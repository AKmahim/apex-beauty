<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/site-config.php';
require_once __DIR__ . '/includes/i18n.php';
$currentLang = apex_current_lang();
$seoTitle = $currentLang === 'en'
    ? 'Hairpedia: Causes, Diagnosis & Treatment of Hair Loss | Apex Beauty'
    : 'Hairpedia: Ursachen, Diagnose & Behandlung von Haarausfall | Apex Beauty';
$seoDescription = $currentLang === 'en'
    ? 'Everything about hair loss: causes, types, diagnosis, treatment options and hair transplantation, explained clearly by Apex Beauty.'
    : 'Alles über Haarausfall: Ursachen, Arten, Diagnose, Behandlungsmöglichkeiten und Haartransplantation, verständlich erklärt von Apex Beauty.';
$seoCanonicalPath = 'hairpedia';
$medicalWebPageSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'MedicalWebPage',
    'name' => $seoTitle,
    'description' => $seoDescription,
    'url' => rtrim(APEX_SITE_URL, '/') . '/hairpedia.php',
    'about' => ['@type' => 'MedicalCondition', 'name' => 'Androgenetic alopecia (hair loss)'],
    'publisher' => ['@type' => 'MedicalOrganization', 'name' => APEX_BUSINESS_NAME],
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
<script type="application/ld+json"><?= json_encode($medicalWebPageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
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

  .cta-ghost {
    border: 1.5px solid rgba(255,255,255,0.55);
    background: rgba(255,255,255,0.22);
    backdrop-filter: blur(12px) saturate(1.3);
    -webkit-backdrop-filter: blur(12px) saturate(1.3);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.5), 0 4px 16px -10px rgba(20,40,60,0.25);
    color: var(--ink);
    font-size: 14px;
    font-weight: 600;
    padding: 10.5px 20px;
    border-radius: 10px;
  }

  /* ---- HAIRPEDIA HERO ---- */
  .hp-hero {
    position: relative;
    padding: 64px 48px 36px;
    background: #ffffff;
    overflow: hidden;
  }
  .hp-hero-bg {
    position: absolute; inset: 0;
    background-image:
      radial-gradient(circle at 12% 15%, rgba(125,211,252,0.32) 0%, transparent 45%),
      radial-gradient(circle at 92% 8%, rgba(94,185,224,0.28) 0%, transparent 50%),
      radial-gradient(circle at 85% 95%, rgba(61,111,214,0.16) 0%, transparent 50%);
    z-index: 0;
  }
  .hp-hero-inner { position: relative; z-index: 1; max-width: 860px; margin: 0 auto; text-align: center; }
  .hp-hero .eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 700; color: #1d2f3d;
    background: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
    padding: 6px 14px; border-radius: 999px; margin-bottom: 20px;
    backdrop-filter: blur(16px) saturate(1.5);
  }
  .hp-hero .eyebrow .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--teal-500); }
  .hp-hero h1 {
    font-size: 44px; line-height: 1.16; font-weight: 800; letter-spacing: -0.02em;
    color: #1a2733; margin-bottom: 16px;
  }
  .hp-hero h1 span {
    background: linear-gradient(100deg, var(--teal-600), var(--blue-700));
    -webkit-background-clip: text; background-clip: text; color: transparent;
  }
  /* Secondary line under the big "Hairpedia" brand word — same gradient
     fill, just sized down between the h1 and the intro paragraph. */
  .hp-hero h1 span.hp-hero-tagline {
    display: block;
    font-size: 22px; font-weight: 600; letter-spacing: 0; line-height: 1.35;
    margin-top: 8px;
  }
  .hp-hero p { font-size: 16px; line-height: 1.6; color: var(--ink-soft); max-width: 620px; margin: 0 auto; }

  /* ---- QUICK NAV ---- */
  .hp-quicknav-wrap {
    /* Must match the site nav's real rendered height (95px desktop, 59px
       once the bar collapses to the hamburger at <=1240px in
       includes/site-header.php) or this bar sticks partly underneath the
       header instead of flush below it. */
    position: sticky; top: 95px; z-index: 40;
    background: rgba(255,255,255,0.5);
    backdrop-filter: blur(28px) saturate(2.1);
    -webkit-backdrop-filter: blur(28px) saturate(2.1);
    border-bottom: 1px solid rgba(255,255,255,0.7);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.7), 0 8px 24px -18px rgba(37,99,235,0.18);
    padding: 12px 0;
  }
  .hp-quicknav {
    display: flex; gap: 10px; overflow-x: auto; padding: 0 48px;
    scrollbar-width: none;
  }
  .hp-quicknav::-webkit-scrollbar { display: none; }
  .hp-quicknav a {
    flex-shrink: 0; display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 16px; border-radius: 999px; font-size: 13px; font-weight: 600;
    color: var(--ink-soft); background: rgba(255,255,255,0.55);
    border: 1px solid rgba(191,219,254,0.7);
    backdrop-filter: blur(10px);
    transition: all 0.15s ease;
  }
  .hp-quicknav a:hover, .hp-quicknav a.active {
    color: #fff; background: linear-gradient(100deg, var(--teal-500), var(--blue-600));
    border-color: transparent;
    box-shadow: 0 6px 16px -6px rgba(37,99,235,0.5);
  }
  .hp-quicknav a svg { width: 15px; height: 15px; flex-shrink: 0; }

  /* ---- CATEGORY THUMB GRID ---- */
  .hp-thumbs-wrap { position: relative; padding: 8px 48px 56px; max-width: 1180px; margin: 0 auto; }
  .hp-thumbs { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
  .hp-thumb {
    position: relative; overflow: hidden;
    display: flex; align-items: center; gap: 14px;
    padding: 18px 20px; border-radius: 18px;
    background: rgba(255,255,255,0.38);
    backdrop-filter: blur(24px) saturate(2);
    -webkit-backdrop-filter: blur(24px) saturate(2);
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 10px 24px -16px rgba(37,99,235,0.26);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .hp-thumb::before { content: ''; position: absolute; inset: 0; border-radius: 18px; background: linear-gradient(160deg, rgba(255,255,255,0.6), transparent 50%); pointer-events: none; }
  .hp-thumb:hover { transform: translateY(-4px); box-shadow: inset 0 1px 0 rgba(255,255,255,0.85), 0 18px 34px -16px rgba(37,99,235,0.34); }
  .hp-thumb .hp-thumb-ico { position: relative; z-index: 1; width: 48px; height: 48px; flex-shrink: 0; filter: drop-shadow(0 5px 12px rgba(37,99,235,0.3)); }
  .hp-thumb .hp-thumb-text { position: relative; z-index: 1; min-width: 0; }
  .hp-thumb .hp-thumb-text b { display: block; font-size: 14.5px; font-weight: 700; color: var(--ink); margin-bottom: 3px; }
  .hp-thumb .hp-thumb-text span { display: block; font-size: 12px; color: var(--ink-soft); line-height: 1.4; }
  .hp-thumb .hp-thumb-arrow {
    position: relative; z-index: 1; margin-left: auto; flex-shrink: 0;
    width: 26px; height: 26px; border-radius: 50%; background: rgba(219,234,254,0.7);
    display: flex; align-items: center; justify-content: center; color: var(--teal-700);
    transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
  }
  .hp-thumb:hover .hp-thumb-arrow { background: linear-gradient(120deg, var(--teal-500), var(--blue-600)); color: #fff; transform: translateX(3px); }

  /* ---- MEDIA PLACEHOLDER ---- */
  .hp-media {
    position: relative; overflow: hidden;
    margin: 22px 0 32px;
    border-radius: 18px;
    border: 2px dashed rgba(96,165,250,0.6);
    background: rgba(255,255,255,0.28);
    backdrop-filter: blur(20px) saturate(1.9);
    -webkit-backdrop-filter: blur(20px) saturate(1.9);
    min-height: 200px;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    gap: 10px; text-align: center; padding: 28px 24px;
  }
  .hp-media svg { width: 40px; height: 40px; color: var(--blue-600); opacity: 0.8; }
  .hp-media b { font-size: 13.5px; color: var(--ink); font-weight: 700; }
  .hp-media span { font-size: 12px; color: var(--ink-soft); font-style: italic; max-width: 460px; line-height: 1.5; }
  .hp-media-img { display: none; width: 100%; max-height: 420px; object-fit: cover; border-radius: 14px; }
  .hp-media.has-media { display: block; padding: 0; border: none; background: none; backdrop-filter: none; -webkit-backdrop-filter: none; min-height: 0; }
  .hp-media.has-media svg, .hp-media.has-media b, .hp-media.has-media > span { display: none; }
  .hp-media.has-media .hp-media-img { display: block; }

  /* ---- SECTIONS ---- */
  .hp-section {
    max-width: 1180px; margin: 0 auto; padding: 68px 48px;
    scroll-margin-top: 150px;
  }
  .hp-section.alt { max-width: none; }
  .hp-section.alt .hp-section-in { max-width: 1180px; margin: 0 auto; padding: 0 48px; }
  .hp-section-head { display: flex; align-items: flex-start; gap: 18px; margin-bottom: 34px; max-width: 760px; }
  /* Flex items default to min-width:auto, so a long German compound
     ("Behandlungsmoeglichkeiten") set a min-content floor the text column
     could not shrink below and it spilled out of the heading block. */
  .hp-section-head > div { min-width: 0; max-width: 100%; }
  .hp-section-head h2 { overflow-wrap: anywhere; }
  .hp-section-icon { width: 56px; height: 56px; flex-shrink: 0; filter: drop-shadow(0 6px 14px rgba(37,99,235,0.25)); }
  .hp-section-head h2 { font-size: 27px; font-weight: 800; color: var(--ink); margin-bottom: 8px; letter-spacing: -0.01em; }
  .hp-section-head p { font-size: 15px; color: var(--ink-soft); line-height: 1.6; }
  .hp-kicker { font-size: 12px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--teal-700); margin-bottom: 6px; }

  /* ---- STAT CALLOUTS ---- */
  .hp-stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; max-width: 640px; margin: 4px 0 8px; }
  .hp-stat {
    position: relative; overflow: hidden;
    border-radius: 16px; padding: 18px 20px;
    background: rgba(255,255,255,0.36);
    backdrop-filter: blur(24px) saturate(2);
    -webkit-backdrop-filter: blur(24px) saturate(2);
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 10px 24px -14px rgba(37,99,235,0.28);
  }
  .hp-stat::before { content: ''; position: absolute; inset: 0; border-radius: 16px; background: linear-gradient(160deg, rgba(255,255,255,0.6), transparent 50%); pointer-events: none; }
  .hp-stat b, .hp-stat span { position: relative; z-index: 1; }
  .hp-stat b {
    display: block; font-size: 23px; font-weight: 800;
    background: linear-gradient(100deg, var(--teal-600), var(--blue-700));
    -webkit-background-clip: text; background-clip: text; color: transparent;
    margin-bottom: 2px;
  }
  .hp-stat span { font-size: 12.5px; color: var(--ink-soft); line-height: 1.4; display: block; }

  /* ---- HAIR CYCLE ---- */
  .hp-cycle { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 28px; }
  .hp-cycle-card {
    position: relative; overflow: hidden;
    border-radius: 18px; padding: 24px 20px;
    background: rgba(255,255,255,0.36);
    backdrop-filter: blur(26px) saturate(2.1);
    -webkit-backdrop-filter: blur(26px) saturate(2.1);
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 14px 28px -16px rgba(37,99,235,0.3);
    text-align: center;
  }
  .hp-cycle-card::before { content: ''; position: absolute; inset: 0; border-radius: 18px; background: linear-gradient(160deg, rgba(255,255,255,0.6), transparent 50%); pointer-events: none; }
  .hp-cycle-card .pct, .hp-cycle-card h4, .hp-cycle-card .dur, .hp-cycle-card p { position: relative; z-index: 1; }
  .hp-cycle-card .pct {
    font-size: 29px; font-weight: 800;
    background: linear-gradient(100deg, var(--teal-600), var(--blue-700));
    -webkit-background-clip: text; background-clip: text; color: transparent;
    margin-bottom: 4px;
  }
  .hp-cycle-card h4 { font-size: 16px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
  .hp-cycle-card .dur { font-size: 11.5px; font-weight: 700; color: var(--teal-700); text-transform: uppercase; letter-spacing: 0.03em; margin-bottom: 10px; }
  .hp-cycle-card p { font-size: 13px; color: var(--ink-soft); line-height: 1.55; }

  /* ---- CARD GRIDS ---- */
  .hp-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
  .hp-grid.cols-2 { grid-template-columns: repeat(2, 1fr); }
  .hp-card {
    position: relative; overflow: hidden;
    border-radius: 16px; padding: 22px 20px;
    background: rgba(255,255,255,0.36);
    backdrop-filter: blur(24px) saturate(2);
    -webkit-backdrop-filter: blur(24px) saturate(2);
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 10px 24px -16px rgba(37,99,235,0.26);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .hp-card::before { content: ''; position: absolute; inset: 0; border-radius: 16px; background: linear-gradient(160deg, rgba(255,255,255,0.6), transparent 50%); pointer-events: none; }
  .hp-card:hover { transform: translateY(-4px); box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 18px 32px -16px rgba(37,99,235,0.32); }
  .hp-card .hp-ico { width: 38px; height: 38px; margin-bottom: 12px; position: relative; z-index: 1; filter: drop-shadow(0 4px 10px rgba(37,99,235,0.28)); }
  .hp-card .hp-ico svg { width: 100%; height: 100%; display: block; }
  .hp-card h4 { font-size: 15.5px; font-weight: 700; color: var(--ink); margin-bottom: 6px; position: relative; z-index: 1; }
  .hp-card p { font-size: 13px; color: var(--ink-soft); line-height: 1.55; position: relative; z-index: 1; }
  .hp-card .hp-badge {
    display: inline-block; font-size: 10.5px; font-weight: 700; color: var(--teal-700);
    background: rgba(125,211,252,0.25); padding: 3px 9px; border-radius: 999px; margin-bottom: 8px;
    position: relative; z-index: 1;
  }

  /* ---- CHECKLIST ---- */
  .hp-checklist { display: grid; gap: 10px; max-width: 680px; }
  .hp-check {
    display: flex; align-items: center; gap: 12px; padding: 13px 16px; border-radius: 12px;
    background: rgba(255,255,255,0.38);
    backdrop-filter: blur(22px) saturate(2);
    -webkit-backdrop-filter: blur(22px) saturate(2);
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.75);
  }
  .hp-check .tick {
    flex-shrink: 0; width: 22px; height: 22px; border-radius: 50%;
    background: linear-gradient(120deg, var(--teal-500), var(--blue-600)); color: #fff;
    display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700;
  }
  .hp-check p { font-size: 13.5px; color: var(--ink); line-height: 1.5; }

  /* ---- COMPARISON TABLE ---- */
  .hp-table-wrap {
    overflow-x: auto; border-radius: 16px; border: 1px solid rgba(255,255,255,0.85);
    background: rgba(255,255,255,0.32);
    backdrop-filter: blur(28px) saturate(2.1);
    -webkit-backdrop-filter: blur(28px) saturate(2.1);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 14px 28px -18px rgba(37,99,235,0.28);
  }
  .hp-table { width: 100%; border-collapse: collapse; font-size: 13.5px; min-width: 560px; }
  .hp-table th {
    text-align: left; padding: 14px 18px;
    background: linear-gradient(100deg, var(--teal-700), var(--blue-900));
    color: #fff; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 0.02em;
  }
  .hp-table td { padding: 13px 18px; border-top: 1px solid rgba(191,219,254,0.4); color: var(--ink); }
  .hp-table tr:nth-child(even) td { background: rgba(240,248,255,0.35); }

  /* ---- TIMELINE ---- */
  .hp-timeline { position: relative; padding-left: 32px; max-width: 760px; }
  .hp-timeline::before { content: ''; position: absolute; left: 9px; top: 6px; bottom: 6px; width: 2px; background: linear-gradient(180deg, var(--teal-400), var(--blue-700)); }
  .hp-tl-item { position: relative; padding-bottom: 26px; }
  .hp-tl-item:last-child { padding-bottom: 0; }
  .hp-tl-dot {
    position: absolute; left: -32px; top: 3px; width: 20px; height: 20px; border-radius: 50%;
    background: linear-gradient(120deg, var(--teal-500), var(--blue-600));
    box-shadow: 0 0 0 4px rgba(255,255,255,0.95), 0 0 0 5px rgba(96,165,250,0.4);
  }
  .hp-tl-card {
    border-radius: 14px; padding: 16px 18px;
    background: rgba(255,255,255,0.36);
    backdrop-filter: blur(24px) saturate(2);
    -webkit-backdrop-filter: blur(24px) saturate(2);
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.75);
  }
  .hp-tl-card .hp-tl-label { font-size: 11.5px; font-weight: 700; color: var(--teal-700); text-transform: uppercase; letter-spacing: 0.03em; margin-bottom: 4px; }
  .hp-tl-card h4 { font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
  .hp-tl-card p { font-size: 13.5px; color: var(--ink-soft); line-height: 1.6; }
  .hp-tl-card p.hp-tl-see { margin-top: 6px; font-weight: 600; color: var(--teal-700); }

  /* ---- AFTERCARE RULES ---- */
  .hp-rules { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
  .hp-rule {
    display: flex; align-items: center; gap: 10px; padding: 12px 14px; border-radius: 12px;
    background: rgba(255,255,255,0.38);
    backdrop-filter: blur(22px) saturate(2);
    -webkit-backdrop-filter: blur(22px) saturate(2);
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.75);
    font-size: 13px; color: var(--ink); line-height: 1.5;
  }
  .hp-rule .ric { flex-shrink: 0; width: 24px; height: 24px; margin-top: 0; display: flex; filter: drop-shadow(0 3px 8px rgba(37,99,235,0.28)); }
  .hp-rule .ric svg { width: 100%; height: 100%; display: block; }

  /* ---- GLOSSARY ---- */
  .hp-glossary { columns: 2; column-gap: 20px; }
  .hp-term {
    break-inside: avoid; margin-bottom: 12px; padding: 14px 16px; border-radius: 12px;
    background: rgba(255,255,255,0.38);
    backdrop-filter: blur(22px) saturate(2);
    -webkit-backdrop-filter: blur(22px) saturate(2);
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.75);
    display: inline-block; width: 100%;
  }
  .hp-term b { display: block; font-size: 13.5px; font-weight: 700; color: var(--teal-700); margin-bottom: 4px; }
  .hp-term span { font-size: 12.5px; color: var(--ink-soft); line-height: 1.5; }

  /* Follows the header's collapse breakpoint, not the content one. */
  @media (max-width: 1240px) { .hp-quicknav-wrap { top: 59px; } }

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
    .hp-hero { padding: 40px 20px 26px; }
    .hp-hero h1 { font-size: 32px; }
    .hp-hero h1 span.hp-hero-tagline { font-size: 17px; margin-top: 6px; }
    .hp-quicknav { padding: 0 20px; }
    .hp-section { padding: 48px 20px; }
    .hp-section.alt .hp-section-in { padding: 0 20px; }
    .hp-grid, .hp-grid.cols-2, .hp-cycle, .hp-stats, .hp-rules { grid-template-columns: 1fr; }
    .hp-glossary { columns: 1; }
    .hp-section-head { flex-direction: column; align-items: center; text-align: center; gap: 12px; max-width: none; }
    /* Heading is centered, so the body copy in the same card centers too. */
    .hp-card { text-align: center; }
    .hp-card .hp-ico { margin-left: auto; margin-right: auto; }
    /* Same stat-card role as .hp-cycle-card (already centered by design),
       so bring it in line for mobile consistency. */
    .hp-stat { text-align: center; }
    /* No left-starting icon here (term + definition only), so it centers
       like every other heading/body pairing. */
    .hp-term { text-align: center; }
    /* Standalone sub-headings and their intro copy (not part of an
       icon-led row like checklists/timeline/table) center along with
       every other heading on the page; the icon-led rows below them
       keep starting from the left. */
    .hp-section > h3, .hp-section > p, .hp-section-in > h3, .hp-section-in > p { text-align: center; }
    .hp-thumbs-wrap { padding: 4px 20px 40px; }
    .hp-thumbs { grid-template-columns: 1fr; }
  }
  @media (min-width: 901px) and (max-width: 1180px) {
    .hp-thumbs { grid-template-columns: repeat(2, 1fr); }
  }
  @media (min-width: 901px) {
    /* Scaled down 20% from the full-width fit — the mobile size already
       reads well, this is a desktop-only adjustment. */
    #was-ist-haarausfall .hp-media-img { width: 80%; display: block; margin: 0 auto; }
  }

  /* ---- CONSULTATION MODAL ---- */
  .consult-overlay {
    position: fixed; inset: 0; z-index: 200;
    display: none;
    align-items: center; justify-content: center;
    background: rgba(147,197,253,0.28);
    backdrop-filter: blur(16px) saturate(1.3);
    -webkit-backdrop-filter: blur(16px) saturate(1.3);
    padding: 20px;
  }
  .consult-overlay.open { display: flex; }
  .consult-modal {
    position: relative;
    overflow-y: auto;
    width: 100%; max-width: 600px; max-height: 92vh;
    border-radius: 26px;
    background: linear-gradient(165deg, rgba(255,255,255,0.42), rgba(219,234,254,0.3));
    backdrop-filter: blur(44px) saturate(2.2);
    -webkit-backdrop-filter: blur(44px) saturate(2.2);
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: 0 0 0 1px rgba(147,197,253,0.35), 0 20px 50px -12px rgba(37,99,235,0.28), 0 40px 90px -30px rgba(10,30,60,0.5), inset 0 1px 0 rgba(255,255,255,0.9);
  }
  .consult-topbar {
    position: sticky; top: 0; z-index: 2;
    background: linear-gradient(120deg, var(--teal-700), var(--blue-900));
    padding: 22px 30px 20px;
    border-radius: 26px 26px 0 0;
  }
  .consult-close {
    position: absolute; top: 14px; right: 14px;
    width: 32px; height: 32px; border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.3);
    background: rgba(255,255,255,0.14);
    font-size: 15px; line-height: 1; cursor: pointer; color: #fff;
  }
  .consult-head { text-align: center; margin-bottom: 20px; }
  .consult-head .clogo { display: flex; align-items: center; justify-content: center; gap: 8px; margin-bottom: 10px; }
  .consult-head .clogo img { height: 24px; width: auto; }
  .consult-head .clogo span { font-family: 'Fraunces', serif; font-weight: 600; font-size: 15px; color: #fff; letter-spacing: 0.02em; }
  .consult-head h2 { font-size: 19px; font-weight: 700; color: #fff; margin-bottom: 4px; }
  .consult-head p { font-size: 12.5px; color: rgba(255,255,255,0.7); }
  .consult-steps {
    display: flex; align-items: center; justify-content: center;
    font-size: 11.5px; font-weight: 600; color: rgba(255,255,255,0.55);
  }
  .cstep { display: flex; flex-direction: column; align-items: center; gap: 6px; width: 64px; }
  .cstep .dot {
    width: 34px; height: 34px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: rgba(255,255,255,0.12); border: 1.5px solid rgba(255,255,255,0.25);
    color: rgba(255,255,255,0.7); font-size: 13px; font-weight: 700;
    transition: all 0.2s ease;
  }
  .cstep.active .dot { background: linear-gradient(120deg, var(--teal-400), var(--blue-500)); border-color: transparent; color: #fff; box-shadow: 0 0 0 4px rgba(56,189,248,0.18); }
  .cstep.done .dot { background: var(--teal-500); border-color: transparent; color: #fff; }
  .cstep.active span:last-child, .cstep.done span:last-child { color: #fff; }
  .cstep-line { flex: 1; height: 2px; background: rgba(255,255,255,0.18); border-radius: 2px; margin: 0 2px; transform: translateY(-15px); max-width: 40px; }
  .cstep-line.done { background: var(--teal-400); }
  .consult-body { padding: 24px 30px 28px; }
  .consult-pane { display: none; }
  .consult-pane.active { display: block; }
  .pane-title { font-size: 16px; font-weight: 700; color: var(--ink); text-align: center; margin-bottom: 4px; }
  .pane-sub { font-size: 12.5px; color: var(--ink-soft); text-align: center; margin-bottom: 20px; }
  .cfield { margin-bottom: 16px; }
  .cfield label { display: block; font-size: 13px; font-weight: 700; color: var(--ink); margin-bottom: 7px; }
  .cfield input[type="text"], .cfield input[type="email"], .cfield input[type="tel"],
  .cfield select, .cfield textarea {
    width: 100%; padding: 13px 15px; font-size: 14.5px; font-family: inherit;
    border: 1.5px solid rgba(255,255,255,0.75); border-radius: 12px;
    background: rgba(255,255,255,0.3); color: var(--ink); outline: none;
    backdrop-filter: blur(18px) saturate(1.9);
    -webkit-backdrop-filter: blur(18px) saturate(1.9);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
  }
  .cfield input:focus, .cfield select:focus, .cfield textarea:focus {
    border-color: var(--teal-600);
    box-shadow: 0 0 0 3px rgba(2,132,199,0.16), inset 0 1px 0 rgba(255,255,255,0.8);
  }
  .cfield textarea { min-height: 76px; resize: vertical; }
  .phone-row { display: flex; gap: 8px; }
  .phone-row .prefix {
    flex-shrink: 0; width: 78px; padding: 13px 8px; text-align: center;
    border: 1.5px solid rgba(255,255,255,0.75); border-radius: 12px;
    background: rgba(219,234,254,0.32); font-size: 14.5px; color: var(--ink); font-weight: 700;
    backdrop-filter: blur(18px) saturate(1.9);
    -webkit-backdrop-filter: blur(18px) saturate(1.9);
  }

  /* ---- Option cards ---- */
  .opt-grid { display: grid; gap: 10px; }
  .opt-grid.cols-2 { grid-template-columns: repeat(2, 1fr); }
  .opt-grid.cols-3 { grid-template-columns: repeat(3, 1fr); }
  .opt-grid.cols-1 { grid-template-columns: 1fr; }
  .opt-card {
    position: relative;
    overflow: hidden;
    display: flex; align-items: center; gap: 10px;
    padding: 14px 16px; border-radius: 13px; cursor: pointer; user-select: none;
    border: 1.5px solid rgba(255,255,255,0.75);
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(20px) saturate(2);
    -webkit-backdrop-filter: blur(20px) saturate(2);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.85), 0 6px 16px -12px rgba(37,99,235,0.25);
    font-size: 14px; font-weight: 600; color: var(--ink);
    transition: all 0.15s ease;
  }
  .opt-card::before {
    content: ''; position: absolute; inset: 0; border-radius: 13px;
    background: linear-gradient(160deg, rgba(255,255,255,0.65) 0%, transparent 50%);
    pointer-events: none;
  }
  .opt-card.centered { justify-content: center; text-align: center; }
  .opt-card:hover { border-color: var(--teal-500); transform: translateY(-1px); box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 10px 22px -12px rgba(37,99,235,0.3); }
  .opt-badge { position: relative; z-index: 1; width: 30px; height: 30px; flex-shrink: 0; display: flex; filter: drop-shadow(0 3px 8px rgba(37,99,235,0.28)); }
  .opt-badge svg { width: 100%; height: 100%; display: block; }
  .opt-card .mark {
    position: relative; z-index: 1;
    flex-shrink: 0; width: 19px; height: 19px; border-radius: 6px;
    border: 1.5px solid rgba(15,32,39,0.25); background: rgba(255,255,255,0.7);
    display: flex; align-items: center; justify-content: center;
    transition: all 0.15s ease;
  }
  .opt-card.radio .mark { border-radius: 50%; }
  .opt-card .mark::after {
    content: ''; width: 9px; height: 9px; border-radius: 3px; background: #fff;
    opacity: 0; transform: scale(0.5); transition: all 0.15s ease;
  }
  .opt-card.radio .mark::after { border-radius: 50%; }
  .opt-card > span { position: relative; z-index: 1; }
  .opt-card.selected {
    background: linear-gradient(120deg, rgba(56,189,248,0.22), rgba(37,99,235,0.14));
    border-color: var(--teal-600);
    box-shadow: 0 0 0 1px rgba(2,132,199,0.3), 0 8px 20px -10px rgba(2,132,199,0.4), inset 0 1px 0 rgba(255,255,255,0.8);
    color: #0c4a76;
  }
  .opt-card.selected .mark { background: var(--teal-600); border-color: var(--teal-600); }
  .opt-card.selected .mark::after { opacity: 1; transform: scale(1); }
  .cgroup-note { font-size: 12px; color: var(--ink-soft); margin: 16px 0 8px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.03em; }

  .photo-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 9px; margin-bottom: 8px; }
  .photo-slot {
    position: relative; border: 1.5px dashed rgba(147,197,253,0.8); border-radius: 13px;
    padding: 14px 6px 11px; text-align: center; cursor: pointer;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(18px) saturate(1.9);
    -webkit-backdrop-filter: blur(18px) saturate(1.9);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.75);
    transition: border-color 0.15s ease;
  }
  .photo-slot:hover { border-color: var(--teal-600); }
  .photo-slot.filled { border-style: solid; border-color: var(--teal-600); background: rgba(56,189,248,0.14); }
  .photo-slot .opt-badge { margin: 0 auto 6px; }
  .photo-slot b { display: block; font-size: 12px; color: var(--ink); }
  .photo-slot span { display: block; font-size: 10px; color: var(--ink-soft); margin-top: 1px; }
  .photo-slot input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }
  .photo-note { font-size: 12px; color: var(--ink-soft); text-align: center; margin-bottom: 16px; }
  .check-row { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 12px; font-size: 12.5px; color: var(--ink-soft); line-height: 1.5; }
  .check-row input { margin-top: 2px; accent-color: var(--teal-600); width: 16px; height: 16px; flex-shrink: 0; }
  .check-row a { color: var(--blue-700); text-decoration: underline; }
  .gdpr-badge { font-size: 11.5px; color: var(--ink-soft); text-align: center; margin: 10px 0 4px; font-weight: 600; }
  .consult-nav { display: flex; gap: 10px; margin-top: 22px; }
  .consult-nav .cback {
    flex: 0 0 auto; padding: 13px 22px; border-radius: 12px; cursor: pointer;
    border: 1.5px solid rgba(255,255,255,0.75); background: rgba(255,255,255,0.25);
    backdrop-filter: blur(18px) saturate(1.9);
    -webkit-backdrop-filter: blur(18px) saturate(1.9);
    font-size: 14.5px; font-weight: 700; color: var(--ink);
  }
  .consult-nav .cnext {
    flex: 1; padding: 13px 22px; border-radius: 12px; cursor: pointer; border: 1px solid rgba(255,255,255,0.5);
    background: linear-gradient(100deg, var(--teal-500) 0%, var(--teal-600) 35%, var(--blue-600) 100%);
    color: #fff; font-size: 15px; font-weight: 700;
    box-shadow: 0 10px 24px -8px rgba(13,148,136,0.5), inset 0 1px 0 rgba(255,255,255,0.5);
    transition: opacity 0.15s ease, transform 0.15s ease;
  }
  .consult-nav .cnext:not(:disabled):hover { transform: translateY(-1px); }
  .consult-nav .cnext:disabled { opacity: 0.4; cursor: not-allowed; }
  .consult-success { text-align: center; padding: 20px 8px 6px; }
  .consult-success .ok-ring {
    width: 66px; height: 66px; border-radius: 50%; margin: 0 auto 16px;
    background: linear-gradient(120deg, var(--teal-500), var(--blue-600));
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 30px;
    box-shadow: 0 14px 30px -10px rgba(13,148,136,0.55);
  }
  .consult-success h3 { font-size: 20px; font-weight: 700; color: var(--ink); margin-bottom: 8px; }
  .consult-success p { font-size: 14px; color: var(--ink-soft); line-height: 1.55; }
  @media (max-width: 560px) {
    .consult-topbar { padding: 18px 20px 16px; }
    .consult-body { padding: 20px 18px 22px; }
    .photo-grid { grid-template-columns: repeat(2, 1fr); }
    .opt-grid.cols-3 { grid-template-columns: repeat(2, 1fr); }
  }

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
  @media (max-width: 640px) {
    .whatsapp-fab { bottom: 16px; right: 16px; width: 50px; height: 50px; }
    .whatsapp-fab svg { width: 27px; height: 27px; }
  }
</style>
</head>
<body data-content-page="hairpedia">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W6ZC5JRP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php
$siteHeaderMode = 'full';
$siteSectionBase = 'index.php';
$siteHomeHref = 'index.php';
include __DIR__ . '/includes/site-header.php';
?>

<section class="hp-hero">
  <div class="hp-hero-bg"></div>
  <div class="hp-hero-inner">
    <div class="eyebrow"><span class="dot"></span><span data-de="Wissen &amp; Aufklärung" data-en="Knowledge &amp; education" data-fr="Savoir et sensibilisation" data-nl="Kennis & voorlichting" data-it="Conoscenza ed educazione" data-tr="Bilgi ve Farkındalık">Wissen &amp; Aufklärung</span></div>
    <h1 data-ckey="hero.heading" data-de="<span>Hairpedia</span><br><span class=&quot;hp-hero-tagline&quot;>Ihr Wissen rund um Haarausfall &amp; Haartransplantation</span>" data-en="<span>Hairpedia</span><br><span class=&quot;hp-hero-tagline&quot;>Everything you need to know about hair loss &amp; hair transplantation</span>"><span>Hairpedia</span><br><span class="hp-hero-tagline">Ihr Wissen rund um Haarausfall &amp; Haartransplantation</span></h1>
    <p data-ckey="hero.sub" data-de="Wissenschaftlich fundiert, verständlich erklärt. Von den Ursachen des Haarausfalls bis zur vollständigen Genesung nach der Transplantation, alles an einem Ort." data-en="Scientifically grounded, clearly explained. From the causes of hair loss to full recovery after transplantation, all in one place.">Wissenschaftlich fundiert, verständlich erklärt. Von den Ursachen des Haarausfalls bis zur vollständigen Genesung nach der Transplantation, alles an einem Ort.</p>
  </div>
</section>

<div class="hp-thumbs-wrap">
  <div class="hp-thumbs">
    <a class="hp-thumb" href="#was-ist-haarausfall">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gInfoThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gInfoThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="32" cy="21" r="4" fill="#fff"/><rect x="28" y="29" width="8" height="20" rx="3" fill="#fff" opacity="0.92"/></svg>
      <span class="hp-thumb-text"><b data-de="Was ist Haarausfall" data-en="What is hair loss" data-fr="Qu'est-ce que la chute de cheveux" data-nl="Wat is haaruitval" data-it="Cos'è la caduta dei capelli" data-tr="Saç Dökülmesi Nedir">Was ist Haarausfall</b><span data-de="Definition, Zahlen, Wachstumszyklus" data-en="Definition, stats, growth cycle" data-fr="Définition, chiffres, cycle de croissance" data-nl="Definitie, cijfers, groeicyclus" data-it="Definizione, dati, ciclo di crescita" data-tr="Tanım, İstatistikler, Büyüme Döngüsü">Definition, Zahlen, Wachstumszyklus</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#ursachen">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gDnaThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gDnaThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M24 14c0 8 16 8 16 16s-16 8-16 16" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round"/><path d="M40 14c0 8-16 8-16 16s16 8 16 16" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round" opacity="0.55"/></svg>
      <span class="hp-thumb-text"><b data-de="Ursachen" data-en="Causes" data-fr="Causes" data-nl="Oorzaken" data-it="Cause" data-tr="Nedenler">Ursachen</b><span data-de="Genetik, DHT, Hormone, Stress" data-en="Genetics, DHT, hormones, stress" data-fr="Génétique, DHT, hormones, stress" data-nl="Genetica, DHT, hormonen, stress" data-it="Genetica, DHT, ormoni, stress" data-tr="Genetik, DHT, Hormonlar, Stres">Genetik, DHT, Hormone, Stress</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#arten">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gGridThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gGridThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="16" y="16" width="12" height="12" rx="3" fill="#fff" opacity="0.95"/><rect x="36" y="16" width="12" height="12" rx="3" fill="#fff" opacity="0.7"/><rect x="16" y="36" width="12" height="12" rx="3" fill="#fff" opacity="0.7"/><rect x="36" y="36" width="12" height="12" rx="3" fill="#fff" opacity="0.95"/></svg>
      <span class="hp-thumb-text"><b data-de="Arten" data-en="Types" data-fr="Types" data-nl="Soorten" data-it="Tipi" data-tr="Türler">Arten</b><span data-de="Androgenetisch, areata und mehr" data-en="Androgenetic, areata, and more" data-fr="Androgénétique, areata et plus" data-nl="Androgenetisch, areata en meer" data-it="Androgenetica, areata e altro" data-tr="Androgenetik, Areata ve Daha Fazlası">Androgenetisch, areata und mehr</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#diagnose">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMagThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gMagThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="27" cy="27" r="11" fill="none" stroke="#fff" stroke-width="3.2"/><line x1="35" y1="35" x2="45" y2="45" stroke="#fff" stroke-width="3.2" stroke-linecap="round"/></svg>
      <span class="hp-thumb-text"><b data-de="Diagnose" data-en="Diagnosis" data-fr="Diagnostic" data-nl="Diagnose" data-it="Diagnosi" data-tr="Teşhis">Diagnose</b><span data-de="Trichoskopie, Zugtest, Bluttests" data-en="Trichoscopy, pull test, blood tests" data-fr="Trichoscopie, test de traction, analyses de sang" data-nl="Trichoscopie, trektest, bloedonderzoek" data-it="Tricoscopia, pull test, esami del sangue" data-tr="Trikoskopi, Çekme Testi, Kan Testleri">Trichoskopie, Zugtest, Bluttests</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#behandlung">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gPillThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gPillThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="16" y="25" width="32" height="14" rx="7" fill="none" stroke="#fff" stroke-width="3"/><line x1="32" y1="25" x2="32" y2="39" stroke="#fff" stroke-width="3"/></svg>
      <span class="hp-thumb-text"><b data-de="Behandlung" data-en="Treatment" data-fr="Traitement" data-nl="Behandeling" data-it="Trattamento" data-tr="Tedavi">Behandlung</b><span data-de="Von Minoxidil bis Transplantation" data-en="From minoxidil to transplantation" data-fr="Du minoxidil à la greffe" data-nl="Van minoxidil tot transplantatie" data-it="Dal minoxidil al trapianto" data-tr="Minoksidilden Saç Ekimine">Von Minoxidil bis Transplantation</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#transplantation">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gGraftThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gGraftThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M22 46c-1-8 1-15 4-19M32 46c0-9 0-16 0-20M42 46c1-8-1-15-4-19" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round"/><circle cx="22" cy="48" r="2.4" fill="#fff"/><circle cx="32" cy="48" r="2.4" fill="#fff"/><circle cx="42" cy="48" r="2.4" fill="#fff"/></svg>
      <span class="hp-thumb-text"><b data-de="Transplantation" data-en="Transplantation" data-fr="Greffe" data-nl="Transplantatie" data-it="Trapianto" data-tr="Saç Ekimi">Transplantation</b><span data-de="FUE, Saphir-FUE und DHI im Vergleich" data-en="FUE, Sapphire FUE, and DHI compared" data-fr="FUE, Saphir-FUE et DHI comparés" data-nl="FUE, Saffier-FUE en DHI vergeleken" data-it="FUE, Saphire-FUE e DHI a confronto" data-tr="FUE, Safir FUE ve DHI Karşılaştırması">FUE, Saphir-FUE und DHI im Vergleich</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#genesung">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gCal2Thumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gCal2Thumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="15" y="18" width="34" height="28" rx="5" fill="none" stroke="#fff" stroke-width="2.6"/><line x1="15" y1="27" x2="49" y2="27" stroke="#fff" stroke-width="2.6"/></svg>
      <span class="hp-thumb-text"><b data-de="Genesung" data-en="Recovery" data-fr="Récupération" data-nl="Herstel" data-it="Recupero" data-tr="İyileşme">Genesung</b><span data-de="Zeitstrahl &amp; Nachsorgeregeln" data-en="Timeline &amp; aftercare rules" data-fr="Chronologie et règles de suivi" data-nl="Tijdlijn & nazorgregels" data-it="Cronologia e regole di assistenza post-operatoria" data-tr="Zaman Çizelgesi ve Bakım Kuralları">Zeitstrahl &amp; Nachsorgeregeln</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#vorher-nachher">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gCompareThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gCompareThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="27" cy="32" r="13" fill="#fff" opacity="0.5"/><circle cx="39" cy="32" r="13" fill="#fff" opacity="0.85"/></svg>
      <span class="hp-thumb-text"><b data-de="Vorher-Nachher" data-en="Before &amp; after" data-fr="Avant/après" data-nl="Voor en na" data-it="Prima e dopo" data-tr="Öncesi ve Sonrası">Vorher-Nachher</b><span data-de="Was pro Monat zu erwarten ist" data-en="What to expect each month" data-fr="À quoi s'attendre chaque mois" data-nl="Wat u elke maand kunt verwachten" data-it="Cosa aspettarsi ogni mese" data-tr="Her Ay Neler Beklenmeli">Was pro Monat zu erwarten ist</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#glossar">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gBookThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gBookThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M32 22c-6-4-13-5-18-3v22c5-2 12-1 18 3 6-4 13-5 18-3V19c-5-2-12-1-18 3z" fill="#fff" opacity="0.95"/></svg>
      <span class="hp-thumb-text"><b data-de="Glossar" data-en="Glossary" data-fr="Glossaire" data-nl="Woordenlijst" data-it="Glossario" data-tr="Sözlük">Glossar</b><span data-de="Fachbegriffe einfach erklärt" data-en="Terms explained simply" data-fr="Termes techniques expliqués simplement" data-nl="Vaktermen eenvoudig uitgelegd" data-it="Termini tecnici spiegati semplicemente" data-tr="Teknik Terimler Basitçe Açıklandı">Fachbegriffe einfach erklärt</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
  </div>
</div>

<div class="hp-quicknav-wrap">
  <div class="hp-quicknav" id="hpQuicknav">
    <a href="#was-ist-haarausfall"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><line x1="12" y1="11" x2="12" y2="16"/><circle cx="12" cy="7.5" r="0.5" fill="currentColor"/></svg><span data-de="Was ist Haarausfall" data-en="What is hair loss" data-fr="Qu'est-ce que la chute de cheveux" data-nl="Wat is haaruitval" data-it="Cos'è la caduta dei capelli" data-tr="Saç Dökülmesi Nedir">Was ist Haarausfall</span></a>
    <a href="#ursachen"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M9 3c0 3 6 3 6 6s-6 3-6 6"/><path d="M15 3c0 3-6 3-6 6s6 3 6 6"/></svg><span data-de="Ursachen" data-en="Causes" data-fr="Causes" data-nl="Oorzaken" data-it="Cause" data-tr="Nedenler">Ursachen</span></a>
    <a href="#arten"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="8" height="8" rx="1.5"/><rect x="13" y="3" width="8" height="8" rx="1.5"/><rect x="3" y="13" width="8" height="8" rx="1.5"/><rect x="13" y="13" width="8" height="8" rx="1.5"/></svg><span data-de="Arten" data-en="Types" data-fr="Types" data-nl="Soorten" data-it="Tipi" data-tr="Türler">Arten</span></a>
    <a href="#diagnose"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="10" cy="10" r="6"/><line x1="14.5" y1="14.5" x2="20" y2="20"/></svg><span data-de="Diagnose" data-en="Diagnosis" data-fr="Diagnostic" data-nl="Diagnose" data-it="Diagnosi" data-tr="Teşhis">Diagnose</span></a>
    <a href="#behandlung"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="8" width="18" height="8" rx="4"/><line x1="12" y1="8" x2="12" y2="16"/></svg><span data-de="Behandlung" data-en="Treatment" data-fr="Traitement" data-nl="Behandeling" data-it="Trattamento" data-tr="Tedavi">Behandlung</span></a>
    <a href="#transplantation"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M8 20c-1-5 0-9 2-12M12 20c0-6 0-10 0-13M16 20c1-5 0-9-2-12"/></svg><span data-de="Transplantation" data-en="Transplantation" data-fr="Greffe" data-nl="Transplantatie" data-it="Trapianto" data-tr="Saç Ekimi">Transplantation</span></a>
    <a href="#genesung"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><line x1="3" y1="9.5" x2="21" y2="9.5"/><line x1="8" y1="2" x2="8" y2="7"/><line x1="16" y1="2" x2="16" y2="7"/></svg><span data-de="Genesung" data-en="Recovery" data-fr="Récupération" data-nl="Herstel" data-it="Recupero" data-tr="İyileşme">Genesung</span></a>
    <a href="#vorher-nachher"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="12" r="7" opacity="0.55"/><circle cx="15" cy="12" r="7"/></svg><span data-de="Vorher-Nachher" data-en="Before &amp; after" data-fr="Avant/après" data-nl="Voor en na" data-it="Prima e dopo" data-tr="Öncesi ve Sonrası">Vorher-Nachher</span></a>
    <a href="#glossar"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5.5c4-2 8 0 8 0s4-2 8 0v13c-4-2-8 0-8 0s-4-2-8 0z"/><line x1="12" y1="5.5" x2="12" y2="18.5"/></svg><span data-de="Glossar" data-en="Glossary" data-fr="Glossaire" data-nl="Woordenlijst" data-it="Glossario" data-tr="Sözlük">Glossar</span></a>
  </div>
</div>

<section class="hp-section" id="was-ist-haarausfall">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gInfo" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gInfo)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="32" cy="21" r="4" fill="#fff"/><rect x="28" y="29" width="8" height="20" rx="3" fill="#fff" opacity="0.92"/></svg>
    <div>
      <h2 data-ckey="wasIstHaarausfall.heading" data-de="Was ist Haarausfall?" data-en="What is hair loss?">Was ist Haarausfall?</h2>
      <p data-ckey="wasIstHaarausfall.body" data-de="Haarausfall, medizinisch Alopezie genannt, ist das teilweise oder vollständige Fehlen von Haaren an Stellen, an denen sie normalerweise wachsen. Bis zu 100 Haare täglich zu verlieren gilt als normaler Teil des Wachstumszyklus." data-en="Hair loss, medically known as alopecia, is the partial or complete absence of hair from areas where it normally grows. Losing up to 100 hairs a day is a normal part of the growth cycle.">Haarausfall, medizinisch Alopezie genannt, ist das teilweise oder vollständige Fehlen von Haaren an Stellen, an denen sie normalerweise wachsen. Bis zu 100 Haare täglich zu verlieren gilt als normaler Teil des Wachstumszyklus.</p>
    </div>
  </div>
  <div class="hp-media" data-cmedia-wrap>
    <img class="hp-media-img" data-cmedia="wasIstHaarausfall.image" alt="">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
    <b data-de="Bildplatzhalter: Diagramm" data-en="Image placeholder: diagram" data-fr="Espace image : diagramme" data-nl="Afbeeldingsplaceholder: diagram" data-it="Segnaposto immagine: diagramma" data-tr="Görsel Yer Tutucu: Diyagram">Bildplatzhalter: Diagramm</b>
    <span data-de="Illustration des Haarwachstumszyklus (Anagen, Katagen, Telogen) als kreisförmiges Diagramm" data-en="Illustration of the hair growth cycle (anagen, catagen, telogen) as a circular diagram" data-fr="Illustration du cycle de croissance des cheveux (anagène, catagène, télogène) sous forme de diagramme circulaire" data-nl="Illustratie van de haargroeicyclus (anageen, catageen, telogeen) als cirkeldiagram" data-it="Illustrazione del ciclo di crescita dei capelli (anagen, catagen, telogen) come diagramma circolare" data-tr="Saç büyüme döngüsünün (anagen, katagen, telogen) dairesel bir diyagram olarak gösterimi">Illustration des Haarwachstumszyklus (Anagen, Katagen, Telogen) als kreisförmiges Diagramm</span>
  </div>
  <div class="hp-stats">
    <div class="hp-stat"><b data-de="1–1,5 Mrd." data-en="1–1.5 bn" data-fr="1 à 1,5 Md" data-nl="1–1,5 mrd" data-it="1–1,5 mld" data-tr="1–1,5 milyar">1–1,5 Mrd.</b><span data-de="Menschen weltweit von androgenetischer Alopezie betroffen" data-en="people worldwide affected by androgenetic alopecia" data-fr="personnes dans le monde touchées par l'alopécie androgénétique" data-nl="mensen wereldwijd getroffen door androgenetische alopecia" data-it="persone nel mondo colpite da alopecia androgenetica" data-tr="dünya genelinde androgenetik alopesiden etkilenen kişi">Menschen weltweit von androgenetischer Alopezie betroffen</span></div>
    <div class="hp-stat"><b data-de="80% / 50%" data-en="80% / 50%" data-fr="80% / 50%" data-nl="80% / 50%" data-it="80% / 50%" data-tr="%80 / %50">80% / 50%</b><span data-de="der Männer bzw. Frauen zeigen bis 70 einen gewissen Grad an Haarausfall" data-en="of men / women show some degree of hair loss by age 70" data-fr="des hommes / femmes présentent un certain degré de chute de cheveux avant 70 ans" data-nl="van de mannen / vrouwen vertoont voor de leeftijd van 70 een zekere mate van haaruitval" data-it="degli uomini / delle donne mostra un certo grado di caduta dei capelli entro i 70 anni" data-tr="erkek / kadının 70 yaşına kadar bir dereceye kadar saç dökülmesi yaşadığı">der Männer bzw. Frauen zeigen bis 70 einen gewissen Grad an Haarausfall</span></div>
  </div>
  <p style="font-size:14.5px;color:var(--ink-soft);line-height:1.65;max-width:760px;margin-bottom:8px" data-de="Haarausfall ist nicht nur ein kosmetisches Thema. Studien zeigen durchgängig höhere Raten von Angst, depressiven Verstimmungen und vermindertem Selbstwertgefühl bei Betroffenen, besonders wenn er in jungen Jahren beginnt." data-en="Hair loss isn't just cosmetic. Research consistently shows higher rates of anxiety, depression, and reduced self-esteem among those affected, particularly when it starts young." data-fr="La chute de cheveux n'est pas qu'une question esthétique. Les études montrent systématiquement des taux plus élevés d'anxiété, de dépression et d'estime de soi réduite chez les personnes concernées, surtout lorsqu'elle commence jeune." data-nl="Haaruitval is niet alleen cosmetisch. Onderzoek toont consistent hogere niveaus van angst, depressie en verminderd zelfvertrouwen bij getroffenen, vooral wanneer het op jonge leeftijd begint." data-it="La caduta dei capelli non è solo una questione estetica. Gli studi mostrano costantemente tassi più elevati di ansia, depressione e autostima ridotta tra le persone colpite, soprattutto quando inizia in giovane età." data-tr="Saç dökülmesi yalnızca kozmetik bir konu değildir. Araştırmalar, özellikle genç yaşta başladığında, etkilenen kişilerde daha yüksek oranda kaygı, depresyon ve düşük özgüven olduğunu tutarlı biçimde göstermektedir.">Haarausfall ist nicht nur ein kosmetisches Thema. Studien zeigen durchgängig höhere Raten von Angst, depressiven Verstimmungen und vermindertem Selbstwertgefühl bei Betroffenen, besonders wenn er in jungen Jahren beginnt.</p>

  <h3 style="font-size:18px;font-weight:700;margin:32px 0 4px" data-de="Der Haarwachstumszyklus" data-en="The hair growth cycle" data-fr="Le cycle de croissance des cheveux" data-nl="De haargroeicyclus" data-it="Il ciclo di crescita dei capelli" data-tr="Saç Büyüme Döngüsü">Der Haarwachstumszyklus</h3>
  <p style="font-size:13.5px;color:var(--ink-soft);margin-bottom:8px;max-width:700px" data-de="Jedes Haar durchläuft drei Phasen. Zu verstehen, wie sie funktionieren, erklärt, warum Haarausfall entsteht und warum eine Transplantation wirkt." data-en="Every hair moves through three phases. Understanding them explains why hair loss happens and why transplantation works." data-fr="Chaque cheveu traverse trois phases. Comprendre leur fonctionnement explique pourquoi la chute de cheveux se produit et pourquoi la greffe fonctionne." data-nl="Elke haar doorloopt drie fasen. Begrijpen hoe ze werken, verklaart waarom haaruitval ontstaat en waarom een transplantatie werkt." data-it="Ogni capello attraversa tre fasi. Comprenderle spiega perché si verifica la caduta dei capelli e perché il trapianto funziona." data-tr="Her saç teli üç aşamadan geçer. Bunların nasıl işlediğini anlamak, saç dökülmesinin neden gerçekleştiğini ve saç ekiminin neden işe yaradığını açıklar.">Jedes Haar durchläuft drei Phasen. Zu verstehen, wie sie funktionieren, erklärt, warum Haarausfall entsteht und warum eine Transplantation wirkt.</p>
  <div class="hp-cycle">
    <div class="hp-cycle-card">
      <div class="pct">85–90%</div>
      <h4 data-de="Anagen" data-en="Anagen" data-fr="Anagène" data-nl="Anageen" data-it="Anagen" data-tr="Anagen">Anagen</h4>
      <div class="dur" data-de="2–7 Jahre · Wachstumsphase" data-en="2–7 years · Growth phase" data-fr="2 à 7 ans · Phase de croissance" data-nl="2–7 jaar · Groeifase" data-it="2–7 anni · Fase di crescita" data-tr="2–7 yıl · Büyüme Evresi">2–7 Jahre · Wachstumsphase</div>
      <p data-de="Der Follikel produziert aktiv einen Haarschaft, rund 1 bis 1,5 cm pro Monat. Je länger diese Phase, desto länger kann das Haar werden." data-en="The follicle actively produces a hair shaft, growing roughly 1 to 1.5 cm per month. The longer this phase, the longer the hair can grow." data-fr="Le follicule produit activement une tige capillaire, à un rythme d'environ 1 à 1,5 cm par mois. Plus cette phase dure longtemps, plus le cheveu peut devenir long." data-nl="De follikel produceert actief een haarschacht, met een groei van ongeveer 1 tot 1,5 cm per maand. Hoe langer deze fase duurt, hoe langer het haar kan worden." data-it="Il follicolo produce attivamente un fusto del capello, crescendo di circa 1-1,5 cm al mese. Più questa fase dura, più il capello può allungarsi." data-tr="Folikül aktif olarak bir saç teli üretir, ayda yaklaşık 1 ila 1,5 cm büyür. Bu evre ne kadar uzun sürerse, saç o kadar uzayabilir.">Der Follikel produziert aktiv einen Haarschaft, rund 1 bis 1,5 cm pro Monat. Je länger diese Phase, desto länger kann das Haar werden.</p>
    </div>
    <div class="hp-cycle-card">
      <div class="pct">~1%</div>
      <h4 data-de="Katagen" data-en="Catagen" data-fr="Catagène" data-nl="Catageen" data-it="Catagen" data-tr="Katagen">Katagen</h4>
      <div class="dur" data-de="2–3 Wochen · Übergangsphase" data-en="2–3 weeks · Transition phase" data-fr="2 à 3 semaines · Phase de transition" data-nl="2–3 weken · Overgangsfase" data-it="2–3 settimane · Fase di transizione" data-tr="2–3 hafta · Geçiş Evresi">2–3 Wochen · Übergangsphase</div>
      <p data-de="Eine kurze Übergangsphase. Die Haarproduktion stoppt, der Follikel schrumpft und löst sich von der Blutversorgung." data-en="A short transitional period. Hair production stops, the follicle shrinks, and detaches from its blood supply." data-fr="Une brève période de transition. La production de cheveux s'arrête, le follicule rétrécit et se détache de son apport sanguin." data-nl="Een korte overgangsperiode. De haarproductie stopt, de follikel krimpt en maakt zich los van de bloedtoevoer." data-it="Un breve periodo di transizione. La produzione di capelli si arresta, il follicolo si restringe e si stacca dal proprio apporto sanguigno." data-tr="Kısa bir geçiş dönemi. Saç üretimi durur, folikül küçülür ve kan akışından ayrılır.">Eine kurze Übergangsphase. Die Haarproduktion stoppt, der Follikel schrumpft und löst sich von der Blutversorgung.</p>
    </div>
    <div class="hp-cycle-card">
      <div class="pct">10–15%</div>
      <h4 data-de="Telogen" data-en="Telogen" data-fr="Télogène" data-nl="Telogeen" data-it="Telogen" data-tr="Telogen">Telogen</h4>
      <div class="dur" data-de="~3 Monate · Ruhephase" data-en="~3 months · Resting phase" data-fr="~3 mois · Phase de repos" data-nl="~3 maanden · Rustfase" data-it="~3 mesi · Fase di riposo" data-tr="~3 ay · Dinlenme Evresi">~3 Monate · Ruhephase</div>
      <p data-de="Der Follikel ruht rund 3 Monate. Am Ende der Phase fällt das Haar aus und ein neues Anagen-Haar beginnt zu wachsen." data-en="The follicle rests for around 3 months. At the end, the hair sheds and a new anagen hair begins growing." data-fr="Le follicule se repose pendant environ 3 mois. À la fin de cette phase, le cheveu tombe et un nouveau cheveu en phase anagène commence à pousser." data-nl="De follikel rust ongeveer 3 maanden. Aan het einde van deze fase valt het haar uit en begint een nieuwe anagene haar te groeien." data-it="Il follicolo riposa per circa 3 mesi. Alla fine della fase, il capello cade e un nuovo capello in fase anagen inizia a crescere." data-tr="Folikül yaklaşık 3 ay dinlenir. Evrenin sonunda saç dökülür ve yeni bir anagen saç büyümeye başlar.">Der Follikel ruht rund 3 Monate. Am Ende der Phase fällt das Haar aus und ein neues Anagen-Haar beginnt zu wachsen.</p>
    </div>
  </div>
</section>

<section class="hp-section alt" id="ursachen">
  <div class="hp-section-in">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gDna" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gDna)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M24 14c0 8 16 8 16 16s-16 8-16 16" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round"/><path d="M40 14c0 8-16 8-16 16s16 8 16 16" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round" opacity="0.55"/><line x1="26" y1="19" x2="38" y2="19" stroke="#fff" stroke-width="2" opacity="0.75"/><line x1="24" y1="30" x2="40" y2="30" stroke="#fff" stroke-width="2" opacity="0.75"/><line x1="26" y1="41" x2="38" y2="41" stroke="#fff" stroke-width="2" opacity="0.75"/></svg>
    <div>
      <h2 data-ckey="ursachen.heading" data-de="Ursachen von Haarausfall" data-en="Causes of hair loss">Ursachen von Haarausfall</h2>
      <p data-ckey="ursachen.body" data-de="Haarausfall hat selten eine einzige Ursache. Genetik, Hormone, Stress und Ernährung wirken häufig zusammen." data-en="Hair loss rarely has a single cause. Genetics, hormones, stress, and nutrition often act together.">Haarausfall hat selten eine einzige Ursache. Genetik, Hormone, Stress und Ernährung wirken häufig zusammen.</p>
    </div>
  </div>
  <div class="hp-media" data-cmedia-wrap>
    <img class="hp-media-img" data-cmedia="ursachen.image" alt="">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
    <b data-de="Bildplatzhalter: Infografik" data-en="Image placeholder: infographic" data-fr="Espace image : infographie" data-nl="Afbeeldingsplaceholder: infografiek" data-it="Segnaposto immagine: infografica" data-tr="Görsel Yer Tutucu: İnfografik">Bildplatzhalter: Infografik</b>
    <span data-de="Infografik mit Icons für jede Ursachengruppe (Genetik, Hormone, Stress, Ernährung, Medikamente)" data-en="Infographic with icons for each cause group (genetics, hormones, stress, nutrition, medications)" data-fr="Infographie avec des icônes pour chaque groupe de causes (génétique, hormones, stress, alimentation, médicaments)" data-nl="Infografiek met iconen voor elke oorzakencategorie (genetica, hormonen, stress, voeding, medicijnen)" data-it="Infografica con icone per ciascun gruppo di cause (genetica, ormoni, stress, alimentazione, farmaci)" data-tr="Her neden grubu için simgeler içeren infografik (genetik, hormonlar, stres, beslenme, ilaçlar)">Infografik mit Icons für jede Ursachengruppe (Genetik, Hormone, Stress, Ernährung, Medikamente)</span>
  </div>
  <div class="hp-grid">
    <div class="hp-card"><span class="hp-badge" data-de="Häufigste Ursache" data-en="Most common" data-fr="Cause la plus fréquente" data-nl="Meest voorkomend" data-it="Causa più comune" data-tr="En Yaygın Neden">Häufigste Ursache</span><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini1" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini1)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M9 3c0 3 6 3 6 6s-6 3-6 6"/><path d="M15 3c0 3-6 3-6 6s6 3 6 6"/></g></svg></div><h4 data-de="Genetik" data-en="Genetics" data-fr="Génétique" data-nl="Genetica" data-it="Genetica" data-tr="Genetik">Genetik</h4><p data-de="Die genetische Veranlagung ist der Haupttreiber. Rund 80% der Männer mit erblich bedingtem Haarausfall haben einen betroffenen Vater. Vererbung kann von beiden Elternteilen kommen." data-en="Genetic predisposition is the primary driver. Around 80% of men with pattern baldness have a father who was also affected. Inheritance can come from either side." data-fr="La prédisposition génétique est le principal facteur. Environ 80% des hommes atteints de calvitie héréditaire ont un père également touché. L'hérédité peut venir des deux côtés." data-nl="Genetische aanleg is de belangrijkste factor. Ongeveer 80% van de mannen met erfelijke kaalheid heeft een vader die ook was aangetast. Overerving kan van beide kanten komen." data-it="La predisposizione genetica è il fattore principale. Circa l'80% degli uomini con calvizie ereditaria ha un padre anch'egli colpito. L'ereditarietà può provenire da entrambi i lati." data-tr="Genetik yatkınlık başlıca etkendir. Kalıtsal saç dökülmesi olan erkeklerin yaklaşık %80'inin babası da bu durumdan etkilenmiştir. Kalıtım her iki taraftan da gelebilir.">Die genetische Veranlagung ist der Haupttreiber. Rund 80% der Männer mit erblich bedingtem Haarausfall haben einen betroffenen Vater. Vererbung kann von beiden Elternteilen kommen.</p></div>
    <div class="hp-card"><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini2" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini2)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M12 2a4 4 0 0 0-4 4v2a4 4 0 0 0 8 0V6a4 4 0 0 0-4-4Z"/><path d="M8 14v1a4 4 0 0 0 8 0v-1"/><path d="M12 19v3"/></g></svg></div><h4 data-de="DHT (Dihydrotestosteron)" data-en="DHT (Dihydrotestosterone)" data-fr="DHT (Dihydrotestostérone)" data-nl="DHT (Dihydrotestosteron)" data-it="DHT (Diidrotestosterone)" data-tr="DHT (Dihidrotestosteron)">DHT (Dihydrotestosteron)</h4><p data-de="Der zentrale Hormontreiber bei Männern und Frauen. DHT bindet an genetisch empfindliche Follikel und lässt sie über Zeit schrumpfen." data-en="The central hormonal driver in both men and women. DHT binds to genetically sensitive follicles and causes them to shrink over time." data-fr="Le principal moteur hormonal chez les hommes et les femmes. La DHT se lie aux follicules génétiquement sensibles et les fait rétrécir avec le temps." data-nl="De centrale hormonale drijfveer bij zowel mannen als vrouwen. DHT bindt zich aan genetisch gevoelige follikels en laat ze na verloop van tijd krimpen." data-it="Il principale fattore ormonale sia negli uomini che nelle donne. Il DHT si lega ai follicoli geneticamente sensibili e li fa restringere nel tempo." data-tr="Hem erkeklerde hem kadınlarda başlıca hormonal etkendir. DHT, genetik olarak duyarlı foliküllere bağlanır ve zamanla küçülmelerine neden olur.">Der zentrale Hormontreiber bei Männern und Frauen. DHT bindet an genetisch empfindliche Follikel und lässt sie über Zeit schrumpfen.</p></div>
    <div class="hp-card"><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini3" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini3)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M12 21c-4-3-8-6-8-11a5 5 0 0 1 9-3 5 5 0 0 1 9 3c0 5-4 8-8 11z"/></g></svg></div><h4 data-de="Hormonelle Veränderungen" data-en="Hormonal changes" data-fr="Changements hormonaux" data-nl="Hormonale veranderingen" data-it="Cambiamenti ormonali" data-tr="Hormonal Değişiklikler">Hormonelle Veränderungen</h4><p data-de="Schwangerschaft, Wechseljahre, Schilddrüsenerkrankungen und PCOS können diffuses Ausdünnen oder Schuppung auslösen." data-en="Pregnancy, menopause, thyroid disorders, and PCOS can trigger diffuse thinning or shedding." data-fr="La grossesse, la ménopause, les troubles thyroïdiens et le SOPK peuvent déclencher un amincissement diffus ou une chute de cheveux." data-nl="Zwangerschap, menopauze, schildklieraandoeningen en PCOS kunnen diffuse verdunning of haaruitval veroorzaken." data-it="Gravidanza, menopausa, disturbi tiroidei e PCOS possono innescare un diradamento diffuso o la caduta dei capelli." data-tr="Hamilelik, menopoz, tiroid bozuklukları ve PCOS yaygın incelme veya dökülmeye neden olabilir.">Schwangerschaft, Wechseljahre, Schilddrüsenerkrankungen und PCOS können diffuses Ausdünnen oder Schuppung auslösen.</p></div>
    <div class="hp-card"><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini4" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini4)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M13 2 4 14h6l-1 8 9-12h-6z"/></g></svg></div><h4 data-de="Stress" data-en="Stress" data-fr="Stress" data-nl="Stress" data-it="Stress" data-tr="Stres">Stress</h4><p data-de="Starker physischer oder psychischer Stress kann viele Follikel gleichzeitig in die Ruhephase drängen (telogenes Effluvium), meist reversibel." data-en="Significant physical or psychological stress can push many follicles into the resting phase at once (telogen effluvium), usually reversible." data-fr="Un stress physique ou psychologique important peut pousser de nombreux follicules simultanément en phase de repos (effluvium télogène), généralement réversible." data-nl="Aanzienlijke fysieke of psychische stress kan veel follikels tegelijk in de rustfase duwen (telogeen effluvium), meestal omkeerbaar." data-it="Uno stress fisico o psicologico significativo può spingere molti follicoli contemporaneamente nella fase di riposo (effluvio telogen), solitamente reversibile." data-tr="Yoğun fiziksel veya psikolojik stres, birçok folikülü aynı anda dinlenme evresine itebilir (telogen effluvium), genellikle geri dönüşlüdür.">Starker physischer oder psychischer Stress kann viele Follikel gleichzeitig in die Ruhephase drängen (telogenes Effluvium), meist reversibel.</p></div>
    <div class="hp-card"><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini5" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini5)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M12 2c4 5 7 9.6 7 13.2A7 7 0 1 1 5 15.2C5 11.6 8 7 12 2z"/></g></svg></div><h4 data-de="Ernährung &amp; Mängel" data-en="Nutrition &amp; deficiencies" data-fr="Alimentation et carences" data-nl="Voeding & tekorten" data-it="Alimentazione e carenze" data-tr="Beslenme ve Eksiklikler">Ernährung &amp; Mängel</h4><p data-de="Eisen, Vitamin D, Zink, Protein und Biotin sind für aktive Follikel essenziell. Mängel beeinträchtigen Wachstum und Qualität." data-en="Iron, vitamin D, zinc, protein, and biotin are essential for active follicles. Deficiencies impair growth and hair quality." data-fr="Le fer, la vitamine D, le zinc, les protéines et la biotine sont essentiels aux follicules actifs. Les carences nuisent à la croissance et à la qualité des cheveux." data-nl="IJzer, vitamine D, zink, eiwitten en biotine zijn essentieel voor actieve follikels. Tekorten belemmeren de groei en haarkwaliteit." data-it="Ferro, vitamina D, zinco, proteine e biotina sono essenziali per i follicoli attivi. Le carenze compromettono la crescita e la qualità dei capelli." data-tr="Demir, D vitamini, çinko, protein ve biyotin aktif foliküller için gereklidir. Eksiklikler büyümeyi ve saç kalitesini olumsuz etkiler.">Eisen, Vitamin D, Zink, Protein und Biotin sind für aktive Follikel essenziell. Mängel beeinträchtigen Wachstum und Qualität.</p></div>
    <div class="hp-card"><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini6" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini6)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><rect x="7" y="3" width="10" height="6" rx="1"/><rect x="4" y="9" width="16" height="12" rx="2"/><line x1="9" y1="14" x2="15" y2="14"/></g></svg></div><h4 data-de="Medikamente" data-en="Medications" data-fr="Médicaments" data-nl="Medicijnen" data-it="Farmaci" data-tr="İlaçlar">Medikamente</h4><p data-de="Blutverdünner, Chemotherapeutika, Antidepressiva, Betablocker und hormonelle Verhütung können Haarausfall als Nebenwirkung haben." data-en="Anticoagulants, chemotherapy drugs, antidepressants, beta-blockers, and hormonal contraceptives can cause hair loss as a side effect." data-fr="Les anticoagulants, les médicaments de chimiothérapie, les antidépresseurs, les bêta-bloquants et les contraceptifs hormonaux peuvent provoquer une chute de cheveux comme effet secondaire." data-nl="Bloedverdunners, chemotherapiemedicijnen, antidepressiva, bètablokkers en hormonale anticonceptie kunnen haaruitval als bijwerking veroorzaken." data-it="Anticoagulanti, farmaci chemioterapici, antidepressivi, betabloccanti e contraccettivi ormonali possono causare la caduta dei capelli come effetto collaterale." data-tr="Kan sulandırıcılar, kemoterapi ilaçları, antidepresanlar, beta blokerler ve hormonal doğum kontrol yöntemleri yan etki olarak saç dökülmesine neden olabilir.">Blutverdünner, Chemotherapeutika, Antidepressiva, Betablocker und hormonelle Verhütung können Haarausfall als Nebenwirkung haben.</p></div>
    <div class="hp-card"><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini7" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini7)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="12.5"/><circle cx="12" cy="16" r="0.5" fill="#fff"/></g></svg></div><h4 data-de="Erkrankungen" data-en="Medical conditions" data-fr="Affections médicales" data-nl="Medische aandoeningen" data-it="Condizioni mediche" data-tr="Tıbbi Durumlar">Erkrankungen</h4><p data-de="Alopecia areata, Kopfhautinfektionen, Lupus und andere Autoimmunerkrankungen sowie Diabetes können Haarausfall verursachen." data-en="Alopecia areata, scalp infections, lupus and other autoimmune diseases, and diabetes can all cause hair loss." data-fr="L'alopécie areata, les infections du cuir chevelu, le lupus et d'autres maladies auto-immunes ainsi que le diabète peuvent tous provoquer une chute de cheveux." data-nl="Alopecia areata, hoofdhuidinfecties, lupus en andere auto-immuunziekten, evenals diabetes, kunnen allemaal haaruitval veroorzaken." data-it="Alopecia areata, infezioni del cuoio capelluto, lupus e altre malattie autoimmuni, così come il diabete, possono tutti causare la caduta dei capelli." data-tr="Alopesi areata, saç derisi enfeksiyonları, lupus ve diğer otoimmün hastalıklar ile diyabet saç dökülmesine neden olabilir.">Alopecia areata, Kopfhautinfektionen, Lupus und andere Autoimmunerkrankungen sowie Diabetes können Haarausfall verursachen.</p></div>
  </div>
  </div>
</section>

<section class="hp-section" id="arten">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gGrid" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gGrid)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="16" y="16" width="12" height="12" rx="3" fill="#fff" opacity="0.95"/><rect x="36" y="16" width="12" height="12" rx="3" fill="#fff" opacity="0.7"/><rect x="16" y="36" width="12" height="12" rx="3" fill="#fff" opacity="0.7"/><rect x="36" y="36" width="12" height="12" rx="3" fill="#fff" opacity="0.95"/></svg>
    <div>
      <h2 data-ckey="arten.heading" data-de="Arten von Haarausfall" data-en="Types of hair loss">Arten von Haarausfall</h2>
      <p data-ckey="arten.body" data-de="Nicht jeder Haarausfall ist gleich. Die Art bestimmt, welche Behandlung sinnvoll ist." data-en="Not all hair loss is the same. The type determines which treatment makes sense.">Nicht jeder Haarausfall ist gleich. Die Art bestimmt, welche Behandlung sinnvoll ist.</p>
    </div>
  </div>
  <div class="hp-media" data-cmedia-wrap>
    <img class="hp-media-img" data-cmedia="arten.image" alt="">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
    <b data-de="Bildplatzhalter: Vergleichsgrafik" data-en="Image placeholder: comparison graphic" data-fr="Espace image : graphique comparatif" data-nl="Afbeeldingsplaceholder: vergelijkingsgrafiek" data-it="Segnaposto immagine: grafico comparativo" data-tr="Görsel Yer Tutucu: Karşılaştırma Grafiği">Bildplatzhalter: Vergleichsgrafik</b>
    <span data-de="Kopfumriss-Illustrationen, die die typischen Ausfallmuster jeder Art zeigen" data-en="Head-outline illustrations showing the typical shedding pattern for each type" data-fr="Illustrations de silhouettes de tête montrant le schéma de perte typique de chaque type" data-nl="Hoofdomtrek-illustraties die het typische uitvalpatroon van elk type tonen" data-it="Illustrazioni con sagome della testa che mostrano il tipico schema di caduta per ciascun tipo" data-tr="Her tür için tipik dökülme desenini gösteren kafa taslağı çizimleri">Kopfumriss-Illustrationen, die die typischen Ausfallmuster jeder Art zeigen</span>
  </div>
  <div class="hp-grid">
    <div class="hp-card"><span class="hp-badge" data-de="Häufigste Form" data-en="Most common" data-fr="Forme la plus fréquente" data-nl="Meest voorkomende vorm" data-it="Forma più comune" data-tr="En Yaygın Form">Häufigste Form</span><h4 data-de="Androgenetische Alopezie" data-en="Androgenetic alopecia" data-fr="Alopécie androgénétique" data-nl="Androgenetische alopecia" data-it="Alopecia androgenetica" data-tr="Androgenetik Alopesi">Androgenetische Alopezie</h4><p data-de="Erblich bedingter Haarausfall. Bei Männern Geheimratsecken und Scheitel (Norwood-Hamilton I–VII), bei Frauen diffuse Ausdünnung des Scheitels (Ludwig I–III). Progressiv, chronisch, bessert sich nicht von selbst." data-en="Genetically inherited pattern hair loss. In men, temple recession and crown thinning (Norwood-Hamilton I–VII); in women, diffuse parting widening (Ludwig I–III). Progressive and chronic, does not resolve on its own." data-fr="Chute de cheveux héréditaire. Chez l'homme, recul des tempes et du sommet (Norwood-Hamilton I–VII) ; chez la femme, amincissement diffus de la raie (Ludwig I–III). Progressive et chronique, ne se résorbe pas d'elle-même." data-nl="Erfelijke haaruitval. Bij mannen, terugtrekkende slapen en kruinverdunning (Norwood-Hamilton I–VII); bij vrouwen, diffuse verbreding van de scheiding (Ludwig I–III). Progressief, chronisch, verdwijnt niet vanzelf." data-it="Caduta dei capelli ereditaria. Negli uomini, recessione temporale e diradamento del vertice (Norwood-Hamilton I–VII); nelle donne, allargamento diffuso della scriminatura (Ludwig I–III). Progressiva, cronica, non si risolve da sola." data-tr="Kalıtsal saç dökülmesi. Erkeklerde şakak çekilmesi ve tepe incelmesi (Norwood-Hamilton I–VII); kadınlarda yaygın ayrım genişlemesi (Ludwig I–III). İlerleyici, kronik, kendiliğinden düzelmez.">Erblich bedingter Haarausfall. Bei Männern Geheimratsecken und Scheitel (Norwood-Hamilton I–VII), bei Frauen diffuse Ausdünnung des Scheitels (Ludwig I–III). Progressiv, chronisch, bessert sich nicht von selbst.</p></div>
    <div class="hp-card"><h4 data-de="Alopecia areata" data-en="Alopecia areata" data-fr="Alopécie en plaques" data-nl="Alopecia areata" data-it="Alopecia areata" data-tr="Alopesi Areata">Alopecia areata</h4><p data-de="Autoimmunerkrankung, bei der das Immunsystem Follikel angreift, meist runde Herde. In den meisten Fällen wächst das Haar zurück, kann aber unvorhersehbar verlaufen." data-en="An autoimmune condition where the immune system attacks follicles, usually causing round patches. In most cases the hair regrows, though it can be unpredictable." data-fr="Une maladie auto-immune dans laquelle le système immunitaire attaque les follicules, provoquant généralement des plaques rondes. Dans la plupart des cas, les cheveux repoussent, bien que cela puisse être imprévisible." data-nl="Een auto-immuunaandoening waarbij het immuunsysteem follikels aanvalt, meestal met ronde plekken tot gevolg. In de meeste gevallen groeit het haar terug, al kan dit onvoorspelbaar verlopen." data-it="Una condizione autoimmune in cui il sistema immunitario attacca i follicoli, causando solitamente chiazze rotonde. Nella maggior parte dei casi i capelli ricrescono, anche se in modo imprevedibile." data-tr="Bağışıklık sisteminin foliküllere saldırdığı, genellikle yuvarlak lekelere neden olan otoimmün bir durumdur. Çoğu vakada saç yeniden çıkar, ancak seyri öngörülemez olabilir.">Autoimmunerkrankung, bei der das Immunsystem Follikel angreift, meist runde Herde. In den meisten Fällen wächst das Haar zurück, kann aber unvorhersehbar verlaufen.</p></div>
    <div class="hp-card"><h4 data-de="Telogenes Effluvium" data-en="Telogen effluvium" data-fr="Effluvium télogène" data-nl="Telogeen effluvium" data-it="Effluvio telogen" data-tr="Telogen Effluvium">Telogenes Effluvium</h4><p data-de="Vorübergehendes, diffuses Ausdünnen 2 bis 4 Monate nach Geburt, OP, schwerer Krankheit oder starkem Stress. Klingt meist innerhalb von 6 bis 12 Monaten ab." data-en="Temporary diffuse shedding 2 to 4 months after childbirth, surgery, severe illness, or major stress. Usually resolves within 6 to 12 months." data-fr="Chute diffuse temporaire, 2 à 4 mois après un accouchement, une opération, une maladie grave ou un stress important. Se résorbe généralement en 6 à 12 mois." data-nl="Tijdelijke diffuse haaruitval, 2 tot 4 maanden na een bevalling, operatie, ernstige ziekte of grote stress. Verdwijnt meestal binnen 6 tot 12 maanden." data-it="Perdita diffusa temporanea, 2-4 mesi dopo il parto, un intervento chirurgico, una malattia grave o uno stress importante. Si risolve solitamente entro 6-12 mesi." data-tr="Doğum, ameliyat, ciddi hastalık veya yoğun stresten 2 ila 4 ay sonra görülen geçici, yaygın dökülmedir. Genellikle 6 ila 12 ay içinde geçer.">Vorübergehendes, diffuses Ausdünnen 2 bis 4 Monate nach Geburt, OP, schwerer Krankheit oder starkem Stress. Klingt meist innerhalb von 6 bis 12 Monaten ab.</p></div>
    <div class="hp-card"><h4 data-de="Traktionsalopezie" data-en="Traction alopecia" data-fr="Alopécie de traction" data-nl="Tractie-alopecia" data-it="Alopecia da trazione" data-tr="Traksiyon Alopesisi">Traktionsalopezie</h4><p data-de="Haarausfall durch dauerhaften Zug, etwa durch enge Zöpfe, Extensions oder Pferdeschwänze. Anfangs reversibel, kann bei anhaltendem Zug dauerhaft werden." data-en="Hair loss from chronic tension, such as tight braids, extensions, or ponytails. Initially reversible, can become permanent if tension continues." data-fr="Chute de cheveux due à une tension chronique, comme des tresses serrées, des extensions ou des queues de cheval. Réversible au début, peut devenir permanente si la tension persiste." data-nl="Haaruitval door aanhoudende trekkracht, zoals strakke vlechten, extensions of paardenstaarten. Aanvankelijk omkeerbaar, kan permanent worden bij aanhoudende trek." data-it="Perdita di capelli causata da tensione cronica, come trecce strette, extension o code di cavallo. Inizialmente reversibile, può diventare permanente se la tensione continua." data-tr="Sıkı örgüler, kaynak saç veya at kuyruğu gibi sürekli çekme nedeniyle oluşan saç dökülmesidir. Başlangıçta geri dönüşlüdür, çekme devam ederse kalıcı hale gelebilir.">Haarausfall durch dauerhaften Zug, etwa durch enge Zöpfe, Extensions oder Pferdeschwänze. Anfangs reversibel, kann bei anhaltendem Zug dauerhaft werden.</p></div>
    <div class="hp-card"><h4 data-de="Vernarbende Alopezie" data-en="Scarring alopecia" data-fr="Alopécie cicatricielle" data-nl="Littekenalopecia" data-it="Alopecia cicatriziale" data-tr="Skatrisyel Alopesi">Vernarbende Alopezie</h4><p data-de="Follikel werden zerstört und durch Narbengewebe ersetzt, dauerhafter Haarverlust. Eine Transplantation ist bei aktiver Entzündung meist nicht geeignet." data-en="Follicles are destroyed and replaced by scar tissue, causing permanent loss. Transplantation is generally unsuitable while inflammation is active." data-fr="Les follicules sont détruits et remplacés par du tissu cicatriciel, entraînant une perte permanente. La greffe n'est généralement pas adaptée tant que l'inflammation est active." data-nl="Follikels worden vernietigd en vervangen door littekenweefsel, wat leidt tot permanent haarverlies. Een transplantatie is doorgaans ongeschikt zolang de ontsteking actief is." data-it="I follicoli vengono distrutti e sostituiti da tessuto cicatriziale, causando una perdita permanente. Il trapianto è generalmente sconsigliato finché l'infiammazione è attiva." data-tr="Foliküller yok olur ve yerini skar dokusu alır, kalıcı saç kaybına yol açar. İltihap aktifken saç ekimi genellikle uygun değildir.">Follikel werden zerstört und durch Narbengewebe ersetzt, dauerhafter Haarverlust. Eine Transplantation ist bei aktiver Entzündung meist nicht geeignet.</p></div>
  </div>
</section>

<section class="hp-section alt" id="diagnose">
  <div class="hp-section-in">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMag" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gMag)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="27" cy="27" r="11" fill="none" stroke="#fff" stroke-width="3.2"/><line x1="35" y1="35" x2="45" y2="45" stroke="#fff" stroke-width="3.2" stroke-linecap="round"/></svg>
    <div>
      <h2 data-ckey="diagnose.heading" data-de="Diagnose &amp; Haaranalyse" data-en="Diagnosis &amp; hair analysis">Diagnose &amp; Haaranalyse</h2>
      <p data-ckey="diagnose.body" data-de="Eine präzise Diagnose ist die Grundlage jeder wirksamen Behandlung." data-en="An accurate diagnosis is the foundation of any effective treatment.">Eine präzise Diagnose ist die Grundlage jeder wirksamen Behandlung.</p>
    </div>
  </div>
  <div class="hp-media" data-cmedia-wrap>
    <img class="hp-media-img" data-cmedia="diagnose.image" alt="">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
    <b data-de="Bildplatzhalter: Klinikfoto" data-en="Image placeholder: clinic photo" data-fr="Espace image : photo de clinique" data-nl="Afbeeldingsplaceholder: kliniekfoto" data-it="Segnaposto immagine: foto della clinica" data-tr="Görsel Yer Tutucu: Klinik Fotoğrafı">Bildplatzhalter: Klinikfoto</b>
    <span data-de="Foto einer Trichoskopie-Untersuchung in der Apex-Klinik" data-en="Photo of a trichoscopy examination at the Apex clinic" data-fr="Photo d'un examen de trichoscopie à la clinique Apex" data-nl="Foto van een trichoscopie-onderzoek in de Apex-kliniek" data-it="Foto di un esame di tricoscopia presso la clinica Apex" data-tr="Apex Kliniği'nde bir trikoskopi muayenesinin fotoğrafı">Foto einer Trichoskopie-Untersuchung in der Apex-Klinik</span>
  </div>
  <div class="hp-grid">
    <div class="hp-card"><h4 data-de="Klinische Untersuchung" data-en="Clinical assessment" data-fr="Évaluation clinique" data-nl="Klinische beoordeling" data-it="Valutazione clinica" data-tr="Klinik Değerlendirme">Klinische Untersuchung</h4><p data-de="Anamnese zu Beginn, Verlauf, Familiengeschichte, Medikamenten und Ernährung, gefolgt von einer körperlichen Untersuchung von Muster und Kopfhaut." data-en="History of onset, progression, family history, medications, and diet, followed by a physical exam of pattern and scalp condition." data-fr="Antécédents concernant le début, l'évolution, les antécédents familiaux, les médicaments et l'alimentation, suivis d'un examen physique du motif et de l'état du cuir chevelu." data-nl="Anamnese van begin, verloop, familiegeschiedenis, medicatie en voeding, gevolgd door een lichamelijk onderzoek van patroon en hoofdhuidconditie." data-it="Anamnesi su esordio, evoluzione, storia familiare, farmaci e alimentazione, seguita da un esame fisico del pattern e delle condizioni del cuoio capelluto." data-tr="Başlangıç, seyir, aile öyküsü, ilaçlar ve beslenmeye ilişkin anamnez, ardından desen ve saç derisi durumunun fiziksel muayenesi.">Anamnese zu Beginn, Verlauf, Familiengeschichte, Medikamenten und Ernährung, gefolgt von einer körperlichen Untersuchung von Muster und Kopfhaut.</p></div>
    <div class="hp-card"><span class="hp-badge" data-de="Bei Apex Beauty" data-en="At Apex Beauty" data-fr="Chez Apex Beauty" data-nl="Bij Apex Beauty" data-it="Da Apex Beauty" data-tr="Apex Beauty'de">Bei Apex Beauty</span><h4 data-de="Trichoskopie &amp; Scalp Mapping" data-en="Trichoscopy &amp; scalp mapping" data-fr="Trichoscopie et cartographie du cuir chevelu" data-nl="Trichoscopie & scalp mapping" data-it="Tricoscopia e mappatura del cuoio capelluto" data-tr="Trikoskopi ve Saç Derisi Haritalama">Trichoskopie &amp; Scalp Mapping</h4><p data-de="Ein Dermatoskop vergrößert die Kopfhaut bis zu 70-fach und zeigt Follikeldichte, Miniaturisierung und Entzündung. Digitales Scalp Mapping dokumentiert Veränderungen präzise über Zeit." data-en="A dermatoscope magnifies the scalp up to 70x, revealing follicle density, miniaturization, and inflammation. Digital scalp mapping tracks changes precisely over time." data-fr="Un dermatoscope grossit le cuir chevelu jusqu'à 70 fois, révélant la densité folliculaire, la miniaturisation et l'inflammation. La cartographie numérique du cuir chevelu documente précisément les changements au fil du temps." data-nl="Een dermatoscoop vergroot de hoofdhuid tot 70x, waardoor follikeldichtheid, miniaturisatie en ontsteking zichtbaar worden. Digitale scalp mapping documenteert veranderingen nauwkeurig over tijd." data-it="Un dermatoscopio ingrandisce il cuoio capelluto fino a 70 volte, rivelando la densità follicolare, la miniaturizzazione e l'infiammazione. La mappatura digitale del cuoio capelluto documenta con precisione i cambiamenti nel tempo." data-tr="Bir dermatoskop saç derisini 70 kata kadar büyüterek folikül yoğunluğunu, minyatürleşmeyi ve iltihabı ortaya koyar. Dijital saç derisi haritalaması, değişiklikleri zaman içinde hassas biçimde belgeler.">Ein Dermatoskop vergrößert die Kopfhaut bis zu 70-fach und zeigt Follikeldichte, Miniaturisierung und Entzündung. Digitales Scalp Mapping dokumentiert Veränderungen präzise über Zeit.</p></div>
    <div class="hp-card"><h4 data-de="Der Zugtest" data-en="The pull test" data-fr="Le test de traction" data-nl="De trektest" data-it="Il pull test" data-tr="Çekme Testi">Der Zugtest</h4><p data-de="40 bis 60 Haare werden sanft gezogen. Lösen sich mehr als 6, deutet das auf aktiven Haarausfall hin." data-en="A bundle of 40 to 60 hairs is gently pulled. Extracting more than 6 suggests active shedding." data-fr="Une mèche de 40 à 60 cheveux est tirée doucement. Si plus de 6 se détachent, cela indique une chute de cheveux active." data-nl="Een bosje van 40 tot 60 haren wordt zachtjes getrokken. Als er meer dan 6 loskomen, duidt dit op actieve haaruitval." data-it="Un ciuffo di 40-60 capelli viene tirato delicatamente. Se se ne staccano più di 6, ciò suggerisce una caduta attiva." data-tr="40 ila 60 saç teli nazikçe çekilir. 6'dan fazlası kopuyorsa, bu aktif saç dökülmesine işaret eder.">40 bis 60 Haare werden sanft gezogen. Lösen sich mehr als 6, deutet das auf aktiven Haarausfall hin.</p></div>
    <div class="hp-card"><h4 data-de="Bluttests" data-en="Blood tests" data-fr="Analyses de sang" data-nl="Bloedonderzoek" data-it="Esami del sangue" data-tr="Kan Testleri">Bluttests</h4><p data-de="Blutbild, Eisen und Ferritin, Schilddrüsenwerte, Hormonspiegel (Testosteron, DHT), Vitamin D, Zink und Blutzucker, um zugrundeliegende Ursachen auszuschließen." data-en="Full blood count, iron and ferritin, thyroid function, hormone levels (testosterone, DHT), vitamin D, zinc, and blood sugar, to rule out underlying causes." data-fr="Numération formule sanguine complète, fer et ferritine, fonction thyroïdienne, taux d'hormones (testostérone, DHT), vitamine D, zinc et glycémie, afin d'exclure des causes sous-jacentes." data-nl="Volledig bloedbeeld, ijzer en ferritine, schildklierfunctie, hormoonspiegels (testosteron, DHT), vitamine D, zink en bloedsuiker, om onderliggende oorzaken uit te sluiten." data-it="Emocromo completo, ferro e ferritina, funzione tiroidea, livelli ormonali (testosterone, DHT), vitamina D, zinco e glicemia, per escludere cause sottostanti." data-tr="Altta yatan nedenleri dışlamak için tam kan sayımı, demir ve ferritin, tiroid fonksiyonu, hormon düzeyleri (testosteron, DHT), D vitamini, çinko ve kan şekeri.">Blutbild, Eisen und Ferritin, Schilddrüsenwerte, Hormonspiegel (Testosteron, DHT), Vitamin D, Zink und Blutzucker, um zugrundeliegende Ursachen auszuschließen.</p></div>
    <div class="hp-card"><h4 data-de="Kopfhautbiopsie" data-en="Scalp biopsy" data-fr="Biopsie du cuir chevelu" data-nl="Hoofdhuidbiopsie" data-it="Biopsia del cuoio capelluto" data-tr="Saç Derisi Biyopsisi">Kopfhautbiopsie</h4><p data-de="Bei unklaren Fällen bestätigt eine kleine Gewebeprobe unter dem Mikroskop die Art des Haarausfalls und mögliche Entzündungen." data-en="In unclear cases, a small tissue sample under the microscope confirms the type of hair loss and any inflammation." data-fr="Dans les cas incertains, un petit échantillon de tissu examiné au microscope confirme le type de chute de cheveux et une éventuelle inflammation." data-nl="In onduidelijke gevallen bevestigt een klein weefselmonster onder de microscoop het type haaruitval en eventuele ontsteking." data-it="Nei casi incerti, un piccolo campione di tessuto esaminato al microscopio conferma il tipo di caduta dei capelli ed eventuali infiammazioni." data-tr="Belirsiz vakalarda, mikroskop altında incelenen küçük bir doku örneği saç dökülmesinin türünü ve olası iltihabı doğrular.">Bei unklaren Fällen bestätigt eine kleine Gewebeprobe unter dem Mikroskop die Art des Haarausfalls und mögliche Entzündungen.</p></div>
  </div>
  </div>
</section>

<section class="hp-section" id="behandlung">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gPill" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gPill)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="16" y="25" width="32" height="14" rx="7" fill="none" stroke="#fff" stroke-width="3"/><line x1="32" y1="25" x2="32" y2="39" stroke="#fff" stroke-width="3"/></svg>
    <div>
      <h2 data-ckey="behandlung.heading" data-de="Behandlungsmöglichkeiten" data-en="Treatment options">Behandlungsmöglichkeiten</h2>
      <p data-ckey="behandlung.body" data-de="Von topischen Medikamenten bis zur Transplantation, jede Option hat einen anderen Wirkmechanismus, Aufwand und Evidenzgrad." data-en="From topical medication to transplantation, each option differs in mechanism, effort, and quality of evidence.">Von topischen Medikamenten bis zur Transplantation, jede Option hat einen anderen Wirkmechanismus, Aufwand und Evidenzgrad.</p>
    </div>
  </div>
  <div class="hp-media" data-cmedia-wrap>
    <img class="hp-media-img" data-cmedia="behandlung.image" alt="">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
    <b data-de="Bildplatzhalter: Produktfotos" data-en="Image placeholder: product photos" data-fr="Espace image : photos de produits" data-nl="Afbeeldingsplaceholder: productfoto's" data-it="Segnaposto immagine: foto dei prodotti" data-tr="Görsel Yer Tutucu: Ürün Fotoğrafları">Bildplatzhalter: Produktfotos</b>
    <span data-de="Foto-Serie der Behandlungsoptionen: Minoxidil-Flasche, PRP-Kit, Mesotherapie-Set" data-en="Photo series of treatment options: minoxidil bottle, PRP kit, mesotherapy set" data-fr="Série de photos des options de traitement : flacon de minoxidil, kit PRP, set de mésothérapie" data-nl="Fotoreeks van behandelopties: minoxidilflacon, PRP-kit, mesotherapieset" data-it="Serie di foto delle opzioni di trattamento: flacone di minoxidil, kit PRP, set di mesoterapia" data-tr="Tedavi seçeneklerinin fotoğraf serisi: minoksidil şişesi, PRP kiti, mezoterapi seti">Foto-Serie der Behandlungsoptionen: Minoxidil-Flasche, PRP-Kit, Mesotherapie-Set</span>
  </div>
  <div class="hp-grid">
    <div class="hp-card"><h4 data-de="Minoxidil" data-en="Minoxidil" data-fr="Minoxidil" data-nl="Minoxidil" data-it="Minoxidil" data-tr="Minoksidil">Minoxidil</h4><p data-de="Topisch oder oral. Verlängert die Anagen-Phase und verbessert die Durchblutung. Blockiert kein DHT. Wirkung sichtbar nach 4 bis 6 Monaten, hält nur bei fortgesetzter Anwendung." data-en="Topical or oral. Extends the anagen phase and improves blood flow. Doesn't block DHT. Visible after 4 to 6 months, only lasts with continued use." data-fr="Topique ou oral. Prolonge la phase anagène et améliore la circulation sanguine. Ne bloque pas la DHT. Effet visible après 4 à 6 mois, ne persiste qu'avec une utilisation continue." data-nl="Topisch of oraal. Verlengt de anagene fase en verbetert de doorbloeding. Blokkeert geen DHT. Effect zichtbaar na 4 tot 6 maanden, houdt alleen aan bij voortgezet gebruik." data-it="Topico o orale. Prolunga la fase anagen e migliora la circolazione sanguigna. Non blocca il DHT. Effetto visibile dopo 4-6 mesi, dura solo con l'uso continuato." data-tr="Topikal veya oral. Anagen evresini uzatır ve kan akışını iyileştirir. DHT'yi engellemez. Etkisi 4 ila 6 ay sonra görülür, yalnızca kullanıma devam edildiğinde kalıcıdır.">Topisch oder oral. Verlängert die Anagen-Phase und verbessert die Durchblutung. Blockiert kein DHT. Wirkung sichtbar nach 4 bis 6 Monaten, hält nur bei fortgesetzter Anwendung.</p></div>
    <div class="hp-card"><h4 data-de="Finasterid" data-en="Finasteride" data-fr="Finastéride" data-nl="Finasteride" data-it="Finasteride" data-tr="Finasterid">Finasterid</h4><p data-de="Orales Medikament, senkt DHT in der Kopfhaut um rund 70%. Stoppt den Haarausfall bei rund 90% der Männer, fördert Regrowth bei rund 65%." data-en="Oral medication, reduces scalp DHT by around 70%. Stops hair loss in around 90% of men, promotes regrowth in around 65%." data-fr="Médicament oral, réduit le DHT du cuir chevelu d'environ 70%. Stoppe la chute de cheveux chez environ 90% des hommes, favorise la repousse chez environ 65%." data-nl="Oraal medicijn, vermindert DHT in de hoofdhuid met ongeveer 70%. Stopt haaruitval bij ongeveer 90% van de mannen, bevordert hergroei bij ongeveer 65%." data-it="Farmaco orale, riduce il DHT del cuoio capelluto di circa il 70%. Arresta la caduta dei capelli in circa il 90% degli uomini, favorisce la ricrescita in circa il 65%." data-tr="Oral ilaç, saç derisindeki DHT'yi yaklaşık %70 azaltır. Erkeklerin yaklaşık %90'ında saç dökülmesini durdurur, yaklaşık %65'inde yeniden büyümeyi destekler.">Orales Medikament, senkt DHT in der Kopfhaut um rund 70%. Stoppt den Haarausfall bei rund 90% der Männer, fördert Regrowth bei rund 65%.</p></div>
    <div class="hp-card"><h4 data-de="Dutasterid" data-en="Dutasteride" data-fr="Dutastéride" data-nl="Dutasteride" data-it="Dutasteride" data-tr="Dutasterid">Dutasterid</h4><p data-de="Stärkere Alternative zu Finasterid, senkt DHT um rund 90%. Off-Label unter ärztlicher Aufsicht, besonders wirksam am Oberkopf." data-en="A more potent alternative to finasteride, reduces DHT by around 90%. Used off-label under medical supervision, particularly effective at the crown." data-fr="Alternative plus puissante au finastéride, réduit la DHT d'environ 90%. Utilisé hors AMM sous supervision médicale, particulièrement efficace au niveau du vertex." data-nl="Krachtiger alternatief voor finasteride, vermindert DHT met ongeveer 90%. Off-label gebruikt onder medisch toezicht, bijzonder effectief bij de kruin." data-it="Alternativa più potente alla finasteride, riduce il DHT di circa il 90%. Usato off-label sotto controllo medico, particolarmente efficace sul vertice." data-tr="Finasteride göre daha güçlü bir alternatiftir, DHT'yi yaklaşık %90 azaltır. Tıbbi gözetim altında endikasyon dışı kullanılır, tepe bölgesinde özellikle etkilidir.">Stärkere Alternative zu Finasterid, senkt DHT um rund 90%. Off-Label unter ärztlicher Aufsicht, besonders wirksam am Oberkopf.</p></div>
    <div class="hp-card"><h4 data-de="PRP" data-en="PRP" data-fr="PRP" data-nl="PRP" data-it="PRP" data-tr="PRP">PRP</h4><p data-de="Plättchenreiches Plasma aus dem eigenen Blut wird in die Kopfhaut injiziert und regt die Follikelaktivität an. Meist als Ergänzung, Sitzungen alle 3 bis 6 Monate." data-en="Platelet-rich plasma from the patient's own blood is injected into the scalp to stimulate follicle activity. Usually a complement, sessions every 3 to 6 months." data-fr="Le plasma riche en plaquettes issu du propre sang du patient est injecté dans le cuir chevelu pour stimuler l'activité folliculaire. Généralement en complément, séances tous les 3 à 6 mois." data-nl="Bloedplaatjesrijk plasma uit het eigen bloed van de patiënt wordt in de hoofdhuid geïnjecteerd om de follikelactiviteit te stimuleren. Meestal als aanvulling, sessies elke 3 tot 6 maanden." data-it="Il plasma ricco di piastrine ricavato dal sangue del paziente viene iniettato nel cuoio capelluto per stimolare l'attività follicolare. Solitamente come complemento, sedute ogni 3-6 mesi." data-tr="Hastanın kendi kanından elde edilen trombositten zengin plazma, folikül aktivitesini uyarmak için saç derisine enjekte edilir. Genellikle tamamlayıcı olarak kullanılır, seanslar 3-6 ayda bir yapılır.">Plättchenreiches Plasma aus dem eigenen Blut wird in die Kopfhaut injiziert und regt die Follikelaktivität an. Meist als Ergänzung, Sitzungen alle 3 bis 6 Monate.</p></div>
    <div class="hp-card"><span class="hp-badge" data-de="Experimentell" data-en="Experimental" data-fr="Expérimental" data-nl="Experimenteel" data-it="Sperimentale" data-tr="Deneysel">Experimentell</span><h4 data-de="Exosomen" data-en="Exosomes" data-fr="Exosomes" data-nl="Exosomen" data-it="Esosomi" data-tr="Ekzozomlar">Exosomen</h4><p data-de="Aus Stammzellen gewonnene Vesikel mit Wachstumssignalen, per Microneedling oder Injektion angewendet. Vielversprechend, aber noch begrenzte Langzeitdaten." data-en="Stem cell-derived vesicles carrying growth signals, applied via micro-needling or injection. Promising, but long-term data is still limited." data-fr="Vésicules dérivées de cellules souches porteuses de signaux de croissance, appliquées par micro-aiguilletage ou injection. Prometteur, mais les données à long terme restent limitées." data-nl="Uit stamcellen verkregen blaasjes met groeisignalen, toegepast via micro-needling of injectie. Veelbelovend, maar langetermijngegevens zijn nog beperkt." data-it="Vescicole derivate da cellule staminali che trasportano segnali di crescita, applicate tramite micro-needling o iniezione. Promettente, ma i dati a lungo termine sono ancora limitati." data-tr="Büyüme sinyalleri taşıyan kök hücre kaynaklı veziküller, mikro-iğneleme veya enjeksiyon yoluyla uygulanır. Umut verici olsa da uzun vadeli veriler henüz sınırlıdır.">Aus Stammzellen gewonnene Vesikel mit Wachstumssignalen, per Microneedling oder Injektion angewendet. Vielversprechend, aber noch begrenzte Langzeitdaten.</p></div>
    <div class="hp-card"><h4 data-de="Mesotherapie" data-en="Mesotherapy" data-fr="Mésothérapie" data-nl="Mesotherapie" data-it="Mesoterapia" data-tr="Mezoterapi">Mesotherapie</h4><p data-de="Mikroinjektionen aus Vitaminen, Mineralien und Wachstumsfaktoren zur Unterstützung der Kopfhautgesundheit. Meist begleitend zu anderen Behandlungen." data-en="Micro-injections of vitamins, minerals, and growth factors to support scalp health. Usually combined with other treatments." data-fr="Micro-injections de vitamines, minéraux et facteurs de croissance pour soutenir la santé du cuir chevelu. Généralement associée à d'autres traitements." data-nl="Micro-injecties van vitamines, mineralen en groeifactoren ter ondersteuning van de hoofdhuidgezondheid. Meestal gecombineerd met andere behandelingen." data-it="Micro-iniezioni di vitamine, minerali e fattori di crescita per sostenere la salute del cuoio capelluto. Solitamente abbinata ad altri trattamenti." data-tr="Saç derisi sağlığını desteklemek için vitamin, mineral ve büyüme faktörlerinin mikro enjeksiyonları. Genellikle diğer tedavilerle birlikte uygulanır.">Mikroinjektionen aus Vitaminen, Mineralien und Wachstumsfaktoren zur Unterstützung der Kopfhautgesundheit. Meist begleitend zu anderen Behandlungen.</p></div>
    <div class="hp-card"><span class="hp-badge" data-de="Einzig dauerhafte Lösung" data-en="Only permanent option" data-fr="Seule solution permanente" data-nl="Enige permanente oplossing" data-it="Unica soluzione permanente" data-tr="Tek Kalıcı Çözüm">Einzig dauerhafte Lösung</span><h4 data-de="Haartransplantation" data-en="Hair transplantation" data-fr="Greffe de cheveux" data-nl="Haartransplantatie" data-it="Trapianto di capelli" data-tr="Saç Ekimi">Haartransplantation</h4><p data-de="Die einzige Behandlung, die dauerhaft Haare in kahle oder ausgedünnte Bereiche zurückbringt. Gesunde Follikel aus dem DHT-resistenten Spenderbereich werden verpflanzt." data-en="The only treatment that permanently restores hair to bald or thinning areas. Healthy follicles from the DHT-resistant donor zone are relocated." data-fr="Le seul traitement qui restaure durablement les cheveux dans les zones chauves ou clairsemées. Des follicules sains provenant de la zone donneuse résistante à la DHT sont déplacés." data-nl="De enige behandeling die haar permanent herstelt in kale of dunner wordende zones. Gezonde follikels uit het DHT-resistente donorgebied worden verplaatst." data-it="L'unico trattamento che ripristina permanentemente i capelli nelle aree calve o diradate. Follicoli sani provenienti dall'area donatrice resistente al DHT vengono trapiantati." data-tr="Kel veya seyrelmiş bölgelere kalıcı olarak saç kazandıran tek tedavidir. DHT'ye dirençli donör bölgeden sağlıklı foliküller nakledilir.">Die einzige Behandlung, die dauerhaft Haare in kahle oder ausgedünnte Bereiche zurückbringt. Gesunde Follikel aus dem DHT-resistenten Spenderbereich werden verpflanzt.</p></div>
  </div>
</section>

<section class="hp-section alt" id="transplantation">
  <div class="hp-section-in">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gGraft" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gGraft)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M22 46c-1-8 1-15 4-19M32 46c0-9 0-16 0-20M42 46c1-8-1-15-4-19" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round"/><circle cx="22" cy="48" r="2.4" fill="#fff"/><circle cx="32" cy="48" r="2.4" fill="#fff"/><circle cx="42" cy="48" r="2.4" fill="#fff"/></svg>
    <div>
      <h2 data-ckey="transplantation.heading" data-de="Haartransplantation" data-en="Hair transplantation" data-fr="Greffe de cheveux" data-nl="Haartransplantatie" data-it="Trapianto di capelli" data-tr="Saç Ekimi">Haartransplantation</h2>
      <p data-ckey="transplantation.body" data-de="Ein chirurgischer Eingriff unter örtlicher Betäubung. Gesunde, DHT-resistente Follikel werden aus dem Spenderbereich entnommen und in ausgedünnte Areale verpflanzt, wo sie dauerhaft weiterwachsen." data-en="A surgical procedure under local anaesthesia. Healthy, DHT-resistant follicles are taken from the donor area and relocated to thinning areas, where they keep growing for life.">Ein chirurgischer Eingriff unter örtlicher Betäubung. Gesunde, DHT-resistente Follikel werden aus dem Spenderbereich entnommen und in ausgedünnte Areale verpflanzt, wo sie dauerhaft weiterwachsen.</p>
    </div>
  </div>
  <div class="hp-media" data-cmedia-wrap>
    <img class="hp-media-img" data-cmedia="transplantation.image" alt="">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
    <b data-de="Bildplatzhalter: Technik-Diagramm" data-en="Image placeholder: technique diagram" data-fr="Espace image : diagramme technique" data-nl="Afbeeldingsplaceholder: technisch diagram" data-it="Segnaposto immagine: diagramma tecnico" data-tr="Görsel Yer Tutucu: Teknik Diyagram">Bildplatzhalter: Technik-Diagramm</b>
    <span data-de="Schnittdarstellung von FUE, Saphir-FUE und DHI im direkten Vergleich" data-en="Cross-section illustration comparing FUE, Sapphire FUE, and DHI" data-fr="Illustration en coupe transversale comparant FUE, FUE au saphir et DHI" data-nl="Doorsnede-illustratie ter vergelijking van FUE, Saffier-FUE en DHI" data-it="Illustrazione in sezione trasversale che confronta FUE, Saphire-FUE e DHI" data-tr="FUE, Safir FUE ve DHI'yi karşılaştıran kesit çizimi">Schnittdarstellung von FUE, Saphir-FUE und DHI im direkten Vergleich</span>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Wer ist geeignet?" data-en="Who is a suitable candidate?" data-fr="Qui est un bon candidat ?" data-nl="Wie komt in aanmerking?" data-it="Chi è un candidato idoneo?" data-tr="Kimler Uygun Adaydır?">Wer ist geeignet?</h3>
  <div class="hp-checklist" style="margin-bottom:40px">
    <div class="hp-check"><span class="tick">✓</span><p data-de="Androgenetische Alopezie in einer stabilen Phase (der Ausfall hat sich verlangsamt oder stabilisiert)." data-en="Androgenetic alopecia in a stable phase (loss has slowed or stabilised)." data-fr="Alopécie androgénétique en phase stable (la chute a ralenti ou s'est stabilisée)." data-nl="Androgenetische alopecia in een stabiele fase (het uitvallen is vertraagd of gestabiliseerd)." data-it="Alopecia androgenetica in fase stabile (la caduta è rallentata o si è stabilizzata)." data-tr="Stabil evrede androgenetik alopesi (dökülme yavaşlamış veya durmuş).">Androgenetische Alopezie in einer stabilen Phase (der Ausfall hat sich verlangsamt oder stabilisiert).</p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-de="Ausreichende Spenderdichte an Hinterkopf und Seiten." data-en="Adequate donor density at the back and sides of the scalp." data-fr="Densité donneuse suffisante à l'arrière et sur les côtés du cuir chevelu." data-nl="Voldoende donordichtheid aan achterhoofd en zijkanten." data-it="Densità donatrice adeguata sul retro e ai lati del cuoio capelluto." data-tr="Saç derisinin arka ve yan bölgelerinde yeterli donör yoğunluğu.">Ausreichende Spenderdichte an Hinterkopf und Seiten.</p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-de="Realistische Erwartungen: eine Transplantation stellt Dichte wieder her, repliziert aber nicht die volle Haarfülle der Jugend." data-en="Realistic expectations: a transplant restores density but cannot replicate the full hair of early youth." data-fr="Attentes réalistes : une greffe restaure la densité mais ne peut pas reproduire la pleine chevelure de la jeunesse." data-nl="Realistische verwachtingen: een transplantatie herstelt dichtheid maar reproduceert niet de volledige haardracht van de jeugd." data-it="Aspettative realistiche: un trapianto ripristina la densità ma non può replicare la piena capigliatura giovanile." data-tr="Gerçekçi beklentiler: bir nakil yoğunluğu geri kazandırır ancak gençlik dönemindeki tam saç yoğunluğunu tekrar oluşturamaz.">Realistische Erwartungen: eine Transplantation stellt Dichte wieder her, repliziert aber nicht die volle Haarfülle der Jugend.</p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-de="Guter allgemeiner Gesundheitszustand, keine aktiven Infektionen oder unbehandelten Autoimmunerkrankungen." data-en="Good general health, no active infections or untreated autoimmune conditions." data-fr="Bon état de santé général, aucune infection active ni maladie auto-immune non traitée." data-nl="Goede algemene gezondheid, geen actieve infecties of onbehandelde auto-immuunaandoeningen." data-it="Buono stato di salute generale, nessuna infezione attiva o condizione autoimmune non trattata." data-tr="İyi genel sağlık durumu, aktif enfeksiyon veya tedavi edilmemiş otoimmün hastalık bulunmaması.">Guter allgemeiner Gesundheitszustand, keine aktiven Infektionen oder unbehandelten Autoimmunerkrankungen.</p></div>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Die drei wichtigsten Techniken" data-en="The three main techniques" data-fr="Les trois principales techniques" data-nl="De drie belangrijkste technieken" data-it="Le tre tecniche principali" data-tr="Üç Ana Teknik">Die drei wichtigsten Techniken</h3>
  <div class="hp-grid" style="margin-bottom:32px">
    <div class="hp-card"><h4 data-de="FUE" data-en="FUE" data-fr="FUE" data-nl="FUE" data-it="FUE" data-tr="FUE">FUE</h4><p data-de="Follikuläre Einheiten (1 bis 4 Haare) werden einzeln mit einem Mikro-Punch-Werkzeug entnommen. Kein linearer Schnitt, keine sichtbare Narbe. 5 bis 8 Stunden je nach Graft-Anzahl." data-en="Follicular units (1 to 4 hairs) are extracted one by one with a micro-punch tool. No linear incision, no visible scar. 5 to 8 hours depending on graft count." data-fr="Les unités folliculaires (1 à 4 cheveux) sont extraites une à une à l'aide d'un micro-punch. Pas d'incision linéaire, pas de cicatrice visible. 5 à 8 heures selon le nombre de greffons." data-nl="Folliculaire eenheden (1 tot 4 haren) worden één voor één geëxtraheerd met een micro-punchtool. Geen lineaire incisie, geen zichtbaar litteken. 5 tot 8 uur, afhankelijk van het aantal grafts." data-it="Le unità follicolari (1-4 capelli) vengono estratte una per una con uno strumento micro-punch. Nessuna incisione lineare, nessuna cicatrice visibile. 5-8 ore a seconda del numero di innesti." data-tr="Foliküler üniteler (1 ila 4 saç teli) mikro-punch aracıyla tek tek çıkarılır. Doğrusal kesi yoktur, görünür iz kalmaz. Greft sayısına bağlı olarak 5 ila 8 saat sürer.">Follikuläre Einheiten (1 bis 4 Haare) werden einzeln mit einem Mikro-Punch-Werkzeug entnommen. Kein linearer Schnitt, keine sichtbare Narbe. 5 bis 8 Stunden je nach Graft-Anzahl.</p></div>
    <div class="hp-card"><span class="hp-badge" data-de="Meistgenutzt in Istanbul" data-en="Most used in Istanbul" data-fr="La plus utilisée à Istanbul" data-nl="Meest gebruikt in Istanboel" data-it="La più utilizzata a Istanbul" data-tr="İstanbul'da En Çok Kullanılan">Meistgenutzt in Istanbul</span><h4 data-de="Saphir-FUE" data-en="Sapphire FUE" data-fr="FUE au saphir" data-nl="Saffier-FUE" data-it="Saphire-FUE" data-tr="Safir FUE">Saphir-FUE</h4><p data-de="Kanäle werden mit Saphirklingen statt Stahl geöffnet: kleinere, präzisere Schnitte, schnellere Heilung, höhere Dichte pro cm² und geringeres Risiko für Verkrustung." data-en="Channels are opened with sapphire blades instead of steel: smaller, more precise incisions, faster healing, higher density per cm², and lower risk of scabbing." data-fr="Les canaux sont ouverts avec des lames en saphir plutôt qu'en acier : incisions plus petites et plus précises, guérison plus rapide, densité plus élevée par cm² et risque réduit de croûtes." data-nl="Kanalen worden geopend met saffieren lemmeten in plaats van staal: kleinere, preciezere incisies, sneller herstel, hogere dichtheid per cm² en lager risico op korstvorming." data-it="I canali vengono aperti con lame di zaffiro anziché in acciaio: incisioni più piccole e precise, guarigione più rapida, maggiore densità per cm² e minor rischio di crostosità." data-tr="Kanallar çelik yerine safir bıçaklarla açılır: daha küçük, daha hassas kesiler, daha hızlı iyileşme, cm² başına daha yüksek yoğunluk ve daha düşük kabuklanma riski.">Kanäle werden mit Saphirklingen statt Stahl geöffnet: kleinere, präzisere Schnitte, schnellere Heilung, höhere Dichte pro cm² und geringeres Risiko für Verkrustung.</p></div>
    <div class="hp-card"><h4 data-de="DHI" data-en="DHI" data-fr="DHI" data-nl="DHI" data-it="DHI" data-tr="DHI">DHI</h4><p data-de="Follikel werden mit einem Choi Implanter Pen direkt implantiert, ohne separate Kanaleröffnung. Präzise Kontrolle über Winkel und Tiefe, ideal für den Haaransatz." data-en="Follicles are implanted directly using a Choi Implanter Pen, without opening separate channels first. Precise control over angle and depth, ideal for the hairline." data-fr="Les follicules sont implantés directement à l'aide d'un stylo implanteur Choi, sans ouverture préalable de canaux séparés. Contrôle précis de l'angle et de la profondeur, idéal pour la ligne capillaire." data-nl="Follikels worden direct geïmplanteerd met een Choi Implanter Pen, zonder eerst afzonderlijke kanalen te openen. Nauwkeurige controle over hoek en diepte, ideaal voor de haarlijn." data-it="I follicoli vengono impiantati direttamente con una penna Choi Implanter, senza aprire prima canali separati. Controllo preciso di angolo e profondità, ideale per l'attaccatura." data-tr="Foliküller, önce ayrı kanallar açılmadan doğrudan bir Choi İmplanter Kalemi ile yerleştirilir. Açı ve derinlik üzerinde hassas kontrol sağlar, saç çizgisi için idealdir.">Follikel werden mit einem Choi Implanter Pen direkt implantiert, ohne separate Kanaleröffnung. Präzise Kontrolle über Winkel und Tiefe, ideal für den Haaransatz.</p></div>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Saphir-FUE oder DHI: der Vergleich" data-en="Sapphire FUE vs. DHI: the comparison" data-fr="FUE au saphir ou DHI : la comparaison" data-nl="Saffier-FUE of DHI: de vergelijking" data-it="Saphire-FUE o DHI: il confronto" data-tr="Safir FUE mi DHI mi: Karşılaştırma">Saphir-FUE oder DHI: der Vergleich</h3>
  <div class="hp-table-wrap" style="margin-bottom:32px">
    <table class="hp-table">
      <tr><th data-de="Faktor" data-en="Factor" data-fr="Facteur" data-nl="Factor" data-it="Fattore" data-tr="Faktör">Faktor</th><th data-de="Saphir-FUE" data-en="Sapphire FUE" data-fr="FUE au saphir" data-nl="Saffier-FUE" data-it="Saphire-FUE" data-tr="Safir FUE">Saphir-FUE</th><th data-de="DHI" data-en="DHI" data-fr="DHI" data-nl="DHI" data-it="DHI" data-tr="DHI">DHI</th></tr>
      <tr><td data-de="Am besten für" data-en="Best for" data-fr="Idéal pour" data-nl="Het beste voor" data-it="Ideale per" data-tr="En İyi Kullanım Alanı">Am besten für</td><td data-de="Große Flächen, hohe Graft-Zahlen" data-en="Large areas, high graft counts" data-fr="Grandes surfaces, nombre élevé de greffons" data-nl="Grote gebieden, hoge graftaantallen" data-it="Aree ampie, elevato numero di innesti" data-tr="Geniş alanlar, yüksek greft sayıları">Große Flächen, hohe Graft-Zahlen</td><td data-de="Haaransatz, hohe Detailtreue, kleinere Flächen" data-en="Frontal hairline, high detail, smaller areas" data-fr="Ligne frontale, grande précision, petites surfaces" data-nl="Voorste haarlijn, hoge precisie, kleinere gebieden" data-it="Attaccatura frontale, alta precisione, aree più piccole" data-tr="Ön saç çizgisi, yüksek detay, küçük alanlar">Haaransatz, hohe Detailtreue, kleinere Flächen</td></tr>
      <tr><td data-de="Heilung" data-en="Healing" data-fr="Guérison" data-nl="Genezing" data-it="Guarigione" data-tr="İyileşme">Heilung</td><td data-de="Schnell (kleinere Schnitte)" data-en="Fast (smaller incisions)" data-fr="Rapide (incisions plus petites)" data-nl="Snel (kleinere incisies)" data-it="Veloce (incisioni più piccole)" data-tr="Hızlı (daha küçük kesiler)">Schnell (kleinere Schnitte)</td><td data-de="Moderat (mehr Werkzeugdurchgänge)" data-en="Moderate (more tool passes)" data-fr="Modérée (davantage de passages d'outil)" data-nl="Matig (meer instrumentbewegingen)" data-it="Moderata (più passaggi dello strumento)" data-tr="Orta (daha fazla alet geçişi)">Moderat (mehr Werkzeugdurchgänge)</td></tr>
      <tr><td data-de="Präzision" data-en="Precision" data-fr="Précision" data-nl="Precisie" data-it="Precisione" data-tr="Hassasiyet">Präzision</td><td data-de="Hoch" data-en="High" data-fr="Élevée" data-nl="Hoog" data-it="Alta" data-tr="Yüksek">Hoch</td><td data-de="Sehr hoch (Winkel- und Tiefenkontrolle)" data-en="Very high (angle and depth control)" data-fr="Très élevée (contrôle de l'angle et de la profondeur)" data-nl="Zeer hoog (hoek- en dieptecontrole)" data-it="Molto alta (controllo di angolo e profondità)" data-tr="Çok yüksek (açı ve derinlik kontrolü)">Sehr hoch (Winkel- und Tiefenkontrolle)</td></tr>
      <tr><td data-de="Typische Sitzungsdauer" data-en="Typical session length" data-fr="Durée de séance typique" data-nl="Typische sessieduur" data-it="Durata tipica della seduta" data-tr="Tipik Seans Süresi">Typische Sitzungsdauer</td><td data-de="5 bis 8 Stunden" data-en="5 to 8 hours" data-fr="5 à 8 heures" data-nl="5 tot 8 uur" data-it="5-8 ore" data-tr="5 ila 8 saat">5 bis 8 Stunden</td><td data-de="6 bis 10 Stunden" data-en="6 to 10 hours" data-fr="6 à 10 heures" data-nl="6 tot 10 uur" data-it="6-10 ore" data-tr="6 ila 10 saat">6 bis 10 Stunden</td></tr>
      <tr><td data-de="Relative Kosten" data-en="Relative cost" data-fr="Coût relatif" data-nl="Relatieve kosten" data-it="Costo relativo" data-tr="Göreceli Maliyet">Relative Kosten</td><td data-de="Moderat" data-en="Moderate" data-fr="Modéré" data-nl="Matig" data-it="Moderato" data-tr="Orta">Moderat</td><td data-de="Höher" data-en="Higher" data-fr="Plus élevé" data-nl="Hoger" data-it="Più elevato" data-tr="Daha Yüksek">Höher</td></tr>
      <tr><td data-de="Kombinierbar?" data-en="Can be combined?" data-fr="Combinable ?" data-nl="Combineerbaar?" data-it="Combinabile?" data-tr="Birlikte Kullanılabilir mi?">Kombinierbar?</td><td data-de="Ja" data-en="Yes" data-fr="Oui" data-nl="Ja" data-it="Sì" data-tr="Evet">Ja</td><td data-de="Ja, DHI für Ansatz + Saphir-FUE für Oberkopf ist gängig" data-en="Yes, DHI for hairline + Sapphire FUE for crown is common" data-fr="Oui, DHI pour la ligne frontale + FUE au saphir pour le sommet est courant" data-nl="Ja, DHI voor de haarlijn + Saffier-FUE voor de kruin is gebruikelijk" data-it="Sì, DHI per l'attaccatura + Saphire-FUE per il vertice è una combinazione comune" data-tr="Evet, saç çizgisi için DHI + tepe için Safir FUE kombinasyonu yaygındır">Ja, DHI für Ansatz + Saphir-FUE für Oberkopf ist gängig</td></tr>
    </table>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Realistische Erwartungen" data-en="Realistic expectations" data-fr="Attentes réalistes" data-nl="Realistische verwachtingen" data-it="Aspettative realistiche" data-tr="Gerçekçi Beklentiler">Realistische Erwartungen</h3>
  <div class="hp-checklist">
    <div class="hp-check"><span class="tick">i</span><p data-de="Eine Transplantation verschiebt vorhandene gesunde Follikel, sie erschafft keine neuen. Das Ergebnis ist durch den verfügbaren Spenderbereich begrenzt." data-en="A transplant relocates existing healthy follicles; it cannot create new ones. The result is limited by the available donor area." data-fr="Une greffe déplace des follicules sains existants ; elle ne peut pas en créer de nouveaux. Le résultat est limité par la zone donneuse disponible." data-nl="Een transplantatie verplaatst bestaande gezonde follikels; er kunnen geen nieuwe worden aangemaakt. Het resultaat wordt beperkt door het beschikbare donorgebied." data-it="Un trapianto sposta follicoli sani esistenti; non può crearne di nuovi. Il risultato è limitato dall'area donatrice disponibile." data-tr="Bir nakil, mevcut sağlıklı foliküllerin yerini değiştirir; yeni folikül oluşturmaz. Sonuç, mevcut donör alanla sınırlıdır.">Eine Transplantation verschiebt vorhandene gesunde Follikel, sie erschafft keine neuen. Das Ergebnis ist durch den verfügbaren Spenderbereich begrenzt.</p></div>
    <div class="hp-check"><span class="tick">i</span><p data-de="Transplantiertes Haar wächst lebenslang, da es aus DHT-resistenten Zonen stammt." data-en="Transplanted hair grows for life because it's taken from DHT-resistant zones." data-fr="Les cheveux transplantés poussent à vie car ils proviennent de zones résistantes à la DHT." data-nl="Getransplanteerd haar groeit levenslang omdat het afkomstig is uit DHT-resistente zones." data-it="I capelli trapiantati crescono per tutta la vita perché provengono da zone resistenti al DHT." data-tr="Nakledilen saçlar DHT'ye dirençli bölgelerden alındığı için ömür boyu büyür.">Transplantiertes Haar wächst lebenslang, da es aus DHT-resistenten Zonen stammt.</p></div>
    <div class="hp-check"><span class="tick">i</span><p data-de="Das vollständige Ergebnis zeigt sich erst nach 12 bis 18 Monaten, nicht sofort." data-en="Full results are visible at 12 to 18 months, not immediately." data-fr="Le résultat complet est visible entre 12 et 18 mois, pas immédiatement." data-nl="Het volledige resultaat is pas na 12 tot 18 maanden zichtbaar, niet meteen." data-it="Il risultato completo è visibile dopo 12-18 mesi, non immediatamente." data-tr="Tam sonuç hemen değil, 12 ila 18 ay içinde ortaya çıkar.">Das vollständige Ergebnis zeigt sich erst nach 12 bis 18 Monaten, nicht sofort.</p></div>
  </div>
  </div>
</section>

<section class="hp-section" id="genesung">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gCal2" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gCal2)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="15" y="18" width="34" height="28" rx="5" fill="none" stroke="#fff" stroke-width="2.6"/><line x1="15" y1="27" x2="49" y2="27" stroke="#fff" stroke-width="2.6"/><line x1="24" y1="13" x2="24" y2="22" stroke="#fff" stroke-width="2.6" stroke-linecap="round"/><line x1="40" y1="13" x2="40" y2="22" stroke="#fff" stroke-width="2.6" stroke-linecap="round"/><circle cx="24" cy="36" r="2" fill="#fff"/><circle cx="32" cy="36" r="2" fill="#fff"/><circle cx="40" cy="36" r="2" fill="#fff"/></svg>
    <div>
      <h2 data-ckey="genesung.heading" data-de="Genesung &amp; Nachsorge" data-en="Recovery &amp; aftercare">Genesung &amp; Nachsorge</h2>
      <p data-ckey="genesung.body" data-de="Die Erholungsphase ist genauso wichtig wie der Eingriff selbst. Sie bestimmt Graft-Überleben, Heilungsqualität und Endergebnis." data-en="The recovery period matters as much as the procedure itself. It determines graft survival, healing quality, and the final result.">Die Erholungsphase ist genauso wichtig wie der Eingriff selbst. Sie bestimmt Graft-Überleben, Heilungsqualität und Endergebnis.</p>
    </div>
  </div>
  <div class="hp-media" data-cmedia-wrap>
    <img class="hp-media-img" data-cmedia="genesung.image" alt="">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
    <b data-de="Bildplatzhalter: Foto-Zeitstrahl" data-en="Image placeholder: photo timeline" data-fr="Espace image : chronologie photo" data-nl="Afbeeldingsplaceholder: fototijdlijn" data-it="Segnaposto immagine: cronologia fotografica" data-tr="Görsel Yer Tutucu: Fotoğraf Zaman Çizelgesi">Bildplatzhalter: Foto-Zeitstrahl</b>
    <span data-de="Patientenfotos von Tag 1 bis Monat 18, mit Einwilligung, den Heilungsverlauf zeigend" data-en="Patient photos from day 1 to month 18, with consent, showing the healing progression" data-fr="Photos de patients du jour 1 au mois 18, avec consentement, montrant la progression de la guérison" data-nl="Patiëntfoto's van dag 1 tot maand 18, met toestemming, die het genezingsproces tonen" data-it="Foto dei pazienti dal giorno 1 al mese 18, con consenso, che mostrano la progressione della guarigione" data-tr="1. günden 18. aya kadar, onay alınarak çekilmiş, iyileşme sürecini gösteren hasta fotoğrafları">Patientenfotos von Tag 1 bis Monat 18, mit Einwilligung, den Heilungsverlauf zeigend</span>
  </div>

  <div class="hp-timeline" style="margin-bottom:44px">
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Tag 1 bis 7" data-en="Day 1 to 7" data-fr="Jour 1 à 7" data-nl="Dag 1 tot 7" data-it="Giorno 1-7" data-tr="1. ile 7. Gün">Tag 1 bis 7</div><h4 data-de="Erste Heilung" data-en="Initial healing" data-fr="Cicatrisation initiale" data-nl="Eerste genezing" data-it="Guarigione iniziale" data-tr="İlk İyileşme">Erste Heilung</h4><p data-de="Kleine Krusten bilden sich, Rötung und leichte Schwellung um Stirn und Augen sind normal. Kopf erhöht schlafen, Kopfhaut nicht berühren." data-en="Small scabs form, redness and mild swelling around the forehead and eyes is common. Sleep with the head elevated, avoid touching the scalp." data-fr="De petites croûtes se forment, des rougeurs et un léger gonflement autour du front et des yeux sont normaux. Dormir la tête surélevée, éviter de toucher le cuir chevelu." data-nl="Kleine korstjes vormen zich, roodheid en lichte zwelling rond voorhoofd en ogen zijn normaal. Slaap met het hoofd omhoog, raak de hoofdhuid niet aan." data-it="Si formano piccole croste, arrossamento e lieve gonfiore intorno alla fronte e agli occhi sono normali. Dormire con la testa sollevata, evitare di toccare il cuoio capelluto." data-tr="Küçük kabuklar oluşur, alın ve göz çevresinde kızarıklık ve hafif şişlik normaldir. Baş yükseltilmiş şekilde uyuyun, saç derisine dokunmaktan kaçının.">Kleine Krusten bilden sich, Rötung und leichte Schwellung um Stirn und Augen sind normal. Kopf erhöht schlafen, Kopfhaut nicht berühren.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Woche 2 bis 4" data-en="Weeks 2 to 4" data-fr="Semaines 2 à 4" data-nl="Week 2 tot 4" data-it="Settimane 2-4" data-tr="2. ile 4. Hafta">Woche 2 bis 4</div><h4 data-de="Schock-Verlust" data-en="Shock loss" data-fr="Chute de choc" data-nl="Shockverlies" data-it="Shock loss" data-tr="Şok Dökülmesi">Schock-Verlust</h4><p data-de="Bis zu 90% der transplantierten Haarschäfte fallen aus. Das ist völlig normal, die Follikel selbst bleiben unter der Kopfhaut aktiv." data-en="Up to 90% of transplanted hair shafts shed. This is completely normal; the follicles themselves remain alive beneath the scalp." data-fr="Jusqu'à 90% des tiges capillaires transplantées tombent. C'est tout à fait normal, les follicules eux-mêmes restent actifs sous le cuir chevelu." data-nl="Tot 90% van de getransplanteerde haarschachten valt uit. Dit is volkomen normaal; de follikels zelf blijven actief onder de hoofdhuid." data-it="Fino al 90% dei fusti di capelli trapiantati cade. È del tutto normale; i follicoli stessi rimangono vivi sotto il cuoio capelluto." data-tr="Nakledilen saç tellerinin %90'a kadarı dökülür. Bu tamamen normaldir; foliküllerin kendisi saç derisi altında aktif kalır.">Bis zu 90% der transplantierten Haarschäfte fallen aus. Das ist völlig normal, die Follikel selbst bleiben unter der Kopfhaut aktiv.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 2 bis 3" data-en="Months 2 to 3" data-fr="Mois 2 à 3" data-nl="Maand 2 tot 3" data-it="Mese 2-3" data-tr="2. ile 3. Ay">Monat 2 bis 3</div><h4 data-de="Die ruhige Phase" data-en="The quiet phase" data-fr="La phase calme" data-nl="De rustige fase" data-it="La fase silente" data-tr="Sessiz Evre">Die ruhige Phase</h4><p data-de="Kaum sichtbares Wachstum, die Follikel ruhen. Erste feine Haare können ab Woche 10 bis 12 erscheinen." data-en="Little visible growth, follicles are resting. First fine hairs may emerge around week 10 to 12." data-fr="Peu de croissance visible, les follicules se reposent. Les premiers cheveux fins peuvent apparaître entre les semaines 10 et 12." data-nl="Weinig zichtbare groei, de follikels rusten. De eerste fijne haartjes kunnen rond week 10 tot 12 verschijnen." data-it="Poca crescita visibile, i follicoli riposano. I primi capelli sottili possono comparire intorno alla settimana 10-12." data-tr="Görünür büyüme azdır, foliküller dinlenir. İlk ince saçlar 10-12. haftalarda belirebilir.">Kaum sichtbares Wachstum, die Follikel ruhen. Erste feine Haare können ab Woche 10 bis 12 erscheinen.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 3 bis 6" data-en="Months 3 to 6" data-fr="Mois 3 à 6" data-nl="Maand 3 tot 6" data-it="Mese 3-6" data-tr="3. ile 6. Ay">Monat 3 bis 6</div><h4 data-de="Sichtbares Wachstum beginnt" data-en="Visible growth begins" data-fr="La croissance visible commence" data-nl="Zichtbare groei begint" data-it="Inizia la crescita visibile" data-tr="Görünür Büyüme Başlar">Sichtbares Wachstum beginnt</h4><p data-de="Feine neue Haare erscheinen und verdicken sich allmählich. Bis Monat 6 sind rund 40 bis 60% des Endergebnisses sichtbar." data-en="Fine new hairs emerge and gradually thicken. By month 6, around 40 to 60% of the final result is visible." data-fr="De fins nouveaux cheveux apparaissent et s'épaississent progressivement. Au mois 6, environ 40 à 60% du résultat final sont visibles." data-nl="Fijne nieuwe haren verschijnen en worden geleidelijk dikker. Tegen maand 6 is ongeveer 40 tot 60% van het eindresultaat zichtbaar." data-it="Compaiono nuovi capelli sottili che si ispessiscono gradualmente. Entro il mese 6, è visibile circa il 40-60% del risultato finale." data-tr="İnce yeni saçlar belirir ve giderek kalınlaşır. 6. aya kadar nihai sonucun yaklaşık %40 ila %60'ı görünür hale gelir.">Feine neue Haare erscheinen und verdicken sich allmählich. Bis Monat 6 sind rund 40 bis 60% des Endergebnisses sichtbar.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 6 bis 9" data-en="Months 6 to 9" data-fr="Mois 6 à 9" data-nl="Maand 6 tot 9" data-it="Mese 6-9" data-tr="6. ile 9. Ay">Monat 6 bis 9</div><h4 data-de="Die Dichte verbessert sich" data-en="Density improves" data-fr="La densité s'améliore" data-nl="De dichtheid verbetert" data-it="La densità migliora" data-tr="Yoğunluk Artıyor">Die Dichte verbessert sich</h4><p data-de="Das Haar wird spürbar dicker und dunkler. Rund 80% der Grafts sind zu diesem Zeitpunkt durchgebrochen." data-en="Hair becomes noticeably thicker and darker. Around 80% of grafts have broken through by this point." data-fr="Les cheveux deviennent nettement plus épais et plus foncés. Environ 80% des greffons ont percé à ce stade." data-nl="Het haar wordt merkbaar dikker en donkerder. Op dit punt is ongeveer 80% van de grafts doorgebroken." data-it="I capelli diventano notevolmente più spessi e scuri. A questo punto circa l'80% degli innesti è emerso." data-tr="Saçlar belirgin şekilde kalınlaşır ve koyulaşır. Bu noktada greftlerin yaklaşık %80'i çıkmış olur.">Das Haar wird spürbar dicker und dunkler. Rund 80% der Grafts sind zu diesem Zeitpunkt durchgebrochen.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 12 bis 18" data-en="Months 12 to 18" data-fr="Mois 12 à 18" data-nl="Maand 12 tot 18" data-it="Mese 12-18" data-tr="12. ile 18. Ay">Monat 12 bis 18</div><h4 data-de="Endgültige Verfeinerung" data-en="Final refinement" data-fr="Affinement final" data-nl="Definitieve verfijning" data-it="Rifinitura finale" data-tr="Son Rötuşlar">Endgültige Verfeinerung</h4><p data-de="Die letzten Haare reifen und verdicken sich. Das transplantierte Haar verschmilzt vollständig mit dem natürlichen Haar." data-en="The last hairs mature and thicken. Transplanted hair fully blends with native hair." data-fr="Les derniers cheveux mûrissent et s'épaississent. Les cheveux transplantés se fondent complètement avec les cheveux naturels." data-nl="De laatste haren rijpen en worden dikker. Getransplanteerd haar vermengt zich volledig met natuurlijk haar." data-it="Gli ultimi capelli maturano e si ispessiscono. I capelli trapiantati si fondono completamente con quelli naturali." data-tr="Son saçlar olgunlaşır ve kalınlaşır. Nakledilen saç, doğal saçla tamamen kaynaşır.">Die letzten Haare reifen und verdicken sich. Das transplantierte Haar verschmilzt vollständig mit dem natürlichen Haar.</p></div></div>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Die wichtigsten Nachsorgeregeln" data-en="Key aftercare rules" data-fr="Les règles de suivi essentielles" data-nl="De belangrijkste nazorgregels" data-it="Le regole di assistenza post-operatoria più importanti" data-tr="Temel Bakım Kuralları">Die wichtigsten Nachsorgeregeln</h3>
  <div class="hp-rules">
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini8" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini8)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.2" y1="4.2" x2="5.6" y2="5.6"/><line x1="18.4" y1="18.4" x2="19.8" y2="19.8"/></g></svg></span><span data-de="Keine direkte Sonne auf der Kopfhaut für mindestens 4 Wochen." data-en="No direct sun exposure on the scalp for at least 4 weeks." data-fr="Pas d'exposition directe au soleil sur le cuir chevelu pendant au moins 4 semaines." data-nl="Geen directe zonlicht op de hoofdhuid gedurende ten minste 4 weken." data-it="Nessuna esposizione diretta al sole sul cuoio capelluto per almeno 4 settimane." data-tr="En az 4 hafta boyunca saç derisine doğrudan güneş ışığı almayın.">Keine direkte Sonne auf der Kopfhaut für mindestens 4 Wochen.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini9" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini9)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M2 16c2-2 4 2 6 0s4 2 6 0 4 2 6 0M2 20c2-2 4 2 6 0s4 2 6 0 4 2 6 0"/></g></svg></span><span data-de="Kein Schwimmen (Pool, Meer, See) für mindestens 4 Wochen." data-en="No swimming (pool, sea, or lake) for at least 4 weeks." data-fr="Pas de baignade (piscine, mer, lac) pendant au moins 4 semaines." data-nl="Niet zwemmen (zwembad, zee, meer) gedurende ten minste 4 weken." data-it="Niente nuoto (piscina, mare, lago) per almeno 4 settimane." data-tr="En az 4 hafta boyunca yüzmeyin (havuz, deniz, göl).">Kein Schwimmen (Pool, Meer, See) für mindestens 4 Wochen.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini10" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini10)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M13 2 4 14h6l-1 8 9-12h-6z"/></g></svg></span><span data-de="Kein intensiver Sport oder starkes Schwitzen für 2 bis 3 Wochen." data-en="No intense exercise or heavy sweating for 2 to 3 weeks." data-fr="Pas de sport intense ni de transpiration excessive pendant 2 à 3 semaines." data-nl="Geen intensieve sport of overmatig zweten gedurende 2 tot 3 weken." data-it="Nessun esercizio intenso o sudorazione eccessiva per 2-3 settimane." data-tr="2-3 hafta boyunca yoğun spor yapmayın veya aşırı terlemekten kaçının.">Kein intensiver Sport oder starkes Schwitzen für 2 bis 3 Wochen.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini11" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini11)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M8 2v4M16 2v4M5 8h14v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2z"/></g></svg></span><span data-de="Kein Alkohol in der ersten Woche, er beeinträchtigt die Durchblutung." data-en="No alcohol for the first week; it affects blood circulation." data-fr="Pas d'alcool la première semaine, il nuit à la circulation sanguine." data-nl="Geen alcohol in de eerste week, dit beïnvloedt de bloedcirculatie." data-it="Niente alcol nella prima settimana, compromette la circolazione sanguigna." data-tr="İlk hafta alkol almayın; kan dolaşımını olumsuz etkiler.">Kein Alkohol in der ersten Woche, er beeinträchtigt die Durchblutung.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini12" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini12)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M9 12a3 3 0 1 1 6 0c0 2-3 2-3 5"/><line x1="12" y1="20" x2="12" y2="20.01"/></g></svg></span><span data-de="Nicht rauchen: Nikotin verengt die Blutgefäße und senkt die Graft-Überlebensrate." data-en="No smoking: nicotine restricts blood supply and reduces graft survival." data-fr="Ne pas fumer : la nicotine restreint l'apport sanguin et réduit la survie des greffons." data-nl="Niet roken: nicotine beperkt de bloedtoevoer en vermindert de overleving van de grafts." data-it="Non fumare: la nicotina riduce l'afflusso di sangue e diminuisce la sopravvivenza degli innesti." data-tr="Sigara içmeyin: nikotin kan akışını kısıtlar ve greft sağkalımını azaltır.">Nicht rauchen: Nikotin verengt die Blutgefäße und senkt die Graft-Überlebensrate.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini13" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini13)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M3 8h11l4 4v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="9" cy="14" r="2"/></g></svg></span><span data-de="Kopf erhöht schlafen für die ersten 3 bis 5 Nächte." data-en="Sleep with the head elevated for the first 3 to 5 nights." data-fr="Dormir la tête surélevée pendant les 3 à 5 premières nuits." data-nl="Slaap met het hoofd omhoog gedurende de eerste 3 tot 5 nachten." data-it="Dormire con la testa sollevata per le prime 3-5 notti." data-tr="İlk 3-5 gece başınızı yükseltilmiş şekilde uyuyun.">Kopf erhöht schlafen für die ersten 3 bis 5 Nächte.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini14" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini14)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M7 21c-2-3 0-5 0-8 0-4-3-5-3-9 4 0 7 2 7 6M17 21c2-3 0-5 0-8 0-4 3-5 3-9-4 0-7 2-7 6"/></g></svg></span><span data-de="Sanft waschen nach Klinikanleitung, keinen starken Wasserstrahl direkt auf die Grafts." data-en="Wash gently per the clinic's instructions; no strong water pressure directly on the grafts." data-fr="Laver délicatement selon les instructions de la clinique, pas de jet d'eau puissant directement sur les greffons." data-nl="Was voorzichtig volgens de instructies van de kliniek, geen sterke waterdruk direct op de grafts." data-it="Lavare delicatamente secondo le istruzioni della clinica, senza getto d'acqua forte direttamente sugli innesti." data-tr="Klinik talimatlarına göre nazikçe yıkayın, greftlerin üzerine doğrudan güçlü su akışı uygulamayın.">Sanft waschen nach Klinikanleitung, keinen starken Wasserstrahl direkt auf die Grafts.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini15" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini15)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><line x1="20" y1="4" x2="8.12" y2="15.88"/><line x1="14.47" y1="14.48" x2="20" y2="20"/><line x1="8.12" y1="8.12" x2="12" y2="12"/></g></svg></span><span data-de="Haare im ersten Monat nicht aggressiv schneiden, färben oder stylen." data-en="Don't cut, colour, or style hair aggressively in the first month." data-fr="Ne pas couper, colorer ou coiffer les cheveux de manière agressive le premier mois." data-nl="Knip, kleur of stijl het haar de eerste maand niet agressief." data-it="Non tagliare, colorare o acconciare i capelli in modo aggressivo nel primo mese." data-tr="İlk ay saçınızı agresif şekilde kesmeyin, boyamayın veya şekillendirmeyin.">Haare im ersten Monat nicht aggressiv schneiden, färben oder stylen.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini16" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini16)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2"/><line x1="9" y1="9" x2="15" y2="9"/><line x1="9" y1="13" x2="15" y2="13"/></g></svg></span><span data-de="Verschriebene Medikamente wie Finasterid oder Minoxidil wie angeordnet fortsetzen." data-en="Continue prescribed medications like finasteride or minoxidil as directed." data-fr="Continuer les médicaments prescrits comme le finastéride ou le minoxidil selon les indications." data-nl="Ga door met voorgeschreven medicatie zoals finasteride of minoxidil zoals aangegeven." data-it="Continuare i farmaci prescritti come finasteride o minoxidil come indicato." data-tr="Finasterid veya minoksidil gibi reçetelenen ilaçları belirtilen şekilde kullanmaya devam edin.">Verschriebene Medikamente wie Finasterid oder Minoxidil wie angeordnet fortsetzen.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini17" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini17)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .3 2 .6 3a2 2 0 0 1-.5 2L7.9 10a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2-.5c1 .3 2 .5 3 .6a2 2 0 0 1 1.8 2z"/></g></svg></span><span data-de="Alle Folgetermine wahrnehmen, manche Kliniken bieten Remote-Check-ins an." data-en="Attend all follow-up appointments; some clinics offer remote check-ins." data-fr="Assister à tous les rendez-vous de suivi ; certaines cliniques proposent des suivis à distance." data-nl="Woon alle vervolgafspraken bij; sommige klinieken bieden externe check-ins aan." data-it="Partecipare a tutti gli appuntamenti di follow-up; alcune cliniche offrono check-in a distanza." data-tr="Tüm takip randevularına katılın; bazı klinikler uzaktan kontrol imkanı sunar.">Alle Folgetermine wahrnehmen, manche Kliniken bieten Remote-Check-ins an.</span></div>
  </div>
