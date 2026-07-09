<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

const APEX_LEAD_STATUSES = ['new', 'contacted', 'converted', 'lost'];
const APEX_MIN_BASE_FOR_TREND = 5;
const APEX_MIN_BASE_FOR_COUNTRY_TREND = 3;
const APEX_MIN_BASE_FOR_PROCEDURE_INSIGHT = 3;

function apex_db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $host = apex_env('DB_HOST', '127.0.0.1') ?? '127.0.0.1';
    $port = apex_env('DB_PORT', '3306') ?? '3306';
    $name = apex_env('DB_NAME');
    $user = apex_env('DB_USER');
    $pass = apex_env('DB_PASSWORD', '') ?? '';
    $charset = apex_env('DB_CHARSET', 'utf8mb4') ?? 'utf8mb4';

    if ($name === null || $name === '' || $user === null || $user === '') {
        throw new RuntimeException('MySQL is not configured. Set DB_HOST, DB_PORT, DB_NAME, DB_USER, and DB_PASSWORD in .env.');
    }

    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', $host, $port, $name, $charset);
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    apex_migrate($pdo);

    return $pdo;
}

function apex_migrate(PDO $pdo): void
{
    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS leads (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            country VARCHAR(32) NULL,
            phone VARCHAR(64) NULL,
            gender VARCHAR(32) NULL,
            procedures LONGTEXT NOT NULL,
            therapies LONGTEXT NOT NULL,
            timing VARCHAR(64) NULL,
            notes TEXT NULL,
            photos_uploaded TINYINT UNSIGNED NOT NULL DEFAULT 0,
            coupon VARCHAR(128) NULL,
            marketing_opt_in TINYINT(1) NOT NULL DEFAULT 0,
            lang VARCHAR(16) NULL,
            utm_source VARCHAR(128) NULL,
            utm_medium VARCHAR(128) NULL,
            utm_campaign VARCHAR(128) NULL,
            tracking_consent TINYINT(1) NOT NULL DEFAULT 0,
            event_id VARCHAR(191) NULL,
            ip_address VARCHAR(64) NULL,
            user_agent TEXT NULL,
            fbp VARCHAR(255) NULL,
            fbc VARCHAR(255) NULL,
            status VARCHAR(32) NOT NULL DEFAULT 'new',
            submitted_at DATETIME NOT NULL,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            KEY idx_leads_created_at (created_at),
            KEY idx_leads_email (email),
            KEY idx_leads_status (status)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
    );
}

function apex_to_mysql_datetime(?string $value): string
{
    if (!is_string($value) || trim($value) === '') {
        return gmdate('Y-m-d H:i:s');
    }

    try {
        $dt = new DateTimeImmutable($value, new DateTimeZone('UTC'));
    } catch (Throwable $e) {
        return gmdate('Y-m-d H:i:s');
    }

    return $dt->setTimezone(new DateTimeZone('UTC'))->format('Y-m-d H:i:s');
}

function apex_from_mysql_datetime(?string $value): ?string
{
    if (!is_string($value) || trim($value) === '') {
        return null;
    }

    try {
        $dt = new DateTimeImmutable($value, new DateTimeZone('UTC'));
    } catch (Throwable $e) {
        return $value;
    }

    return $dt->format(DATE_ATOM);
}

function apex_to_row(array $lead, array $meta = []): array
{
    return [
        ':name' => $lead['name'],
        ':email' => $lead['email'],
        ':country' => $lead['country'] ?? null,
        ':phone' => $lead['phone'] ?? null,
        ':gender' => $lead['gender'] ?? null,
        ':procedures' => json_encode($lead['procedures'] ?? []),
        ':therapies' => json_encode($lead['therapies'] ?? []),
        ':timing' => $lead['timing'] ?? null,
        ':notes' => $lead['notes'] ?? null,
        ':photos_uploaded' => (int) ($lead['photosUploaded'] ?? 0),
        ':coupon' => $lead['coupon'] ?? null,
        ':marketing_opt_in' => !empty($lead['marketingOptIn']) ? 1 : 0,
        ':lang' => $lead['lang'] ?? null,
        ':utm_source' => $lead['utm']['source'] ?? null,
        ':utm_medium' => $lead['utm']['medium'] ?? null,
        ':utm_campaign' => $lead['utm']['campaign'] ?? null,
        ':tracking_consent' => !empty($lead['trackingConsent']) ? 1 : 0,
        ':event_id' => $lead['eventId'] ?? null,
        ':ip_address' => $meta['ipAddress'] ?? null,
        ':user_agent' => $meta['userAgent'] ?? null,
        ':fbp' => $lead['fbp'] ?? null,
        ':fbc' => $lead['fbc'] ?? null,
        ':submitted_at' => apex_to_mysql_datetime($lead['submittedAt'] ?? null),
    ];
}

