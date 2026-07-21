<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/site-config.php';
$seoTitle = APEX_PHYSICIAN_NAME . ' – Ihr Facharzt für Haartransplantation | Apex Beauty';
$seoDescription = 'Lernen Sie ' . APEX_PHYSICIAN_NAME . ' kennen, verantwortlich für die medizinische Qualität jeder Haartransplantation bei Apex Beauty.';
$seoCanonicalPath = 'doctor';
$physicianSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Physician',
    'name' => APEX_PHYSICIAN_NAME,
    'medicalSpecialty' => 'https://schema.org/Dermatology',
    'url' => rtrim(APEX_SITE_URL, '/') . '/doctor.php',
    'worksFor' => ['@type' => 'MedicalClinic', 'name' => APEX_BUSINESS_NAME, 'url' => APEX_SITE_URL],
];
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($seoTitle, ENT_QUOTES) ?></title>
<?php require __DIR__ . '/includes/site-meta.php'; ?>
<script type="application/ld+json"><?= json_encode($physicianSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
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
      radial-gradient(circle at 20% 90%, rgba(45,212,191,0.22) 0%, transparent 40%);
    background-color: #ffffff;
  }
  a { text-decoration: none; color: inherit; }

  .cta-btn {
    position: relative;
    overflow: hidden;
    background: linear-gradient(100deg, var(--teal-500) 0%, var(--teal-600) 35%, var(--blue-600) 100%);
    color: white;
    font-size: 14px;
    font-weight: 700;
    padding: 12px 24px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.5);
    box-shadow: 0 10px 28px -6px rgba(13,148,136,0.55), 0 4px 14px -4px rgba(37,99,235,0.5), inset 0 1px 0 rgba(255,255,255,0.55);
    transition: transform 0.15s ease, box-shadow 0.15s ease;
    display: inline-block;
  }
  .cta-btn:hover { transform: translateY(-1px); }

  /* ---- WhatsApp floating button ---- */
  .whatsapp-fab {
    position: fixed; bottom: 24px; right: 24px; z-index: 90;
    width: 56px; height: 56px; border-radius: 50%;
    background: #25D366;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 16px 36px -10px rgba(0,0,0,0.38), 0 6px 14px -6px rgba(0,0,0,0.22);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .whatsapp-fab:hover { transform: translateY(-4px) scale(1.07); }
  .whatsapp-fab svg { width: 30px; height: 30px; display: block; }
  @media (max-width: 640px) {
    .whatsapp-fab { bottom: 16px; right: 16px; width: 50px; height: 50px; }
    .whatsapp-fab svg { width: 27px; height: 27px; }
  }

  /* ---- DOCTOR HERO ---- */
  .dr-hero {
    position: relative; overflow: hidden;
    padding: 64px 48px 56px;
    background: #ffffff;
  }
  .dr-hero-bg {
    position: absolute; inset: 0;
    background-image:
      radial-gradient(circle at 12% 15%, rgba(125,211,252,0.32) 0%, transparent 45%),
      radial-gradient(circle at 92% 8%, rgba(94,185,224,0.28) 0%, transparent 50%);
  }
  .dr-hero-inner {
    position: relative; z-index: 1; max-width: 1000px; margin: 0 auto;
    display: grid; grid-template-columns: 220px 1fr; gap: 40px; align-items: center;
  }
  /* Circular dashed placeholder until a real photo is uploaded — swap via
     the admin panel's Doctor page > Physician profile > Photo field, which
     sets data-cmedia and this frame disappears automatically once an image
     is present (see [data-cmedia-wrap].has-media below). */
  .dr-photo-frame {
    position: relative; width: 220px; height: 220px; border-radius: 50%;
    border: 2px dashed rgba(37,99,235,0.4);
    background: linear-gradient(160deg, rgba(224,242,254,0.6), rgba(191,225,250,0.4));
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
  }
  .dr-photo-frame img { width: 100%; height: 100%; object-fit: cover; display: none; }
  .dr-photo-frame.has-media img { display: block; }
  .dr-photo-frame.has-media { border-style: solid; border-color: rgba(255,255,255,0.9); }
  .dr-photo-placeholder { text-align: center; padding: 0 20px; }
  .dr-photo-frame.has-media .dr-photo-placeholder { display: none; }
  .dr-photo-monogram {
    font-family: 'Urbanist', -apple-system, sans-serif;
    font-size: 42px; font-weight: 700; color: var(--blue-700); line-height: 1;
    margin-bottom: 8px;
  }
  .dr-photo-placeholder span { display: block; font-size: 11px; color: var(--ink-soft); font-weight: 600; }
  .dr-hero-text .eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 700; color: #1d2f3d;
    background: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.85);
    padding: 6px 14px; border-radius: 999px; margin-bottom: 16px;
    backdrop-filter: blur(16px) saturate(1.5);
  }
  .dr-hero-text .eyebrow .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--teal-500); }
  .dr-hero-text h1 {
    font-family: 'Urbanist', -apple-system, sans-serif;
    font-size: 34px; line-height: 1.16; font-weight: 700; letter-spacing: -0.01em;
    color: var(--ink); margin-bottom: 4px;
  }
  .dr-hero-text .dr-credentials { font-size: 15px; font-weight: 600; color: var(--teal-700); margin-bottom: 14px; }
  .dr-hero-text .dr-intro { font-size: 15.5px; line-height: 1.6; color: var(--ink-soft); margin-bottom: 20px; max-width: 560px; }
  .dr-contact-chips { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px; }
  .dr-chip {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: 13px; font-weight: 600; color: var(--ink);
    background: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.85);
    padding: 8px 14px; border-radius: 999px;
    backdrop-filter: blur(14px) saturate(1.4);
  }
  .dr-chip svg { width: 15px; height: 15px; color: var(--teal-600); flex-shrink: 0; }

  @media (max-width: 720px) {
    .dr-hero { padding: 40px 20px 40px; }
    .dr-hero-inner { grid-template-columns: 1fr; text-align: center; gap: 20px; }
    .dr-photo-frame { width: 160px; height: 160px; margin: 0 auto; }
    .dr-hero-text .dr-intro { margin: 0 auto 20px; }
    .dr-contact-chips { justify-content: center; }
  }

  /* ---- BIO ---- */
  .dr-section { max-width: 820px; margin: 0 auto; padding: 8px 48px 56px; }
  .dr-section h2 { font-size: 22px; font-weight: 700; color: var(--ink); margin-bottom: 14px; }
  .dr-bio p { font-size: 15px; line-height: 1.7; color: var(--ink-soft); margin-bottom: 14px; }
  @media (max-width: 720px) { .dr-section { padding: 8px 20px 40px; } }

  /* ---- SPECIALTIES ---- */
  .dr-specialties-wrap { background: rgba(224,242,254,0.35); padding: 48px 48px 56px; }
  .dr-specialties-inner { max-width: 1000px; margin: 0 auto; }
  .dr-specialties-inner h2 { font-size: 22px; font-weight: 700; color: var(--ink); margin-bottom: 24px; text-align: center; }
  .dr-specialties { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
  .dr-specialty {
    background: rgba(255,255,255,0.55);
    border: 1px solid rgba(255,255,255,0.85);
    border-radius: 16px; padding: 22px 20px;
    backdrop-filter: blur(20px) saturate(1.8);
  }
  .dr-specialty b { display: block; font-size: 14.5px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
  .dr-specialty span { display: block; font-size: 13px; line-height: 1.5; color: var(--ink-soft); }
  @media (max-width: 720px) {
    .dr-specialties-wrap { padding: 36px 20px 40px; }
    .dr-specialties { grid-template-columns: 1fr; }
  }

  .dr-cta-wrap { text-align: center; padding: 48px 20px 64px; }
  .dr-cta-wrap p { font-size: 14.5px; color: var(--ink-soft); margin-bottom: 18px; }
</style>
</head>
<body data-content-page="doctor">
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

<section class="dr-hero">
  <div class="dr-hero-bg"></div>
  <div class="dr-hero-inner">
    <div class="dr-photo-frame" data-cmedia-wrap>
      <img data-cmedia="hero.photo" alt="<?= htmlspecialchars(APEX_PHYSICIAN_NAME, ENT_QUOTES) ?>">
      <div class="dr-photo-placeholder">
        <div class="dr-photo-monogram">HB</div>
        <span data-de="Foto folgt in Kürze" data-en="Photo coming soon">Foto folgt in Kürze</span>
      </div>
    </div>
    <div class="dr-hero-text">
      <span class="eyebrow"><span class="dot"></span><span data-de="Ihr Facharzt" data-en="Your Physician">Ihr Facharzt</span></span>
      <h1 data-ckey="hero.name" data-de="Dr. Huseyin Burhan" data-en="Dr. Huseyin Burhan">Dr. Huseyin Burhan</h1>
      <p class="dr-credentials" data-ckey="hero.credentials" data-de="Facharzt für Haartransplantation" data-en="Hair Transplant Specialist">Facharzt für Haartransplantation</p>
      <div class="dr-intro" data-ckey="hero.intro" data-de="Verantwortlich für die medizinische Qualität jeder Behandlung bei Apex Beauty – von der ersten Kopfhaut-Analyse bis zur langfristigen Nachsorge." data-en="Responsible for the medical quality of every Apex Beauty treatment — from the first scalp analysis through long-term aftercare.">Verantwortlich für die medizinische Qualität jeder Behandlung bei Apex Beauty – von der ersten Kopfhaut-Analyse bis zur langfristigen Nachsorge.</div>
      <div class="dr-contact-chips">
        <span class="dr-chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.9 17.4a2 2 0 0 1-2.2 1.7 17.6 17.6 0 0 1-7.6-3.2 17.4 17.4 0 0 1-5.3-5.3A17.6 17.6 0 0 1 2.6 3a2 2 0 0 1 1.7-2.2h3a2 2 0 0 1 2 1.7c.1 1 .3 2 .7 2.9a2 2 0 0 1-.4 2.1L8.5 8.6a14 14 0 0 0 5.3 5.3l1.1-1.1a2 2 0 0 1 2.1-.4c.9.4 1.9.6 2.9.7a2 2 0 0 1 1.7 2z"/></svg><?= htmlspecialchars(APEX_PHYSICIAN_PHONE_DISPLAY, ENT_QUOTES) ?> <span style="margin-left:4px">🇺🇸</span></span>
        <a class="dr-chip" href="<?= htmlspecialchars(APEX_WHATSAPP_LINK, ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer">
          <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.35 5.07L2 22l5.1-1.33C8.55 21.5 10.24 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm5.2 14.24c-.22.62-1.28 1.17-1.77 1.24-.45.07-.99.1-1.6-.1-.37-.12-.84-.27-1.44-.53-2.53-1.1-4.18-3.65-4.31-3.82-.13-.17-1.03-1.37-1.03-2.61 0-1.24.65-1.85.88-2.1.22-.25.5-.31.66-.31.17 0 .33 0 .48.01.15.01.36-.06.56.43.22.53.74 1.83.8 1.96.07.13.11.29.02.46-.09.17-.13.27-.26.42-.13.15-.27.33-.39.44-.13.13-.26.27-.11.53.15.26.66 1.09 1.42 1.76.98.87 1.8 1.14 2.06 1.27.26.13.41.11.56-.06.15-.18.63-.74.8-.99.17-.26.34-.21.57-.13.22.09 1.43.67 1.68.79.24.13.4.19.46.29.07.11.07.61-.15 1.24z"/></svg>
          <?= htmlspecialchars(APEX_WHATSAPP_DISPLAY, ENT_QUOTES) ?>
        </a>
      </div>
      <a href="contact.php" class="cta-btn" data-de="Termin bei Apex Beauty anfragen" data-en="Request an appointment">Termin bei Apex Beauty anfragen</a>
    </div>
  </div>
</section>

<section class="dr-section">
  <h2 data-de="Über Dr. Burhan" data-en="About Dr. Burhan">Über Dr. Burhan</h2>
  <div class="dr-bio" data-ckey="hero.bio" data-de="&lt;p&gt;Dr. Huseyin Burhan &uuml;berwacht die medizinische Planung und Durchf&uuml;hrung der Haartransplantationen bei Apex Beauty. Jeder Fall beginnt mit einer individuellen Kopfhaut-Analyse, auf deren Grundlage Behandlungsplan, Graft-Anzahl und Haarlinien-Design festgelegt werden.&lt;/p&gt;&lt;p&gt;Sein Ansatz stellt eine durchgehende Betreuung in den Mittelpunkt: von der Beratung in &Ouml;sterreich &uuml;ber die Behandlung in der Partnerklinik in der T&uuml;rkei bis zur Nachsorge in &Ouml;sterreich, Deutschland und der Schweiz.&lt;/p&gt;" data-en="&lt;p&gt;Dr. Huseyin Burhan oversees the medical planning and execution of hair transplants at Apex Beauty. Every case begins with an individual scalp analysis, which forms the basis for the treatment plan, graft count, and hairline design.&lt;/p&gt;&lt;p&gt;His approach centers on continuous care: from consultation in Austria, through treatment at the partner clinic in Turkey, to aftercare across Austria, Germany, and Switzerland.&lt;/p&gt;">
    <p>Dr. Huseyin Burhan überwacht die medizinische Planung und Durchführung der Haartransplantationen bei Apex Beauty. Jeder Fall beginnt mit einer individuellen Kopfhaut-Analyse, auf deren Grundlage Behandlungsplan, Graft-Anzahl und Haarlinien-Design festgelegt werden.</p>
    <p>Sein Ansatz stellt eine durchgehende Betreuung in den Mittelpunkt: von der Beratung in Österreich über die Behandlung in der Partnerklinik in der Türkei bis zur Nachsorge in Österreich, Deutschland und der Schweiz.</p>
  </div>
</section>

<section class="dr-specialties-wrap">
  <div class="dr-specialties-inner">
    <h2 data-ckey="specialties.heading" data-de="Schwerpunkte" data-en="Areas of focus">Schwerpunkte</h2>
    <div class="dr-specialties" data-clist="specialties.items">
      <div class="dr-specialty" data-citem>
        <b data-cfield="title" data-de="Individuelles Haarlinien-Design" data-en="Personalized hairline design">Individuelles Haarlinien-Design</b>
        <span data-cfield="body" data-de="Jede Haarlinie wird an Gesichtsform und natürlichen Haarwuchs angepasst." data-en="Every hairline is planned around facial structure and natural growth patterns.">Jede Haarlinie wird an Gesichtsform und natürlichen Haarwuchs angepasst.</span>
      </div>
    </div>
  </div>
</section>

<div class="dr-cta-wrap">
  <p data-de="Bereit für den ersten Schritt?" data-en="Ready for the first step?">Bereit für den ersten Schritt?</p>
  <a href="contact.php" class="cta-btn" data-de="Jetzt kostenlose Beratung sichern" data-en="Get your free consultation">Jetzt kostenlose Beratung sichern</a>
</div>

<?php include __DIR__ . '/includes/site-footer.php'; ?>

<a class="whatsapp-fab" href="<?= htmlspecialchars(APEX_WHATSAPP_LINK, ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp" onclick="trackWhatsAppContact()">
  <svg viewBox="0 0 24 24" fill="#ffffff" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.35 5.07L2 22l5.1-1.33C8.55 21.5 10.24 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm5.2 14.24c-.22.62-1.28 1.17-1.77 1.24-.45.07-.99.1-1.6-.1-.37-.12-.84-.27-1.44-.53-2.53-1.1-4.18-3.65-4.31-3.82-.13-.17-1.03-1.37-1.03-2.61 0-1.24.65-1.85.88-2.1.22-.25.5-.31.66-.31.17 0 .33 0 .48.01.15.01.36-.06.56.43.22.53.74 1.83.8 1.96.07.13.11.29.02.46-.09.17-.13.27-.26.42-.13.15-.27.33-.39.44-.13.13-.26.27-.11.53.15.26.66 1.09 1.42 1.76.98.87 1.8 1.14 2.06 1.27.26.13.41.11.56-.06.15-.18.63-.74.8-.99.17-.26.34-.21.57-.13.22.09 1.43.67 1.68.79.24.13.4.19.46.29.07.11.07.61-.15 1.24z"/></svg>
</a>

<script>
  function applyLang(lang) {
    document.documentElement.lang = lang;
    document.querySelectorAll('[data-de]').forEach(function (el) {
      var val = el.getAttribute('data-' + lang);
      if (val !== null) el.innerHTML = val;
    });
    document.querySelectorAll('.lang-switch button').forEach(function (s) {
      var isActive = s.getAttribute('data-lang') === lang;
      s.className = isActive ? 'active' : 'inactive';
    });
  }
  document.querySelectorAll('.lang-switch button').forEach(function (s) {
    s.addEventListener('click', function () { applyLang(s.getAttribute('data-lang')); });
  });

  function trackWhatsAppContact() {
    if (window.__apexPixel) window.__apexPixel.track('Contact');
  }
  if (window.__apexPixel) {
    window.__apexPixel.onActivate(function () {
      window.__apexPixel.track('ViewContent');
    });
  }
</script>

</body>
</html>
