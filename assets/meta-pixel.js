// Meta Pixel — shared base config + consent gate, included by every page
// that needs it (glass-theme.html, hairpedia.html, contact.html,
// privacy.html) via <script src="assets/meta-pixel.js"></script> in <head>.
//
// META_PIXEL_ID IS THE ONLY PLACE THE PIXEL ID LIVES.
// Once a real Pixel ID is issued, replace the placeholder value below —
// no other file needs to change, since every page reads it from here.
const META_PIXEL_ID = 'PENDING_PIXEL_ID'; // TODO: swap in the real Meta Pixel ID when available.

// ---- Consent gate (DSGVO baseline) ----
// The Pixel must not load, set cookies, or send any event until the
// visitor has explicitly opted in to the "marketing" cookie category via
// the consent banner (see assets/cookie-consent.js). Consent choice lives
// in localStorage; read fresh on every page load and again whenever the
// banner changes it at runtime (no reload required).
var APEX_CONSENT_KEY = 'apexConsent';

function apexGetConsent() {
  try {
    return JSON.parse(localStorage.getItem(APEX_CONSENT_KEY) || 'null');
  } catch (e) {
    return null;
  }
}
function apexHasDecided() {
  return apexGetConsent() !== null;
}
function apexHasMarketingConsent() {
  var c = apexGetConsent();
  return !!(c && c.marketing === true);
}

// The stock Meta base snippet — only ever invoked once marketing consent
// exists, so the real fbevents.js (and any cookie it might set) is never
// requested from Meta's servers before that point. This is the strongest
// form of the gate: not just "don't call track", but "don't even load it".
function apexLoadMetaScript() {
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
}

// Callbacks registered via apexOnActivate() that haven't run yet because
// consent wasn't granted at registration time (see below).
var pendingActivationCallbacks = [];

// Loads the script (first time only — fbq no-ops on repeat calls), sends
// Meta's Consent Mode 'grant' signal explicitly, then inits and fires
// PageView. Safe to call again later (e.g. re-granting after a revoke)
// since fbq() itself is idempotent about re-loading the script.
function apexActivatePixel() {
  apexLoadMetaScript();
  fbq('consent', 'grant');
  fbq('init', META_PIXEL_ID);
  fbq('track', 'PageView');
  console.log('[meta-pixel] marketing consent granted — Pixel loaded, Consent Mode grant sent, PageView fired', { pixelId: META_PIXEL_ID, page: window.location.pathname });
  var callbacks = pendingActivationCallbacks;
  pendingActivationCallbacks = [];
  callbacks.forEach(function (cb) { try { cb(); } catch (e) { console.warn('[meta-pixel] onActivate callback failed', e); } });
}

// Runs cb immediately if marketing consent already exists (e.g. granted on
// a previous visit), or queues it to run the moment consent is granted in
// this page view — used by service pages to fire ViewContent exactly like
// PageView already behaves: never before consent, but also never missed if
// consent arrives later via the cookie banner.
function apexOnActivate(cb) {
  if (typeof cb !== 'function') return;
  if (apexHasMarketingConsent()) {
    cb();
  } else {
    pendingActivationCallbacks.push(cb);
  }
}

// Called when consent is revoked after previously being granted in this
// page view (script already loaded). Meta's SDK honors this Consent Mode
// signal by stopping cookie writes / data collection going forward; it
// cannot un-send events already fired before the revoke.
function apexDeactivatePixel() {
  if (typeof fbq === 'function' && fbq.loaded) {
    fbq('consent', 'revoke');
    console.log('[meta-pixel] marketing consent revoked — Consent Mode revoke sent', { pixelId: META_PIXEL_ID });
  }
}

// Persists a consent choice and (de)activates the Pixel to match. This is
// the only place that writes APEX_CONSENT_KEY, called by the cookie banner
// (assets/cookie-consent.js).
function apexSetConsent(marketingGranted) {
  var record = { essential: true, marketing: !!marketingGranted, decidedAt: new Date().toISOString() };
  try { localStorage.setItem(APEX_CONSENT_KEY, JSON.stringify(record)); } catch (e) { /* storage unavailable */ }
  if (record.marketing) {
    apexActivatePixel();
  } else {
    apexDeactivatePixel();
  }
  return record;
}

// Consent-gated event tracker used by each page's own lead-form submission
// and Contact-link click handlers, instead of calling fbq(...) directly —
// this is what guarantees Lead/Contact can never fire pre-consent, and
// never throws even when fbq hasn't been loaded at all yet.
//
// options.eventId, when passed, is forwarded as fbq's eventID so this
// browser-side event and the server-side CAPI event for the same
// submission (see backend/capi.js) share one event_id — that's what lets
// Meta deduplicate them into a single event instead of counting twice.
function apexTrackEvent(eventName, options) {
  options = options || {};
  if (!apexHasMarketingConsent()) {
    console.log('[meta-pixel] skipped ' + eventName + ' — no marketing consent', { pixelId: META_PIXEL_ID, eventId: options.eventId || null });
    return;
  }
  if (typeof fbq !== 'function') {
    console.warn('[meta-pixel] consent granted but Pixel not loaded yet, skipping ' + eventName);
    return;
  }
  console.log('[meta-pixel] tracking ' + eventName, { pixelId: META_PIXEL_ID, eventId: options.eventId || null });
  if (options.eventId) {
    fbq('track', eventName, {}, { eventID: options.eventId });
  } else {
    fbq('track', eventName);
  }
}

if (apexHasMarketingConsent()) {
  apexActivatePixel();
} else {
  console.log('[meta-pixel] no marketing consent yet — Pixel not loaded, no PageView fired', { pixelId: META_PIXEL_ID, page: window.location.pathname });
}

// Exposed for assets/cookie-consent.js (the banner) and for each page's own
// inline script (Lead on form submit, Contact on WhatsApp click).
window.__apexPixel = {
  activate: apexActivatePixel,
  deactivate: apexDeactivatePixel,
  track: apexTrackEvent,
  onActivate: apexOnActivate
};
window.__apexConsent = {
  get: apexGetConsent,
  set: apexSetConsent,
  hasDecided: apexHasDecided,
  hasMarketingConsent: apexHasMarketingConsent
};
