<x-layout :title="$collection->title" :solid-nav="false">
    <section class="relative min-h-screen overflow-hidden pt-[168px] md:pt-[176px] lg:pt-[154px] pb-12 md:pb-16 bg-[#f7f8f3]">

        {{-- BOTANICAL BACKGROUND --}}
        <div
            class="absolute inset-0 bg-top bg-no-repeat bg-[length:100%_100%] lg:bg-[length:100%_auto] pointer-events-none"
            style="background-image:url('{{ asset('images/collection-detail-bg.png') }}')"
            aria-hidden="true"
        ></div>

        {{-- BACKGROUND OVERLAY --}}
        <div
            class="absolute inset-0 bg-gradient-to-b from-white/[.12] via-[#f7f8f3]/[.05] to-[#f7f8f3]/35 pointer-events-none"
            aria-hidden="true"
        ></div>

        <div class="relative z-10 max-w-[1180px] mx-auto px-4 md:px-6">

            {{-- BREADCRUMB --}}
            <nav
                class="mb-6 md:mb-8 text-[11px] md:text-xs text-on-surface-variant"
                aria-label="{{ __('Breadcrumb') }}"
            >
                <ol class="flex items-center gap-1.5 md:gap-2.5 min-w-0">
                    <li class="shrink-0">
                        <a
                            href="{{ route('home') }}"
                            class="hover:text-primary transition-colors"
                        >
                            {{ __('Beranda') }}
                        </a>
                    </li>

                    <li class="flex items-center text-outline shrink-0">
                        <span
                            class="material-symbols-outlined text-[15px]"
                            aria-hidden="true"
                        >
                            chevron_right
                        </span>
                    </li>

                    <li class="shrink-0">
                        <a
                            href="{{ route('collections.index') }}"
                            class="hover:text-primary transition-colors"
                        >
                            {{ __('Koleksi') }}
                        </a>
                    </li>

                    {{-- Judul hanya tablet + desktop --}}
                    <li class="hidden md:flex items-center text-outline shrink-0">
                        <span
                            class="material-symbols-outlined text-[15px]"
                            aria-hidden="true"
                        >
                            chevron_right
                        </span>
                    </li>

                    <li class="hidden md:block min-w-0 max-w-[520px] truncate font-medium text-on-surface">
                        {{ $collection->title }}
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-[320px_minmax(0,1fr)] xl:grid-cols-[340px_minmax(0,1fr)] gap-7 lg:gap-10 xl:gap-12 items-start">

                {{-- LEFT --}}
                <aside class="w-full max-w-[340px] mx-auto lg:mx-0">

                    {{-- COVER --}}
                    <div class="relative rounded-[22px] border border-primary/10 bg-white/95 p-2.5 md:p-3 shadow-[0_16px_38px_rgba(25,70,44,.12)]">
                        <span
                            class="absolute inset-x-8 top-0 z-[2] h-[3px] rounded-b-full bg-secondary"
                            aria-hidden="true"
                        ></span>

                        <div class="relative overflow-hidden rounded-[16px] bg-surface-container-low aspect-[3/4]">
                            @if($collection->cover_path)
                                <img
                                    src="{{ $collection->cover_path }}"
                                    alt="Sampul buku {{ $collection->title }}"
                                    class="absolute inset-0 w-full h-full object-cover"
                                    loading="lazy"
                                    width="480"
                                    height="640"
                                >
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 bg-gradient-to-br from-primary/10 via-surface-container-low to-secondary/10">
                                    <span class="w-14 h-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center">
                                        <span
                                            class="material-symbols-outlined text-[30px]"
                                            aria-hidden="true"
                                        >
                                            menu_book
                                        </span>
                                    </span>

                                    <p class="mt-4 text-[12px] font-bold leading-relaxed text-primary">
                                        {{ $collection->title }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- ACCESS --}}
                    @if($collection->access_link)
                        <div class="mt-4 rounded-[18px] border border-primary/10 bg-white/90 p-4 shadow-[0_8px_22px_rgba(25,70,44,.06)]">
                            <div class="flex items-start gap-3">
                                <span class="w-9 h-9 rounded-[11px] bg-primary/[.08] text-primary flex items-center justify-center shrink-0">
                                    <span
                                        class="material-symbols-outlined text-[18px]"
                                        aria-hidden="true"
                                    >
                                        language
                                    </span>
                                </span>

                                <div>
                                    <h2 class="text-[12px] font-bold text-primary">
                                        {{ __('Akses Koleksi') }}
                                    </h2>

                                    <p class="mt-0.5 text-[10px] leading-[1.5] text-on-surface-variant">
                                        {{ __('Buka versi digital atau sumber koleksi yang tersedia.') }}
                                    </p>
                                </div>
                            </div>

                            <a
                                href="{{ $collection->access_link }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="group mt-3 inline-flex w-full h-10 items-center justify-center gap-2 rounded-xl bg-primary px-4 text-[11px] font-bold text-white shadow-[0_7px_16px_rgba(0,105,61,.18)] transition-all hover:-translate-y-0.5 hover:bg-primary-container hover:shadow-[0_10px_20px_rgba(0,105,61,.24)]"
                            >
                                <span
                                    class="material-symbols-outlined text-[17px]"
                                    aria-hidden="true"
                                >
                                    open_in_new
                                </span>

                                {{ __('Buka Koleksi') }}

                                <span
                                    class="material-symbols-outlined text-[14px] opacity-70 transition-transform group-hover:translate-x-0.5"
                                    aria-hidden="true"
                                >
                                    arrow_forward
                                </span>
                            </a>
                        </div>
                    @endif
                </aside>

                {{-- MAIN --}}
                <article class="min-w-0">

                    {{-- TITLE --}}
                    <header>
                        <span class="inline-flex items-center gap-2 rounded-full border border-primary/10 bg-primary/[.07] px-3 py-1.5 text-[9.5px] md:text-[10.5px] font-extrabold uppercase tracking-[.08em] text-primary">
                            <span
                                class="w-1.5 h-1.5 rounded-full bg-secondary"
                                aria-hidden="true"
                            ></span>

                            {{ $collection->category->name ?? __('Koleksi') }}
                        </span>

                        <h1 class="mt-4 max-w-[850px] font-serif text-[28px] md:text-[36px] lg:text-[40px] xl:text-[42px] font-bold leading-[1.12] tracking-[-.025em] text-primary-container">
                            {{ $collection->title }}
                        </h1>

                        @if($collection->author)
                            <p class="mt-3 flex items-start gap-2 text-[12px] md:text-[13px] leading-relaxed text-on-surface-variant">
                                <span
                                    class="material-symbols-outlined mt-px text-[17px] text-primary/70 shrink-0"
                                    aria-hidden="true"
                                >
                                    person
                                </span>

                                <span>{{ $collection->author }}</span>
                            </p>
                        @endif

                        <div class="mt-5 md:mt-6 flex items-center gap-3">
                            <span class="h-[3px] w-12 rounded-full bg-secondary"></span>
                            <span class="h-px flex-1 bg-primary/10"></span>
                        </div>
                    </header>

                    {{-- BIBLIOGRAPHIC INFORMATION --}}
                    <section class="mt-6 overflow-hidden rounded-[22px] border border-primary/10 bg-white/95 shadow-[0_12px_32px_rgba(25,70,44,.07)]">

                        {{-- HEADER --}}
                        <div class="flex items-center gap-3 px-5 py-4 md:px-6 md:py-5 border-b border-outline-variant/15 bg-[#fbfcf9]">
                            <span class="w-10 h-10 rounded-xl bg-primary/[.08] text-primary flex items-center justify-center shrink-0">
                                <span
                                    class="material-symbols-outlined text-[20px]"
                                    aria-hidden="true"
                                >
                                    menu_book
                                </span>
                            </span>

                            <div>
                                <p class="text-[9px] md:text-[10px] font-bold uppercase tracking-[.1em] text-on-surface-variant">
                                    {{ __('Detail Koleksi') }}
                                </p>

                                <h2 class="mt-0.5 text-[15px] md:text-lg font-bold text-primary">
                                    {{ __('Informasi Bibliografi') }}
                                </h2>
                            </div>
                        </div>

                        {{-- METADATA --}}
                        <dl class="grid grid-cols-2 lg:grid-cols-3">

                            {{-- PENULIS --}}
                            <div class="col-span-2 lg:col-span-3 px-5 py-4 md:px-6 border-b border-outline-variant/15">
                                <dt class="flex items-center gap-2 text-[9px] md:text-[10px] font-bold uppercase tracking-[.08em] text-on-surface-variant">
                                    <span
                                        class="material-symbols-outlined text-[16px] text-primary"
                                        aria-hidden="true"
                                    >
                                        person
                                    </span>

                                    {{ __('Penulis') }}
                                </dt>

                                <dd class="mt-1.5 text-[13px] md:text-[14px] font-semibold leading-relaxed text-on-surface">
                                    {{ $collection->author ?? '-' }}
                                </dd>
                            </div>

                            {{-- PENERBIT --}}
                            <div class="col-span-2 sm:col-span-1 px-5 py-4 md:px-6 border-b sm:border-r border-outline-variant/15">
                                <dt class="flex items-center gap-2 text-[9px] md:text-[10px] font-bold uppercase tracking-[.08em] text-on-surface-variant">
                                    <span
                                        class="material-symbols-outlined text-[16px] text-primary"
                                        aria-hidden="true"
                                    >
                                        apartment
                                    </span>

                                    {{ __('Penerbit') }}
                                </dt>

                                <dd class="mt-1.5 text-[13px] md:text-[14px] font-semibold text-on-surface">
                                    {{ $collection->publisher ?? '-' }}
                                </dd>
                            </div>

                            {{-- TAHUN --}}
                            <div class="px-5 py-4 md:px-6 border-b lg:border-r border-outline-variant/15">
                                <dt class="flex items-center gap-2 text-[9px] md:text-[10px] font-bold uppercase tracking-[.08em] text-on-surface-variant">
                                    <span
                                        class="material-symbols-outlined text-[16px] text-primary"
                                        aria-hidden="true"
                                    >
                                        calendar_month
                                    </span>

                                    {{ __('Tahun Terbit') }}
                                </dt>

                                <dd class="mt-1.5 text-[13px] md:text-[14px] font-semibold text-on-surface">
                                    {{ $collection->published_year ?? '-' }}
                                </dd>
                            </div>

                            {{-- HALAMAN --}}
                            <div class="px-5 py-4 md:px-6 border-b border-outline-variant/15">
                                <dt class="flex items-center gap-2 text-[9px] md:text-[10px] font-bold uppercase tracking-[.08em] text-on-surface-variant">
                                    <span
                                        class="material-symbols-outlined text-[16px] text-primary"
                                        aria-hidden="true"
                                    >
                                        auto_stories
                                    </span>

                                    {{ __('Tebal Buku') }}
                                </dt>

                                <dd class="mt-1.5 text-[13px] md:text-[14px] font-semibold text-on-surface">
                                    {{ $collection->page_count ? $collection->page_count.' '.__('halaman') : '-' }}
                                </dd>
                            </div>

                            {{-- ISBN --}}
                            <div class="col-span-2 lg:col-span-3 px-5 py-4 md:px-6">
                                <dt class="flex items-center gap-2 text-[9px] md:text-[10px] font-bold uppercase tracking-[.08em] text-on-surface-variant">
                                    <span
                                        class="material-symbols-outlined text-[16px] text-primary"
                                        aria-hidden="true"
                                    >
                                        barcode
                                    </span>

                                    {{ __('ISBN') }}
                                </dt>

                                <dd class="mt-1.5 text-[13px] md:text-[14px] font-semibold text-on-surface">
                                    {{ $collection->isbn ?: '-' }}
                                </dd>
                            </div>
                        </dl>
                    </section>

                    {{-- SYNOPSIS --}}
                    <section class="mt-6 rounded-[22px] border border-primary/10 bg-white/90 px-5 py-5 md:px-6 md:py-6 shadow-[0_10px_28px_rgba(25,70,44,.055)]">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="w-9 h-9 rounded-[11px] bg-secondary-container/60 text-primary flex items-center justify-center shrink-0">
                                <span
                                    class="material-symbols-outlined text-[18px]"
                                    aria-hidden="true"
                                >
                                    subject
                                </span>
                            </span>

                            <div>
                                <p class="text-[9px] font-bold uppercase tracking-[.1em] text-on-surface-variant">
                                    {{ __('Tentang Buku') }}
                                </p>

                                <h2 class="mt-0.5 text-[15px] md:text-lg font-bold text-primary">
                                    {{ __('Sinopsis') }}
                                </h2>
                            </div>
                        </div>

                        <p class="max-w-[900px] whitespace-pre-line text-[13px] md:text-[14px] leading-[1.8] text-on-surface-variant">
                            {{ $collection->synopsis ?: __('Informasi koleksi ini belum memiliki sinopsis.') }}
                        </p>
                    </section>
                </article>
            </div>
        </div>
    </section>
</x-layout>