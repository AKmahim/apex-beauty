<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/apex-ai-knowledge.php';
require_once __DIR__ . '/site-config.php';

// Apex AI: a retrieval/rule-based chat widget, not a call to an external LLM.
// "Intelligence" here means: weighted keyword scoring against a real
// knowledge base (see apex-ai-knowledge.php), a confidence threshold that
// asks a clarifying question instead of guessing, light topic-continuity
// memory across turns, and small talk / disclaimer handling — all
// deterministic PHP, no network calls, no ongoing cost.

// Covers all 6 site languages, not just EN/DE — a common function word left
// unfiltered in French/Dutch/Italian/Turkish (e.g. Dutch "het") shows up in
// so few corpus entries (only the handful with that language's keywords)
// that IDF mistakes it for a rare, highly specific term and lets it hijack
// unrelated queries. Doesn't need to be exhaustive, just cover what people
// actually type around a question.
const APEX_AI_STOPWORDS = [
    // English
    'a', 'an', 'the', 'is', 'are', 'was', 'were', 'be', 'been', 'to', 'of', 'for', 'and', 'or', 'in', 'on', 'at',
    'it', 'this', 'that', 'do', 'does', 'did', 'how', 'what', 'why', 'when', 'can', 'could', 'will', 'would',
    'i', 'am', 'you', 'your', 'my', 'me', 'about', 'with', 'have', 'has', 'if', 'so', 'not', 'get', 'like', 'im', 'ive',
    // German (written in folded/unaccented form: für -> fur, etc. — matches
    // are compared post-diacritic-folding, see apex_ai_normalize())
    'der', 'die', 'das', 'ein', 'eine', 'einen', 'einem', 'ist', 'sind', 'war', 'waren', 'zu', 'von', 'fur', 'und',
    'oder', 'auf', 'bei', 'es', 'wie', 'was', 'warum', 'wann', 'kann', 'konnen', 'wird', 'wurde', 'ich', 'du', 'sie',
    'mein', 'meine', 'mir', 'uber', 'mit', 'habe', 'hat', 'nicht', 'sich', 'auch', 'noch',
    // French
    'le', 'la', 'les', 'un', 'une', 'des', 'du', 'de', 'ce', 'cette', 'ces', 'est', 'es', 'suis', 'sont', 'sera',
    'avoir', 'ai', 'ont', 'je', 'tu', 'il', 'elle', 'nous', 'vous', 'ils', 'elles', 'mon', 'ma', 'mes', 'ton', 'ta',
    'tes', 'son', 'sa', 'ses', 'que', 'qui', 'quoi', 'qu', 'comment', 'pourquoi', 'quand', 'combien', 'pour', 'avec',
    // NOTE: "ou" (or) deliberately excluded — accent-folding collapses "où"
    // (where) onto the same token, and "where" is worth keeping as a signal.
    'dans', 'sur', 'sans', 'et', 'mais', 'donc', 'car', 'ne', 'pas', 'se', 'd', 'l', 'n', 's', 'ca', 'votre',
    // Dutch
    'het', 'een', 'zijn', 'wordt', 'worden', 'ik', 'jij', 'hij', 'zij', 'wij', 'jullie', 'mijn', 'jouw', 'uw',
    // NOTE: "hoeveel" (how much) deliberately excluded — unlike English "how"
    // it's a single word carrying real meaning (cost questions hinge on it).
    'haar', 'ons', 'hun', 'dat', 'die', 'deze', 'dit', 'wat', 'hoe', 'waarom', 'wanneer', 'voor', 'met',
    'zonder', 'of', 'en', 'maar', 'dus', 'want', 'niet', 'ook', 'nog', 'kunnen', 'wil', 'doet', 'doen', 'heeft', 'hebben', 'u',
    // Italian
    'il', 'lo', 'gli', 'uno', 'una', 'sono', 'era', 'erano', 'sara', 'io', 'lui', 'lei', 'noi', 'voi', 'loro',
    'mio', 'mia', 'tuo', 'tua', 'suo', 'sua', 'cosa', 'come', 'perche', 'quando', 'quanto', 'quanti', 'con', 'su',
    'senza', 'ma', 'quindi', 'anche', 'ancora', 'puo', 'posso', 'ha', 'hanno', 'fa', 'fare',
    // Turkish
    'bir', 'bu', 'su', 'ben', 'sen', 'biz', 'siz', 'onlar', 'benim', 'senin', 'onun', 'bizim', 'sizin', 'onlarin',
    'ne', 'nasil', 'neden', 'kac', 'icin', 'ile', 'mi', 'mi', 'mu', 'mu', 've', 'ama', 'degil', 'da', 'de', 'cok',
];

