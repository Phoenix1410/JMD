/**
 * Paarcel3u Embeddable Bilingual Chatbot Widget
 * State Machine Driven Decision-Tree Logic (English & Hindi)
 * 
 * Version: 1.0.1
 * Pure Vanilla JavaScript (Zero external dependencies)
 */

(function (window, document) {
  'use strict';

  // State Definitions
  const STATES = {
    INIT: 'INIT',                     // State 0: Language selection
    MAIN_MENU: 'MAIN_MENU',           // State 1: Main menu options
    TRACK_PROMPT: 'TRACK_PROMPT',     // State 2: Prompting for Tracking ID
    BRANCH_INPUT: 'BRANCH_INPUT',     // State 3: Branch autocomplete search
    QUERY_INPUT: 'QUERY_INPUT',       // State 4a: Support query text
    CONTACT_INPUT: 'CONTACT_INPUT'    // State 4b: Support contact info
  };

  // Mock tracking database for offline / standalone preview & fallbacks
  const MOCK_TRACKING_DATA = {
    'P3U1001': {
      status: 200,
      data: {
        tracking_id: 'P3U1001',
        status_en: 'In Transit',
        status_hi: 'रास्ते में है',
        eta: '2026-10-15 18:00',
        branch_contact: '+91 9775531166',
        branch_map_url: 'https://maps.google.com/?q=22.5726,88.3639'
      }
    },
    'P3U1002': {
      status: 200,
      data: {
        tracking_id: 'P3U1002',
        status_en: 'Out for Delivery',
        status_hi: 'डिलीवरी के लिए निकल चुका है',
        eta: '2026-10-12 14:30',
        branch_contact: '+91 9820012345',
        branch_map_url: 'https://maps.google.com/?q=19.1136,72.8697'
      }
    },
    'P3U1003': {
      status: 200,
      data: {
        tracking_id: 'P3U1003',
        status_en: 'Delivered',
        status_hi: 'डिलीवर हो चुका है',
        eta: '2026-10-10 11:20',
        branch_contact: '+91 9811098765',
        branch_map_url: 'https://maps.google.com/?q=28.5355,77.2732'
      }
    },
    'P3U500': {
      status: 500,
      error: 'Simulated server error'
    }
  };

  // Safe HTML string escaping
  function escapeHTML(str) {
    if (typeof str !== 'string') return '';
    return str
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  // Debounce helper
  function debounce(fn, delay) {
    let timer = null;
    return function (...args) {
      clearTimeout(timer);
      timer = setTimeout(() => fn.apply(this, args), delay);
    };
  }

  class Paarcel3uWidget {
    constructor(options = {}) {
      this.options = Object.assign({
        apiBase: '',
        branchesUrl: '/branches.json', /* FIXED: Absolute path for Vite */
        trackEndpoint: '/api/track',
        ticketEndpoint: '/api/support/ticket',
        autoOpen: false,
        mockFallback: true
      }, options);

      // Runtime State
      this.isOpen = false;
      this.currentState = STATES.INIT;
      this.currentLang = 'en'; // 'en' | 'hi'
      this.pendingTicket = { query: '', contact: '' };
      this.branches = [];
      this.selectedSuggestionIndex = -1;
      this.currentSuggestions = [];

      this.initDOM();
      this.loadBranches();
      this.setupEventListeners();
      this.startConversation();
    }

    // 1. DOM Hierarchy Construction
    initDOM() {
      const existingRoot = document.getElementById('p3u-chatbot-root');
      if (existingRoot) existingRoot.remove();

      this.root = document.createElement('div');
      this.root.id = 'p3u-chatbot-root';

      this.root.innerHTML = `
        <button type="button" class="p3u-launcher-btn" id="p3u-launcher-btn" aria-label="Open Customer Chat" title="Paarcel3u Chatbot">
          <span class="p3u-launcher-pulse"></span>
          <svg class="p3u-launcher-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 2H4C2.9 2 2 2.9 2 4V22L6 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2ZM20 16H5.17L4 17.17V4H20V16Z" fill="currentColor"/>
            <path d="M7 9H17V11H7V9ZM7 6H17V8H7V6ZM7 12H14V14H7V12Z" fill="currentColor"/>
          </svg>
          <span class="p3u-launcher-close-icon">✕</span>
        </button>

        <div class="p3u-window" id="p3u-window" role="dialog" aria-modal="true" aria-label="Paarcel3u Virtual Assistant">
          <div class="p3u-header">
            <div class="p3u-brand-info">
              <div class="p3u-avatar">
                <svg viewBox="0 0 24 24" fill="currentColor">
                  <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                </svg>
              </div>
              <div class="p3u-brand-text">
                <div class="p3u-brand-title">Paarcel3u Assistant</div>
                <div class="p3u-status-indicator">
                  <span class="p3u-status-dot"></span>
                  <span id="p3u-status-text">Online • 24/7 Support</span>
                </div>
              </div>
            </div>
            <div class="p3u-header-controls">
              <button type="button" class="p3u-header-btn" id="p3u-reset-btn" title="Reset Conversation" aria-label="Reset Conversation">↺</button>
              <button type="button" class="p3u-header-btn" id="p3u-close-btn" title="Close Chat" aria-label="Close Chat">✕</button>
            </div>
          </div>

          <div class="p3u-messages" id="p3u-messages"></div>

          <div class="p3u-input-area" id="p3u-input-area">
            <ul class="p3u-suggestions" id="p3u-suggestions"></ul>
            <div class="p3u-input-row" id="p3u-input-row">
              <input type="text" class="p3u-input" id="p3u-input" placeholder="Select an option above..." autocomplete="off" disabled />
              <button type="button" class="p3u-send-btn" id="p3u-send-btn" disabled aria-label="Send Message">
                <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
              </button>
            </div>
            <div class="p3u-footer-tag">Official Support by <a href="http://paarcel3u.in" target="_blank" rel="noopener">Paarcel3u.in</a></div>
          </div>
        </div>
      `;

      document.body.appendChild(this.root);

      this.launcherBtn = this.root.querySelector('#p3u-launcher-btn');
      this.chatWindow = this.root.querySelector('#p3u-window');
      this.messagesContainer = this.root.querySelector('#p3u-messages');
      this.inputField = this.root.querySelector('#p3u-input');
      this.sendBtn = this.root.querySelector('#p3u-send-btn');
      this.suggestionsList = this.root.querySelector('#p3u-suggestions');
      this.resetBtn = this.root.querySelector('#p3u-reset-btn');
      this.closeBtn = this.root.querySelector('#p3u-close-btn');

      if (this.options.autoOpen) {
        this.open();
      }
    }

    async loadBranches() {
      try {
        const response = await fetch(this.options.branchesUrl);
        if (response.ok) {
          this.branches = await response.json();
        } else {
          console.warn('[Paarcel3u Chatbot] Failed to load branches.json:', response.status);
        }
      } catch (err) {
        console.warn('[Paarcel3u Chatbot] Error loading branches.json:', err);
      }
    }

    setupEventListeners() {
      this.launcherBtn.addEventListener('click', () => this.toggle());
      this.closeBtn.addEventListener('click', () => this.close());
      this.resetBtn.addEventListener('click', () => this.resetConversation());
      this.sendBtn.addEventListener('click', () => this.handleUserInputSubmit());

      this.inputField.addEventListener('keydown', (e) => {
        if (this.currentState === STATES.BRANCH_INPUT && this.currentSuggestions.length > 0) {
          if (e.key === 'ArrowDown') {
            e.preventDefault();
            this.selectedSuggestionIndex = Math.min(this.selectedSuggestionIndex + 1, this.currentSuggestions.length - 1);
            this.renderSuggestions();
            return;
          }
          if (e.key === 'ArrowUp') {
            e.preventDefault();
            this.selectedSuggestionIndex = Math.max(this.selectedSuggestionIndex - 1, 0);
            this.renderSuggestions();
            return;
          }
          if (e.key === 'Enter') {
            e.preventDefault();
            if (this.selectedSuggestionIndex >= 0 && this.selectedSuggestionIndex < this.currentSuggestions.length) {
              const selectedBranch = this.currentSuggestions[this.selectedSuggestionIndex];
              this.selectBranch(selectedBranch);
              return;
            }
          }
        }
        if (e.key === 'Enter') {
          e.preventDefault();
          this.handleUserInputSubmit();
        }
      });

      const onAutocomplete = debounce(() => {
        if (this.currentState === STATES.BRANCH_INPUT) {
          this.handleBranchSearch(this.inputField.value);
        }
      }, 150);

      this.inputField.addEventListener('input', () => {
        this.updateSendButtonState();
        onAutocomplete();
      });

      document.addEventListener('click', (e) => {
        if (!this.root.contains(e.target)) {
          this.hideSuggestions();
        }
      });
    }

    toggle() {
      this.isOpen ? this.close() : this.open();
    }

    open() {
      this.isOpen = true;
      this.chatWindow.classList.add('p3u-open');
      this.launcherBtn.classList.add('p3u-active');
      if (!this.inputField.disabled) {
        setTimeout(() => this.inputField.focus(), 250);
      }
    }

    close() {
      this.isOpen = false;
      this.chatWindow.classList.remove('p3u-open');
      this.launcherBtn.classList.remove('p3u-active');
      this.hideSuggestions();
    }

    scrollToBottom() {
      setTimeout(() => {
        this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
      }, 50);
    }

    appendBotMessage(text, options = null, richCardHTML = '') {
      const row = document.createElement('div');
      row.className = 'p3u-msg-row p3u-bot';
      let inner = `
        <div class="p3u-bubble-avatar">P</div>
        <div class="p3u-bubble">
          ${text ? `<div>${escapeHTML(text).replace(/\n/g, '<br/>')}</div>` : ''}
          ${richCardHTML}
          ${options && options.length > 0 ? `<div class="p3u-options-container"></div>` : ''}
        </div>
      `;
      row.innerHTML = inner;

      if (options && options.length > 0) {
        const optsContainer = row.querySelector('.p3u-options-container');
        options.forEach(opt => {
          const btn = document.createElement('button');
          btn.type = 'button';
          btn.className = `p3u-option-btn ${opt.isMainMenu ? 'p3u-main-menu-btn' : ''}`;
          btn.innerHTML = `<span>${escapeHTML(opt.label)}</span> <span>→</span>`;
          btn.addEventListener('click', () => opt.onClick());
          optsContainer.appendChild(btn);
        });
      }
      this.messagesContainer.appendChild(row);
      this.scrollToBottom();
    }

    appendUserMessage(text) {
      const row = document.createElement('div');
      row.className = 'p3u-msg-row p3u-user';
      row.innerHTML = `<div class="p3u-bubble">${escapeHTML(text).replace(/\n/g, '<br/>')}</div>`;
      this.messagesContainer.appendChild(row);
      this.scrollToBottom();
    }

    showTypingIndicator() {
      const indicator = document.createElement('div');
      indicator.className = 'p3u-msg-row p3u-bot p3u-typing-row';
      indicator.innerHTML = `
        <div class="p3u-bubble-avatar">P</div>
        <div class="p3u-typing">
          <span class="p3u-dot"></span>
          <span class="p3u-dot"></span>
          <span class="p3u-dot"></span>
        </div>
      `;
      this.messagesContainer.appendChild(indicator);
      this.scrollToBottom();
      return indicator;
    }

    removeTypingIndicator() {
      this.messagesContainer.querySelectorAll('.p3u-typing-row').forEach(el => el.remove());
    }

    enableInput(placeholder, initialValue = '') {
      this.inputField.disabled = false;
      this.inputField.placeholder = placeholder;
      this.inputField.value = initialValue;
      this.updateSendButtonState();
      setTimeout(() => this.inputField.focus(), 100);
    }

    disableInput(placeholder) {
      this.inputField.disabled = true;
      this.inputField.value = '';
      this.inputField.placeholder = placeholder || (this.currentLang === 'hi' ? 'कृपया ऊपर एक विकल्प चुनें...' : 'Select an option above...');
      this.sendBtn.disabled = true;
      this.hideSuggestions();
    }

    updateSendButtonState() {
      if (this.inputField.disabled) {
        this.sendBtn.disabled = true;
      } else {
        this.sendBtn.disabled = this.inputField.value.trim().length === 0;
      }
    }

    startConversation() {
      this.currentState = STATES.INIT;
      this.disableInput();
      this.appendBotMessage(
        "Please select your language / कृपया अपनी भाषा चुनें:",
        [
          { label: "English", onClick: () => this.selectLanguage('en') },
          { label: "हिंदी", onClick: () => this.selectLanguage('hi') }
        ]
      );
    }

    selectLanguage(lang) {
      this.currentLang = lang;
      this.appendUserMessage(lang === 'hi' ? 'हिंदी' : 'English');
      this.transitionToMainMenu();
    }

    transitionToMainMenu() {
      this.currentState = STATES.MAIN_MENU;
      this.disableInput();
      const isHi = this.currentLang === 'hi';
      const promptText = isHi ? "आज हम आपकी क्या सहायता कर सकते हैं?" : "How can I help you today?";

      const options = [
        {
          label: isHi ? "📦 पार्सल ट्रैक करें" : "📦 Track your shipment",
          onClick: () => {
            this.appendUserMessage(isHi ? "📦 पार्सल ट्रैक करें" : "📦 Track your shipment");
            this.transitionToTrackPrompt();
          }
        },
        {
          label: isHi ? "📍 शाखा की जानकारी" : "📍 Branch details",
          onClick: () => {
            this.appendUserMessage(isHi ? "📍 शाखा की जानकारी" : "📍 Branch details");
            this.transitionToBranchInput();
          }
        },
        {
          label: isHi ? "💬 अपनी समस्या बताएं" : "💬 Tell us about your query",
          onClick: () => {
            this.appendUserMessage(isHi ? "💬 अपनी समस्या बताएं" : "💬 Tell us about your query");
            this.transitionToQueryInput();
          }
        }
      ];
      this.appendBotMessage(promptText, options);
    }

    getMainMenuOption() {
      const isHi = this.currentLang === 'hi';
      return [
        {
          label: isHi ? "⬅ मुख्य मेन्यू" : "⬅ Main Menu",
          isMainMenu: true,
          onClick: () => {
            this.appendUserMessage(isHi ? "मुख्य मेन्यू" : "Main Menu");
            this.transitionToMainMenu();
          }
        }
      ];
    }

    resetConversation() {
      this.messagesContainer.innerHTML = '';
      this.currentLang = 'en';
      this.pendingTicket = { query: '', contact: '' };
      this.hideSuggestions();
      this.startConversation();
    }

    transitionToTrackPrompt() {
      this.currentState = STATES.TRACK_PROMPT;
      const isHi = this.currentLang === 'hi';
      const botPrompt = isHi ? "कृपया अपना ट्रैकिंग नंबर दर्ज करें:" : "Please enter your Tracking ID:";
      const placeholder = isHi ? "उदा. P3U1001" : "e.g. P3U1001";
      this.appendBotMessage(botPrompt);
      this.enableInput(placeholder);
    }

    async handleTrackingSubmit(rawId) {
      const isHi = this.currentLang === 'hi';
      const sanitizedId = (rawId || '').replace(/\s+/g, '');
      const trackingRegex = /^[A-Za-z0-9]{4,25}$/;
      
      if (!trackingRegex.test(sanitizedId)) {
        const errorMsg = isHi ? "अमान्य ट्रैकिंग नंबर। कृपया सही अक्षरांकीय कोड दर्ज करें।" : "Invalid Tracking ID. Please enter a valid alphanumeric code.";
        this.appendBotMessage(errorMsg);
        this.enableInput(isHi ? "उदा. P3U1001" : "e.g. P3U1001");
        return;
      }

      this.disableInput(isHi ? "खोज रहे हैं..." : "Searching...");
      const typingEl = this.showTypingIndicator();

      try {
        let result = null;
        let statusCode = 200;
        const endpointUrl = `${this.options.apiBase}${this.options.trackEndpoint}?id=${encodeURIComponent(sanitizedId)}`;
        
        try {
          const res = await fetch(endpointUrl, { headers: { 'Accept': 'application/json' } });
          statusCode = res.status;
          if (res.ok) {
            result = await res.json();
          } else if (res.status === 404 || res.status === 500) {
            result = null;
          }
        } catch (networkErr) {
          if (this.options.mockFallback) {
            if (MOCK_TRACKING_DATA[sanitizedId]) {
              const mock = MOCK_TRACKING_DATA[sanitizedId];
              statusCode = mock.status;
              result = mock.data || null;
            } else if (sanitizedId.toUpperCase().includes('500')) {
              statusCode = 500;
              result = null;
            } else {
              statusCode = 404;
              result = null;
            }
          } else {
            statusCode = 500;
          }
        }

        await new Promise(r => setTimeout(r, 600));
        this.removeTypingIndicator();

        if (statusCode === 200 && result) {
          const cardHtml = `
            <div class="p3u-card">
              <div class="p3u-card-header">
                <span>📦 ${escapeHTML(result.tracking_id || sanitizedId)}</span>
                <span class="p3u-card-badge status-in-transit">${escapeHTML(isHi ? result.status_hi : result.status_en)}</span>
              </div>
              <div class="p3u-card-body">
                <div class="p3u-card-item"><strong>${isHi ? 'स्थिति:' : 'Status:'}</strong><span>${escapeHTML(isHi ? result.status_hi : result.status_en)}</span></div>
                <div class="p3u-card-item"><strong>${isHi ? 'डिलीवरी:' : 'Estimated Delivery:'}</strong><span>${escapeHTML(result.eta)}</span></div>
                <div class="p3u-card-item"><strong>${isHi ? 'शाखा संपर्क:' : 'Branch Contact:'}</strong><a href="tel:${escapeHTML(result.branch_contact)}" style="color: inherit; text-decoration: underline;">${escapeHTML(result.branch_contact)}</a></div>
                <div class="p3u-card-item"><strong>${isHi ? 'दिशा-निर्देश:' : 'Directions:'}</strong><a href="${escapeHTML(result.branch_map_url)}" target="_blank" rel="noopener noreferrer" class="p3u-card-link">${isHi ? 'Google Maps पर देखें' : 'View on Google Maps'}<svg viewBox="0 0 24 24"><path d="M14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3m-2 16H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7z"/></svg></a></div>
              </div>
            </div>
          `;
          const introMsg = isHi ? "Paarcel3u से संपर्क करने के लिए धन्यवाद। आपके पार्सल की वर्तमान स्थिति:" : "Hi! Thank you for reaching out to Paarcel3u. Here is the current status of your shipment:";
          this.appendBotMessage(introMsg, this.getMainMenuOption(), cardHtml);
        } else if (statusCode === 404) {
          const notFoundMsg = isHi ? `आईडी '${escapeHTML(sanitizedId)}' का कोई पार्सल नहीं मिला। कृपया नंबर जांचें और पुनः प्रयास करें।` : `No shipment found with ID '${escapeHTML(sanitizedId)}'. Please check the tracking number and try again.`;
          this.appendBotMessage(notFoundMsg, this.getMainMenuOption());
        } else {
          const serverErrorMsg = isHi ? "सर्वर से संपर्क नहीं हो पा रहा है। कृपया कुछ समय बाद पुनः प्रयास करें।" : "Unable to retrieve tracking details right now. Please try again shortly.";
          this.appendBotMessage(serverErrorMsg, this.getMainMenuOption());
        }
      } catch (err) {
        this.removeTypingIndicator();
        const errText = isHi ? "सर्वर से संपर्क नहीं हो पा रहा है। कृपया कुछ समय बाद पुनः प्रयास करें।" : "Unable to retrieve tracking details right now. Please try again shortly.";
        this.appendBotMessage(errText, this.getMainMenuOption());
      }
    }

    transitionToBranchInput() {
      this.currentState = STATES.BRANCH_INPUT;
      const isHi = this.currentLang === 'hi';
      const botPrompt = isHi ? "शाखा या शहर का नाम लिखें:" : "Type the branch name or city:";
      const placeholder = isHi ? "उदा. कोलकाता, मुंबई, दिल्ली..." : "e.g. Kolkata, Mumbai, Delhi...";
      this.appendBotMessage(botPrompt);
      this.enableInput(placeholder);
    }

    handleBranchSearch(query) {
      const trimmed = (query || '').trim().toLowerCase();
      if (!trimmed) {
        this.hideSuggestions();
        return;
      }
      const matches = this.branches.filter(b => {
        const nameEn = (b.name_en || '').toLowerCase();
        const nameHi = (b.name_hi || '').toLowerCase();
        const addrEn = (b.address_en || '').toLowerCase();
        const addrHi = (b.address_hi || '').toLowerCase();
        return nameEn.includes(trimmed) || nameHi.includes(trimmed) || addrEn.includes(trimmed) || addrHi.includes(trimmed);
      });
      this.currentSuggestions = matches.slice(0, 4);
      this.selectedSuggestionIndex = -1;
      this.renderSuggestions(trimmed);
    }

    highlightMatch(text, query) {
      if (!query) return escapeHTML(text);
      const safeText = escapeHTML(text);
      const safeQuery = escapeHTML(query);
      const regex = new RegExp(`(${safeQuery.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
      return safeText.replace(regex, '<span class="p3u-highlight">$1</span>');
    }

    renderSuggestions(query = '') {
      if (this.currentSuggestions.length === 0) {
        this.hideSuggestions();
        return;
      }
      this.suggestionsList.innerHTML = '';
      const isHi = this.currentLang === 'hi';

      this.currentSuggestions.forEach((branch, idx) => {
        const li = document.createElement('li');
        li.className = `p3u-suggestion-item ${idx === this.selectedSuggestionIndex ? 'p3u-selected' : ''}`;
        const titleText = isHi ? branch.name_hi : branch.name_en;
        const subText = isHi ? branch.address_hi : branch.address_en;
        li.innerHTML = `<div class="p3u-suggestion-title">📍 ${this.highlightMatch(titleText, query)}</div><div class="p3u-suggestion-sub">${this.highlightMatch(subText, query)}</div>`;
        li.addEventListener('click', () => this.selectBranch(branch));
        this.suggestionsList.appendChild(li);
      });
      this.suggestionsList.classList.add('p3u-visible');
    }

    hideSuggestions() {
      this.suggestionsList.classList.remove('p3u-visible');
      this.suggestionsList.innerHTML = '';
      this.currentSuggestions = [];
      this.selectedSuggestionIndex = -1;
    }

    selectBranch(branch) {
      this.hideSuggestions();
      const isHi = this.currentLang === 'hi';
      const branchName = isHi ? branch.name_hi : branch.name_en;
      this.appendUserMessage(branchName);
      this.disableInput();

      const cardHtml = `
        <div class="p3u-card">
          <div class="p3u-card-header"><span>📍 ${escapeHTML(isHi ? branch.name_hi : branch.name_en)}</span></div>
          <div class="p3u-card-body">
            <div class="p3u-card-item"><strong>${isHi ? 'शाखा:' : 'Branch:'}</strong><span>${escapeHTML(isHi ? branch.name_hi : branch.name_en)}</span></div>
            <div class="p3u-card-item"><strong>${isHi ? 'पता:' : 'Address:'}</strong><span>${escapeHTML(isHi ? branch.address_hi : branch.address_en)}</span></div>
            <div class="p3u-card-item"><strong>${isHi ? 'संपर्क:' : 'Contact:'}</strong><a href="tel:${escapeHTML(branch.contact)}" style="color: inherit; text-decoration: underline;">${escapeHTML(branch.contact)}</a></div>
            <div class="p3u-card-item"><strong>${isHi ? 'स्थान:' : 'Location:'}</strong><a href="${escapeHTML(branch.map_link)}" target="_blank" rel="noopener noreferrer" class="p3u-card-link">${isHi ? 'Google Maps पर देखें' : 'View on Google Maps'}<svg viewBox="0 0 24 24"><path d="M14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3m-2 16H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7z"/></svg></a></div>
          </div>
        </div>
      `;
      const introMsg = isHi ? "शाखा का विवरण:" : "Here are our branch details:";
      this.appendBotMessage(introMsg, this.getMainMenuOption(), cardHtml);
    }

    handleBranchSubmit(text) {
      this.hideSuggestions();
      const isHi = this.currentLang === 'hi';
      const query = (text || '').trim().toLowerCase();
      const matched = this.branches.find(b => 
        (b.name_en && b.name_en.toLowerCase() === query) || (b.name_hi && b.name_hi.toLowerCase() === query) ||
        (b.name_en && b.name_en.toLowerCase().includes(query)) || (b.name_hi && b.name_hi.toLowerCase().includes(query)) ||
        (b.address_en && b.address_en.toLowerCase().includes(query)) || (b.address_hi && b.address_hi.toLowerCase().includes(query))
      );

      if (matched) {
        this.selectBranch(matched);
      } else {
        const notFoundMsg = isHi ? "कोई शाखा नहीं मिली। कृपया नाम की जांच करें।" : "No matching branch found. Please verify the branch name.";
        this.appendBotMessage(notFoundMsg, this.getMainMenuOption());
      }
    }

    transitionToQueryInput() {
      this.currentState = STATES.QUERY_INPUT;
      this.pendingTicket = { query: '', contact: '' };
      const isHi = this.currentLang === 'hi';
      const prompt = isHi ? "कृपया अपनी समस्या या प्रश्न का विवरण लिखें:" : "Please describe your query or problem in detail:";
      const placeholder = isHi ? "अपनी समस्या यहाँ लिखें..." : "Describe your query here...";
      this.appendBotMessage(prompt);
      this.enableInput(placeholder);
    }

    handleQueryTextSubmit(queryText) {
      const sanitizedQuery = (queryText || '').trim();
      if (!sanitizedQuery) return;
      this.pendingTicket.query = sanitizedQuery;
      this.transitionToContactInput();
    }

    transitionToContactInput() {
      this.currentState = STATES.CONTACT_INPUT;
      const isHi = this.currentLang === 'hi';
      const prompt = isHi ? "कृपया अपना 10 अंकों का मोबाइल नंबर या ईमेल आईडी दर्ज करें ताकि हमारे प्रतिनिधि आपसे संपर्क कर सकें:" : "Please enter your 10-digit mobile number or email address so our executive can contact you:";
      const placeholder = isHi ? "उदा. 9876543210 या name@domain.com" : "e.g. 9876543210 or name@domain.com";
      this.appendBotMessage(prompt);
      this.enableInput(placeholder);
    }

    async handleContactSubmit(contactText) {
      const isHi = this.currentLang === 'hi';
      const cleanContact = (contactText || '').trim();
      const isValid = /^[6-9]\d{9}$/.test(cleanContact) || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(cleanContact);

      if (!isValid) {
        const invalidMsg = isHi ? "कृपया एक मान्य 10 अंकों का मोबाइल नंबर या ईमेल आईडी दर्ज करें।" : "Please enter a valid 10-digit Indian mobile number or email address.";
        this.appendBotMessage(invalidMsg);
        this.enableInput(isHi ? "मोबाइल या ईमेल दर्ज करें..." : "Enter mobile or email...");
        return;
      }

      this.pendingTicket.contact = cleanContact;
      this.disableInput(isHi ? "सबमिट कर रहे हैं..." : "Submitting...");
      const typingEl = this.showTypingIndicator();

      const payload = {
        query: this.pendingTicket.query,
        contact: this.pendingTicket.contact,
        language: this.currentLang,
        timestamp: new Date().toISOString()
      };

      try {
        await fetch(`${this.options.apiBase}${this.options.ticketEndpoint}`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
          body: JSON.stringify(payload)
        }).catch(() => {});
      } catch (err) {}

      await new Promise(r => setTimeout(r, 650));
      this.removeTypingIndicator();

      const ackMsg = isHi
        ? "Paarcel3u से संपर्क करने के लिए धन्यवाद। हमारे कस्टमर सपोर्ट अधिकारी जल्द ही आपसे संपर्क करेंगे। आपका दिन शुभ हो!\n\nबातचीत के लिए धन्यवाद! हमें आपकी सहायता करके खुशी हुई। 😊 भविष्य में सहायता के लिए कभी भी संपर्क करें। आपका दिन मंगलमय हो! 🙏"
        : "Thank you for contacting Paarcel3u. Our customer support executive will contact you at the earliest. Wishing you a great day ahead!\n\nThanks for talking! Glad we could help you today. 😊 If you need any more help with your package later, just send us a message anytime! Have a great day! 🙏";

      const resetOption = [{ label: isHi ? "🔄 नई बातचीत शुरू करें" : "🔄 Start New Chat", isMainMenu: true, onClick: () => this.resetConversation() }];
      this.appendBotMessage(ackMsg, resetOption);
    }

    handleUserInputSubmit() {
      const val = this.inputField.value;
      if (!val || !val.trim()) return;
      const userText = val.trim();
      this.appendUserMessage(userText);
      this.inputField.value = '';
      this.updateSendButtonState();

      switch (this.currentState) {
        case STATES.TRACK_PROMPT: this.handleTrackingSubmit(userText); break;
        case STATES.BRANCH_INPUT: this.handleBranchSubmit(userText); break;
        case STATES.QUERY_INPUT: this.handleQueryTextSubmit(userText); break;
        case STATES.CONTACT_INPUT: this.handleContactSubmit(userText); break;
      }
    }
  }

  // Export to Global Scope
  window.Paarcel3uChatbot = {
    instance: null,
    init: function (options) {
      if (!this.instance) {
        this.instance = new Paarcel3uWidget(options);
      }
      return this.instance;
    }
  };

  // Fixed Initialization to prevent React/Vite race conditions
  function initP3uChatbot() {
    if (!window.Paarcel3uChatbot.instance) {
      window.Paarcel3uChatbot.init({
        branchesUrl: '/branches.json',
        mockFallback: true,
        autoOpen: false
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initP3uChatbot);
  } else {
    // If Vite has already loaded the DOM, initialize immediately
    initP3uChatbot();
  }

})(window, document);