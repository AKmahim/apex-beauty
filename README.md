# Apex Beauty — Website & Leads/Content Platform

A mockup marketing site for a hair-transplant clinic (Apex Beauty), plus a
custom backend that (1) captures and manages consultation leads and (2)
lets the clinic edit the website's text, images, and videos without
touching code.

This is now a **single PHP application**: the public pages, admin dashboard,
lead API, and content API all deploy together on one PHP host, with leads
stored in **MySQL/MariaDB**.

---

## 1. Quick start

Requirements: **PHP with PDO MySQL**, **MySQL/MariaDB**, and Apache rewrite
support (`.htaccess`).

```bash
cp .env.example .env
# then set ADMIN_PASSWORD, DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD
# and deploy the project root to your PHP host
```

Then open:
- **Marketing site**: `/glass-theme` (or `/` if you make that your entry page)
- **Admin dashboard**: `/admin` (log in with the password you set in `.env`)

The frontend now talks to the API via same-origin paths (`/api/...`), so the
pages and API can live on the same domain without separate backend/frontend
deployment steps.

If you already have legacy leads in the old SQLite file, you can import them
once after configuring MySQL:

```bash
php scripts/import-sqlite-to-mysql.php
```

Optional: pass a custom SQLite file path as the first argument.


command for run the project:
```bash
php -l router.php && php -S 127.0.0.1:8081 router.php
```



---

## 2. Folder structure

```
apex-mockup/
├── glass-theme.html              Homepage
├── hairpedia.html                Hairpedia (hair-loss encyclopedia)
├── service-hair-transplant.html  Hair Transplant service page
├── contact.html                  Standalone consultation-form landing page
├── privacy.html                  Privacy policy (DSGVO/GDPR)
├── index.html                    Redirects to glass-theme.html
├── assets/
│   ├── apex-video-verticle.mp4            Hero background video
│   ├── apex-drone.mp4            "Promise" section background video
│   ├── lotus-transparent.png     Logo (icon)
│   ├── wordmark-transparent.png  Logo (wordmark)
│   ├── earth-globe.js + earth/   WebGL network-map globe (Three.js)
│   ├── meta-pixel.js             Meta Pixel + Conversion API wrapper
│   ├── cookie-consent.js         Cookie consent banner
│   ├── content-loader.js         Pulls CMS content into every page (see §5)
│   └── content/                  Images/videos uploaded via the CMS land here
├── _archive-unused/              Old code kept for reference, not loaded by any page
└── backend/
    ├── server.js                 Express app entry point
    ├── db.js                     SQLite leads schema + queries
    ├── auth.js                   Admin session auth (password + cookie)
    ├── export.js                 Excel export (leads)
    ├── content.js                Content-file read/write + media upload storage
    ├── content-schemas.js        Defines every editable page/section/field
    ├── capi.js                   Meta Conversion API server-side calls
    ├── routes/
    │   ├── leads.js               POST /api/leads
    │   ├── admin.js                /api/admin/* (leads, stats, insights, status)
    │   └── content.js              /api/content/* and /api/admin/content/*
    ├── data/
    │   ├── leads.db                SQLite database (created on first run)
    │   └── content/*.json          One file per page's editable content
    └── public/admin/              Admin dashboard (static HTML/CSS/JS)
```

---

## 3. Frontend — what's built

**Pages** (all bilingual DE/EN, toggled with the switch in the nav):
- **Home** (`glass-theme.html`) — hero with looping video background and a
  sound toggle, animated trust-bar stat counters, a "promise" section with
  a drone-video background and 3-step process cards, an aftercare-network
  section with an interactive WebGL globe (Three.js) pinning AT/DE/CH/TR,
  and an FAQ accordion.
- **Hairpedia** (`hairpedia.html`) — a 9-section hair-loss encyclopedia
  (causes, types, diagnosis, treatments, transplantation techniques,
  recovery, before/after, glossary), each with card grids, a comparison
  table, and an image slot.
