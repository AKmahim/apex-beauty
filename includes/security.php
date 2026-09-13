<?php

declare(strict_types=1);

// Site-wide hardening. Everything here is called from bootstrap.php, so it
// applies to every page and every API route without each template having to
// remember it.
//
// Three jobs:
//   1. Response headers (CSP, framing, sniffing, referrer, HSTS).
//   2. Upload validation - the admin media endpoints accept a file from the
//      browser and write it under the document root, so what is allowed
//      through here is the difference between an image library and a way to
//      run arbitrary PHP on the server.
//   3. Request-origin checks and a shared, lock-safe rate limiter.

// Only these ever get written into a web-served directory. No SVG: it is an
// XML document that can carry <script>, so an "image" upload would become
// stored XSS the moment someone opened it directly.
const APEX_UPLOAD_IMAGE_TYPES = [
    'jpg' => ['image/jpeg'],
    'jpeg' => ['image/jpeg'],
    'png' => ['image/png'],
    'gif' => ['image/gif'],
    'webp' => ['image/webp'],
    'avif' => ['image/avif'],
];

const APEX_UPLOAD_VIDEO_TYPES = [
    'mp4' => ['video/mp4'],
    'webm' => ['video/webm'],
    'mov' => ['video/quicktime'],
];

const APEX_UPLOAD_MAX_IMAGE_BYTES = 12582912;  // 12 MB
const APEX_UPLOAD_MAX_VIDEO_BYTES = 33554432;  // 32 MB

// PHP rejects an oversized upload in the SAPI, before a line of this code
// runs, so a limit here that is larger than the server's is a promise the
// application cannot keep: the editor picks a photo, PHP discards it, and the
// handler sees no file at all. Both limits are therefore clamped to whatever
// the server actually allows, and the message the editor gets names the real
// number rather than the aspirational one.
function apex_upload_ini_bytes(string $directive): int
{
    $raw = trim((string) ini_get($directive));
    if ($raw === '') {
        return PHP_INT_MAX;
    }
    $unit = strtolower(substr($raw, -1));
    $value = (int) $raw;
    return match ($unit) {
        'g' => $value * 1024 * 1024 * 1024,
        'm' => $value * 1024 * 1024,
        'k' => $value * 1024,
        default => $value,
    };
}

function apex_upload_limit(string $kind = 'image'): int
{
    $configured = $kind === 'video' ? APEX_UPLOAD_MAX_VIDEO_BYTES : APEX_UPLOAD_MAX_IMAGE_BYTES;
    return min(
        $configured,
        apex_upload_ini_bytes('upload_max_filesize'),
        apex_upload_ini_bytes('post_max_size')
    );
}

function apex_format_bytes(int $bytes): string
{
    if ($bytes >= 1048576) {
        return round($bytes / 1048576, 1) . ' MB';
    }
    return max(1, (int) round($bytes / 1024)) . ' KB';
}

/**
 * Turns a failed upload into a sentence an editor can act on.
 *
 * Returns null when the upload arrived intact. Before this, every one of
 * these cases produced "No file uploaded." - including the common one where
 * the file was fine and simply larger than the server accepts, which left the
 * editor retrying the same photo.
 */
function apex_upload_error(?array $file): ?string
{
    // When the request body exceeds post_max_size, PHP discards $_POST and
    // $_FILES entirely, so there is no error code to read - only the fact
    // that a POST arrived with a Content-Length and nothing survived it.
    if ($file === null || !isset($file['error'])) {
        $length = (int) ($_SERVER['CONTENT_LENGTH'] ?? 0);
        $postMax = apex_upload_ini_bytes('post_max_size');
        if ($length > 0 && $length > $postMax) {
            return 'That file is too large for this server (limit ' . apex_format_bytes($postMax) . ').';
        }
        return 'No file uploaded.';
    }

    return match ((int) $file['error']) {
        UPLOAD_ERR_OK => null,
        UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE =>
            'That file is too large (limit ' . apex_format_bytes(apex_upload_limit('image')) . ' for images, '
            . apex_format_bytes(apex_upload_limit('video')) . ' for video).',
        UPLOAD_ERR_PARTIAL => 'The upload was interrupted. Please try again.',
        UPLOAD_ERR_NO_FILE => 'No file was chosen.',
        UPLOAD_ERR_NO_TMP_DIR, UPLOAD_ERR_CANT_WRITE =>
            'The server could not save the file. Please tell whoever maintains the site.',
        UPLOAD_ERR_EXTENSION => 'The upload was blocked by the server configuration.',
        default => 'The upload failed.',
    };
}