</section>

<section class="hp-section" id="vorher-nachher">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gCompare" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gCompare)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="27" cy="32" r="13" fill="#fff" opacity="0.5"/><circle cx="39" cy="32" r="13" fill="#fff" opacity="0.85"/></svg>
    <div>
      <h2 data-ckey="vorherNachher.heading" data-de="Vorher-Nachher: was pro Monat zu erwarten ist" data-en="Before &amp; after: what to expect each month">Vorher-Nachher: was pro Monat zu erwarten ist</h2>
      <p data-ckey="vorherNachher.body" data-de="Ein visueller und beschreibender Monat-für-Monat-Überblick. Echte Patientenfotos von Apex Beauty folgen hier, sobald sie freigegeben sind." data-en="A visual and descriptive month-by-month reference. Real Apex Beauty patient photos will appear here once cleared for use.">Ein visueller und beschreibender Monat-für-Monat-Überblick. Echte Patientenfotos von Apex Beauty folgen hier, sobald sie freigegeben sind.</p>
    </div>
  </div>
  <div class="hp-media" data-cmedia-wrap>
    <img class="hp-media-img" data-cmedia="vorherNachher.image" alt="">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
    <b data-de="Bildplatzhalter: Vorher-Nachher-Galerie" data-en="Image placeholder: before/after gallery" data-fr="Espace image : galerie avant/après" data-nl="Afbeeldingsplaceholder: voor-en-na-galerij" data-it="Segnaposto immagine: galleria prima/dopo" data-tr="Görsel Yer Tutucu: Öncesi/Sonrası Galerisi">Bildplatzhalter: Vorher-Nachher-Galerie</b>
    <span data-de="Echte Apex-Patientenfotos im Split-Vergleich, mit schriftlicher Einwilligung" data-en="Real Apex patient photos in a split comparison view, with written consent" data-fr="Vraies photos de patients Apex en comparaison divisée, avec consentement écrit" data-nl="Echte foto's van Apex-patiënten in gesplitste vergelijking, met schriftelijke toestemming" data-it="Foto reali di pazienti Apex in confronto affiancato, con consenso scritto" data-tr="Yazılı onay alınmış, ikiye bölünmüş karşılaştırma görünümünde gerçek Apex hasta fotoğrafları">Echte Apex-Patientenfotos im Split-Vergleich, mit schriftlicher Einwilligung</span>
  </div>
  <div class="hp-timeline">
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Tag 1 bis 7" data-en="Day 1 to 7" data-fr="Jour 1 à 7" data-nl="Dag 1 tot 7" data-it="Giorno 1-7" data-tr="1. ile 7. Gün">Tag 1 bis 7</div><h4 data-de="Grafts setzen sich, Blutversorgung baut sich wieder auf" data-en="Grafts settling, blood supply re-establishing">Grafts setzen sich, Blutversorgung baut sich wieder auf</h4><p class="hp-tl-see" data-de="Sichtbar: Rötung, kleine Krusten, leichte Schwellung" data-en="What you see: redness, small scabs, mild swelling">Sichtbar: Rötung, kleine Krusten, leichte Schwellung</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Woche 2 bis 4" data-en="Weeks 2 to 4" data-fr="Semaines 2 à 4" data-nl="Week 2 tot 4" data-it="Settimane 2-4" data-tr="2. ile 4. Hafta">Woche 2 bis 4</div><h4 data-de="Follikel treten in die Telogen-Phase ein, Schock-Verlust" data-en="Follicles enter telogen, shock loss occurs">Follikel treten in die Telogen-Phase ein, Schock-Verlust</h4><p class="hp-tl-see" data-de="Sichtbar: transplantiertes Haar fällt aus, das ist normal" data-en="What you see: transplanted hair sheds, this is normal">Sichtbar: transplantiertes Haar fällt aus, das ist normal</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 2 bis 3" data-en="Month 2 to 3" data-fr="Mois 2 à 3" data-nl="Maand 2 tot 3" data-it="Mese 2-3" data-tr="2. ile 3. Ay">Monat 2 bis 3</div><h4 data-de="Follikel in Ruhephase, neuer Zyklus bereitet sich vor" data-en="Follicles resting, new cycle preparing" data-fr="Follicules au repos, nouveau cycle en préparation" data-nl="Follikels in rust, nieuwe cyclus bereidt zich voor" data-it="Follicoli a riposo, nuovo ciclo in preparazione" data-tr="Foliküller dinleniyor, yeni döngü hazırlanıyor">Follikel in Ruhephase, neuer Zyklus bereitet sich vor</h4><p class="hp-tl-see" data-de="Sichtbar: kaum Veränderung, Kopfhaut wirkt ruhig" data-en="What you see: little visible change, scalp appears calm" data-fr="Ce que vous voyez : peu de changement visible, le cuir chevelu semble calme" data-nl="Wat u ziet: weinig zichtbare verandering, hoofdhuid oogt rustig" data-it="Cosa vedi: poco cambiamento visibile, il cuoio capelluto appare calmo" data-tr="Gördükleriniz: çok az görünür değişiklik, saç derisi sakin görünüyor">Sichtbar: kaum Veränderung, Kopfhaut wirkt ruhig</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 3 bis 5" data-en="Month 3 to 5" data-fr="Mois 3 à 5" data-nl="Maand 3 tot 5" data-it="Mese 3-5" data-tr="3. ile 5. Ay">Monat 3 bis 5</div><h4 data-de="Neue Anagen-Phase beginnt, erste Haare erscheinen" data-en="New anagen phase begins, first hairs emerge" data-fr="Une nouvelle phase anagène commence, les premiers cheveux apparaissent" data-nl="Nieuwe anagene fase begint, eerste haren verschijnen" data-it="Inizia una nuova fase anagen, compaiono i primi capelli" data-tr="Yeni anagen evre başlar, ilk saçlar belirir">Neue Anagen-Phase beginnt, erste Haare erscheinen</h4><p class="hp-tl-see" data-de="Sichtbar: feine, helle Haare, rund 20% Fortschritt" data-en="What you see: fine, light hairs, around 20% progress" data-fr="Ce que vous voyez : cheveux fins et clairs, environ 20% de progression" data-nl="Wat u ziet: fijne, lichte haartjes, ongeveer 20% voortgang" data-it="Cosa vedi: capelli sottili e chiari, circa il 20% di progresso" data-tr="Gördükleriniz: ince, açık renkli saçlar, yaklaşık %20 ilerleme">Sichtbar: feine, helle Haare, rund 20% Fortschritt</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 5 bis 7" data-en="Month 5 to 7" data-fr="Mois 5 à 7" data-nl="Maand 5 tot 7" data-it="Mese 5-7" data-tr="5. ile 7. Ay">Monat 5 bis 7</div><h4 data-de="Haarschaft verdickt sich, wird dunkler und länger" data-en="Hair shaft thickens, darkens, lengthens" data-fr="La tige capillaire s'épaissit, fonce et s'allonge" data-nl="Haarschacht wordt dikker, donkerder en langer" data-it="Il fusto del capello si ispessisce, scurisce e si allunga" data-tr="Saç teli kalınlaşır, koyulaşır ve uzar">Haarschaft verdickt sich, wird dunkler und länger</h4><p class="hp-tl-see" data-de="Sichtbar: rund 50% der Enddichte" data-en="What you see: around 50% of final density" data-fr="Ce que vous voyez : environ 50% de la densité finale" data-nl="Wat u ziet: ongeveer 50% van de einddichtheid" data-it="Cosa vedi: circa il 50% della densità finale" data-tr="Gördükleriniz: nihai yoğunluğun yaklaşık %50'si">Sichtbar: rund 50% der Enddichte</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 7 bis 9" data-en="Month 7 to 9" data-fr="Mois 7 à 9" data-nl="Maand 7 tot 9" data-it="Mese 7-9" data-tr="7. ile 9. Ay">Monat 7 bis 9</div><h4 data-de="Dichte, Deckung und Textur verbessern sich weiter" data-en="Density, coverage, and texture keep improving" data-fr="La densité, la couverture et la texture continuent de s'améliorer" data-nl="Dichtheid, dekking en textuur blijven verbeteren" data-it="Densità, copertura e texture continuano a migliorare" data-tr="Yoğunluk, kapsama ve doku iyileşmeye devam eder">Dichte, Deckung und Textur verbessern sich weiter</h4><p class="hp-tl-see" data-de="Sichtbar: rund 70 bis 80% des Endergebnisses" data-en="What you see: around 70 to 80% of the final result" data-fr="Ce que vous voyez : environ 70 à 80% du résultat final" data-nl="Wat u ziet: ongeveer 70 tot 80% van het eindresultaat" data-it="Cosa vedi: circa il 70-80% del risultato finale" data-tr="Gördükleriniz: nihai sonucun yaklaşık %70 ila %80'i">Sichtbar: rund 70 bis 80% des Endergebnisses</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 10 bis 12" data-en="Month 10 to 12" data-fr="Mois 10 à 12" data-nl="Maand 10 tot 12" data-it="Mese 10-12" data-tr="10. ile 12. Ay">Monat 10 bis 12</div><h4 data-de="Die meisten Grafts sind ausgereift, Endergebnis formt sich" data-en="Most grafts mature, final result forming" data-fr="La plupart des greffons sont matures, le résultat final se dessine" data-nl="De meeste grafts zijn volgroeid, eindresultaat vormt zich" data-it="La maggior parte degli innesti è matura, il risultato finale prende forma" data-tr="Greftlerin çoğu olgunlaşmıştır, nihai sonuç şekilleniyor">Die meisten Grafts sind ausgereift, Endergebnis formt sich</h4><p class="hp-tl-see" data-de="Sichtbar: nahezu finales Erscheinungsbild, natürliche Verschmelzung" data-en="What you see: near-final appearance, natural blending" data-fr="Ce que vous voyez : apparence quasi finale, fusion naturelle" data-nl="Wat u ziet: bijna definitief uiterlijk, natuurlijke vermenging" data-it="Cosa vedi: aspetto quasi definitivo, fusione naturale" data-tr="Gördükleriniz: neredeyse nihai görünüm, doğal kaynaşma">Sichtbar: nahezu finales Erscheinungsbild, natürliche Verschmelzung</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 12 bis 18" data-en="Month 12 to 18" data-fr="Mois 12 à 18" data-nl="Maand 12 tot 18" data-it="Mese 12-18" data-tr="12. ile 18. Ay">Monat 12 bis 18</div><h4 data-de="Letzte Haare reifen, volle Integration mit dem natürlichen Haar" data-en="Last hairs mature, full integration with native hair" data-fr="Les derniers cheveux mûrissent, intégration complète avec les cheveux naturels" data-nl="Laatste haren rijpen, volledige integratie met natuurlijk haar" data-it="Gli ultimi capelli maturano, integrazione completa con i capelli naturali" data-tr="Son saçlar olgunlaşır, doğal saçla tam entegrasyon">Letzte Haare reifen, volle Integration mit dem natürlichen Haar</h4><p class="hp-tl-see" data-de="Sichtbar: Endergebnis, natürlich und nicht mehr zu unterscheiden" data-en="What you see: final result, natural and indistinguishable" data-fr="Ce que vous voyez : résultat final, naturel et indiscernable" data-nl="Wat u ziet: eindresultaat, natuurlijk en niet meer te onderscheiden" data-it="Cosa vedi: risultato finale, naturale e indistinguibile" data-tr="Gördükleriniz: doğal ve ayırt edilemeyen nihai sonuç">Sichtbar: Endergebnis, natürlich und nicht mehr zu unterscheiden</p></div></div>
  </div>
