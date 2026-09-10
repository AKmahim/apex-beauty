<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/site-config.php';
require_once __DIR__ . '/i18n.php';

// The blog: one JSON file per post under data/blog, so publishing or editing
// one post never rewrites the others and the slug is the file name. Posts
// carry the same { de, en, fr, nl, it, tr } shape as the rest of the CMS, and
// only German and English get crawlable URLs, exactly like the static pages.

const APEX_BLOG_STATUSES = ['draft', 'published'];

// Fields whose value is a per-language dictionary rather than a plain string.
const APEX_BLOG_LANG_FIELDS = ['title', 'excerpt', 'body', 'coverAlt', 'seoTitle', 'seoDescription'];

function apex_blog_slugify(string $value): string
{
    $map = [
        'ä' => 'ae', 'ö' => 'oe', 'ü' => 'ue', 'Ä' => 'ae', 'Ö' => 'oe', 'Ü' => 'ue', 'ß' => 'ss',
        'á' => 'a', 'à' => 'a', 'â' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 'é' => 'e',
        'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'í' => 'i', 'î' => 'i', 'ó' => 'o', 'ô' => 'o',
        'ø' => 'o', 'ú' => 'u', 'û' => 'u', 'ñ' => 'n', 'ı' => 'i', 'ş' => 's', 'ğ' => 'g',
    ];
    $value = strtr(mb_strtolower(trim($value), 'UTF-8'), $map);
    $value = (string) preg_replace('/[^a-z0-9]+/u', '-', $value);
    return trim($value, '-');
}

// A slug is also a file name, so it is validated rather than trusted: no
// traversal, no dots, nothing that could escape data/blog.
function apex_blog_valid_slug(string $slug): bool
{
    return $slug !== '' && strlen($slug) <= 120 && preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug) === 1;
}

function apex_blog_path(string $slug): ?string
{
    return apex_blog_valid_slug($slug) ? APEX_BLOG_DIR . '/' . $slug . '.json' : null;
}

function apex_blog_empty_langs(): array
{
    return array_fill_keys(APEX_CONTENT_LANGS, '');
}

// Fills in every field a post is expected to have, so the admin panel and the
// templates never have to guard against a post written by an older version.
function apex_blog_normalise(array $post, string $slug): array
{
    $out = [
        'slug' => $slug,
        'status' => in_array($post['status'] ?? '', APEX_BLOG_STATUSES, true) ? $post['status'] : 'draft',
        'publishedAt' => is_string($post['publishedAt'] ?? null) && $post['publishedAt'] !== ''
            ? substr($post['publishedAt'], 0, 10)
            : gmdate('Y-m-d'),
        'updatedAt' => is_string($post['updatedAt'] ?? null) ? substr((string) $post['updatedAt'], 0, 10) : gmdate('Y-m-d'),
        'author' => is_string($post['author'] ?? null) && $post['author'] !== '' ? $post['author'] : APEX_BUSINESS_NAME,
        'coverImage' => is_string($post['coverImage'] ?? null) ? $post['coverImage'] : '',
        // Every URL this post has ever had. Renaming a published article used
        // to leave the old URL as a hard 404, losing whatever ranking and
        // links it had earned; these let the old URL redirect instead.
        'previousSlugs' => array_values(array_unique(array_filter(
            is_array($post['previousSlugs'] ?? null) ? $post['previousSlugs'] : [],
            static fn($v): bool => is_string($v) && apex_blog_valid_slug($v)
        ))),
    ];
    foreach (APEX_BLOG_LANG_FIELDS as $field) {
        $value = $post[$field] ?? null;
        $dict = apex_blog_empty_langs();
        if (is_array($value)) {
            foreach (APEX_CONTENT_LANGS as $lang) {
                $dict[$lang] = is_string($value[$lang] ?? null) ? $value[$lang] : '';
            }
        }
        $out[$field] = $dict;
    }
    return $out;
}

function apex_blog_get(string $slug): ?array
{
    $path = apex_blog_path($slug);
    if ($path === null || !is_file($path)) {
        return null;
    }
    $data = json_decode((string) file_get_contents($path), true);
    return is_array($data) ? apex_blog_normalise($data, $slug) : null;
}

