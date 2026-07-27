<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/apex-ai.php';

// The "sales agent" layer on top of Apex AI's Q&A engine: a small,
// deterministic conversation state machine (not the LLM's own reasoning —
// there is none) that recognises buying-intent signals, proactively offers
// a free consultation, and — if the visitor agrees — collects name/email/
// phone/timing turn by turn and writes a real row into the same `leads`
// table the site's own consultation form uses (see includes/db.php), so it
// shows up in the admin dashboard identically, just tagged with a distinct
// UTM source.
//
// State (`leadState`) is round-tripped through the client exactly like
// `lastTopicId` — the server is stateless between requests, the browser
// just echoes back whatever it was last given.

const APEX_AI_LEAD_TIMING_VALUES = ['this-month', '1-3', '3-6', '6plus', 'research'];

// Topics worth a soft consultation offer once answered — high commercial
// intent (cost, candidacy, comparing techniques) rather than pure trivia
// (a glossary term, an aftercare rule).
const APEX_AI_LEAD_OFFER_TOPICS = [
    'cost-pricing', 'candidacy', 'booking-consultation', 'technique-comparison',
    'what-is-hair-transplant', 'safety-risks',
];

function apex_ai_lead_copy(string $key, string $textLang, array $vars = []): string
{
    $en = [
        'offer' => "If you'd like, I can arrange a free consultation with our team — it only takes a couple of quick details.",
        'ask_name' => "Great — let's get that arranged. What's your name?",
        'name_retry' => "Sorry, that doesn't look like a name — could you type just your first name?",
        'ask_email' => 'Thanks, {name}! What email should our team reach you at?',
        'email_retry' => "That doesn't look like a valid email — mind double-checking it?",
        'email_required' => "I'll need an email so our team can actually get back to you — it's only used for this enquiry.",
        'ask_phone' => 'And a phone or WhatsApp number, if you\'d like a faster reply? You can also just say "skip".',
        'ask_timing' => 'Last thing — when are you thinking of moving forward?',
        'confirm' => "Here's what I have:\nName: {name}\nEmail: {email}\nPhone: {phone}\nTiming: {timing}\n\nShall I send this to our team? They'll only use it to follow up on this enquiry.",
        'confirm_retry' => 'Sorry, I didn\'t catch that — should I go ahead and send your details, or start over?',
        'submitted' => "All set, {name}! Our team will reach out to {email} shortly. Anything else I can help with in the meantime?",
        'submit_failed' => "Sorry, something went wrong sending that on my end. Could you message us directly on WhatsApp at " . APEX_WHATSAPP_DISPLAY . ' instead? Your details weren\'t saved.',
        'cancelled' => "No problem, I've cancelled that. Feel free to ask me anything else.",
        'declined_offer' => 'No problem at all — what else would you like to know?',
        'resume_prefix' => "Whenever you're ready to continue: ",
    ];
    $de = [
        'offer' => 'Wenn Sie möchten, kann ich eine kostenlose Beratung mit unserem Team für Sie einrichten — dafür brauche ich nur ein paar kurze Angaben.',
        'ask_name' => 'Gerne — richten wir das ein. Wie ist Ihr Name?',
        'name_retry' => 'Entschuldigung, das sieht nicht nach einem Namen aus — könnten Sie einfach Ihren Vornamen eingeben?',
        'ask_email' => 'Danke, {name}! Unter welcher E-Mail-Adresse erreicht Sie unser Team am besten?',
        'email_retry' => 'Das sieht nicht nach einer gültigen E-Mail-Adresse aus — können Sie sie noch einmal prüfen?',
        'email_required' => 'Ich brauche eine E-Mail-Adresse, damit unser Team Sie erreichen kann — sie wird nur für diese Anfrage verwendet.',
        'ask_phone' => 'Und eine Telefon- oder WhatsApp-Nummer, falls Sie schneller kontaktiert werden möchten? Sie können auch einfach "überspringen" schreiben.',
        'ask_timing' => 'Letzte Frage — wann denken Sie, den nächsten Schritt zu machen?',
        'confirm' => "Das habe ich notiert:\nName: {name}\nE-Mail: {email}\nTelefon: {phone}\nZeitpunkt: {timing}\n\nSoll ich das an unser Team senden? Es wird nur für die Rückmeldung zu dieser Anfrage verwendet.",
        'confirm_retry' => 'Entschuldigung, das habe ich nicht verstanden — soll ich Ihre Angaben senden oder von vorne beginnen?',
        'submitted' => 'Erledigt, {name}! Unser Team wird sich in Kürze bei {email} melden. Kann ich in der Zwischenzeit noch etwas für Sie tun?',
        'submit_failed' => 'Entschuldigung, dabei ist auf meiner Seite etwas schiefgelaufen. Könnten Sie uns stattdessen direkt auf WhatsApp unter ' . APEX_WHATSAPP_DISPLAY . ' schreiben? Ihre Angaben wurden nicht gespeichert.',
        'cancelled' => 'Kein Problem, ich habe das abgebrochen. Fragen Sie mich gerne alles andere.',
        'declined_offer' => 'Kein Problem — was möchten Sie sonst noch wissen?',
        'resume_prefix' => 'Sobald Sie bereit sind, weiterzumachen: ',
    ];
    $dict = $textLang === 'de' ? $de : $en;
    $str = $dict[$key] ?? ($en[$key] ?? '');
    foreach ($vars as $k => $v) {
        $str = str_replace('{' . $k . '}', (string) $v, $str);
    }
    return $str;
}

