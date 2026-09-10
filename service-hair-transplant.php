<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/content.php';
require_once __DIR__ . '/includes/i18n.php';
require_once __DIR__ . '/includes/seo.php';
$currentLang = apex_current_lang();
// The copy the admin panel edits, rendered into the HTML instead of being
// swapped in by JavaScript, so an edit is visible to crawlers.
$cmsService = apex_get_page_content('service') ?? [];
// Title, description, share image and the Google visibility switch are edited
// in the admin panel under Website content > Search engine listing; the
// fallbacks live in includes/seo.php.
$seoPage = 'service';
$seoTitle = apex_seo_title($seoPage);
$seoDescription = apex_seo_description($seoPage);
$seoCanonicalPath = apex_seo_path($seoPage);
$seoNoindex = apex_seo_noindex($seoPage);
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
<?php require __DIR__ . '/includes/site-pixel.php'; ?>
<script src="/assets/meta-pixel.js"></script>
<script src="/assets/cookie-consent.js"></script>
<script src="/assets/content-loader.js"></script>
<?php require __DIR__ . '/includes/site-gtm.php'; ?>
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

  /* ---- WhatsApp floating button (same as glass-theme.html) ---- */
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
    /* Must match the site nav's real rendered height (95px desktop, 59px
       once the bar collapses to the hamburger at <=1360px in
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
  @media (max-width: 1360px) { .hp-quicknav-wrap { top: 59px; } }

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
<body data-content-page="service">
<?php require __DIR__ . '/includes/site-gtm-noscript.php'; ?>

<?php
$siteHeaderMode = 'full';
$siteSectionBase = 'index.php';
$siteHomeHref = 'index.php';
include __DIR__ . '/includes/site-header.php';
?>

<section class="hp-hero">
  <div class="hp-hero-bg"></div>
  <div class="hp-hero-inner">
    <div class="eyebrow"><span class="dot"></span><span data-ckey="hpHero.t1"<?= apex_cms_attrs_or($cmsService['hpHero']['t1'] ?? null, ['de' => "Verfahren", 'en' => "Procedure", 'fr' => "Procédure", 'nl' => "Procedure", 'it' => "Procedura", 'tr' => "İşlem"]) ?>><?= apex_cms_value_or($cmsService['hpHero']['t1'] ?? null, ['de' => "Verfahren", 'en' => "Procedure", 'fr' => "Procédure", 'nl' => "Procedure", 'it' => "Procedura", 'tr' => "İşlem"], $currentLang) ?></span></div>
    <h1 data-ckey="hero.heading"<?= apex_cms_attrs_or($cmsService['hero']['heading'] ?? null, ['de' => "&lt;span&gt;Haartransplantation&lt;/span&gt; bei Apex Beauty", 'en' => "Hair Transplantation &lt;span&gt;at Apex Beauty&lt;/span&gt;", 'fr' => "Greffe de cheveux &lt;span&gt;chez Apex Beauty&lt;/span&gt;", 'nl' => "Haartransplantatie &lt;span&gt;bij Apex Beauty&lt;/span&gt;", 'it' => "Trapianto di capelli &lt;span&gt;presso Apex Beauty&lt;/span&gt;", 'tr' => "Saç Ekimi &lt;span&gt;Apex Beauty'de&lt;/span&gt;"]) ?>><?= apex_cms_value_or($cmsService['hero']['heading'] ?? null, ['de' => "&lt;span&gt;Haartransplantation&lt;/span&gt; bei Apex Beauty", 'en' => "Hair Transplantation &lt;span&gt;at Apex Beauty&lt;/span&gt;", 'fr' => "Greffe de cheveux &lt;span&gt;chez Apex Beauty&lt;/span&gt;", 'nl' => "Haartransplantatie &lt;span&gt;bij Apex Beauty&lt;/span&gt;", 'it' => "Trapianto di capelli &lt;span&gt;presso Apex Beauty&lt;/span&gt;", 'tr' => "Saç Ekimi &lt;span&gt;Apex Beauty'de&lt;/span&gt;"], $currentLang) ?></h1>
    <p data-ckey="hero.sub"<?= apex_cms_attrs_or($cmsService['hero']['sub'] ?? null, ['de' => "Ein chirurgischer Eingriff unter örtlicher Betäubung. Gesunde, DHT-resistente Follikel werden aus dem Spenderbereich entnommen und in ausgedünnte Areale verpflanzt, wo sie dauerhaft weiterwachsen.", 'en' => "A surgical procedure under local anaesthesia. Healthy, DHT-resistant follicles are taken from the donor area and relocated to thinning areas, where they keep growing for life.", 'fr' => "Une intervention chirurgicale sous anesthésie locale. Des follicules sains, résistants à la DHT, sont prélevés dans la zone donneuse et replantés dans les zones clairsemées, où ils continuent de pousser à vie.", 'nl' => "Een chirurgische ingreep onder lokale verdoving. Gezonde, DHT-resistente follikels worden uit het donorgebied gehaald en verplaatst naar dunner wordende zones, waar ze levenslang blijven doorgroeien.", 'it' => "Una procedura chirurgica in anestesia locale. Follicoli sani e resistenti al DHT vengono prelevati dall'area donatrice e trapiantati nelle zone diradate, dove continuano a crescere per tutta la vita.", 'tr' => "Lokal anestezi altında yapılan cerrahi bir işlemdir. Sağlıklı, DHT'ye dirençli foliküller donör bölgeden alınarak seyrelen bölgelere nakledilir ve orada ömür boyu büyümeye devam eder."]) ?>><?= apex_cms_value_or($cmsService['hero']['sub'] ?? null, ['de' => "Ein chirurgischer Eingriff unter örtlicher Betäubung. Gesunde, DHT-resistente Follikel werden aus dem Spenderbereich entnommen und in ausgedünnte Areale verpflanzt, wo sie dauerhaft weiterwachsen.", 'en' => "A surgical procedure under local anaesthesia. Healthy, DHT-resistant follicles are taken from the donor area and relocated to thinning areas, where they keep growing for life.", 'fr' => "Une intervention chirurgicale sous anesthésie locale. Des follicules sains, résistants à la DHT, sont prélevés dans la zone donneuse et replantés dans les zones clairsemées, où ils continuent de pousser à vie.", 'nl' => "Een chirurgische ingreep onder lokale verdoving. Gezonde, DHT-resistente follikels worden uit het donorgebied gehaald en verplaatst naar dunner wordende zones, waar ze levenslang blijven doorgroeien.", 'it' => "Una procedura chirurgica in anestesia locale. Follicoli sani e resistenti al DHT vengono prelevati dall'area donatrice e trapiantati nelle zone diradate, dove continuano a crescere per tutta la vita.", 'tr' => "Lokal anestezi altında yapılan cerrahi bir işlemdir. Sağlıklı, DHT'ye dirençli foliküller donör bölgeden alınarak seyrelen bölgelere nakledilir ve orada ömür boyu büyümeye devam eder."], $currentLang) ?></p>
  </div>
</section>

<div class="hp-quicknav-wrap">
  <div class="hp-quicknav" id="hpQuicknav">
    <a href="#umfasst"><span data-ckey="hpHero.t2"<?= apex_cms_attrs_or($cmsService['hpHero']['t2'] ?? null, ['de' => "Was es umfasst", 'en' => "What it involves", 'fr' => "En quoi elle consiste", 'nl' => "Wat het inhoudt", 'it' => "Cosa comprende", 'tr' => "Neleri Kapsar"]) ?>><?= apex_cms_value_or($cmsService['hpHero']['t2'] ?? null, ['de' => "Was es umfasst", 'en' => "What it involves", 'fr' => "En quoi elle consiste", 'nl' => "Wat het inhoudt", 'it' => "Cosa comprende", 'tr' => "Neleri Kapsar"], $currentLang) ?></span></a>
    <a href="#geeignet"><span data-ckey="hpHero.t3"<?= apex_cms_attrs_or($cmsService['hpHero']['t3'] ?? null, ['de' => "Wer ist geeignet", 'en' => "Candidacy", 'fr' => "Éligibilité", 'nl' => "Geschiktheid", 'it' => "Idoneità", 'tr' => "Adaylık"]) ?>><?= apex_cms_value_or($cmsService['hpHero']['t3'] ?? null, ['de' => "Wer ist geeignet", 'en' => "Candidacy", 'fr' => "Éligibilité", 'nl' => "Geschiktheid", 'it' => "Idoneità", 'tr' => "Adaylık"], $currentLang) ?></span></a>
    <a href="#genesung-service"><span data-ckey="hpHero.t4"<?= apex_cms_attrs_or($cmsService['hpHero']['t4'] ?? null, ['de' => "Genesung", 'en' => "Recovery", 'fr' => "Récupération", 'nl' => "Herstel", 'it' => "Recupero", 'tr' => "İyileşme"]) ?>><?= apex_cms_value_or($cmsService['hpHero']['t4'] ?? null, ['de' => "Genesung", 'en' => "Recovery", 'fr' => "Récupération", 'nl' => "Herstel", 'it' => "Recupero", 'tr' => "İyileşme"], $currentLang) ?></span></a>
    <a href="#ergebnisse"><span data-ckey="hpHero.t5"<?= apex_cms_attrs_or($cmsService['hpHero']['t5'] ?? null, ['de' => "Ergebnisse", 'en' => "Results", 'fr' => "Résultats", 'nl' => "Resultaten", 'it' => "Risultati", 'tr' => "Sonuçlar"]) ?>><?= apex_cms_value_or($cmsService['hpHero']['t5'] ?? null, ['de' => "Ergebnisse", 'en' => "Results", 'fr' => "Résultats", 'nl' => "Resultaten", 'it' => "Risultati", 'tr' => "Sonuçlar"], $currentLang) ?></span></a>
  </div>
</div>

<section class="hp-section" id="umfasst">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gSvcGraft" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gSvcGraft)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M22 46c-1-8 1-15 4-19M32 46c0-9 0-16 0-20M42 46c1-8-1-15-4-19" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round"/><circle cx="22" cy="48" r="2.4" fill="#fff"/><circle cx="32" cy="48" r="2.4" fill="#fff"/><circle cx="42" cy="48" r="2.4" fill="#fff"/></svg>
    <div>
      <h2 data-ckey="umfasst.heading"<?= apex_cms_attrs_or($cmsService['umfasst']['heading'] ?? null, ['de' => "Was die Behandlung umfasst", 'en' => "What the treatment involves", 'fr' => "En quoi consiste le traitement", 'nl' => "Wat de behandeling inhoudt", 'it' => "Cosa comprende il trattamento", 'tr' => "Tedavi Neleri Kapsar"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['heading'] ?? null, ['de' => "Was die Behandlung umfasst", 'en' => "What the treatment involves", 'fr' => "En quoi consiste le traitement", 'nl' => "Wat de behandeling inhoudt", 'it' => "Cosa comprende il trattamento", 'tr' => "Tedavi Neleri Kapsar"], $currentLang) ?></h2>
      <p data-ckey="umfasst.body"<?= apex_cms_attrs_or($cmsService['umfasst']['body'] ?? null, ['de' => "Apex Beauty führt drei anerkannte Transplantationstechniken durch, je nach Fläche, Graft-Anzahl und gewünschtem Detailgrad.", 'en' => "Apex Beauty performs three recognised transplantation techniques, chosen based on area, graft count, and desired level of detail.", 'fr' => "Apex Beauty pratique trois techniques de greffe reconnues, choisies selon la zone, le nombre de greffons et le niveau de précision souhaité.", 'nl' => "Apex Beauty past drie erkende transplantatietechnieken toe, gekozen op basis van het gebied, het aantal grafts en het gewenste detailniveau.", 'it' => "Apex Beauty esegue tre tecniche di trapianto riconosciute, scelte in base all'area, al numero di innesti e al livello di dettaglio desiderato.", 'tr' => "Apex Beauty, bölgeye, greft sayısına ve istenen detay düzeyine göre seçilen üç kabul görmüş nakil tekniği uygular."]) ?>><?= apex_cms_value_or($cmsService['umfasst']['body'] ?? null, ['de' => "Apex Beauty führt drei anerkannte Transplantationstechniken durch, je nach Fläche, Graft-Anzahl und gewünschtem Detailgrad.", 'en' => "Apex Beauty performs three recognised transplantation techniques, chosen based on area, graft count, and desired level of detail.", 'fr' => "Apex Beauty pratique trois techniques de greffe reconnues, choisies selon la zone, le nombre de greffons et le niveau de précision souhaité.", 'nl' => "Apex Beauty past drie erkende transplantatietechnieken toe, gekozen op basis van het gebied, het aantal grafts en het gewenste detailniveau.", 'it' => "Apex Beauty esegue tre tecniche di trapianto riconosciute, scelte in base all'area, al numero di innesti e al livello di dettaglio desiderato.", 'tr' => "Apex Beauty, bölgeye, greft sayısına ve istenen detay düzeyine göre seçilen üç kabul görmüş nakil tekniği uygular."], $currentLang) ?></p>
    </div>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-ckey="umfasst.t1"<?= apex_cms_attrs_or($cmsService['umfasst']['t1'] ?? null, ['de' => "Die drei wichtigsten Techniken", 'en' => "The three main techniques", 'fr' => "Les trois principales techniques", 'nl' => "De drie belangrijkste technieken", 'it' => "Le tre tecniche principali", 'tr' => "Üç Ana Teknik"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t1'] ?? null, ['de' => "Die drei wichtigsten Techniken", 'en' => "The three main techniques", 'fr' => "Les trois principales techniques", 'nl' => "De drie belangrijkste technieken", 'it' => "Le tre tecniche principali", 'tr' => "Üç Ana Teknik"], $currentLang) ?></h3>
  <div class="hp-grid" style="margin-bottom:32px">
    <div class="hp-card"><h4 data-ckey="umfasst.t2"<?= apex_cms_attrs_or($cmsService['umfasst']['t2'] ?? null, ['de' => "FUE", 'en' => "FUE", 'fr' => "FUE", 'nl' => "FUE", 'it' => "FUE", 'tr' => "FUE"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t2'] ?? null, ['de' => "FUE", 'en' => "FUE", 'fr' => "FUE", 'nl' => "FUE", 'it' => "FUE", 'tr' => "FUE"], $currentLang) ?></h4><p data-ckey="umfasst.t3"<?= apex_cms_attrs_or($cmsService['umfasst']['t3'] ?? null, ['de' => "Follikuläre Einheiten (1 bis 4 Haare) werden einzeln mit einem Mikro-Punch-Werkzeug entnommen. Kein linearer Schnitt, keine sichtbare Narbe. 5 bis 8 Stunden je nach Graft-Anzahl.", 'en' => "Follicular units (1 to 4 hairs) are extracted one by one with a micro-punch tool. No linear incision, no visible scar. 5 to 8 hours depending on graft count.", 'fr' => "Les unités folliculaires (1 à 4 cheveux) sont extraites une à une à l'aide d'un micro-punch. Pas d'incision linéaire, pas de cicatrice visible. 5 à 8 heures selon le nombre de greffons.", 'nl' => "Folliculaire eenheden (1 tot 4 haren) worden één voor één geëxtraheerd met een micro-punchtool. Geen lineaire incisie, geen zichtbaar litteken. 5 tot 8 uur, afhankelijk van het aantal grafts.", 'it' => "Le unità follicolari (1-4 capelli) vengono estratte una per una con uno strumento micro-punch. Nessuna incisione lineare, nessuna cicatrice visibile. 5-8 ore a seconda del numero di innesti.", 'tr' => "Foliküler üniteler (1 ila 4 saç teli) mikro-punch aracıyla tek tek çıkarılır. Doğrusal kesi yoktur, görünür iz kalmaz. Greft sayısına bağlı olarak 5 ila 8 saat sürer."]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t3'] ?? null, ['de' => "Follikuläre Einheiten (1 bis 4 Haare) werden einzeln mit einem Mikro-Punch-Werkzeug entnommen. Kein linearer Schnitt, keine sichtbare Narbe. 5 bis 8 Stunden je nach Graft-Anzahl.", 'en' => "Follicular units (1 to 4 hairs) are extracted one by one with a micro-punch tool. No linear incision, no visible scar. 5 to 8 hours depending on graft count.", 'fr' => "Les unités folliculaires (1 à 4 cheveux) sont extraites une à une à l'aide d'un micro-punch. Pas d'incision linéaire, pas de cicatrice visible. 5 à 8 heures selon le nombre de greffons.", 'nl' => "Folliculaire eenheden (1 tot 4 haren) worden één voor één geëxtraheerd met een micro-punchtool. Geen lineaire incisie, geen zichtbaar litteken. 5 tot 8 uur, afhankelijk van het aantal grafts.", 'it' => "Le unità follicolari (1-4 capelli) vengono estratte una per una con uno strumento micro-punch. Nessuna incisione lineare, nessuna cicatrice visibile. 5-8 ore a seconda del numero di innesti.", 'tr' => "Foliküler üniteler (1 ila 4 saç teli) mikro-punch aracıyla tek tek çıkarılır. Doğrusal kesi yoktur, görünür iz kalmaz. Greft sayısına bağlı olarak 5 ila 8 saat sürer."], $currentLang) ?></p></div>
    <div class="hp-card"><span class="hp-badge" data-ckey="umfasst.t4"<?= apex_cms_attrs_or($cmsService['umfasst']['t4'] ?? null, ['de' => "Meistgenutzt in Istanbul", 'en' => "Most used in Istanbul", 'fr' => "La plus utilisée à Istanbul", 'nl' => "Meest gebruikt in Istanboel", 'it' => "La più utilizzata a Istanbul", 'tr' => "İstanbul'da En Çok Kullanılan"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t4'] ?? null, ['de' => "Meistgenutzt in Istanbul", 'en' => "Most used in Istanbul", 'fr' => "La plus utilisée à Istanbul", 'nl' => "Meest gebruikt in Istanboel", 'it' => "La più utilizzata a Istanbul", 'tr' => "İstanbul'da En Çok Kullanılan"], $currentLang) ?></span><h4 data-ckey="umfasst.t5"<?= apex_cms_attrs_or($cmsService['umfasst']['t5'] ?? null, ['de' => "Saphir-FUE", 'en' => "Sapphire FUE", 'fr' => "FUE au saphir", 'nl' => "Saffier-FUE", 'it' => "Saphire-FUE", 'tr' => "Safir FUE"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t5'] ?? null, ['de' => "Saphir-FUE", 'en' => "Sapphire FUE", 'fr' => "FUE au saphir", 'nl' => "Saffier-FUE", 'it' => "Saphire-FUE", 'tr' => "Safir FUE"], $currentLang) ?></h4><p data-ckey="umfasst.t6"<?= apex_cms_attrs_or($cmsService['umfasst']['t6'] ?? null, ['de' => "Kanäle werden mit Saphirklingen statt Stahl geöffnet: kleinere, präzisere Schnitte, schnellere Heilung, höhere Dichte pro cm² und geringeres Risiko für Verkrustung.", 'en' => "Channels are opened with sapphire blades instead of steel: smaller, more precise incisions, faster healing, higher density per cm², and lower risk of scabbing.", 'fr' => "Les canaux sont ouverts avec des lames en saphir plutôt qu'en acier : incisions plus petites et plus précises, guérison plus rapide, densité plus élevée par cm² et risque réduit de croûtes.", 'nl' => "Kanalen worden geopend met saffieren lemmeten in plaats van staal: kleinere, preciezere incisies, sneller herstel, hogere dichtheid per cm² en lager risico op korstvorming.", 'it' => "I canali vengono aperti con lame di zaffiro anziché in acciaio: incisioni più piccole e precise, guarigione più rapida, maggiore densità per cm² e minor rischio di crostosità.", 'tr' => "Kanallar çelik yerine safir bıçaklarla açılır: daha küçük, daha hassas kesiler, daha hızlı iyileşme, cm² başına daha yüksek yoğunluk ve daha düşük kabuklanma riski."]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t6'] ?? null, ['de' => "Kanäle werden mit Saphirklingen statt Stahl geöffnet: kleinere, präzisere Schnitte, schnellere Heilung, höhere Dichte pro cm² und geringeres Risiko für Verkrustung.", 'en' => "Channels are opened with sapphire blades instead of steel: smaller, more precise incisions, faster healing, higher density per cm², and lower risk of scabbing.", 'fr' => "Les canaux sont ouverts avec des lames en saphir plutôt qu'en acier : incisions plus petites et plus précises, guérison plus rapide, densité plus élevée par cm² et risque réduit de croûtes.", 'nl' => "Kanalen worden geopend met saffieren lemmeten in plaats van staal: kleinere, preciezere incisies, sneller herstel, hogere dichtheid per cm² en lager risico op korstvorming.", 'it' => "I canali vengono aperti con lame di zaffiro anziché in acciaio: incisioni più piccole e precise, guarigione più rapida, maggiore densità per cm² e minor rischio di crostosità.", 'tr' => "Kanallar çelik yerine safir bıçaklarla açılır: daha küçük, daha hassas kesiler, daha hızlı iyileşme, cm² başına daha yüksek yoğunluk ve daha düşük kabuklanma riski."], $currentLang) ?></p></div>
    <div class="hp-card"><h4 data-ckey="umfasst.t7"<?= apex_cms_attrs_or($cmsService['umfasst']['t7'] ?? null, ['de' => "DHI", 'en' => "DHI", 'fr' => "DHI", 'nl' => "DHI", 'it' => "DHI", 'tr' => "DHI"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t7'] ?? null, ['de' => "DHI", 'en' => "DHI", 'fr' => "DHI", 'nl' => "DHI", 'it' => "DHI", 'tr' => "DHI"], $currentLang) ?></h4><p data-ckey="umfasst.t8"<?= apex_cms_attrs_or($cmsService['umfasst']['t8'] ?? null, ['de' => "Follikel werden mit einem Choi Implanter Pen direkt implantiert, ohne separate Kanaleröffnung. Präzise Kontrolle über Winkel und Tiefe, ideal für den Haaransatz.", 'en' => "Follicles are implanted directly using a Choi Implanter Pen, without opening separate channels first. Precise control over angle and depth, ideal for the hairline.", 'fr' => "Les follicules sont implantés directement à l'aide d'un stylo implanteur Choi, sans ouverture préalable de canaux séparés. Contrôle précis de l'angle et de la profondeur, idéal pour la ligne capillaire.", 'nl' => "Follikels worden direct geïmplanteerd met een Choi Implanter Pen, zonder eerst afzonderlijke kanalen te openen. Nauwkeurige controle over hoek en diepte, ideaal voor de haarlijn.", 'it' => "I follicoli vengono impiantati direttamente con una penna Choi Implanter, senza aprire prima canali separati. Controllo preciso di angolo e profondità, ideale per l'attaccatura.", 'tr' => "Foliküller, önce ayrı kanallar açılmadan doğrudan bir Choi İmplanter Kalemi ile yerleştirilir. Açı ve derinlik üzerinde hassas kontrol sağlar, saç çizgisi için idealdir."]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t8'] ?? null, ['de' => "Follikel werden mit einem Choi Implanter Pen direkt implantiert, ohne separate Kanaleröffnung. Präzise Kontrolle über Winkel und Tiefe, ideal für den Haaransatz.", 'en' => "Follicles are implanted directly using a Choi Implanter Pen, without opening separate channels first. Precise control over angle and depth, ideal for the hairline.", 'fr' => "Les follicules sont implantés directement à l'aide d'un stylo implanteur Choi, sans ouverture préalable de canaux séparés. Contrôle précis de l'angle et de la profondeur, idéal pour la ligne capillaire.", 'nl' => "Follikels worden direct geïmplanteerd met een Choi Implanter Pen, zonder eerst afzonderlijke kanalen te openen. Nauwkeurige controle over hoek en diepte, ideaal voor de haarlijn.", 'it' => "I follicoli vengono impiantati direttamente con una penna Choi Implanter, senza aprire prima canali separati. Controllo preciso di angolo e profondità, ideale per l'attaccatura.", 'tr' => "Foliküller, önce ayrı kanallar açılmadan doğrudan bir Choi İmplanter Kalemi ile yerleştirilir. Açı ve derinlik üzerinde hassas kontrol sağlar, saç çizgisi için idealdir."], $currentLang) ?></p></div>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-ckey="umfasst.t9"<?= apex_cms_attrs_or($cmsService['umfasst']['t9'] ?? null, ['de' => "Saphir-FUE oder DHI: der Vergleich", 'en' => "Sapphire FUE vs. DHI: the comparison", 'fr' => "FUE au saphir ou DHI : la comparaison", 'nl' => "Saffier-FUE of DHI: de vergelijking", 'it' => "Saphire-FUE o DHI: il confronto", 'tr' => "Safir FUE mi DHI mi: Karşılaştırma"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t9'] ?? null, ['de' => "Saphir-FUE oder DHI: der Vergleich", 'en' => "Sapphire FUE vs. DHI: the comparison", 'fr' => "FUE au saphir ou DHI : la comparaison", 'nl' => "Saffier-FUE of DHI: de vergelijking", 'it' => "Saphire-FUE o DHI: il confronto", 'tr' => "Safir FUE mi DHI mi: Karşılaştırma"], $currentLang) ?></h3>
  <div class="hp-table-wrap">
    <table class="hp-table">
      <tr><th data-ckey="umfasst.t10"<?= apex_cms_attrs_or($cmsService['umfasst']['t10'] ?? null, ['de' => "Faktor", 'en' => "Factor", 'fr' => "Facteur", 'nl' => "Factor", 'it' => "Fattore", 'tr' => "Faktör"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t10'] ?? null, ['de' => "Faktor", 'en' => "Factor", 'fr' => "Facteur", 'nl' => "Factor", 'it' => "Fattore", 'tr' => "Faktör"], $currentLang) ?></th><th data-ckey="umfasst.t11"<?= apex_cms_attrs_or($cmsService['umfasst']['t11'] ?? null, ['de' => "Saphir-FUE", 'en' => "Sapphire FUE", 'fr' => "FUE au saphir", 'nl' => "Saffier-FUE", 'it' => "Saphire-FUE", 'tr' => "Safir FUE"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t11'] ?? null, ['de' => "Saphir-FUE", 'en' => "Sapphire FUE", 'fr' => "FUE au saphir", 'nl' => "Saffier-FUE", 'it' => "Saphire-FUE", 'tr' => "Safir FUE"], $currentLang) ?></th><th data-ckey="umfasst.t12"<?= apex_cms_attrs_or($cmsService['umfasst']['t12'] ?? null, ['de' => "DHI", 'en' => "DHI", 'fr' => "DHI", 'nl' => "DHI", 'it' => "DHI", 'tr' => "DHI"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t12'] ?? null, ['de' => "DHI", 'en' => "DHI", 'fr' => "DHI", 'nl' => "DHI", 'it' => "DHI", 'tr' => "DHI"], $currentLang) ?></th></tr>
      <tr><td data-ckey="umfasst.t13"<?= apex_cms_attrs_or($cmsService['umfasst']['t13'] ?? null, ['de' => "Am besten für", 'en' => "Best for", 'fr' => "Idéal pour", 'nl' => "Het beste voor", 'it' => "Ideale per", 'tr' => "En İyi Kullanım Alanı"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t13'] ?? null, ['de' => "Am besten für", 'en' => "Best for", 'fr' => "Idéal pour", 'nl' => "Het beste voor", 'it' => "Ideale per", 'tr' => "En İyi Kullanım Alanı"], $currentLang) ?></td><td data-ckey="umfasst.t14"<?= apex_cms_attrs_or($cmsService['umfasst']['t14'] ?? null, ['de' => "Große Flächen, hohe Graft-Zahlen", 'en' => "Large areas, high graft counts", 'fr' => "Grandes surfaces, nombre élevé de greffons", 'nl' => "Grote gebieden, hoge graftaantallen", 'it' => "Aree ampie, elevato numero di innesti", 'tr' => "Geniş alanlar, yüksek greft sayıları"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t14'] ?? null, ['de' => "Große Flächen, hohe Graft-Zahlen", 'en' => "Large areas, high graft counts", 'fr' => "Grandes surfaces, nombre élevé de greffons", 'nl' => "Grote gebieden, hoge graftaantallen", 'it' => "Aree ampie, elevato numero di innesti", 'tr' => "Geniş alanlar, yüksek greft sayıları"], $currentLang) ?></td><td data-ckey="umfasst.t15"<?= apex_cms_attrs_or($cmsService['umfasst']['t15'] ?? null, ['de' => "Haaransatz, hohe Detailtreue, kleinere Flächen", 'en' => "Frontal hairline, high detail, smaller areas", 'fr' => "Ligne frontale, grande précision, petites surfaces", 'nl' => "Voorste haarlijn, hoge precisie, kleinere gebieden", 'it' => "Attaccatura frontale, alta precisione, aree più piccole", 'tr' => "Ön saç çizgisi, yüksek detay, küçük alanlar"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t15'] ?? null, ['de' => "Haaransatz, hohe Detailtreue, kleinere Flächen", 'en' => "Frontal hairline, high detail, smaller areas", 'fr' => "Ligne frontale, grande précision, petites surfaces", 'nl' => "Voorste haarlijn, hoge precisie, kleinere gebieden", 'it' => "Attaccatura frontale, alta precisione, aree più piccole", 'tr' => "Ön saç çizgisi, yüksek detay, küçük alanlar"], $currentLang) ?></td></tr>
      <tr><td data-ckey="umfasst.t16"<?= apex_cms_attrs_or($cmsService['umfasst']['t16'] ?? null, ['de' => "Heilung", 'en' => "Healing", 'fr' => "Guérison", 'nl' => "Genezing", 'it' => "Guarigione", 'tr' => "İyileşme"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t16'] ?? null, ['de' => "Heilung", 'en' => "Healing", 'fr' => "Guérison", 'nl' => "Genezing", 'it' => "Guarigione", 'tr' => "İyileşme"], $currentLang) ?></td><td data-ckey="umfasst.t17"<?= apex_cms_attrs_or($cmsService['umfasst']['t17'] ?? null, ['de' => "Schnell (kleinere Schnitte)", 'en' => "Fast (smaller incisions)", 'fr' => "Rapide (incisions plus petites)", 'nl' => "Snel (kleinere incisies)", 'it' => "Veloce (incisioni più piccole)", 'tr' => "Hızlı (daha küçük kesiler)"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t17'] ?? null, ['de' => "Schnell (kleinere Schnitte)", 'en' => "Fast (smaller incisions)", 'fr' => "Rapide (incisions plus petites)", 'nl' => "Snel (kleinere incisies)", 'it' => "Veloce (incisioni più piccole)", 'tr' => "Hızlı (daha küçük kesiler)"], $currentLang) ?></td><td data-ckey="umfasst.t18"<?= apex_cms_attrs_or($cmsService['umfasst']['t18'] ?? null, ['de' => "Moderat (mehr Werkzeugdurchgänge)", 'en' => "Moderate (more tool passes)", 'fr' => "Modérée (davantage de passages d'outil)", 'nl' => "Matig (meer instrumentbewegingen)", 'it' => "Moderata (più passaggi dello strumento)", 'tr' => "Orta (daha fazla alet geçişi)"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t18'] ?? null, ['de' => "Moderat (mehr Werkzeugdurchgänge)", 'en' => "Moderate (more tool passes)", 'fr' => "Modérée (davantage de passages d'outil)", 'nl' => "Matig (meer instrumentbewegingen)", 'it' => "Moderata (più passaggi dello strumento)", 'tr' => "Orta (daha fazla alet geçişi)"], $currentLang) ?></td></tr>
      <tr><td data-ckey="umfasst.t19"<?= apex_cms_attrs_or($cmsService['umfasst']['t19'] ?? null, ['de' => "Präzision", 'en' => "Precision", 'fr' => "Précision", 'nl' => "Precisie", 'it' => "Precisione", 'tr' => "Hassasiyet"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t19'] ?? null, ['de' => "Präzision", 'en' => "Precision", 'fr' => "Précision", 'nl' => "Precisie", 'it' => "Precisione", 'tr' => "Hassasiyet"], $currentLang) ?></td><td data-ckey="umfasst.t20"<?= apex_cms_attrs_or($cmsService['umfasst']['t20'] ?? null, ['de' => "Hoch", 'en' => "High", 'fr' => "Élevée", 'nl' => "Hoog", 'it' => "Alta", 'tr' => "Yüksek"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t20'] ?? null, ['de' => "Hoch", 'en' => "High", 'fr' => "Élevée", 'nl' => "Hoog", 'it' => "Alta", 'tr' => "Yüksek"], $currentLang) ?></td><td data-ckey="umfasst.t21"<?= apex_cms_attrs_or($cmsService['umfasst']['t21'] ?? null, ['de' => "Sehr hoch (Winkel- und Tiefenkontrolle)", 'en' => "Very high (angle and depth control)", 'fr' => "Très élevée (contrôle de l'angle et de la profondeur)", 'nl' => "Zeer hoog (hoek- en dieptecontrole)", 'it' => "Molto alta (controllo di angolo e profondità)", 'tr' => "Çok yüksek (açı ve derinlik kontrolü)"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t21'] ?? null, ['de' => "Sehr hoch (Winkel- und Tiefenkontrolle)", 'en' => "Very high (angle and depth control)", 'fr' => "Très élevée (contrôle de l'angle et de la profondeur)", 'nl' => "Zeer hoog (hoek- en dieptecontrole)", 'it' => "Molto alta (controllo di angolo e profondità)", 'tr' => "Çok yüksek (açı ve derinlik kontrolü)"], $currentLang) ?></td></tr>
      <tr><td data-ckey="umfasst.t22"<?= apex_cms_attrs_or($cmsService['umfasst']['t22'] ?? null, ['de' => "Typische Sitzungsdauer", 'en' => "Typical session length", 'fr' => "Durée de séance typique", 'nl' => "Typische sessieduur", 'it' => "Durata tipica della seduta", 'tr' => "Tipik Seans Süresi"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t22'] ?? null, ['de' => "Typische Sitzungsdauer", 'en' => "Typical session length", 'fr' => "Durée de séance typique", 'nl' => "Typische sessieduur", 'it' => "Durata tipica della seduta", 'tr' => "Tipik Seans Süresi"], $currentLang) ?></td><td data-ckey="umfasst.t23"<?= apex_cms_attrs_or($cmsService['umfasst']['t23'] ?? null, ['de' => "5 bis 8 Stunden", 'en' => "5 to 8 hours", 'fr' => "5 à 8 heures", 'nl' => "5 tot 8 uur", 'it' => "5-8 ore", 'tr' => "5 ila 8 saat"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t23'] ?? null, ['de' => "5 bis 8 Stunden", 'en' => "5 to 8 hours", 'fr' => "5 à 8 heures", 'nl' => "5 tot 8 uur", 'it' => "5-8 ore", 'tr' => "5 ila 8 saat"], $currentLang) ?></td><td data-ckey="umfasst.t24"<?= apex_cms_attrs_or($cmsService['umfasst']['t24'] ?? null, ['de' => "6 bis 10 Stunden", 'en' => "6 to 10 hours", 'fr' => "6 à 10 heures", 'nl' => "6 tot 10 uur", 'it' => "6-10 ore", 'tr' => "6 ila 10 saat"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t24'] ?? null, ['de' => "6 bis 10 Stunden", 'en' => "6 to 10 hours", 'fr' => "6 à 10 heures", 'nl' => "6 tot 10 uur", 'it' => "6-10 ore", 'tr' => "6 ila 10 saat"], $currentLang) ?></td></tr>
      <tr><td data-ckey="umfasst.t25"<?= apex_cms_attrs_or($cmsService['umfasst']['t25'] ?? null, ['de' => "Relative Kosten", 'en' => "Relative cost", 'fr' => "Coût relatif", 'nl' => "Relatieve kosten", 'it' => "Costo relativo", 'tr' => "Göreceli Maliyet"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t25'] ?? null, ['de' => "Relative Kosten", 'en' => "Relative cost", 'fr' => "Coût relatif", 'nl' => "Relatieve kosten", 'it' => "Costo relativo", 'tr' => "Göreceli Maliyet"], $currentLang) ?></td><td data-ckey="umfasst.t26"<?= apex_cms_attrs_or($cmsService['umfasst']['t26'] ?? null, ['de' => "Moderat", 'en' => "Moderate", 'fr' => "Modéré", 'nl' => "Matig", 'it' => "Moderato", 'tr' => "Orta"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t26'] ?? null, ['de' => "Moderat", 'en' => "Moderate", 'fr' => "Modéré", 'nl' => "Matig", 'it' => "Moderato", 'tr' => "Orta"], $currentLang) ?></td><td data-ckey="umfasst.t27"<?= apex_cms_attrs_or($cmsService['umfasst']['t27'] ?? null, ['de' => "Höher", 'en' => "Higher", 'fr' => "Plus élevé", 'nl' => "Hoger", 'it' => "Più elevato", 'tr' => "Daha Yüksek"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t27'] ?? null, ['de' => "Höher", 'en' => "Higher", 'fr' => "Plus élevé", 'nl' => "Hoger", 'it' => "Più elevato", 'tr' => "Daha Yüksek"], $currentLang) ?></td></tr>
      <tr><td data-ckey="umfasst.t28"<?= apex_cms_attrs_or($cmsService['umfasst']['t28'] ?? null, ['de' => "Kombinierbar?", 'en' => "Can be combined?", 'fr' => "Combinable ?", 'nl' => "Combineerbaar?", 'it' => "Combinabile?", 'tr' => "Birlikte Kullanılabilir mi?"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t28'] ?? null, ['de' => "Kombinierbar?", 'en' => "Can be combined?", 'fr' => "Combinable ?", 'nl' => "Combineerbaar?", 'it' => "Combinabile?", 'tr' => "Birlikte Kullanılabilir mi?"], $currentLang) ?></td><td data-ckey="umfasst.t29"<?= apex_cms_attrs_or($cmsService['umfasst']['t29'] ?? null, ['de' => "Ja", 'en' => "Yes", 'fr' => "Oui", 'nl' => "Ja", 'it' => "Sì", 'tr' => "Evet"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t29'] ?? null, ['de' => "Ja", 'en' => "Yes", 'fr' => "Oui", 'nl' => "Ja", 'it' => "Sì", 'tr' => "Evet"], $currentLang) ?></td><td data-ckey="umfasst.t30"<?= apex_cms_attrs_or($cmsService['umfasst']['t30'] ?? null, ['de' => "Ja, DHI für Ansatz + Saphir-FUE für Oberkopf ist gängig", 'en' => "Yes, DHI for hairline + Sapphire FUE for crown is common", 'fr' => "Oui, DHI pour la ligne frontale + FUE au saphir pour le sommet est courant", 'nl' => "Ja, DHI voor de haarlijn + Saffier-FUE voor de kruin is gebruikelijk", 'it' => "Sì, DHI per l'attaccatura + Saphire-FUE per il vertice è una combinazione comune", 'tr' => "Evet, saç çizgisi için DHI + tepe için Safir FUE kombinasyonu yaygındır"]) ?>><?= apex_cms_value_or($cmsService['umfasst']['t30'] ?? null, ['de' => "Ja, DHI für Ansatz + Saphir-FUE für Oberkopf ist gängig", 'en' => "Yes, DHI for hairline + Sapphire FUE for crown is common", 'fr' => "Oui, DHI pour la ligne frontale + FUE au saphir pour le sommet est courant", 'nl' => "Ja, DHI voor de haarlijn + Saffier-FUE voor de kruin is gebruikelijk", 'it' => "Sì, DHI per l'attaccatura + Saphire-FUE per il vertice è una combinazione comune", 'tr' => "Evet, saç çizgisi için DHI + tepe için Safir FUE kombinasyonu yaygındır"], $currentLang) ?></td></tr>
    </table>
  </div>
</section>

<section class="hp-section alt" id="geeignet">
  <div class="hp-section-in">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gSvcCheck" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gSvcCheck)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M18 32l9 9 19-19" stroke="#fff" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
    <div>
      <h2 data-ckey="geeignet.heading"<?= apex_cms_attrs_or($cmsService['geeignet']['heading'] ?? null, ['de' => "Wer ist geeignet?", 'en' => "Who is a suitable candidate?", 'fr' => "Qui est un bon candidat ?", 'nl' => "Wie komt in aanmerking?", 'it' => "Chi è un candidato idoneo?", 'tr' => "Kimler Uygun Adaydır?"]) ?>><?= apex_cms_value_or($cmsService['geeignet']['heading'] ?? null, ['de' => "Wer ist geeignet?", 'en' => "Who is a suitable candidate?", 'fr' => "Qui est un bon candidat ?", 'nl' => "Wie komt in aanmerking?", 'it' => "Chi è un candidato idoneo?", 'tr' => "Kimler Uygun Adaydır?"], $currentLang) ?></h2>
      <p data-ckey="geeignet.body"<?= apex_cms_attrs_or($cmsService['geeignet']['body'] ?? null, ['de' => "Eine kostenlose Beratung mit Haaranalyse gibt eine präzise, individuelle Einschätzung.", 'en' => "A free consultation with scalp analysis gives a precise, individual assessment.", 'fr' => "Une consultation gratuite avec analyse du cuir chevelu permet une évaluation précise et individuelle.", 'nl' => "Een gratis consult met hoofdhuidanalyse geeft een nauwkeurige, individuele inschatting.", 'it' => "Un consulto gratuito con analisi del cuoio capelluto fornisce una valutazione precisa e personalizzata.", 'tr' => "Saç derisi analizi içeren ücretsiz bir danışma, hassas ve kişiye özel bir değerlendirme sağlar."]) ?>><?= apex_cms_value_or($cmsService['geeignet']['body'] ?? null, ['de' => "Eine kostenlose Beratung mit Haaranalyse gibt eine präzise, individuelle Einschätzung.", 'en' => "A free consultation with scalp analysis gives a precise, individual assessment.", 'fr' => "Une consultation gratuite avec analyse du cuir chevelu permet une évaluation précise et individuelle.", 'nl' => "Een gratis consult met hoofdhuidanalyse geeft een nauwkeurige, individuele inschatting.", 'it' => "Un consulto gratuito con analisi del cuoio capelluto fornisce una valutazione precisa e personalizzata.", 'tr' => "Saç derisi analizi içeren ücretsiz bir danışma, hassas ve kişiye özel bir değerlendirme sağlar."], $currentLang) ?></p>
    </div>
  </div>
  <div class="hp-checklist">
    <div class="hp-check"><span class="tick">✓</span><p data-ckey="geeignet.t1"<?= apex_cms_attrs_or($cmsService['geeignet']['t1'] ?? null, ['de' => "Androgenetische Alopezie in einer stabilen Phase (der Ausfall hat sich verlangsamt oder stabilisiert).", 'en' => "Androgenetic alopecia in a stable phase (loss has slowed or stabilised).", 'fr' => "Alopécie androgénétique en phase stable (la chute a ralenti ou s'est stabilisée).", 'nl' => "Androgenetische alopecia in een stabiele fase (het uitvallen is vertraagd of gestabiliseerd).", 'it' => "Alopecia androgenetica in fase stabile (la caduta è rallentata o si è stabilizzata).", 'tr' => "Stabil evrede androgenetik alopesi (dökülme yavaşlamış veya durmuş)."]) ?>><?= apex_cms_value_or($cmsService['geeignet']['t1'] ?? null, ['de' => "Androgenetische Alopezie in einer stabilen Phase (der Ausfall hat sich verlangsamt oder stabilisiert).", 'en' => "Androgenetic alopecia in a stable phase (loss has slowed or stabilised).", 'fr' => "Alopécie androgénétique en phase stable (la chute a ralenti ou s'est stabilisée).", 'nl' => "Androgenetische alopecia in een stabiele fase (het uitvallen is vertraagd of gestabiliseerd).", 'it' => "Alopecia androgenetica in fase stabile (la caduta è rallentata o si è stabilizzata).", 'tr' => "Stabil evrede androgenetik alopesi (dökülme yavaşlamış veya durmuş)."], $currentLang) ?></p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-ckey="geeignet.t2"<?= apex_cms_attrs_or($cmsService['geeignet']['t2'] ?? null, ['de' => "Ausreichende Spenderdichte an Hinterkopf und Seiten.", 'en' => "Adequate donor density at the back and sides of the scalp.", 'fr' => "Densité donneuse suffisante à l'arrière et sur les côtés du cuir chevelu.", 'nl' => "Voldoende donordichtheid aan achterhoofd en zijkanten.", 'it' => "Densità donatrice adeguata sul retro e ai lati del cuoio capelluto.", 'tr' => "Saç derisinin arka ve yan bölgelerinde yeterli donör yoğunluğu."]) ?>><?= apex_cms_value_or($cmsService['geeignet']['t2'] ?? null, ['de' => "Ausreichende Spenderdichte an Hinterkopf und Seiten.", 'en' => "Adequate donor density at the back and sides of the scalp.", 'fr' => "Densité donneuse suffisante à l'arrière et sur les côtés du cuir chevelu.", 'nl' => "Voldoende donordichtheid aan achterhoofd en zijkanten.", 'it' => "Densità donatrice adeguata sul retro e ai lati del cuoio capelluto.", 'tr' => "Saç derisinin arka ve yan bölgelerinde yeterli donör yoğunluğu."], $currentLang) ?></p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-ckey="geeignet.t3"<?= apex_cms_attrs_or($cmsService['geeignet']['t3'] ?? null, ['de' => "Realistische Erwartungen: eine Transplantation stellt Dichte wieder her, repliziert aber nicht die volle Haarfülle der Jugend.", 'en' => "Realistic expectations: a transplant restores density but cannot replicate the full hair of early youth.", 'fr' => "Attentes réalistes : une greffe restaure la densité mais ne peut pas reproduire la pleine chevelure de la jeunesse.", 'nl' => "Realistische verwachtingen: een transplantatie herstelt dichtheid maar reproduceert niet de volledige haardracht van de jeugd.", 'it' => "Aspettative realistiche: un trapianto ripristina la densità ma non può replicare la piena capigliatura giovanile.", 'tr' => "Gerçekçi beklentiler: bir nakil yoğunluğu geri kazandırır ancak gençlik dönemindeki tam saç yoğunluğunu tekrar oluşturamaz."]) ?>><?= apex_cms_value_or($cmsService['geeignet']['t3'] ?? null, ['de' => "Realistische Erwartungen: eine Transplantation stellt Dichte wieder her, repliziert aber nicht die volle Haarfülle der Jugend.", 'en' => "Realistic expectations: a transplant restores density but cannot replicate the full hair of early youth.", 'fr' => "Attentes réalistes : une greffe restaure la densité mais ne peut pas reproduire la pleine chevelure de la jeunesse.", 'nl' => "Realistische verwachtingen: een transplantatie herstelt dichtheid maar reproduceert niet de volledige haardracht van de jeugd.", 'it' => "Aspettative realistiche: un trapianto ripristina la densità ma non può replicare la piena capigliatura giovanile.", 'tr' => "Gerçekçi beklentiler: bir nakil yoğunluğu geri kazandırır ancak gençlik dönemindeki tam saç yoğunluğunu tekrar oluşturamaz."], $currentLang) ?></p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-ckey="geeignet.t4"<?= apex_cms_attrs_or($cmsService['geeignet']['t4'] ?? null, ['de' => "Guter allgemeiner Gesundheitszustand, keine aktiven Infektionen oder unbehandelten Autoimmunerkrankungen.", 'en' => "Good general health, no active infections or untreated autoimmune conditions.", 'fr' => "Bon état de santé général, aucune infection active ni maladie auto-immune non traitée.", 'nl' => "Goede algemene gezondheid, geen actieve infecties of onbehandelde auto-immuunaandoeningen.", 'it' => "Buono stato di salute generale, nessuna infezione attiva o condizione autoimmune non trattata.", 'tr' => "İyi genel sağlık durumu, aktif enfeksiyon veya tedavi edilmemiş otoimmün hastalık bulunmaması."]) ?>><?= apex_cms_value_or($cmsService['geeignet']['t4'] ?? null, ['de' => "Guter allgemeiner Gesundheitszustand, keine aktiven Infektionen oder unbehandelten Autoimmunerkrankungen.", 'en' => "Good general health, no active infections or untreated autoimmune conditions.", 'fr' => "Bon état de santé général, aucune infection active ni maladie auto-immune non traitée.", 'nl' => "Goede algemene gezondheid, geen actieve infecties of onbehandelde auto-immuunaandoeningen.", 'it' => "Buono stato di salute generale, nessuna infezione attiva o condizione autoimmune non trattata.", 'tr' => "İyi genel sağlık durumu, aktif enfeksiyon veya tedavi edilmemiş otoimmün hastalık bulunmaması."], $currentLang) ?></p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-ckey="geeignet.t5"<?= apex_cms_attrs_or($cmsService['geeignet']['t5'] ?? null, ['de' => "Frauen mit androgenetischer Alopezie können ebenfalls geeignete Kandidatinnen sein. Bei diffusem Haarausfall über die gesamte Kopfhaut reicht die stabile Spenderdichte jedoch oft nicht aus, eine fachärztliche Beurteilung ist essenziell.", 'en' => "Women with androgenetic alopecia can also be suitable candidates. With diffuse hair loss across the entire scalp, stable donor density is often insufficient, so a specialist assessment is essential.", 'fr' => "Les femmes atteintes d'alopécie androgénétique peuvent également être de bonnes candidates. En cas de chute de cheveux diffuse sur l'ensemble du cuir chevelu, la densité donneuse stable est souvent insuffisante, une évaluation par un spécialiste est donc essentielle.", 'nl' => "Vrouwen met androgenetische alopecia kunnen ook geschikte kandidaten zijn. Bij diffuse haaruitval over de hele hoofdhuid is de stabiele donordichtheid vaak onvoldoende, dus een beoordeling door een specialist is essentieel.", 'it' => "Anche le donne con alopecia androgenetica possono essere candidate idonee. In caso di caduta diffusa dei capelli su tutto il cuoio capelluto, la densità donatrice stabile è spesso insufficiente, quindi una valutazione specialistica è essenziale.", 'tr' => "Androgenetik alopesisi olan kadınlar da uygun aday olabilir. Tüm saç derisinde yaygın saç dökülmesi durumunda kararlı donör yoğunluğu genellikle yetersiz kalır, bu nedenle uzman değerlendirmesi şarttır."]) ?>><?= apex_cms_value_or($cmsService['geeignet']['t5'] ?? null, ['de' => "Frauen mit androgenetischer Alopezie können ebenfalls geeignete Kandidatinnen sein. Bei diffusem Haarausfall über die gesamte Kopfhaut reicht die stabile Spenderdichte jedoch oft nicht aus, eine fachärztliche Beurteilung ist essenziell.", 'en' => "Women with androgenetic alopecia can also be suitable candidates. With diffuse hair loss across the entire scalp, stable donor density is often insufficient, so a specialist assessment is essential.", 'fr' => "Les femmes atteintes d'alopécie androgénétique peuvent également être de bonnes candidates. En cas de chute de cheveux diffuse sur l'ensemble du cuir chevelu, la densité donneuse stable est souvent insuffisante, une évaluation par un spécialiste est donc essentielle.", 'nl' => "Vrouwen met androgenetische alopecia kunnen ook geschikte kandidaten zijn. Bij diffuse haaruitval over de hele hoofdhuid is de stabiele donordichtheid vaak onvoldoende, dus een beoordeling door een specialist is essentieel.", 'it' => "Anche le donne con alopecia androgenetica possono essere candidate idonee. In caso di caduta diffusa dei capelli su tutto il cuoio capelluto, la densità donatrice stabile è spesso insufficiente, quindi una valutazione specialistica è essenziale.", 'tr' => "Androgenetik alopesisi olan kadınlar da uygun aday olabilir. Tüm saç derisinde yaygın saç dökülmesi durumunda kararlı donör yoğunluğu genellikle yetersiz kalır, bu nedenle uzman değerlendirmesi şarttır."], $currentLang) ?></p></div>
  </div>
  </div>
</section>

<section class="hp-section" id="genesung-service">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gSvcCal" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gSvcCal)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="15" y="18" width="34" height="28" rx="5" fill="none" stroke="#fff" stroke-width="2.6"/><line x1="15" y1="27" x2="49" y2="27" stroke="#fff" stroke-width="2.6"/></svg>
    <div>
      <h2 data-ckey="genesungService.heading"<?= apex_cms_attrs_or($cmsService['genesungService']['heading'] ?? null, ['de' => "Genesung &amp; Nachsorge", 'en' => "Recovery &amp; aftercare", 'fr' => "Récupération et suivi", 'nl' => "Herstel &amp; nazorg", 'it' => "Recupero e assistenza post-operatoria", 'tr' => "İyileşme ve Bakım"]) ?>><?= apex_cms_value_or($cmsService['genesungService']['heading'] ?? null, ['de' => "Genesung &amp; Nachsorge", 'en' => "Recovery &amp; aftercare", 'fr' => "Récupération et suivi", 'nl' => "Herstel &amp; nazorg", 'it' => "Recupero e assistenza post-operatoria", 'tr' => "İyileşme ve Bakım"], $currentLang) ?></h2>
      <p data-ckey="genesungService.body"<?= apex_cms_attrs_or($cmsService['genesungService']['body'] ?? null, ['de' => "Die Erholungsphase ist genauso wichtig wie der Eingriff selbst. Sie bestimmt Graft-Überleben, Heilungsqualität und Endergebnis.", 'en' => "The recovery period matters as much as the procedure itself. It determines graft survival, healing quality, and the final result.", 'fr' => "La période de récupération compte autant que l'intervention elle-même. Elle détermine la survie des greffons, la qualité de la cicatrisation et le résultat final.", 'nl' => "De hersteltijd is net zo belangrijk als de ingreep zelf. Deze bepaalt de overleving van de grafts, de kwaliteit van de genezing en het eindresultaat.", 'it' => "Il periodo di recupero è importante quanto l'intervento stesso. Determina la sopravvivenza degli innesti, la qualità della guarigione e il risultato finale.", 'tr' => "İyileşme süreci, işlemin kendisi kadar önemlidir. Greft sağkalımını, iyileşme kalitesini ve nihai sonucu belirler."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['body'] ?? null, ['de' => "Die Erholungsphase ist genauso wichtig wie der Eingriff selbst. Sie bestimmt Graft-Überleben, Heilungsqualität und Endergebnis.", 'en' => "The recovery period matters as much as the procedure itself. It determines graft survival, healing quality, and the final result.", 'fr' => "La période de récupération compte autant que l'intervention elle-même. Elle détermine la survie des greffons, la qualité de la cicatrisation et le résultat final.", 'nl' => "De hersteltijd is net zo belangrijk als de ingreep zelf. Deze bepaalt de overleving van de grafts, de kwaliteit van de genezing en het eindresultaat.", 'it' => "Il periodo di recupero è importante quanto l'intervento stesso. Determina la sopravvivenza degli innesti, la qualità della guarigione e il risultato finale.", 'tr' => "İyileşme süreci, işlemin kendisi kadar önemlidir. Greft sağkalımını, iyileşme kalitesini ve nihai sonucu belirler."], $currentLang) ?></p>
    </div>
  </div>
  <div class="hp-timeline" style="margin-bottom:44px">
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-ckey="genesungService.t1"<?= apex_cms_attrs_or($cmsService['genesungService']['t1'] ?? null, ['de' => "Tag 1 bis 7", 'en' => "Day 1 to 7", 'fr' => "Jour 1 à 7", 'nl' => "Dag 1 tot 7", 'it' => "Giorno 1-7", 'tr' => "1. ile 7. Gün"]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t1'] ?? null, ['de' => "Tag 1 bis 7", 'en' => "Day 1 to 7", 'fr' => "Jour 1 à 7", 'nl' => "Dag 1 tot 7", 'it' => "Giorno 1-7", 'tr' => "1. ile 7. Gün"], $currentLang) ?></div><h4 data-ckey="genesungService.t2"<?= apex_cms_attrs_or($cmsService['genesungService']['t2'] ?? null, ['de' => "Erste Heilung", 'en' => "Initial healing", 'fr' => "Cicatrisation initiale", 'nl' => "Eerste genezing", 'it' => "Guarigione iniziale", 'tr' => "İlk İyileşme"]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t2'] ?? null, ['de' => "Erste Heilung", 'en' => "Initial healing", 'fr' => "Cicatrisation initiale", 'nl' => "Eerste genezing", 'it' => "Guarigione iniziale", 'tr' => "İlk İyileşme"], $currentLang) ?></h4><p data-ckey="genesungService.t3"<?= apex_cms_attrs_or($cmsService['genesungService']['t3'] ?? null, ['de' => "Kleine Krusten bilden sich, Rötung und leichte Schwellung um Stirn und Augen sind normal. Kopf erhöht schlafen, Kopfhaut nicht berühren.", 'en' => "Small scabs form, redness and mild swelling around the forehead and eyes is common. Sleep with the head elevated, avoid touching the scalp.", 'fr' => "De petites croûtes se forment, des rougeurs et un léger gonflement autour du front et des yeux sont normaux. Dormir la tête surélevée, éviter de toucher le cuir chevelu.", 'nl' => "Kleine korstjes vormen zich, roodheid en lichte zwelling rond voorhoofd en ogen zijn normaal. Slaap met het hoofd omhoog, raak de hoofdhuid niet aan.", 'it' => "Si formano piccole croste, arrossamento e lieve gonfiore intorno alla fronte e agli occhi sono normali. Dormire con la testa sollevata, evitare di toccare il cuoio capelluto.", 'tr' => "Küçük kabuklar oluşur, alın ve göz çevresinde kızarıklık ve hafif şişlik normaldir. Baş yükseltilmiş şekilde uyuyun, saç derisine dokunmaktan kaçının."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t3'] ?? null, ['de' => "Kleine Krusten bilden sich, Rötung und leichte Schwellung um Stirn und Augen sind normal. Kopf erhöht schlafen, Kopfhaut nicht berühren.", 'en' => "Small scabs form, redness and mild swelling around the forehead and eyes is common. Sleep with the head elevated, avoid touching the scalp.", 'fr' => "De petites croûtes se forment, des rougeurs et un léger gonflement autour du front et des yeux sont normaux. Dormir la tête surélevée, éviter de toucher le cuir chevelu.", 'nl' => "Kleine korstjes vormen zich, roodheid en lichte zwelling rond voorhoofd en ogen zijn normaal. Slaap met het hoofd omhoog, raak de hoofdhuid niet aan.", 'it' => "Si formano piccole croste, arrossamento e lieve gonfiore intorno alla fronte e agli occhi sono normali. Dormire con la testa sollevata, evitare di toccare il cuoio capelluto.", 'tr' => "Küçük kabuklar oluşur, alın ve göz çevresinde kızarıklık ve hafif şişlik normaldir. Baş yükseltilmiş şekilde uyuyun, saç derisine dokunmaktan kaçının."], $currentLang) ?></p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-ckey="genesungService.t4"<?= apex_cms_attrs_or($cmsService['genesungService']['t4'] ?? null, ['de' => "Woche 2 bis 4", 'en' => "Weeks 2 to 4", 'fr' => "Semaines 2 à 4", 'nl' => "Week 2 tot 4", 'it' => "Settimane 2-4", 'tr' => "2. ile 4. Hafta"]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t4'] ?? null, ['de' => "Woche 2 bis 4", 'en' => "Weeks 2 to 4", 'fr' => "Semaines 2 à 4", 'nl' => "Week 2 tot 4", 'it' => "Settimane 2-4", 'tr' => "2. ile 4. Hafta"], $currentLang) ?></div><h4 data-ckey="genesungService.t5"<?= apex_cms_attrs_or($cmsService['genesungService']['t5'] ?? null, ['de' => "Schock-Verlust", 'en' => "Shock loss", 'fr' => "Chute de choc", 'nl' => "Shockverlies", 'it' => "Shock loss", 'tr' => "Şok Dökülmesi"]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t5'] ?? null, ['de' => "Schock-Verlust", 'en' => "Shock loss", 'fr' => "Chute de choc", 'nl' => "Shockverlies", 'it' => "Shock loss", 'tr' => "Şok Dökülmesi"], $currentLang) ?></h4><p data-ckey="genesungService.t6"<?= apex_cms_attrs_or($cmsService['genesungService']['t6'] ?? null, ['de' => "Bis zu 90% der transplantierten Haarschäfte fallen aus. Das ist völlig normal, die Follikel selbst bleiben unter der Kopfhaut aktiv.", 'en' => "Up to 90% of transplanted hair shafts shed. This is completely normal; the follicles themselves remain alive beneath the scalp.", 'fr' => "Jusqu'à 90% des tiges capillaires transplantées tombent. C'est tout à fait normal, les follicules eux-mêmes restent actifs sous le cuir chevelu.", 'nl' => "Tot 90% van de getransplanteerde haarschachten valt uit. Dit is volkomen normaal; de follikels zelf blijven actief onder de hoofdhuid.", 'it' => "Fino al 90% dei fusti di capelli trapiantati cade. È del tutto normale; i follicoli stessi rimangono vivi sotto il cuoio capelluto.", 'tr' => "Nakledilen saç tellerinin %90'a kadarı dökülür. Bu tamamen normaldir; foliküllerin kendisi saç derisi altında aktif kalır."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t6'] ?? null, ['de' => "Bis zu 90% der transplantierten Haarschäfte fallen aus. Das ist völlig normal, die Follikel selbst bleiben unter der Kopfhaut aktiv.", 'en' => "Up to 90% of transplanted hair shafts shed. This is completely normal; the follicles themselves remain alive beneath the scalp.", 'fr' => "Jusqu'à 90% des tiges capillaires transplantées tombent. C'est tout à fait normal, les follicules eux-mêmes restent actifs sous le cuir chevelu.", 'nl' => "Tot 90% van de getransplanteerde haarschachten valt uit. Dit is volkomen normaal; de follikels zelf blijven actief onder de hoofdhuid.", 'it' => "Fino al 90% dei fusti di capelli trapiantati cade. È del tutto normale; i follicoli stessi rimangono vivi sotto il cuoio capelluto.", 'tr' => "Nakledilen saç tellerinin %90'a kadarı dökülür. Bu tamamen normaldir; foliküllerin kendisi saç derisi altında aktif kalır."], $currentLang) ?></p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-ckey="genesungService.t7"<?= apex_cms_attrs_or($cmsService['genesungService']['t7'] ?? null, ['de' => "Monat 3 bis 6", 'en' => "Months 3 to 6", 'fr' => "Mois 3 à 6", 'nl' => "Maand 3 tot 6", 'it' => "Mese 3-6", 'tr' => "3. ile 6. Ay"]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t7'] ?? null, ['de' => "Monat 3 bis 6", 'en' => "Months 3 to 6", 'fr' => "Mois 3 à 6", 'nl' => "Maand 3 tot 6", 'it' => "Mese 3-6", 'tr' => "3. ile 6. Ay"], $currentLang) ?></div><h4 data-ckey="genesungService.t8"<?= apex_cms_attrs_or($cmsService['genesungService']['t8'] ?? null, ['de' => "Sichtbares Wachstum beginnt", 'en' => "Visible growth begins", 'fr' => "La croissance visible commence", 'nl' => "Zichtbare groei begint", 'it' => "Inizia la crescita visibile", 'tr' => "Görünür Büyüme Başlar"]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t8'] ?? null, ['de' => "Sichtbares Wachstum beginnt", 'en' => "Visible growth begins", 'fr' => "La croissance visible commence", 'nl' => "Zichtbare groei begint", 'it' => "Inizia la crescita visibile", 'tr' => "Görünür Büyüme Başlar"], $currentLang) ?></h4><p data-ckey="genesungService.t9"<?= apex_cms_attrs_or($cmsService['genesungService']['t9'] ?? null, ['de' => "Feine neue Haare erscheinen und verdicken sich allmählich. Bis Monat 6 sind rund 40 bis 60% des Endergebnisses sichtbar.", 'en' => "Fine new hairs emerge and gradually thicken. By month 6, around 40 to 60% of the final result is visible.", 'fr' => "De fins nouveaux cheveux apparaissent et s'épaississent progressivement. Au mois 6, environ 40 à 60% du résultat final sont visibles.", 'nl' => "Fijne nieuwe haren verschijnen en worden geleidelijk dikker. Tegen maand 6 is ongeveer 40 tot 60% van het eindresultaat zichtbaar.", 'it' => "Compaiono nuovi capelli sottili che si ispessiscono gradualmente. Entro il mese 6, è visibile circa il 40-60% del risultato finale.", 'tr' => "İnce yeni saçlar belirir ve giderek kalınlaşır. 6. aya kadar nihai sonucun yaklaşık %40 ila %60'ı görünür hale gelir."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t9'] ?? null, ['de' => "Feine neue Haare erscheinen und verdicken sich allmählich. Bis Monat 6 sind rund 40 bis 60% des Endergebnisses sichtbar.", 'en' => "Fine new hairs emerge and gradually thicken. By month 6, around 40 to 60% of the final result is visible.", 'fr' => "De fins nouveaux cheveux apparaissent et s'épaississent progressivement. Au mois 6, environ 40 à 60% du résultat final sont visibles.", 'nl' => "Fijne nieuwe haren verschijnen en worden geleidelijk dikker. Tegen maand 6 is ongeveer 40 tot 60% van het eindresultaat zichtbaar.", 'it' => "Compaiono nuovi capelli sottili che si ispessiscono gradualmente. Entro il mese 6, è visibile circa il 40-60% del risultato finale.", 'tr' => "İnce yeni saçlar belirir ve giderek kalınlaşır. 6. aya kadar nihai sonucun yaklaşık %40 ila %60'ı görünür hale gelir."], $currentLang) ?></p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-ckey="genesungService.t10"<?= apex_cms_attrs_or($cmsService['genesungService']['t10'] ?? null, ['de' => "Monat 6 bis 9", 'en' => "Months 6 to 9", 'fr' => "Mois 6 à 9", 'nl' => "Maand 6 tot 9", 'it' => "Mese 6-9", 'tr' => "6. ile 9. Ay"]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t10'] ?? null, ['de' => "Monat 6 bis 9", 'en' => "Months 6 to 9", 'fr' => "Mois 6 à 9", 'nl' => "Maand 6 tot 9", 'it' => "Mese 6-9", 'tr' => "6. ile 9. Ay"], $currentLang) ?></div><h4 data-ckey="genesungService.t11"<?= apex_cms_attrs_or($cmsService['genesungService']['t11'] ?? null, ['de' => "Die Dichte verbessert sich", 'en' => "Density improves", 'fr' => "La densité s'améliore", 'nl' => "De dichtheid verbetert", 'it' => "La densità migliora", 'tr' => "Yoğunluk Artıyor"]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t11'] ?? null, ['de' => "Die Dichte verbessert sich", 'en' => "Density improves", 'fr' => "La densité s'améliore", 'nl' => "De dichtheid verbetert", 'it' => "La densità migliora", 'tr' => "Yoğunluk Artıyor"], $currentLang) ?></h4><p data-ckey="genesungService.t12"<?= apex_cms_attrs_or($cmsService['genesungService']['t12'] ?? null, ['de' => "Das Haar wird spürbar dicker und dunkler. Rund 80% der Grafts sind zu diesem Zeitpunkt durchgebrochen.", 'en' => "Hair becomes noticeably thicker and darker. Around 80% of grafts have broken through by this point.", 'fr' => "Les cheveux deviennent nettement plus épais et plus foncés. Environ 80% des greffons ont percé à ce stade.", 'nl' => "Het haar wordt merkbaar dikker en donkerder. Op dit punt is ongeveer 80% van de grafts doorgebroken.", 'it' => "I capelli diventano notevolmente più spessi e scuri. A questo punto circa l'80% degli innesti è emerso.", 'tr' => "Saçlar belirgin şekilde kalınlaşır ve koyulaşır. Bu noktada greftlerin yaklaşık %80'i çıkmış olur."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t12'] ?? null, ['de' => "Das Haar wird spürbar dicker und dunkler. Rund 80% der Grafts sind zu diesem Zeitpunkt durchgebrochen.", 'en' => "Hair becomes noticeably thicker and darker. Around 80% of grafts have broken through by this point.", 'fr' => "Les cheveux deviennent nettement plus épais et plus foncés. Environ 80% des greffons ont percé à ce stade.", 'nl' => "Het haar wordt merkbaar dikker en donkerder. Op dit punt is ongeveer 80% van de grafts doorgebroken.", 'it' => "I capelli diventano notevolmente più spessi e scuri. A questo punto circa l'80% degli innesti è emerso.", 'tr' => "Saçlar belirgin şekilde kalınlaşır ve koyulaşır. Bu noktada greftlerin yaklaşık %80'i çıkmış olur."], $currentLang) ?></p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-ckey="genesungService.t13"<?= apex_cms_attrs_or($cmsService['genesungService']['t13'] ?? null, ['de' => "Monat 12 bis 18", 'en' => "Months 12 to 18", 'fr' => "Mois 12 à 18", 'nl' => "Maand 12 tot 18", 'it' => "Mese 12-18", 'tr' => "12. ile 18. Ay"]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t13'] ?? null, ['de' => "Monat 12 bis 18", 'en' => "Months 12 to 18", 'fr' => "Mois 12 à 18", 'nl' => "Maand 12 tot 18", 'it' => "Mese 12-18", 'tr' => "12. ile 18. Ay"], $currentLang) ?></div><h4 data-ckey="genesungService.t14"<?= apex_cms_attrs_or($cmsService['genesungService']['t14'] ?? null, ['de' => "Endgültige Verfeinerung", 'en' => "Final refinement", 'fr' => "Affinement final", 'nl' => "Definitieve verfijning", 'it' => "Rifinitura finale", 'tr' => "Son Rötuşlar"]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t14'] ?? null, ['de' => "Endgültige Verfeinerung", 'en' => "Final refinement", 'fr' => "Affinement final", 'nl' => "Definitieve verfijning", 'it' => "Rifinitura finale", 'tr' => "Son Rötuşlar"], $currentLang) ?></h4><p data-ckey="genesungService.t15"<?= apex_cms_attrs_or($cmsService['genesungService']['t15'] ?? null, ['de' => "Die letzten Haare reifen und verdicken sich. Das transplantierte Haar verschmilzt vollständig mit dem natürlichen Haar.", 'en' => "The last hairs mature and thicken. Transplanted hair fully blends with native hair.", 'fr' => "Les derniers cheveux mûrissent et s'épaississent. Les cheveux transplantés se fondent complètement avec les cheveux naturels.", 'nl' => "De laatste haren rijpen en worden dikker. Getransplanteerd haar vermengt zich volledig met natuurlijk haar.", 'it' => "Gli ultimi capelli maturano e si ispessiscono. I capelli trapiantati si fondono completamente con quelli naturali.", 'tr' => "Son saçlar olgunlaşır ve kalınlaşır. Nakledilen saç, doğal saçla tamamen kaynaşır."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t15'] ?? null, ['de' => "Die letzten Haare reifen und verdicken sich. Das transplantierte Haar verschmilzt vollständig mit dem natürlichen Haar.", 'en' => "The last hairs mature and thicken. Transplanted hair fully blends with native hair.", 'fr' => "Les derniers cheveux mûrissent et s'épaississent. Les cheveux transplantés se fondent complètement avec les cheveux naturels.", 'nl' => "De laatste haren rijpen en worden dikker. Getransplanteerd haar vermengt zich volledig met natuurlijk haar.", 'it' => "Gli ultimi capelli maturano e si ispessiscono. I capelli trapiantati si fondono completamente con quelli naturali.", 'tr' => "Son saçlar olgunlaşır ve kalınlaşır. Nakledilen saç, doğal saçla tamamen kaynaşır."], $currentLang) ?></p></div></div>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-ckey="genesungService.t16"<?= apex_cms_attrs_or($cmsService['genesungService']['t16'] ?? null, ['de' => "Die wichtigsten Nachsorgeregeln", 'en' => "Key aftercare rules", 'fr' => "Les règles de suivi essentielles", 'nl' => "De belangrijkste nazorgregels", 'it' => "Le regole di assistenza post-operatoria più importanti", 'tr' => "Temel Bakım Kuralları"]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t16'] ?? null, ['de' => "Die wichtigsten Nachsorgeregeln", 'en' => "Key aftercare rules", 'fr' => "Les règles de suivi essentielles", 'nl' => "De belangrijkste nazorgregels", 'it' => "Le regole di assistenza post-operatoria più importanti", 'tr' => "Temel Bakım Kuralları"], $currentLang) ?></h3>
  <div class="hp-rules">
    <div class="hp-rule"><span class="ric">📍</span><span data-ckey="genesungService.t17"<?= apex_cms_attrs_or($cmsService['genesungService']['t17'] ?? null, ['de' => "Keine direkte Sonne auf der Kopfhaut für mindestens 4 Wochen.", 'en' => "No direct sun exposure on the scalp for at least 4 weeks.", 'fr' => "Pas d'exposition directe au soleil sur le cuir chevelu pendant au moins 4 semaines.", 'nl' => "Geen directe zonlicht op de hoofdhuid gedurende ten minste 4 weken.", 'it' => "Nessuna esposizione diretta al sole sul cuoio capelluto per almeno 4 settimane.", 'tr' => "En az 4 hafta boyunca saç derisine doğrudan güneş ışığı almayın."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t17'] ?? null, ['de' => "Keine direkte Sonne auf der Kopfhaut für mindestens 4 Wochen.", 'en' => "No direct sun exposure on the scalp for at least 4 weeks.", 'fr' => "Pas d'exposition directe au soleil sur le cuir chevelu pendant au moins 4 semaines.", 'nl' => "Geen directe zonlicht op de hoofdhuid gedurende ten minste 4 weken.", 'it' => "Nessuna esposizione diretta al sole sul cuoio capelluto per almeno 4 settimane.", 'tr' => "En az 4 hafta boyunca saç derisine doğrudan güneş ışığı almayın."], $currentLang) ?></span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-ckey="genesungService.t18"<?= apex_cms_attrs_or($cmsService['genesungService']['t18'] ?? null, ['de' => "Kein Schwimmen (Pool, Meer, See) für mindestens 4 Wochen.", 'en' => "No swimming (pool, sea, or lake) for at least 4 weeks.", 'fr' => "Pas de baignade (piscine, mer, lac) pendant au moins 4 semaines.", 'nl' => "Niet zwemmen (zwembad, zee, meer) gedurende ten minste 4 weken.", 'it' => "Niente nuoto (piscina, mare, lago) per almeno 4 settimane.", 'tr' => "En az 4 hafta boyunca yüzmeyin (havuz, deniz, göl)."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t18'] ?? null, ['de' => "Kein Schwimmen (Pool, Meer, See) für mindestens 4 Wochen.", 'en' => "No swimming (pool, sea, or lake) for at least 4 weeks.", 'fr' => "Pas de baignade (piscine, mer, lac) pendant au moins 4 semaines.", 'nl' => "Niet zwemmen (zwembad, zee, meer) gedurende ten minste 4 weken.", 'it' => "Niente nuoto (piscina, mare, lago) per almeno 4 settimane.", 'tr' => "En az 4 hafta boyunca yüzmeyin (havuz, deniz, göl)."], $currentLang) ?></span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-ckey="genesungService.t19"<?= apex_cms_attrs_or($cmsService['genesungService']['t19'] ?? null, ['de' => "Kein intensiver Sport oder starkes Schwitzen für 2 bis 3 Wochen.", 'en' => "No intense exercise or heavy sweating for 2 to 3 weeks.", 'fr' => "Pas de sport intense ni de transpiration excessive pendant 2 à 3 semaines.", 'nl' => "Geen intensieve sport of overmatig zweten gedurende 2 tot 3 weken.", 'it' => "Nessun esercizio intenso o sudorazione eccessiva per 2-3 settimane.", 'tr' => "2-3 hafta boyunca yoğun spor yapmayın veya aşırı terlemekten kaçının."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t19'] ?? null, ['de' => "Kein intensiver Sport oder starkes Schwitzen für 2 bis 3 Wochen.", 'en' => "No intense exercise or heavy sweating for 2 to 3 weeks.", 'fr' => "Pas de sport intense ni de transpiration excessive pendant 2 à 3 semaines.", 'nl' => "Geen intensieve sport of overmatig zweten gedurende 2 tot 3 weken.", 'it' => "Nessun esercizio intenso o sudorazione eccessiva per 2-3 settimane.", 'tr' => "2-3 hafta boyunca yoğun spor yapmayın veya aşırı terlemekten kaçının."], $currentLang) ?></span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-ckey="genesungService.t20"<?= apex_cms_attrs_or($cmsService['genesungService']['t20'] ?? null, ['de' => "Kein Alkohol in der ersten Woche, er beeinträchtigt die Durchblutung.", 'en' => "No alcohol for the first week; it affects blood circulation.", 'fr' => "Pas d'alcool la première semaine, il nuit à la circulation sanguine.", 'nl' => "Geen alcohol in de eerste week, dit beïnvloedt de bloedcirculatie.", 'it' => "Niente alcol nella prima settimana, compromette la circolazione sanguigna.", 'tr' => "İlk hafta alkol almayın; kan dolaşımını olumsuz etkiler."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t20'] ?? null, ['de' => "Kein Alkohol in der ersten Woche, er beeinträchtigt die Durchblutung.", 'en' => "No alcohol for the first week; it affects blood circulation.", 'fr' => "Pas d'alcool la première semaine, il nuit à la circulation sanguine.", 'nl' => "Geen alcohol in de eerste week, dit beïnvloedt de bloedcirculatie.", 'it' => "Niente alcol nella prima settimana, compromette la circolazione sanguigna.", 'tr' => "İlk hafta alkol almayın; kan dolaşımını olumsuz etkiler."], $currentLang) ?></span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-ckey="genesungService.t21"<?= apex_cms_attrs_or($cmsService['genesungService']['t21'] ?? null, ['de' => "Nicht rauchen: Nikotin verengt die Blutgefäße und senkt die Graft-Überlebensrate.", 'en' => "No smoking: nicotine restricts blood supply and reduces graft survival.", 'fr' => "Ne pas fumer : la nicotine restreint l'apport sanguin et réduit la survie des greffons.", 'nl' => "Niet roken: nicotine beperkt de bloedtoevoer en vermindert de overleving van de grafts.", 'it' => "Non fumare: la nicotina riduce l'afflusso di sangue e diminuisce la sopravvivenza degli innesti.", 'tr' => "Sigara içmeyin: nikotin kan akışını kısıtlar ve greft sağkalımını azaltır."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t21'] ?? null, ['de' => "Nicht rauchen: Nikotin verengt die Blutgefäße und senkt die Graft-Überlebensrate.", 'en' => "No smoking: nicotine restricts blood supply and reduces graft survival.", 'fr' => "Ne pas fumer : la nicotine restreint l'apport sanguin et réduit la survie des greffons.", 'nl' => "Niet roken: nicotine beperkt de bloedtoevoer en vermindert de overleving van de grafts.", 'it' => "Non fumare: la nicotina riduce l'afflusso di sangue e diminuisce la sopravvivenza degli innesti.", 'tr' => "Sigara içmeyin: nikotin kan akışını kısıtlar ve greft sağkalımını azaltır."], $currentLang) ?></span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-ckey="genesungService.t22"<?= apex_cms_attrs_or($cmsService['genesungService']['t22'] ?? null, ['de' => "Kopf erhöht schlafen für die ersten 3 bis 5 Nächte.", 'en' => "Sleep with the head elevated for the first 3 to 5 nights.", 'fr' => "Dormir la tête surélevée pendant les 3 à 5 premières nuits.", 'nl' => "Slaap met het hoofd omhoog gedurende de eerste 3 tot 5 nachten.", 'it' => "Dormire con la testa sollevata per le prime 3-5 notti.", 'tr' => "İlk 3-5 gece başınızı yükseltilmiş şekilde uyuyun."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t22'] ?? null, ['de' => "Kopf erhöht schlafen für die ersten 3 bis 5 Nächte.", 'en' => "Sleep with the head elevated for the first 3 to 5 nights.", 'fr' => "Dormir la tête surélevée pendant les 3 à 5 premières nuits.", 'nl' => "Slaap met het hoofd omhoog gedurende de eerste 3 tot 5 nachten.", 'it' => "Dormire con la testa sollevata per le prime 3-5 notti.", 'tr' => "İlk 3-5 gece başınızı yükseltilmiş şekilde uyuyun."], $currentLang) ?></span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-ckey="genesungService.t23"<?= apex_cms_attrs_or($cmsService['genesungService']['t23'] ?? null, ['de' => "Sanft waschen nach Klinikanleitung, keinen starken Wasserstrahl direkt auf die Grafts.", 'en' => "Wash gently per the clinic's instructions; no strong water pressure directly on the grafts.", 'fr' => "Laver délicatement selon les instructions de la clinique, pas de jet d'eau puissant directement sur les greffons.", 'nl' => "Was voorzichtig volgens de instructies van de kliniek, geen sterke waterdruk direct op de grafts.", 'it' => "Lavare delicatamente secondo le istruzioni della clinica, senza getto d'acqua forte direttamente sugli innesti.", 'tr' => "Klinik talimatlarına göre nazikçe yıkayın, greftlerin üzerine doğrudan güçlü su akışı uygulamayın."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t23'] ?? null, ['de' => "Sanft waschen nach Klinikanleitung, keinen starken Wasserstrahl direkt auf die Grafts.", 'en' => "Wash gently per the clinic's instructions; no strong water pressure directly on the grafts.", 'fr' => "Laver délicatement selon les instructions de la clinique, pas de jet d'eau puissant directement sur les greffons.", 'nl' => "Was voorzichtig volgens de instructies van de kliniek, geen sterke waterdruk direct op de grafts.", 'it' => "Lavare delicatamente secondo le istruzioni della clinica, senza getto d'acqua forte direttamente sugli innesti.", 'tr' => "Klinik talimatlarına göre nazikçe yıkayın, greftlerin üzerine doğrudan güçlü su akışı uygulamayın."], $currentLang) ?></span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-ckey="genesungService.t24"<?= apex_cms_attrs_or($cmsService['genesungService']['t24'] ?? null, ['de' => "Alle Folgetermine wahrnehmen, manche Kliniken bieten Remote-Check-ins an.", 'en' => "Attend all follow-up appointments; some clinics offer remote check-ins.", 'fr' => "Assister à tous les rendez-vous de suivi ; certaines cliniques proposent des suivis à distance.", 'nl' => "Woon alle vervolgafspraken bij; sommige klinieken bieden externe check-ins aan.", 'it' => "Partecipare a tutti gli appuntamenti di follow-up; alcune cliniche offrono check-in a distanza.", 'tr' => "Tüm takip randevularına katılın; bazı klinikler uzaktan kontrol imkanı sunar."]) ?>><?= apex_cms_value_or($cmsService['genesungService']['t24'] ?? null, ['de' => "Alle Folgetermine wahrnehmen, manche Kliniken bieten Remote-Check-ins an.", 'en' => "Attend all follow-up appointments; some clinics offer remote check-ins.", 'fr' => "Assister à tous les rendez-vous de suivi ; certaines cliniques proposent des suivis à distance.", 'nl' => "Woon alle vervolgafspraken bij; sommige klinieken bieden externe check-ins aan.", 'it' => "Partecipare a tutti gli appuntamenti di follow-up; alcune cliniche offrono check-in a distanza.", 'tr' => "Tüm takip randevularına katılın; bazı klinikler uzaktan kontrol imkanı sunar."], $currentLang) ?></span></div>
  </div>
</section>

<section class="hp-section alt" id="ergebnisse">
  <div class="hp-section-in">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gSvcResult" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gSvcResult)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="27" cy="32" r="13" fill="#fff" opacity="0.5"/><circle cx="39" cy="32" r="13" fill="#fff" opacity="0.85"/></svg>
    <div>
      <h2 data-ckey="ergebnisse.heading"<?= apex_cms_attrs_or($cmsService['ergebnisse']['heading'] ?? null, ['de' => "Ergebnisse: was Sie realistisch erwarten können", 'en' => "Results: what to realistically expect", 'fr' => "Résultats : à quoi s'attendre réellement", 'nl' => "Resultaten: wat u realistisch kunt verwachten", 'it' => "Risultati: cosa aspettarsi realisticamente", 'tr' => "Sonuçlar: Gerçekçi Olarak Neler Beklenmeli"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['heading'] ?? null, ['de' => "Ergebnisse: was Sie realistisch erwarten können", 'en' => "Results: what to realistically expect", 'fr' => "Résultats : à quoi s'attendre réellement", 'nl' => "Resultaten: wat u realistisch kunt verwachten", 'it' => "Risultati: cosa aspettarsi realisticamente", 'tr' => "Sonuçlar: Gerçekçi Olarak Neler Beklenmeli"], $currentLang) ?></h2>
      <p data-ckey="ergebnisse.body"<?= apex_cms_attrs_or($cmsService['ergebnisse']['body'] ?? null, ['de' => "Das vollständige Ergebnis zeigt sich erst nach 12 bis 18 Monaten, nicht sofort.", 'en' => "Full results are visible at 12 to 18 months, not immediately.", 'fr' => "Le résultat complet est visible entre 12 et 18 mois, pas immédiatement.", 'nl' => "Het volledige resultaat is pas na 12 tot 18 maanden zichtbaar, niet meteen.", 'it' => "Il risultato completo è visibile dopo 12-18 mesi, non immediatamente.", 'tr' => "Tam sonuç hemen değil, 12 ila 18 ay içinde ortaya çıkar."]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['body'] ?? null, ['de' => "Das vollständige Ergebnis zeigt sich erst nach 12 bis 18 Monaten, nicht sofort.", 'en' => "Full results are visible at 12 to 18 months, not immediately.", 'fr' => "Le résultat complet est visible entre 12 et 18 mois, pas immédiatement.", 'nl' => "Het volledige resultaat is pas na 12 tot 18 maanden zichtbaar, niet meteen.", 'it' => "Il risultato completo è visibile dopo 12-18 mesi, non immediatamente.", 'tr' => "Tam sonuç hemen değil, 12 ila 18 ay içinde ortaya çıkar."], $currentLang) ?></p>
    </div>
  </div>
  <div class="hp-checklist" style="margin-bottom:36px">
    <div class="hp-check"><span class="tick">i</span><p data-ckey="ergebnisse.t1"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t1'] ?? null, ['de' => "Eine Transplantation verschiebt vorhandene gesunde Follikel, sie erschafft keine neuen. Das Ergebnis ist durch den verfügbaren Spenderbereich begrenzt.", 'en' => "A transplant relocates existing healthy follicles; it cannot create new ones. The result is limited by the available donor area.", 'fr' => "Une greffe déplace des follicules sains existants ; elle ne peut pas en créer de nouveaux. Le résultat est limité par la zone donneuse disponible.", 'nl' => "Een transplantatie verplaatst bestaande gezonde follikels; er kunnen geen nieuwe worden aangemaakt. Het resultaat wordt beperkt door het beschikbare donorgebied.", 'it' => "Un trapianto sposta follicoli sani esistenti; non può crearne di nuovi. Il risultato è limitato dall'area donatrice disponibile.", 'tr' => "Bir nakil, mevcut sağlıklı foliküllerin yerini değiştirir; yeni folikül oluşturmaz. Sonuç, mevcut donör alanla sınırlıdır."]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t1'] ?? null, ['de' => "Eine Transplantation verschiebt vorhandene gesunde Follikel, sie erschafft keine neuen. Das Ergebnis ist durch den verfügbaren Spenderbereich begrenzt.", 'en' => "A transplant relocates existing healthy follicles; it cannot create new ones. The result is limited by the available donor area.", 'fr' => "Une greffe déplace des follicules sains existants ; elle ne peut pas en créer de nouveaux. Le résultat est limité par la zone donneuse disponible.", 'nl' => "Een transplantatie verplaatst bestaande gezonde follikels; er kunnen geen nieuwe worden aangemaakt. Het resultaat wordt beperkt door het beschikbare donorgebied.", 'it' => "Un trapianto sposta follicoli sani esistenti; non può crearne di nuovi. Il risultato è limitato dall'area donatrice disponibile.", 'tr' => "Bir nakil, mevcut sağlıklı foliküllerin yerini değiştirir; yeni folikül oluşturmaz. Sonuç, mevcut donör alanla sınırlıdır."], $currentLang) ?></p></div>
    <div class="hp-check"><span class="tick">i</span><p data-ckey="ergebnisse.t2"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t2'] ?? null, ['de' => "Transplantiertes Haar wächst lebenslang, da es aus DHT-resistenten Zonen stammt.", 'en' => "Transplanted hair grows for life because it's taken from DHT-resistant zones.", 'fr' => "Les cheveux transplantés poussent à vie car ils proviennent de zones résistantes à la DHT.", 'nl' => "Getransplanteerd haar groeit levenslang omdat het afkomstig is uit DHT-resistente zones.", 'it' => "I capelli trapiantati crescono per tutta la vita perché provengono da zone resistenti al DHT.", 'tr' => "Nakledilen saçlar DHT'ye dirençli bölgelerden alındığı için ömür boyu büyür."]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t2'] ?? null, ['de' => "Transplantiertes Haar wächst lebenslang, da es aus DHT-resistenten Zonen stammt.", 'en' => "Transplanted hair grows for life because it's taken from DHT-resistant zones.", 'fr' => "Les cheveux transplantés poussent à vie car ils proviennent de zones résistantes à la DHT.", 'nl' => "Getransplanteerd haar groeit levenslang omdat het afkomstig is uit DHT-resistente zones.", 'it' => "I capelli trapiantati crescono per tutta la vita perché provengono da zone resistenti al DHT.", 'tr' => "Nakledilen saçlar DHT'ye dirençli bölgelerden alındığı için ömür boyu büyür."], $currentLang) ?></p></div>
    <div class="hp-check"><span class="tick">i</span><p data-ckey="ergebnisse.t3"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t3'] ?? null, ['de' => "Die Graft-Überlebensrate liegt bei seriösen Kliniken bei 90 bis 95%. Bleibt das Ergebnis nach 12 bis 18 Monaten unter den Erwartungen, kann eine Folgesitzung besprochen werden. Apex Beauty bietet eine Kontrolluntersuchung nach 12 Monaten an.", 'en' => "Graft survival rates at reputable clinics are generally 90 to 95%. If the result is below expectations after 12 to 18 months, a follow-up session can be discussed. Apex Beauty offers a 12-month follow-up consultation to assess the outcome.", 'fr' => "Les taux de survie des greffons dans les cliniques réputées sont généralement de 90 à 95 %. Si le résultat est inférieur aux attentes après 12 à 18 mois, une séance de suivi peut être envisagée. Apex Beauty propose une consultation de suivi à 12 mois pour évaluer le résultat.", 'nl' => "De overlevingspercentages van grafts bij gerenommeerde klinieken liggen doorgaans tussen 90 en 95%. Als het resultaat na 12 tot 18 maanden onder de verwachtingen blijft, kan een vervolgsessie worden besproken. Apex Beauty biedt een vervolgconsult na 12 maanden om het resultaat te beoordelen.", 'it' => "I tassi di sopravvivenza degli innesti nelle cliniche affidabili sono generalmente del 90-95%. Se il risultato è inferiore alle aspettative dopo 12-18 mesi, si può discutere di una seduta di follow-up. Apex Beauty offre una consulenza di controllo a 12 mesi per valutare l'esito.", 'tr' => "Saygın kliniklerde greft sağkalım oranları genellikle %90 ila %95 arasındadır. Sonuç 12-18 ay sonra beklentilerin altındaysa, bir takip seansı değerlendirilebilir. Apex Beauty, sonucu değerlendirmek için 12 aylık bir takip danışmanlığı sunar."]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t3'] ?? null, ['de' => "Die Graft-Überlebensrate liegt bei seriösen Kliniken bei 90 bis 95%. Bleibt das Ergebnis nach 12 bis 18 Monaten unter den Erwartungen, kann eine Folgesitzung besprochen werden. Apex Beauty bietet eine Kontrolluntersuchung nach 12 Monaten an.", 'en' => "Graft survival rates at reputable clinics are generally 90 to 95%. If the result is below expectations after 12 to 18 months, a follow-up session can be discussed. Apex Beauty offers a 12-month follow-up consultation to assess the outcome.", 'fr' => "Les taux de survie des greffons dans les cliniques réputées sont généralement de 90 à 95 %. Si le résultat est inférieur aux attentes après 12 à 18 mois, une séance de suivi peut être envisagée. Apex Beauty propose une consultation de suivi à 12 mois pour évaluer le résultat.", 'nl' => "De overlevingspercentages van grafts bij gerenommeerde klinieken liggen doorgaans tussen 90 en 95%. Als het resultaat na 12 tot 18 maanden onder de verwachtingen blijft, kan een vervolgsessie worden besproken. Apex Beauty biedt een vervolgconsult na 12 maanden om het resultaat te beoordelen.", 'it' => "I tassi di sopravvivenza degli innesti nelle cliniche affidabili sono generalmente del 90-95%. Se il risultato è inferiore alle aspettative dopo 12-18 mesi, si può discutere di una seduta di follow-up. Apex Beauty offre una consulenza di controllo a 12 mesi per valutare l'esito.", 'tr' => "Saygın kliniklerde greft sağkalım oranları genellikle %90 ila %95 arasındadır. Sonuç 12-18 ay sonra beklentilerin altındaysa, bir takip seansı değerlendirilebilir. Apex Beauty, sonucu değerlendirmek için 12 aylık bir takip danışmanlığı sunar."], $currentLang) ?></p></div>
    <div class="hp-check"><span class="tick">i</span><p data-ckey="ergebnisse.t4"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t4'] ?? null, ['de' => "In den ersten 1 bis 2 Wochen können Krusten und Rötungen sichtbar sein. Danach ist die Heilung weitgehend unsichtbar. Ab Monat 4 bis 6 verschmilzt das neue Haar natürlich mit dem vorhandenen, bei einem erfahrenen Chirurgen nicht von echtem Haar zu unterscheiden.", 'en' => "In the first 1 to 2 weeks, visible scabbing and redness may be noticeable. After that, healing is largely invisible. By months 4 to 6, the new hair blends naturally and, with an experienced surgeon, is indistinguishable from native hair.", 'fr' => "Durant les 1 à 2 premières semaines, des croûtes visibles et des rougeurs peuvent apparaître. Ensuite, la cicatrisation devient largement invisible. Entre le 4e et le 6e mois, les nouveaux cheveux se fondent naturellement et, avec un chirurgien expérimenté, deviennent indiscernables des cheveux naturels.", 'nl' => "In de eerste 1 tot 2 weken kunnen zichtbare korstjes en roodheid optreden. Daarna is de genezing grotendeels onzichtbaar. Vanaf maand 4 tot 6 vermengt het nieuwe haar zich natuurlijk en is het, bij een ervaren chirurg, niet te onderscheiden van natuurlijk haar.", 'it' => "Nelle prime 1-2 settimane possono essere visibili croste e arrossamenti. Successivamente, la guarigione diventa in gran parte invisibile. Dal 4° al 6° mese, i nuovi capelli si integrano in modo naturale e, con un chirurgo esperto, risultano indistinguibili dai capelli naturali.", 'tr' => "İlk 1-2 hafta içinde görünür kabuklanma ve kızarıklık olabilir. Bundan sonra iyileşme büyük ölçüde görünmez hale gelir. 4. ile 6. aylar arasında yeni saçlar doğal bir şekilde kaynaşır ve deneyimli bir cerrahla doğal saçtan ayırt edilemez hale gelir."]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t4'] ?? null, ['de' => "In den ersten 1 bis 2 Wochen können Krusten und Rötungen sichtbar sein. Danach ist die Heilung weitgehend unsichtbar. Ab Monat 4 bis 6 verschmilzt das neue Haar natürlich mit dem vorhandenen, bei einem erfahrenen Chirurgen nicht von echtem Haar zu unterscheiden.", 'en' => "In the first 1 to 2 weeks, visible scabbing and redness may be noticeable. After that, healing is largely invisible. By months 4 to 6, the new hair blends naturally and, with an experienced surgeon, is indistinguishable from native hair.", 'fr' => "Durant les 1 à 2 premières semaines, des croûtes visibles et des rougeurs peuvent apparaître. Ensuite, la cicatrisation devient largement invisible. Entre le 4e et le 6e mois, les nouveaux cheveux se fondent naturellement et, avec un chirurgien expérimenté, deviennent indiscernables des cheveux naturels.", 'nl' => "In de eerste 1 tot 2 weken kunnen zichtbare korstjes en roodheid optreden. Daarna is de genezing grotendeels onzichtbaar. Vanaf maand 4 tot 6 vermengt het nieuwe haar zich natuurlijk en is het, bij een ervaren chirurg, niet te onderscheiden van natuurlijk haar.", 'it' => "Nelle prime 1-2 settimane possono essere visibili croste e arrossamenti. Successivamente, la guarigione diventa in gran parte invisibile. Dal 4° al 6° mese, i nuovi capelli si integrano in modo naturale e, con un chirurgo esperto, risultano indistinguibili dai capelli naturali.", 'tr' => "İlk 1-2 hafta içinde görünür kabuklanma ve kızarıklık olabilir. Bundan sonra iyileşme büyük ölçüde görünmez hale gelir. 4. ile 6. aylar arasında yeni saçlar doğal bir şekilde kaynaşır ve deneyimli bir cerrahla doğal saçtan ayırt edilemez hale gelir."], $currentLang) ?></p></div>
  </div>
  <p style="font-size:14px;color:var(--ink-soft);line-height:1.6;max-width:640px" data-de="Möchten Sie tiefer eintauchen? Unsere &lt;a href=&quot;<?= apex_lang_base() ?>/hairpedia&quot; style=&quot;color:var(--blue-700);text-decoration:underline;font-weight:600;&quot;&gt;Hairpedia&lt;/a&gt; behandelt Haarausfall, Diagnose, Techniken und den vollständigen Monat-für-Monat-Heilungsverlauf im Detail." data-en="Want to go deeper? Our &lt;a href=&quot;<?= apex_lang_base() ?>/hairpedia&quot; style=&quot;color:var(--blue-700);text-decoration:underline;font-weight:600;&quot;&gt;Hairpedia&lt;/a&gt; covers hair loss, diagnosis, techniques, and the full month-by-month healing timeline in detail." data-fr="Vous voulez approfondir ? Notre &lt;a href=&quot;<?= apex_lang_base() ?>/hairpedia&quot; style=&quot;color:var(--blue-700);text-decoration:underline;font-weight:600;&quot;&gt;Hairpedia&lt;/a&gt; traite en détail la chute de cheveux, le diagnostic, les techniques et la chronologie complète de guérison mois par mois." data-nl="Wilt u meer weten? Onze &lt;a href=&quot;<?= apex_lang_base() ?>/hairpedia&quot; style=&quot;color:var(--blue-700);text-decoration:underline;font-weight:600;&quot;&gt;Hairpedia&lt;/a&gt; behandelt haaruitval, diagnose, technieken en de volledige maand-voor-maand genezingstijdlijn in detail." data-it="Vuoi approfondire? La nostra &lt;a href=&quot;<?= apex_lang_base() ?>/hairpedia&quot; style=&quot;color:var(--blue-700);text-decoration:underline;font-weight:600;&quot;&gt;Hairpedia&lt;/a&gt; tratta in dettaglio la caduta dei capelli, la diagnosi, le tecniche e la cronologia completa di guarigione mese per mese." data-tr="Daha derinlemesine bilgi mi istiyorsunuz? &lt;a href=&quot;<?= apex_lang_base() ?>/hairpedia&quot; style=&quot;color:var(--blue-700);text-decoration:underline;font-weight:600;&quot;&gt;Hairpedia&lt;/a&gt;'mız saç dökülmesini, teşhisi, teknikleri ve ay ay tam iyileşme sürecini ayrıntılı olarak ele alır.">Möchten Sie tiefer eintauchen? Unsere <a href="<?= apex_lang_base() ?>/hairpedia" style="color:var(--blue-700);text-decoration:underline;font-weight:600;">Hairpedia</a> behandelt Haarausfall, Diagnose, Techniken und den vollständigen Monat-für-Monat-Heilungsverlauf im Detail.</p>
  </div>
</section>

<section style="padding: 40px 48px 60px; text-align:center; max-width:1180px; margin:0 auto;">
  <a href="#" class="cta-btn" onclick="openConsult(event)" style="padding:16px 34px; font-size:15.5px; display:inline-flex;" data-ckey="ergebnisse.t5"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t5'] ?? null, ['de' => "Kostenlose Beratung sichern", 'en' => "Get your free consultation", 'fr' => "Obtenez votre consultation gratuite", 'nl' => "Vraag uw gratis consult aan", 'it' => "Richiedi il tuo consulto gratuito", 'tr' => "Ücretsiz Danışmanızı Alın"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t5'] ?? null, ['de' => "Kostenlose Beratung sichern", 'en' => "Get your free consultation", 'fr' => "Obtenez votre consultation gratuite", 'nl' => "Vraag uw gratis consult aan", 'it' => "Richiedi il tuo consulto gratuito", 'tr' => "Ücretsiz Danışmanızı Alın"], $currentLang) ?></a>
</section>


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
        <h2 id="consultTitle" data-ckey="ergebnisse.t6"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t6'] ?? null, ['de' => "Kostenlose Beratung", 'en' => "Free Consultation", 'fr' => "Consultation gratuite", 'nl' => "Gratis consult", 'it' => "Consulto gratuito", 'tr' => "Ücretsiz Danışma"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t6'] ?? null, ['de' => "Kostenlose Beratung", 'en' => "Free Consultation", 'fr' => "Consultation gratuite", 'nl' => "Gratis consult", 'it' => "Consulto gratuito", 'tr' => "Ücretsiz Danışma"], $currentLang) ?></h2>
        <p data-ckey="ergebnisse.t7"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t7'] ?? null, ['de' => "Füllen Sie das Formular aus, wir melden uns innerhalb von 24 Stunden.", 'en' => "Fill in the form and we'll get back to you within 24 hours.", 'fr' => "Remplissez le formulaire, nous vous répondrons sous 24 heures.", 'nl' => "Vul het formulier in, we nemen binnen 24 uur contact met u op.", 'it' => "Compila il modulo, ti risponderemo entro 24 ore.", 'tr' => "Formu doldurun, 24 saat içinde size dönüş yapalım."]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t7'] ?? null, ['de' => "Füllen Sie das Formular aus, wir melden uns innerhalb von 24 Stunden.", 'en' => "Fill in the form and we'll get back to you within 24 hours.", 'fr' => "Remplissez le formulaire, nous vous répondrons sous 24 heures.", 'nl' => "Vul het formulier in, we nemen binnen 24 uur contact met u op.", 'it' => "Compila il modulo, ti risponderemo entro 24 ore.", 'tr' => "Formu doldurun, 24 saat içinde size dönüş yapalım."], $currentLang) ?></p>
      </div>
      <div class="consult-steps" id="consultSteps">
        <div class="cstep active" data-step="1"><span class="dot">1</span><span data-ckey="ergebnisse.t8"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t8'] ?? null, ['de' => "Info", 'en' => "Info", 'fr' => "Infos", 'nl' => "Info", 'it' => "Info", 'tr' => "Bilgi"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t8'] ?? null, ['de' => "Info", 'en' => "Info", 'fr' => "Infos", 'nl' => "Info", 'it' => "Info", 'tr' => "Bilgi"], $currentLang) ?></span></div>
        <div class="cstep-line"></div>
        <div class="cstep" data-step="2"><span class="dot">2</span><span data-ckey="ergebnisse.t9"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t9'] ?? null, ['de' => "Bedarf", 'en' => "Needs", 'fr' => "Besoins", 'nl' => "Behoefte", 'it' => "Esigenze", 'tr' => "İhtiyaçlar"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t9'] ?? null, ['de' => "Bedarf", 'en' => "Needs", 'fr' => "Besoins", 'nl' => "Behoefte", 'it' => "Esigenze", 'tr' => "İhtiyaçlar"], $currentLang) ?></span></div>
        <div class="cstep-line"></div>
        <div class="cstep" data-step="3"><span class="dot">3</span><span data-ckey="ergebnisse.t10"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t10'] ?? null, ['de' => "Fotos", 'en' => "Photos", 'fr' => "Photos", 'nl' => "Foto's", 'it' => "Foto", 'tr' => "Fotoğraflar"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t10'] ?? null, ['de' => "Fotos", 'en' => "Photos", 'fr' => "Photos", 'nl' => "Foto's", 'it' => "Foto", 'tr' => "Fotoğraflar"], $currentLang) ?></span></div>
      </div>
    </div>
    <div class="consult-body">

    <!-- STEP 1: Info -->
    <div class="consult-pane active" id="cpane1">
      <div class="pane-title" data-ckey="ergebnisse.t11"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t11'] ?? null, ['de' => "Holen Sie sich Ihre kostenlose Haaranalyse", 'en' => "Get Your Free Hair Analysis", 'fr' => "Obtenez votre analyse capillaire gratuite", 'nl' => "Krijg uw gratis haaranalyse", 'it' => "Ottieni la tua analisi gratuita dei capelli", 'tr' => "Ücretsiz Saç Analizinizi Alın"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t11'] ?? null, ['de' => "Holen Sie sich Ihre kostenlose Haaranalyse", 'en' => "Get Your Free Hair Analysis", 'fr' => "Obtenez votre analyse capillaire gratuite", 'nl' => "Krijg uw gratis haaranalyse", 'it' => "Ottieni la tua analisi gratuita dei capelli", 'tr' => "Ücretsiz Saç Analizinizi Alın"], $currentLang) ?></div>
      <div class="pane-sub" data-ckey="ergebnisse.t12"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t12'] ?? null, ['de' => "Unser Expertenteam meldet sich innerhalb von 24 Stunden", 'en' => "Our expert team will contact you within 24 hours", 'fr' => "Notre équipe d'experts vous contactera sous 24 heures", 'nl' => "Ons expertteam neemt binnen 24 uur contact met u op", 'it' => "Il nostro team di esperti ti contatterà entro 24 ore", 'tr' => "Uzman ekibimiz 24 saat içinde sizinle iletişime geçecektir"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t12'] ?? null, ['de' => "Unser Expertenteam meldet sich innerhalb von 24 Stunden", 'en' => "Our expert team will contact you within 24 hours", 'fr' => "Notre équipe d'experts vous contactera sous 24 heures", 'nl' => "Ons expertteam neemt binnen 24 uur contact met u op", 'it' => "Il nostro team di esperti ti contatterà entro 24 ore", 'tr' => "Uzman ekibimiz 24 saat içinde sizinle iletişime geçecektir"], $currentLang) ?></div>
      <div class="cfield">
        <label data-ckey="ergebnisse.t13"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t13'] ?? null, ['de' => "Vollständiger Name *", 'en' => "Full Name *", 'fr' => "Nom complet *", 'nl' => "Volledige naam *", 'it' => "Nome completo *", 'tr' => "Ad Soyad *"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t13'] ?? null, ['de' => "Vollständiger Name *", 'en' => "Full Name *", 'fr' => "Nom complet *", 'nl' => "Volledige naam *", 'it' => "Nome completo *", 'tr' => "Ad Soyad *"], $currentLang) ?></label>
        <input type="text" id="cfName" data-de-ph="Ihr vollständiger Name" data-en-ph="Your full name" placeholder="Ihr vollständiger Name" oninput="validateStep1()">
      </div>
      <div class="cfield">
        <label data-ckey="ergebnisse.t14"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t14'] ?? null, ['de' => "E-Mail *", 'en' => "Email *", 'fr' => "E-mail *", 'nl' => "E-mail *", 'it' => "E-mail *", 'tr' => "E-posta *"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t14'] ?? null, ['de' => "E-Mail *", 'en' => "Email *", 'fr' => "E-mail *", 'nl' => "E-mail *", 'it' => "E-mail *", 'tr' => "E-posta *"], $currentLang) ?></label>
        <input type="email" id="cfEmail" placeholder="email@example.com" oninput="validateStep1()">
      </div>
      <div class="cfield">
        <label data-ckey="ergebnisse.t15"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t15'] ?? null, ['de' => "Land *", 'en' => "Country *", 'fr' => "Pays *", 'nl' => "Land *", 'it' => "Paese *", 'tr' => "Ülke *"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t15'] ?? null, ['de' => "Land *", 'en' => "Country *", 'fr' => "Pays *", 'nl' => "Land *", 'it' => "Paese *", 'tr' => "Ülke *"], $currentLang) ?></label>
        <select id="cfCountry" onchange="updatePrefix(); validateStep1()">
          <option value="AT" data-prefix="+43">🇦🇹 Österreich</option>
          <option value="DE" data-prefix="+49">🇩🇪 Deutschland</option>
          <option value="CH" data-prefix="+41">🇨🇭 Schweiz</option>
          <option value="TR" data-prefix="+90">🇹🇷 Türkei</option>
          <option value="OTHER" data-prefix="+">🌍 Andere / Other</option>
        </select>
      </div>
      <div class="cfield">
        <label data-ckey="ergebnisse.t16"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t16'] ?? null, ['de' => "Telefon *", 'en' => "Phone *", 'fr' => "Téléphone *", 'nl' => "Telefoon *", 'it' => "Telefono *", 'tr' => "Telefon *"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t16'] ?? null, ['de' => "Telefon *", 'en' => "Phone *", 'fr' => "Téléphone *", 'nl' => "Telefoon *", 'it' => "Telefono *", 'tr' => "Telefon *"], $currentLang) ?></label>
        <div class="phone-row">
          <div class="prefix" id="cfPrefix">+43</div>
          <input type="tel" id="cfPhone" placeholder="660 123 45 67" oninput="validateStep1()">
        </div>
      </div>
      <div class="consult-nav">
        <button type="button" class="cnext" id="cnext1" disabled onclick="gotoStep(2)" data-ckey="ergebnisse.t17"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t17'] ?? null, ['de' => "Weiter", 'en' => "Continue", 'fr' => "Continuer", 'nl' => "Doorgaan", 'it' => "Continua", 'tr' => "Devam Et"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t17'] ?? null, ['de' => "Weiter", 'en' => "Continue", 'fr' => "Continuer", 'nl' => "Doorgaan", 'it' => "Continua", 'tr' => "Devam Et"], $currentLang) ?></button>
      </div>
    </div>

    <!-- STEP 2: Needs -->
    <div class="consult-pane" id="cpane2">
      <div class="cfield">
        <label data-ckey="ergebnisse.t18"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t18'] ?? null, ['de' => "Ihr Geschlecht *", 'en' => "Your Gender *", 'fr' => "Votre sexe *", 'nl' => "Uw geslacht *", 'it' => "Il tuo genere *", 'tr' => "Cinsiyetiniz *"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t18'] ?? null, ['de' => "Ihr Geschlecht *", 'en' => "Your Gender *", 'fr' => "Votre sexe *", 'nl' => "Uw geslacht *", 'it' => "Il tuo genere *", 'tr' => "Cinsiyetiniz *"], $currentLang) ?></label>
        <div class="opt-grid cols-2" id="genderRow">
          <div class="opt-card radio centered" data-value="male" onclick="pickSingle(this,'genderRow'); validateStep2()">
            <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModMale" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModMale)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="12" cy="18" r="6" fill="none" stroke="#fff" stroke-width="2.2"/><polyline points="17,7 23,7 23,13" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/><line x1="16.2" y1="13.8" x2="23" y2="7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/></svg></span><span data-ckey="ergebnisse.t19"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t19'] ?? null, ['de' => "Männlich", 'en' => "Male", 'fr' => "Homme", 'nl' => "Man", 'it' => "Uomo", 'tr' => "Erkek"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t19'] ?? null, ['de' => "Männlich", 'en' => "Male", 'fr' => "Homme", 'nl' => "Man", 'it' => "Uomo", 'tr' => "Erkek"], $currentLang) ?></span>
          </div>
          <div class="opt-card radio centered" data-value="female" onclick="pickSingle(this,'genderRow'); validateStep2()">
            <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModFemale" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModFemale)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="11" r="6" fill="none" stroke="#fff" stroke-width="2.2"/><line x1="15" y1="17" x2="15" y2="25" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/><line x1="11" y1="21" x2="19" y2="21" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/></svg></span><span data-ckey="ergebnisse.t20"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t20'] ?? null, ['de' => "Weiblich", 'en' => "Female", 'fr' => "Femme", 'nl' => "Vrouw", 'it' => "Donna", 'tr' => "Kadın"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t20'] ?? null, ['de' => "Weiblich", 'en' => "Female", 'fr' => "Femme", 'nl' => "Vrouw", 'it' => "Donna", 'tr' => "Kadın"], $currentLang) ?></span>
          </div>
        </div>
      </div>
      <div class="cfield">
        <label data-ckey="ergebnisse.t21"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t21'] ?? null, ['de' => "Verfahren, die Sie interessieren *", 'en' => "Procedures You're Interested In *", 'fr' => "Interventions qui vous intéressent *", 'nl' => "Ingrepen waarin u geïnteresseerd bent *", 'it' => "Procedure di tuo interesse *", 'tr' => "İlgilendiğiniz İşlemler *"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t21'] ?? null, ['de' => "Verfahren, die Sie interessieren *", 'en' => "Procedures You're Interested In *", 'fr' => "Interventions qui vous intéressent *", 'nl' => "Ingrepen waarin u geïnteresseerd bent *", 'it' => "Procedure di tuo interesse *", 'tr' => "İlgilendiğiniz İşlemler *"], $currentLang) ?></label>
        <div class="opt-grid cols-1" id="procRow">
          <div class="opt-card" data-value="hair" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModHair" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModHair)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M10 24c-1-6 0-11 2-14" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><path d="M15 24c0-7 0.5-12 0-16" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><path d="M20 24c1-6 0-11-2-14" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg></span><span data-ckey="ergebnisse.t22"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t22'] ?? null, ['de' => "Haartransplantation", 'en' => "Hair Transplant", 'fr' => "Greffe de cheveux", 'nl' => "Haartransplantatie", 'it' => "Trapianto di capelli", 'tr' => "Saç Ekimi"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t22'] ?? null, ['de' => "Haartransplantation", 'en' => "Hair Transplant", 'fr' => "Greffe de cheveux", 'nl' => "Haartransplantatie", 'it' => "Trapianto di capelli", 'tr' => "Saç Ekimi"], $currentLang) ?></span>
          </div>
          <div class="opt-card" data-value="beard" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModBeard" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModBeard)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M9 10c0 8 2 14 6 16 4-2 6-8 6-16" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 20l0 3M15 21.5l0 3M18 20l0 3" stroke="#fff" stroke-width="1.6" stroke-linecap="round"/></svg></span><span data-ckey="ergebnisse.t23"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t23'] ?? null, ['de' => "Barttransplantation", 'en' => "Beard Transplant", 'fr' => "Greffe de barbe", 'nl' => "Baardtransplantatie", 'it' => "Trapianto di barba", 'tr' => "Sakal Ekimi"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t23'] ?? null, ['de' => "Barttransplantation", 'en' => "Beard Transplant", 'fr' => "Greffe de barbe", 'nl' => "Baardtransplantatie", 'it' => "Trapianto di barba", 'tr' => "Sakal Ekimi"], $currentLang) ?></span>
          </div>
          <div class="opt-card" data-value="eyebrow" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModBrow" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModBrow)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M7 10c2-1.5 5-2.2 8-2.2s6 0.7 8 2.2" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><path d="M8 17c2.5-3 5-4.5 7-4.5s4.5 1.5 7 4.5c-2.5 3-5 4.5-7 4.5S10.5 20 8 17z" fill="none" stroke="#fff" stroke-width="1.8" stroke-linejoin="round"/><circle cx="15" cy="17" r="2" fill="#fff"/></svg></span><span data-ckey="ergebnisse.t24"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t24'] ?? null, ['de' => "Augenbrauentransplantation", 'en' => "Eyebrow Transplant", 'fr' => "Greffe de sourcils", 'nl' => "Wenkbrauwtransplantatie", 'it' => "Trapianto di sopracciglia", 'tr' => "Kaş Ekimi"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t24'] ?? null, ['de' => "Augenbrauentransplantation", 'en' => "Eyebrow Transplant", 'fr' => "Greffe de sourcils", 'nl' => "Wenkbrauwtransplantatie", 'it' => "Trapianto di sopracciglia", 'tr' => "Kaş Ekimi"], $currentLang) ?></span>
          </div>
        </div>
        <div class="cgroup-note" data-ckey="ergebnisse.t25"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t25'] ?? null, ['de' => "Unterstützende Therapien", 'en' => "Supporting Therapies", 'fr' => "Thérapies complémentaires", 'nl' => "Ondersteunende therapieën", 'it' => "Terapie di supporto", 'tr' => "Destekleyici Tedaviler"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t25'] ?? null, ['de' => "Unterstützende Therapien", 'en' => "Supporting Therapies", 'fr' => "Thérapies complémentaires", 'nl' => "Ondersteunende therapieën", 'it' => "Terapie di supporto", 'tr' => "Destekleyici Tedaviler"], $currentLang) ?></div>
        <div class="opt-grid cols-2" id="therapyRow">
          <div class="opt-card" data-value="prp" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPrp" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPrp)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M15 6c4 5.5 7 9.6 7 13.2A7 7 0 1 1 8 19.2C8 15.6 11 11.5 15 6z" fill="#fff" opacity="0.95"/></svg></span><span data-ckey="ergebnisse.t26"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t26'] ?? null, ['de' => "PRP-Therapie", 'en' => "PRP Therapy", 'fr' => "Thérapie PRP", 'nl' => "PRP-therapie", 'it' => "Terapia PRP", 'tr' => "PRP Tedavisi"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t26'] ?? null, ['de' => "PRP-Therapie", 'en' => "PRP Therapy", 'fr' => "Thérapie PRP", 'nl' => "PRP-therapie", 'it' => "Terapia PRP", 'tr' => "PRP Tedavisi"], $currentLang) ?></span>
          </div>
          <div class="opt-card" data-value="stemcell" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModStem" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModStem)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M15 6l7 4v10l-7 4-7-4V10z" fill="none" stroke="#fff" stroke-width="2" stroke-linejoin="round"/><circle cx="15" cy="15" r="3" fill="#fff"/></svg></span><span data-ckey="ergebnisse.t27"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t27'] ?? null, ['de' => "Stammzelltherapie", 'en' => "Stem Cell Therapy", 'fr' => "Thérapie par cellules souches", 'nl' => "Stamceltherapie", 'it' => "Terapia con cellule staminali", 'tr' => "Kök Hücre Tedavisi"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t27'] ?? null, ['de' => "Stammzelltherapie", 'en' => "Stem Cell Therapy", 'fr' => "Thérapie par cellules souches", 'nl' => "Stamceltherapie", 'it' => "Terapia con cellule staminali", 'tr' => "Kök Hücre Tedavisi"], $currentLang) ?></span>
          </div>
          <div class="opt-card" data-value="exosome" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModExo" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModExo)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="11" cy="12" r="4" fill="#fff" opacity="0.9"/><circle cx="20" cy="11" r="3" fill="#fff" opacity="0.75"/><circle cx="13" cy="20" r="3.4" fill="#fff" opacity="0.85"/><circle cx="21" cy="19" r="2.6" fill="#fff" opacity="0.7"/></svg></span><span data-ckey="ergebnisse.t28"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t28'] ?? null, ['de' => "Exosom-Therapie", 'en' => "Exosome Therapy", 'fr' => "Thérapie par exosomes", 'nl' => "Exosoomtherapie", 'it' => "Terapia con esosomi", 'tr' => "Ekzozom Tedavisi"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t28'] ?? null, ['de' => "Exosom-Therapie", 'en' => "Exosome Therapy", 'fr' => "Thérapie par exosomes", 'nl' => "Exosoomtherapie", 'it' => "Terapia con esosomi", 'tr' => "Ekzozom Tedavisi"], $currentLang) ?></span>
          </div>
          <div class="opt-card" data-value="hbot" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModHbot" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModHbot)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><rect x="8" y="7" width="14" height="16" rx="7" fill="none" stroke="#fff" stroke-width="2"/><path d="M15 12v6M12 15h6" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg></span><span data-ckey="ergebnisse.t29"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t29'] ?? null, ['de' => "Hyperbarer Sauerstoff", 'en' => "Hyperbaric Oxygen", 'fr' => "Oxygénothérapie hyperbare", 'nl' => "Hyperbare zuurstoftherapie", 'it' => "Ossigenoterapia iperbarica", 'tr' => "Hiperbarik Oksijen"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t29'] ?? null, ['de' => "Hyperbarer Sauerstoff", 'en' => "Hyperbaric Oxygen", 'fr' => "Oxygénothérapie hyperbare", 'nl' => "Hyperbare zuurstoftherapie", 'it' => "Ossigenoterapia iperbarica", 'tr' => "Hiperbarik Oksijen"], $currentLang) ?></span>
          </div>
        </div>
      </div>
      <div class="cfield">
        <label data-ckey="ergebnisse.t30"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t30'] ?? null, ['de' => "Wann planen Sie den Eingriff?", 'en' => "When Are You Planning the Procedure?", 'fr' => "Quand prévoyez-vous l'intervention ?", 'nl' => "Wanneer plant u de ingreep?", 'it' => "Quando prevedi l'intervento?", 'tr' => "İşlemi Ne Zaman Planlıyorsunuz?"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t30'] ?? null, ['de' => "Wann planen Sie den Eingriff?", 'en' => "When Are You Planning the Procedure?", 'fr' => "Quand prévoyez-vous l'intervention ?", 'nl' => "Wanneer plant u de ingreep?", 'it' => "Quando prevedi l'intervento?", 'tr' => "İşlemi Ne Zaman Planlıyorsunuz?"], $currentLang) ?></label>
        <div class="opt-grid cols-3" id="timingRow">
          <div class="opt-card radio centered" data-value="this-month" onclick="pickSingle(this,'timingRow'); validateStep2()"><span data-ckey="ergebnisse.t31"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t31'] ?? null, ['de' => "Diesen Monat", 'en' => "This month", 'fr' => "Ce mois-ci", 'nl' => "Deze maand", 'it' => "Questo mese", 'tr' => "Bu Ay"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t31'] ?? null, ['de' => "Diesen Monat", 'en' => "This month", 'fr' => "Ce mois-ci", 'nl' => "Deze maand", 'it' => "Questo mese", 'tr' => "Bu Ay"], $currentLang) ?></span></div>
          <div class="opt-card radio centered" data-value="1-3" onclick="pickSingle(this,'timingRow'); validateStep2()"><span data-ckey="ergebnisse.t32"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t32'] ?? null, ['de' => "In 1–3 Monaten", 'en' => "In 1–3 months", 'fr' => "Dans 1 à 3 mois", 'nl' => "Over 1–3 maanden", 'it' => "Tra 1 e 3 mesi", 'tr' => "1-3 Ay İçinde"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t32'] ?? null, ['de' => "In 1–3 Monaten", 'en' => "In 1–3 months", 'fr' => "Dans 1 à 3 mois", 'nl' => "Over 1–3 maanden", 'it' => "Tra 1 e 3 mesi", 'tr' => "1-3 Ay İçinde"], $currentLang) ?></span></div>
          <div class="opt-card radio centered" data-value="3-6" onclick="pickSingle(this,'timingRow'); validateStep2()"><span data-ckey="ergebnisse.t33"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t33'] ?? null, ['de' => "In 3–6 Monaten", 'en' => "In 3–6 months", 'fr' => "Dans 3 à 6 mois", 'nl' => "Over 3–6 maanden", 'it' => "Tra 3 e 6 mesi", 'tr' => "3-6 Ay İçinde"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t33'] ?? null, ['de' => "In 3–6 Monaten", 'en' => "In 3–6 months", 'fr' => "Dans 3 à 6 mois", 'nl' => "Over 3–6 maanden", 'it' => "Tra 3 e 6 mesi", 'tr' => "3-6 Ay İçinde"], $currentLang) ?></span></div>
          <div class="opt-card radio centered" data-value="6plus" onclick="pickSingle(this,'timingRow'); validateStep2()"><span data-ckey="ergebnisse.t34"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t34'] ?? null, ['de' => "In 6+ Monaten", 'en' => "In 6+ months", 'fr' => "Dans 6+ mois", 'nl' => "Over 6+ maanden", 'it' => "Tra 6+ mesi", 'tr' => "6+ Ay İçinde"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t34'] ?? null, ['de' => "In 6+ Monaten", 'en' => "In 6+ months", 'fr' => "Dans 6+ mois", 'nl' => "Over 6+ maanden", 'it' => "Tra 6+ mesi", 'tr' => "6+ Ay İçinde"], $currentLang) ?></span></div>
          <div class="opt-card radio centered" data-value="research" onclick="pickSingle(this,'timingRow'); validateStep2()" style="grid-column: span 2;"><span data-ckey="ergebnisse.t35"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t35'] ?? null, ['de' => "Nur recherchieren", 'en' => "Just researching", 'fr' => "Je me renseigne seulement", 'nl' => "Alleen aan het oriënteren", 'it' => "Sto solo informandomi", 'tr' => "Sadece Araştırıyorum"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t35'] ?? null, ['de' => "Nur recherchieren", 'en' => "Just researching", 'fr' => "Je me renseigne seulement", 'nl' => "Alleen aan het oriënteren", 'it' => "Sto solo informandomi", 'tr' => "Sadece Araştırıyorum"], $currentLang) ?></span></div>
        </div>
      </div>
      <div class="cfield">
        <label data-ckey="ergebnisse.t36"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t36'] ?? null, ['de' => "Zusätzliche Notizen (optional)", 'en' => "Additional Notes (Optional)", 'fr' => "Remarques supplémentaires (facultatif)", 'nl' => "Aanvullende opmerkingen (optioneel)", 'it' => "Note aggiuntive (facoltativo)", 'tr' => "Ek Notlar (İsteğe Bağlı)"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t36'] ?? null, ['de' => "Zusätzliche Notizen (optional)", 'en' => "Additional Notes (Optional)", 'fr' => "Remarques supplémentaires (facultatif)", 'nl' => "Aanvullende opmerkingen (optioneel)", 'it' => "Note aggiuntive (facoltativo)", 'tr' => "Ek Notlar (İsteğe Bağlı)"], $currentLang) ?></label>
        <textarea id="cfNotes" data-de-ph="Ihre Ziele oder Fragen..." data-en-ph="Your goals or questions..." placeholder="Ihre Ziele oder Fragen..."></textarea>
      </div>
      <div class="consult-nav">
        <button type="button" class="cback" onclick="gotoStep(1)" data-ckey="ergebnisse.t37"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t37'] ?? null, ['de' => "Zurück", 'en' => "Back", 'fr' => "Retour", 'nl' => "Terug", 'it' => "Indietro", 'tr' => "Geri"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t37'] ?? null, ['de' => "Zurück", 'en' => "Back", 'fr' => "Retour", 'nl' => "Terug", 'it' => "Indietro", 'tr' => "Geri"], $currentLang) ?></button>
        <button type="button" class="cnext" id="cnext2" disabled onclick="gotoStep(3)" data-ckey="ergebnisse.t38"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t38'] ?? null, ['de' => "Weiter", 'en' => "Continue", 'fr' => "Continuer", 'nl' => "Doorgaan", 'it' => "Continua", 'tr' => "Devam Et"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t38'] ?? null, ['de' => "Weiter", 'en' => "Continue", 'fr' => "Continuer", 'nl' => "Doorgaan", 'it' => "Continua", 'tr' => "Devam Et"], $currentLang) ?></button>
      </div>
    </div>

    <!-- STEP 3: Photos -->
    <div class="consult-pane" id="cpane3">
      <div class="photo-note" data-ckey="ergebnisse.t39"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t39'] ?? null, ['de' => "📸 Fotos sind optional. Unsere Experten kontaktieren Sie in jedem Fall.", 'en' => "📸 Photos are optional. Our experts will contact you either way.", 'fr' => "📸 Les photos sont facultatives. Nos experts vous contacteront dans tous les cas.", 'nl' => "📸 Foto's zijn optioneel. Onze experts nemen sowieso contact met u op.", 'it' => "📸 Le foto sono facoltative. I nostri esperti ti contatteranno comunque.", 'tr' => "📸 Fotoğraflar isteğe bağlıdır. Uzmanlarımız her durumda sizinle iletişime geçecektir."]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t39'] ?? null, ['de' => "📸 Fotos sind optional. Unsere Experten kontaktieren Sie in jedem Fall.", 'en' => "📸 Photos are optional. Our experts will contact you either way.", 'fr' => "📸 Les photos sont facultatives. Nos experts vous contacteront dans tous les cas.", 'nl' => "📸 Foto's zijn optioneel. Onze experts nemen sowieso contact met u op.", 'it' => "📸 Le foto sono facoltative. I nostri esperti ti contatteranno comunque.", 'tr' => "📸 Fotoğraflar isteğe bağlıdır. Uzmanlarımız her durumda sizinle iletişime geçecektir."], $currentLang) ?></div>
      <div class="photo-grid">
        <div class="photo-slot" id="slot-front">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPhFront" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPhFront)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="14" r="7" fill="none" stroke="#fff" stroke-width="2"/><circle cx="12.5" cy="12.5" r="1.1" fill="#fff"/><circle cx="17.5" cy="12.5" r="1.1" fill="#fff"/><path d="M12 17c1 1.2 2 1.6 3 1.6s2-0.4 3-1.6" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round"/></svg></span>
          <b data-ckey="ergebnisse.t40"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t40'] ?? null, ['de' => "Vorne", 'en' => "Front", 'fr' => "Face avant", 'nl' => "Voorkant", 'it' => "Fronte", 'tr' => "Ön"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t40'] ?? null, ['de' => "Vorne", 'en' => "Front", 'fr' => "Face avant", 'nl' => "Voorkant", 'it' => "Fronte", 'tr' => "Ön"], $currentLang) ?></b>
          <span data-ckey="ergebnisse.t41"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t41'] ?? null, ['de' => "Gesicht sichtbar", 'en' => "Face visible", 'fr' => "Visage visible", 'nl' => "Gezicht zichtbaar", 'it' => "Volto visibile", 'tr' => "Yüz Görünür"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t41'] ?? null, ['de' => "Gesicht sichtbar", 'en' => "Face visible", 'fr' => "Visage visible", 'nl' => "Gezicht zichtbaar", 'it' => "Volto visibile", 'tr' => "Yüz Görünür"], $currentLang) ?></span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-front')">
        </div>
        <div class="photo-slot" id="slot-top">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPhTop" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPhTop)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="20" r="4.5" fill="none" stroke="#fff" stroke-width="2"/><path d="M15 5v8M11 9l4-4 4 4" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <b data-ckey="ergebnisse.t42"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t42'] ?? null, ['de' => "Oben", 'en' => "Top", 'fr' => "Dessus", 'nl' => "Bovenkant", 'it' => "Sopra", 'tr' => "Üst"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t42'] ?? null, ['de' => "Oben", 'en' => "Top", 'fr' => "Dessus", 'nl' => "Bovenkant", 'it' => "Sopra", 'tr' => "Üst"], $currentLang) ?></b>
          <span data-ckey="ergebnisse.t43"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t43'] ?? null, ['de' => "Von oben", 'en' => "From above", 'fr' => "Vue de dessus", 'nl' => "Van bovenaf", 'it' => "Dall'alto", 'tr' => "Yukarıdan"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t43'] ?? null, ['de' => "Von oben", 'en' => "From above", 'fr' => "Vue de dessus", 'nl' => "Van bovenaf", 'it' => "Dall'alto", 'tr' => "Yukarıdan"], $currentLang) ?></span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-top')">
        </div>
        <div class="photo-slot" id="slot-side">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPhSide" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPhSide)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M11 22c-1-2-1-4 0-6-1-1-1-3 0-4 1-3 4-5 7-5 3 0 4 2 4 4 1 0 2 1 2 2 0 2-1 3-2 3 0 2-1 4-3 5-1 1-1 2 0 3z" fill="#fff" opacity="0.92"/></svg></span>
          <b data-ckey="ergebnisse.t44"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t44'] ?? null, ['de' => "Seite", 'en' => "Side", 'fr' => "Profil", 'nl' => "Zijkant", 'it' => "Lato", 'tr' => "Yan"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t44'] ?? null, ['de' => "Seite", 'en' => "Side", 'fr' => "Profil", 'nl' => "Zijkant", 'it' => "Lato", 'tr' => "Yan"], $currentLang) ?></b>
          <span data-ckey="ergebnisse.t45"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t45'] ?? null, ['de' => "Profil", 'en' => "Profile", 'fr' => "Profil", 'nl' => "Profiel", 'it' => "Profilo", 'tr' => "Profil"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t45'] ?? null, ['de' => "Profil", 'en' => "Profile", 'fr' => "Profil", 'nl' => "Profiel", 'it' => "Profilo", 'tr' => "Profil"], $currentLang) ?></span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-side')">
        </div>
        <div class="photo-slot" id="slot-donor">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gModPhDonor" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gModPhDonor)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M20 10a7 7 0 1 0 1.8 6.9" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><polyline points="22,7 21.8,11.5 17.5,10.5" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <b data-ckey="ergebnisse.t46"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t46'] ?? null, ['de' => "Spender", 'en' => "Donor", 'fr' => "Donneuse", 'nl' => "Donor", 'it' => "Donatrice", 'tr' => "Donör"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t46'] ?? null, ['de' => "Spender", 'en' => "Donor", 'fr' => "Donneuse", 'nl' => "Donor", 'it' => "Donatrice", 'tr' => "Donör"], $currentLang) ?></b>
          <span data-ckey="ergebnisse.t47"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t47'] ?? null, ['de' => "Hinterkopf", 'en' => "Back of head", 'fr' => "Arrière de la tête", 'nl' => "Achterhoofd", 'it' => "Retro della testa", 'tr' => "Baş Arkası"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t47'] ?? null, ['de' => "Hinterkopf", 'en' => "Back of head", 'fr' => "Arrière de la tête", 'nl' => "Achterhoofd", 'it' => "Retro della testa", 'tr' => "Baş Arkası"], $currentLang) ?></span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-donor')">
        </div>
      </div>
      <div class="photo-note"><span id="photoCount">0</span>/4 <span data-ckey="ergebnisse.t48"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t48'] ?? null, ['de' => "Fotos hochgeladen", 'en' => "photos uploaded", 'fr' => "photos téléchargées", 'nl' => "foto's geüpload", 'it' => "foto caricate", 'tr' => "fotoğraf yüklendi"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t48'] ?? null, ['de' => "Fotos hochgeladen", 'en' => "photos uploaded", 'fr' => "photos téléchargées", 'nl' => "foto's geüpload", 'it' => "foto caricate", 'tr' => "fotoğraf yüklendi"], $currentLang) ?></span></div>
      <div class="cfield">
        <label data-ckey="ergebnisse.t49"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t49'] ?? null, ['de' => "Rabattgutschein (optional)", 'en' => "Discount Coupon (Optional)", 'fr' => "Code de réduction (facultatif)", 'nl' => "Kortingscode (optioneel)", 'it' => "Codice sconto (facoltativo)", 'tr' => "İndirim Kuponu (İsteğe Bağlı)"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t49'] ?? null, ['de' => "Rabattgutschein (optional)", 'en' => "Discount Coupon (Optional)", 'fr' => "Code de réduction (facultatif)", 'nl' => "Kortingscode (optioneel)", 'it' => "Codice sconto (facoltativo)", 'tr' => "İndirim Kuponu (İsteğe Bağlı)"], $currentLang) ?></label>
        <input type="text" id="cfCoupon" placeholder="WELCOME5">
      </div>
      <div class="check-row">
        <input type="checkbox" id="cfPrivacy" onchange="validateStep3()">
        <span data-de="Ich habe die &lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;Datenschutzerklärung&lt;/a&gt; gelesen und akzeptiere die Verarbeitung meiner personenbezogenen Daten. *" data-en="I have read the &lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;privacy policy&lt;/a&gt; and accept the processing of my personal data. *" data-fr="J'ai lu la &lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;politique de confidentialité&lt;/a&gt; et j'accepte le traitement de mes données personnelles. *" data-nl="Ik heb het &lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;privacybeleid&lt;/a&gt; gelezen en ga akkoord met de verwerking van mijn persoonsgegevens. *" data-it="Ho letto l'&lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;informativa sulla privacy&lt;/a&gt; e accetto il trattamento dei miei dati personali. *" data-tr="&lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;Gizlilik politikasını&lt;/a&gt; okudum ve kişisel verilerimin işlenmesini kabul ediyorum. *">Ich habe die <a href="<?= apex_lang_base() ?>/privacy" target="_blank" rel="noopener noreferrer">Datenschutzerklärung</a> gelesen und akzeptiere die Verarbeitung meiner personenbezogenen Daten. *</span>
      </div>
      <div class="check-row">
        <input type="checkbox" id="cfMarketing">
        <span data-ckey="ergebnisse.t50"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t50'] ?? null, ['de' => "Ich möchte über Aktionen und Angebote informiert werden.", 'en' => "I'd like to be informed about promotions and offers.", 'fr' => "Je souhaite être informé(e) des promotions et offres.", 'nl' => "Ik wil op de hoogte worden gehouden van acties en aanbiedingen.", 'it' => "Desidero essere informato/a su promozioni e offerte.", 'tr' => "Kampanyalar ve fırsatlar hakkında bilgilendirilmek istiyorum."]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t50'] ?? null, ['de' => "Ich möchte über Aktionen und Angebote informiert werden.", 'en' => "I'd like to be informed about promotions and offers.", 'fr' => "Je souhaite être informé(e) des promotions et offres.", 'nl' => "Ik wil op de hoogte worden gehouden van acties en aanbiedingen.", 'it' => "Desidero essere informato/a su promozioni e offerte.", 'tr' => "Kampanyalar ve fırsatlar hakkında bilgilendirilmek istiyorum."], $currentLang) ?></span>
      </div>
      <div class="gdpr-badge" data-ckey="ergebnisse.t51"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t51'] ?? null, ['de' => "🇪🇺 DSGVO · Ihre Daten sind geschützt", 'en' => "🇪🇺 GDPR · Your data is protected", 'fr' => "🇪🇺 RGPD · Vos données sont protégées", 'nl' => "🇪🇺 AVG · Uw gegevens zijn beschermd", 'it' => "🇪🇺 GDPR · I tuoi dati sono protetti", 'tr' => "🇪🇺 GDPR · Verileriniz Korunmaktadır"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t51'] ?? null, ['de' => "🇪🇺 DSGVO · Ihre Daten sind geschützt", 'en' => "🇪🇺 GDPR · Your data is protected", 'fr' => "🇪🇺 RGPD · Vos données sont protégées", 'nl' => "🇪🇺 AVG · Uw gegevens zijn beschermd", 'it' => "🇪🇺 GDPR · I tuoi dati sono protetti", 'tr' => "🇪🇺 GDPR · Verileriniz Korunmaktadır"], $currentLang) ?></div>
      <div class="consult-nav">
        <button type="button" class="cback" onclick="gotoStep(2)" data-ckey="ergebnisse.t52"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t52'] ?? null, ['de' => "Zurück", 'en' => "Back", 'fr' => "Retour", 'nl' => "Terug", 'it' => "Indietro", 'tr' => "Geri"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t52'] ?? null, ['de' => "Zurück", 'en' => "Back", 'fr' => "Retour", 'nl' => "Terug", 'it' => "Indietro", 'tr' => "Geri"], $currentLang) ?></button>
        <button type="button" class="cnext" id="cnext3" disabled onclick="submitConsult()" data-ckey="ergebnisse.t53"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t53'] ?? null, ['de' => "Absenden", 'en' => "Submit", 'fr' => "Envoyer", 'nl' => "Versturen", 'it' => "Invia", 'tr' => "Gönder"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t53'] ?? null, ['de' => "Absenden", 'en' => "Submit", 'fr' => "Envoyer", 'nl' => "Versturen", 'it' => "Invia", 'tr' => "Gönder"], $currentLang) ?></button>
      </div>
    </div>

    <!-- SUCCESS -->
    <div class="consult-pane" id="cpaneSuccess">
      <div class="consult-success">
        <div class="ok-ring">✓</div>
        <h3 data-ckey="ergebnisse.t54"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t54'] ?? null, ['de' => "Vielen Dank!", 'en' => "Thank You!", 'fr' => "Merci !", 'nl' => "Bedankt!", 'it' => "Grazie!", 'tr' => "Teşekkürler!"]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t54'] ?? null, ['de' => "Vielen Dank!", 'en' => "Thank You!", 'fr' => "Merci !", 'nl' => "Bedankt!", 'it' => "Grazie!", 'tr' => "Teşekkürler!"], $currentLang) ?></h3>
        <p data-ckey="ergebnisse.t55"<?= apex_cms_attrs_or($cmsService['ergebnisse']['t55'] ?? null, ['de' => "Ihre Anfrage ist bei uns eingegangen. Unser Team meldet sich innerhalb von 24 Stunden bei Ihnen.", 'en' => "We've received your request. Our team will get back to you within 24 hours.", 'fr' => "Nous avons bien reçu votre demande. Notre équipe vous recontactera sous 24 heures.", 'nl' => "We hebben uw aanvraag ontvangen. Ons team neemt binnen 24 uur contact met u op.", 'it' => "Abbiamo ricevuto la tua richiesta. Il nostro team ti risponderà entro 24 ore.", 'tr' => "Talebinizi aldık. Ekibimiz 24 saat içinde sizinle iletişime geçecektir."]) ?>><?= apex_cms_value_or($cmsService['ergebnisse']['t55'] ?? null, ['de' => "Ihre Anfrage ist bei uns eingegangen. Unser Team meldet sich innerhalb von 24 Stunden bei Ihnen.", 'en' => "We've received your request. Our team will get back to you within 24 hours.", 'fr' => "Nous avons bien reçu votre demande. Notre équipe vous recontactera sous 24 heures.", 'nl' => "We hebben uw aanvraag ontvangen. Ons team neemt binnen 24 uur contact met u op.", 'it' => "Abbiamo ricevuto la tua richiesta. Il nostro team ti risponderà entro 24 ore.", 'tr' => "Talebinizi aldık. Ekibimiz 24 saat içinde sizinle iletişime geçecektir."], $currentLang) ?></p>
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

  // Meta Pixel Contact event — fired from the WhatsApp floating button's
  // onclick below. Routed through window.__apexPixel.track() (defined in
  // assets/meta-pixel.js) so it's consent-gated the same way Lead is above.
  function trackWhatsAppContact() {
    window.__apexPixel.track('Contact');
  }

  // Meta Pixel ViewContent — this is a service page, so it fires once per
  // load, gated by the same consent logic as PageView/Lead/Contact
  // (batch 4/6): never before marketing consent, but not missed either if
  // consent is granted later in this same page view (see onActivate in
  // assets/meta-pixel.js).
  window.__apexPixel.onActivate(function () {
    window.__apexPixel.track('ViewContent');
  });
</script>

<?php include __DIR__ . '/includes/site-footer.php'; ?>

<a class="whatsapp-fab" href="https://wa.me/436641999199" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp" onclick="trackWhatsAppContact()">
  <svg viewBox="0 0 32 32" fill="#fff" aria-hidden="true"><path d="M16.004 3C9.373 3 4 8.373 4 15.004c0 2.386.7 4.61 1.902 6.478L4 29l7.72-1.865a11.94 11.94 0 0 0 4.284.788h.001C22.635 27.923 28 22.55 28 15.918 28 9.287 22.635 3 16.004 3zm0 21.9h-.001a9.9 9.9 0 0 1-5.05-1.383l-.362-.215-4.583 1.107 1.128-4.47-.236-.376a9.86 9.86 0 0 1-1.516-5.263c0-5.468 4.45-9.917 9.923-9.917 2.65 0 5.14 1.033 7.014 2.909a9.85 9.85 0 0 1 2.905 7.019c0 5.468-4.45 9.589-9.222 9.589z"/><path d="M21.62 18.164c-.297-.148-1.758-.868-2.03-.967-.273-.099-.471-.148-.669.149-.198.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.149-1.254-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.058-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.148-.174.198-.298.297-.496.099-.198.05-.372-.025-.52-.074-.149-.669-1.612-.916-2.208-.242-.58-.487-.502-.669-.511l-.57-.01c-.198 0-.52.074-.792.372-.273.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.876 1.213 3.074.148.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.873.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
</a>

<?php include __DIR__ . '/includes/apex-ai-widget.php'; ?>

</body>
</html>
<?php echo apex_localize_output((string) ob_get_clean(), $currentLang); ?>
