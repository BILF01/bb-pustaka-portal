<x-layout title="Berita & Artikel" :solid-nav="false">
    <section class="pb-20 bg-[#F3F5F1]">
        <div class="max-w-[1280px] mx-auto px-6">

            <div class="relative left-1/2 w-screen -translate-x-1/2 overflow-hidden mb-10">
                <img
                    src="{{ asset('images/background-berita.jpeg') }}"
                    alt=""
                    class="absolute inset-0 w-full h-full object-cover object-center grayscale opacity-55 brightness-105 contrast-90 pointer-events-none"
                    loading="lazy"
                    aria-hidden="true"
                >
                <div class="absolute inset-0 bg-gradient-to-b from-white/10 via-white/5 to-[#F3F5F1] pointer-events-none"></div>

                <div class="relative z-10 max-w-[1280px] mx-auto px-6 pt-32 pb-10 md:pt-36">
                    <div class="mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">newspaper</span>
                            </div>
                            <div>
                                <h1 class="text-2xl md:text-headline-lg font-bold text-primary">
                                    Berita &amp; Artikel
                                </h1>
                                <p class="text-on-surface-variant mt-2 max-w-xl">
                                    Informasi terbaru, kegiatan, inovasi, dan konten literasi dari BB Pustaka untuk Anda.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('news.index') }}" class="mb-6 flex flex-col sm:flex-row gap-3">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        <div class="relative flex-1">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant" aria-hidden="true">search</span>
                            <label for="news-search" class="sr-only">Cari berita atau artikel</label>
                            <input
                                id="news-search"
                                name="q"
                                type="search"
                                value="{{ request('q') }}"
                                placeholder="Cari berita atau artikel..."
                                class="w-full h-12 pl-11 pr-4 rounded-full border border-outline-variant bg-white/80 backdrop-blur-sm focus:ring-2 focus:ring-primary focus:border-primary"
                            >
                        </div>

                        <button type="submit" class="h-12 px-6 bg-primary text-on-primary font-bold rounded-full hover:bg-primary-container transition-all shrink-0">
                            Cari
                        </button>
                    </form>

                    <div class="flex flex-wrap gap-2.5">
                        <a href="{{ route('news.index',array_filter(['q'=>request('q')])) }}" class="inline-flex items-center gap-2 px-4 h-10 rounded-full text-sm font-semibold transition-colors {{ !request('category')?'bg-primary text-on-primary':'bg-white/90 border border-outline-variant text-on-surface-variant hover:border-primary/30' }}">
                            <span class="material-symbols-outlined text-base" aria-hidden="true">apps</span>
                            Semua
                        </a>

                        @foreach($categories as $cat)
                            <a href="{{ route('news.index',array_filter(['q'=>request('q'),'category'=>$cat->slug])) }}" class="inline-flex items-center gap-2 px-4 h-10 rounded-full text-sm font-semibold transition-colors {{ request('category')===$cat->slug?'bg-primary text-on-primary':'bg-white/90 border border-outline-variant text-on-surface-variant hover:border-primary/30' }}">
                                <span class="material-symbols-outlined text-base" aria-hidden="true">newspaper</span>
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        @php
            $items=$newsList->getCollection();
            $featured=$items->first();
            $secondary=$items->slice(1,2);
            $remaining=$items->slice(3);
        @endphp

        @if($featured)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mb-5">
                <article class="lg:col-span-6 bg-white rounded-2xl overflow-hidden border border-outline-variant/30 shadow-sm hover:shadow-md transition-all group">
                    <a href="{{ route('news.show',$featured) }}" class="block overflow-hidden h-[250px] md:h-[300px]">
                        <img src="{{ $featured->image_path }}" alt="{{ $featured->title }}" class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500">
                    </a>
                    <div class="p-5">
                        <div class="flex flex-wrap items-center gap-3 mb-3">
                            <span class="inline-flex bg-primary text-on-primary text-[11px] leading-none font-bold uppercase tracking-wider px-2.5 py-1.5 rounded-md">Berita Terkini</span>
                            <time datetime="{{ $featured->published_at->toDateString() }}" class="flex items-center gap-1.5 text-xs text-on-surface-variant">
                                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                {{ $featured->published_at->translatedFormat('d M Y') }}
                            </time>
                        </div>
                        <h2 class="text-xl md:text-2xl font-bold leading-tight text-on-surface group-hover:text-primary transition-colors">
                            <a href="{{ route('news.show',$featured) }}">{{ $featured->title }}</a>
                        </h2>
                        <a href="{{ route('news.show',$featured) }}" class="inline-flex items-center gap-2 mt-4 text-sm font-bold text-primary hover:gap-3 transition-all">
                            Baca Selengkapnya
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                    </div>
                </article>

                @foreach($secondary as $news)
                    <article class="lg:col-span-3 bg-white rounded-2xl overflow-hidden border border-outline-variant/30 shadow-sm hover:shadow-md transition-all group">
                        <a href="{{ route('news.show',$news) }}" class="block h-[190px] md:h-[220px] overflow-hidden">
                            <img src="{{ $news->image_path }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </a>
                        <div class="p-4">
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <span class="bg-primary text-on-primary text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded">{{ $news->category->name }}</span>
                                <time datetime="{{ $news->published_at->toDateString() }}" class="flex items-center gap-1 text-xs text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[15px]">calendar_today</span>
                                    {{ $news->published_at->translatedFormat('d M Y') }}
                                </time>
                            </div>
                            <h3 class="font-bold text-lg leading-snug text-on-surface group-hover:text-primary transition-colors">
                                <a href="{{ route('news.show',$news) }}">{{ $news->title }}</a>
                            </h3>
                        </div>
                    </article>
                @endforeach
            </div>

            @if($remaining->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($remaining as $news)
                        <article class="bg-white rounded-2xl overflow-hidden border border-outline-variant/30 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all group">
                            <a href="{{ route('news.show',$news) }}" class="block h-[190px] overflow-hidden">
                                <img src="{{ $news->image_path }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </a>
                            <div class="p-4">
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded {{ str_starts_with($news->title,'Info')?'bg-secondary text-on-secondary':'bg-primary text-on-primary' }}">{{ str_starts_with($news->title,'Info Teknologi:')?'Info Teknologi':$news->category->name }}</span>
                                    <time datetime="{{ $news->published_at->toDateString() }}" class="flex items-center gap-1 text-xs text-on-surface-variant">
                                        <span class="material-symbols-outlined text-[15px]">calendar_today</span>
                                        {{ $news->published_at->translatedFormat('d M Y') }}
                                    </time>
                                </div>
                                <h3 class="font-bold text-base leading-snug text-on-surface group-hover:text-primary transition-colors">
                                    <a href="{{ route('news.show',$news) }}">{{ $news->title }}</a>
                                </h3>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        @else
            <div class="py-20 text-center border border-dashed border-outline-variant rounded-2xl bg-surface">
                <span class="material-symbols-outlined text-5xl text-on-surface-variant/50 mb-3">newspaper</span>
                <p class="font-semibold text-on-surface">Berita tidak ditemukan.</p>
                <p class="text-sm text-on-surface-variant mt-1">Coba gunakan kata kunci atau kategori lainnya.</p>
            </div>
        @endif

        @if($newsList->hasPages())
            <div class="mt-10">
                {{ $newsList->links() }}
            </div>
        @endif
    </section>
</x-layout>