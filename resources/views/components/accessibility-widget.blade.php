<div x-data @keydown.escape.window="$store.a11y.open = false">
    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <defs>
            <filter id="a11y-protanopia">
                <feColorMatrix type="matrix" values="0.567,0.433,0,0,0  0.558,0.442,0,0,0  0,0.242,0.758,0,0  0,0,0,1,0"></feColorMatrix>
            </filter>
            <filter id="a11y-deuteranopia">
                <feColorMatrix type="matrix" values="0.625,0.375,0,0,0  0.7,0.3,0,0,0  0,0.3,0.7,0,0  0,0,0,1,0"></feColorMatrix>
            </filter>
            <filter id="a11y-tritanopia">
                <feColorMatrix type="matrix" values="0.95,0.05,0,0,0  0,0.433,0.567,0,0  0,0.475,0.525,0,0  0,0,0,1,0"></feColorMatrix>
            </filter>
        </defs>
    </svg>

    <div id="a11y-reading-guide"></div>
    <div id="a11y-reading-mask-top"></div>
    <div id="a11y-reading-mask-bottom"></div>

    <button type="button" @click="$store.a11y.open = !$store.a11y.open" :aria-expanded="$store.a11y.open" aria-controls="a11y-panel" aria-label="Buka menu aksesibilitas" class="fixed bottom-6 right-6 z-[100] w-14 h-14 bg-white rounded-full shadow-2xl flex items-center justify-center text-primary hover:scale-110 transition-transform border border-outline-variant">
        <span class="material-symbols-outlined text-[28px]" aria-hidden="true">accessibility_new</span>
    </button>

    <div id="a11y-panel" x-show="$store.a11y.open" x-cloak style="display:none" x-transition x-trap="$store.a11y.open" @click.outside="$store.a11y.open = false" role="dialog" aria-modal="true" aria-label="Panel Aksesibilitas" class="fixed bottom-24 right-6 z-[101] w-[22rem] max-w-[calc(100vw-3rem)] max-h-[75vh] overflow-y-auto bg-white border border-outline-variant shadow-2xl rounded-xl p-5">
        <div class="flex justify-between items-center mb-4 pb-2 border-b border-outline-variant/30">
            <h2 class="font-bold text-primary">Aksesibilitas</h2>
            <button type="button" @click="$store.a11y.open = false" aria-label="Tutup panel aksesibilitas" class="text-on-surface-variant hover:text-primary">
                <span class="material-symbols-outlined" aria-hidden="true">close</span>
            </button>
        </div>

        <div class="space-y-6 text-sm">
            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase mb-2">Ukuran Teks</p>
                <div class="flex gap-2">
                    <button type="button" @click="$store.a11y.changeFontScale(-10)" class="flex-1 py-2 bg-surface-container rounded border border-outline-variant font-bold hover:bg-surface-container-high">A-</button>
                    <span class="flex-1 py-2 bg-primary text-on-primary rounded font-bold text-center" x-text="$store.a11y.fontScale + '%'"></span>
                    <button type="button" @click="$store.a11y.changeFontScale(10)" class="flex-1 py-2 bg-surface-container rounded border border-outline-variant font-bold hover:bg-surface-container-high">A+</button>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase mb-2">Spasi Huruf</p>
                <div class="flex gap-2">
                    <button type="button" @click="$store.a11y.changeLetterSpacing(-1)" class="flex-1 py-2 bg-surface-container rounded border border-outline-variant font-bold hover:bg-surface-container-high">-</button>
                    <span class="flex-1 py-2 text-center font-bold" x-text="$store.a11y.letterSpacing"></span>
                    <button type="button" @click="$store.a11y.changeLetterSpacing(1)" class="flex-1 py-2 bg-surface-container rounded border border-outline-variant font-bold hover:bg-surface-container-high">+</button>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase mb-2">Tinggi Baris</p>
                <div class="flex gap-2">
                    <button type="button" @click="$store.a11y.changeLineHeight(-1)" class="flex-1 py-2 bg-surface-container rounded border border-outline-variant font-bold hover:bg-surface-container-high">-</button>
                    <span class="flex-1 py-2 text-center font-bold" x-text="$store.a11y.lineHeight"></span>
                    <button type="button" @click="$store.a11y.changeLineHeight(1)" class="flex-1 py-2 bg-surface-container rounded border border-outline-variant font-bold hover:bg-surface-container-high">+</button>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase mb-2">Perbesar Halaman</p>
                <div class="flex gap-2">
                    <button type="button" @click="$store.a11y.changeZoom(-10)" class="flex-1 py-2 bg-surface-container rounded border border-outline-variant font-bold hover:bg-surface-container-high">-</button>
                    <span class="flex-1 py-2 text-center font-bold" x-text="$store.a11y.zoom + '%'"></span>
                    <button type="button" @click="$store.a11y.changeZoom(10)" class="flex-1 py-2 bg-surface-container rounded border border-outline-variant font-bold hover:bg-surface-container-high">+</button>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase mb-2">Tampilan</p>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" @click="$store.a11y.toggle('darkMode')" :class="$store.a11y.darkMode ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold">Mode Gelap</button>
                    <button type="button" @click="$store.a11y.toggle('highContrast')" :class="$store.a11y.highContrast ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold">Kontras Tinggi</button>
                    <button type="button" @click="$store.a11y.toggle('invert')" :class="$store.a11y.invert ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold">Balik Warna</button>
                    <button type="button" @click="$store.a11y.toggle('grayscale')" :class="$store.a11y.grayscale ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold">Skala Abu</button>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase mb-2">Mode Buta Warna</p>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" @click="$store.a11y.setColorBlindMode('protanopia')" :class="$store.a11y.colorBlindMode === 'protanopia' ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-[11px] font-bold">Protanopia</button>
                    <button type="button" @click="$store.a11y.setColorBlindMode('deuteranopia')" :class="$store.a11y.colorBlindMode === 'deuteranopia' ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-[11px] font-bold">Deuteranopia</button>
                    <button type="button" @click="$store.a11y.setColorBlindMode('tritanopia')" :class="$store.a11y.colorBlindMode === 'tritanopia' ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-[11px] font-bold">Tritanopia</button>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase mb-2">Bantuan Membaca</p>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" @click="$store.a11y.toggle('highlightLinks')" :class="$store.a11y.highlightLinks ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold">Sorot Tautan</button>
                    <button type="button" @click="$store.a11y.toggle('highlightHeadings')" :class="$store.a11y.highlightHeadings ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold">Sorot Judul</button>
                    <button type="button" @click="$store.a11y.toggle('readingGuide')" :class="$store.a11y.readingGuide ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold">Garis Panduan</button>
                    <button type="button" @click="$store.a11y.toggle('readingMask')" :class="$store.a11y.readingMask ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold">Masker Baca</button>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase mb-2">Navigasi &amp; Fokus</p>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" @click="$store.a11y.toggle('bigCursor')" :class="$store.a11y.bigCursor ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold">Kursor Besar</button>
                    <button type="button" @click="$store.a11y.toggle('focusStrong')" :class="$store.a11y.focusStrong ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold">Fokus Tegas</button>
                    <button type="button" @click="$store.a11y.toggle('stopAnimation')" :class="$store.a11y.stopAnimation ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold">Hentikan Animasi</button>
                    <button type="button" @click="$store.a11y.toggle('hideImages')" :class="$store.a11y.hideImages ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold">Sembunyikan Gambar</button>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase mb-2">Pembaca Layar</p>
                <div class="grid grid-cols-1 gap-2">
                    <button type="button" @click="$store.a11y.toggle('readOnInteract')" :class="$store.a11y.readOnInteract ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm" aria-hidden="true">record_voice_over</span>
                        <span x-text="$store.a11y.readOnInteract ? 'Narasi Teks: Aktif' : 'Aktifkan Narasi Teks'"></span>
                    </button>
                    <button type="button" @click="$store.a11y.toggleVoiceCommand()" :class="$store.a11y.listening ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant'" class="py-2 rounded text-xs font-bold flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm" aria-hidden="true">mic</span>
                        <span x-text="$store.a11y.listening ? 'Mendengarkan...' : 'Perintah Suara'"></span>
                    </button>
                </div>
                <p class="text-[11px] text-on-surface-variant mt-2">Saat aktif, arahkan kursor (desktop) atau sentuh (mobile) teks untuk mendengarkan narasinya.</p>
            </div>

            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase mb-2">{{ __('Bahasa') }}</p>
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('locale.switch', 'id') }}" class="py-2 rounded text-xs font-bold text-center {{ app()->getLocale() === 'id' ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant' }}">Indonesia</a>
                    <a href="{{ route('locale.switch', 'en') }}" class="py-2 rounded text-xs font-bold text-center {{ app()->getLocale() === 'en' ? 'bg-primary text-on-primary' : 'bg-surface-container border border-outline-variant' }}">English</a>
                </div>
                <p class="text-[11px] text-on-surface-variant mt-1">{{ __('Mengubah bahasa navigasi dan teks utama situs. Konten dari basis data (berita, koleksi, dsb.) belum diterjemahkan.') }}</p>
            </div>

            <button type="button" @click="$store.a11y.reset()" class="w-full py-3 bg-error text-on-error rounded-lg font-bold text-sm hover:opacity-90">
                Reset Semua Pengaturan
            </button>
        </div>
    </div>
</div>