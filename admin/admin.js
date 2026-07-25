(function () {
  const API = '/api/admin';
  let page = 1;
  let totalPages = 1;
  const charts = {};

  const COLORS = {
    blue: '#2563eb',
    teal: '#0ea5e9',
    ink: '#45596a',
    line: '#dbe6f2',
    palette: ['#2563eb', '#0ea5e9', '#7c3aed', '#db2777', '#ea580c', '#16a34a', '#64748b', '#eab308']
  };

  const $ = (id) => document.getElementById(id);

  const STATUSES = ['new', 'contacted', 'converted', 'lost'];

  // ---- Admin UI language (this dashboard's own chrome — separate from the
  // site-content language tabs in the Website content panel below). ----
  const I18N = {
    en: {
      'login-sub': 'Leads admin — sign in to continue.',
      'login-error': 'Incorrect password.',
      'login-error-throttled': 'Too many attempts. Please wait and try again.',
      'login-password-ph': 'Admin password',
      'login-submit': 'Sign in',
      'header-title': 'Consultation leads',
      'header-sub': 'Live submissions from the free-consultation form',
      'logout': 'Log out',
      'tab-leads': 'Leads',
      'tab-content': 'Website content',
      'stat-total': 'Total leads',
      'stat-7d': 'Last 7 days',
      'stat-30d': 'Last 30 days',
      'stat-avgday': 'Avg leads / day (7d)',
      'stat-optin': 'Marketing opt-ins',
      'stat-photos': 'With photos uploaded',
      'insights-title': 'Insights',
      'insights-empty': 'Not enough data yet for insights.',
      'suggestions-title': 'Suggestions',
      'suggestions-empty': 'No notable suggestions right now.',
      'forecast-title': 'Forecast',
      'forecast-sub': 'Historical + projected daily leads, next 14 days',
      'forecast-insufficient': 'Not enough history yet for a reliable forecast.',
      'forecast-summary': 'Projected next 30 days: {total} (range {low}–{high}) — {sign}{pct}% vs the last 30 days ({last30}).',
      'forecast-legend-actual': 'Actual',
      'forecast-legend-projected': 'Projected',
      'anomalies-title': 'Anomalies',
      'anomalies-empty': 'No anomalies detected.',
      'anomaly-spike': 'Spike',
      'anomaly-drop': 'Drop',
      'anomaly-scope-day': 'Day',
      'anomaly-scope-source': 'Source',
      'anomaly-scope-procedure': 'Procedure',
      'anomaly-line': '{scope} {label}: {actual} vs usual {baseline}',
      'priority-high': 'High',
      'priority-medium': 'Medium',
      'priority-low': 'Low',
      'kind-risk': 'Risk',
      'kind-opportunity': 'Opportunity',
      'kind-operational': 'Operational',
      'trend-title': 'Leads over time',
      'trend-sub': 'Daily submissions, last 30 days',
      'monthly-title': 'Leads per month',
      'monthly-sub': 'Monthly submissions, last 6 months',
      'bd-procedure': 'By procedure',
      'bd-timing': 'By timing',
      'bd-gender': 'By gender',
      'bd-country': 'By country',
      'bd-source': 'By source (UTM)',
      'bd-therapy': 'By therapy add-on',
      'bd-status': 'By status',
      'search-ph': 'Search name, email, phone…',
      'gender-any': 'Any gender', 'gender-male': 'Male', 'gender-female': 'Female',
      'timing-any': 'Any timing', 'timing-thismonth': 'This month', 'timing-1-3': '1–3 months',
      'timing-3-6': '3–6 months', 'timing-6plus': '6+ months', 'timing-research': 'Just researching',
      'marketing-any': 'Marketing: any', 'marketing-in': 'Opted in', 'marketing-out': 'Not opted in',
      'source-any': 'Any source',
      'status-any': 'Any status', 'status-new': 'New', 'status-contacted': 'Contacted',
      'status-converted': 'Converted', 'status-lost': 'Lost',
      'from-date': 'From date', 'to-date': 'To date',
      'reset-btn': 'Reset', 'export-btn': '⬇ Export CSV',
      'th-submitted': 'Submitted', 'th-name': 'Name', 'th-email': 'Email', 'th-phone': 'Phone',
      'th-country': 'Country', 'th-gender': 'Gender', 'th-procedures': 'Procedures', 'th-therapies': 'Therapies',
      'th-timing': 'Timing', 'th-source': 'Source', 'th-marketing': 'Marketing', 'th-photos': 'Photos', 'th-status': 'Status',
      'empty-state': 'No leads match these filters yet.',
      'prev-page': '← Prev', 'next-page': 'Next →', 'page-info': 'Page {page} of {total}',
      'page-label': 'Page:',
      'content-hint': 'Edits save immediately and appear on the live site on next page load.',
      'yes': 'Yes', 'no': 'No',
      'delete-btn': 'Delete',
      'delete-confirm': 'Delete this lead permanently?',
      'editing-lang': 'Editing',
      'editing-hint': 'Switch languages above to translate this section.',
      'save-section': 'Save section',
      'saved': 'Saved ✓',
      'add-prefix': '+ Add',
      'upload-btn': 'Upload',
      'uploading': 'Uploading…',
      'uploaded': 'Uploaded ✓',
      'upload-failed': 'Upload failed.',
      'choose-file-first': 'Choose a file first.'
    },
    de: {
      'login-sub': 'Leads-Verwaltung – zum Fortfahren anmelden.',
      'login-error': 'Falsches Passwort.',
      'login-error-throttled': 'Zu viele Versuche. Bitte warten und erneut versuchen.',
      'login-password-ph': 'Admin-Passwort',
      'login-submit': 'Anmelden',
      'header-title': 'Beratungsanfragen',
      'header-sub': 'Live-Einsendungen aus dem Beratungsformular',
      'logout': 'Abmelden',
      'tab-leads': 'Leads',
      'tab-content': 'Website-Inhalte',
      'stat-total': 'Leads gesamt',
      'stat-7d': 'Letzte 7 Tage',
      'stat-30d': 'Letzte 30 Tage',
      'stat-avgday': 'Ø Leads/Tag (7T)',
      'stat-optin': 'Marketing-Zustimmungen',
      'stat-photos': 'Mit hochgeladenen Fotos',
      'insights-title': 'Einblicke',
      'insights-empty': 'Noch nicht genug Daten für Einblicke.',
      'suggestions-title': 'Vorschläge',
      'suggestions-empty': 'Derzeit keine nennenswerten Vorschläge.',
      'forecast-title': 'Prognose',
      'forecast-sub': 'Verlauf + prognostizierte tägliche Leads, nächste 14 Tage',
      'forecast-insufficient': 'Noch nicht genug Verlauf für eine verlässliche Prognose.',
      'forecast-summary': 'Prognose nächste 30 Tage: {total} (Bereich {low}–{high}) — {sign}{pct}% gegenüber den letzten 30 Tagen ({last30}).',
      'forecast-legend-actual': 'Tatsächlich',
      'forecast-legend-projected': 'Prognostiziert',
      'anomalies-title': 'Auffälligkeiten',
      'anomalies-empty': 'Keine Auffälligkeiten erkannt.',
      'anomaly-spike': 'Anstieg',
      'anomaly-drop': 'Rückgang',
      'anomaly-scope-day': 'Tag',
      'anomaly-scope-source': 'Quelle',
      'anomaly-scope-procedure': 'Verfahren',
      'anomaly-line': '{scope} {label}: {actual} statt üblich {baseline}',
      'priority-high': 'Hoch',
      'priority-medium': 'Mittel',
      'priority-low': 'Niedrig',
      'kind-risk': 'Risiko',
      'kind-opportunity': 'Chance',
      'kind-operational': 'Organisatorisch',
      'trend-title': 'Leads im Zeitverlauf',
      'trend-sub': 'Tägliche Einsendungen, letzte 30 Tage',
      'monthly-title': 'Leads pro Monat',
      'monthly-sub': 'Monatliche Einsendungen, letzte 6 Monate',
      'bd-procedure': 'Nach Verfahren',
      'bd-timing': 'Nach Zeitpunkt',
      'bd-gender': 'Nach Geschlecht',
      'bd-country': 'Nach Land',
      'bd-source': 'Nach Quelle (UTM)',
      'bd-therapy': 'Nach Zusatztherapie',
      'bd-status': 'Nach Status',
      'search-ph': 'Name, E-Mail, Telefon suchen…',
      'gender-any': 'Alle Geschlechter', 'gender-male': 'Männlich', 'gender-female': 'Weiblich',
      'timing-any': 'Beliebiger Zeitpunkt', 'timing-thismonth': 'Diesen Monat', 'timing-1-3': '1–3 Monate',
      'timing-3-6': '3–6 Monate', 'timing-6plus': '6+ Monate', 'timing-research': 'Nur Recherche',
      'marketing-any': 'Marketing: alle', 'marketing-in': 'Zugestimmt', 'marketing-out': 'Nicht zugestimmt',
      'source-any': 'Beliebige Quelle',
      'status-any': 'Beliebiger Status', 'status-new': 'Neu', 'status-contacted': 'Kontaktiert',
      'status-converted': 'Konvertiert', 'status-lost': 'Verloren',
      'from-date': 'Von Datum', 'to-date': 'Bis Datum',
      'reset-btn': 'Zurücksetzen', 'export-btn': '⬇ CSV exportieren',
      'th-submitted': 'Eingereicht', 'th-name': 'Name', 'th-email': 'E-Mail', 'th-phone': 'Telefon',
      'th-country': 'Land', 'th-gender': 'Geschlecht', 'th-procedures': 'Verfahren', 'th-therapies': 'Therapien',
      'th-timing': 'Zeitpunkt', 'th-source': 'Quelle', 'th-marketing': 'Marketing', 'th-photos': 'Fotos', 'th-status': 'Status',
      'empty-state': 'Keine Leads entsprechen diesen Filtern.',
      'prev-page': '← Zurück', 'next-page': 'Weiter →', 'page-info': 'Seite {page} von {total}',
      'page-label': 'Seite:',
      'content-hint': 'Änderungen werden sofort gespeichert und erscheinen beim nächsten Laden auf der Live-Seite.',
      'yes': 'Ja', 'no': 'Nein',
      'delete-btn': 'Löschen',
      'delete-confirm': 'Diesen Lead endgültig löschen?',
      'editing-lang': 'Bearbeitet wird',
      'editing-hint': 'Oben die Sprache wechseln, um diesen Abschnitt zu übersetzen.',
      'save-section': 'Abschnitt speichern',
      'saved': 'Gespeichert ✓',
      'add-prefix': '+ Hinzufügen:',
      'upload-btn': 'Hochladen',
      'uploading': 'Wird hochgeladen…',
      'uploaded': 'Hochgeladen ✓',
      'upload-failed': 'Upload fehlgeschlagen.',
      'choose-file-first': 'Bitte zuerst eine Datei auswählen.'
    }
  };

  // Schema section/field/list labels come from includes/content-schema.php,
  // which is written in English (plus a few section names that are already
  // German, since they mirror the German-first site copy). This is a
  // translation lookup rather than a schema change, so content-schema.php
  // doesn't need a parallel labelDe key on every single entry.
  const SCHEMA_LABEL_DE = {
    'Homepage': 'Startseite',
    'Hero': 'Hero',
    'Eyebrow line': 'Kurzzeile über der Überschrift',
    'Headline — line 1': 'Überschrift — Zeile 1',
    'Headline — line 2': 'Überschrift — Zeile 2',
    'Subtext': 'Untertext',
    'Primary button': 'Primärer Button',
    'Secondary button': 'Sekundärer Button',
    'Hero video (mobile)': 'Hero-Video (mobil)',
    'Hero video (desktop)': 'Hero-Video (Desktop)',
    'Trust pills': 'Vertrauens-Badges',
    'Trust bar (stat strip)': 'Vertrauensleiste (Statistikband)',
    'Stat 1 label (under patient count)': 'Statistik 1 — Beschriftung (unter Patientenzahl)',
    'Stat 2 label (under review score)': 'Statistik 2 — Beschriftung (unter Bewertung)',
    'Stat 3 unit (e.g. "Years")': 'Statistik 3 — Einheit (z. B. „Jahre“)',
    'Stat 3 label (under years)': 'Statistik 3 — Beschriftung (unter Jahren)',
    'Stat 4 main text (e.g. "Largest Network")': 'Statistik 4 — Haupttext (z. B. „Größtes Netzwerk“)',
    'Stat 4 label': 'Statistik 4 — Beschriftung',
    'Promise / 360° care section': 'Versprechen / 360°-Betreuung',
    'Heading': 'Überschrift',
    'Background video': 'Hintergrundvideo',
    'Before & after (Vorher/Nachher carousel)': 'Vorher/Nachher-Karussell',
    'Heading (line 1)': 'Überschrift (Zeile 1)',
    'Heading (line 2, highlighted)': 'Überschrift (Zeile 2, hervorgehoben)',
    'Cases': 'Fälle',
    'Vorher photo': 'Vorher-Foto',
    'Vorher (line 1)': 'Vorher (Zeile 1)',
    'Vorher (line 2)': 'Vorher (Zeile 2)',
    'Nachher photo': 'Nachher-Foto',
    'Nachher (line 1)': 'Nachher (Zeile 1)',
    'Nachher (line 2)': 'Nachher (Zeile 2)',
    'Aftercare network section': 'Nachsorge-Netzwerk',
    'FAQ': 'FAQ',
    'Questions': 'Fragen',
    'Question': 'Frage',
    'Answer': 'Antwort',
    'Hairpedia': 'Hairpedia',
    'Body text': 'Fließtext',
    'Image': 'Bild',
    'Hair Transplant Service page': 'Seite Haartransplantation',
    'Doctors page': 'Ärzteseite',
    'Doctor profiles': 'Arztprofile',
    'Doctors': 'Ärzte',
    'Photo': 'Foto',
    'Name': 'Name',
    'Title / credentials': 'Titel / Qualifikation',
    'Short intro line': 'Kurze Einleitungszeile',
    'Biography': 'Biografie',
    'Specialties heading (e.g. "Why Dr. Burhan")': 'Schwerpunkte-Überschrift (z. B. „Warum Dr. Burhan“)',
    'Specialty 1 — title': 'Schwerpunkt 1 — Titel',
    'Specialty 1 — description': 'Schwerpunkt 1 — Beschreibung',
    'Specialty 2 — title': 'Schwerpunkt 2 — Titel',
    'Specialty 2 — description': 'Schwerpunkt 2 — Beschreibung',
    'Specialty 3 — title': 'Schwerpunkt 3 — Titel',
    'Specialty 3 — description': 'Schwerpunkt 3 — Beschreibung',
    'Contact / consultation modal': 'Kontakt- / Beratungsformular',
    'Modal intro': 'Formular-Einleitung',
    'Title': 'Titel',
    'Privacy policy': 'Datenschutzerklärung',
    'Page intro': 'Seiteneinleitung',
    'Legal sections': 'Rechtliche Abschnitte',
    'Sections': 'Abschnitte'
  };

  let adminLang = localStorage.getItem('apexAdminLang') || 'en';

  function t(key, vars) {
    let str = (I18N[adminLang] && I18N[adminLang][key]) || I18N.en[key] || key;
    if (vars) Object.keys(vars).forEach((k) => { str = str.replace('{' + k + '}', vars[k]); });
    return str;
  }

  function schemaLabel(str) {
    if (adminLang !== 'de') return str;
    return SCHEMA_LABEL_DE[str] || str;
  }

  function applyAdminLang() {
    document.querySelectorAll('[data-i18n]').forEach((el) => { el.textContent = t(el.getAttribute('data-i18n')); });
    document.querySelectorAll('[data-i18n-ph]').forEach((el) => { el.placeholder = t(el.getAttribute('data-i18n-ph')); });
    document.querySelectorAll('[data-i18n-title]').forEach((el) => { el.title = t(el.getAttribute('data-i18n-title')); });
    document.querySelectorAll('.admin-lang-toggle button').forEach((b) => {
      b.classList.toggle('active', b.dataset.adminLang === adminLang);
    });
    // Re-render whatever dynamic (JS-generated) content is currently
    // visible so it picks up the new language too — static data-i18n
    // elements above are already handled, this just covers JS templates.
    if ($('leadsPanel').style.display !== 'none') {
      loadLeads();
      loadInsights();
      loadForecast();
      loadSuggestions();
    }
    if ($('contentPanel').style.display !== 'none' && currentPage) {
      renderSectionTabs();
      renderSection();
    }
  }

  $('adminLangToggle').addEventListener('click', (e) => {
    const btn = e.target.closest('button[data-admin-lang]');
    if (!btn) return;
    adminLang = btn.dataset.adminLang;
    localStorage.setItem('apexAdminLang', adminLang);
    applyAdminLang();
  });

  function currentFilters() {
    return {
      search: $('fSearch').value.trim(),
      gender: $('fGender').value,
      timing: $('fTiming').value,
      marketingOptIn: $('fMarketing').value,
      utmSource: $('fSource').value,
      status: $('fStatus').value,
      from: $('fFrom').value,
      to: $('fTo').value
    };
  }

  function toQuery(params) {
    const qs = new URLSearchParams();
    for (const [k, v] of Object.entries(params)) {
      if (v) qs.set(k, v);
    }
    return qs.toString();
  }

  async function api(path, options) {
    const res = await fetch(API + path, { credentials: 'same-origin', ...options });
    if (res.status === 401) {
      showLogin();
      throw new Error('Not authenticated');
    }
    return res;
  }

  function showLogin() {
    $('loginScreen').style.display = 'flex';
    $('dashboard').style.display = 'none';
  }

  function showDashboard() {
    $('loginScreen').style.display = 'none';
    $('dashboard').style.display = 'block';
    loadEverything();
  }

  // ---- Login ----
  $('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    $('loginError').style.display = 'none';
    const password = $('loginPassword').value;
    const res = await fetch(API + '/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'same-origin',
      body: JSON.stringify({ password })
    });
    if (!res.ok) {
      $('loginError').textContent = res.status === 429 ? t('login-error-throttled') : t('login-error');
      $('loginError').setAttribute('data-i18n', res.status === 429 ? 'login-error-throttled' : 'login-error');
      $('loginError').style.display = 'block';
      return;
    }
    $('loginPassword').value = '';
    showDashboard();
  });

  $('logoutBtn').addEventListener('click', async () => {
    await fetch(API + '/logout', { method: 'POST', credentials: 'same-origin' });
    showLogin();
  });

  // ---- Charts ----
  function upsertChart(canvasId, config) {
    if (charts[canvasId]) {
      charts[canvasId].data = config.data;
      charts[canvasId].options = config.options;
      charts[canvasId].config.type = config.type;
      charts[canvasId].update();
      return charts[canvasId];
    }
    const ctx = $(canvasId).getContext('2d');
    charts[canvasId] = new Chart(ctx, config);
    return charts[canvasId];
  }

  function renderTrend(dailyTrend) {
    const labels = dailyTrend.map((d) => {
      const dt = new Date(d.date + 'T00:00:00Z');
      return dt.toLocaleDateString(undefined, { month: 'short', day: 'numeric' });
    });
    const data = dailyTrend.map((d) => d.n);
    upsertChart('chTrend', {
      type: 'line',
      data: {
        labels,
        datasets: [{
          data,
          borderColor: COLORS.blue,
          backgroundColor: 'rgba(37,99,235,0.12)',
          fill: true,
          tension: 0.35,
          pointRadius: 0,
          pointHoverRadius: 4,
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { ticks: { maxTicksLimit: 8, color: COLORS.ink, font: { size: 10.5 } }, grid: { display: false } },
          y: { beginAtZero: true, ticks: { precision: 0, color: COLORS.ink, font: { size: 10.5 } }, grid: { color: COLORS.line } }
        }
      }
    });
  }

  function renderMonthlyTrend(monthlyTrend) {
    const labels = (monthlyTrend || []).map((m) => {
      const dt = new Date(m.month + '-01T00:00:00Z');
      return dt.toLocaleDateString(undefined, { month: 'short', year: '2-digit' });
    });
    const data = (monthlyTrend || []).map((m) => m.n);
    upsertChart('chMonthly', {
      type: 'bar',
      data: {
        labels,
        datasets: [{
          data,
          backgroundColor: COLORS.blue,
          borderRadius: 5,
          maxBarThickness: 44
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { ticks: { color: COLORS.ink, font: { size: 11 } }, grid: { display: false } },
          y: { beginAtZero: true, ticks: { precision: 0, color: COLORS.ink, font: { size: 10.5 } }, grid: { color: COLORS.line } }
        }
      }
    });
  }

  function renderBarBreakdown(canvasId, rows) {
    const el = $(canvasId);
    if (!rows || !rows.length) {
      if (charts[canvasId]) { charts[canvasId].destroy(); delete charts[canvasId]; }
      el.getContext('2d').clearRect(0, 0, el.width, el.height);
      return;
    }
    const top = rows.slice(0, 7);
    upsertChart(canvasId, {
      type: 'bar',
      data: {
        labels: top.map((r) => r.key),
        datasets: [{
          data: top.map((r) => r.n),
          backgroundColor: COLORS.teal,
          borderRadius: 4,
          maxBarThickness: 18
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { beginAtZero: true, ticks: { precision: 0, color: COLORS.ink, font: { size: 10.5 } }, grid: { color: COLORS.line } },
          y: { ticks: { color: COLORS.ink, font: { size: 11 } }, grid: { display: false } }
        }
      }
    });
  }

  function renderDonut(canvasId, rows) {
    const el = $(canvasId);
    if (!rows || !rows.length) {
      if (charts[canvasId]) { charts[canvasId].destroy(); delete charts[canvasId]; }
      el.getContext('2d').clearRect(0, 0, el.width, el.height);
      return;
    }
    upsertChart(canvasId, {
      type: 'doughnut',
      data: {
        labels: rows.map((r) => r.key),
        datasets: [{
          data: rows.map((r) => r.n),
          backgroundColor: COLORS.palette,
          borderColor: '#fff',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '62%',
        plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 11 }, color: COLORS.ink } } }
      }
    });
  }

  function renderForecastChart(data) {
    const summaryEl = $('forecastSummary');
    if (!data.enoughHistory) {
      if (charts.chForecast) { charts.chForecast.destroy(); delete charts.chForecast; }
      const el = $('chForecast');
      el.getContext('2d').clearRect(0, 0, el.width, el.height);
      summaryEl.textContent = t('forecast-insufficient');
      return;
    }

    // Trend/seasonality is fit server-side on 8 weeks of history; only the
    // last 30 days are drawn here so the chart stays readable.
    const historyTrim = data.history.slice(-30);
    const fmt = (d) => new Date(d + 'T00:00:00Z').toLocaleDateString(undefined, { month: 'short', day: 'numeric' });
    const labels = historyTrim.map((h) => fmt(h.date)).concat(data.projection.map((p) => fmt(p.date)));

    const actualData = historyTrim.map((h) => h.n).concat(data.projection.map(() => null));
    const projectedData = historyTrim.map(() => null);
    projectedData[historyTrim.length - 1] = historyTrim[historyTrim.length - 1].n; // connects the two lines at "today"
    data.projection.forEach((p) => projectedData.push(p.n));
    const lowData = historyTrim.map(() => null).concat(data.projection.map((p) => p.low));
    const highData = historyTrim.map(() => null).concat(data.projection.map((p) => p.high));

    upsertChart('chForecast', {
      type: 'line',
      data: {
        labels,
        datasets: [
          {
            data: lowData, borderWidth: 0, pointRadius: 0, fill: false, tension: 0.35, showInLegend: false
          },
          {
            data: highData, borderWidth: 0, pointRadius: 0, fill: 0, tension: 0.35,
            backgroundColor: 'rgba(14,165,233,0.16)', showInLegend: false
          },
          {
            label: t('forecast-legend-actual'), data: actualData, borderColor: COLORS.blue,
            backgroundColor: 'transparent', fill: false, tension: 0.35, pointRadius: 0,
            pointHoverRadius: 4, borderWidth: 2
          },
          {
            label: t('forecast-legend-projected'), data: projectedData, borderColor: COLORS.blue,
            backgroundColor: 'transparent', borderDash: [6, 4], fill: false, tension: 0.35,
            pointRadius: 0, pointHoverRadius: 4, borderWidth: 2
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true,
            position: 'bottom',
            labels: {
              boxWidth: 10, font: { size: 11 }, color: COLORS.ink,
              filter: (item, chartData) => chartData.datasets[item.datasetIndex].showInLegend !== false
            }
          }
        },
        scales: {
          x: { ticks: { maxTicksLimit: 10, color: COLORS.ink, font: { size: 10.5 } }, grid: { display: false } },
          y: { beginAtZero: true, ticks: { precision: 0, color: COLORS.ink, font: { size: 10.5 } }, grid: { color: COLORS.line } }
        }
      }
    });

    const changePct = data.changeVsLast30Pct ?? 0;
    summaryEl.textContent = t('forecast-summary', {
      total: data.totalNext30,
      low: data.totalNext30Low,
      high: data.totalNext30High,
      sign: changePct > 0 ? '+' : '',
      pct: changePct,
      last30: data.last30Actual
    });
  }

  function renderSuggestions(list) {
    const el = $('suggestionsList');
    if (!list || !list.length) {
      el.innerHTML = `<li class="suggestions-empty">${escapeHtml(t('suggestions-empty'))}</li>`;
      return;
    }
    el.innerHTML = list.map((s) => `
      <li class="kind-${s.kind} priority-${s.priority}">
        <span class="badge">${escapeHtml(t('priority-' + s.priority))} · ${escapeHtml(t('kind-' + s.kind))}</span>
        <span>${escapeHtml(s.text)}</span>
      </li>
    `).join('');
  }

  function renderAnomalies(list) {
    const el = $('anomaliesList');
    if (!list || !list.length) {
      el.innerHTML = `<li class="anomalies-empty">${escapeHtml(t('anomalies-empty'))}</li>`;
      return;
    }
    el.innerHTML = list.map((a) => `
      <li class="${a.direction}">
        <span class="badge">${escapeHtml(t('anomaly-' + a.direction))}</span>
        <span>${escapeHtml(t('anomaly-line', {
          scope: t('anomaly-scope-' + a.scope), label: a.label, actual: a.actual, baseline: a.baselineMean
        }))}</span>
      </li>
    `).join('');
  }

  function pct(n, total) { return total ? Math.round((n / total) * 100) : 0; }

  function renderDelta(elId, current, previous) {
    const el = $(elId);
    if (!previous) { el.textContent = ''; el.className = 'delta'; return; }
    const change = Math.round(((current - previous) / previous) * 100);
    if (change > 0) { el.textContent = ` ▲${change}%`; el.className = 'delta up'; }
    else if (change < 0) { el.textContent = ` ▼${Math.abs(change)}%`; el.className = 'delta down'; }
    else { el.textContent = ' –'; el.className = 'delta flat'; }
  }

  function populateSourceFilter(rows) {
    const select = $('fSource');
    const current = select.value;
    const options = [`<option value="">${t('source-any')}</option>`]
      .concat((rows || []).map((r) => `<option value="${escapeAttr(r.key)}">${escapeHtml(r.key)} (${r.n})</option>`));
    select.innerHTML = options.join('');
    select.value = current;
  }

  function escapeAttr(str) {
    return String(str ?? '').replace(/"/g, '&quot;');
  }

  async function loadStats() {
    const res = await api('/stats');
    const stats = await res.json();
    $('statTotal').textContent = stats.total;
    $('stat7').textContent = stats.last7Days;
    renderDelta('stat7Delta', stats.last7Days, stats.prev7Days);
    $('stat30').textContent = stats.last30Days;
    $('statAvgDay').textContent = (stats.last7Days / 7).toFixed(1);
    $('statOptIn').textContent = `${stats.marketingOptIns} (${pct(stats.marketingOptIns, stats.total)}%)`;
    $('statPhotos').textContent = `${stats.withPhotos} (${pct(stats.withPhotos, stats.total)}%)`;

    renderTrend(stats.dailyTrend);
    renderMonthlyTrend(stats.monthlyTrend);
    renderBarBreakdown('chProcedure', stats.byProcedure);
    renderBarBreakdown('chTiming', stats.byTiming);
    renderDonut('chGender', stats.byGender);
    renderBarBreakdown('chCountry', stats.byCountry);
    renderBarBreakdown('chSource', stats.byUtmSource);
    renderBarBreakdown('chTherapy', stats.byTherapy);
    renderDonut('chStatus', stats.byStatus);

    populateSourceFilter(stats.byUtmSource);
  }

  async function loadInsights() {
    const res = await api('/insights');
    const data = await res.json();
    const list = $('insightsList');
    if (!data.insights || !data.insights.length) {
      list.innerHTML = `<li class="insufficient">${escapeHtml(t('insights-empty'))}</li>`;
      return;
    }
    list.innerHTML = data.insights.map((i) =>
      `<li class="${i.kind === 'insufficient' ? 'insufficient' : ''}">${escapeHtml(i.text)}</li>`
    ).join('');
  }

  async function loadForecast() {
    const res = await api('/forecast');
    const data = await res.json();
    renderForecastChart(data);
  }

  async function loadSuggestions() {
    const res = await api('/suggestions');
    const data = await res.json();
    renderSuggestions(data.suggestions);
    renderAnomalies(data.anomalies);
  }

  // ---- Leads table ----
  function escapeHtml(str) {
    return String(str ?? '').replace(/[&<>"']/g, (c) => ({
      '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
    }[c]));
  }

  function fmtDate(iso) {
    if (!iso) return '';
    const d = new Date(iso);
    if (Number.isNaN(d.getTime())) return iso;
    return d.toLocaleString(undefined, { dateStyle: 'medium', timeStyle: 'short' });
  }

  function tagsHtml(list) {
    if (!list || !list.length) return '';
    return list.map((tg) => `<span class="tag">${escapeHtml(tg)}</span>`).join('');
  }

  function statusSelectHtml(lead) {
    const current = lead.status || 'new';
    const options = STATUSES.map((s) =>
      `<option value="${s}"${s === current ? ' selected' : ''}>${escapeHtml(t('status-' + s))}</option>`
    ).join('');
    return `<select class="status-select status-${current}" data-id="${lead.id}">${options}</select>`;
  }

  async function loadLeads() {
    const query = toQuery({ ...currentFilters(), page, pageSize: 25 });
    const res = await api('/leads?' + query);
    const data = await res.json();
    totalPages = Math.max(1, Math.ceil(data.total / data.pageSize));
    page = data.page;

    const body = $('leadsBody');
    if (!data.leads.length) {
      body.innerHTML = '';
      $('emptyState').style.display = 'block';
    } else {
      $('emptyState').style.display = 'none';
      body.innerHTML = data.leads.map((lead) => `
        <tr data-id="${lead.id}">
          <td>${fmtDate(lead.submittedAt)}</td>
          <td>${escapeHtml(lead.name)}</td>
          <td>${escapeHtml(lead.email)}</td>
          <td>${escapeHtml(lead.phone)}</td>
          <td>${escapeHtml(lead.country)}</td>
          <td>${escapeHtml(lead.gender)}</td>
          <td>${tagsHtml(lead.procedures)}</td>
          <td>${tagsHtml(lead.therapies)}</td>
          <td>${escapeHtml(lead.timing)}</td>
          <td>${escapeHtml(lead.utm?.source || 'direct')}</td>
          <td>${lead.marketingOptIn ? t('yes') : t('no')}</td>
          <td>${lead.photosUploaded}</td>
          <td>${statusSelectHtml(lead)}</td>
          <td><button class="del-btn" data-id="${lead.id}">${escapeHtml(t('delete-btn'))}</button></td>
        </tr>
      `).join('');
    }
    $('pageInfo').textContent = t('page-info', { page, total: totalPages });
    $('prevPage').disabled = page <= 1;
    $('nextPage').disabled = page >= totalPages;
  }

  $('leadsBody').addEventListener('click', async (e) => {
    const btn = e.target.closest('.del-btn');
    if (!btn) return;
    if (!confirm(t('delete-confirm'))) return;
    await api('/leads/' + btn.dataset.id, { method: 'DELETE' });
    loadLeads();
    loadStats();
  });

  // Status is the one field the clinic team edits directly from here — a
  // plain per-row dropdown, saved immediately on change (no separate save
  // button, since this is meant to be a quick during-the-day update).
  $('leadsBody').addEventListener('change', async (e) => {
    const select = e.target.closest('.status-select');
    if (!select) return;
    const newStatus = select.value;
    const res = await api('/leads/' + select.dataset.id + '/status', {
      method: 'PATCH',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ status: newStatus })
    });
    if (res.ok) {
      select.className = 'status-select status-' + newStatus;
      loadStats();
      loadInsights();
      loadSuggestions();
    }
  });

  $('prevPage').addEventListener('click', () => { if (page > 1) { page--; loadLeads(); } });
  $('nextPage').addEventListener('click', () => { if (page < totalPages) { page++; loadLeads(); } });

  ['fSearch', 'fGender', 'fTiming', 'fMarketing', 'fSource', 'fStatus', 'fFrom', 'fTo'].forEach((id) => {
    const el = $(id);
    const evt = el.tagName === 'INPUT' ? 'input' : 'change';
    el.addEventListener(evt, () => { page = 1; loadLeads(); });
  });

  $('resetBtn').addEventListener('click', () => {
    $('fSearch').value = '';
    $('fGender').value = '';
    $('fTiming').value = '';
    $('fMarketing').value = '';
    $('fSource').value = '';
    $('fStatus').value = '';
    $('fFrom').value = '';
    $('fTo').value = '';
    page = 1;
    loadLeads();
  });

  $('exportBtn').addEventListener('click', () => {
    const query = toQuery(currentFilters());
    window.location.href = API + '/leads-export.csv' + (query ? '?' + query : '');
  });

  function loadEverything() {
    loadStats();
    loadLeads();
    loadInsights();
    loadForecast();
    loadSuggestions();
  }

  // ---- Tabs ----
  let contentLoaded = false;
  document.querySelectorAll('.tab-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.tab-btn').forEach((b) => b.classList.remove('active'));
      btn.classList.add('active');
      const tab = btn.dataset.tab;
      $('leadsPanel').style.display = tab === 'leads' ? 'block' : 'none';
      $('contentPanel').style.display = tab === 'content' ? 'block' : 'none';
      if (tab === 'content' && !contentLoaded) {
        contentLoaded = true;
        loadContent();
      }
    });
  });

  // ---- Website content: generic schema-driven editor ----
  // Every page/section is described in includes/content-schema.php. This
  // renders a form from that schema instead of hand-coding HTML per field,
  // so wiring up a new page/section never touches this file again — only
  // the schema, the content JSON defaults, and the live page's markup do.
  //
  // Layout: a section tab down the left picks which part of the page is
  // being edited (instead of one long scroll of every section stacked),
  // and a language tab row across the top picks which of the site's six
  // languages is currently shown in each field (instead of 2 or 6 inputs
  // stacked per field). Only the active language's value is mounted in the
  // DOM at a time; every other language's text lives in an in-memory model
  // (card.__values / row.__item) that's kept fully in sync via write-through
  // on every keystroke, so switching tabs or saving never loses an edit.
  const CONTENT_LANGS = [
    { code: 'de', label: 'DE' },
    { code: 'en', label: 'EN' },
    { code: 'fr', label: 'FR' },
    { code: 'nl', label: 'NL' },
    { code: 'it', label: 'IT' },
    { code: 'tr', label: 'TR' }
  ];

  let schemaCache = null;
  const sectionState = {}; // sectionState[page][section] = content object as last fetched/saved from the server
  let currentPage = null;
  let currentSectionKey = null;
  let currentContentLang = 'de';

  function emptyLangObj() {
    const o = {};
    CONTENT_LANGS.forEach((l) => { o[l.code] = ''; });
    return o;
  }

  function normalizeLangValue(v) {
    const o = emptyLangObj();
    if (v && typeof v === 'object') CONTENT_LANGS.forEach((l) => { o[l.code] = v[l.code] || ''; });
    return o;
  }

  function makeItemSkeleton(list) {
    if (list.itemType === 'text') return emptyLangObj();
    const item = {};
    list.itemFields.forEach((f) => {
      item[f.key] = (f.type === 'image' || f.type === 'video') ? '' : emptyLangObj();
    });
    return item;
  }

  function normalizeListItem(list, raw) {
    if (list.itemType === 'text') return normalizeLangValue(raw);
    const item = {};
    list.itemFields.forEach((f) => {
      item[f.key] = (f.type === 'image' || f.type === 'video') ? ((raw && raw[f.key]) || '') : normalizeLangValue(raw && raw[f.key]);
    });
    return item;
  }

  function textOrArea(field, dataAttrs, value) {
    // <input> can't hold its value as inner text (only <textarea> can) —
    // richtext fields render as a textarea with the value as content,
    // everything else as an input with the value in the value="" attribute.
    if (field.type === 'richtext') {
      return `<textarea rows="3" ${dataAttrs}>${escapeHtml(value)}</textarea>`;
    }
    return `<input type="text" ${dataAttrs} value="${escapeAttr(value)}">`;
  }

  function siteAssetUrl(path) {
    return '/' + String(path || '').replace(/^\/+/, '');
  }

  function mediaFieldHtml(page, section, field, path) {
    const isVideo = field.type === 'video';
    const previewUrl = path ? siteAssetUrl(path) : '';
    const preview = path
      ? (isVideo ? `<video class="media-preview" src="${escapeAttr(previewUrl)}" muted></video>` : `<img class="media-preview" src="${escapeAttr(previewUrl)}">`)
      : `<div class="media-preview"></div>`;
    return `
      <div class="media-row" data-media-field="${field.key}" data-page="${page}" data-section="${section}">
        <label>${escapeHtml(schemaLabel(field.label))}</label>
        ${preview}
        <input type="file" accept="${isVideo ? 'video/*' : 'image/*'}">
        <button type="button" class="media-upload-btn">${escapeHtml(t('upload-btn'))}</button>
        <span class="media-status"></span>
      </div>`;
  }

  function listItemRowHtml(list, item) {
    if (list.itemType === 'text') {
      return `
        <div class="list-row list-row-text" data-list-item>
          <input type="text" data-item-text value="${escapeAttr(item[currentContentLang] || '')}" placeholder="${escapeAttr(schemaLabel(list.label))}">
          <button type="button" class="list-row-remove" title="Remove">×</button>
        </div>`;
    }
    const rows = list.itemFields.map((f) => {
      if (f.type === 'image' || f.type === 'video') {
        const path = item[f.key] || '';
        const previewUrl = path ? siteAssetUrl(path) : '';
        const preview = path
          ? (f.type === 'video' ? `<video class="media-preview" src="${escapeAttr(previewUrl)}" muted></video>` : `<img class="media-preview" src="${escapeAttr(previewUrl)}">`)
          : `<div class="media-preview"></div>`;
        return `
          <div class="item-media-row" data-item-media-field="${f.key}" data-path="${escapeAttr(path)}">
            <label>${escapeHtml(schemaLabel(f.label))}</label>
            <div class="item-media-controls">
              ${preview}
              <input type="file" accept="${f.type === 'video' ? 'video/*' : 'image/*'}">
              <button type="button" class="item-media-upload-btn">${escapeHtml(t('upload-btn'))}</button>
              <span class="item-media-status"></span>
            </div>
          </div>`;
      }
      return `
        <div class="item-field-row">
          <label>${escapeHtml(schemaLabel(f.label))}</label>
          ${textOrArea(f, `data-item-field="${f.key}"`, item[f.key][currentContentLang] || '')}
        </div>`;
    }).join('');
    return `
      <div class="list-row" data-list-item>
        <div class="list-row-fields">${rows}</div>
        <button type="button" class="list-row-remove" title="Remove">×</button>
      </div>`;
  }

  function renderFieldsHtml(section) {
    const values = {};
    const html = (section.fields || []).map((f) => {
      if (f.type === 'image' || f.type === 'video') {
        return mediaFieldHtml(currentPage, currentSectionKey, f, (sectionState[currentPage][currentSectionKey] || {})[f.key]);
      }
      values[f.key] = normalizeLangValue((sectionState[currentPage][currentSectionKey] || {})[f.key]);
      return `
        <div class="field-row">
          <label>${escapeHtml(schemaLabel(f.label))}</label>
          ${textOrArea(f, `data-field="${f.key}"`, values[f.key][currentContentLang] || '')}
        </div>`;
    }).join('');
    return { html, values };
  }

  function renderListHtml(section) {
    if (!section.list) return null;
    const content = sectionState[currentPage][currentSectionKey] || {};
    const rawItems = content[section.list.key] || [];
    const items = rawItems.map((raw) => normalizeListItem(section.list, raw));
    const rowsHtml = items.map((item) => listItemRowHtml(section.list, item)).join('');
    const addLabel = schemaLabel(section.list.label).replace(/s$/, '');
    return {
      html: `
        <label class="list-label">${escapeHtml(schemaLabel(section.list.label))}</label>
        <div class="list-items" data-list-key="${section.list.key}" data-item-type="${section.list.itemType}">
          ${rowsHtml}
        </div>
        <button type="button" class="add-item-btn" data-add-item>${escapeHtml(t('add-prefix'))} ${escapeHtml(addLabel)}</button>`,
      items
    };
  }

  function renderSectionTabs() {
    const pageSchema = schemaCache[currentPage];
    const sectionKeys = Object.keys(pageSchema.sections);
    $('cSectionTabs').innerHTML = sectionKeys.map((key) => `
      <button type="button" class="section-tab-btn${key === currentSectionKey ? ' active' : ''}" data-section-key="${key}">${escapeHtml(schemaLabel(pageSchema.sections[key].label))}</button>
    `).join('');
  }

  function renderLangTabs() {
    $('cLangTabs').innerHTML = CONTENT_LANGS.map((l) => `
      <button type="button" class="lang-tab-btn${l.code === currentContentLang ? ' active' : ''}" data-lang="${l.code}">${l.label}<span class="miss-dot" data-lang-dot="${l.code}"></span></button>
    `).join('');
  }

  function updateMissingDots() {
    const card = $('cSections').querySelector('.content-card');
    CONTENT_LANGS.forEach((l) => {
      let missing = false;
      if (card && card.__values) {
        Object.values(card.__values).forEach((v) => { if (v.en && !v[l.code]) missing = true; });
      }
      if (card) {
        card.querySelectorAll('[data-list-item]').forEach((row) => {
          if (!row.__item) return;
          if (row.classList.contains('list-row-text')) {
            if (row.__item.en && !row.__item[l.code]) missing = true;
          } else {
            Object.values(row.__item).forEach((v) => {
              if (v && typeof v === 'object' && v.en && !v[l.code]) missing = true;
            });
          }
        });
      }
      const dot = document.querySelector(`.miss-dot[data-lang-dot="${l.code}"]`);
      if (dot) dot.style.display = (l.code !== 'en' && missing) ? 'inline-block' : 'none';
    });
  }

  function renderSection() {
    const section = schemaCache[currentPage].sections[currentSectionKey];
    const fields = renderFieldsHtml(section);
    const list = renderListHtml(section);
    $('cSections').innerHTML = `
      <div class="content-card" data-page="${currentPage}" data-section="${currentSectionKey}">
        <h3>${escapeHtml(schemaLabel(section.label))}</h3>
        <div class="sub">${escapeHtml(t('editing-lang'))}: <strong class="current-lang-name">${CONTENT_LANGS.find((l) => l.code === currentContentLang).label}</strong> — ${escapeHtml(t('editing-hint'))}</div>
        ${fields.html}
        ${list ? list.html : ''}
        <div class="content-save-row">
          <button class="btn-primary section-save-btn">${escapeHtml(t('save-section'))}</button>
          <span class="content-save-msg">${escapeHtml(t('saved'))}</span>
        </div>
      </div>`;
    const card = $('cSections').querySelector('.content-card');
    card.__values = fields.values;
    if (list) {
      const rows = Array.from(card.querySelectorAll('.list-items > [data-list-item]'));
      rows.forEach((row, idx) => { row.__item = list.items[idx]; });
    }
    updateMissingDots();
  }

  function refreshVisibleValues() {
    const card = $('cSections').querySelector('.content-card');
    if (!card) return;
    card.querySelectorAll('[data-field]').forEach((el) => {
      const key = el.dataset.field;
      if (card.__values && card.__values[key]) el.value = card.__values[key][currentContentLang] || '';
    });
    card.querySelectorAll('[data-list-item]').forEach((row) => {
      if (!row.__item) return;
      if (row.classList.contains('list-row-text')) {
        const input = row.querySelector('[data-item-text]');
        if (input) input.value = row.__item[currentContentLang] || '';
      } else {
        row.querySelectorAll('[data-item-field]').forEach((el) => {
          const key = el.dataset.itemField;
          if (row.__item[key]) el.value = row.__item[key][currentContentLang] || '';
        });
      }
    });
    const nameEl = card.querySelector('.current-lang-name');
    if (nameEl) nameEl.textContent = CONTENT_LANGS.find((l) => l.code === currentContentLang).label;
  }

  $('cSectionTabs').addEventListener('click', (e) => {
    const btn = e.target.closest('.section-tab-btn');
    if (!btn) return;
    currentSectionKey = btn.dataset.sectionKey;
    document.querySelectorAll('.section-tab-btn').forEach((b) => b.classList.toggle('active', b === btn));
    renderSection();
  });

  $('cLangTabs').addEventListener('click', (e) => {
    const btn = e.target.closest('.lang-tab-btn');
    if (!btn) return;
    currentContentLang = btn.dataset.lang;
    document.querySelectorAll('.lang-tab-btn').forEach((b) => b.classList.toggle('active', b === btn));
    refreshVisibleValues();
  });

  $('cSections').addEventListener('input', (e) => {
    const card = e.target.closest('.content-card');
    if (!card) return;
    if (e.target.matches('[data-field]')) {
      const key = e.target.dataset.field;
      if (card.__values[key]) card.__values[key][currentContentLang] = e.target.value;
      updateMissingDots();
      return;
    }
    if (e.target.matches('[data-item-text]')) {
      const row = e.target.closest('[data-list-item]');
      if (row && row.__item) row.__item[currentContentLang] = e.target.value;
      updateMissingDots();
      return;
    }
    if (e.target.matches('[data-item-field]')) {
      const row = e.target.closest('[data-list-item]');
      const key = e.target.dataset.itemField;
      if (row && row.__item && row.__item[key]) row.__item[key][currentContentLang] = e.target.value;
      updateMissingDots();
    }
  });

  async function loadSchema() {
    if (schemaCache) return schemaCache;
    const res = await api('/content/schema');
    const data = await res.json();
    schemaCache = data.pages;
    return schemaCache;
  }

  async function renderPage(pageKey) {
    const schemas = await loadSchema();
    const pageSchema = schemas[pageKey];
    const res = await api('/content/' + pageKey);
    const content = await res.json();
    sectionState[pageKey] = content;
    currentPage = pageKey;
    currentSectionKey = Object.keys(pageSchema.sections)[0];
    renderSectionTabs();
    renderSection();
  }

  async function loadContent() {
    const schemas = await loadSchema();
    const select = $('cPageSelect');
    select.innerHTML = Object.entries(schemas).map(([key, s]) => `<option value="${key}">${escapeHtml(schemaLabel(s.label))}</option>`).join('');
    select.addEventListener('change', () => renderPage(select.value));
    renderLangTabs();
    await renderPage(select.value);
  }

  function collectSectionPayload(card, pageKey, sectionKey) {
    const schema = schemaCache[pageKey].sections[sectionKey];
    const payload = { ...sectionState[pageKey][sectionKey] };
    (schema.fields || []).forEach((f) => {
      if (f.type === 'image' || f.type === 'video') return; // media saves via its own upload endpoint
      payload[f.key] = { ...(card.__values[f.key] || emptyLangObj()) };
    });
    if (schema.list) {
      const container = card.querySelector('.list-items');
      const rows = Array.from(container.querySelectorAll(':scope > [data-list-item]'));
      if (schema.list.itemType === 'text') {
        payload[schema.list.key] = rows
          .map((row) => ({ ...(row.__item || emptyLangObj()) }))
          .filter((item) => CONTENT_LANGS.some((l) => item[l.code]));
      } else {
        payload[schema.list.key] = rows.map((row) => {
          const item = {};
          schema.list.itemFields.forEach((f) => {
            if (f.type === 'image' || f.type === 'video') {
              // Already saved directly to disk by its own upload endpoint,
              // just carry the current path forward so re-saving the text
              // fields in this item doesn't wipe it out.
              const mediaEl = row.querySelector(`[data-item-media-field="${f.key}"]`);
              item[f.key] = mediaEl ? (mediaEl.dataset.path || '') : '';
              return;
            }
            item[f.key] = { ...((row.__item && row.__item[f.key]) || emptyLangObj()) };
          });
          return item;
        });
      }
    }
    return payload;
  }

  $('cSections').addEventListener('click', async (e) => {
    const addBtn = e.target.closest('[data-add-item]');
    if (addBtn) {
      const card = addBtn.closest('.content-card');
      const list = schemaCache[currentPage].sections[currentSectionKey].list;
      const item = makeItemSkeleton(list);
      const container = card.querySelector('.list-items');
      container.insertAdjacentHTML('beforeend', listItemRowHtml(list, item));
      container.lastElementChild.__item = item;
      updateMissingDots();
      return;
    }
    const removeBtn = e.target.closest('.list-row-remove');
    if (removeBtn) {
      removeBtn.closest('[data-list-item]').remove();
      updateMissingDots();
      return;
    }
    const uploadBtn = e.target.closest('.media-upload-btn');
    if (uploadBtn) {
      const row = uploadBtn.closest('.media-row');
      const fileInput = row.querySelector('input[type="file"]');
      const file = fileInput.files[0];
      const status = row.querySelector('.media-status');
      if (!file) { status.textContent = t('choose-file-first'); return; }
      const { page: pKey, section } = row.dataset;
      const field = row.dataset.mediaField;
      status.textContent = t('uploading');
      const formData = new FormData();
      formData.append('file', file);
      const res = await api(`/content/${pKey}/${section}/media/${field}`, { method: 'POST', body: formData });
      if (res.ok) {
        const data = await res.json();
        sectionState[pKey][section][field] = data.path;
        const preview = row.querySelector('.media-preview');
        preview.src = siteAssetUrl(data.path);
        status.textContent = t('uploaded');
      } else {
        status.textContent = t('upload-failed');
      }
      return;
    }
    const itemUploadBtn = e.target.closest('.item-media-upload-btn');
    if (itemUploadBtn) {
      const mediaRow = itemUploadBtn.closest('[data-item-media-field]');
      const listRow = itemUploadBtn.closest('[data-list-item]');
      const container = itemUploadBtn.closest('.list-items');
      const card = itemUploadBtn.closest('.content-card');
      const fileInput = mediaRow.querySelector('input[type="file"]');
      const file = fileInput.files[0];
      const status = mediaRow.querySelector('.item-media-status');
      if (!file) { status.textContent = t('choose-file-first'); return; }
      const { page: pKey, section } = card.dataset;
      const field = mediaRow.dataset.itemMediaField;
      const listKey = container.dataset.listKey;
      // Position in the DOM right now, not a stored id; matches how the
      // backend addresses list items (see apex_set_section_media).
      const index = Array.from(container.children).indexOf(listRow);
      status.textContent = t('uploading');
      const formData = new FormData();
      formData.append('file', file);
      formData.append('listKey', listKey);
      formData.append('index', String(index));
      const res = await api(`/content/${pKey}/${section}/media/${field}`, { method: 'POST', body: formData });
      if (res.ok) {
        const data = await res.json();
        mediaRow.dataset.path = data.path;
        const previewHolder = mediaRow.querySelector('.media-preview');
        if (previewHolder.tagName === 'DIV') {
          const img = document.createElement('img');
          img.className = 'media-preview';
          img.src = siteAssetUrl(data.path);
          previewHolder.replaceWith(img);
        } else {
          previewHolder.src = siteAssetUrl(data.path);
        }
        status.textContent = t('uploaded');
      } else {
        status.textContent = t('upload-failed');
      }
      return;
    }
    const saveBtn = e.target.closest('.section-save-btn');
    if (saveBtn) {
      const card = saveBtn.closest('.content-card');
      const { page: pKey, section } = card.dataset;
      const payload = collectSectionPayload(card, pKey, section);
      const res = await api(`/content/${pKey}/${section}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });
      if (res.ok) {
        const data = await res.json();
        sectionState[pKey][section] = data.data;
        const msg = card.querySelector('.content-save-msg');
        msg.classList.add('show');
        setTimeout(() => msg.classList.remove('show'), 2000);
      }
    }
  });

  // ---- Boot: check for an existing session before showing the login form ----
  applyAdminLang();
  (async function boot() {
    const res = await fetch(API + '/me', { credentials: 'same-origin' });
    if (res.ok) showDashboard();
    else showLogin();
  })();
})();
