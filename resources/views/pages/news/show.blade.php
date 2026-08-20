<x-layout :title="$news->title" :solid-nav="false" :description="$news->excerpt" :image="$news->image_path">
    @php
        $blocks=preg_split('/\R{2,}/',trim($news->body))?:[];
        $sections=[];
        $current=['title'=>null,'id'=>null,'blocks'=>[]];

        foreach($blocks as $block){
            $block=trim($block);
            if($block==='')continue;

            if(str_starts_with($block,'## ')){
                if($current['title']!==null||$current['blocks'])$sections[]=$current;
                $title=trim(substr($block,3));
                $current=['title'=>$title,'id'=>\Illuminate\Support\Str::slug($title),'blocks'=>[]];
                continue;
            }

            $current['blocks'][]=$block;
        }

        if($current['title']!==null||$current['blocks'])$sections[]=$current;

        $toc=array_values(array_filter($sections,fn($section)=>$section['title']));
        $readingMinutes=max(1,(int)ceil(str_word_count(strip_tags($news->body))/200));
    @endphp

    <article class="relative pt-28 md:pt-32 pb-20 bg-[#F8FAF6] min-h-screen">
        <img src="{{ asset('images/background-show-berita.png') }}" alt="" class="absolute inset-0 w-full h-full object-fill pointer-events-none opacity-100" aria-hidden="true">
        <div class="absolute inset-0 bg-white/5 pointer-events-none"></div>
        <div class="relative z-10 max-w-[1180px] mx-auto px-6">

            <nav class="flex items-center gap-2 text-sm text-on-surface-variant mb-8 overflow-hidden">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors shrink-0">Beranda</a>
                <span class="material-symbols-outlined text-base">chevron_right</span>
                <a href="{{ route('news.index') }}" class="hover:text-primary transition-colors shrink-0">Berita &amp; Artikel</a>
                <span class="material-symbols-outlined text-base">chevron_right</span>
                <span class="truncate">{{ $news->title }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-[220px_minmax(0,1fr)] gap-8 items-start">
                <header class="min-w-0 lg:col-start-2 lg:row-start-1">
                <span class="inline-flex px-3 py-1 rounded-full bg-primary text-on-primary text-xs font-bold uppercase tracking-wider">
                    {{ $news->category->name }}
                </span>

                <h1 class="text-3xl md:text-4xl lg:text-[42px] font-bold text-primary leading-[1.15] tracking-tight mt-4 max-w-4xl">
                    {{ $news->title }}
                </h1>

                <p class="mt-4 text-base md:text-lg text-on-surface-variant leading-relaxed max-w-3xl">
                    {{ $news->excerpt }}
                </p>

                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-5 text-sm text-on-surface-variant">
                    <span class="inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-[19px]">calendar_today</span>
                        {{ $news->published_at->translatedFormat('d F Y') }}
                    </span>
                    <span class="inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-[19px]">schedule</span>
                        {{ $readingMinutes }} menit baca
                    </span>
                    <span class="inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-[19px]">sell</span>
                        {{ $news->category->name }}
                    </span>
                </div>
                </header>

                <aside class="hidden lg:block lg:col-start-1 lg:row-start-1 lg:row-span-2 lg:pt-10 lg:sticky lg:top-40 self-start space-y-4">
                    @if($toc)
                        <div class="bg-white border border-outline-variant/30 rounded-2xl p-5 shadow-sm">
                            <h2 class="font-bold text-primary mb-4">Daftar Isi</h2>
                            <div class="space-y-3">
                                @foreach($toc as $section)
                                    <a href="#{{ $section['id'] }}" class="flex items-start gap-3 text-sm text-on-surface-variant hover:text-primary transition-colors">
                                        <span class="w-2 h-2 rounded-full bg-primary/40 mt-1.5 shrink-0"></span>
                                        <span>{{ $section['title'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="bg-white border border-outline-variant/30 rounded-2xl p-5 shadow-sm">
                        <h2 class="font-bold text-primary mb-4">Bagikan Berita</h2>

                        <div class="flex gap-2 mb-4">
                            <a href="https://wa.me/?text={{ urlencode($news->title.' '.url()->current()) }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center hover:bg-primary hover:text-on-primary transition-colors" aria-label="Bagikan ke WhatsApp">
                                <span class="material-symbols-outlined text-xl">chat</span>
                            </a>

                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center hover:bg-primary hover:text-on-primary transition-colors" aria-label="Bagikan ke Facebook">
                                <span class="font-bold">f</span>
                            </a>

                            <a href="https://www.instagram.com/pustaka.kementan/" target="_blank" rel="noopener" class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center hover:bg-primary hover:text-on-primary transition-colors" aria-label="Instagram BB Pustaka">
                                <span class="material-symbols-outlined text-xl">photo_camera</span>
                            </a>
                        </div>

                        <div x-data="{copied:false}">
                            <button type="button" @click="navigator.clipboard.writeText(window.location.href);copied=true;setTimeout(()=>copied=false,1500)" class="w-full h-10 rounded-lg bg-surface flex items-center justify-center gap-2 text-sm font-semibold text-on-surface hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px]">link</span>
                                <span x-text="copied?'Tautan tersalin':'Salin tautan'">Salin tautan</span>
                            </button>
                        </div>
                    </div>
                </aside>

                <div class="min-w-0 lg:col-start-2 lg:row-start-2">
                    @if($news->image_path)
                        <figure class="bg-white rounded-2xl border border-outline-variant/30 overflow-hidden shadow-sm mb-10">
                            <img
                                src="{{ $news->image_path }}"
                                alt="{{ $news->title }}"
                                class="w-full max-h-[560px] object-cover"
                                loading="eager"
                            >
                        </figure>
                    @endif

                    <div class="max-w-3xl">
                        @foreach($sections as $section)
                            <section @if($section['id']) id="{{ $section['id'] }}" @endif class="scroll-mt-32 mb-9">
                                @if($section['title'])
                                    <h2 class="flex items-center gap-3 text-xl md:text-2xl font-bold text-primary mb-4">
                                        <span class="w-1.5 h-7 rounded-full bg-primary shrink-0"></span>
                                        {{ $section['title'] }}
                                    </h2>
                                @endif

                                <div class="space-y-5 text-[16px] md:text-[17px] text-on-surface-variant leading-8">
                                    @foreach($section['blocks'] as $block)
                                        @if(str_starts_with($block,'> '))
                                            <blockquote class="relative rounded-2xl bg-primary/5 border-l-4 border-primary px-6 py-5 text-on-surface font-medium">
                                                <span class="material-symbols-outlined text-primary text-3xl mb-2">format_quote</span>
                                                <p>{{ trim(substr($block,2)) }}</p>
                                            </blockquote>
                                        @elseif(str_starts_with($block,'- '))
                                            @php
                                                $listItems=array_filter(array_map(fn($item)=>trim(ltrim($item,'- ')),preg_split('/\R/',$block)));
                                            @endphp
                                            <ul class="space-y-2">
                                                @foreach($listItems as $item)
                                                    <li class="flex gap-3">
                                                        <span class="w-2 h-2 rounded-full bg-primary mt-3 shrink-0"></span>
                                                        <span>{{ $item }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @elseif(str_starts_with($block,'Sumber asli: '))
                                            @php
                                                $sourceUrl=trim(substr($block,13));
                                            @endphp
                                            @if(filter_var($sourceUrl,FILTER_VALIDATE_URL))
                                                <div class="pt-2">
                                                    <a href="{{ $sourceUrl }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm font-bold text-primary hover:underline">
                                                        <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                                                        Lihat sumber artikel asli
                                                    </a>
                                                </div>
                                            @endif
                                        @else
                                            <p>{!! nl2br(e($block)) !!}</p>
                                        @endif
                                    @endforeach
                                </div>
                            </section>
                        @endforeach
                    </div>

                    <div class="border-t border-outline-variant/30 mt-12 pt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            @if($previousNews)
                                <a href="{{ route('news.show',$previousNews) }}" class="group block p-4 rounded-xl border border-outline-variant/30 bg-white hover:border-primary/30 hover:shadow-sm transition-all">
                                    <span class="text-xs text-on-surface-variant">Berita Sebelumnya</span>
                                    <div class="flex items-start gap-2 mt-1 font-bold text-on-surface group-hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-lg mt-0.5">arrow_back</span>
                                        <span class="line-clamp-2">{{ $previousNews->title }}</span>
                                    </div>
                                </a>
                            @endif
                        </div>

                        <div>
                            @if($nextNews)
                                <a href="{{ route('news.show',$nextNews) }}" class="group block p-4 rounded-xl border border-outline-variant/30 bg-white hover:border-primary/30 hover:shadow-sm transition-all text-right">
                                    <span class="text-xs text-on-surface-variant">Berita Selanjutnya</span>
                                    <div class="flex items-start justify-end gap-2 mt-1 font-bold text-on-surface group-hover:text-primary transition-colors">
                                        <span class="line-clamp-2">{{ $nextNews->title }}</span>
                                        <span class="material-symbols-outlined text-lg mt-0.5">arrow_forward</span>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</x-layout>