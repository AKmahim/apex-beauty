<?php declare(strict_types=1);

require_once __DIR__ . '/site-config.php';
require_once __DIR__ . '/i18n.php';

$siteHeaderMode = $siteHeaderMode ?? 'simple';
$siteActivePage = $siteActivePage ?? '';
$siteLangBase = apex_lang_base();
// Pages pass 'index.php' (the only value ever used in practice) or leave
// these unset; either way the real link always needs the current language's
// URL prefix, since a bare relative "index.php" resolves one level too deep
// once a page is actually served from under /en/.
$siteHomeHref = $siteHomeHref ?? 'index.php';
$siteHomeHref = $siteLangBase . '/' . ($siteHomeHref === 'index.php' || $siteHomeHref === '' ? '' : ltrim($siteHomeHref, '/'));
$siteSectionBase = $siteSectionBase ?? '';
$siteSectionBase = $siteLangBase . '/' . ($siteSectionBase === 'index.php' || $siteSectionBase === '' ? '' : ltrim($siteSectionBase, '/'));

if (!defined('APEX_SITE_HEADER_STYLE_EMITTED')) {
  define('APEX_SITE_HEADER_STYLE_EMITTED', true);
  ?>
  <style>
    .nav {
      position: sticky;
      top: 0;
      z-index: 50;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 48px;
      transition: top 0.35s ease;
      background: linear-gradient(100deg, rgba(224,242,254,0.65), rgba(191,225,250,0.5) 55%, rgba(219,238,254,0.55));
      background-color: rgba(255,255,255,0.55);
      backdrop-filter: blur(30px) saturate(1.8);
      -webkit-backdrop-filter: blur(30px) saturate(1.8);
      border-bottom: 1px solid rgba(255,255,255,0.7);
      box-shadow: 0 1px 0 rgba(255,255,255,0.8) inset, 0 8px 24px -18px rgba(37,99,235,0.18);
    }
    .logo-lockup { display: flex; align-items: center; gap: 4px; }
    .logo-lockup img.lotus { height: 46px; width: auto; display: block; }
    .logo-lockup img.wordmark { height: 70px; width: auto; display: block; transform: translateY(3px); }
    .nav-links {
      display: flex;
      gap: 32px;
      font-size: 14.5px;
      font-weight: 500;
      color: var(--ink-soft);
    }
    .nav-links a:hover { color: var(--teal-700); }
    .nav-links a.active { color: var(--teal-700); font-weight: 700; }
    .nav-right {
      display: flex;
      align-items: center;
      gap: 20px;
    }
    .lang-switch {
      position: relative;
      font-size: 13px;
      font-weight: 600;
    }
    .lang-switch-toggle {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 6px 14px;
      cursor: pointer;
      border: 1px solid rgba(255,255,255,0.6);
      border-radius: 999px;
      background: rgba(255,255,255,0.25);
      backdrop-filter: blur(10px);
      font: inherit;
      font-weight: inherit;
      color: var(--ink);
    }
    .lang-switch-caret { width: 11px; height: 11px; flex-shrink: 0; transition: transform 0.2s ease; }
    .lang-switch.open .lang-switch-caret { transform: rotate(180deg); }
    .lang-switch-menu {
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      display: flex;
      flex-direction: column;
      gap: 2px;
      min-width: 96px;
      padding: 6px;
      background: rgba(255,255,255,0.92);
      backdrop-filter: blur(24px) saturate(1.6);
      -webkit-backdrop-filter: blur(24px) saturate(1.6);
      border: 1px solid rgba(255,255,255,0.75);
      border-radius: 14px;
      box-shadow: 0 18px 34px -14px rgba(15,23,42,0.35);
      opacity: 0;
      visibility: hidden;
      transform: translateY(-6px);
      transition: opacity 0.16s ease, transform 0.16s ease, visibility 0.16s;
      z-index: 60;
    }
    .lang-switch.open .lang-switch-menu { opacity: 1; visibility: visible; transform: translateY(0); }
    .lang-switch-menu button {
      padding: 7px 12px;
      cursor: pointer;
      border: none;
      font: inherit;
      font-weight: inherit;
      border-radius: 999px;
      text-align: left;
      background: transparent;
      color: var(--ink-soft);
    }
    .lang-switch-menu button:hover:not(.active) { background: rgba(37,99,235,0.08); color: var(--ink); }
    .lang-switch-menu button.active {
      position: relative;
      overflow: hidden;
      background: linear-gradient(100deg, var(--teal-500), var(--blue-600));
      box-shadow: 0 4px 14px -3px rgba(37,99,235,0.6), inset 0 1px 0 rgba(255,255,255,0.55);
      color: white;
    }
    .cta-btn {
      position: relative;
      overflow: hidden;
      background: linear-gradient(100deg, var(--teal-500) 0%, var(--teal-600) 35%, var(--blue-600) 100%);
      color: white;
      font-size: 14px;
      font-weight: 700;
      padding: 11px 22px;
      border-radius: 10px;
      border: 1px solid rgba(255,255,255,0.5);
      box-shadow: 0 10px 28px -6px rgba(13,148,136,0.55), 0 4px 14px -4px rgba(37,99,235,0.5), inset 0 1px 0 rgba(255,255,255,0.55);
      transition: transform 0.15s ease, box-shadow 0.15s ease;
      white-space: nowrap;
    }
    .cta-btn::before {
      content: ''; position: absolute; inset: 0;
      background: linear-gradient(180deg, rgba(255,255,255,0.5) 0%, rgba(255,255,255,0.08) 45%, transparent 55%);
      pointer-events: none;
    }
    .cta-btn:hover { transform: translateY(-1px); box-shadow: 0 14px 32px -6px rgba(13,148,136,0.65), 0 6px 16px -4px rgba(37,99,235,0.6), inset 0 1px 0 rgba(255,255,255,0.6); }

    .nav-collapse { display: contents; }
    .nav-drop-cta { display: none; }
    .nav-hamburger {
      display: none;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      flex-shrink: 0;
      background: rgba(255,255,255,0.5);
      border: 1px solid rgba(255,255,255,0.7);
      border-radius: 10px;
      color: var(--ink);
      cursor: pointer;
    }
    .nav-hamburger svg { width: 20px; height: 20px; }

    @media (max-width: 900px) {
      .logo-lockup { gap: 8px; flex-shrink: 0; }
      .logo-lockup img.lotus { height: 30px; }
      .logo-lockup img.wordmark { height: 22px; transform: translateY(3px); }

      .nav.nav-full {
        position: sticky;
        padding: 10px 16px;
        gap: 8px;
        flex-wrap: wrap;
        background: linear-gradient(100deg, rgba(224,242,254,0.97), rgba(204,227,247,0.97) 55%, rgba(219,238,254,0.97));
        background-color: rgba(224,242,254,0.97);
        backdrop-filter: blur(24px) saturate(1.5);
        -webkit-backdrop-filter: blur(24px) saturate(1.5);
        border-bottom-color: rgba(191,225,250,0.95);
      }
      .nav.nav-full .nav-links { display: none; }
      .nav.nav-full .nav-right { display: contents; }
      .nav.nav-full .nav-right .lang-switch { margin-left: auto; }
      .nav.nav-full .nav-right .cta-btn { display: none; }
      .nav.nav-full .nav-hamburger { display: flex; }
      .nav.nav-full .nav-collapse {
        display: none;
        position: absolute;
        top: 100%; left: 0; right: 0;
        background: linear-gradient(145deg, rgba(228,244,255,0.98), rgba(214,233,250,0.98));
        background-color: rgba(228,244,255,0.98);
        backdrop-filter: blur(28px) saturate(1.6);
        -webkit-backdrop-filter: blur(28px) saturate(1.6);
        border-top: 1px solid rgba(255,255,255,0.55);
        border-bottom: 1px solid rgba(191,225,250,0.9);
        border-radius: 0 0 20px 20px;
        box-shadow: 0 18px 34px -18px rgba(15,23,42,0.25), inset 0 -12px 24px -18px rgba(37,99,235,0.25);
        padding: 10px 16px 16px;
      }
      .nav.nav-open.nav-full .nav-collapse { display: block; }
      .nav.nav-open.nav-full .nav-links { display: flex; flex-direction: column; gap: 3px; }
      .nav.nav-open.nav-full .nav-links a {
        padding: 10px 12px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.75);
      }
      .nav-drop-cta { justify-content: center; text-align: center; margin-top: 12px; }
      .nav.nav-open.nav-full .nav-drop-cta { display: flex; }

      .nav.nav-simple { padding: 10px 16px; gap: 10px; flex-wrap: wrap; }
      .nav.nav-simple .nav-right { margin-left: auto; gap: 12px; }
      .nav.nav-simple .nav-links {
        order: 3;
        width: 100%;
        gap: 12px;
        overflow-x: auto;
        white-space: nowrap;
        padding-top: 8px;
      }
      .nav.nav-simple .nav-links::-webkit-scrollbar { display: none; }

      .lang-switch { font-size: 11px; }
      .lang-switch-toggle { padding: 5px 10px; }
      .lang-switch-menu button { padding: 6px 10px; }
      .nav-right .cta-btn { padding: 9px 12px; font-size: 12.5px; white-space: nowrap; }
    }

    @media (max-width: 580px) {
      .logo-lockup img.wordmark { display: none; }
      .nav-right .cta-btn { padding: 8px 10px; font-size: 12px; }
    }
  </style>
  <?php
}
?>
<?php if (!defined('APEX_SITE_SCHEMA_EMITTED')): ?>
<?php
define('APEX_SITE_SCHEMA_EMITTED', true);
$medicalClinicSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'MedicalClinic',
  'name' => APEX_BUSINESS_NAME,
  'legalName' => APEX_BUSINESS_LEGAL_NAME,
  'url' => APEX_SITE_URL,
  'logo' => APEX_SITE_URL . '/assets/wordmark-transparent.png',
  'image' => APEX_SITE_URL . '/assets/wordmark-transparent.png',
  'telephone' => APEX_WHATSAPP_E164,
  'address' => [
    '@type' => 'PostalAddress',
    'streetAddress' => APEX_ADDRESS_STREET,
    'addressLocality' => APEX_ADDRESS_CITY,
    'postalCode' => APEX_ADDRESS_POSTAL_CODE,
    'addressCountry' => APEX_ADDRESS_COUNTRY,
  ],
  'areaServed' => ['Austria', 'Germany', 'Switzerland'],
  // Hair transplantation is a surgical/reconstructive procedure, not a skin
  // condition — PlasticSurgery is schema.org's actual MedicalSpecialty enum
  // member for this (there's no dedicated "hair restoration" value), and it
  // matches the site's own "Plastic Surgeon Supervised" copy elsewhere.
  'medicalSpecialty' => 'https://schema.org/PlasticSurgery',
  'availableService' => [
    '@type' => 'MedicalProcedure',
    'name' => 'Hair Transplantation',
  ],
  'employee' => [
    '@type' => 'Physician',
    'name' => APEX_PHYSICIAN_NAME,
    'medicalSpecialty' => 'https://schema.org/PlasticSurgery',
    'url' => rtrim(APEX_SITE_URL, '/') . '/doctor.php',
  ],
  'sameAs' => [
    'https://www.facebook.com/profile.php?id=61583751883465',
    'https://www.instagram.com/apex_beauty_',
  ],
]; ?>
<script type="application/ld+json"><?= json_encode($medicalClinicSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php endif; ?>
<nav class="nav <?= $siteHeaderMode === 'full' ? 'nav-full' : 'nav-simple' ?>">
  <a class="logo-lockup" href="<?= htmlspecialchars($siteHomeHref, ENT_QUOTES) ?>" aria-label="Apex Beauty Home">
    <img class="lotus" src="/assets/lotus-transparent.png" alt="Apex Beauty">
    <img class="wordmark" src="/assets/wordmark-transparent.png" alt="Apex Beauty">
  </a>

<?php if ($siteHeaderMode === 'full'): ?>
  <div class="nav-collapse">
    <div class="nav-links">
      <a href="<?= htmlspecialchars($siteLangBase, ENT_QUOTES) ?>/service-hair-transplant" data-de="Verfahren" data-en="Procedures" data-fr="Procédures" data-nl="Procedures" data-it="Procedure" data-tr="İşlemler">Verfahren</a>
      <a href="<?= htmlspecialchars($siteSectionBase, ENT_QUOTES) ?>#before-after" data-de="Vorher-Nachher" data-en="Before &amp; after" data-fr="Avant/après" data-nl="Voor en na" data-it="Prima e dopo" data-tr="Öncesi ve Sonrası">Vorher-Nachher</a>
      <a href="<?= htmlspecialchars($siteLangBase, ENT_QUOTES) ?>/doctor" data-de="Ärzte" data-en="Doctors" data-fr="Médecins" data-nl="Artsen" data-it="Medici" data-tr="Doktorlar">Ärzte</a>
      <a href="<?= htmlspecialchars($siteLangBase, ENT_QUOTES) ?>/prices" data-de="Preise" data-en="Prices" data-fr="Tarifs" data-nl="Prijzen" data-it="Prezzi" data-tr="Fiyatlar">Preise</a>
      <a href="<?= htmlspecialchars($siteLangBase, ENT_QUOTES) ?>/hairpedia" data-de="Hairpedia" data-en="Hairpedia">Hairpedia</a>
      <a href="<?= htmlspecialchars($siteSectionBase, ENT_QUOTES) ?>#network" data-de="Unser Netzwerk" data-en="Our Network" data-fr="Notre réseau" data-nl="Ons netwerk" data-it="La nostra rete" data-tr="Ağımız">Unser Netzwerk</a>
      <a href="<?= htmlspecialchars($siteSectionBase, ENT_QUOTES) ?>#faq" data-de="FAQ" data-en="FAQ">FAQ</a>
    </div>
    <a href="#" class="cta-btn nav-drop-cta" onclick="openConsult(event)" data-de="Kontakt aufnehmen" data-en="Get in Touch" data-fr="Nous contacter" data-nl="Neem contact op" data-it="Contattaci" data-tr="Bize Ulaşın">Kontakt aufnehmen</a>
  </div>
  <div class="nav-right">
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
    <a href="#" class="cta-btn" onclick="openConsult(event)" data-de="Kontakt aufnehmen" data-en="Get in Touch" data-fr="Nous contacter" data-nl="Neem contact op" data-it="Contattaci" data-tr="Bize Ulaşın">Kontakt aufnehmen</a>
  </div>
  <button type="button" class="nav-hamburger" id="navHamburger" aria-label="Menu" aria-expanded="false">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
  </button>
<?php else: ?>
  <div class="nav-links">
    <a href="<?= htmlspecialchars($siteLangBase, ENT_QUOTES) ?>/service-hair-transplant" class="<?= $siteActivePage === 'service' ? 'active' : '' ?>" data-de="Verfahren" data-en="Procedures" data-fr="Procédures" data-nl="Procedures" data-it="Procedure" data-tr="İşlemler">Verfahren</a>
    <a href="<?= htmlspecialchars($siteSectionBase, ENT_QUOTES) ?>#before-after" data-de="Vorher-Nachher" data-en="Before &amp; after" data-fr="Avant/après" data-nl="Voor en na" data-it="Prima e dopo" data-tr="Öncesi ve Sonrası">Vorher-Nachher</a>
    <a href="<?= htmlspecialchars($siteLangBase, ENT_QUOTES) ?>/doctor" class="<?= $siteActivePage === 'doctor' ? 'active' : '' ?>" data-de="Ärzte" data-en="Doctors" data-fr="Médecins" data-nl="Artsen" data-it="Medici" data-tr="Doktorlar">Ärzte</a>
    <a href="<?= htmlspecialchars($siteLangBase, ENT_QUOTES) ?>/prices" class="<?= $siteActivePage === 'prices' ? 'active' : '' ?>" data-de="Preise" data-en="Prices" data-fr="Tarifs" data-nl="Prijzen" data-it="Prezzi" data-tr="Fiyatlar">Preise</a>
    <a href="<?= htmlspecialchars($siteLangBase, ENT_QUOTES) ?>/hairpedia" class="<?= $siteActivePage === 'hairpedia' ? 'active' : '' ?>" data-de="Hairpedia" data-en="Hairpedia">Hairpedia</a>
    <a href="<?= htmlspecialchars($siteSectionBase, ENT_QUOTES) ?>#faq" data-de="FAQ" data-en="FAQ">FAQ</a>
  </div>
  <div class="nav-right">
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
    <a href="#" class="cta-btn" onclick="openConsult(event)" data-de="Kostenlose Beratung" data-en="Free consultation" data-fr="Consultation gratuite" data-nl="Gratis consult" data-it="Consulto gratuito" data-tr="Ücretsiz Danışma">Kostenlose Beratung</a>
  </div>
<?php endif; ?>
</nav>

<?php if (!defined('APEX_SITE_HEADER_SCRIPT_EMITTED')): ?>
<?php define('APEX_SITE_HEADER_SCRIPT_EMITTED', true); ?>
<script>
  (function () {
    var nav = document.querySelector('.nav.nav-full');
    var navHamburger = document.getElementById('navHamburger');
    if (!nav || !navHamburger || navHamburger.dataset.bound === '1') return;

    navHamburger.dataset.bound = '1';
    navHamburger.addEventListener('click', function () {
      var isOpen = nav.classList.toggle('nav-open');
      navHamburger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  })();

  // Language pill: click to drop the language list down, click a language or
  // click outside to close it again. applyLang() itself (which swaps the
  // actual text and updates .active/.lang-switch-current) lives per-page.
  (function () {
    document.querySelectorAll('.lang-switch').forEach(function (ls) {
      var toggle = ls.querySelector('.lang-switch-toggle');
      if (!toggle || ls.dataset.bound === '1') return;
      ls.dataset.bound = '1';
      toggle.addEventListener('click', function (e) {
        e.stopPropagation();
        var isOpen = ls.classList.toggle('open');
        toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      });
    });
    document.addEventListener('click', function (e) {
      document.querySelectorAll('.lang-switch.open').forEach(function (ls) {
        if (ls.contains(e.target)) return;
        ls.classList.remove('open');
        var t = ls.querySelector('.lang-switch-toggle');
        if (t) t.setAttribute('aria-expanded', 'false');
      });
    });
    document.addEventListener('keydown', function (e) {
      if (e.key !== 'Escape') return;
      document.querySelectorAll('.lang-switch.open').forEach(function (ls) {
        ls.classList.remove('open');
        var t = ls.querySelector('.lang-switch-toggle');
        if (t) t.setAttribute('aria-expanded', 'false');
      });
    });
  })();
</script>
<?php endif; ?>
