<x-layout
    :title="$news->title"
    :solid-nav="false"
    :description="$news->excerpt"
    :image="$news->image_path"
>
    @php
        $blocks=preg_split('/\R{2,}/',trim($news->body))?:[];
        $sections=[];
        $current=['title'=>null,'id'=>null,'blocks'=>[]];

        foreach($blocks as $block){
            $block=trim($block);

            if($block===''){
                continue;
            }

            if(str_starts_with($block,'## ')){
                if($current['title']!==null||$current['blocks']){
                    $sections[]=$current;
                }

                $title=trim(substr($block,3));

                $current=[
                    'title'=>$title,
                    'id'=>\Illuminate\Support\Str::slug($title),
                    'blocks'=>[],
                ];

                continue;
            }

            $current['blocks'][]=$block;
        }

        if($current['title']!==null||$current['blocks']){
            $sections[]=$current;
        }

        $toc=array_values(
            array_filter(
                $sections,
                fn($section)=>$section['title']
            )
        );

        $readingMinutes=max(
            1,
            (int) ceil(
                str_word_count(strip_tags($news->body))/200
            )
        );
    @endphp

    <article class="relative min-h-screen pt-[150px] md:pt-[158px] lg:pt-[154px] pb-12 md:pb-16 bg-[#F8FAF6]">

        {{-- BOTANICAL BACKGROUND
             Mobile: mengikuti seluruh tinggi artikel.
             Desktop: mempertahankan proporsi asli. --}}
        <div
            class="absolute inset-0 bg-top bg-no-repeat bg-[length:100%_100%] lg:bg-[length:100%_auto] pointer-events-none"
            style="background-image:url('{{ asset('images/background-show-berita-v2.png') }}')"
            aria-hidden="true"
        ></div>

        <div
            class="absolute inset-0 bg-gradient-to-b from-white/[.06] via-[#F8FAF6]/[.02] to-[#F8FAF6]/10 pointer-events-none"
            aria-hidden="true"
        ></div>

        <div class="relative z-10 max-w-[1180px] mx-auto px-4 md:px-6">

            {{-- BREADCRUMB --}}
            <nav
                class="mb-5 md:mb-7 text-[10px] md:text-xs text-on-surface-variant"
                aria-label="{{ __('Breadcrumb') }}"
            >
                <ol class="flex items-center gap-1.5 md:gap-2 min-w-0">
                    <li class="shrink-0">
                        <a
                            href="{{ route('home') }}"
                            class="hover:text-primary transition-colors"
                        >
                            {{ __('Beranda') }}
                        </a>
                    </li>

                    <li class="flex items-center shrink-0 text-outline">
                        <span
                            class="material-symbols-outlined text-[15px]"
                            aria-hidden="true"
                        >
                            chevron_right
                        </span>
                    </li>

                    <li class="shrink-0">
                        <a
                            href="{{ route('news.index') }}"
                            class="hover:text-primary transition-colors"
                        >
                            {{ __('Berita & Artikel') }}
                        </a>
                    </li>

                    <li class="hidden md:flex items-center shrink-0 text-outline">
                        <span
                            class="material-symbols-outlined text-[15px]"
                            aria-hidden="true"
                        >
                            chevron_right
                        </span>
                    </li>

                    <li class="hidden md:block min-w-0 truncate text-on-surface">
                        {{ $news->title }}
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-[210px_minmax(0,1fr)] xl:grid-cols-[220px_minmax(0,1fr)] gap-7 lg:gap-8 items-start">

                {{-- HEADER --}}
                <header class="min-w-0 lg:col-start-2 lg:row-start-1">
                    <span class="inline-flex items-center gap-2 h-7 px-3 rounded-full bg-primary text-on-primary text-[9px] md:text-[10px] font-extrabold uppercase tracking-[.08em] shadow-sm">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-secondary"
                            aria-hidden="true"
                        ></span>

                        {{ $news->category?->name ?? __('Berita') }}
                    </span>

                    <h1 class="mt-4 max-w-[900px] font-serif text-[27px] sm:text-[30px] md:text-[36px] lg:text-[40px] xl:text-[42px] font-bold leading-[1.14] tracking-[-.025em] text-primary-container">
                        {{ $news->title }}
                    </h1>

                    @if($news->excerpt)
                        <p class="mt-3.5 md:mt-4 max-w-[820px] text-[12px] md:text-[16px] leading-[1.7] text-on-surface-variant">
                            {{ $news->excerpt }}
                        </p>
                    @endif

                    {{-- META --}}
                    <div class="mt-4 md:mt-5 flex flex-wrap items-center gap-x-4 md:gap-x-5 gap-y-2 text-[9.5px] md:text-[12px] text-on-surface-variant">
                        <span class="inline-flex items-center gap-1.5">
                            <span
                                class="material-symbols-outlined text-[16px] md:text-[17px] text-primary/75"
                                aria-hidden="true"
                            >
                                calendar_today
                            </span>

                            <time datetime="{{ $news->published_at->toDateString() }}">
                                {{ $news->published_at->translatedFormat('d F Y') }}
                            </time>
                        </span>

                        <span class="inline-flex items-center gap-1.5">
                            <span
                                class="material-symbols-outlined text-[16px] md:text-[17px] text-primary/75"
                                aria-hidden="true"
                            >
                                schedule
                            </span>

                            {{ $readingMinutes }} {{ __('menit baca') }}
                        </span>

                        <span class="inline-flex items-center gap-1.5">
                            <span
                                class="material-symbols-outlined text-[16px] md:text-[17px] text-primary/75"
                                aria-hidden="true"
                            >
                                sell
                            </span>

                            {{ $news->category?->name ?? __('Berita') }}
                        </span>
                    </div>

                    {{-- MOBILE SHARE --}}
                    <div
                        class="lg:hidden mt-4 flex items-center gap-2"
                        x-data="{copied:false}"
                    >
                        <span class="mr-1 text-[9.5px] font-bold text-primary">
                            {{ __('Bagikan') }}
                        </span>

                        <a
                            href="https://wa.me/?text={{ urlencode($news->title.' '.url()->current()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="{{ __('Bagikan ke WhatsApp') }}"
                            class="w-8 h-8 rounded-full bg-primary/[.08] text-primary flex items-center justify-center transition-colors hover:bg-primary hover:text-on-primary"
                        >
                            <span
                                class="material-symbols-outlined text-[16px]"
                                aria-hidden="true"
                            >
                                chat
                            </span>
                        </a>

                        <a
                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="{{ __('Bagikan ke Facebook') }}"
                            class="w-8 h-8 rounded-full bg-primary/[.08] text-primary flex items-center justify-center transition-colors hover:bg-primary hover:text-on-primary"
                        >
                            <span
                                class="text-[12px] font-black"
                                aria-hidden="true"
                            >
                                f
                            </span>
                        </a>

                        <button
                            type="button"
                            @click="navigator.clipboard.writeText(window.location.href);copied=true;setTimeout(()=>copied=false,1500)"
                            :aria-label="copied ? 'Tautan tersalin' : 'Salin tautan'"
                            class="h-8 px-2.5 rounded-full bg-primary/[.08] text-primary flex items-center gap-1.5 text-[9px] font-bold transition-colors hover:bg-primary hover:text-on-primary"
                        >
                            <span
                                class="material-symbols-outlined text-[15px]"
                                aria-hidden="true"
                            >
                                link
                            </span>

                            <span x-text="copied?'Tersalin':'Salin'">
                                {{ __('Salin') }}
                            </span>
                        </button>
                    </div>

                    <div class="mt-4 md:mt-6 flex items-center gap-3">
                        <span class="w-12 h-[3px] rounded-full bg-secondary"></span>
                        <span class="h-px flex-1 bg-primary/10"></span>
                    </div>
                </header>

                {{-- DESKTOP SIDEBAR --}}
                <aside class="hidden lg:block lg:col-start-1 lg:row-start-1 lg:row-span-2 self-stretch">
                    <div class="sticky top-[168px] space-y-3">

                        {{-- TOC --}}
                        @if($toc)
                            <section class="rounded-[18px] border border-primary/10 bg-white/90 backdrop-blur-sm p-4 shadow-[0_7px_20px_rgba(22,61,44,.06)]">
                                <div class="flex items-center gap-2 mb-3.5">
                                    <span
                                        class="material-symbols-outlined text-[17px] text-primary"
                                        aria-hidden="true"
                                    >
                                        format_list_bulleted
                                    </span>

                                    <h2 class="text-[13px] font-bold text-primary">
                                        {{ __('Daftar Isi') }}
                                    </h2>
                                </div>

                                <nav aria-label="{{ __('Daftar isi artikel') }}">
                                    <div class="space-y-2.5">
                                        @foreach($toc as $section)
                                            <a
                                                href="#{{ $section['id'] }}"
                                                class="group flex items-start gap-2.5 text-[10.5px] leading-[1.5] text-on-surface-variant hover:text-primary transition-colors"
                                            >
                                                <span
                                                    class="w-1.5 h-1.5 mt-[5px] rounded-full bg-primary/35 group-hover:bg-primary shrink-0 transition-colors"
                                                    aria-hidden="true"
                                                ></span>

                                                <span>
                                                    {{ $section['title'] }}
                                                </span>
                                            </a>
                                        @endforeach
                                    </div>
                                </nav>
                            </section>
                        @endif

                        {{-- SHARE --}}
                        <section class="rounded-[18px] border border-primary/10 bg-white/90 backdrop-blur-sm p-4 shadow-[0_7px_20px_rgba(22,61,44,.06)]">
                            <div class="flex items-center gap-2 mb-3.5">
                                <span
                                    class="material-symbols-outlined text-[17px] text-primary"
                                    aria-hidden="true"
                                >
                                    share
                                </span>

                                <h2 class="text-[13px] font-bold text-primary">
                                    {{ __('Bagikan Berita') }}
                                </h2>
                            </div>

                            <div class="flex items-center gap-2 mb-3">
                                <a
                                    href="https://wa.me/?text={{ urlencode($news->title.' '.url()->current()) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="{{ __('Bagikan ke WhatsApp') }}"
                                    class="w-9 h-9 rounded-full bg-primary/[.08] text-primary flex items-center justify-center transition-colors hover:bg-primary hover:text-on-primary"
                                >
                                    <span
                                        class="material-symbols-outlined text-[18px]"
                                        aria-hidden="true"
                                    >
                                        chat
                                    </span>
                                </a>

                                <a
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="{{ __('Bagikan ke Facebook') }}"
                                    class="w-9 h-9 rounded-full bg-primary/[.08] text-primary flex items-center justify-center transition-colors hover:bg-primary hover:text-on-primary"
                                >
                                    <span
                                        class="text-[13px] font-extrabold"
                                        aria-hidden="true"
                                    >
                                        f
                                    </span>
                                </a>

                                <a
                                    href="https://www.instagram.com/pustaka.kementan/"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="{{ __('Instagram BB Pustaka') }}"
                                    class="w-9 h-9 rounded-full bg-primary/[.08] text-primary flex items-center justify-center transition-colors hover:bg-primary hover:text-on-primary"
                                >
                                    <span
                                        class="material-symbols-outlined text-[18px]"
                                        aria-hidden="true"
                                    >
                                        photo_camera
                                    </span>
                                </a>
                            </div>

                            <div x-data="{copied:false}">
                                <button
                                    type="button"
                                    @click="navigator.clipboard.writeText(window.location.href);copied=true;setTimeout(()=>copied=false,1500)"
                                    class="w-full h-9 rounded-[10px] bg-surface-container-low flex items-center justify-center gap-2 text-[10px] font-bold text-on-surface transition-colors hover:text-primary"
                                >
                                    <span
                                        class="material-symbols-outlined text-[16px]"
                                        aria-hidden="true"
                                    >
                                        link
                                    </span>

                                    <span x-text="copied?'Tautan tersalin':'Salin tautan'">
                                        {{ __('Salin tautan') }}
                                    </span>
                                </button>
                            </div>
                        </section>
                    </div>
                </aside>

                {{-- ARTICLE BODY --}}
                <div class="min-w-0 lg:col-start-2 lg:row-start-2">

                    {{-- FEATURED IMAGE --}}
                    @if($news->image_path)
                        <figure class="mt-1 mb-7 md:mb-9 overflow-hidden rounded-[18px] md:rounded-[20px] border border-primary/10 bg-white shadow-[0_10px_28px_rgba(22,61,44,.08)]">
                            <img
                                src="{{ $news->image_path }}"
                                alt="{{ $news->title }}"
                                class="w-full max-h-[500px] object-cover"
                                loading="eager"
                                width="1000"
                                height="620"
                            >
                        </figure>
                    @endif

                    {{-- ARTICLE CONTENT --}}
                    <div class="max-w-[800px]">
                        @foreach($sections as $section)
                            <section
                                @if($section['id'])
                                    id="{{ $section['id'] }}"
                                @endif
                                class="scroll-mt-[190px] mb-7 md:mb-9"
                            >
                                @if($section['title'])
                                    <h2 class="flex items-start gap-2.5 md:gap-3 mb-3.5 font-serif text-[20px] md:text-[24px] font-bold leading-[1.3] text-primary">
                                        <span
                                            class="w-1.5 h-6 md:h-7 mt-0.5 rounded-full bg-primary shrink-0"
                                            aria-hidden="true"
                                        ></span>

                                        <span>
                                            {{ $section['title'] }}
                                        </span>
                                    </h2>
                                @endif

                                <div class="space-y-4 text-[13.5px] md:text-[16px] leading-[1.8] md:leading-[1.85] text-on-surface-variant">
                                    @foreach($section['blocks'] as $block)

                                        {{-- BLOCKQUOTE --}}
                                        @if(str_starts_with($block,'> '))
                                            <blockquote class="relative rounded-[16px] md:rounded-[18px] border-l-4 border-primary bg-primary/[.05] px-4 md:px-6 py-4 md:py-5 text-on-surface font-medium">
                                                <span
                                                    class="material-symbols-outlined text-[25px] md:text-[26px] text-primary mb-1.5"
                                                    aria-hidden="true"
                                                >
                                                    format_quote
                                                </span>

                                                <p>
                                                    {{ trim(substr($block,2)) }}
                                                </p>
                                            </blockquote>

                                        {{-- LIST --}}
                                        @elseif(str_starts_with($block,'- '))
                                            @php
                                                $listItems=array_filter(
                                                    array_map(
                                                        fn($item)=>trim(ltrim($item,'- ')),
                                                        preg_split('/\R/',$block)
                                                    )
                                                );
                                            @endphp

                                            <ul class="space-y-2.5">
                                                @foreach($listItems as $item)
                                                    <li class="flex items-start gap-3">
                                                        <span
                                                            class="w-1.5 h-1.5 mt-[10px] md:mt-[11px] rounded-full bg-primary shrink-0"
                                                            aria-hidden="true"
                                                        ></span>

                                                        <span>
                                                            {{ $item }}
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        {{-- SOURCE --}}
                                        @elseif(str_starts_with($block,'Sumber asli: '))
                                            @php
                                                $sourceUrl=trim(substr($block,13));
                                            @endphp

                                            @if(filter_var($sourceUrl,FILTER_VALIDATE_URL))
                                                <div class="pt-1">
                                                    <a
                                                        href="{{ $sourceUrl }}"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        class="inline-flex items-center gap-2 text-[10.5px] md:text-[12px] font-bold text-primary hover:underline"
                                                    >
                                                        <span
                                                            class="material-symbols-outlined text-[17px]"
                                                            aria-hidden="true"
                                                        >
                                                            open_in_new
                                                        </span>

                                                        {{ __('Lihat sumber artikel asli') }}
                                                    </a>
                                                </div>
                                            @endif

                                        {{-- PARAGRAPH --}}
                                        @else
                                            <p>
                                                {!! nl2br(e($block)) !!}
                                            </p>
                                        @endif
                                    @endforeach
                                </div>
                            </section>
                        @endforeach
                    </div>

                    {{-- ARTICLE NAVIGATION --}}
                    @if($previousNews || $nextNews)
                        <nav
                            class="mt-9 md:mt-12 pt-6 border-t border-outline-variant/25 grid grid-cols-1 sm:grid-cols-2 gap-3"
                            aria-label="{{ __('Navigasi antar berita') }}"
                        >
                            <div>
                                @if($previousNews)
                                    <a
                                        href="{{ route('news.show',$previousNews) }}"
                                        class="group flex h-full min-h-[92px] md:min-h-[104px] flex-col justify-center rounded-[16px] md:rounded-[18px] border border-primary/10 bg-white/90 px-4 py-4 shadow-[0_5px_16px_rgba(22,61,44,.04)] transition-all hover:-translate-y-0.5 hover:border-primary/25 hover:shadow-[0_9px_22px_rgba(22,61,44,.08)]"
                                    >
                                        <span class="text-[8.5px] md:text-[9px] font-semibold text-on-surface-variant">
                                            {{ __('Berita Sebelumnya') }}
                                        </span>

                                        <div class="mt-1.5 flex items-start gap-2 text-[11px] md:text-[13px] font-bold leading-[1.45] text-on-surface transition-colors group-hover:text-primary">
                                            <span
                                                class="material-symbols-outlined text-[16px] md:text-[17px] mt-px shrink-0"
                                                aria-hidden="true"
                                            >
                                                arrow_back
                                            </span>

                                            <span class="line-clamp-2">
                                                {{ $previousNews->title }}
                                            </span>
                                        </div>
                                    </a>
                                @endif
                            </div>

                            <div>
                                @if($nextNews)
                                    <a
                                        href="{{ route('news.show',$nextNews) }}"
                                        class="group flex h-full min-h-[92px] md:min-h-[104px] flex-col justify-center rounded-[16px] md:rounded-[18px] border border-primary/10 bg-white/90 px-4 py-4 text-right shadow-[0_5px_16px_rgba(22,61,44,.04)] transition-all hover:-translate-y-0.5 hover:border-primary/25 hover:shadow-[0_9px_22px_rgba(22,61,44,.08)]"
                                    >
                                        <span class="text-[8.5px] md:text-[9px] font-semibold text-on-surface-variant">
                                            {{ __('Berita Selanjutnya') }}
                                        </span>

                                        <div class="mt-1.5 flex items-start justify-end gap-2 text-[11px] md:text-[13px] font-bold leading-[1.45] text-on-surface transition-colors group-hover:text-primary">
                                            <span class="line-clamp-2">
                                                {{ $nextNews->title }}
                                            </span>

                                            <span
                                                class="material-symbols-outlined text-[16px] md:text-[17px] mt-px shrink-0"
                                                aria-hidden="true"
                                            >
                                                arrow_forward
                                            </span>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </article>
</x-layout>