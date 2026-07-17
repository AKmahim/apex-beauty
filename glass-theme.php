<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- favicon -->
<link rel="icon" href="assets/lotus-transparent.png" type="image/x-icon">
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
<title>Apex Beauty</title>
<script src="assets/meta-pixel.js"></script>
<script src="assets/cookie-consent.js?v=24"></script>
<script src="assets/content-loader.js?v=23"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@100..800&display=swap" rel="stylesheet">
<script type="importmap">
{
  "imports": {
    "three": "https://cdn.jsdelivr.net/npm/three@0.167.0/build/three.module.js",
    "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.167.0/examples/jsm/"
  }
}
</script>
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
    background: var(--paper);
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
  @media (max-width: 640px) {
    .whatsapp-fab { bottom: 16px; right: 16px; width: 50px; height: 50px; }
    .whatsapp-fab svg { width: 27px; height: 27px; }
  }

  /* Desktop-only 10% zoom out — mobile keeps its own tightly-tuned responsive
     scale, so this is scoped to the same breakpoint used everywhere else.
     Applied to body, not html: html is the element that actually owns the
     native scrollbar, and zooming it directly shrinks the scrollbar track
     along with the page, leaving a gap instead of spanning the full window
     height. Zooming body instead keeps html (and the scrollbar) at true
     1:1 scale while everything visually inside the page still renders at 90%. */
  @media (min-width: 901px) {
    body { zoom: 0.9; }
  }

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

  /* ---- HERO ---- */
  .hero {
    position: relative;
    min-height: 92vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: #ffffff;
    padding: 56px 0 64px;
  }
  @media (min-width: 901px) {
    /* The desktop-only body zoom above (0.9) also scales down this
       min-height at render time, so 92vh fell noticeably short of the
       actual window height and let the next section peek in before any
       scrolling happened. Dividing by the zoom factor compensates so the
       hero's true on-screen height still reaches the full viewport. This
       has to come after the base .hero rule to win the cascade. Centering
    content (the base rule's align-items:center) inside this much-taller
    box left a large empty gap above the eyebrow pill, so pin content to
    the top instead — the extra height still pads out the bottom, which
    is what actually prevents the peek-through. */
    .hero { min-height: calc(100vh / 0.9); align-items: flex-start; }
  }
  .hero-inner > * { min-width: 0; }
  .hero-bg-layer {
    position: absolute;
    inset: 0;
    background-image:
      radial-gradient(circle at 12% 20%, rgba(125,211,252,0.35) 0%, transparent 45%),
      radial-gradient(circle at 90% 10%, rgba(94,185,224,0.3) 0%, transparent 50%),
      radial-gradient(circle at 80% 90%, rgba(61,111,214,0.22) 0%, transparent 50%),
      radial-gradient(circle at 10% 90%, rgba(45,212,191,0.18) 0%, transparent 45%);
  }
  .hero-mobile-video, .hero-mobile-scrim { display: none; }
  .hero-inner {
    position: relative;
    z-index: 2;
    max-width: 1600px;
    margin: 0 auto;
    padding: 0 48px;
    display: grid;
    grid-template-columns: 0.95fr 1.15fr;
    gap: 48px;
    align-items: center;
  }
  .eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 700;
    color: #1d2f3d;
    background: rgba(255,255,255,0.45);
    border: 1px solid rgba(255,255,255,0.75);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
    padding: 6px 14px;
    border-radius: 999px;
    margin-bottom: 24px;
    backdrop-filter: blur(16px) saturate(1.5);
    -webkit-backdrop-filter: blur(16px) saturate(1.5);
  }
  .eyebrow .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--accent-amber); }
  h1 {
    font-family: 'Urbanist', -apple-system, sans-serif;
    font-size: 46px;
    line-height: 1.16;
    font-weight: 300;
    color: #1a2733;
    letter-spacing: -0.01em;
    margin-bottom: 20px;
    text-wrap: balance;
  }
  h1 span {
    background: linear-gradient(100deg, var(--blue-600), var(--blue-700));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
  }
  .hero-sub {
    font-size: 17px;
    line-height: 1.6;
    color: #33424d;
    max-width: 500px;
    margin-bottom: 28px;
  }
  /* Shortened, hardcoded mobile-only stand-in for .hero-sub (not CMS-driven —
     see the Glass Premium mockup, which shows a single short line instead of
     the full CMS paragraph). Shares .hero-sub's typography via the same
     class; hidden on desktop, swapped in on mobile in the media query below. */
  .hero-sub-mobile { display: none; }
  /* ---- ANNOUNCEMENT BAR (top scroller) ---- */
  .announce-bar {
    position: sticky; top: 0; z-index: 60;
    overflow: hidden;
    isolation: isolate;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    max-height: 68px;
    transition: max-height 0.35s ease, opacity 0.3s ease;
    background: linear-gradient(100deg, rgba(224,242,254,0.68), rgba(191,225,250,0.56) 55%, rgba(219,238,254,0.62));
    background-color: rgba(255,255,255,0.5);
    backdrop-filter: blur(34px) saturate(2.4);
    -webkit-backdrop-filter: blur(34px) saturate(2.4);
    border-bottom: 1px solid rgba(255,255,255,0.65);
    box-shadow: 0 1px 0 rgba(255,255,255,0.95) inset, 0 -1px 0 rgba(15,32,39,0.06) inset, 0 10px 28px -16px rgba(37,99,235,0.3);
  }
  .announce-bar::before {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(118deg, rgba(255,255,255,0.7) 0%, rgba(255,255,255,0.18) 26%, transparent 52%, rgba(255,255,255,0.1) 76%, rgba(255,255,255,0.4) 100%);
    pointer-events: none;
  }
  .announce-glint {
    position: absolute; top: -30%; bottom: -30%;
    left: 0;
    width: 16%;
    background: linear-gradient(100deg, transparent, rgba(255,255,255,0.4), transparent);
    pointer-events: none;
    will-change: transform;
    animation: announceGlint 7s ease-in-out infinite;
  }
  @keyframes announceGlint {
    0% { transform: translateX(-250%) skewX(-18deg); }
    38% { transform: translateX(750%) skewX(-18deg); }
    100% { transform: translateX(750%) skewX(-18deg); }
  }
  .announce-bar::after {
    content: '';
    position: absolute; left: 0; right: 0; bottom: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent 0%, rgba(56,189,248,0.7) 22%, rgba(37,99,235,0.6) 40%, rgba(125,211,252,0.7) 58%, transparent 82%, transparent 100%);
    background-size: 260% 100%;
    animation: announceLineMove 6s linear infinite;
    pointer-events: none;
  }
  @keyframes announceLineMove {
    0% { background-position: 100% 0; }
    100% { background-position: -160% 0; }
  }
  .announce-bar.is-closed { max-height: 0; opacity: 0; }
  .announce-inner {
    display: flex; align-items: center; gap: 16px;
    width: 100%;
    padding: 11px 32px;
  }
  .announce-viewport { flex: 1; min-width: 0; overflow: hidden; }
  .announce-track {
    display: flex;
    width: max-content;
    will-change: transform;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    animation: announceMarquee 26s linear infinite;
  }
  .announce-bar:hover .announce-track { animation-play-state: paused; }
  @keyframes announceMarquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
  }
  .announce-items {
    display: flex; align-items: center; gap: 22px;
    flex-shrink: 0;
    padding-right: 22px;
  }
  .announce-item { display: flex; align-items: center; gap: 9px; flex-shrink: 0; }
  .announce-item .ico { width: 26px; height: 26px; flex-shrink: 0; display: block; }
  .announce-item .ico svg.gi-usp { filter: none; }
  .announce-item b {
    display: block; font-size: 11.5px; color: #16232e; font-weight: 800; line-height: 1;
    white-space: nowrap; text-transform: uppercase; letter-spacing: 0.02em;
  }
  .announce-divider { width: 1px; height: 26px; background: rgba(15,32,39,0.14); flex-shrink: 0; }
  .announce-close {
    flex-shrink: 0; width: 30px; height: 30px; border-radius: 50%;
    border: 1px solid rgba(15,32,39,0.14); background: rgba(255,255,255,0.6);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--ink-soft); font-size: 14px; line-height: 1;
    transition: all 0.15s ease;
  }
  .announce-close:hover { background: rgba(255,255,255,0.95); color: var(--ink); transform: scale(1.06); }
  .hero-ctas { display: flex; align-items: stretch; gap: 14px; margin-bottom: 32px; }
  .hero-ctas .cta-btn { padding: 15px 28px; font-size: 15.5px; display: inline-flex; align-items: center; }
  .hero-ctas .cta-ghost { white-space: nowrap; display: inline-flex; align-items: center; }
  .hero-ctas .cta-ghost {
    color: #1a2733;
    background: rgba(255,255,255,0.55);
    backdrop-filter: blur(22px) saturate(1.6);
    -webkit-backdrop-filter: blur(22px) saturate(1.6);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
    border-color: rgba(26,39,51,0.16);
    padding: 14.5px 26px;
    font-size: 15.5px;
  }
  .hero-microtrust {
    display: flex;
    flex-wrap: nowrap;
    gap: 8px;
    max-width: none;
  }
  .trust-pill {
    position: relative;
    overflow: hidden;
    flex-shrink: 0;
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 6px;
    padding: 7px 13px;
    border-radius: 999px;
    background: rgba(255,255,255,0.6);
    backdrop-filter: blur(16px) saturate(1.5);
    -webkit-backdrop-filter: blur(16px) saturate(1.5);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
    font-size: 12px;
    font-weight: 700;
    line-height: 1.2;
    white-space: nowrap;
    color: #1a2733;
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .trust-pill::before {
    content: ''; position: absolute; inset: 0; border-radius: 999px;
    background: linear-gradient(165deg, rgba(255,255,255,0.5) 0%, transparent 55%);
    pointer-events: none;
  }
  .trust-pill:hover { transform: translateY(-2px); }
  .trust-pill svg { flex-shrink: 0; position: relative; z-index: 1; }
  .trust-pill span { position: relative; z-index: 1; }
  .trust-pill.tp-amber { border: 1px solid rgba(56,189,248,0.5); }
  .trust-pill.tp-amber svg { color: #0284c7; }
  .trust-pill.tp-pink { border: 1px solid rgba(59,130,246,0.45); }
  .trust-pill.tp-pink svg { color: #2563eb; }
  .trust-pill.tp-teal { border: 1px solid rgba(14,165,233,0.5); }
  .trust-pill.tp-teal svg { color: #0ea5e9; }
  .star-row { display: flex; gap: 1px; }

  /* floating parallax card (foreground layer, moves opposite bg) */
  .hero-visual {
    position: relative;
    height: 600px;
  }
  .visual-frame {
    position: absolute;
    inset: 0;
    overflow: hidden;
    border-radius: 24px;
    background: linear-gradient(160deg, rgba(255,255,255,0.32), rgba(255,255,255,0.12));
    border: 1px solid rgba(255,255,255,0.6);
    box-shadow: 0 24px 48px -20px rgba(10,20,30,0.28), inset 0 1px 0 rgba(255,255,255,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(20,30,40,0.55);
    font-size: 14px;
    text-align: center;
  }
  .visual-frame video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* The source clip is portrait (1080x1920) inside a landscape frame, so
       cover crops most of its height; shifted from 22% toward the top so the
       Apex Beauty logo stays fully in frame instead of being clipped. */
    object-position: center 12%;
  }
  .sound-toggle {
    position: absolute; bottom: 16px; right: 16px; z-index: 2;
    width: 40px; height: 40px; border-radius: 50%;
    background: rgba(15,20,28,0.45);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.4);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: #fff; padding: 0;
    transition: background 0.15s ease, transform 0.15s ease;
  }
  .sound-toggle:hover { background: rgba(15,20,28,0.65); transform: scale(1.06); }
  .sound-toggle svg { width: 18px; height: 18px; display: block; }
  .sound-toggle .icon-muted { display: none; }
  .sound-toggle.is-muted .icon-on { display: none; }
  .sound-toggle.is-muted .icon-muted { display: block; }
  .sound-toggle-mobile { display: none; }
  .float-card {
    position: absolute;
    z-index: 3;
    background: rgba(255,255,255,0.5);
    backdrop-filter: blur(24px) saturate(2);
    -webkit-backdrop-filter: blur(24px) saturate(2);
    border: 1px solid rgba(255,255,255,0.9);
    border-radius: 16px;
    padding: 14px 18px;
    /* Layered box-shadow fakes the bevel/rim-lit edge a real glass shader
       would compute: bright top inset for the "light catching the top edge"
       look, a faint blue inset along the bottom for depth, and the original
       soft drop shadow underneath for elevation. */
    box-shadow:
      0 16px 32px -10px rgba(20,40,60,0.28),
      inset 0 1px 0 rgba(255,255,255,0.95),
      inset 0 -10px 18px -14px rgba(37,99,235,0.35),
      inset 1px 0 0 rgba(255,255,255,0.5),
      inset -1px 0 0 rgba(100,116,139,0.18);
    font-size: 13px;
    font-weight: 600;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: 10px;
    overflow: hidden;
  }
  .fc-glass-tint {
    position: absolute; inset: 0; border-radius: inherit;
    background: linear-gradient(135deg, rgba(255,255,255,0.88) 0%, rgba(255,255,255,0.38) 45%, rgba(255,255,255,0.6) 100%);
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
  }
  /* A soft diagonal highlight that slowly sweeps across the card, standing
     in for the moving specular glint a real-time glass shader renders. */
  .fc-glass-tint::before {
    content: '';
    position: absolute;
    top: -60%;
    left: 0;
    width: 26%;
    height: 220%;
    background: linear-gradient(100deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.75) 50%, rgba(255,255,255,0) 100%);
    transform: translateX(-160%) rotate(12deg);
    animation: glassSheen 7s ease-in-out infinite;
  }
  @keyframes glassSheen {
    0%, 45%, 100% { transform: translateX(-160%) rotate(12deg); }
    22% { transform: translateX(420%) rotate(12deg); }
  }
  .float-card.fc-1 { animation: floatSlow 5.5s ease-in-out infinite; }
  .float-card.fc-2 { animation: floatSlow 5.5s ease-in-out infinite; animation-delay: -2.75s; }
  @keyframes floatSlow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
  }
  .float-card .icon, .float-card > div:not(.fc-glass-tint) {
    position: relative; z-index: 1;
  }
  .float-card .icon {
    width: 34px; height: 34px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .float-card .icon svg { width: 100%; height: 100%; }
  .float-card.fc-2 { text-decoration: none; color: var(--ink); }
  .fc-1 { top: 8%; left: -10%; }
  .fc-2 { bottom: 20%; right: -5%; }

  /* ---- TRUST BAR ---- */
  .trust-bar {
    position: relative;
    z-index: 3;
    background: white;
    border-top: 1px solid rgba(15,32,39,0.06);
    margin-top: -1px;
  }
  .trust-inner {
    max-width: 1180px;
    margin: 0 auto;
    padding: 36px 48px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
  }
  .trust-item {
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .trust-icon {
    width: 44px; height: 44px;
    flex-shrink: 0;
  }
  .trust-num { font-size: 22px; font-weight: 700; letter-spacing: -0.01em; }
  .trust-label { font-size: 13px; color: var(--ink-soft); font-weight: 500; }

  /* ---- GLASS GRADIENT ICONS ---- */
  .gi { width: 100%; height: 100%; display: block; overflow: visible; }
  .gi-ti { filter: drop-shadow(0 6px 14px rgba(15,32,39,0.22)); }
  .gi-usp { filter: drop-shadow(0 4px 10px rgba(15,32,39,0.16)); }
  .gi-fc { filter: drop-shadow(0 3px 8px rgba(15,32,39,0.20)); }

  /* ---- Hover micro-parallax ---- */
  .float-card { transition: transform 0.25s ease, box-shadow 0.25s ease; }
  .float-card:hover { transform: translateY(-4px); }
  .float-card .icon { transition: transform 0.25s ease; }
  .float-card:hover .icon { transform: translateY(-2px) scale(1.08); }
  .trust-pill { transition: transform 0.2s ease, border-color 0.2s ease; }
  .trust-pill:hover { transform: translateY(-2px); }
  .trust-pill svg { transition: transform 0.2s ease; }
  .trust-pill:hover svg { transform: translateY(-1px) scale(1.12); }
  .trust-item .trust-icon { transition: transform 0.25s ease; }
  .trust-item:hover .trust-icon { transform: translateY(-3px) scale(1.07); }
  .step-card { transition: transform 0.25s ease, box-shadow 0.25s ease; }
  .step-card:hover { transform: translateY(-5px); }
  .step-num { transition: transform 0.25s ease; }
  .step-card:hover .step-num { transform: translateY(-2px) scale(1.1); }

  /* ---- BEFORE & AFTER ---- */
  .ba-section {
    position: relative;
    overflow: hidden;
    background: #ffffff;
    padding: 88px 48px 96px;
  }
  .ba-bg-layer {
    position: absolute; inset: 0;
    background-image:
      radial-gradient(circle at 10% 15%, rgba(125,211,252,0.18) 0%, transparent 45%),
      radial-gradient(circle at 92% 85%, rgba(37,99,235,0.1) 0%, transparent 50%);
  }
  .ba-inner { position: relative; z-index: 2; max-width: 1180px; margin: 0 auto; }
  .ba-head { max-width: 640px; margin: 0 auto 48px; text-align: center; }
  .ba-kicker {
    display: inline-block; font-size: 13px; font-weight: 700; letter-spacing: 0.04em;
    text-transform: uppercase; color: var(--teal-700); margin-bottom: 14px;
  }
  .ba-head h2 {
    font-family: 'Urbanist', -apple-system, sans-serif; font-size: 38px; line-height: 1.16;
    font-weight: 300; color: var(--ink); margin-bottom: 14px; letter-spacing: -0.01em;
  }
  .ba-head h2 .hl {
    background: linear-gradient(100deg, var(--blue-600), var(--blue-700));
    -webkit-background-clip: text; background-clip: text; color: transparent;
    font-weight: 600;
  }
  .ba-head p { font-size: 15.5px; color: var(--ink-soft); line-height: 1.6; }

  .ba-carousel { display: flex; align-items: center; gap: 20px; margin-bottom: 40px; }
  .ba-arrow {
    flex-shrink: 0; width: 48px; height: 48px; border-radius: 50%;
    background: rgba(255,255,255,0.7); border: 1px solid rgba(255,255,255,0.9);
    backdrop-filter: blur(20px) saturate(1.8); -webkit-backdrop-filter: blur(20px) saturate(1.8);
    box-shadow: 0 12px 28px -10px rgba(20,40,60,0.28), inset 0 1px 0 rgba(255,255,255,0.9);
    display: flex; align-items: center; justify-content: center; cursor: pointer;
    color: var(--blue-700); transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .ba-arrow:hover { transform: scale(1.08); }
  .ba-arrow svg { width: 20px; height: 20px; }

  .ba-track { flex: 1; min-width: 0; overflow: hidden; touch-action: pan-y; }
  .ba-slide { display: none; }
  .ba-slide.active { display: block; }
  /* Direction-aware entrance: prev/next arrows and dot-jumps pick dir-next
     or dir-prev (see the carousel script) so the case actually slides in
     from the side it logically came from, instead of just fading in place.
     dir-init is the original subtle fade, used only on first paint. */
  .ba-slide.active.dir-next { animation: baSlideInRight 0.5s cubic-bezier(0.22, 0.9, 0.32, 1); }
  .ba-slide.active.dir-prev { animation: baSlideInLeft 0.5s cubic-bezier(0.22, 0.9, 0.32, 1); }
  .ba-slide.active.dir-init { animation: baFade 0.35s ease; }
  @keyframes baFade { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
  @keyframes baSlideInRight { from { opacity: 0; transform: translateX(44px) scale(0.98); } to { opacity: 1; transform: translateX(0) scale(1); } }
  @keyframes baSlideInLeft { from { opacity: 0; transform: translateX(-44px) scale(0.98); } to { opacity: 1; transform: translateX(0) scale(1); } }

  .ba-compare {
    display: grid; grid-template-columns: 1fr 1fr; gap: 22px;
    border-radius: 26px; padding: 14px;
    background: linear-gradient(160deg, rgba(255,255,255,0.62), rgba(255,255,255,0.4));
    backdrop-filter: blur(24px) saturate(2); -webkit-backdrop-filter: blur(24px) saturate(2);
    border: 1px solid rgba(255,255,255,0.9);
    box-shadow:
      0 30px 70px -24px rgba(20,40,60,0.32),
      inset 0 1px 0 rgba(255,255,255,0.95),
      inset 0 -14px 26px -20px rgba(37,99,235,0.22);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .ba-compare:hover {
    transform: translateY(-3px);
    box-shadow:
      0 36px 80px -22px rgba(20,40,60,0.36),
      inset 0 1px 0 rgba(255,255,255,0.95),
      inset 0 -14px 26px -20px rgba(37,99,235,0.24);
  }
  .ba-photo { position: relative; aspect-ratio: 3 / 4.7; }
  .ba-photo-frame {
    position: absolute; inset: 0; overflow: hidden; border-radius: 18px;
    background: linear-gradient(160deg, #cfe8f7 0%, #7fb8e0 50%, #3d6fd6 100%);
    box-shadow: inset 0 0 0 1px rgba(255,255,255,0.4), inset 0 -40px 60px -20px rgba(10,20,40,0.28);
  }
  .ba-photo img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
  .ba-tag {
    position: absolute; top: 14px; left: 14px; z-index: 2;
    background: rgba(255,255,255,0.92); color: var(--ink);
    font-size: 11.5px; font-weight: 800; letter-spacing: 0.04em;
    padding: 6px 14px; border-radius: 999px;
    box-shadow: 0 6px 14px -6px rgba(20,40,60,0.3);
  }
  .ba-photo.ba-after .ba-tag { left: auto; right: 14px; }
  .ba-placeholder {
    position: absolute; inset: 0; display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 8px; text-align: center; padding: 20px;
    color: rgba(255,255,255,0.85);
  }
  .ba-placeholder svg { width: 34px; height: 34px; opacity: 0.85; }
  .ba-placeholder b { font-size: 12.5px; font-weight: 700; }
  .ba-callout {
    position: absolute; bottom: -16px; left: 12px; right: 12px; z-index: 2;
    background: rgba(255,255,255,0.6);
    backdrop-filter: blur(20px) saturate(2); -webkit-backdrop-filter: blur(20px) saturate(2);
    border: 1px solid rgba(255,255,255,0.95); border-radius: 14px;
    padding: 12px 14px; display: flex; align-items: flex-start; gap: 10px;
    box-shadow:
      0 16px 30px -12px rgba(20,40,60,0.32),
      inset 0 1px 0 rgba(255,255,255,0.95),
      inset 0 -8px 14px -12px rgba(37,99,235,0.3);
    animation: floatSlow 5.5s ease-in-out infinite;
  }
  .ba-photo.ba-after .ba-callout { animation-delay: -2.75s; }
  .ba-callout .ba-callout-ico {
    flex-shrink: 0; width: 28px; height: 28px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, var(--teal-500), var(--blue-600)); color: #fff;
  }
  .ba-callout .ba-callout-ico svg { width: 15px; height: 15px; }
  .ba-callout b { display: block; font-size: 11.5px; font-weight: 800; color: var(--ink); margin-bottom: 2px; text-transform: uppercase; letter-spacing: 0.02em; }
  .ba-callout span { display: block; font-size: 11px; color: var(--ink-soft); line-height: 1.5; }

  .ba-dots { display: flex; align-items: center; justify-content: center; gap: 8px; margin: 28px 0 44px; }
  .ba-dot { width: 8px; height: 8px; border-radius: 50%; background: rgba(29,78,216,0.22); border: none; cursor: pointer; padding: 0; transition: transform 0.2s ease, background 0.2s ease; }
  .ba-dot.active { background: var(--blue-600); transform: scale(1.3); }
  .ba-carousel.single-slide .ba-arrow { display: none; }
  .ba-dots.single-slide { display: none; }

  .ba-features {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;
    border-radius: 20px; padding: 30px 24px; margin-bottom: 36px;
    background: rgba(224,242,254,0.4);
    border: 1px solid rgba(255,255,255,0.8);
  }
  .ba-feature { display: flex; flex-direction: column; align-items: center; text-align: center; gap: 10px; }
  .ba-feature-ico { flex-shrink: 0; width: 44px; height: 44px; transition: transform 0.25s ease; }
  .ba-feature:hover .ba-feature-ico { transform: translateY(-3px) scale(1.07); }
  .ba-feature b { display: block; font-size: 13.5px; font-weight: 700; color: var(--ink); margin-bottom: 2px; }
  .ba-feature span { display: block; font-size: 12px; color: var(--ink-soft); }

  .ba-cta-wrap { text-align: center; }

  /* ---- SERVICE / USP (draft copy) ---- */
  .service {
    position: relative;
    overflow: hidden;
    background: #0a0e14;
    padding: 88px 48px 96px;
  }
  .service-video {
    position: absolute; inset: 0; width: 100%; height: 100%;
    object-fit: cover; z-index: 0;
  }
  .service-scrim {
    position: absolute; inset: 0; z-index: 1;
    background: linear-gradient(180deg, rgba(6,10,16,0.82) 0%, rgba(6,10,16,0.68) 45%, rgba(6,10,16,0.88) 100%);
  }
  .service-inner { position: relative; z-index: 2; max-width: 1180px; margin: 0 auto; }
  .service-head { max-width: 640px; margin: 0 auto 56px; text-align: center; }
  .service-kicker {
    display: inline-block; font-size: 13px; font-weight: 700; letter-spacing: 0.04em;
    text-transform: uppercase; color: #7dd3fc; margin-bottom: 14px;
  }
  .service-head h2 { font-family: 'Urbanist', -apple-system, sans-serif; font-size: 40px; line-height: 1.16; font-weight: 300; color: #ffffff; margin-bottom: 14px; }
  .service-head p { font-size: 16.5px; color: rgba(226,232,240,0.82); line-height: 1.6; }
  .service-steps { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; position: relative; }
  .service-steps::before {
    content: ''; position: absolute; top: 34px; left: 16.6%; right: 16.6%; height: 2px;
    background: linear-gradient(90deg, var(--accent-amber), var(--teal-600), var(--accent-purple));
    z-index: 0;
  }
  .step-card {
    position: relative; z-index: 1;
    backdrop-filter: blur(18px) saturate(1.5);
    -webkit-backdrop-filter: blur(18px) saturate(1.5);
    border-radius: 18px; padding: 28px 24px;
  }
  .step-card.s1 { background: linear-gradient(160deg, rgba(125,211,252,0.24), rgba(37,99,235,0.08)); background-color: rgba(255,255,255,0.06); border: 1px solid rgba(56,189,248,0.4); box-shadow: 0 0 0 1px rgba(56,189,248,0.12), 0 16px 36px -18px rgba(0,0,0,0.55); }
  .step-card.s2 { background: linear-gradient(160deg, rgba(96,165,250,0.22), rgba(37,99,235,0.1)); background-color: rgba(255,255,255,0.06); border: 1px solid rgba(59,130,246,0.4); box-shadow: 0 0 0 1px rgba(59,130,246,0.12), 0 16px 36px -18px rgba(0,0,0,0.55); }
  .step-card.s3 { background: linear-gradient(160deg, rgba(147,197,253,0.22), rgba(30,64,175,0.12)); background-color: rgba(255,255,255,0.06); border: 1px solid rgba(37,99,235,0.4); box-shadow: 0 0 0 1px rgba(37,99,235,0.12), 0 16px 36px -18px rgba(0,0,0,0.55); }
  .step-num {
    width: 36px; height: 36px; border-radius: 50%; color: white; font-weight: 700; font-size: 15px;
    display: flex; align-items: center; justify-content: center; margin-bottom: 18px;
    box-shadow: 0 0 0 4px rgba(255,255,255,0.08);
  }
  .step-card.s1 .step-num { background: linear-gradient(135deg, var(--accent-amber), var(--blue-600)); }
  .step-card.s2 .step-num { background: linear-gradient(135deg, var(--teal-600), var(--blue-600)); }
  .step-card.s3 .step-num { background: linear-gradient(135deg, var(--blue-600), var(--accent-purple)); }
  .step-flag { font-size: 12px; font-weight: 700; letter-spacing: 0.03em; text-transform: uppercase; color: rgba(226,232,240,0.6); margin-bottom: 6px; }
  .step-card h3 { font-size: 19px; font-weight: 700; margin-bottom: 8px; color: #ffffff; }
  .step-card p { font-size: 14px; line-height: 1.55; color: rgba(226,232,240,0.75); }
  .service-foot {
    margin-top: 48px; display: flex; align-items: center; justify-content: center; gap: 10px;
    font-size: 14px; color: rgba(226,232,240,0.75); text-align: center;
  }
  .service-foot b { color: #7dd3fc; }

  @media (max-width: 900px) {
    .nav-right .cta-btn { white-space: nowrap; }
    /* Glass Premium mockup order: eyebrow -> heading -> subtext -> video ->
       CTAs -> stats. The markup keeps hero-visual as hero-inner's 2nd child
       (desktop needs it beside the text), so on mobile the text wrapper is
       unboxed via display:contents and every hero-inner descendant gets an
       explicit flex order instead of relying on DOM position. */
    /* Mobile hero also drops its forced 92vh min-height (a desktop-only
       full-bleed-video artifact) and shrinks its top/bottom padding, so the
       whole hero + trust-bar stack fits in roughly one screen instead of
       leaving a tall gap before the stats row. */
    /* min-height fills the space left under the announce bar + nav and above
       the trust bar, so the "Unser Versprechen" section only appears on
       scroll; the flex column spreads its rows evenly into that space so the
       layout breathes instead of bunching at the top. */
    .hero { min-height: calc(100svh - 182px); padding: 12px 0 10px; }
    /* The announce bar dismisses itself after 60s (adds .is-closed, stays in
       the DOM) — reclaim its 49px so the trust bar keeps hugging the fold
       instead of letting the promise section peek in. */
    body:has(#announceBar.is-closed) .hero { min-height: calc(100svh - 133px); }
    .hero-inner {
      grid-template-columns: 1fr; padding: 0 20px;
      display: flex; flex-direction: column; align-items: stretch;
      justify-content: space-evenly; flex: 1;
      gap: 0; /* desktop grid's 48px gap would otherwise pad every flex row */
    }
    .hero-inner > div:first-child { display: contents; }
    .eyebrow { order: 1; margin-bottom: 12px; align-self: flex-start; }
    h1 { order: 2; font-size: 26px; margin-bottom: 10px; }
    /* Only the first headline sentence shows on mobile (Glass Premium). */
    h1 br { display: none; }
    h1 .hl { display: none; }
    .hero-sub { display: none; order: 3; }
    .hero-sub-mobile { display: block; margin-bottom: 14px; font-size: 13.5px; line-height: 1.55; }
    .hero-visual { order: 4; height: 250px; margin-top: 0; margin-bottom: 14px; }
    .hero-ctas { order: 5; margin-bottom: 10px; gap: 10px; }
    .hero-ctas .cta-btn, .hero-ctas .cta-ghost { padding: 11px 22px; font-size: 14px; }
    .hero-microtrust { display: none; order: 6; }
    .fc-2 { display: none; }
    /* 360° float card pinned to the video's bottom-left corner, scaled down
       so it doesn't cover the footage. */
    .fc-1 {
      top: auto; bottom: 10px; left: 10px; right: auto;
      transform: scale(0.8); transform-origin: bottom left;
    }
    .fc-1:hover { transform: scale(0.8); }
    /* Keep the eyebrow pill on a single line on phones. */
    .eyebrow { font-size: 10px; padding: 5px 11px; white-space: nowrap; }
    .eyebrow span:last-child { overflow: hidden; text-overflow: ellipsis; }
    .announce-inner { padding: 9px 16px; gap: 10px; }
    .announce-items { gap: 16px; }
    .announce-item b { font-size: 10.5px; }
    .announce-divider { display: none; }
    .hero-ctas { flex-wrap: wrap; }
    .trust-inner { grid-template-columns: repeat(3, auto); justify-content: space-between; padding: 10px 16px 12px; gap: 8px; }
    .trust-item { flex-direction: column; align-items: center; text-align: center; gap: 2px; }
    .trust-item .trust-icon { width: 22px; height: 22px; }
    .trust-inner .trust-item:nth-child(4) { display: none; }
    .trust-num { font-size: 13.5px; color: var(--blue-700); }
    .trust-label { font-size: 9px; white-space: nowrap; }
    .ba-section { padding: 56px 20px 64px; }
    .ba-head h2 { font-size: 26px; }
    .ba-carousel { gap: 8px; }
    .ba-arrow { width: 36px; height: 36px; }
    .ba-arrow svg { width: 16px; height: 16px; }
    .ba-compare { grid-template-columns: 1fr 1fr; gap: 10px; padding: 8px; border-radius: 18px; align-items: start; }
    .ba-photo { aspect-ratio: auto; min-width: 0; }
    .ba-photo-frame { position: relative; width: 100%; aspect-ratio: 3 / 4.3; border-radius: 12px; }
    .ba-tag { font-size: 9.5px; padding: 4px 9px; top: 8px; left: 8px; }
    .ba-photo.ba-after .ba-tag { right: 8px; }
    .ba-callout {
      position: static; margin-top: 8px; animation: none;
      padding: 7px 8px; gap: 6px; border-radius: 11px; align-items: flex-start;
    }
    .ba-callout .ba-callout-ico { width: 20px; height: 20px; }
    .ba-callout .ba-callout-ico svg { width: 11px; height: 11px; }
    .ba-callout b { display: none; }
    .ba-callout span:last-child { display: none; }
    .ba-callout span { font-size: 9.5px; line-height: 1.3; overflow-wrap: break-word; }
    .ba-features { grid-template-columns: 1fr; gap: 14px; padding: 20px 18px; }
    .service { padding: 64px 20px 72px; }
    .service-steps { grid-template-columns: 1fr; gap: 16px; position: relative; }
    .service-steps::before { display: none; }
    .service-steps::after {
      content: '';
      position: absolute;
      left: 42px; top: 46px; bottom: 46px; width: 2px;
      background: linear-gradient(180deg, var(--accent-amber), var(--teal-600), var(--accent-purple));
      opacity: 0.5;
      z-index: 0;
    }
    .step-card { display: flex; align-items: flex-start; gap: 16px; position: relative; z-index: 1; }
    .step-num { margin-bottom: 0; flex-shrink: 0; }
    .step-text { flex: 1; min-width: 0; }

    /* ---- Mobile: light "Glass Premium" layout — hero-visual (the same
       rounded video card used on desktop) stacks below the text instead of
       a full-bleed background video, so text stays dark-on-light like desktop. ---- */
    .hero { overflow: hidden; }
  }

  @media (max-width: 580px) {
    .hero-ctas .cta-btn, .hero-ctas .cta-ghost { padding: 10px 18px; font-size: 13px; }
  }

  /* ---- OUR NETWORK (live animated map) ---- */
  .network-section {
    position: relative;
    overflow: hidden;
    background: radial-gradient(ellipse at 24% 18%, #101f3d 0%, #070c18 55%, #03050c 100%);
    padding: 77px 48px 83px;
  }
  .network-inner { position: relative; z-index: 2; max-width: none; margin: 0 auto; }
  .network-head { max-width: 640px; margin: 0 auto 38px; text-align: center; }
  .network-kicker {
    display: inline-block; font-size: 13px; font-weight: 700; letter-spacing: 0.04em;
    text-transform: uppercase; color: #7dd3fc; margin-bottom: 14px;
  }
  .network-head h2 { font-family: 'Urbanist', -apple-system, sans-serif; font-size: 38px; line-height: 1.16; font-weight: 300; color: #ffffff; margin-bottom: 14px; }
  .network-head p { font-size: 15.5px; color: rgba(255,255,255,0.66); line-height: 1.6; }

  .network-map {
    position: relative;
    border-radius: 26px;
    overflow: hidden;
    border: 1px solid rgba(120,170,255,0.16);
    box-shadow: 0 34px 80px -34px rgba(0,0,0,0.7), inset 0 1px 0 rgba(255,255,255,0.06);
    width: 100%;
    margin: 0 auto;
    aspect-ratio: 1000 / 700;
    background:
      radial-gradient(circle at 18% 78%, rgba(56,132,255,0.14), transparent 45%),
      radial-gradient(circle at 82% 20%, rgba(56,189,248,0.12), transparent 50%),
      linear-gradient(160deg, #070d1e 0%, #04070f 60%, #020408 100%);
  }
  .network-map::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(96,165,250,0.4) 1px, transparent 1.4px);
    background-size: 26px 26px;
    opacity: 0.28;
    animation: netGridPulse 6s ease-in-out infinite;
    pointer-events: none;
  }
  @keyframes netGridPulse {
    0%, 100% { opacity: 0.18; }
    50% { opacity: 0.34; }
  }

  /* ---- Globe (real WebGL 3D Earth, see assets/earth-globe.js) ---- */
  .earth-globe { position: absolute; inset: 0; }
  .earth-canvas { position: absolute; inset: 0; width: 100%; height: 100%; display: block; touch-action: none; }
  .earth-markers { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }

  .net-node { position: absolute; left: 0; top: 0; pointer-events: auto; transition: opacity 0.2s ease; }
  .net-pin {
    position: relative; width: 14px; height: 14px; border-radius: 50%;
    background: none; border: none; padding: 0; cursor: pointer; display: block;
  }
  .net-pin::before { content: ''; position: absolute; inset: -15px; border-radius: 50%; }

  .net-label {
    position: absolute; left: 50%;
    display: flex; flex-direction: column; align-items: center; text-align: center;
    white-space: nowrap; opacity: 0; pointer-events: none;
    transition: opacity 0.7s ease, transform 0.7s ease;
    transition-delay: var(--d, 0s);
  }
  /* The JS anchors the node exactly on the pole tip; this small fixed gap
     just clears the tip sphere so the flag's bottom edge reads as resting
     directly on top of the pole, perfectly centered, no lean. */
  .net-label.lbl-above { bottom: 3px; transform: translate(-50%, 10px); }
  .net-label.lbl-below { top: 32px; transform: translate(-50%, -10px); }
  .net-label.lbl-above-left { bottom: 30px; right: -14px; left: auto; align-items: flex-end; text-align: right; transform: translateY(10px); }
  .net-label.lbl-below-left { top: 28px; right: -14px; left: auto; align-items: flex-end; text-align: right; transform: translateY(-10px); }
  .net-label.lbl-right { left: auto; right: -30px; top: 50%; align-items: flex-start; text-align: left; transform: translate(10px, -50%); }
  .network-map.in-view .net-label.lbl-above,
  .network-map.in-view .net-label.lbl-below { opacity: 1; transform: translate(-50%, 0); }
  .network-map.in-view .net-label.lbl-above-left,
  .network-map.in-view .net-label.lbl-below-left { opacity: 1; transform: translateY(0); }
  .network-map.in-view .net-label.lbl-right { opacity: 1; transform: translate(0, -50%); }

  .net-label .city {
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
    background: rgba(10,16,32,0.6); width: 40px; height: 40px; border-radius: 50%;
    border: 2px solid rgba(200,212,228,0.75);
    box-shadow:
      0 4px 18px rgba(0,0,0,0.55),
      0 0 0 5px rgba(148,163,184,0.16),
      inset 0 1px 0 rgba(255,255,255,0.25);
    backdrop-filter: blur(8px) saturate(1.3);
    -webkit-backdrop-filter: blur(8px) saturate(1.3);
  }
  .net-label .city svg { width: 100%; height: 100%; display: block; opacity: 0.94; }
  .net-label .role {
    font-size: 10px; font-weight: 600; color: #fdba74; text-transform: uppercase;
    letter-spacing: 0.03em; margin-top: 0; text-shadow: 0 2px 8px rgba(0,0,0,0.85);
    max-height: 0; opacity: 0; overflow: hidden;
    transition: max-height 0.3s ease, opacity 0.3s ease, margin-top 0.3s ease;
  }
  .net-label .desc {
    max-width: 168px; white-space: normal; font-size: 11px; line-height: 1.4;
    color: rgba(255,255,255,0.75);
    max-height: 0; opacity: 0; margin-top: 0; overflow: hidden;
    transition: max-height 0.3s ease, opacity 0.3s ease, margin-top 0.3s ease;
  }
  .net-node:hover .net-label .role,
  .net-node:focus-within .net-label .role,
  .net-node.tap-active .net-label .role {
    max-height: 20px; opacity: 1; margin-top: 2px;
  }
  .net-node:hover .net-label .desc,
  .net-node:focus-within .net-label .desc,
  .net-node.tap-active .net-label .desc {
    max-height: 70px; opacity: 1; margin-top: 6px;
  }
  .net-node:hover .net-label, .net-node.tap-active .net-label { pointer-events: auto; }

  .network-legend { display: flex; justify-content: center; margin-top: 21px; }
  .network-legend .lg-item {
    display: flex; align-items: center; gap: 8px; font-size: 12px;
    color: rgba(255,255,255,0.92); text-transform: uppercase;
    letter-spacing: 0.08em; font-weight: 600;
  }
  .network-legend .lg-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: linear-gradient(135deg, var(--teal-400), var(--blue-600));
    box-shadow: 0 0 8px rgba(56,189,248,0.6);
    animation: netPulseDot 2.2s ease-in-out infinite;
  }
  @keyframes netPulseDot { 0%, 100% { opacity: 0.6; } 50% { opacity: 1; } }

  @media (max-width: 860px) {
    .network-section { padding: 64px 20px 72px; }
    .network-head h2 { font-size: 27px; }
    .network-map { aspect-ratio: 1000 / 900; }
    .net-label .city { width: 28px; height: 28px; font-size: 16px; }
    .net-label .role { font-size: 9px; }
    .net-label .desc { max-width: 128px; font-size: 10px; }
    .net-node[data-id="tr"] .net-label.lbl-above-left {
      bottom: auto; top: 26px; right: auto; left: -10px;
      align-items: flex-start; text-align: left;
      transform: translateY(-10px);
    }
    .network-map.in-view .net-node[data-id="tr"] .net-label.lbl-above-left {
      transform: translateY(0);
    }
  }

  /* ---- FAQ ---- */
  .faq-section {
    position: relative;
    overflow: hidden;
    padding: 80px 48px 88px;
    background: #ffffff;
  }
  .faq-bg {
    position: absolute; inset: 0;
    background-image:
      radial-gradient(circle at 10% 15%, rgba(125,211,252,0.32) 0%, transparent 45%),
      radial-gradient(circle at 92% 10%, rgba(94,185,224,0.26) 0%, transparent 50%),
      radial-gradient(circle at 85%, rgba(61,111,214,0.16) 0%, transparent 50%),
      radial-gradient(circle at 15% 92%, rgba(45,212,191,0.16) 0%, transparent 45%);
    z-index: 0;
  }
  .faq-inner { position: relative; z-index: 1; max-width: 1180px; margin: 0 auto; }
  .faq-head { display: flex; align-items: flex-start; gap: 18px; margin-bottom: 36px; max-width: 760px; }
  .faq-head-icon { width: 56px; height: 56px; flex-shrink: 0; filter: drop-shadow(0 6px 14px rgba(37,99,235,0.25)); }
  .faq-kicker { font-size: 12px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--teal-700); margin-bottom: 6px; }
  .faq-head h2 { font-family: 'Urbanist', -apple-system, sans-serif; font-size: 30px; font-weight: 300; color: var(--ink); margin-bottom: 8px; letter-spacing: -0.01em; }
  .faq-head p { font-size: 15px; color: var(--ink-soft); line-height: 1.6; }
  .hp-faq-list { display: grid; gap: 10px; max-width: 820px; }
  .hp-faq-item {
    border-radius: 14px; overflow: hidden;
    background: rgba(255,255,255,0.4);
    backdrop-filter: blur(22px) saturate(2);
    -webkit-backdrop-filter: blur(22px) saturate(2);
    border: 1px solid rgba(255,255,255,0.8);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.75), 0 10px 24px -16px rgba(37,99,235,0.22);
  }
  .hp-faq-q {
    display: flex; align-items: center; justify-content: space-between; gap: 14px;
    padding: 16px 20px; cursor: pointer; font-size: 14.5px; font-weight: 700; color: var(--ink);
    user-select: none;
  }
  .hp-faq-q .plus {
    flex-shrink: 0; width: 26px; height: 26px; border-radius: 50%;
    background: rgba(219,234,254,0.7); display: flex; align-items: center; justify-content: center;
    font-size: 15px; color: var(--teal-700); transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease;
  }
  .hp-faq-item.open .hp-faq-q .plus { transform: rotate(45deg); background: linear-gradient(120deg, var(--teal-500), var(--blue-600)); color: #fff; }
  .hp-faq-a { max-height: 0; overflow: hidden; transition: max-height 0.35s ease; }
  .hp-faq-item.open .hp-faq-a { max-height: 420px; }
  .hp-faq-a p { padding: 0 20px 18px; font-size: 13.5px; color: var(--ink-soft); line-height: 1.65; }
  @media (max-width: 900px) {
    .faq-section { padding: 56px 20px 64px; }
    .faq-head { flex-direction: column; gap: 12px; }
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

  /* ---- Option cards (replaces old pill chips) ---- */
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
  .opt-card .ico { font-size: 18px; flex-shrink: 0; line-height: 1; }
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
  .photo-slot .ph-ico { font-size: 21px; display: block; margin-bottom: 5px; }
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
<body data-content-page="home">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.php?id=GTM-W6ZC5JRP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="announce-bar" id="announceBar">
  <div class="announce-glint"></div>
  <div class="announce-inner">
    <div class="announce-viewport">
      <div class="announce-track" id="announceTrack">
        <div class="announce-items">
          <div class="announce-item">
            <span class="ico"><svg class="gi gi-usp" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gAChat" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gAChat)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="14" y="16" width="36" height="24" rx="8" fill="#fff" opacity="0.92"/><path d="M22 40l0 8 10-8z" fill="#fff" opacity="0.92"/><circle cx="24" cy="28" r="2.4" fill="url(#gAChat)"/><circle cx="32" cy="28" r="2.4" fill="url(#gAChat)"/><circle cx="40" cy="28" r="2.4" fill="url(#gAChat)"/></svg></span>
            <b data-de="Beratung – Vor Ort, Österreich" data-en="Consultation - In person, Austria">Beratung – Vor Ort, Österreich</b>
          </div>
          <div class="announce-divider"></div>
          <div class="announce-item">
            <span class="ico"><svg class="gi gi-usp" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gACase" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gACase)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="24" y="12" width="16" height="10" rx="3" fill="none" stroke="#fff" stroke-width="3" opacity="0.9"/><rect x="14" y="22" width="36" height="28" rx="6" fill="#fff" opacity="0.92"/><rect x="14" y="33" width="36" height="4" fill="url(#gACase)" opacity="0.45"/></svg></span>
            <b data-de="Reise in die Türkei – Wir organisieren alles" data-en="Trip to Turkey - We handle it all">Reise in die Türkei – Wir organisieren alles</b>
          </div>
          <div class="announce-divider"></div>
          <div class="announce-item">
            <span class="ico"><svg class="gi gi-usp" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gACross" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#3b82f6"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gACross)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M27 14h10v11h11v10H37v11H27V35H16V25h11z" fill="#fff" opacity="0.92"/></svg></span>
            <b data-de="Behandlung – Hauptklinik Türkei" data-en="Treatment - Main Clinic Turkey">Behandlung – Hauptklinik Türkei</b>
          </div>
          <div class="announce-divider"></div>
          <div class="announce-item">
            <span class="ico"><svg class="gi gi-usp" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gAGlobe" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gAGlobe)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="28" cy="30" r="14" fill="none" stroke="#fff" stroke-width="2.4" opacity="0.85"/><ellipse cx="28" cy="30" rx="14" ry="5.5" fill="none" stroke="#fff" stroke-width="1.8" opacity="0.6"/><line x1="14" y1="30" x2="42" y2="30" stroke="#fff" stroke-width="1.8" opacity="0.6"/><path d="M43 36c4 0 7 3 7 7 0 5-7 11-7 11s-7-6-7-11c0-4 3-7 7-7z" fill="#fff" opacity="0.95"/><circle cx="43" cy="43" r="2.4" fill="url(#gAGlobe)"/></svg></span>
            <b data-de="Größtes Nachsorge-Netzwerk – AT·DE·CH" data-en="Largest Aftercare Network - AT·DE·CH">Größtes Nachsorge-Netzwerk – AT·DE·CH</b>
          </div>
          <div class="announce-divider"></div>
        </div>
        <div class="announce-items" aria-hidden="true">
          <div class="announce-item">
            <span class="ico"><svg class="gi gi-usp" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gAChat2" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gAChat2)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="14" y="16" width="36" height="24" rx="8" fill="#fff" opacity="0.92"/><path d="M22 40l0 8 10-8z" fill="#fff" opacity="0.92"/><circle cx="24" cy="28" r="2.4" fill="url(#gAChat2)"/><circle cx="32" cy="28" r="2.4" fill="url(#gAChat2)"/><circle cx="40" cy="28" r="2.4" fill="url(#gAChat2)"/></svg></span>
            <b data-de="Beratung – Vor Ort, Österreich" data-en="Consultation - In person, Austria">Beratung – Vor Ort, Österreich</b>
          </div>
          <div class="announce-divider"></div>
          <div class="announce-item">
            <span class="ico"><svg class="gi gi-usp" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gACase2" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gACase2)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="24" y="12" width="16" height="10" rx="3" fill="none" stroke="#fff" stroke-width="3" opacity="0.9"/><rect x="14" y="22" width="36" height="28" rx="6" fill="#fff" opacity="0.92"/><rect x="14" y="33" width="36" height="4" fill="url(#gACase2)" opacity="0.45"/></svg></span>
            <b data-de="Reise in die Türkei – Wir organisieren alles" data-en="Trip to Turkey - We handle it all">Reise in die Türkei – Wir organisieren alles</b>
          </div>
          <div class="announce-divider"></div>
          <div class="announce-item">
            <span class="ico"><svg class="gi gi-usp" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gACross2" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#3b82f6"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gACross2)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M27 14h10v11h11v10H37v11H27V35H16V25h11z" fill="#fff" opacity="0.92"/></svg></span>
            <b data-de="Behandlung – Hauptklinik Türkei" data-en="Treatment - Main Clinic Turkey">Behandlung – Hauptklinik Türkei</b>
          </div>
          <div class="announce-divider"></div>
          <div class="announce-item">
            <span class="ico"><svg class="gi gi-usp" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gAGlobe2" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gAGlobe2)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="28" cy="30" r="14" fill="none" stroke="#fff" stroke-width="2.4" opacity="0.85"/><ellipse cx="28" cy="30" rx="14" ry="5.5" fill="none" stroke="#fff" stroke-width="1.8" opacity="0.6"/><line x1="14" y1="30" x2="42" y2="30" stroke="#fff" stroke-width="1.8" opacity="0.6"/><path d="M43 36c4 0 7 3 7 7 0 5-7 11-7 11s-7-6-7-11c0-4 3-7 7-7z" fill="#fff" opacity="0.95"/><circle cx="43" cy="43" r="2.4" fill="url(#gAGlobe2)"/></svg></span>
            <b data-de="Größtes Nachsorge-Netzwerk – AT·DE·CH" data-en="Largest Aftercare Network - AT·DE·CH">Größtes Nachsorge-Netzwerk – AT·DE·CH</b>
          </div>
          <div class="announce-divider"></div>
        </div>
      </div>
    </div>
    <button type="button" class="announce-close" onclick="closeAnnounceBar()" aria-label="Close">✕</button>
  </div>
</div>

<?php
$siteHeaderMode = 'full';
$siteHomeHref = 'index.php';
include __DIR__ . '/includes/site-header.php';
?>

<section class="hero">
  <div class="hero-bg-layer"></div>
  <video class="hero-mobile-video" id="mobileVideo" data-cmedia="hero.mobileVideo" autoplay muted loop playsinline webkit-playsinline data-src="assets/apex-video-verticle.mp4"></video>
  <div class="hero-mobile-scrim"></div>
  <button type="button" class="sound-toggle sound-toggle-mobile" id="soundToggleMobile" aria-label="Mute video" aria-pressed="true">
    <svg class="icon-on" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 9v6h4l5 4V5L8 9H4z" fill="currentColor" stroke="none"/><path d="M15.5 8.5a5 5 0 0 1 0 7"/><path d="M18.5 6a9 9 0 0 1 0 12"/></svg>
    <svg class="icon-muted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 9v6h4l5 4V5L8 9H4z" fill="currentColor" stroke="none"/><path d="M16 9l5 6M21 9l-5 6"/></svg>
  </button>
  <div class="hero-inner">
    <div>
      <a href="#network" class="eyebrow"><span class="dot"></span><span data-ckey="hero.eyebrow" data-de="Basiert in Österreich · Größtes Nachsorge-Netzwerk" data-en="Based in Austria · Largest Aftercare Network">Basiert in Österreich · Größtes Nachsorge-Netzwerk</span></a>
      <h1>
        <span data-ckey="hero.headline1" data-de="Ihre komplette Haartransplantation." data-en="Your complete hair transplant journey.">Ihre komplette Haartransplantation.</span><br>
        <span class="hl" data-ckey="hero.headline2" data-de="Professionell begleitet von der Beratung bis zur Nachsorge." data-en="Professionally managed from consultation to aftercare.">Professionell begleitet von der Beratung bis zur Nachsorge.</span>
      </h1>
      <p class="hero-sub" data-ckey="hero.sub" data-de="Persönliche Beratung in Österreich, Behandlung in unserer führenden Klinik in der Türkei und professionelle Nachsorge in Österreich, Deutschland und der Schweiz. Mit einer ärztlichen Betreuung rund um die Uhr und einem der größten Nachsorgenetzwerke Europas begleiten wir Sie Schritt für Schritt auf Ihrem Weg." data-en="Consultation in Austria, treatment at our leading clinic in Turkey and professional aftercare across Austria, Germany and Switzerland. With 24/7 medical supervision and one of Europe's largest aftercare networks, you're supported every step of the way.">Persönliche Beratung in Österreich, Behandlung in unserer führenden Klinik in der Türkei und professionelle Nachsorge in Österreich, Deutschland und der Schweiz. Mit einer ärztlichen Betreuung rund um die Uhr und einem der größten Nachsorgenetzwerke Europas begleiten wir Sie Schritt für Schritt auf Ihrem Weg.</p>
      <p class="hero-sub hero-sub-mobile" data-de="Persönliche Beratung in Österreich, Behandlung in unserer führenden Klinik in der Türkei und professionelle Nachsorge in Österreich, Deutschland und der Schweiz." data-en="Consultation in Austria, treatment at our leading clinic in Turkey and professional aftercare across Austria, Germany and Switzerland.">Persönliche Beratung in Österreich, Behandlung in unserer führenden Klinik in der Türkei und professionelle Nachsorge in Österreich, Deutschland und der Schweiz.</p>
      <div class="hero-ctas">
        <a href="#" class="cta-btn" onclick="openConsult(event)" data-ckey="hero.ctaPrimary" data-de="Kostenlose Beratung sichern" data-en="Get your free consultation">Kostenlose Beratung sichern</a>
        <a href="#before-after" class="cta-ghost" data-ckey="hero.ctaSecondary" data-de="Vorher-Nachher ansehen" data-en="See before &amp; after">Vorher-Nachher ansehen</a>
      </div>
      <div class="hero-microtrust" id="heroMicrotrust" data-clist="hero.trustPills">
        <div class="trust-pill tp-amber" data-citem>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a4 4 0 0 0-4 4v2a4 4 0 0 0 8 0V6a4 4 0 0 0-4-4Z"/><path d="M8 14v1a4 4 0 0 0 8 0v-1"/><path d="M12 19v3"/><circle cx="19" cy="8" r="2"/></svg>
          <span data-ctext data-de="Fachärztlich Betreut" data-en="Plastic Surgeon Supervised">Fachärztlich Betreut</span>
        </div>
        <div class="trust-pill tp-pink">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22a9 9 0 0 1 0-18c4.97 0 9 3.5 9 7.5 0 2-1.5 3.5-3.5 3.5H15a1.5 1.5 0 0 0-1 2.6c.3.3.5.7.5 1.1 0 1-.9 1.8-2 1.8Z"/><circle cx="7.5" cy="10.5" r="1"/><circle cx="10.5" cy="7" r="1"/><circle cx="15" cy="7.5" r="1"/></svg>
          <span data-de="Individuelles Haarlinien-Design" data-en="Personalized Hairline Design">Individuelles Haarlinien-Design</span>
        </div>
        <div class="trust-pill tp-teal">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 2 4 4"/><path d="m17 7 3-3"/><path d="M19 9 8.7 19.3c-1 1-2.5 1-3.4 0l-.6-.6c-1-1-1-2.5 0-3.4L15 5"/><path d="m9 11 4 4"/><path d="m5 19-3 3"/><path d="m14 4 6 6"/></svg>
          <span data-de="Stressfreie Sedierung" data-en="Stress-Free Sedation">Stressfreie Sedierung</span>
        </div>
      </div>
    </div>
    <div class="hero-visual">
      <div class="visual-frame">
        <video id="desktopVideo" data-cmedia="hero.desktopVideo" autoplay muted loop playsinline webkit-playsinline data-src="assets/apex-video-verticle.mp4"></video>
        <button type="button" class="sound-toggle" id="soundToggle" aria-label="Mute video" aria-pressed="true">
          <svg class="icon-on" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 9v6h4l5 4V5L8 9H4z" fill="currentColor" stroke="none"/><path d="M15.5 8.5a5 5 0 0 1 0 7"/><path d="M18.5 6a9 9 0 0 1 0 12"/></svg>
          <svg class="icon-muted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 9v6h4l5 4V5L8 9H4z" fill="currentColor" stroke="none"/><path d="M16 9l5 6M21 9l-5 6"/></svg>
        </button>
      </div>
      <a href="#network" class="float-card fc-1">
        <div class="fc-glass-tint"></div>
        <div class="icon"><svg class="gi gi-fc" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gBadge" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><path d="M22 40l-6 16 12-4 4 8 6-15z" fill="#cfe8f7" opacity="0.9" stroke="#9fcfe8" stroke-width="0.5"/><path d="M42 40l6 16-12-4-4 8-6-15z" fill="#cfe8f7" opacity="0.9" stroke="#9fcfe8" stroke-width="0.5"/><circle cx="32" cy="28" r="26" fill="url(#gBadge)"/><ellipse cx="23" cy="17" rx="15" ry="8" fill="#fff" opacity="0.25"/><text x="32" y="33" font-family="Arial, sans-serif" font-size="14" font-weight="800" fill="#fff" text-anchor="middle">360°</text></svg></div>
        <div><span data-de="360°-Betreuung" data-en="360° Care">360°-Betreuung</span><br><span style="font-weight:400;color:#64748b;font-size:11px" data-de="Beratung bis Nachsorge" data-en="Consultation to Aftercare">Beratung bis Nachsorge</span></div>
      </a>
      <a class="float-card fc-2" href="https://www.google.com/maps/place/Apex+Beauty+%C3%84sthetische+Chirurgie,+Medizin+Tourismus/@48.3014502,14.2879031,17z/data=!3m1!4b1!4m6!3m5!1s0x47739758cfdf6873:0x1802fb70cbb5f96d!8m2!3d48.3014502!4d14.290478!16s%2Fg%2F11h84lrbht?hl=de&entry=ttu&g_ep=EgoyMDI2MDYyOC4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer">
        <div class="fc-glass-tint"></div>
        <div class="icon"><svg width="48" height="48" viewBox="0 0 48 48"><path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/></svg></div>
        <div>
          <span class="star-row" style="margin-bottom:3px">
            <svg width="12" height="12" viewBox="0 0 20 20" fill="#fbbf24"><path d="M10 1l2.6 5.6 6.1.6-4.6 4.1 1.3 6-5.4-3.1L4.6 17.3l1.3-6L1.3 7.2l6.1-.6z"/></svg>
            <svg width="12" height="12" viewBox="0 0 20 20" fill="#fbbf24"><path d="M10 1l2.6 5.6 6.1.6-4.6 4.1 1.3 6-5.4-3.1L4.6 17.3l1.3-6L1.3 7.2l6.1-.6z"/></svg>
            <svg width="12" height="12" viewBox="0 0 20 20" fill="#fbbf24"><path d="M10 1l2.6 5.6 6.1.6-4.6 4.1 1.3 6-5.4-3.1L4.6 17.3l1.3-6L1.3 7.2l6.1-.6z"/></svg>
            <svg width="12" height="12" viewBox="0 0 20 20" fill="#fbbf24"><path d="M10 1l2.6 5.6 6.1.6-4.6 4.1 1.3 6-5.4-3.1L4.6 17.3l1.3-6L1.3 7.2l6.1-.6z"/></svg>
            <svg width="12" height="12" viewBox="0 0 20 20" fill="#fbbf24"><path d="M10 1l2.6 5.6 6.1.6-4.6 4.1 1.3 6-5.4-3.1L4.6 17.3l1.3-6L1.3 7.2l6.1-.6z"/></svg>
          </span>
          <span>4.9 </span><span style="font-weight:400;color:#64748b;font-size:11px" data-de="Google-Bewertungen" data-en="Google Reviews">Google-Bewertungen</span>
        </div>
      </a>
    </div>
  </div>
</section>

<section class="trust-bar">
  <div class="trust-inner">
    <div class="trust-item">
      <div class="trust-icon"><svg class="gi gi-ti" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gPerson" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gPerson)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="32" cy="25" r="8" fill="#fff" opacity="0.92"/><path d="M16 49c0-9 7-14 16-14s16 5 16 14v2a2 2 0 0 1-2 2H18a2 2 0 0 1-2-2z" fill="#fff" opacity="0.92"/></svg></div>
      <div><div class="trust-num"><span class="cnt" data-target="12000">0</span>+</div><div class="trust-label" data-ckey="trustBar.stat1Label" data-de="Patienten Behandelt" data-en="Patients Treated">Patienten Behandelt</div></div>
    </div>
    <div class="trust-item">
      <div class="trust-icon"><svg class="gi gi-ti" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gStarTi" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#0284c7"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gStarTi)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M32 15l5.4 11 12.1 1.7-8.8 8.5 2.1 12-10.8-5.7-10.8 5.7 2.1-12-8.8-8.5L26.6 26z" fill="#fff" opacity="0.92"/></svg></div>
      <div><div class="trust-num"><span class="cnt" data-target="4.9" data-decimals="1">0</span> / 5</div><div class="trust-label" data-ckey="trustBar.stat2Label" data-de="Google-Bewertungen" data-en="Google Reviews">Google-Bewertungen</div></div>
    </div>
    <div class="trust-item">
      <div class="trust-icon"><svg class="gi gi-ti" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gCal" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="10" y="10" width="50" height="50" rx="16" fill="#fff" opacity="0.3"/><rect x="4" y="4" width="50" height="50" rx="16" fill="url(#gCal)"/><rect x="16" y="1" width="6" height="12" rx="3" fill="#fff" opacity="0.85"/><rect x="38" y="1" width="6" height="12" rx="3" fill="#fff" opacity="0.85"/><rect x="10" y="22" width="38" height="3" rx="1.5" fill="#fff" opacity="0.7"/><circle cx="16" cy="34" r="2.6" fill="#fff" opacity="0.85"/><circle cx="26" cy="34" r="2.6" fill="#fff" opacity="0.85"/><circle cx="36" cy="34" r="2.6" fill="#fff" opacity="0.85"/><circle cx="16" cy="44" r="2.6" fill="#fff" opacity="0.85"/><circle cx="26" cy="44" r="2.6" fill="#fff" opacity="0.85"/></svg></div>
      <div><div class="trust-num"><span class="cnt" data-target="15">0</span> <span data-ckey="trustBar.stat3Unit" data-de="Jahre" data-en="Years">Jahre</span></div><div class="trust-label" data-ckey="trustBar.stat3Label" data-de="Klinische Erfahrung" data-en="Clinical Experience">Klinische Erfahrung</div></div>
    </div>
    <div class="trust-item">
      <div class="trust-icon"><svg class="gi gi-ti" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gNet" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gNet)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><g stroke="#fff" stroke-width="2.4" opacity="0.75"><line x1="32" y1="32" x2="32" y2="16"/><line x1="32" y1="32" x2="47" y2="41"/><line x1="32" y1="32" x2="17" y2="41"/></g><circle cx="32" cy="32" r="7" fill="#fff" opacity="0.95"/><circle cx="32" cy="16" r="5" fill="#fff" opacity="0.85"/><circle cx="47" cy="41" r="5" fill="#fff" opacity="0.85"/><circle cx="17" cy="41" r="5" fill="#fff" opacity="0.85"/></svg></div>
      <div><div class="trust-num" data-ckey="trustBar.stat4Main" data-de="Größtes Netzwerk" data-en="Largest Network">Größtes Netzwerk</div><div class="trust-label" data-ckey="trustBar.stat4Label" data-de="Für Nachsorge in AT · DE · CH" data-en="For Aftercare in AT · DE · CH">Für Nachsorge in AT · DE · CH</div></div>
    </div>
  </div>
</section>

<section class="service" id="promiseSection">
  <video class="service-video" id="serviceVideo" data-cmedia="promise.video" autoplay muted loop playsinline webkit-playsinline data-src="assets/apex-drone.mp4"></video>
  <div class="service-scrim"></div>
  <div class="service-inner">
    <div class="service-head">
      <span class="service-kicker" data-de="Unser Versprechen" data-en="Our promise">Unser Versprechen</span>
      <h2 data-ckey="promise.heading" data-de="Kein Bruch zwischen Beratung, Behandlung und Nachsorge" data-en="No gap between consultation, treatment and aftercare">Kein Bruch zwischen Beratung, Behandlung und Nachsorge</h2>
      <p data-ckey="promise.sub" data-de="Die meisten Patienten fürchten sich nicht vor der Operation, sondern davor, was passiert, wenn sie wieder zuhause sind. Deshalb begleiten wir Sie durchgehend, nicht nur am Tag des Eingriffs." data-en="Most patients aren't afraid of the procedure itself. They're afraid of what happens once they're back home. That's why we stay with you the whole way, not just on treatment day.">Die meisten Patienten fürchten sich nicht vor der Operation, sondern davor, was passiert, wenn sie wieder zuhause sind. Deshalb begleiten wir Sie durchgehend, nicht nur am Tag des Eingriffs.</p>
    </div>
    <div class="service-steps">
      <div class="step-card s1">
        <div class="step-num">1</div>
        <div class="step-text">
          <div class="step-flag" data-de="Österreich" data-en="Austria">Österreich</div>
          <h3 data-de="Persönliche Beratung" data-en="Personal consultation">Persönliche Beratung</h3>
          <p data-de="Ihr erstes Gespräch findet vor Ort statt, nicht per anonymem Chat. Wir klären Erwartungen, Methode und Ablauf, bevor Sie reisen." data-en="Your first conversation happens in person, not through an anonymous chat. We clarify expectations, method and process before you travel.">Ihr erstes Gespräch findet vor Ort statt, nicht per anonymem Chat. Wir klären Erwartungen, Methode und Ablauf, bevor Sie reisen.</p>
        </div>
      </div>
      <div class="step-card s2">
        <div class="step-num">2</div>
        <div class="step-text">
          <div class="step-flag" data-de="Hauptklinik Istanbul" data-en="Main clinic, Istanbul">Hauptklinik Istanbul</div>
          <h3 data-de="Behandlung mit 24/7-Betreuung" data-en="Treatment with 24/7 care">Behandlung mit 24/7-Betreuung</h3>
          <p data-de="Die Transplantation findet in unserer Hauptklinik statt, mit durchgehender ärztlicher Betreuung, nicht nur während des Eingriffs selbst." data-en="The transplant takes place at our main clinic, with continuous medical supervision, not just during the procedure itself.">Die Transplantation findet in unserer Hauptklinik statt, mit durchgehender ärztlicher Betreuung, nicht nur während des Eingriffs selbst.</p>
        </div>
      </div>
      <div class="step-card s3">
        <div class="step-num">3</div>
        <div class="step-text">
          <div class="step-flag" data-de="AT · DE · CH Netzwerk" data-en="AT · DE · CH network">AT · DE · CH Netzwerk</div>
          <h3 data-de="Nachsorge in Ihrer Nähe" data-en="Aftercare near you">Nachsorge in Ihrer Nähe</h3>
          <p data-de="Zurück zuhause endet die Betreuung nicht: unser Kliniknetzwerk in Österreich, Deutschland und der Schweiz übernimmt die Nachsorge, von Medikamenten bis PRP-Behandlungen." data-en="Care doesn't end once you're home: our clinic network in Austria, Germany and Switzerland handles aftercare, from medication to PRP treatments.">Zurück zuhause endet die Betreuung nicht: unser Kliniknetzwerk in Österreich, Deutschland und der Schweiz übernimmt die Nachsorge, von Medikamenten bis PRP-Behandlungen.</p>
        </div>
      </div>
    </div>
    <div class="service-foot">
      <span data-de="Ein Anbieter, drei Länder, ein durchgehendes Betreuungsmodell." data-en="One provider, three countries, one continuous model of care.">Ein Anbieter, drei Länder, ein durchgehendes Betreuungsmodell.</span>
    </div>
  </div>
</section>

<section class="ba-section" id="before-after">
  <div class="ba-bg-layer"></div>
  <div class="ba-inner">
    <div class="ba-head">
      <span class="ba-kicker" data-de="Vorher &amp; Nachher" data-en="Before &amp; after">Vorher &amp; Nachher</span>
      <h2><span data-ckey="beforeAfter.heading1" data-de="Jeder Haaransatz." data-en="Every hairline.">Jeder Haaransatz.</span> <span class="hl" data-ckey="beforeAfter.heading2" data-de="Mit Präzision gestaltet." data-en="Designed with precision.">Mit Präzision gestaltet.</span></h2>
      <p data-ckey="beforeAfter.sub" data-de="Jeder Fall beginnt mit einer Kopfhaut-Analyse und endet mit einem Ergebnis, das individuell geplant wurde." data-en="Every case starts with a scalp analysis and ends with a result that was planned individually.">Jeder Fall beginnt mit einer Kopfhaut-Analyse und endet mit einem Ergebnis, das individuell geplant wurde.</p>
    </div>

    <div class="ba-carousel">
      <button type="button" class="ba-arrow ba-arrow-prev" id="baPrev" aria-label="Previous case">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 5l-7 7 7 7"/></svg>
      </button>

      <!-- Cases come from the admin panel's "Before & after" list (content
           API: home.beforeAfter.cases). This single .ba-slide is the clone
           template - content-loader.js (data-clist/data-citem) clones it
           once per case and fills data-cfield/data-cmediafield descendants;
           the JS carousel further down detects the resulting slide count and
           reveals the arrows/dots once there's more than one. -->
      <div class="ba-track" id="baTrack" data-clist="beforeAfter.cases">
        <div class="ba-slide active" data-citem data-slide="0">
          <div class="ba-compare">
            <div class="ba-photo ba-before">
              <span class="ba-tag" data-de="VORHER" data-en="BEFORE">VORHER</span>
              <div class="ba-photo-frame">
                <img src="assets/before.png" alt="Vorher" loading="lazy" data-cmediafield="vorherImage">
              </div>
              <div class="ba-callout">
                <div class="ba-callout-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3v3M9 14a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0 0v7m-3 0h6"/></svg></div>
                <div>
                  <b data-de="Kopfhaut-Analyse" data-en="Scalp analysis">Kopfhaut-Analyse</b>
                  <span data-cfield="vorherLine1" data-de="Bereich: Stirn &amp; Krone" data-en="Area: Hairline &amp; crown">Bereich: Stirn &amp; Krone</span>
                  <span data-cfield="vorherLine2" data-de="Dichte: Gering" data-en="Density: Low">Dichte: Gering</span>
                </div>
              </div>
            </div>
            <div class="ba-photo ba-after">
              <span class="ba-tag" data-de="NACHHER" data-en="AFTER">NACHHER</span>
              <div class="ba-photo-frame">
                <img src="assets/after.png" alt="Nachher" loading="lazy" data-cmediafield="nachherImage">
              </div>
              <div class="ba-callout">
                <div class="ba-callout-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12l5 5L20 6"/></svg></div>
                <div>
                  <b data-de="Präzises Ergebnis" data-en="Precise result">Präzises Ergebnis</b>
                  <span data-cfield="nachherLine1" data-de="Transplantate präzise platziert" data-en="Grafts precisely placed">Transplantate präzise platziert</span>
                  <span data-cfield="nachherLine2" data-de="Natürlicher Haaransatz · Verbesserte Dichte" data-en="Natural hairline · Improved density">Natürlicher Haaransatz · Verbesserte Dichte</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <button type="button" class="ba-arrow ba-arrow-next" id="baNext" aria-label="Next case">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7"/></svg>
      </button>
    </div>

    <div class="ba-dots" id="baDots">
      <button type="button" class="ba-dot active" data-goto="0" aria-label="Case 1"></button>
    </div>

    <div class="ba-features">
      <div class="ba-feature">
        <div class="ba-feature-ico"><svg class="gi gi-ti" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gBaTarget" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gBaTarget)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><circle cx="32" cy="32" r="14" fill="none" stroke="#fff" stroke-width="2.6"/><circle cx="32" cy="32" r="8" fill="none" stroke="#fff" stroke-width="2.4"/><circle cx="32" cy="32" r="2.8" fill="#fff"/></svg></div>
        <div>
          <b data-de="Mit Erfahrung gestaltet" data-en="Shaped by experience">Mit Erfahrung gestaltet</b>
          <span data-de="Für maximale Präzision" data-en="For maximum precision">Für maximale Präzision</span>
        </div>
      </div>
      <div class="ba-feature">
        <div class="ba-feature-ico"><svg class="gi gi-ti" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gBaDensity" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#0284c7"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gBaDensity)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="20" y="34" width="5" height="14" rx="2.5" fill="#fff"/><rect x="29.5" y="24" width="5" height="24" rx="2.5" fill="#fff"/><rect x="39" y="29" width="5" height="19" rx="2.5" fill="#fff"/></svg></div>
        <div>
          <b data-de="Natürliche Dichte" data-en="Natural density">Natürliche Dichte</b>
          <span data-de="Für ein echtes Ergebnis" data-en="For a genuine result">Für ein echtes Ergebnis</span>
        </div>
      </div>
      <div class="ba-feature">
        <div class="ba-feature-ico"><svg class="gi gi-ti" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gBaShield" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gBaShield)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><path d="M32 16l14 6v10c0 11-6 18-14 22-8-4-14-11-14-22V22z" fill="none" stroke="#fff" stroke-width="2.6" stroke-linejoin="round"/><path d="M25 32l5 5 10-10" fill="none" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <div>
          <b data-de="Individuell geplant" data-en="Individually planned">Individuell geplant</b>
          <span data-de="Für langfristige Erfolge" data-en="For long-term success">Für langfristige Erfolge</span>
        </div>
      </div>
    </div>

    <div class="ba-cta-wrap">
      <a href="#" class="cta-btn" onclick="openConsult(event)" data-de="Jetzt kostenlose Beratung sichern" data-en="Get Quote">Jetzt kostenlose Beratung sichern</a>
    </div>
  </div>
</section>

<section class="network-section" id="network">
  <div class="network-inner">
    <div class="network-head">
      <span class="network-kicker" data-de="Unser Netzwerk" data-en="Our network">Unser Netzwerk</span>
      <h2 data-ckey="network.heading" data-de="Ein Anbieter, verbunden über vier Länder" data-en="One provider, connected across four countries">Ein Anbieter, verbunden über vier Länder</h2>
      <p data-ckey="network.sub" data-de="Österreich, Deutschland und die Schweiz, verbunden mit unserer Hauptklinik in der Türkei: ein durchgehendes Betreuungsnetzwerk über vier Länder hinweg." data-en="Austria, Germany and Switzerland, connecting to our main clinic in Turkey: one continuous care network spanning four countries.">Österreich, Deutschland und die Schweiz, verbunden mit unserer Hauptklinik in der Türkei: ein durchgehendes Betreuungsnetzwerk über vier Länder hinweg.</p>
    </div>

    <div class="network-map" id="networkMap">
      <div class="earth-globe" id="earthGlobe" data-asset-base="assets/earth/">
        <canvas class="earth-canvas" aria-hidden="true"></canvas>
        <div class="earth-markers">
          <div class="net-node" data-id="de" style="--d:.1s;">
            <button type="button" class="net-pin" aria-label="Germany"></button>
            <div class="net-label lbl-above">
              <span class="city flag" role="img" aria-label="Deutschland"><svg viewBox="0 0 3 2" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false"><rect width="3" height="0.667" y="0" fill="#1a1a1a"/><rect width="3" height="0.667" y="0.667" fill="#dd0000"/><rect width="3" height="0.666" y="1.334" fill="#ffce00"/></svg></span>
              <span class="role" data-de="Nachsorge" data-en="Aftercare">Nachsorge</span>
              <span class="desc" data-de="München, Teil unseres Nachsorge-Netzwerks." data-en="Munich, part of our aftercare network.">München, Teil unseres Nachsorge-Netzwerks.</span>
            </div>
          </div>

          <div class="net-node" data-id="ch" style="--d:.25s;">
            <button type="button" class="net-pin" aria-label="Switzerland"></button>
            <div class="net-label lbl-above">
              <span class="city flag" role="img" aria-label="Schweiz"><svg viewBox="0 0 2 2" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false"><rect width="2" height="2" fill="#e2101c"/><rect x="0.86" y="0.4" width="0.28" height="1.2" fill="#fff"/><rect x="0.4" y="0.86" width="1.2" height="0.28" fill="#fff"/></svg></span>
              <span class="role" data-de="Nachsorge" data-en="Aftercare">Nachsorge</span>
              <span class="desc" data-de="Zürich, Teil unseres Nachsorge-Netzwerks." data-en="Zurich, part of our aftercare network.">Zürich, Teil unseres Nachsorge-Netzwerks.</span>
            </div>
          </div>

          <div class="net-node nn-hub" data-id="at" style="--d:.4s;">
            <button type="button" class="net-pin" aria-label="Austria"></button>
            <div class="net-label lbl-above">
              <span class="city flag" role="img" aria-label="Österreich"><svg viewBox="0 0 3 2" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false"><rect width="3" height="2" fill="#ed2939"/><rect y="0.667" width="3" height="0.666" fill="#fff"/></svg></span>
              <span class="role" data-de="Beratung &amp; Zentrale" data-en="Consultation &amp; HQ">Beratung &amp; Zentrale</span>
              <span class="desc" data-de="Linz, Ihr erstes Gespräch findet hier statt, persönlich vor Ort." data-en="Linz, your first conversation happens here, in person.">Linz, Ihr erstes Gespräch findet hier statt, persönlich vor Ort.</span>
            </div>
          </div>

          <div class="net-node" data-id="tr" style="--d:.55s;">
            <button type="button" class="net-pin" aria-label="Turkey"></button>
            <div class="net-label lbl-above">
              <span class="city flag" role="img" aria-label="Türkei"><svg viewBox="0 0 3 2" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false"><rect width="3" height="2" fill="#e30a17"/><circle cx="1.15" cy="1" r="0.5" fill="#fff"/><circle cx="1.3" cy="1" r="0.4" fill="#e30a17"/><polygon points="1.62,0.78 1.68,0.94 1.85,0.94 1.71,1.05 1.77,1.22 1.62,1.11 1.47,1.22 1.53,1.05 1.39,0.94 1.56,0.94" fill="#fff"/></svg></span>
              <span class="role" data-de="Hauptklinik" data-en="Main clinic">Hauptklinik</span>
              <span class="desc" data-de="Istanbul, Ihre Behandlung findet hier statt, mit 24/7-Betreuung." data-en="Istanbul, your treatment takes place here, with 24/7 care.">Istanbul, Ihre Behandlung findet hier statt, mit 24/7-Betreuung.</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="network-legend">
      <div class="lg-item"><span class="lg-dot"></span><span data-de="Live verbundenes Betreuungsnetzwerk" data-en="Live connected care network">Live verbundenes Betreuungsnetzwerk</span></div>
    </div>
  </div>
</section>

<section class="faq-section" id="faq">
  <div class="faq-bg"></div>
  <div class="faq-inner">
    <div class="faq-head">
      <svg class="faq-head-icon gi" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gChatQ2" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect x="2" y="2" width="60" height="60" rx="18" fill="url(#gChatQ2)"/><ellipse cx="22" cy="16" rx="20" ry="12" fill="#fff" opacity="0.22"/><rect x="14" y="16" width="36" height="24" rx="8" fill="#fff" opacity="0.95"/><path d="M22 40l0 8 10-8z" fill="#fff" opacity="0.95"/><text x="32" y="34" font-family="Arial, sans-serif" font-size="18" font-weight="800" fill="#2563eb" text-anchor="middle">?</text></svg>
      <div>
        <div class="faq-kicker" data-de="Fragen &amp; Antworten" data-en="Questions &amp; answers">Fragen &amp; Antworten</div>
        <h2 data-ckey="faq.heading" data-de="Häufig gestellte Fragen" data-en="Frequently asked questions">Häufig gestellte Fragen</h2>
        <p data-de="Die Fragen, die potenzielle Patienten am häufigsten davon abhalten, eine Beratung zu buchen, ehrlich beantwortet." data-en="The questions that most often hold prospective patients back from booking a consultation, answered honestly.">Die Fragen, die potenzielle Patienten am häufigsten davon abhalten, eine Beratung zu buchen, ehrlich beantwortet.</p>
        <a href="service-hair-transplant.php" style="display:inline-block;margin-top:10px;font-size:13.5px;font-weight:700;color:var(--blue-700);text-decoration:underline;" data-de="Mehr über die Haartransplantation erfahren →" data-en="Learn more about hair transplantation →">Mehr über die Haartransplantation erfahren →</a>
      </div>
    </div>

    <div class="hp-faq-list" data-clist="faq.items">
      <div class="hp-faq-item" data-citem>
        <div class="hp-faq-q" onclick="toggleFaq(this)"><span data-cfield="question" data-de="Tut eine Haartransplantation weh?" data-en="Does a hair transplant hurt?">Tut eine Haartransplantation weh?</span><span class="plus">+</span></div>
        <div class="hp-faq-a"><p data-cfield="answer" data-de="Der Eingriff erfolgt unter örtlicher Betäubung, die Kopfhaut ist während der Operation vollständig taub. Die meisten Patienten spüren nur leichten Druck, nicht Schmerz. Nachbeschwerden sind meist mild und mit frei verkäuflichen Schmerzmitteln gut zu behandeln." data-en="The procedure is performed under local anaesthesia, so the scalp is fully numb during the operation. Most patients feel only mild pressure, not pain. Post-operative discomfort is usually mild and manageable with standard over-the-counter pain relief.">Der Eingriff erfolgt unter örtlicher Betäubung, die Kopfhaut ist während der Operation vollständig taub. Die meisten Patienten spüren nur leichten Druck, nicht Schmerz. Nachbeschwerden sind meist mild und mit frei verkäuflichen Schmerzmitteln gut zu behandeln.</p></div>
      </div>
      <div class="hp-faq-item">
        <div class="hp-faq-q" onclick="toggleFaq(this)"><span data-de="Wird man sehen, dass ich eine Transplantation hatte?" data-en="Will anyone be able to tell I've had a transplant?">Wird man sehen, dass ich eine Transplantation hatte?</span><span class="plus">+</span></div>
        <div class="hp-faq-a"><p data-de="In den ersten 1 bis 2 Wochen können Krusten und Rötungen sichtbar sein. Danach ist die Heilung weitgehend unsichtbar. Ab Monat 4 bis 6 verschmilzt das neue Haar natürlich mit dem vorhandenen, bei einem erfahrenen Chirurgen nicht von echtem Haar zu unterscheiden." data-en="In the first 1 to 2 weeks, visible scabbing and redness may be noticeable. After that, healing is largely invisible. By months 4 to 6, the new hair blends naturally and, with an experienced surgeon, is indistinguishable from native hair.">In den ersten 1 bis 2 Wochen können Krusten und Rötungen sichtbar sein. Danach ist die Heilung weitgehend unsichtbar. Ab Monat 4 bis 6 verschmilzt das neue Haar natürlich mit dem vorhandenen, bei einem erfahrenen Chirurgen nicht von echtem Haar zu unterscheiden.</p></div>
      </div>
      <div class="hp-faq-item">
        <div class="hp-faq-q" onclick="toggleFaq(this)"><span data-de="Wie viele Grafts brauche ich?" data-en="How many grafts do I need?">Wie viele Grafts brauche ich?</span><span class="plus">+</span></div>
        <div class="hp-faq-a"><p data-de="Das hängt vom Ausmaß des Haarausfalls und der gewünschten Dichte ab. Eine typische Sitzung umfasst 1.500 bis 4.000 Grafts. Grad II bis III benötigt meist 1.500 bis 2.000, Grad V bis VI oft 3.000 bis 4.500. Eine kostenlose Beratung mit Haaranalyse gibt eine präzise Einschätzung." data-en="This depends entirely on the degree of hair loss and desired density. A typical session ranges from 1,500 to 4,000 grafts. Grade II to III usually needs 1,500 to 2,000; grade V to VI often 3,000 to 4,500. A free consultation with scalp analysis gives an accurate estimate.">Das hängt vom Ausmaß des Haarausfalls und der gewünschten Dichte ab. Eine typische Sitzung umfasst 1.500 bis 4.000 Grafts. Grad II bis III benötigt meist 1.500 bis 2.000, Grad V bis VI oft 3.000 bis 4.500. Eine kostenlose Beratung mit Haaranalyse gibt eine präzise Einschätzung.</p></div>
      </div>
      <div class="hp-faq-item">
        <div class="hp-faq-q" onclick="toggleFaq(this)"><span data-de="Ist das Ergebnis dauerhaft?" data-en="Is the result permanent?">Ist das Ergebnis dauerhaft?</span><span class="plus">+</span></div>
        <div class="hp-faq-a"><p data-de="Transplantiertes Haar stammt aus dem DHT-resistenten Spenderbereich und wächst lebenslang weiter. Nicht transplantiertes Haar kann jedoch weiter ausdünnen. Medikamente wie Finasterid oder Minoxidil nach dem Eingriff schützen das verbleibende natürliche Haar." data-en="Transplanted hair is taken from the DHT-resistant donor zone and continues to grow for life. However, existing non-transplanted hair may keep thinning. Medication like finasteride or minoxidil after the procedure helps protect remaining native hair.">Transplantiertes Haar stammt aus dem DHT-resistenten Spenderbereich und wächst lebenslang weiter. Nicht transplantiertes Haar kann jedoch weiter ausdünnen. Medikamente wie Finasterid oder Minoxidil nach dem Eingriff schützen das verbleibende natürliche Haar.</p></div>
      </div>
      <div class="hp-faq-item">
        <div class="hp-faq-q" onclick="toggleFaq(this)"><span data-de="Was passiert, wenn das Ergebnis nicht ausreicht?" data-en="What happens if I don't get enough results?">Was passiert, wenn das Ergebnis nicht ausreicht?</span><span class="plus">+</span></div>
        <div class="hp-faq-a"><p data-de="Die Graft-Überlebensrate liegt bei seriösen Kliniken bei 90 bis 95%. Bleibt das Ergebnis nach 12 bis 18 Monaten unter den Erwartungen, kann eine Folgesitzung besprochen werden. Apex Beauty bietet eine Kontrolluntersuchung nach 12 Monaten an." data-en="Graft survival rates at reputable clinics are generally 90 to 95%. If the result is below expectations after 12 to 18 months, a follow-up session can be discussed. Apex Beauty offers a 12-month follow-up consultation to assess the outcome.">Die Graft-Überlebensrate liegt bei seriösen Kliniken bei 90 bis 95%. Bleibt das Ergebnis nach 12 bis 18 Monaten unter den Erwartungen, kann eine Folgesitzung besprochen werden. Apex Beauty bietet eine Kontrolluntersuchung nach 12 Monaten an.</p></div>
      </div>
      <div class="hp-faq-item">
        <div class="hp-faq-q" onclick="toggleFaq(this)"><span data-de="Können Frauen eine Haartransplantation bekommen?" data-en="Can women have hair transplants?">Können Frauen eine Haartransplantation bekommen?</span><span class="plus">+</span></div>
        <div class="hp-faq-a"><p data-de="Ja. Frauen mit androgenetischer Alopezie können geeignete Kandidatinnen sein. Bei diffusem Haarausfall über die gesamte Kopfhaut, einschließlich des Spenderbereichs, reicht die stabile Spenderdichte jedoch oft nicht aus. Eine fachärztliche Beurteilung ist essenziell." data-en="Yes. Women with androgenetic alopecia can be suitable candidates. However, women with diffuse hair loss across the entire scalp, including the donor area, may not have sufficient stable donor hair. A specialist assessment is essential.">Ja. Frauen mit androgenetischer Alopezie können geeignete Kandidatinnen sein. Bei diffusem Haarausfall über die gesamte Kopfhaut, einschließlich des Spenderbereichs, reicht die stabile Spenderdichte jedoch oft nicht aus. Eine fachärztliche Beurteilung ist essenziell.</p></div>
      </div>
      <div class="hp-faq-item">
        <div class="hp-faq-q" onclick="toggleFaq(this)"><span data-de="Wie läuft die Anreise nach Istanbul ab?" data-en="How do I travel to Istanbul for the procedure?">Wie läuft die Anreise nach Istanbul ab?</span><span class="plus">+</span></div>
        <div class="hp-faq-a"><p data-de="Apex Beauty organisiert die gesamte Logistik für Patienten aus Österreich, Deutschland und der Schweiz. Der Eingriff dauert einen Tag. Die meisten Patienten fliegen am Vortag ein, ruhen sich eine Nacht aus und fliegen innerhalb von 48 Stunden zurück. Folgetermine können per Videoanruf stattfinden." data-en="Apex Beauty coordinates all logistics for patients from Austria, Germany, and Switzerland. The procedure takes one day. Most patients fly in the day before, rest one night, and fly home within 48 hours. Follow-up appointments can be conducted remotely via video call.">Apex Beauty organisiert die gesamte Logistik für Patienten aus Österreich, Deutschland und der Schweiz. Der Eingriff dauert einen Tag. Die meisten Patienten fliegen am Vortag ein, ruhen sich eine Nacht aus und fliegen innerhalb von 48 Stunden zurück. Folgetermine können per Videoanruf stattfinden.</p></div>
      </div>
      <div class="hp-faq-item">
        <div class="hp-faq-q" onclick="toggleFaq(this)"><span data-de="Was unterscheidet Apex direkt von einem Vermittler?" data-en="What's the difference between Apex direct and a broker?">Was unterscheidet Apex direkt von einem Vermittler?</span><span class="plus">+</span></div>
        <div class="hp-faq-a"><p data-de="Ein Vermittler koordiniert zwischen Patient und Klinik, ist aber medizinisch nicht involviert. Sie wissen oft nicht im Voraus, welches Team Sie behandelt. Apex Beauty ist eine Direktklinik: das Team, das Sie beraten hat, behandelt Sie auch, in unserer eigenen Einrichtung. Das bedeutet konsistente Qualität und direkte Verantwortung." data-en="A broker coordinates between a patient and a clinic but isn't medically involved. You may not know in advance which team will treat you. Apex Beauty is a direct clinic: the team you consult with is the team that treats you, in our own facility. That means consistent quality and direct accountability.">Ein Vermittler koordiniert zwischen Patient und Klinik, ist aber medizinisch nicht involviert. Sie wissen oft nicht im Voraus, welches Team Sie behandelt. Apex Beauty ist eine Direktklinik: das Team, das Sie beraten hat, behandelt Sie auch, in unserer eigenen Einrichtung. Das bedeutet konsistente Qualität und direkte Verantwortung.</p></div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/site-footer.php'; ?>

<a class="whatsapp-fab" href="https://wa.me/436641999199" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp" onclick="trackWhatsAppContact()">
  <svg viewBox="0 0 32 32" fill="#fff" aria-hidden="true"><path d="M16.004 3C9.373 3 4 8.373 4 15.004c0 2.386.7 4.61 1.902 6.478L4 29l7.72-1.865a11.94 11.94 0 0 0 4.284.788h.001C22.635 27.923 28 22.55 28 15.918 28 9.287 22.635 3 16.004 3zm0 21.9h-.001a9.9 9.9 0 0 1-5.05-1.383l-.362-.215-4.583 1.107 1.128-4.47-.236-.376a9.86 9.86 0 0 1-1.516-5.263c0-5.468 4.45-9.917 9.923-9.917 2.65 0 5.14 1.033 7.014 2.909a9.85 9.85 0 0 1 2.905 7.019c0 5.468-4.45 9.589-9.222 9.589z"/><path d="M21.62 18.164c-.297-.148-1.758-.868-2.03-.967-.273-.099-.471-.148-.669.149-.198.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.149-1.254-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.058-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.148-.174.198-.298.297-.496.099-.198.05-.372-.025-.52-.074-.149-.669-1.612-.916-2.208-.242-.58-.487-.502-.669-.511l-.57-.01c-.198 0-.52.074-.792.372-.273.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.876 1.213 3.074.148.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.873.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
</a>

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
            <span data-de="Männlich" data-en="Male">Männlich</span>
          </div>
          <div class="opt-card radio centered" data-value="female" onclick="pickSingle(this,'genderRow'); validateStep2()">
            <span data-de="Weiblich" data-en="Female">Weiblich</span>
          </div>
        </div>
      </div>
      <div class="cfield">
        <label data-de="Verfahren, die Sie interessieren *" data-en="Procedures You're Interested In *">Verfahren, die Sie interessieren *</label>
        <div class="opt-grid cols-1" id="procRow">
          <div class="opt-card" data-value="hair" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span data-de="Haartransplantation" data-en="Hair Transplant">Haartransplantation</span>
          </div>
          <div class="opt-card" data-value="beard" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span data-de="Barttransplantation" data-en="Beard Transplant">Barttransplantation</span>
          </div>
          <div class="opt-card" data-value="eyebrow" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span data-de="Augenbrauentransplantation" data-en="Eyebrow Transplant">Augenbrauentransplantation</span>
          </div>
        </div>
        <div class="cgroup-note" data-de="Unterstützende Therapien" data-en="Supporting Therapies">Unterstützende Therapien</div>
        <div class="opt-grid cols-2" id="therapyRow">
          <div class="opt-card" data-value="prp" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span data-de="PRP-Therapie" data-en="PRP Therapy">PRP-Therapie</span>
          </div>
          <div class="opt-card" data-value="stemcell" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span data-de="Stammzelltherapie" data-en="Stem Cell Therapy">Stammzelltherapie</span>
          </div>
          <div class="opt-card" data-value="exosome" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span data-de="Exosom-Therapie" data-en="Exosome Therapy">Exosom-Therapie</span>
          </div>
          <div class="opt-card" data-value="hbot" onclick="toggleChip(this); validateStep2()">
            <span class="mark"></span><span data-de="Hyperbarer Sauerstoff" data-en="Hyperbaric Oxygen">Hyperbarer Sauerstoff</span>
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
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gPhFront" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gPhFront)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="14" r="7" fill="none" stroke="#fff" stroke-width="2"/><circle cx="12.5" cy="12.5" r="1.1" fill="#fff"/><circle cx="17.5" cy="12.5" r="1.1" fill="#fff"/><path d="M12 17c1 1.2 2 1.6 3 1.6s2-0.4 3-1.6" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round"/></svg></span>
          <b data-de="Vorne" data-en="Front">Vorne</b>
          <span data-de="Gesicht sichtbar" data-en="Face visible">Gesicht sichtbar</span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-front')">
        </div>
        <div class="photo-slot" id="slot-top">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gPhTop" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gPhTop)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="20" r="4.5" fill="none" stroke="#fff" stroke-width="2"/><path d="M15 5v8M11 9l4-4 4 4" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <b data-de="Oben" data-en="Top">Oben</b>
          <span data-de="Von oben" data-en="From above">Von oben</span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-top')">
        </div>
        <div class="photo-slot" id="slot-side">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gPhSide" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gPhSide)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M11 22c-1-2-1-4 0-6-1-1-1-3 0-4 1-3 4-5 7-5 3 0 4 2 4 4 1 0 2 1 2 2 0 2-1 3-2 3 0 2-1 4-3 5-1 1-1 2 0 3z" fill="#fff" opacity="0.92"/></svg></span>
          <b data-de="Seite" data-en="Side">Seite</b>
          <span data-de="Profil" data-en="Profile">Profil</span>
          <input type="file" accept="image/*" onchange="markSlot(this,'slot-side')">
        </div>
        <div class="photo-slot" id="slot-donor">
          <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gPhDonor" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gPhDonor)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M20 10a7 7 0 1 0 1.8 6.9" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><polyline points="22,7 21.8,11.5 17.5,10.5" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
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
        <span data-de="Ich habe die &lt;a href=&quot;privacy.php&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;Datenschutzerklärung&lt;/a&gt; gelesen und akzeptiere die Verarbeitung meiner personenbezogenen Daten. *" data-en="I have read the &lt;a href=&quot;privacy.php&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;privacy policy&lt;/a&gt; and accept the processing of my personal data. *">Ich habe die <a href="privacy.php" target="_blank" rel="noopener noreferrer">Datenschutzerklärung</a> gelesen und akzeptiere die Verarbeitung meiner personenbezogenen Daten. *</span>
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

  // Meta Pixel Contact event — fired from the WhatsApp floating button's
  // onclick below. Routed through window.__apexPixel.track() (defined in
  // assets/meta-pixel.js) so it's consent-gated the same way Lead is below.
  function trackWhatsAppContact() {
    window.__apexPixel.track('Contact');
  }

  // Ad landing links go straight to the homepage with a query param that
  // auto-opens the lead form (see openConsult() call near the bottom):
  //   ?open=consult        — full homepage experience in the background
  //                          (hero videos, 3D earth globe)
  //   ?open=consult-light  — lightest possible load: the form opens over a
  //                          plain background and none of the heavy assets
  //                          (71MB+156MB of video, Three.js + earth textures)
  //                          are ever requested at all.
  // Both variants skip the "sound on by default" hero behavior below, since
  // either way the visitor came for the form, not to browse the homepage.
  var openParam = new URLSearchParams(window.location.search).get('open');
  var isLightLanding = openParam === 'consult-light';
  var isAdLanding = isLightLanding || openParam === 'consult';

  function loadRealVideoSource(id) {
    var v = document.getElementById(id);
    if (!v || !v.dataset.src) return;
    if (isLightLanding) return; // leave it src-less: zero network request
    v.src = v.dataset.src;
    v.load();
  }
  loadRealVideoSource('mobileVideo');
  loadRealVideoSource('desktopVideo');
  loadRealVideoSource('serviceVideo');

  function updateNavOffset() {
    var bar = document.getElementById('announceBar');
    var nav = document.querySelector('.nav');
    if (!bar || !nav) return;
    if (bar.classList.contains('is-closed')) {
      nav.style.top = '0px';
    } else {
      nav.style.top = bar.offsetHeight + 'px';
    }
  }
  function closeAnnounceBar() {
    var bar = document.getElementById('announceBar');
    if (!bar) return;
    bar.classList.add('is-closed');
    document.querySelector('.nav').style.top = '0px';
  }
  window.addEventListener('load', updateNavOffset);
  window.addEventListener('resize', updateNavOffset);
  setTimeout(closeAnnounceBar, 60000);
  function initNetworkMap() {
    var mapEl = document.getElementById('networkMap');
    if (!mapEl) return;
    var nodes = mapEl.querySelectorAll('.net-node');
    nodes.forEach(function (node) {
      var id = node.getAttribute('data-id');
      function highlight() {
        if (window.__earthGlobeApi) window.__earthGlobeApi.setHover(id);
        node.classList.add('is-active');
      }
      function clear() {
        if (window.__earthGlobeApi) window.__earthGlobeApi.clearHover();
        node.classList.remove('is-active');
      }
      node.addEventListener('mouseenter', highlight);
      node.addEventListener('mouseleave', clear);
      node.addEventListener('focusin', highlight);
      node.addEventListener('focusout', clear);
      node.querySelector('.net-pin').addEventListener('click', function (e) {
        e.preventDefault();
        var wasActive = node.classList.contains('tap-active');
        nodes.forEach(function (n) { n.classList.remove('tap-active'); });
        if (!wasActive) {
          node.classList.add('tap-active');
          highlight();
        } else {
          clear();
        }
      });
    });
    if ('IntersectionObserver' in window) {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            mapEl.classList.add('in-view');
            io.unobserve(mapEl);
          }
        });
      }, { threshold: 0.3 });
      io.observe(mapEl);
    } else {
      mapEl.classList.add('in-view');
    }
  }
  window.addEventListener('load', initNetworkMap);
  function toggleFaq(el) {
    var item = el.parentElement;
    var wasOpen = item.classList.contains('open');
    item.parentElement.querySelectorAll('.hp-faq-item').forEach(function (i) { i.classList.remove('open'); });
    if (!wasOpen) item.classList.add('open');
  }
  // Hero video sound: try to autoplay with sound on by default, and fall
  // back to muted (with a visible tap-to-unmute button) whenever a browser
  // blocks that — which is virtually always the case on mobile. There are
  // two <video> elements (desktop card + mobile full-bleed background) that
  // share the same source, so only the one actually visible for the current
  // breakpoint is ever allowed to play unmuted — otherwise both would play
  // their audio tracks at once, even the one hidden via CSS.
  function setupHeroSound(videoId, buttonId) {
    var video = document.getElementById(videoId);
    var btn = document.getElementById(buttonId);
    if (!video || !btn) return { activate: function () {}, deactivate: function () {} };
    var userMuted = null;

    function syncButton() {
      var muted = video.muted;
      btn.classList.toggle('is-muted', muted);
      btn.setAttribute('aria-pressed', String(!muted));
      btn.setAttribute('aria-label', muted ? 'Unmute video' : 'Mute video');
    }

    function tryUnmutedAutoplay() {
      if (userMuted === true) return;
      video.muted = false;
      var playPromise = video.play();
      if (playPromise && typeof playPromise.then === 'function') {
        playPromise.then(syncButton).catch(function () {
          video.muted = true;
          video.play().catch(function () {});
          syncButton();
        });
      } else {
        syncButton();
      }
    }

    function forceMute() {
      video.muted = true;
      syncButton();
    }

    btn.addEventListener('click', function () {
      video.muted = !video.muted;
      userMuted = video.muted;
      if (!video.muted) video.play().catch(function () { video.muted = true; syncButton(); });
      syncButton();
    });
    video.addEventListener('volumechange', syncButton);

    return { activate: tryUnmutedAutoplay, deactivate: forceMute };
  }
  // isAdLanding / isLightLanding are computed once, near the top of this
  // script — see the comment there for what each ?open= value does. Here,
  // an ad landing (either variant) just means: don't try to turn the hero
  // video's sound on behind the modal.
  (function initHeroSound() {
    var desktopSound = setupHeroSound('desktopVideo', 'soundToggle');
    var mobileSound = setupHeroSound('mobileVideo', 'soundToggleMobile');
    var mq = window.matchMedia('(max-width: 900px)');
    function applyForBreakpoint(isMobile) {
      if (isMobile) {
        desktopSound.deactivate();
        isAdLanding ? mobileSound.deactivate() : mobileSound.activate();
      } else {
        mobileSound.deactivate();
        isAdLanding ? desktopSound.deactivate() : desktopSound.activate();
      }
    }
    applyForBreakpoint(mq.matches);
    mq.addEventListener('change', function (e) { applyForBreakpoint(e.matches); });
  })();
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
    if (countsDone) renderCounts(1);
  }

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
  // Ad landing (?open=consult): pop the lead form open immediately.
  if (isAdLanding) openConsult();
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
  document.querySelectorAll('.lang-switch button').forEach(function (s) {
    s.addEventListener('click', function () { applyLang(s.getAttribute('data-lang')); });
  });

  /* ---- Before & after carousel ---- */
  (function () {
    var section = document.getElementById('before-after');
    if (!section) return;
    var slides = [];
    var dots = [];
    var current = 0;
    var touchStartX = null;

    function refresh() {
      slides = Array.prototype.slice.call(section.querySelectorAll('.ba-slide'));
      if (!slides.length) return;
      var carousel = section.querySelector('.ba-carousel');
      var dotsWrap = section.querySelector('#baDots');
      if (dotsWrap) {
        dotsWrap.innerHTML = slides.map(function (_, i) {
          return '<button type="button" class="ba-dot' + (i === 0 ? ' active' : '') +
            '" data-goto="' + i + '" aria-label="Case ' + (i + 1) + '"></button>';
        }).join('');
      }
      dots = Array.prototype.slice.call(section.querySelectorAll('.ba-dot'));
      var single = slides.length <= 1;
      if (carousel) carousel.classList.toggle('single-slide', single);
      if (dotsWrap) dotsWrap.classList.toggle('single-slide', single);
      current = 0;
      slides.forEach(function (s, idx) {
        s.classList.remove('dir-next', 'dir-prev', 'dir-init');
        var isFirst = idx === 0;
        s.classList.toggle('active', isFirst);
        if (isFirst) s.classList.add('dir-init');
      });
    }

    function goTo(i, dir) {
      if (!slides.length) return;
      var next = (i + slides.length) % slides.length;
      if (!dir) {
        if (next === current) return;
        var forward = (next - current + slides.length) % slides.length;
        var backward = (current - next + slides.length) % slides.length;
        dir = forward <= backward ? 'dir-next' : 'dir-prev';
      }
      current = next;
      slides.forEach(function (s, idx) {
        var isActive = idx === current;
        s.classList.toggle('active', isActive);
        if (isActive) {
          s.classList.remove('dir-next', 'dir-prev', 'dir-init');
          void s.offsetWidth;
          s.classList.add(dir);
        }
      });
      dots.forEach(function (d, idx) { d.classList.toggle('active', idx === current); });
    }

    document.addEventListener('click', function (e) {
      if (e.target.closest('#baPrev')) { goTo(current - 1, 'dir-prev'); return; }
      if (e.target.closest('#baNext')) { goTo(current + 1, 'dir-next'); return; }
      var dot = e.target.closest('.ba-dot');
      if (dot) goTo(parseInt(dot.getAttribute('data-goto'), 10));
    });

    section.addEventListener('touchstart', function (e) {
      if (!e.touches || !e.touches.length) return;
      touchStartX = e.touches[0].clientX;
    }, { passive: true });

    section.addEventListener('touchend', function (e) {
      if (touchStartX == null || !e.changedTouches || !e.changedTouches.length) return;
      var deltaX = e.changedTouches[0].clientX - touchStartX;
      touchStartX = null;
      if (Math.abs(deltaX) < 36) return;
      goTo(current + (deltaX < 0 ? 1 : -1), deltaX < 0 ? 'dir-next' : 'dir-prev');
    }, { passive: true });

    section.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft') goTo(current - 1, 'dir-prev');
      if (e.key === 'ArrowRight') goTo(current + 1, 'dir-next');
    });

    refresh();
    document.addEventListener('apex-content-loaded', refresh);
  })();

  /* ---- Rolling count-up numbers (trust bar) ---- */
  var countsDone = false;
  function formatCount(value, decimals) {
    if (decimals > 0) return value.toFixed(decimals);
    var sep = document.documentElement.lang === 'de' ? '.' : ',';
    return Math.round(value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, sep);
  }
  function renderCounts(progress) {
    document.querySelectorAll('.cnt').forEach(function (el) {
      var target = parseFloat(el.getAttribute('data-target'));
      var decimals = parseInt(el.getAttribute('data-decimals') || '0', 10);
      el.textContent = formatCount(target * progress, decimals);
    });
  }
  function animateCounts() {
    var duration = 1600, start = null;
    function tick(ts) {
      if (countsDone) return;
      if (!start) start = ts;
      var t = Math.min((ts - start) / duration, 1);
      var eased = 1 - Math.pow(1 - t, 3);
      renderCounts(eased);
      if (t < 1) { requestAnimationFrame(tick); } else { countsDone = true; }
    }
    requestAnimationFrame(tick);
    setTimeout(function () {
      if (!countsDone) { countsDone = true; renderCounts(1); }
    }, duration + 500);
  }
  var trustBar = document.querySelector('.trust-bar');
  var countsSeen = false;
  function startCountsIfVisible() {
    if (countsSeen || !trustBar) return;
    var r = trustBar.getBoundingClientRect();
    if (r.top < window.innerHeight && r.bottom > 0) {
      countsSeen = true;
      animateCounts();
      window.removeEventListener('scroll', startCountsIfVisible);
    }
  }
  if (trustBar) {
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (entries, obs) {
        entries.forEach(function (e) {
          if (e.isIntersecting && !countsSeen) { countsSeen = true; animateCounts(); obs.disconnect(); }
        });
      }, { threshold: 0.35 }).observe(trustBar);
    }
    window.addEventListener('scroll', startCountsIfVisible, { passive: true });
    startCountsIfVisible();
  }
</script>

<!-- ---- Our Network globe (real WebGL 3D Earth, adapted from mitchcamza/Earth3D) ----
     Loaded via a dynamic import (not a static type="module" script) so a
     light ad landing (?open=consult-light) never requests Three.js or any
     of the earth textures at all. -->
<script>
  if (!isLightLanding) {
    import('./assets/earth-globe.js').then(function (mod) {
      var root = document.getElementById('earthGlobe');
      if (root) window.__earthGlobeApi = mod.initEarthGlobe(root);
    });
  }
</script>

</body>
</html>
