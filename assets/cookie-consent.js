// Cookie consent banner — shared by every page (glass-theme.html,
// hairpedia.html, contact.html, privacy.html) via
// <script src="assets/cookie-consent.js"></script> in <head>, placed right
// after assets/meta-pixel.js so window.__apexConsent / __apexPixel already
// exist by the time this runs.
//
// Renders entirely from JS (no markup duplicated per page). Bilingual text
// uses the same data-de/data-en convention as the rest of the site, so each
// page's existing applyLang() picks it up automatically via its generic
// document.querySelectorAll('[data-de]') pass — no extra wiring needed here.
(function () {
  var STYLE_ID = 'apex-cookie-consent-style';
  var BANNER_ID = 'apexCookieBanner';

  function injectStyle() {
    if (document.getElementById(STYLE_ID)) return;
    var style = document.createElement('style');
    style.id = STYLE_ID;
    style.textContent = [
      '#' + BANNER_ID + '{position:fixed;left:0;right:0;bottom:0;z-index:9999;',
      'display:flex;justify-content:center;padding:16px;',
      'font-family:-apple-system,BlinkMacSystemFont,"Inter","Segoe UI",sans-serif;}',
      '#' + BANNER_ID + ' .acc-card{width:100%;max-width:640px;background:#fff;',
      'border:1px solid #dbe6f2;border-radius:16px;padding:20px 22px;',
      'box-shadow:0 20px 50px -12px rgba(15,32,39,0.28);color:#0f2027;}',
      '#' + BANNER_ID + ' h2{font-size:15px;margin:0 0 6px;font-weight:700;}',
      '#' + BANNER_ID + ' p{font-size:12.5px;line-height:1.55;color:#45596a;margin:0 0 14px;}',
      '#' + BANNER_ID + ' p a{color:#1d4ed8;text-decoration:underline;}',
      '#' + BANNER_ID + ' .acc-row{display:flex;align-items:center;justify-content:space-between;',
      'gap:10px;padding:9px 0;border-top:1px solid #eef3fa;font-size:13px;font-weight:600;}',
      '#' + BANNER_ID + ' .acc-row .acc-desc{font-size:11.5px;font-weight:400;color:#45596a;margin-top:2px;}',
      '#' + BANNER_ID + ' .acc-switch{flex-shrink:0;width:38px;height:22px;border-radius:999px;',
      'position:relative;background:#cbd5e1;transition:background .15s ease;}',
      '#' + BANNER_ID + ' .acc-switch.on{background:#0ea5e9;}',
      '#' + BANNER_ID + ' .acc-switch.locked{opacity:0.55;cursor:not-allowed;}',
      '#' + BANNER_ID + ' .acc-switch:not(.locked){cursor:pointer;}',
      '#' + BANNER_ID + ' .acc-switch .knob{position:absolute;top:2px;left:2px;width:18px;height:18px;',
      'border-radius:50%;background:#fff;transition:left .15s ease;box-shadow:0 1px 3px rgba(0,0,0,0.3);}',
      '#' + BANNER_ID + ' .acc-switch.on .knob{left:18px;}',
      '#' + BANNER_ID + ' .acc-actions{display:flex;gap:10px;margin-top:16px;flex-wrap:wrap;}',
      '#' + BANNER_ID + ' .acc-actions button{flex:1 1 auto;padding:11px 14px;border-radius:10px;',
      'font-size:13px;font-weight:700;cursor:pointer;border:1.5px solid #dbe6f2;}',
      '#' + BANNER_ID + ' .acc-btn-reject{background:#fff;color:#0f2027;}',
      '#' + BANNER_ID + ' .acc-btn-save{background:#fff;color:#0f2027;}',
      '#' + BANNER_ID + ' .acc-btn-accept{background:linear-gradient(100deg,#0ea5e9,#2563eb);',
      'color:#fff;border-color:transparent;}',
      '@media (max-width:480px){#' + BANNER_ID + ' .acc-actions{flex-direction:column;}}'
    ].join('');
    document.head.appendChild(style);
  }

  function bannerHtml(marketingChecked) {
    return (
      '<div class="acc-card">' +
        '<h2 data-de="Cookies &amp; Datenschutz" data-en="Cookies &amp; Privacy">Cookies &amp; Datenschutz</h2>' +
        '<p data-de="Wir verwenden essenzielle Cookies, damit die Website funktioniert, und optionale Marketing-Cookies (Meta Pixel), um die Wirkung unserer Anzeigen zu messen — nur mit Ihrer Zustimmung. Mehr dazu in unserer &lt;a href=&quot;privacy.html&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;Datenschutzerklärung&lt;/a&gt;." ' +
           'data-en="We use essential cookies to run this site, and optional marketing cookies (Meta Pixel) to measure ad performance — only with your consent. More in our &lt;a href=&quot;privacy.html&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;&gt;privacy policy&lt;/a&gt;.">' +
          'Wir verwenden essenzielle Cookies, damit die Website funktioniert, und optionale Marketing-Cookies (Meta Pixel), um die Wirkung unserer Anzeigen zu messen — nur mit Ihrer Zustimmung. Mehr dazu in unserer <a href="privacy.html" target="_blank" rel="noopener noreferrer">Datenschutzerklärung</a>.' +
        '</p>' +
        '<div class="acc-row">' +
          '<div>' +
            '<div data-de="Essenziell" data-en="Essential">Essenziell</div>' +
            '<div class="acc-desc" data-de="Immer aktiv — notwendig, damit die Seite funktioniert." data-en="Always on — required for the site to work.">Immer aktiv — notwendig, damit die Seite funktioniert.</div>' +
          '</div>' +
          '<div class="acc-switch on locked" aria-hidden="true"><span class="knob"></span></div>' +
        '</div>' +
        '<div class="acc-row">' +
          '<div>' +
            '<div data-de="Marketing / Tracking" data-en="Marketing / Tracking">Marketing / Tracking</div>' +
            '<div class="acc-desc" data-de="Meta Pixel — nur mit Ihrer Zustimmung aktiv." data-en="Meta Pixel — only active with your consent.">Meta Pixel — nur mit Ihrer Zustimmung aktiv.</div>' +
          '</div>' +
          '<div class="acc-switch' + (marketingChecked ? ' on' : '') + '" id="apexMarketingSwitch" role="switch" aria-checked="' + (marketingChecked ? 'true' : 'false') + '" tabindex="0"><span class="knob"></span></div>' +
        '</div>' +
        '<div class="acc-actions">' +
          '<button type="button" class="acc-btn-reject" id="apexRejectAll" data-de="Nur essenziell" data-en="Essential only">Nur essenziell</button>' +
          '<button type="button" class="acc-btn-save" id="apexSaveChoices" data-de="Auswahl speichern" data-en="Save choices">Auswahl speichern</button>' +
          '<button type="button" class="acc-btn-accept" id="apexAcceptAll" data-de="Alle akzeptieren" data-en="Accept all">Alle akzeptieren</button>' +
        '</div>' +
      '</div>'
    );
  }

  function closeBanner() {
    var el = document.getElementById(BANNER_ID);
    if (el) el.remove();
  }

  function openBanner() {
    var existing = document.getElementById(BANNER_ID);
    if (existing) return;
    injectStyle();
    var current = window.__apexConsent.get();
    var marketingChecked = !!(current && current.marketing === true);
    var wrap = document.createElement('div');
    wrap.id = BANNER_ID;
    wrap.innerHTML = bannerHtml(marketingChecked);
    document.body.appendChild(wrap);

    var switchEl = document.getElementById('apexMarketingSwitch');
    var toggle = function () {
      switchEl.classList.toggle('on');
      switchEl.setAttribute('aria-checked', switchEl.classList.contains('on') ? 'true' : 'false');
    };
    switchEl.addEventListener('click', toggle);
    switchEl.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle(); }
    });

    document.getElementById('apexAcceptAll').addEventListener('click', function () {
      window.__apexConsent.set(true);
      closeBanner();
    });
    document.getElementById('apexRejectAll').addEventListener('click', function () {
      window.__apexConsent.set(false);
      closeBanner();
    });
    document.getElementById('apexSaveChoices').addEventListener('click', function () {
      window.__apexConsent.set(switchEl.classList.contains('on'));
      closeBanner();
    });

    // Pick up whatever language the page is currently showing (applyLang()
    // re-runs this same query on toggle, so this just handles first paint).
    var lang = document.documentElement.lang || 'de';
    if (lang !== 'de') {
      wrap.querySelectorAll('[data-' + lang + ']').forEach(function (el) {
        var val = el.getAttribute('data-' + lang);
        if (val !== null) el.innerHTML = val;
      });
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    if (!window.__apexConsent.hasDecided()) {
      openBanner();
    }
  });
})();
