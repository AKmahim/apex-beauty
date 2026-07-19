<?php declare(strict_types=1);

$siteHeaderMode = $siteHeaderMode ?? 'simple';
$siteActivePage = $siteActivePage ?? '';
$siteHomeHref = $siteHomeHref ?? 'index.php';
$siteSectionBase = $siteSectionBase ?? '';

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
      display: flex;
      font-size: 13px;
      font-weight: 600;
      border: 1px solid rgba(255,255,255,0.6);
      border-radius: 999px;
      overflow: hidden;
      background: rgba(255,255,255,0.25);
      backdrop-filter: blur(10px);
      padding: 3px;
    }
    .lang-switch button { padding: 5px 12px; cursor: pointer; border: none; font: inherit; font-weight: inherit; border-radius: 999px; }
    .lang-switch .active {
      position: relative;
      overflow: hidden;
      background: linear-gradient(100deg, var(--teal-500), var(--blue-600));
      box-shadow: 0 4px 14px -3px rgba(37,99,235,0.6), inset 0 1px 0 rgba(255,255,255,0.55);
      color: white;
    }
    .lang-switch .active::before {
      content: ''; position: absolute; inset: 0;
      background: linear-gradient(180deg, rgba(255,255,255,0.55), transparent 60%);
      pointer-events: none;
    }
    .lang-switch .inactive { color: var(--ink-soft); background: transparent; }
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
      .lang-switch button { padding: 4px 9px; }
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
<nav class="nav <?= $siteHeaderMode === 'full' ? 'nav-full' : 'nav-simple' ?>">
  <a class="logo-lockup" href="<?= htmlspecialchars($siteHomeHref, ENT_QUOTES) ?>" aria-label="Apex Beauty Home">
    <img class="lotus" src="assets/lotus-transparent.png" alt="Apex Beauty">
    <img class="wordmark" src="assets/wordmark-transparent.png" alt="Apex Beauty">
  </a>

<?php if ($siteHeaderMode === 'full'): ?>
  <div class="nav-collapse">
    <div class="nav-links">
      <a href="service-hair-transplant.php" data-de="Verfahren" data-en="Procedures">Verfahren</a>
      <a href="#before-after" data-de="Vorher-Nachher" data-en="Before &amp; after">Vorher-Nachher</a>
      <!-- <a href="#" data-de="Ärzte" data-en="Doctors">Ärzte</a> -->
      <a href="hairpedia.php" data-de="Hairpedia" data-en="Hairpedia">Hairpedia</a>
      <a href="<?= htmlspecialchars($siteSectionBase, ENT_QUOTES) ?>#network" data-de="Unser Netzwerk" data-en="Our Network">Unser Netzwerk</a>
      <a href="<?= htmlspecialchars($siteSectionBase, ENT_QUOTES) ?>#faq" data-de="FAQ" data-en="FAQ">FAQ</a>
    </div>
    <a href="#" class="cta-btn nav-drop-cta" onclick="openConsult(event)" data-de="Kontakt aufnehmen" data-en="Get in Touch">Kontakt aufnehmen</a>
  </div>
  <div class="nav-right">
    <div class="lang-switch">
      <button type="button" class="active" data-lang="de">DE</button>
      <button type="button" class="inactive" data-lang="en">EN</button>
    </div>
    <a href="#" class="cta-btn" onclick="openConsult(event)" data-de="Kontakt aufnehmen" data-en="Get in Touch">Kontakt aufnehmen</a>
  </div>
  <button type="button" class="nav-hamburger" id="navHamburger" aria-label="Menu" aria-expanded="false">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
  </button>
<?php else: ?>
  <div class="nav-links">
    <a href="service-hair-transplant.php" class="<?= $siteActivePage === 'service' ? 'active' : '' ?>" data-de="Verfahren" data-en="Procedures">Verfahren</a>
    <a href="index.php" data-de="Vorher-Nachher" data-en="Before &amp; after">Vorher-Nachher</a>
    <a href="index.php" data-de="Ärzte" data-en="Doctors">Ärzte</a>
    <a href="hairpedia.php" class="<?= $siteActivePage === 'hairpedia' ? 'active' : '' ?>" data-de="Hairpedia" data-en="Hairpedia">Hairpedia</a>
    <a href="index.php#faq" data-de="FAQ" data-en="FAQ">FAQ</a>
  </div>
  <div class="nav-right">
    <div class="lang-switch">
      <button type="button" class="active" data-lang="de">DE</button>
      <button type="button" class="inactive" data-lang="en">EN</button>
    </div>
    <a href="#" class="cta-btn" onclick="openConsult(event)" data-de="Kostenlose Beratung" data-en="Free consultation">Kostenlose Beratung</a>
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
</script>
<?php endif; ?>