const APEX_AI_MAX_MESSAGES = 40;
const APEX_AI_WINDOW_SECONDS = 600;
const APEX_AI_MAX_MESSAGE_LENGTH = 800;

// Folds accented Latin letters to their plain form (é/è/ê/ë -> e, ç -> c,
// ü/ö/ä -> u/o/a, ı/ş/ğ -> i/s/g, ...) so matching doesn't depend on a
// visitor's keyboard including the right diacritics, and so one stopword
// list can cover all 6 site languages without listing every accented
// variant. Applied uniformly to corpus text and queries alike via
// apex_ai_normalize(), the sole choke point both go through.
const APEX_AI_DIACRITIC_MAP = [
    'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
    'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
    'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ı' => 'i',
    'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
    'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
    'ç' => 'c', 'ñ' => 'n', 'ß' => 'ss', 'ş' => 's', 'ğ' => 'g',
];

function apex_ai_normalize(string $s): string
{
    $s = mb_strtolower($s, 'UTF-8');
    $s = strtr($s, APEX_AI_DIACRITIC_MAP);
    $s = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $s) ?? $s;
    $s = preg_replace('/\s+/', ' ', $s) ?? $s;
    return trim($s);
}

// Crude English-plural stemmer (transplants -> transplant, grafts -> graft).
// Applied identically to corpus keywords and query tokens so both sides
// normalize the same way; harmless no-op on German words that don't end in
// a bare "s" (most German plurals end in -en/-er/-e, not -s).
function apex_ai_stem(string $tok): string
{
    $len = mb_strlen($tok, 'UTF-8');
    if ($len >= 4 && mb_substr($tok, -1, 1, 'UTF-8') === 's' && mb_substr($tok, -2, 2, 'UTF-8') !== 'ss') {
        return mb_substr($tok, 0, $len - 1, 'UTF-8');
    }
    return $tok;
}

function apex_ai_tokens(string $s): array
{
    $norm = apex_ai_normalize($s);
    if ($norm === '') {
        return [];
    }
    return array_map('apex_ai_stem', explode(' ', $norm));
}

// Role multipliers: where a word appears still matters (a title word is a
// better signal than an incidental body word), but the multiplier is now
// combined with real IDF below rather than standing alone — a role bonus by
// itself can't tell "hair transplant" (in nearly every entry) apart from
// "kostet" (in exactly one).
const APEX_AI_ROLE_TITLE = 2.0;
const APEX_AI_ROLE_KEYWORD = 3.0;
const APEX_AI_ROLE_BODY = 1.0;

function apex_ai_entry_raw_tokens(array $entry): array
{
    $roles = [];
    foreach (['en', 'de', 'fr', 'nl', 'it', 'tr'] as $lang) {
        foreach (apex_ai_tokens($entry['title'][$lang] ?? '') as $tok) {
            if (!in_array($tok, APEX_AI_STOPWORDS, true)) {
                $roles[$tok] = max($roles[$tok] ?? 0, APEX_AI_ROLE_TITLE);
            }
        }
        foreach (($entry['extraKeywords'][$lang] ?? []) as $phrase) {
            foreach (apex_ai_tokens($phrase) as $tok) {
                if (!in_array($tok, APEX_AI_STOPWORDS, true)) {
                    $roles[$tok] = max($roles[$tok] ?? 0, APEX_AI_ROLE_KEYWORD);
                }
            }
        }
        foreach (apex_ai_tokens($entry['text'][$lang] ?? '') as $tok) {
            if (!in_array($tok, APEX_AI_STOPWORDS, true)) {
                $roles[$tok] = max($roles[$tok] ?? 0, APEX_AI_ROLE_BODY);
            }
        }
    }
    return $roles;
}

