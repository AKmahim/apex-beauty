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

// Only matches leaf elements (opening tag ... text with no nested tags ...
// matching closing tag), which is the only shape this data-{lang} pattern is
// ever authored in across the templates. Anything else (nested markup) is
// silently left on its German fallback rather than risking corruption of the
// surrounding structure.
function apex_localize_output(string $html, string $lang): string
{
    if ($lang === 'de') {
        return $html;
    }

    $pattern = '/<([a-zA-Z][a-zA-Z0-9]*)((?:\s+[a-zA-Z_:][a-zA-Z0-9_:.-]*(?:=(?:"[^"]*"|\'[^\']*\'))?)*)\s*>([^<]*)<\/\1>/';
    $attrPattern = '/\bdata-' . preg_quote($lang, '/') . '="([^"]*)"/';

    $result = preg_replace_callback($pattern, static function (array $m) use ($attrPattern): string {
        if (!preg_match($attrPattern, $m[2], $am)) {
            return $m[0];
        }
        return '<' . $m[1] . $m[2] . '>' . $am[1] . '</' . $m[1] . '>';
    }, $html);

    return $result ?? $html;
}
