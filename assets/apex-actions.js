// Delegated event dispatcher.
//
// Every interactive element on this site used to carry its behaviour in an
// inline attribute - onclick="toggleChip(this); validateStep2()" and so on,
// 140 of them across the templates. Inline handlers are script, so keeping
// them meant keeping 'unsafe-inline' in the Content-Security-Policy, and
// 'unsafe-inline' in script-src is most of what a CSP is for.
//
// The markup now declares intent (data-click="chip") instead of code, and
// this file maps intent to the page functions. One listener per event type on
// the document, so it also covers elements added after load - the consultation
// modal's chips and the before/after rows used to need their handlers written
// into every generated row.
//
// The page functions themselves are unchanged and still defined by each
// page's own script block; they are looked up at call time so a page that
// does not define one simply does nothing rather than throwing.
(function () {
  'use strict';

  function call(name, args) {
    var fn = window[name];
    if (typeof fn === 'function') {
      return fn.apply(window, args || []);
    }
    return undefined;
  }

  var CLICK = {
    'chip': function (el) { call('toggleChip', [el]); call('validateStep2'); },
    'pick': function (el) { call('pickSingle', [el, el.getAttribute('data-row')]); call('validateStep2'); },
    'faq': function (el) { call('toggleFaq', [el]); },
    'step': function (el) { call('gotoStep', [Number(el.getAttribute('data-step'))]); },
    'whatsapp': function () { call('trackWhatsAppContact'); },
    'open-consult': function (el, event) { call('openConsult', [event]); },
    'close-consult': function () { call('closeConsult'); },
    'submit-consult': function () { call('submitConsult'); },
    'close-announce': function () { call('closeAnnounceBar'); },
    'noop': function () { /* was onclick="return false;" - see handler below */ }
  };

  var CHANGE = {
    'validate3': function () { call('validateStep3'); },
    'prefix': function () { call('updatePrefix'); call('validateStep1'); },
    'slot': function (el) { call('markSlot', [el, el.getAttribute('data-slot')]); }
  };

  var INPUT = {
    'validate1': function () { call('validateStep1'); }
  };

  function bind(eventName, attribute, table) {
    document.addEventListener(eventName, function (event) {
      var target = event.target;
      if (!target || typeof target.closest !== 'function') return;
      var el = target.closest('[' + attribute + ']');
      if (!el) return;
      var action = el.getAttribute(attribute);
      var handler = table[action];
      if (!handler) return;
      // The one handler that existed purely to cancel the default action.
      if (action === 'noop') { event.preventDefault(); return; }
      handler(el, event);
    }, false);
  }

  bind('click', 'data-click', CLICK);
  bind('change', 'data-change', CHANGE);
  bind('input', 'data-input', INPUT);
}());
