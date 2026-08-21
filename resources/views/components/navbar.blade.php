@props(['solid' => true])

<header
    id="site-header"
    x-data="{ scrolled: {{ $solid ? 'true' : 'false' }}, mobileOpen: false, searchOpen: false, searchQuery: '', searchResults: [], searchLoading: false }"
    x-init="@if (! $solid) window.addEventListener('scroll', () => scrolled = window.scrollY > 80) @endif"
    @keydown.window="if ((event.ctrlKey || event.metaKey) && event.key === 'k') { event.preventDefault(); searchOpen = true; $nextTick(() => $refs.navSearchInput?.focus()); }"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-300"
>
    <div :class="scrolled ? 'bg-white text-on-surface border-b border-outline-variant/30' : 'bg-black/45 backdrop-blur-md text-white border-b border-white/15'" class="hidden lg:block text-xs transition-all duration-300">
        <div class="max-w-[1400px] mx-auto px-6 xl:px-8 w-full h-10 flex items-center justify-between gap-6">
            <div class="flex items-center min-w-0 text-[11px] xl:text-xs font-medium">
                <span class="font-semibold whitespace-nowrap">NPP: 3271034C1019314</span>
                <span class="h-4 border-l border-current/25 mx-4"></span>
                <span class="flex items-center gap-1.5 whitespace-nowrap">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">location_on</span>
                    {{ \App\Models\SiteSetting::get('address') }}
                </span>
                <span class="h-4 border-l border-current/25 mx-4"></span>
                <span class="flex items-center gap-1.5 whitespace-nowrap">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">call</span>
                    {{ \App\Models\SiteSetting::get('phone') }}
                </span>
                <span class="h-4 border-l border-current/25 mx-4"></span>
                <a href="mailto:{{ \App\Models\SiteSetting::get('email') }}" class="flex items-center gap-1.5 whitespace-nowrap hover:opacity-80 transition-opacity">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">mail</span>
                    {{ \App\Models\SiteSetting::get('email') }}
                </a>
            </div>

            <div class="flex items-center shrink-0" aria-label="{{ __('PilihBahasa') }}">
                <a href="{{ route('locale.switch', 'en') }}" class="flex items-center gap-1.5 whitespace-nowrap transition-opacity {{ app()->getLocale() === 'en' ? 'opacity-100' : 'opacity-50 hover:opacity-100' }}" aria-label="English">
                    <span class="block w-5 h-3.5 rounded-[2px] overflow-hidden">
                        <svg viewBox="0 0 20 14" class="w-full h-full"><rect width="20" height="14" fill="#00247d"/><path d="M0 0L20 14M20 0L0 14" stroke="#fff" stroke-width="2.5"/><path d="M0 0L20 14M20 0L0 14" stroke="#cf142b" stroke-width="1.2"/><path d="M10 0V14M0 7H20" stroke="#fff" stroke-width="4"/><path d="M10 0V14M0 7H20" stroke="#cf142b" stroke-width="2"/></svg>
                    </span>
                    <span class="text-[11px] xl:text-xs font-semibold">EN</span>
                </a>
                <span class="h-4 border-l border-current/25 mx-2"></span>
                <a href="{{ route('locale.switch', 'id') }}" class="flex items-center gap-1.5 whitespace-nowrap transition-opacity {{ app()->getLocale() === 'id' ? 'opacity-100' : 'opacity-50 hover:opacity-100' }}" aria-label="Indonesia">
                    <span class="block w-5 h-3.5 rounded-[2px] overflow-hidden">
                        <svg viewBox="0 0 20 14" class="w-full h-full"><rect width="20" height="7" fill="#ce1126"/><rect y="7" width="20" height="7" fill="#fff"/></svg>
                    </span>
                    <span class="text-[11px] xl:text-xs font-semibold">ID</span>
                </a>
            </div>
        </div>
    </div>

        <div :class="scrolled ? 'bg-white shadow-md text-on-surface' : 'bg-black/45 backdrop-blur-md text-white'" class="transition-all duration-300">
            <div class="max-w-[1400px] mx-auto px-6 min-h-20 py-2 flex items-center gap-3 lg:gap-4 xl:gap-6">
            <a
                href="{{ route('home') }}"
                class="flex items-center gap-2.5 min-w-0 flex-1"
                aria-label="BB Pustaka - {{ __('Beranda') }}"
            >
                <img
                    src="{{ asset('images/logo-bbpustaka.png') }}"
                    alt="Logo BB Pustaka"
                    class="w-10 h-10 object-contain shrink-0"
                >

                {{-- MOBILE --}}
                <span class="sm:hidden min-w-0 max-w-[225px] flex flex-col leading-none">
                    <span
                        :class="scrolled ? 'text-on-surface-variant' : 'text-white/75'"
                        class="block mb-1 text-[6.5px] font-semibold uppercase tracking-[.025em] whitespace-nowrap"
                    >
                        {{ __('Kementerian Pertanian Republik Indonesia') }}
                    </span>

                    <span
                        :class="scrolled ? 'text-primary' : 'text-white'"
                        class="block text-[9.5px] font-extrabold uppercase leading-[1.2] tracking-[-.015em]"
                    >
                        {{ __('Balai Besar Perpustakaan dan Literasi Pertanian') }}
                    </span>
                </span>

                {{-- TABLET + DESKTOP --}}
                <span class="hidden sm:flex flex-col leading-tight min-w-[200px] lg:min-w-[220px] xl:min-w-[240px] max-w-[260px] lg:max-w-[300px] xl:max-w-[360px]">
                    <span
                        :class="scrolled ? 'text-on-surface-variant' : 'text-white/85'"
                        class="text-[10px] font-semibold uppercase tracking-wide"
                    >
                        {{ __('Kementerian Pertanian Republik Indonesia') }}
                    </span>

                    <span
                        :class="scrolled ? 'text-primary' : 'text-white'"
                        class="text-sm lg:text-base font-bold uppercase"
                    >
                        {{ __('Balai Besar Perpustakaan dan Literasi Pertanian') }}
                    </span>
                </span>
            </a>

            <nav class="hidden lg:flex items-center justify-end gap-0 xl:gap-0.5 {{ app()->getLocale() === 'en' ? 'text-[11px] xl:text-xs' : 'text-sm' }} shrink-0 flex-nowrap" aria-label="{{ __('Navigasi utama') }}">
                <a href="{{ route('home') }}" class="shrink-0 whitespace-nowrap px-1 xl:px-2 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors">{{ __('Home') }}</a>

                <div class="relative shrink-0" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button type="button" @click="open = !open" :aria-expanded="open" class="whitespace-nowrap px-1 xl:px-2 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors flex items-center gap-1">
                        {{ __('Profil') }}
                        <span class="material-symbols-outlined text-base transition-transform" :class="open ? 'rotate-180' : ''" aria-hidden="true">expand_more</span>
                    </button>
                    <div x-show="open" x-cloak style="display:none" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @keydown.escape.window="open = false" class="absolute left-0 top-full pt-1.5 w-64 z-50 origin-top">
                        <div class="bg-white/95 backdrop-blur-sm text-on-surface border border-outline-variant/20 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.08)] p-1.5">
                            <a href="{{ route('about') }}" class="block px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Tentang') }}</a>
                            <a href="{{ route('collections.index') }}" class="block px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Koleksi dan Layanan') }}</a>
                            <a href="{{ route('news.index') }}" class="block px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Berita & Artikel') }}</a>
                            <a href="{{ route('contact.index') }}" class="block px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Kontak') }}</a>
                        </div>
                    </div>
                </div>

                <div class="relative shrink-0" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button type="button" @click="open = !open" :aria-expanded="open" class="whitespace-nowrap px-1 xl:px-2 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors flex items-center gap-1">
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
                    <button type="button" @click="open = !open" :aria-expanded="open" class="whitespace-nowrap px-1 xl:px-2 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors flex items-center gap-1">
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
                    <button type="button" @click="open = !open" :aria-expanded="open" class="whitespace-nowrap px-1 xl:px-2 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors flex items-center gap-1">
                        {{ __('Kepustakawanan') }}
                        <span class="material-symbols-outlined text-base transition-transform" :class="open ? 'rotate-180' : ''" aria-hidden="true">expand_more</span>
                    </button>
                    <div x-show="open" x-cloak style="display:none" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @keydown.escape.window="open = false" class="absolute left-0 top-full pt-1.5 w-72 z-50 origin-top">
                        <div class="bg-white/95 backdrop-blur-sm text-on-surface border border-outline-variant/20 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.08)] p-1.5">
                            <a href="https://pustaka.bppsdmp.pertanian.go.id/kepustakawanan/petunjuk-teknis-bagi-pustakawan" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between px-3.5 py-2.5 text-sm rounded-lg hover:bg-surface-container-low/70 hover:text-primary transition-colors duration-150">{{ __('Petunjuk Teknis Bagi Pustakawan') }} <span class="material-symbols-outlined text-sm text-on-surface-variant" aria-hidden="true">arrow_outward</span></a>
                        </div>
                    </div>
                </div>

                <a href="https://pustaka.bppsdmp.pertanian.go.id/informasi-publik" target="_blank" rel="noopener noreferrer" class="shrink-0 whitespace-nowrap px-1 xl:px-2 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors">{{ __('Informasi Publik') }}</a>

                <a href="https://docs.google.com/forms/d/e/1FAIpQLSfyLxbviVVYA45bsqtgcYPp3YhguggtFQDYYsjfvpIbDmqv9g/viewform?usp=header" target="_blank" rel="noopener noreferrer" class="shrink-0 whitespace-nowrap px-1 xl:px-2 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors">{{ __('Survey IKM') }}</a>

                <div class="relative shrink-0" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button type="button" @click="open = !open" :aria-expanded="open" class="whitespace-nowrap px-1 xl:px-2 py-2 rounded-lg font-semibold hover:bg-current/10 transition-colors flex items-center gap-1">
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

                <span class="h-5 border-l border-current/25 mx-1"></span>

                <div class="relative shrink-0">
                    <button type="button" @click="searchOpen = !searchOpen; $nextTick(() => searchOpen && $refs.navSearchInput.focus())" :aria-expanded="searchOpen" class="p-2 rounded-lg hover:bg-current/10 transition-colors" aria-label="{{ __('Cari koleksi') }}">
                        <span class="material-symbols-outlined" aria-hidden="true">search</span>
                    </button>

                    <div
                        x-show="searchOpen"
                        x-cloak
                        style="display:none"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        @keydown.escape.window="searchOpen = false"
                        @click.outside="searchOpen = false"
                        class="absolute right-0 top-full pt-1.5 w-[420px] z-50 origin-top-right"
                    >
                        <form action="{{ route('collections.index') }}" method="GET" class="relative flex items-center bg-white rounded-full border border-outline-variant/40 focus-within:border-primary focus-within:ring-4 focus-within:ring-primary/15 transition-all overflow-hidden shadow-[0_12px_32px_rgba(0,0,0,0.18)]">
                            <span class="material-symbols-outlined text-on-surface-variant pl-4" aria-hidden="true">search</span>
                            <label for="navbar-search" class="sr-only">{{ __('Cari koleksi, jurnal, atau arsip digital...') }}</label>
                            <input
                                x-ref="navSearchInput"
                                x-model="searchQuery"
                                @input.debounce.300ms="
                                    if (searchQuery.length < 2) { searchResults = []; return; }
                                    searchLoading = true;
                                    fetch('{{ route('collections.suggest') }}?q=' + encodeURIComponent(searchQuery))
                                        .then(r => r.json())
                                        .then(data => { searchResults = data; searchLoading = false; });
                                "
                                id="navbar-search"
                                name="q"
                                type="search"
                                autocomplete="off"
                                placeholder="{{ __('Cari koleksi...') }}"
                                class="flex-1 min-w-0 h-11 px-3 text-on-surface bg-transparent placeholder:text-on-surface-variant border-0 focus:ring-0 text-sm"
                            >
                            <kbd class="hidden sm:inline-block text-[10px] font-semibold px-1.5 py-1 rounded border border-outline-variant text-on-surface-variant bg-surface-container-low shrink-0">Ctrl+K</kbd>
                            <button type="submit" class="h-11 px-4 ml-2 bg-primary text-on-primary hover:bg-primary-container transition-colors flex items-center shrink-0">
                                <span class="material-symbols-outlined text-base" aria-hidden="true">search</span>
                            </button>
                        </form>

                        <div x-show="searchQuery.length >= 2" x-cloak style="display:none" class="mt-2 bg-white text-on-surface border border-outline-variant/20 rounded-2xl shadow-[0_12px_32px_rgba(0,0,0,0.15)] overflow-hidden">
                            <template x-if="searchLoading">
                                <p class="px-4 py-4 text-sm text-on-surface-variant">{{ __('Memuat...') }}</p>
                            </template>
                            <template x-if="!searchLoading && searchResults.length === 0">
                                <p class="px-4 py-4 text-sm text-on-surface-variant">{{ __('Tidak ada hasil ditemukan') }}</p>
                            </template>
                            <template x-if="!searchLoading && searchResults.length > 0">
                                <div>
                                    <p class="px-4 pt-3 pb-1 text-[11px] font-bold text-on-surface-variant uppercase tracking-wide">{{ __('Koleksi') }}</p>
                                    <template x-for="item in searchResults" :key="item.url">
                                        <a :href="item.url" class="flex items-center justify-between gap-3 px-4 py-2.5 hover:bg-surface-container-low/70 transition-colors">
                                            <span class="flex items-center gap-2 min-w-0">
                                                <span class="material-symbols-outlined text-base text-on-surface-variant shrink-0" aria-hidden="true">menu_book</span>
                                                <span class="text-sm truncate" x-text="item.title"></span>
                                            </span>
                                            <span class="text-xs text-on-surface-variant shrink-0" x-text="item.category"></span>
                                        </a>
                                    </template>
                                    <a :href="'{{ route('collections.index') }}?q=' + encodeURIComponent(searchQuery)" class="flex items-center justify-between gap-2 px-4 py-3 border-t border-outline-variant/20 text-sm font-semibold text-primary hover:bg-surface-container-low/70 transition-colors">
                                        <span>{{ __('Lihat semua hasil untuk') }} "<span x-text="searchQuery"></span>"</span>
                                        <span class="material-symbols-outlined text-base" aria-hidden="true">chevron_right</span>
                                    </a>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="flex items-center gap-2 shrink-0 justify-self-end">
                <button
                    type="button"
                    class="lg:hidden p-2.5 rounded-full hover:bg-current/10"
                    @click="mobileOpen = !mobileOpen"
                    :aria-expanded="mobileOpen"
                    aria-controls="mobile-nav"
                    aria-label="{{ __('Buka menu navigasi') }}"
                >
                    <span
                        class="material-symbols-outlined"
                        x-text="mobileOpen ? 'close' : 'menu'"
                        aria-hidden="true"
                    >menu</span>
                </button>
            </div>
        </div>
    </div>

    <div class="lg:hidden border-t border-current/10" :class="scrolled ? 'bg-white' : 'bg-black/45 backdrop-blur-md'">
        <div class="px-4 py-3">
            <form action="{{ route('collections.index') }}" method="GET" class="relative flex items-center gap-2">
                <span class="material-symbols-outlined absolute left-3 text-on-surface-variant" aria-hidden="true">search</span>
                <label for="mobile-navbar-search" class="sr-only">{{ __('Cari koleksi, jurnal, atau arsip digital...') }}</label>
                <input
                    x-model="searchQuery"
                    @input.debounce.300ms="
                        if (searchQuery.length < 2) { searchResults = []; return; }
                        searchLoading = true;
                        fetch('{{ route('collections.suggest') }}?q=' + encodeURIComponent(searchQuery))
                            .then(r => r.json())
                            .then(data => { searchResults = data; searchLoading = false; });
                    "
                    id="mobile-navbar-search"
                    name="q"
                    type="search"
                    autocomplete="off"
                    placeholder="{{ __('Cari koleksi, jurnal, atau arsip digital...') }}"
                    class="w-full h-11 pl-9 pr-14 rounded-xl text-on-surface bg-white placeholder:text-on-surface-variant border border-outline-variant focus:ring-2 focus:ring-primary focus:border-primary text-sm"
                >
                <button type="submit" class="absolute right-1.5 top-1.5 bottom-1.5 px-3 rounded-lg bg-primary text-on-primary hover:bg-primary-container transition-colors flex items-center justify-center">
                    <span class="material-symbols-outlined text-base" aria-hidden="true">search</span>
                </button>
            </form>

            <div x-show="searchQuery.length >= 2" x-cloak style="display:none" class="mt-2 bg-white text-on-surface border border-outline-variant/20 rounded-2xl shadow-sm overflow-hidden">
                <template x-if="searchLoading">
                    <p class="px-4 py-3 text-sm text-on-surface-variant">{{ __('Memuat...') }}</p>
                </template>
                <template x-if="!searchLoading && searchResults.length === 0">
                    <p class="px-4 py-3 text-sm text-on-surface-variant">{{ __('Tidak ada hasil ditemukan') }}</p>
                </template>
                <template x-if="!searchLoading && searchResults.length > 0">
                    <div>
                        <template x-for="item in searchResults" :key="item.url">
                            <a :href="item.url" class="flex items-center justify-between gap-3 px-4 py-2.5 hover:bg-surface-container-low/70 transition-colors border-b border-outline-variant/10 last:border-0">
                                <span class="text-sm truncate" x-text="item.title"></span>
                                <span class="text-xs text-on-surface-variant shrink-0" x-text="item.category"></span>
                            </a>
                        </template>
                    </div>
                </template>
            </div>
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
                <a href="http://repository.pertanian.go.id" target="_blank" rel="noopener noreferrer" class="block py-1.5 text-sm">{{__('Repository') }}</a>
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

        <a href="{{ route('collections.index') }}" class="block font-semibold py-2 px-2 border-t border-outline-variant/20">{{ __('Cari Koleksi') }}</a>

        <div class="flex items-center gap-2 pt-3 mt-2 border-t border-outline-variant/30">
            <a href="{{ route('locale.switch', 'id') }}" class="px-3 py-1.5 rounded-full text-xs font-bold {{ app()->getLocale() === 'id' ? 'bg-primary text-on-primary' : 'bg-surface-container-low' }}">Indonesia</a>
            <a href="{{ route('locale.switch', 'en') }}" class="px-3 py-1.5 rounded-full text-xs font-bold {{ app()->getLocale() === 'en' ? 'bg-primary text-on-primary' : 'bg-surface-container-low' }}">English</a>
        </div>
    </nav>
</header>
