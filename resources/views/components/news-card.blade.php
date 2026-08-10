@props(['news'])

<article class="bg-white rounded-xl overflow-hidden border border-outline-variant/30 shadow-sm hover:shadow-md transition-all group">
    <a href="{{ route('news.show', $news) }}" class="block aspect-video overflow-hidden">
        <img
            src="{{ $news->image_path }}"
            alt="{{ $news->title }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            loading="lazy"
            width="400"
            height="225"
        >
    </a>
    <div class="p-5">
        <div class="flex gap-3 mb-2 items-center">
            <span class="text-xs font-bold text-secondary-container bg-primary/90 px-2 py-0.5 rounded uppercase tracking-wider">
                {{ $news->category->name }}
            </span>
            <time datetime="{{ $news->published_at->toDateString() }}" class="text-xs text-on-surface-variant">
                {{ $news->published_at->translatedFormat('d M Y') }}
            </time>
        </div>
        <h3 class="font-bold text-lg mb-2 text-on-surface group-hover:text-primary transition-colors">
            <a href="{{ route('news.show', $news) }}">{{ $news->title }}</a>
        </h3>
        <p class="text-sm text-on-surface-variant line-clamp-2">{{ $news->excerpt }}</p>
    </div>
</article>