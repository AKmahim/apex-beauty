<?php declare(strict_types=1);

require_once __DIR__ . '/site-config.php';
require_once __DIR__ . '/i18n.php';
require_once __DIR__ . '/seo.php';
require_once __DIR__ . '/settings.php';

// Include this once per page, right after that page's own <title> tag, with
// $seoPage (the CMS page key, e.g. 'hairpedia') / $seoTitle / $seoDescription
// / $seoCanonicalPath (DE-rooted path, e.g. 'hairpedia' or '' for the
// homepage - the /en equivalent is derived from it) / $seoNoindex (bool) set
// beforehand. Pages get all of those from includes/seo.php, which resolves
// them from the admin panel first and the coded defaults second.
$seoTitle = $seoTitle ?? APEX_BUSINESS_NAME;
$seoDescription = $seoDescription ?? '';
$seoCanonicalPath = $seoCanonicalPath ?? '';
$seoNoindex = $seoNoindex ?? false;
$seoPage = $seoPage ?? '';
// A page with its own share image uploaded in the admin panel uses it;
// everything else falls back to the site wordmark.
$seoImage = $seoImage ?? apex_seo_image($seoPage, apex_setting('defaultShareImage'));

$currentLang = apex_current_lang();
$buildLocalizedUrl = static function (string $langBase) use ($seoCanonicalPath): string {
    $path = trim($langBase . '/' . ltrim($seoCanonicalPath, '/'), '/');
    return $path === '' ? rtrim(APEX_SITE_URL, '/') . '/' : rtrim(APEX_SITE_URL, '/') . '/' . $path;
};
// One URL per language. German is the root and also the x-default, since it is
// the language a visitor with no better match should land on.
$langUrls = ['de' => $buildLocalizedUrl('')];
foreach (APEX_URL_LANGS as $code) {
    $langUrls[$code] = $buildLocalizedUrl('/' . $code);
}
$deUrl = $langUrls['de'];
$canonicalUrl = $langUrls[$currentLang] ?? $deUrl;
$imageUrl = rtrim(APEX_SITE_URL, '/') . '/' . ltrim($seoImage, '/');
?>
<?php if (apex_setting('googleSiteVerification') !== ''): ?>
<meta name="google-site-verification" content="<?= htmlspecialchars(apex_setting('googleSiteVerification'), ENT_QUOTES) ?>">
<?php endif; ?>
<?php if (apex_setting('bingSiteVerification') !== ''): ?>
<meta name="msvalidate.01" content="<?= htmlspecialchars(apex_setting('bingSiteVerification'), ENT_QUOTES) ?>">
<?php endif; ?>
<meta name="description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES) ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES) ?>">
<?php foreach ($langUrls as $hrefLang => $hrefUrl): ?>
<link rel="alternate" hreflang="<?= htmlspecialchars($hrefLang, ENT_QUOTES) ?>" href="<?= htmlspecialchars($hrefUrl, ENT_QUOTES) ?>">
<?php endforeach; ?>
<link rel="alternate" hreflang="x-default" href="<?= htmlspecialchars($deUrl, ENT_QUOTES) ?>">
<meta name="robots" content="<?= $seoNoindex ? 'noindex, nofollow' : 'index, follow' ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= htmlspecialchars(APEX_BUSINESS_NAME, ENT_QUOTES) ?>">
<meta property="og:title" content="<?= htmlspecialchars($seoTitle, ENT_QUOTES) ?>">
<meta property="og:description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES) ?>">
<meta property="og:image" content="<?= htmlspecialchars($imageUrl, ENT_QUOTES) ?>">
<meta property="og:locale" content="<?= htmlspecialchars(apex_locale($currentLang), ENT_QUOTES) ?>">
<?php foreach (array_keys($langUrls) as $altLang): if ($altLang === $currentLang) { continue; } ?>
<meta property="og:locale:alternate" content="<?= htmlspecialchars(apex_locale($altLang), ENT_QUOTES) ?>">
<?php endforeach; ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($seoTitle, ENT_QUOTES) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES) ?>">
<meta name="twitter:image" content="<?= htmlspecialchars($imageUrl, ENT_QUOTES) ?>">
