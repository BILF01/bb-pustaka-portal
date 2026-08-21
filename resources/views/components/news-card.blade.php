@props(['news'])

<article class="group h-full overflow-hidden rounded-[22px] border border-primary/10 bg-surface-container-lowest shadow-[0_7px_22px_rgba(22,61,44,.055)] transition-all duration-300 hover:-translate-y-1 hover:border-primary/20 hover:shadow-[0_16px_34px_rgba(22,61,44,.11)]">
    <a href="{{ route('news.show', $news) }}" class="relative block aspect-[16/9] overflow-hidden bg-surface-container-low">
        @if($news->image_path)
            <img
                src="{{ $news->image_path }}"
                alt="{{ $news->title }}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.04]"
                loading="lazy"
                width="640"
                height="360"
            >
        @else
            <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-primary/[.08] via-surface-container-low to-secondary/[.10]">
                <span class="material-symbols-outlined text-[42px] text-primary/40" aria-hidden="true">newspaper</span>
            </div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-70"></div>

        @if($news->category)
            <span class="absolute left-4 bottom-4 inline-flex items-center px-3 h-7 rounded-full bg-primary text-on-primary text-[9px] font-extrabold uppercase tracking-[.08em] shadow">
                {{ $news->category->name }}
            </span>
        @endif
    </a>

    <div class="p-5">
        <div class="flex items-center gap-2 text-[10px] text-on-surface-variant mb-3">
            <span class="material-symbols-outlined text-[15px] text-primary/70" aria-hidden="true">calendar_today</span>
            <time datetime="{{ $news->published_at->toDateString() }}">
                {{ $news->published_at->translatedFormat('d M Y') }}
            </time>
        </div>

        <h3 class="min-h-[50px] text-[16px] md:text-[17px] font-bold leading-[1.45] text-on-surface transition-colors group-hover:text-primary">
            <a href="{{ route('news.show', $news) }}" class="line-clamp-2">
                {{ $news->title }}
            </a>
        </h3>

        @if($news->excerpt)
            <p class="mt-2 text-[12px] leading-[1.65] text-on-surface-variant line-clamp-2">
                {{ $news->excerpt }}
            </p>
        @endif

        <a href="{{ route('news.show', $news) }}" class="mt-4 inline-flex items-center gap-2 text-[11px] font-bold text-primary">
            <span>{{ __('Baca Selengkapnya') }}</span>
            <span class="material-symbols-outlined text-[16px] transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true">arrow_forward</span>
        </a>
    </div>
</article>