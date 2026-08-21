@php
    $serviceUrl = \App\Models\SiteSetting::get('external_system_url', '#');
@endphp

<section class="py-10 md:py-12" aria-labelledby="reservation-heading">
    <div class="max-w-[1240px] mx-auto px-4 md:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_320px] overflow-hidden rounded-[26px] border border-primary/10 bg-surface-container-lowest shadow-[0_12px_34px_rgba(22,61,44,.08)]">

            {{-- INFORMASI LAYANAN --}}
            <div class="p-5 md:p-7 lg:p-8">
                <div class="max-w-[680px]">
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/[.08] text-primary text-[10px] font-extrabold uppercase tracking-[.09em]">
                        <span class="material-symbols-outlined text-[15px]" aria-hidden="true">concierge</span>
                        {{ __('Layanan Kami') }}
                    </span>

                    <h2 id="reservation-heading" class="mt-3 font-serif text-[25px] md:text-[30px] font-bold leading-[1.15] tracking-[-.015em] text-primary-container">
                        {{ __('Reservasi & Pengajuan Layanan') }}
                    </h2>

                    <p class="mt-2 max-w-[650px] text-[13px] md:text-sm leading-[1.65] text-on-surface-variant">
                        {{ __('Ajukan reservasi kunjungan, peminjaman ruang, usulan koleksi, dan kebutuhan layanan publik melalui portal layanan BB Pustaka.') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 mt-6">
                    @foreach ([
                        ['icon' => 'event_available', 'label' => 'Reservasi Kunjungan', 'description' => 'Jadwalkan kunjungan ke BB Pustaka.'],
                        ['icon' => 'meeting_room', 'label' => 'Booking Ruang Rapat', 'description' => 'Ajukan penggunaan ruang yang tersedia.'],
                        ['icon' => 'library_add', 'label' => 'Usulan Koleksi', 'description' => 'Sampaikan usulan bahan pustaka baru.'],
                        ['icon' => 'support_agent', 'label' => 'Layanan Publik Lainnya', 'description' => 'Akses kebutuhan layanan lainnya.'],
                    ] as $service)
                        <div class="group flex items-center gap-3.5 rounded-[16px] border border-primary/[.08] bg-surface-container-low/55 p-3 transition-colors hover:border-primary/15 hover:bg-primary/[.035]">
                            <span class="w-10 h-10 shrink-0 rounded-[12px] bg-primary/[.08] text-primary flex items-center justify-center">
                                <span class="material-symbols-outlined text-[19px]" aria-hidden="true">{{ $service['icon'] }}</span>
                            </span>

                            <div class="min-w-0">
                                <h3 class="text-[11px] md:text-[12px] font-bold leading-snug text-on-surface">
                                    {{ __($service['label']) }}
                                </h3>
                                <p class="mt-0.5 text-[9px] md:text-[10px] leading-relaxed text-on-surface-variant/75">
                                    {{ __($service['description']) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- CTA --}}
            <aside class="relative flex flex-col justify-between overflow-hidden border-t lg:border-t-0 lg:border-l border-primary/10 bg-primary p-6 md:p-7 text-on-primary">
                <div class="absolute -right-16 -top-16 w-44 h-44 rounded-full border-[28px] border-white/[.035]" aria-hidden="true"></div>
                <div class="absolute -left-16 -bottom-20 w-40 h-40 rounded-full bg-white/[.025]" aria-hidden="true"></div>

                <div class="relative">
                    <span class="w-11 h-11 rounded-[14px] bg-white/10 border border-white/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[22px] text-secondary" aria-hidden="true">open_in_new</span>
                    </span>

                    <p class="mt-5 text-[10px] font-extrabold uppercase tracking-[.1em] text-white/55">
                        {{ __('Portal Layanan') }}
                    </p>

                    <h3 class="mt-1.5 font-serif text-[22px] font-bold leading-tight text-white">
                        {{ __('Ajukan Layanan Secara Online') }}
                    </h3>

                    <p class="mt-3 text-[11px] leading-[1.65] text-white/70">
                        {{ __('Gunakan portal layanan terpadu untuk mengirim pengajuan dengan lebih cepat dan terstruktur.') }}
                    </p>
                </div>

                <div class="relative mt-7">
                    <a
                        href="{{ $serviceUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="group flex h-11 w-full items-center justify-between rounded-[13px] bg-white pl-4 pr-1.5 text-[11px] font-extrabold text-primary shadow-[0_8px_20px_rgba(0,0,0,.12)] transition-all hover:-translate-y-0.5 hover:shadow-[0_12px_24px_rgba(0,0,0,.16)]"
                    >
                        <span>{{ __('Buka Portal Layanan') }}</span>

                        <span class="w-8 h-8 rounded-[10px] bg-gold text-white flex items-center justify-center transition-transform group-hover:translate-x-0.5">
                            <span class="material-symbols-outlined text-[17px]" aria-hidden="true">north_east</span>
                        </span>
                    </a>

                    <p class="mt-3 text-[9px] leading-relaxed text-white/45">
                        {{ __('Tautan akan membuka sistem layanan pada tab baru.') }}
                    </p>
                </div>
            </aside>

        </div>
    </div>
</section>