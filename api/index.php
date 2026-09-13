<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/content.php';
require_once __DIR__ . '/../includes/blog.php';
require_once __DIR__ . '/../includes/settings.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/capi.php';
require_once __DIR__ . '/../includes/export.php';
require_once __DIR__ . '/../includes/apex-ai.php';
require_once __DIR__ . '/../includes/apex-ai-sales.php';

// A POST larger than post_max_size is discarded by PHP before any of this
// runs: $_POST and $_FILES arrive empty, the session cookie is never read,
// and the request then fails the auth check further down - so an editor who
// picked an oversized video was told they were logged out. Catching it here,
// ahead of everything, turns that into the one sentence that is actually
// true. 413 rather than 400, because the request really was too large.
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $contentLength = (int) ($_SERVER['CONTENT_LENGTH'] ?? 0);
    $postMax = apex_upload_ini_bytes('post_max_size');
    if ($contentLength > 0 && $postMax > 0 && $contentLength > $postMax && !$_POST && !$_FILES) {
        apex_json_response([
            'error' => 'That upload is too large for this server (limit '
                . apex_format_bytes($postMax) . ' per request).',
        ], 413);
    }
}

$method = apex_request_method();
$path = preg_replace('#^/api/?#', '', apex_request_path()) ?? '';
$segments = array_values(array_filter(explode('/', trim($path, '/')), static fn(string $segment): bool => $segment !== ''));

const APEX_LEAD_MAX_FIELD_LENGTH = 2000;
const APEX_LEAD_MAX_PER_HOUR = 12;

function apex_not_found(): never
{
    apex_json_response(['error' => 'Not found.'], 404);
}

function apex_read_filters(): array
{
    return [
        'search' => $_GET['search'] ?? '',
        'gender' => $_GET['gender'] ?? '',
        'timing' => $_GET['timing'] ?? '',
        'procedure' => $_GET['procedure'] ?? '',
        'marketingOptIn' => $_GET['marketingOptIn'] ?? '',
        'utmSource' => $_GET['utmSource'] ?? '',
        'status' => $_GET['status'] ?? '',
        'from' => $_GET['from'] ?? '',
        'to' => $_GET['to'] ?? '',
    ];
}

if (($segments[0] ?? '') === 'leads') {
    apex_send_cors(['POST', 'OPTIONS']);
    if ($method !== 'POST' || count($segments) !== 1) {
        apex_not_found();
    }

    $lead = apex_read_json_body();
    if (empty($lead['name']) || empty($lead['email'])) {
        apex_json_response(['error' => 'name and email are required.'], 400);
    }
    if (!is_string($lead['email']) || filter_var($lead['email'], FILTER_VALIDATE_EMAIL) === false) {
        apex_json_response(['error' => 'A valid email address is required.'], 400);
    }
    // Caps every submitted string before it reaches the database. Without
    // this the form is a free write of unbounded text from anyone on the
    // internet, and the notes field in particular had no ceiling at all.
    foreach ($lead as $key => $value) {
        if (is_string($value) && mb_strlen($value) > APEX_LEAD_MAX_FIELD_LENGTH) {
            $lead[$key] = mb_substr($value, 0, APEX_LEAD_MAX_FIELD_LENGTH);
        }
    }

    $ipAddress = apex_client_ip();
    // The consultation form is the one endpoint an anonymous visitor can
    // write through. Twelve genuine enquiries an hour from one address is
    // already generous; beyond that it is a script filling the leads table.
    if (apex_rate_limited('leads', $ipAddress, APEX_LEAD_MAX_PER_HOUR, 3600)) {
        apex_json_response(['error' => 'Too many submissions. Please try again later.'], 429);
    }
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $id = apex_insert_lead($lead, ['ipAddress' => $ipAddress, 'userAgent' => $userAgent]);

    if (($lead['trackingConsent'] ?? false) === true) {
        apex_send_lead_event([
            'eventId' => $lead['eventId'] ?? null,
            'email' => $lead['email'] ?? null,
            'phone' => $lead['phone'] ?? null,
            'ip' => $ipAddress,
            'userAgent' => $userAgent,
            'fbp' => $lead['fbp'] ?? null,
            'fbc' => $lead['fbc'] ?? null,
            'eventSourceUrl' => $lead['pageUrl'] ?? null,
        ]);
    }

    apex_json_response(['ok' => true, 'id' => $id], 201);
}

