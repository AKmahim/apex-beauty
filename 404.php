<?php

declare(strict_types=1);

// Served by Apache's ErrorDocument for any URL that does not resolve (see
// .htaccess). Before this, a mistyped URL got Apache's bare "Not Found" text
// with no branding and no way back into the site. The language is still read
// off the URL, so /fr/typo stays French.

require_once __DIR__ . '/includes/site-config.php';
require_once __DIR__ . '/includes/i18n.php';
require_once __DIR__ . '/includes/seo.php';

http_response_code(404);

$currentLang = apex_current_lang();
$langBase = apex_lang_base();
$t = static fn(array $by): string => $by[$currentLang] ?? $by['en'];

$seoPage = '';
$seoNoindex = true;
$seoCanonicalPath = '';
$seoTitle = $t([
    'de' => 'Seite nicht gefunden', 'en' => 'Page not found', 'fr' => 'Page introuvable',
    'nl' => 'Pagina niet gevonden', 'it' => 'Pagina non trovata', 'tr' => 'Sayfa bulunamadı',
]) . ' | ' . APEX_BUSINESS_NAME;
$seoDescription = '';
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
<!-- DOMPurify + wrapper: loaded before anything that writes markup into the
     DOM, so the language switcher never assigns unsanitised innerHTML. -->
<link rel="stylesheet" href="<?= htmlspecialchars(apex_asset('assets/apex-utilities.css'), ENT_QUOTES) ?>">
<script src="/assets/vendor/purify-3.1.6.min.js" nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>"></script>
<script src="<?= htmlspecialchars(apex_asset('assets/apex-safe-html.js'), ENT_QUOTES) ?>" nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>"></script>
<script src="<?= htmlspecialchars(apex_asset('assets/apex-actions.js'), ENT_QUOTES) ?>" nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>"></script>
<script src="<?= htmlspecialchars(apex_asset('assets/cookie-consent.js'), ENT_QUOTES) ?>" nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>"></script>
<style nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>">
  :root { --teal-500: #0ea5e9; --blue-600: #2563eb; --ink: #0f2027; }
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: -apple-system, BlinkMacSystemFont, "Inter", "Segoe UI", sans-serif; color: var(--ink); background: #fff; }
  .nf {
    min-height: 72vh; display: flex; flex-direction: column; align-items: center; justify-content: center;
    text-align: center; padding: 96px 24px;
    background: linear-gradient(160deg, #0b1b2b 0%, #12304d 60%, #0f2740 100%); color: #fff;
  }
  .nf-code { font-size: 13px; letter-spacing: 0.18em; text-transform: uppercase; color: #38bdf8; font-weight: 700; margin-bottom: 16px; }
  .nf h1 { font-size: clamp(26px, 4.4vw, 40px); font-weight: 800; margin-bottom: 14px; overflow-wrap: anywhere; }
  .nf p { color: #c7dbeb; font-size: 16px; line-height: 1.65; max-width: 520px; margin-bottom: 30px; }
  .nf-links { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; }
  .nf-links a {
    display: inline-block; text-decoration: none; font-weight: 700; font-size: 14.5px;
    padding: 12px 24px; border-radius: 999px;
  }
  .nf-primary { background: linear-gradient(135deg, var(--teal-500), var(--blue-600)); color: #fff; }
  .nf-ghost { border: 1.5px solid rgba(255,255,255,0.35); color: #fff; }
  .nf-ghost:hover { border-color: #38bdf8; }
</style>
</head>
<body>
<?php require __DIR__ . '/includes/site-gtm-noscript.php'; ?>
<?php
$siteHeaderMode = 'full';
$siteActivePage = '';
$siteSectionBase = 'index.php';
$siteHomeHref = 'index.php';
include __DIR__ . '/includes/site-header.php';
?>
<main class="nf">
  <div class="nf-code">404</div>
  <h1><?= htmlspecialchars($t([
    'de' => 'Diese Seite gibt es nicht', 'en' => 'This page does not exist',
    'fr' => "Cette page n'existe pas", 'nl' => 'Deze pagina bestaat niet',
    'it' => 'Questa pagina non esiste', 'tr' => 'Bu sayfa mevcut değil',
  ]), ENT_QUOTES) ?></h1>
  <p><?= htmlspecialchars($t([
    'de' => 'Der Link ist vielleicht veraltet oder enthält einen Tippfehler. Von hier kommen Sie zurück.',
    'en' => 'The link may be outdated or contain a typo. You can get back from here.',
    'fr' => 'Le lien est peut-être obsolète ou contient une faute de frappe. Vous pouvez repartir d\'ici.',
    'nl' => 'De link is mogelijk verouderd of bevat een typefout. Vanaf hier komt u weer verder.',
    'it' => 'Il link potrebbe essere obsoleto o contenere un errore di battitura. Da qui puoi tornare indietro.',
    'tr' => 'Bağlantı eski olabilir veya bir yazım hatası içerebilir. Buradan geri dönebilirsiniz.',
  ]), ENT_QUOTES) ?></p>
  <div class="nf-links">
    <a class="nf-primary" href="<?= htmlspecialchars($langBase === '' ? '/' : $langBase, ENT_QUOTES) ?>"><?= htmlspecialchars($t([
      'de' => 'Zur Startseite', 'en' => 'Go to the homepage', 'fr' => "Aller à l'accueil",
      'nl' => 'Naar de homepage', 'it' => 'Vai alla home', 'tr' => 'Ana sayfaya git',
    ]), ENT_QUOTES) ?></a>
    <a class="nf-ghost" href="<?= htmlspecialchars($langBase . '/prices', ENT_QUOTES) ?>"><?= htmlspecialchars($t([
      'de' => 'Preise', 'en' => 'Prices', 'fr' => 'Tarifs', 'nl' => 'Prijzen', 'it' => 'Prezzi', 'tr' => 'Fiyatlar',
    ]), ENT_QUOTES) ?></a>
    <a class="nf-ghost" href="<?= htmlspecialchars($langBase . '/blog', ENT_QUOTES) ?>"><?= htmlspecialchars($t([
      'de' => 'Ratgeber', 'en' => 'Guide', 'fr' => 'Guide', 'nl' => 'Gids', 'it' => 'Guida', 'tr' => 'Rehber',
    ]), ENT_QUOTES) ?></a>
  </div>
</main>
<?php include __DIR__ . '/includes/site-footer.php'; ?>
</body>
</html>
<?php echo apex_localize_output((string) ob_get_clean(), $currentLang); ?>