function apex_from_row(array $row): array
{
    return [
        'id' => (int) $row['id'],
        'name' => $row['name'],
        'email' => $row['email'],
        'country' => $row['country'],
        'phone' => $row['phone'],
        'gender' => $row['gender'],
        'procedures' => json_decode($row['procedures'] ?? '[]', true) ?: [],
        'therapies' => json_decode($row['therapies'] ?? '[]', true) ?: [],
        'timing' => $row['timing'],
        'notes' => $row['notes'],
        'photosUploaded' => (int) $row['photos_uploaded'],
        'coupon' => $row['coupon'],
        'marketingOptIn' => (bool) $row['marketing_opt_in'],
        'lang' => $row['lang'],
        'utm' => [
            'source' => $row['utm_source'],
            'medium' => $row['utm_medium'],
            'campaign' => $row['utm_campaign'],
        ],
        'trackingConsent' => (bool) $row['tracking_consent'],
        'eventId' => $row['event_id'],
        'ipAddress' => $row['ip_address'],
        'userAgent' => $row['user_agent'],
        'fbp' => $row['fbp'],
        'fbc' => $row['fbc'],
        'status' => $row['status'],
        'submittedAt' => apex_from_mysql_datetime($row['submitted_at'] ?? null),
        'createdAt' => apex_from_mysql_datetime($row['created_at'] ?? null),
    ];
}

function apex_insert_lead(array $lead, array $meta = []): int
{
    $pdo = apex_db();
    $stmt = $pdo->prepare(
        'INSERT INTO leads (
            name, email, country, phone, gender, procedures, therapies, timing,
            notes, photos_uploaded, coupon, marketing_opt_in, lang,
            utm_source, utm_medium, utm_campaign,
            tracking_consent, event_id, ip_address, user_agent, fbp, fbc, submitted_at
        ) VALUES (
            :name, :email, :country, :phone, :gender, :procedures, :therapies, :timing,
            :notes, :photos_uploaded, :coupon, :marketing_opt_in, :lang,
            :utm_source, :utm_medium, :utm_campaign,
            :tracking_consent, :event_id, :ip_address, :user_agent, :fbp, :fbc, :submitted_at
        )'
    );
    $stmt->execute(apex_to_row($lead, $meta));
    return (int) $pdo->lastInsertId();
}