/**
 * Document frequency of every token across the whole knowledge base, i.e.
 * how many entries mention it at all. A word like "hair" or "transplant"
 * that shows up in dozens of entries carries almost no discriminating power
 * ("of course a hair-transplant site's chatbot corpus mentions hair
 * transplants everywhere"); a word like "kostet" or "finasteride" that shows
 * up in one or two is a strong, specific signal. IDF below turns that
 * document frequency into a weight multiplier.
 */
function apex_ai_document_frequencies(): array
{
    static $df = null;
    if ($df !== null) {
        return $df;
    }
    $df = [];
    foreach (apex_ai_knowledge_base() as $entry) {
        foreach (array_keys(apex_ai_entry_raw_tokens($entry)) as $tok) {
            $df[$tok] = ($df[$tok] ?? 0) + 1;
        }
    }
    return $df;
}

// PHP silently casts purely-numeric string array keys (e.g. the "5" in
// "5-alpha reductase") to int, so a token can arrive here as either —
// accept both rather than let a token like that throw a TypeError.
function apex_ai_idf(int|string $token): float
{
    static $n = null;
    if ($n === null) {
        $n = count(apex_ai_knowledge_base());
    }
    $df = apex_ai_document_frequencies()[$token] ?? 0;
    return log(($n + 1) / ($df + 1)) + 1.0;
}

function apex_ai_entry_keyword_weights(array $entry): array
{
    static $cache = [];
    if (isset($cache[$entry['id']])) {
        return $cache[$entry['id']];
    }
    $weighted = [];
    foreach (apex_ai_entry_raw_tokens($entry) as $tok => $role) {
        $weighted[$tok] = $role * apex_ai_idf($tok);
    }
    $cache[$entry['id']] = $weighted;
    return $weighted;
}

function apex_ai_score_entry(array $entry, string $normalizedQuery, array $queryTokenCounts): float
{
    $weighted = apex_ai_entry_keyword_weights($entry);
    $score = 0.0;
    foreach ($queryTokenCounts as $tok => $count) {
        if (isset($weighted[$tok])) {
            $score += $weighted[$tok] * $count;
        }
    }

    // A whole distinctive phrase appearing verbatim is still a strong
    // signal on top of the per-word score, but scaled by how discriminating
    // its words are, so a generic phrase can't dominate on length alone.
    foreach (['en', 'de', 'fr', 'nl', 'it', 'tr'] as $lang) {
        $phrases = $entry['extraKeywords'][$lang] ?? [];
        if (!empty($entry['title'][$lang])) {
            $phrases[] = $entry['title'][$lang];
        }
        foreach ($phrases as $phrase) {
            $p = apex_ai_normalize($phrase);
            if ($p === '' || mb_strlen($p) < 4 || !str_contains($normalizedQuery, $p)) {
                continue;
            }
            $words = array_filter(explode(' ', $p), static fn(string $w): bool => !in_array($w, APEX_AI_STOPWORDS, true));
            if (!$words) {
                continue;
            }
            $avgIdf = array_sum(array_map('apex_ai_idf', $words)) / count($words);
            $score += 2.0 * $avgIdf;
        }
    }
    return $score;
}

function apex_ai_text_lang(string $lang): string
{
    return in_array($lang, ['en', 'de'], true) ? $lang : 'en';
}

function apex_ai_disclaimer(string $textLang): string
{
    return $textLang === 'de'
        ? 'Dies sind allgemeine Informationen, keine medizinische Beratung. Für eine persönliche Einschätzung vereinbaren Sie eine kostenlose Beratung.'
        : 'This is general information, not medical advice. For a personal assessment, book a free consultation.';
}

