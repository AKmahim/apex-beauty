<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/site-config.php';
require_once __DIR__ . '/includes/i18n.php';
require_once __DIR__ . '/includes/blog.php';
require_once __DIR__ . '/includes/seo.php';
$currentLang = apex_current_lang();
$langBase = apex_lang_base();

$slug = (string) ($_GET['slug'] ?? '');
$post = apex_blog_valid_slug($slug) ? apex_blog_get($slug) : null;

// A draft, a missing post, or one with nothing written in this language is a
// genuine 404 rather than an empty page, so Google never indexes a shell.
if ($post === null || $post['status'] !== 'published' || !apex_blog_has_language($post, $currentLang)) {
    http_response_code(404);
    $seoNoindex = true;
    require __DIR__ . '/includes/blog-not-found.php';
    return;
}

$title = apex_cms_value($post['title'], $currentLang);
$excerpt = apex_cms_value($post['excerpt'], $currentLang);
$body = apex_cms_value($post['body'], $currentLang);
$coverAlt = apex_cms_value($post['coverAlt'], $currentLang);

$seoPage = '';
$seoCanonicalPath = apex_blog_post_path($post['slug'], 'de');
$seoTitle = trim(apex_cms_value($post['seoTitle'], $currentLang)) !== ''
    ? apex_cms_value($post['seoTitle'], $currentLang)
    : strip_tags($title) . ' | ' . APEX_BUSINESS_NAME;
$seoDescription = trim(apex_cms_value($post['seoDescription'], $currentLang)) !== ''
    ? apex_cms_value($post['seoDescription'], $currentLang)
    : strip_tags($excerpt);
$seoNoindex = false;
if ($post['coverImage'] !== '') {
    $seoImage = $post['coverImage'];
}

$t = static fn(string $de, string $en): string => $currentLang === 'en' ? $en : $de;

$postUrl = apex_blog_url(apex_blog_post_path($post['slug']));
$articleSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => strip_tags($title),
    'description' => strip_tags($excerpt),
    'datePublished' => $post['publishedAt'],
    'dateModified' => $post['updatedAt'],
    'inLanguage' => $currentLang,
    'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => $postUrl],
    'author' => ['@type' => 'Organization', 'name' => $post['author']],
    'publisher' => [
        '@type' => 'MedicalOrganization',
        'name' => APEX_BUSINESS_NAME,
        'url' => APEX_SITE_URL,
    ],
];
if ($post['coverImage'] !== '') {
    $articleSchema['image'] = rtrim(APEX_SITE_URL, '/') . '/' . ltrim($post['coverImage'], '/');
}

// Breadcrumbs give Google the path to show under the result instead of a bare
// URL, and they are only honest if they match the links actually on the page.
$breadcrumbSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => APEX_BUSINESS_NAME, 'item' => apex_blog_url('')],
        ['@type' => 'ListItem', 'position' => 2, 'name' => $t('Ratgeber', 'Guide'), 'item' => apex_blog_url(apex_blog_index_path())],
        ['@type' => 'ListItem', 'position' => 3, 'name' => strip_tags($title)],
    ],
];

$related = array_values(array_filter(
    apex_blog_all(true),
    static fn(array $p): bool => $p['slug'] !== $post['slug'] && apex_blog_has_language($p, $currentLang)
));
$related = array_slice($related, 0, 3);