if (($segments[0] ?? '') === 'chat') {
    apex_send_cors(['POST', 'OPTIONS']);
    if ($method !== 'POST') {
        apex_not_found();
    }

    $body = apex_read_json_body();
    $message = is_string($body['message'] ?? null) ? trim($body['message']) : '';
    if ($message === '' || mb_strlen($message) > APEX_AI_MAX_MESSAGE_LENGTH) {
        apex_json_response(['error' => 'A message (max ' . APEX_AI_MAX_MESSAGE_LENGTH . ' characters) is required.'], 400);
    }
    $lang = is_string($body['lang'] ?? null) ? $body['lang'] : 'de';
    $lastTopicId = is_string($body['lastTopicId'] ?? null) ? $body['lastTopicId'] : null;
    $leadState = is_array($body['leadState'] ?? null) ? $body['leadState'] : null;

    if (apex_ai_check_and_record_hit(apex_client_ip())) {
        apex_json_response(['error' => 'Too many messages. Please wait a moment and try again.'], 429);
    }
    apex_json_response(apex_ai_sales_respond($message, $lang, $lastTopicId, $leadState));
}

if (($segments[0] ?? '') === 'content') {
    apex_send_cors(['GET', 'OPTIONS']);
    if ($method !== 'GET' || count($segments) !== 2) {
        apex_not_found();
    }
    $page = $segments[1];
    if (!in_array($page, apex_content_pages(), true)) {
        apex_json_response(['error' => 'Unknown page.'], 404);
    }
    $content = apex_get_page_content($page);
    if ($content === null) {
        apex_json_response(['error' => 'No content for this page.'], 404);
    }
    apex_json_response($content);
}

if (($segments[0] ?? '') !== 'admin') {
    apex_not_found();
}

$adminSegments = array_slice($segments, 1);
$resource = $adminSegments[0] ?? '';

if ($resource === 'login') {
    if ($method !== 'POST') {
        apex_not_found();
    }
    apex_login(apex_read_json_body());
}

if ($resource === 'logout') {
    if ($method !== 'POST') {
        apex_not_found();
    }
    apex_logout();
}

apex_require_auth();

if ($resource === 'me' && $method === 'GET') {
    apex_json_response(['ok' => true]);
}

if ($resource === 'stats' && $method === 'GET') {
    apex_json_response(apex_get_stats());
}

if ($resource === 'insights' && $method === 'GET') {
    apex_json_response(['insights' => apex_get_insights()]);
}

if ($resource === 'forecast' && $method === 'GET') {
    apex_json_response(apex_get_forecast());
}

if ($resource === 'suggestions' && $method === 'GET') {
    apex_json_response(['suggestions' => apex_get_suggestions(), 'anomalies' => apex_get_anomalies()]);
}

if ($resource === 'leads-export.csv' && $method === 'GET') {
    apex_export_leads_csv(apex_list_all_leads_for_export(apex_read_filters()));
}

if ($resource === 'leads') {
    if ($method === 'GET' && count($adminSegments) === 1) {
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $pageSize = min(200, max(1, (int) ($_GET['pageSize'] ?? 50)));
        apex_json_response(apex_list_leads(apex_read_filters(), $page, $pageSize));
    }

    if (count($adminSegments) === 2 && $method === 'GET') {
        $lead = apex_get_lead_by_id((int) $adminSegments[1]);
        if ($lead === null) {
            apex_json_response(['error' => 'Not found.'], 404);
        }
        apex_json_response($lead);
    }

    if (count($adminSegments) === 2 && $method === 'DELETE') {
        $deleted = apex_delete_lead((int) $adminSegments[1]);
        if (!$deleted) {
            apex_json_response(['error' => 'Not found.'], 404);
        }
        apex_json_response(['ok' => true]);
    }

    if (count($adminSegments) === 3 && $adminSegments[2] === 'status' && $method === 'PATCH') {
        $body = apex_read_json_body();
        $status = $body['status'] ?? '';
        if (!in_array($status, APEX_LEAD_STATUSES, true)) {
            apex_json_response(['error' => 'status must be one of: ' . implode(', ', APEX_LEAD_STATUSES)], 400);
        }
        $updated = apex_update_lead_status((int) $adminSegments[1], $status);
        if (!$updated) {
            apex_json_response(['error' => 'Not found.'], 404);
        }
        apex_json_response(['ok' => true, 'status' => $status]);
    }
}