function apex_ai_needs_disclaimer(array $entry): bool
{
    return $entry['category'] === 'education';
}

/**
 * Genuinely-related entries, not just "next N in array order" — treats the
 * matched entry's own title as a pseudo-query and scores every other entry
 * against it with the same IDF-weighted scorer used for real messages, so
 * e.g. "FUE" suggests "Sapphire FUE" / "DHI" / technique comparison rather
 * than whichever glossary term happens to be first in the corpus.
 */
function apex_ai_related_entries(array $kb, array $entry, int $limit = 3): array
{
    $textLang = apex_ai_text_lang('en');
    $pseudoQuery = trim(($entry['title'][$textLang] ?? '') . ' ' . ($entry['title']['de'] ?? ''));
    $normalizedQuery = apex_ai_normalize($pseudoQuery);
    $tokens = array_diff(apex_ai_tokens($pseudoQuery), APEX_AI_STOPWORDS);
    $queryTokenCounts = array_count_values($tokens);

    $scored = [];
    foreach ($kb as $candidate) {
        if ($candidate['id'] === $entry['id']) {
            continue;
        }
        $score = apex_ai_score_entry($candidate, $normalizedQuery, $queryTokenCounts);
        if ($candidate['category'] === $entry['category']) {
            $score += 1.0; // mild same-category nudge as a tie-breaker
        }
        if ($score > 0) {
            $scored[] = ['entry' => $candidate, 'score' => $score];
        }
    }
    usort($scored, static fn(array $a, array $b): int => $b['score'] <=> $a['score']);

    return array_map(static fn(array $s): array => $s['entry'], array_slice($scored, 0, $limit));
}

function apex_ai_compose_answer(array $entry, array $kb, string $lang): array
{
    $textLang = apex_ai_text_lang($lang);
    $reply = $entry['text'][$textLang] ?? $entry['text']['en'];
    if (apex_ai_needs_disclaimer($entry)) {
        $reply .= "\n\n" . apex_ai_disclaimer($textLang);
    }

    $quickReplies = [];
    foreach (apex_ai_related_entries($kb, $entry) as $related) {
        $quickReplies[] = $related['title'][$textLang] ?? $related['title']['en'];
    }

    return [
        'reply' => $reply,
        'quickReplies' => array_values(array_unique($quickReplies)),
        'topicId' => $entry['id'],
    ];
}

function apex_ai_clarify_from_candidates(array $scored, string $lang): array
{
    $textLang = apex_ai_text_lang($lang);
    $labels = [];
    foreach (array_slice($scored, 0, 3) as $s) {
        $labels[] = $s['entry']['title'][$textLang] ?? $s['entry']['title']['en'];
    }
    $prompt = $textLang === 'de'
        ? 'Damit ich die richtige Frage beantworte — meinten Sie eines davon?'
        : 'To make sure I answer the right question — did you mean one of these?';
    return [
        'reply' => $prompt,
        'quickReplies' => array_values(array_unique($labels)),
        'topicId' => null,
    ];
}

function apex_ai_fallback_response(string $lang): array
{
    $textLang = apex_ai_text_lang($lang);
    $reply = $textLang === 'de'
        ? ('Dazu habe ich noch keine genauen Informationen. Ich kann bei Transplantationstechniken, Ursachen und Arten von Haarausfall, '
            . 'Genesung, Eignung oder der Buchung einer kostenlosen Beratung helfen — oder schreiben Sie uns direkt auf WhatsApp unter '
            . APEX_WHATSAPP_DISPLAY . '.')
        : ("I don't have specific information on that yet. I can help with hair transplant techniques, causes and types of hair loss, "
            . 'recovery, candidacy, or booking a free consultation — or message us directly on WhatsApp at ' . APEX_WHATSAPP_DISPLAY . '.');

    $quickReplies = $textLang === 'de'
        ? ['FUE vs. Saphir-FUE vs. DHI', 'Bin ich geeignet?', 'Wie buche ich eine Beratung?']
        : ['FUE vs Sapphire FUE vs DHI', 'Am I a good candidate?', 'How do I book a consultation?'];

    return ['reply' => $reply, 'quickReplies' => $quickReplies, 'topicId' => null];
}

