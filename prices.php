<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/site-config.php';
require_once __DIR__ . '/includes/i18n.php';
$currentLang = apex_current_lang();
$langBase = apex_lang_base();
$seoTitle = $currentLang === 'en'
    ? 'Hair Transplant Prices & Packages | Apex Beauty'
    : 'Haartransplantation Preise & Pakete | Apex Beauty';
$seoDescription = $currentLang === 'en'
    ? 'Transparent all-in package prices for a hair transplant at Apex Beauty: VIP from EUR 4,350, Comfort from EUR 3,950, Basic from EUR 2,650 - including PRP, medication and medical follow-ups.'
    : 'Transparente Komplettpreise für Ihre Haartransplantation bei Apex Beauty: VIP ab 4.350 EUR, Komfort ab 3.950 EUR, Basis ab 2.650 EUR - inklusive PRP, Medikamenten und ärztlicher Nachbehandlung.';
$seoCanonicalPath = 'prices';

// Consultation CTA target. The consult modal itself lives on the homepage
// (index.php reads ?open=consult), so every CTA here routes there rather
// than duplicating ~400 lines of modal markup and its multi-step JS.
$consultHref = ($langBase === '' ? '' : $langBase) . '/consult';

// Offer schema for the three packages. Modelled as a Service with an
// OfferCatalog rather than a Product, since this is a medical service
// package and not a physical good.
$pricesUrl = rtrim(APEX_SITE_URL, '/') . '/' . ltrim(trim($langBase . '/' . $seoCanonicalPath, '/'), '/');
$packageOffers = [
    ['id' => 'vip', 'price' => '4350', 'de' => 'VIP-Paket', 'en' => 'VIP Package'],
    ['id' => 'komfort', 'price' => '3950', 'de' => 'Komfortpaket', 'en' => 'Comfort Package'],
    ['id' => 'basis', 'price' => '2650', 'de' => 'Basispaket', 'en' => 'Basic Package'],
];
$pricesSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => $currentLang === 'en' ? 'Hair transplant packages' : 'Haartransplantation Pakete',
    'serviceType' => $currentLang === 'en' ? 'Hair transplantation' : 'Haartransplantation',
    'provider' => [
        '@type' => 'MedicalClinic',
        'name' => APEX_BUSINESS_NAME,
        'url' => APEX_SITE_URL,
    ],
    'areaServed' => ['Austria', 'Germany', 'Switzerland'],
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => $currentLang === 'en' ? 'Hair transplant packages' : 'Haartransplantation Pakete',
        'itemListElement' => array_map(static function (array $p) use ($currentLang, $pricesUrl): array {
            return [
                '@type' => 'Offer',
                'name' => $p[$currentLang === 'en' ? 'en' : 'de'],
                'price' => $p['price'],
                'priceCurrency' => 'EUR',
                'availability' => 'https://schema.org/InStock',
                'url' => $pricesUrl . '#' . $p['id'],
                'itemOffered' => [
                    '@type' => 'Service',
                    'name' => $p[$currentLang === 'en' ? 'en' : 'de'],
                ],
            ];
        }, $packageOffers),
    ],
];
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
<script type="application/ld+json"><?= json_encode($pricesSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
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
fbq('init', '972641739140966');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=972641739140966&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
<script src="/assets/meta-pixel.js"></script>
<script src="/assets/cookie-consent.js"></script>
<script src="/assets/content-loader.js"></script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W6ZC5JRP');</script>
<!-- End Google Tag Manager -->
<style>
  :root {
    --teal-400: #38bdf8;
    --teal-500: #0ea5e9;
    --teal-600: #0284c7;
    --teal-700: #075985;
    --blue-500: #3b82f6;
    --blue-600: #2563eb;
    --blue-700: #1d4ed8;
    --blue-900: #1e3a5f;
    --accent-amber: #7dd3fc;
    --accent-purple: #1e40af;
    --ink: #0f2027;
    --ink-soft: #45596a;
    --paper: #f7fafd;
  }
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    font-family: -apple-system, BlinkMacSystemFont, "Inter", "Segoe UI", sans-serif;
    color: var(--ink);
    background: #ffffff;
    position: relative;
  }
  body::before {
    content: '';
    position: fixed;
    inset: 0;
    z-index: -1;
    background-image:
      radial-gradient(circle at 10% 8%, rgba(125,211,252,0.4) 0%, transparent 40%),
      radial-gradient(circle at 90% 15%, rgba(94,185,224,0.32) 0%, transparent 42%),
      radial-gradient(circle at 20% 55%, rgba(147,197,253,0.3) 0%, transparent 40%),
      radial-gradient(circle at 85% 60%, rgba(61,111,214,0.22) 0%, transparent 42%),
      radial-gradient(circle at 15% 95%, rgba(45,212,191,0.22) 0%, transparent 40%),
      radial-gradient(circle at 80% 98%, rgba(56,189,248,0.28) 0%, transparent 42%);
    background-color: #ffffff;
  }
  a { text-decoration: none; color: inherit; }

  /* ---- WhatsApp floating button ---- */
  .whatsapp-fab {
    position: fixed; bottom: 24px; right: 24px; z-index: 90;
    width: 56px; height: 56px; border-radius: 50%;
    background: #25D366;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 16px 36px -10px rgba(0,0,0,0.38), 0 6px 14px -6px rgba(0,0,0,0.22);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .whatsapp-fab:hover {
    transform: translateY(-4px) scale(1.07);
    box-shadow: 0 22px 44px -10px rgba(0,0,0,0.42), 0 10px 22px -6px rgba(0,0,0,0.28);
  }
  .whatsapp-fab svg { width: 30px; height: 30px; display: block; }

  /* ---- HERO ---- */
  .pr-hero { position: relative; padding: 64px 48px 30px; background: #ffffff; overflow: hidden; }
  .pr-hero-bg {
    position: absolute; inset: 0;
    background-image:
      radial-gradient(circle at 12% 15%, rgba(125,211,252,0.32) 0%, transparent 45%),
      radial-gradient(circle at 92% 8%, rgba(94,185,224,0.28) 0%, transparent 50%),
      radial-gradient(circle at 85% 95%, rgba(61,111,214,0.16) 0%, transparent 50%);
    z-index: 0;
  }
  .pr-hero-inner { position: relative; z-index: 1; max-width: 820px; margin: 0 auto; text-align: center; }
  .pr-hero .eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 700; color: #1d2f3d;
    background: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
    padding: 6px 14px; border-radius: 999px; margin-bottom: 20px;
    backdrop-filter: blur(16px) saturate(1.5);
  }
  .pr-hero .eyebrow .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--teal-500); }
  .pr-hero h1 {
    font-size: 38px; line-height: 1.16; font-weight: 800; letter-spacing: -0.02em;
    color: #1a2733; margin-bottom: 16px;
  }
  .pr-hero h1 span {
    background: linear-gradient(100deg, var(--teal-600), var(--blue-700));
    -webkit-background-clip: text; background-clip: text; color: transparent;
  }
  .pr-hero p { font-size: 16px; line-height: 1.6; color: var(--ink-soft); max-width: 640px; margin: 0 auto; }

  /* ---- PACKAGE CARDS ---- */
  .pr-cards-wrap { max-width: 1180px; margin: 0 auto; padding: 30px 48px 10px; }
  .pr-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; align-items: start; }
  .pr-card {
    position: relative; overflow: hidden;
    display: flex; flex-direction: column;
    border-radius: 22px; padding: 26px 24px 24px;
    background: rgba(255,255,255,0.42);
    backdrop-filter: blur(26px) saturate(2.1);
    -webkit-backdrop-filter: blur(26px) saturate(2.1);
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 14px 32px -18px rgba(37,99,235,0.3);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    scroll-margin-top: 130px;
  }
  .pr-card::before {
    content: ''; position: absolute; inset: 0; border-radius: 22px;
    background: linear-gradient(160deg, rgba(255,255,255,0.6), transparent 50%);
    pointer-events: none;
  }
  .pr-card:hover { transform: translateY(-5px); box-shadow: inset 0 1px 0 rgba(255,255,255,0.85), 0 24px 44px -18px rgba(37,99,235,0.38); }
  .pr-card > * { position: relative; z-index: 1; }

  /* Flagship tier gets a gradient rim so the eye lands on it first. */
  .pr-card.featured {
    border-color: transparent;
    box-shadow:
      inset 0 1px 0 rgba(255,255,255,0.85),
      0 0 0 2px rgba(2,132,199,0.55),
      0 20px 44px -18px rgba(37,99,235,0.45);
    background: rgba(255,255,255,0.55);
  }
  .pr-card.featured:hover { box-shadow: inset 0 1px 0 rgba(255,255,255,0.9), 0 0 0 2px rgba(2,132,199,0.7), 0 28px 54px -18px rgba(37,99,235,0.5); }

  .pr-badge {
    display: inline-block; align-self: flex-start;
    font-size: 10.5px; font-weight: 800; letter-spacing: 0.06em; text-transform: uppercase;
    color: var(--teal-700); background: rgba(125,211,252,0.28);
    padding: 5px 11px; border-radius: 999px; margin-bottom: 12px;
  }
  .pr-card.featured .pr-badge {
    color: #fff;
    background: linear-gradient(100deg, var(--teal-500), var(--blue-600));
    box-shadow: 0 6px 14px -6px rgba(37,99,235,0.6);
  }
  .pr-name { font-size: 20px; font-weight: 800; color: var(--ink); margin-bottom: 10px; letter-spacing: -0.01em; }
  .pr-price {
    font-size: 40px; font-weight: 800; line-height: 1.05; letter-spacing: -0.02em;
    background: linear-gradient(100deg, var(--teal-600), var(--blue-700));
    -webkit-background-clip: text; background-clip: text; color: transparent;
    margin-bottom: 4px;
  }
  .pr-price-note { font-size: 12px; font-weight: 700; color: var(--teal-700); text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 14px; }
  .pr-desc { font-size: 13.5px; color: var(--ink-soft); line-height: 1.55; margin-bottom: 18px; }
  .pr-divider { height: 1px; background: linear-gradient(90deg, rgba(147,197,253,0.7), transparent); margin-bottom: 16px; }

  .pr-feats { display: grid; gap: 9px; margin-bottom: 22px; }
  .pr-feat { display: flex; align-items: flex-start; gap: 10px; }
  .pr-feat .tick {
    flex-shrink: 0; width: 19px; height: 19px; border-radius: 50%; margin-top: 1px;
    background: linear-gradient(120deg, var(--teal-500), var(--blue-600)); color: #fff;
    display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700;
  }
  .pr-feat span { font-size: 13px; color: var(--ink); line-height: 1.45; }
  /* Perks unique to this tier read slightly stronger than the shared base. */
  .pr-feat.plus span { font-weight: 700; }

  .pr-cta {
    margin-top: auto; display: block; text-align: center;
    padding: 13px 20px; border-radius: 12px;
    font-size: 14.5px; font-weight: 700;
    border: 1.5px solid rgba(2,132,199,0.35);
    background: rgba(255,255,255,0.5);
    color: var(--blue-700);
    transition: all 0.18s ease;
  }
  .pr-cta:hover { background: rgba(255,255,255,0.85); border-color: var(--teal-600); transform: translateY(-1px); }
  .pr-card.featured .pr-cta {
    border-color: transparent; color: #fff;
    background: linear-gradient(100deg, var(--teal-500) 0%, var(--teal-600) 35%, var(--blue-600) 100%);
    box-shadow: 0 12px 26px -10px rgba(13,148,136,0.55), inset 0 1px 0 rgba(255,255,255,0.5);
  }
  .pr-card.featured .pr-cta:hover { transform: translateY(-2px); }

  /* ---- SECTIONS ---- */
  .pr-section { max-width: 1180px; margin: 0 auto; padding: 56px 48px; scroll-margin-top: 130px; }
  .pr-section-head { text-align: center; max-width: 700px; margin: 0 auto 30px; }
  .pr-section-head h2 { font-size: 27px; font-weight: 800; color: var(--ink); margin-bottom: 8px; letter-spacing: -0.01em; }
  .pr-section-head p { font-size: 15px; color: var(--ink-soft); line-height: 1.6; }

  /* ---- COMPARISON TABLE ---- */
  .pr-table-wrap {
    overflow-x: auto; border-radius: 18px; border: 1px solid rgba(255,255,255,0.85);
    background: rgba(255,255,255,0.34);
    backdrop-filter: blur(28px) saturate(2.1);
    -webkit-backdrop-filter: blur(28px) saturate(2.1);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 14px 30px -18px rgba(37,99,235,0.3);
  }
  .pr-table { width: 100%; border-collapse: collapse; font-size: 13.5px; min-width: 660px; }
  .pr-table th, .pr-table td { padding: 13px 16px; text-align: left; border-bottom: 1px solid rgba(191,219,254,0.5); }
  .pr-table thead th {
    font-size: 12.5px; font-weight: 800; color: #fff;
    background: linear-gradient(100deg, var(--teal-600), var(--blue-700));
    white-space: nowrap;
  }
  .pr-table thead th:first-child { background: linear-gradient(100deg, var(--teal-700), var(--teal-600)); }
  .pr-table tbody td { text-align: center; width: 130px; }
  .pr-table tbody tr:last-child td, .pr-table tbody tr:last-child th { border-bottom: none; }
  .pr-table tbody tr:hover td, .pr-table tbody tr:hover th { background: rgba(224,242,254,0.45); }
  /* First cell of every body/footer row is a row-scoped header cell, so a
     screen reader announces the service name alongside each tick rather
     than reading a column of bare checkmarks. */
  .pr-table tbody th { color: var(--ink); font-weight: 600; width: auto; }
  .pr-yes {
    display: inline-flex; align-items: center; justify-content: center;
    width: 22px; height: 22px; border-radius: 50%;
    background: linear-gradient(120deg, var(--teal-500), var(--blue-600));
    color: #fff; font-size: 12px; font-weight: 700;
  }
  .pr-no { display: inline-block; color: rgba(69,89,106,0.4); font-size: 15px; font-weight: 700; }
  .pr-table tfoot td, .pr-table tfoot th {
    font-weight: 800; font-size: 15px; color: var(--ink);
    background: rgba(224,242,254,0.5);
  }
  .pr-table tfoot td { text-align: center; }

  /* ---- NOTES ---- */
  .pr-notes { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-top: 26px; }
  .pr-note {
    position: relative; overflow: hidden;
    border-radius: 16px; padding: 20px 20px;
    background: rgba(255,255,255,0.36);
    backdrop-filter: blur(24px) saturate(2);
    -webkit-backdrop-filter: blur(24px) saturate(2);
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 10px 24px -16px rgba(37,99,235,0.26);
  }
  .pr-note::before { content: ''; position: absolute; inset: 0; border-radius: 16px; background: linear-gradient(160deg, rgba(255,255,255,0.6), transparent 50%); pointer-events: none; }
  .pr-note b, .pr-note p { position: relative; z-index: 1; }
  .pr-note b { display: block; font-size: 14.5px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
  .pr-note p { font-size: 13px; color: var(--ink-soft); line-height: 1.55; }

  /* ---- CLOSING CTA BAND ---- */
  .pr-band-wrap { padding: 10px 48px 70px; max-width: 1180px; margin: 0 auto; }
  .pr-band {
    position: relative; overflow: hidden;
    border-radius: 24px; padding: 44px 40px;
    text-align: center;
    background: linear-gradient(120deg, var(--teal-600) 0%, var(--blue-600) 55%, var(--blue-700) 100%);
    box-shadow: 0 24px 50px -22px rgba(37,99,235,0.6);
    color: #fff;
  }
  .pr-band::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(circle at 15% 20%, rgba(255,255,255,0.22) 0%, transparent 45%),
                radial-gradient(circle at 85% 85%, rgba(255,255,255,0.14) 0%, transparent 45%);
    pointer-events: none;
  }
  .pr-band > * { position: relative; z-index: 1; }
  .pr-band h2 { font-size: 26px; font-weight: 800; margin-bottom: 10px; letter-spacing: -0.01em; }
  .pr-band p { font-size: 15px; opacity: 0.92; line-height: 1.6; max-width: 560px; margin: 0 auto 22px; }
  .pr-band-actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
  .pr-band-btn {
    display: inline-flex; align-items: center; gap: 9px;
    padding: 13px 24px; border-radius: 12px;
    font-size: 15px; font-weight: 700;
    background: #fff; color: var(--blue-700);
    box-shadow: 0 12px 26px -12px rgba(0,0,0,0.4);
    transition: transform 0.18s ease;
  }
  .pr-band-btn:hover { transform: translateY(-2px); }
  .pr-band-btn.ghost {
    background: rgba(255,255,255,0.16); color: #fff;
    border: 1.5px solid rgba(255,255,255,0.6);
    backdrop-filter: blur(10px);
  }
  .pr-band-btn svg { width: 18px; height: 18px; }

  @media (max-width: 900px) {
    .nav { padding: 10px 16px; gap: 8px; }
    .nav-links { display: none; }
    .logo-lockup { gap: 8px; flex-shrink: 0; }
    .logo-lockup img.lotus { height: 30px; }
    .logo-lockup img.wordmark { height: 19px; }
    .nav-right { gap: 8px; }
    .lang-switch { font-size: 11px; }
    .lang-switch button { padding: 4px 9px; }
    .nav-right .cta-btn { padding: 9px 12px; font-size: 12.5px; white-space: nowrap; }
    .pr-hero { padding: 40px 20px 22px; }
    .pr-hero h1 { font-size: 27px; }
    .pr-cards-wrap { padding: 24px 20px 6px; }
    .pr-cards { grid-template-columns: 1fr; gap: 16px; }
    .pr-section { padding: 44px 20px; }
    .pr-notes { grid-template-columns: 1fr; }
    .pr-band-wrap { padding: 6px 20px 56px; }
    .pr-band { padding: 34px 22px; }
    .pr-band h2 { font-size: 22px; }
    .whatsapp-fab { bottom: 16px; right: 16px; width: 50px; height: 50px; }
    .whatsapp-fab svg { width: 27px; height: 27px; }
  }
  @media (min-width: 901px) and (max-width: 1080px) {
    .pr-price { font-size: 34px; }
    .pr-name { font-size: 18px; }
  }
