<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/db.php';

if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "This importer must be run from the command line.\n");
    exit(1);
}

$sqlitePath = $argv[1] ?? (APEX_DATA_DIR . '/leads.sqlite');
if (!is_file($sqlitePath)) {
    fwrite(STDERR, "SQLite file not found: {$sqlitePath}\n");
    exit(1);
}

if (!in_array('sqlite', PDO::getAvailableDrivers(), true)) {
    fwrite(STDERR, "PDO SQLite is not available in this PHP runtime. Run the importer on a machine with pdo_sqlite enabled.\n");
    exit(1);
}

try {
    $source = new PDO('sqlite:' . $sqlitePath);
    $source->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $source->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $target = apex_db();
    $target->beginTransaction();

    $rows = $source->query('SELECT * FROM leads ORDER BY id ASC')->fetchAll();
    $stmt = $target->prepare(
        'INSERT INTO leads (
            id, name, email, country, phone, gender, procedures, therapies, timing,
            notes, photos_uploaded, coupon, marketing_opt_in, lang,
            utm_source, utm_medium, utm_campaign,
            tracking_consent, event_id, ip_address, user_agent, fbp, fbc,
            status, submitted_at, created_at
        ) VALUES (
            :id, :name, :email, :country, :phone, :gender, :procedures, :therapies, :timing,
            :notes, :photos_uploaded, :coupon, :marketing_opt_in, :lang,
            :utm_source, :utm_medium, :utm_campaign,
            :tracking_consent, :event_id, :ip_address, :user_agent, :fbp, :fbc,
            :status, :submitted_at, :created_at
        ) ON DUPLICATE KEY UPDATE
            name = VALUES(name),
            email = VALUES(email),
            country = VALUES(country),
            phone = VALUES(phone),
            gender = VALUES(gender),
            procedures = VALUES(procedures),
            therapies = VALUES(therapies),
            timing = VALUES(timing),
            notes = VALUES(notes),
            photos_uploaded = VALUES(photos_uploaded),
            coupon = VALUES(coupon),
            marketing_opt_in = VALUES(marketing_opt_in),
            lang = VALUES(lang),
            utm_source = VALUES(utm_source),
            utm_medium = VALUES(utm_medium),
            utm_campaign = VALUES(utm_campaign),
            tracking_consent = VALUES(tracking_consent),
            event_id = VALUES(event_id),
            ip_address = VALUES(ip_address),
            user_agent = VALUES(user_agent),
            fbp = VALUES(fbp),
            fbc = VALUES(fbc),
            status = VALUES(status),
            submitted_at = VALUES(submitted_at),
            created_at = VALUES(created_at)'
    );

    $imported = 0;
    foreach ($rows as $row) {
        $stmt->execute([
            ':id' => (int) $row['id'],
            ':name' => $row['name'],
            ':email' => $row['email'],
            ':country' => $row['country'] ?: null,
            ':phone' => $row['phone'] ?: null,
            ':gender' => $row['gender'] ?: null,
            ':procedures' => $row['procedures'] ?: '[]',
            ':therapies' => $row['therapies'] ?: '[]',
            ':timing' => $row['timing'] ?: null,
            ':notes' => $row['notes'] ?: null,
            ':photos_uploaded' => (int) ($row['photos_uploaded'] ?? 0),
            ':coupon' => $row['coupon'] ?: null,
            ':marketing_opt_in' => (int) ($row['marketing_opt_in'] ?? 0),
            ':lang' => $row['lang'] ?: null,
            ':utm_source' => $row['utm_source'] ?: null,
            ':utm_medium' => $row['utm_medium'] ?: null,
            ':utm_campaign' => $row['utm_campaign'] ?: null,
            ':tracking_consent' => (int) ($row['tracking_consent'] ?? 0),
            ':event_id' => $row['event_id'] ?: null,
            ':ip_address' => $row['ip_address'] ?: null,
            ':user_agent' => $row['user_agent'] ?: null,
            ':fbp' => $row['fbp'] ?: null,
            ':fbc' => $row['fbc'] ?: null,
            ':status' => in_array($row['status'] ?? 'new', APEX_LEAD_STATUSES, true) ? $row['status'] : 'new',
            ':submitted_at' => apex_to_mysql_datetime($row['submitted_at'] ?? null),
            ':created_at' => apex_to_mysql_datetime($row['created_at'] ?? null),
        ]);
        $imported++;
    }

    $maxId = (int) $target->query('SELECT COALESCE(MAX(id), 0) FROM leads')->fetchColumn();
    $target->exec('ALTER TABLE leads AUTO_INCREMENT = ' . ($maxId + 1));
    $target->commit();

    fwrite(STDOUT, "Imported {$imported} leads from {$sqlitePath} into MySQL.\n");
    exit(0);
} catch (Throwable $e) {
    if (isset($target) && $target instanceof PDO && $target->inTransaction()) {
        $target->rollBack();
    }
    fwrite(STDERR, 'Import failed: ' . $e->getMessage() . "\n");
    exit(1);
}