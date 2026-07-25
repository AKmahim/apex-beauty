<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

const APEX_LEAD_STATUSES = ['new', 'contacted', 'converted', 'lost'];
const APEX_MIN_BASE_FOR_TREND = 5;
const APEX_MIN_BASE_FOR_COUNTRY_TREND = 3;
const APEX_MIN_BASE_FOR_PROCEDURE_INSIGHT = 3;

// ---- Forecasting / anomaly detection / suggestions thresholds ----
// (all just statistical guardrails so the engine stays quiet instead of
// guessing confidently from too little data)
const APEX_FORECAST_HISTORY_DAYS = 56;   // 8 weeks of daily data feeds the trend + seasonality fit
const APEX_FORECAST_PROJECT_DAYS = 14;   // how far ahead the forecast chart projects
const APEX_FORECAST_MIN_ACTIVE_DAYS = 10; // days with >0 leads required before trusting the forecast
const APEX_ANOMALY_Z_THRESHOLD = 2.0;     // |z| >= this counts as a statistical anomaly
const APEX_ANOMALY_MIN_BASELINE_STD = 0.5; // skip near-constant baselines (any blip would "anomaly")
const APEX_ANOMALY_MIN_SEGMENT_MEAN = 2.0; // skip segments too sparse to say anything meaningful
const APEX_BACKLOG_HOURS = 48;            // "new" leads older than this are a follow-up risk
const APEX_CONVERSION_MIN_AGE_DAYS = 14;  // leads need this long to reach a terminal status
const APEX_CONVERSION_MIN_SAMPLE = 8;     // minimum decided (converted+lost) leads per segment
const APEX_CONVERSION_SIG_DIFF_POINTS = 15; // percentage-point gap vs overall to call out
const APEX_PROCEDURE_TREND_MIN_BASE = 3;
const APEX_PROCEDURE_TREND_SIG_PCT = 25;

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

/**
 * Zero-filled daily lead counts for the last $days days (oldest first),
 * ending today. Shared by the stats trend chart, the forecast, and
 * anomaly detection so they all agree on what "a day" means.
 */
function apex_daily_series(int $days): array
{
    $rows = apex_group_counts(
        "SELECT date(submitted_at) AS day, COUNT(*) AS n
         FROM leads
         WHERE submitted_at >= UTC_TIMESTAMP() - INTERVAL {$days} DAY
         GROUP BY day"
    );
    $map = [];
    foreach ($rows as $row) {
        $map[$row['day']] = (int) $row['n'];
    }
    $series = [];
    for ($i = $days - 1; $i >= 0; $i--) {
        $key = gmdate('Y-m-d', strtotime('-' . $i . ' days'));
        $series[] = ['date' => $key, 'n' => $map[$key] ?? 0];
    }
    return $series;
}

function apex_mean(array $values): float
{
    $n = count($values);
    return $n > 0 ? array_sum($values) / $n : 0.0;
}

function apex_stddev(array $values): float
{
    $n = count($values);
    if ($n < 2) {
        return 0.0;
    }
    $mean = apex_mean($values);
    $sumSq = 0.0;
    foreach ($values as $v) {
        $sumSq += ($v - $mean) ** 2;
    }
    return sqrt($sumSq / ($n - 1));
}

/**
 * Ordinary least-squares fit of $ys against implied x = 0..n-1.
 * Returns [slope, intercept]. Degenerate inputs (too few points, or a
 * single repeated x — which can't happen here, but defensively) fall
 * back to a flat line at the mean rather than dividing by zero.
 */
function apex_linreg(array $ys): array
{
    $n = count($ys);
    if ($n < 2) {
        return [0.0, $n ? (float) reset($ys) : 0.0];
    }
    $sumX = 0; $sumY = 0.0; $sumXY = 0.0; $sumX2 = 0;
    foreach (array_values($ys) as $x => $y) {
        $sumX += $x;
        $sumY += $y;
        $sumXY += $x * $y;
        $sumX2 += $x * $x;
    }
    $denom = ($n * $sumX2) - ($sumX * $sumX);
    if (abs($denom) < 1e-9) {
        return [0.0, apex_mean($ys)];
    }
    $slope = (($n * $sumXY) - ($sumX * $sumY)) / $denom;
    $intercept = ($sumY - $slope * $sumX) / $n;
    return [$slope, $intercept];
}

