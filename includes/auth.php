<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/security.php';

const APEX_SESSION_COOKIE = 'apex_admin_session';
// Twelve hours was chosen for an editor working through a day of content.
// Idle sessions are cut at APEX_SESSION_IDLE_TTL regardless, so a panel left
// open on a laptop in a clinic waiting room does not stay usable overnight.
const APEX_SESSION_TTL = 43200;
const APEX_SESSION_IDLE_TTL = 3600;
const APEX_MAX_ATTEMPTS = 8;
const APEX_ATTEMPT_WINDOW = 600;

// Preferred: a bcrypt/argon hash in ADMIN_PASSWORD_HASH, so the plaintext
// password exists nowhere on the server. Generate one with:
//   php -r 'echo password_hash("your password", PASSWORD_DEFAULT), PHP_EOL;'
function apex_admin_password_hash(): ?string
{
    $hash = trim((string) (apex_env('ADMIN_PASSWORD_HASH', '') ?? ''));
    return $hash !== '' ? $hash : null;
}

function apex_admin_password(): ?string
{
    $password = (string) (apex_env('ADMIN_PASSWORD', '') ?? '');
    return $password !== '' ? $password : null;
}

// Verifies a submitted password in constant time. There is deliberately no
// default password: if the environment is missing or unreadable on the
// server, every login fails rather than silently falling back to a value that
// is printed in this repository and would open the panel to anyone who read it.
function apex_admin_password_matches(string $candidate): bool
{
    $hash = apex_admin_password_hash();
    if ($hash !== null) {
        return password_verify($candidate, $hash);
    }
    $plain = apex_admin_password();
    if ($plain === null) {
        return false;
    }
    return hash_equals($plain, $candidate);
}

function apex_admin_password_configured(): bool
{
    return apex_admin_password_hash() !== null || apex_admin_password() !== null;
}

