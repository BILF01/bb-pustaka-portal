<x-layout title="Tentang Kami" description="Mengenal BB Pustaka — institusi di balik literasi pertanian Indonesia, sejarah, visi misi, peran, dan struktur organisasinya." :solid-nav="false">

    {{-- ===================== HERO (Pinned) ===================== --}}
    <div class="relative">
        <section class="sticky top-0 z-0 h-screen flex items-center pt-28 pb-16 overflow-hidden bg-primary">
            <div class="absolute inset-y-0 right-0 w-full lg:w-[78%]">
                <img
                    src="{{ asset('images/gedung-bb-pustaka.jpeg') }}"
                    alt="Gedung BB Pustaka"
                    class="w-full h-full object-cover"
                    style="object-position: center 35%;"
                    loading="lazy"
                >
                <div class="absolute inset-0" style="background: linear-gradient(90deg, var(--color-primary) 0%, rgba(5,104,57,.85) 10%, rgba(5,104,57,.4) 25%, rgba(5,104,57,.05) 42%, transparent 55%)"></div>
            </div>
            <div class="absolute inset-0 bg-primary/70 lg:hidden"></div>

            <div class="relative z-10 max-w-[1280px] mx-auto px-6 w-full">
                <div class="max-w-xl">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-8 h-px bg-secondary"></span>
                        <span class="text-sm font-bold text-secondary uppercase tracking-[0.25em]">Tentang BB Pustaka</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-5 leading-tight">
                        Mengenal Institusi di Balik Literasi Pertanian Indonesia
                    </h1>
                    <p class="text-white/90 leading-relaxed mb-8 max-w-md">
                        BB Pustaka (Balai Besar Perpustakaan dan Literasi Pertanian) terus bertransformasi mengikuti perkembangan organisasi Kementerian Pertanian, berkomitmen menjadi pusat rujukan literasi pertanian terdepan di Indonesia.
                    </p>
                    <a href="#sejarah" class="group inline-flex items-center gap-2 px-6 h-12 bg-white text-primary font-bold rounded-lg hover:bg-surface-container-low transition-all">
                        Jelajahi Sejarah Kami
                        <span class="material-symbols-outlined text-base transition-transform group-hover:translate-y-0.5" aria-hidden="true">arrow_downward</span>
                    </a>
                </div>
            </div>
        </section>

        {{-- ===================== TENTANG BB PUSTAKA ===================== --}}
        <section class="relative z-10 -mt-16 md:-mt-20 py-16 md:py-20 bg-surface-container-lowest rounded-t-[2rem] md:rounded-t-[2.5rem] shadow-[0_-25px_50px_rgba(0,0,0,0.15)]">
            <div class="max-w-[1280px] mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                {{-- placeholder: kolase foto interior/kegiatan, ganti dengan aset resmi --}}
                <div class="relative">
                    <img
                        src="{{ asset('images/gedung01-bb-pustaka.jpeg') }}"
                        alt="Interior perpustakaan BB Pustaka"
                        class="w-full aspect-[4/3] object-cover rounded-2xl shadow-md"
                        loading="lazy"
                    >
                    <img
                        src="{{ asset('images/bb-pustaka.jpeg') }}"
                        alt="Koleksi buku BB Pustaka"
                        class="hidden md:block absolute -bottom-8 -right-6 w-2/5 aspect-square object-cover rounded-2xl shadow-lg border-4 border-white"
                        loading="lazy"
                    >
                </div>

                <div class="mt-8 lg:mt-0">
                    <span class="text-xs font-bold text-secondary uppercase tracking-[0.2em]">Siapa Kami</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-primary mt-3 mb-4">Tentang BB Pustaka</h2>
                    <p class="text-on-surface-variant leading-relaxed mb-8">
                        BB Pustaka (Balai Besar Perpustakaan dan Literasi Pertanian) merupakan lembaga yang terus bertransformasi mengikuti perkembangan organisasi Kementerian Pertanian, berkomitmen menjadi pusat rujukan literasi pertanian terdepan di Indonesia.
                    </p>

                    <div class="border-l-4 border-secondary pl-6">
                        <span class="block text-3xl md:text-4xl font-bold text-primary">1842 — 2026</span>
                        <span class="block text-sm font-semibold text-on-surface-variant mt-1">180+ Tahun Perjalanan Literasi Pertanian</span>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- ===================== SEJARAH / VISUAL JOURNEY ===================== --}}
    <section id="sejarah" class="scroll-mt-24 py-16 md:py-24 max-w-[1280px] mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold text-secondary uppercase tracking-[0.2em]">Sejarah BB Pustaka</span>
            <h2 class="text-2xl md:text-3xl font-bold text-primary mt-3 mb-4">
                Perjalanan Panjang Literasi Pertanian Indonesia
            </h2>
            <p class="text-on-surface-variant leading-relaxed">
                Perjalanan BB Pustaka dimulai sejak 1842 dan terus berkembang mengikuti kebutuhan informasi, pengetahuan, dan literasi pertanian di Indonesia.
            </p>
        </div>

        <div class="text-center mb-12">
            <span class="text-xs font-semibold text-on-surface-variant uppercase tracking-[0.15em]">Jejak Perjalanan</span>
        </div>

        @php
            $milestones = [
                ['year' => '1842', 'title' => 'Awal Berdirinya PUSTAKA', 'desc' => 'Diawali dengan pembelian 25 judul buku milik Jacques Pierot yang disarankan oleh J.K. Hasskarl dan M. Diard.'],
                ['year' => '1850', 'title' => "Bibliotheek's Land Plantentuin te Buitenzorg", 'desc' => 'Secara resmi menjadi perpustakaan dengan nama tersebut.'],
                ['year' => '2000', 'title' => 'Pusat Perpustakaan dan Penyebaran Teknologi Pertanian', 'desc' => 'Berdasarkan SK Menteri Pertanian Nomor 160/2000, nama PUSTAKA berubah.'],
                ['year' => '2023', 'title' => 'Pusat Perpustakaan dan Literasi Pertanian', 'desc' => 'Nama PUSTAKA berubah kembali mengikuti perkembangan organisasi.'],
                ['year' => '2025', 'title' => 'Balai Besar Perpustakaan dan Literasi Pertanian', 'desc' => 'Nama PUSTAKA kembali berganti menjadi nama yang digunakan saat ini.'],
            ];
        @endphp

        <div
            x-data
            x-init="
                const items = $el.querySelectorAll('[data-milestone]');
                const obs = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        entry.target.classList.toggle('milestone-active', entry.isIntersecting);
                    });
                }, { threshold: 0.55 });
                items.forEach((el) => obs.observe(el));
            "
        >
            {{-- Desktop: horizontal journey --}}
            <div class="hidden lg:block relative">
                <div class="absolute left-0 right-0 h-px bg-outline-variant/40" style="top: 8rem;"></div>
                <div class="relative grid grid-cols-5 gap-3">
                    @foreach ($milestones as $item)
                        <div data-milestone class="flex flex-col items-center milestone-item transition-all duration-500 motion-reduce:transition-none opacity-50 scale-95">
                            <div class="h-32 flex items-end justify-center w-full px-1">
                                @if ($loop->even)
                                    <div class="text-center pb-5">
                                        <span class="inline-block text-lg font-bold text-primary mb-1 milestone-year">{{ $item['year'] }}</span>
                                        <p class="text-xs font-semibold text-on-surface leading-snug">{{ $item['title'] }}</p>
                                        <p class="text-[11px] text-on-surface-variant leading-snug mt-1">{{ $item['desc'] }}</p>
                                    </div>
                                @endif
                            </div>

                            <span class="w-3.5 h-3.5 rounded-full bg-primary ring-4 ring-white shadow-sm shrink-0 z-10 milestone-dot transition-transform duration-500 motion-reduce:transition-none"></span>

                            <div class="h-32 flex items-start justify-center w-full px-1">
                                @if ($loop->odd)
                                    <div class="text-center pt-5">
                                        <span class="inline-block text-lg font-bold text-primary mb-1 milestone-year">{{ $item['year'] }}</span>
                                        <p class="text-xs font-semibold text-on-surface leading-snug">{{ $item['title'] }}</p>
                                        <p class="text-[11px] text-on-surface-variant leading-snug mt-1">{{ $item['desc'] }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Mobile: vertical journey --}}
            <div class="lg:hidden relative pl-6">
                <div class="absolute left-[7px] top-2 bottom-2 w-px bg-outline-variant/40"></div>
                <div class="space-y-8">
                    @foreach ($milestones as $item)
                        <div data-milestone class="relative milestone-item transition-opacity duration-500 motion-reduce:transition-none opacity-60">
                            <span class="absolute -left-6 top-1 w-3.5 h-3.5 rounded-full bg-primary ring-4 ring-white shadow-sm milestone-dot"></span>
                            <span class="text-lg font-bold text-primary milestone-year">{{ $item['year'] }}</span>
                            <p class="text-sm font-semibold text-on-surface mt-0.5">{{ $item['title'] }}</p>
                            <p class="text-sm text-on-surface-variant mt-1 leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== VISI & MISI ===================== --}}
    <section class="py-16 md:py-20 max-w-[1280px] mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-primary text-on-primary rounded-2xl p-8 md:p-10 relative overflow-hidden flex flex-col justify-center">
                <span class="text-xs font-bold text-secondary uppercase tracking-[0.2em] mb-4">Visi</span>
                <p class="text-2xl md:text-3xl font-bold leading-snug">
                    &ldquo;Menjadi pusat literasi pertanian yang handal dan mandiri.&rdquo;
                </p>
                <span class="material-symbols-outlined absolute -bottom-6 -right-6 text-white/10 text-[140px] pointer-events-none" aria-hidden="true">eco</span>
            </div>

            <div class="bg-surface-container-low rounded-2xl p-8 md:p-10 border-l-4 border-secondary flex flex-col justify-center">
                <span class="text-xs font-bold text-primary uppercase tracking-[0.2em] mb-4">Misi</span>
                <p class="text-lg md:text-xl font-semibold text-on-surface leading-snug">
                    Mengelola pengetahuan dan teknologi pertanian untuk kemaslahatan masyarakat.
                </p>
            </div>
        </div>
    </section>

    {{-- ===================== PERAN & FUNGSI ===================== --}}
    <section class="py-16 md:py-20 bg-surface-container-lowest border-y border-outline-variant/20">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold text-secondary uppercase tracking-[0.2em]">Peran &amp; Fungsi</span>
                <h2 class="text-2xl md:text-3xl font-bold text-primary mt-3">Apa yang Kami Lakukan</h2>
            </div>

            @php
                $functions = [
                    ['num' => '01', 'title' => 'Pengembangan Koleksi', 'desc' => 'Pengembangan koleksi dan repository ilmiah pertanian.'],
                    ['num' => '02', 'title' => 'Layanan Referensi', 'desc' => 'Layanan referensi dan penelusuran informasi pertanian.'],
                    ['num' => '03', 'title' => 'Publikasi', 'desc' => 'Publikasi dan penerbitan bahan literasi pertanian.'],
                    ['num' => '04', 'title' => 'Pembinaan Kepustakawanan', 'desc' => 'Pembinaan kepustakawanan lingkup Kementerian Pertanian.'],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                @foreach ($functions as $fn)
                    <div class="flex gap-5 pb-8 border-b border-outline-variant/20 last:md:border-b-0">
                        <span class="text-3xl font-bold text-secondary shrink-0">{{ $fn['num'] }}</span>
                        <div>
                            <h3 class="font-bold text-primary mb-1">{{ $fn['title'] }}</h3>
                            <p class="text-sm text-on-surface-variant">{{ $fn['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== STRUKTUR ORGANISASI ===================== --}}
    <section class="py-16 md:py-20 max-w-[1280px] mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold text-secondary uppercase tracking-[0.2em]">Struktur Organisasi</span>
            <h2 class="text-2xl md:text-3xl font-bold text-primary mt-3">Bersinergi untuk Literasi Pertanian</h2>
        </div>

        @php
            $units = [
                'Bagian Tata Usaha',
                'Bidang Pengembangan Koleksi dan Repository',
                'Bidang Layanan dan Literasi Pertanian',
                'Kelompok Jabatan Fungsional Pustakawan',
            ];
        @endphp

        <div class="flex flex-col items-center">
            <div class="bg-primary text-on-primary font-bold px-6 py-3 rounded-lg shadow-sm">Kepala Balai</div>
            <div class="w-px h-8 bg-outline-variant"></div>

            <div class="hidden md:block w-full max-w-4xl h-px bg-outline-variant relative mb-8">
                @for ($i = 0; $i < count($units); $i++)
                    <div class="absolute top-0 w-px h-8 bg-outline-variant" style="left: {{ (($i + 0.5) / count($units)) * 100 }}%"></div>
                @endfor
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 w-full max-w-4xl">
                @foreach ($units as $unit)
                    <div class="bg-surface-container-low border border-outline-variant/30 rounded-lg px-4 py-3 text-center text-sm font-semibold text-on-surface">
                        {{ $unit }}
                    </div>
                @endforeach
            </div>
        </div>

        <p class="text-xs text-on-surface-variant text-center mt-8">*Struktur organisasi dapat berubah sesuai dengan ketentuan yang berlaku.</p>
    </section>

    {{-- ===================== CTA ===================== --}}
    <section class="py-16 md:py-20 max-w-[1280px] mx-auto px-6">
        <div class="bg-primary text-on-primary rounded-2xl p-10 md:p-14 text-center relative overflow-hidden">
            <h2 class="text-2xl md:text-3xl font-bold mb-3">Jelajahi Koleksi BB Pustaka</h2>
            <p class="text-white/90 max-w-xl mx-auto mb-8">
                Temukan ribuan koleksi literasi pertanian yang kami kelola untuk mendukung penelitian dan pengembangan pertanian Indonesia.
            </p>
            <a href="{{ route('collections.index') }}" class="inline-flex items-center gap-2 px-8 h-12 bg-secondary text-on-secondary font-bold rounded-lg hover:bg-white transition-all">
                Jelajahi Koleksi
                <span class="material-symbols-outlined text-base" aria-hidden="true">arrow_forward</span>
            </a>
            <span class="material-symbols-outlined absolute -bottom-8 -right-8 text-white/10 text-[160px] pointer-events-none" aria-hidden="true">local_library</span>
        </div>
    </section>

</x-layout>