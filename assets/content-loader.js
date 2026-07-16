// Shared across every page. Pulls this page's editable copy/media from the
// backend content API (see backend/data/content/<page>.json, edited from the
// admin panel's "Website content" tab) and applies it to the DOM, using three
// marker attributes:
//
//   data-ckey="section.field"      plain bilingual text -> sets data-de/data-en
//   data-cmedia="section.field"    image/video src -> swaps in the uploaded file
//   data-clist="section.listKey"   repeatable list container; its first child
//                                  marked data-citem is the template, cloned
//                                  once per array entry. Fields inside a clone
//                                  use data-cfield="itemFieldKey" for text, or
//                                  data-cmediafield="itemFieldKey" for an
//                                  image/video whose src comes from that item
//                                  (as opposed to data-cmedia, which always
//                                  resolves against the top-level content).
//
// After applying content, it re-runs the page's own applyLang(), so the
// DE/EN toggle keeps working on freshly-loaded text.
(function () {
  var CONTENT_API_BASE = '';

  function resolvePath(obj, path) {
    var parts = path.split('.');
    var node = obj;
    for (var i = 0; i < parts.length; i++) {
      if (node == null) return undefined;
      node = node[parts[i]];
    }
    return node;
  }

  function applyBilingual(el, node) {
    if (!node || typeof node.de !== 'string') return;
    el.setAttribute('data-de', node.de);
    el.setAttribute('data-en', node.en || node.de);
  }

  function applyContent(content) {
    document.querySelectorAll('[data-ckey]').forEach(function (el) {
      applyBilingual(el, resolvePath(content, el.getAttribute('data-ckey')));
    });

    document.querySelectorAll('[data-clist]').forEach(function (container) {
      var items = resolvePath(content, container.getAttribute('data-clist'));
      if (!Array.isArray(items) || !items.length) return;
      var template = container.querySelector('[data-citem]');
      if (!template) return;
      var frag = document.createDocumentFragment();
      items.forEach(function (item) {
        var clone = template.cloneNode(true);
        var fieldEls = clone.querySelectorAll('[data-cfield]');
        if (fieldEls.length) {
          // itemType 'fields': each named sub-element gets its own value.
          fieldEls.forEach(function (fieldEl) {
            applyBilingual(fieldEl, item[fieldEl.getAttribute('data-cfield')]);
          });
        } else if (typeof item.de === 'string') {
          // itemType 'text': the item itself is a { de, en } pair, applied to
          // the descendant marked data-ctext (or the clone root if none).
          applyBilingual(clone.querySelector('[data-ctext]') || clone, item);
        }
        clone.querySelectorAll('[data-cmediafield]').forEach(function (mediaEl) {
          var path = item[mediaEl.getAttribute('data-cmediafield')];
          if (!path) return;
          if (mediaEl.tagName === 'IMG') {
            mediaEl.src = path;
          } else if (mediaEl.tagName === 'VIDEO') {
            mediaEl.src = path;
          }
        });
        frag.appendChild(clone);
      });
      container.innerHTML = '';
      container.appendChild(frag);
    });

    document.querySelectorAll('[data-cmedia]').forEach(function (el) {
      var path = resolvePath(content, el.getAttribute('data-cmedia'));
      if (!path) return;
      if (el.tagName === 'IMG') {
        el.src = path;
        el.closest('[data-cmedia-wrap]') && el.closest('[data-cmedia-wrap]').classList.add('has-media');
      } else if (el.tagName === 'VIDEO') {
        el.setAttribute('data-src', path);
        // Some pages lazy-load the real source only under certain
        // conditions (see loadRealVideoSource in glass-theme.html) — only
        // force a reload here if that already happened for this element.
        if (el.hasAttribute('src')) {
          el.src = path;
          el.load();
        }
      }
    });

    if (typeof window.applyLang === 'function') {
      window.applyLang(document.documentElement.lang === 'en' ? 'en' : 'de');
    } else {
      var lang = document.documentElement.lang === 'en' ? 'en' : 'de';
      document.querySelectorAll('[data-de]').forEach(function (el) {
        var val = el.getAttribute('data-' + lang);
        if (val !== null) el.innerHTML = val;
      });
    }
    document.dispatchEvent(new CustomEvent('apex-content-loaded'));
  }

  function boot() {
    // This script is loaded from <head> (alongside meta-pixel.js /
    // cookie-consent.js), before <body> exists — data-content-page lives on
    // <body>, so this has to wait for the DOM instead of reading it eagerly.
    var page = document.body.getAttribute('data-content-page');
    if (!page) return;
    fetch(CONTENT_API_BASE + '/api/content/' + page, { cache: 'no-store' })
      .then(function (res) { return res.ok ? res.json() : null; })
      .then(function (content) { if (content) applyContent(content); })
      .catch(function () { /* content API unreachable — keep static defaults */ });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