</section>

<section class="hp-section alt" id="glossar">
  <div class="hp-section-in">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gBook" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gBook)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M32 22c-6-4-13-5-18-3v22c5-2 12-1 18 3 6-4 13-5 18-3V19c-5-2-12-1-18 3z" fill="#fff" opacity="0.95"/><line x1="32" y1="22" x2="32" y2="44" stroke="#1d4ed8" stroke-width="1.5" opacity="0.4"/></svg>
    <div>
      <h2 data-ckey="glossar.heading" data-de="Medizinisches Glossar" data-en="Medical glossary">Medizinisches Glossar</h2>
      <p data-ckey="glossar.body" data-de="Alle Fachbegriffe der Hairpedia einfach erklärt." data-en="All the technical terms used throughout Hairpedia, explained simply.">Alle Fachbegriffe der Hairpedia einfach erklärt.</p>
    </div>
  </div>
  <div class="hp-glossary">
    <div class="hp-term"><b data-de="Alopezie" data-en="Alopecia" data-fr="Alopécie" data-nl="Alopecia" data-it="Alopecia" data-tr="Alopesi">Alopezie</b><span data-de="Der medizinische Begriff für Haarausfall, unabhängig von der Ursache." data-en="The medical term for hair loss, from any cause." data-fr="Le terme médical désignant la chute de cheveux, quelle qu'en soit la cause." data-nl="De medische term voor haaruitval, ongeacht de oorzaak." data-it="Il termine medico per la caduta dei capelli, indipendentemente dalla causa." data-tr="Nedeni ne olursa olsun saç dökülmesi için kullanılan tıbbi terim.">Der medizinische Begriff für Haarausfall, unabhängig von der Ursache.</span></div>
    <div class="hp-term"><b data-de="Anagen" data-en="Anagen" data-fr="Anagène" data-nl="Anageen" data-it="Anagen" data-tr="Anagen">Anagen</b><span data-de="Die aktive Wachstumsphase des Haarzyklus, dauert 2 bis 7 Jahre." data-en="The active growth phase of the hair cycle, lasting 2 to 7 years.">Die aktive Wachstumsphase des Haarzyklus, dauert 2 bis 7 Jahre.</span></div>
    <div class="hp-term"><b data-de="Androgenetische Alopezie" data-en="Androgenetic alopecia" data-fr="Alopécie androgénétique" data-nl="Androgenetische alopecia" data-it="Alopecia androgenetica" data-tr="Androgenetik Alopesi">Androgenetische Alopezie</b><span data-de="Erblich bedingter, durch DHT beeinflusster Haarausfall. Die häufigste Form bei Männern und Frauen." data-en="Genetically inherited pattern hair loss influenced by DHT. The most common form in both men and women.">Erblich bedingter, durch DHT beeinflusster Haarausfall. Die häufigste Form bei Männern und Frauen.</span></div>
    <div class="hp-term"><b data-de="Katagen" data-en="Catagen" data-fr="Catagène" data-nl="Catageen" data-it="Catagen" data-tr="Katagen">Katagen</b><span data-de="Die kurze Übergangsphase, rund 2 bis 3 Wochen, in der der Follikel schrumpft und das Wachstum stoppt." data-en="The short transitional phase, lasting about 2 to 3 weeks, during which the follicle shrinks and growth stops.">Die kurze Übergangsphase, rund 2 bis 3 Wochen, in der der Follikel schrumpft und das Wachstum stoppt.</span></div>
    <div class="hp-term"><b data-de="DHI" data-en="DHI" data-fr="DHI" data-nl="DHI" data-it="DHI" data-tr="DHI">DHI</b><span data-de="Direkte Haarimplantation. Technik mit einem Choi Implanter Pen, der Follikel in einem Schritt entnimmt und implantiert." data-en="Direct Hair Implantation. A technique using a Choi Implanter Pen to extract and implant follicles in a single step.">Direkte Haarimplantation. Technik mit einem Choi Implanter Pen, der Follikel in einem Schritt entnimmt und implantiert.</span></div>
    <div class="hp-term"><b data-de="DHT (Dihydrotestosteron)" data-en="DHT (Dihydrotestosterone)" data-fr="DHT (Dihydrotestostérone)" data-nl="DHT (Dihydrotestosteron)" data-it="DHT (Diidrotestosterone)" data-tr="DHT (Dihidrotestosteron)">DHT (Dihydrotestosteron)</b><span data-de="Ein starkes Hormon aus Testosteron, der Haupttreiber der androgenetischen Alopezie bei genetisch empfindlichen Personen." data-en="A potent hormone derived from testosterone, the primary driver of androgenetic alopecia in genetically sensitive individuals.">Ein starkes Hormon aus Testosteron, der Haupttreiber der androgenetischen Alopezie bei genetisch empfindlichen Personen.</span></div>
    <div class="hp-term"><b data-de="Spenderbereich" data-en="Donor area" data-fr="Zone donneuse" data-nl="Donorgebied" data-it="Area donatrice" data-tr="Donör Bölge">Spenderbereich</b><span data-de="Der Bereich der Kopfhaut, meist Hinterkopf und Seiten, aus dem DHT-resistente Follikel entnommen werden." data-en="The part of the scalp, typically the back and sides, from which DHT-resistant follicles are harvested." data-fr="La zone du cuir chevelu, généralement l'arrière et les côtés, d'où sont prélevés les follicules résistants à la DHT." data-nl="Het deel van de hoofdhuid, meestal achterhoofd en zijkanten, waaruit DHT-resistente follikels worden geoogst." data-it="La zona del cuoio capelluto, generalmente la parte posteriore e laterale, da cui vengono prelevati i follicoli resistenti al DHT." data-tr="Genellikle arka ve yan bölgeler olmak üzere, DHT'ye dirençli foliküllerin alındığı saç derisi bölgesi.">Der Bereich der Kopfhaut, meist Hinterkopf und Seiten, aus dem DHT-resistente Follikel entnommen werden.</span></div>
    <div class="hp-term"><b data-de="Exosomen" data-en="Exosomes" data-fr="Exosomes" data-nl="Exosomen" data-it="Esosomi" data-tr="Ekzozomlar">Exosomen</b><span data-de="Winzige, aus Stammzellen gewonnene Vesikel mit Wachstumssignalen, experimentell zur Follikelregeneration eingesetzt." data-en="Tiny stem cell-derived vesicles containing growth signals, used experimentally to stimulate follicle regeneration.">Winzige, aus Stammzellen gewonnene Vesikel mit Wachstumssignalen, experimentell zur Follikelregeneration eingesetzt.</span></div>
    <div class="hp-term"><b data-de="5-Alpha-Reduktase" data-en="5-alpha reductase" data-fr="5-alpha réductase" data-nl="5-alfa-reductase" data-it="5-alfa reduttasi" data-tr="5-Alfa Redüktaz">5-Alpha-Reduktase</b><span data-de="Das Enzym, das Testosteron in DHT umwandelt. Wird durch Finasterid und Dutasterid gehemmt." data-en="The enzyme responsible for converting testosterone into DHT. Inhibited by finasteride and dutasteride." data-fr="L'enzyme responsable de la conversion de la testostérone en DHT. Inhibée par le finastéride et le dutastéride." data-nl="Het enzym dat testosteron omzet in DHT. Wordt geremd door finasteride en dutasteride." data-it="L'enzima responsabile della conversione del testosterone in DHT. Inibito da finasteride e dutasteride." data-tr="Testosteronu DHT'ye dönüştüren enzimdir. Finasterid ve dutasterid tarafından inhibe edilir.">Das Enzym, das Testosteron in DHT umwandelt. Wird durch Finasterid und Dutasterid gehemmt.</span></div>
    <div class="hp-term"><b data-de="Finasterid" data-en="Finasteride" data-fr="Finastéride" data-nl="Finasteride" data-it="Finasteride" data-tr="Finasterid">Finasterid</b><span data-de="Orales Medikament, senkt DHT in der Kopfhaut um rund 70%, indem es Typ-II-5-Alpha-Reduktase blockiert." data-en="An oral medication that reduces scalp DHT by around 70% by blocking type II 5-alpha reductase.">Orales Medikament, senkt DHT in der Kopfhaut um rund 70%, indem es Typ-II-5-Alpha-Reduktase blockiert.</span></div>
    <div class="hp-term"><b data-de="Follikuläre Einheit" data-en="Follicular unit" data-fr="Unité folliculaire" data-nl="Folliculaire eenheid" data-it="Unità follicolare" data-tr="Foliküler Ünite">Follikuläre Einheit</b><span data-de="Eine natürliche Gruppierung von 1 bis 4 Haaren. Bei der Transplantation werden ganze Einheiten verpflanzt." data-en="A natural grouping of 1 to 4 hairs. Transplantation moves whole follicular units." data-fr="Un regroupement naturel de 1 à 4 cheveux. La greffe déplace des unités folliculaires entières." data-nl="Een natuurlijke groepering van 1 tot 4 haren. Bij transplantatie worden hele folliculaire eenheden verplaatst." data-it="Un raggruppamento naturale di 1-4 capelli. Il trapianto sposta intere unità follicolari." data-tr="1 ila 4 saç telinin doğal bir gruplanmasıdır. Nakil sırasında tüm foliküler üniteler taşınır.">Eine natürliche Gruppierung von 1 bis 4 Haaren. Bei der Transplantation werden ganze Einheiten verpflanzt.</span></div>
    <div class="hp-term"><b data-de="FUE" data-en="FUE" data-fr="FUE" data-nl="FUE" data-it="FUE" data-tr="FUE">FUE</b><span data-de="Follikuläre Einheiten-Extraktion. Einzelne Follikel werden mit einem Mikro-Punch entnommen, ohne lineare Narbe." data-en="Follicular Unit Extraction. Individual units are extracted one by one with a micro-punch tool, leaving no linear scar.">Follikuläre Einheiten-Extraktion. Einzelne Follikel werden mit einem Mikro-Punch entnommen, ohne lineare Narbe.</span></div>
    <div class="hp-term"><b data-de="FUT" data-en="FUT" data-fr="FUT" data-nl="FUT" data-it="FUT" data-tr="FUT">FUT</b><span data-de="Ältere Streifenmethode: ein Hautstreifen wird entnommen und in Einheiten geteilt. Hinterlässt eine lineare Narbe." data-en="An older strip technique: a strip of scalp is removed and divided into units. Leaves a linear scar." data-fr="Une technique de bandelette plus ancienne : une bande de cuir chevelu est prélevée et divisée en unités. Laisse une cicatrice linéaire." data-nl="Een oudere striptechniek: een strook hoofdhuid wordt verwijderd en verdeeld in eenheden. Laat een lineair litteken achter." data-it="Una tecnica a striscia più datata: una striscia di cuoio capelluto viene rimossa e suddivisa in unità. Lascia una cicatrice lineare." data-tr="Daha eski bir şerit tekniğidir: saç derisinden bir şerit alınır ve ünitelere ayrılır. Doğrusal bir iz bırakır.">Ältere Streifenmethode: ein Hautstreifen wird entnommen und in Einheiten geteilt. Hinterlässt eine lineare Narbe.</span></div>
    <div class="hp-term"><b data-de="Graft" data-en="Graft" data-fr="Greffon" data-nl="Graft" data-it="Innesto" data-tr="Greft">Graft</b><span data-de="Eine bei der Transplantation verwendete follikuläre Einheit, üblicherweise 1 bis 4 Haare." data-en="A follicular unit used in transplantation, typically containing 1 to 4 hairs." data-fr="Une unité folliculaire utilisée lors de la greffe, contenant généralement 1 à 4 cheveux." data-nl="Een folliculaire eenheid die bij transplantatie wordt gebruikt, meestal met 1 tot 4 haren." data-it="Un'unità follicolare utilizzata nel trapianto, che contiene tipicamente 1-4 capelli." data-tr="Nakilde kullanılan, genellikle 1 ila 4 saç teli içeren foliküler ünitedir.">Eine bei der Transplantation verwendete follikuläre Einheit, üblicherweise 1 bis 4 Haare.</span></div>
    <div class="hp-term"><b data-de="Ludwig-Skala" data-en="Ludwig scale" data-fr="Échelle de Ludwig" data-nl="Ludwig-schaal" data-it="Scala di Ludwig" data-tr="Ludwig Skalası">Ludwig-Skala</b><span data-de="Klassifikation für weiblichen Haarausfall, Grad I bis III nach Ausmaß der zentralen Ausdünnung." data-en="A classification system for female pattern hair loss, graded I to III based on central thinning." data-fr="Un système de classification pour la chute de cheveux féminine, gradué de I à III selon l'ampleur de l'amincissement central." data-nl="Een classificatiesysteem voor vrouwelijke haaruitval, gegradeerd van I tot III op basis van de mate van centrale verdunning." data-it="Un sistema di classificazione per la caduta dei capelli femminile, graduato da I a III in base al diradamento centrale." data-tr="Kadın tipi saç dökülmesi için merkezi incelme derecesine göre I ile III arasında derecelendirilen bir sınıflandırma sistemidir.">Klassifikation für weiblichen Haarausfall, Grad I bis III nach Ausmaß der zentralen Ausdünnung.</span></div>
    <div class="hp-term"><b data-de="Mesotherapie" data-en="Mesotherapy" data-fr="Mésothérapie" data-nl="Mesotherapie" data-it="Mesoterapia" data-tr="Mezoterapi">Mesotherapie</b><span data-de="Mikroinjektionen aus Vitaminen, Mineralien und Wachstumsfaktoren zur Unterstützung der Follikelgesundheit." data-en="Micro-injections of vitamins, minerals, and growth factors to support follicle health.">Mikroinjektionen aus Vitaminen, Mineralien und Wachstumsfaktoren zur Unterstützung der Follikelgesundheit.</span></div>
    <div class="hp-term"><b data-de="Miniaturisierung" data-en="Miniaturisation" data-fr="Miniaturisation" data-nl="Miniaturisatie" data-it="Miniaturizzazione" data-tr="Minyatürleşme">Miniaturisierung</b><span data-de="Das fortschreitende Schrumpfen der Follikel durch DHT, bis der Follikel schließlich ruht." data-en="The progressive shrinking of follicles caused by DHT, until the follicle becomes dormant." data-fr="Le rétrécissement progressif des follicules causé par la DHT, jusqu'à ce que le follicule devienne dormant." data-nl="De progressieve verkleining van follikels door DHT, totdat de follikel uiteindelijk inactief wordt." data-it="Il progressivo restringimento dei follicoli causato dal DHT, fino a quando il follicolo diventa dormiente." data-tr="DHT'nin neden olduğu, folikülün sonunda uykuya geçmesine kadar süren kademeli küçülmedir.">Das fortschreitende Schrumpfen der Follikel durch DHT, bis der Follikel schließlich ruht.</span></div>
    <div class="hp-term"><b data-de="Minoxidil" data-en="Minoxidil" data-fr="Minoxidil" data-nl="Minoxidil" data-it="Minoxidil" data-tr="Minoksidil">Minoxidil</b><span data-de="Topisches oder orales Mittel, das die Anagen-Phase verlängert und die Durchblutung verbessert. Blockiert kein DHT." data-en="A topical or oral medication that extends the anagen phase and improves blood flow. Doesn't block DHT.">Topisches oder orales Mittel, das die Anagen-Phase verlängert und die Durchblutung verbessert. Blockiert kein DHT.</span></div>
    <div class="hp-term"><b data-de="Norwood-Hamilton-Skala" data-en="Norwood-Hamilton scale" data-fr="Échelle de Norwood-Hamilton" data-nl="Norwood-Hamilton-schaal" data-it="Scala di Norwood-Hamilton" data-tr="Norwood-Hamilton Skalası">Norwood-Hamilton-Skala</b><span data-de="Klassifikation für männlichen Haarausfall, Grad I bis VII nach Muster und Ausmaß." data-en="A classification system for male pattern baldness, graded I to VII based on pattern and extent." data-fr="Un système de classification pour la calvitie masculine, gradué de I à VII selon le motif et l'étendue." data-nl="Een classificatiesysteem voor mannelijke kaalheid, gegradeerd van I tot VII op basis van patroon en omvang." data-it="Un sistema di classificazione per la calvizie maschile, graduato da I a VII in base al pattern e all'estensione." data-tr="Erkek tipi kellik için desen ve kapsama göre I ile VII arasında derecelendirilen bir sınıflandırma sistemidir.">Klassifikation für männlichen Haarausfall, Grad I bis VII nach Muster und Ausmaß.</span></div>
    <div class="hp-term"><b data-de="PRP" data-en="PRP" data-fr="PRP" data-nl="PRP" data-it="PRP" data-tr="PRP">PRP</b><span data-de="Plättchenreiches Plasma. Eigenes Blut wird zentrifugiert und in die Kopfhaut injiziert, um Follikelaktivität anzuregen." data-en="Platelet-Rich Plasma. The patient's own blood is centrifuged and injected into the scalp to stimulate follicle activity.">Plättchenreiches Plasma. Eigenes Blut wird zentrifugiert und in die Kopfhaut injiziert, um Follikelaktivität anzuregen.</span></div>
    <div class="hp-term"><b data-de="Empfängerbereich" data-en="Recipient area" data-fr="Zone receveuse" data-nl="Ontvangstgebied" data-it="Area ricevente" data-tr="Alıcı Bölge">Empfängerbereich</b><span data-de="Der ausgedünnte oder kahle Bereich der Kopfhaut, in den Grafts transplantiert werden." data-en="The thinning or bald area of the scalp into which grafts are transplanted." data-fr="La zone clairsemée ou chauve du cuir chevelu dans laquelle les greffons sont transplantés." data-nl="Het uitgedunde of kale gebied van de hoofdhuid waarin grafts worden getransplanteerd." data-it="L'area diradata o calva del cuoio capelluto in cui vengono trapiantati gli innesti." data-tr="Greftlerin nakledildiği, seyrelmiş veya kel saç derisi bölgesi.">Der ausgedünnte oder kahle Bereich der Kopfhaut, in den Grafts transplantiert werden.</span></div>
    <div class="hp-term"><b data-de="Saphir-FUE" data-en="Sapphire FUE" data-fr="FUE au saphir" data-nl="Saffier-FUE" data-it="Saphire-FUE" data-tr="Safir FUE">Saphir-FUE</b><span data-de="Fortgeschrittene FUE-Variante mit Saphirklingen für kleinere, präzisere Kanäle und schnellere Heilung." data-en="An advanced version of FUE using sapphire blades for smaller, more precise channels and faster healing.">Fortgeschrittene FUE-Variante mit Saphirklingen für kleinere, präzisere Kanäle und schnellere Heilung.</span></div>
    <div class="hp-term"><b data-de="Schock-Verlust" data-en="Shock loss" data-fr="Chute de choc" data-nl="Shockverlies" data-it="Shock loss" data-tr="Şok Dökülmesi">Schock-Verlust</b><span data-de="Vorübergehender Ausfall des transplantierten Haares 2 bis 4 Wochen nach dem Eingriff. Die Follikel überleben, die Schäfte wachsen nach." data-en="Temporary shedding of transplanted hair 2 to 4 weeks after a transplant. The follicles survive; the shafts regrow.">Vorübergehender Ausfall des transplantierten Haares 2 bis 4 Wochen nach dem Eingriff. Die Follikel überleben, die Schäfte wachsen nach.</span></div>
    <div class="hp-term"><b data-de="Telogen" data-en="Telogen" data-fr="Télogène" data-nl="Telogeen" data-it="Telogen" data-tr="Telogen">Telogen</b><span data-de="Die Ruhephase des Haarzyklus, rund 2 bis 3 Monate. Das Haar bleibt, wächst aber nicht mehr." data-en="The resting phase of the hair cycle, lasting 2 to 3 months. Hair remains in place but doesn't grow.">Die Ruhephase des Haarzyklus, rund 2 bis 3 Monate. Das Haar bleibt, wächst aber nicht mehr.</span></div>
    <div class="hp-term"><b data-de="Telogenes Effluvium" data-en="Telogen effluvium" data-fr="Effluvium télogène" data-nl="Telogeen effluvium" data-it="Effluvio telogen" data-tr="Telogen Effluvium">Telogenes Effluvium</b><span data-de="Vorübergehender diffuser Haarausfall, wenn viele Follikel gleichzeitig in die Telogen-Phase eintreten." data-en="A temporary condition causing diffuse shedding when many follicles simultaneously enter telogen.">Vorübergehender diffuser Haarausfall, wenn viele Follikel gleichzeitig in die Telogen-Phase eintreten.</span></div>
    <div class="hp-term"><b data-de="Trichoskopie" data-en="Trichoscopy" data-fr="Trichoscopie" data-nl="Trichoscopie" data-it="Tricoscopia" data-tr="Trikoskopi">Trichoskopie</b><span data-de="Nicht-invasive Technik mit einem Dermatoskop zur Beurteilung von Follikeldichte, Miniaturisierung und Kopfhautzustand." data-en="A non-invasive technique using a dermatoscope to assess follicle density, miniaturisation, and scalp condition." data-fr="Une technique non invasive utilisant un dermatoscope pour évaluer la densité folliculaire, la miniaturisation et l'état du cuir chevelu." data-nl="Een niet-invasieve techniek met een dermatoscoop om follikeldichtheid, miniaturisatie en hoofdhuidconditie te beoordelen." data-it="Una tecnica non invasiva che utilizza un dermatoscopio per valutare la densità follicolare, la miniaturizzazione e le condizioni del cuoio capelluto." data-tr="Folikül yoğunluğunu, minyatürleşmeyi ve saç derisi durumunu değerlendirmek için dermatoskop kullanan invaziv olmayan bir tekniktir.">Nicht-invasive Technik mit einem Dermatoskop zur Beurteilung von Follikeldichte, Miniaturisierung und Kopfhautzustand.</span></div>
    <div class="hp-term"><b data-de="Vertex / Oberkopf" data-en="Vertex / Crown" data-fr="Vertex / Sommet" data-nl="Vertex / Kruin" data-it="Vertice / Sommità" data-tr="Vertex / Tepe">Vertex / Oberkopf</b><span data-de="Der obere Hinterkopfbereich, oft einer der zuletzt betroffenen Bereiche bei männlichem Haarausfall." data-en="The top-rear area of the scalp, often one of the later areas affected in male pattern baldness." data-fr="La zone supérieure-arrière du cuir chevelu, souvent l'une des dernières zones touchées par la calvitie masculine." data-nl="Het bovenste achterste gebied van de hoofdhuid, vaak een van de laatste gebieden die worden aangetast bij mannelijke kaalheid." data-it="L'area superiore-posteriore del cuoio capelluto, spesso una delle ultime aree colpite dalla calvizie maschile." data-tr="Saç derisinin üst-arka bölgesi, erkek tipi kellikte genellikle en son etkilenen alanlardan biridir.">Der obere Hinterkopfbereich, oft einer der zuletzt betroffenen Bereiche bei männlichem Haarausfall.</span></div>
  </div>
  </div>
