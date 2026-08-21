@props(['collection'])

<article class="group flex h-full flex-col">
    <a
        href="{{ route('collections.show', $collection) }}"
        class="relative block aspect-[3/4] overflow-hidden rounded-[18px] border border-primary/10 bg-surface-container-low shadow-[0_7px_20px_rgba(22,61,44,.08)] transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-[0_15px_30px_rgba(22,61,44,.14)]"
    >
        @if($collection->cover_path)
            <img
                src="{{ $collection->cover_path }}"
                alt="Sampul buku {{ $collection->title }}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.035]"
                loading="lazy"
                width="300"
                height="400"
            >
        @else
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-5 bg-gradient-to-br from-primary/10 via-surface-container-low to-secondary/10">
                <span class="w-14 h-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-[30px]" aria-hidden="true">menu_book</span>
                </span>

                <span class="text-primary font-bold text-[12px] leading-relaxed line-clamp-4">
                    {{ $collection->title }}
                </span>

                @if($collection->published_year)
                    <span class="mt-3 text-[10px] text-on-surface-variant">
                        {{ $collection->publisher }}
                        @if($collection->publisher) &middot; @endif
                        {{ $collection->published_year }}
                    </span>
                @endif
            </div>
        @endif

        <div class="absolute inset-0 flex items-end justify-center p-3 bg-gradient-to-t from-black/55 via-black/5 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
            <span class="inline-flex items-center gap-1.5 px-3.5 h-8 rounded-full bg-white text-primary text-[10px] font-extrabold shadow">
                {{ __('Lihat Detail') }}
                <span class="material-symbols-outlined text-[14px]" aria-hidden="true">arrow_forward</span>
            </span>
        </div>
    </a>

    <div class="pt-3 px-1 text-center">
        <h4 class="min-h-[40px] text-[12px] md:text-[13px] font-bold leading-[1.45] text-on-surface line-clamp-2 transition-colors group-hover:text-primary">
            <a href="{{ route('collections.show', $collection) }}">
                {{ $collection->title }}
            </a>
        </h4>

        @if($collection->author)
            <p class="mt-1 text-[10px] text-on-surface-variant line-clamp-1">
                {{ $collection->author }}
            </p>
        @endif

        @if($collection->category)
            <span class="mt-2 inline-flex items-center px-2.5 py-1 rounded-full bg-primary/[.07] text-primary text-[9px] font-bold">
                {{ $collection->category->name }}
            </span>
        @endif
    </div>
</article>