function apex_blog_save(string $slug, array $post): ?array
{
    $path = apex_blog_path($slug);
    if ($path === null) {
        return null;
    }
    $post = apex_blog_normalise($post, $slug);
    // The admin panel round-trips the post through the browser, and the browser
    // has no reason to know about retired URLs. Merging with what is already on
    // disk means a normal save cannot silently drop the redirect history.
    $existing = apex_blog_get($slug);
    if ($existing !== null) {
        $post['previousSlugs'] = array_values(array_unique(
            array_merge($existing['previousSlugs'], $post['previousSlugs'])
        ));
    }
    $post['previousSlugs'] = array_values(array_diff($post['previousSlugs'], [$slug]));
    $post['updatedAt'] = gmdate('Y-m-d');
    file_put_contents($path, json_encode($post, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    return $post;
}

function apex_blog_delete(string $slug): bool
{
    $path = apex_blog_path($slug);
    if ($path === null || !is_file($path)) {
        return false;
    }
    return unlink($path);
}

function apex_blog_rename(string $from, string $to): bool
{
    $fromPath = apex_blog_path($from);
    $toPath = apex_blog_path($to);
    if ($fromPath === null || $toPath === null || !is_file($fromPath) || is_file($toPath)) {
        return false;
    }
    if (!rename($fromPath, $toPath)) {
        return false;
    }
    // Remember where this post used to live so the old URL can redirect.
    $post = apex_blog_get($to);
    if ($post !== null) {
        $post['previousSlugs'][] = $from;
        apex_blog_save($to, $post);
    }
    return true;
}

// Finds the post that a retired URL now belongs to, so it can 301 rather
// than 404.
function apex_blog_find_by_previous_slug(string $slug): ?array
{
    if (!apex_blog_valid_slug($slug)) {
        return null;
    }
    foreach (apex_blog_all(false) as $post) {
        if (in_array($slug, $post['previousSlugs'], true)) {
            return $post;
        }
    }
    return null;
}

// Newest first. Drafts are included only when asked for, so the same call
// serves both the public archive and the admin list.
function apex_blog_all(bool $publishedOnly = true): array
{
    $posts = [];
    foreach (glob(APEX_BLOG_DIR . '/*.json') ?: [] as $file) {
        $slug = basename($file, '.json');
        $post = apex_blog_get($slug);
        if ($post === null) {
            continue;
        }
        if ($publishedOnly && $post['status'] !== 'published') {
            continue;
        }
        $posts[] = $post;
    }
    usort($posts, static fn(array $a, array $b): int => strcmp($b['publishedAt'], $a['publishedAt'])
        ?: strcmp($b['slug'], $a['slug']));
    return $posts;
}

function apex_blog_index_path(?string $lang = null): string
{
    return trim(apex_lang_base($lang) . '/blog', '/');
}

function apex_blog_post_path(string $slug, ?string $lang = null): string
{
    return trim(apex_lang_base($lang) . '/blog/' . $slug, '/');
}

function apex_blog_url(string $path): string
{
    return rtrim(APEX_SITE_URL, '/') . '/' . ltrim($path, '/');
}

// A post is only worth showing in a language if it actually has a title and a
// body there. Everything else falls back the way the rest of the site does.
function apex_blog_has_language(array $post, string $lang): bool
{
    return trim((string) ($post['title'][$lang] ?? '')) !== ''
        && trim((string) ($post['body'][$lang] ?? '')) !== '';
}

function apex_blog_reading_minutes(array $post, string $lang): int
{
    $text = strip_tags(apex_cms_value($post['body'] ?? null, $lang));
    $words = str_word_count($text, 0, 'äöüÄÖÜßáàâéèêíóôúñçışğ');
    return max(1, (int) ceil($words / 200));
}

const APEX_BLOG_IMAGE_TYPES = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif'];

// Stores an uploaded image for a post and hands back the public path. Unlike
// the page-media uploader this checks the extension against an allowlist,
// because the blog is where a lot of files get uploaded by whoever is writing.
function apex_blog_store_media(string $slug, string $tmpPath, string $originalName): ?string
{
    if (!apex_blog_valid_slug($slug)) {
        return null;
    }
    $ext = strtolower((string) preg_replace('/[^a-z0-9]/i', '', pathinfo($originalName, PATHINFO_EXTENSION)));
    if (!in_array($ext, APEX_BLOG_IMAGE_TYPES, true)) {
        return null;
    }
    $base = apex_blog_slugify(pathinfo($originalName, PATHINFO_FILENAME));
    $base = $base !== '' ? substr($base, 0, 60) : 'image';
    $filename = sprintf('%s-%s-%d.%s', $slug, $base, time(), $ext);
    $target = APEX_BLOG_MEDIA_DIR . '/' . $filename;

    if (!move_uploaded_file($tmpPath, $target) && !rename($tmpPath, $target)) {
        return null;
    }
    return 'assets/blog/' . $filename;
}

// Images uploaded for a post are named after its slug, so deleting the post
// can clean them up instead of leaving orphans in assets/blog forever.
function apex_blog_delete_media(string $slug): int
{
    if (!apex_blog_valid_slug($slug)) {
        return 0;
    }
    $removed = 0;
    foreach (glob(APEX_BLOG_MEDIA_DIR . '/' . $slug . '-*') ?: [] as $file) {
        if (is_file($file) && unlink($file)) {
            $removed++;
        }
    }
    return $removed;
}