</style>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W6ZC5JRP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php
$siteHeaderMode = 'full';
$siteActivePage = 'prices';
$siteSectionBase = 'index.php';
$siteHomeHref = 'index.php';
include __DIR__ . '/includes/site-header.php';
?>

<section class="pr-hero">
  <div class="pr-hero-bg"></div>
  <div class="pr-hero-inner">
    <div class="eyebrow"><span class="dot"></span><span data-de="Preise &amp; Pakete" data-en="Prices &amp; Packages" data-fr="Prix &amp; forfaits" data-nl="Prijzen &amp; pakketten" data-it="Prezzi e pacchetti" data-tr="Fiyatlar ve Paketler">Preise &amp; Pakete</span></div>
    <h1 data-de="Transparente Preise für Ihre &lt;span&gt;Haartransplantation&lt;/span&gt;" data-en="Transparent pricing for your &lt;span&gt;hair transplant&lt;/span&gt;" data-fr="Des tarifs transparents pour votre &lt;span&gt;greffe de cheveux&lt;/span&gt;" data-nl="Transparante prijzen voor uw &lt;span&gt;haartransplantatie&lt;/span&gt;" data-it="Prezzi trasparenti per il tuo &lt;span&gt;trapianto di capelli&lt;/span&gt;" data-tr="&lt;span&gt;Saç ekiminiz&lt;/span&gt; için şeffaf fiyatlar">Transparente Preise für Ihre Haartransplantation</h1>
    <p data-de="Drei Komplettpakete, ein fester Preis. Jedes Paket enthält die vollständige medizinische Behandlung inklusive PRP, Medikamenten und ärztlicher Nachbehandlung." data-en="Three all-in packages, one fixed price. Every package covers the complete medical treatment including PRP, medication and medical follow-ups." data-fr="Trois forfaits complets, un prix fixe. Chaque forfait comprend l'intégralité du traitement médical, y compris le PRP, les médicaments et le suivi médical." data-nl="Drie complete pakketten, één vaste prijs. Elk pakket omvat de volledige medische behandeling inclusief PRP, medicatie en medische nacontroles." data-it="Tre pacchetti completi, un prezzo fisso. Ogni pacchetto comprende l'intero trattamento medico, inclusi PRP, farmaci e controlli medici." data-tr="Üç eksiksiz paket, tek sabit fiyat. Her paket; PRP, ilaçlar ve tıbbi kontroller dahil olmak üzere eksiksiz tıbbi tedaviyi kapsar.">Drei Komplettpakete, ein fester Preis. Jedes Paket enthält die vollständige medizinische Behandlung inklusive PRP, Medikamenten und ärztlicher Nachbehandlung.</p>
  </div>