</section>

<section style="padding: 40px 48px 60px; text-align:center; max-width:1180px; margin:0 auto;">
  <a href="#" class="cta-btn" onclick="openConsult(event)" style="padding:16px 34px; font-size:15.5px; display:inline-flex;" data-de="Kostenlose Beratung sichern" data-en="Get your free consultation" data-fr="Obtenez votre consultation gratuite" data-nl="Vraag uw gratis consult aan" data-it="Richiedi il tuo consulto gratuito" data-tr="Ücretsiz Danışmanızı Alın">Kostenlose Beratung sichern</a>
</section>

<?php include __DIR__ . '/includes/site-footer.php'; ?>

<a class="whatsapp-fab" href="<?= htmlspecialchars(APEX_WHATSAPP_LINK, ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp" onclick="trackWhatsAppContact()">
  <svg viewBox="0 0 32 32" fill="#fff" aria-hidden="true"><path d="M16.004 3C9.373 3 4 8.373 4 15.004c0 2.386.7 4.61 1.902 6.478L4 29l7.72-1.865a11.94 11.94 0 0 0 4.284.788h.001C22.635 27.923 28 22.55 28 15.918 28 9.287 22.635 3 16.004 3zm0 21.9h-.001a9.9 9.9 0 0 1-5.05-1.383l-.362-.215-4.583 1.107 1.128-4.47-.236-.376a9.86 9.86 0 0 1-1.516-5.263c0-5.468 4.45-9.917 9.923-9.917 2.65 0 5.14 1.033 7.014 2.909a9.85 9.85 0 0 1 2.905 7.019c0 5.468-4.45 9.589-9.222 9.589z"/><path d="M21.62 18.164c-.297-.148-1.758-.868-2.03-.967-.273-.099-.471-.148-.669.149-.198.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.149-1.254-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.058-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.148-.174.198-.298.297-.496.099-.198.05-.372-.025-.52-.074-.149-.669-1.612-.916-2.208-.242-.58-.487-.502-.669-.511l-.57-.01c-.198 0-.52.074-.792.372-.273.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.876 1.213 3.074.148.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.873.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