- **Hair Transplant service page** (`service-hair-transplant.html`) — what
  the procedure involves, candidacy, recovery, and realistic results.
- **Contact** (`contact.html`) — a minimal landing page that's just the
  consultation form, used for ad click-throughs.
- **Privacy policy** (`privacy.html`) — DSGVO/GDPR baseline disclosures
  across 7 sections (data collected, retention, cookies table, rights, etc).

**Shared mechanics:**
- **Bilingual content**: every visible text element carries
  `data-de="..."` / `data-en="..."` attributes; `applyLang(lang)` swaps
  `innerHTML` when the DE/EN switch is clicked.
- **Consultation modal**: a 3-step lead form (info → needs → photo upload)
  embedded on every page, opens via any "Kostenlose Beratung" CTA or
  automatically via `?open=consult` (for ad landing pages — a
  `?open=consult-light` variant skips loading the heavy hero video/3D globe
  entirely, for the lightest possible ad-landing load).
- **Meta Pixel + Conversion API**: client-side Pixel events and
  server-side CAPI calls share a single `event_id` for deduplication, all
  gated behind the cookie-consent banner (`assets/cookie-consent.js`).
- **Content-driven rendering**: page text/images/videos are no longer
  hard-coded — see §5.

---

## 4. Backend — what's built

Two things live in the same Express app (`backend/server.js`):

### A. Leads capture & management

- `POST /api/leads` — public endpoint the consultation form submits to.
  Every submission is stored permanently in SQLite (`backend/data/leads.db`).
- **Admin dashboard** (`/admin`, password-protected via `ADMIN_PASSWORD`):
  - Stat cards: total leads, last 7/30 days (with trend arrows), avg/day,
    marketing opt-ins, leads with photos uploaded.
  - **Auto-generated insights**: plain-language, period-over-period
    observations (e.g. "Leads increased 42% this month") — computed
    strictly from real data, and explicitly says "not enough data yet"
    rather than fabricate a trend when the sample is too small.
  - Charts: daily trend (30 days), monthly trend (6 months), and
    breakdowns by procedure, timing, gender, country, UTM source, therapy
    add-on, and status.
  - **Status field**: every lead defaults to `new` on submission; the
    clinic team changes it to `contacted` / `converted` / `lost` from a
    dropdown directly in the leads table — the one thing editable there.
  - Search/filter/paginate the full leads table; delete individual leads.
  - **Export to Excel** — respects whatever filters are currently active.

### B. Website content management (CMS)

A schema-driven system so the admin panel's "Website content" tab never
needs new hand-written HTML/JS when a new page or section is added — only
a schema entry, a content-file default, and markers on the live page.

- `backend/content-schemas.js` — declares, per page, each section's fields
  (`text`, `richtext`, `image`, `video`) and any repeatable list (FAQ
  questions, trust pills, privacy sections), including labels.
- `backend/data/content/<page>.json` — the actual current DE/EN text and
  media paths for that page. This is what the admin panel reads/writes and
  what the live site fetches on every page load.
- **Admin panel → Website content tab**: pick a page from the dropdown,
  edit any section's fields inline (DE and EN side by side), add/remove
  list items (e.g. FAQ questions, privacy sections, trust pills), and
  upload a replacement image or video for any media slot. Saves per
  section, live immediately.
- **Media uploads** (`POST /api/admin/content/:page/:section/media/:field`)
  land in `assets/content/` (served directly by the same static file
  server as the rest of the site) and the content JSON is updated to point
  at the new file.
- **Public read endpoint** (`GET /api/content/:page`, CORS-open) — what
  `assets/content-loader.js` fetches on every page load to populate
  `data-ckey` / `data-clist` / `data-cmedia` marked elements (see below).

