<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/site-config.php';
require_once __DIR__ . '/includes/content.php';
require_once __DIR__ . '/includes/i18n.php';
require_once __DIR__ . '/includes/seo.php';
$currentLang = apex_current_lang();
$langBase = apex_lang_base();

// Copy and prices come from the admin panel (data/content/prices.json, edited
// under Website content > Prices page). Rendering them server-side rather than
// letting content-loader.js swap them in keeps the English pages correct for
// crawlers that never run the JS.
$pricesContent = apex_get_page_content('prices') ?? [];
$prHero = $pricesContent['hero'] ?? [];
$prShowcase = $pricesContent['showcase'] ?? [];
$prPackages = $pricesContent['packages']['items'] ?? [];
$prComparison = $pricesContent['comparison'] ?? [];
$prNotes = $pricesContent['notes']['items'] ?? [];
$prCta = $pricesContent['cta'] ?? [];
// Packages are keyed so the template can pair each one with its feature list,
// which stays here rather than in the CMS: the features are structural (they
// drive the comparison matrix too) and change far less often than a price.
$prByKey = [];
foreach ($prPackages as $p) {
    if (!empty($p['key'])) {
        $prByKey[$p['key']] = $p;
    }
}
$prPrice = static function (string $key) use ($prByKey) {
    return $prByKey[$key]['price'] ?? null;
};
// Column headings pair a short tier label with the price. The label stays in
// the template (the full CMS name, "VIP-Paket", is too wide for a 130px
// column) but the number is taken from the CMS, so the table can never quote a
// price the cards disagree with.
$prColHead = static function (string $key, array $short) use ($prByKey): array {
    $price = $prByKey[$key]['price'] ?? [];
    $out = [];
    foreach (APEX_CONTENT_LANGS as $l) {
        $p = is_array($price) ? ($price[$l] ?? ($price['en'] ?? '')) : '';
        $out[$l] = ($short[$l] ?? $short['en'] ?? '') . " \u{00B7} " . $p;
    }
    return $out;
};
// Title, description, share image and the Google visibility switch are edited
// in the admin panel under Website content > Search engine listing; the
// fallbacks live in includes/seo.php.
$seoPage = 'prices';
$seoTitle = apex_seo_title($seoPage);
$seoDescription = apex_seo_description($seoPage);
$seoCanonicalPath = apex_seo_path($seoPage);
$seoNoindex = apex_seo_noindex($seoPage);

// Consultation CTA target. The consult modal itself lives on the homepage
// (index.php reads ?open=consult), so every CTA here routes there rather
// than duplicating ~400 lines of modal markup and its multi-step JS.
$consultHref = ($langBase === '' ? '' : $langBase) . '/consult';

