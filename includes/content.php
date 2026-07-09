<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

function apex_content_schemas(): array
{
    static $schemas = null;
    if ($schemas === null) {
        $schemas = require __DIR__ . '/content-schema.php';
    }
    return $schemas;
}

function apex_content_pages(): array
{
    return array_keys(apex_content_schemas());
}

function apex_get_page_schema(string $page): ?array
{
    $schemas = apex_content_schemas();
    return $schemas[$page] ?? null;
}

function apex_content_path(string $page): string
{
    return APEX_CONTENT_DIR . '/' . $page . '.json';
}

function apex_get_page_content(string $page): ?array
{
    $path = apex_content_path($page);
    if (!is_file($path)) {
        return null;
    }
    $data = json_decode((string) file_get_contents($path), true);
    return is_array($data) ? $data : null;
}

function apex_write_page_content(string $page, array $content): void
{
    file_put_contents(
        apex_content_path($page),
        json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    );
}

function apex_update_section(string $page, string $section, array $data): ?array
{
    $current = apex_get_page_content($page);
    if ($current === null || !array_key_exists($section, $current)) {
        return null;
    }
    $current[$section] = $data;
    apex_write_page_content($page, $current);
    return $current[$section];
}

function apex_set_section_media(string $page, string $section, string $field, string $tmpPath, string $originalName): ?string
{
    $current = apex_get_page_content($page);
    if ($current === null || !array_key_exists($section, $current)) {
        return null;
    }

    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $ext = $ext !== '' ? '.' . preg_replace('/[^a-z0-9]/i', '', $ext) : '';
    $filename = sprintf('%s-%s-%s-%d%s', $page, $section, $field, time(), $ext);
    $target = APEX_MEDIA_DIR . '/' . $filename;

    if (!move_uploaded_file($tmpPath, $target)) {
        if (!rename($tmpPath, $target)) {
            return null;
        }
    }

    $publicPath = 'assets/content/' . $filename;
    $current[$section][$field] = $publicPath;
    apex_write_page_content($page, $current);

    return $publicPath;
}
