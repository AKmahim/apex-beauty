<?php

declare(strict_types=1);

// Served at /robots.txt (see .htaccess). The disallow list is derived from the
// same noindex switches that drive sitemap.xml and each page's robots meta
// tag, so the three cannot drift apart.
require_once __DIR__ . '/includes/seo.php';

header('Content-Type: text/plain; charset=utf-8');
echo apex_robots_txt();