// Appends the file's modification time to an asset URL, so a deploy that
// changes a script or stylesheet changes its URL too. Without this the shared
// files were fetched unversioned and a returning visitor kept the copy their
// browser had cached - which is how a fixed bug stays visible in the wild.
// Derived from mtime rather than a hand-bumped constant because a constant
// only works when somebody remembers to bump it.
function apex_asset(string $path): string
{
    $path = '/' . ltrim($path, '/');
    $file = APEX_ROOT . $path;
    $stamp = is_file($file) ? filemtime($file) : false;
    return $stamp === false ? $path : $path . '?v=' . $stamp;
}

// A fresh random nonce per response. Inline <script> blocks carry it; the CSP
// names it; anything injected into the page by an attacker cannot guess it.
// Memoised so every block in one response shares the value the header names.
function apex_csp_nonce(): string
{
    static $nonce = null;
    if ($nonce === null) {
        $nonce = base64_encode(random_bytes(16));
    }
    return $nonce;
}

// True only when APEX_DEV is explicitly set. Nothing infers this from the
// request: a development flag that turns itself on is a production hole.
function apex_is_dev(): bool
{
    return in_array(strtolower((string) (apex_env('APEX_DEV', '') ?? '')), ['1', 'true', 'on', 'yes'], true);
}

function apex_is_https(): bool
{
    if (($_SERVER['HTTPS'] ?? '') !== '' && strtolower((string) $_SERVER['HTTPS']) !== 'off') {
        return true;
    }
    // Behind a reverse proxy or load balancer the TLS terminates upstream and
    // only this header records that it happened.
    if (strtolower((string) ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '')) === 'https') {
        return true;
    }
    return (int) ($_SERVER['SERVER_PORT'] ?? 0) === 443;
}

function apex_request_host(): string
{
    return strtolower((string) ($_SERVER['HTTP_HOST'] ?? ''));
}

// Origins allowed to call the public endpoints (lead capture, chat) from a
// browser. Overridable because the marketing team has, in the past, embedded
// the consultation form on a landing page hosted elsewhere.
function apex_allowed_origins(): array
{
    $configured = apex_env('APEX_ALLOWED_ORIGINS', '') ?? '';
    $origins = array_filter(array_map('trim', explode(',', $configured)));
    if (!$origins) {
        $origins = [
            'https://apexbeauty.at',
            'https://www.apexbeauty.at',
            'https://my.apexbeauty.at',
        ];
    }
    $host = apex_request_host();
    if ($host !== '') {
        $origins[] = (apex_is_https() ? 'https://' : 'http://') . $host;
    }
    return array_values(array_unique($origins));
}

