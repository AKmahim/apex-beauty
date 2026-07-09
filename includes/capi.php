<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

const APEX_META_API_VERSION = 'v21.0';

function apex_meta_pixel_id(): string
{
    return apex_env('META_PIXEL_ID', 'PENDING_PIXEL_ID') ?? 'PENDING_PIXEL_ID';
}

function apex_meta_access_token(): string
{
    return apex_env('META_ACCESS_TOKEN', 'PENDING_ACCESS_TOKEN') ?? 'PENDING_ACCESS_TOKEN';
}

function apex_has_real_meta_credentials(): bool
{
    return apex_meta_pixel_id() !== 'PENDING_PIXEL_ID' && apex_meta_access_token() !== 'PENDING_ACCESS_TOKEN';
}

function apex_sha256_hex(string $value): string
{
    return hash('sha256', $value);
}

function apex_hash_email(?string $email): string
{
    return apex_sha256_hex(strtolower(trim((string) $email)));
}

function apex_hash_phone(?string $phone): string
{
    return apex_sha256_hex((string) preg_replace('/\D+/', '', (string) $phone));
}

function apex_build_lead_event_payload(array $fields): array
{
    $userData = [
        'em' => [apex_hash_email($fields['email'] ?? '')],
        'ph' => [apex_hash_phone($fields['phone'] ?? '')],
        'client_ip_address' => $fields['ip'] ?? null,
        'client_user_agent' => $fields['userAgent'] ?? null,
        'fbp' => $fields['fbp'] ?? null,
        'fbc' => $fields['fbc'] ?? null,
    ];
    $userData = array_filter($userData, static fn($value) => $value !== null);

    $event = [
        'event_name' => 'Lead',
        'event_time' => time(),
        'event_id' => $fields['eventId'] ?? null,
        'action_source' => 'website',
        'user_data' => $userData,
    ];

    if (!empty($fields['eventSourceUrl'])) {
        $event['event_source_url'] = $fields['eventSourceUrl'];
    }

    return ['data' => [$event]];
}

function apex_send_lead_event(array $fields): array
{
    $payload = apex_build_lead_event_payload($fields);
    if (!apex_has_real_meta_credentials()) {
        error_log('[capi] placeholder credentials — Lead payload constructed but not sent: ' . json_encode($payload));
        return ['sent' => false, 'reason' => 'placeholder_credentials', 'payload' => $payload];
    }

    if (!function_exists('curl_init')) {
        error_log('[capi] curl extension unavailable — Lead payload constructed but not sent: ' . json_encode($payload));
        return ['sent' => false, 'reason' => 'curl_unavailable', 'payload' => $payload];
    }

    $url = sprintf(
        'https://graph.facebook.com/%s/%s/events?access_token=%s',
        APEX_META_API_VERSION,
        apex_meta_pixel_id(),
        rawurlencode(apex_meta_access_token())
    );

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_TIMEOUT => 10,
    ]);
    $response = curl_exec($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($response === false) {
        error_log('[capi] failed to reach Meta CAPI endpoint: ' . $error);
        return ['sent' => false, 'reason' => 'network_error', 'payload' => $payload];
    }

    $body = json_decode($response, true);
    error_log('[capi] sent Lead event to Meta: ' . json_encode(['status' => $status, 'body' => $body]));
    return ['sent' => $status >= 200 && $status < 300, 'status' => $status, 'body' => $body, 'payload' => $payload];
}
