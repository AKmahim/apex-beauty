<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/content.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/capi.php';
require_once __DIR__ . '/../includes/export.php';

$method = apex_request_method();
$path = preg_replace('#^/api/?#', '', apex_request_path()) ?? '';
$segments = array_values(array_filter(explode('/', trim($path, '/')), static fn(string $segment): bool => $segment !== ''));

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

    $ipAddress = apex_client_ip();
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
        if (!isset($_FILES['file']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
            apex_json_response(['error' => 'No file uploaded.'], 400);
        }
        $stored = apex_set_section_media($page, $adminSegments[2], $adminSegments[4], $_FILES['file']['tmp_name'], $_FILES['file']['name']);
        if ($stored === null) {
            apex_json_response(['error' => 'Unknown section.'], 404);
        }
        apex_json_response(['ok' => true, 'path' => $stored]);
    }
}

apex_not_found();