if ($resource === 'content') {
    if ($method === 'GET' && ($adminSegments[1] ?? '') === 'schema') {
        $schemas = [];
        foreach (apex_content_pages() as $page) {
            $schemas[$page] = apex_get_page_schema($page);
        }
        apex_json_response(['pages' => $schemas]);
    }

    $page = $adminSegments[1] ?? '';
    if (!in_array($page, apex_content_pages(), true)) {
        apex_json_response(['error' => 'Unknown page.'], 404);
    }

    if ($method === 'GET' && count($adminSegments) === 2) {
        $content = apex_get_page_content($page);
        if ($content === null) {
            apex_json_response(['error' => 'No content for this page.'], 404);
        }
        apex_json_response($content);
    }

    if ($method === 'PUT' && count($adminSegments) === 3) {
        $updated = apex_update_section($page, $adminSegments[2], apex_read_json_body());
        if ($updated === null) {
            apex_json_response(['error' => 'Unknown section.'], 404);
        }
        apex_json_response(['ok' => true, 'section' => $adminSegments[2], 'data' => $updated]);
    }

    if ($method === 'POST' && count($adminSegments) === 5 && $adminSegments[3] === 'media') {
        $uploadError = apex_upload_error($_FILES['file'] ?? null);
        if ($uploadError !== null || !is_uploaded_file($_FILES['file']['tmp_name'])) {
            apex_json_response(['error' => $uploadError ?? 'No file uploaded.'], 400);
        }
        // Optional: present when uploading a photo for one item in a list
        // (e.g. one Vorher/Nachher case) rather than a flat section field.
        $listKey = isset($_POST['listKey']) && $_POST['listKey'] !== '' ? (string) $_POST['listKey'] : null;
        $listIndex = isset($_POST['index']) && $_POST['index'] !== '' ? (int) $_POST['index'] : null;
        // Checked here as well as inside apex_set_section_media so a rejected
        // file gets a message that says what was wrong with it, rather than
        // the 404 that means "no such section".
        if (apex_upload_safe_extension($_FILES['file']['tmp_name'], (string) $_FILES['file']['name'], 'any') === null) {
            apex_json_response(['error' => 'That file was not accepted. Use JPG, PNG, WebP, GIF or AVIF up to '
                . apex_format_bytes(apex_upload_limit('image')) . ', or MP4, WebM or MOV up to '
                . apex_format_bytes(apex_upload_limit('video')) . '.'], 400);
        }
        $stored = apex_set_section_media(
            $page,
            $adminSegments[2],
            $adminSegments[4],
            $_FILES['file']['tmp_name'],
            $_FILES['file']['name'],
            $listKey,
            $listIndex
        );
        if ($stored === null) {
            apex_json_response(['error' => 'Unknown section.'], 404);
        }
        apex_json_response(['ok' => true, 'path' => $stored]);
    }
}

// ---- Site settings --------------------------------------------------------
// Verification strings and tracking IDs that used to be hardcoded in every
// page template.
if ($resource === 'settings') {
    if ($method === 'GET') {
        apex_json_response(['settings' => apex_settings(), 'fields' => array_keys(APEX_SETTINGS_DEFAULTS)]);
    }
    if ($method === 'PUT') {
        apex_json_response(['ok' => true, 'settings' => apex_save_settings(apex_read_json_body())]);
    }
    apex_not_found();
}

