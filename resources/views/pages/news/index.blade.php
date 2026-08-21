<x-layout title="Berita & Artikel" :solid-nav="false">
    <section class="min-h-screen bg-[#F4F6F2] pb-10 md:pb-20">

        {{-- HERO --}}
        <div class="relative overflow-hidden">
            <img
                src="{{ asset('images/background-berita.jpeg') }}"
                alt=""
                class="absolute inset-0 w-full h-full object-cover object-center grayscale opacity-45 brightness-105 contrast-90 pointer-events-none"
                loading="lazy"
                aria-hidden="true"
            >

            <div
                class="absolute inset-0 bg-gradient-to-b from-white/10 via-[#F7F8F4]/30 to-[#F4F6F2] pointer-events-none"
                aria-hidden="true"
            ></div>

            <div class="relative z-10 max-w-[1280px] mx-auto px-4 md:px-6 pt-[168px] md:pt-[176px] lg:pt-[150px] pb-6 md:pb-10">

                {{-- BREADCRUMB --}}
                <nav
                    class="flex items-center gap-1.5 mb-4 md:mb-5 text-[10px] md:text-[11px] text-on-surface-variant"
                    aria-label="{{ __('Breadcrumb') }}"
                >
                    <a href="{{ route('home') }}" class="hover:text-primary transition-colors">
                        {{ __('Beranda') }}
                    </a>

                    <span
                        class="material-symbols-outlined text-[14px] text-on-surface-variant/50"
                        aria-hidden="true"
                    >
                        chevron_right
                    </span>

                    <span class="font-semibold text-primary">
                        {{ __('Berita & Artikel') }}
                    </span>
                </nav>

                {{-- TITLE --}}
                <div class="max-w-[760px]">
                    <p class="flex items-center gap-2 text-[9.5px] md:text-[11px] font-extrabold uppercase tracking-[.12em] text-primary/70">
                        <span
                            class="material-symbols-outlined text-[16px] md:text-[17px]"
                            aria-hidden="true"
                        >
                            newspaper
                        </span>

                        {{ __('Informasi BB Pustaka') }}
                    </p>

                    <h1 class="mt-2 font-serif text-[28px] md:text-[38px] lg:text-[42px] font-bold leading-[1.08] tracking-[-.02em] text-primary-container">
                        {{ __('Berita & Artikel') }}
                    </h1>

                    <p class="mt-3 max-w-[680px] text-[11.5px] md:text-[14px] leading-[1.65] md:leading-[1.7] text-on-surface-variant">
                        {{ __('Ikuti informasi terbaru mengenai kegiatan, inovasi, layanan, dan literasi pertanian dari BB Pustaka.') }}
                    </p>
                </div>

                {{-- SEARCH --}}
                <form
                    method="GET"
                    action="{{ route('news.index') }}"
                    class="mt-5 md:mt-7 max-w-[940px]"
                >
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    <div class="flex items-center gap-1.5 md:gap-2 rounded-[16px] md:rounded-[18px] border border-primary/10 bg-white/90 backdrop-blur-md p-1.5 shadow-[0_10px_30px_rgba(31,73,44,.08)]">
                        <div class="relative min-w-0 flex-1">
                            <span
                                class="material-symbols-outlined absolute left-3.5 md:left-4 top-1/2 -translate-y-1/2 text-[18px] md:text-[20px] text-primary/55"
                                aria-hidden="true"
                            >
                                search
                            </span>

                            <label for="news-search" class="sr-only">
                                {{ __('Cari berita atau artikel') }}
                            </label>

                            <input
                                id="news-search"
                                name="q"
                                type="search"
                                value="{{ request('q') }}"
                                placeholder="{{ __('Cari berita atau artikel...') }}"
                                class="w-full h-11 md:h-12 pl-10 md:pl-12 pr-2 md:pr-4 bg-transparent border-0 rounded-[13px] md:rounded-[14px] text-[11.5px] md:text-[13px] text-on-surface placeholder:text-on-surface-variant/55 focus:ring-0"
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

                {{-- CATEGORY --}}
                <div class="mt-5 md:mt-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span
                            class="material-symbols-outlined text-[16px] md:text-[17px] text-primary"
                            aria-hidden="true"
                        >
                            filter_alt
                        </span>

                        <span class="text-[10px] md:text-[11px] font-bold text-primary-container">
                            {{ __('Kategori Berita') }}
                        </span>
                    </div>

                    <div class="relative">
                        <div class="relative z-10 -mx-4 px-4 pr-7 flex gap-2 overflow-x-auto pb-1 no-scrollbar md:mx-0 md:px-0 md:pr-0 md:flex-wrap md:overflow-visible md:pb-0">
                            <a
                                href="{{ route('news.index', array_filter([
                                    'q' => request('q'),
                                ])) }}"
                                class="shrink-0 inline-flex items-center gap-1.5 h-9 px-3.5 rounded-full border text-[9.5px] md:text-[10.5px] font-bold transition-all
                                    {{ !request('category')
                                        ? 'bg-primary text-on-primary border-primary shadow-sm'
                                        : 'bg-white/80 text-on-surface-variant border-outline-variant/40 hover:text-primary hover:border-primary/30 hover:bg-white'
                                    }}"
                            >
                                <span class="material-symbols-outlined text-[15px]" aria-hidden="true">apps</span>
                                {{ __('Semua') }}
                            </a>

                            @foreach($categories as $cat)
                                <a
                                    href="{{ route('news.index', array_filter([
                                        'q' => request('q'),
                                        'category' => $cat->slug,
                                    ])) }}"
                                    class="shrink-0 inline-flex items-center gap-1.5 h-9 px-3.5 rounded-full border text-[9.5px] md:text-[10.5px] font-bold transition-all
                                        {{ request('category') === $cat->slug
                                            ? 'bg-primary text-on-primary border-primary shadow-sm'
                                            : 'bg-white/80 text-on-surface-variant border-outline-variant/40 hover:text-primary hover:border-primary/30 hover:bg-white'
                                        }}"
                                >
                                    <span class="material-symbols-outlined text-[14px]" aria-hidden="true">newspaper</span>
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>

                        <div
                            class="md:hidden pointer-events-none absolute right-0 top-0 bottom-1 z-0 w-6 bg-gradient-to-l from-[#F4F6F2] via-[#F4F6F2]/78 to-transparent"
                            aria-hidden="true"
                        ></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="max-w-[1280px] mx-auto px-4 md:px-6">
            @php
                $items=$newsList->getCollection();
                $featured=$items->first();
                $secondary=$items->slice(1,2);
                $remaining=$items->slice(3);
            @endphp

            {{-- CONTENT HEADER --}}
            <div class="flex items-end justify-between gap-4 mb-5 pb-4 border-b border-outline-variant/25">
                <div>
                    <h2 class="font-serif text-[24px] md:text-[28px] font-bold text-primary-container">
                        {{ request('q') || request('category')
                            ? __('Hasil Berita')
                            : __('Berita Terbaru')
                        }}
                    </h2>

                    <p class="mt-1 text-[10px] md:text-[10.5px] text-on-surface-variant">
                        @if($newsList->total())
                            {{ $newsList->total() }} {{ __('berita dan artikel tersedia') }}
                        @else
                            {{ __('Tidak ada berita yang ditemukan') }}
                        @endif
                    </p>
                </div>

                @if(request('q') || request('category'))
                    <a
                        href="{{ route('news.index') }}"
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

            @if($featured)

                {{-- EDITORIAL LEAD --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:items-stretch">

                    {{-- MAIN NEWS --}}
                    <article class="group lg:col-span-7 overflow-hidden rounded-[20px] md:rounded-[22px] border border-primary/10 bg-surface-container-lowest shadow-[0_8px_26px_rgba(22,61,44,.065)] transition-all duration-300 hover:border-primary/20 hover:shadow-[0_14px_32px_rgba(22,61,44,.10)]">
                        <a
                            href="{{ route('news.show',$featured) }}"
                            class="relative block h-[185px] md:h-[225px] xl:h-[235px] overflow-hidden bg-surface-container-low"
                        >
                            @if($featured->image_path)
                                <img
                                    src="{{ $featured->image_path }}"
                                    alt="{{ $featured->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.025]"
                                    loading="lazy"
                                    width="900"
                                    height="520"
                                >
                            @else
                                <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-primary/[.08] via-surface-container-low to-secondary/[.10]">
                                    <span
                                        class="material-symbols-outlined text-[44px] md:text-[48px] text-primary/35"
                                        aria-hidden="true"
                                    >
                                        newspaper
                                    </span>
                                </div>
                            @endif

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/48 via-black/5 to-transparent"
                                aria-hidden="true"
                            ></div>

                            @if($featured->category)
                                <span class="absolute left-4 bottom-4 inline-flex items-center h-6 px-2.5 rounded-full bg-primary text-on-primary text-[8px] md:text-[8.5px] font-extrabold uppercase tracking-[.08em] shadow">
                                    {{ $featured->category->name }}
                                </span>
                            @endif
                        </a>

                        <div class="p-4 md:px-5 md:py-4">
                            <div class="flex items-center gap-2 text-[9px] md:text-[9.5px] text-on-surface-variant">
                                <span
                                    class="material-symbols-outlined text-[14px] text-primary/70"
                                    aria-hidden="true"
                                >
                                    calendar_today
                                </span>

                                <time datetime="{{ $featured->published_at->toDateString() }}">
                                    {{ $featured->published_at->translatedFormat('d M Y') }}
                                </time>
                            </div>

                            <h3 class="mt-2 font-serif text-[18px] md:text-[20px] xl:text-[22px] font-bold leading-[1.3] tracking-[-.015em] text-on-surface transition-colors group-hover:text-primary line-clamp-2">
                                <a href="{{ route('news.show',$featured) }}">
                                    {{ $featured->title }}
                                </a>
                            </h3>

                            @if($featured->excerpt)
                                <p class="mt-2 text-[10.5px] leading-[1.6] text-on-surface-variant line-clamp-2 md:line-clamp-1">
                                    {{ $featured->excerpt }}
                                </p>
                            @endif

                            <a
                                href="{{ route('news.show',$featured) }}"
                                class="mt-2.5 inline-flex items-center gap-2 text-[10px] font-extrabold text-primary"
                            >
                                {{ __('Baca Selengkapnya') }}

                                <span
                                    class="material-symbols-outlined text-[15px] transition-transform duration-300 group-hover:translate-x-1"
                                    aria-hidden="true"
                                >
                                    arrow_forward
                                </span>
                            </a>
                        </div>
                    </article>

                    {{-- SECONDARY NEWS --}}
                    <div class="lg:col-span-5 grid grid-cols-1 lg:grid-rows-2 gap-3 h-full">
                        @foreach($secondary as $news)
                            <article class="group grid grid-cols-[116px_minmax(0,1fr)] sm:grid-cols-[145px_minmax(0,1fr)] xl:grid-cols-[160px_minmax(0,1fr)] min-h-[122px] sm:min-h-[145px] lg:h-full overflow-hidden rounded-[18px] border border-primary/10 bg-surface-container-lowest shadow-[0_6px_20px_rgba(22,61,44,.05)] transition-all duration-300 hover:border-primary/20 hover:shadow-[0_10px_26px_rgba(22,61,44,.085)]">

                                {{-- IMAGE --}}
                                <a
                                    href="{{ route('news.show',$news) }}"
                                    class="relative block overflow-hidden bg-surface-container-low"
                                >
                                    @if($news->image_path)
                                        <img
                                            src="{{ $news->image_path }}"
                                            alt="{{ $news->title }}"
                                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.04]"
                                            loading="lazy"
                                            width="360"
                                            height="280"
                                        >
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-primary/[.08] via-surface-container-low to-secondary/[.10]">
                                            <span
                                                class="material-symbols-outlined text-[27px] md:text-[29px] text-primary/35"
                                                aria-hidden="true"
                                            >
                                                newspaper
                                            </span>
                                        </div>
                                    @endif
                                </a>

                                {{-- CONTENT --}}
                                <div class="min-w-0 p-3 flex flex-col">
                                    @if($news->category)
                                        <span class="self-start inline-flex items-center h-5 px-2 rounded-full bg-primary/[.07] text-primary text-[7.5px] font-extrabold uppercase tracking-[.06em]">
                                            {{ $news->category->name }}
                                        </span>
                                    @endif

                                    <h3 class="mt-2 text-[12px] sm:text-[13px] xl:text-[13.5px] font-bold leading-[1.35] text-on-surface transition-colors group-hover:text-primary line-clamp-2">
                                        <a href="{{ route('news.show',$news) }}">
                                            {{ $news->title }}
                                        </a>
                                    </h3>

                                    <div class="mt-auto pt-2 flex items-center justify-between gap-2">
                                        <div class="min-w-0 flex items-center gap-1 text-[8px] sm:text-[8.5px] text-on-surface-variant">
                                            <span
                                                class="material-symbols-outlined text-[12px] text-primary/65 shrink-0"
                                                aria-hidden="true"
                                            >
                                                calendar_today
                                            </span>

                                            <time
                                                datetime="{{ $news->published_at->toDateString() }}"
                                                class="truncate"
                                            >
                                                {{ $news->published_at->translatedFormat('d M Y') }}
                                            </time>
                                        </div>

                                        <a
                                            href="{{ route('news.show',$news) }}"
                                            aria-label="{{ __('Baca selengkapnya:') }} {{ $news->title }}"
                                            class="shrink-0 inline-flex items-center gap-0.5 text-[8px] sm:text-[8.5px] font-extrabold text-primary"
                                        >
                                            <span class="hidden sm:inline">
                                                {{ __('Baca') }}
                                            </span>

                                            <span
                                                class="material-symbols-outlined text-[12px] transition-transform duration-300 group-hover:translate-x-0.5"
                                                aria-hidden="true"
                                            >
                                                arrow_forward
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                {{-- REMAINING NEWS --}}
                @if($remaining->isNotEmpty())
                    <section class="mt-7 md:mt-8">
                        <div class="flex items-center gap-3 mb-5 md:mb-6">
                            <h2 class="font-serif text-[21px] md:text-[25px] font-bold text-primary-container shrink-0">
                                {{ __('Berita Lainnya') }}
                            </h2>

                            <span class="h-px flex-1 bg-outline-variant/30"></span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6">
                            @foreach($remaining as $news)
                                <x-news-card :news="$news" />
                            @endforeach
                        </div>
                    </section>
                @endif

            @else

                {{-- EMPTY STATE --}}
                <div class="rounded-[20px] md:rounded-[22px] border border-primary/10 bg-surface-container-lowest px-5 md:px-6 py-10 md:py-14 text-center shadow-[0_8px_24px_rgba(22,61,44,.05)]">
                    <span class="w-12 h-12 mx-auto rounded-[14px] bg-primary/[.08] text-primary flex items-center justify-center">
                        <span
                            class="material-symbols-outlined text-[24px]"
                            aria-hidden="true"
                        >
                            newspaper
                        </span>
                    </span>

                    <h2 class="mt-4 font-serif text-lg md:text-xl font-bold text-primary-container">
                        {{ __('Berita tidak ditemukan') }}
                    </h2>

                    <p class="mt-2 max-w-[480px] mx-auto text-[11px] md:text-[12px] leading-[1.65] text-on-surface-variant">
                        {{ __('Coba gunakan kata kunci lain atau hapus filter kategori untuk melihat berita yang tersedia.') }}
                    </p>

                    <a
                        href="{{ route('news.index') }}"
                        class="mt-5 inline-flex items-center gap-2 h-10 px-4 rounded-full bg-primary text-on-primary text-[11px] font-bold"
                    >
                        <span
                            class="material-symbols-outlined text-[16px]"
                            aria-hidden="true"
                        >
                            restart_alt
                        </span>

                        {{ __('Lihat Semua Berita') }}
                    </a>
                </div>
            @endif

            {{-- PAGINATION --}}
            @if($newsList->hasPages())
                @php
                    $currentPage=$newsList->currentPage();
                    $lastPage=$newsList->lastPage();
                    $startPage=max(1,$currentPage-1);
                    $endPage=min($lastPage,$currentPage+1);
                @endphp

                <nav
                    class="mt-9 md:mt-10 pt-5 border-t border-outline-variant/20 flex items-center justify-center md:justify-end"
                    aria-label="{{ __('Navigasi halaman berita') }}"
                >
                    <div class="flex items-center gap-1.5">

                        {{-- PREVIOUS --}}
                        @if($newsList->onFirstPage())
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
                                href="{{ $newsList->previousPageUrl() }}"
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
                                href="{{ $newsList->url(1) }}"
                                class="w-9 h-9 rounded-full flex items-center justify-center text-[12px] font-bold text-on-surface-variant transition-colors hover:bg-primary/[.07] hover:text-primary"
                            >
                                1
                            </a>

                            @if($startPage > 2)
                                <span class="w-6 text-center text-on-surface-variant/50">…</span>
                            @endif
                        @endif

                        {{-- PAGE RANGE --}}
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
                                    href="{{ $newsList->url($page) }}"
                                    class="w-9 h-9 rounded-full flex items-center justify-center text-[12px] font-bold text-on-surface-variant transition-colors hover:bg-primary/[.07] hover:text-primary"
                                >
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor

                        {{-- LAST PAGE --}}
                        @if($endPage < $lastPage)
                            @if($endPage < $lastPage-1)
                                <span class="w-6 text-center text-on-surface-variant/50">…</span>
                            @endif

                            <a
                                href="{{ $newsList->url($lastPage) }}"
                                class="w-9 h-9 rounded-full flex items-center justify-center text-[12px] font-bold text-on-surface-variant transition-colors hover:bg-primary/[.07] hover:text-primary"
                            >
                                {{ $lastPage }}
                            </a>
                        @endif

                        {{-- NEXT --}}
                        @if($newsList->hasMorePages())
                            <a
                                href="{{ $newsList->nextPageUrl() }}"
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