</section>

<div class="pr-cards-wrap">
  <div class="pr-cards">

    <!-- ===== VIP - highest tier, listed first ===== -->
    <div class="pr-card featured" id="vip">
      <span class="pr-badge" data-de="VIP-Erlebnis" data-en="VIP Experience" data-fr="Expérience VIP" data-nl="VIP-ervaring" data-it="Esperienza VIP" data-tr="VIP Deneyim">VIP-Erlebnis</span>
      <div class="pr-name" data-de="VIP-Paket" data-en="VIP Package" data-fr="Forfait VIP" data-nl="VIP-pakket" data-it="Pacchetto VIP" data-tr="VIP Paketi">VIP-Paket</div>
      <div class="pr-price" data-de="€ 4.350" data-en="€4,350" data-fr="4 350 €" data-nl="€ 4.350" data-it="4.350 €" data-tr="4.350 €">€ 4.350</div>
      <div class="pr-price-note" data-de="Komplettpaket" data-en="All-in package" data-fr="Forfait tout compris" data-nl="Compleet pakket" data-it="Pacchetto completo" data-tr="Her Şey Dahil Paket">Komplettpaket</div>
      <p class="pr-desc" data-de="Zusätzlich zu den medizinischen Leistungen genießen Sie ein exklusives Istanbul-Erlebnis." data-en="On top of the medical services, you enjoy an exclusive Istanbul experience." data-fr="En plus des prestations médicales, vous profitez d'une expérience exclusive à Istanbul." data-nl="Naast de medische diensten geniet u van een exclusieve Istanbul-ervaring." data-it="Oltre alle prestazioni mediche, potrai vivere un'esclusiva esperienza a Istanbul." data-tr="Tıbbi hizmetlerin yanı sıra ayrıcalıklı bir İstanbul deneyimi yaşarsınız.">Zusätzlich zu den medizinischen Leistungen genießen Sie ein exklusives Istanbul-Erlebnis.</p>
      <div class="pr-divider"></div>
      <div class="pr-feats">
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Kostenlose Erstberatung" data-en="Free initial consultation" data-fr="Première consultation gratuite" data-nl="Gratis eerste consult" data-it="Prima consulenza gratuita" data-tr="Ücretsiz ilk danışma">Kostenlose Erstberatung</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Kostenlose Haaranalyse" data-en="Free hair analysis" data-fr="Analyse capillaire gratuite" data-nl="Gratis haaranalyse" data-it="Analisi dei capelli gratuita" data-tr="Ücretsiz saç analizi">Kostenlose Haaranalyse</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Individuelle Behandlungsplanung" data-en="Individual treatment planning" data-fr="Planification personnalisée du traitement" data-nl="Individuele behandelplanning" data-it="Pianificazione personalizzata del trattamento" data-tr="Kişiye özel tedavi planlaması">Individuelle Behandlungsplanung</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Präzise Anzeichnung der Haarlinie" data-en="Precise hairline design" data-fr="Tracé précis de la ligne capillaire" data-nl="Precieze aftekening van de haarlijn" data-it="Disegno preciso dell'attaccatura" data-tr="Hassas saç çizgisi tasarımı">Präzise Anzeichnung der Haarlinie</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Hochwertige Haartransplantation (DHI/FUE, nach medizinischer Empfehlung)" data-en="High-quality hair transplant (DHI/FUE, as medically recommended)" data-fr="Greffe de cheveux haut de gamme (DHI/FUE, selon recommandation médicale)" data-nl="Hoogwaardige haartransplantatie (DHI/FUE, volgens medisch advies)" data-it="Trapianto di capelli di alta qualità (DHI/FUE, secondo indicazione medica)" data-tr="Yüksek kaliteli saç ekimi (DHI/FUE, tıbbi öneriye göre)">Hochwertige Haartransplantation (DHI/FUE, nach medizinischer Empfehlung)</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="PRP-Eigenblutbehandlung inklusive" data-en="PRP treatment included" data-fr="Traitement PRP inclus" data-nl="PRP-behandeling inbegrepen" data-it="Trattamento PRP incluso" data-tr="PRP tedavisi dahil">PRP-Eigenblutbehandlung inklusive</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Medikamente für die erste Woche" data-en="Medication for the first week" data-fr="Médicaments pour la première semaine" data-nl="Medicatie voor de eerste week" data-it="Farmaci per la prima settimana" data-tr="İlk hafta için ilaçlar">Medikamente für die erste Woche</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Zweimal ärztliche Nachbehandlung in der Klinik" data-en="Two medical follow-ups at the clinic" data-fr="Deux suivis médicaux à la clinique" data-nl="Twee medische nacontroles in de kliniek" data-it="Due controlli medici in clinica" data-tr="Klinikte iki kez tıbbi kontrol">Zweimal ärztliche Nachbehandlung in der Klinik</span></div>
        <div class="pr-feat plus"><span class="tick">✓</span><span data-de="3 Übernachtungen im Partnerhotel direkt neben der Klinik" data-en="3 nights at the partner hotel right next to the clinic" data-fr="3 nuits à l'hôtel partenaire juste à côté de la clinique" data-nl="3 overnachtingen in het partnerhotel direct naast de kliniek" data-it="3 notti nell'hotel partner accanto alla clinica" data-tr="Kliniğin hemen yanındaki partner otelde 3 gece konaklama">3 Übernachtungen im Partnerhotel direkt neben der Klinik</span></div>
        <div class="pr-feat plus"><span class="tick">✓</span><span data-de="Flughafentransfer (Flughafen ↔ Hotel)" data-en="Airport transfer (airport ↔ hotel)" data-fr="Transfert aéroport (aéroport ↔ hôtel)" data-nl="Luchthaventransfer (luchthaven ↔ hotel)" data-it="Transfer aeroportuale (aeroporto ↔ hotel)" data-tr="Havaalanı transferi (havaalanı ↔ otel)">Flughafentransfer (Flughafen ↔ Hotel)</span></div>
        <div class="pr-feat plus"><span class="tick">✓</span><span data-de="Geführte Istanbul-Tour (Hagia Sophia, Großer Basar und Galataturm)" data-en="Guided Istanbul tour (Hagia Sophia, Grand Bazaar and Galata Tower)" data-fr="Visite guidée d'Istanbul (Sainte-Sophie, Grand Bazar et tour de Galata)" data-nl="Begeleide Istanbul-tour (Hagia Sophia, Grote Bazaar en Galatatoren)" data-it="Tour guidato di Istanbul (Santa Sofia, Gran Bazar e Torre di Galata)" data-tr="Rehberli İstanbul turu (Ayasofya, Kapalıçarşı ve Galata Kulesi)">Geführte Istanbul-Tour (Hagia Sophia, Großer Basar und Galataturm)</span></div>
        <div class="pr-feat plus"><span class="tick">✓</span><span data-de="Bosporus-Schifffahrt (ca. 2,5 Stunden)" data-en="Bosphorus cruise (approx. 2.5 hours)" data-fr="Croisière sur le Bosphore (env. 2,5 heures)" data-nl="Bosporus-cruise (ca. 2,5 uur)" data-it="Crociera sul Bosforo (ca. 2,5 ore)" data-tr="Boğaz turu (yaklaşık 2,5 saat)">Bosporus-Schifffahrt (ca. 2,5 Stunden)</span></div>
        <div class="pr-feat plus"><span class="tick">✓</span><span data-de="Metrokarte für kostenlose Fahrten zu den Sehenswürdigkeiten" data-en="Metro card for free travel to the sights" data-fr="Carte de métro pour des trajets gratuits vers les sites touristiques" data-nl="Metrokaart voor gratis ritten naar de bezienswaardigheden" data-it="Tessera della metro per viaggi gratuiti verso le attrazioni" data-tr="Gezilecek yerlere ücretsiz ulaşım için metro kartı">Metrokarte für kostenlose Fahrten zu den Sehenswürdigkeiten</span></div>
        <div class="pr-feat plus"><span class="tick">✓</span><span data-de="Persönliche VIP-Betreuung" data-en="Personal VIP support" data-fr="Accompagnement VIP personnalisé" data-nl="Persoonlijke VIP-begeleiding" data-it="Assistenza VIP personale" data-tr="Kişisel VIP hizmeti">Persönliche VIP-Betreuung</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Deutschsprachige Betreuung" data-en="German-speaking support" data-fr="Accompagnement en allemand" data-nl="Duitstalige begeleiding" data-it="Assistenza in lingua tedesca" data-tr="Almanca dil desteği">Deutschsprachige Betreuung</span></div>
      </div>
      <a class="pr-cta" href="<?= htmlspecialchars($consultHref, ENT_QUOTES) ?>" data-de="Kostenlose Beratung sichern" data-en="Book a free consultation" data-fr="Réserver une consultation gratuite" data-nl="Gratis consult aanvragen" data-it="Prenota una consulenza gratuita" data-tr="Ücretsiz danışma alın">Kostenlose Beratung sichern</a>
    </div>

    <!-- ===== KOMFORT - middle tier ===== -->
    <div class="pr-card" id="komfort">
      <span class="pr-badge" data-de="Komfort &amp; Service" data-en="Comfort &amp; Service" data-fr="Confort &amp; service" data-nl="Comfort &amp; service" data-it="Comfort e servizio" data-tr="Konfor ve Hizmet">Komfort &amp; Service</span>
      <div class="pr-name" data-de="Komfortpaket" data-en="Comfort Package" data-fr="Forfait Confort" data-nl="Comfortpakket" data-it="Pacchetto Comfort" data-tr="Konfor Paketi">Komfortpaket</div>
      <div class="pr-price" data-de="€ 3.950" data-en="€3,950" data-fr="3 950 €" data-nl="€ 3.950" data-it="3.950 €" data-tr="3.950 €">€ 3.950</div>
      <div class="pr-price-note" data-de="Komplettpaket" data-en="All-in package" data-fr="Forfait tout compris" data-nl="Compleet pakket" data-it="Pacchetto completo" data-tr="Her Şey Dahil Paket">Komplettpaket</div>
      <p class="pr-desc" data-de="Zusätzlich zu den medizinischen Leistungen sind Hotel und Transfers bereits inkludiert." data-en="On top of the medical services, hotel and transfers are already included." data-fr="En plus des prestations médicales, l'hôtel et les transferts sont déjà inclus." data-nl="Naast de medische diensten zijn hotel en transfers al inbegrepen." data-it="Oltre alle prestazioni mediche, hotel e transfer sono già inclusi." data-tr="Tıbbi hizmetlere ek olarak otel ve transferler zaten dahildir.">Zusätzlich zu den medizinischen Leistungen sind Hotel und Transfers bereits inkludiert.</p>
      <div class="pr-divider"></div>
      <div class="pr-feats">
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Kostenlose Erstberatung" data-en="Free initial consultation" data-fr="Première consultation gratuite" data-nl="Gratis eerste consult" data-it="Prima consulenza gratuita" data-tr="Ücretsiz ilk danışma">Kostenlose Erstberatung</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Kostenlose Haaranalyse" data-en="Free hair analysis" data-fr="Analyse capillaire gratuite" data-nl="Gratis haaranalyse" data-it="Analisi dei capelli gratuita" data-tr="Ücretsiz saç analizi">Kostenlose Haaranalyse</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Individuelle Behandlungsplanung" data-en="Individual treatment planning" data-fr="Planification personnalisée du traitement" data-nl="Individuele behandelplanning" data-it="Pianificazione personalizzata del trattamento" data-tr="Kişiye özel tedavi planlaması">Individuelle Behandlungsplanung</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Präzise Anzeichnung der Haarlinie" data-en="Precise hairline design" data-fr="Tracé précis de la ligne capillaire" data-nl="Precieze aftekening van de haarlijn" data-it="Disegno preciso dell'attaccatura" data-tr="Hassas saç çizgisi tasarımı">Präzise Anzeichnung der Haarlinie</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Hochwertige Haartransplantation (DHI/FUE, nach medizinischer Empfehlung)" data-en="High-quality hair transplant (DHI/FUE, as medically recommended)" data-fr="Greffe de cheveux haut de gamme (DHI/FUE, selon recommandation médicale)" data-nl="Hoogwaardige haartransplantatie (DHI/FUE, volgens medisch advies)" data-it="Trapianto di capelli di alta qualità (DHI/FUE, secondo indicazione medica)" data-tr="Yüksek kaliteli saç ekimi (DHI/FUE, tıbbi öneriye göre)">Hochwertige Haartransplantation (DHI/FUE, nach medizinischer Empfehlung)</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="PRP-Eigenblutbehandlung inklusive" data-en="PRP treatment included" data-fr="Traitement PRP inclus" data-nl="PRP-behandeling inbegrepen" data-it="Trattamento PRP incluso" data-tr="PRP tedavisi dahil">PRP-Eigenblutbehandlung inklusive</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Medikamente für die erste Woche" data-en="Medication for the first week" data-fr="Médicaments pour la première semaine" data-nl="Medicatie voor de eerste week" data-it="Farmaci per la prima settimana" data-tr="İlk hafta için ilaçlar">Medikamente für die erste Woche</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Zweimal ärztliche Nachbehandlung in der Klinik" data-en="Two medical follow-ups at the clinic" data-fr="Deux suivis médicaux à la clinique" data-nl="Twee medische nacontroles in de kliniek" data-it="Due controlli medici in clinica" data-tr="Klinikte iki kez tıbbi kontrol">Zweimal ärztliche Nachbehandlung in der Klinik</span></div>
        <div class="pr-feat plus"><span class="tick">✓</span><span data-de="3 Übernachtungen im Partnerhotel direkt neben der Klinik" data-en="3 nights at the partner hotel right next to the clinic" data-fr="3 nuits à l'hôtel partenaire juste à côté de la clinique" data-nl="3 overnachtingen in het partnerhotel direct naast de kliniek" data-it="3 notti nell'hotel partner accanto alla clinica" data-tr="Kliniğin hemen yanındaki partner otelde 3 gece konaklama">3 Übernachtungen im Partnerhotel direkt neben der Klinik</span></div>
        <div class="pr-feat plus"><span class="tick">✓</span><span data-de="Flughafentransfer (Flughafen ↔ Hotel)" data-en="Airport transfer (airport ↔ hotel)" data-fr="Transfert aéroport (aéroport ↔ hôtel)" data-nl="Luchthaventransfer (luchthaven ↔ hotel)" data-it="Transfer aeroportuale (aeroporto ↔ hotel)" data-tr="Havaalanı transferi (havaalanı ↔ otel)">Flughafentransfer (Flughafen ↔ Hotel)</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Deutschsprachige Betreuung" data-en="German-speaking support" data-fr="Accompagnement en allemand" data-nl="Duitstalige begeleiding" data-it="Assistenza in lingua tedesca" data-tr="Almanca dil desteği">Deutschsprachige Betreuung</span></div>
      </div>
      <a class="pr-cta" href="<?= htmlspecialchars($consultHref, ENT_QUOTES) ?>" data-de="Kostenlose Beratung sichern" data-en="Book a free consultation" data-fr="Réserver une consultation gratuite" data-nl="Gratis consult aanvragen" data-it="Prenota una consulenza gratuita" data-tr="Ücretsiz danışma alın">Kostenlose Beratung sichern</a>
    </div>

    <!-- ===== BASIS - entry tier ===== -->
    <div class="pr-card" id="basis">
      <span class="pr-badge" data-de="Ihr Vorteil" data-en="Your Advantage" data-fr="Votre avantage" data-nl="Uw voordeel" data-it="Il tuo vantaggio" data-tr="Avantajınız">Ihr Vorteil</span>
      <div class="pr-name" data-de="Basispaket" data-en="Basic Package" data-fr="Forfait de base" data-nl="Basispakket" data-it="Pacchetto Base" data-tr="Temel Paket">Basispaket</div>
      <div class="pr-price" data-de="€ 2.650" data-en="€2,650" data-fr="2 650 €" data-nl="€ 2.650" data-it="2.650 €" data-tr="2.650 €">€ 2.650</div>
      <div class="pr-price-note" data-de="Komplettpaket" data-en="All-in package" data-fr="Forfait tout compris" data-nl="Compleet pakket" data-it="Pacchetto completo" data-tr="Her Şey Dahil Paket">Komplettpaket</div>
      <p class="pr-desc" data-de="Alle medizinischen Leistungen folgen einem klar strukturierten Behandlungsablauf, von der Beratung bis zur Nachbetreuung." data-en="All medical services follow a clearly structured treatment process, from consultation through to aftercare." data-fr="Toutes les prestations médicales suivent un parcours de traitement clairement structuré, de la consultation au suivi." data-nl="Alle medische diensten volgen een duidelijk gestructureerd behandeltraject, van consult tot nazorg." data-it="Tutte le prestazioni mediche seguono un percorso di trattamento chiaramente strutturato, dalla consulenza al follow-up." data-tr="Tüm tıbbi hizmetler, danışmadan bakım sonrası sürece kadar net yapılandırılmış bir tedavi akışını izler.">Alle medizinischen Leistungen folgen einem klar strukturierten Behandlungsablauf, von der Beratung bis zur Nachbetreuung.</p>
      <div class="pr-divider"></div>
      <div class="pr-feats">
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Kostenlose Erstberatung" data-en="Free initial consultation" data-fr="Première consultation gratuite" data-nl="Gratis eerste consult" data-it="Prima consulenza gratuita" data-tr="Ücretsiz ilk danışma">Kostenlose Erstberatung</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Kostenlose Haaranalyse" data-en="Free hair analysis" data-fr="Analyse capillaire gratuite" data-nl="Gratis haaranalyse" data-it="Analisi dei capelli gratuita" data-tr="Ücretsiz saç analizi">Kostenlose Haaranalyse</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Individuelle Behandlungsplanung" data-en="Individual treatment planning" data-fr="Planification personnalisée du traitement" data-nl="Individuele behandelplanning" data-it="Pianificazione personalizzata del trattamento" data-tr="Kişiye özel tedavi planlaması">Individuelle Behandlungsplanung</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Präzise Anzeichnung der Haarlinie" data-en="Precise hairline design" data-fr="Tracé précis de la ligne capillaire" data-nl="Precieze aftekening van de haarlijn" data-it="Disegno preciso dell'attaccatura" data-tr="Hassas saç çizgisi tasarımı">Präzise Anzeichnung der Haarlinie</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Hochwertige Haartransplantation (DHI/FUE, nach medizinischer Empfehlung)" data-en="High-quality hair transplant (DHI/FUE, as medically recommended)" data-fr="Greffe de cheveux haut de gamme (DHI/FUE, selon recommandation médicale)" data-nl="Hoogwaardige haartransplantatie (DHI/FUE, volgens medisch advies)" data-it="Trapianto di capelli di alta qualità (DHI/FUE, secondo indicazione medica)" data-tr="Yüksek kaliteli saç ekimi (DHI/FUE, tıbbi öneriye göre)">Hochwertige Haartransplantation (DHI/FUE, nach medizinischer Empfehlung)</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="PRP-Eigenblutbehandlung inklusive" data-en="PRP treatment included" data-fr="Traitement PRP inclus" data-nl="PRP-behandeling inbegrepen" data-it="Trattamento PRP incluso" data-tr="PRP tedavisi dahil">PRP-Eigenblutbehandlung inklusive</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Medikamente für die erste Woche" data-en="Medication for the first week" data-fr="Médicaments pour la première semaine" data-nl="Medicatie voor de eerste week" data-it="Farmaci per la prima settimana" data-tr="İlk hafta için ilaçlar">Medikamente für die erste Woche</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Zweimal ärztliche Nachbehandlung in der Klinik" data-en="Two medical follow-ups at the clinic" data-fr="Deux suivis médicaux à la clinique" data-nl="Twee medische nacontroles in de kliniek" data-it="Due controlli medici in clinica" data-tr="Klinikte iki kez tıbbi kontrol">Zweimal ärztliche Nachbehandlung in der Klinik</span></div>
        <div class="pr-feat"><span class="tick">✓</span><span data-de="Deutschsprachige Betreuung" data-en="German-speaking support" data-fr="Accompagnement en allemand" data-nl="Duitstalige begeleiding" data-it="Assistenza in lingua tedesca" data-tr="Almanca dil desteği">Deutschsprachige Betreuung</span></div>
      </div>
      <a class="pr-cta" href="<?= htmlspecialchars($consultHref, ENT_QUOTES) ?>" data-de="Kostenlose Beratung sichern" data-en="Book a free consultation" data-fr="Réserver une consultation gratuite" data-nl="Gratis consult aanvragen" data-it="Prenota una consulenza gratuita" data-tr="Ücretsiz danışma alın">Kostenlose Beratung sichern</a>
    </div>

  </div>
