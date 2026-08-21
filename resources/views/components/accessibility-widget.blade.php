<div x-data @keydown.escape.window="$store.a11y.open = false">
    <svg width="0" height="0" class="absolute" aria-hidden="true">
        <defs>
            <filter id="a11y-protanopia"><feColorMatrix type="matrix" values="0.567,0.433,0,0,0 0.558,0.442,0,0,0 0,0.242,0.758,0,0 0,0,0,1,0"></feColorMatrix></filter>
            <filter id="a11y-deuteranopia"><feColorMatrix type="matrix" values="0.625,0.375,0,0,0 0.7,0.3,0,0,0 0,0.3,0.7,0,0 0,0,0,1,0"></feColorMatrix></filter>
            <filter id="a11y-tritanopia"><feColorMatrix type="matrix" values="0.95,0.05,0,0,0 0,0.433,0.567,0,0 0,0.475,0.525,0,0 0,0,0,1,0"></feColorMatrix></filter>
        </defs>
    </svg>

    <div id="a11y-reading-guide"></div>
    <div id="a11y-reading-mask-top"></div>
    <div id="a11y-reading-mask-bottom"></div>

    <button
        x-show="!$store.a11y.open && !$store.chat.open"
        x-transition
        type="button"
        @click="$store.chat.open = false; $store.a11y.open = true"
        aria-controls="a11y-panel"
        aria-label="Buka menu aksesibilitas"
        class="group fixed bottom-3 right-3 sm:bottom-6 sm:right-6 z-40 sm:z-[100] w-11 h-11 sm:w-[58px] sm:h-[58px] rounded-[14px] sm:rounded-[20px] bg-white/95 text-primary border border-primary/15 shadow-[0_6px_18px_rgba(24,75,46,.12)] sm:shadow-[0_8px_24px_rgba(24,75,46,.14)] backdrop-blur-md flex items-center justify-center hover:-translate-y-1 hover:border-primary/30 hover:shadow-[0_12px_30px_rgba(24,75,46,.20)] transition-all"
    >
        <span class="material-symbols-outlined text-[22px] sm:text-[28px] group-hover:scale-110 transition-transform" aria-hidden="true">accessibility</span>

        <span class="pointer-events-none absolute right-[70px] hidden sm:block whitespace-nowrap rounded-lg bg-[#173c2c] px-3 py-2 text-[11px] font-bold text-white opacity-0 translate-x-1 shadow-lg transition-all group-hover:opacity-100 group-hover:translate-x-0">
            {{ __('Aksesibilitas') }}
        </span>
    </button>

    <div id="a11y-panel" x-show="$store.a11y.open" x-cloak style="display:none" x-transition x-trap="$store.a11y.open" @click.outside="$store.a11y.open = false" role="dialog" aria-modal="true" aria-label="Panel Aksesibilitas" class="fixed inset-x-4 top-4 bottom-4 sm:inset-x-auto sm:top-[150px] sm:bottom-[92px] sm:right-6 z-[110] sm:w-[400px] bg-surface-container-lowest border border-primary/10 shadow-[0_24px_60px_rgba(18,55,36,.22)] rounded-[22px] overflow-hidden flex flex-col">

        <header class="h-[64px] px-4 bg-primary text-on-primary flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl bg-white/12 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[21px]" aria-hidden="true">settings_accessibility</span>
                </span>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-[14px] font-bold leading-none">{{ __('Aksesibilitas') }}</h2>
                        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    </div>
                    <p class="mt-1.5 text-[9px] font-medium text-white/65">{{ __('Sesuaikan pengalaman menggunakan portal') }}</p>
                </div>
            </div>
            <button type="button" @click="$store.a11y.open = false" aria-label="Tutup panel aksesibilitas" class="w-9 h-9 rounded-xl flex items-center justify-center text-white/75 hover:text-white hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined text-[21px]" aria-hidden="true">close</span>
            </button>
        </header>

        <div class="flex-1 min-h-0 overflow-y-auto overscroll-contain bg-[#f6f9f6] p-3.5 space-y-3">

            {{-- Teks & Tampilan --}}
            <section class="rounded-2xl border border-primary/10 bg-white overflow-hidden shadow-[0_3px_12px_rgba(24,75,46,.04)]">
                <div class="px-4 py-3 flex items-center gap-2.5 border-b border-primary/[.08]">
                    <span class="w-8 h-8 rounded-[10px] bg-primary/[.08] text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[17px]" aria-hidden="true">text_fields</span>
                    </span>
                    <div>
                        <h3 class="text-[12px] font-bold text-primary">{{ __('Teks & Tampilan') }}</h3>
                        <p class="mt-0.5 text-[9px] text-on-surface-variant/60">{{ __('Atur ukuran dan kenyamanan membaca') }}</p>
                    </div>
                </div>

                <div class="px-4">
                    <div class="py-3 flex items-center justify-between gap-3">
                        <span class="text-[11px] font-semibold text-on-surface">{{ __('Ukuran Teks') }}</span>
                        <div class="flex items-center gap-1 p-1 rounded-xl bg-surface-container-low">
                            <button type="button" @click="$store.a11y.changeFontScale(-10)" class="w-9 h-8 rounded-lg text-[11px] font-bold hover:bg-white hover:text-primary transition-colors">A-</button>
                            <span class="min-w-[54px] h-8 px-2 rounded-lg bg-primary text-on-primary flex items-center justify-center text-[11px] font-bold" x-text="$store.a11y.fontScale + '%'"></span>
                            <button type="button" @click="$store.a11y.changeFontScale(10)" class="w-9 h-8 rounded-lg text-[11px] font-bold hover:bg-white hover:text-primary transition-colors">A+</button>
                        </div>
                    </div>

                    <div class="py-3 border-t border-primary/[.07] flex items-center justify-between gap-3">
                        <span class="text-[11px] font-semibold text-on-surface">{{ __('Spasi Huruf') }}</span>
                        <div class="flex items-center gap-1 p-1 rounded-xl bg-surface-container-low">
                            <button type="button" @click="$store.a11y.changeLetterSpacing(-1)" class="w-9 h-8 rounded-lg font-bold hover:bg-white hover:text-primary transition-colors">-</button>
                            <span class="min-w-[54px] text-center text-[11px] font-bold" x-text="$store.a11y.letterSpacing"></span>
                            <button type="button" @click="$store.a11y.changeLetterSpacing(1)" class="w-9 h-8 rounded-lg font-bold hover:bg-white hover:text-primary transition-colors">+</button>
                        </div>
                    </div>

                    <div class="py-3 border-t border-primary/[.07] flex items-center justify-between gap-3">
                        <span class="text-[11px] font-semibold text-on-surface">{{ __('Tinggi Baris') }}</span>
                        <div class="flex items-center gap-1 p-1 rounded-xl bg-surface-container-low">
                            <button type="button" @click="$store.a11y.changeLineHeight(-1)" class="w-9 h-8 rounded-lg font-bold hover:bg-white hover:text-primary transition-colors">-</button>
                            <span class="min-w-[54px] text-center text-[11px] font-bold" x-text="$store.a11y.lineHeight"></span>
                            <button type="button" @click="$store.a11y.changeLineHeight(1)" class="w-9 h-8 rounded-lg font-bold hover:bg-white hover:text-primary transition-colors">+</button>
                        </div>
                    </div>

                    <div class="py-3 border-t border-primary/[.07] flex items-center justify-between gap-3">
                        <span class="text-[11px] font-semibold text-on-surface">{{ __('Perbesar Halaman') }}</span>
                        <div class="flex items-center gap-1 p-1 rounded-xl bg-surface-container-low">
                            <button type="button" @click="$store.a11y.changeZoom(-10)" class="w-9 h-8 rounded-lg font-bold hover:bg-white hover:text-primary transition-colors">-</button>
                            <span class="min-w-[54px] text-center text-[11px] font-bold" x-text="$store.a11y.zoom + '%'"></span>
                            <button type="button" @click="$store.a11y.changeZoom(10)" class="w-9 h-8 rounded-lg font-bold hover:bg-white hover:text-primary transition-colors">+</button>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Mode Tampilan --}}
            <section class="rounded-2xl border border-primary/10 bg-white p-4 shadow-[0_3px_12px_rgba(24,75,46,.04)]">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-[18px] text-primary" aria-hidden="true">contrast</span>
                    <h3 class="text-[12px] font-bold text-primary">{{ __('Mode Tampilan') }}</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" @click="$store.a11y.toggle('darkMode')" :class="$store.a11y.darkMode ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[10px] font-bold transition-colors">{{ __('Mode Gelap') }}</button>
                    <button type="button" @click="$store.a11y.toggle('highContrast')" :class="$store.a11y.highContrast ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[10px] font-bold transition-colors">{{ __('Kontras Tinggi') }}</button>
                    <button type="button" @click="$store.a11y.toggle('invert')" :class="$store.a11y.invert ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[10px] font-bold transition-colors">{{ __('Balik Warna') }}</button>
                    <button type="button" @click="$store.a11y.toggle('grayscale')" :class="$store.a11y.grayscale ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[10px] font-bold transition-colors">{{ __('Skala Abu') }}</button>
                </div>
            </section>

            {{-- Buta Warna --}}
            <section class="rounded-2xl border border-primary/10 bg-white p-4 shadow-[0_3px_12px_rgba(24,75,46,.04)]">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-[18px] text-primary" aria-hidden="true">visibility</span>
                    <h3 class="text-[12px] font-bold text-primary">{{ __('Mode Buta Warna') }}</h3>
                </div>
                <div class="grid grid-cols-3 gap-1.5">
                    <button type="button" @click="$store.a11y.setColorBlindMode('protanopia')" :class="$store.a11y.colorBlindMode === 'protanopia' ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[9px] font-bold transition-colors">Protanopia</button>
                    <button type="button" @click="$store.a11y.setColorBlindMode('deuteranopia')" :class="$store.a11y.colorBlindMode === 'deuteranopia' ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[9px] font-bold transition-colors">Deuteranopia</button>
                    <button type="button" @click="$store.a11y.setColorBlindMode('tritanopia')" :class="$store.a11y.colorBlindMode === 'tritanopia' ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[9px] font-bold transition-colors">Tritanopia</button>
                </div>
            </section>

            {{-- Bantuan Membaca --}}
            <section class="rounded-2xl border border-primary/10 bg-white p-4 shadow-[0_3px_12px_rgba(24,75,46,.04)]">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-[18px] text-primary" aria-hidden="true">menu_book</span>
                    <h3 class="text-[12px] font-bold text-primary">{{ __('Bantuan Membaca') }}</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" @click="$store.a11y.toggle('highlightLinks')" :class="$store.a11y.highlightLinks ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[10px] font-bold transition-colors">{{ __('Sorot Tautan') }}</button>
                    <button type="button" @click="$store.a11y.toggle('highlightHeadings')" :class="$store.a11y.highlightHeadings ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[10px] font-bold transition-colors">{{ __('Sorot Judul') }}</button>
                    <button type="button" @click="$store.a11y.toggle('readingGuide')" :class="$store.a11y.readingGuide ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[10px] font-bold transition-colors">{{ __('Garis Panduan') }}</button>
                    <button type="button" @click="$store.a11y.toggle('readingMask')" :class="$store.a11y.readingMask ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[10px] font-bold transition-colors">{{ __('Masker Baca') }}</button>
                </div>
            </section>

            {{-- Navigasi --}}
            <section class="rounded-2xl border border-primary/10 bg-white p-4 shadow-[0_3px_12px_rgba(24,75,46,.04)]">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-[18px] text-primary" aria-hidden="true">ads_click</span>
                    <h3 class="text-[12px] font-bold text-primary">{{ __('Navigasi & Fokus') }}</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" @click="$store.a11y.toggle('bigCursor')" :class="$store.a11y.bigCursor ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[10px] font-bold transition-colors">{{ __('Kursor Besar') }}</button>
                    <button type="button" @click="$store.a11y.toggle('focusStrong')" :class="$store.a11y.focusStrong ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[10px] font-bold transition-colors">{{ __('Fokus Tegas') }}</button>
                    <button type="button" @click="$store.a11y.toggle('stopAnimation')" :class="$store.a11y.stopAnimation ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[10px] font-bold transition-colors">{{ __('Hentikan Animasi') }}</button>
                    <button type="button" @click="$store.a11y.toggle('hideImages')" :class="$store.a11y.hideImages ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="h-10 rounded-xl border text-[10px] font-bold transition-colors">{{ __('Sembunyikan Gambar') }}</button>
                </div>
            </section>

            {{-- Pembaca Layar --}}
            <section class="rounded-2xl border border-primary/10 bg-white p-4 shadow-[0_3px_12px_rgba(24,75,46,.04)]">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-[18px] text-primary" aria-hidden="true">record_voice_over</span>
                    <h3 class="text-[12px] font-bold text-primary">{{ __('Pembaca Layar') }}</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" @click="$store.a11y.toggle('readOnInteract')" :class="$store.a11y.readOnInteract ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="min-h-11 px-2 rounded-xl border text-[10px] font-bold flex items-center justify-center gap-1.5 transition-colors">
                        <span class="material-symbols-outlined text-[16px]" aria-hidden="true">volume_up</span>
                        <span x-text="$store.a11y.readOnInteract ? 'Narasi Aktif' : 'Narasi Teks'"></span>
                    </button>
                    <button type="button" @click="$store.a11y.toggleVoiceCommand()" :class="$store.a11y.listening ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10'" class="min-h-11 px-2 rounded-xl border text-[10px] font-bold flex items-center justify-center gap-1.5 transition-colors">
                        <span class="material-symbols-outlined text-[16px]" aria-hidden="true">mic</span>
                        <span x-text="$store.a11y.listening ? 'Mendengarkan...' : 'Perintah Suara'"></span>
                    </button>
                </div>
                <p class="mt-2.5 text-[9px] leading-4 text-on-surface-variant/60">{{ __('Saat narasi aktif, arahkan kursor atau sentuh teks untuk mendengarkannya.') }}</p>
            </section>

            {{-- Bahasa --}}
            <section class="rounded-2xl border border-primary/10 bg-white p-4 shadow-[0_3px_12px_rgba(24,75,46,.04)]">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-[18px] text-primary" aria-hidden="true">language</span>
                    <h3 class="text-[12px] font-bold text-primary">{{ __('Bahasa') }}</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('locale.switch', 'id') }}" class="h-10 rounded-xl flex items-center justify-center border text-[10px] font-bold {{ app()->getLocale() === 'id' ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10' }}">Indonesia</a>
                    <a href="{{ route('locale.switch', 'en') }}" class="h-10 rounded-xl flex items-center justify-center border text-[10px] font-bold {{ app()->getLocale() === 'en' ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-low text-on-surface border-primary/10' }}">English</a>
                </div>
                <p class="mt-2.5 text-[9px] leading-4 text-on-surface-variant/60">{{ __('Bahasa hanya mengubah navigasi dan teks utama situs. Konten dari basis data belum diterjemahkan.') }}</p>
            </section>

            <button type="button" @click="$store.a11y.reset()" class="w-full h-11 rounded-xl border border-error/20 bg-error/[.06] text-error text-[11px] font-bold flex items-center justify-center gap-2 hover:bg-error hover:text-on-error transition-colors">
                <span class="material-symbols-outlined text-[17px]" aria-hidden="true">restart_alt</span>
                {{ __('Reset Semua Pengaturan') }}
            </button>
        </div>
    </div>
</div>