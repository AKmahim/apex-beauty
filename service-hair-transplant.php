<?php
declare(strict_types=1);
$seoTitle = 'Haartransplantation: Ablauf, Eignung & Ergebnisse | Apex Beauty';
$seoDescription = 'Ihr Leitfaden zur Haartransplantation von Apex Beauty: was die Behandlung umfasst, wer geeignet ist, wie die Genesung verläuft und welche Ergebnisse Sie erwarten können.';
$seoCanonicalPath = 'service-hair-transplant';
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="favicon.ico" sizes="any">
<link rel="icon" href="assets/lotus-transparent.png" type="image/png">
<title><?= htmlspecialchars($seoTitle, ENT_QUOTES) ?></title>
<?php require __DIR__ . '/includes/site-meta.php'; ?>
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
<body data-content-page="service">
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
    <div class="eyebrow"><span class="dot"></span><span data-de="Verfahren" data-en="Procedure">Verfahren</span></div>
    <h1 data-ckey="hero.heading" data-de="<span>Haartransplantation</span> bei Apex Beauty" data-en="Hair Transplantation <span>at Apex Beauty</span>">Haartransplantation bei Apex Beauty</h1>
    <p data-ckey="hero.sub" data-de="Ein chirurgischer Eingriff unter örtlicher Betäubung. Gesunde, DHT-resistente Follikel werden aus dem Spenderbereich entnommen und in ausgedünnte Areale verpflanzt, wo sie dauerhaft weiterwachsen." data-en="A surgical procedure under local anaesthesia. Healthy, DHT-resistant follicles are taken from the donor area and relocated to thinning areas, where they keep growing for life.">Ein chirurgischer Eingriff unter örtlicher Betäubung. Gesunde, DHT-resistente Follikel werden aus dem Spenderbereich entnommen und in ausgedünnte Areale verpflanzt, wo sie dauerhaft weiterwachsen.</p>
  </div>
</section>

<div class="hp-quicknav-wrap">
  <div class="hp-quicknav" id="hpQuicknav">
    <a href="#umfasst"><span data-de="Was es umfasst" data-en="What it involves">Was es umfasst</span></a>
    <a href="#geeignet"><span data-de="Wer ist geeignet" data-en="Candidacy">Wer ist geeignet</span></a>
    <a href="#genesung-service"><span data-de="Genesung" data-en="Recovery">Genesung</span></a>
    <a href="#ergebnisse"><span data-de="Ergebnisse" data-en="Results">Ergebnisse</span></a>
  </div>
</div>

