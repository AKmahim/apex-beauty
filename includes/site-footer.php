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
      display: flex; align-items: center; justify-content: space-between; gap: 16px;
    }
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
      .footer-inner { flex-direction: column; text-align: center; }
    }
  </style>
  <?php
}
?>
<footer class="site-footer">
  <div class="footer-inner">
    <p class="footer-copy">&copy; <span id="footerYear"></span> <span data-de="Apex Beauty. Alle Rechte vorbehalten." data-en="Apex Beauty. All rights reserved.">Apex Beauty. All rights reserved.</span></p>
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
</footer>
<script>document.getElementById('footerYear').textContent = new Date().getFullYear();</script>