// ---- Blog -----------------------------------------------------------------
// Posts are addressed by slug: /api/admin/blog for the list, /blog/<slug> for
// one post, /blog/<slug>/media/<field> for its images.
if ($resource === 'blog') {
    $slug = $adminSegments[1] ?? '';

    if ($method === 'GET' && count($adminSegments) === 1) {
        apex_json_response(['posts' => apex_blog_all(false), 'languages' => APEX_CONTENT_LANGS]);
    }

    // Create. A title is enough; the slug is derived from it unless one is
    // given, and a collision gets a numeric suffix rather than an error, so
    // writing a second "Hair transplant cost" post just works.
    if ($method === 'POST' && count($adminSegments) === 1) {
        $body = apex_read_json_body();
        $wanted = apex_blog_slugify((string) ($body['slug'] ?? $body['title'] ?? ''));
        if ($wanted === '') {
            $wanted = 'post-' . gmdate('Ymd-His');
        }
        $slug = $wanted;
        $n = 2;
        while (apex_blog_get($slug) !== null) {
            $slug = $wanted . '-' . $n++;
        }
        $post = apex_blog_save($slug, [
            'status' => 'draft',
            'title' => is_array($body['title'] ?? null) ? $body['title'] : [],
        ]);
        if ($post === null) {
            apex_json_response(['error' => 'Could not create post.'], 400);
        }
        apex_json_response(['ok' => true, 'post' => $post], 201);
    }

    if (!apex_blog_valid_slug($slug)) {
        apex_not_found();
    }

    if ($method === 'GET' && count($adminSegments) === 2) {
        $post = apex_blog_get($slug);
        if ($post === null) {
            apex_json_response(['error' => 'Unknown post.'], 404);
        }
        apex_json_response($post);
    }

    if ($method === 'PUT' && count($adminSegments) === 2) {
        if (apex_blog_get($slug) === null) {
            apex_json_response(['error' => 'Unknown post.'], 404);
        }
        $body = apex_read_json_body();
        // Renaming the slug changes the post's public URL, so it only happens
        // when the new one is valid and free.
        $target = apex_blog_slugify((string) ($body['slug'] ?? $slug));
        if ($target !== $slug && $target !== '') {
            if (apex_blog_get($target) !== null) {
                apex_json_response(['error' => 'That URL is already used by another post.'], 409);
            }
            if (!apex_blog_rename($slug, $target)) {
                apex_json_response(['error' => 'Could not change the URL.'], 400);
            }
            $slug = $target;
        }
        $post = apex_blog_save($slug, $body);
        if ($post === null) {
            apex_json_response(['error' => 'Could not save post.'], 400);
        }
        apex_json_response(['ok' => true, 'post' => $post]);
    }

    if ($method === 'DELETE' && count($adminSegments) === 2) {
        if (!apex_blog_delete($slug)) {
            apex_json_response(['error' => 'Unknown post.'], 404);
        }
        apex_blog_delete_media($slug);
        apex_json_response(['ok' => true]);
    }

    if ($method === 'POST' && count($adminSegments) === 4 && $adminSegments[2] === 'media') {
        if (apex_blog_get($slug) === null) {
            apex_json_response(['error' => 'Unknown post.'], 404);
        }
        $uploadError = apex_upload_error($_FILES['file'] ?? null);
        if ($uploadError !== null || !is_uploaded_file($_FILES['file']['tmp_name'])) {
            apex_json_response(['error' => $uploadError ?? 'No file uploaded.'], 400);
        }
        $stored = apex_blog_store_media($slug, $_FILES['file']['tmp_name'], $_FILES['file']['name']);
        if ($stored === null) {
            apex_json_response(['error' => 'That file was not accepted. Use JPG, PNG, WebP, GIF or AVIF up to '
                . apex_format_bytes(apex_upload_limit('image')) . '.'], 400);
        }
        // The cover is a field on the post; anything else is an inline image
        // the editor drops into the body, so it only needs its URL back.
        if ($adminSegments[3] === 'cover') {
            $post = apex_blog_get($slug) ?? [];
            $post['coverImage'] = $stored;
            apex_blog_save($slug, $post);
        }
        apex_json_response(['ok' => true, 'path' => $stored, 'url' => '/' . $stored]);
    }

    apex_not_found();
}

apex_not_found();
