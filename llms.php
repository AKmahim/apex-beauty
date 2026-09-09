<?php

declare(strict_types=1);

// Served at /llms.txt (see .htaccess). Page list and package prices come
// straight from the admin panel's content, so the file answer engines read can
// no longer quote a price the site has stopped charging.
require_once __DIR__ . '/includes/seo.php';

header('Content-Type: text/plain; charset=utf-8');
echo apex_llms_txt();