</a>

<!-- ==================== CONSULTATION MODAL ==================== -->
<div class="consult-overlay" id="consultOverlay">
  <div class="consult-modal" role="dialog" aria-modal="true" aria-labelledby="consultTitle">
    <div class="consult-topbar">
      <button type="button" class="consult-close" onclick="closeConsult()" aria-label="Close">✕</button>
      <div class="consult-head">
        <div class="clogo">
          <img src="/assets/lotus-transparent.png" alt="Apex Beauty">
          <span>Apex Beauty</span>
        </div>
        <h2 id="consultTitle" data-de="Kostenlose Beratung" data-en="Free Consultation" data-fr="Consultation gratuite" data-nl="Gratis consult" data-it="Consulto gratuito" data-tr="Ücretsiz Danışma">Kostenlose Beratung</h2>
        <p data-de="Füllen Sie das Formular aus, wir melden uns innerhalb von 24 Stunden." data-en="Fill in the form and we'll get back to you within 24 hours." data-fr="Remplissez le formulaire, nous vous répondrons sous 24 heures." data-nl="Vul het formulier in, we nemen binnen 24 uur contact met u op." data-it="Compila il modulo, ti risponderemo entro 24 ore." data-tr="Formu doldurun, 24 saat içinde size dönüş yapalım.">Füllen Sie das Formular aus, wir melden uns innerhalb von 24 Stunden.</p>
      </div>
      <div class="consult-steps" id="consultSteps">
        <div class="cstep active" data-step="1"><span class="dot">1</span><span data-de="Info" data-en="Info" data-fr="Infos" data-nl="Info" data-it="Info" data-tr="Bilgi">Info</span></div>
        <div class="cstep-line"></div>
        <div class="cstep" data-step="2"><span class="dot">2</span><span data-de="Bedarf" data-en="Needs" data-fr="Besoins" data-nl="Behoefte" data-it="Esigenze" data-tr="İhtiyaçlar">Bedarf</span></div>
        <div class="cstep-line"></div>
        <div class="cstep" data-step="3"><span class="dot">3</span><span data-de="Fotos" data-en="Photos" data-fr="Photos" data-nl="Foto's" data-it="Foto" data-tr="Fotoğraflar">Fotos</span></div>
      </div>
    </div>
    <div class="consult-body">

    <!-- STEP 1: Info -->
    <div class="consult-pane active" id="cpane1">
      <div class="pane-title" data-de="Holen Sie sich Ihre kostenlose Haaranalyse" data-en="Get Your Free Hair Analysis" data-fr="Obtenez votre analyse capillaire gratuite" data-nl="Krijg uw gratis haaranalyse" data-it="Ottieni la tua analisi gratuita dei capelli" data-tr="Ücretsiz Saç Analizinizi Alın">Holen Sie sich Ihre kostenlose Haaranalyse</div>
      <div class="pane-sub" data-de="Unser Expertenteam meldet sich innerhalb von 24 Stunden" data-en="Our expert team will contact you within 24 hours" data-fr="Notre équipe d'experts vous contactera sous 24 heures" data-nl="Ons expertteam neemt binnen 24 uur contact met u op" data-it="Il nostro team di esperti ti contatterà entro 24 ore" data-tr="Uzman ekibimiz 24 saat içinde sizinle iletişime geçecektir">Unser Expertenteam meldet sich innerhalb von 24 Stunden</div>
      <div class="cfield">
        <label data-de="Vollständiger Name *" data-en="Full Name *" data-fr="Nom complet *" data-nl="Volledige naam *" data-it="Nome completo *" data-tr="Ad Soyad *">Vollständiger Name *</label>
        <input type="text" id="cfName" data-de-ph="Ihr vollständiger Name" data-en-ph="Your full name" placeholder="Ihr vollständiger Name" oninput="validateStep1()">
      </div>
      <div class="cfield">
        <label data-de="E-Mail *" data-en="Email *" data-fr="E-mail *" data-nl="E-mail *" data-it="E-mail *" data-tr="E-posta *">E-Mail *</label>
        <input type="email" id="cfEmail" placeholder="email@example.com" oninput="validateStep1()">
      </div>
      <div class="cfield">
        <label data-de="Land *" data-en="Country *" data-fr="Pays *" data-nl="Land *" data-it="Paese *" data-tr="Ülke *">Land *</label>
        <select id="cfCountry" onchange="updatePrefix(); validateStep1()">
          <option value="AT" data-prefix="+43">🇦🇹 Österreich</option>
          <option value="DE" data-prefix="+49">🇩🇪 Deutschland</option>
          <option value="CH" data-prefix="+41">🇨🇭 Schweiz</option>
          <option value="TR" data-prefix="+90">🇹🇷 Türkei</option>
          <option value="OTHER" data-prefix="+">🌍 Andere / Other</option>
        </select>
      </div>
      <div class="cfield">
        <label data-de="Telefon *" data-en="Phone *" data-fr="Téléphone *" data-nl="Telefoon *" data-it="Telefono *" data-tr="Telefon *">Telefon *</label>
        <div class="phone-row">
          <div class="prefix" id="cfPrefix">+43</div>
          <input type="tel" id="cfPhone" placeholder="660 123 45 67" oninput="validateStep1()">
        </div>
      </div>
      <div class="consult-nav">
        <button type="button" class="cnext" id="cnext1" disabled onclick="gotoStep(2)" data-de="Weiter" data-en="Continue" data-fr="Continuer" data-nl="Doorgaan" data-it="Continua" data-tr="Devam Et">Weiter</button>
      </div>
    </div>

    <!-- STEP 2: Needs -->
    <div class="consult-pane" id="cpane2">
      <div class="cfield">
        <label data-de="Ihr Geschlecht *" data-en="Your Gender *" data-fr="Votre sexe *" data-nl="Uw geslacht *" data-it="Il tuo genere *" data-tr="Cinsiyetiniz *">Ihr Geschlecht *</label>
        <div class="opt-grid cols-2" id="genderRow">
          <div class="opt-card radio centered" data-value="male" onclick="pickSingle(this,'genderRow'); validateStep2()">
            <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModMale" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModMale)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="12" cy="18" r="6" fill="none" stroke="#fff" stroke-width="2.2"/><polyline points="17,7 23,7 23,13" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/><line x1="16.2" y1="13.8" x2="23" y2="7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/></svg></span><span data-de="Männlich" data-en="Male" data-fr="Homme" data-nl="Man" data-it="Uomo" data-tr="Erkek">Männlich</span>
          </div>
          <div class="opt-card radio centered" data-value="female" onclick="pickSingle(this,'genderRow'); validateStep2()">
            <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModFemale" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModFemale)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="11" r="6" fill="none" stroke="#fff" stroke-width="2.2"/><line x1="15" y1="17" x2="15" y2="25" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/><line x1="11" y1="21" x2="19" y2="21" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/></svg></span><span data-de="Weiblich" data-en="Female" data-fr="Femme" data-nl="Vrouw" data-it="Donna" data-tr="Kadın">Weiblich</span>
          </div>
        </div>
      </div>
      <div class="cfield">
        <label data-de="Verfahren, die Sie interessieren *" data-en="Procedures You're Interested In *" data-fr="Interventions qui vous intéressent *" data-nl="Ingrepen waarin u geïnteresseerd bent *" data-it="Procedure di tuo interesse *" data-tr="İlgilendiğiniz İşlemler *">Verfahren, die Sie interessieren *</label>
        <div class="opt-grid cols-1" id="procRow">
          <div class="opt-card" data-value="hair" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModHair" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModHair)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M10 24c-1-6 0-11 2-14" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><path d="M15 24c0-7 0.5-12 0-16" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><path d="M20 24c1-6 0-11-2-14" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg></span><span data-de="Haartransplantation" data-en="Hair Transplant" data-fr="Greffe de cheveux" data-nl="Haartransplantatie" data-it="Trapianto di capelli" data-tr="Saç Ekimi">Haartransplantation</span>
          </div>
          <div class="opt-card" data-value="beard" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModBeard" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModBeard)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M9 10c0 8 2 14 6 16 4-2 6-8 6-16" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 20l0 3M15 21.5l0 3M18 20l0 3" stroke="#fff" stroke-width="1.6" stroke-linecap="round"/></svg></span><span data-de="Barttransplantation" data-en="Beard Transplant" data-fr="Greffe de barbe" data-nl="Baardtransplantatie" data-it="Trapianto di barba" data-tr="Sakal Ekimi">Barttransplantation</span>
          </div>
          <div class="opt-card" data-value="eyebrow" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModBrow" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModBrow)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M7 10c2-1.5 5-2.2 8-2.2s6 0.7 8 2.2" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><path d="M8 17c2.5-3 5-4.5 7-4.5s4.5 1.5 7 4.5c-2.5 3-5 4.5-7 4.5S10.5 20 8 17z" fill="none" stroke="#fff" stroke-width="1.8" stroke-linejoin="round"/><circle cx="15" cy="17" r="2" fill="#fff"/></svg></span><span data-de="Augenbrauentransplantation" data-en="Eyebrow Transplant" data-fr="Greffe de sourcils" data-nl="Wenkbrauwtransplantatie" data-it="Trapianto di sopracciglia" data-tr="Kaş Ekimi">Augenbrauentransplantation</span>
          </div>
        </div>
        <div class="cgroup-note" data-de="Unterstützende Therapien" data-en="Supporting Therapies" data-fr="Thérapies complémentaires" data-nl="Ondersteunende therapieën" data-it="Terapie di supporto" data-tr="Destekleyici Tedaviler">Unterstützende Therapien</div>
        <div class="opt-grid cols-2" id="therapyRow">
          <div class="opt-card" data-value="prp" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPrp" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPrp)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M15 6c4 5.5 7 9.6 7 13.2A7 7 0 1 1 8 19.2C8 15.6 11 11.5 15 6z" fill="#fff" opacity="0.95"/></svg></span><span data-de="PRP-Therapie" data-en="PRP Therapy" data-fr="Thérapie PRP" data-nl="PRP-therapie" data-it="Terapia PRP" data-tr="PRP Tedavisi">PRP-Therapie</span>
          </div>
          <div class="opt-card" data-value="stemcell" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModStem" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModStem)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M15 6l7 4v10l-7 4-7-4V10z" fill="none" stroke="#fff" stroke-width="2" stroke-linejoin="round"/><circle cx="15" cy="15" r="3" fill="#fff"/></svg></span><span data-de="Stammzelltherapie" data-en="Stem Cell Therapy" data-fr="Thérapie par cellules souches" data-nl="Stamceltherapie" data-it="Terapia con cellule staminali" data-tr="Kök Hücre Tedavisi">Stammzelltherapie</span>
          </div>
          <div class="opt-card" data-value="exosome" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModExo" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModExo)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="11" cy="12" r="4" fill="#fff" opacity="0.9"/><circle cx="20" cy="11" r="3" fill="#fff" opacity="0.75"/><circle cx="13" cy="20" r="3.4" fill="#fff" opacity="0.85"/><circle cx="21" cy="19" r="2.6" fill="#fff" opacity="0.7"/></svg></span><span data-de="Exosom-Therapie" data-en="Exosome Therapy" data-fr="Thérapie par exosomes" data-nl="Exosoomtherapie" data-it="Terapia con esosomi" data-tr="Ekzozom Tedavisi">Exosom-Therapie</span>
          </div>
          <div class="opt-card" data-value="hbot" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModHbot" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModHbot)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><rect x="8" y="7" width="14" height="16" rx="7" fill="none" stroke="#fff" stroke-width="2"/><path d="M15 12v6M12 15h6" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg></span><span data-de="Hyperbarer Sauerstoff" data-en="Hyperbaric Oxygen" data-fr="Oxygénothérapie hyperbare" data-nl="Hyperbare zuurstoftherapie" data-it="Ossigenoterapia iperbarica" data-tr="Hiperbarik Oksijen">Hyperbarer Sauerstoff</span>
          </div>
        </div>
      </div>
      <div class="cfield">
        <label data-de="Wann planen Sie den Eingriff?" data-en="When Are You Planning the Procedure?" data-fr="Quand prévoyez-vous l'intervention ?" data-nl="Wanneer plant u de ingreep?" data-it="Quando prevedi l'intervento?" data-tr="İşlemi Ne Zaman Planlıyorsunuz?">Wann planen Sie den Eingriff?</label>
        <div class="opt-grid cols-3" id="timingRow">
          <div class="opt-card radio centered" data-value="this-month" onclick="pickSingle(this,'timingRow'); validateStep2()"><span data-de="Diesen Monat" data-en="This month" data-fr="Ce mois-ci" data-nl="Deze maand" data-it="Questo mese" data-tr="Bu Ay">Diesen Monat</span></div>
          <div class="opt-card radio centered" data-value="1-3" onclick="pickSingle(this,'timingRow'); validateStep2()"><span data-de="In 1–3 Monaten" data-en="In 1–3 months" data-fr="Dans 1 à 3 mois" data-nl="Over 1–3 maanden" data-it="Tra 1 e 3 mesi" data-tr="1-3 Ay İçinde">In 1–3 Monaten</span></div>
          <div class="opt-card radio centered" data-value="3-6" onclick="pickSingle(this,'timingRow'); validateStep2()"><span data-de="In 3–6 Monaten" data-en="In 3–6 months" data-fr="Dans 3 à 6 mois" data-nl="Over 3–6 maanden" data-it="Tra 3 e 6 mesi" data-tr="3-6 Ay İçinde">In 3–6 Monaten</span></div>
          <div class="opt-card radio centered" data-value="6plus" onclick="pickSingle(this,'timingRow'); validateStep2()"><span data-de="In 6+ Monaten" data-en="In 6+ months" data-fr="Dans 6+ mois" data-nl="Over 6+ maanden" data-it="Tra 6+ mesi" data-tr="6+ Ay İçinde">In 6+ Monaten</span></div>
          <div class="opt-card radio centered" data-value="research" onclick="pickSingle(this,'timingRow'); validateStep2()" style="grid-column: span 2;"><span data-de="Nur recherchieren" data-en="Just researching" data-fr="Je me renseigne seulement" data-nl="Alleen aan het oriënteren" data-it="Sto solo informandomi" data-tr="Sadece Araştırıyorum">Nur recherchieren</span></div>
        </div>
      </div>
      <div class="cfield">
        <label data-de="Zusätzliche Notizen (optional)" data-en="Additional Notes (Optional)" data-fr="Remarques supplémentaires (facultatif)" data-nl="Aanvullende opmerkingen (optioneel)" data-it="Note aggiuntive (facoltativo)" data-tr="Ek Notlar (İsteğe Bağlı)">Zusätzliche Notizen (optional)</label>
        <textarea id="cfNotes" data-de-ph="Ihre Ziele oder Fragen..." data-en-ph="Your goals or questions..." placeholder="Ihre Ziele oder Fragen..."></textarea>
      </div>
      <div class="consult-nav">
        <button type="button" class="cback" onclick="gotoStep(1)" data-de="Zurück" data-en="Back" data-fr="Retour" data-nl="Terug" data-it="Indietro" data-tr="Geri">Zurück</button>
        <button type="button" class="cnext" id="cnext2" disabled onclick="gotoStep(3)" data-de="Weiter" data-en="Continue" data-fr="Continuer" data-nl="Doorgaan" data-it="Continua" data-tr="Devam Et">Weiter</button>
      </div>
    </div>

    <!-- STEP 3: Photos -->
    <div class="consult-pane" id="cpane3">
      <div class="photo-note" data-de="📸 Fotos sind optional. Unsere Experten kontaktieren Sie in jedem Fall." data-en="📸 Photos are optional. Our experts will contact you either way." data-fr="📸 Les photos sont facultatives. Nos experts vous contacteront dans tous les cas." data-nl="📸 Foto's zijn optioneel. Onze experts nemen sowieso contact met u op." data-it="📸 Le foto sono facoltative. I nostri esperti ti contatteranno comunque." data-tr="📸 Fotoğraflar isteğe bağlıdır. Uzmanlarımız her durumda sizinle iletişime geçecektir.">📸 Fotos sind optional. Unsere Experten kontaktieren Sie in jedem Fall.</div>
      <div class="photo-grid">
        <div class="photo-slot" id="slot-front">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPhFront" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPhFront)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="14" r="7" fill="none" stroke="#fff" stroke-width="2"/><circle cx="12.5" cy="12.5" r="1.1" fill="#fff"/><circle cx="17.5" cy="12.5" r="1.1" fill="#fff"/><path d="M12 17c1 1.2 2 1.6 3 1.6s2-0.4 3-1.6" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round"/></svg></span>
          <b data-de="Vorne" data-en="Front" data-fr="Face avant" data-nl="Voorkant" data-it="Fronte" data-tr="Ön">Vorne</b>
          <span data-de="Gesicht sichtbar" data-en="Face visible" data-fr="Visage visible" data-nl="Gezicht zichtbaar" data-it="Volto visibile" data-tr="Yüz Görünür">Gesicht sichtbar</span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-front')">
        </div>
        <div class="photo-slot" id="slot-top">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPhTop" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPhTop)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="20" r="4.5" fill="none" stroke="#fff" stroke-width="2"/><path d="M15 5v8M11 9l4-4 4 4" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <b data-de="Oben" data-en="Top" data-fr="Dessus" data-nl="Bovenkant" data-it="Sopra" data-tr="Üst">Oben</b>
          <span data-de="Von oben" data-en="From above" data-fr="Vue de dessus" data-nl="Van bovenaf" data-it="Dall'alto" data-tr="Yukarıdan">Von oben</span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-top')">
        </div>
        <div class="photo-slot" id="slot-side">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPhSide" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPhSide)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M11 22c-1-2-1-4 0-6-1-1-1-3 0-4 1-3 4-5 7-5 3 0 4 2 4 4 1 0 2 1 2 2 0 2-1 3-2 3 0 2-1 4-3 5-1 1-1 2 0 3z" fill="#fff" opacity="0.92"/></svg></span>
          <b data-de="Seite" data-en="Side" data-fr="Profil" data-nl="Zijkant" data-it="Lato" data-tr="Yan">Seite</b>
          <span data-de="Profil" data-en="Profile" data-fr="Profil" data-nl="Profiel" data-it="Profilo" data-tr="Profil">Profil</span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-side')">
        </div>
        <div class="photo-slot" id="slot-donor">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPhDonor" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPhDonor)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M20 10a7 7 0 1 0 1.8 6.9" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><polyline points="22,7 21.8,11.5 17.5,10.5" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <b data-de="Spender" data-en="Donor" data-fr="Donneuse" data-nl="Donor" data-it="Donatrice" data-tr="Donör">Spender</b>
          <span data-de="Hinterkopf" data-en="Back of head" data-fr="Arrière de la tête" data-nl="Achterhoofd" data-it="Retro della testa" data-tr="Baş Arkası">Hinterkopf</span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-donor')">
        </div>
      </div>
      <div class="photo-note"><span id="photoCount">0</span>/4 <span data-de="Fotos hochgeladen" data-en="photos uploaded" data-fr="photos téléchargées" data-nl="foto's geüpload" data-it="foto caricate" data-tr="fotoğraf yüklendi">Fotos hochgeladen</span></div>
      <div class="cfield">
        <label data-de="Rabattgutschein (optional)" data-en="Discount Coupon (Optional)" data-fr="Code de réduction (facultatif)" data-nl="Kortingscode (optioneel)" data-it="Codice sconto (facoltativo)" data-tr="İndirim Kuponu (İsteğe Bağlı)">Rabattgutschein (optional)</label>
        <input type="text" id="cfCoupon" placeholder="WELCOME5">
      </div>
      <div class="check-row">
        <input type="checkbox" id="cfPrivacy" onchange="validateStep3()">
        <span data-de="Ich habe die &lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;Datenschutzerklärung&lt;/a&gt; gelesen und akzeptiere die Verarbeitung meiner personenbezogenen Daten. *" data-en="I have read the &lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;privacy policy&lt;/a&gt; and accept the processing of my personal data. *" data-fr="J'ai lu la &lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;politique de confidentialité&lt;/a&gt; et j'accepte le traitement de mes données personnelles. *" data-nl="Ik heb het &lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;privacybeleid&lt;/a&gt; gelezen en ga akkoord met de verwerking van mijn persoonsgegevens. *" data-it="Ho letto l'&lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;informativa sulla privacy&lt;/a&gt; e accetto il trattamento dei miei dati personali. *" data-tr="&lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;Gizlilik politikasını&lt;/a&gt; okudum ve kişisel verilerimin işlenmesini kabul ediyorum. *">Ich habe die <a href="<?= apex_lang_base() ?>/privacy" target="_blank" rel="noopener noreferrer">Datenschutzerklärung</a> gelesen und akzeptiere die Verarbeitung meiner personenbezogenen Daten. *</span>
      </div>
      <div class="check-row">
        <input type="checkbox" id="cfMarketing">
        <span data-de="Ich möchte über Aktionen und Angebote informiert werden." data-en="I'd like to be informed about promotions and offers." data-fr="Je souhaite être informé(e) des promotions et offres." data-nl="Ik wil op de hoogte worden gehouden van acties en aanbiedingen." data-it="Desidero essere informato/a su promozioni e offerte." data-tr="Kampanyalar ve fırsatlar hakkında bilgilendirilmek istiyorum.">Ich möchte über Aktionen und Angebote informiert werden.</span>
      </div>
      <div class="gdpr-badge" data-de="🇪🇺 DSGVO · Ihre Daten sind geschützt" data-en="🇪🇺 GDPR · Your data is protected" data-fr="🇪🇺 RGPD · Vos données sont protégées" data-nl="🇪🇺 AVG · Uw gegevens zijn beschermd" data-it="🇪🇺 GDPR · I tuoi dati sono protetti" data-tr="🇪🇺 GDPR · Verileriniz Korunmaktadır">🇪🇺 DSGVO · Ihre Daten sind geschützt</div>
      <div class="consult-nav">
        <button type="button" class="cback" onclick="gotoStep(2)" data-de="Zurück" data-en="Back" data-fr="Retour" data-nl="Terug" data-it="Indietro" data-tr="Geri">Zurück</button>
        <button type="button" class="cnext" id="cnext3" disabled onclick="submitConsult()" data-de="Absenden" data-en="Submit" data-fr="Envoyer" data-nl="Versturen" data-it="Invia" data-tr="Gönder">Absenden</button>
      </div>
    </div>

    <!-- SUCCESS -->
    <div class="consult-pane" id="cpaneSuccess">
      <div class="consult-success">
        <div class="ok-ring">✓</div>
        <h3 data-de="Vielen Dank!" data-en="Thank You!" data-fr="Merci !" data-nl="Bedankt!" data-it="Grazie!" data-tr="Teşekkürler!">Vielen Dank!</h3>
        <p data-de="Ihre Anfrage ist bei uns eingegangen. Unser Team meldet sich innerhalb von 24 Stunden bei Ihnen." data-en="We've received your request. Our team will get back to you within 24 hours." data-fr="Nous avons bien reçu votre demande. Notre équipe vous recontactera sous 24 heures." data-nl="We hebben uw aanvraag ontvangen. Ons team neemt binnen 24 uur contact met u op." data-it="Abbiamo ricevuto la tua richiesta. Il nostro team ti risponderà entro 24 ore." data-tr="Talebinizi aldık. Ekibimiz 24 saat içinde sizinle iletişime geçecektir.">Ihre Anfrage ist bei uns eingegangen. Unser Team meldet sich innerhalb von 24 Stunden bei Ihnen.</p>
      </div>
    </div>
    </div>
  </div>
