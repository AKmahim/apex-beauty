<?php

declare(strict_types=1);

// Resolves which language a request is for from the URL itself (/en/... vs
// everything else = de), and server-renders that language into the page
// before it's sent. Every translatable element in the page templates already
// carries data-de/data-en/... attributes (used by the client-side applyLang()
// JS to swap visible text after the page loads) but the text actually baked
// between the tags was always German — crawlers that don't execute
// JavaScript (GPTBot, ClaudeBot, PerplexityBot, and non-JS-rendering indexers
// generally) only ever saw German regardless of the language a visitor
// picked. This makes /en/* a real, independently crawlable English surface
// without needing a second copy of every template.

function apex_resolve_lang(): string
{
    static $lang = null;
    if ($lang !== null) {
        return $lang;
    }
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
    $lang = preg_match('#^/en(/|$)#', $path) === 1 ? 'en' : 'de';
    return $lang;
}

function apex_current_lang(): string
{
    return apex_resolve_lang();
}

function apex_lang_base(?string $lang = null): string
{
    $lang = $lang ?? apex_resolve_lang();
    return $lang === 'en' ? '/en' : '';
}

// Rewrites the body of any element carrying a data-{lang} attribute, mirroring
// what the client-side applyLang() does with el.innerHTML.
//
// The inner match deliberately allows nested markup of *other* tags — plenty of
// translatable strings wrap a link or a styling <span> (the GDPR consent label
// and several headings do) and an earlier leaf-only version skipped every one
// of them, leaving German text in the server-rendered English pages for any
// crawler that does not run JavaScript. What it still refuses is a nested
// element of the *same* tag name, where the first closing tag would not be our
// own and rewriting would strand a stray closer.
function apex_localize_output(string $html, string $lang): string
{
    if ($lang === 'de') {
        return $html;
    }

    $lang = preg_quote($lang, '/');
    // One HTML attribute: name, optionally = "value" / 'value'.
    $attr = '\s+[a-zA-Z_:][a-zA-Z0-9_:.-]*(?:=(?:"[^"]*"|\'[^\']*\'))?';
    // The opening tag must itself carry data-{lang}. Matching *only* those
    // elements is what keeps this single pass correct: an untranslated wrapper
    // would otherwise match first and swallow the translatable elements nested
    // inside it, so they would never get a match of their own.
    $pattern = '/<([a-zA-Z][a-zA-Z0-9]*)((?:' . $attr . ')*?\s+data-' . $lang . '="[^"]*"(?:' . $attr . ')*)\s*>'
        . '((?:(?!<\/?\1[\s>\/])[\s\S])*)<\/\1\s*>/';
    $attrPattern = '/\bdata-' . $lang . '="([^"]*)"/';

    $result = preg_replace_callback($pattern, static function (array $m) use ($attrPattern): string {
        if (!preg_match($attrPattern, $m[2], $am)) {
            return $m[0];
        }
        // The client-side applyLang() does el.innerHTML = el.getAttribute(...),
        // and getAttribute hands back the *decoded* value — so a translation
        // authored as "Hair Transplantation &lt;span&gt;at Apex Beauty&lt;/span&gt;"
        // becomes real markup there. Copying the raw attribute text through
        // instead emitted the escaped entities as visible content, so the
        // server-rendered heading literally read "<span>at Apex Beauty</span>"
        // until JS repainted it — which is exactly what a non-JS crawler ends
        // up indexing. Decoding here keeps SSR and applyLang byte-identical.
        return '<' . $m[1] . $m[2] . '>' . htmlspecialchars_decode($am[1], ENT_QUOTES) . '</' . $m[1] . '>';
    }, $html);

    return $result ?? $html;
}
