// Apex AI floating chat widget. Talks to POST /api/chat (see
// includes/apex-ai.php) — a rule-based retrieval engine grounded in this
// site's own content, not a call to an external AI model. This file only
// handles UI: open/close, rendering, sessionStorage persistence, and
// syncing with whichever site language is currently active.
(function () {
  var SUPPORTED_LANGS = ['de', 'en', 'fr', 'nl', 'it', 'tr'];
  var STORAGE_KEY = 'apexAiState';

  var CHROME = {
    en: {
      subtitle: 'Ask me anything about hair transplants',
      placeholder: 'Type your question…',
      send: 'Send',
      greeting: "Hi, I'm Apex AI. Ask me anything about hair transplants or Apex Beauty.",
      teaser: 'Ask Apex AI anything!',
      starters: [
        { label: 'What is a hair transplant?', send: 'What is a hair transplant?' },
        { label: 'FUE vs Sapphire FUE vs DHI', send: 'FUE vs Sapphire FUE vs DHI' },
        { label: 'Am I a good candidate?', send: 'Am I a good candidate?' }
      ],
      error: "Sorry, I couldn't reach the server. Please try again in a moment."
    },
    de: {
      subtitle: 'Fragen Sie mich alles über Haartransplantation',
      placeholder: 'Ihre Frage eingeben…',
      send: 'Senden',
      greeting: 'Hallo, ich bin Apex AI. Fragen Sie mich alles über Haartransplantation oder Apex Beauty.',
      teaser: 'Fragen Sie Apex AI alles!',
      starters: [
        { label: 'Was ist eine Haartransplantation?', send: 'Was ist eine Haartransplantation?' },
        { label: 'FUE vs. Saphir-FUE vs. DHI', send: 'FUE vs. Saphir-FUE vs. DHI' },
        { label: 'Bin ich geeignet?', send: 'Bin ich geeignet?' }
      ],
      error: 'Entschuldigung, der Server war nicht erreichbar. Bitte versuchen Sie es gleich noch einmal.'
    },
    fr: {
      subtitle: 'Posez-moi vos questions sur la greffe de cheveux',
      placeholder: 'Tapez votre question…',
      send: 'Envoyer',
      greeting: 'Bonjour, je suis Apex AI. Posez-moi toutes vos questions sur la greffe de cheveux ou Apex Beauty.',
      teaser: 'Posez vos questions à Apex AI !',
      starters: [
        { label: "Qu'est-ce qu'une greffe de cheveux ?", send: 'What is a hair transplant?' },
        { label: 'FUE, FUE au saphir ou DHI ?', send: 'FUE vs Sapphire FUE vs DHI' },
        { label: 'Suis-je un bon candidat ?', send: 'Am I a good candidate?' }
      ],
      error: "Désolé, le serveur est injoignable. Veuillez réessayer dans un instant."
    },
    nl: {
      subtitle: 'Stel me al uw vragen over haartransplantatie',
      placeholder: 'Typ uw vraag…',
      send: 'Verzenden',
      greeting: 'Hallo, ik ben Apex AI. Stel me al uw vragen over haartransplantatie of Apex Beauty.',
      teaser: 'Vraag Apex AI van alles!',
      starters: [
        { label: 'Wat is een haartransplantatie?', send: 'What is a hair transplant?' },
        { label: 'FUE vs Saffier-FUE vs DHI', send: 'FUE vs Sapphire FUE vs DHI' },
        { label: 'Ben ik een goede kandidaat?', send: 'Am I a good candidate?' }
      ],
      error: 'Sorry, de server was niet bereikbaar. Probeer het zo dadelijk opnieuw.'
    },
    it: {
      subtitle: 'Fatemi qualsiasi domanda sul trapianto di capelli',
      placeholder: 'Scrivi la tua domanda…',
      send: 'Invia',
      greeting: 'Ciao, sono Apex AI. Fatemi qualsiasi domanda sul trapianto di capelli o su Apex Beauty.',
      teaser: 'Chiedi qualsiasi cosa ad Apex AI!',
      starters: [
        { label: 'Cos\'è un trapianto di capelli?', send: 'What is a hair transplant?' },
        { label: 'FUE vs Saphire-FUE vs DHI', send: 'FUE vs Sapphire FUE vs DHI' },
        { label: 'Sono un buon candidato?', send: 'Am I a good candidate?' }
      ],
      error: 'Siamo spiacenti, il server non è raggiungibile. Riprova tra un momento.'
    },
    tr: {
      subtitle: 'Saç ekimi hakkında bana her şeyi sorun',
      placeholder: 'Sorunuzu yazın…',
      send: 'Gönder',
      greeting: 'Merhaba, ben Apex AI. Saç ekimi veya Apex Beauty hakkında istediğiniz her şeyi sorabilirsiniz.',
      teaser: 'Apex AI\'ya her şeyi sorabilirsiniz!',
      starters: [
        { label: 'Saç ekimi nedir?', send: 'What is a hair transplant?' },
        { label: 'FUE ve Safir FUE ve DHI', send: 'FUE vs Sapphire FUE vs DHI' },
        { label: 'İyi bir aday mıyım?', send: 'Am I a good candidate?' }
      ],
      error: 'Üzgünüz, sunucuya ulaşılamadı. Lütfen birazdan tekrar deneyin.'
    }
  };

  function currentLang() {
    var lang = (document.documentElement.lang || 'de').toLowerCase();
    return SUPPORTED_LANGS.indexOf(lang) === -1 ? 'de' : lang;
  }

  function chrome() {
    return CHROME[currentLang()] || CHROME.en;
  }

  function loadState() {
    try {
      var raw = sessionStorage.getItem(STORAGE_KEY);
      var parsed = raw ? JSON.parse(raw) : null;
      if (parsed && Array.isArray(parsed.messages)) return parsed;
    } catch (e) { /* storage unavailable or corrupt, start fresh */ }
    return { messages: [], lastTopicId: null, leadState: null, isOpen: false };
  }

  function saveState() {
    try { sessionStorage.setItem(STORAGE_KEY, JSON.stringify(state)); } catch (e) { /* storage unavailable */ }
  }

  var state = loadState();

  var launcher = document.getElementById('apexAiLauncher');
  var panel = document.getElementById('apexAiPanel');
  var subtitleEl = document.getElementById('apexAiSubtitle');
  var messagesEl = document.getElementById('apexAiMessages');
  var quickEl = document.getElementById('apexAiQuick');
  var input = document.getElementById('apexAiInput');
  var sendBtn = document.getElementById('apexAiSend');
  var teaser = document.getElementById('apexAiTeaser');
  var teaserText = document.getElementById('apexAiTeaserText');
  var teaserClose = document.getElementById('apexAiTeaserClose');
  var TEASER_KEY = 'apexAiTeaserShown';

  function escapeForAttr(s) { return String(s).replace(/"/g, '&quot;'); }

  function renderMessages() {
    messagesEl.innerHTML = '';
    state.messages.forEach(function (m) {
      var div = document.createElement('div');
      div.className = 'apex-ai-msg ' + (m.role === 'user' ? 'user' : 'bot');
      div.textContent = m.text;
      messagesEl.appendChild(div);
    });
    messagesEl.scrollTop = messagesEl.scrollHeight;
  }

  function renderQuickReplies(labels) {
    quickEl.innerHTML = '';
    (labels || []).forEach(function (label) {
      var btn = document.createElement('button');
      btn.type = 'button';
      btn.textContent = label;
      btn.addEventListener('click', function () { sendMessage(label); });
      quickEl.appendChild(btn);
    });
  }

  function applyChrome() {
    var c = chrome();
    subtitleEl.textContent = c.subtitle;
    input.placeholder = c.placeholder;
    sendBtn.textContent = c.send;
  }

  function ensureGreeting() {
    if (state.messages.length > 0) return;
    var c = chrome();
    state.messages.push({ role: 'bot', text: c.greeting });
    renderMessages();
    renderQuickReplies(c.starters.map(function (s) { return s.label; }));
    saveState();
  }

  // Quick replies are rendered from whatever the server returned (English
  // titles once the conversation has started, since the knowledge base only
  // has full en/de answers) — except the very first, client-side greeting,
  // where the *starter* chips should show in the visitor's own site
  // language while still sending a value that reliably matches. Re-map
  // labels back to their canonical "send" value for that one case.
  function resolveSendValue(label) {
    var starters = chrome().starters;
    for (var i = 0; i < starters.length; i++) {
      if (starters[i].label === label) return starters[i].send;
    }
    return label;
  }

  function setBusy(busy) {
    sendBtn.disabled = busy;
    input.disabled = busy;
  }

  function showTyping() {
    var div = document.createElement('div');
    div.className = 'apex-ai-msg bot typing';
    div.id = 'apexAiTyping';
    div.innerHTML = '<span></span><span></span><span></span>';
    messagesEl.appendChild(div);
    messagesEl.scrollTop = messagesEl.scrollHeight;
  }

  function hideTyping() {
    var el = document.getElementById('apexAiTyping');
    if (el) el.remove();
  }

  function sleep(ms) { return new Promise(function (resolve) { setTimeout(resolve, ms); }); }

  function sendMessage(text) {
    var value = resolveSendValue(text).trim();
    if (!value) return;

    state.messages.push({ role: 'user', text: text });
    renderMessages();
    renderQuickReplies([]);
    saveState();

    input.value = '';
    setBusy(true);
    showTyping();

    var minDelay = sleep(400 + Math.random() * 500);
    var lang = currentLang();

    Promise.all([
      fetch('api/chat', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ message: value, lang: lang, lastTopicId: state.lastTopicId, leadState: state.leadState })
      }).then(function (res) {
        if (!res.ok) throw new Error('bad status ' + res.status);
        return res.json();
      }),
      minDelay
    ]).then(function (results) {
      var data = results[0];
      hideTyping();
      setBusy(false);
      state.messages.push({ role: 'bot', text: data.reply });
      state.lastTopicId = data.topicId || null;
      state.leadState = data.leadState || null;
      renderMessages();
      renderQuickReplies(data.quickReplies || []);
      saveState();
      input.focus();
    }).catch(function () {
      hideTyping();
      setBusy(false);
      state.messages.push({ role: 'bot', text: chrome().error });
      renderMessages();
      saveState();
    });
  }

  function hideTeaser() {
    teaser.classList.remove('show');
  }

  // A one-time nudge per browser tab so a first-time visitor notices the
  // widget: fades in a few seconds after load, auto-hides itself after a
  // while, and never reappears again this session once shown or dismissed.
  function maybeShowTeaser() {
    if (state.isOpen) return;
    try {
      if (sessionStorage.getItem(TEASER_KEY) === '1') return;
    } catch (e) { /* storage unavailable, just skip the teaser */ }

    setTimeout(function () {
      if (panel.classList.contains('open')) return;
      teaserText.textContent = chrome().teaser;
      teaser.classList.add('show');
      try { sessionStorage.setItem(TEASER_KEY, '1'); } catch (e) { /* storage unavailable */ }
      setTimeout(hideTeaser, 9000);
    }, 2500);
  }

  teaser.addEventListener('click', function () {
    hideTeaser();
    openPanel();
  });
  teaserClose.addEventListener('click', function (e) {
    e.stopPropagation();
    hideTeaser();
  });

  function openPanel() {
    state.isOpen = true;
    hideTeaser();
    panel.classList.add('open');
    launcher.classList.add('open');
    launcher.setAttribute('aria-expanded', 'true');
    applyChrome();
    ensureGreeting();
    saveState();
    input.focus();
  }

  function closePanel() {
    state.isOpen = false;
    panel.classList.remove('open');
    launcher.classList.remove('open');
    launcher.setAttribute('aria-expanded', 'false');
    saveState();
  }

  launcher.addEventListener('click', function () {
    if (panel.classList.contains('open')) closePanel(); else openPanel();
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && panel.classList.contains('open')) closePanel();
  });

  sendBtn.addEventListener('click', function () {
    if (input.value.trim()) sendMessage(input.value);
  });
  input.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' && input.value.trim()) sendMessage(input.value);
  });

  // Restore prior state within this browser tab (persists across page
  // navigation, cleared when the tab closes).
  renderMessages();
  if (state.isOpen) openPanel();
  else maybeShowTeaser();
})();