// Offer schema for the three packages. Modelled as a Service with an
// OfferCatalog rather than a Product, since this is a medical service
// package and not a physical good.
$pricesUrl = rtrim(APEX_SITE_URL, '/') . '/' . ltrim(trim($langBase . '/' . $seoCanonicalPath, '/'), '/');
// Schema.org wants a bare number, but the CMS stores the price as it should be
// displayed ("€ 4.350" / "4 350 €"), so strip everything that is not a digit.
// Editing the price in the admin therefore updates the structured data too.
$packageOffers = [];
foreach ($prPackages as $p) {
    $digits = preg_replace('/\D+/', '', apex_cms_value($p['price'] ?? null, 'en'));
    if ($digits === '') {
        continue;
    }
    $packageOffers[] = [
        'id' => $p['key'] ?? '',
        'price' => $digits,
        'de' => apex_cms_value($p['name'] ?? null, 'de'),
        'en' => apex_cms_value($p['name'] ?? null, 'en'),
    ];
}
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
  .pr-hero { position: relative; padding: 66px 48px 34px; background: #ffffff; overflow: hidden; }
  .pr-hero-bg {
    position: absolute; inset: 0;
    background-image:
      radial-gradient(circle at 12% 12%, rgba(125,211,252,0.46) 0%, transparent 46%),
      radial-gradient(circle at 90% 4%, rgba(94,185,224,0.40) 0%, transparent 50%),
      radial-gradient(circle at 50% 120%, rgba(37,99,235,0.20) 0%, transparent 55%);
    z-index: 0;
  }
  .pr-hero-inner { position: relative; z-index: 1; max-width: 820px; margin: 0 auto; text-align: center; }
  .pr-hero .eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 700; color: #1d2f3d;
    background: rgba(255,255,255,0.62); border: 1px solid rgba(255,255,255,0.9);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 8px 20px -12px rgba(37,99,235,0.4);
    padding: 7px 15px; border-radius: 999px; margin-bottom: 20px;
    backdrop-filter: blur(18px) saturate(1.7);
    -webkit-backdrop-filter: blur(18px) saturate(1.7);
  }
  .pr-hero .eyebrow .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--teal-500); box-shadow: 0 0 0 3px rgba(14,165,233,0.2); }
  .pr-hero h1 {
    font-size: 40px; line-height: 1.14; font-weight: 800; letter-spacing: -0.022em;
    color: #1a2733; margin-bottom: 16px;
  }
  .pr-hero h1 span {
    background: linear-gradient(100deg, var(--teal-600), var(--blue-700));
    -webkit-background-clip: text; background-clip: text; color: transparent;
  }
  .pr-hero p { font-size: 16px; line-height: 1.6; color: var(--ink-soft); max-width: 640px; margin: 0 auto; }

  /* ---- PACKAGE SHOWCASE (deep band) ----
     The site's premium moments (the three-step section over the clinic photo,
     the night-earth network globe) all put glass on a deep navy ground. On the
     pale page background the same cards had nothing to refract and read flat,
     so the tiers get that same dark stage here. */
  .pr-showcase {
    position: relative; overflow: hidden;
    margin-top: 26px; padding: 64px 48px 68px;
    /* Light pools on the left, where the flagship tier sits, and falls away
       to deep navy on the right so the eye lands on VIP first. */
    background:
      radial-gradient(115% 95% at 16% 6%, rgba(2,132,199,0.50) 0%, transparent 56%),
      radial-gradient(85% 80% at 30% 0%, rgba(124,58,237,0.26) 0%, transparent 52%),
      radial-gradient(100% 90% at 45% 112%, rgba(14,165,233,0.26) 0%, transparent 58%),
      linear-gradient(150deg, #0c1d33 0%, #0d2137 38%, #091524 100%);
  }
  /* Soft light blooms drifting behind the glass, like the globe atmosphere. */
  .pr-showcase::before {
    content: ''; position: absolute; inset: -20% -10%;
    background:
      radial-gradient(closest-side, rgba(56,189,248,0.40), transparent) 12% 26% / 46% 56% no-repeat,
      radial-gradient(closest-side, rgba(139,92,246,0.22), transparent) 34% 4% / 34% 40% no-repeat,
      radial-gradient(closest-side, rgba(37,99,235,0.22), transparent) 78% 92% / 44% 46% no-repeat;
    filter: blur(6px);
    animation: prDrift 18s ease-in-out infinite alternate;
    pointer-events: none;
  }
  @keyframes prDrift {
    from { transform: translate3d(-1.5%, -1%, 0) scale(1); }
    to   { transform: translate3d(1.5%, 1.5%, 0) scale(1.06); }
  }
  @media (prefers-reduced-motion: reduce) { .pr-showcase::before { animation: none; } }
  /* Hairline light seams top and bottom, so the band reads as a pane of glass
     laid over the page rather than a flat colour block. */
  .pr-showcase::after {
    content: ''; position: absolute; left: 0; right: 0; top: 0; height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.35), transparent);
  }
  .pr-showcase-inner { position: relative; z-index: 1; max-width: 1180px; margin: 0 auto; }
  .pr-showcase-head { text-align: center; max-width: 660px; margin: 0 auto 34px; }
  .pr-showcase-head h2 { font-size: 25px; font-weight: 800; color: #fff; letter-spacing: -0.01em; margin-bottom: 8px; }
  .pr-showcase-head p { font-size: 14.5px; line-height: 1.6; color: rgba(226,242,255,0.72); }

  .pr-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; align-items: stretch; }
  .pr-card {
    position: relative;
    display: flex; flex-direction: column;
    border-radius: 24px; padding: 28px 26px 26px;
    background: linear-gradient(168deg, rgba(255,255,255,0.13), rgba(255,255,255,0.055));
    backdrop-filter: blur(30px) saturate(1.6);
    -webkit-backdrop-filter: blur(30px) saturate(1.6);
    border: 1px solid rgba(255,255,255,0.16);
    box-shadow:
      inset 0 1px 0 rgba(255,255,255,0.35),
      inset 0 -30px 60px -40px rgba(56,189,248,0.5),
      0 26px 50px -24px rgba(3,10,22,0.85);
    transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
    scroll-margin-top: 130px;
  }
  /* Specular sheen across the top edge. */
  .pr-card::before {
    content: ''; position: absolute; inset: 0; border-radius: 24px; pointer-events: none;
    background: linear-gradient(150deg, rgba(255,255,255,0.20) 0%, rgba(255,255,255,0.05) 26%, transparent 52%);
  }
  .pr-card:hover {
    transform: translateY(-6px);
    background: linear-gradient(168deg, rgba(255,255,255,0.17), rgba(255,255,255,0.075));
    box-shadow:
      inset 0 1px 0 rgba(255,255,255,0.45),
      inset 0 -30px 60px -40px rgba(56,189,248,0.65),
      0 38px 66px -24px rgba(3,10,22,0.9);
  }
  .pr-card > * { position: relative; z-index: 1; }

  /* Flagship tier: a true gradient rim plus an outer bloom. */
  .pr-card.featured {
    background: linear-gradient(168deg, rgba(255,255,255,0.22), rgba(255,255,255,0.085));
    border-color: transparent;
    box-shadow:
      inset 0 1px 0 rgba(255,255,255,0.55),
      inset 0 -34px 70px -40px rgba(56,189,248,0.8),
      0 0 90px -14px rgba(56,189,248,0.55),
      0 34px 60px -24px rgba(3,10,22,0.9);
  }
  .pr-card.featured::after {
    content: ''; position: absolute; inset: 0; border-radius: 24px; padding: 2.5px;
    background: linear-gradient(140deg, #e0f7ff 0%, #7dd3fc 22%, #38bdf8 48%, #6366f1 78%, #a78bfa 100%);
    -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    -webkit-mask-composite: xor; mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    mask-composite: exclude;
    pointer-events: none;
  }
  .pr-card.featured:hover { box-shadow:
      inset 0 1px 0 rgba(255,255,255,0.55),
      inset 0 -34px 70px -40px rgba(56,189,248,0.9),
      0 0 90px -16px rgba(56,189,248,0.6),
      0 44px 74px -24px rgba(3,10,22,0.92); }

  .pr-badge {
    display: inline-block; align-self: flex-start;
    font-size: 10.5px; font-weight: 800; letter-spacing: 0.07em; text-transform: uppercase;
    color: #d8f1ff; background: rgba(125,211,252,0.16);
    border: 1px solid rgba(125,211,252,0.32);
    padding: 5px 12px; border-radius: 999px; margin-bottom: 14px;
  }
  .pr-card.featured .pr-badge {
    color: #06263c; border-color: transparent;
    background: linear-gradient(100deg, #7dd3fc, #38bdf8 55%, #60a5fa);
    box-shadow: 0 8px 20px -8px rgba(56,189,248,0.8);
  }
  .pr-name { font-size: 21px; font-weight: 800; color: #fff; margin-bottom: 10px; letter-spacing: -0.01em; }
  .pr-price {
    font-size: 42px; font-weight: 800; line-height: 1.04; letter-spacing: -0.025em;
    background: linear-gradient(100deg, #ffffff 0%, #bae6fd 45%, #7dd3fc 100%);
    -webkit-background-clip: text; background-clip: text; color: transparent;
    margin-bottom: 4px;
    text-shadow: 0 8px 30px rgba(56,189,248,0.25);
  }
  .pr-price-note { font-size: 11.5px; font-weight: 700; color: rgba(125,211,252,0.9); text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 15px; }
  .pr-desc { font-size: 13.5px; color: rgba(222,239,255,0.78); line-height: 1.6; margin-bottom: 18px; }
  .pr-divider { height: 1px; background: linear-gradient(90deg, rgba(125,211,252,0.5), rgba(255,255,255,0.06)); margin-bottom: 17px; }

  .pr-feats { display: grid; gap: 10px; margin-bottom: 24px; }
  .pr-feat { display: flex; align-items: flex-start; gap: 10px; }
  .pr-feat .tick {
    flex-shrink: 0; width: 19px; height: 19px; border-radius: 50%; margin-top: 1px;
    background: linear-gradient(135deg, #38bdf8, #2563eb); color: #fff;
    display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700;
    box-shadow: 0 4px 10px -3px rgba(56,189,248,0.7);
  }
  .pr-feat span { font-size: 13px; color: rgba(233,245,255,0.9); line-height: 1.5; }
  /* Perks unique to this tier read brighter than the shared medical base. */
  .pr-feat.plus span { color: #fff; font-weight: 600; }
  .pr-feat.plus .tick { background: linear-gradient(135deg, #7dd3fc, #8b5cf6); }

  .pr-cta {
    margin-top: auto; display: block; text-align: center;
    padding: 13.5px 20px; border-radius: 13px;
    font-size: 14.5px; font-weight: 700;
    border: 1px solid rgba(255,255,255,0.28);
    background: rgba(255,255,255,0.10);
    color: #eaf6ff;
    backdrop-filter: blur(10px);
    transition: transform 0.18s ease, background 0.18s ease, box-shadow 0.18s ease;
  }
  .pr-cta:hover { background: rgba(255,255,255,0.2); transform: translateY(-2px); box-shadow: 0 14px 28px -14px rgba(0,0,0,0.7); }
  .pr-card.featured .pr-cta {
    border-color: transparent; color: #05243a;
    background: linear-gradient(100deg, #a5e8ff 0%, #7dd3fc 45%, #93c5fd 100%);
    box-shadow: 0 16px 32px -12px rgba(56,189,248,0.75), inset 0 1px 0 rgba(255,255,255,0.7);
  }
  .pr-card.featured .pr-cta:hover { transform: translateY(-3px); box-shadow: 0 22px 42px -12px rgba(56,189,248,0.9), inset 0 1px 0 rgba(255,255,255,0.8); }

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
    .pr-showcase { padding: 44px 20px 48px; margin-top: 18px; }
    .pr-showcase-head { margin-bottom: 26px; }
    .pr-showcase-head h2 { font-size: 21px; }
    .pr-cards { grid-template-columns: 1fr; gap: 16px; }
    .pr-card { padding: 24px 22px 22px; }
    .pr-price { font-size: 38px; }
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
    <div class="eyebrow"><span class="dot"></span><span<?= apex_cms_attrs($prHero['eyebrow'] ?? null) ?>><?= apex_cms_value($prHero['eyebrow'] ?? null, $currentLang) ?></span></div>
    <h1<?= apex_cms_attrs($prHero['heading'] ?? null) ?>><?= apex_cms_value($prHero['heading'] ?? null, $currentLang) ?></h1>
    <p<?= apex_cms_attrs($prHero['sub'] ?? null) ?>><?= apex_cms_value($prHero['sub'] ?? null, $currentLang) ?></p>
  </div>
</section>

<section class="pr-showcase">
  <div class="pr-showcase-inner">
    <div class="pr-showcase-head">
      <h2<?= apex_cms_attrs($prShowcase['heading'] ?? null) ?>><?= apex_cms_value($prShowcase['heading'] ?? null, $currentLang) ?></h2>
      <p<?= apex_cms_attrs($prShowcase['sub'] ?? null) ?>><?= apex_cms_value($prShowcase['sub'] ?? null, $currentLang) ?></p>
    </div>
    <div class="pr-cards">

    <!-- ===== VIP - highest tier, listed first ===== -->
    <div class="pr-card featured" id="vip">
      <span class="pr-badge"<?= apex_cms_attrs($prByKey['vip']['badge'] ?? null) ?>><?= apex_cms_value($prByKey['vip']['badge'] ?? null, $currentLang) ?></span>
      <div class="pr-name"<?= apex_cms_attrs($prByKey['vip']['name'] ?? null) ?>><?= apex_cms_value($prByKey['vip']['name'] ?? null, $currentLang) ?></div>
      <div class="pr-price"<?= apex_cms_attrs($prByKey['vip']['price'] ?? null) ?>><?= apex_cms_value($prByKey['vip']['price'] ?? null, $currentLang) ?></div>
      <div class="pr-price-note"<?= apex_cms_attrs($prByKey['vip']['priceNote'] ?? null) ?>><?= apex_cms_value($prByKey['vip']['priceNote'] ?? null, $currentLang) ?></div>
      <p class="pr-desc"<?= apex_cms_attrs($prByKey['vip']['description'] ?? null) ?>><?= apex_cms_value($prByKey['vip']['description'] ?? null, $currentLang) ?></p>
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
      <span class="pr-badge"<?= apex_cms_attrs($prByKey['komfort']['badge'] ?? null) ?>><?= apex_cms_value($prByKey['komfort']['badge'] ?? null, $currentLang) ?></span>
      <div class="pr-name"<?= apex_cms_attrs($prByKey['komfort']['name'] ?? null) ?>><?= apex_cms_value($prByKey['komfort']['name'] ?? null, $currentLang) ?></div>
      <div class="pr-price"<?= apex_cms_attrs($prByKey['komfort']['price'] ?? null) ?>><?= apex_cms_value($prByKey['komfort']['price'] ?? null, $currentLang) ?></div>
      <div class="pr-price-note"<?= apex_cms_attrs($prByKey['komfort']['priceNote'] ?? null) ?>><?= apex_cms_value($prByKey['komfort']['priceNote'] ?? null, $currentLang) ?></div>
      <p class="pr-desc"<?= apex_cms_attrs($prByKey['komfort']['description'] ?? null) ?>><?= apex_cms_value($prByKey['komfort']['description'] ?? null, $currentLang) ?></p>
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
      <span class="pr-badge"<?= apex_cms_attrs($prByKey['basis']['badge'] ?? null) ?>><?= apex_cms_value($prByKey['basis']['badge'] ?? null, $currentLang) ?></span>
      <div class="pr-name"<?= apex_cms_attrs($prByKey['basis']['name'] ?? null) ?>><?= apex_cms_value($prByKey['basis']['name'] ?? null, $currentLang) ?></div>
      <div class="pr-price"<?= apex_cms_attrs($prByKey['basis']['price'] ?? null) ?>><?= apex_cms_value($prByKey['basis']['price'] ?? null, $currentLang) ?></div>
      <div class="pr-price-note"<?= apex_cms_attrs($prByKey['basis']['priceNote'] ?? null) ?>><?= apex_cms_value($prByKey['basis']['priceNote'] ?? null, $currentLang) ?></div>
      <p class="pr-desc"<?= apex_cms_attrs($prByKey['basis']['description'] ?? null) ?>><?= apex_cms_value($prByKey['basis']['description'] ?? null, $currentLang) ?></p>
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
</section>

<section class="pr-section" id="vergleich">
  <div class="pr-section-head">
    <h2<?= apex_cms_attrs($prComparison['heading'] ?? null) ?>><?= apex_cms_value($prComparison['heading'] ?? null, $currentLang) ?></h2>
    <p<?= apex_cms_attrs($prComparison['sub'] ?? null) ?>><?= apex_cms_value($prComparison['sub'] ?? null, $currentLang) ?></p>
  </div>

  <div class="pr-table-wrap">
    <table class="pr-table">
      <thead>
        <tr>
          <th data-de="Leistung" data-en="Service" data-fr="Prestation" data-nl="Dienst" data-it="Prestazione" data-tr="Hizmet">Leistung</th>
          <th<?= apex_cms_attrs($prColHead('vip', ['de'=>'VIP','en'=>'VIP','fr'=>'VIP','nl'=>'VIP','it'=>'VIP','tr'=>'VIP'])) ?>><?= apex_cms_value($prColHead('vip', ['de'=>'VIP','en'=>'VIP','fr'=>'VIP','nl'=>'VIP','it'=>'VIP','tr'=>'VIP']), $currentLang) ?></th>
          <th<?= apex_cms_attrs($prColHead('komfort', ['de'=>'Komfort','en'=>'Comfort','fr'=>'Confort','nl'=>'Comfort','it'=>'Comfort','tr'=>'Konfor'])) ?>><?= apex_cms_value($prColHead('komfort', ['de'=>'Komfort','en'=>'Comfort','fr'=>'Confort','nl'=>'Comfort','it'=>'Comfort','tr'=>'Konfor']), $currentLang) ?></th>
          <th<?= apex_cms_attrs($prColHead('basis', ['de'=>'Basis','en'=>'Basic','fr'=>'Base','nl'=>'Basis','it'=>'Base','tr'=>'Temel'])) ?>><?= apex_cms_value($prColHead('basis', ['de'=>'Basis','en'=>'Basic','fr'=>'Base','nl'=>'Basis','it'=>'Base','tr'=>'Temel']), $currentLang) ?></th>
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
          <td<?= apex_cms_attrs($prPrice('vip')) ?>><?= apex_cms_value($prPrice('vip'), $currentLang) ?></td>
          <td<?= apex_cms_attrs($prPrice('komfort')) ?>><?= apex_cms_value($prPrice('komfort'), $currentLang) ?></td>
          <td<?= apex_cms_attrs($prPrice('basis')) ?>><?= apex_cms_value($prPrice('basis'), $currentLang) ?></td>
        </tr>
      </tfoot>
    </table>
  </div>

  <div class="pr-notes">
    <div class="pr-note">
      <b<?= apex_cms_attrs($prNotes[0]['title'] ?? null) ?>><?= apex_cms_value($prNotes[0]['title'] ?? null, $currentLang) ?></b>
      <p<?= apex_cms_attrs($prNotes[0]['body'] ?? null) ?>><?= apex_cms_value($prNotes[0]['body'] ?? null, $currentLang) ?></p>
    </div>
    <div class="pr-note">
      <b<?= apex_cms_attrs($prNotes[1]['title'] ?? null) ?>><?= apex_cms_value($prNotes[1]['title'] ?? null, $currentLang) ?></b>
      <p<?= apex_cms_attrs($prNotes[1]['body'] ?? null) ?>><?= apex_cms_value($prNotes[1]['body'] ?? null, $currentLang) ?></p>
    </div>
    <div class="pr-note">
      <b<?= apex_cms_attrs($prNotes[2]['title'] ?? null) ?>><?= apex_cms_value($prNotes[2]['title'] ?? null, $currentLang) ?></b>
      <p<?= apex_cms_attrs($prNotes[2]['body'] ?? null) ?>><?= apex_cms_value($prNotes[2]['body'] ?? null, $currentLang) ?></p>
    </div>
  </div>
</section>

<div class="pr-band-wrap">
  <div class="pr-band">
    <h2<?= apex_cms_attrs($prCta['heading'] ?? null) ?>><?= apex_cms_value($prCta['heading'] ?? null, $currentLang) ?></h2>
    <p<?= apex_cms_attrs($prCta['sub'] ?? null) ?>><?= apex_cms_value($prCta['sub'] ?? null, $currentLang) ?></p>
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
