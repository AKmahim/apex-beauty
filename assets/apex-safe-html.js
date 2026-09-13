// Safe replacement for `el.innerHTML = value` on the language-switching path.
//
// applyLang() reads a data-de/data-en/... attribute and writes it back as
// markup, because a translated headline legitimately contains <span> and a
// paragraph contains <a>. That makes every one of those attributes an
// innerHTML sink. The server already sanitises what it writes into them
// (includes/security.php), so this is the second lock: if a value ever
// reaches the DOM from somewhere the server did not clean, it is cleaned here
// before it is parsed.
//
// The allowlist mirrors APEX_HTML_ALLOWED on the server, so a tag that
// survives one survives the other and nothing disappears only in the browser.
(function () {
  'use strict';

  var CONFIG = {
    ALLOWED_TAGS: [
      'a', 'span', 'strong', 'b', 'em', 'i', 'u', 'mark', 'small', 'sup', 'sub',
      's', 'del', 'ins', 'br', 'hr', 'p', 'div', 'h1', 'h2', 'h3', 'h4', 'h5',
      'h6', 'ul', 'ol', 'li', 'blockquote', 'cite', 'q', 'figure', 'figcaption',
      'img', 'picture', 'source', 'table', 'thead', 'tbody', 'tfoot', 'tr',
      'td', 'th', 'abbr', 'time', 'code', 'pre'
    ],
    ALLOWED_ATTR: [
      'href', 'title', 'target', 'rel', 'class', 'id', 'download', 'src', 'alt',
      'width', 'height', 'loading', 'srcset', 'type', 'media', 'colspan',
      'rowspan', 'scope', 'datetime'
    ],
    ALLOW_DATA_ATTR: false,
    USE_PROFILES: { html: true }
  };

  // A link opened in a new tab must not be able to reach back through
  // window.opener.
  if (window.DOMPurify && typeof window.DOMPurify.addHook === 'function') {
    window.DOMPurify.addHook('afterSanitizeAttributes', function (node) {
      if (node.tagName === 'A' && node.getAttribute('target') === '_blank') {
        node.setAttribute('rel', 'noopener noreferrer');
      }
    });
  }

  window.apexSetHTML = function (el, html) {
    if (!el) return;
    if (html === null || html === undefined) return;

    if (window.DOMPurify && typeof window.DOMPurify.sanitize === 'function') {
      el.innerHTML = window.DOMPurify.sanitize(String(html), CONFIG);
      return;
    }

    // DOMPurify failed to load. Degrade to text rather than to raw markup:
    // the page loses its inline formatting for that string and keeps its
    // words, which is the right way round for a failure nobody is watching.
    el.textContent = String(html);
  };
}());
