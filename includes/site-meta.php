<?php declare(strict_types=1);

require_once __DIR__ . '/site-config.php';

// Include this once per page, right after that page's own <title> tag, with
// $seoTitle / $seoDescription / $seoCanonicalPath (path only, e.g. 'hairpedia'
// or '' for the homepage) / $seoNoindex (bool) set beforehand.
$seoTitle = $seoTitle ?? APEX_BUSINESS_NAME;
$seoDescription = $seoDescription ?? '';
$seoCanonicalPath = $seoCanonicalPath ?? '';
$seoNoindex = $seoNoindex ?? false;
$seoImage = $seoImage ?? 'assets/wordmark-transparent.png';

$canonicalUrl = rtrim(APEX_SITE_URL, '/') . '/' . ltrim($seoCanonicalPath, '/');
$canonicalUrl = $seoCanonicalPath === '' ? APEX_SITE_URL : rtrim($canonicalUrl, '/');
$imageUrl = rtrim(APEX_SITE_URL, '/') . '/' . ltrim($seoImage, '/');
?>
<meta name="description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES) ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES) ?>">
<meta name="robots" content="<?= $seoNoindex ? 'noindex, nofollow' : 'index, follow' ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= htmlspecialchars(APEX_BUSINESS_NAME, ENT_QUOTES) ?>">
<meta property="og:title" content="<?= htmlspecialchars($seoTitle, ENT_QUOTES) ?>">
<meta property="og:description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES) ?>">
<meta property="og:image" content="<?= htmlspecialchars($imageUrl, ENT_QUOTES) ?>">
<meta property="og:locale" content="de_AT">
<meta property="og:locale:alternate" content="en_US">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($seoTitle, ENT_QUOTES) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES) ?>">
<meta name="twitter:image" content="<?= htmlspecialchars($imageUrl, ENT_QUOTES) ?>">
