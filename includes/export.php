<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/security.php';

function apex_export_leads_csv(array $leads): never
{
    $filename = 'apex-beauty-leads-' . gmdate('Y-m-d') . '.csv';
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $out = fopen('php://output', 'wb');
    fputcsv($out, [
        'ID', 'Submitted at', 'Name', 'Email', 'Phone', 'Country', 'Gender',
        'Procedures', 'Therapies', 'Timing', 'Photos uploaded', 'Coupon',
        'Marketing opt-in', 'Language', 'UTM source', 'UTM medium', 'UTM campaign', 'Notes', 'Status'
    ]);

    foreach ($leads as $lead) {
        // Every field here was typed by a member of the public. apex_csv_cell
        // stops a spreadsheet from executing one when the clinic opens the
        // export.
        fputcsv($out, array_map('apex_csv_cell', [
            $lead['id'],
            $lead['submittedAt'],
            $lead['name'],
            $lead['email'],
            $lead['phone'],
            $lead['country'],
            $lead['gender'],
            implode(', ', $lead['procedures'] ?? []),
            implode(', ', $lead['therapies'] ?? []),
            $lead['timing'],
            $lead['photosUploaded'],
            $lead['coupon'],
            !empty($lead['marketingOptIn']) ? 'Yes' : 'No',
            $lead['lang'],
            $lead['utm']['source'] ?? null,
            $lead['utm']['medium'] ?? null,
            $lead['utm']['campaign'] ?? null,
            $lead['notes'],
            $lead['status'],
        ]));
    }

    fclose($out);
    exit;
}