// The Content-Security-Policy. Inline <script> and <style> are everywhere in
// these templates, so 'unsafe-inline' has to stay until they are moved out to
// files with nonces; the policy still shuts off the things that matter most
// for a clinic site - no plugins, no injected <base>, no posting a stolen
// form somewhere else, no framing by a third party.
function apex_csp(): string
{
    $directives = [
        "default-src 'self'",
        // No 'unsafe-inline': every inline block on the site carries the
        // nonce above, and the 140 inline event-handler attributes that used
        // to make this impossible are now data-click/data-change attributes
        // dispatched from assets/apex-actions.js.
        //
        // 'strict-dynamic' is deliberately not used. It would ignore the host
        // list below, and while Google Tag Manager is loaded at all it can
        // fetch whatever it likes anyway - the extra directive would buy
        // nothing and cost the ability to serve plain <script src> tags.
        // Order matters for backwards compatibility: a CSP3 browser honours
        // the nonce and 'strict-dynamic' and ignores 'self' and the host list;
        // a CSP2 browser ignores 'strict-dynamic' and falls back to them.
        //
        // 'strict-dynamic' is here because Google Tag Manager injects inline
        // tags of its own, which cannot carry a nonce. It lets the nonced GTM
        // loader pass its trust to what it creates, so the marketing tags keep
        // working without 'unsafe-inline' re-opening the page to injected
        // script. The cost is that every <script src> in the markup needs the
        // nonce too, since the host list is then ignored.
        "script-src 'nonce-" . apex_csp_nonce() . "' 'strict-dynamic' 'self' https://www.googletagmanager.com https://connect.facebook.net https://www.google-analytics.com",
        // No 'unsafe-inline' here either. The 46 style="" attributes that
        // made it necessary are now classes in assets/apex-utilities.css, the
        // <style> blocks carry the nonce, and the one stylesheet built in JS
        // (the consent banner) reads the nonce off its own script tag.
        // Injected CSS is not script, but it can still read a form's contents
        // out of a page one attribute selector at a time.
        "style-src 'self' 'nonce-" . apex_csp_nonce() . "'",
        "font-src 'self'",
        "img-src 'self' data: blob: https://www.googletagmanager.com https://www.facebook.com https://www.google.com https://www.google.at https://www.google-analytics.com",
        "media-src 'self' data: blob:",
        "connect-src 'self' https://www.google-analytics.com https://analytics.google.com https://region1.google-analytics.com https://stats.g.doubleclick.net https://www.facebook.com https://graph.facebook.com https://www.googletagmanager.com",
        "frame-src 'self' https://www.googletagmanager.com https://www.facebook.com https://www.google.com https://www.youtube.com https://www.youtube-nocookie.com",
        "worker-src 'self' blob:",
        "object-src 'none'",
        "base-uri 'self'",
        "form-action 'self'",
        "frame-ancestors 'none'",
    ];
    if (apex_is_https()) {
        $directives[] = 'upgrade-insecure-requests';
    }
    return implode('; ', $directives);
}

// PHP's default of printing warnings into the response body leaks absolute
// paths, database hostnames and stack traces to whoever triggered the error -
// and on an API route it also corrupts the JSON. Errors belong in the server
// log, where the host can read them and a visitor cannot.
function apex_error_reporting(): void
{
    $debug = strtolower((string) (apex_env('APEX_DEBUG', '') ?? ''));
    $isDebug = in_array($debug, ['1', 'true', 'on', 'yes'], true);

    ini_set('display_errors', $isDebug ? '1' : '0');
    ini_set('display_startup_errors', $isDebug ? '1' : '0');
    ini_set('log_errors', '1');
    error_reporting($isDebug ? E_ALL : E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    // Session ids and CSRF-relevant values must never end up in a URL, and a
    // URL ends up in access logs, Referer headers and analytics.
    ini_set('session.use_trans_sid', '0');
}

// Suppressing error output (above) stops PHP printing a stack trace into the
// response, but on its own it replaces that with an empty body - and an empty
// body is not valid JSON, so the admin panel reported "Unexpected end of JSON
// input" instead of "something went wrong". These handlers make a failure
// answer in the shape the caller expects: JSON for /api, the branded error
// page for everything else. The detail still goes to the server log, where
// only the host can read it.
function apex_is_api_request(): bool
{
    return str_starts_with(apex_request_path(), '/api');
}

function apex_fail(string $logLine): void
{
    error_log('apex: ' . $logLine);

    if (headers_sent()) {
        return;
    }
    http_response_code(500);

    if (apex_is_api_request()) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['error' => 'Something went wrong on the server. Please try again.']);
        return;
    }

    header('Content-Type: text/html; charset=utf-8');
    echo '<!doctype html><meta charset="utf-8"><title>Apex Beauty</title>'
        . '<div style="font:16px/1.6 -apple-system,BlinkMacSystemFont,Segoe UI,sans-serif;'
        . 'max-width:36rem;margin:18vh auto;padding:0 1.5rem;color:#0f2027">'
        . '<h1 style="font-weight:300">Es ist ein Fehler aufgetreten.</h1>'
        . '<p>Bitte versuchen Sie es in einem Moment erneut. '
        . '<a href="/" style="color:#1d4ed8">Zur Startseite</a></p></div>';
}

