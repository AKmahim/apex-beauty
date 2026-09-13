<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/security.php';

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

function apex_set_section_media(
    string $page,
    string $section,
    string $field,
    string $tmpPath,
    string $originalName,
    ?string $listKey = null,
    ?int $listIndex = null
): ?string {
    $current = apex_get_page_content($page);
    if ($current === null || !array_key_exists($section, $current)) {
        return null;
    }

    // This writes a browser-supplied file into a directory Apache serves, so
    // the extension is not taken from the upload - it is decided here, from an
    // allowlist checked against the file's actual sniffed type. Before this,
    // uploading hero-image.php stored an executable script under the document
    // root, which is remote code execution behind one shared password.
    $ext = apex_upload_safe_extension($tmpPath, $originalName, 'any');
    if ($ext === null) {
        return null;
    }
    $filename = sprintf(
        '%s-%s-%s-%d.%s',
        apex_upload_safe_segment($page),
        apex_upload_safe_segment($section),
        apex_upload_safe_segment($field),
        time(),
        $ext
    );
    $target = APEX_MEDIA_DIR . '/' . $filename;

    if (!move_uploaded_file($tmpPath, $target)) {
        if (!rename($tmpPath, $target)) {
            return null;
        }
    }

    $publicPath = 'assets/content/' . $filename;

    if ($listKey !== null && $listIndex !== null) {
        // Per-item media (e.g. a Vorher/Nachher case's photo): same upload
        // endpoint as section-level media, just scoped one level deeper into
        // a list item. Auto-creates the item slot so a brand-new, not-yet-
        // saved list row (added in the admin panel but no "Save section"
        // click yet) can still receive its photo immediately.
        if (!isset($current[$section][$listKey]) || !is_array($current[$section][$listKey])) {
            $current[$section][$listKey] = [];
        }
        if (!isset($current[$section][$listKey][$listIndex]) || !is_array($current[$section][$listKey][$listIndex])) {
            $current[$section][$listKey][$listIndex] = [];
        }
        $current[$section][$listKey][$listIndex][$field] = $publicPath;
    } else {
        $current[$section][$field] = $publicPath;
    }
    apex_write_page_content($page, $current);

    return $publicPath;
}
