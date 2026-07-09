<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

const APEX_SESSION_COOKIE = 'apex_admin_session';
const APEX_SESSION_TTL = 43200;
const APEX_MAX_ATTEMPTS = 8;
const APEX_ATTEMPT_WINDOW = 600;

function apex_admin_password(): string
{
    return apex_env('ADMIN_PASSWORD', 'apex-admin-dev-only') ?? 'apex-admin-dev-only';
}

function apex_session_start(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    session_name(APEX_SESSION_COOKIE);
    session_set_cookie_params([
        'lifetime' => APEX_SESSION_TTL,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function apex_attempts_path(): string
{
    return APEX_DATA_DIR . '/login-attempts.json';
}

function apex_read_attempts(): array
{
    $path = apex_attempts_path();
    if (!is_file($path)) {
        return [];
    }
    $data = json_decode((string) file_get_contents($path), true);
    return is_array($data) ? $data : [];
}

function apex_write_attempts(array $attempts): void
{
    file_put_contents($path = apex_attempts_path(), json_encode($attempts, JSON_PRETTY_PRINT));
}

function apex_is_rate_limited(string $ip): bool
{
    $attempts = apex_read_attempts();
    if (!isset($attempts[$ip])) {
        return false;
    }
    $entry = $attempts[$ip];
    if ((time() - (int) ($entry['windowStart'] ?? 0)) > APEX_ATTEMPT_WINDOW) {
        unset($attempts[$ip]);
        apex_write_attempts($attempts);
        return false;
    }
    return (int) ($entry['count'] ?? 0) >= APEX_MAX_ATTEMPTS;
}

function apex_record_failed_attempt(string $ip): void
{
    $attempts = apex_read_attempts();
    $now = time();
    $entry = $attempts[$ip] ?? null;

    if (!is_array($entry) || ($now - (int) ($entry['windowStart'] ?? 0)) > APEX_ATTEMPT_WINDOW) {
        $attempts[$ip] = ['count' => 1, 'windowStart' => $now];
    } else {
        $attempts[$ip]['count'] = (int) ($entry['count'] ?? 0) + 1;
        $attempts[$ip]['windowStart'] = (int) ($entry['windowStart'] ?? $now);
    }

    apex_write_attempts($attempts);
}

function apex_clear_failed_attempts(string $ip): void
{
    $attempts = apex_read_attempts();
    unset($attempts[$ip]);
    apex_write_attempts($attempts);
}

function apex_login(array $body): never
{
    $ip = apex_client_ip();
    if (apex_is_rate_limited($ip)) {
        apex_json_response(['error' => 'Too many attempts. Try again later.'], 429);
    }

    $password = $body['password'] ?? null;
    if (!is_string($password) || !hash_equals(apex_admin_password(), $password)) {
        apex_record_failed_attempt($ip);
        apex_json_response(['error' => 'Incorrect password.'], 401);
    }

    apex_clear_failed_attempts($ip);
    apex_session_start();
    $_SESSION['authenticated'] = true;
    $_SESSION['expiresAt'] = time() + APEX_SESSION_TTL;

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
    apex_session_start();
    $expiresAt = $_SESSION['expiresAt'] ?? 0;
    if (empty($_SESSION['authenticated']) || !is_int($expiresAt) && !is_numeric($expiresAt) || (int) $expiresAt < time()) {
        $_SESSION = [];
        apex_json_response(['error' => 'Not authenticated.'], 401);
    }

    $_SESSION['expiresAt'] = time() + APEX_SESSION_TTL;
}