</div>

<section class="pr-section" id="vergleich">
  <div class="pr-section-head">
    <h2 data-de="Alle Pakete im Vergleich" data-en="All packages compared" data-fr="Comparatif des forfaits" data-nl="Alle pakketten vergeleken" data-it="Confronto tra i pacchetti" data-tr="Tüm paketlerin karşılaştırması">Alle Pakete im Vergleich</h2>
    <p data-de="Die medizinischen Leistungen sind in jedem Paket identisch. Die Unterschiede liegen in Unterbringung, Transfer und Betreuung vor Ort." data-en="The medical services are identical in every package. The differences are in accommodation, transfers and on-site support." data-fr="Les prestations médicales sont identiques dans chaque forfait. Les différences portent sur l'hébergement, les transferts et l'accompagnement sur place." data-nl="De medische diensten zijn in elk pakket identiek. De verschillen zitten in verblijf, transfers en begeleiding ter plaatse." data-it="Le prestazioni mediche sono identiche in ogni pacchetto. Le differenze riguardano alloggio, transfer e assistenza in loco." data-tr="Tıbbi hizmetler her pakette aynıdır. Farklar konaklama, transfer ve yerinde destek konularındadır.">Die medizinischen Leistungen sind in jedem Paket identisch. Die Unterschiede liegen in Unterbringung, Transfer und Betreuung vor Ort.</p>
  </div>

  <div class="pr-table-wrap">
    <table class="pr-table">
      <thead>
        <tr>
          <th data-de="Leistung" data-en="Service" data-fr="Prestation" data-nl="Dienst" data-it="Prestazione" data-tr="Hizmet">Leistung</th>
          <th data-de="VIP · € 4.350" data-en="VIP · €4,350" data-fr="VIP · 4 350 €" data-nl="VIP · € 4.350" data-it="VIP · 4.350 €" data-tr="VIP · 4.350 €">VIP · € 4.350</th>
          <th data-de="Komfort · € 3.950" data-en="Comfort · €3,950" data-fr="Confort · 3 950 €" data-nl="Comfort · € 3.950" data-it="Comfort · 3.950 €" data-tr="Konfor · 3.950 €">Komfort · € 3.950</th>
          <th data-de="Basis · € 2.650" data-en="Basic · €2,650" data-fr="Base · 2 650 €" data-nl="Basis · € 2.650" data-it="Base · 2.650 €" data-tr="Temel · 2.650 €">Basis · € 2.650</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row" data-de="Kostenlose Erstberatung" data-en="Free initial consultation" data-fr="Première consultation gratuite" data-nl="Gratis eerste consult" data-it="Prima consulenza gratuita" data-tr="Ücretsiz ilk danışma">Kostenlose Erstberatung</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="Kostenlose Haaranalyse" data-en="Free hair analysis" data-fr="Analyse capillaire gratuite" data-nl="Gratis haaranalyse" data-it="Analisi dei capelli gratuita" data-tr="Ücretsiz saç analizi">Kostenlose Haaranalyse</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="Individuelle Behandlungsplanung" data-en="Individual treatment planning" data-fr="Planification personnalisée du traitement" data-nl="Individuele behandelplanning" data-it="Pianificazione personalizzata del trattamento" data-tr="Kişiye özel tedavi planlaması">Individuelle Behandlungsplanung</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="Präzise Anzeichnung der Haarlinie" data-en="Precise hairline design" data-fr="Tracé précis de la ligne capillaire" data-nl="Precieze aftekening van de haarlijn" data-it="Disegno preciso dell'attaccatura" data-tr="Hassas saç çizgisi tasarımı">Präzise Anzeichnung der Haarlinie</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="Haartransplantation (DHI/FUE)" data-en="Hair transplant (DHI/FUE)" data-fr="Greffe de cheveux (DHI/FUE)" data-nl="Haartransplantatie (DHI/FUE)" data-it="Trapianto di capelli (DHI/FUE)" data-tr="Saç ekimi (DHI/FUE)">Haartransplantation (DHI/FUE)</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="PRP-Eigenblutbehandlung" data-en="PRP treatment" data-fr="Traitement PRP" data-nl="PRP-behandeling" data-it="Trattamento PRP" data-tr="PRP tedavisi">PRP-Eigenblutbehandlung</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="Medikamente für die erste Woche" data-en="Medication for the first week" data-fr="Médicaments pour la première semaine" data-nl="Medicatie voor de eerste week" data-it="Farmaci per la prima settimana" data-tr="İlk hafta için ilaçlar">Medikamente für die erste Woche</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="Zweimal ärztliche Nachbehandlung" data-en="Two medical follow-ups" data-fr="Deux suivis médicaux" data-nl="Twee medische nacontroles" data-it="Due controlli medici" data-tr="İki kez tıbbi kontrol">Zweimal ärztliche Nachbehandlung</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="Deutschsprachige Betreuung" data-en="German-speaking support" data-fr="Accompagnement en allemand" data-nl="Duitstalige begeleiding" data-it="Assistenza in lingua tedesca" data-tr="Almanca dil desteği">Deutschsprachige Betreuung</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="3 Übernachtungen im Partnerhotel" data-en="3 nights at the partner hotel" data-fr="3 nuits à l'hôtel partenaire" data-nl="3 overnachtingen in het partnerhotel" data-it="3 notti nell'hotel partner" data-tr="Partner otelde 3 gece konaklama">3 Übernachtungen im Partnerhotel</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td><td><span class="pr-no">✕</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="Flughafentransfer (Flughafen ↔ Hotel)" data-en="Airport transfer (airport ↔ hotel)" data-fr="Transfert aéroport (aéroport ↔ hôtel)" data-nl="Luchthaventransfer (luchthaven ↔ hotel)" data-it="Transfer aeroportuale (aeroporto ↔ hotel)" data-tr="Havaalanı transferi (havaalanı ↔ otel)">Flughafentransfer (Flughafen ↔ Hotel)</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-yes">✓</span></td><td><span class="pr-no">✕</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="Geführte Istanbul-Tour" data-en="Guided Istanbul tour" data-fr="Visite guidée d'Istanbul" data-nl="Begeleide Istanbul-tour" data-it="Tour guidato di Istanbul" data-tr="Rehberli İstanbul turu">Geführte Istanbul-Tour</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-no">✕</span></td><td><span class="pr-no">✕</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="Bosporus-Schifffahrt (ca. 2,5 Stunden)" data-en="Bosphorus cruise (approx. 2.5 hours)" data-fr="Croisière sur le Bosphore (env. 2,5 heures)" data-nl="Bosporus-cruise (ca. 2,5 uur)" data-it="Crociera sul Bosforo (ca. 2,5 ore)" data-tr="Boğaz turu (yaklaşık 2,5 saat)">Bosporus-Schifffahrt (ca. 2,5 Stunden)</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-no">✕</span></td><td><span class="pr-no">✕</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="Metrokarte für Sehenswürdigkeiten" data-en="Metro card for the sights" data-fr="Carte de métro pour les sites touristiques" data-nl="Metrokaart voor de bezienswaardigheden" data-it="Tessera della metro per le attrazioni" data-tr="Gezilecek yerler için metro kartı">Metrokarte für Sehenswürdigkeiten</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-no">✕</span></td><td><span class="pr-no">✕</span></td>
        </tr>
        <tr>
          <th scope="row" data-de="Persönliche VIP-Betreuung" data-en="Personal VIP support" data-fr="Accompagnement VIP personnalisé" data-nl="Persoonlijke VIP-begeleiding" data-it="Assistenza VIP personale" data-tr="Kişisel VIP hizmeti">Persönliche VIP-Betreuung</th>
          <td><span class="pr-yes">✓</span></td><td><span class="pr-no">✕</span></td><td><span class="pr-no">✕</span></td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <th scope="row" data-de="Paketpreis" data-en="Package price" data-fr="Prix du forfait" data-nl="Pakketprijs" data-it="Prezzo del pacchetto" data-tr="Paket fiyatı">Paketpreis</th>
          <td data-de="€ 4.350" data-en="€4,350" data-fr="4 350 €" data-nl="€ 4.350" data-it="4.350 €" data-tr="4.350 €">€ 4.350</td>
          <td data-de="€ 3.950" data-en="€3,950" data-fr="3 950 €" data-nl="€ 3.950" data-it="3.950 €" data-tr="3.950 €">€ 3.950</td>
          <td data-de="€ 2.650" data-en="€2,650" data-fr="2 650 €" data-nl="€ 2.650" data-it="2.650 €" data-tr="2.650 €">€ 2.650</td>
        </tr>
      </tfoot>
    </table>
  </div>

  <div class="pr-notes">
    <div class="pr-note">
      <b data-de="Fester Paketpreis" data-en="Fixed package price" data-fr="Prix forfaitaire fixe" data-nl="Vaste pakketprijs" data-it="Prezzo fisso del pacchetto" data-tr="Sabit paket fiyatı">Fester Paketpreis</b>
      <p data-de="Die genannten Preise sind Komplettpreise für das jeweilige Paket. Alle enthaltenen Leistungen sind oben aufgeführt." data-en="The prices shown are complete prices for the respective package. Everything included is listed above." data-fr="Les prix indiqués sont des prix complets pour le forfait concerné. Toutes les prestations incluses sont listées ci-dessus." data-nl="De genoemde prijzen zijn complete prijzen voor het betreffende pakket. Alles wat inbegrepen is, staat hierboven vermeld." data-it="I prezzi indicati sono prezzi completi per il rispettivo pacchetto. Tutto ciò che è incluso è elencato sopra." data-tr="Belirtilen fiyatlar ilgili paketin tam fiyatlarıdır. Dahil olan her şey yukarıda listelenmiştir.">Die genannten Preise sind Komplettpreise für das jeweilige Paket. Alle enthaltenen Leistungen sind oben aufgeführt.</p>
    </div>
    <div class="pr-note">
      <b data-de="Technik nach Befund" data-en="Technique based on assessment" data-fr="Technique selon le diagnostic" data-nl="Techniek op basis van diagnose" data-it="Tecnica in base alla valutazione" data-tr="Değerlendirmeye göre teknik">Technik nach Befund</b>
      <p data-de="Ob DHI oder FUE zum Einsatz kommt, entscheidet die medizinische Empfehlung nach Ihrer Haaranalyse. Der Paketpreis bleibt davon unberührt." data-en="Whether DHI or FUE is used follows the medical recommendation after your hair analysis. The package price stays the same either way." data-fr="Le choix entre DHI et FUE dépend de la recommandation médicale après votre analyse capillaire. Le prix du forfait reste inchangé." data-nl="Of DHI of FUE wordt gebruikt, volgt uit het medisch advies na uw haaranalyse. De pakketprijs blijft hetzelfde." data-it="Se venga utilizzata la tecnica DHI o FUE dipende dall'indicazione medica dopo l'analisi dei capelli. Il prezzo del pacchetto non cambia." data-tr="DHI mi yoksa FUE mi kullanılacağı, saç analizinizin ardından verilen tıbbi öneriye bağlıdır. Paket fiyatı değişmez.">Ob DHI oder FUE zum Einsatz kommt, entscheidet die medizinische Empfehlung nach Ihrer Haaranalyse. Der Paketpreis bleibt davon unberührt.</p>
    </div>
    <div class="pr-note">
      <b data-de="Offene Fragen?" data-en="Any open questions?" data-fr="Des questions ?" data-nl="Nog vragen?" data-it="Domande aperte?" data-tr="Sorularınız mı var?">Offene Fragen?</b>
      <p data-de="Was über das Paket hinaus benötigt wird, klären wir individuell und unverbindlich in Ihrer kostenlosen Beratung." data-en="Anything you need beyond the package is clarified individually and without obligation in your free consultation." data-fr="Tout ce qui dépasse le forfait est clarifié individuellement et sans engagement lors de votre consultation gratuite." data-nl="Alles wat u buiten het pakket nodig heeft, bespreken we individueel en vrijblijvend tijdens uw gratis consult." data-it="Tutto ciò che serve oltre al pacchetto viene chiarito individualmente e senza impegno durante la consulenza gratuita." data-tr="Paketin ötesinde ihtiyaç duyduğunuz her şey, ücretsiz danışmanızda kişisel olarak ve hiçbir yükümlülük olmadan netleştirilir.">Was über das Paket hinaus benötigt wird, klären wir individuell und unverbindlich in Ihrer kostenlosen Beratung.</p>
    </div>
  </div>
