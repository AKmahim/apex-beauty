<?php
// Meta Pixel. The ID comes from the admin panel (Site settings) rather than
// being repeated verbatim in every page template.
require_once __DIR__ . '/settings.php';
$apexPixelId = apex_setting('metaPixelId');
if ($apexPixelId === '') {
    return;
}
?>
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '<?= htmlspecialchars($apexPixelId, ENT_QUOTES) ?>');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=<?= htmlspecialchars($apexPixelId, ENT_QUOTES) ?>&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
