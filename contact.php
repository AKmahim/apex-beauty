<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/content.php';
require_once __DIR__ . '/includes/site-config.php';
require_once __DIR__ . '/includes/i18n.php';
require_once __DIR__ . '/includes/seo.php';
$currentLang = apex_current_lang();
// The copy the admin panel edits, rendered into the HTML instead of being
// swapped in by JavaScript, so an edit is visible to crawlers.
$cmsContact = apex_get_page_content('contact') ?? [];
// Title, description, share image and the Google visibility switch are edited
// in the admin panel under Website content > Search engine listing; the
// fallbacks live in includes/seo.php.
$seoPage = 'contact';
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
<script src="<?= htmlspecialchars(apex_asset('assets/meta-pixel.js'), ENT_QUOTES) ?>" nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>"></script>
<!-- DOMPurify + wrapper: loaded before anything that writes markup into the
     DOM, so the language switcher never assigns unsanitised innerHTML. -->
<link rel="stylesheet" href="<?= htmlspecialchars(apex_asset('assets/apex-utilities.css'), ENT_QUOTES) ?>">
<script src="/assets/vendor/purify-3.1.6.min.js" nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>"></script>
<script src="<?= htmlspecialchars(apex_asset('assets/apex-safe-html.js'), ENT_QUOTES) ?>" nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>"></script>
<script src="<?= htmlspecialchars(apex_asset('assets/apex-actions.js'), ENT_QUOTES) ?>" nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>"></script>
<script src="<?= htmlspecialchars(apex_asset('assets/cookie-consent.js'), ENT_QUOTES) ?>" nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>"></script>
<script src="<?= htmlspecialchars(apex_asset('assets/content-loader.js'), ENT_QUOTES) ?>" nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>"></script>
<?php require __DIR__ . '/includes/site-gtm.php'; ?>
<style nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>">
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
    position: relative;
    font-size: 12px; font-weight: 600;
    width: fit-content;
    margin: 0 auto 14px;
  }
  .lang-switch-toggle {
    display: flex; align-items: center; gap: 6px;
    padding: 5px 12px; cursor: pointer;
    border: 1px solid rgba(255,255,255,0.3); border-radius: 999px;
    background: rgba(255,255,255,0.1);
    font: inherit; font-weight: inherit; color: rgba(255,255,255,0.85);
  }
  .lang-switch-caret { width: 11px; height: 11px; flex-shrink: 0; transition: transform 0.2s ease; }
  .lang-switch.open .lang-switch-caret { transform: rotate(180deg); }
  .lang-switch-menu {
    position: absolute; top: calc(100% + 8px); left: 50%; transform: translateX(-50%) translateY(-6px);
    display: flex; flex-direction: column; gap: 2px;
    min-width: 90px; padding: 6px;
    background: rgba(20,30,45,0.95); backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.2); border-radius: 14px;
    box-shadow: 0 18px 34px -14px rgba(0,0,0,0.5);
    opacity: 0; visibility: hidden;
    transition: opacity 0.16s ease, transform 0.16s ease, visibility 0.16s;
    z-index: 60;
  }
  .lang-switch.open .lang-switch-menu { opacity: 1; visibility: visible; transform: translateX(-50%) translateY(0); }
  .lang-switch-menu button { padding: 6px 11px; cursor: pointer; border: none; font: inherit; font-weight: inherit; border-radius: 999px; color: rgba(255,255,255,0.7); background: transparent; }
  .lang-switch-menu button:hover:not(.active) { background: rgba(255,255,255,0.12); color: #fff; }
  .lang-switch-menu button.active { background: linear-gradient(100deg, var(--teal-500), var(--blue-600)); color: #fff; }
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
<body data-content-page="contact">
<?php require __DIR__ . '/includes/site-gtm-noscript.php'; ?>

<div class="consult-modal" role="dialog" aria-labelledby="consultTitle">
  <div class="consult-topbar">
    <div class="consult-head">
      <div class="clogo">
        <img src="/assets/lotus-transparent.png" alt="Apex Beauty">
        <span>Apex Beauty</span>
      </div>
      <h2 id="consultTitle" data-ckey="intro.title"<?= apex_cms_attrs_or($cmsContact['intro']['title'] ?? null, ['de' => "Kostenlose Beratung", 'en' => "Free Consultation", 'fr' => "Consultation gratuite", 'nl' => "Gratis consult", 'it' => "Consulto gratuito", 'tr' => "Ücretsiz Danışma"]) ?>><?= apex_cms_value_or($cmsContact['intro']['title'] ?? null, ['de' => "Kostenlose Beratung", 'en' => "Free Consultation", 'fr' => "Consultation gratuite", 'nl' => "Gratis consult", 'it' => "Consulto gratuito", 'tr' => "Ücretsiz Danışma"], $currentLang) ?></h2>
      <p data-ckey="intro.sub"<?= apex_cms_attrs_or($cmsContact['intro']['sub'] ?? null, ['de' => "Füllen Sie das Formular aus, wir melden uns innerhalb von 24 Stunden.", 'en' => "Fill in the form and we'll get back to you within 24 hours.", 'fr' => "Remplissez le formulaire, nous vous répondrons sous 24 heures.", 'nl' => "Vul het formulier in, we nemen binnen 24 uur contact met u op.", 'it' => "Compila il modulo, ti risponderemo entro 24 ore.", 'tr' => "Formu doldurun, 24 saat içinde size dönüş yapalım."]) ?>><?= apex_cms_value_or($cmsContact['intro']['sub'] ?? null, ['de' => "Füllen Sie das Formular aus, wir melden uns innerhalb von 24 Stunden.", 'en' => "Fill in the form and we'll get back to you within 24 hours.", 'fr' => "Remplissez le formulaire, nous vous répondrons sous 24 heures.", 'nl' => "Vul het formulier in, we nemen binnen 24 uur contact met u op.", 'it' => "Compila il modulo, ti risponderemo entro 24 ore.", 'tr' => "Formu doldurun, 24 saat içinde size dönüş yapalım."], $currentLang) ?></p>
    </div>
    <div class="lang-switch" id="langSwitch">
      <button type="button" class="lang-switch-toggle" id="langSwitchToggle" aria-haspopup="listbox" aria-expanded="false">
        <span class="lang-switch-current">DE</span>
        <svg class="lang-switch-caret" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div class="lang-switch-menu" id="langSwitchMenu" role="listbox">
        <button type="button" class="active" data-lang="de" role="option">DE</button>
        <button type="button" class="inactive" data-lang="en" role="option">EN</button>
        <button type="button" class="inactive" data-lang="fr" role="option">FR</button>
        <button type="button" class="inactive" data-lang="nl" role="option">NL</button>
        <button type="button" class="inactive" data-lang="it" role="option">IT</button>
        <button type="button" class="inactive" data-lang="tr" role="option">TR</button>
      </div>
    </div>
    <div class="consult-steps" id="consultSteps">
      <div class="cstep active" data-step="1"><span class="dot">1</span><span data-ckey="intro.t1"<?= apex_cms_attrs_or($cmsContact['intro']['t1'] ?? null, ['de' => "Info", 'en' => "Info", 'fr' => "Infos", 'nl' => "Info", 'it' => "Info", 'tr' => "Bilgi"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t1'] ?? null, ['de' => "Info", 'en' => "Info", 'fr' => "Infos", 'nl' => "Info", 'it' => "Info", 'tr' => "Bilgi"], $currentLang) ?></span></div>
      <div class="cstep-line"></div>
      <div class="cstep" data-step="2"><span class="dot">2</span><span data-ckey="intro.t2"<?= apex_cms_attrs_or($cmsContact['intro']['t2'] ?? null, ['de' => "Bedarf", 'en' => "Needs", 'fr' => "Besoins", 'nl' => "Behoefte", 'it' => "Esigenze", 'tr' => "İhtiyaçlar"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t2'] ?? null, ['de' => "Bedarf", 'en' => "Needs", 'fr' => "Besoins", 'nl' => "Behoefte", 'it' => "Esigenze", 'tr' => "İhtiyaçlar"], $currentLang) ?></span></div>
      <div class="cstep-line"></div>
      <div class="cstep" data-step="3"><span class="dot">3</span><span data-ckey="intro.t3"<?= apex_cms_attrs_or($cmsContact['intro']['t3'] ?? null, ['de' => "Fotos", 'en' => "Photos", 'fr' => "Photos", 'nl' => "Foto's", 'it' => "Foto", 'tr' => "Fotoğraflar"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t3'] ?? null, ['de' => "Fotos", 'en' => "Photos", 'fr' => "Photos", 'nl' => "Foto's", 'it' => "Foto", 'tr' => "Fotoğraflar"], $currentLang) ?></span></div>
    </div>
  </div>
  <div class="consult-body">

  <!-- STEP 1: Info -->
  <div class="consult-pane active" id="cpane1">
    <div class="pane-title" data-ckey="intro.t4"<?= apex_cms_attrs_or($cmsContact['intro']['t4'] ?? null, ['de' => "Holen Sie sich Ihre kostenlose Haaranalyse", 'en' => "Get Your Free Hair Analysis", 'fr' => "Obtenez votre analyse capillaire gratuite", 'nl' => "Krijg uw gratis haaranalyse", 'it' => "Ottieni la tua analisi gratuita dei capelli", 'tr' => "Ücretsiz Saç Analizinizi Alın"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t4'] ?? null, ['de' => "Holen Sie sich Ihre kostenlose Haaranalyse", 'en' => "Get Your Free Hair Analysis", 'fr' => "Obtenez votre analyse capillaire gratuite", 'nl' => "Krijg uw gratis haaranalyse", 'it' => "Ottieni la tua analisi gratuita dei capelli", 'tr' => "Ücretsiz Saç Analizinizi Alın"], $currentLang) ?></div>
    <div class="pane-sub" data-ckey="intro.t5"<?= apex_cms_attrs_or($cmsContact['intro']['t5'] ?? null, ['de' => "Unser Expertenteam meldet sich innerhalb von 24 Stunden", 'en' => "Our expert team will contact you within 24 hours", 'fr' => "Notre équipe d'experts vous contactera sous 24 heures", 'nl' => "Ons expertteam neemt binnen 24 uur contact met u op", 'it' => "Il nostro team di esperti ti contatterà entro 24 ore", 'tr' => "Uzman ekibimiz 24 saat içinde sizinle iletişime geçecektir"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t5'] ?? null, ['de' => "Unser Expertenteam meldet sich innerhalb von 24 Stunden", 'en' => "Our expert team will contact you within 24 hours", 'fr' => "Notre équipe d'experts vous contactera sous 24 heures", 'nl' => "Ons expertteam neemt binnen 24 uur contact met u op", 'it' => "Il nostro team di esperti ti contatterà entro 24 ore", 'tr' => "Uzman ekibimiz 24 saat içinde sizinle iletişime geçecektir"], $currentLang) ?></div>
    <div class="cfield">
      <label data-ckey="intro.t6"<?= apex_cms_attrs_or($cmsContact['intro']['t6'] ?? null, ['de' => "Vollständiger Name *", 'en' => "Full Name *", 'fr' => "Nom complet *", 'nl' => "Volledige naam *", 'it' => "Nome completo *", 'tr' => "Ad Soyad *"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t6'] ?? null, ['de' => "Vollständiger Name *", 'en' => "Full Name *", 'fr' => "Nom complet *", 'nl' => "Volledige naam *", 'it' => "Nome completo *", 'tr' => "Ad Soyad *"], $currentLang) ?></label>
      <input type="text" id="cfName" data-de-ph="Ihr vollständiger Name" data-en-ph="Your full name" placeholder="Ihr vollständiger Name" data-input="validate1">
    </div>
    <div class="cfield">
      <label data-ckey="intro.t7"<?= apex_cms_attrs_or($cmsContact['intro']['t7'] ?? null, ['de' => "E-Mail *", 'en' => "Email *", 'fr' => "E-mail *", 'nl' => "E-mail *", 'it' => "E-mail *", 'tr' => "E-posta *"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t7'] ?? null, ['de' => "E-Mail *", 'en' => "Email *", 'fr' => "E-mail *", 'nl' => "E-mail *", 'it' => "E-mail *", 'tr' => "E-posta *"], $currentLang) ?></label>
      <input type="email" id="cfEmail" placeholder="email@example.com" data-input="validate1">
    </div>
    <div class="cfield">
      <label data-ckey="intro.t8"<?= apex_cms_attrs_or($cmsContact['intro']['t8'] ?? null, ['de' => "Land *", 'en' => "Country *", 'fr' => "Pays *", 'nl' => "Land *", 'it' => "Paese *", 'tr' => "Ülke *"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t8'] ?? null, ['de' => "Land *", 'en' => "Country *", 'fr' => "Pays *", 'nl' => "Land *", 'it' => "Paese *", 'tr' => "Ülke *"], $currentLang) ?></label>
      <select id="cfCountry" data-change="prefix">
        <option value="AT" data-prefix="+43">🇦🇹 Österreich</option>
        <option value="DE" data-prefix="+49">🇩🇪 Deutschland</option>
        <option value="CH" data-prefix="+41">🇨🇭 Schweiz</option>
        <option value="TR" data-prefix="+90">🇹🇷 Türkei</option>
        <option value="OTHER" data-prefix="+">🌍 Andere / Other</option>
      </select>
    </div>
    <div class="cfield">
      <label data-ckey="intro.t9"<?= apex_cms_attrs_or($cmsContact['intro']['t9'] ?? null, ['de' => "Telefon *", 'en' => "Phone *", 'fr' => "Téléphone *", 'nl' => "Telefoon *", 'it' => "Telefono *", 'tr' => "Telefon *"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t9'] ?? null, ['de' => "Telefon *", 'en' => "Phone *", 'fr' => "Téléphone *", 'nl' => "Telefoon *", 'it' => "Telefono *", 'tr' => "Telefon *"], $currentLang) ?></label>
      <div class="phone-row">
        <div class="prefix" id="cfPrefix">+43</div>
        <input type="tel" id="cfPhone" placeholder="660 123 45 67" data-input="validate1">
      </div>
    </div>
    <div class="consult-nav">
      <button type="button" class="cnext" id="cnext1" disabled data-click="step" data-step="2" data-ckey="intro.t10"<?= apex_cms_attrs_or($cmsContact['intro']['t10'] ?? null, ['de' => "Weiter", 'en' => "Continue", 'fr' => "Continuer", 'nl' => "Doorgaan", 'it' => "Continua", 'tr' => "Devam Et"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t10'] ?? null, ['de' => "Weiter", 'en' => "Continue", 'fr' => "Continuer", 'nl' => "Doorgaan", 'it' => "Continua", 'tr' => "Devam Et"], $currentLang) ?></button>
    </div>
  </div>

  <!-- STEP 2: Needs -->
  <div class="consult-pane" id="cpane2">
    <div class="cfield">
      <label data-ckey="intro.t11"<?= apex_cms_attrs_or($cmsContact['intro']['t11'] ?? null, ['de' => "Ihr Geschlecht *", 'en' => "Your Gender *", 'fr' => "Votre sexe *", 'nl' => "Uw geslacht *", 'it' => "Il tuo genere *", 'tr' => "Cinsiyetiniz *"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t11'] ?? null, ['de' => "Ihr Geschlecht *", 'en' => "Your Gender *", 'fr' => "Votre sexe *", 'nl' => "Uw geslacht *", 'it' => "Il tuo genere *", 'tr' => "Cinsiyetiniz *"], $currentLang) ?></label>
      <div class="opt-grid cols-2" id="genderRow">
        <div class="opt-card radio centered" data-value="male" data-click="pick" data-row="genderRow">
          <span data-ckey="intro.t12"<?= apex_cms_attrs_or($cmsContact['intro']['t12'] ?? null, ['de' => "Männlich", 'en' => "Male", 'fr' => "Homme", 'nl' => "Man", 'it' => "Uomo", 'tr' => "Erkek"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t12'] ?? null, ['de' => "Männlich", 'en' => "Male", 'fr' => "Homme", 'nl' => "Man", 'it' => "Uomo", 'tr' => "Erkek"], $currentLang) ?></span>
        </div>
        <div class="opt-card radio centered" data-value="female" data-click="pick" data-row="genderRow">
          <span data-ckey="intro.t13"<?= apex_cms_attrs_or($cmsContact['intro']['t13'] ?? null, ['de' => "Weiblich", 'en' => "Female", 'fr' => "Femme", 'nl' => "Vrouw", 'it' => "Donna", 'tr' => "Kadın"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t13'] ?? null, ['de' => "Weiblich", 'en' => "Female", 'fr' => "Femme", 'nl' => "Vrouw", 'it' => "Donna", 'tr' => "Kadın"], $currentLang) ?></span>
        </div>
      </div>
    </div>
    <div class="cfield">
      <label data-ckey="intro.t14"<?= apex_cms_attrs_or($cmsContact['intro']['t14'] ?? null, ['de' => "Verfahren, die Sie interessieren *", 'en' => "Procedures You're Interested In *", 'fr' => "Interventions qui vous intéressent *", 'nl' => "Ingrepen waarin u geïnteresseerd bent *", 'it' => "Procedure di tuo interesse *", 'tr' => "İlgilendiğiniz İşlemler *"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t14'] ?? null, ['de' => "Verfahren, die Sie interessieren *", 'en' => "Procedures You're Interested In *", 'fr' => "Interventions qui vous intéressent *", 'nl' => "Ingrepen waarin u geïnteresseerd bent *", 'it' => "Procedure di tuo interesse *", 'tr' => "İlgilendiğiniz İşlemler *"], $currentLang) ?></label>
      <div class="opt-grid cols-1" id="procRow">
        <div class="opt-card" data-value="hair" data-click="chip">
          <span class="mark"></span><span data-ckey="intro.t15"<?= apex_cms_attrs_or($cmsContact['intro']['t15'] ?? null, ['de' => "Haartransplantation", 'en' => "Hair Transplant", 'fr' => "Greffe de cheveux", 'nl' => "Haartransplantatie", 'it' => "Trapianto di capelli", 'tr' => "Saç Ekimi"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t15'] ?? null, ['de' => "Haartransplantation", 'en' => "Hair Transplant", 'fr' => "Greffe de cheveux", 'nl' => "Haartransplantatie", 'it' => "Trapianto di capelli", 'tr' => "Saç Ekimi"], $currentLang) ?></span>
        </div>
        <div class="opt-card" data-value="beard" data-click="chip">
          <span class="mark"></span><span data-ckey="intro.t16"<?= apex_cms_attrs_or($cmsContact['intro']['t16'] ?? null, ['de' => "Barttransplantation", 'en' => "Beard Transplant", 'fr' => "Greffe de barbe", 'nl' => "Baardtransplantatie", 'it' => "Trapianto di barba", 'tr' => "Sakal Ekimi"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t16'] ?? null, ['de' => "Barttransplantation", 'en' => "Beard Transplant", 'fr' => "Greffe de barbe", 'nl' => "Baardtransplantatie", 'it' => "Trapianto di barba", 'tr' => "Sakal Ekimi"], $currentLang) ?></span>
        </div>
        <div class="opt-card" data-value="eyebrow" data-click="chip">
          <span class="mark"></span><span data-ckey="intro.t17"<?= apex_cms_attrs_or($cmsContact['intro']['t17'] ?? null, ['de' => "Augenbrauentransplantation", 'en' => "Eyebrow Transplant", 'fr' => "Greffe de sourcils", 'nl' => "Wenkbrauwtransplantatie", 'it' => "Trapianto di sopracciglia", 'tr' => "Kaş Ekimi"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t17'] ?? null, ['de' => "Augenbrauentransplantation", 'en' => "Eyebrow Transplant", 'fr' => "Greffe de sourcils", 'nl' => "Wenkbrauwtransplantatie", 'it' => "Trapianto di sopracciglia", 'tr' => "Kaş Ekimi"], $currentLang) ?></span>
        </div>
      </div>
      <div class="cgroup-note" data-ckey="intro.t18"<?= apex_cms_attrs_or($cmsContact['intro']['t18'] ?? null, ['de' => "Unterstützende Therapien", 'en' => "Supporting Therapies", 'fr' => "Thérapies complémentaires", 'nl' => "Ondersteunende therapieën", 'it' => "Terapie di supporto", 'tr' => "Destekleyici Tedaviler"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t18'] ?? null, ['de' => "Unterstützende Therapien", 'en' => "Supporting Therapies", 'fr' => "Thérapies complémentaires", 'nl' => "Ondersteunende therapieën", 'it' => "Terapie di supporto", 'tr' => "Destekleyici Tedaviler"], $currentLang) ?></div>
      <div class="opt-grid cols-2" id="therapyRow">
        <div class="opt-card" data-value="prp" data-click="chip">
          <span class="mark"></span><span data-ckey="intro.t19"<?= apex_cms_attrs_or($cmsContact['intro']['t19'] ?? null, ['de' => "PRP-Therapie", 'en' => "PRP Therapy", 'fr' => "Thérapie PRP", 'nl' => "PRP-therapie", 'it' => "Terapia PRP", 'tr' => "PRP Tedavisi"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t19'] ?? null, ['de' => "PRP-Therapie", 'en' => "PRP Therapy", 'fr' => "Thérapie PRP", 'nl' => "PRP-therapie", 'it' => "Terapia PRP", 'tr' => "PRP Tedavisi"], $currentLang) ?></span>
        </div>
        <div class="opt-card" data-value="stemcell" data-click="chip">
          <span class="mark"></span><span data-ckey="intro.t20"<?= apex_cms_attrs_or($cmsContact['intro']['t20'] ?? null, ['de' => "Stammzelltherapie", 'en' => "Stem Cell Therapy", 'fr' => "Thérapie par cellules souches", 'nl' => "Stamceltherapie", 'it' => "Terapia con cellule staminali", 'tr' => "Kök Hücre Tedavisi"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t20'] ?? null, ['de' => "Stammzelltherapie", 'en' => "Stem Cell Therapy", 'fr' => "Thérapie par cellules souches", 'nl' => "Stamceltherapie", 'it' => "Terapia con cellule staminali", 'tr' => "Kök Hücre Tedavisi"], $currentLang) ?></span>
        </div>
        <div class="opt-card" data-value="exosome" data-click="chip">
          <span class="mark"></span><span data-ckey="intro.t21"<?= apex_cms_attrs_or($cmsContact['intro']['t21'] ?? null, ['de' => "Exosom-Therapie", 'en' => "Exosome Therapy", 'fr' => "Thérapie par exosomes", 'nl' => "Exosoomtherapie", 'it' => "Terapia con esosomi", 'tr' => "Ekzozom Tedavisi"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t21'] ?? null, ['de' => "Exosom-Therapie", 'en' => "Exosome Therapy", 'fr' => "Thérapie par exosomes", 'nl' => "Exosoomtherapie", 'it' => "Terapia con esosomi", 'tr' => "Ekzozom Tedavisi"], $currentLang) ?></span>
        </div>
        <div class="opt-card" data-value="hbot" data-click="chip">
          <span class="mark"></span><span data-ckey="intro.t22"<?= apex_cms_attrs_or($cmsContact['intro']['t22'] ?? null, ['de' => "Hyperbarer Sauerstoff", 'en' => "Hyperbaric Oxygen", 'fr' => "Oxygénothérapie hyperbare", 'nl' => "Hyperbare zuurstoftherapie", 'it' => "Ossigenoterapia iperbarica", 'tr' => "Hiperbarik Oksijen"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t22'] ?? null, ['de' => "Hyperbarer Sauerstoff", 'en' => "Hyperbaric Oxygen", 'fr' => "Oxygénothérapie hyperbare", 'nl' => "Hyperbare zuurstoftherapie", 'it' => "Ossigenoterapia iperbarica", 'tr' => "Hiperbarik Oksijen"], $currentLang) ?></span>
        </div>
      </div>
    </div>
    <div class="cfield">
      <label data-ckey="intro.t23"<?= apex_cms_attrs_or($cmsContact['intro']['t23'] ?? null, ['de' => "Wann planen Sie den Eingriff?", 'en' => "When Are You Planning the Procedure?", 'fr' => "Quand prévoyez-vous l'intervention ?", 'nl' => "Wanneer plant u de ingreep?", 'it' => "Quando prevedi l'intervento?", 'tr' => "İşlemi Ne Zaman Planlıyorsunuz?"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t23'] ?? null, ['de' => "Wann planen Sie den Eingriff?", 'en' => "When Are You Planning the Procedure?", 'fr' => "Quand prévoyez-vous l'intervention ?", 'nl' => "Wanneer plant u de ingreep?", 'it' => "Quando prevedi l'intervento?", 'tr' => "İşlemi Ne Zaman Planlıyorsunuz?"], $currentLang) ?></label>
      <div class="opt-grid cols-3" id="timingRow">
        <div class="opt-card radio centered" data-value="this-month" data-click="pick" data-row="timingRow"><span data-ckey="intro.t24"<?= apex_cms_attrs_or($cmsContact['intro']['t24'] ?? null, ['de' => "Diesen Monat", 'en' => "This month", 'fr' => "Ce mois-ci", 'nl' => "Deze maand", 'it' => "Questo mese", 'tr' => "Bu Ay"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t24'] ?? null, ['de' => "Diesen Monat", 'en' => "This month", 'fr' => "Ce mois-ci", 'nl' => "Deze maand", 'it' => "Questo mese", 'tr' => "Bu Ay"], $currentLang) ?></span></div>
        <div class="opt-card radio centered" data-value="1-3" data-click="pick" data-row="timingRow"><span data-ckey="intro.t25"<?= apex_cms_attrs_or($cmsContact['intro']['t25'] ?? null, ['de' => "In 1–3 Monaten", 'en' => "In 1–3 months", 'fr' => "Dans 1 à 3 mois", 'nl' => "Over 1–3 maanden", 'it' => "Tra 1 e 3 mesi", 'tr' => "1-3 Ay İçinde"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t25'] ?? null, ['de' => "In 1–3 Monaten", 'en' => "In 1–3 months", 'fr' => "Dans 1 à 3 mois", 'nl' => "Over 1–3 maanden", 'it' => "Tra 1 e 3 mesi", 'tr' => "1-3 Ay İçinde"], $currentLang) ?></span></div>
        <div class="opt-card radio centered" data-value="3-6" data-click="pick" data-row="timingRow"><span data-ckey="intro.t26"<?= apex_cms_attrs_or($cmsContact['intro']['t26'] ?? null, ['de' => "In 3–6 Monaten", 'en' => "In 3–6 months", 'fr' => "Dans 3 à 6 mois", 'nl' => "Over 3–6 maanden", 'it' => "Tra 3 e 6 mesi", 'tr' => "3-6 Ay İçinde"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t26'] ?? null, ['de' => "In 3–6 Monaten", 'en' => "In 3–6 months", 'fr' => "Dans 3 à 6 mois", 'nl' => "Over 3–6 maanden", 'it' => "Tra 3 e 6 mesi", 'tr' => "3-6 Ay İçinde"], $currentLang) ?></span></div>
        <div class="opt-card radio centered" data-value="6plus" data-click="pick" data-row="timingRow"><span data-ckey="intro.t27"<?= apex_cms_attrs_or($cmsContact['intro']['t27'] ?? null, ['de' => "In 6+ Monaten", 'en' => "In 6+ months", 'fr' => "Dans 6+ mois", 'nl' => "Over 6+ maanden", 'it' => "Tra 6+ mesi", 'tr' => "6+ Ay İçinde"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t27'] ?? null, ['de' => "In 6+ Monaten", 'en' => "In 6+ months", 'fr' => "Dans 6+ mois", 'nl' => "Over 6+ maanden", 'it' => "Tra 6+ mesi", 'tr' => "6+ Ay İçinde"], $currentLang) ?></span></div>
        <div class="opt-card radio centered u-02" data-value="research" data-click="pick" data-row="timingRow"><span data-ckey="intro.t28"<?= apex_cms_attrs_or($cmsContact['intro']['t28'] ?? null, ['de' => "Nur recherchieren", 'en' => "Just researching", 'fr' => "Je me renseigne seulement", 'nl' => "Alleen aan het oriënteren", 'it' => "Sto solo informandomi", 'tr' => "Sadece Araştırıyorum"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t28'] ?? null, ['de' => "Nur recherchieren", 'en' => "Just researching", 'fr' => "Je me renseigne seulement", 'nl' => "Alleen aan het oriënteren", 'it' => "Sto solo informandomi", 'tr' => "Sadece Araştırıyorum"], $currentLang) ?></span></div>
      </div>
    </div>
    <div class="cfield">
      <label data-ckey="intro.t29"<?= apex_cms_attrs_or($cmsContact['intro']['t29'] ?? null, ['de' => "Zusätzliche Notizen (optional)", 'en' => "Additional Notes (Optional)", 'fr' => "Remarques supplémentaires (facultatif)", 'nl' => "Aanvullende opmerkingen (optioneel)", 'it' => "Note aggiuntive (facoltativo)", 'tr' => "Ek Notlar (İsteğe Bağlı)"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t29'] ?? null, ['de' => "Zusätzliche Notizen (optional)", 'en' => "Additional Notes (Optional)", 'fr' => "Remarques supplémentaires (facultatif)", 'nl' => "Aanvullende opmerkingen (optioneel)", 'it' => "Note aggiuntive (facoltativo)", 'tr' => "Ek Notlar (İsteğe Bağlı)"], $currentLang) ?></label>
      <textarea id="cfNotes" data-de-ph="Ihre Ziele oder Fragen..." data-en-ph="Your goals or questions..." placeholder="Ihre Ziele oder Fragen..."></textarea>
    </div>
    <div class="consult-nav">
      <button type="button" class="cback" data-click="step" data-step="1" data-ckey="intro.t30"<?= apex_cms_attrs_or($cmsContact['intro']['t30'] ?? null, ['de' => "Zurück", 'en' => "Back", 'fr' => "Retour", 'nl' => "Terug", 'it' => "Indietro", 'tr' => "Geri"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t30'] ?? null, ['de' => "Zurück", 'en' => "Back", 'fr' => "Retour", 'nl' => "Terug", 'it' => "Indietro", 'tr' => "Geri"], $currentLang) ?></button>
      <button type="button" class="cnext" id="cnext2" disabled data-click="step" data-step="3" data-ckey="intro.t31"<?= apex_cms_attrs_or($cmsContact['intro']['t31'] ?? null, ['de' => "Weiter", 'en' => "Continue", 'fr' => "Continuer", 'nl' => "Doorgaan", 'it' => "Continua", 'tr' => "Devam Et"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t31'] ?? null, ['de' => "Weiter", 'en' => "Continue", 'fr' => "Continuer", 'nl' => "Doorgaan", 'it' => "Continua", 'tr' => "Devam Et"], $currentLang) ?></button>
    </div>
  </div>

  <!-- STEP 3: Photos -->
  <div class="consult-pane" id="cpane3">
    <div class="photo-note" data-ckey="intro.t32"<?= apex_cms_attrs_or($cmsContact['intro']['t32'] ?? null, ['de' => "📸 Fotos sind optional. Unsere Experten kontaktieren Sie in jedem Fall.", 'en' => "📸 Photos are optional. Our experts will contact you either way.", 'fr' => "📸 Les photos sont facultatives. Nos experts vous contacteront dans tous les cas.", 'nl' => "📸 Foto's zijn optioneel. Onze experts nemen sowieso contact met u op.", 'it' => "📸 Le foto sono facoltative. I nostri esperti ti contatteranno comunque.", 'tr' => "📸 Fotoğraflar isteğe bağlıdır. Uzmanlarımız her durumda sizinle iletişime geçecektir."]) ?>><?= apex_cms_value_or($cmsContact['intro']['t32'] ?? null, ['de' => "📸 Fotos sind optional. Unsere Experten kontaktieren Sie in jedem Fall.", 'en' => "📸 Photos are optional. Our experts will contact you either way.", 'fr' => "📸 Les photos sont facultatives. Nos experts vous contacteront dans tous les cas.", 'nl' => "📸 Foto's zijn optioneel. Onze experts nemen sowieso contact met u op.", 'it' => "📸 Le foto sono facoltative. I nostri esperti ti contatteranno comunque.", 'tr' => "📸 Fotoğraflar isteğe bağlıdır. Uzmanlarımız her durumda sizinle iletişime geçecektir."], $currentLang) ?></div>
    <div class="photo-grid">
      <div class="photo-slot" id="slot-front">
        <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gPhFront" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gPhFront)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="14" r="7" fill="none" stroke="#fff" stroke-width="2"/><circle cx="12.5" cy="12.5" r="1.1" fill="#fff"/><circle cx="17.5" cy="12.5" r="1.1" fill="#fff"/><path d="M12 17c1 1.2 2 1.6 3 1.6s2-0.4 3-1.6" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round"/></svg></span>
        <b data-ckey="intro.t33"<?= apex_cms_attrs_or($cmsContact['intro']['t33'] ?? null, ['de' => "Vorne", 'en' => "Front", 'fr' => "Face avant", 'nl' => "Voorkant", 'it' => "Fronte", 'tr' => "Ön"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t33'] ?? null, ['de' => "Vorne", 'en' => "Front", 'fr' => "Face avant", 'nl' => "Voorkant", 'it' => "Fronte", 'tr' => "Ön"], $currentLang) ?></b>
        <span data-ckey="intro.t34"<?= apex_cms_attrs_or($cmsContact['intro']['t34'] ?? null, ['de' => "Gesicht sichtbar", 'en' => "Face visible", 'fr' => "Visage visible", 'nl' => "Gezicht zichtbaar", 'it' => "Volto visibile", 'tr' => "Yüz Görünür"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t34'] ?? null, ['de' => "Gesicht sichtbar", 'en' => "Face visible", 'fr' => "Visage visible", 'nl' => "Gezicht zichtbaar", 'it' => "Volto visibile", 'tr' => "Yüz Görünür"], $currentLang) ?></span>
        <input type="file" accept="image/*" data-change="slot" data-slot="slot-front">
      </div>
      <div class="photo-slot" id="slot-top">
        <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gPhTop" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#60a5fa"/><stop offset="1" stop-color="#1d4ed8"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gPhTop)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><circle cx="15" cy="20" r="4.5" fill="none" stroke="#fff" stroke-width="2"/><path d="M15 5v8M11 9l4-4 4 4" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
        <b data-ckey="intro.t35"<?= apex_cms_attrs_or($cmsContact['intro']['t35'] ?? null, ['de' => "Oben", 'en' => "Top", 'fr' => "Dessus", 'nl' => "Bovenkant", 'it' => "Sopra", 'tr' => "Üst"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t35'] ?? null, ['de' => "Oben", 'en' => "Top", 'fr' => "Dessus", 'nl' => "Bovenkant", 'it' => "Sopra", 'tr' => "Üst"], $currentLang) ?></b>
        <span data-ckey="intro.t36"<?= apex_cms_attrs_or($cmsContact['intro']['t36'] ?? null, ['de' => "Von oben", 'en' => "From above", 'fr' => "Vue de dessus", 'nl' => "Van bovenaf", 'it' => "Dall'alto", 'tr' => "Yukarıdan"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t36'] ?? null, ['de' => "Von oben", 'en' => "From above", 'fr' => "Vue de dessus", 'nl' => "Van bovenaf", 'it' => "Dall'alto", 'tr' => "Yukarıdan"], $currentLang) ?></span>
        <input type="file" accept="image/*" data-change="slot" data-slot="slot-top">
      </div>
      <div class="photo-slot" id="slot-side">
        <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gPhSide" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#38bdf8"/><stop offset="1" stop-color="#2563eb"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gPhSide)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M11 22c-1-2-1-4 0-6-1-1-1-3 0-4 1-3 4-5 7-5 3 0 4 2 4 4 1 0 2 1 2 2 0 2-1 3-2 3 0 2-1 4-3 5-1 1-1 2 0 3z" fill="#fff" opacity="0.92"/></svg></span>
        <b data-ckey="intro.t37"<?= apex_cms_attrs_or($cmsContact['intro']['t37'] ?? null, ['de' => "Seite", 'en' => "Side", 'fr' => "Profil", 'nl' => "Zijkant", 'it' => "Lato", 'tr' => "Yan"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t37'] ?? null, ['de' => "Seite", 'en' => "Side", 'fr' => "Profil", 'nl' => "Zijkant", 'it' => "Lato", 'tr' => "Yan"], $currentLang) ?></b>
        <span data-ckey="intro.t38"<?= apex_cms_attrs_or($cmsContact['intro']['t38'] ?? null, ['de' => "Profil", 'en' => "Profile", 'fr' => "Profil", 'nl' => "Profiel", 'it' => "Profilo", 'tr' => "Profil"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t38'] ?? null, ['de' => "Profil", 'en' => "Profile", 'fr' => "Profil", 'nl' => "Profiel", 'it' => "Profilo", 'tr' => "Profil"], $currentLang) ?></span>
        <input type="file" accept="image/*" data-change="slot" data-slot="slot-side">
      </div>
      <div class="photo-slot" id="slot-donor">
        <span class="opt-badge"><svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="gPhDonor" x1="0" y1="0" x2="30" y2="30" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#7dd3fc"/><stop offset="1" stop-color="#1e40af"/></linearGradient></defs><rect width="30" height="30" rx="9" fill="url(#gPhDonor)"/><ellipse cx="10" cy="8" rx="9" ry="5" fill="#fff" opacity="0.18"/><path d="M20 10a7 7 0 1 0 1.8 6.9" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/><polyline points="22,7 21.8,11.5 17.5,10.5" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
        <b data-ckey="intro.t39"<?= apex_cms_attrs_or($cmsContact['intro']['t39'] ?? null, ['de' => "Spender", 'en' => "Donor", 'fr' => "Donneuse", 'nl' => "Donor", 'it' => "Donatrice", 'tr' => "Donör"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t39'] ?? null, ['de' => "Spender", 'en' => "Donor", 'fr' => "Donneuse", 'nl' => "Donor", 'it' => "Donatrice", 'tr' => "Donör"], $currentLang) ?></b>
        <span data-ckey="intro.t40"<?= apex_cms_attrs_or($cmsContact['intro']['t40'] ?? null, ['de' => "Hinterkopf", 'en' => "Back of head", 'fr' => "Arrière de la tête", 'nl' => "Achterhoofd", 'it' => "Retro della testa", 'tr' => "Baş Arkası"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t40'] ?? null, ['de' => "Hinterkopf", 'en' => "Back of head", 'fr' => "Arrière de la tête", 'nl' => "Achterhoofd", 'it' => "Retro della testa", 'tr' => "Baş Arkası"], $currentLang) ?></span>
        <input type="file" accept="image/*" data-change="slot" data-slot="slot-donor">
      </div>
    </div>
    <div class="photo-note"><span id="photoCount">0</span>/4 <span data-ckey="intro.t41"<?= apex_cms_attrs_or($cmsContact['intro']['t41'] ?? null, ['de' => "Fotos hochgeladen", 'en' => "photos uploaded", 'fr' => "photos téléchargées", 'nl' => "foto's geüpload", 'it' => "foto caricate", 'tr' => "fotoğraf yüklendi"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t41'] ?? null, ['de' => "Fotos hochgeladen", 'en' => "photos uploaded", 'fr' => "photos téléchargées", 'nl' => "foto's geüpload", 'it' => "foto caricate", 'tr' => "fotoğraf yüklendi"], $currentLang) ?></span></div>
    <div class="cfield">
      <label data-ckey="intro.t42"<?= apex_cms_attrs_or($cmsContact['intro']['t42'] ?? null, ['de' => "Rabattgutschein (optional)", 'en' => "Discount Coupon (Optional)", 'fr' => "Code de réduction (facultatif)", 'nl' => "Kortingscode (optioneel)", 'it' => "Codice sconto (facoltativo)", 'tr' => "İndirim Kuponu (İsteğe Bağlı)"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t42'] ?? null, ['de' => "Rabattgutschein (optional)", 'en' => "Discount Coupon (Optional)", 'fr' => "Code de réduction (facultatif)", 'nl' => "Kortingscode (optioneel)", 'it' => "Codice sconto (facoltativo)", 'tr' => "İndirim Kuponu (İsteğe Bağlı)"], $currentLang) ?></label>
      <input type="text" id="cfCoupon" placeholder="WELCOME5">
    </div>
    <div class="check-row">
      <input type="checkbox" id="cfPrivacy" data-change="validate3">
      <span data-de="Ich habe die &lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;Datenschutzerklärung&lt;/a&gt; gelesen und akzeptiere die Verarbeitung meiner personenbezogenen Daten. *" data-en="I have read the &lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;privacy policy&lt;/a&gt; and accept the processing of my personal data. *" data-fr="J'ai lu la &lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;politique de confidentialité&lt;/a&gt; et j'accepte le traitement de mes données personnelles. *" data-nl="Ik heb het &lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;privacybeleid&lt;/a&gt; gelezen en ga akkoord met de verwerking van mijn persoonsgegevens. *" data-it="Ho letto l'&lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;informativa sulla privacy&lt;/a&gt; e accetto il trattamento dei miei dati personali. *" data-tr="&lt;a href=&quot;<?= apex_lang_base() ?>/privacy&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;Gizlilik politikasını&lt;/a&gt; okudum ve kişisel verilerimin işlenmesini kabul ediyorum. *">Ich habe die <a href="<?= apex_lang_base() ?>/privacy" target="_blank" rel="noopener noreferrer">Datenschutzerklärung</a> gelesen und akzeptiere die Verarbeitung meiner personenbezogenen Daten. *</span>
    </div>
    <div class="check-row">
      <input type="checkbox" id="cfMarketing">
      <span data-ckey="intro.t43"<?= apex_cms_attrs_or($cmsContact['intro']['t43'] ?? null, ['de' => "Ich möchte über Aktionen und Angebote informiert werden.", 'en' => "I'd like to be informed about promotions and offers.", 'fr' => "Je souhaite être informé(e) des promotions et offres.", 'nl' => "Ik wil op de hoogte worden gehouden van acties en aanbiedingen.", 'it' => "Desidero essere informato/a su promozioni e offerte.", 'tr' => "Kampanyalar ve fırsatlar hakkında bilgilendirilmek istiyorum."]) ?>><?= apex_cms_value_or($cmsContact['intro']['t43'] ?? null, ['de' => "Ich möchte über Aktionen und Angebote informiert werden.", 'en' => "I'd like to be informed about promotions and offers.", 'fr' => "Je souhaite être informé(e) des promotions et offres.", 'nl' => "Ik wil op de hoogte worden gehouden van acties en aanbiedingen.", 'it' => "Desidero essere informato/a su promozioni e offerte.", 'tr' => "Kampanyalar ve fırsatlar hakkında bilgilendirilmek istiyorum."], $currentLang) ?></span>
    </div>
    <div class="gdpr-badge" data-ckey="intro.t44"<?= apex_cms_attrs_or($cmsContact['intro']['t44'] ?? null, ['de' => "🇪🇺 DSGVO · Ihre Daten sind geschützt", 'en' => "🇪🇺 GDPR · Your data is protected", 'fr' => "🇪🇺 RGPD · Vos données sont protégées", 'nl' => "🇪🇺 AVG · Uw gegevens zijn beschermd", 'it' => "🇪🇺 GDPR · I tuoi dati sono protetti", 'tr' => "🇪🇺 GDPR · Verileriniz Korunmaktadır"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t44'] ?? null, ['de' => "🇪🇺 DSGVO · Ihre Daten sind geschützt", 'en' => "🇪🇺 GDPR · Your data is protected", 'fr' => "🇪🇺 RGPD · Vos données sont protégées", 'nl' => "🇪🇺 AVG · Uw gegevens zijn beschermd", 'it' => "🇪🇺 GDPR · I tuoi dati sono protetti", 'tr' => "🇪🇺 GDPR · Verileriniz Korunmaktadır"], $currentLang) ?></div>
    <div class="consult-nav">
      <button type="button" class="cback" data-click="step" data-step="2" data-ckey="intro.t45"<?= apex_cms_attrs_or($cmsContact['intro']['t45'] ?? null, ['de' => "Zurück", 'en' => "Back", 'fr' => "Retour", 'nl' => "Terug", 'it' => "Indietro", 'tr' => "Geri"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t45'] ?? null, ['de' => "Zurück", 'en' => "Back", 'fr' => "Retour", 'nl' => "Terug", 'it' => "Indietro", 'tr' => "Geri"], $currentLang) ?></button>
      <button type="button" class="cnext" id="cnext3" disabled data-click="submit-consult" data-ckey="intro.t46"<?= apex_cms_attrs_or($cmsContact['intro']['t46'] ?? null, ['de' => "Absenden", 'en' => "Submit", 'fr' => "Envoyer", 'nl' => "Versturen", 'it' => "Invia", 'tr' => "Gönder"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t46'] ?? null, ['de' => "Absenden", 'en' => "Submit", 'fr' => "Envoyer", 'nl' => "Versturen", 'it' => "Invia", 'tr' => "Gönder"], $currentLang) ?></button>
    </div>
  </div>

  <!-- SUCCESS -->
  <div class="consult-pane" id="cpaneSuccess">
    <div class="consult-success">
      <div class="ok-ring">✓</div>
      <h3 data-ckey="intro.t47"<?= apex_cms_attrs_or($cmsContact['intro']['t47'] ?? null, ['de' => "Vielen Dank!", 'en' => "Thank You!", 'fr' => "Merci !", 'nl' => "Bedankt!", 'it' => "Grazie!", 'tr' => "Teşekkürler!"]) ?>><?= apex_cms_value_or($cmsContact['intro']['t47'] ?? null, ['de' => "Vielen Dank!", 'en' => "Thank You!", 'fr' => "Merci !", 'nl' => "Bedankt!", 'it' => "Grazie!", 'tr' => "Teşekkürler!"], $currentLang) ?></h3>
      <p data-ckey="intro.t48"<?= apex_cms_attrs_or($cmsContact['intro']['t48'] ?? null, ['de' => "Ihre Anfrage ist bei uns eingegangen. Unser Team meldet sich innerhalb von 24 Stunden bei Ihnen.", 'en' => "We've received your request. Our team will get back to you within 24 hours.", 'fr' => "Nous avons bien reçu votre demande. Notre équipe vous recontactera sous 24 heures.", 'nl' => "We hebben uw aanvraag ontvangen. Ons team neemt binnen 24 uur contact met u op.", 'it' => "Abbiamo ricevuto la tua richiesta. Il nostro team ti risponderà entro 24 ore.", 'tr' => "Talebinizi aldık. Ekibimiz 24 saat içinde sizinle iletişime geçecektir."]) ?>><?= apex_cms_value_or($cmsContact['intro']['t48'] ?? null, ['de' => "Ihre Anfrage ist bei uns eingegangen. Unser Team meldet sich innerhalb von 24 Stunden bei Ihnen.", 'en' => "We've received your request. Our team will get back to you within 24 hours.", 'fr' => "Nous avons bien reçu votre demande. Notre équipe vous recontactera sous 24 heures.", 'nl' => "We hebben uw aanvraag ontvangen. Ons team neemt binnen 24 uur contact met u op.", 'it' => "Abbiamo ricevuto la tua richiesta. Il nostro team ti risponderà entro 24 ore.", 'tr' => "Talebinizi aldık. Ekibimiz 24 saat içinde sizinle iletişime geçecektir."], $currentLang) ?></p>
    </div>
  </div>
  </div>
</div>

<script nonce="<?= htmlspecialchars(apex_csp_nonce(), ENT_QUOTES) ?>">
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
  // All six languages carry data-* translations now. When this still said
  // ['de','en'], applyLang() treated fr/nl/it/tr as untranslated and fell
  // back to English for them, overwriting text the server had already
  // rendered in the right language.
  var APEX_TRANSLATED_LANGS = ['de', 'en', 'fr', 'nl', 'it', 'tr'];
  function applyLang(lang) {
    document.documentElement.lang = lang;
    var fallback = APEX_TRANSLATED_LANGS.indexOf(lang) === -1 ? 'en' : null;
    document.querySelectorAll('[data-de]').forEach(function (el) {
      var val = el.getAttribute('data-' + lang);
      if (val === null && fallback) val = el.getAttribute('data-' + fallback);
      if (val !== null) apexSetHTML(el, val);
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
  (function () {
    var toggle = document.getElementById('langSwitchToggle');
    var ls = document.getElementById('langSwitch');
    if (!toggle || !ls) return;
    toggle.addEventListener('click', function (e) {
      e.stopPropagation();
      var isOpen = ls.classList.toggle('open');
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
    document.addEventListener('click', function (e) {
      if (ls.classList.contains('open') && !ls.contains(e.target)) {
        ls.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') { ls.classList.remove('open'); toggle.setAttribute('aria-expanded', 'false'); }
    });
  })();

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

  function trackWhatsAppContact() {
    if (window.__apexPixel) window.__apexPixel.track('Contact');
  }
</script>

<a class="whatsapp-fab" href="<?= htmlspecialchars(APEX_WHATSAPP_LINK, ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp" data-click="whatsapp">
  <svg viewBox="0 0 32 32" fill="#fff" aria-hidden="true"><path d="M16.004 3C9.373 3 4 8.373 4 15.004c0 2.386.7 4.61 1.902 6.478L4 29l7.72-1.865a11.94 11.94 0 0 0 4.284.788h.001C22.635 27.923 28 22.55 28 15.918 28 9.287 22.635 3 16.004 3zm0 21.9h-.001a9.9 9.9 0 0 1-5.05-1.383l-.362-.215-4.583 1.107 1.128-4.47-.236-.376a9.86 9.86 0 0 1-1.516-5.263c0-5.468 4.45-9.917 9.923-9.917 2.65 0 5.14 1.033 7.014 2.909a9.85 9.85 0 0 1 2.905 7.019c0 5.468-4.45 9.589-9.222 9.589z"/><path d="M21.62 18.164c-.297-.148-1.758-.868-2.03-.967-.273-.099-.471-.148-.669.149-.198.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.149-1.254-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.058-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.148-.174.198-.298.297-.496.099-.198.05-.372-.025-.52-.074-.149-.669-1.612-.916-2.208-.242-.58-.487-.502-.669-.511l-.57-.01c-.198 0-.52.074-.792.372-.273.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.876 1.213 3.074.148.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.873.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
</a>

<?php include __DIR__ . '/includes/apex-ai-widget.php'; ?>

</body>
</html>
<?php echo apex_localize_output((string) ob_get_clean(), $currentLang); ?>
