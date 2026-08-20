<section class="py-6 md:py-8" aria-labelledby="reservation-heading">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-[1.4fr_1fr] rounded-[32px] overflow-hidden border border-outline-variant/20 shadow-[0_20px_50px_rgba(0,0,0,0.1)]">

            <!-- LEFT -->
            <div class="relative overflow-hidden p-6 md:p-8" style="background: radial-gradient(circle at 15% 10%, rgba(212,166,42,.06), transparent 35%), linear-gradient(160deg, #fdfefb 0%, #f8fbf8 100%);">
                <img src="{{ asset('images/leaf-decoration-right.png') }}" alt="" class="absolute -top-6 -right-6 w-[180px] md:w-[220px] h-auto opacity-25 pointer-events-none" loading="lazy" aria-hidden="true">
                <img src="{{ asset('images/leaf-decoration-left.png') }}" alt="" class="absolute -bottom-8 -left-8 w-[160px] md:w-[200px] h-auto opacity-15 pointer-events-none" loading="lazy" aria-hidden="true">

                <div class="relative z-10">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-[11px] font-extrabold uppercase tracking-wide mt-4">
                        <span class="material-symbols-outlined text-sm" aria-hidden="true">eco</span>
                        {{ __('Layanan Kami') }}
                    </span>

                    <h2 id="reservation-heading" class="font-serif text-primary text-[26px] md:text-[32px] leading-[1.1] font-bold mt-3">
                        {{ __('Reservasi & Pengajuan Layanan') }}
                    </h2>

                    <span class="block w-14 h-[3px] rounded-full bg-gold mt-3 mb-4"></span>

                    <p class="text-sm md:text-[15px] text-on-surface-variant leading-relaxed max-w-[520px]">
                        {{ __('Ajukan reservasi kunjungan, booking ruang rapat, usulan koleksi, dan layanan publik lainnya melalui portal layanan terpadu kami.') }}
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 mt-5">
                        @foreach ([
                            ['icon' => 'event', 'label' => 'Reservasi Kunjungan'],
                            ['icon' => 'meeting_room', 'label' => 'Booking Ruang Rapat'],
                            ['icon' => 'menu_book', 'label' => 'Usulan Koleksi'],
                            ['icon' => 'more_horiz', 'label' => 'Layanan Publik Lainnya'],
                        ] as $tag)
                            <div class="flex items-center justify-between gap-3 px-4 py-2.5 rounded-xl bg-white border border-outline-variant/30 shadow-[0_4px_14px_rgba(0,0,0,0.04)]">
                                <span class="flex items-center gap-3 min-w-0">
                                    <span class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-primary text-lg" aria-hidden="true">{{ $tag['icon'] }}</span>
                                    </span>
                                    <span class="text-sm font-semibold text-on-surface truncate">{{ __($tag['label']) }}</span>
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="relative overflow-hidden p-6 md:p-8 flex flex-col items-center justify-center text-center gap-4 text-on-primary" style="background: radial-gradient(circle at 85% 15%, rgba(255,255,255,.06), transparent 40%), linear-gradient(160deg, var(--color-primary-container) 0%, var(--color-primary) 100%);">
                <img src="{{ asset('images/leaf-decoration-right.png') }}" alt="" class="absolute -top-4 -right-4 w-[160px] h-auto opacity-15 pointer-events-none" loading="lazy" aria-hidden="true">

                <div class="relative z-10 w-14 h-14 rounded-full border-2 border-gold/50 flex items-center justify-center">
                    <span class="material-symbols-outlined text-gold text-2xl" aria-hidden="true">open_in_new</span>
                </div>

                <p class="relative z-10 font-serif text-base md:text-lg leading-relaxed max-w-sm">
                    {{ __('Semua layanan kami tersedia secara online untuk kemudahan dan kecepatan pelayanan.') }}
                </p>

                <div class="relative z-10 flex items-center gap-2.5 w-full max-w-[160px]">
                    <span class="flex-1 h-px bg-gold/40"></span>
                    <span class="material-symbols-outlined text-gold text-base" aria-hidden="true">spa</span>
                    <span class="flex-1 h-px bg-gold/40"></span>
                </div>

                <a
                    href="{{ \App\Models\SiteSetting::get('external_system_url', '#') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="relative z-10 inline-flex items-center justify-between gap-3 min-w-[250px] pl-6 pr-1.5 py-1.5 rounded-full bg-white text-primary font-serif font-bold text-sm border-2 border-gold/60 shadow-[0_10px_24px_rgba(0,0,0,0.16)] hover:shadow-[0_14px_30px_rgba(0,0,0,0.22)] hover:-translate-y-0.5 transition-all duration-300"
                >
                    <span>{{ __('Buka Portal Layanan') }}</span>

                    <span class="w-9 h-9 rounded-full bg-gold text-white flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-lg" aria-hidden="true">arrow_outward</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>