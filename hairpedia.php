<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/site-config.php';
$seoTitle = 'Hairpedia: Haarausfall verstehen – Ursachen, Diagnose & Behandlung | Apex Beauty';
$seoDescription = 'Alles über Haarausfall: Ursachen, Arten, Diagnose, Behandlungsmöglichkeiten und Haartransplantation, verständlich erklärt von Apex Beauty.';
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
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<script src="assets/meta-pixel.js"></script>
<script src="assets/cookie-consent.js"></script>
<script src="assets/content-loader.js"></script>
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
    font-size: 38px; line-height: 1.16; font-weight: 800; letter-spacing: -0.02em;
    color: #1a2733; margin-bottom: 16px;
  }
  .hp-hero h1 span {
    background: linear-gradient(100deg, var(--teal-600), var(--blue-700));
    -webkit-background-clip: text; background-clip: text; color: transparent;
  }
  .hp-hero p { font-size: 16px; line-height: 1.6; color: var(--ink-soft); max-width: 620px; margin: 0 auto; }

  /* ---- QUICK NAV ---- */
  .hp-quicknav-wrap {
    position: sticky; top: 71px; z-index: 40;
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
    display: flex; align-items: flex-start; gap: 12px; padding: 13px 16px; border-radius: 12px;
    background: rgba(255,255,255,0.38);
    backdrop-filter: blur(22px) saturate(2);
    -webkit-backdrop-filter: blur(22px) saturate(2);
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.75);
  }
  .hp-check .tick {
    flex-shrink: 0; width: 22px; height: 22px; border-radius: 50%;
    background: linear-gradient(120deg, var(--teal-500), var(--blue-600)); color: #fff;
    display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; margin-top: 1px;
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
    display: flex; align-items: flex-start; gap: 10px; padding: 12px 14px; border-radius: 12px;
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
    .hp-hero h1 { font-size: 27px; }
    .hp-quicknav { padding: 0 20px; }
    .hp-section { padding: 48px 20px; }
    .hp-section.alt .hp-section-in { padding: 0 20px; }
    .hp-grid, .hp-grid.cols-2, .hp-cycle, .hp-stats, .hp-rules { grid-template-columns: 1fr; }
    .hp-glossary { columns: 1; }
    .hp-section-head { flex-direction: column; gap: 12px; }
    .hp-thumbs-wrap { padding: 4px 20px 40px; }
    .hp-thumbs { grid-template-columns: 1fr; }
  }
  @media (min-width: 901px) and (max-width: 1180px) {
    .hp-thumbs { grid-template-columns: repeat(2, 1fr); }
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
</style>
</head>
<body data-content-page="hairpedia">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.php?id=GTM-W6ZC5JRP"
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
    <div class="eyebrow"><span class="dot"></span><span data-de="Wissen &amp; Aufklärung" data-en="Knowledge &amp; education">Wissen &amp; Aufklärung</span></div>
    <h1 data-ckey="hero.heading" data-de="Hairpedia: Ihr Wissen rund um <span>Haarausfall &amp; Haartransplantation</span>" data-en="Hairpedia: everything you need to know about <span>hair loss &amp; hair transplantation</span>">Hairpedia: Ihr Wissen rund um <span>Haarausfall &amp; Haartransplantation</span></h1>
    <p data-ckey="hero.sub" data-de="Wissenschaftlich fundiert, verständlich erklärt. Von den Ursachen des Haarausfalls bis zur vollständigen Genesung nach der Transplantation, alles an einem Ort." data-en="Scientifically grounded, clearly explained. From the causes of hair loss to full recovery after transplantation, all in one place.">Wissenschaftlich fundiert, verständlich erklärt. Von den Ursachen des Haarausfalls bis zur vollständigen Genesung nach der Transplantation, alles an einem Ort.</p>
  </div>
</section>

<div class="hp-thumbs-wrap">
  <div class="hp-thumbs">
    <a class="hp-thumb" href="#was-ist-haarausfall">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gInfoThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gInfoThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="32" cy="21" r="4" fill="#fff"/><rect x="28" y="29" width="8" height="20" rx="3" fill="#fff" opacity="0.92"/></svg>
      <span class="hp-thumb-text"><b data-de="Was ist Haarausfall" data-en="What is hair loss">Was ist Haarausfall</b><span data-de="Definition, Zahlen, Wachstumszyklus" data-en="Definition, stats, growth cycle">Definition, Zahlen, Wachstumszyklus</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#ursachen">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gDnaThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gDnaThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M24 14c0 8 16 8 16 16s-16 8-16 16" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round"/><path d="M40 14c0 8-16 8-16 16s16 8 16 16" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round" opacity="0.55"/></svg>
      <span class="hp-thumb-text"><b data-de="Ursachen" data-en="Causes">Ursachen</b><span data-de="Genetik, DHT, Hormone, Stress" data-en="Genetics, DHT, hormones, stress">Genetik, DHT, Hormone, Stress</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#arten">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gGridThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gGridThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="16" y="16" width="12" height="12" rx="3" fill="#fff" opacity="0.95"/><rect x="36" y="16" width="12" height="12" rx="3" fill="#fff" opacity="0.7"/><rect x="16" y="36" width="12" height="12" rx="3" fill="#fff" opacity="0.7"/><rect x="36" y="36" width="12" height="12" rx="3" fill="#fff" opacity="0.95"/></svg>
      <span class="hp-thumb-text"><b data-de="Arten" data-en="Types">Arten</b><span data-de="Androgenetisch, areata und mehr" data-en="Androgenetic, areata, and more">Androgenetisch, areata und mehr</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#diagnose">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMagThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gMagThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="27" cy="27" r="11" fill="none" stroke="#fff" stroke-width="3.2"/><line x1="35" y1="35" x2="45" y2="45" stroke="#fff" stroke-width="3.2" stroke-linecap="round"/></svg>
      <span class="hp-thumb-text"><b data-de="Diagnose" data-en="Diagnosis">Diagnose</b><span data-de="Trichoskopie, Zugtest, Bluttests" data-en="Trichoscopy, pull test, blood tests">Trichoskopie, Zugtest, Bluttests</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#behandlung">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gPillThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gPillThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="16" y="25" width="32" height="14" rx="7" fill="none" stroke="#fff" stroke-width="3"/><line x1="32" y1="25" x2="32" y2="39" stroke="#fff" stroke-width="3"/></svg>
      <span class="hp-thumb-text"><b data-de="Behandlung" data-en="Treatment">Behandlung</b><span data-de="Von Minoxidil bis Transplantation" data-en="From minoxidil to transplantation">Von Minoxidil bis Transplantation</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#transplantation">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gGraftThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gGraftThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M22 46c-1-8 1-15 4-19M32 46c0-9 0-16 0-20M42 46c1-8-1-15-4-19" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round"/><circle cx="22" cy="48" r="2.4" fill="#fff"/><circle cx="32" cy="48" r="2.4" fill="#fff"/><circle cx="42" cy="48" r="2.4" fill="#fff"/></svg>
      <span class="hp-thumb-text"><b data-de="Transplantation" data-en="Transplantation">Transplantation</b><span data-de="FUE, Saphir-FUE und DHI im Vergleich" data-en="FUE, Sapphire FUE, and DHI compared">FUE, Saphir-FUE und DHI im Vergleich</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#genesung">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gCal2Thumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gCal2Thumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="15" y="18" width="34" height="28" rx="5" fill="none" stroke="#fff" stroke-width="2.6"/><line x1="15" y1="27" x2="49" y2="27" stroke="#fff" stroke-width="2.6"/></svg>
      <span class="hp-thumb-text"><b data-de="Genesung" data-en="Recovery">Genesung</b><span data-de="Zeitstrahl &amp; Nachsorgeregeln" data-en="Timeline &amp; aftercare rules">Zeitstrahl &amp; Nachsorgeregeln</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#vorher-nachher">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gCompareThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gCompareThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="27" cy="32" r="13" fill="#fff" opacity="0.5"/><circle cx="39" cy="32" r="13" fill="#fff" opacity="0.85"/></svg>
      <span class="hp-thumb-text"><b data-de="Vorher-Nachher" data-en="Before &amp; after">Vorher-Nachher</b><span data-de="Was pro Monat zu erwarten ist" data-en="What to expect each month">Was pro Monat zu erwarten ist</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
    <a class="hp-thumb" href="#glossar">
      <svg class="hp-thumb-ico" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gBookThumb" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gBookThumb)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M32 22c-6-4-13-5-18-3v22c5-2 12-1 18 3 6-4 13-5 18-3V19c-5-2-12-1-18 3z" fill="#fff" opacity="0.95"/></svg>
      <span class="hp-thumb-text"><b data-de="Glossar" data-en="Glossary">Glossar</b><span data-de="Fachbegriffe einfach erklärt" data-en="Terms explained simply">Fachbegriffe einfach erklärt</span></span>
      <span class="hp-thumb-arrow">→</span>
    </a>
  </div>
</div>

<div class="hp-quicknav-wrap">
  <div class="hp-quicknav" id="hpQuicknav">
    <a href="#was-ist-haarausfall"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><line x1="12" y1="11" x2="12" y2="16"/><circle cx="12" cy="7.5" r="0.5" fill="currentColor"/></svg><span data-de="Was ist Haarausfall" data-en="What is hair loss">Was ist Haarausfall</span></a>
    <a href="#ursachen"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M9 3c0 3 6 3 6 6s-6 3-6 6"/><path d="M15 3c0 3-6 3-6 6s6 3 6 6"/></svg><span data-de="Ursachen" data-en="Causes">Ursachen</span></a>
    <a href="#arten"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="8" height="8" rx="1.5"/><rect x="13" y="3" width="8" height="8" rx="1.5"/><rect x="3" y="13" width="8" height="8" rx="1.5"/><rect x="13" y="13" width="8" height="8" rx="1.5"/></svg><span data-de="Arten" data-en="Types">Arten</span></a>
    <a href="#diagnose"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="10" cy="10" r="6"/><line x1="14.5" y1="14.5" x2="20" y2="20"/></svg><span data-de="Diagnose" data-en="Diagnosis">Diagnose</span></a>
    <a href="#behandlung"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="8" width="18" height="8" rx="4"/><line x1="12" y1="8" x2="12" y2="16"/></svg><span data-de="Behandlung" data-en="Treatment">Behandlung</span></a>
    <a href="#transplantation"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M8 20c-1-5 0-9 2-12M12 20c0-6 0-10 0-13M16 20c1-5 0-9-2-12"/></svg><span data-de="Transplantation" data-en="Transplantation">Transplantation</span></a>
    <a href="#genesung"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><line x1="3" y1="9.5" x2="21" y2="9.5"/><line x1="8" y1="2" x2="8" y2="7"/><line x1="16" y1="2" x2="16" y2="7"/></svg><span data-de="Genesung" data-en="Recovery">Genesung</span></a>
    <a href="#vorher-nachher"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="12" r="7" opacity="0.55"/><circle cx="15" cy="12" r="7"/></svg><span data-de="Vorher-Nachher" data-en="Before &amp; after">Vorher-Nachher</span></a>
    <a href="#glossar"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5.5c4-2 8 0 8 0s4-2 8 0v13c-4-2-8 0-8 0s-4-2-8 0z"/><line x1="12" y1="5.5" x2="12" y2="18.5"/></svg><span data-de="Glossar" data-en="Glossary">Glossar</span></a>
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
    <b data-de="Bildplatzhalter: Diagramm" data-en="Image placeholder: diagram">Bildplatzhalter: Diagramm</b>
    <span data-de="Illustration des Haarwachstumszyklus (Anagen, Katagen, Telogen) als kreisförmiges Diagramm" data-en="Illustration of the hair growth cycle (anagen, catagen, telogen) as a circular diagram">Illustration des Haarwachstumszyklus (Anagen, Katagen, Telogen) als kreisförmiges Diagramm</span>
  </div>
  <div class="hp-stats">
    <div class="hp-stat"><b data-de="1–1,5 Mrd." data-en="1–1.5 bn">1–1,5 Mrd.</b><span data-de="Menschen weltweit von androgenetischer Alopezie betroffen" data-en="people worldwide affected by androgenetic alopecia">Menschen weltweit von androgenetischer Alopezie betroffen</span></div>
    <div class="hp-stat"><b data-de="80% / 50%" data-en="80% / 50%">80% / 50%</b><span data-de="der Männer bzw. Frauen zeigen bis 70 einen gewissen Grad an Haarausfall" data-en="of men / women show some degree of hair loss by age 70">der Männer bzw. Frauen zeigen bis 70 einen gewissen Grad an Haarausfall</span></div>
  </div>
  <p style="font-size:14.5px;color:var(--ink-soft);line-height:1.65;max-width:760px;margin-bottom:8px" data-de="Haarausfall ist nicht nur ein kosmetisches Thema. Studien zeigen durchgängig höhere Raten von Angst, depressiven Verstimmungen und vermindertem Selbstwertgefühl bei Betroffenen, besonders wenn er in jungen Jahren beginnt." data-en="Hair loss isn't just cosmetic. Research consistently shows higher rates of anxiety, depression, and reduced self-esteem among those affected, particularly when it starts young.">Haarausfall ist nicht nur ein kosmetisches Thema. Studien zeigen durchgängig höhere Raten von Angst, depressiven Verstimmungen und vermindertem Selbstwertgefühl bei Betroffenen, besonders wenn er in jungen Jahren beginnt.</p>

  <h3 style="font-size:18px;font-weight:700;margin:32px 0 4px" data-de="Der Haarwachstumszyklus" data-en="The hair growth cycle">Der Haarwachstumszyklus</h3>
  <p style="font-size:13.5px;color:var(--ink-soft);margin-bottom:8px;max-width:700px" data-de="Jedes Haar durchläuft drei Phasen. Zu verstehen, wie sie funktionieren, erklärt, warum Haarausfall entsteht und warum eine Transplantation wirkt." data-en="Every hair moves through three phases. Understanding them explains why hair loss happens and why transplantation works.">Jedes Haar durchläuft drei Phasen. Zu verstehen, wie sie funktionieren, erklärt, warum Haarausfall entsteht und warum eine Transplantation wirkt.</p>
  <div class="hp-cycle">
    <div class="hp-cycle-card">
      <div class="pct">85–90%</div>
      <h4 data-de="Anagen" data-en="Anagen">Anagen</h4>
      <div class="dur" data-de="2–7 Jahre · Wachstumsphase" data-en="2–7 years · Growth phase">2–7 Jahre · Wachstumsphase</div>
      <p data-de="Der Follikel produziert aktiv einen Haarschaft, rund 1 bis 1,5 cm pro Monat. Je länger diese Phase, desto länger kann das Haar werden." data-en="The follicle actively produces a hair shaft, growing roughly 1 to 1.5 cm per month. The longer this phase, the longer the hair can grow.">Der Follikel produziert aktiv einen Haarschaft, rund 1 bis 1,5 cm pro Monat. Je länger diese Phase, desto länger kann das Haar werden.</p>
    </div>
    <div class="hp-cycle-card">
      <div class="pct">~1%</div>
      <h4 data-de="Katagen" data-en="Catagen">Katagen</h4>
      <div class="dur" data-de="2–3 Wochen · Übergangsphase" data-en="2–3 weeks · Transition phase">2–3 Wochen · Übergangsphase</div>
      <p data-de="Eine kurze Übergangsphase. Die Haarproduktion stoppt, der Follikel schrumpft und löst sich von der Blutversorgung." data-en="A short transitional period. Hair production stops, the follicle shrinks, and detaches from its blood supply.">Eine kurze Übergangsphase. Die Haarproduktion stoppt, der Follikel schrumpft und löst sich von der Blutversorgung.</p>
    </div>
    <div class="hp-cycle-card">
      <div class="pct">10–15%</div>
      <h4 data-de="Telogen" data-en="Telogen">Telogen</h4>
      <div class="dur" data-de="~3 Monate · Ruhephase" data-en="~3 months · Resting phase">~3 Monate · Ruhephase</div>
      <p data-de="Der Follikel ruht rund 3 Monate. Am Ende der Phase fällt das Haar aus und ein neues Anagen-Haar beginnt zu wachsen." data-en="The follicle rests for around 3 months. At the end, the hair sheds and a new anagen hair begins growing.">Der Follikel ruht rund 3 Monate. Am Ende der Phase fällt das Haar aus und ein neues Anagen-Haar beginnt zu wachsen.</p>
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
    <b data-de="Bildplatzhalter: Infografik" data-en="Image placeholder: infographic">Bildplatzhalter: Infografik</b>
    <span data-de="Infografik mit Icons für jede Ursachengruppe (Genetik, Hormone, Stress, Ernährung, Medikamente)" data-en="Infographic with icons for each cause group (genetics, hormones, stress, nutrition, medications)">Infografik mit Icons für jede Ursachengruppe (Genetik, Hormone, Stress, Ernährung, Medikamente)</span>
  </div>
  <div class="hp-grid">
    <div class="hp-card"><span class="hp-badge" data-de="Häufigste Ursache" data-en="Most common">Häufigste Ursache</span><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini1" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini1)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M9 3c0 3 6 3 6 6s-6 3-6 6"/><path d="M15 3c0 3-6 3-6 6s6 3 6 6"/></g></svg></div><h4 data-de="Genetik" data-en="Genetics">Genetik</h4><p data-de="Die genetische Veranlagung ist der Haupttreiber. Rund 80% der Männer mit erblich bedingtem Haarausfall haben einen betroffenen Vater. Vererbung kann von beiden Elternteilen kommen." data-en="Genetic predisposition is the primary driver. Around 80% of men with pattern baldness have a father who was also affected. Inheritance can come from either side.">Die genetische Veranlagung ist der Haupttreiber. Rund 80% der Männer mit erblich bedingtem Haarausfall haben einen betroffenen Vater. Vererbung kann von beiden Elternteilen kommen.</p></div>
    <div class="hp-card"><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini2" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini2)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M12 2a4 4 0 0 0-4 4v2a4 4 0 0 0 8 0V6a4 4 0 0 0-4-4Z"/><path d="M8 14v1a4 4 0 0 0 8 0v-1"/><path d="M12 19v3"/></g></svg></div><h4 data-de="DHT (Dihydrotestosteron)" data-en="DHT (Dihydrotestosterone)">DHT (Dihydrotestosteron)</h4><p data-de="Der zentrale Hormontreiber bei Männern und Frauen. DHT bindet an genetisch empfindliche Follikel und lässt sie über Zeit schrumpfen." data-en="The central hormonal driver in both men and women. DHT binds to genetically sensitive follicles and causes them to shrink over time.">Der zentrale Hormontreiber bei Männern und Frauen. DHT bindet an genetisch empfindliche Follikel und lässt sie über Zeit schrumpfen.</p></div>
    <div class="hp-card"><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini3" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini3)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M12 21c-4-3-8-6-8-11a5 5 0 0 1 9-3 5 5 0 0 1 9 3c0 5-4 8-8 11z"/></g></svg></div><h4 data-de="Hormonelle Veränderungen" data-en="Hormonal changes">Hormonelle Veränderungen</h4><p data-de="Schwangerschaft, Wechseljahre, Schilddrüsenerkrankungen und PCOS können diffuses Ausdünnen oder Schuppung auslösen." data-en="Pregnancy, menopause, thyroid disorders, and PCOS can trigger diffuse thinning or shedding.">Schwangerschaft, Wechseljahre, Schilddrüsenerkrankungen und PCOS können diffuses Ausdünnen oder Schuppung auslösen.</p></div>
    <div class="hp-card"><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini4" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini4)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M13 2 4 14h6l-1 8 9-12h-6z"/></g></svg></div><h4 data-de="Stress" data-en="Stress">Stress</h4><p data-de="Starker physischer oder psychischer Stress kann viele Follikel gleichzeitig in die Ruhephase drängen (telogenes Effluvium), meist reversibel." data-en="Significant physical or psychological stress can push many follicles into the resting phase at once (telogen effluvium), usually reversible.">Starker physischer oder psychischer Stress kann viele Follikel gleichzeitig in die Ruhephase drängen (telogenes Effluvium), meist reversibel.</p></div>
    <div class="hp-card"><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini5" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini5)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M12 2c4 5 7 9.6 7 13.2A7 7 0 1 1 5 15.2C5 11.6 8 7 12 2z"/></g></svg></div><h4 data-de="Ernährung &amp; Mängel" data-en="Nutrition &amp; deficiencies">Ernährung &amp; Mängel</h4><p data-de="Eisen, Vitamin D, Zink, Protein und Biotin sind für aktive Follikel essenziell. Mängel beeinträchtigen Wachstum und Qualität." data-en="Iron, vitamin D, zinc, protein, and biotin are essential for active follicles. Deficiencies impair growth and hair quality.">Eisen, Vitamin D, Zink, Protein und Biotin sind für aktive Follikel essenziell. Mängel beeinträchtigen Wachstum und Qualität.</p></div>
    <div class="hp-card"><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini6" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini6)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><rect x="7" y="3" width="10" height="6" rx="1"/><rect x="4" y="9" width="16" height="12" rx="2"/><line x1="9" y1="14" x2="15" y2="14"/></g></svg></div><h4 data-de="Medikamente" data-en="Medications">Medikamente</h4><p data-de="Blutverdünner, Chemotherapeutika, Antidepressiva, Betablocker und hormonelle Verhütung können Haarausfall als Nebenwirkung haben." data-en="Anticoagulants, chemotherapy drugs, antidepressants, beta-blockers, and hormonal contraceptives can cause hair loss as a side effect.">Blutverdünner, Chemotherapeutika, Antidepressiva, Betablocker und hormonelle Verhütung können Haarausfall als Nebenwirkung haben.</p></div>
    <div class="hp-card"><div class="hp-ico"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini7" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini7)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="12.5"/><circle cx="12" cy="16" r="0.5" fill="#fff"/></g></svg></div><h4 data-de="Erkrankungen" data-en="Medical conditions">Erkrankungen</h4><p data-de="Alopecia areata, Kopfhautinfektionen, Lupus und andere Autoimmunerkrankungen sowie Diabetes können Haarausfall verursachen." data-en="Alopecia areata, scalp infections, lupus and other autoimmune diseases, and diabetes can all cause hair loss.">Alopecia areata, Kopfhautinfektionen, Lupus und andere Autoimmunerkrankungen sowie Diabetes können Haarausfall verursachen.</p></div>
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
    <b data-de="Bildplatzhalter: Vergleichsgrafik" data-en="Image placeholder: comparison graphic">Bildplatzhalter: Vergleichsgrafik</b>
    <span data-de="Kopfumriss-Illustrationen, die die typischen Ausfallmuster jeder Art zeigen" data-en="Head-outline illustrations showing the typical shedding pattern for each type">Kopfumriss-Illustrationen, die die typischen Ausfallmuster jeder Art zeigen</span>
  </div>
  <div class="hp-grid">
    <div class="hp-card"><span class="hp-badge" data-de="Häufigste Form" data-en="Most common">Häufigste Form</span><h4 data-de="Androgenetische Alopezie" data-en="Androgenetic alopecia">Androgenetische Alopezie</h4><p data-de="Erblich bedingter Haarausfall. Bei Männern Geheimratsecken und Scheitel (Norwood-Hamilton I–VII), bei Frauen diffuse Ausdünnung des Scheitels (Ludwig I–III). Progressiv, chronisch, bessert sich nicht von selbst." data-en="Genetically inherited pattern hair loss. In men, temple recession and crown thinning (Norwood-Hamilton I–VII); in women, diffuse parting widening (Ludwig I–III). Progressive and chronic, does not resolve on its own.">Erblich bedingter Haarausfall. Bei Männern Geheimratsecken und Scheitel (Norwood-Hamilton I–VII), bei Frauen diffuse Ausdünnung des Scheitels (Ludwig I–III). Progressiv, chronisch, bessert sich nicht von selbst.</p></div>
    <div class="hp-card"><h4 data-de="Alopecia areata" data-en="Alopecia areata">Alopecia areata</h4><p data-de="Autoimmunerkrankung, bei der das Immunsystem Follikel angreift, meist runde Herde. In den meisten Fällen wächst das Haar zurück, kann aber unvorhersehbar verlaufen." data-en="An autoimmune condition where the immune system attacks follicles, usually causing round patches. In most cases the hair regrows, though it can be unpredictable.">Autoimmunerkrankung, bei der das Immunsystem Follikel angreift, meist runde Herde. In den meisten Fällen wächst das Haar zurück, kann aber unvorhersehbar verlaufen.</p></div>
    <div class="hp-card"><h4 data-de="Telogenes Effluvium" data-en="Telogen effluvium">Telogenes Effluvium</h4><p data-de="Vorübergehendes, diffuses Ausdünnen 2 bis 4 Monate nach Geburt, OP, schwerer Krankheit oder starkem Stress. Klingt meist innerhalb von 6 bis 12 Monaten ab." data-en="Temporary diffuse shedding 2 to 4 months after childbirth, surgery, severe illness, or major stress. Usually resolves within 6 to 12 months.">Vorübergehendes, diffuses Ausdünnen 2 bis 4 Monate nach Geburt, OP, schwerer Krankheit oder starkem Stress. Klingt meist innerhalb von 6 bis 12 Monaten ab.</p></div>
    <div class="hp-card"><h4 data-de="Traktionsalopezie" data-en="Traction alopecia">Traktionsalopezie</h4><p data-de="Haarausfall durch dauerhaften Zug, etwa durch enge Zöpfe, Extensions oder Pferdeschwänze. Anfangs reversibel, kann bei anhaltendem Zug dauerhaft werden." data-en="Hair loss from chronic tension, such as tight braids, extensions, or ponytails. Initially reversible, can become permanent if tension continues.">Haarausfall durch dauerhaften Zug, etwa durch enge Zöpfe, Extensions oder Pferdeschwänze. Anfangs reversibel, kann bei anhaltendem Zug dauerhaft werden.</p></div>
    <div class="hp-card"><h4 data-de="Vernarbende Alopezie" data-en="Scarring alopecia">Vernarbende Alopezie</h4><p data-de="Follikel werden zerstört und durch Narbengewebe ersetzt, dauerhafter Haarverlust. Eine Transplantation ist bei aktiver Entzündung meist nicht geeignet." data-en="Follicles are destroyed and replaced by scar tissue, causing permanent loss. Transplantation is generally unsuitable while inflammation is active.">Follikel werden zerstört und durch Narbengewebe ersetzt, dauerhafter Haarverlust. Eine Transplantation ist bei aktiver Entzündung meist nicht geeignet.</p></div>
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
    <b data-de="Bildplatzhalter: Klinikfoto" data-en="Image placeholder: clinic photo">Bildplatzhalter: Klinikfoto</b>
    <span data-de="Foto einer Trichoskopie-Untersuchung in der Apex-Klinik" data-en="Photo of a trichoscopy examination at the Apex clinic">Foto einer Trichoskopie-Untersuchung in der Apex-Klinik</span>
  </div>
  <div class="hp-grid">
    <div class="hp-card"><h4 data-de="Klinische Untersuchung" data-en="Clinical assessment">Klinische Untersuchung</h4><p data-de="Anamnese zu Beginn, Verlauf, Familiengeschichte, Medikamenten und Ernährung, gefolgt von einer körperlichen Untersuchung von Muster und Kopfhaut." data-en="History of onset, progression, family history, medications, and diet, followed by a physical exam of pattern and scalp condition.">Anamnese zu Beginn, Verlauf, Familiengeschichte, Medikamenten und Ernährung, gefolgt von einer körperlichen Untersuchung von Muster und Kopfhaut.</p></div>
    <div class="hp-card"><span class="hp-badge" data-de="Bei Apex Beauty" data-en="At Apex Beauty">Bei Apex Beauty</span><h4 data-de="Trichoskopie &amp; Scalp Mapping" data-en="Trichoscopy &amp; scalp mapping">Trichoskopie &amp; Scalp Mapping</h4><p data-de="Ein Dermatoskop vergrößert die Kopfhaut bis zu 70-fach und zeigt Follikeldichte, Miniaturisierung und Entzündung. Digitales Scalp Mapping dokumentiert Veränderungen präzise über Zeit." data-en="A dermatoscope magnifies the scalp up to 70x, revealing follicle density, miniaturization, and inflammation. Digital scalp mapping tracks changes precisely over time.">Ein Dermatoskop vergrößert die Kopfhaut bis zu 70-fach und zeigt Follikeldichte, Miniaturisierung und Entzündung. Digitales Scalp Mapping dokumentiert Veränderungen präzise über Zeit.</p></div>
    <div class="hp-card"><h4 data-de="Der Zugtest" data-en="The pull test">Der Zugtest</h4><p data-de="40 bis 60 Haare werden sanft gezogen. Lösen sich mehr als 6, deutet das auf aktiven Haarausfall hin." data-en="A bundle of 40 to 60 hairs is gently pulled. Extracting more than 6 suggests active shedding.">40 bis 60 Haare werden sanft gezogen. Lösen sich mehr als 6, deutet das auf aktiven Haarausfall hin.</p></div>
    <div class="hp-card"><h4 data-de="Bluttests" data-en="Blood tests">Bluttests</h4><p data-de="Blutbild, Eisen und Ferritin, Schilddrüsenwerte, Hormonspiegel (Testosteron, DHT), Vitamin D, Zink und Blutzucker, um zugrundeliegende Ursachen auszuschließen." data-en="Full blood count, iron and ferritin, thyroid function, hormone levels (testosterone, DHT), vitamin D, zinc, and blood sugar, to rule out underlying causes.">Blutbild, Eisen und Ferritin, Schilddrüsenwerte, Hormonspiegel (Testosteron, DHT), Vitamin D, Zink und Blutzucker, um zugrundeliegende Ursachen auszuschließen.</p></div>
    <div class="hp-card"><h4 data-de="Kopfhautbiopsie" data-en="Scalp biopsy">Kopfhautbiopsie</h4><p data-de="Bei unklaren Fällen bestätigt eine kleine Gewebeprobe unter dem Mikroskop die Art des Haarausfalls und mögliche Entzündungen." data-en="In unclear cases, a small tissue sample under the microscope confirms the type of hair loss and any inflammation.">Bei unklaren Fällen bestätigt eine kleine Gewebeprobe unter dem Mikroskop die Art des Haarausfalls und mögliche Entzündungen.</p></div>
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
    <b data-de="Bildplatzhalter: Produktfotos" data-en="Image placeholder: product photos">Bildplatzhalter: Produktfotos</b>
    <span data-de="Foto-Serie der Behandlungsoptionen: Minoxidil-Flasche, PRP-Kit, Mesotherapie-Set" data-en="Photo series of treatment options: minoxidil bottle, PRP kit, mesotherapy set">Foto-Serie der Behandlungsoptionen: Minoxidil-Flasche, PRP-Kit, Mesotherapie-Set</span>
  </div>
  <div class="hp-grid">
    <div class="hp-card"><h4 data-de="Minoxidil" data-en="Minoxidil">Minoxidil</h4><p data-de="Topisch oder oral. Verlängert die Anagen-Phase und verbessert die Durchblutung. Blockiert kein DHT. Wirkung sichtbar nach 4 bis 6 Monaten, hält nur bei fortgesetzter Anwendung." data-en="Topical or oral. Extends the anagen phase and improves blood flow. Doesn't block DHT. Visible after 4 to 6 months, only lasts with continued use.">Topisch oder oral. Verlängert die Anagen-Phase und verbessert die Durchblutung. Blockiert kein DHT. Wirkung sichtbar nach 4 bis 6 Monaten, hält nur bei fortgesetzter Anwendung.</p></div>
    <div class="hp-card"><h4 data-de="Finasterid" data-en="Finasteride">Finasterid</h4><p data-de="Orales Medikament, senkt DHT in der Kopfhaut um rund 70%. Stoppt den Haarausfall bei rund 90% der Männer, fördert Regrowth bei rund 65%." data-en="Oral medication, reduces scalp DHT by around 70%. Stops hair loss in around 90% of men, promotes regrowth in around 65%.">Orales Medikament, senkt DHT in der Kopfhaut um rund 70%. Stoppt den Haarausfall bei rund 90% der Männer, fördert Regrowth bei rund 65%.</p></div>
    <div class="hp-card"><h4 data-de="Dutasterid" data-en="Dutasteride">Dutasterid</h4><p data-de="Stärkere Alternative zu Finasterid, senkt DHT um rund 90%. Off-Label unter ärztlicher Aufsicht, besonders wirksam am Oberkopf." data-en="A more potent alternative to finasteride, reduces DHT by around 90%. Used off-label under medical supervision, particularly effective at the crown.">Stärkere Alternative zu Finasterid, senkt DHT um rund 90%. Off-Label unter ärztlicher Aufsicht, besonders wirksam am Oberkopf.</p></div>
    <div class="hp-card"><h4 data-de="PRP" data-en="PRP">PRP</h4><p data-de="Plättchenreiches Plasma aus dem eigenen Blut wird in die Kopfhaut injiziert und regt die Follikelaktivität an. Meist als Ergänzung, Sitzungen alle 3 bis 6 Monate." data-en="Platelet-rich plasma from the patient's own blood is injected into the scalp to stimulate follicle activity. Usually a complement, sessions every 3 to 6 months.">Plättchenreiches Plasma aus dem eigenen Blut wird in die Kopfhaut injiziert und regt die Follikelaktivität an. Meist als Ergänzung, Sitzungen alle 3 bis 6 Monate.</p></div>
    <div class="hp-card"><span class="hp-badge" data-de="Experimentell" data-en="Experimental">Experimentell</span><h4 data-de="Exosomen" data-en="Exosomes">Exosomen</h4><p data-de="Aus Stammzellen gewonnene Vesikel mit Wachstumssignalen, per Microneedling oder Injektion angewendet. Vielversprechend, aber noch begrenzte Langzeitdaten." data-en="Stem cell-derived vesicles carrying growth signals, applied via micro-needling or injection. Promising, but long-term data is still limited.">Aus Stammzellen gewonnene Vesikel mit Wachstumssignalen, per Microneedling oder Injektion angewendet. Vielversprechend, aber noch begrenzte Langzeitdaten.</p></div>
    <div class="hp-card"><h4 data-de="Mesotherapie" data-en="Mesotherapy">Mesotherapie</h4><p data-de="Mikroinjektionen aus Vitaminen, Mineralien und Wachstumsfaktoren zur Unterstützung der Kopfhautgesundheit. Meist begleitend zu anderen Behandlungen." data-en="Micro-injections of vitamins, minerals, and growth factors to support scalp health. Usually combined with other treatments.">Mikroinjektionen aus Vitaminen, Mineralien und Wachstumsfaktoren zur Unterstützung der Kopfhautgesundheit. Meist begleitend zu anderen Behandlungen.</p></div>
    <div class="hp-card"><span class="hp-badge" data-de="Einzig dauerhafte Lösung" data-en="Only permanent option">Einzig dauerhafte Lösung</span><h4 data-de="Haartransplantation" data-en="Hair transplantation">Haartransplantation</h4><p data-de="Die einzige Behandlung, die dauerhaft Haare in kahle oder ausgedünnte Bereiche zurückbringt. Gesunde Follikel aus dem DHT-resistenten Spenderbereich werden verpflanzt." data-en="The only treatment that permanently restores hair to bald or thinning areas. Healthy follicles from the DHT-resistant donor zone are relocated.">Die einzige Behandlung, die dauerhaft Haare in kahle oder ausgedünnte Bereiche zurückbringt. Gesunde Follikel aus dem DHT-resistenten Spenderbereich werden verpflanzt.</p></div>
  </div>
</section>

<section class="hp-section alt" id="transplantation">
  <div class="hp-section-in">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gGraft" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gGraft)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M22 46c-1-8 1-15 4-19M32 46c0-9 0-16 0-20M42 46c1-8-1-15-4-19" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round"/><circle cx="22" cy="48" r="2.4" fill="#fff"/><circle cx="32" cy="48" r="2.4" fill="#fff"/><circle cx="42" cy="48" r="2.4" fill="#fff"/></svg>
    <div>
      <h2 data-ckey="transplantation.heading" data-de="Haartransplantation" data-en="Hair transplantation">Haartransplantation</h2>
      <p data-ckey="transplantation.body" data-de="Ein chirurgischer Eingriff unter örtlicher Betäubung. Gesunde, DHT-resistente Follikel werden aus dem Spenderbereich entnommen und in ausgedünnte Areale verpflanzt, wo sie dauerhaft weiterwachsen." data-en="A surgical procedure under local anaesthesia. Healthy, DHT-resistant follicles are taken from the donor area and relocated to thinning areas, where they keep growing for life.">Ein chirurgischer Eingriff unter örtlicher Betäubung. Gesunde, DHT-resistente Follikel werden aus dem Spenderbereich entnommen und in ausgedünnte Areale verpflanzt, wo sie dauerhaft weiterwachsen.</p>
    </div>
  </div>
  <div class="hp-media" data-cmedia-wrap>
    <img class="hp-media-img" data-cmedia="transplantation.image" alt="">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
    <b data-de="Bildplatzhalter: Technik-Diagramm" data-en="Image placeholder: technique diagram">Bildplatzhalter: Technik-Diagramm</b>
    <span data-de="Schnittdarstellung von FUE, Saphir-FUE und DHI im direkten Vergleich" data-en="Cross-section illustration comparing FUE, Sapphire FUE, and DHI">Schnittdarstellung von FUE, Saphir-FUE und DHI im direkten Vergleich</span>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Wer ist geeignet?" data-en="Who is a suitable candidate?">Wer ist geeignet?</h3>
  <div class="hp-checklist" style="margin-bottom:40px">
    <div class="hp-check"><span class="tick">✓</span><p data-de="Androgenetische Alopezie in einer stabilen Phase (der Ausfall hat sich verlangsamt oder stabilisiert)." data-en="Androgenetic alopecia in a stable phase (loss has slowed or stabilised).">Androgenetische Alopezie in einer stabilen Phase (der Ausfall hat sich verlangsamt oder stabilisiert).</p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-de="Ausreichende Spenderdichte an Hinterkopf und Seiten." data-en="Adequate donor density at the back and sides of the scalp.">Ausreichende Spenderdichte an Hinterkopf und Seiten.</p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-de="Realistische Erwartungen: eine Transplantation stellt Dichte wieder her, repliziert aber nicht die volle Haarfülle der Jugend." data-en="Realistic expectations: a transplant restores density but cannot replicate the full hair of early youth.">Realistische Erwartungen: eine Transplantation stellt Dichte wieder her, repliziert aber nicht die volle Haarfülle der Jugend.</p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-de="Guter allgemeiner Gesundheitszustand, keine aktiven Infektionen oder unbehandelten Autoimmunerkrankungen." data-en="Good general health, no active infections or untreated autoimmune conditions.">Guter allgemeiner Gesundheitszustand, keine aktiven Infektionen oder unbehandelten Autoimmunerkrankungen.</p></div>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Die drei wichtigsten Techniken" data-en="The three main techniques">Die drei wichtigsten Techniken</h3>
  <div class="hp-grid" style="margin-bottom:32px">
    <div class="hp-card"><h4 data-de="FUE" data-en="FUE">FUE</h4><p data-de="Follikuläre Einheiten (1 bis 4 Haare) werden einzeln mit einem Mikro-Punch-Werkzeug entnommen. Kein linearer Schnitt, keine sichtbare Narbe. 5 bis 8 Stunden je nach Graft-Anzahl." data-en="Follicular units (1 to 4 hairs) are extracted one by one with a micro-punch tool. No linear incision, no visible scar. 5 to 8 hours depending on graft count.">Follikuläre Einheiten (1 bis 4 Haare) werden einzeln mit einem Mikro-Punch-Werkzeug entnommen. Kein linearer Schnitt, keine sichtbare Narbe. 5 bis 8 Stunden je nach Graft-Anzahl.</p></div>
    <div class="hp-card"><span class="hp-badge" data-de="Meistgenutzt in Istanbul" data-en="Most used in Istanbul">Meistgenutzt in Istanbul</span><h4 data-de="Saphir-FUE" data-en="Sapphire FUE">Saphir-FUE</h4><p data-de="Kanäle werden mit Saphirklingen statt Stahl geöffnet: kleinere, präzisere Schnitte, schnellere Heilung, höhere Dichte pro cm² und geringeres Risiko für Verkrustung." data-en="Channels are opened with sapphire blades instead of steel: smaller, more precise incisions, faster healing, higher density per cm², and lower risk of scabbing.">Kanäle werden mit Saphirklingen statt Stahl geöffnet: kleinere, präzisere Schnitte, schnellere Heilung, höhere Dichte pro cm² und geringeres Risiko für Verkrustung.</p></div>
    <div class="hp-card"><h4 data-de="DHI" data-en="DHI">DHI</h4><p data-de="Follikel werden mit einem Choi Implanter Pen direkt implantiert, ohne separate Kanaleröffnung. Präzise Kontrolle über Winkel und Tiefe, ideal für den Haaransatz." data-en="Follicles are implanted directly using a Choi Implanter Pen, without opening separate channels first. Precise control over angle and depth, ideal for the hairline.">Follikel werden mit einem Choi Implanter Pen direkt implantiert, ohne separate Kanaleröffnung. Präzise Kontrolle über Winkel und Tiefe, ideal für den Haaransatz.</p></div>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Saphir-FUE oder DHI: der Vergleich" data-en="Sapphire FUE vs. DHI: the comparison">Saphir-FUE oder DHI: der Vergleich</h3>
  <div class="hp-table-wrap" style="margin-bottom:32px">
    <table class="hp-table">
      <tr><th data-de="Faktor" data-en="Factor">Faktor</th><th data-de="Saphir-FUE" data-en="Sapphire FUE">Saphir-FUE</th><th data-de="DHI" data-en="DHI">DHI</th></tr>
      <tr><td data-de="Am besten für" data-en="Best for">Am besten für</td><td data-de="Große Flächen, hohe Graft-Zahlen" data-en="Large areas, high graft counts">Große Flächen, hohe Graft-Zahlen</td><td data-de="Haaransatz, hohe Detailtreue, kleinere Flächen" data-en="Frontal hairline, high detail, smaller areas">Haaransatz, hohe Detailtreue, kleinere Flächen</td></tr>
      <tr><td data-de="Heilung" data-en="Healing">Heilung</td><td data-de="Schnell (kleinere Schnitte)" data-en="Fast (smaller incisions)">Schnell (kleinere Schnitte)</td><td data-de="Moderat (mehr Werkzeugdurchgänge)" data-en="Moderate (more tool passes)">Moderat (mehr Werkzeugdurchgänge)</td></tr>
      <tr><td data-de="Präzision" data-en="Precision">Präzision</td><td data-de="Hoch" data-en="High">Hoch</td><td data-de="Sehr hoch (Winkel- und Tiefenkontrolle)" data-en="Very high (angle and depth control)">Sehr hoch (Winkel- und Tiefenkontrolle)</td></tr>
      <tr><td data-de="Typische Sitzungsdauer" data-en="Typical session length">Typische Sitzungsdauer</td><td data-de="5 bis 8 Stunden" data-en="5 to 8 hours">5 bis 8 Stunden</td><td data-de="6 bis 10 Stunden" data-en="6 to 10 hours">6 bis 10 Stunden</td></tr>
      <tr><td data-de="Relative Kosten" data-en="Relative cost">Relative Kosten</td><td data-de="Moderat" data-en="Moderate">Moderat</td><td data-de="Höher" data-en="Higher">Höher</td></tr>
      <tr><td data-de="Kombinierbar?" data-en="Can be combined?">Kombinierbar?</td><td data-de="Ja" data-en="Yes">Ja</td><td data-de="Ja, DHI für Ansatz + Saphir-FUE für Oberkopf ist gängig" data-en="Yes, DHI for hairline + Sapphire FUE for crown is common">Ja, DHI für Ansatz + Saphir-FUE für Oberkopf ist gängig</td></tr>
    </table>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Realistische Erwartungen" data-en="Realistic expectations">Realistische Erwartungen</h3>
  <div class="hp-checklist">
    <div class="hp-check"><span class="tick">i</span><p data-de="Eine Transplantation verschiebt vorhandene gesunde Follikel, sie erschafft keine neuen. Das Ergebnis ist durch den verfügbaren Spenderbereich begrenzt." data-en="A transplant relocates existing healthy follicles; it cannot create new ones. The result is limited by the available donor area.">Eine Transplantation verschiebt vorhandene gesunde Follikel, sie erschafft keine neuen. Das Ergebnis ist durch den verfügbaren Spenderbereich begrenzt.</p></div>
    <div class="hp-check"><span class="tick">i</span><p data-de="Transplantiertes Haar wächst lebenslang, da es aus DHT-resistenten Zonen stammt." data-en="Transplanted hair grows for life because it's taken from DHT-resistant zones.">Transplantiertes Haar wächst lebenslang, da es aus DHT-resistenten Zonen stammt.</p></div>
    <div class="hp-check"><span class="tick">i</span><p data-de="Das vollständige Ergebnis zeigt sich erst nach 12 bis 18 Monaten, nicht sofort." data-en="Full results are visible at 12 to 18 months, not immediately.">Das vollständige Ergebnis zeigt sich erst nach 12 bis 18 Monaten, nicht sofort.</p></div>
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
    <b data-de="Bildplatzhalter: Foto-Zeitstrahl" data-en="Image placeholder: photo timeline">Bildplatzhalter: Foto-Zeitstrahl</b>
    <span data-de="Patientenfotos von Tag 1 bis Monat 18, mit Einwilligung, den Heilungsverlauf zeigend" data-en="Patient photos from day 1 to month 18, with consent, showing the healing progression">Patientenfotos von Tag 1 bis Monat 18, mit Einwilligung, den Heilungsverlauf zeigend</span>
  </div>

  <div class="hp-timeline" style="margin-bottom:44px">
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Tag 1 bis 7" data-en="Day 1 to 7">Tag 1 bis 7</div><h4 data-de="Erste Heilung" data-en="Initial healing">Erste Heilung</h4><p data-de="Kleine Krusten bilden sich, Rötung und leichte Schwellung um Stirn und Augen sind normal. Kopf erhöht schlafen, Kopfhaut nicht berühren." data-en="Small scabs form, redness and mild swelling around the forehead and eyes is common. Sleep with the head elevated, avoid touching the scalp.">Kleine Krusten bilden sich, Rötung und leichte Schwellung um Stirn und Augen sind normal. Kopf erhöht schlafen, Kopfhaut nicht berühren.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Woche 2 bis 4" data-en="Weeks 2 to 4">Woche 2 bis 4</div><h4 data-de="Schock-Verlust" data-en="Shock loss">Schock-Verlust</h4><p data-de="Bis zu 90% der transplantierten Haarschäfte fallen aus. Das ist völlig normal, die Follikel selbst bleiben unter der Kopfhaut aktiv." data-en="Up to 90% of transplanted hair shafts shed. This is completely normal; the follicles themselves remain alive beneath the scalp.">Bis zu 90% der transplantierten Haarschäfte fallen aus. Das ist völlig normal, die Follikel selbst bleiben unter der Kopfhaut aktiv.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 2 bis 3" data-en="Months 2 to 3">Monat 2 bis 3</div><h4 data-de="Die ruhige Phase" data-en="The quiet phase">Die ruhige Phase</h4><p data-de="Kaum sichtbares Wachstum, die Follikel ruhen. Erste feine Haare können ab Woche 10 bis 12 erscheinen." data-en="Little visible growth, follicles are resting. First fine hairs may emerge around week 10 to 12.">Kaum sichtbares Wachstum, die Follikel ruhen. Erste feine Haare können ab Woche 10 bis 12 erscheinen.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 3 bis 6" data-en="Months 3 to 6">Monat 3 bis 6</div><h4 data-de="Sichtbares Wachstum beginnt" data-en="Visible growth begins">Sichtbares Wachstum beginnt</h4><p data-de="Feine neue Haare erscheinen und verdicken sich allmählich. Bis Monat 6 sind rund 40 bis 60% des Endergebnisses sichtbar." data-en="Fine new hairs emerge and gradually thicken. By month 6, around 40 to 60% of the final result is visible.">Feine neue Haare erscheinen und verdicken sich allmählich. Bis Monat 6 sind rund 40 bis 60% des Endergebnisses sichtbar.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 6 bis 9" data-en="Months 6 to 9">Monat 6 bis 9</div><h4 data-de="Die Dichte verbessert sich" data-en="Density improves">Die Dichte verbessert sich</h4><p data-de="Das Haar wird spürbar dicker und dunkler. Rund 80% der Grafts sind zu diesem Zeitpunkt durchgebrochen." data-en="Hair becomes noticeably thicker and darker. Around 80% of grafts have broken through by this point.">Das Haar wird spürbar dicker und dunkler. Rund 80% der Grafts sind zu diesem Zeitpunkt durchgebrochen.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 12 bis 18" data-en="Months 12 to 18">Monat 12 bis 18</div><h4 data-de="Endgültige Verfeinerung" data-en="Final refinement">Endgültige Verfeinerung</h4><p data-de="Die letzten Haare reifen und verdicken sich. Das transplantierte Haar verschmilzt vollständig mit dem natürlichen Haar." data-en="The last hairs mature and thicken. Transplanted hair fully blends with native hair.">Die letzten Haare reifen und verdicken sich. Das transplantierte Haar verschmilzt vollständig mit dem natürlichen Haar.</p></div></div>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Die wichtigsten Nachsorgeregeln" data-en="Key aftercare rules">Die wichtigsten Nachsorgeregeln</h3>
  <div class="hp-rules">
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini8" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini8)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.2" y1="4.2" x2="5.6" y2="5.6"/><line x1="18.4" y1="18.4" x2="19.8" y2="19.8"/></g></svg></span><span data-de="Keine direkte Sonne auf der Kopfhaut für mindestens 4 Wochen." data-en="No direct sun exposure on the scalp for at least 4 weeks.">Keine direkte Sonne auf der Kopfhaut für mindestens 4 Wochen.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini9" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini9)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M2 16c2-2 4 2 6 0s4 2 6 0 4 2 6 0M2 20c2-2 4 2 6 0s4 2 6 0 4 2 6 0"/></g></svg></span><span data-de="Kein Schwimmen (Pool, Meer, See) für mindestens 4 Wochen." data-en="No swimming (pool, sea, or lake) for at least 4 weeks.">Kein Schwimmen (Pool, Meer, See) für mindestens 4 Wochen.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini10" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini10)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M13 2 4 14h6l-1 8 9-12h-6z"/></g></svg></span><span data-de="Kein intensiver Sport oder starkes Schwitzen für 2 bis 3 Wochen." data-en="No intense exercise or heavy sweating for 2 to 3 weeks.">Kein intensiver Sport oder starkes Schwitzen für 2 bis 3 Wochen.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini11" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini11)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M8 2v4M16 2v4M5 8h14v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2z"/></g></svg></span><span data-de="Kein Alkohol in der ersten Woche, er beeinträchtigt die Durchblutung." data-en="No alcohol for the first week; it affects blood circulation.">Kein Alkohol in der ersten Woche, er beeinträchtigt die Durchblutung.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini12" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini12)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M9 12a3 3 0 1 1 6 0c0 2-3 2-3 5"/><line x1="12" y1="20" x2="12" y2="20.01"/></g></svg></span><span data-de="Nicht rauchen: Nikotin verengt die Blutgefäße und senkt die Graft-Überlebensrate." data-en="No smoking: nicotine restricts blood supply and reduces graft survival.">Nicht rauchen: Nikotin verengt die Blutgefäße und senkt die Graft-Überlebensrate.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini13" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini13)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M3 8h11l4 4v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="9" cy="14" r="2"/></g></svg></span><span data-de="Kopf erhöht schlafen für die ersten 3 bis 5 Nächte." data-en="Sleep with the head elevated for the first 3 to 5 nights.">Kopf erhöht schlafen für die ersten 3 bis 5 Nächte.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini14" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini14)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M7 21c-2-3 0-5 0-8 0-4-3-5-3-9 4 0 7 2 7 6M17 21c2-3 0-5 0-8 0-4 3-5 3-9-4 0-7 2-7 6"/></g></svg></span><span data-de="Sanft waschen nach Klinikanleitung, keinen starken Wasserstrahl direkt auf die Grafts." data-en="Wash gently per the clinic's instructions; no strong water pressure directly on the grafts.">Sanft waschen nach Klinikanleitung, keinen starken Wasserstrahl direkt auf die Grafts.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini15" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini15)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><line x1="20" y1="4" x2="8.12" y2="15.88"/><line x1="14.47" y1="14.48" x2="20" y2="20"/><line x1="8.12" y1="8.12" x2="12" y2="12"/></g></svg></span><span data-de="Haare im ersten Monat nicht aggressiv schneiden, färben oder stylen." data-en="Don't cut, colour, or style hair aggressively in the first month.">Haare im ersten Monat nicht aggressiv schneiden, färben oder stylen.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini16" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini16)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2"/><line x1="9" y1="9" x2="15" y2="9"/><line x1="9" y1="13" x2="15" y2="13"/></g></svg></span><span data-de="Verschriebene Medikamente wie Finasterid oder Minoxidil wie angeordnet fortsetzen." data-en="Continue prescribed medications like finasteride or minoxidil as directed.">Verschriebene Medikamente wie Finasterid oder Minoxidil wie angeordnet fortsetzen.</span></div>
    <div class="hp-rule"><span class="ric"><svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gMini17" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="36" height="36" rx="11" fill="url(#gMini17)"/><ellipse cx="12" cy="10" rx="11" ry="6" fill="#fff" opacity="0.18"/><g transform="translate(6,6) scale(0.75)" stroke="#fff" fill="none" stroke-width="2"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .3 2 .6 3a2 2 0 0 1-.5 2L7.9 10a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2-.5c1 .3 2 .5 3 .6a2 2 0 0 1 1.8 2z"/></g></svg></span><span data-de="Alle Folgetermine wahrnehmen, manche Kliniken bieten Remote-Check-ins an." data-en="Attend all follow-up appointments; some clinics offer remote check-ins.">Alle Folgetermine wahrnehmen, manche Kliniken bieten Remote-Check-ins an.</span></div>
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
    <b data-de="Bildplatzhalter: Vorher-Nachher-Galerie" data-en="Image placeholder: before/after gallery">Bildplatzhalter: Vorher-Nachher-Galerie</b>
    <span data-de="Echte Apex-Patientenfotos im Split-Vergleich, mit schriftlicher Einwilligung" data-en="Real Apex patient photos in a split comparison view, with written consent">Echte Apex-Patientenfotos im Split-Vergleich, mit schriftlicher Einwilligung</span>
  </div>
  <div class="hp-timeline">
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Tag 1 bis 7" data-en="Day 1 to 7">Tag 1 bis 7</div><h4 data-de="Grafts setzen sich, Blutversorgung baut sich wieder auf" data-en="Grafts settling, blood supply re-establishing">Grafts setzen sich, Blutversorgung baut sich wieder auf</h4><p class="hp-tl-see" data-de="Sichtbar: Rötung, kleine Krusten, leichte Schwellung" data-en="What you see: redness, small scabs, mild swelling">Sichtbar: Rötung, kleine Krusten, leichte Schwellung</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Woche 2 bis 4" data-en="Weeks 2 to 4">Woche 2 bis 4</div><h4 data-de="Follikel treten in die Telogen-Phase ein, Schock-Verlust" data-en="Follicles enter telogen, shock loss occurs">Follikel treten in die Telogen-Phase ein, Schock-Verlust</h4><p class="hp-tl-see" data-de="Sichtbar: transplantiertes Haar fällt aus, das ist normal" data-en="What you see: transplanted hair sheds, this is normal">Sichtbar: transplantiertes Haar fällt aus, das ist normal</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 2 bis 3" data-en="Month 2 to 3">Monat 2 bis 3</div><h4 data-de="Follikel in Ruhephase, neuer Zyklus bereitet sich vor" data-en="Follicles resting, new cycle preparing">Follikel in Ruhephase, neuer Zyklus bereitet sich vor</h4><p class="hp-tl-see" data-de="Sichtbar: kaum Veränderung, Kopfhaut wirkt ruhig" data-en="What you see: little visible change, scalp appears calm">Sichtbar: kaum Veränderung, Kopfhaut wirkt ruhig</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 3 bis 5" data-en="Month 3 to 5">Monat 3 bis 5</div><h4 data-de="Neue Anagen-Phase beginnt, erste Haare erscheinen" data-en="New anagen phase begins, first hairs emerge">Neue Anagen-Phase beginnt, erste Haare erscheinen</h4><p class="hp-tl-see" data-de="Sichtbar: feine, helle Haare, rund 20% Fortschritt" data-en="What you see: fine, light hairs, around 20% progress">Sichtbar: feine, helle Haare, rund 20% Fortschritt</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 5 bis 7" data-en="Month 5 to 7">Monat 5 bis 7</div><h4 data-de="Haarschaft verdickt sich, wird dunkler und länger" data-en="Hair shaft thickens, darkens, lengthens">Haarschaft verdickt sich, wird dunkler und länger</h4><p class="hp-tl-see" data-de="Sichtbar: rund 50% der Enddichte" data-en="What you see: around 50% of final density">Sichtbar: rund 50% der Enddichte</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 7 bis 9" data-en="Month 7 to 9">Monat 7 bis 9</div><h4 data-de="Dichte, Deckung und Textur verbessern sich weiter" data-en="Density, coverage, and texture keep improving">Dichte, Deckung und Textur verbessern sich weiter</h4><p class="hp-tl-see" data-de="Sichtbar: rund 70 bis 80% des Endergebnisses" data-en="What you see: around 70 to 80% of the final result">Sichtbar: rund 70 bis 80% des Endergebnisses</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 10 bis 12" data-en="Month 10 to 12">Monat 10 bis 12</div><h4 data-de="Die meisten Grafts sind ausgereift, Endergebnis formt sich" data-en="Most grafts mature, final result forming">Die meisten Grafts sind ausgereift, Endergebnis formt sich</h4><p class="hp-tl-see" data-de="Sichtbar: nahezu finales Erscheinungsbild, natürliche Verschmelzung" data-en="What you see: near-final appearance, natural blending">Sichtbar: nahezu finales Erscheinungsbild, natürliche Verschmelzung</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 12 bis 18" data-en="Month 12 to 18">Monat 12 bis 18</div><h4 data-de="Letzte Haare reifen, volle Integration mit dem natürlichen Haar" data-en="Last hairs mature, full integration with native hair">Letzte Haare reifen, volle Integration mit dem natürlichen Haar</h4><p class="hp-tl-see" data-de="Sichtbar: Endergebnis, natürlich und nicht mehr zu unterscheiden" data-en="What you see: final result, natural and indistinguishable">Sichtbar: Endergebnis, natürlich und nicht mehr zu unterscheiden</p></div></div>
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
    <div class="hp-term"><b data-de="Alopezie" data-en="Alopecia">Alopezie</b><span data-de="Der medizinische Begriff für Haarausfall, unabhängig von der Ursache." data-en="The medical term for hair loss, from any cause.">Der medizinische Begriff für Haarausfall, unabhängig von der Ursache.</span></div>
    <div class="hp-term"><b data-de="Anagen" data-en="Anagen">Anagen</b><span data-de="Die aktive Wachstumsphase des Haarzyklus, dauert 2 bis 7 Jahre." data-en="The active growth phase of the hair cycle, lasting 2 to 7 years.">Die aktive Wachstumsphase des Haarzyklus, dauert 2 bis 7 Jahre.</span></div>
    <div class="hp-term"><b data-de="Androgenetische Alopezie" data-en="Androgenetic alopecia">Androgenetische Alopezie</b><span data-de="Erblich bedingter, durch DHT beeinflusster Haarausfall. Die häufigste Form bei Männern und Frauen." data-en="Genetically inherited pattern hair loss influenced by DHT. The most common form in both men and women.">Erblich bedingter, durch DHT beeinflusster Haarausfall. Die häufigste Form bei Männern und Frauen.</span></div>
    <div class="hp-term"><b data-de="Katagen" data-en="Catagen">Katagen</b><span data-de="Die kurze Übergangsphase, rund 2 bis 3 Wochen, in der der Follikel schrumpft und das Wachstum stoppt." data-en="The short transitional phase, lasting about 2 to 3 weeks, during which the follicle shrinks and growth stops.">Die kurze Übergangsphase, rund 2 bis 3 Wochen, in der der Follikel schrumpft und das Wachstum stoppt.</span></div>
    <div class="hp-term"><b data-de="DHI" data-en="DHI">DHI</b><span data-de="Direkte Haarimplantation. Technik mit einem Choi Implanter Pen, der Follikel in einem Schritt entnimmt und implantiert." data-en="Direct Hair Implantation. A technique using a Choi Implanter Pen to extract and implant follicles in a single step.">Direkte Haarimplantation. Technik mit einem Choi Implanter Pen, der Follikel in einem Schritt entnimmt und implantiert.</span></div>
    <div class="hp-term"><b data-de="DHT (Dihydrotestosteron)" data-en="DHT (Dihydrotestosterone)">DHT (Dihydrotestosteron)</b><span data-de="Ein starkes Hormon aus Testosteron, der Haupttreiber der androgenetischen Alopezie bei genetisch empfindlichen Personen." data-en="A potent hormone derived from testosterone, the primary driver of androgenetic alopecia in genetically sensitive individuals.">Ein starkes Hormon aus Testosteron, der Haupttreiber der androgenetischen Alopezie bei genetisch empfindlichen Personen.</span></div>
    <div class="hp-term"><b data-de="Spenderbereich" data-en="Donor area">Spenderbereich</b><span data-de="Der Bereich der Kopfhaut, meist Hinterkopf und Seiten, aus dem DHT-resistente Follikel entnommen werden." data-en="The part of the scalp, typically the back and sides, from which DHT-resistant follicles are harvested.">Der Bereich der Kopfhaut, meist Hinterkopf und Seiten, aus dem DHT-resistente Follikel entnommen werden.</span></div>
    <div class="hp-term"><b data-de="Exosomen" data-en="Exosomes">Exosomen</b><span data-de="Winzige, aus Stammzellen gewonnene Vesikel mit Wachstumssignalen, experimentell zur Follikelregeneration eingesetzt." data-en="Tiny stem cell-derived vesicles containing growth signals, used experimentally to stimulate follicle regeneration.">Winzige, aus Stammzellen gewonnene Vesikel mit Wachstumssignalen, experimentell zur Follikelregeneration eingesetzt.</span></div>
    <div class="hp-term"><b data-de="5-Alpha-Reduktase" data-en="5-alpha reductase">5-Alpha-Reduktase</b><span data-de="Das Enzym, das Testosteron in DHT umwandelt. Wird durch Finasterid und Dutasterid gehemmt." data-en="The enzyme responsible for converting testosterone into DHT. Inhibited by finasteride and dutasteride.">Das Enzym, das Testosteron in DHT umwandelt. Wird durch Finasterid und Dutasterid gehemmt.</span></div>
    <div class="hp-term"><b data-de="Finasterid" data-en="Finasteride">Finasterid</b><span data-de="Orales Medikament, senkt DHT in der Kopfhaut um rund 70%, indem es Typ-II-5-Alpha-Reduktase blockiert." data-en="An oral medication that reduces scalp DHT by around 70% by blocking type II 5-alpha reductase.">Orales Medikament, senkt DHT in der Kopfhaut um rund 70%, indem es Typ-II-5-Alpha-Reduktase blockiert.</span></div>
    <div class="hp-term"><b data-de="Follikuläre Einheit" data-en="Follicular unit">Follikuläre Einheit</b><span data-de="Eine natürliche Gruppierung von 1 bis 4 Haaren. Bei der Transplantation werden ganze Einheiten verpflanzt." data-en="A natural grouping of 1 to 4 hairs. Transplantation moves whole follicular units.">Eine natürliche Gruppierung von 1 bis 4 Haaren. Bei der Transplantation werden ganze Einheiten verpflanzt.</span></div>
    <div class="hp-term"><b data-de="FUE" data-en="FUE">FUE</b><span data-de="Follikuläre Einheiten-Extraktion. Einzelne Follikel werden mit einem Mikro-Punch entnommen, ohne lineare Narbe." data-en="Follicular Unit Extraction. Individual units are extracted one by one with a micro-punch tool, leaving no linear scar.">Follikuläre Einheiten-Extraktion. Einzelne Follikel werden mit einem Mikro-Punch entnommen, ohne lineare Narbe.</span></div>
    <div class="hp-term"><b data-de="FUT" data-en="FUT">FUT</b><span data-de="Ältere Streifenmethode: ein Hautstreifen wird entnommen und in Einheiten geteilt. Hinterlässt eine lineare Narbe." data-en="An older strip technique: a strip of scalp is removed and divided into units. Leaves a linear scar.">Ältere Streifenmethode: ein Hautstreifen wird entnommen und in Einheiten geteilt. Hinterlässt eine lineare Narbe.</span></div>
    <div class="hp-term"><b data-de="Graft" data-en="Graft">Graft</b><span data-de="Eine bei der Transplantation verwendete follikuläre Einheit, üblicherweise 1 bis 4 Haare." data-en="A follicular unit used in transplantation, typically containing 1 to 4 hairs.">Eine bei der Transplantation verwendete follikuläre Einheit, üblicherweise 1 bis 4 Haare.</span></div>
    <div class="hp-term"><b data-de="Ludwig-Skala" data-en="Ludwig scale">Ludwig-Skala</b><span data-de="Klassifikation für weiblichen Haarausfall, Grad I bis III nach Ausmaß der zentralen Ausdünnung." data-en="A classification system for female pattern hair loss, graded I to III based on central thinning.">Klassifikation für weiblichen Haarausfall, Grad I bis III nach Ausmaß der zentralen Ausdünnung.</span></div>
    <div class="hp-term"><b data-de="Mesotherapie" data-en="Mesotherapy">Mesotherapie</b><span data-de="Mikroinjektionen aus Vitaminen, Mineralien und Wachstumsfaktoren zur Unterstützung der Follikelgesundheit." data-en="Micro-injections of vitamins, minerals, and growth factors to support follicle health.">Mikroinjektionen aus Vitaminen, Mineralien und Wachstumsfaktoren zur Unterstützung der Follikelgesundheit.</span></div>
    <div class="hp-term"><b data-de="Miniaturisierung" data-en="Miniaturisation">Miniaturisierung</b><span data-de="Das fortschreitende Schrumpfen der Follikel durch DHT, bis der Follikel schließlich ruht." data-en="The progressive shrinking of follicles caused by DHT, until the follicle becomes dormant.">Das fortschreitende Schrumpfen der Follikel durch DHT, bis der Follikel schließlich ruht.</span></div>
    <div class="hp-term"><b data-de="Minoxidil" data-en="Minoxidil">Minoxidil</b><span data-de="Topisches oder orales Mittel, das die Anagen-Phase verlängert und die Durchblutung verbessert. Blockiert kein DHT." data-en="A topical or oral medication that extends the anagen phase and improves blood flow. Doesn't block DHT.">Topisches oder orales Mittel, das die Anagen-Phase verlängert und die Durchblutung verbessert. Blockiert kein DHT.</span></div>
    <div class="hp-term"><b data-de="Norwood-Hamilton-Skala" data-en="Norwood-Hamilton scale">Norwood-Hamilton-Skala</b><span data-de="Klassifikation für männlichen Haarausfall, Grad I bis VII nach Muster und Ausmaß." data-en="A classification system for male pattern baldness, graded I to VII based on pattern and extent.">Klassifikation für männlichen Haarausfall, Grad I bis VII nach Muster und Ausmaß.</span></div>
    <div class="hp-term"><b data-de="PRP" data-en="PRP">PRP</b><span data-de="Plättchenreiches Plasma. Eigenes Blut wird zentrifugiert und in die Kopfhaut injiziert, um Follikelaktivität anzuregen." data-en="Platelet-Rich Plasma. The patient's own blood is centrifuged and injected into the scalp to stimulate follicle activity.">Plättchenreiches Plasma. Eigenes Blut wird zentrifugiert und in die Kopfhaut injiziert, um Follikelaktivität anzuregen.</span></div>
    <div class="hp-term"><b data-de="Empfängerbereich" data-en="Recipient area">Empfängerbereich</b><span data-de="Der ausgedünnte oder kahle Bereich der Kopfhaut, in den Grafts transplantiert werden." data-en="The thinning or bald area of the scalp into which grafts are transplanted.">Der ausgedünnte oder kahle Bereich der Kopfhaut, in den Grafts transplantiert werden.</span></div>
    <div class="hp-term"><b data-de="Saphir-FUE" data-en="Sapphire FUE">Saphir-FUE</b><span data-de="Fortgeschrittene FUE-Variante mit Saphirklingen für kleinere, präzisere Kanäle und schnellere Heilung." data-en="An advanced version of FUE using sapphire blades for smaller, more precise channels and faster healing.">Fortgeschrittene FUE-Variante mit Saphirklingen für kleinere, präzisere Kanäle und schnellere Heilung.</span></div>
    <div class="hp-term"><b data-de="Schock-Verlust" data-en="Shock loss">Schock-Verlust</b><span data-de="Vorübergehender Ausfall des transplantierten Haares 2 bis 4 Wochen nach dem Eingriff. Die Follikel überleben, die Schäfte wachsen nach." data-en="Temporary shedding of transplanted hair 2 to 4 weeks after a transplant. The follicles survive; the shafts regrow.">Vorübergehender Ausfall des transplantierten Haares 2 bis 4 Wochen nach dem Eingriff. Die Follikel überleben, die Schäfte wachsen nach.</span></div>
    <div class="hp-term"><b data-de="Telogen" data-en="Telogen">Telogen</b><span data-de="Die Ruhephase des Haarzyklus, rund 2 bis 3 Monate. Das Haar bleibt, wächst aber nicht mehr." data-en="The resting phase of the hair cycle, lasting 2 to 3 months. Hair remains in place but doesn't grow.">Die Ruhephase des Haarzyklus, rund 2 bis 3 Monate. Das Haar bleibt, wächst aber nicht mehr.</span></div>
    <div class="hp-term"><b data-de="Telogenes Effluvium" data-en="Telogen effluvium">Telogenes Effluvium</b><span data-de="Vorübergehender diffuser Haarausfall, wenn viele Follikel gleichzeitig in die Telogen-Phase eintreten." data-en="A temporary condition causing diffuse shedding when many follicles simultaneously enter telogen.">Vorübergehender diffuser Haarausfall, wenn viele Follikel gleichzeitig in die Telogen-Phase eintreten.</span></div>
    <div class="hp-term"><b data-de="Trichoskopie" data-en="Trichoscopy">Trichoskopie</b><span data-de="Nicht-invasive Technik mit einem Dermatoskop zur Beurteilung von Follikeldichte, Miniaturisierung und Kopfhautzustand." data-en="A non-invasive technique using a dermatoscope to assess follicle density, miniaturisation, and scalp condition.">Nicht-invasive Technik mit einem Dermatoskop zur Beurteilung von Follikeldichte, Miniaturisierung und Kopfhautzustand.</span></div>
    <div class="hp-term"><b data-de="Vertex / Oberkopf" data-en="Vertex / Crown">Vertex / Oberkopf</b><span data-de="Der obere Hinterkopfbereich, oft einer der zuletzt betroffenen Bereiche bei männlichem Haarausfall." data-en="The top-rear area of the scalp, often one of the later areas affected in male pattern baldness.">Der obere Hinterkopfbereich, oft einer der zuletzt betroffenen Bereiche bei männlichem Haarausfall.</span></div>
  </div>
  </div>
</section>

<section style="padding: 40px 48px 60px; text-align:center; max-width:1180px; margin:0 auto;">
  <a href="#" class="cta-btn" onclick="openConsult(event)" style="padding:16px 34px; font-size:15.5px; display:inline-flex;" data-de="Kostenlose Beratung sichern" data-en="Get your free consultation">Kostenlose Beratung sichern</a>
</section>

<?php include __DIR__ . '/includes/site-footer.php'; ?>

<!-- ==================== CONSULTATION MODAL ==================== -->
<div class="consult-overlay" id="consultOverlay">
  <div class="consult-modal" role="dialog" aria-modal="true" aria-labelledby="consultTitle">
    <div class="consult-topbar">
      <button type="button" class="consult-close" onclick="closeConsult()" aria-label="Close">✕</button>
      <div class="consult-head">
        <div class="clogo">
          <img src="assets/lotus-transparent.png" alt="Apex Beauty">
          <span>Apex Beauty</span>
        </div>
        <h2 id="consultTitle" data-de="Kostenlose Beratung" data-en="Free Consultation">Kostenlose Beratung</h2>
        <p data-de="Füllen Sie das Formular aus, wir melden uns innerhalb von 24 Stunden." data-en="Fill in the form and we'll get back to you within 24 hours.">Füllen Sie das Formular aus, wir melden uns innerhalb von 24 Stunden.</p>
      </div>
      <div class="consult-steps" id="consultSteps">
        <div class="cstep active" data-step="1"><span class="dot">1</span><span data-de="Info" data-en="Info">Info</span></div>
        <div class="cstep-line"></div>
        <div class="cstep" data-step="2"><span class="dot">2</span><span data-de="Bedarf" data-en="Needs">Bedarf</span></div>
        <div class="cstep-line"></div>
        <div class="cstep" data-step="3"><span class="dot">3</span><span data-de="Fotos" data-en="Photos">Fotos</span></div>
      </div>
    </div>
    <div class="consult-body">

    <!-- STEP 1: Info -->
    <div class="consult-pane active" id="cpane1">
      <div class="pane-title" data-de="Holen Sie sich Ihre kostenlose Haaranalyse" data-en="Get Your Free Hair Analysis">Holen Sie sich Ihre kostenlose Haaranalyse</div>
      <div class="pane-sub" data-de="Unser Expertenteam meldet sich innerhalb von 24 Stunden" data-en="Our expert team will contact you within 24 hours">Unser Expertenteam meldet sich innerhalb von 24 Stunden</div>
      <div class="cfield">
        <label data-de="Vollständiger Name *" data-en="Full Name *">Vollständiger Name *</label>
        <input type="text" id="cfName" data-de-ph="Ihr vollständiger Name" data-en-ph="Your full name" placeholder="Ihr vollständiger Name" oninput="validateStep1()">
      </div>
      <div class="cfield">
        <label data-de="E-Mail *" data-en="Email *">E-Mail *</label>
        <input type="email" id="cfEmail" placeholder="email@example.com" oninput="validateStep1()">
      </div>
      <div class="cfield">
        <label data-de="Land *" data-en="Country *">Land *</label>
        <select id="cfCountry" onchange="updatePrefix(); validateStep1()">
          <option value="AT" data-prefix="+43">🇦🇹 Österreich</option>
          <option value="DE" data-prefix="+49">🇩🇪 Deutschland</option>
          <option value="CH" data-prefix="+41">🇨🇭 Schweiz</option>
          <option value="TR" data-prefix="+90">🇹🇷 Türkei</option>
          <option value="OTHER" data-prefix="+">🌍 Andere / Other</option>
        </select>
      </div>
      <div class="cfield">
        <label data-de="Telefon *" data-en="Phone *">Telefon *</label>
        <div class="phone-row">
          <div class="prefix" id="cfPrefix">+43</div>
          <input type="tel" id="cfPhone" placeholder="660 123 45 67" oninput="validateStep1()">
        </div>
      </div>
      <div class="consult-nav">
        <button type="button" class="cnext" id="cnext1" disabled onclick="gotoStep(2)" data-de="Weiter" data-en="Continue">Weiter</button>
      </div>
    </div>

    <!-- STEP 2: Needs -->
    <div class="consult-pane" id="cpane2">
      <div class="cfield">
        <label data-de="Ihr Geschlecht *" data-en="Your Gender *">Ihr Geschlecht *</label>
        <div class="opt-grid cols-2" id="genderRow">
          <div class="opt-card radio centered" data-value="male" onclick="pickSingle(this,'genderRow'); validateStep2()">
            <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModMale" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModMale)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="12" cy="18" r="6" fill="none" stroke="#fff" stroke-width="2.2"/><polyline points="17,7 23,7 23,13" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/><line x1="16.2" y1="13.8" x2="23" y2="7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/></svg></span><span data-de="Männlich" data-en="Male">Männlich</span>
          </div>
          <div class="opt-card radio centered" data-value="female" onclick="pickSingle(this,'genderRow'); validateStep2()">
            <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModFemale" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModFemale)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="11" r="6" fill="none" stroke="#fff" stroke-width="2.2"/><line x1="15" y1="17" x2="15" y2="25" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/><line x1="11" y1="21" x2="19" y2="21" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/></svg></span><span data-de="Weiblich" data-en="Female">Weiblich</span>
          </div>
        </div>
      </div>
      <div class="cfield">
        <label data-de="Verfahren, die Sie interessieren *" data-en="Procedures You're Interested In *">Verfahren, die Sie interessieren *</label>
        <div class="opt-grid cols-1" id="procRow">
          <div class="opt-card" data-value="hair" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModHair" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModHair)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M10 24c-1-6 0-11 2-14" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><path d="M15 24c0-7 0.5-12 0-16" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><path d="M20 24c1-6 0-11-2-14" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg></span><span data-de="Haartransplantation" data-en="Hair Transplant">Haartransplantation</span>
          </div>
          <div class="opt-card" data-value="beard" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModBeard" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModBeard)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M9 10c0 8 2 14 6 16 4-2 6-8 6-16" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 20l0 3M15 21.5l0 3M18 20l0 3" stroke="#fff" stroke-width="1.6" stroke-linecap="round"/></svg></span><span data-de="Barttransplantation" data-en="Beard Transplant">Barttransplantation</span>
          </div>
          <div class="opt-card" data-value="eyebrow" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModBrow" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModBrow)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M7 10c2-1.5 5-2.2 8-2.2s6 0.7 8 2.2" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><path d="M8 17c2.5-3 5-4.5 7-4.5s4.5 1.5 7 4.5c-2.5 3-5 4.5-7 4.5S10.5 20 8 17z" fill="none" stroke="#fff" stroke-width="1.8" stroke-linejoin="round"/><circle cx="15" cy="17" r="2" fill="#fff"/></svg></span><span data-de="Augenbrauentransplantation" data-en="Eyebrow Transplant">Augenbrauentransplantation</span>
          </div>
        </div>
        <div class="cgroup-note" data-de="Unterstützende Therapien" data-en="Supporting Therapies">Unterstützende Therapien</div>
        <div class="opt-grid cols-2" id="therapyRow">
          <div class="opt-card" data-value="prp" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPrp" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPrp)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M15 6c4 5.5 7 9.6 7 13.2A7 7 0 1 1 8 19.2C8 15.6 11 11.5 15 6z" fill="#fff" opacity="0.95"/></svg></span><span data-de="PRP-Therapie" data-en="PRP Therapy">PRP-Therapie</span>
          </div>
          <div class="opt-card" data-value="stemcell" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModStem" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModStem)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M15 6l7 4v10l-7 4-7-4V10z" fill="none" stroke="#fff" stroke-width="2" stroke-linejoin="round"/><circle cx="15" cy="15" r="3" fill="#fff"/></svg></span><span data-de="Stammzelltherapie" data-en="Stem Cell Therapy">Stammzelltherapie</span>
          </div>
          <div class="opt-card" data-value="exosome" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModExo" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModExo)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="11" cy="12" r="4" fill="#fff" opacity="0.9"/><circle cx="20" cy="11" r="3" fill="#fff" opacity="0.75"/><circle cx="13" cy="20" r="3.4" fill="#fff" opacity="0.85"/><circle cx="21" cy="19" r="2.6" fill="#fff" opacity="0.7"/></svg></span><span data-de="Exosom-Therapie" data-en="Exosome Therapy">Exosom-Therapie</span>
          </div>
          <div class="opt-card" data-value="hbot" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModHbot" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModHbot)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><rect x="8" y="7" width="14" height="16" rx="7" fill="none" stroke="#fff" stroke-width="2"/><path d="M15 12v6M12 15h6" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg></span><span data-de="Hyperbarer Sauerstoff" data-en="Hyperbaric Oxygen">Hyperbarer Sauerstoff</span>
          </div>
        </div>
      </div>
      <div class="cfield">
        <label data-de="Wann planen Sie den Eingriff?" data-en="When Are You Planning the Procedure?">Wann planen Sie den Eingriff?</label>
        <div class="opt-grid cols-3" id="timingRow">
          <div class="opt-card radio centered" data-value="this-month" onclick="pickSingle(this,'timingRow'); validateStep2()"><span data-de="Diesen Monat" data-en="This month">Diesen Monat</span></div>
          <div class="opt-card radio centered" data-value="1-3" onclick="pickSingle(this,'timingRow'); validateStep2()"><span data-de="In 1–3 Monaten" data-en="In 1–3 months">In 1–3 Monaten</span></div>
          <div class="opt-card radio centered" data-value="3-6" onclick="pickSingle(this,'timingRow'); validateStep2()"><span data-de="In 3–6 Monaten" data-en="In 3–6 months">In 3–6 Monaten</span></div>
          <div class="opt-card radio centered" data-value="6plus" onclick="pickSingle(this,'timingRow'); validateStep2()"><span data-de="In 6+ Monaten" data-en="In 6+ months">In 6+ Monaten</span></div>
          <div class="opt-card radio centered" data-value="research" onclick="pickSingle(this,'timingRow'); validateStep2()" style="grid-column: span 2;"><span data-de="Nur recherchieren" data-en="Just researching">Nur recherchieren</span></div>
        </div>
      </div>
      <div class="cfield">
        <label data-de="Zusätzliche Notizen (optional)" data-en="Additional Notes (Optional)">Zusätzliche Notizen (optional)</label>
        <textarea id="cfNotes" data-de-ph="Ihre Ziele oder Fragen..." data-en-ph="Your goals or questions..." placeholder="Ihre Ziele oder Fragen..."></textarea>
      </div>
      <div class="consult-nav">
        <button type="button" class="cback" onclick="gotoStep(1)" data-de="Zurück" data-en="Back">Zurück</button>
        <button type="button" class="cnext" id="cnext2" disabled onclick="gotoStep(3)" data-de="Weiter" data-en="Continue">Weiter</button>
      </div>
    </div>

    <!-- STEP 3: Photos -->
    <div class="consult-pane" id="cpane3">
      <div class="photo-note" data-de="📸 Fotos sind optional. Unsere Experten kontaktieren Sie in jedem Fall." data-en="📸 Photos are optional. Our experts will contact you either way.">📸 Fotos sind optional. Unsere Experten kontaktieren Sie in jedem Fall.</div>
      <div class="photo-grid">
        <div class="photo-slot" id="slot-front">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPhFront" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPhFront)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="14" r="7" fill="none" stroke="#fff" stroke-width="2"/><circle cx="12.5" cy="12.5" r="1.1" fill="#fff"/><circle cx="17.5" cy="12.5" r="1.1" fill="#fff"/><path d="M12 17c1 1.2 2 1.6 3 1.6s2-0.4 3-1.6" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round"/></svg></span>
          <b data-de="Vorne" data-en="Front">Vorne</b>
          <span data-de="Gesicht sichtbar" data-en="Face visible">Gesicht sichtbar</span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-front')">
        </div>
        <div class="photo-slot" id="slot-top">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPhTop" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPhTop)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="20" r="4.5" fill="none" stroke="#fff" stroke-width="2"/><path d="M15 5v8M11 9l4-4 4 4" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <b data-de="Oben" data-en="Top">Oben</b>
          <span data-de="Von oben" data-en="From above">Von oben</span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-top')">
        </div>
        <div class="photo-slot" id="slot-side">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPhSide" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPhSide)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M11 22c-1-2-1-4 0-6-1-1-1-3 0-4 1-3 4-5 7-5 3 0 4 2 4 4 1 0 2 1 2 2 0 2-1 3-2 3 0 2-1 4-3 5-1 1-1 2 0 3z" fill="#fff" opacity="0.92"/></svg></span>
          <b data-de="Seite" data-en="Side">Seite</b>
          <span data-de="Profil" data-en="Profile">Profil</span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-side')">
        </div>
        <div class="photo-slot" id="slot-donor">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPhDonor" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPhDonor)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M20 10a7 7 0 1 0 1.8 6.9" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><polyline points="22,7 21.8,11.5 17.5,10.5" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <b data-de="Spender" data-en="Donor">Spender</b>
          <span data-de="Hinterkopf" data-en="Back of head">Hinterkopf</span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-donor')">
        </div>
      </div>
      <div class="photo-note"><span id="photoCount">0</span>/4 <span data-de="Fotos hochgeladen" data-en="photos uploaded">Fotos hochgeladen</span></div>
      <div class="cfield">
        <label data-de="Rabattgutschein (optional)" data-en="Discount Coupon (Optional)">Rabattgutschein (optional)</label>
        <input type="text" id="cfCoupon" placeholder="WELCOME5">
      </div>
      <div class="check-row">
        <input type="checkbox" id="cfPrivacy" onchange="validateStep3()">
        <span data-de="Ich habe die &lt;a href=&quot;privacy.html&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;Datenschutzerklärung&lt;/a&gt; gelesen und akzeptiere die Verarbeitung meiner personenbezogenen Daten. *" data-en="I have read the &lt;a href=&quot;privacy.html&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;privacy policy&lt;/a&gt; and accept the processing of my personal data. *">Ich habe die <a href="privacy.html" target="_blank" rel="noopener noreferrer">Datenschutzerklärung</a> gelesen und akzeptiere die Verarbeitung meiner personenbezogenen Daten. *</span>
      </div>
      <div class="check-row">
        <input type="checkbox" id="cfMarketing">
        <span data-de="Ich möchte über Aktionen und Angebote informiert werden." data-en="I'd like to be informed about promotions and offers.">Ich möchte über Aktionen und Angebote informiert werden.</span>
      </div>
      <div class="gdpr-badge" data-de="🇪🇺 DSGVO · Ihre Daten sind geschützt" data-en="🇪🇺 GDPR · Your data is protected">🇪🇺 DSGVO · Ihre Daten sind geschützt</div>
      <div class="consult-nav">
        <button type="button" class="cback" onclick="gotoStep(2)" data-de="Zurück" data-en="Back">Zurück</button>
        <button type="button" class="cnext" id="cnext3" disabled onclick="submitConsult()" data-de="Absenden" data-en="Submit">Absenden</button>
      </div>
    </div>

    <!-- SUCCESS -->
    <div class="consult-pane" id="cpaneSuccess">
      <div class="consult-success">
        <div class="ok-ring">✓</div>
        <h3 data-de="Vielen Dank!" data-en="Thank You!">Vielen Dank!</h3>
        <p data-de="Ihre Anfrage ist bei uns eingegangen. Unser Team meldet sich innerhalb von 24 Stunden bei Ihnen." data-en="We've received your request. Our team will get back to you within 24 hours.">Ihre Anfrage ist bei uns eingegangen. Unser Team meldet sich innerhalb von 24 Stunden bei Ihnen.</p>
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

  function applyLang(lang) {
    document.documentElement.lang = lang;
    document.querySelectorAll('[data-de]').forEach(function (el) {
      var val = el.getAttribute('data-' + lang);
      if (val !== null) el.innerHTML = val;
    });
    document.querySelectorAll('[data-de-ph]').forEach(function (el) {
      var ph = el.getAttribute('data-' + lang + '-ph');
      if (ph !== null) el.placeholder = ph;
    });
    document.querySelectorAll('.lang-switch button').forEach(function (s) {
      var isActive = s.getAttribute('data-lang') === lang;
      s.className = isActive ? 'active' : 'inactive';
    });
  }
  document.querySelectorAll('.lang-switch button').forEach(function (s) {
    s.addEventListener('click', function () { applyLang(s.getAttribute('data-lang')); });
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
  if ('IntersectionObserver' in window && hpSections.length) {
    var spy = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          hpLinks.forEach(function (l) { l.classList.remove('active'); });
          var match = hpLinks.find(function (l) { return l.getAttribute('href') === '#' + entry.target.id; });
          if (match) match.classList.add('active');
        }
      });
    }, { rootMargin: '-160px 0px -70% 0px' });
    hpSections.forEach(function (s) { spy.observe(s); });
  }
</script>

</body>
</html>
