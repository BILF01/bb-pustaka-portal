import { marked } from 'marked';
import DOMPurify from 'dompurify';
import hljs from 'highlight.js/lib/core';
import javascript from 'highlight.js/lib/languages/javascript';
import php from 'highlight.js/lib/languages/php';
import bash from 'highlight.js/lib/languages/bash';

hljs.registerLanguage('javascript', javascript);
hljs.registerLanguage('php', php);
hljs.registerLanguage('bash', bash);

const VISITOR_KEY = 'bbpustaka_chat_visitor';
const SESSION_KEY = 'bbpustaka_chat_session';

marked.setOptions({
    breaks: true,
    highlight(code, lang) {
        if (lang && hljs.getLanguage(lang)) {
            return hljs.highlight(code, { language: lang }).value;
        }
        return hljs.highlightAuto(code).value;
    },
});

function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';
}

export function registerChatStore(Alpine) {
    Alpine.store('chat', {
        open: false,
        loading: false,
        booting: true,
        sessionUuid: localStorage.getItem(SESSION_KEY) || null,
        visitorToken: localStorage.getItem(VISITOR_KEY) || null,
        messages: [],
        input: '',
        suggestions: [
            'Bagaimana cara meminjam buku?',
            'Apa itu Smart OPAC?',
            'Jam operasional perpustakaan?',
            'Bagaimana cara mengakses Repository?',
        ],

        async init() {
            if (!this.sessionUuid) {
                await this._startSession();
            } else {
                await this._loadHistory();
            }
            this.booting = false;
        },

        async _startSession() {
            try {
                const response = await fetch('/chat/sessions', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken(),
                        Accept: 'application/json',
                    },
                    body: JSON.stringify({ visitor_token: this.visitorToken }),
                });
                const data = await response.json();
                this.sessionUuid = data.session_uuid;
                this.visitorToken = data.visitor_token;
                localStorage.setItem(SESSION_KEY, this.sessionUuid);
                localStorage.setItem(VISITOR_KEY, this.visitorToken);
            } catch (e) {
                console.error('Gagal memulai sesi chat', e);
            }
        },

        async _loadHistory() {
            try {
                const response = await fetch(`/chat/sessions/${this.sessionUuid}/messages`);
                if (!response.ok) {
                    await this._startSession();
                    return;
                }
                const data = await response.json();
                this.messages = data.map((m) => ({
                    role: m.role,
                    html: this.renderMarkdown(m.content),
                    time: this._formatTime(m.created_at),
                }));
                this._scrollToBottom();
            } catch (e) {
                console.error('Gagal memuat riwayat chat', e);
            }
        },

        renderMarkdown(text) {
            return DOMPurify.sanitize(marked.parse(text));
        },

        _formatTime(isoString) {
            const date = new Date(isoString);
            return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        },

        _scrollToBottom() {
            requestAnimationFrame(() => {
                const container = document.getElementById('chat-messages');
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        },

        useSuggestion(text) {
            this.input = text;
            this.send();
        },

        async send() {
            const text = this.input.trim();
            if (!text || this.loading) return;

            this.messages.push({
                role: 'user',
                html: this.renderMarkdown(text),
                time: this._formatTime(new Date().toISOString()),
            });
            this.input = '';
            this.loading = true;
            this._scrollToBottom();

            try {
                const response = await fetch(`/chat/sessions/${this.sessionUuid}/messages`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken(),
                        Accept: 'application/json',
                    },
                    body: JSON.stringify({ message: text }),
                });
                const data = await response.json();
                this.messages.push({
                    role: 'assistant',
                    html: this.renderMarkdown(data.reply),
                    time: this._formatTime(data.created_at),
                });
            } catch (e) {
                this.messages.push({
                    role: 'assistant',
                    html: this.renderMarkdown('Maaf, terjadi kendala koneksi. Silakan coba lagi.'),
                    time: this._formatTime(new Date().toISOString()),
                });
            } finally {
                this.loading = false;
                this._scrollToBottom();
            }
        },
    });
}