function apex_ai_lead_confirm_quick_replies(string $textLang): array
{
    return $textLang === 'de' ? ['Ja, senden', 'Neu starten'] : ['Yes, send it', 'Start over'];
}

function apex_ai_lead_timing_labels(string $textLang): array
{
    return $textLang === 'de'
        ? ['Diesen Monat', 'In 1–3 Monaten', 'In 3–6 Monaten', 'In 6+ Monaten', 'Nur recherchieren']
        : ['This month', 'In 1–3 months', 'In 3–6 months', 'In 6+ months', 'Just researching'];
}

function apex_ai_lead_response(string $textLang, string $key, array $vars = [], array $quickReplies = [], ?array $leadState = null): array
{
    return [
        'reply' => apex_ai_lead_copy($key, $textLang, $vars),
        'quickReplies' => $quickReplies,
        'topicId' => null,
        'leadState' => $leadState ?? apex_ai_lead_state_defaults(),
    ];
}

function apex_ai_lead_state_defaults(): array
{
    return ['step' => 'idle', 'data' => [], 'offered' => false];
}

function apex_ai_normalize_lead_state($raw): array
{
    if (!is_array($raw)) {
        return apex_ai_lead_state_defaults();
    }
    $validSteps = ['idle', 'awaiting_name', 'awaiting_email', 'awaiting_phone', 'awaiting_timing', 'awaiting_confirm'];
    $step = is_string($raw['step'] ?? null) && in_array($raw['step'], $validSteps, true) ? $raw['step'] : 'idle';
    $data = is_array($raw['data'] ?? null) ? $raw['data'] : [];
    $clean = [];
    foreach (['name', 'email', 'phone', 'timing', 'procedures'] as $k) {
        if (isset($data[$k]) && (is_string($data[$k]) || is_array($data[$k]))) {
            $clean[$k] = $data[$k];
        }
    }
    return ['step' => $step, 'data' => $clean, 'offered' => !empty($raw['offered'])];
}

// ---- Small phrase detectors (EN + DE; the rest of the site's convention —
// full support in the two complete languages, graceful English fallback for
// FR/NL/IT/TR since a mis-detected "yes" mid-lead-capture is worse than a
// visitor occasionally needing to re-click a chip). ----

function apex_ai_lead_booking_intent(string $normalized): bool
{
    $phrases = [
        'book me', 'book a consultation', 'i want to book', 'sign me up', 'count me in',
        'i am interested', 'im interested', 'get started', 'contact me', 'call me back',
        'schedule a consultation', 'arrange a consultation', 'free consultation',
        'buchen', 'anmelden', 'einplanen', 'ich bin interessiert', 'kontaktieren sie mich',
        'rufen sie mich an', 'termin vereinbaren', 'kostenlose beratung',
    ];
    foreach ($phrases as $p) {
        if (str_contains($normalized, $p)) {
            return true;
        }
    }
    return false;
}

function apex_ai_lead_is_affirmative(string $normalized): bool
{
    $words = ['yes', 'yeah', 'yep', 'sure', 'ok', 'okay', 'go ahead', 'send it', 'book me', 'sign me up', 'ja', 'jep', 'klar', 'gerne', 'mach das'];
    foreach ($words as $w) {
        if ($normalized === $w || str_starts_with($normalized, $w . ' ') || str_contains($normalized, $w)) {
            return true;
        }
    }
    return false;
}

