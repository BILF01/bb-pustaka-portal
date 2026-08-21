<x-layout title="Koleksi" :solid-nav="false">
    <section class="min-h-screen bg-[#F5F7F3] pb-10 md:pb-20">

        {{-- HERO + SEARCH --}}
        <div class="relative overflow-hidden">
            <img
                src="{{ asset('images/minimal_botanical_book_banner.png') }}"
                alt=""
                class="absolute inset-0 w-full h-full object-cover object-[72%_center] md:object-center pointer-events-none"
                loading="lazy"
                aria-hidden="true"
            >

            <div
                class="absolute inset-0 bg-gradient-to-b from-white/5 via-[#F8FAF5]/20 to-[#F5F7F3]/95 md:from-white/10 md:via-[#F8FAF5]/45 md:to-[#F5F7F3] pointer-events-none"
                aria-hidden="true"
            ></div>

            <div class="relative z-10 max-w-[1280px] mx-auto px-4 md:px-6 pt-[184px] md:pt-[176px] lg:pt-[150px] pb-7 md:pb-10">

                {{-- BREADCRUMB --}}
                <nav
                    class="flex items-center gap-1.5 mb-4 md:mb-5 text-[10px] md:text-[11px] text-on-surface-variant"
                    aria-label="{{ __('Breadcrumb') }}"
                >
                    <a
                        href="{{ route('home') }}"
                        class="hover:text-primary transition-colors"
                    >
                        {{ __('Beranda') }}
                    </a>

                    <span
                        class="material-symbols-outlined text-[14px] text-on-surface-variant/50"
                        aria-hidden="true"
                    >
                        chevron_right
                    </span>

                    <span class="font-semibold text-primary">
                        {{ __('Koleksi') }}
                    </span>
                </nav>

                {{-- TITLE --}}
                <div class="max-w-[760px]">
                    <p class="flex items-center gap-2 text-[10px] md:text-[11px] font-extrabold uppercase tracking-[.12em] text-primary/70">
                        <span
                            class="material-symbols-outlined text-[17px]"
                            aria-hidden="true"
                        >
                            local_library
                        </span>

                        {{ __('Katalog Perpustakaan') }}
                    </p>

                    <h1 class="mt-2 font-serif text-[28px] md:text-[38px] lg:text-[42px] font-bold leading-[1.08] tracking-[-.02em] text-primary-container">
                        {{ __('Koleksi BB Pustaka') }}
                    </h1>

                    <p class="mt-3 max-w-[680px] text-[12px] md:text-[14px] leading-[1.65] md:leading-[1.7] text-on-surface-variant">
                        {{ __('Temukan buku, publikasi, dan referensi pertanian yang tersedia dalam koleksi Balai Besar Perpustakaan dan Literasi Pertanian.') }}
                    </p>
                </div>

                {{-- SEARCH --}}
                <form
                    method="GET"
                    action="{{ route('collections.index') }}"
                    class="mt-6 md:mt-7 max-w-[940px]"
                >
                    @if(request('category'))
                        <input
                            type="hidden"
                            name="category"
                            value="{{ request('category') }}"
                        >
                    @endif

                    <div class="flex items-center gap-1.5 md:gap-2 rounded-[16px] md:rounded-[18px] border border-primary/10 bg-white/90 backdrop-blur-md p-1.5 shadow-[0_10px_30px_rgba(31,73,44,.08)]">
                        <div class="relative min-w-0 flex-1">
                            <span
                                class="material-symbols-outlined absolute left-3.5 md:left-4 top-1/2 -translate-y-1/2 text-[19px] md:text-[20px] text-primary/55"
                                aria-hidden="true"
                            >
                                search
                            </span>

                            <label
                                for="collection-search"
                                class="sr-only"
                            >
                                {{ __('Cari judul atau penulis') }}
                            </label>

                            <input
                                id="collection-search"
                                name="q"
                                type="search"
                                value="{{ request('q') }}"
                                placeholder="{{ __('Cari judul atau penulis...') }}"
                                class="w-full h-11 md:h-12 pl-11 md:pl-12 pr-2 md:pr-4 bg-transparent border-0 rounded-[13px] md:rounded-[14px] text-[12px] md:text-[13px] text-on-surface placeholder:text-on-surface-variant/55 focus:ring-0"
                            >
                        </div>

                        <button
                            type="submit"
                            class="h-10 md:h-11 px-4 md:px-7 rounded-[12px] md:rounded-[13px] bg-primary text-on-primary text-[11px] md:text-[12px] font-extrabold flex items-center gap-1.5 md:gap-2 shrink-0 shadow-sm transition-all hover:bg-primary-container hover:shadow-md"
                        >
                            <span
                                class="material-symbols-outlined text-[17px]"
                                aria-hidden="true"
                            >
                                search
                            </span>

                            {{ __('Cari') }}
                        </button>
                    </div>
                </form>

                {{-- CATEGORY FILTER --}}
                <div class="mt-5 md:mt-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span
                            class="material-symbols-outlined text-[17px] text-primary"
                            aria-hidden="true"
                        >
                            filter_alt
                        </span>

                        <span class="text-[10.5px] md:text-[11px] font-bold text-primary-container">
                            {{ __('Filter Kategori') }}
                        </span>
                    </div>

                    <div class="relative">
                        <div class="-mx-4 px-4 pr-12 flex gap-2 overflow-x-auto pb-1 no-scrollbar md:mx-0 md:px-0 md:pr-0 md:flex-wrap md:overflow-visible md:pb-0">
                            <a
                                href="{{ route('collections.index', array_filter([
                                    'q' => request('q'),
                                ])) }}"
                                class="shrink-0 inline-flex items-center gap-1.5 h-9 px-3.5 rounded-full border text-[10px] md:text-[10.5px] font-bold transition-all
                                    {{ !request('category')
                                        ? 'bg-primary text-on-primary border-primary shadow-sm'
                                        : 'bg-white/80 text-on-surface-variant border-outline-variant/40 hover:text-primary hover:border-primary/30 hover:bg-white'
                                    }}"
                            >
                                <span
                                    class="material-symbols-outlined text-[15px]"
                                    aria-hidden="true"
                                >
                                    apps
                                </span>

                                {{ __('Semua Koleksi') }}
                            </a>

                            @foreach($categories as $cat)
                                <a
                                    href="{{ route('collections.index', array_filter([
                                        'q' => request('q'),
                                        'category' => $cat->slug,
                                    ])) }}"
                                    class="shrink-0 inline-flex items-center gap-1.5 h-9 px-3.5 rounded-full border text-[10px] md:text-[10.5px] font-bold transition-all
                                        {{ request('category') === $cat->slug
                                            ? 'bg-primary text-on-primary border-primary shadow-sm'
                                            : 'bg-white/80 text-on-surface-variant border-outline-variant/40 hover:text-primary hover:border-primary/30 hover:bg-white'
                                        }}"
                                >
                                    <span
                                        class="material-symbols-outlined text-[14px]"
                                        aria-hidden="true"
                                    >
                                        eco
                                    </span>

                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>

                        {{-- MOBILE SCROLL INDICATOR --}}
                        <div
                            class="md:hidden pointer-events-none absolute right-0 top-0 bottom-1 w-11 bg-gradient-to-l from-[#F5F7F3] via-[#F5F7F3]/85 to-transparent"
                            aria-hidden="true"
                        ></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- COLLECTION CONTENT --}}
        <div class="max-w-[1280px] mx-auto px-4 md:px-6">

            {{-- RESULT INFO --}}
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3 mb-6 md:mb-7 pb-4 border-b border-outline-variant/25">
                <div>
                    <p class="text-[11px] md:text-[12px] font-bold text-primary-container">
                        @if($collections->total() > 0)
                            {{ __('Menampilkan') }}
                            {{ $collections->firstItem() }}–{{ $collections->lastItem() }}
                            {{ __('dari') }}
                            {{ $collections->total() }}
                            {{ __('koleksi') }}
                        @else
                            {{ __('Tidak ada koleksi ditemukan') }}
                        @endif
                    </p>

                    @if(request('q') || request('category'))
                        <p class="mt-1 text-[10px] md:text-[10.5px] leading-relaxed text-on-surface-variant">
                            @if(request('q'))
                                {{ __('Pencarian') }}:
                                <span class="font-semibold text-on-surface">
                                    “{{ request('q') }}”
                                </span>
                            @endif

                            @if(request('q') && request('category'))
                                <span class="mx-1 text-on-surface-variant/40">
                                    •
                                </span>
                            @endif

                            @if(request('category'))
                                {{ __('Kategori') }}:
                                <span class="font-semibold text-on-surface">
                                    {{ $categories->firstWhere('slug', request('category'))?->name ?? request('category') }}
                                </span>
                            @endif
                        </p>
                    @else
                        <p class="mt-1 text-[10px] md:text-[10.5px] text-on-surface-variant">
                            {{ __('Jelajahi seluruh koleksi yang tersedia di BB Pustaka.') }}
                        </p>
                    @endif
                </div>

                @if(request('q') || request('category'))
                    <a
                        href="{{ route('collections.index') }}"
                        class="inline-flex items-center gap-1.5 text-[10px] md:text-[10.5px] font-bold text-primary hover:underline shrink-0"
                    >
                        <span
                            class="material-symbols-outlined text-[15px]"
                            aria-hidden="true"
                        >
                            restart_alt
                        </span>

                        {{ __('Reset Filter') }}
                    </a>
                @endif
            </div>

            {{-- GRID --}}
            @if($collections->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-7 md:gap-x-6 md:gap-y-10">
                    @foreach($collections as $collection)
                        <x-book-card :collection="$collection" />
                    @endforeach
                </div>
            @else
                {{-- EMPTY STATE --}}
                <div class="rounded-[20px] md:rounded-[22px] border border-primary/10 bg-surface-container-lowest px-5 md:px-6 py-10 md:py-14 text-center shadow-[0_8px_24px_rgba(22,61,44,.05)]">
                    <span class="w-12 h-12 mx-auto rounded-[14px] bg-primary/[.08] text-primary flex items-center justify-center">
                        <span
                            class="material-symbols-outlined text-[24px]"
                            aria-hidden="true"
                        >
                            search_off
                        </span>
                    </span>

                    <h2 class="mt-4 font-serif text-lg md:text-xl font-bold text-primary-container">
                        {{ __('Koleksi tidak ditemukan') }}
                    </h2>

                    <p class="mt-2 max-w-[480px] mx-auto text-[11px] md:text-[12px] leading-[1.65] text-on-surface-variant">
                        {{ __('Coba gunakan kata kunci lain atau hapus filter kategori untuk melihat koleksi yang tersedia.') }}
                    </p>

                    <a
                        href="{{ route('collections.index') }}"
                        class="mt-5 inline-flex items-center gap-2 h-10 px-4 rounded-full bg-primary text-on-primary text-[11px] font-bold"
                    >
                        <span
                            class="material-symbols-outlined text-[16px]"
                            aria-hidden="true"
                        >
                            restart_alt
                        </span>

                        {{ __('Lihat Semua Koleksi') }}
                    </a>
                </div>
            @endif

            {{-- PAGINATION --}}
            @if($collections->hasPages())
                @php
                    $currentPage=$collections->currentPage();
                    $lastPage=$collections->lastPage();
                    $startPage=max(1,$currentPage-1);
                    $endPage=min($lastPage,$currentPage+1);
                @endphp

                <nav
                    class="mt-9 md:mt-10 pt-5 border-t border-outline-variant/20 flex items-center justify-center md:justify-end"
                    aria-label="{{ __('Navigasi halaman koleksi') }}"
                >
                    <div class="flex items-center gap-1.5">

                        {{-- PREVIOUS --}}
                        @if($collections->onFirstPage())
                            <span
                                class="w-9 h-9 rounded-full flex items-center justify-center text-on-surface-variant/30 cursor-not-allowed"
                                aria-hidden="true"
                            >
                                <span class="material-symbols-outlined text-[18px]">
                                    chevron_left
                                </span>
                            </span>
                        @else
                            <a
                                href="{{ $collections->previousPageUrl() }}"
                                rel="prev"
                                aria-label="{{ __('Halaman sebelumnya') }}"
                                class="w-9 h-9 rounded-full flex items-center justify-center text-primary transition-colors hover:bg-primary/[.07]"
                            >
                                <span
                                    class="material-symbols-outlined text-[18px]"
                                    aria-hidden="true"
                                >
                                    chevron_left
                                </span>
                            </a>
                        @endif

                        {{-- FIRST PAGE --}}
                        @if($startPage > 1)
                            <a
                                href="{{ $collections->url(1) }}"
                                class="w-9 h-9 rounded-full flex items-center justify-center text-[12px] font-bold text-on-surface-variant transition-colors hover:bg-primary/[.07] hover:text-primary"
                            >
                                1
                            </a>

                            @if($startPage > 2)
                                <span class="w-6 text-center text-on-surface-variant/50">
                                    …
                                </span>
                            @endif
                        @endif

                        {{-- CURRENT RANGE --}}
                        @for($page=$startPage;$page<=$endPage;$page++)
                            @if($page===$currentPage)
                                <span
                                    aria-current="page"
                                    class="w-9 h-9 rounded-full bg-primary text-on-primary flex items-center justify-center text-[12px] font-extrabold shadow-sm"
                                >
                                    {{ $page }}
                                </span>
                            @else
                                <a
                                    href="{{ $collections->url($page) }}"
                                    class="w-9 h-9 rounded-full flex items-center justify-center text-[12px] font-bold text-on-surface-variant transition-colors hover:bg-primary/[.07] hover:text-primary"
                                >
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor

                        {{-- LAST PAGE --}}
                        @if($endPage < $lastPage)
                            @if($endPage < $lastPage-1)
                                <span class="w-6 text-center text-on-surface-variant/50">
                                    …
                                </span>
                            @endif

                            <a
                                href="{{ $collections->url($lastPage) }}"
                                class="w-9 h-9 rounded-full flex items-center justify-center text-[12px] font-bold text-on-surface-variant transition-colors hover:bg-primary/[.07] hover:text-primary"
                            >
                                {{ $lastPage }}
                            </a>
                        @endif

                        {{-- NEXT --}}
                        @if($collections->hasMorePages())
                            <a
                                href="{{ $collections->nextPageUrl() }}"
                                rel="next"
                                aria-label="{{ __('Halaman berikutnya') }}"
                                class="w-9 h-9 rounded-full flex items-center justify-center text-primary transition-colors hover:bg-primary/[.07]"
                            >
                                <span
                                    class="material-symbols-outlined text-[18px]"
                                    aria-hidden="true"
                                >
                                    chevron_right
                                </span>
                            </a>
                        @else
                            <span
                                class="w-9 h-9 rounded-full flex items-center justify-center text-on-surface-variant/30 cursor-not-allowed"
                                aria-hidden="true"
                            >
                                <span class="material-symbols-outlined text-[18px]">
                                    chevron_right
                                </span>
                            </span>
                        @endif
                    </div>
                </nav>
            @endif
        </div>
    </section>
</x-layout>