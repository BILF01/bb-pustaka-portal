@props(['collection'])

<div class="flex flex-col gap-2">
    <a
        href="{{ route('collections.show', $collection) }}"
        class="aspect-[3/4] bg-surface-container-low rounded-xl shadow-md overflow-hidden relative group block"
    >
        @if ($collection->cover_path)
            <img
                src="{{ $collection->cover_path }}"
                alt="Sampul buku {{ $collection->title }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                loading="lazy"
                width="300"
                height="400"
            >
        @else
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 bg-gradient-to-br from-primary/10 via-surface-container-low to-secondary/10">
                <span
                    class="material-symbols-outlined text-primary text-5xl mb-4"
                    aria-hidden="true"
                >
                    menu_book
                </span>

                <span class="text-primary font-bold text-sm leading-snug line-clamp-4">
                    {{ $collection->title }}
                </span>

                @if ($collection->published_year)
                    <span class="text-xs text-on-surface-variant mt-3">
                        {{ $collection->publisher }}
                        &middot;
                        {{ $collection->published_year }}
                    </span>
                @endif
            </div>
        @endif

        <button
            type="button"
            class="absolute top-2.5 right-2.5 z-10 w-9 h-9 rounded-full bg-white/90 backdrop-blur-sm shadow-sm flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors"
            aria-label="{{ __('Simpan buku') }}"
            tabindex="-1"
        >
            <span class="material-symbols-outlined text-lg" aria-hidden="true">bookmark_border</span>
        </button>

        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center p-4">
            <span class="bg-white text-primary px-4 py-1.5 rounded-lg font-bold text-xs">
                {{ __('Lihat Detail') }}
            </span>
        </div>
    </a>

    <h4 class="font-bold text-sm text-center line-clamp-2">
        {{ $collection->title }}
    </h4>

    @if ($collection->author)
        <p class="text-xs text-on-surface-variant text-center line-clamp-1">
            {{ $collection->author }}
        </p>
    @endif

    @if ($collection->category)
        <span class="inline-flex items-center self-center px-2.5 py-1 rounded-full bg-primary/10 text-primary text-[11px] font-semibold">
            {{ $collection->category->name }}
        </span>
    @endif
</div>