@props(['sources'])

@php
    $details = [
        'Repositori Pertanian' => [
            'type' => 'Koleksi Digital',
            'purpose' => 'Publikasi & referensi ilmiah',
            'description' => 'Koleksi digital publikasi lingkup Kementerian Pertanian untuk mendukung kebutuhan referensi dan penelusuran informasi pertanian.',
        ],
        'Katalog Induk Kementerian Pertanian' => [
            'type' => 'Katalog Terintegrasi',
            'purpose' => 'Koleksi lintas perpustakaan',
            'description' => 'Telusuri koleksi perpustakaan di lingkungan Kementerian Pertanian melalui layanan katalog yang terintegrasi.',
        ],
        'Katalog Online Pustaka' => [
            'type' => 'Katalog BB Pustaka',
            'purpose' => 'Pencarian koleksi Pustaka',
            'description' => 'Temukan buku dan bahan pustaka yang tersedia pada koleksi Balai Besar Perpustakaan dan Literasi Pertanian.',
        ],
        'E-Publikasi Pertanian' => [
            'type' => 'Publikasi Digital',
            'purpose' => 'Terbitan pertanian digital',
            'description' => 'Akses berbagai publikasi pertanian digital sebagai sumber informasi dan pengetahuan bidang pertanian.',
        ],
    ];
@endphp

<section class="py-12 md:py-14" aria-labelledby="information-sources-heading">
    <div class="w-[92%] max-w-[1240px] mx-auto">

        {{-- HEADER --}}
        <div class="max-w-[720px] mb-7 md:mb-8">
            <p class="flex items-center gap-2 text-[10px] md:text-[11px] font-extrabold uppercase tracking-[.12em] text-primary/65">
                <span class="material-symbols-outlined text-[17px]" aria-hidden="true">library_books</span>
                {{ __('Layanan Informasi Digital') }}
            </p>

            <h2 id="information-sources-heading" class="mt-2 font-serif text-[27px] md:text-[32px] font-bold leading-[1.15] tracking-[-.015em] text-primary-container">
                {{ __('Sumber Informasi Pertanian') }}
            </h2>

            <p class="mt-2.5 max-w-[680px] text-[12.5px] md:text-sm leading-[1.7] text-on-surface-variant">
                {{ __('Akses katalog, repositori, dan publikasi digital untuk mendukung pencarian koleksi serta kebutuhan informasi pertanian.') }}
            </p>
        </div>

        {{-- 4 SUMBER INFORMASI --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3.5">
            @foreach ($sources as $source)
                @php
                    $detail = $details[$source['title']] ?? [
                        'type' => 'Sumber Informasi',
                        'purpose' => 'Informasi pertanian',
                        'description' => $source['description'],
                    ];

                    $host = parse_url($source['url'], PHP_URL_HOST);
                    $host = $host ? preg_replace('/^www\./', '', $host) : null;
                @endphp

                <a
                    href="{{ $source['url'] }}"
                    @if($source['external'] ?? false)
                        target="_blank"
                        rel="noopener noreferrer"
                    @endif
                    class="group relative flex min-h-[245px] flex-col overflow-hidden rounded-[18px] border border-outline-variant/25 bg-surface-container-lowest p-5 transition-all duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-[0_12px_28px_rgba(22,61,44,.09)]"
                >
                    {{-- IDENTITAS --}}
                    <div class="flex items-start gap-3.5">
                        <span class="w-11 h-11 shrink-0 rounded-[12px] border border-primary/10 bg-primary/[.07] text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-[21px]" aria-hidden="true">
                                {{ $source['icon'] }}
                            </span>
                        </span>

                        <div class="min-w-0 pt-0.5">
                            <p class="text-[9px] font-extrabold uppercase tracking-[.1em] text-primary/55">
                                {{ __($detail['type']) }}
                            </p>

                            <h3 class="mt-1 text-[13px] md:text-[13.5px] font-bold leading-[1.4] text-primary-container">
                                {{ __($source['title']) }}
                            </h3>
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <p class="mt-4 text-[10.5px] md:text-[11px] leading-[1.65] text-on-surface-variant">
                        {{ __($detail['description']) }}
                    </p>

                    {{-- FUNGSI --}}
                    <div class="mt-4 flex items-start gap-2">
                        <span class="material-symbols-outlined mt-px text-[15px] text-primary shrink-0" aria-hidden="true">
                            check_circle
                        </span>

                        <span class="text-[9.5px] font-semibold leading-[1.5] text-on-surface-variant">
                            {{ __($detail['purpose']) }}
                        </span>
                    </div>

                    {{-- LINK --}}
                    <div class="mt-auto pt-4">
                        <div class="h-px bg-outline-variant/20 mb-3"></div>

                        <div class="flex items-center justify-between gap-3">
                            <span class="min-w-0 truncate text-[9px] font-bold text-primary/70">
                                {{ $host ?: __('Buka layanan') }}
                            </span>

                            <span class="inline-flex items-center gap-1 text-[10px] font-extrabold text-primary">
                                {{ __('Kunjungi') }}
                                <span class="material-symbols-outlined text-[15px] transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5" aria-hidden="true">
                                    {{ $source['external'] ?? false ? 'north_east' : 'arrow_forward' }}
                                </span>
                            </span>
                        </div>
                    </div>

                    {{-- ACCENT --}}
                    <span class="absolute inset-x-5 bottom-0 h-[2px] origin-left scale-x-0 bg-primary transition-transform duration-300 group-hover:scale-x-100" aria-hidden="true"></span>
                </a>
            @endforeach
        </div>

        {{-- NOTE --}}
        <div class="mt-4 flex items-start gap-2.5">
            <span class="material-symbols-outlined text-[16px] text-primary/70 shrink-0" aria-hidden="true">info</span>
            <p class="max-w-[760px] text-[10px] leading-[1.6] text-on-surface-variant/75">
                {{ __('Setiap sumber memiliki cakupan koleksi yang berbeda. Pilih layanan sesuai jenis informasi yang ingin Anda telusuri.') }}
            </p>
        </div>
    </div>
</section>