/** UTC Monday-Sunday week bounds, $weeksAgo=0 is the current (partial) week. */
function apex_weekly_bounds(int $weeksAgo): array
{
    $now = new DateTimeImmutable('now', new DateTimeZone('UTC'));
    $isoDow = (int) $now->format('N'); // 1 (Mon) .. 7 (Sun)
    $mondayThisWeek = $now->modify('-' . ($isoDow - 1) . ' days')->setTime(0, 0, 0);
    $start = $mondayThisWeek->modify('-' . ($weeksAgo * 7) . ' days');
    $end = $start->modify('+7 days');
    return ['start' => $start->format(DATE_ATOM), 'end' => $end->format(DATE_ATOM)];
}

function apex_procedure_counts_in_range(string $start, string $end): array
{
    $stmt = apex_db()->prepare('SELECT procedures FROM leads WHERE submitted_at >= :start AND submitted_at < :end');
    $stmt->execute([':start' => $start, ':end' => $end]);
    $counts = [];
    foreach ($stmt->fetchAll() ?: [] as $row) {
        foreach (json_decode($row['procedures'] ?? '[]', true) ?: [] as $procedure) {
            $counts[$procedure] = ($counts[$procedure] ?? 0) + 1;
        }
    }
    return $counts;
}

function apex_get_stats(): array
{
    $total = apex_scalar('SELECT COUNT(*) FROM leads');
    $last7Days = apex_scalar("SELECT COUNT(*) FROM leads WHERE submitted_at >= UTC_TIMESTAMP() - INTERVAL 7 DAY");
    $prev7Days = apex_scalar("SELECT COUNT(*) FROM leads WHERE submitted_at >= UTC_TIMESTAMP() - INTERVAL 14 DAY AND submitted_at < UTC_TIMESTAMP() - INTERVAL 7 DAY");
    $last30Days = apex_scalar("SELECT COUNT(*) FROM leads WHERE submitted_at >= UTC_TIMESTAMP() - INTERVAL 30 DAY");
    $marketingOptIns = apex_scalar('SELECT COUNT(*) FROM leads WHERE marketing_opt_in = 1');
    $withPhotos = apex_scalar('SELECT COUNT(*) FROM leads WHERE photos_uploaded > 0');

    $byGender = apex_group_counts("SELECT COALESCE(gender,'unspecified') AS `key`, COUNT(*) AS n FROM leads GROUP BY `key` ORDER BY n DESC");
    $byTiming = apex_group_counts("SELECT COALESCE(timing,'unspecified') AS `key`, COUNT(*) AS n FROM leads GROUP BY `key` ORDER BY n DESC");
    $byCountry = apex_group_counts("SELECT COALESCE(country,'unspecified') AS `key`, COUNT(*) AS n FROM leads GROUP BY `key` ORDER BY n DESC");
    $byUtmSource = apex_group_counts("SELECT COALESCE(utm_source,'direct') AS `key`, COUNT(*) AS n FROM leads GROUP BY `key` ORDER BY n DESC");
    $byStatus = apex_group_counts("SELECT status AS `key`, COUNT(*) AS n FROM leads GROUP BY `key` ORDER BY n DESC");

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

    $dailyTrend = apex_daily_series(30);

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

    $procedureCounts = apex_procedure_counts_in_range($thisMonth['start'], $thisMonth['end']);
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

/**
 * Lead-volume forecast: fits a linear trend on day-of-week-deseasonalized
 * history (so a normal Monday dip doesn't look like a decline), then
 * reseasonalizes the projection and derives a rough confidence band from
 * the fit's residual spread. Statistical extrapolation, not machine
 * learning — no external model, just least-squares + z-based bands.
 */
function apex_get_forecast(): array
{
    $historyDays = APEX_FORECAST_HISTORY_DAYS;
    $history = apex_daily_series($historyDays);
    $counts = array_column($history, 'n');

    $activeDays = count(array_filter($counts, static fn(int $n): bool => $n > 0));
    $enoughHistory = $activeDays >= APEX_FORECAST_MIN_ACTIVE_DAYS;

    $overallMean = apex_mean($counts);
    $dowSums = array_fill(0, 7, 0.0);
    $dowCounts = array_fill(0, 7, 0);
    foreach ($history as $point) {
        $dow = (int) gmdate('w', strtotime($point['date'])); // 0=Sun..6=Sat
        $dowSums[$dow] += $point['n'];
        $dowCounts[$dow]++;
    }
    $dowFactor = array_fill(0, 7, 1.0);
    if ($overallMean > 0) {
        for ($d = 0; $d < 7; $d++) {
            if ($dowCounts[$d] > 0) {
                $dowAvg = $dowSums[$d] / $dowCounts[$d];
                $dowFactor[$d] = $dowAvg > 0 ? $dowAvg / $overallMean : 1.0;
            }
        }
    }
    $safeFactor = static fn(int $dow): float => $dowFactor[$dow] > 0.05 ? $dowFactor[$dow] : 1.0;

    $deseasonalized = [];
    foreach ($history as $point) {
        $dow = (int) gmdate('w', strtotime($point['date']));
        $deseasonalized[] = $point['n'] / $safeFactor($dow);
    }
    [$slope, $intercept] = apex_linreg($deseasonalized);

    $residuals = [];
    foreach (array_values($deseasonalized) as $x => $value) {
        $residuals[] = $value - ($intercept + $slope * $x);
    }
    $residualStd = apex_stddev($residuals);
    $z80 = 1.2816; // ~80% interval, wide enough to be honest with this little math behind it

    $projection = [];
    $totalNext30 = 0.0;
    $totalNext30Low = 0.0;
    $totalNext30High = 0.0;
    $horizonDays = max(APEX_FORECAST_PROJECT_DAYS, 30);
    for ($i = 1; $i <= $horizonDays; $i++) {
        $dayIndex = $historyDays - 1 + $i;
        $date = gmdate('Y-m-d', strtotime("+{$i} days"));
        $factor = $safeFactor((int) gmdate('w', strtotime($date)));
        $point = max(0.0, ($intercept + $slope * $dayIndex) * $factor);
        $margin = $z80 * $residualStd * $factor;
        $low = max(0.0, $point - $margin);
        $high = $point + $margin;

        if ($i <= APEX_FORECAST_PROJECT_DAYS) {
            $projection[] = ['date' => $date, 'n' => round($point, 1), 'low' => round($low, 1), 'high' => round($high, 1)];
        }
        if ($i <= 30) {
            $totalNext30 += $point;
            $totalNext30Low += $low;
            $totalNext30High += $high;
        }
    }

    $last30Actual = apex_scalar('SELECT COUNT(*) FROM leads WHERE submitted_at >= UTC_TIMESTAMP() - INTERVAL 30 DAY');
    $changeVsLast30Pct = $last30Actual > 0 ? (int) round((($totalNext30 - $last30Actual) / $last30Actual) * 100) : null;

    return [
        'enoughHistory' => $enoughHistory,
        'history' => $history,
        'projection' => $projection,
        'totalNext30' => (int) round($totalNext30),
        'totalNext30Low' => (int) round($totalNext30Low),
        'totalNext30High' => (int) round($totalNext30High),
        'last30Actual' => $last30Actual,
        'changeVsLast30Pct' => $changeVsLast30Pct,
        'trendDirection' => $slope > 0.02 ? 'up' : ($slope < -0.02 ? 'down' : 'flat'),
    ];
}

/**
 * Statistical anomaly detection (z-score vs a rolling baseline) at two
 * granularities: individual recent days, and this-week-vs-trailing-4-weeks
 * per traffic source / procedure. Flags genuine outliers, not just "went
 * up" — a baseline that's too flat or too sparse is skipped rather than
 * treated as a false signal.
 */
function apex_get_anomalies(): array
{
    $anomalies = apex_daily_anomalies();
    $anomalies = array_merge($anomalies, apex_column_weekly_anomalies('utm_source', 'source'));
    $anomalies = array_merge($anomalies, apex_procedure_weekly_anomalies());
    return $anomalies;
}

function apex_daily_anomalies(): array
{
    $recentDays = 7;
    $baselineDays = 21;
    $lookback = $recentDays + $baselineDays;
    $series = apex_daily_series($lookback);

    $anomalies = [];
    for ($i = $baselineDays; $i < $lookback; $i++) {
        $baselineValues = array_column(array_slice($series, $i - $baselineDays, $baselineDays), 'n');
        $mean = apex_mean($baselineValues);
        $std = apex_stddev($baselineValues);
        if ($std < APEX_ANOMALY_MIN_BASELINE_STD) {
            continue;
        }
        $actual = $series[$i]['n'];
        $z = ($actual - $mean) / $std;
        if (abs($z) >= APEX_ANOMALY_Z_THRESHOLD) {
            $anomalies[] = [
                'scope' => 'day',
                'label' => $series[$i]['date'],
                'actual' => $actual,
                'baselineMean' => round($mean, 1),
                'z' => round($z, 2),
                'direction' => $z > 0 ? 'spike' : 'drop',
            ];
        }
    }
    return $anomalies;
}

function apex_column_weekly_anomalies(string $column, string $scope): array
{
    $weeklyBySeg = [];
    for ($w = 4; $w >= 0; $w--) {
        $bounds = apex_weekly_bounds($w);
        $rows = apex_group_counts(
            "SELECT {$column} AS seg, COUNT(*) AS n FROM leads
             WHERE submitted_at >= :start AND submitted_at < :end
               AND {$column} IS NOT NULL AND {$column} != ''
             GROUP BY seg",
            [':start' => $bounds['start'], ':end' => $bounds['end']]
        );
        foreach ($rows as $row) {
            $weeklyBySeg[$row['seg']][$w] = (int) $row['n'];
        }
    }
    return apex_weekly_anomalies_from_map($weeklyBySeg, $scope);
}

function apex_procedure_weekly_anomalies(): array
{
    $weeklyBySeg = [];
    for ($w = 4; $w >= 0; $w--) {
        $bounds = apex_weekly_bounds($w);
        foreach (apex_procedure_counts_in_range($bounds['start'], $bounds['end']) as $procedure => $n) {
            $weeklyBySeg[$procedure][$w] = $n;
        }
    }
    return apex_weekly_anomalies_from_map($weeklyBySeg, 'procedure');
}

/** @param array<string,array<int,int>> $weeklyBySeg segment => [weeksAgo => count] */
function apex_weekly_anomalies_from_map(array $weeklyBySeg, string $scope): array
{
    $anomalies = [];
    foreach ($weeklyBySeg as $seg => $weeks) {
        $baseline = [];
        for ($w = 4; $w >= 1; $w--) {
            $baseline[] = $weeks[$w] ?? 0;
        }
        $current = $weeks[0] ?? 0;
        $mean = apex_mean($baseline);
        if ($mean < APEX_ANOMALY_MIN_SEGMENT_MEAN) {
            continue;
        }
        $std = apex_stddev($baseline);
        if ($std < APEX_ANOMALY_MIN_BASELINE_STD) {
            continue;
        }
        $z = ($current - $mean) / $std;
        if (abs($z) >= APEX_ANOMALY_Z_THRESHOLD) {
            $anomalies[] = [
                'scope' => $scope,
                'label' => $seg,
                'actual' => $current,
                'baselineMean' => round($mean, 1),
                'z' => round($z, 2),
                'direction' => $z > 0 ? 'spike' : 'drop',
            ];
        }
    }
    return $anomalies;
}

/**
 * Rule-based recommendations, but each rule is gated on a real statistical
 * or volume threshold rather than firing unconditionally — so the list
 * only contains things actually worth a clinic staffer's attention.
 */
function apex_get_suggestions(): array
{
    $suggestions = [];

    $backlogCount = apex_scalar(
        "SELECT COUNT(*) FROM leads WHERE status = 'new' AND submitted_at <= UTC_TIMESTAMP() - INTERVAL " . APEX_BACKLOG_HOURS . ' HOUR'
    );
    if ($backlogCount > 0) {
        $oldestAgeDays = apex_scalar(
            "SELECT COALESCE(TIMESTAMPDIFF(DAY, MIN(submitted_at), UTC_TIMESTAMP()), 0) FROM leads
             WHERE status = 'new' AND submitted_at <= UTC_TIMESTAMP() - INTERVAL " . APEX_BACKLOG_HOURS . ' HOUR'
        );
        $priority = ($backlogCount >= 10 || $oldestAgeDays >= 7) ? 'high' : 'medium';
        $suggestions[] = [
            'kind' => 'risk',
            'priority' => $priority,
            'text' => "{$backlogCount} lead(s) have gone more than " . APEX_BACKLOG_HOURS . " hours without first contact (oldest: {$oldestAgeDays} day(s)). Follow up soon to avoid losing them.",
        ];
    }

    $suggestions = array_merge($suggestions, apex_conversion_suggestions('utm_source', 'traffic source'));
    $suggestions = array_merge($suggestions, apex_procedure_trend_suggestion());

    $forecast = apex_get_forecast();
    if ($forecast['enoughHistory'] && $forecast['last30Actual'] > 0 && $forecast['changeVsLast30Pct'] !== null) {
        $change = $forecast['changeVsLast30Pct'];
        if ($change <= -20) {
            $suggestions[] = [
                'kind' => 'risk',
                'priority' => 'high',
                'text' => "Based on the recent trend, the next 30 days are projected at {$forecast['totalNext30']} leads — {$change}% below the last 30 days ({$forecast['last30Actual']}). Consider a campaign push.",
            ];
        } elseif ($change >= 20) {
            $suggestions[] = [
                'kind' => 'opportunity',
                'priority' => 'medium',
                'text' => "Lead volume is trending up — the next 30 days are projected at {$forecast['totalNext30']} (+{$change}% vs the last 30 days). Make sure follow-up capacity can keep pace.",
            ];
        }
    }

    $dowSuggestion = apex_busiest_weekday_suggestion();
    if ($dowSuggestion !== null) {
        $suggestions[] = $dowSuggestion;
    }

    $priorityRank = ['high' => 0, 'medium' => 1, 'low' => 2];
    usort($suggestions, static fn(array $a, array $b): int => $priorityRank[$a['priority']] <=> $priorityRank[$b['priority']]);

    return $suggestions;
}

function apex_conversion_suggestions(string $column, string $label): array
{
    $minAgeDays = APEX_CONVERSION_MIN_AGE_DAYS;

    $overall = apex_group_counts(
        "SELECT status, COUNT(*) AS n FROM leads
         WHERE submitted_at <= UTC_TIMESTAMP() - INTERVAL {$minAgeDays} DAY
         GROUP BY status"
    );
    $overallDecided = 0;
    $overallConverted = 0;
    foreach ($overall as $row) {
        if ($row['status'] === 'converted') {
            $overallConverted += (int) $row['n'];
            $overallDecided += (int) $row['n'];
        } elseif ($row['status'] === 'lost') {
            $overallDecided += (int) $row['n'];
        }
    }
    if ($overallDecided < APEX_CONVERSION_MIN_SAMPLE) {
        return [];
    }
    $overallRate = $overallConverted / $overallDecided;

    $rows = apex_group_counts(
        "SELECT {$column} AS seg, status, COUNT(*) AS n FROM leads
         WHERE submitted_at <= UTC_TIMESTAMP() - INTERVAL {$minAgeDays} DAY
           AND {$column} IS NOT NULL AND {$column} != ''
         GROUP BY seg, status"
    );
    $bySeg = [];
    foreach ($rows as $row) {
        $bySeg[$row['seg']][$row['status']] = (int) $row['n'];
    }

    $best = null;
    $worst = null;
    foreach ($bySeg as $seg => $counts) {
        $converted = $counts['converted'] ?? 0;
        $lost = $counts['lost'] ?? 0;
        $decided = $converted + $lost;
        if ($decided < APEX_CONVERSION_MIN_SAMPLE) {
            continue;
        }
        $rate = $converted / $decided;
        $diffPoints = ($rate - $overallRate) * 100;
        $entry = ['seg' => $seg, 'rate' => $rate, 'decided' => $decided, 'diffPoints' => $diffPoints];
        if ($worst === null || $diffPoints < $worst['diffPoints']) {
            $worst = $entry;
        }
        if ($best === null || $diffPoints > $best['diffPoints']) {
            $best = $entry;
        }
    }

    $suggestions = [];
    if ($worst !== null && $worst['diffPoints'] <= -APEX_CONVERSION_SIG_DIFF_POINTS) {
        $suggestions[] = [
            'kind' => 'risk',
            'priority' => abs($worst['diffPoints']) >= 25 ? 'high' : 'medium',
            'text' => sprintf(
                "Leads from %s '%s' convert at %d%%, %d points below the overall average of %d%% (based on %d decided leads). Worth reviewing follow-up quality here.",
                $label,
                $worst['seg'],
                (int) round($worst['rate'] * 100),
                (int) round(abs($worst['diffPoints'])),
                (int) round($overallRate * 100),
                $worst['decided']
            ),
        ];
    }
    if ($best !== null && $best['diffPoints'] >= APEX_CONVERSION_SIG_DIFF_POINTS && $best['seg'] !== ($worst['seg'] ?? null)) {
        $suggestions[] = [
            'kind' => 'opportunity',
            'priority' => 'medium',
            'text' => sprintf(
                "Leads from %s '%s' convert at %d%%, %d points above the overall average of %d%% (based on %d decided leads). Consider investing more here.",
                $label,
                $best['seg'],
                (int) round($best['rate'] * 100),
                (int) round($best['diffPoints']),
                (int) round($overallRate * 100),
                $best['decided']
            ),
        ];
    }
    return $suggestions;
}

function apex_procedure_trend_suggestion(): array
{
    $thisMonth = apex_month_bounds(0);
    $lastMonth = apex_month_bounds(-1);
    $thisCounts = apex_procedure_counts_in_range($thisMonth['start'], $thisMonth['end']);
    $lastCounts = apex_procedure_counts_in_range($lastMonth['start'], $lastMonth['end']);

    $best = null;
    foreach ($thisCounts as $procedure => $curr) {
        $prev = $lastCounts[$procedure] ?? 0;
        if ($prev < APEX_PROCEDURE_TREND_MIN_BASE) {
            continue;
        }
        $change = (int) round((($curr - $prev) / $prev) * 100);
        if ($best === null || abs($change) > abs($best['change'])) {
            $best = ['procedure' => $procedure, 'change' => $change, 'curr' => $curr, 'prev' => $prev];
        }
    }
    if ($best === null || abs($best['change']) < APEX_PROCEDURE_TREND_SIG_PCT) {
        return [];
    }

    if ($best['change'] > 0) {
        return [[
            'kind' => 'opportunity',
            'priority' => 'medium',
            'text' => "Interest in {$best['procedure']} is up {$best['change']}% this month ({$best['curr']} vs {$best['prev']}) — consider prioritizing marketing spend or scheduling capacity there.",
        ]];
    }
    return [[
        'kind' => 'risk',
        'priority' => 'low',
        'text' => 'Interest in ' . $best['procedure'] . ' dropped ' . abs($best['change']) . "% this month ({$best['curr']} vs {$best['prev']}).",
    ]];
}

function apex_busiest_weekday_suggestion(): ?array
{
    $series = apex_daily_series(APEX_FORECAST_HISTORY_DAYS);
    $activeDays = count(array_filter(array_column($series, 'n'), static fn(int $n): bool => $n > 0));
    if ($activeDays < APEX_FORECAST_MIN_ACTIVE_DAYS) {
        return null;
    }

    $dowSums = array_fill(1, 7, 0);
    $dowCounts = array_fill(1, 7, 0);
    foreach ($series as $point) {
        $dow = (int) gmdate('N', strtotime($point['date'])); // 1=Mon..7=Sun
        $dowSums[$dow] += $point['n'];
        $dowCounts[$dow]++;
    }
    $dowAvg = [];
    for ($d = 1; $d <= 7; $d++) {
        $dowAvg[$d] = $dowCounts[$d] > 0 ? $dowSums[$d] / $dowCounts[$d] : 0.0;
    }
    $overallAvg = apex_mean($dowAvg);
    if ($overallAvg <= 0) {
        return null;
    }
    $busiestDow = array_keys($dowAvg, max($dowAvg))[0];
    $busiestAvg = $dowAvg[$busiestDow];
    if ($busiestAvg < $overallAvg * 1.25) {
        return null; // not meaningfully different from the average day
    }

    $names = [1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday'];
    return [
        'kind' => 'operational',
        'priority' => 'low',
        'text' => "{$names[$busiestDow]}s bring in the most leads on average (" . round($busiestAvg, 1) . '/day vs ' . round($overallAvg, 1) . ' overall) — make sure follow-up staffing covers that day.',
    ];
}