<section class="hp-section" id="umfasst">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gSvcGraft" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gSvcGraft)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M22 46c-1-8 1-15 4-19M32 46c0-9 0-16 0-20M42 46c1-8-1-15-4-19" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round"/><circle cx="22" cy="48" r="2.4" fill="#fff"/><circle cx="32" cy="48" r="2.4" fill="#fff"/><circle cx="42" cy="48" r="2.4" fill="#fff"/></svg>
    <div>
      <h2 data-ckey="umfasst.heading" data-de="Was die Behandlung umfasst" data-en="What the treatment involves">Was die Behandlung umfasst</h2>
      <p data-ckey="umfasst.body" data-de="Apex Beauty führt drei anerkannte Transplantationstechniken durch, je nach Fläche, Graft-Anzahl und gewünschtem Detailgrad." data-en="Apex Beauty performs three recognised transplantation techniques, chosen based on area, graft count, and desired level of detail.">Apex Beauty führt drei anerkannte Transplantationstechniken durch, je nach Fläche, Graft-Anzahl und gewünschtem Detailgrad.</p>
    </div>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Die drei wichtigsten Techniken" data-en="The three main techniques">Die drei wichtigsten Techniken</h3>
  <div class="hp-grid" style="margin-bottom:32px">
    <div class="hp-card"><h4 data-de="FUE" data-en="FUE">FUE</h4><p data-de="Follikuläre Einheiten (1 bis 4 Haare) werden einzeln mit einem Mikro-Punch-Werkzeug entnommen. Kein linearer Schnitt, keine sichtbare Narbe. 5 bis 8 Stunden je nach Graft-Anzahl." data-en="Follicular units (1 to 4 hairs) are extracted one by one with a micro-punch tool. No linear incision, no visible scar. 5 to 8 hours depending on graft count.">Follikuläre Einheiten (1 bis 4 Haare) werden einzeln mit einem Mikro-Punch-Werkzeug entnommen. Kein linearer Schnitt, keine sichtbare Narbe. 5 bis 8 Stunden je nach Graft-Anzahl.</p></div>
    <div class="hp-card"><span class="hp-badge" data-de="Meistgenutzt in Istanbul" data-en="Most used in Istanbul">Meistgenutzt in Istanbul</span><h4 data-de="Saphir-FUE" data-en="Sapphire FUE">Saphir-FUE</h4><p data-de="Kanäle werden mit Saphirklingen statt Stahl geöffnet: kleinere, präzisere Schnitte, schnellere Heilung, höhere Dichte pro cm² und geringeres Risiko für Verkrustung." data-en="Channels are opened with sapphire blades instead of steel: smaller, more precise incisions, faster healing, higher density per cm², and lower risk of scabbing.">Kanäle werden mit Saphirklingen statt Stahl geöffnet: kleinere, präzisere Schnitte, schnellere Heilung, höhere Dichte pro cm² und geringeres Risiko für Verkrustung.</p></div>
    <div class="hp-card"><h4 data-de="DHI" data-en="DHI">DHI</h4><p data-de="Follikel werden mit einem Choi Implanter Pen direkt implantiert, ohne separate Kanaleröffnung. Präzise Kontrolle über Winkel und Tiefe, ideal für den Haaransatz." data-en="Follicles are implanted directly using a Choi Implanter Pen, without opening separate channels first. Precise control over angle and depth, ideal for the hairline.">Follikel werden mit einem Choi Implanter Pen direkt implantiert, ohne separate Kanaleröffnung. Präzise Kontrolle über Winkel und Tiefe, ideal für den Haaransatz.</p></div>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Saphir-FUE oder DHI: der Vergleich" data-en="Sapphire FUE vs. DHI: the comparison">Saphir-FUE oder DHI: der Vergleich</h3>
  <div class="hp-table-wrap">
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
</section>

<section class="hp-section alt" id="geeignet">
  <div class="hp-section-in">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gSvcCheck" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gSvcCheck)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M18 32l9 9 19-19" stroke="#fff" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
    <div>
      <h2 data-ckey="geeignet.heading" data-de="Wer ist geeignet?" data-en="Who is a suitable candidate?">Wer ist geeignet?</h2>
      <p data-ckey="geeignet.body" data-de="Eine kostenlose Beratung mit Haaranalyse gibt eine präzise, individuelle Einschätzung." data-en="A free consultation with scalp analysis gives a precise, individual assessment.">Eine kostenlose Beratung mit Haaranalyse gibt eine präzise, individuelle Einschätzung.</p>
    </div>
  </div>
  <div class="hp-checklist">
    <div class="hp-check"><span class="tick">✓</span><p data-de="Androgenetische Alopezie in einer stabilen Phase (der Ausfall hat sich verlangsamt oder stabilisiert)." data-en="Androgenetic alopecia in a stable phase (loss has slowed or stabilised).">Androgenetische Alopezie in einer stabilen Phase (der Ausfall hat sich verlangsamt oder stabilisiert).</p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-de="Ausreichende Spenderdichte an Hinterkopf und Seiten." data-en="Adequate donor density at the back and sides of the scalp.">Ausreichende Spenderdichte an Hinterkopf und Seiten.</p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-de="Realistische Erwartungen: eine Transplantation stellt Dichte wieder her, repliziert aber nicht die volle Haarfülle der Jugend." data-en="Realistic expectations: a transplant restores density but cannot replicate the full hair of early youth.">Realistische Erwartungen: eine Transplantation stellt Dichte wieder her, repliziert aber nicht die volle Haarfülle der Jugend.</p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-de="Guter allgemeiner Gesundheitszustand, keine aktiven Infektionen oder unbehandelten Autoimmunerkrankungen." data-en="Good general health, no active infections or untreated autoimmune conditions.">Guter allgemeiner Gesundheitszustand, keine aktiven Infektionen oder unbehandelten Autoimmunerkrankungen.</p></div>
    <div class="hp-check"><span class="tick">✓</span><p data-de="Frauen mit androgenetischer Alopezie können ebenfalls geeignete Kandidatinnen sein. Bei diffusem Haarausfall über die gesamte Kopfhaut reicht die stabile Spenderdichte jedoch oft nicht aus, eine fachärztliche Beurteilung ist essenziell." data-en="Women with androgenetic alopecia can also be suitable candidates. With diffuse hair loss across the entire scalp, stable donor density is often insufficient, so a specialist assessment is essential.">Frauen mit androgenetischer Alopezie können ebenfalls geeignete Kandidatinnen sein. Bei diffusem Haarausfall über die gesamte Kopfhaut reicht die stabile Spenderdichte jedoch oft nicht aus, eine fachärztliche Beurteilung ist essenziell.</p></div>
  </div>
  </div>
