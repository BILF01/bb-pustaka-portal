import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import { registerAccessibilityStore } from './accessibility';
import { registerChatStore } from './chat';

// Cegah state Alpine (panel pencarian/chat/aksesibilitas) "membeku" saat
// halaman dipulihkan dari bfcache (misal setelah menekan tombol back/forward
// browser) — paksa reload penuh supaya semua komponen mulai dari state awal.
window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
        window.location.reload();
    }
});

Alpine.plugin(focus);
registerAccessibilityStore(Alpine);
registerChatStore(Alpine);

window.Alpine = Alpine;
Alpine.start();