</div>

<script>
  // Leads backend (see /backend) — update this when deploying so submissions
  // reach the real API instead of a local dev server.
  var LEADS_API_BASE = '';

  // Reads a cookie by name (used below for Meta's _fbp/_fbc, which the
  // Pixel script itself sets once loaded — see assets/meta-pixel.js).
  function apexReadCookie(name) {
    var match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
    return match ? decodeURIComponent(match[1]) : null;
  }

  // FR/NL/IT/TR have no translated copy yet — they fall back to the English
  // strings until real translations are added for those data-* attributes.
  var APEX_TRANSLATED_LANGS = ['de', 'en'];
  function applyLang(lang) {
    document.documentElement.lang = lang;
    var fallback = APEX_TRANSLATED_LANGS.indexOf(lang) === -1 ? 'en' : null;
    document.querySelectorAll('[data-de]').forEach(function (el) {
      var val = el.getAttribute('data-' + lang);
      if (val === null && fallback) val = el.getAttribute('data-' + fallback);
      if (val !== null) el.innerHTML = val;
    });
    document.querySelectorAll('[data-de-ph]').forEach(function (el) {
      var ph = el.getAttribute('data-' + lang + '-ph');
      if (ph === null && fallback) ph = el.getAttribute('data-' + fallback + '-ph');
      if (ph !== null) el.placeholder = ph;
    });
    document.querySelectorAll('.lang-switch-menu button').forEach(function (s) {
      var isActive = s.getAttribute('data-lang') === lang;
      s.className = isActive ? 'active' : 'inactive';
    });
    document.querySelectorAll('.lang-switch-current').forEach(function (s) {
      s.textContent = lang.toUpperCase();
    });
  }
  document.querySelectorAll('.lang-switch-menu button').forEach(function (s) {
    s.addEventListener('click', function () {
      applyLang(s.getAttribute('data-lang'));
      var ls = s.closest('.lang-switch');
      if (ls) {
        ls.classList.remove('open');
        var t = ls.querySelector('.lang-switch-toggle');
        if (t) t.setAttribute('aria-expanded', 'false');
      }
    });
  });

  /* ---- Consultation modal ---- */
  function openConsult(e) {
    if (e) e.preventDefault();
    document.getElementById('consultOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeConsult() {
    document.getElementById('consultOverlay').classList.remove('open');
    document.body.style.overflow = '';
  }
  document.getElementById('consultOverlay').addEventListener('click', function (e) {
    if (e.target === this) closeConsult();
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeConsult();
  });
  function gotoStep(n) {
    [1, 2, 3].forEach(function (i) {
      document.getElementById('cpane' + i).classList.toggle('active', i === n);
    });
    document.getElementById('cpaneSuccess').classList.remove('active');
    document.querySelectorAll('#consultSteps .cstep').forEach(function (s) {
      var step = parseInt(s.getAttribute('data-step'), 10);
      s.classList.toggle('active', step === n);
      s.classList.toggle('done', step < n);
    });
    document.querySelector('.consult-modal').scrollTop = 0;
  }
  function pickSingle(el, rowId) {
    document.querySelectorAll('#' + rowId + ' .opt-card').forEach(function (c) { c.classList.remove('selected'); });
    el.classList.add('selected');
  }
  function toggleChip(el) { el.classList.toggle('selected'); }
  function selectedValues(rowId) {
    return Array.from(document.querySelectorAll('#' + rowId + ' .opt-card.selected'))
      .map(function (c) { return c.getAttribute('data-value'); });
  }
  function updatePrefix() {
    var sel = document.getElementById('cfCountry');
    var prefix = sel.options[sel.selectedIndex].getAttribute('data-prefix');
    document.getElementById('cfPrefix').textContent = prefix;
  }
  function validateStep1() {
    var name = document.getElementById('cfName').value.trim();
    var email = document.getElementById('cfEmail').value.trim();
    var phone = document.getElementById('cfPhone').value.trim();
    var emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    document.getElementById('cnext1').disabled = !(name.length >= 2 && emailOk && phone.length >= 5);
  }
  function validateStep2() {
    var gender = selectedValues('genderRow').length === 1;
    var procs = selectedValues('procRow').length + selectedValues('therapyRow').length > 0;
    document.getElementById('cnext2').disabled = !(gender && procs);
  }
  function validateStep3() {
    document.getElementById('cnext3').disabled = !document.getElementById('cfPrivacy').checked;
  }
  function markSlot(input, slotId) {
    var slot = document.getElementById(slotId);
    slot.classList.toggle('filled', input.files.length > 0);
    var filled = document.querySelectorAll('.photo-slot.filled').length;
    document.getElementById('photoCount').textContent = filled;
  }
  function submitConsult() {
    var params = new URLSearchParams(window.location.search);
    // Shared event_id: generated once per submission, used identically in
    // the client-side fbq('track','Lead',...) call below AND sent to the
    // backend for its CAPI Lead event (backend/capi.js) — this is what lets
    // Meta deduplicate the two into a single event.
    var eventId = (window.crypto && crypto.randomUUID) ? crypto.randomUUID() : (Date.now() + '-' + Math.random().toString(36).slice(2));
    var lead = {
      name: document.getElementById('cfName').value.trim(),
      email: document.getElementById('cfEmail').value.trim(),
      country: document.getElementById('cfCountry').value,
      phone: document.getElementById('cfPrefix').textContent + ' ' + document.getElementById('cfPhone').value.trim(),
      gender: selectedValues('genderRow')[0] || null,
      procedures: selectedValues('procRow'),
      therapies: selectedValues('therapyRow'),
      timing: selectedValues('timingRow')[0] || null,
      notes: document.getElementById('cfNotes').value.trim(),
      photosUploaded: document.querySelectorAll('.photo-slot.filled').length,
      coupon: document.getElementById('cfCoupon').value.trim(),
      marketingOptIn: document.getElementById('cfMarketing').checked,
      lang: document.documentElement.lang,
      utm: {
        source: params.get('utm_source'),
        medium: params.get('utm_medium'),
        campaign: params.get('utm_campaign')
      },
      // Consent + CAPI match-quality fields (batch 5). trackingConsent is
      // what routes/leads.js checks before calling Meta's Conversion API —
      // the lead itself is always saved either way.
      eventId: eventId,
      trackingConsent: window.__apexConsent.hasMarketingConsent(),
      fbp: apexReadCookie('_fbp'),
      fbc: apexReadCookie('_fbc'),
      pageUrl: window.location.href,
      submittedAt: new Date().toISOString()
    };
    try {
      var leads = JSON.parse(localStorage.getItem('apexLeads') || '[]');
      leads.push(lead);
      localStorage.setItem('apexLeads', JSON.stringify(leads));
    } catch (err) { /* storage unavailable */ }
    console.log('[apex-lead]', lead);
    // localStorage above is a local fallback/cache only. The real record of
    // truth is the leads backend (see /backend) — this call is fire-and-forget
    // so a slow/offline API never blocks the success screen from showing.
    fetch(LEADS_API_BASE + '/api/leads', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(lead)
    }).then(function (res) {
      // Only a real 201 from the backend counts as a genuine lead — never
      // fire on a network error, a validation failure, or just because the
      // success screen is already showing (that's shown unconditionally,
      // see above).
      if (res.status === 201) {
        window.__apexPixel.track('Lead', { eventId: eventId });
      }
    }).catch(function (err) { console.warn('[apex-lead] backend unreachable, kept locally only', err); });
    [1, 2, 3].forEach(function (i) { document.getElementById('cpane' + i).classList.remove('active'); });
    document.querySelectorAll('#consultSteps .cstep').forEach(function (s) { s.classList.add('done'); s.classList.remove('active'); });
    document.getElementById('cpaneSuccess').classList.add('active');
  }

  /* ---- Quick-nav scroll spy ---- */
  var hpSections = Array.from(document.querySelectorAll('.hp-section[id]'));
  var hpLinks = Array.from(document.querySelectorAll('#hpQuicknav a'));
  var hpQuicknavEl = document.getElementById('hpQuicknav');
  function hpScrollNavToActive(link) {
    if (!hpQuicknavEl || !link) return;
    var containerRect = hpQuicknavEl.getBoundingClientRect();
    var linkRect = link.getBoundingClientRect();
    var offset = (linkRect.left + linkRect.width / 2) - (containerRect.left + containerRect.width / 2);
    hpQuicknavEl.scrollBy({ left: offset, behavior: 'smooth' });
  }
  if ('IntersectionObserver' in window && hpSections.length) {
    var spy = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          hpLinks.forEach(function (l) { l.classList.remove('active'); });
          var match = hpLinks.find(function (l) { return l.getAttribute('href') === '#' + entry.target.id; });
          if (match) {
            match.classList.add('active');
            hpScrollNavToActive(match);
          }
        }
      });
    }, { rootMargin: '-160px 0px -70% 0px' });
    hpSections.forEach(function (s) { spy.observe(s); });
  }

  function trackWhatsAppContact() {
    if (window.__apexPixel) window.__apexPixel.track('Contact');
  }
</script>

<?php include __DIR__ . '/includes/apex-ai-widget.php'; ?>

</body>
</html>
<?php echo apex_localize_output((string) ob_get_clean(), $currentLang); ?>