function apex_install_error_handlers(): void
{
    static $installed = false;
    if ($installed) {
        return;
    }
    $installed = true;

    set_exception_handler(static function (Throwable $e): void {
        apex_fail(get_class($e) . ': ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
    });

    register_shutdown_function(static function (): void {
        $error = error_get_last();
        if ($error === null || !in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
            return;
        }
        apex_fail('fatal: ' . $error['message'] . ' in ' . $error['file'] . ':' . $error['line']);
    });
}

function apex_security_headers(): void
{
    if (headers_sent()) {
        return;
    }

    header('X-Content-Type-Options: nosniff');
    // DENY rather than SAMEORIGIN: nothing on this site frames itself, so
    // there is no reason to permit it.
    header('X-Frame-Options: DENY');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Cross-Origin-Opener-Policy: same-origin-allow-popups');
    header('Permissions-Policy: geolocation=(), microphone=(), camera=(), payment=(), usb=(), magnetometer=(), accelerometer=()');
    header_remove('X-Powered-By');

    // A GTM container can load tags nobody here wrote, so the policy has an
    // escape hatch: APEX_CSP_MODE=report logs violations without blocking
    // (read them in the browser console), off disables it entirely.
    $mode = strtolower(apex_env('APEX_CSP_MODE', 'enforce') ?? 'enforce');
    if ($mode === 'report') {
        header('Content-Security-Policy-Report-Only: ' . apex_csp());
    } elseif ($mode !== 'off') {
        header('Content-Security-Policy: ' . apex_csp());
    }

    if (apex_is_https()) {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
}

// Admin responses must never sit in a shared cache or a browser's back-button
// cache: a leads table is patient data.
function apex_no_store(): void
{
    if (headers_sent()) {
        return;
    }
    header('Cache-Control: no-store, no-cache, must-revalidate, private');
    header('Pragma: no-cache');
}

// Cross-site request forgery. The session cookie is SameSite=Strict, which
// already stops a cookie riding along on a cross-site request in a current
// browser; this is the second lock, for old browsers and for anything that
// manages to be same-site but not same-origin (a compromised subdomain).
function apex_require_same_origin(): void
{
    $method = apex_request_method();
    if (in_array($method, ['GET', 'HEAD', 'OPTIONS'], true)) {
        return;
    }

    $fetchSite = $_SERVER['HTTP_SEC_FETCH_SITE'] ?? null;
    if (is_string($fetchSite)) {
        if (in_array($fetchSite, ['same-origin', 'none'], true)) {
            return;
        }
        apex_json_response(['error' => 'Cross-site request rejected.'], 403);
    }

    // Older browser with no Sec-Fetch-Site: fall back to Origin/Referer.
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
    if ($origin === '' && isset($_SERVER['HTTP_REFERER'])) {
        $parsed = parse_url((string) $_SERVER['HTTP_REFERER']);
        if (isset($parsed['scheme'], $parsed['host'])) {
            $origin = $parsed['scheme'] . '://' . $parsed['host'] . (isset($parsed['port']) ? ':' . $parsed['port'] : '');
        }
    }
    if ($origin === '') {
        apex_json_response(['error' => 'Cross-site request rejected.'], 403);
    }

    $host = apex_request_host();
    $expected = [
        'https://' . $host,
        'http://' . $host,
    ];
    if (!in_array(strtolower($origin), $expected, true)) {
        apex_json_response(['error' => 'Cross-site request rejected.'], 403);
    }
}

// ---- Uploads --------------------------------------------------------------

function apex_upload_detect_mime(string $path): string
{
    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if ($finfo !== false) {
            $mime = finfo_file($finfo, $path);
            finfo_close($finfo);
            if (is_string($mime) && $mime !== '') {
                return strtolower($mime);
            }
        }
    }
    if (function_exists('mime_content_type')) {
        $mime = mime_content_type($path);
        if (is_string($mime) && $mime !== '') {
            return strtolower($mime);
        }
    }
    return '';
}

/**
 * Decides whether an uploaded file may be written into a web-served directory,
 * and returns the extension it is allowed to keep.
 *
 * Three independent checks, because any one of them alone has a known bypass:
 * the extension must be on the allowlist, the sniffed MIME type must be the
 * one that extension implies, and an image must additionally parse as an
 * image. A PHP script renamed to .jpg fails the second; a real JPEG with PHP
 * appended to it fails nothing here but also cannot execute, because the
 * extension it keeps is .jpg and upload directories have execution disabled.
 *
 * @param string $kind 'image', 'video' or 'any'
 */
function apex_upload_safe_extension(string $tmpPath, string $originalName, string $kind = 'image'): ?string
{
    if (!is_file($tmpPath)) {
        return null;
    }

    $allowed = match ($kind) {
        'video' => APEX_UPLOAD_VIDEO_TYPES,
        'any' => APEX_UPLOAD_IMAGE_TYPES + APEX_UPLOAD_VIDEO_TYPES,
        default => APEX_UPLOAD_IMAGE_TYPES,
    };

    $ext = strtolower((string) preg_replace('/[^a-z0-9]/i', '', pathinfo($originalName, PATHINFO_EXTENSION)));
    if ($ext === '' || !isset($allowed[$ext])) {
        return null;
    }

    $isVideo = isset(APEX_UPLOAD_VIDEO_TYPES[$ext]);
    $maxBytes = apex_upload_limit($isVideo ? 'video' : 'image');
    $size = filesize($tmpPath);
    if ($size === false || $size <= 0 || $size > $maxBytes) {
        return null;
    }

    $mime = apex_upload_detect_mime($tmpPath);
    if ($mime !== '' && !in_array($mime, $allowed[$ext], true)) {
        return null;
    }

    if (!$isVideo) {
        // AVIF predates getimagesize() support in some builds, so a missing
        // answer there is only fatal when the format is one it does know.
        $info = @getimagesize($tmpPath);
        if ($info === false && $ext !== 'avif') {
            return null;
        }
    }

    return $ext;
}

// Turns any string into something safe to put in a filename.
function apex_upload_safe_segment(string $value, int $max = 40): string
{
    $value = strtolower((string) preg_replace('/[^A-Za-z0-9]+/', '-', $value));
    $value = trim($value, '-');
    return $value === '' ? 'x' : substr($value, 0, $max);
}

// ---- Rate limiting --------------------------------------------------------

/**
 * Counts hits per key in a window, under an exclusive lock so two requests
 * arriving together cannot both read the old count and both write count+1 -
 * which is how a file-based limiter normally gets walked straight through.
 *
 * @return bool true when the caller is over the limit and should be refused
 */
function apex_rate_limited(string $bucket, string $key, int $max, int $windowSeconds): bool
{
    $path = APEX_DATA_DIR . '/rate-' . preg_replace('/[^a-z0-9-]/i', '', $bucket) . '.json';
    $fh = @fopen($path, 'c+');
    if ($fh === false) {
        return false; // fail open rather than lock out real visitors over a disk problem
    }
    if (!flock($fh, LOCK_EX)) {
        fclose($fh);
        return false;
    }

    $hits = json_decode((string) stream_get_contents($fh), true);
    $hits = is_array($hits) ? $hits : [];
    $now = time();
    $entry = $hits[$key] ?? null;
    $limited = false;

    if (is_array($entry) && ($now - (int) ($entry['windowStart'] ?? 0)) <= $windowSeconds) {
        if ((int) ($entry['count'] ?? 0) >= $max) {
            $limited = true;
        } else {
            $hits[$key]['count'] = (int) $entry['count'] + 1;
        }
    } else {
        $hits[$key] = ['count' => 1, 'windowStart' => $now];
    }

    // Drop long-expired keys so the file cannot grow without bound.
    foreach ($hits as $k => $v) {
        if (($now - (int) ($v['windowStart'] ?? 0)) > $windowSeconds * 6) {
            unset($hits[$k]);
        }
    }

    ftruncate($fh, 0);
    rewind($fh);
    fwrite($fh, (string) json_encode($hits));
    fflush($fh);
    flock($fh, LOCK_UN);
    fclose($fh);

    return $limited;
}

// ---- Stored markup --------------------------------------------------------

// Content fields and blog bodies are stored as HTML fragments and printed
// raw, because a headline legitimately contains <span> and a paragraph
// contains <a> or <strong>. That means the panel can write markup straight
// into every visitor's page, so whatever it writes has to be narrowed to
// formatting before it gets there.
//
// A blocklist rather than a tag allowlist, deliberately: the existing 700-odd
// fields and fifteen articles already contain a wide range of valid markup,
// and an allowlist tight enough to be worth having would silently delete some
// of it. What is removed here is the set of things that can execute - script
// and frame elements, event-handler attributes, and javascript: URLs - none
// of which appears anywhere in the current content.
// What formatting is allowed to survive. Anything not named here is removed;
// the element's text is kept, so a stripped <div> loses its box but not its
// words. Derived from what the 711 content fields and fifteen articles
// actually contain, plus the tags a rich-text editor produces.
const APEX_HTML_ALLOWED = [
    'a' => ['href', 'title', 'target', 'rel', 'class', 'id', 'download'],
    'span' => ['class'],
    'strong' => [], 'b' => [], 'em' => [], 'i' => [], 'u' => [], 'mark' => [],
    'small' => [], 'sup' => [], 'sub' => [], 's' => [], 'del' => [], 'ins' => [],
    'br' => [], 'hr' => [],
    'p' => ['class'], 'div' => ['class'],
    'h1' => ['class'], 'h2' => ['class'], 'h3' => ['class'], 'h4' => ['class'],
    'h5' => ['class'], 'h6' => ['class'],
    'ul' => ['class'], 'ol' => ['class'], 'li' => ['class'],
    'blockquote' => ['class'], 'cite' => [], 'q' => [],
    'figure' => ['class'], 'figcaption' => ['class'],
    'img' => ['src', 'alt', 'title', 'width', 'height', 'loading', 'class'],
    'picture' => [], 'source' => ['src', 'srcset', 'type', 'media'],
    'table' => ['class'], 'thead' => [], 'tbody' => [], 'tfoot' => [],
    'tr' => ['class'], 'td' => ['class', 'colspan', 'rowspan'],
    'th' => ['class', 'colspan', 'rowspan', 'scope'],
    'abbr' => ['title'], 'time' => ['datetime'], 'code' => [], 'pre' => [],
];

const APEX_HTML_URL_ATTRS = ['href', 'src', 'srcset'];

// Elements whose contents are discarded along with the tag, rather than kept
// as text - printing the body of a <script> as visible text would be absurd.
const APEX_HTML_DROP_CONTENT = [
    'script', 'style', 'iframe', 'object', 'embed', 'applet', 'frame',
    'frameset', 'noscript', 'template', 'svg', 'math', 'canvas', 'audio',
    'video', 'form', 'input', 'button', 'select', 'textarea', 'option',
];

/**
 * Sanitises a stored HTML fragment by parsing it and rebuilding it from an
 * allowlist.
 *
 * This replaces an earlier regex-based version. Regex cannot sanitise HTML
 * safely: a browser's parser recovers from malformed markup in ways a pattern
 * does not model, which is the whole mXSS family - markup that looks inert to
 * a matcher and becomes a script once the browser has finished fixing it up.
 * Parsing the fragment the way a browser would, discarding every element and
 * attribute not explicitly permitted, and re-serialising from the resulting
 * tree removes that class of bypass rather than enumerating it.
 */
function apex_sanitize_html(string $html): string
{
    if ($html === '' || !str_contains($html, '<')) {
        // No markup at all: the overwhelming majority of the 700-odd content
        // fields. Nothing to parse, and nothing a parser could change.
        return str_contains($html, '&') ? $html : $html;
    }

    static $cache = [];
    $key = md5($html);
    if (isset($cache[$key])) {
        return $cache[$key];
    }

    $previous = libxml_use_internal_errors(true);
    $doc = new DOMDocument('1.0', 'UTF-8');
    // The wrapper gives libxml a document to hang the fragment on without it
    // inventing <html><body> around the result; the XML declaration keeps it
    // from guessing Latin-1 for German and Turkish text.
    $loaded = $doc->loadHTML(
        '<?xml encoding="UTF-8"?><div id="apex-sanitize-root">' . $html . '</div>',
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NONET
    );
    libxml_clear_errors();
    libxml_use_internal_errors($previous);

    if (!$loaded) {
        // Unparseable: return it as text rather than as markup.
        return htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
    }

    $root = $doc->getElementById('apex-sanitize-root');
    if (!$root instanceof DOMElement) {
        $root = $doc->documentElement;
    }
    if (!$root instanceof DOMElement) {
        return htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
    }

    apex_sanitize_node($root);

    $out = '';
    foreach (iterator_to_array($root->childNodes) as $child) {
        $out .= $doc->saveHTML($child);
    }

    // libxml decodes &nbsp; to the literal U+00A0 character. It renders
    // identically, but writing it back as the entity keeps the stored content
    // and the served HTML byte-for-byte what the editor typed.
    $out = str_replace("\xC2\xA0", '&nbsp;', $out);

    if (count($cache) > 2000) {
        $cache = [];
    }
    return $cache[$key] = $out;
}

// Depth-first cleanup of one element's children, in place.
function apex_sanitize_node(DOMElement $element): void
{
    foreach (iterator_to_array($element->childNodes) as $child) {
        if ($child instanceof DOMText) {
            continue;
        }
        if ($child instanceof DOMComment || $child instanceof DOMProcessingInstruction) {
            // A comment can carry a conditional-comment payload and is never
            // needed in stored content.
            $element->removeChild($child);
            continue;
        }
        if (!$child instanceof DOMElement) {
            $element->removeChild($child);
            continue;
        }

        $tag = strtolower($child->nodeName);

        if (in_array($tag, APEX_HTML_DROP_CONTENT, true)) {
            $element->removeChild($child);
            continue;
        }

        if (!isset(APEX_HTML_ALLOWED[$tag])) {
            // Not permitted, but not dangerous either: keep the words, drop
            // the tag, so a stray <section> does not delete a paragraph.
            apex_sanitize_node($child);
            while ($child->firstChild !== null) {
                $element->insertBefore($child->firstChild, $child);
            }
            $element->removeChild($child);
            continue;
        }

        apex_sanitize_attributes($child, $tag);
        apex_sanitize_node($child);
    }
}

function apex_sanitize_attributes(DOMElement $element, string $tag): void
{
    $allowed = APEX_HTML_ALLOWED[$tag] ?? [];

    foreach (iterator_to_array($element->attributes ?? []) as $attr) {
        $name = strtolower($attr->nodeName);

        // Covers every on* handler without having to list them, including
        // ones added to the platform after this was written.
        if (!in_array($name, $allowed, true)) {
            $element->removeAttribute($attr->nodeName);
            continue;
        }

        if (in_array($name, APEX_HTML_URL_ATTRS, true) && !apex_url_is_safe((string) $attr->nodeValue)) {
            $element->removeAttribute($attr->nodeName);
        }
    }

    // A link that opens a new tab gets noopener, so the opened page cannot
    // reach back through window.opener.
    if ($tag === 'a' && strtolower((string) $element->getAttribute('target')) === '_blank') {
        $element->setAttribute('rel', 'noopener noreferrer');
    }
}

// Only these schemes may appear in a URL attribute. Relative URLs are fine;
// javascript:, vbscript: and data: (other than images) are not.
function apex_url_is_safe(string $url): bool
{
    // Strip the whitespace and control characters a browser ignores when it
    // resolves a scheme, so "java\tscript:" is judged as "javascript:".
    $probe = strtolower((string) preg_replace('/[\s\x00-\x20]+/', '', $url));
    $probe = (string) preg_replace('/&#x?0*(?:9|a|d|10|13);?/i', '', $probe);

    if ($probe === '') {
        return false;
    }
    if (!preg_match('#^([a-z][a-z0-9+.\-]*):#', $probe, $m)) {
        return true; // relative URL, path or fragment
    }
    $scheme = $m[1];
    if ($scheme === 'data') {
        return str_starts_with($probe, 'data:image/')
            && !str_contains($probe, 'image/svg'); // SVG data URLs can carry script
    }
    return in_array($scheme, ['http', 'https', 'mailto', 'tel'], true);
}

// ---- CSV ------------------------------------------------------------------

// A lead whose name is "=HYPERLINK(...)" is stored harmlessly and exported
// harmlessly, and then Excel treats it as a formula the moment the clinic
// opens the file. Prefixing the cell keeps the text intact and stops the
// spreadsheet from evaluating it.
function apex_csv_cell($value): string
{
    $value = (string) ($value ?? '');
    if ($value !== '' && str_contains("=+-@\t\r", substr($value, 0, 1))) {
        return "'" . $value;
    }
    return $value;
}