// Deliberately excludes a bare "no"/"nein" — at the phone step that means
// "skip this field," not "cancel the whole thing," so it's ambiguous
// without knowing which step is asking. Callers that reach a step where a
// bare "no" unambiguously means decline (confirming submission) check for
// it explicitly themselves instead.
function apex_ai_lead_is_cancel(string $normalized): bool
{
    $words = ['no thanks', 'not now', 'cancel', 'stop', 'nevermind', 'never mind', 'start over',
        'nein danke', 'nicht jetzt', 'abbrechen', 'stopp', 'neu starten', 'von vorne'];
    foreach ($words as $w) {
        if (str_contains($normalized, $w)) {
            return true;
        }
    }
    return false;
}

function apex_ai_lead_is_decline_offer(string $normalized): bool
{
    $phrases = ['not yet', 'more questions', 'no thanks', 'not now', 'maybe later',
        'noch nicht', 'weitere fragen', 'nein danke', 'nicht jetzt', 'vielleicht spater'];
    foreach ($phrases as $p) {
        if (str_contains($normalized, $p)) {
            return true;
        }
    }
    return false;
}

function apex_ai_lead_is_skip(string $normalized): bool
{
    $words = ['skip', 'none', 'no', 'uberspringen', 'überspringen', 'nein', 'kein'];
    foreach ($words as $w) {
        if ($normalized === $w) {
            return true;
        }
    }
    return false;
}

// Deliberately conservative: requires an actual "?" or a leading
// interrogative word, checked against the *unfiltered* first token (the
// stopword list would otherwise strip exactly the words this needs to see —
// "what", "is", "wie" are stopwords for scoring purposes, not for this).
function apex_ai_looks_like_question(string $trimmed): bool
{
    if (str_contains($trimmed, '?')) {
        return true;
    }
    $starters = ['what', 'how', 'why', 'when', 'is', 'are', 'can', 'does', 'do', 'will', 'would',
        'was', 'wie', 'warum', 'wann', 'kann', 'ist', 'sind', 'wird'];
    $tokens = apex_ai_tokens($trimmed);
    return isset($tokens[0]) && in_array($tokens[0], $starters, true);
}

function apex_ai_lead_extract_email(string $text): ?string
{
    if (preg_match('/[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}/', $text, $m)) {
        return $m[0];
    }
    return null;
}

function apex_ai_lead_match_timing(string $normalized): ?string
{
    $map = [
        'this-month' => ['this month', 'diesen monat', 'this-month'],
        '1-3' => ['1-3', '1 to 3', '1 bis 3', '1–3'],
        '3-6' => ['3-6', '3 to 6', '3 bis 6', '3–6'],
        '6plus' => ['6+', '6 plus', 'more than 6', 'über 6', 'ueber 6'],
        'research' => ['research', 'just looking', 'recherchier', 'informier'],
    ];
    foreach ($map as $value => $phrases) {
        foreach ($phrases as $p) {
            if (str_contains($normalized, $p)) {
                return $value;
            }
        }
    }
    return null;
}

/** Which of the site's procedure checkboxes this conversation was actually about, inferred from the topic just discussed. */
function apex_ai_lead_infer_procedures(array $kb, ?string $topicId): array
{
    if ($topicId === null) {
        return ['hair'];
    }
    foreach ($kb as $entry) {
        if ($entry['id'] === $topicId) {
            $title = mb_strtolower($entry['title']['en'] ?? '', 'UTF-8');
            if (str_contains($title, 'prp')) {
                return ['prp'];
            }
            if (str_contains($title, 'exosome')) {
                return ['exosome'];
            }
            break;
        }
    }
    return ['hair'];
}

/**
 * Writes the collected lead into the same `leads` table the site's own
 * consultation form uses. Wrapped defensively: this chat widget runs on
 * every page regardless of whether MySQL happens to be reachable right
 * now, and a DB hiccup should degrade to "message us on WhatsApp instead",
 * not take down the whole chat.
 */