function apex_ai_match_small_talk(string $normalizedMessage, string $lang): ?array
{
    $textLang = apex_ai_text_lang($lang);

    $greetings = ['hi', 'hello', 'hey', 'hallo', 'servus', 'guten tag', 'moin', 'good morning', 'good evening', 'bonjour', 'hallo daar', 'ciao', 'merhaba', 'selam'];
    foreach ($greetings as $g) {
        if ($normalizedMessage === $g || str_starts_with($normalizedMessage, $g . ' ')) {
            return [
                'reply' => $textLang === 'de'
                    ? 'Hallo! Ich bin Apex AI. Fragen Sie mich alles über Haartransplantation oder Apex Beauty.'
                    : "Hi there! I'm Apex AI. Ask me anything about hair transplants or Apex Beauty.",
                'quickReplies' => $textLang === 'de'
                    ? ['Was ist eine Haartransplantation?', 'FUE vs. Saphir-FUE vs. DHI', 'Bin ich geeignet?']
                    : ['What is a hair transplant?', 'FUE vs Sapphire FUE vs DHI', 'Am I a good candidate?'],
                'topicId' => null,
            ];
        }
    }

    $thanks = ['thanks', 'thank you', 'thx', 'danke', 'vielen dank', 'dankeschon', 'merci', 'bedankt', 'grazie', 'tesekkurler'];
    foreach ($thanks as $t) {
        if (str_contains($normalizedMessage, $t)) {
            return [
                'reply' => $textLang === 'de' ? 'Gern geschehen! Fragen Sie ruhig weiter.' : "You're welcome! Feel free to ask anything else.",
                'quickReplies' => [],
                'topicId' => null,
            ];
        }
    }

    $byes = ['bye', 'goodbye', 'see you', 'tschuss', 'tschuess', 'auf wiedersehen'];
    foreach ($byes as $b) {
        if (str_contains($normalizedMessage, $b)) {
            return [
                'reply' => $textLang === 'de' ? 'Bis bald! Bei weiteren Fragen bin ich hier.' : "Take care! I'm here whenever you have more questions.",
                'quickReplies' => [],
                'topicId' => null,
            ];
        }
    }

    return null;
}

// A small, curated bridge between common everyday phrasing and this
// corpus's own vocabulary — not a real synonym dictionary, just the
// handful of substitutions that matter for the questions people actually
// ask (identified by testing the matcher against paraphrased questions).
// Added to the query only, never to the corpus, so it can't dilute an
// entry's own specificity.
const APEX_AI_QUERY_SYNONYMS = [
    'en' => [
        'hairs' => ['graft'], 'surgery' => ['transplant'], 'operation' => ['transplant'],
        'hurt' => ['pain'], 'painful' => ['pain'], 'sore' => ['pain'],
        'dangerous' => ['risk', 'safety'], 'risky' => ['risk', 'safety'], 'safe' => ['safety'],
        'job' => ['work'], 'office' => ['work'],
    ],
    'de' => [
        'op' => ['operation'], 'eingriff' => ['operation'],
        'weh' => ['schmerz'], 'schmerzhaft' => ['schmerz'],
        'gefahrlich' => ['risiko', 'sicherheit'], 'sicher' => ['sicherheit'],
        'job' => ['arbeit'], 'buro' => ['arbeit'],
    ],
];

function apex_ai_expand_synonyms(array $tokens, string $lang): array
{
    $map = APEX_AI_QUERY_SYNONYMS[$lang] ?? [];
    if (!$map) {
        return $tokens;
    }
    $expanded = $tokens;
    foreach ($tokens as $tok) {
        foreach (($map[$tok] ?? []) as $syn) {
            $expanded[] = $syn;
        }
    }
    return $expanded;
}