**Coverage**: Home (hero incl. both hero videos, trust bar, promise
section incl. drone video, network section, FAQ), Hairpedia (hero + all 9
sections' heading/body/image), Service page (hero + all 4 sections),
Contact (modal title/subtext), Privacy (intro + all 7 legal sections).

**Deliberately NOT covered** (a scoped trade-off, not an oversight): the
card grids and comparison tables *within* Hairpedia/Service sections
(e.g. the 7 "causes of hair loss" cards) are fixed content, not
individually editable — only the section-level heading/body/image is.
Making every card structurally editable was scoped out as a much larger
follow-up job. Also, the consultation modal embedded inline on
Home/Hairpedia/Service still uses static text; only `contact.html`'s
standalone copy is wired to the CMS.

---

## 5. How a page pulls in its content

Every page includes `assets/content-loader.js` and sets
`<body data-content-page="home">` (or `hairpedia` / `service` / `contact` /
`privacy`). On load, that script:

1. Fetches `GET /api/content/<page>` from the backend.
2. For every element with `data-ckey="section.field"`, sets its
   `data-de`/`data-en` attributes from the matching JSON path.
3. For every `data-clist="section.listKey"` container, clones its first
   `data-citem` child once per array entry (so add/remove in the admin
   panel actually changes how many items render).
4. For every `data-cmedia="section.field"` image/video element, swaps in
   the uploaded file's path.
5. Re-runs the page's own `applyLang()` so the DE/EN toggle keeps working
   on the freshly-loaded text.

If the backend is unreachable, every page falls back to its static
hard-coded default text — the site never breaks from a CMS outage.

---

## 6. Known limitations / before real deployment

- **`ADMIN_PASSWORD`** — `.env.example`'s value is for local testing only.
  Set a strong real password before deploying, and switch the session
  cookie to `secure: true` in `backend/auth.js` once served over HTTPS.
- **CORS** — `/api/leads` and `/api/content/:page` are wide open (`*`) so
  the statically-hosted marketing site can call the backend cross-origin.
  Restrict this to your real production domain once you know it.
- **Sessions are in-memory** — restarting the backend logs the admin out.
  Fine for a single small clinic team; swap for a persisted session store
  if this ever runs across multiple server instances.
- **Back up `backend/data/leads.db` and `backend/data/content/*.json`
  regularly** — they're plain files, so copying them is the entire backup
  strategy. `leads.db` contains real customer names/emails/phone numbers.
- **Large assets**: `assets/apex-video-verticle.mp4` and `assets/apex-drone.mp4` are
  real video files (tens/hundreds of MB) — expect a large first clone/copy
  and make sure your host of choice can serve large static files.

## API reference

| Method | Path | Auth | Purpose |
|---|---|---|---|
| POST | `/api/leads` | none | Submit a new consultation lead |
| POST | `/api/admin/login` | none | `{ password }` → sets session cookie |
| POST | `/api/admin/logout` | — | Clears session |
| GET | `/api/admin/me` | session | Check if logged in |
| GET | `/api/admin/leads` | session | List/search/filter leads (paginated) |
| GET | `/api/admin/leads/:id` | session | Fetch one lead |
| DELETE | `/api/admin/leads/:id` | session | Delete one lead |
| PATCH | `/api/admin/leads/:id/status` | session | Set status: new/contacted/converted/lost |
| GET | `/api/admin/stats` | session | Summary counts, trends, breakdowns |
| GET | `/api/admin/insights` | session | Auto-generated plain-language insights |
| GET | `/api/admin/leads-export.xlsx` | session | Download filtered leads as Excel |
| GET | `/api/content/:page` | none | Public: current content for a page |
| GET | `/api/admin/content/schema` | session | All pages' editable-field schemas |
| GET | `/api/admin/content/:page` | session | Current content for a page (editing) |
| PUT | `/api/admin/content/:page/:section` | session | Save a section's text/list fields |
| POST | `/api/admin/content/:page/:section/media/:field` | session | Upload image/video for a media field |
