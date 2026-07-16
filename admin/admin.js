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
      $('loginError').textContent = res.status === 429
        ? 'Too many attempts. Please wait and try again.'
        : 'Incorrect password.';
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
    const options = ['<option value="">Any source</option>']
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
      list.innerHTML = '<li class="insufficient">Not enough data yet for insights.</li>';
      return;
    }
    list.innerHTML = data.insights.map((i) =>
      `<li class="${i.kind === 'insufficient' ? 'insufficient' : ''}">${escapeHtml(i.text)}</li>`
    ).join('');
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
    return list.map((t) => `<span class="tag">${escapeHtml(t)}</span>`).join('');
  }

  function statusSelectHtml(lead) {
    const current = lead.status || 'new';
    const options = STATUSES.map((s) =>
      `<option value="${s}"${s === current ? ' selected' : ''}>${s.charAt(0).toUpperCase() + s.slice(1)}</option>`
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
          <td>${lead.marketingOptIn ? 'Yes' : 'No'}</td>
          <td>${lead.photosUploaded}</td>
          <td>${statusSelectHtml(lead)}</td>
          <td><button class="del-btn" data-id="${lead.id}">Delete</button></td>
        </tr>
      `).join('');
    }
    $('pageInfo').textContent = `Page ${page} of ${totalPages}`;
    $('prevPage').disabled = page <= 1;
    $('nextPage').disabled = page >= totalPages;
  }

  $('leadsBody').addEventListener('click', async (e) => {
    const btn = e.target.closest('.del-btn');
    if (!btn) return;
    if (!confirm('Delete this lead permanently?')) return;
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
  // Every page/section is described in backend/content-schemas.js. This
  // renders a form from that schema instead of hand-coding HTML per field,
  // so wiring up a new page/section never touches this file again — only
  // the schema, the content JSON defaults, and the live page's markup do.
  let schemaCache = null;
  const sectionState = {}; // sectionState[page][section] = current content object (mutated on upload)

  function textOrArea(field, dataAttrs, value) {
    // <input> can't hold its value as inner text (only <textarea> can) —
    // richtext fields render as a textarea with the value as content,
    // everything else as an input with the value in the value="" attribute.
    if (field.type === 'richtext') {
      return `<textarea rows="3" ${dataAttrs}>${escapeHtml(value)}</textarea>`;
    }
    return `<input type="text" ${dataAttrs} value="${escapeAttr(value)}">`;
  }

  function fieldInputHtml(sectionPath, field, value) {
    const v = value || {};
    const mk = (lang) => textOrArea(field, `data-field="${field.key}" data-lang="${lang}"`, v[lang] || '');
    return `
      <div class="field-row" data-section-path="${sectionPath}">
        <label>${escapeHtml(field.label)}</label>
        <div><span class="lang-tag">DE</span>${mk('de')}</div>
        <div><span class="lang-tag">EN</span>${mk('en')}</div>
      </div>`;
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
        <label>${escapeHtml(field.label)}</label>
        ${preview}
        <input type="file" accept="${isVideo ? 'video/*' : 'image/*'}">
        <button type="button" class="media-upload-btn">Upload</button>
        <span class="media-status"></span>
      </div>`;
  }

  function listItemRowHtml(list, item) {
    if (list.itemType === 'text') {
      return `
        <div class="list-row" data-list-item>
          <label>${escapeHtml(list.label)}</label>
          <input type="text" data-item-lang="de" value="${escapeAttr(item?.de || '')}" placeholder="DE">
          <input type="text" data-item-lang="en" value="${escapeAttr(item?.en || '')}" placeholder="EN">
          <button type="button" class="list-row-remove" title="Remove">×</button>
        </div>`;
    }
    // itemType 'fields': one field-row-ish block per named field, grouped together.
    const rows = list.itemFields.map((f) => {
      if (f.type === 'image' || f.type === 'video') {
        // Per-item media (e.g. one Vorher/Nachher case's photo). Uploads hit
        // the same media endpoint as section-level fields, just with an
        // extra listKey/index so the backend writes it into this list item
        // instead of the section root — see the item-media-upload-btn
        // handler below. The item's position in the DOM at upload time (not
        // a stored index) decides which array slot it targets, so this only
        // stays correct if the row isn't reordered between adding it and
        // saving — there's no drag-reorder UI, so that's not a real risk.
        const path = (item && item[f.key]) || '';
        const previewUrl = path ? siteAssetUrl(path) : '';
        const preview = path
          ? (f.type === 'video' ? `<video class="media-preview" src="${escapeAttr(previewUrl)}" muted></video>` : `<img class="media-preview" src="${escapeAttr(previewUrl)}">`)
          : `<div class="media-preview"></div>`;
        return `
          <div class="item-media-row" data-item-media-field="${f.key}" data-path="${escapeAttr(path)}" style="display:grid;grid-template-columns:110px 1fr;gap:8px;margin-bottom:4px;align-items:center;">
            <label style="font-size:11.5px;color:var(--ink-soft);">${escapeHtml(f.label)}</label>
            <div style="display:flex;align-items:center;gap:8px;">
              ${preview}
              <input type="file" accept="${f.type === 'video' ? 'video/*' : 'image/*'}">
              <button type="button" class="item-media-upload-btn">Upload</button>
              <span class="item-media-status" style="font-size:11px;color:var(--ink-soft);"></span>
            </div>
          </div>`;
      }
      const v = (item && item[f.key]) || {};
      return `
        <div style="display:grid;grid-template-columns:110px 1fr 1fr;gap:8px;margin-bottom:4px;">
          <label style="font-size:11.5px;color:var(--ink-soft);padding-top:7px;">${escapeHtml(f.label)}</label>
          ${textOrArea(f, `data-item-field="${f.key}" data-item-lang="de" placeholder="DE"`, v.de || '')}
          ${textOrArea(f, `data-item-field="${f.key}" data-item-lang="en" placeholder="EN"`, v.en || '')}
        </div>`;
    }).join('');
    return `
      <div class="list-row" data-list-item style="grid-template-columns:1fr 32px;">
        <div>${rows}</div>
        <button type="button" class="list-row-remove" title="Remove">×</button>
      </div>`;
  }

  function renderSectionCard(page, sectionKey, section, content) {
    const fieldsHtml = (section.fields || [])
      .map((f) => f.type === 'image' || f.type === 'video'
        ? mediaFieldHtml(page, sectionKey, f, content[f.key])
        : fieldInputHtml(sectionKey, f, content[f.key]))
      .join('');
    let listHtml = '';
    if (section.list) {
      const items = content[section.list.key] || [];
      listHtml = `
        <label style="font-size:12.5px; font-weight:600; color:var(--ink-soft); display:block; margin: 14px 0 8px;">${escapeHtml(section.list.label)}</label>
        <div class="list-items" data-list-key="${section.list.key}" data-item-type="${section.list.itemType}">
          ${items.map((item) => listItemRowHtml(section.list, item)).join('')}
        </div>
        <button type="button" class="add-item-btn" data-add-item>+ Add ${escapeHtml(section.list.label.replace(/s$/, ''))}</button>`;
    }
    return `
      <div class="content-card" data-page="${page}" data-section="${sectionKey}">
        <h3>${escapeHtml(section.label)}</h3>
        <div class="sub">Fill in both German (DE) and English (EN) — the site's language switch uses whichever the visitor picks.</div>
        ${fieldsHtml}
        ${listHtml}
        <div class="content-save-row">
          <button class="btn-primary section-save-btn">Save section</button>
          <span class="content-save-msg">Saved ✓</span>
        </div>
      </div>`;
  }

  async function loadSchema() {
    if (schemaCache) return schemaCache;
    const res = await api('/content/schema');
    const data = await res.json();
    schemaCache = data.pages;
    return schemaCache;
  }

  async function renderPage(page) {
    const schemas = await loadSchema();
    const pageSchema = schemas[page];
    const res = await api('/content/' + page);
    const content = await res.json();
    sectionState[page] = content;
    const html = Object.entries(pageSchema.sections)
      .map(([key, section]) => renderSectionCard(page, key, section, content[key] || {}))
      .join('');
    $('cSections').innerHTML = html;
  }

  async function loadContent() {
    const schemas = await loadSchema();
    const select = $('cPageSelect');
    select.innerHTML = Object.entries(schemas).map(([key, s]) => `<option value="${key}">${escapeHtml(s.label)}</option>`).join('');
    select.addEventListener('change', () => renderPage(select.value));
    await renderPage(select.value);
  }

  function collectSectionPayload(card, page, sectionKey) {
    const schema = schemaCache[page].sections[sectionKey];
    const payload = { ...sectionState[page][sectionKey] };
    (schema.fields || []).forEach((f) => {
      if (f.type === 'image' || f.type === 'video') return; // media saves via its own upload endpoint
      payload[f.key] = {
        de: card.querySelector(`[data-field="${f.key}"][data-lang="de"]`).value.trim(),
        en: card.querySelector(`[data-field="${f.key}"][data-lang="en"]`).value.trim()
      };
    });
    if (schema.list) {
      const container = card.querySelector('.list-items');
      const rows = Array.from(container.querySelectorAll('[data-list-item]'));
      if (schema.list.itemType === 'text') {
        payload[schema.list.key] = rows.map((row) => ({
          de: row.querySelector('[data-item-lang="de"]').value.trim(),
          en: row.querySelector('[data-item-lang="en"]').value.trim()
        })).filter((item) => item.de || item.en);
      } else {
        payload[schema.list.key] = rows.map((row) => {
          const item = {};
          schema.list.itemFields.forEach((f) => {
            if (f.type === 'image' || f.type === 'video') {
              // Already saved directly to disk by its own upload endpoint —
              // just carry the current path forward so re-saving the text
              // fields in this item doesn't wipe it out.
              const mediaEl = row.querySelector(`[data-item-media-field="${f.key}"]`);
              item[f.key] = mediaEl ? (mediaEl.dataset.path || '') : '';
              return;
            }
            item[f.key] = {
              de: row.querySelector(`[data-item-field="${f.key}"][data-item-lang="de"]`).value.trim(),
              en: row.querySelector(`[data-item-field="${f.key}"][data-item-lang="en"]`).value.trim()
            };
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
      const page = card.dataset.page, sectionKey = card.dataset.section;
      const list = schemaCache[page].sections[sectionKey].list;
      addBtn.previousElementSibling.insertAdjacentHTML('beforeend', listItemRowHtml(list, null));
      return;
    }
    const removeBtn = e.target.closest('.list-row-remove');
    if (removeBtn) {
      removeBtn.closest('[data-list-item]').remove();
      return;
    }
    const uploadBtn = e.target.closest('.media-upload-btn');
    if (uploadBtn) {
      const row = uploadBtn.closest('.media-row');
      const fileInput = row.querySelector('input[type="file"]');
      const file = fileInput.files[0];
      const status = row.querySelector('.media-status');
      if (!file) { status.textContent = 'Choose a file first.'; return; }
      const { page, section } = row.dataset;
      const field = row.dataset.mediaField;
      status.textContent = 'Uploading…';
      const formData = new FormData();
      formData.append('file', file);
      const res = await api(`/content/${page}/${section}/media/${field}`, { method: 'POST', body: formData });
      if (res.ok) {
        const data = await res.json();
        sectionState[page][section][field] = data.path;
        const preview = row.querySelector('.media-preview');
        preview.src = siteAssetUrl(data.path);
        status.textContent = 'Uploaded ✓';
      } else {
        status.textContent = 'Upload failed.';
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
      if (!file) { status.textContent = 'Choose a file first.'; return; }
      const { page, section } = card.dataset;
      const field = mediaRow.dataset.itemMediaField;
      const listKey = container.dataset.listKey;
      // Position in the DOM right now, not a stored id — matches how the
      // backend addresses list items (see apex_set_section_media).
      const index = Array.from(container.children).indexOf(listRow);
      status.textContent = 'Uploading…';
      const formData = new FormData();
      formData.append('file', file);
      formData.append('listKey', listKey);
      formData.append('index', String(index));
      const res = await api(`/content/${page}/${section}/media/${field}`, { method: 'POST', body: formData });
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
        status.textContent = 'Uploaded ✓';
      } else {
        status.textContent = 'Upload failed.';
      }
      return;
    }
    const saveBtn = e.target.closest('.section-save-btn');
    if (saveBtn) {
      const card = saveBtn.closest('.content-card');
      const { page, section } = card.dataset;
      const payload = collectSectionPayload(card, page, section);
      const res = await api(`/content/${page}/${section}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });
      if (res.ok) {
        const data = await res.json();
        sectionState[page][section] = data.data;
        const msg = card.querySelector('.content-save-msg');
        msg.classList.add('show');
        setTimeout(() => msg.classList.remove('show'), 2000);
      }
    }
  });

  // ---- Boot: check for an existing session before showing the login form ----
  (async function boot() {
    const res = await fetch(API + '/me', { credentials: 'same-origin' });
    if (res.ok) showDashboard();
    else showLogin();
  })();
})();
