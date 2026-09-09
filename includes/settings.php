<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

// Site-wide settings that used to be constants scattered through the page
// templates: the tracking IDs (repeated verbatim in seven files), the Search
// Console verification string, and the default social share image.
//
// Defaults are the values that were hardcoded, so an empty settings file
// behaves exactly like the site did before.

const APEX_SETTINGS_DEFAULTS = [
    'gtmId' => 'GTM-W6ZC5JRP',
    'metaPixelId' => '972641739140966',
    'googleSiteVerification' => '',
    'bingSiteVerification' => '',
    'defaultShareImage' => 'assets/wordmark-transparent.png',
];

function apex_settings_path(): string
{
    return APEX_DATA_DIR . '/settings.json';
}

function apex_settings(bool $refresh = false): array
{
    static $settings = null;
    if ($settings !== null && !$refresh) {
        return $settings;
    }
    $stored = [];
    $path = apex_settings_path();
    if (is_file($path)) {
        $decoded = json_decode((string) file_get_contents($path), true);
        if (is_array($decoded)) {
            $stored = $decoded;
        }
    }
    $settings = [];
    foreach (APEX_SETTINGS_DEFAULTS as $key => $default) {
        $value = $stored[$key] ?? null;
        $settings[$key] = is_string($value) && trim($value) !== '' ? trim($value) : $default;
    }
    return $settings;
}

function apex_setting(string $key): string
{
    return apex_settings()[$key] ?? '';
}

function apex_save_settings(array $incoming): array
{
    $current = apex_settings();
    foreach (APEX_SETTINGS_DEFAULTS as $key => $default) {
        if (array_key_exists($key, $incoming) && is_string($incoming[$key])) {
            $current[$key] = trim($incoming[$key]);
        }
    }
    file_put_contents(
        apex_settings_path(),
        json_encode($current, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    );
    // Re-read so anything asking later in this same request sees the new
    // values rather than the memoised ones.
    return apex_settings(true);
}
