<?php

declare(strict_types=1);

// Served at /sitemap.xml (see .htaccess). Generated from the live CMS content
// rather than hand-maintained, so a page switched to noindex in the admin
// panel disappears from here, and editing copy updates its <lastmod>.
require_once __DIR__ . '/includes/seo.php';

header('Content-Type: application/xml; charset=utf-8');
echo apex_sitemap_xml();