</section>

<section class="hp-section" id="genesung-service">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gSvcCal" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gSvcCal)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="15" y="18" width="34" height="28" rx="5" fill="none" stroke="#fff" stroke-width="2.6"/><line x1="15" y1="27" x2="49" y2="27" stroke="#fff" stroke-width="2.6"/></svg>
    <div>
      <h2 data-ckey="genesungService.heading" data-de="Genesung &amp; Nachsorge" data-en="Recovery &amp; aftercare">Genesung &amp; Nachsorge</h2>
      <p data-ckey="genesungService.body" data-de="Die Erholungsphase ist genauso wichtig wie der Eingriff selbst. Sie bestimmt Graft-Überleben, Heilungsqualität und Endergebnis." data-en="The recovery period matters as much as the procedure itself. It determines graft survival, healing quality, and the final result.">Die Erholungsphase ist genauso wichtig wie der Eingriff selbst. Sie bestimmt Graft-Überleben, Heilungsqualität und Endergebnis.</p>
    </div>
  </div>
  <div class="hp-timeline" style="margin-bottom:44px">
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Tag 1 bis 7" data-en="Day 1 to 7">Tag 1 bis 7</div><h4 data-de="Erste Heilung" data-en="Initial healing">Erste Heilung</h4><p data-de="Kleine Krusten bilden sich, Rötung und leichte Schwellung um Stirn und Augen sind normal. Kopf erhöht schlafen, Kopfhaut nicht berühren." data-en="Small scabs form, redness and mild swelling around the forehead and eyes is common. Sleep with the head elevated, avoid touching the scalp.">Kleine Krusten bilden sich, Rötung und leichte Schwellung um Stirn und Augen sind normal. Kopf erhöht schlafen, Kopfhaut nicht berühren.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Woche 2 bis 4" data-en="Weeks 2 to 4">Woche 2 bis 4</div><h4 data-de="Schock-Verlust" data-en="Shock loss">Schock-Verlust</h4><p data-de="Bis zu 90% der transplantierten Haarschäfte fallen aus. Das ist völlig normal, die Follikel selbst bleiben unter der Kopfhaut aktiv." data-en="Up to 90% of transplanted hair shafts shed. This is completely normal; the follicles themselves remain alive beneath the scalp.">Bis zu 90% der transplantierten Haarschäfte fallen aus. Das ist völlig normal, die Follikel selbst bleiben unter der Kopfhaut aktiv.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 3 bis 6" data-en="Months 3 to 6">Monat 3 bis 6</div><h4 data-de="Sichtbares Wachstum beginnt" data-en="Visible growth begins">Sichtbares Wachstum beginnt</h4><p data-de="Feine neue Haare erscheinen und verdicken sich allmählich. Bis Monat 6 sind rund 40 bis 60% des Endergebnisses sichtbar." data-en="Fine new hairs emerge and gradually thicken. By month 6, around 40 to 60% of the final result is visible.">Feine neue Haare erscheinen und verdicken sich allmählich. Bis Monat 6 sind rund 40 bis 60% des Endergebnisses sichtbar.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 6 bis 9" data-en="Months 6 to 9">Monat 6 bis 9</div><h4 data-de="Die Dichte verbessert sich" data-en="Density improves">Die Dichte verbessert sich</h4><p data-de="Das Haar wird spürbar dicker und dunkler. Rund 80% der Grafts sind zu diesem Zeitpunkt durchgebrochen." data-en="Hair becomes noticeably thicker and darker. Around 80% of grafts have broken through by this point.">Das Haar wird spürbar dicker und dunkler. Rund 80% der Grafts sind zu diesem Zeitpunkt durchgebrochen.</p></div></div>
    <div class="hp-tl-item"><div class="hp-tl-dot"></div><div class="hp-tl-card"><div class="hp-tl-label" data-de="Monat 12 bis 18" data-en="Months 12 to 18">Monat 12 bis 18</div><h4 data-de="Endgültige Verfeinerung" data-en="Final refinement">Endgültige Verfeinerung</h4><p data-de="Die letzten Haare reifen und verdicken sich. Das transplantierte Haar verschmilzt vollständig mit dem natürlichen Haar." data-en="The last hairs mature and thicken. Transplanted hair fully blends with native hair.">Die letzten Haare reifen und verdicken sich. Das transplantierte Haar verschmilzt vollständig mit dem natürlichen Haar.</p></div></div>
  </div>

  <h3 style="font-size:17px;font-weight:700;margin-bottom:14px" data-de="Die wichtigsten Nachsorgeregeln" data-en="Key aftercare rules">Die wichtigsten Nachsorgeregeln</h3>
  <div class="hp-rules">
    <div class="hp-rule"><span class="ric">📍</span><span data-de="Keine direkte Sonne auf der Kopfhaut für mindestens 4 Wochen." data-en="No direct sun exposure on the scalp for at least 4 weeks.">Keine direkte Sonne auf der Kopfhaut für mindestens 4 Wochen.</span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-de="Kein Schwimmen (Pool, Meer, See) für mindestens 4 Wochen." data-en="No swimming (pool, sea, or lake) for at least 4 weeks.">Kein Schwimmen (Pool, Meer, See) für mindestens 4 Wochen.</span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-de="Kein intensiver Sport oder starkes Schwitzen für 2 bis 3 Wochen." data-en="No intense exercise or heavy sweating for 2 to 3 weeks.">Kein intensiver Sport oder starkes Schwitzen für 2 bis 3 Wochen.</span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-de="Kein Alkohol in der ersten Woche, er beeinträchtigt die Durchblutung." data-en="No alcohol for the first week; it affects blood circulation.">Kein Alkohol in der ersten Woche, er beeinträchtigt die Durchblutung.</span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-de="Nicht rauchen: Nikotin verengt die Blutgefäße und senkt die Graft-Überlebensrate." data-en="No smoking: nicotine restricts blood supply and reduces graft survival.">Nicht rauchen: Nikotin verengt die Blutgefäße und senkt die Graft-Überlebensrate.</span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-de="Kopf erhöht schlafen für die ersten 3 bis 5 Nächte." data-en="Sleep with the head elevated for the first 3 to 5 nights.">Kopf erhöht schlafen für die ersten 3 bis 5 Nächte.</span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-de="Sanft waschen nach Klinikanleitung, keinen starken Wasserstrahl direkt auf die Grafts." data-en="Wash gently per the clinic's instructions; no strong water pressure directly on the grafts.">Sanft waschen nach Klinikanleitung, keinen starken Wasserstrahl direkt auf die Grafts.</span></div>
    <div class="hp-rule"><span class="ric">📍</span><span data-de="Alle Folgetermine wahrnehmen, manche Kliniken bieten Remote-Check-ins an." data-en="Attend all follow-up appointments; some clinics offer remote check-ins.">Alle Folgetermine wahrnehmen, manche Kliniken bieten Remote-Check-ins an.</span></div>
  </div>