</section>

<div class="pr-band-wrap">
  <div class="pr-band">
    <h2 data-de="Welches Paket passt zu Ihnen?" data-en="Which package fits you?" data-fr="Quel forfait vous convient ?" data-nl="Welk pakket past bij u?" data-it="Quale pacchetto fa per te?" data-tr="Hangi paket size uygun?">Welches Paket passt zu Ihnen?</h2>
    <p data-de="Erstberatung und Haaranalyse sind in jedem Paket kostenlos und völlig unverbindlich. Wir sagen Ihnen ehrlich, was medizinisch sinnvoll ist." data-en="The initial consultation and hair analysis are free in every package and entirely without obligation. We will tell you honestly what makes medical sense." data-fr="La première consultation et l'analyse capillaire sont gratuites dans chaque forfait et sans aucun engagement. Nous vous dirons honnêtement ce qui est médicalement pertinent." data-nl="Het eerste consult en de haaranalyse zijn in elk pakket gratis en volledig vrijblijvend. We vertellen u eerlijk wat medisch zinvol is." data-it="La prima consulenza e l'analisi dei capelli sono gratuite in ogni pacchetto e senza alcun impegno. Ti diremo onestamente cosa ha senso dal punto di vista medico." data-tr="İlk danışma ve saç analizi her pakette ücretsizdir ve tamamen yükümlülüksüzdür. Tıbbi açıdan neyin anlamlı olduğunu size dürüstçe söyleriz.">Erstberatung und Haaranalyse sind in jedem Paket kostenlos und völlig unverbindlich. Wir sagen Ihnen ehrlich, was medizinisch sinnvoll ist.</p>
    <div class="pr-band-actions">
      <a class="pr-band-btn" href="<?= htmlspecialchars($consultHref, ENT_QUOTES) ?>" data-de="Kostenlose Beratung sichern" data-en="Book a free consultation" data-fr="Réserver une consultation gratuite" data-nl="Gratis consult aanvragen" data-it="Prenota una consulenza gratuita" data-tr="Ücretsiz danışma alın">Kostenlose Beratung sichern</a>
      <a class="pr-band-btn ghost" href="<?= htmlspecialchars(APEX_WHATSAPP_LINK, ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer" onclick="trackWhatsAppContact()">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.35 5.07L2 22l5.1-1.33C8.55 21.5 10.24 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm5.2 14.24c-.22.62-1.28 1.17-1.77 1.24-.45.07-.99.1-1.6-.1-.37-.12-.84-.27-1.44-.53-2.53-1.1-4.18-3.65-4.31-3.82-.13-.17-1.03-1.37-1.03-2.61 0-1.24.65-1.85.88-2.1.22-.25.5-.31.66-.31.17 0 .33 0 .48.01.15.01.36-.06.56.43.22.53.74 1.83.8 1.96.07.13.11.29.02.46-.09.17-.13.27-.26.42-.13.15-.27.33-.39.44-.13.13-.26.27-.11.53.15.26.66 1.09 1.42 1.76.98.87 1.8 1.14 2.06 1.27.26.13.41.11.56-.06.15-.18.63-.74.8-.99.17-.26.34-.21.57-.13.22.09 1.43.67 1.68.79.24.13.4.19.46.29.07.11.07.61-.15 1.24z"/></svg>
        <span data-de="Auf WhatsApp fragen" data-en="Ask on WhatsApp" data-fr="Demander sur WhatsApp" data-nl="Vraag het op WhatsApp" data-it="Chiedi su WhatsApp" data-tr="WhatsApp'tan sorun">Auf WhatsApp fragen</span>
      </a>
    </div>
  </div>
