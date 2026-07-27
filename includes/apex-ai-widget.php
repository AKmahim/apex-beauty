<?php
// Site-wide floating "Apex AI" chat widget. Included near the end of every
// page's <body> (see index.php, hairpedia.php, service-hair-transplant.php,
// doctor.php, contact.php, privacy.php), mirroring the whatsapp-fab already
// on every page but pinned to the opposite (left) side.
if (!defined('APEX_AI_WIDGET_EMITTED')):
define('APEX_AI_WIDGET_EMITTED', true);
?>
<style>
  .apex-ai-launcher {
    position: fixed; bottom: 24px; left: 24px; z-index: 90;
    width: 56px; height: 56px; border-radius: 50%;
    background: linear-gradient(135deg, var(--teal-500), var(--blue-700));
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 16px 36px -10px rgba(0,0,0,0.38), 0 6px 14px -6px rgba(0,0,0,0.22);
    transition: box-shadow 0.2s ease;
    border: none; cursor: pointer; color: #fff;
    animation: apexAiFloat 2.8s ease-in-out infinite, apexAiPulse 2.6s ease-out 1.2s 2;
  }
  .apex-ai-launcher:hover {
    animation-play-state: paused;
    transform: translateY(-4px) scale(1.07);
    box-shadow: 0 22px 44px -10px rgba(0,0,0,0.42), 0 10px 22px -6px rgba(0,0,0,0.28);
  }
  .apex-ai-launcher.open { animation: none; }
  .apex-ai-launcher svg { width: 28px; height: 28px; display: block; }
  .apex-ai-launcher.open svg.ic-chat { display: none; }
  .apex-ai-launcher svg.ic-close { display: none; }
  .apex-ai-launcher.open svg.ic-close { display: block; }
  @keyframes apexAiFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-7px); }
  }
  @keyframes apexAiPulse {
    0%, 100% { box-shadow: 0 16px 36px -10px rgba(0,0,0,0.38), 0 6px 14px -6px rgba(0,0,0,0.22), 0 0 0 0 rgba(14,165,233,0.5); }
    50% { box-shadow: 0 16px 36px -10px rgba(0,0,0,0.38), 0 6px 14px -6px rgba(0,0,0,0.22), 0 0 0 10px rgba(14,165,233,0); }
  }

  .apex-ai-teaser {
    position: fixed; bottom: 32px; left: 88px; z-index: 89;
    max-width: 220px; background: #fff; color: var(--ink);
    border-radius: 14px; padding: 11px 30px 11px 14px; font-size: 13px; font-weight: 700;
    box-shadow: 0 14px 32px -10px rgba(15,32,39,0.28), 0 6px 16px -8px rgba(15,32,39,0.18);
    display: none; align-items: center; cursor: pointer; line-height: 1.35;
    animation: apexAiTeaserIn 0.3s ease;
  }
  .apex-ai-teaser.show { display: flex; }
  .apex-ai-teaser::after {
    content: ''; position: absolute; left: -6px; top: 50%; margin-top: -6px;
    width: 12px; height: 12px; background: #fff; transform: rotate(45deg);
    box-shadow: -2px 2px 4px -2px rgba(15,32,39,0.15);
  }
  .apex-ai-teaser-close {
    position: absolute; top: 4px; right: 4px; width: 20px; height: 20px; border: none; background: none;
    color: var(--ink-soft); cursor: pointer; font-size: 15px; line-height: 1; border-radius: 50%;
    display: flex; align-items: center; justify-content: center; padding: 0;
  }
  .apex-ai-teaser-close:hover { background: var(--paper); }
  @keyframes apexAiTeaserIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @media (max-width: 640px) {
    .apex-ai-teaser { left: 72px; bottom: 24px; max-width: 175px; font-size: 12.5px; padding: 9px 26px 9px 12px; }
  }

  .apex-ai-panel {
    position: fixed; bottom: 92px; left: 24px; z-index: 91;
    width: 360px; max-width: calc(100vw - 32px); height: 520px; max-height: calc(100vh - 140px);
    background: #fff; border-radius: 18px; overflow: hidden;
    box-shadow: 0 30px 70px -20px rgba(15,32,39,0.35), 0 10px 26px -10px rgba(15,32,39,0.2);
    display: none; flex-direction: column;
    font-family: inherit;
  }
  .apex-ai-panel.open { display: flex; }

  .apex-ai-head {
    background: linear-gradient(135deg, var(--blue-700), var(--teal-600));
    color: #fff; padding: 14px 16px; flex: none;
  }
  .apex-ai-head .name { font-weight: 800; font-size: 15px; letter-spacing: 0.01em; }
  .apex-ai-head .sub { font-size: 11.5px; opacity: 0.85; margin-top: 2px; }

  .apex-ai-messages {
    flex: 1; overflow-y: auto; padding: 14px 14px 6px; display: flex; flex-direction: column; gap: 10px;
    background: var(--paper);
  }
  .apex-ai-msg { max-width: 84%; padding: 9px 12px; border-radius: 14px; font-size: 13.5px; line-height: 1.45; white-space: pre-line; }
  .apex-ai-msg.bot { align-self: flex-start; background: #fff; color: var(--ink); border: 1px solid var(--line, #dbe6f2); border-bottom-left-radius: 4px; }
  .apex-ai-msg.user { align-self: flex-end; background: var(--blue-600); color: #fff; border-bottom-right-radius: 4px; }
  .apex-ai-msg.typing { display: flex; align-items: center; gap: 4px; padding: 12px; }
  .apex-ai-msg.typing span { width: 6px; height: 6px; border-radius: 50%; background: var(--ink-soft, #45596a); opacity: 0.5; animation: apexAiTyping 1s infinite ease-in-out; }
  .apex-ai-msg.typing span:nth-child(2) { animation-delay: 0.15s; }
  .apex-ai-msg.typing span:nth-child(3) { animation-delay: 0.3s; }
  @keyframes apexAiTyping { 0%, 60%, 100% { transform: translateY(0); opacity: 0.4; } 30% { transform: translateY(-4px); opacity: 1; } }

  .apex-ai-quick { display: flex; flex-wrap: wrap; gap: 6px; padding: 4px 14px 10px; flex: none; background: var(--paper); }
  .apex-ai-quick button {
    border: 1.5px solid var(--teal-500); background: #fff; color: var(--blue-700);
    border-radius: 999px; padding: 6px 12px; font-size: 12px; font-weight: 600; cursor: pointer;
    transition: background 0.15s ease, color 0.15s ease;
  }
  .apex-ai-quick button:hover { background: var(--teal-500); color: #fff; }

  .apex-ai-inputrow { flex: none; display: flex; gap: 8px; padding: 10px; border-top: 1px solid var(--line, #dbe6f2); background: #fff; }
  .apex-ai-inputrow input {
    flex: 1; border: 1.5px solid var(--line, #dbe6f2); border-radius: 10px; padding: 9px 12px; font-size: 13.5px; font-family: inherit;
  }
  .apex-ai-inputrow input:focus { outline: none; border-color: var(--blue-600); }
  .apex-ai-inputrow button {
    border: none; background: var(--blue-600); color: #fff; border-radius: 10px; padding: 0 16px; font-size: 13px; font-weight: 700; cursor: pointer;
  }
  .apex-ai-inputrow button:hover { background: var(--blue-700); }
  .apex-ai-inputrow button:disabled { opacity: 0.5; cursor: default; }

  @media (max-width: 640px) {
    .apex-ai-launcher { bottom: 16px; left: 16px; width: 50px; height: 50px; }
    .apex-ai-panel { bottom: 78px; left: 8px; width: calc(100vw - 16px); height: calc(100vh - 110px); }
  }
</style>

<button type="button" class="apex-ai-launcher" id="apexAiLauncher" aria-label="Apex AI" aria-expanded="false">
  <svg class="ic-chat" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
  <svg class="ic-close" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
</button>

<div class="apex-ai-teaser" id="apexAiTeaser">
  <span id="apexAiTeaserText"></span>
  <button type="button" class="apex-ai-teaser-close" id="apexAiTeaserClose" aria-label="Dismiss">&times;</button>
</div>

<div class="apex-ai-panel" id="apexAiPanel" role="dialog" aria-label="Apex AI chat">
  <div class="apex-ai-head">
    <div class="name">Apex AI</div>
    <div class="sub" id="apexAiSubtitle"></div>
  </div>
  <div class="apex-ai-messages" id="apexAiMessages"></div>
  <div class="apex-ai-quick" id="apexAiQuick"></div>
  <div class="apex-ai-inputrow">
    <input type="text" id="apexAiInput" maxlength="500" autocomplete="off">
    <button type="button" id="apexAiSend"></button>
  </div>
</div>

<script src="assets/apex-ai.js" defer></script>
<?php endif; ?>