/** Which of the query's tokens actually contributed to this entry's score. */
function apex_ai_matched_tokens(array $entry, array $queryTokenCounts): array
{
    $weighted = apex_ai_entry_keyword_weights($entry);
    $matched = [];
    foreach (array_keys($queryTokenCounts) as $tok) {
        if (($weighted[$tok] ?? 0) > 0) {
            $matched[] = $tok;
        }
    }
    return $matched;
}

function apex_ai_compose_multi_answer(array $first, array $second, array $kb, string $lang): array
{
    $textLang = apex_ai_text_lang($lang);
    $reply = ($first['text'][$textLang] ?? $first['text']['en']) . "\n\n" . ($second['text'][$textLang] ?? $second['text']['en']);
    if (apex_ai_needs_disclaimer($first) || apex_ai_needs_disclaimer($second)) {
        $reply .= "\n\n" . apex_ai_disclaimer($textLang);
    }

    $quickReplies = [];
    foreach (apex_ai_related_entries($kb, $first, 2) as $r) {
        $quickReplies[] = $r['title'][$textLang] ?? $r['title']['en'];
    }
    foreach (apex_ai_related_entries($kb, $second, 2) as $r) {
        $quickReplies[] = $r['title'][$textLang] ?? $r['title']['en'];
    }

    return [
        'reply' => $reply,
        'quickReplies' => array_values(array_unique(array_slice($quickReplies, 0, 3))),
        'topicId' => $first['id'],
    ];
}

/** Every meaningful (title/keyword-role) word in the corpus — the set of "correct" spellings to fix typos toward. */
function apex_ai_correction_vocabulary(): array
{
    static $vocab = null;
    if ($vocab !== null) {
        return $vocab;
    }
    $vocab = [];
    foreach (apex_ai_knowledge_base() as $entry) {
        foreach (apex_ai_entry_raw_tokens($entry) as $tok => $role) {
            if ($role >= APEX_AI_ROLE_TITLE && mb_strlen((string) $tok, 'UTF-8') >= 3) {
                $vocab[$tok] = true;
            }
        }
    }
    $vocab = array_keys($vocab);
    return $vocab;
}

/** Closest known vocabulary word within a small edit distance, or null if nothing is close enough to be confident. */
// Optimal-string-alignment variant of Damerau-Levenshtein: like plain
// Levenshtein (insert/delete/substitute) but an adjacent-letter swap costs 1
// instead of 2. That swap is by far the most common short-acronym typo
// ("FEU" for "FUE", "saef" for "safe") and plain levenshtein() would miss
// both at the tight distance threshold a 3-4 letter word needs to avoid
// false corrections.
function apex_ai_edit_distance(string $a, string $b): int
{
    $ca = preg_split('//u', $a, -1, PREG_SPLIT_NO_EMPTY) ?: [];
    $cb = preg_split('//u', $b, -1, PREG_SPLIT_NO_EMPTY) ?: [];
    $la = count($ca);
    $lb = count($cb);
    $d = [];
    for ($i = 0; $i <= $la; $i++) {
        $d[$i][0] = $i;
    }
    for ($j = 0; $j <= $lb; $j++) {
        $d[0][$j] = $j;
    }
    for ($i = 1; $i <= $la; $i++) {
        for ($j = 1; $j <= $lb; $j++) {
            $cost = ($ca[$i - 1] === $cb[$j - 1]) ? 0 : 1;
            $d[$i][$j] = min($d[$i - 1][$j] + 1, $d[$i][$j - 1] + 1, $d[$i - 1][$j - 1] + $cost);
            if ($i > 1 && $j > 1 && $ca[$i - 1] === $cb[$j - 2] && $ca[$i - 2] === $cb[$j - 1]) {
                $d[$i][$j] = min($d[$i][$j], $d[$i - 2][$j - 2] + 1);
            }
        }
    }
    return $d[$la][$lb];
}