function apex_ai_submit_lead(array $data, string $lang, array $kb, ?string $topicId): bool
{
    try {
        require_once __DIR__ . '/db.php';
        $lead = [
            'name' => (string) ($data['name'] ?? ''),
            'email' => (string) ($data['email'] ?? ''),
            'phone' => isset($data['phone']) ? (string) $data['phone'] : null,
            'procedures' => apex_ai_lead_infer_procedures($kb, $topicId),
            'therapies' => [],
            'timing' => $data['timing'] ?? null,
            'notes' => 'Captured via the Apex AI chat widget.',
            'lang' => $lang,
            'utm' => ['source' => 'apex_ai_chat', 'medium' => 'chat', 'campaign' => null],
            'marketingOptIn' => false,
            'trackingConsent' => false,
        ];
        if ($lead['name'] === '' || $lead['email'] === '') {
            return false;
        }
        apex_insert_lead($lead, [
            'ipAddress' => apex_client_ip(),
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        ]);
        return true;
    } catch (\Throwable $e) {
        return false;
    }
}

/**
 * The sales-agent state machine. Returns null when there's nothing for it
 * to do (idle, no booking intent detected) — apex_ai_respond() then falls
 * through to the normal Q&A path. Otherwise returns a full response array,
 * already carrying the next leadState for the client to echo back.
 */
function apex_ai_handle_lead_flow(string $trimmed, string $normalizedQuery, string $lang, array $leadState, array $kb, ?string $lastTopicId): ?array
{
    $textLang = apex_ai_text_lang($lang);
    $step = $leadState['step'];
    $data = $leadState['data'];

    if ($step === 'idle') {
        if (apex_ai_lead_booking_intent($normalizedQuery)) {
            return apex_ai_lead_response($textLang, 'ask_name', [], [], [
                'step' => 'awaiting_name', 'data' => [], 'offered' => true,
            ]);
        }
        // Declining the earlier soft offer ("Not yet, more questions") isn't
        // itself a real question — answering it through the normal KB
        // scorer would just produce an irrelevant clarify prompt. A short
        // acknowledgement and handing back to normal Q&A reads far better.
        if ($leadState['offered'] && apex_ai_lead_is_decline_offer($normalizedQuery)) {
            return apex_ai_lead_response($textLang, 'declined_offer', [], [], $leadState);
        }
        return null;
    }

    // A clear, unambiguous cancel wins at any step.
    if (apex_ai_lead_is_cancel($normalizedQuery)) {
        return apex_ai_lead_response($textLang, 'cancelled', [], [], [
            'step' => 'idle', 'data' => [], 'offered' => $leadState['offered'],
        ]);
    }

    // An interruption: the visitor asked a real question instead of
    // answering the pending step. Answer it normally, but keep the lead
    // flow's state frozen so it resumes right where it left off — rather
    // than either ignoring the question or silently abandoning the booking.
    //
    // Requires the message to actually *look* like a question (a "?", or
    // starting with an interrogative word) on top of a confident KB score —
    // score alone isn't enough, since an ordinary short answer can
    // accidentally contain a rare corpus word (a name like "Test" collides
    // with the "pull test" glossary entry) without being a question at all.
    if (in_array($step, ['awaiting_name', 'awaiting_email', 'awaiting_phone'], true)
        && apex_ai_looks_like_question($trimmed)) {
        $tokens = array_diff(apex_ai_tokens($trimmed), APEX_AI_STOPWORDS);
        $tokens = apex_ai_expand_synonyms($tokens, $textLang);
        $queryTokenCounts = array_count_values($tokens);
        $bestScore = 0.0;
        foreach ($kb as $entry) {
            $bestScore = max($bestScore, apex_ai_score_entry($entry, $normalizedQuery, $queryTokenCounts));
        }
        if ($bestScore >= 6.0) {
            $answer = apex_ai_respond($trimmed, $lang, $lastTopicId);
            $resumeKey = $step === 'awaiting_name' ? 'ask_name' : ($step === 'awaiting_email' ? 'ask_email' : 'ask_phone');
            $answer['reply'] .= "\n\n" . apex_ai_lead_copy('resume_prefix', $textLang) . apex_ai_lead_copy($resumeKey, $textLang, ['name' => $data['name'] ?? '']);
            $answer['leadState'] = $leadState;
            return $answer;
        }
    }

    switch ($step) {
        case 'awaiting_name':
            $name = trim($trimmed);
            if (mb_strlen($name) < 2 || mb_strlen($name) > 80 || str_contains($name, '@')) {
                return apex_ai_lead_response($textLang, 'name_retry', [], [], $leadState);
            }
            $data['name'] = $name;
            return apex_ai_lead_response($textLang, 'ask_email', ['name' => $name], [], [
                'step' => 'awaiting_email', 'data' => $data, 'offered' => true,
            ]);

        case 'awaiting_email':
            $email = apex_ai_lead_extract_email($trimmed);
            if ($email === null) {
                if (apex_ai_lead_is_skip($normalizedQuery)) {
                    return apex_ai_lead_response($textLang, 'email_required', [], [], $leadState);
                }
                return apex_ai_lead_response($textLang, 'email_retry', [], [], $leadState);
            }
            $data['email'] = $email;
            return apex_ai_lead_response($textLang, 'ask_phone', [], [], [
                'step' => 'awaiting_phone', 'data' => $data, 'offered' => true,
            ]);

        case 'awaiting_phone':
            if (!apex_ai_lead_is_skip($normalizedQuery)) {
                $data['phone'] = trim($trimmed);
            }
            return apex_ai_lead_response($textLang, 'ask_timing', [], apex_ai_lead_timing_labels($textLang), [
                'step' => 'awaiting_timing', 'data' => $data, 'offered' => true,
            ]);

        case 'awaiting_timing':
            $timing = apex_ai_lead_match_timing($normalizedQuery);
            if ($timing !== null) {
                $data['timing'] = $timing;
            }
            $next = ['step' => 'awaiting_confirm', 'data' => $data, 'offered' => true];
            return apex_ai_lead_response($textLang, 'confirm', [
                'name' => $data['name'] ?? '',
                'email' => $data['email'] ?? '',
                'phone' => $data['phone'] ?? '—',
                'timing' => $timing !== null ? apex_ai_lead_timing_labels($textLang)[array_search($timing, APEX_AI_LEAD_TIMING_VALUES, true)] : '—',
            ], apex_ai_lead_confirm_quick_replies($textLang), $next);

        case 'awaiting_confirm':
            if (apex_ai_lead_is_affirmative($normalizedQuery)) {
                $ok = apex_ai_submit_lead($data, $lang, $kb, $lastTopicId);
                $freshState = ['step' => 'idle', 'data' => [], 'offered' => true];
                if ($ok) {
                    return apex_ai_lead_response($textLang, 'submitted', [
                        'name' => $data['name'] ?? '', 'email' => $data['email'] ?? '',
                    ], [], $freshState);
                }
                return apex_ai_lead_response($textLang, 'submit_failed', [], [], $freshState);
            }
            // Here, unlike the phone step, a bare "no"/"nein" is unambiguous
            // (there's no field left to skip) so it's treated as a decline.
            if (apex_ai_lead_is_cancel($normalizedQuery) || $normalizedQuery === 'no' || $normalizedQuery === 'nein') {
                return apex_ai_lead_response($textLang, 'cancelled', [], [], [
                    'step' => 'idle', 'data' => [], 'offered' => $leadState['offered'],
                ]);
            }
            return apex_ai_lead_response($textLang, 'confirm_retry', [], apex_ai_lead_confirm_quick_replies($textLang), $leadState);

        default:
            return null;
    }
}

