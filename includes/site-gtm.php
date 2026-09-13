<?php
// Google Tag Manager, head half. Container ID comes from the admin panel.
require_once __DIR__ . '/settings.php';
$apexGtmId = apex_setting('gtmId');
if ($apexGtmId === '') {
    return;
}
?>
<!-- Google Tag Manager -->
<script nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?= htmlspecialchars($apexGtmId, ENT_QUOTES) ?>');</script>
<!-- End Google Tag Manager -->