function apex_ai_fuzzy_correct(string $token): ?string
{
    $len = mb_strlen($token, 'UTF-8');
    if ($len < 3) {
        return null;
    }
    $maxDist = $len >= 6 ? 2 : 1;
    $best = null;
    $bestDist = $maxDist + 1;
    foreach (apex_ai_correction_vocabulary() as $word) {
        if (abs(mb_strlen((string) $word, 'UTF-8') - $len) > $maxDist) {
            continue; // cheap filter before the more expensive edit-distance call
        }
        $dist = apex_ai_edit_distance($token, (string) $word);
        if ($dist < $bestDist) {
            $bestDist = $dist;
            $best = (string) $word;
        }
    }
    return $bestDist <= $maxDist ? $best : null;
}

/**
 * Only for tokens the exact matcher has never seen anywhere in the corpus
 * (a real word just scores 0 on an entry, but is still a known token) — so
 * this only fires on genuine typos ("FEU"), not on words that are simply
 * absent from a given entry.
 */
function apex_ai_apply_fuzzy_corrections(array $queryTokenCounts): array
{
    $df = apex_ai_document_frequencies();
    $augmented = $queryTokenCounts;
    foreach ($queryTokenCounts as $tok => $count) {
        if (isset($df[$tok])) {
            continue;
        }
        $corrected = apex_ai_fuzzy_correct((string) $tok);
        if ($corrected !== null) {
            $augmented[$corrected] = ($augmented[$corrected] ?? 0) + $count;
        }
    }
    return $augmented;
}

function apex_ai_respond(string $message, string $lang, ?string $lastTopicId): array
{
    $lang = in_array($lang, ['de', 'en', 'fr', 'nl', 'it', 'tr'], true) ? $lang : 'de';
    $trimmed = trim($message);
    if ($trimmed === '') {
        return apex_ai_fallback_response($lang);
    }

    $normalizedQuery = apex_ai_normalize($trimmed);

    $smallTalk = apex_ai_match_small_talk($normalizedQuery, $lang);
    if ($smallTalk !== null) {
        return $smallTalk;
    }

    $tokens = array_diff(apex_ai_tokens($trimmed), APEX_AI_STOPWORDS);
    $tokens = apex_ai_expand_synonyms($tokens, apex_ai_text_lang($lang));
    $queryTokenCounts = array_count_values($tokens);

    $kb = apex_ai_knowledge_base();
    $scored = [];
    foreach ($kb as $entry) {
        $score = apex_ai_score_entry($entry, $normalizedQuery, $queryTokenCounts);
        if ($lastTopicId !== null && $entry['id'] === $lastTopicId) {
            $score += 1.5; // topic-continuity nudge for short ambiguous follow-ups
        }
        if ($score > 0) {
            $scored[] = ['entry' => $entry, 'score' => $score];
        }
    }
    usort($scored, static fn(array $a, array $b): int => $b['score'] <=> $a['score']);

    // Typo tolerance as a fallback, not the primary path: only try correcting
    // spelling once the exact match has already failed or is too weak to
    // trust, and only keep the correction if it turns into a confident match
    // — so a genuine (if unusual) query never gets silently "corrected" into
    // the wrong topic just because some word also resembles another one.
    if (!$scored || $scored[0]['score'] < 2.5) {
        $correctedCounts = apex_ai_apply_fuzzy_corrections($queryTokenCounts);
        if ($correctedCounts !== $queryTokenCounts) {
            $retryScored = [];
            foreach ($kb as $entry) {
                $score = apex_ai_score_entry($entry, $normalizedQuery, $correctedCounts);
                if ($lastTopicId !== null && $entry['id'] === $lastTopicId) {
                    $score += 1.5;
                }
                if ($score > 0) {
                    $retryScored[] = ['entry' => $entry, 'score' => $score];
                }
            }
            usort($retryScored, static fn(array $a, array $b): int => $b['score'] <=> $a['score']);
            if ($retryScored && $retryScored[0]['score'] >= 2.5) {
                $scored = $retryScored;
            }
        }
    }

    if (!$scored) {
        return apex_ai_fallback_response($lang);
    }

    $top = $scored[0];
    if ($top['score'] < 2.5) {
        return apex_ai_clarify_from_candidates($scored, $lang);
    }

    // Compound question ("cost AND recovery"): the second-best entry is
    // confident in its own right, and answers a genuinely different part of
    // the question rather than riding on the same words the top entry
    // already matched. Answer both instead of silently dropping one.
    $second = $scored[1] ?? null;
    if ($second !== null && $second['entry']['id'] !== $top['entry']['id'] && $top['score'] >= 6 && $second['score'] >= 5) {
        $topTokens = apex_ai_matched_tokens($top['entry'], $queryTokenCounts);
        $secondTokens = apex_ai_matched_tokens($second['entry'], $queryTokenCounts);
        $overlap = count(array_intersect($topTokens, $secondTokens));
        $union = count(array_unique(array_merge($topTokens, $secondTokens)));
        $jaccard = $union > 0 ? $overlap / $union : 1.0;
        if ($jaccard < 0.35) {
            return apex_ai_compose_multi_answer($top['entry'], $second['entry'], $kb, $lang);
        }
    }

    $close = array_values(array_filter(
        $scored,
        static fn(array $s): bool => $s['entry']['id'] !== $top['entry']['id'] && $s['score'] >= $top['score'] * 0.75
    ));
    if ($close && $top['score'] < 6) {
        return apex_ai_clarify_from_candidates(array_merge([$top], $close), $lang);
    }

    return apex_ai_compose_answer($top['entry'], $kb, $lang);
}

