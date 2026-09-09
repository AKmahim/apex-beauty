<?php
declare(strict_types=1);

// Shown when a blog URL does not resolve: an unknown slug, a draft, or a post
// that has not been written in the language being requested. It is a real 404
// with a noindex tag, so Google never files an empty page under a URL that
// might later hold a real article.

require_once __DIR__ . '/site-config.php';
require_once __DIR__ . '/i18n.php';
require_once __DIR__ . '/blog.php';
require_once __DIR__ . '/seo.php';

$currentLang = apex_current_lang();
$langBase = apex_lang_base();
$nf = static fn(string $de, string $en): string => $currentLang === 'en' ? $en : $de;

$seoPage = '';
$seoNoindex = true;
$seoCanonicalPath = apex_blog_index_path('de');
$seoTitle = $nf('Artikel nicht gefunden', 'Article not found') . ' | ' . APEX_BUSINESS_NAME;
$seoDescription = $nf(
    'Dieser Artikel existiert nicht oder ist noch nicht veroeffentlicht.',
    'This article does not exist or has not been published yet.'
);
ob_start();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($currentLang, ENT_QUOTES) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/assets/lotus-transparent.png" type="image/png">
<title><?= htmlspecialchars($seoTitle, ENT_QUOTES) ?></title>
<?php require __DIR__ . '/site-meta.php'; ?>
<script src="/assets/cookie-consent.js"></script>
<style>
  :root { --teal-400: #38bdf8; --teal-500: #0ea5e9; --blue-600: #2563eb; --ink: #0f2027; }
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: -apple-system, BlinkMacSystemFont, "Inter", "Segoe UI", sans-serif; color: var(--ink); background: #fff; }
  .nf {
    min-height: 68vh; display: flex; flex-direction: column; align-items: center; justify-content: center;
    text-align: center; padding: 90px 24px;
    background: linear-gradient(160deg, #0b1b2b 0%, #12304d 60%, #0f2740 100%); color: #fff;
  }
  .nf h1 { font-size: clamp(26px, 4vw, 38px); font-weight: 800; margin-bottom: 14px; }
  .nf p { color: #c7dbeb; font-size: 16px; line-height: 1.65; max-width: 520px; margin-bottom: 28px; }
  .nf a {
    display: inline-block; background: linear-gradient(135deg, var(--teal-500), var(--blue-600));
    color: #fff; text-decoration: none; font-weight: 700; font-size: 15px; padding: 13px 28px; border-radius: 999px;
  }
</style>
</head>
<body>
<?php
$siteHeaderMode = 'full';
$siteActivePage = 'blog';
$siteSectionBase = ($langBase === '' ? '/' : $langBase);
$siteHomeHref = ($langBase === '' ? '/' : $langBase);
include __DIR__ . '/site-header.php';
?>
<main class="nf">
  <h1><?= htmlspecialchars($nf('Diesen Artikel gibt es nicht', 'That article does not exist'), ENT_QUOTES) ?></h1>
  <p><?= htmlspecialchars($nf(
      'Der Link ist vielleicht veraltet oder der Beitrag wurde noch nicht veroeffentlicht. Im Ratgeber finden Sie alle aktuellen Artikel.',
      'The link may be outdated, or the post has not been published yet. All current articles are in the guide.'
  ), ENT_QUOTES) ?></p>
  <a href="/<?= htmlspecialchars(apex_blog_index_path(), ENT_QUOTES) ?>"><?= htmlspecialchars($nf('Zum Ratgeber', 'Go to the guide'), ENT_QUOTES) ?></a>
</main>
<?php include __DIR__ . '/site-footer.php'; ?>
</body>
</html>
<?php echo apex_localize_output((string) ob_get_clean(), $currentLang); ?>