function apex_get_lead_by_id(int $id): ?array
{
    $stmt = apex_db()->prepare('SELECT * FROM leads WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    return is_array($row) ? apex_from_row($row) : null;
}

function apex_build_filter(array $filters): array
{
    $clauses = [];
    $params = [];

    if (($filters['search'] ?? '') !== '') {
        $clauses[] = '(name LIKE :search OR email LIKE :search OR phone LIKE :search)';
        $params[':search'] = '%' . $filters['search'] . '%';
    }
    if (($filters['gender'] ?? '') !== '') {
        $clauses[] = 'gender = :gender';
        $params[':gender'] = $filters['gender'];
    }
    if (($filters['timing'] ?? '') !== '') {
        $clauses[] = 'timing = :timing';
        $params[':timing'] = $filters['timing'];
    }
    if (($filters['procedure'] ?? '') !== '') {
        $clauses[] = 'procedures LIKE :procedure';
        $params[':procedure'] = '%"' . $filters['procedure'] . '"%';
    }
    if (($filters['marketingOptIn'] ?? '') === 'true') {
        $clauses[] = 'marketing_opt_in = 1';
    } elseif (($filters['marketingOptIn'] ?? '') === 'false') {
        $clauses[] = 'marketing_opt_in = 0';
    }
    if (($filters['utmSource'] ?? '') !== '') {
        $clauses[] = "COALESCE(utm_source, 'direct') = :utmSource";
        $params[':utmSource'] = $filters['utmSource'];
    }
    if (($filters['status'] ?? '') !== '') {
        $clauses[] = 'status = :status';
        $params[':status'] = $filters['status'];
    }
    if (($filters['from'] ?? '') !== '') {
        $clauses[] = 'submitted_at >= :from';
        $params[':from'] = $filters['from'];
    }
    if (($filters['to'] ?? '') !== '') {
        $clauses[] = 'submitted_at <= :to';
        $params[':to'] = $filters['to'];
    }

    return [
        'where' => $clauses ? ' WHERE ' . implode(' AND ', $clauses) : '',
        'params' => $params,
    ];
}

function apex_list_leads(array $filters = [], int $page = 1, int $pageSize = 50): array
{
    $filter = apex_build_filter($filters);
    $offset = (max(1, $page) - 1) * $pageSize;
    $pdo = apex_db();

    $stmt = $pdo->prepare('SELECT * FROM leads' . $filter['where'] . ' ORDER BY submitted_at DESC LIMIT :limit OFFSET :offset');
    foreach ($filter['params'] as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $pageSize, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    $countStmt = $pdo->prepare('SELECT COUNT(*) AS total FROM leads' . $filter['where']);
    $countStmt->execute($filter['params']);
    $total = (int) $countStmt->fetchColumn();

    return [
        'leads' => array_map('apex_from_row', $rows ?: []),
        'total' => $total,
        'page' => max(1, $page),
        'pageSize' => $pageSize,
    ];
}

function apex_list_all_leads_for_export(array $filters = []): array
{
    $filter = apex_build_filter($filters);
    $stmt = apex_db()->prepare('SELECT * FROM leads' . $filter['where'] . ' ORDER BY submitted_at DESC');
    $stmt->execute($filter['params']);
    return array_map('apex_from_row', $stmt->fetchAll() ?: []);
}

function apex_delete_lead(int $id): bool
{
    $stmt = apex_db()->prepare('DELETE FROM leads WHERE id = :id');
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount() > 0;
}

function apex_update_lead_status(int $id, string $status): bool
{
    if (!in_array($status, APEX_LEAD_STATUSES, true)) {
        throw new InvalidArgumentException('Invalid status.');
    }
    $stmt = apex_db()->prepare('UPDATE leads SET status = :status WHERE id = :id');
    $stmt->execute([':status' => $status, ':id' => $id]);
    return $stmt->rowCount() > 0;
}

function apex_scalar(string $sql, array $params = []): int
{
    $stmt = apex_db()->prepare($sql);
    $stmt->execute($params);
    return (int) $stmt->fetchColumn();
}

function apex_group_counts(string $sql, array $params = []): array
{
    $stmt = apex_db()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll() ?: [];
}

function apex_get_stats(): array
{
    $total = apex_scalar('SELECT COUNT(*) FROM leads');
    $last7Days = apex_scalar("SELECT COUNT(*) FROM leads WHERE submitted_at >= UTC_TIMESTAMP() - INTERVAL 7 DAY");
    $prev7Days = apex_scalar("SELECT COUNT(*) FROM leads WHERE submitted_at >= UTC_TIMESTAMP() - INTERVAL 14 DAY AND submitted_at < UTC_TIMESTAMP() - INTERVAL 7 DAY");
    $last30Days = apex_scalar("SELECT COUNT(*) FROM leads WHERE submitted_at >= UTC_TIMESTAMP() - INTERVAL 30 DAY");
    $marketingOptIns = apex_scalar('SELECT COUNT(*) FROM leads WHERE marketing_opt_in = 1');
    $withPhotos = apex_scalar('SELECT COUNT(*) FROM leads WHERE photos_uploaded > 0');

    $byGender = apex_group_counts("SELECT COALESCE(gender,'unspecified') AS key, COUNT(*) AS n FROM leads GROUP BY key ORDER BY n DESC");
    $byTiming = apex_group_counts("SELECT COALESCE(timing,'unspecified') AS key, COUNT(*) AS n FROM leads GROUP BY key ORDER BY n DESC");
    $byCountry = apex_group_counts("SELECT COALESCE(country,'unspecified') AS key, COUNT(*) AS n FROM leads GROUP BY key ORDER BY n DESC");
    $byUtmSource = apex_group_counts("SELECT COALESCE(utm_source,'direct') AS key, COUNT(*) AS n FROM leads GROUP BY key ORDER BY n DESC");
    $byStatus = apex_group_counts("SELECT status AS key, COUNT(*) AS n FROM leads GROUP BY key ORDER BY n DESC");

    $procedureCounts = [];
    $therapyCounts = [];
    foreach (apex_group_counts('SELECT procedures, therapies FROM leads') as $row) {
        foreach (json_decode($row['procedures'] ?? '[]', true) ?: [] as $item) {
            $procedureCounts[$item] = ($procedureCounts[$item] ?? 0) + 1;
        }
        foreach (json_decode($row['therapies'] ?? '[]', true) ?: [] as $item) {
            $therapyCounts[$item] = ($therapyCounts[$item] ?? 0) + 1;
        }
    }

    $trendRows = apex_group_counts(
        "SELECT date(submitted_at) AS day, COUNT(*) AS n
         FROM leads
            WHERE submitted_at >= UTC_TIMESTAMP() - INTERVAL 29 DAY
         GROUP BY day"
    );
    $trendMap = [];
    foreach ($trendRows as $row) {
        $trendMap[$row['day']] = (int) $row['n'];
    }
    $dailyTrend = [];
    for ($i = 29; $i >= 0; $i--) {
        $key = gmdate('Y-m-d', strtotime('-' . $i . ' days'));
        $dailyTrend[] = ['date' => $key, 'n' => $trendMap[$key] ?? 0];
    }

    $monthlyRows = apex_group_counts(
           "SELECT DATE_FORMAT(submitted_at, '%Y-%m') AS month, COUNT(*) AS n
         FROM leads
            WHERE submitted_at >= DATE_SUB(DATE_FORMAT(UTC_TIMESTAMP(), '%Y-%m-01 00:00:00'), INTERVAL 5 MONTH)
         GROUP BY month"
    );
    $monthlyMap = [];
    foreach ($monthlyRows as $row) {
        $monthlyMap[$row['month']] = (int) $row['n'];
    }
    $monthlyTrend = [];
    for ($i = 5; $i >= 0; $i--) {
        $key = gmdate('Y-m', strtotime('-' . $i . ' months', strtotime(gmdate('Y-m-01'))));
        $monthlyTrend[] = ['month' => $key, 'n' => $monthlyMap[$key] ?? 0];
    }

    $mapCounts = static function (array $source): array {
        $rows = [];
        foreach ($source as $key => $n) {
            $rows[] = ['key' => $key, 'n' => $n];
        }
        usort($rows, static fn(array $a, array $b): int => $b['n'] <=> $a['n']);
        return $rows;
    };

    return [
        'total' => $total,
        'last7Days' => $last7Days,
        'prev7Days' => $prev7Days,
        'last30Days' => $last30Days,
        'marketingOptIns' => $marketingOptIns,
        'withPhotos' => $withPhotos,
        'byGender' => $byGender,
        'byTiming' => $byTiming,
        'byCountry' => $byCountry,
        'byUtmSource' => $byUtmSource,
        'byStatus' => $byStatus,
        'dailyTrend' => $dailyTrend,
        'monthlyTrend' => $monthlyTrend,
        'byProcedure' => $mapCounts($procedureCounts),
        'byTherapy' => $mapCounts($therapyCounts),
    ];
}

function apex_month_bounds(int $offsetMonths): array
{
    $start = new DateTimeImmutable('first day of this month 00:00:00', new DateTimeZone('UTC'));
    if ($offsetMonths !== 0) {
        $start = $start->modify(($offsetMonths > 0 ? '+' : '') . $offsetMonths . ' months');
    }
    $end = $start->modify('+1 month');
    return ['start' => $start->format(DATE_ATOM), 'end' => $end->format(DATE_ATOM)];
}

function apex_count_in_range(string $start, string $end, ?string $country = null): int
{
    if ($country === null) {
        return apex_scalar('SELECT COUNT(*) FROM leads WHERE submitted_at >= :start AND submitted_at < :end', [':start' => $start, ':end' => $end]);
    }
    return apex_scalar('SELECT COUNT(*) FROM leads WHERE country = :country AND submitted_at >= :start AND submitted_at < :end', [':country' => $country, ':start' => $start, ':end' => $end]);
}

function apex_get_insights(): array
{
    $insights = [];
    $thisMonth = apex_month_bounds(0);
    $lastMonth = apex_month_bounds(-1);

    $thisMonthTotal = apex_count_in_range($thisMonth['start'], $thisMonth['end']);
    $lastMonthTotal = apex_count_in_range($lastMonth['start'], $lastMonth['end']);

    if ($lastMonthTotal >= APEX_MIN_BASE_FOR_TREND) {
        $change = (int) round((($thisMonthTotal - $lastMonthTotal) / $lastMonthTotal) * 100);
        if ($change > 0) {
            $insights[] = ['text' => "Leads increased {$change}% this month compared to last month ({$thisMonthTotal} vs {$lastMonthTotal}).", 'kind' => 'trend'];
        } elseif ($change < 0) {
            $insights[] = ['text' => 'Leads decreased ' . abs($change) . "% this month compared to last month ({$thisMonthTotal} vs {$lastMonthTotal}).", 'kind' => 'trend'];
        } else {
            $insights[] = ['text' => "Lead volume is flat this month compared to last month ({$thisMonthTotal} both months).", 'kind' => 'trend'];
        }
    } else {
        $suffix = $lastMonthTotal === 1 ? '' : 's';
        $insights[] = ['text' => "Not enough data yet to compare month-over-month lead volume (only {$lastMonthTotal} lead{$suffix} last month).", 'kind' => 'insufficient'];
    }

    $countries = apex_group_counts("SELECT DISTINCT country FROM leads WHERE country IS NOT NULL AND country != ''");
    $topCountryMove = null;
    foreach ($countries as $row) {
        $country = $row['country'];
        $prev = apex_count_in_range($lastMonth['start'], $lastMonth['end'], $country);
        if ($prev < APEX_MIN_BASE_FOR_COUNTRY_TREND) {
            continue;
        }
        $curr = apex_count_in_range($thisMonth['start'], $thisMonth['end'], $country);
        $change = (int) round((($curr - $prev) / $prev) * 100);
        if ($topCountryMove === null || abs($change) > abs($topCountryMove['change'])) {
            $topCountryMove = ['country' => $country, 'change' => $change, 'curr' => $curr, 'prev' => $prev];
        }
    }
    if ($topCountryMove !== null && $topCountryMove['change'] !== 0) {
        $direction = $topCountryMove['change'] > 0 ? 'increased' : 'decreased';
        $insights[] = ['text' => 'Leads from ' . $topCountryMove['country'] . ' ' . $direction . ' ' . abs($topCountryMove['change']) . "% this month compared to last month ({$topCountryMove['curr']} vs {$topCountryMove['prev']}).", 'kind' => 'trend'];
    }

    $procedureCounts = [];
    $stmt = apex_db()->prepare('SELECT procedures FROM leads WHERE submitted_at >= :start AND submitted_at < :end');
    $stmt->execute([':start' => $thisMonth['start'], ':end' => $thisMonth['end']]);
    foreach ($stmt->fetchAll() ?: [] as $row) {
        foreach (json_decode($row['procedures'] ?? '[]', true) ?: [] as $procedure) {
            $procedureCounts[$procedure] = ($procedureCounts[$procedure] ?? 0) + 1;
        }
    }
    arsort($procedureCounts);
    $procedureTotal = array_sum($procedureCounts);
    if ($procedureCounts !== [] && $procedureTotal >= APEX_MIN_BASE_FOR_PROCEDURE_INSIGHT) {
        $topProcedure = array_key_first($procedureCounts);
        $topCount = $procedureCounts[$topProcedure];
        $share = (int) round(($topCount / $procedureTotal) * 100);
        $insights[] = ['text' => "{$topProcedure} remains the most requested procedure this month ({$share}% of procedure-tagged leads).", 'kind' => 'fact'];
    } else {
        $insights[] = ['text' => 'Not enough data yet this month to identify a leading procedure.', 'kind' => 'insufficient'];
    }

    $totalLeads = apex_scalar('SELECT COUNT(*) FROM leads');
    $newCount = apex_scalar("SELECT COUNT(*) FROM leads WHERE status = 'new'");
    if ($totalLeads > 0) {
        $share = (int) round(($newCount / $totalLeads) * 100);
        $insights[] = ['text' => "{$newCount} of {$totalLeads} total leads ({$share}%) are still marked as new and awaiting follow-up.", 'kind' => 'fact'];
    }

    return $insights;
}