</div>

<?php include __DIR__ . '/includes/site-footer.php'; ?>

<a class="whatsapp-fab" href="<?= htmlspecialchars(APEX_WHATSAPP_LINK, ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp" onclick="trackWhatsAppContact()">
  <svg viewBox="0 0 32 32" fill="#fff" aria-hidden="true"><path d="M16.004 3C9.373 3 4 8.373 4 15.004c0 2.386.7 4.61 1.902 6.478L4 29l7.72-1.865a11.94 11.94 0 0 0 4.284.788h.001C22.635 27.923 28 22.55 28 15.918 28 9.287 22.635 3 16.004 3zm0 21.9h-.001a9.9 9.9 0 0 1-5.05-1.383l-.362-.215-4.583 1.107 1.128-4.47-.236-.376a9.86 9.86 0 0 1-1.516-5.263c0-5.468 4.45-9.917 9.923-9.917 2.65 0 5.14 1.033 7.014 2.909a9.85 9.85 0 0 1 2.905 7.019c0 5.468-4.45 9.589-9.222 9.589z"/><path d="M21.62 18.164c-.297-.148-1.758-.868-2.03-.967-.273-.099-.471-.148-.669.149-.198.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.149-1.254-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.058-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.148-.174.198-.298.297-.496.099-.198.05-.372-.025-.52-.074-.149-.669-1.612-.916-2.208-.242-.58-.487-.502-.669-.511l-.57-.01c-.198 0-.52.074-.792.372-.273.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.876 1.213 3.074.148.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.873.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
