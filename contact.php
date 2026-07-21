<?php
declare(strict_types=1);
$seoTitle = 'Apex Beauty — Kostenlose Beratung';
$seoDescription = 'Sichern Sie sich eine kostenlose, unverbindliche Beratung zur Haartransplantation bei Apex Beauty.';
$seoCanonicalPath = 'contact';
$seoNoindex = true;
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    --ink: #0f2027;
    --ink-soft: #45596a;
    --paper: #f7fafd;
  }
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    font-family: -apple-system, BlinkMacSystemFont, "Inter", "Segoe UI", sans-serif;
    color: var(--ink);
    background: linear-gradient(160deg, #eaf6fe, #dbeafe);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px 16px;
  }
  a { text-decoration: none; color: inherit; }

  /* ---- Lead card (lifted as-is from the consultation modal in
     glass-theme.html — same class names, same look — just placed directly
     on the page instead of inside a fixed overlay, since this page's only
     job is showing the form immediately. ) ---- */
  .consult-modal {
    position: relative;
    width: 100%; max-width: 600px;
    border-radius: 26px;
    background: linear-gradient(165deg, rgba(255,255,255,0.65), rgba(219,234,254,0.5));
    border: 1px solid rgba(255,255,255,0.85);
    box-shadow: 0 0 0 1px rgba(147,197,253,0.35), 0 20px 50px -12px rgba(37,99,235,0.28), 0 40px 90px -30px rgba(10,30,60,0.5), inset 0 1px 0 rgba(255,255,255,0.9);
  }
  .consult-topbar {
    position: relative;
    background: linear-gradient(120deg, var(--teal-700), var(--blue-900));
    padding: 22px 30px 20px;
    border-radius: 26px 26px 0 0;
  }
  .consult-head { text-align: center; margin-bottom: 20px; }
  .consult-head .clogo { display: flex; align-items: center; justify-content: center; gap: 8px; margin-bottom: 10px; }
  .consult-head .clogo img { height: 24px; width: auto; }
  .consult-head .clogo span { font-family: 'Fraunces', serif; font-weight: 600; font-size: 15px; color: #fff; letter-spacing: 0.02em; }
  .consult-head h2 { font-size: 19px; font-weight: 700; color: #fff; margin-bottom: 4px; }
  .consult-head p { font-size: 12.5px; color: rgba(255,255,255,0.7); }
  .lang-switch {
    display: flex; justify-content: center;
    font-size: 12px; font-weight: 600;
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 999px;
    overflow: hidden;
    background: rgba(255,255,255,0.1);
    padding: 3px;
    width: fit-content;
    margin: 0 auto 14px;
  }
  .lang-switch button { padding: 4px 11px; cursor: pointer; border: none; font: inherit; font-weight: inherit; border-radius: 999px; color: rgba(255,255,255,0.7); background: transparent; }
  .lang-switch .active { background: linear-gradient(100deg, var(--teal-500), var(--blue-600)); color: #fff; }
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
    background: rgba(255,255,255,0.6); color: var(--ink); outline: none;
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
    background: rgba(219,234,254,0.6); font-size: 14.5px; color: var(--ink); font-weight: 700;
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
    background: rgba(255,255,255,0.45);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.85), 0 6px 16px -12px rgba(37,99,235,0.25);
    font-size: 14px; font-weight: 600; color: var(--ink);
    transition: all 0.15s ease;
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
    background: rgba(255,255,255,0.45);
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
    border: 1.5px solid rgba(255,255,255,0.75); background: rgba(255,255,255,0.5);
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
<body data-content-page="contact">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.php?id=GTM-W6ZC5JRP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="consult-modal" role="dialog" aria-labelledby="consultTitle">
  <div class="consult-topbar">
    <div class="consult-head">
      <div class="clogo">
        <img src="assets/lotus-transparent.png" alt="Apex Beauty">
        <span>Apex Beauty</span>
      </div>
      <h2 id="consultTitle" data-ckey="intro.title" data-de="Kostenlose Beratung" data-en="Free Consultation">Kostenlose Beratung</h2>
      <p data-ckey="intro.sub" data-de="Füllen Sie das Formular aus, wir melden uns innerhalb von 24 Stunden." data-en="Fill in the form and we'll get back to you within 24 hours.">Füllen Sie das Formular aus, wir melden uns innerhalb von 24 Stunden.</p>
    </div>
    <div class="lang-switch">
      <button type="button" class="active" data-lang="de">DE</button>
      <button type="button" class="inactive" data-lang="en">EN</button>
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
    window.scrollTo(0, 0);
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
</script>
</body>
</html>
