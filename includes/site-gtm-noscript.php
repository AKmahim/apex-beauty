<?php
// Google Tag Manager, body half. Must be the first thing inside <body>.
require_once __DIR__ . '/settings.php';
$apexGtmId = apex_setting('gtmId');
if ($apexGtmId === '') {
    return;
}
?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe class="u-26" src="https://www.googletagmanager.com/ns.html?id=<?= htmlspecialchars($apexGtmId, ENT_QUOTES) ?>"
height="0" width="0"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