function apex_session_start(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    // Strict mode makes PHP refuse a session id it did not issue, which is
    // what stops an attacker from planting one in the victim's browser first
    // and then using it after they log in.
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');

    session_name(APEX_SESSION_COOKIE);
    session_set_cookie_params([
        'lifetime' => APEX_SESSION_TTL,
        'path' => '/',
        // Secure unconditionally. This used to be apex_is_https(), which meant
        // the flag switched itself off for any plaintext request - a security
        // control decided by a value an attacker can influence by stripping
        // TLS at the edge. Local development over plain http:// now needs
        // APEX_DEV=1 set deliberately, rather than getting the weaker cookie
        // by accident.
        'secure' => !apex_is_dev(),
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

function apex_attempts_path(): string
{
    return APEX_DATA_DIR . '/login-attempts.json';
}

// Read-modify-write under an exclusive lock. The previous version read the
// file, decided, and wrote it back without locking, so requests arriving
// together each saw the same old count - a burst of parallel guesses was
// counted as roughly one attempt.
function apex_attempts_update(callable $mutate)
{
    $fh = @fopen(apex_attempts_path(), 'c+');
    if ($fh === false) {
        return null;
    }
    if (!flock($fh, LOCK_EX)) {
        fclose($fh);
        return null;
    }
    $attempts = json_decode((string) stream_get_contents($fh), true);
    $attempts = is_array($attempts) ? $attempts : [];

    $result = $mutate($attempts);

    ftruncate($fh, 0);
    rewind($fh);
    fwrite($fh, (string) json_encode($attempts));
    fflush($fh);
    flock($fh, LOCK_UN);
    fclose($fh);

    return $result;
}

function apex_is_rate_limited(string $ip): bool
{
    return (bool) apex_attempts_update(static function (array &$attempts) use ($ip): bool {
        $entry = $attempts[$ip] ?? null;
        if (!is_array($entry)) {
            return false;
        }
        if ((time() - (int) ($entry['windowStart'] ?? 0)) > APEX_ATTEMPT_WINDOW) {
            unset($attempts[$ip]);
            return false;
        }
        return (int) ($entry['count'] ?? 0) >= APEX_MAX_ATTEMPTS;
    });
}

function apex_record_failed_attempt(string $ip): void
{
    apex_attempts_update(static function (array &$attempts) use ($ip): void {
        $now = time();
        $entry = $attempts[$ip] ?? null;
        if (!is_array($entry) || ($now - (int) ($entry['windowStart'] ?? 0)) > APEX_ATTEMPT_WINDOW) {
            $attempts[$ip] = ['count' => 1, 'windowStart' => $now];
        } else {
            $attempts[$ip]['count'] = (int) ($entry['count'] ?? 0) + 1;
            $attempts[$ip]['windowStart'] = (int) ($entry['windowStart'] ?? $now);
        }
        // Housekeeping, so the file cannot grow one key per attacking IP forever.
        foreach ($attempts as $k => $v) {
            if (($now - (int) ($v['windowStart'] ?? 0)) > APEX_ATTEMPT_WINDOW * 24) {
                unset($attempts[$k]);
            }
        }
    });
}

function apex_clear_failed_attempts(string $ip): void
{
    apex_attempts_update(static function (array &$attempts) use ($ip): void {
        unset($attempts[$ip]);
    });
}

function apex_login(array $body): never
{
    apex_no_store();
    apex_require_same_origin();

    $ip = apex_client_ip();
    if (apex_is_rate_limited($ip)) {
        apex_json_response(['error' => 'Too many attempts. Try again later.'], 429);
    }

    if (!apex_admin_password_configured()) {
        // No credentials on this server. Refusing is the only safe answer;
        // the alternative is a known default that unlocks the leads database.
        error_log('apex: admin login attempted but neither ADMIN_PASSWORD nor ADMIN_PASSWORD_HASH is set');
        apex_json_response(['error' => 'Admin access is not configured on this server.'], 503);
    }

    $password = $body['password'] ?? null;
    if (!is_string($password) || $password === '' || !apex_admin_password_matches($password)) {
        apex_record_failed_attempt($ip);
        // Costs a wrong guess a second; costs a real editor nothing they notice.
        usleep(400000);
        apex_json_response(['error' => 'Incorrect password.'], 401);
    }

    apex_clear_failed_attempts($ip);
    apex_session_start();
    // A brand-new session id for the authenticated session, so any id fixed
    // in the browser before login is now worthless.
    session_regenerate_id(true);
    $_SESSION['authenticated'] = true;
    $_SESSION['expiresAt'] = time() + APEX_SESSION_TTL;
    $_SESSION['lastSeen'] = time();
    // Bound to the browser that logged in: a stolen cookie replayed from a
    // different client is rejected.
    $_SESSION['ua'] = hash('sha256', (string) ($_SERVER['HTTP_USER_AGENT'] ?? ''));

    apex_json_response(['ok' => true]);
}

function apex_logout(): never
{
    apex_session_start();
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $params['path'], $params['domain'] ?? '', (bool) ($params['secure'] ?? false), (bool) ($params['httponly'] ?? true));
    }
    session_destroy();
    apex_json_response(['ok' => true]);
}

function apex_require_auth(): void
{
    apex_no_store();
    apex_session_start();

    $now = time();
    $expiresAt = (int) ($_SESSION['expiresAt'] ?? 0);
    $lastSeen = (int) ($_SESSION['lastSeen'] ?? 0);
    $ua = hash('sha256', (string) ($_SERVER['HTTP_USER_AGENT'] ?? ''));

    $valid = !empty($_SESSION['authenticated'])
        && $expiresAt >= $now
        && ($lastSeen === 0 || ($now - $lastSeen) <= APEX_SESSION_IDLE_TTL)
        && (!isset($_SESSION['ua']) || hash_equals((string) $_SESSION['ua'], $ua));

    if (!$valid) {
        $_SESSION = [];
        session_destroy();
        apex_json_response(['error' => 'Not authenticated.'], 401);
    }

    // Every state-changing admin call has to come from this site's own pages.
    apex_require_same_origin();

    $_SESSION['expiresAt'] = $now + APEX_SESSION_TTL;
    $_SESSION['lastSeen'] = $now;
}
