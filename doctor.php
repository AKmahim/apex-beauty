<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/site-config.php';
$seoTitle = APEX_PHYSICIAN_NAME . ', Ihr Facharzt für Haartransplantation | Apex Beauty';
$seoDescription = 'Lernen Sie ' . APEX_PHYSICIAN_NAME . ' kennen, verantwortlich für die medizinische Qualität jeder Haartransplantation bei Apex Beauty.';
$seoCanonicalPath = 'doctor';
$physicianSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Physician',
    'name' => APEX_PHYSICIAN_NAME,
    'medicalSpecialty' => 'https://schema.org/PlasticSurgery',
    'url' => rtrim(APEX_SITE_URL, '/') . '/doctor.php',
    'worksFor' => ['@type' => 'MedicalClinic', 'name' => APEX_BUSINESS_NAME, 'url' => APEX_SITE_URL],
];
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
    padding: 72px 48px 64px;
    background: #ffffff;
  }
  .dr-hero-bg {
    position: absolute; inset: 0;
    background-image:
      radial-gradient(circle at 12% 15%, rgba(125,211,252,0.36) 0%, transparent 45%),
      radial-gradient(circle at 92% 8%, rgba(94,185,224,0.3) 0%, transparent 50%),
      radial-gradient(circle at 78% 95%, rgba(45,212,191,0.18) 0%, transparent 45%);
  }
  .dr-hero-inner {
    position: relative; z-index: 1; max-width: 1040px; margin: 0 auto;
    display: grid; grid-template-columns: 260px 1fr; gap: 48px; align-items: center;
  }
  /* Gradient-ring avatar with a "verified physician" badge, standing in
     until a real photo is uploaded via the admin panel's Doctor page >
     Physician profile > Photo field. That sets data-cmedia; this frame's
     placeholder disappears automatically once an image is present (see
     [data-cmedia-wrap].has-media below). */
  .dr-photo-frame {
    position: relative; width: 240px; height: 240px; border-radius: 50%;
    padding: 6px; flex-shrink: 0;
    background: linear-gradient(145deg, var(--teal-400), var(--blue-600));
    box-shadow: 0 26px 56px -18px rgba(37,99,235,0.45), 0 10px 24px -10px rgba(20,40,60,0.25);
  }
  .dr-photo-inner {
    position: relative; width: 100%; height: 100%; border-radius: 50%;
    overflow: hidden; border: 4px solid #ffffff;
    background: linear-gradient(160deg, #eaf4ff 0%, #cfe4fb 60%, #b8d7f5 100%);
    display: flex; align-items: center; justify-content: center;
  }
  .dr-photo-inner img { width: 100%; height: 100%; object-fit: cover; display: none; position: absolute; inset: 0; }
  .dr-photo-frame.has-media .dr-photo-inner img { display: block; }
  .dr-photo-placeholder { text-align: center; padding: 0 20px; }
  .dr-photo-frame.has-media .dr-photo-placeholder { display: none; }
  .dr-photo-monogram {
    font-family: 'Urbanist', -apple-system, sans-serif;
    font-size: 46px; font-weight: 700; color: var(--blue-700); line-height: 1;
    margin-bottom: 8px;
  }
  .dr-photo-placeholder span { display: block; font-size: 11px; color: var(--ink-soft); font-weight: 600; }
  .dr-hero-text .eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 700; color: #1d2f3d;
    background: rgba(255,255,255,0.65); border: 1px solid rgba(255,255,255,0.9);
    padding: 6px 14px; border-radius: 999px; margin-bottom: 18px;
    backdrop-filter: blur(16px) saturate(1.5);
    box-shadow: 0 6px 16px -8px rgba(20,40,60,0.25);
  }
  .dr-hero-text .eyebrow .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--teal-500); }
  .dr-hero-text h1 {
    font-family: 'Urbanist', -apple-system, sans-serif;
    font-size: 40px; line-height: 1.14; font-weight: 700; letter-spacing: -0.015em;
    color: var(--ink); margin-bottom: 6px;
  }
  .dr-hero-text .dr-credentials {
    display: inline-block; font-size: 14.5px; font-weight: 700;
    background: linear-gradient(100deg, var(--teal-600), var(--blue-700));
    -webkit-background-clip: text; background-clip: text; color: transparent;
    margin-bottom: 16px;
  }
  .dr-hero-text .dr-intro { font-size: 16px; line-height: 1.65; color: var(--ink-soft); margin-bottom: 28px; max-width: 580px; }

  @media (max-width: 720px) {
    .dr-hero { padding: 44px 20px 44px; }
    .dr-hero-inner { grid-template-columns: 1fr; text-align: center; gap: 24px; }
    .dr-photo-frame { width: 180px; height: 180px; margin: 0 auto; }
    .dr-photo-monogram { font-size: 36px; }
    .dr-hero-text h1 { font-size: 30px; }
    .dr-hero-text .dr-intro { margin: 0 auto 28px; }
  }

  /* ---- BIO ---- */
  .dr-section-wrap { padding: 8px 48px 8px; }
  .dr-section {
    max-width: 900px; margin: 0 auto; padding: 40px 44px;
    border-radius: 24px; position: relative; overflow: hidden;
    background: rgba(255,255,255,0.5);
    border: 1px solid rgba(255,255,255,0.85);
    backdrop-filter: blur(24px) saturate(1.9);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.8), 0 20px 44px -26px rgba(37,99,235,0.28);
  }
  .dr-section::before { content: ''; position: absolute; inset: 0; border-radius: 24px; background: linear-gradient(160deg, rgba(255,255,255,0.6), transparent 55%); pointer-events: none; }
  .dr-section-head { position: relative; z-index: 1; display: flex; align-items: center; gap: 14px; margin-bottom: 18px; }
  .dr-section-ico {
    flex-shrink: 0; width: 44px; height: 44px; border-radius: 14px;
    background: linear-gradient(135deg, var(--teal-500), var(--blue-600));
    display: flex; align-items: center; justify-content: center; color: #fff;
    box-shadow: 0 10px 22px -8px rgba(37,99,235,0.45);
  }
  .dr-section-ico svg { width: 22px; height: 22px; }
  .dr-section h2 { position: relative; z-index: 1; font-size: 23px; font-weight: 700; color: var(--ink); }
  .dr-bio { position: relative; z-index: 1; }
  .dr-bio p { font-size: 15.5px; line-height: 1.75; color: var(--ink-soft); margin-bottom: 14px; }
  .dr-bio p:last-child { margin-bottom: 0; }
  @media (max-width: 720px) {
    .dr-section-wrap { padding: 0 20px; }
    .dr-section { padding: 28px 22px; border-radius: 20px; }
    /* Same treatment as the specialty cards below: icon centered above the
       heading, not side-by-side pinned to the left with empty space next
       to it. The bio paragraphs below center too, since there's no
       left-starting icon to anchor them left. */
    .dr-section-head { flex-direction: column; align-items: center; text-align: center; gap: 10px; }
    .dr-bio { text-align: center; }
  }

  /* ---- SPECIALTIES ---- */
  .dr-specialties-wrap { padding: 56px 48px 8px; }
  .dr-specialties-inner { max-width: 1000px; margin: 0 auto; }
  .dr-specialties-inner .dr-kicker { display: block; text-align: center; font-size: 12.5px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--teal-700); margin-bottom: 8px; }
  .dr-specialties-inner h2 { font-size: 24px; font-weight: 700; color: var(--ink); margin-bottom: 28px; text-align: center; }
  .dr-specialties { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
  .dr-specialty {
    position: relative; overflow: hidden;
    background: rgba(255,255,255,0.55);
    border: 1px solid rgba(255,255,255,0.9);
    border-radius: 18px; padding: 26px 22px;
    backdrop-filter: blur(20px) saturate(1.8);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.85), 0 14px 30px -18px rgba(37,99,235,0.3);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .dr-specialty::before { content: ''; position: absolute; inset: 0; border-radius: 18px; background: linear-gradient(160deg, rgba(255,255,255,0.6), transparent 50%); pointer-events: none; }
  .dr-specialty:hover { transform: translateY(-4px); box-shadow: inset 0 1px 0 rgba(255,255,255,0.9), 0 22px 40px -18px rgba(37,99,235,0.4); }
  .dr-specialty-ico {
    position: relative; z-index: 1;
    width: 48px; height: 48px; border-radius: 14px; margin-bottom: 14px;
    background: linear-gradient(135deg, var(--teal-500), var(--blue-600));
    display: flex; align-items: center; justify-content: center; color: #fff;
    box-shadow: 0 10px 22px -8px rgba(37,99,235,0.45);
  }
  .dr-specialty-ico svg { width: 24px; height: 24px; }
  .dr-specialty b { position: relative; z-index: 1; display: block; font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 6px; }
  /* .dr-specialty-ico is also a <span>, so this needs to out-specify the
     icon's own color:#fff rule above (".dr-specialty span" alone would
     otherwise win on specificity and grey out the icon). */
  .dr-specialty .dr-specialty-desc { position: relative; z-index: 1; display: block; font-size: 13px; line-height: 1.5; color: var(--ink-soft); }
  @media (max-width: 720px) {
    .dr-specialties-wrap { padding: 40px 20px 8px; }
    .dr-specialties { grid-template-columns: 1fr; }
    /* Icon, then headline, then text — all centered. Left-aligned reads
       fine in a 3-column grid but looks lopsided once each card is its own
       full-width row. */
    .dr-specialty { text-align: center; display: flex; flex-direction: column; align-items: center; }
    .dr-specialty-ico { margin: 0 auto 14px; }
  }

  .dr-cta-wrap {
    max-width: 900px; margin: 56px auto 64px; padding: 40px 44px;
    border-radius: 24px; text-align: center; position: relative; overflow: hidden;
    background: linear-gradient(135deg, rgba(14,165,233,0.12), rgba(37,99,235,0.14));
    border: 1px solid rgba(255,255,255,0.85);
  }
  .dr-cta-wrap h2 { font-size: 22px; font-weight: 700; color: var(--ink); margin-bottom: 8px; }
  .dr-cta-wrap p { font-size: 14.5px; color: var(--ink-soft); margin-bottom: 20px; }
  @media (max-width: 720px) { .dr-cta-wrap { margin: 40px 20px 48px; padding: 32px 22px; } }
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
      <div class="dr-photo-inner">
        <img data-cmedia="hero.photo" alt="<?= htmlspecialchars(APEX_PHYSICIAN_NAME, ENT_QUOTES) ?>">
        <div class="dr-photo-placeholder">
          <div class="dr-photo-monogram">HB</div>
          <span data-de="Foto folgt in Kürze" data-en="Photo coming soon">Foto folgt in Kürze</span>
        </div>
      </div>
    </div>
    <div class="dr-hero-text">
      <span class="eyebrow"><span class="dot"></span><span data-de="Ihr Facharzt" data-en="Your Physician">Ihr Facharzt</span></span>
      <h1 data-ckey="hero.name" data-de="Dr. Huseyin Burhan" data-en="Dr. Huseyin Burhan">Dr. Huseyin Burhan</h1>
      <p class="dr-credentials" data-ckey="hero.credentials" data-de="Facharzt für Haartransplantation" data-en="Hair Transplant Specialist">Facharzt für Haartransplantation</p>
      <div class="dr-intro" data-ckey="hero.intro" data-de="Verantwortlich für die medizinische Qualität jeder Behandlung bei Apex Beauty: von der ersten Kopfhaut-Analyse bis zur langfristigen Nachsorge." data-en="Responsible for the medical quality of every Apex Beauty treatment: from the first scalp analysis through long-term aftercare.">Verantwortlich für die medizinische Qualität jeder Behandlung bei Apex Beauty: von der ersten Kopfhaut-Analyse bis zur langfristigen Nachsorge.</div>
      <?php
      // Dr. Burhan's direct phone number and the clinic WhatsApp chip both
      // stay available (site-config.php / the floating WhatsApp button
      // site-wide) but are intentionally not duplicated here in the hero.
      ?>
      <a href="contact.php" class="cta-btn" data-de="Termin bei Apex Beauty anfragen" data-en="Request an appointment">Termin bei Apex Beauty anfragen</a>
    </div>
  </div>
</section>

<div class="dr-section-wrap">
  <section class="dr-section">
    <div class="dr-section-head">
      <span class="dr-section-ico" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
      <h2 data-de="Über Dr. Burhan" data-en="About Dr. Burhan">Über Dr. Burhan</h2>
    </div>
    <div class="dr-bio" data-ckey="hero.bio" data-de="&lt;p&gt;Dr. Huseyin Burhan &uuml;berwacht die medizinische Planung und Durchf&uuml;hrung der Haartransplantationen bei Apex Beauty. Jeder Fall beginnt mit einer individuellen Kopfhaut-Analyse, auf deren Grundlage Behandlungsplan, Graft-Anzahl und Haarlinien-Design festgelegt werden.&lt;/p&gt;&lt;p&gt;Sein Ansatz stellt eine durchgehende Betreuung in den Mittelpunkt: von der Beratung in &Ouml;sterreich &uuml;ber die Behandlung in der Partnerklinik in der T&uuml;rkei bis zur Nachsorge in &Ouml;sterreich, Deutschland und der Schweiz.&lt;/p&gt;" data-en="&lt;p&gt;Dr. Huseyin Burhan oversees the medical planning and execution of hair transplants at Apex Beauty. Every case begins with an individual scalp analysis, which forms the basis for the treatment plan, graft count, and hairline design.&lt;/p&gt;&lt;p&gt;His approach centers on continuous care: from consultation in Austria, through treatment at the partner clinic in Turkey, to aftercare across Austria, Germany, and Switzerland.&lt;/p&gt;">
      <p>Dr. Huseyin Burhan überwacht die medizinische Planung und Durchführung der Haartransplantationen bei Apex Beauty. Jeder Fall beginnt mit einer individuellen Kopfhaut-Analyse, auf deren Grundlage Behandlungsplan, Graft-Anzahl und Haarlinien-Design festgelegt werden.</p>
      <p>Sein Ansatz stellt eine durchgehende Betreuung in den Mittelpunkt: von der Beratung in Österreich über die Behandlung in der Partnerklinik in der Türkei bis zur Nachsorge in Österreich, Deutschland und der Schweiz.</p>
    </div>
  </section>
</div>

<section class="dr-specialties-wrap">
  <div class="dr-specialties-inner">
    <span class="dr-kicker" data-de="Warum Dr. Burhan" data-en="Why Dr. Burhan">Warum Dr. Burhan</span>
    <h2 data-ckey="specialties.heading" data-de="Schwerpunkte" data-en="Areas of focus">Schwerpunkte</h2>
    <div class="dr-specialties">
      <div class="dr-specialty">
        <span class="dr-specialty-ico" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4.5"/><circle cx="12" cy="12" r="0.8" fill="currentColor"/></svg></span>
        <b data-de="Individuelles Haarlinien-Design" data-en="Personalized hairline design">Individuelles Haarlinien-Design</b>
        <span class="dr-specialty-desc" data-de="Jede Haarlinie wird an Gesichtsform und natürlichen Haarwuchs angepasst." data-en="Every hairline is planned around facial structure and natural growth patterns.">Jede Haarlinie wird an Gesichtsform und natürlichen Haarwuchs angepasst.</span>
      </div>
      <div class="dr-specialty">
        <span class="dr-specialty-ico" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg></span>
        <b data-de="Kopfhaut-Analyse" data-en="Scalp analysis">Kopfhaut-Analyse</b>
        <span class="dr-specialty-desc" data-de="Grundlage für Behandlungsplan, Graft-Anzahl und erwartetes Ergebnis." data-en="The basis for the treatment plan, graft count, and expected outcome.">Grundlage für Behandlungsplan, Graft-Anzahl und erwartetes Ergebnis.</span>
      </div>
      <div class="dr-specialty">
        <span class="dr-specialty-ico" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21c-4-2.5-8-6-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 5-4 8.5-8 11z"/></svg></span>
        <b data-de="Durchgehende Betreuung" data-en="Continuous care">Durchgehende Betreuung</b>
        <span class="dr-specialty-desc" data-de="Von der Beratung über die Behandlung bis zur Nachsorge in AT · DE · CH." data-en="From consultation through treatment to aftercare across AT · DE · CH.">Von der Beratung über die Behandlung bis zur Nachsorge in AT · DE · CH.</span>
      </div>
    </div>
  </div>
</section>

<div class="dr-cta-wrap">
  <h2 data-de="Bereit für den ersten Schritt?" data-en="Ready for the first step?">Bereit für den ersten Schritt?</h2>
  <p data-de="Sichern Sie sich eine kostenlose, unverbindliche Beratung." data-en="Get a free, no-obligation consultation.">Sichern Sie sich eine kostenlose, unverbindliche Beratung.</p>
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