</a>

<script>
  // The consultation modal lives on the homepage, so the shared header's
  // CTA buttons (which call openConsult) navigate there instead of trying
  // to open a modal that does not exist on this page.
  function openConsult(e) {
    if (e) e.preventDefault();
    window.location.href = <?= json_encode($consultHref, JSON_UNESCAPED_SLASHES) ?>;
  }

  function trackWhatsAppContact() {
    if (window.__apexPixel) window.__apexPixel.track('Contact');
  }

  var APEX_TRANSLATED_LANGS = ['de', 'en', 'fr', 'nl', 'it', 'tr'];
  function applyLang(lang) {
    document.documentElement.lang = lang;
    var fallback = APEX_TRANSLATED_LANGS.indexOf(lang) === -1 ? 'en' : null;
    document.querySelectorAll('[data-de]').forEach(function (el) {
      var val = el.getAttribute('data-' + lang);
      if (val === null && fallback) val = el.getAttribute('data-' + fallback);
      if (val !== null) el.innerHTML = val;
    });
    document.querySelectorAll('.lang-switch-menu button').forEach(function (s) {
      s.className = s.getAttribute('data-lang') === lang ? 'active' : 'inactive';
    });
    document.querySelectorAll('.lang-switch-current').forEach(function (s) {
      s.textContent = lang.toUpperCase();
    });
  }
  document.querySelectorAll('.lang-switch-menu button').forEach(function (btn) {
    btn.addEventListener('click', function () {
      applyLang(btn.getAttribute('data-lang'));
      var ls = btn.closest('.lang-switch');
      if (ls) ls.classList.remove('open');
    });
  });
  // The server already rendered this page in the resolved language, so sync
  // the switcher's own state to it rather than repainting the whole page.
  applyLang(document.documentElement.lang || 'de');

  // Meta Pixel ViewContent: pricing is a high-intent page, so it earns its
  // own signal rather than relying on PageView alone. Gated by the same
  // consent logic as every other event: never before marketing consent, but
  // not missed either if consent is granted later in this same page view
  // (see onActivate in assets/meta-pixel.js).
  window.__apexPixel.onActivate(function () {
    window.__apexPixel.track('ViewContent');
  });
</script>

<?php include __DIR__ . '/includes/apex-ai-widget.php'; ?>

</body>
</html>
<?php echo apex_localize_output((string) ob_get_clean(), $currentLang); ?>
