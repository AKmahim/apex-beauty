<?php declare(strict_types=1);

if (!defined('APEX_SITE_FOOTER_STYLE_EMITTED')) {
  define('APEX_SITE_FOOTER_STYLE_EMITTED', true);
  ?>
  <style>
    .site-footer {
      background: #0b1524;
      padding: 28px 48px;
    }
    .footer-inner {
      max-width: 1180px; margin: 0 auto;
      display: flex; flex-direction: column; gap: 18px;
    }
    .footer-main {
      display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;
    }
    .footer-nap { font-size: 13px; color: rgba(226,232,240,0.75); line-height: 1.6; }
    .footer-nap .footer-business-name { font-weight: 700; color: rgba(226,232,240,0.92); margin-bottom: 2px; }
    .footer-nap address { font-style: normal; }
    .footer-whatsapp {
      display: inline-flex; align-items: center; gap: 6px; margin-top: 4px;
      color: rgba(226,232,240,0.75); text-decoration: none; transition: color 0.2s ease;
    }
    .footer-whatsapp:hover, .footer-whatsapp:focus-visible { color: #ffffff; }
    .footer-whatsapp svg { width: 15px; height: 15px; flex-shrink: 0; }
    .footer-bottom { display: flex; align-items: center; justify-content: space-between; gap: 16px; }
    .footer-copy { font-size: 13px; color: rgba(226,232,240,0.6); }
    .footer-social { display: flex; align-items: center; gap: 10px; }
    .footer-social-link {
      width: 38px; height: 38px; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: rgba(226,232,240,0.75);
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.12);
      transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
    }
    .footer-social-link:hover, .footer-social-link:focus-visible {
      color: #ffffff; background: var(--blue-600); border-color: var(--blue-600);
      transform: translateY(-2px);
    }
    .footer-social-link svg { width: 17px; height: 17px; display: block; }

    @media (max-width: 640px) {
      .site-footer { padding: 24px 20px; }
      .footer-main { flex-direction: column; align-items: center; text-align: center; gap: 14px; }
      .footer-bottom { flex-direction: column; text-align: center; }
    }
  </style>
  <?php
}
require_once __DIR__ . '/site-config.php';
?>
<footer class="site-footer">
  <div class="footer-inner">
    <div class="footer-main">
      <div class="footer-nap">
        <p class="footer-business-name"><?= htmlspecialchars(APEX_BUSINESS_LEGAL_NAME, ENT_QUOTES) ?></p>
        <address><?= htmlspecialchars(APEX_ADDRESS_STREET, ENT_QUOTES) ?>, <?= htmlspecialchars(APEX_ADDRESS_POSTAL_CODE, ENT_QUOTES) ?> <?= htmlspecialchars(APEX_ADDRESS_CITY, ENT_QUOTES) ?>, <?= htmlspecialchars(APEX_ADDRESS_COUNTRY_NAME, ENT_QUOTES) ?></address>
        <a class="footer-whatsapp" href="<?= htmlspecialchars(APEX_WHATSAPP_LINK, ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer">
          <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.35 5.07L2 22l5.1-1.33C8.55 21.5 10.24 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm5.2 14.24c-.22.62-1.28 1.17-1.77 1.24-.45.07-.99.1-1.6-.1-.37-.12-.84-.27-1.44-.53-2.53-1.1-4.18-3.65-4.31-3.82-.13-.17-1.03-1.37-1.03-2.61 0-1.24.65-1.85.88-2.1.22-.25.5-.31.66-.31.17 0 .33 0 .48.01.15.01.36-.06.56.43.22.53.74 1.83.8 1.96.07.13.11.29.02.46-.09.17-.13.27-.26.42-.13.15-.27.33-.39.44-.13.13-.26.27-.11.53.15.26.66 1.09 1.42 1.76.98.87 1.8 1.14 2.06 1.27.26.13.41.11.56-.06.15-.18.63-.74.8-.99.17-.26.34-.21.57-.13.22.09 1.43.67 1.68.79.24.13.4.19.46.29.07.11.07.61-.15 1.24z"/></svg>
          <?= htmlspecialchars(APEX_WHATSAPP_DISPLAY, ENT_QUOTES) ?>
        </a>
      </div>
      <div class="footer-social">
        <a class="footer-social-link" href="https://www.facebook.com/profile.php?id=61583751883465" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
          <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.5 21v-7.5h2.5l.4-3h-2.9V8.5c0-.87.24-1.46 1.5-1.46h1.6V4.36C15.85 4.32 15.02 4.25 14.06 4.25c-2.13 0-3.6 1.3-3.6 3.7V10.5H8v3h2.46V21h3.04z"/></svg>
        </a>
        <a class="footer-social-link" href="https://www.instagram.com/apex_beauty_?utm_source=ig_web_button_share_sheet&amp;igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
            <rect x="3.5" y="3.5" width="17" height="17" rx="5"/>
            <circle cx="12" cy="12" r="4.1"/>
            <circle cx="17.1" cy="6.9" r="0.9" fill="currentColor" stroke="none"/>
          </svg>
        </a>
        <a class="footer-social-link" href="#" onclick="return false;" aria-label="YouTube" title="YouTube">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
            <rect x="2.5" y="6" width="19" height="12" rx="4"/>
            <path d="M10.3 9.6l5 2.4-5 2.4v-4.8z" fill="currentColor" stroke="none"/>
          </svg>
        </a>
      </div>
    </div>
    <div class="footer-bottom">
      <p class="footer-copy">&copy; <span id="footerYear"></span> <span data-de="Apex Beauty. Alle Rechte vorbehalten." data-en="Apex Beauty. All rights reserved.">Apex Beauty. All rights reserved.</span></p>
      <a class="footer-copy" href="privacy.php" data-de="Datenschutzerklärung" data-en="Privacy Policy">Datenschutzerklärung</a>
    </div>
  </div>
</footer>
<script>document.getElementById('footerYear').textContent = new Date().getFullYear();</script>