$consultHref = ($langBase === '' ? '' : $langBase) . '/consult';
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
<?php require __DIR__ . '/includes/site-meta.php'; ?>
<meta property="article:published_time" content="<?= htmlspecialchars($post['publishedAt'], ENT_QUOTES) ?>">
<meta property="article:modified_time" content="<?= htmlspecialchars($post['updatedAt'], ENT_QUOTES) ?>">
<script type="application/ld+json"><?= json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php require __DIR__ . '/includes/site-pixel.php'; ?>
<script src="/assets/meta-pixel.js"></script>
<script src="/assets/cookie-consent.js"></script>
<script src="/assets/content-loader.js"></script>
<?php require __DIR__ . '/includes/site-gtm.php'; ?>
<style>
  :root {
    --teal-400: #38bdf8; --teal-500: #0ea5e9; --teal-600: #0284c7; --teal-700: #075985;
    --blue-500: #3b82f6; --blue-600: #2563eb; --blue-700: #1d4ed8; --blue-900: #1e3a5f;
    --ink: #0f2027; --ink-soft: #45596a; --paper: #f7fafd;
  }
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: -apple-system, BlinkMacSystemFont, "Inter", "Segoe UI", sans-serif; color: var(--ink); background: #fff; }
  img { max-width: 100%; display: block; }

  .bp-head { background: linear-gradient(160deg, #0b1b2b 0%, #12304d 60%, #0f2740 100%); color: #fff; padding: 74px 24px 96px; }
  .bp-head-inner { max-width: 760px; margin: 0 auto; }
  .bp-crumbs { font-size: 13px; color: #9dc0da; margin-bottom: 20px; display: flex; gap: 8px; flex-wrap: wrap; }
  .bp-crumbs a { color: #9dc0da; text-decoration: none; }
  .bp-crumbs a:hover { color: var(--teal-400); }
  .bp-head h1 { font-size: clamp(27px, 4.4vw, 42px); line-height: 1.18; font-weight: 800; margin-bottom: 18px; overflow-wrap: anywhere; }
  .bp-head h1 span { color: var(--teal-400); }
  .bp-meta { font-size: 13.5px; color: #c7dbeb; display: flex; gap: 10px; flex-wrap: wrap; }
  .bp-meta .dot { color: #6d90ab; }

  .bp-wrap { max-width: 760px; margin: 0 auto; padding: 0 24px 90px; }
  .bp-cover { margin-top: -58px; border-radius: 20px; overflow: hidden; border: 1px solid #e3edf6; box-shadow: 0 30px 60px -30px rgba(15,39,64,0.4); background: #eef5fb; }
  .bp-cover img { width: 100%; aspect-ratio: 16 / 9; object-fit: cover; }

  .bp-body { margin-top: 44px; font-size: 17px; line-height: 1.75; color: #24404f; overflow-wrap: anywhere; }
  .bp-body > * + * { margin-top: 20px; }
  .bp-body h2 { font-size: clamp(21px, 3vw, 27px); line-height: 1.3; font-weight: 800; color: var(--ink); margin-top: 44px; }
  .bp-body h3 { font-size: clamp(18px, 2.4vw, 21px); line-height: 1.35; font-weight: 750; color: var(--ink); margin-top: 34px; }
  .bp-body ul, .bp-body ol { padding-left: 24px; }
  .bp-body li + li { margin-top: 9px; }
  .bp-body a { color: var(--blue-600); }
  .bp-body img { border-radius: 14px; margin: 30px 0; }
  .bp-body figure { margin: 30px 0; }
  .bp-body figcaption { font-size: 13.5px; color: var(--ink-soft); margin-top: 10px; text-align: center; }
  .bp-body blockquote {
    border-left: 3px solid var(--teal-500); padding: 6px 0 6px 20px; color: var(--ink-soft); font-style: italic;
  }
  .bp-body table { width: 100%; border-collapse: collapse; font-size: 15px; }
  .bp-body th, .bp-body td { border: 1px solid #e3edf6; padding: 10px 12px; text-align: left; overflow-wrap: anywhere; }
  .bp-body th { background: var(--paper); font-weight: 700; }
  .bp-tablescroll { overflow-x: auto; }

  .bp-cta { margin-top: 56px; padding: 42px 30px; background: linear-gradient(150deg, #0b1b2b, #14395c); border-radius: 22px; color: #fff; text-align: center; }
  .bp-cta h2 { font-size: clamp(20px, 3vw, 25px); font-weight: 800; margin-bottom: 12px; }
  .bp-cta p { color: #c7dbeb; font-size: 15px; line-height: 1.65; margin-bottom: 24px; }
  .bp-cta a { display: inline-block; background: linear-gradient(135deg, var(--teal-500), var(--blue-600)); color: #fff; text-decoration: none; font-weight: 700; font-size: 15px; padding: 13px 28px; border-radius: 999px; }

  .bp-related { max-width: 1120px; margin: 0 auto; padding: 0 24px 90px; }
  .bp-related h2 { font-size: 21px; font-weight: 800; margin-bottom: 22px; }
  .bp-related-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 22px; }
  .bp-rel-card { background: #fff; border: 1px solid #e3edf6; border-radius: 16px; overflow: hidden; height: 100%; }
  .bp-rel-card img { width: 100%; aspect-ratio: 16 / 9; object-fit: cover; background: #eef5fb; }
  .bp-rel-body { padding: 18px 20px 22px; min-width: 0; }
  .bp-rel-body h3 { font-size: 16.5px; line-height: 1.35; font-weight: 700; overflow-wrap: anywhere; }
  .bp-rel-body time { font-size: 12.5px; color: var(--ink-soft); display: block; margin-bottom: 8px; }
  a.bp-cardlink { text-decoration: none; color: inherit; display: block; }

  @media (max-width: 640px) {
    .bp-cover { margin-top: -40px; }
    .bp-body { font-size: 16.5px; }
  }
</style>
</head>
<body data-content-page="blog-post">
<?php require __DIR__ . '/includes/site-gtm-noscript.php'; ?>

<?php
$siteHeaderMode = 'full';
$siteActivePage = 'blog';
$siteSectionBase = ($langBase === '' ? '/' : $langBase);
$siteHomeHref = ($langBase === '' ? '/' : $langBase);
include __DIR__ . '/includes/site-header.php';
?>

<article>
<header class="bp-head">
  <div class="bp-head-inner">
    <nav class="bp-crumbs" aria-label="Breadcrumb">
      <a href="<?= htmlspecialchars($langBase === '' ? '/' : $langBase, ENT_QUOTES) ?>"><?= htmlspecialchars(APEX_BUSINESS_NAME, ENT_QUOTES) ?></a>
      <span>/</span>
      <a href="/<?= htmlspecialchars(apex_blog_index_path(), ENT_QUOTES) ?>"><?= htmlspecialchars($t('Ratgeber', 'Guide'), ENT_QUOTES) ?></a>
    </nav>
    <h1><?= strip_tags($title, '<span><em><strong>') ?></h1>
    <div class="bp-meta">
      <time datetime="<?= htmlspecialchars($post['publishedAt'], ENT_QUOTES) ?>"><?= htmlspecialchars($post['publishedAt'], ENT_QUOTES) ?></time>
      <span class="dot">&middot;</span>
      <span><?= (int) apex_blog_reading_minutes($post, $currentLang) ?> <?= htmlspecialchars($t('Min. Lesezeit', 'min read'), ENT_QUOTES) ?></span>
      <span class="dot">&middot;</span>
      <span><?= htmlspecialchars($post['author'], ENT_QUOTES) ?></span>
    </div>
  </div>
</header>

<div class="bp-wrap">
  <?php if ($post['coverImage'] !== ''): ?>
  <div class="bp-cover">
    <img src="/<?= htmlspecialchars(ltrim($post['coverImage'], '/'), ENT_QUOTES) ?>" alt="<?= htmlspecialchars($coverAlt !== '' ? $coverAlt : strip_tags($title), ENT_QUOTES) ?>" width="1200" height="675">
  </div>
  <?php endif; ?>

  <div class="bp-body"><?= $body ?></div>

  <section class="bp-cta">
    <h2><?= htmlspecialchars($t('Wie sieht Ihre Haarsituation aus?', 'What does your hair situation look like?'), ENT_QUOTES) ?></h2>
    <p><?= htmlspecialchars($t(
      'In einer kostenlosen Analyse sagen wir Ihnen ehrlich, was in Ihrem Fall realistisch ist.',
      'In a free analysis we tell you honestly what is realistic in your case.'
    ), ENT_QUOTES) ?></p>
    <a href="<?= htmlspecialchars($consultHref, ENT_QUOTES) ?>"><?= htmlspecialchars($t('Kostenlose Beratung sichern', 'Book a free consultation'), ENT_QUOTES) ?></a>
  </section>
</div>
</article>

<?php if ($related !== []): ?>
<section class="bp-related">
  <h2><?= htmlspecialchars($t('Weitere Artikel', 'More articles'), ENT_QUOTES) ?></h2>
  <div class="bp-related-grid">
    <?php foreach ($related as $rel):
      $rTitle = apex_cms_value($rel['title'], $currentLang);
      $rAlt = apex_cms_value($rel['coverAlt'], $currentLang);
    ?>
    <a class="bp-cardlink" href="/<?= htmlspecialchars(apex_blog_post_path($rel['slug']), ENT_QUOTES) ?>">
      <article class="bp-rel-card">
        <?php if ($rel['coverImage'] !== ''): ?>
        <img src="/<?= htmlspecialchars(ltrim($rel['coverImage'], '/'), ENT_QUOTES) ?>" alt="<?= htmlspecialchars($rAlt !== '' ? $rAlt : strip_tags($rTitle), ENT_QUOTES) ?>" width="600" height="338" loading="lazy">
        <?php endif; ?>
        <div class="bp-rel-body">
          <time datetime="<?= htmlspecialchars($rel['publishedAt'], ENT_QUOTES) ?>"><?= htmlspecialchars($rel['publishedAt'], ENT_QUOTES) ?></time>
          <h3><?= strip_tags($rTitle, '<span><em><strong>') ?></h3>
        </div>
      </article>
    </a>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<?php include __DIR__ . '/includes/site-footer.php'; ?>
<?php include __DIR__ . '/includes/apex-ai-widget.php'; ?>

</body>
</html>
<?php echo apex_localize_output((string) ob_get_clean(), $currentLang); ?>