/**
 * Entry point api/index.php calls instead of apex_ai_respond() directly.
 * Keeps every sales-specific concern (booking-intent detection, the
 * multi-step capture, the proactive consultation offer) out of
 * apex-ai.php's own Q&A engine entirely — that file never needs to know
 * this layer exists. Normal questions pass straight through untouched.
 */
function apex_ai_sales_respond(string $message, string $lang, ?string $lastTopicId, $leadStateRaw): array
{
    $leadState = apex_ai_normalize_lead_state($leadStateRaw);
    $trimmed = trim($message);
    $normalizedQuery = apex_ai_normalize($trimmed);
    $kb = apex_ai_knowledge_base();

    $handled = apex_ai_handle_lead_flow($trimmed, $normalizedQuery, $lang, $leadState, $kb, $lastTopicId);
    if ($handled !== null) {
        return $handled;
    }

    $result = apex_ai_respond($message, $lang, $lastTopicId);
    $textLang = apex_ai_text_lang($lang);

    if (!$leadState['offered'] && in_array($result['topicId'], APEX_AI_LEAD_OFFER_TOPICS, true)) {
        $result['reply'] .= "\n\n" . apex_ai_lead_copy('offer', $textLang);
        $result['quickReplies'] = $textLang === 'de'
            ? ['Ja, bitte einplanen', 'Noch nicht, weitere Fragen']
            : ['Yes, book me in', 'Not yet, more questions'];
        $leadState['offered'] = true;
    }

    $result['leadState'] = $leadState;
    return $result;
}