</section>

<section class="hp-section alt" id="ergebnisse">
  <div class="hp-section-in">
  <div class="hp-section-head">
    <svg class="hp-section-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gSvcResult" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gSvcResult)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="27" cy="32" r="13" fill="#fff" opacity="0.5"/><circle cx="39" cy="32" r="13" fill="#fff" opacity="0.85"/></svg>
    <div>
      <h2 data-ckey="ergebnisse.heading" data-de="Ergebnisse: was Sie realistisch erwarten können" data-en="Results: what to realistically expect">Ergebnisse: was Sie realistisch erwarten können</h2>
      <p data-ckey="ergebnisse.body" data-de="Das vollständige Ergebnis zeigt sich erst nach 12 bis 18 Monaten, nicht sofort." data-en="Full results are visible at 12 to 18 months, not immediately.">Das vollständige Ergebnis zeigt sich erst nach 12 bis 18 Monaten, nicht sofort.</p>
    </div>
  </div>
  <div class="hp-checklist" style="margin-bottom:36px">
    <div class="hp-check"><span class="tick">i</span><p data-de="Eine Transplantation verschiebt vorhandene gesunde Follikel, sie erschafft keine neuen. Das Ergebnis ist durch den verfügbaren Spenderbereich begrenzt." data-en="A transplant relocates existing healthy follicles; it cannot create new ones. The result is limited by the available donor area.">Eine Transplantation verschiebt vorhandene gesunde Follikel, sie erschafft keine neuen. Das Ergebnis ist durch den verfügbaren Spenderbereich begrenzt.</p></div>
    <div class="hp-check"><span class="tick">i</span><p data-de="Transplantiertes Haar wächst lebenslang, da es aus DHT-resistenten Zonen stammt." data-en="Transplanted hair grows for life because it's taken from DHT-resistant zones.">Transplantiertes Haar wächst lebenslang, da es aus DHT-resistenten Zonen stammt.</p></div>
    <div class="hp-check"><span class="tick">i</span><p data-de="Die Graft-Überlebensrate liegt bei seriösen Kliniken bei 90 bis 95%. Bleibt das Ergebnis nach 12 bis 18 Monaten unter den Erwartungen, kann eine Folgesitzung besprochen werden. Apex Beauty bietet eine Kontrolluntersuchung nach 12 Monaten an." data-en="Graft survival rates at reputable clinics are generally 90 to 95%. If the result is below expectations after 12 to 18 months, a follow-up session can be discussed. Apex Beauty offers a 12-month follow-up consultation to assess the outcome.">Die Graft-Überlebensrate liegt bei seriösen Kliniken bei 90 bis 95%. Bleibt das Ergebnis nach 12 bis 18 Monaten unter den Erwartungen, kann eine Folgesitzung besprochen werden. Apex Beauty bietet eine Kontrolluntersuchung nach 12 Monaten an.</p></div>
    <div class="hp-check"><span class="tick">i</span><p data-de="In den ersten 1 bis 2 Wochen können Krusten und Rötungen sichtbar sein. Danach ist die Heilung weitgehend unsichtbar. Ab Monat 4 bis 6 verschmilzt das neue Haar natürlich mit dem vorhandenen, bei einem erfahrenen Chirurgen nicht von echtem Haar zu unterscheiden." data-en="In the first 1 to 2 weeks, visible scabbing and redness may be noticeable. After that, healing is largely invisible. By months 4 to 6, the new hair blends naturally and, with an experienced surgeon, is indistinguishable from native hair.">In den ersten 1 bis 2 Wochen können Krusten und Rötungen sichtbar sein. Danach ist die Heilung weitgehend unsichtbar. Ab Monat 4 bis 6 verschmilzt das neue Haar natürlich mit dem vorhandenen, bei einem erfahrenen Chirurgen nicht von echtem Haar zu unterscheiden.</p></div>
  </div>
  <p style="font-size:14px;color:var(--ink-soft);line-height:1.6;max-width:640px" data-de="Möchten Sie tiefer eintauchen? Unsere &lt;a href=&quot;hairpedia.html&quot; style=&quot;color:var(--blue-700);text-decoration:underline;font-weight:600;&quot;&gt;Hairpedia&lt;/a&gt; behandelt Haarausfall, Diagnose, Techniken und den vollständigen Monat-für-Monat-Heilungsverlauf im Detail." data-en="Want to go deeper? Our &lt;a href=&quot;hairpedia.html&quot; style=&quot;color:var(--blue-700);text-decoration:underline;font-weight:600;&quot;&gt;Hairpedia&lt;/a&gt; covers hair loss, diagnosis, techniques, and the full month-by-month healing timeline in detail.">Möchten Sie tiefer eintauchen? Unsere <a href="hairpedia.html" style="color:var(--blue-700);text-decoration:underline;font-weight:600;">Hairpedia</a> behandelt Haarausfall, Diagnose, Techniken und den vollständigen Monat-für-Monat-Heilungsverlauf im Detail.</p>
  </div>
</section>

<section style="padding: 40px 48px 60px; text-align:center; max-width:1180px; margin:0 auto;">
  <a href="#" class="cta-btn" onclick="openConsult(event)" style="padding:16px 34px; font-size:15.5px; display:inline-flex;" data-de="Kostenlose Beratung sichern" data-en="Get your free consultation">Kostenlose Beratung sichern</a>
</section>


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

</body>
</html>
