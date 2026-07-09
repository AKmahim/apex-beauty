<?php

declare(strict_types=1);

const APEX_ROOT = __DIR__ . '/..';
const APEX_DATA_DIR = APEX_ROOT . '/data';
const APEX_CONTENT_DIR = APEX_DATA_DIR . '/content';
const APEX_MEDIA_DIR = APEX_ROOT . '/assets/content';
const APEX_ENV_FILES = [
    APEX_ROOT . '/.env',
    APEX_ROOT . '/backend/.env',
];

function apex_bootstrap(): void
{
    static $booted = false;
    if ($booted) {
        return;
    }

    foreach (APEX_ENV_FILES as $envFile) {
        apex_load_env_file($envFile);
    }

    if (!is_dir(APEX_DATA_DIR)) {
        mkdir(APEX_DATA_DIR, 0775, true);
    }
    if (!is_dir(APEX_CONTENT_DIR)) {
        mkdir(APEX_CONTENT_DIR, 0775, true);
    }
    if (!is_dir(APEX_MEDIA_DIR)) {
        mkdir(APEX_MEDIA_DIR, 0775, true);
    }

    date_default_timezone_set('UTC');
    $booted = true;
}

function apex_load_env_file(string $path): void
{
    if (!is_file($path) || !is_readable($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        $parts = explode('=', $line, 2);
        if (count($parts) !== 2) {
            continue;
        }
        $name = trim($parts[0]);
        $value = trim($parts[1]);
        if ($name === '' || getenv($name) !== false) {
            continue;
        }
        putenv($name . '=' . $value);
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}

function apex_env(string $name, ?string $default = null): ?string
{
    $value = getenv($name);
    return $value === false ? $default : $value;
}

function apex_json_response(array $payload, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function apex_request_path(): string
{
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($uri, PHP_URL_PATH);
    return is_string($path) ? $path : '/';
}

function apex_request_method(): string
{
    return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
}

function apex_read_json_body(): array
{
    $raw = file_get_contents('php://input');
    if ($raw === false || $raw === '') {
        return [];
    }
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

function apex_client_ip(): string
{
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

function apex_same_origin_base(): string
{
    return '';
}

function apex_send_cors(array $methods, array $headers = ['Content-Type']): void
{
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: ' . implode(', ', $methods));
    if ($headers) {
        header('Access-Control-Allow-Headers: ' . implode(', ', $headers));
    }
    if (apex_request_method() === 'OPTIONS') {
        http_response_code(204);
        exit;
    }
}

apex_bootstrap();
