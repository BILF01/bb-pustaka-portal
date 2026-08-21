const STORAGE_KEY = 'bbpustaka_a11y';

const defaultState = {
    open: false,
    darkMode: false,
    highContrast: false,
    invert: false,
    grayscale: false,
    colorBlindMode: 'none',
    fontScale: 100,
    letterSpacing: 0,
    lineHeight: 0,
    zoom: 100,
    highlightLinks: false,
    highlightHeadings: false,
    readingGuide: false,
    readingMask: false,
    bigCursor: false,
    stopAnimation: false,
    hideImages: false,
    focusStrong: false,
    readOnInteract: false,
    lang: 'id',
    listening: false,
};

const letterSpacingSteps = ['normal', '0.05em', '0.1em', '0.15em'];
const lineHeightSteps = ['inherit', '1.6', '1.8', '2.1'];
const READABLE_SELECTOR = 'p, h1, h2, h3, h4, h5, h6, li, a, button, td, th, label, blockquote, figcaption, summary';

export function registerAccessibilityStore(Alpine) {
    Alpine.store('a11y', {
        ...defaultState,
        _recognition: null,
        _hoverTimeout: null,

        init() {
            const lang = document.documentElement.lang?.toLowerCase().startsWith('en') ? 'en' : 'id';
            try {
                const saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
                Object.assign(this, defaultState, saved, { open: false, listening: false, lang });
            } catch (e) {
                Object.assign(this, defaultState, { lang });
            }
            this.apply();
            this._bindReadingHelpers();
            this._bindReadOnInteract();
        },

        persist() {
            const { open, listening, _recognition, _hoverTimeout, ...rest } = this;
            localStorage.setItem(STORAGE_KEY, JSON.stringify(rest));
        },

        toggle(key) {
            this[key] = !this[key];
            if (key === 'readOnInteract' && !this[key]) {
                this.stopSpeaking();
            }
            this.apply();
            this.persist();
        },

        setColorBlindMode(mode) {
            this.colorBlindMode = this.colorBlindMode === mode ? 'none' : mode;
            this.apply();
            this.persist();
        },

        changeFontScale(delta) {
            if (delta === 0) return;
            this.fontScale = Math.min(150, Math.max(80, this.fontScale + delta));
            this.apply();
            this.persist();
        },

        changeLetterSpacing(delta) {
            this.letterSpacing = Math.min(3, Math.max(0, this.letterSpacing + delta));
            this.apply();
            this.persist();
        },

        changeLineHeight(delta) {
            this.lineHeight = Math.min(3, Math.max(0, this.lineHeight + delta));
            this.apply();
            this.persist();
        },

        changeZoom(delta) {
            this.zoom = Math.min(150, Math.max(80, this.zoom + delta));
            this.apply();
            this.persist();
        },

        setLang(lang) {
            this.lang = lang;
            this.apply();
            this.persist();
        },

        reset() {
            const wasOpen = this.open;
            const lang = document.documentElement.lang?.toLowerCase().startsWith('en') ? 'en' : 'id';

            this.stopSpeaking();
            clearTimeout(this._hoverTimeout);

            if (this._recognition) {
                try {
                    this._recognition.stop();
                } catch (_) {}
                this._recognition = null;
            }

            Object.assign(this, defaultState, { open: wasOpen, lang });
            this.apply();
            localStorage.removeItem(STORAGE_KEY);
        },

        apply() {
            const html = document.documentElement;

            html.classList.toggle('a11y-dark', this.darkMode);
            html.classList.toggle('a11y-high-contrast', this.highContrast);
            html.classList.toggle('a11y-highlight-links', this.highlightLinks);
            html.classList.toggle('a11y-highlight-headings', this.highlightHeadings);
            html.classList.toggle('a11y-hide-images', this.hideImages);
            html.classList.toggle('a11y-stop-animation', this.stopAnimation);
            html.classList.toggle('a11y-focus-strong', this.focusStrong);
            html.classList.toggle('a11y-big-cursor', this.bigCursor);
            html.classList.toggle('a11y-reading-guide', this.readingGuide);
            html.classList.toggle('a11y-reading-mask', this.readingMask);

            html.style.setProperty('--a11y-letter-spacing', letterSpacingSteps[this.letterSpacing]);
            html.style.setProperty('--a11y-line-height', lineHeightSteps[this.lineHeight]);
            html.style.fontSize = this.fontScale + '%';
            html.style.zoom = this.zoom + '%';
            html.setAttribute('lang', this.lang);

            const filters = [];
            if (this.invert) filters.push('invert(1) hue-rotate(180deg)');
            if (this.grayscale) filters.push('grayscale(1)');
            if (this.colorBlindMode !== 'none') filters.push(`url(#a11y-${this.colorBlindMode})`);
            html.style.filter = filters.join(' ');
        },

        _bindReadingHelpers() {
            const guide = document.getElementById('a11y-reading-guide');
            const maskTop = document.getElementById('a11y-reading-mask-top');
            const maskBottom = document.getElementById('a11y-reading-mask-bottom');
            if (!guide || !maskTop || !maskBottom) return;

            document.addEventListener('mousemove', (e) => {
                if (this.readingGuide) {
                    guide.style.top = e.clientY + 'px';
                }
                if (this.readingMask) {
                    const bandHeight = 60;
                    maskTop.style.top = '0px';
                    maskTop.style.height = Math.max(0, e.clientY - bandHeight / 2) + 'px';
                    maskBottom.style.top = (e.clientY + bandHeight / 2) + 'px';
                    maskBottom.style.height = Math.max(0, window.innerHeight - (e.clientY + bandHeight / 2)) + 'px';
                }
            });
        },

        /**
         * Pembacaan Kontekstual: teks dibacakan saat kursor diarahkan (desktop)
         * atau disentuh (mobile). Tidak ada pembacaan otomatis seluruh halaman.
         */
        _bindReadOnInteract() {
            const hasPreciseHover = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

            if (hasPreciseHover) {
                document.addEventListener('mouseover', (e) => {
                    if (!this.readOnInteract) return;
                    const el = e.target.closest(READABLE_SELECTOR);
                    if (!el || el.closest('#a11y-panel, #chat-window') || el.getAttribute('aria-hidden') === 'true') return;

                    clearTimeout(this._hoverTimeout);
                    this._hoverTimeout = setTimeout(() => this._speakElement(el), 350);
                });

                document.addEventListener('mouseout', () => {
                    clearTimeout(this._hoverTimeout);
                });
            } else {
                document.addEventListener('click', (e) => {
                    if (!this.readOnInteract) return;
                    const el = e.target.closest(READABLE_SELECTOR);
                    if (!el || el.closest('#a11y-panel, #chat-window') || el.getAttribute('aria-hidden') === 'true') return;

                    this._speakElement(el);
                }, true);
            }
        },

        _speakElement(el) {
            if (!('speechSynthesis' in window)) return;

            const text = (el.innerText || el.textContent || '').trim().slice(0, 500);
            if (!text) return;

            window.speechSynthesis.cancel();
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = this.lang === 'id' ? 'id-ID' : 'en-US';
            window.speechSynthesis.speak(utterance);
        },

        stopSpeaking() {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
            }
        },

        get speechRecognitionSupported() {
            return 'SpeechRecognition' in window || 'webkitSpeechRecognition' in window;
        },

        toggleVoiceCommand() {
            if (!this.speechRecognitionSupported) {
                alert('Peramban Anda tidak mendukung fitur Pengenalan Suara.');
                return;
            }
            if (this.listening) {
                this._recognition?.stop();
                return;
            }
            const SpeechRecognitionCtor = window.SpeechRecognition || window.webkitSpeechRecognition;
            this._recognition = new SpeechRecognitionCtor();
            this._recognition.lang = this.lang === 'id' ? 'id-ID' : 'en-US';
            this._recognition.continuous = false;
            this._recognition.interimResults = false;

            this._recognition.onstart = () => { this.listening = true; };
            this._recognition.onend = () => { this.listening = false; };
            this._recognition.onerror = () => { this.listening = false; };
            this._recognition.onresult = (event) => {
                const command = event.results[0][0].transcript.toLowerCase();
                this._handleVoiceCommand(command);
            };

            this._recognition.start();
        },

        _handleVoiceCommand(command) {
            const routes = {
                'beranda': '/',
                'katalog': '/koleksi',
                'koleksi': '/koleksi',
                'layanan': '/layanan',
                'berita': '/berita',
                'tentang kami': '/tentang-kami',
                'tentang': '/tentang-kami',
                'kontak': '/kontak',
            };

            for (const keyword in routes) {
                if (command.includes(keyword)) {
                    window.location.href = routes[keyword];
                    return;
                }
            }
        },
    });
}