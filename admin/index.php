<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Apex Beauty — Leads Admin</title>
<meta name="robots" content="noindex, nofollow">
<style>
  :root {
    --blue-600: #2563eb;
    --blue-700: #1d4ed8;
    --blue-900: #1e3a5f;
    --teal-500: #0ea5e9;
    --ink: #0f2027;
    --ink-soft: #45596a;
    --paper: #f7fafd;
    --line: #dbe6f2;
  }
  * { box-sizing: border-box; }
  body {
    margin: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Inter", "Segoe UI", sans-serif;
    background: var(--paper);
    color: var(--ink);
  }

  /* ---- Login screen ---- */
  #loginScreen {
    min-height: 100vh; display: flex; align-items: center; justify-content: center;
    background: linear-gradient(160deg, var(--blue-900), #0b1524);
  }
  .login-card {
    width: 320px; background: #fff; border-radius: 16px; padding: 32px;
    box-shadow: 0 30px 60px -20px rgba(0,0,0,0.5);
  }
  .login-card h1 { font-size: 18px; margin: 0 0 4px; }
  .login-card p { font-size: 13px; color: var(--ink-soft); margin: 0 0 20px; }
  .login-card input {
    width: 100%; padding: 11px 12px; border: 1.5px solid var(--line); border-radius: 10px;
    font-size: 14px; margin-bottom: 12px;
  }
  .login-card button {
    width: 100%; padding: 11px; border: none; border-radius: 10px; cursor: pointer;
    background: var(--blue-600); color: #fff; font-weight: 700; font-size: 14px;
  }
  .login-card button:hover { background: var(--blue-700); }
  .login-error { color: #dc2626; font-size: 13px; margin: 0 0 12px; display: none; }

  /* ---- Dashboard ---- */
  #dashboard { display: none; max-width: 1280px; margin: 0 auto; padding: 24px 24px 60px; }
  .db-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
  .db-header h1 { font-size: 20px; margin: 0; }
  .db-header .sub { font-size: 12.5px; color: var(--ink-soft); }
  #logoutBtn {
    border: 1.5px solid var(--line); background: #fff; padding: 8px 14px; border-radius: 9px;
    cursor: pointer; font-size: 13px; font-weight: 600; color: var(--ink);
  }
  #logoutBtn:hover { border-color: var(--blue-600); color: var(--blue-600); }

  .stat-cards { display: grid; grid-template-columns: repeat(6, 1fr); gap: 12px; margin-bottom: 20px; }
  .stat-card { background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 14px 16px; }
  .stat-card .n { font-size: 24px; font-weight: 800; color: var(--blue-700); display: flex; align-items: baseline; gap: 6px; }
  .stat-card .l { font-size: 12px; color: var(--ink-soft); margin-top: 2px; }
  .stat-card .delta { font-size: 11.5px; font-weight: 700; }
  .stat-card .delta.up { color: #16a34a; }
  .stat-card .delta.down { color: #dc2626; }
  .stat-card .delta.flat { color: var(--ink-soft); }

  .trend-card {
    background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 16px 18px 8px; margin-bottom: 20px;
  }
  .trend-card h3 { font-size: 12px; text-transform: uppercase; letter-spacing: 0.03em; color: var(--ink-soft); margin: 0 0 4px; }
  .trend-card .sub { font-size: 11.5px; color: var(--ink-soft); margin-bottom: 10px; }
  .trend-card .chart-wrap { height: 200px; position: relative; }

  .breakdown-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 24px; }
  .breakdown-card { background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 14px 16px; }
  .breakdown-card h3 { font-size: 12px; text-transform: uppercase; letter-spacing: 0.03em; color: var(--ink-soft); margin: 0 0 10px; }
  .breakdown-card .chart-wrap { height: 170px; position: relative; }
  .breakdown-card .chart-wrap.donut { height: 150px; }
  .bd-empty { font-size: 12.5px; color: var(--ink-soft); }

  .insights-card {
    background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 16px 18px; margin-bottom: 20px;
  }
  .insights-card h3 { font-size: 12px; text-transform: uppercase; letter-spacing: 0.03em; color: var(--ink-soft); margin: 0 0 10px; }
  .insights-list { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 8px; }
  .insights-list li {
    font-size: 13.5px; color: var(--ink); padding: 9px 12px; border-radius: 8px; background: #f7fafd;
    border-left: 3px solid var(--teal-500);
  }
  .insights-list li.insufficient { border-left-color: var(--line); color: var(--ink-soft); font-style: italic; }

  .status-select {
    padding: 5px 8px; border-radius: 7px; border: 1.5px solid var(--line); font-size: 12px; font-weight: 600;
    background: #fff; color: var(--ink); cursor: pointer;
  }
  .status-select.status-new { border-color: #93c5fd; color: #1d4ed8; }
  .status-select.status-contacted { border-color: #fcd34d; color: #92400e; }
  .status-select.status-converted { border-color: #86efac; color: #15803d; }
  .status-select.status-lost { border-color: #fca5a5; color: #b91c1c; }

  .toolbar {
    display: flex; flex-wrap: wrap; align-items: center; gap: 8px;
    background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 12px; margin-bottom: 14px;
  }
  .toolbar input, .toolbar select {
    padding: 8px 10px; border: 1.5px solid var(--line); border-radius: 8px; font-size: 13px;
  }
  .toolbar input[type="search"] { flex: 1 1 200px; min-width: 160px; }
  .toolbar button {
    padding: 8px 14px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; border: none;
  }
  .btn-primary { background: var(--blue-600); color: #fff; }
  .btn-primary:hover { background: var(--blue-700); }
  .btn-ghost { background: #fff; border: 1.5px solid var(--line) !important; color: var(--ink); }
  .btn-ghost:hover { border-color: var(--blue-600) !important; color: var(--blue-600); }
  .toolbar .spacer { flex: 1; }

  table { width: 100%; border-collapse: collapse; background: #fff; border: 1px solid var(--line); border-radius: 12px; overflow: hidden; }
  thead th {
    text-align: left; font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.02em;
    color: var(--ink-soft); background: #eef3fa; padding: 10px 12px; white-space: nowrap;
  }
  tbody td { padding: 10px 12px; font-size: 13px; border-top: 1px solid var(--line); vertical-align: top; }
  tbody tr:hover { background: #f7fafd; }
  .tag { display: inline-block; background: #eaf6fe; color: #0c5c8e; border-radius: 6px; padding: 2px 7px; font-size: 11px; margin: 1px; }
  .del-btn { border: none; background: none; color: #dc2626; cursor: pointer; font-size: 12px; font-weight: 700; }
  .del-btn:hover { text-decoration: underline; }
  .empty-state { text-align: center; padding: 40px; color: var(--ink-soft); font-size: 13.5px; }

  .pagination { display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 14px; font-size: 13px; }
  .pagination button {
    padding: 6px 12px; border-radius: 7px; border: 1.5px solid var(--line); background: #fff; cursor: pointer;
  }
  .pagination button:disabled { opacity: 0.4; cursor: default; }

  @media (max-width: 980px) {
    .stat-cards { grid-template-columns: repeat(3, 1fr); }
    .breakdown-row { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 620px) {
    .stat-cards { grid-template-columns: repeat(2, 1fr); }
    .breakdown-row { grid-template-columns: 1fr; }
  }

  /* ---- Tabs ---- */
  .tabs { display: flex; gap: 4px; margin-bottom: 20px; border-bottom: 1.5px solid var(--line); }
  .tab-btn {
    border: none; background: none; padding: 10px 4px; margin-right: 20px; font-size: 14px; font-weight: 700;
    color: var(--ink-soft); cursor: pointer; border-bottom: 2.5px solid transparent; margin-bottom: -1.5px;
  }
  .tab-btn.active { color: var(--blue-700); border-bottom-color: var(--blue-600); }

  /* ---- Content panel ---- */
  .content-card { background: #fff; border: 1px solid var(--line); border-radius: 12px; padding: 18px 20px; margin-bottom: 18px; }
  .content-card h3 { font-size: 14px; margin: 0 0 4px; }
  .content-card .sub { font-size: 12px; color: var(--ink-soft); margin: 0 0 16px; }
  .field-row { display: grid; grid-template-columns: 160px 1fr 1fr; gap: 10px; align-items: start; margin-bottom: 10px; }
  .field-row label { font-size: 12.5px; font-weight: 600; color: var(--ink-soft); padding-top: 9px; }
  .field-row input, .field-row textarea {
    width: 100%; padding: 8px 10px; border: 1.5px solid var(--line); border-radius: 8px; font-size: 13px;
    font-family: inherit; resize: vertical;
  }
  .field-row .lang-tag { font-size: 10.5px; font-weight: 700; color: var(--ink-soft); margin-bottom: 3px; display: block; }
  .pill-row { display: grid; grid-template-columns: 160px 1fr 1fr 32px; gap: 10px; align-items: center; margin-bottom: 8px; }
  .pill-row input { padding: 7px 9px; border: 1.5px solid var(--line); border-radius: 8px; font-size: 12.5px; }
  .pill-remove { border: none; background: none; color: #dc2626; font-size: 16px; cursor: pointer; line-height: 1; }
  .add-pill-btn {
    border: 1.5px dashed var(--line); background: none; color: var(--ink-soft); padding: 6px 12px;
    border-radius: 8px; font-size: 12.5px; cursor: pointer; margin-top: 4px;
  }
  .add-pill-btn:hover { border-color: var(--blue-600); color: var(--blue-600); }
  .content-save-row { display: flex; align-items: center; gap: 12px; margin-top: 6px; }
  .content-save-msg { font-size: 12.5px; color: #16a34a; opacity: 0; transition: opacity 0.2s; }
  .content-save-msg.show { opacity: 1; }
  .list-row { display: grid; grid-template-columns: 160px 1fr 1fr 32px; gap: 10px; align-items: center; margin-bottom: 8px; }
  .list-row input, .list-row textarea { padding: 7px 9px; border: 1.5px solid var(--line); border-radius: 8px; font-size: 12.5px; font-family: inherit; }
  .list-row-remove { border: none; background: none; color: #dc2626; font-size: 16px; cursor: pointer; line-height: 1; }
  .add-item-btn {
    border: 1.5px dashed var(--line); background: none; color: var(--ink-soft); padding: 6px 12px;
    border-radius: 8px; font-size: 12.5px; cursor: pointer; margin-top: 4px;
  }
  .add-item-btn:hover { border-color: var(--blue-600); color: var(--blue-600); }
  .media-row { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
  .media-row label { font-size: 12.5px; font-weight: 600; color: var(--ink-soft); width: 160px; flex-shrink: 0; }
  .media-preview { width: 100px; height: 60px; border-radius: 8px; border: 1.5px solid var(--line); object-fit: cover; background: #eef3fa; }
  .media-row input[type="file"] { font-size: 12px; max-width: 220px; }
  .media-upload-btn { padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; border: 1.5px solid var(--blue-600); background: #fff; color: var(--blue-600); }
  .media-upload-btn:hover { background: var(--blue-600); color: #fff; }
  .media-status { font-size: 11.5px; color: var(--ink-soft); }
</style>
</head>
<body>

<div id="loginScreen">
  <form class="login-card" id="loginForm">
    <h1>Apex Beauty</h1>
    <p>Leads admin — sign in to continue.</p>
    <p class="login-error" id="loginError">Incorrect password.</p>
    <input type="password" id="loginPassword" placeholder="Admin password" autocomplete="current-password" required>
    <button type="submit">Sign in</button>
  </form>
</div>

<div id="dashboard">
  <div class="db-header">
    <div>
      <h1>Consultation leads</h1>
      <div class="sub">Live submissions from the free-consultation form</div>
    </div>
    <button id="logoutBtn">Log out</button>
  </div>

  <div class="tabs">
    <button class="tab-btn active" id="tabLeadsBtn" data-tab="leads">Leads</button>
    <button class="tab-btn" id="tabContentBtn" data-tab="content">Website content</button>
  </div>

  <div id="leadsPanel">
  <div class="stat-cards">
    <div class="stat-card"><div class="n" id="statTotal">–</div><div class="l">Total leads</div></div>
    <div class="stat-card"><div class="n"><span id="stat7">–</span><span class="delta" id="stat7Delta"></span></div><div class="l">Last 7 days</div></div>
    <div class="stat-card"><div class="n" id="stat30">–</div><div class="l">Last 30 days</div></div>
    <div class="stat-card"><div class="n" id="statAvgDay">–</div><div class="l">Avg leads / day (7d)</div></div>
    <div class="stat-card"><div class="n" id="statOptIn">–</div><div class="l">Marketing opt-ins</div></div>
    <div class="stat-card"><div class="n" id="statPhotos">–</div><div class="l">With photos uploaded</div></div>
  </div>

  <div class="insights-card">
    <h3>Insights</h3>
    <ul class="insights-list" id="insightsList"></ul>
  </div>

  <div class="trend-card">
    <h3>Leads over time</h3>
    <div class="sub">Daily submissions, last 30 days</div>
    <div class="chart-wrap"><canvas id="chTrend"></canvas></div>
  </div>

  <div class="trend-card">
    <h3>Leads per month</h3>
    <div class="sub">Monthly submissions, last 6 months</div>
    <div class="chart-wrap"><canvas id="chMonthly"></canvas></div>
  </div>

  <div class="breakdown-row">
    <div class="breakdown-card"><h3>By procedure</h3><div class="chart-wrap"><canvas id="chProcedure"></canvas></div></div>
    <div class="breakdown-card"><h3>By timing</h3><div class="chart-wrap"><canvas id="chTiming"></canvas></div></div>
    <div class="breakdown-card"><h3>By gender</h3><div class="chart-wrap donut"><canvas id="chGender"></canvas></div></div>
    <div class="breakdown-card"><h3>By country</h3><div class="chart-wrap"><canvas id="chCountry"></canvas></div></div>
    <div class="breakdown-card"><h3>By source (UTM)</h3><div class="chart-wrap"><canvas id="chSource"></canvas></div></div>
    <div class="breakdown-card"><h3>By therapy add-on</h3><div class="chart-wrap"><canvas id="chTherapy"></canvas></div></div>
    <div class="breakdown-card"><h3>By status</h3><div class="chart-wrap donut"><canvas id="chStatus"></canvas></div></div>
  </div>

  <div class="toolbar">
    <input type="search" id="fSearch" placeholder="Search name, email, phone…">
    <select id="fGender"><option value="">Any gender</option><option value="male">Male</option><option value="female">Female</option></select>
    <select id="fTiming">
      <option value="">Any timing</option>
      <option value="this-month">This month</option>
      <option value="1-3">1–3 months</option>
      <option value="3-6">3–6 months</option>
      <option value="6plus">6+ months</option>
      <option value="research">Just researching</option>
    </select>
    <select id="fMarketing"><option value="">Marketing: any</option><option value="true">Opted in</option><option value="false">Not opted in</option></select>
    <select id="fSource"><option value="">Any source</option></select>
    <select id="fStatus">
      <option value="">Any status</option>
      <option value="new">New</option>
      <option value="contacted">Contacted</option>
      <option value="converted">Converted</option>
      <option value="lost">Lost</option>
    </select>
    <input type="date" id="fFrom" title="From date">
    <input type="date" id="fTo" title="To date">
    <button class="btn-ghost" id="resetBtn">Reset</button>
    <span class="spacer"></span>
    <button class="btn-primary" id="exportBtn">⬇ Export CSV</button>
  </div>

  <div id="tableWrap">
    <table>
      <thead>
        <tr>
          <th>Submitted</th><th>Name</th><th>Email</th><th>Phone</th><th>Country</th>
          <th>Gender</th><th>Procedures</th><th>Therapies</th><th>Timing</th><th>Source</th><th>Marketing</th><th>Photos</th><th>Status</th><th></th>
        </tr>
      </thead>
      <tbody id="leadsBody"></tbody>
    </table>
    <div class="empty-state" id="emptyState" style="display:none;">No leads match these filters yet.</div>
  </div>

  <div class="pagination">
    <button id="prevPage">← Prev</button>
    <span id="pageInfo">Page 1</span>
    <button id="nextPage">Next →</button>
  </div>
  </div>

  <div id="contentPanel" style="display:none;">
    <div class="toolbar">
      <label style="font-size:13px; font-weight:600; color:var(--ink-soft);">Page:</label>
      <select id="cPageSelect"></select>
      <span class="sub" style="margin-left:auto;">Edits save immediately and appear on the live site on next page load.</span>
    </div>
    <div id="cSections"></div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script src="/admin/admin.js"></script>
</body>
</html>