// ---- Rate limiting (file-based, same pattern as includes/auth.php's login
// throttle) — defends against a scripted flood of requests, not a cost
// concern since there's no external API call behind this.
//
// Check-and-increment happens as one flock()-guarded read-modify-write, not
// two separate ones (an earlier version read the count in one function and
// wrote the increment in another, unlocked) — under real concurrent traffic
// on a multi-worker server, two requests could both read "39" and both
// write "40", silently losing a hit and letting a burst slip past the cap.
// PHP's built-in dev server (php -S) processes requests one at a time, so
// this race can't be reproduced there; it only shows up under something
// like PHP-FPM/Apache with multiple workers, which is what production runs. ----

function apex_ai_hits_path(): string
{
    return APEX_DATA_DIR . '/chat-hits.json';
}

/** Returns true if this request should be blocked (429), false if it was recorded and may proceed. */
function apex_ai_check_and_record_hit(string $ip): bool
{
    $fh = fopen(apex_ai_hits_path(), 'c+');
    if ($fh === false) {
        return false; // fail open rather than break the widget over a filesystem hiccup
    }
    if (!flock($fh, LOCK_EX)) {
        fclose($fh);
        return false;
    }

    $raw = stream_get_contents($fh);
    $hits = json_decode((string) $raw, true);
    $hits = is_array($hits) ? $hits : [];

    $now = time();
    $entry = $hits[$ip] ?? null;
    $limited = false;
    if (is_array($entry) && ($now - (int) ($entry['windowStart'] ?? 0)) <= APEX_AI_WINDOW_SECONDS) {
        if ((int) ($entry['count'] ?? 0) >= APEX_AI_MAX_MESSAGES) {
            $limited = true;
        } else {
            $hits[$ip]['count'] = (int) $entry['count'] + 1;
        }
    } else {
        $hits[$ip] = ['count' => 1, 'windowStart' => $now];
    }

    if (!$limited) {
        foreach ($hits as $k => $v) {
            if (($now - (int) ($v['windowStart'] ?? 0)) > APEX_AI_WINDOW_SECONDS * 6) {
                unset($hits[$k]);
            }
        }
        rewind($fh);
        ftruncate($fh, 0);
        fwrite($fh, json_encode($hits));
        fflush($fh);
    }

    flock($fh, LOCK_UN);
    fclose($fh);
    return $limited;
}
