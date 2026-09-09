<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/site-config.php';
require_once __DIR__ . '/includes/i18n.php';
require_once __DIR__ . '/includes/content.php';
require_once __DIR__ . '/includes/blog.php';
require_once __DIR__ . '/includes/seo.php';
$currentLang = apex_current_lang();
$langBase = apex_lang_base();
// Title, description, share image and the Google visibility switch are edited
// in the admin panel under Website content > Search engine listing; the
// fallbacks live in includes/seo.php.
$seoPage = 'blog';
$seoTitle = apex_seo_title($seoPage);
$seoDescription = apex_seo_description($seoPage);
$seoCanonicalPath = apex_seo_path($seoPage);
$seoNoindex = apex_seo_noindex($seoPage);

// Only posts that actually have a title and a body in this language are shown,
// so a post drafted in German alone never appears as a blank card on /en.
$posts = array_values(array_filter(
    apex_blog_all(true),
    static fn(array $post): bool => apex_blog_has_language($post, $currentLang)
));
$featured = $posts[0] ?? null;
$rest = array_slice($posts, 1);

$t = static function (string $de, string $en) use ($currentLang): string {
    return $currentLang === 'en' ? $en : $de;
};

// Wrapper copy for the archive comes from the admin panel (Website content >
// Guide / blog page). The articles themselves live in the Blog tab.
$blogContent = apex_get_page_content('blog') ?? [];
$blHero = $blogContent['hero'] ?? [];
$blCta = $blogContent['cta'] ?? [];

$blogSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Blog',
    'name' => $seoTitle,
    'description' => $seoDescription,
    'url' => apex_blog_url(apex_blog_index_path()),
    'publisher' => ['@type' => 'MedicalOrganization', 'name' => APEX_BUSINESS_NAME, 'url' => APEX_SITE_URL],
    'blogPost' => array_map(static function (array $post) use ($currentLang): array {
        return [
            '@type' => 'BlogPosting',
            'headline' => strip_tags(apex_cms_value($post['title'], $currentLang)),
            'url' => apex_blog_url(apex_blog_post_path($post['slug'])),
            'datePublished' => $post['publishedAt'],
        ];
    }, array_slice($posts, 0, 10)),
];

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
<script type="application/ld+json"><?= json_encode($blogSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
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

  .bl-hero {
    background: linear-gradient(160deg, #0b1b2b 0%, #12304d 55%, #0f2740 100%);
    color: #fff; padding: 96px 24px 108px; text-align: center; position: relative; overflow: hidden;
  }
  .bl-hero::after {
    content: ''; position: absolute; inset: auto -10% -60% -10%; height: 220px;
    background: radial-gradient(60% 100% at 50% 0%, rgba(56,189,248,0.28), transparent 70%);
    pointer-events: none;
  }
  .bl-hero-inner { max-width: 780px; margin: 0 auto; position: relative; z-index: 1; }
  .bl-eyebrow {
    display: inline-block; font-size: 12px; letter-spacing: 0.14em; text-transform: uppercase;
    font-weight: 700; color: var(--teal-400); border: 1px solid rgba(56,189,248,0.35);
    background: rgba(56,189,248,0.1); border-radius: 999px; padding: 7px 16px; margin-bottom: 22px;
  }
  .bl-hero h1 { font-size: clamp(30px, 5vw, 46px); line-height: 1.14; font-weight: 800; margin-bottom: 18px; overflow-wrap: anywhere; }
  .bl-hero h1 span { color: var(--teal-400); }
  .bl-hero p { font-size: clamp(15px, 2vw, 17.5px); line-height: 1.65; color: #c7dbeb; }

  .bl-wrap { max-width: 1120px; margin: 0 auto; padding: 0 24px 96px; }
  .bl-feature {
    display: grid; grid-template-columns: 1.15fr 1fr; gap: 0; align-items: stretch;
    background: #fff; border: 1px solid #e3edf6; border-radius: 22px; overflow: hidden;
    margin-top: -56px; position: relative; z-index: 2;
    box-shadow: 0 30px 60px -30px rgba(15,39,64,0.35);
  }
  .bl-feature-media { background: #eef5fb; min-height: 300px; }
  .bl-feature-media img { width: 100%; height: 100%; object-fit: cover; }
  .bl-feature-body { padding: 38px 38px 34px; display: flex; flex-direction: column; justify-content: center; min-width: 0; }
  .bl-meta { font-size: 12.5px; color: var(--ink-soft); display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 14px; }
  .bl-meta .dot { color: #c3d4e3; }
  .bl-feature-body h2 { font-size: clamp(22px, 3vw, 29px); line-height: 1.25; font-weight: 800; margin-bottom: 14px; overflow-wrap: anywhere; }
  .bl-feature-body p { font-size: 15.5px; line-height: 1.7; color: var(--ink-soft); margin-bottom: 22px; }
  .bl-readmore { font-weight: 700; font-size: 14.5px; color: var(--blue-600); text-decoration: none; }
  .bl-readmore:hover { color: var(--teal-700); }
  a.bl-cardlink { text-decoration: none; color: inherit; display: block; }

  .bl-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 26px; margin-top: 46px; }
  .bl-card {
    background: #fff; border: 1px solid #e3edf6; border-radius: 18px; overflow: hidden;
    display: flex; flex-direction: column; height: 100%; transition: transform 0.18s, box-shadow 0.18s;
  }
  .bl-card:hover { transform: translateY(-4px); box-shadow: 0 22px 40px -22px rgba(15,39,64,0.3); }
  .bl-card-media { aspect-ratio: 16 / 9; background: #eef5fb; }
  .bl-card-media img { width: 100%; height: 100%; object-fit: cover; }
  .bl-card-body { padding: 22px 22px 24px; display: flex; flex-direction: column; flex: 1; min-width: 0; }
  .bl-card-body h3 { font-size: 18.5px; line-height: 1.35; font-weight: 750; margin-bottom: 10px; overflow-wrap: anywhere; }
  .bl-card-body p { font-size: 14.5px; line-height: 1.65; color: var(--ink-soft); margin-bottom: 18px; flex: 1; }

  .bl-empty {
    margin-top: 60px; text-align: center; padding: 64px 28px; border: 1px dashed #cfe0ee;
    border-radius: 18px; color: var(--ink-soft); background: var(--paper);
  }

  .bl-cta {
    margin-top: 70px; text-align: center; padding: 54px 30px;
    background: linear-gradient(150deg, #0b1b2b, #14395c); border-radius: 24px; color: #fff;
  }
  .bl-cta h2 { font-size: clamp(21px, 3vw, 28px); font-weight: 800; margin-bottom: 12px; }
  .bl-cta p { color: #c7dbeb; font-size: 15.5px; line-height: 1.65; max-width: 560px; margin: 0 auto 26px; }
  .bl-cta a {
    display: inline-block; background: linear-gradient(135deg, var(--teal-500), var(--blue-600));
    color: #fff; text-decoration: none; font-weight: 700; font-size: 15px;
    padding: 14px 30px; border-radius: 999px;
  }

  @media (max-width: 860px) {
    .bl-feature { grid-template-columns: 1fr; margin-top: -40px; }
    .bl-feature-media { min-height: 220px; aspect-ratio: 16 / 9; }
    .bl-feature-body { padding: 28px 24px; }
  }
  @media (prefers-reduced-motion: reduce) {
    .bl-card { transition: none; }
    .bl-card:hover { transform: none; }
  }
</style>
</head>
<body data-content-page="blog">
<?php require __DIR__ . '/includes/site-gtm-noscript.php'; ?>

<?php
$siteHeaderMode = 'full';
$siteActivePage = 'blog';
$siteSectionBase = ($langBase === '' ? '/' : $langBase);
$siteHomeHref = ($langBase === '' ? '/' : $langBase);
include __DIR__ . '/includes/site-header.php';
?>

<section class="bl-hero">
  <div class="bl-hero-inner">
    <span class="bl-eyebrow"<?= apex_cms_attrs($blHero['eyebrow'] ?? null) ?>><?= apex_cms_value($blHero['eyebrow'] ?? null, $currentLang) ?: htmlspecialchars($t('Ratgeber', 'Guide'), ENT_QUOTES) ?></span>
    <h1<?= apex_cms_attrs($blHero['heading'] ?? null) ?>><?= apex_cms_value($blHero['heading'] ?? null, $currentLang) ?: $t('Wissen zu <span>Haarausfall</span> und Haartransplantation', 'Knowledge on <span>hair loss</span> and hair transplantation') ?></h1>
    <p<?= apex_cms_attrs($blHero['sub'] ?? null) ?>><?= apex_cms_value($blHero['sub'] ?? null, $currentLang) ?></p>
  </div>
</section>

<div class="bl-wrap">
<?php if ($featured === null): ?>
  <div class="bl-empty">
    <?= htmlspecialchars($t('Die ersten Artikel erscheinen in Kürze.', 'The first articles are coming shortly.'), ENT_QUOTES) ?>
  </div>
<?php else: ?>
  <?php
  $fTitle = apex_cms_value($featured['title'], $currentLang);
  $fExcerpt = apex_cms_value($featured['excerpt'], $currentLang);
  $fAlt = apex_cms_value($featured['coverAlt'], $currentLang);
  $fHref = '/' . apex_blog_post_path($featured['slug']);
  ?>
  <a class="bl-cardlink" href="<?= htmlspecialchars($fHref, ENT_QUOTES) ?>">
    <article class="bl-feature">
      <?php if ($featured['coverImage'] !== ''): ?>
      <div class="bl-feature-media">
        <img src="/<?= htmlspecialchars(ltrim($featured['coverImage'], '/'), ENT_QUOTES) ?>" alt="<?= htmlspecialchars($fAlt !== '' ? $fAlt : strip_tags($fTitle), ENT_QUOTES) ?>" width="760" height="520">
      </div>
      <?php endif; ?>
      <div class="bl-feature-body">
        <div class="bl-meta">
          <time datetime="<?= htmlspecialchars($featured['publishedAt'], ENT_QUOTES) ?>"><?= htmlspecialchars($featured['publishedAt'], ENT_QUOTES) ?></time>
          <span class="dot">&middot;</span>
          <span><?= (int) apex_blog_reading_minutes($featured, $currentLang) ?> <?= htmlspecialchars($t('Min. Lesezeit', 'min read'), ENT_QUOTES) ?></span>
        </div>
        <h2><?= strip_tags($fTitle, '<span><em><strong>') ?></h2>
        <?php if ($fExcerpt !== ''): ?><p><?= strip_tags($fExcerpt, '<em><strong>') ?></p><?php endif; ?>
        <span class="bl-readmore"><?= htmlspecialchars($t('Artikel lesen', 'Read the article'), ENT_QUOTES) ?> &rarr;</span>
      </div>
    </article>
  </a>

  <?php if ($rest !== []): ?>
  <div class="bl-grid">
    <?php foreach ($rest as $post):
      $pTitle = apex_cms_value($post['title'], $currentLang);
      $pExcerpt = apex_cms_value($post['excerpt'], $currentLang);
      $pAlt = apex_cms_value($post['coverAlt'], $currentLang);
      $pHref = '/' . apex_blog_post_path($post['slug']);
    ?>
    <a class="bl-cardlink" href="<?= htmlspecialchars($pHref, ENT_QUOTES) ?>">
      <article class="bl-card">
        <?php if ($post['coverImage'] !== ''): ?>
        <div class="bl-card-media">
          <img src="/<?= htmlspecialchars(ltrim($post['coverImage'], '/'), ENT_QUOTES) ?>" alt="<?= htmlspecialchars($pAlt !== '' ? $pAlt : strip_tags($pTitle), ENT_QUOTES) ?>" width="600" height="338" loading="lazy">
        </div>
        <?php endif; ?>
        <div class="bl-card-body">
          <div class="bl-meta">
            <time datetime="<?= htmlspecialchars($post['publishedAt'], ENT_QUOTES) ?>"><?= htmlspecialchars($post['publishedAt'], ENT_QUOTES) ?></time>
            <span class="dot">&middot;</span>
            <span><?= (int) apex_blog_reading_minutes($post, $currentLang) ?> <?= htmlspecialchars($t('Min.', 'min'), ENT_QUOTES) ?></span>
          </div>
          <h3><?= strip_tags($pTitle, '<span><em><strong>') ?></h3>
          <?php if ($pExcerpt !== ''): ?><p><?= strip_tags($pExcerpt, '<em><strong>') ?></p><?php endif; ?>
          <span class="bl-readmore"><?= htmlspecialchars($t('Weiterlesen', 'Read more'), ENT_QUOTES) ?> &rarr;</span>
        </div>
      </article>
    </a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
<?php endif; ?>

  <section class="bl-cta">
    <h2<?= apex_cms_attrs($blCta['heading'] ?? null) ?>><?= apex_cms_value($blCta['heading'] ?? null, $currentLang) ?></h2>
    <p<?= apex_cms_attrs($blCta['sub'] ?? null) ?>><?= apex_cms_value($blCta['sub'] ?? null, $currentLang) ?></p>
    <a href="<?= htmlspecialchars($consultHref, ENT_QUOTES) ?>"<?= apex_cms_attrs($blCta['button'] ?? null) ?>><?= apex_cms_value($blCta['button'] ?? null, $currentLang) ?: htmlspecialchars($t('Kostenlose Beratung sichern', 'Book a free consultation'), ENT_QUOTES) ?></a>
  </section>
</div>

<?php include __DIR__ . '/includes/site-footer.php'; ?>
<?php include __DIR__ . '/includes/apex-ai-widget.php'; ?>

</body>
</html>
<?php echo apex_localize_output((string) ob_get_clean(), $currentLang); ?>
