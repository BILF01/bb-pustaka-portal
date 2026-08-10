<header
    x-data="{ scrolled: false, mobileOpen: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 80)"
    :class="scrolled ? 'bg-white shadow-md text-on-surface' : 'bg-transparent text-white'"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-300"
>
    <div class="max-w-[1400px] mx-auto px-6 h-20 grid grid-cols-[auto_1fr_auto] items-center gap-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-lg shrink-0" aria-label="BB Pustaka - {{ __('Beranda') }}">
            <img src="{{ asset('images/logo-bbpustaka.png') }}" alt="Logo BB Pustaka" class="w-10 h-10 object-contain">
            <span :class="scrolled ? 'text-primary' : 'text-white'" class="hidden sm:inline">BB Pustaka</span>
        </a>

        <nav class="hidden lg:flex items-center justify-center gap-0.5 text-sm min-w-0 flex-nowrap" aria-label="{{ __('Navigasi utama') }}">
            <a href="{{ route('home') }}" class="shrink-0 whitespace-nowrap px-2.5 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors {{ request()->routeIs('home') ? 'text-secondary' : '' }}">{{ __('Home') }}</a>

            <div class="relative shrink-0" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button type="button" @click="open = !open" :aria-expanded="open" class="whitespace-nowrap px-2.5 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors flex items-center gap-1">
                    {{ __('Profil') }}
                    <span class="material-symbols-outlined text-base transition-transform" :class="open ? 'rotate-180' : ''" aria-hidden="true">expand_more</span>
                </button>
                <div x-show="open" x-cloak style="display:none" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @keydown.escape.window="open = false" class="absolute left-0 top-full pt-1.5 w-64 z-50 origin-top">
                    <div class="bg-white/95 backdrop-blur-sm text-on-surface border border-outline-variant/20 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.08)] p-1.5">
                        <a href="{{ route('about') }}" class="block px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Tentang') }}</a>
                        <a href="{{ route('collections.index') }}" class="block px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Koleksi dan Layanan') }}</a>
                        <a href="{{ route('news.index') }}" class="block px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Berita & Artikel') }}</a>
                        <a href="{{ route('faq.index') }}" class="block px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('FAQ') }}</a>
                        <a href="{{ route('contact.index') }}" class="block px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Kontak') }}</a>
                    </div>
                </div>
            </div>

            <div class="relative shrink-0" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button type="button" @click="open = !open" :aria-expanded="open" class="whitespace-nowrap px-2.5 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors flex items-center gap-1">
                    {{ __('Layanan') }}
                    <span class="material-symbols-outlined text-base transition-transform" :class="open ? 'rotate-180' : ''" aria-hidden="true">expand_more</span>
                </button>
                <div x-show="open" x-cloak style="display:none" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @keydown.escape.window="open = false" class="absolute left-0 top-full pt-1.5 w-80 z-50 origin-top">
                    <div class="bg-white text-on-surface border border-outline-variant/30 rounded-xl shadow-[0_12px_32px_rgba(0,0,0,0.18)] py-2 max-h-[70vh] overflow-y-auto">
                        <a href="https://www.kikp-pertanian.id/pustaka/opac/" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Katalog Online') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                        <a href="http://repository.pertanian.go.id" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Repository') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                        <a href="https://pustaka.bppsdmp.pertanian.go.id/layanan/jasa-informasi-terbaru" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Jasa Informasi Terbaru') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                        <a href="https://pustaka.bppsdmp.pertanian.go.id/layanan/jasa-informasi-terseleksi" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Jasa Informasi Terseleksi') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                        <a href="https://pustaka.bppsdmp.pertanian.go.id/layanan/abstrak-dan-bibliografi" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Abstrak dan Bibliografi') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                        <a href="https://kikp-pertanian.id/antiquariat/opac/" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Koleksi Antiquariat') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>

                        <details class="group">
                            <summary class="cursor-pointer list-none flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">
                                {{ __('Layanan Informasi/Referensi Pertanian') }}
                                <span class="material-symbols-outlined text-sm transition-transform group-open:rotate-90" aria-hidden="true">chevron_right</span>
                            </summary>
                            <div class="bg-surface-container-low">
                                <a href="https://pustaka.bppsdmp.pertanian.go.id/layanan/jasa-permohonan-informasi/layanan-penyediaan-literatur-pertanian" target="_blank" rel="noopener noreferrer" class="block pl-8 pr-4 py-2 text-xs hover:text-primary">{{ __('Layanan Penyediaan Literatur Pertanian') }}</a>
                                <a href="https://pustaka.bppsdmp.pertanian.go.id/layanan/jasa-permohonan-informasi/layanan-konsultasi-referensi-pertanian" target="_blank" rel="noopener noreferrer" class="block pl-8 pr-4 py-2 text-xs hover:text-primary">{{ __('Layanan Konsultasi/Referensi Pertanian') }}</a>
                            </div>
                        </details>

                        <details class="group">
                            <summary class="cursor-pointer list-none flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">
                                {{ __('Database Dilanggan') }}
                                <span class="material-symbols-outlined text-sm transition-transform group-open:rotate-90" aria-hidden="true">chevron_right</span>
                            </summary>
                            <div class="bg-surface-container-low">
                                <a href="http://search.proquest.com/login" target="_blank" rel="noopener noreferrer" class="block pl-8 pr-4 py-2 text-xs hover:text-primary">Proquest</a>
                            </div>
                        </details>

                        <a href="http://perpustakaan.pertanian.go.id/" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Portal Perpustakaan') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>

                        <details class="group">
                            <summary class="cursor-pointer list-none flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">
                                {{ __('Pertanian Press') }}
                                <span class="material-symbols-outlined text-sm transition-transform group-open:rotate-90" aria-hidden="true">chevron_right</span>
                            </summary>
                            <div class="bg-surface-container-low">
                                <a href="https://epublikasi.pertanian.go.id/pertanianpress/announcement/view/2" target="_blank" rel="noopener noreferrer" class="block pl-8 pr-4 py-2 text-xs hover:text-primary">{{ __('Permohonan ISBN') }}</a>
                                <a href="https://epublikasi.pertanian.go.id/pertanianpress/announcement/view/3" target="_blank" rel="noopener noreferrer" class="block pl-8 pr-4 py-2 text-xs hover:text-primary">{{ __('Pengumuman') }}</a>
                            </div>
                        </details>

                        <a href="https://pustaka.bppsdmp.pertanian.go.id/layanan/layanan-magang" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Layanan Magang/Observasi') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                    </div>
                </div>
            </div>

            <div class="relative shrink-0" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button type="button" @click="open = !open" :aria-expanded="open" class="whitespace-nowrap px-2.5 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors flex items-center gap-1">
                    {{ __('Publikasi') }}
                    <span class="material-symbols-outlined text-base transition-transform" :class="open ? 'rotate-180' : ''" aria-hidden="true">expand_more</span>
                </button>
                <div x-show="open" x-cloak style="display:none" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @keydown.escape.window="open = false" class="absolute left-0 top-full pt-1.5 w-56 z-50 origin-top">
                    <div class="bg-white/95 backdrop-blur-sm text-on-surface border border-outline-variant/20 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.08)] p-1.5">
                        <a href="http://repository.pertanian.go.id/handle/123456789/3" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">JPP <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                        <a href="http://repository.pertanian.go.id/handle/123456789/22" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Buku') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                        <a href="http://repository.pertanian.go.id/handle/123456789/1" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Jurnal') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                        <a href="http://repository.pertanian.go.id/handle/123456789/5397" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Brosur') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                        <a href="https://pustaka.bppsdmp.pertanian.go.id/publikasi/warta" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Warta') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                    </div>
                </div>
            </div>

            <div class="relative shrink-0" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button type="button" @click="open = !open" :aria-expanded="open" class="whitespace-nowrap px-2.5 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors flex items-center gap-1">
                    {{ __('Kepustakawanan') }}
                    <span class="material-symbols-outlined text-base transition-transform" :class="open ? 'rotate-180' : ''" aria-hidden="true">expand_more</span>
                </button>
                <div x-show="open" x-cloak style="display:none" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @keydown.escape.window="open = false" class="absolute left-0 top-full pt-1.5 w-72 z-50 origin-top">
                    <div class="bg-white/95 backdrop-blur-sm text-on-surface border border-outline-variant/20 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.08)] p-1.5">
                        <a href="https://pustaka.bppsdmp.pertanian.go.id/kepustakawanan/petunjuk-teknis-bagi-pustakawan" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Petunjuk Teknis Bagi Pustakawan') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                    </div>
                </div>
            </div>

            <a href="https://pustaka.bppsdmp.pertanian.go.id/informasi-publik" target="_blank" rel="noopener noreferrer" class="shrink-0 whitespace-nowrap px-2.5 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors">{{ __('Informasi Publik') }}</a>

            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfyLxbviVVYA45bsqtgcYPp3YhguggtFQDYYsjfvpIbDmqv9g/viewform?usp=header" target="_blank" rel="noopener noreferrer" class="shrink-0 whitespace-nowrap px-2.5 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors">{{ __('Survey IKM') }}</a>

            <div class="relative shrink-0" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button type="button" @click="open = !open" :aria-expanded="open" class="whitespace-nowrap px-2.5 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors flex items-center gap-1">
                    {{ __('Zona Integritas') }}
                    <span class="material-symbols-outlined text-base transition-transform" :class="open ? 'rotate-180' : ''" aria-hidden="true">expand_more</span>
                </button>
                <div x-show="open" x-cloak style="display:none" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @keydown.escape.window="open = false" class="absolute right-0 top-full pt-1.5 w-64 z-50 origin-top-right">
                    <div class="bg-white/95 backdrop-blur-sm text-on-surface border border-outline-variant/20 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.08)] p-1.5">
                        <a href="https://pustaka.bppsdmp.pertanian.go.id/zona-integritas/wbk" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">WBK <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                        <a href="https://pustaka.bppsdmp.pertanian.go.id/zona-integritas/pengaduan" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Pengaduan') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                        <a href="https://ppid.pertanian.go.id/index.php/portal" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Permohonan Informasi Publik') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex items-center gap-2 shrink-0 justify-self-end">
            <div class="hidden sm:flex items-center gap-0.5 px-1 py-1 rounded-full border border-current/20" aria-label="{{ __('Pilih Bahasa') }}">
                <a href="{{ route('locale.switch', 'id') }}" class="px-2 py-1 rounded-full text-xs font-bold transition-all {{ app()->getLocale() === 'id' ? 'bg-current/15' : 'opacity-60 hover:opacity-100' }}">ID</a>
                <a href="{{ route('locale.switch', 'en') }}" class="px-2 py-1 rounded-full text-xs font-bold transition-all {{ app()->getLocale() === 'en' ? 'bg-current/15' : 'opacity-60 hover:opacity-100' }}">EN</a>
            </div>

            <button
                type="button"
                class="lg:hidden p-2.5 rounded-full hover:bg-current/10"
                @click="mobileOpen = !mobileOpen"
                :aria-expanded="mobileOpen"
                aria-controls="mobile-nav"
                aria-label="{{ __('Buka menu navigasi') }}"
            >
                <span class="material-symbols-outlined" aria-hidden="true">menu</span>
            </button>
        </div>
    </div>

    <nav
        id="mobile-nav"
        x-show="mobileOpen"
        x-cloak
        style="display:none"
        x-transition
        class="lg:hidden bg-white text-on-surface px-4 py-4 space-y-1 shadow-lg border-t border-outline-variant/30 max-h-[calc(100vh-5rem)] overflow-y-auto"
        aria-label="{{ __('Navigasi mobile') }}"
    >
        <a href="{{ route('home') }}" class="block font-semibold py-2 px-2">{{ __('Home') }}</a>

        <details class="group border-t border-outline-variant/20 pt-1">
            <summary class="cursor-pointer list-none flex items-center justify-between font-semibold py-2 px-2">
                {{ __('Profil') }}
                <span class="material-symbols-outlined text-base transition-transform group-open:rotate-180" aria-hidden="true">expand_more</span>
            </summary>
            <div class="pl-4 space-y-1 pb-2">
                <a href="{{ route('about') }}" class="block py-1.5 text-sm">{{ __('Tentang') }}</a>
                <a href="{{ route('collections.index') }}" class="block py-1.5 text-sm">{{ __('Koleksi dan Layanan') }}</a>
                <a href="{{ route('news.index') }}" class="block py-1.5 text-sm">{{ __('Berita & Artikel') }}</a>
                <a href="{{ route('faq.index') }}" class="block py-1.5 text-sm">{{ __('FAQ') }}</a>
                <a href="{{ route('contact.index') }}" class="block py-1.5 text-sm">{{ __('Kontak') }}</a>
            </div>
        </details>

        <details class="group border-t border-outline-variant/20 pt-1">
            <summary class="cursor-pointer list-none flex items-center justify-between font-semibold py-2 px-2">
                {{ __('Layanan') }}
                <span class="material-symbols-outlined text-base transition-transform group-open:rotate-180" aria-hidden="true">expand_more</span>
            </summary>
            <div class="pl-4 space-y-1 pb-2">
                <a href="https://www.kikp-pertanian.id/pustaka/opac/" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">{{ __('Katalog Online') }}</a>
                <a href="http://repository.pertanian.go.id" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">{{ __('Repository') }}</a>
                <a href="https://pustaka.bppsdmp.pertanian.go.id/layanan/jasa-informasi-terbaru" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Jasa Informasi Terbaru</a>
                <a href="https://pustaka.bppsdmp.pertanian.go.id/layanan/jasa-informasi-terseleksi" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Jasa Informasi Terseleksi</a>
                <a href="https://pustaka.bppsdmp.pertanian.go.id/layanan/abstrak-dan-bibliografi" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Abstrak dan Bibliografi</a>
                <a href="https://kikp-pertanian.id/antiquariat/opac/" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Koleksi Antiquariat</a>
                <a href="https://pustaka.bppsdmp.pertanian.go.id/layanan/jasa-permohonan-informasi/layanan-penyediaan-literatur-pertanian" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Layanan Penyediaan Literatur Pertanian</a>
                <a href="https://pustaka.bppsdmp.pertanian.go.id/layanan/jasa-permohonan-informasi/layanan-konsultasi-referensi-pertanian" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Layanan Konsultasi/Referensi Pertanian</a>
                <a href="http://search.proquest.com/login" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Proquest</a>
                <a href="http://perpustakaan.pertanian.go.id/" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Portal Perpustakaan</a>
                <a href="https://epublikasi.pertanian.go.id/pertanianpress/announcement/view/2" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Permohonan ISBN</a>
                <a href="https://epublikasi.pertanian.go.id/pertanianpress/announcement/view/3" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Pengumuman Pertanian Press</a>
                <a href="https://pustaka.bppsdmp.pertanian.go.id/layanan/layanan-magang" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Layanan Magang/Observasi</a>
            </div>
        </details>

        <details class="group border-t border-outline-variant/20 pt-1">
            <summary class="cursor-pointer list-none flex items-center justify-between font-semibold py-2 px-2">
                {{ __('Publikasi') }}
                <span class="material-symbols-outlined text-base transition-transform group-open:rotate-180" aria-hidden="true">expand_more</span>
            </summary>
            <div class="pl-4 space-y-1 pb-2">
                <a href="http://repository.pertanian.go.id/handle/123456789/3" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">JPP</a>
                <a href="http://repository.pertanian.go.id/handle/123456789/22" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Buku</a>
                <a href="http://repository.pertanian.go.id/handle/123456789/1" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Jurnal</a>
                <a href="http://repository.pertanian.go.id/handle/123456789/5397" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Brosur</a>
                <a href="https://pustaka.bppsdmp.pertanian.go.id/publikasi/warta" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Warta</a>
            </div>
        </details>

        <details class="group border-t border-outline-variant/20 pt-1">
            <summary class="cursor-pointer list-none flex items-center justify-between font-semibold py-2 px-2">
                {{ __('Kepustakawanan') }}
                <span class="material-symbols-outlined text-base transition-transform group-open:rotate-180" aria-hidden="true">expand_more</span>
            </summary>
            <div class="pl-4 space-y-1 pb-2">
                <a href="https://pustaka.bppsdmp.pertanian.go.id/kepustakawanan/petunjuk-teknis-bagi-pustakawan" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Petunjuk Teknis Bagi Pustakawan</a>
            </div>
        </details>

        <a href="https://pustaka.bppsdmp.pertanian.go.id/informasi-publik" target="_blank" rel="noopener noreferrer" class="block font-semibold py-2 px-2 border-t border-outline-variant/20">{{ __('Informasi Publik') }}</a>
        <a href="https://docs.google.com/forms/d/e/1FAIpQLSfyLxbviVVYA45bsqtgcYPp3YhguggtFQDYYsjfvpIbDmqv9g/viewform?usp=header" target="_blank" rel="noopener noreferrer" class="block font-semibold py-2 px-2 border-t border-outline-variant/20">{{ __('Survey IKM') }}</a>

        <details class="group border-t border-outline-variant/20 pt-1">
            <summary class="cursor-pointer list-none flex items-center justify-between font-semibold py-2 px-2">
                {{ __('Zona Integritas') }}
                <span class="material-symbols-outlined text-base transition-transform group-open:rotate-180" aria-hidden="true">expand_more</span>
            </summary>
            <div class="pl-4 space-y-1 pb-2">
                <a href="https://pustaka.bppsdmp.pertanian.go.id/zona-integritas/wbk" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">WBK</a>
                <a href="https://pustaka.bppsdmp.pertanian.go.id/zona-integritas/pengaduan" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Pengaduan</a>
                <a href="https://ppid.pertanian.go.id/index.php/portal" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">Permohonan Informasi Publik</a>
            </div>
        </details>

        <div class="flex items-center gap-2 pt-3 mt-2 border-t border-outline-variant/30">
            <a href="{{ route('locale.switch', 'id') }}" class="px-3 py-1.5 rounded-full text-xs font-bold {{ app()->getLocale() === 'id' ? 'bg-primary text-on-primary' : 'bg-surface-container-low' }}">Indonesia</a>
            <a href="{{ route('locale.switch', 'en') }}" class="px-3 py-1.5 rounded-full text-xs font-bold {{ app()->getLocale() === 'en' ? 'bg-primary text-on-primary' : 'bg-surface-container-low' }}">English</a>
        </div>
    </nav>
</header>