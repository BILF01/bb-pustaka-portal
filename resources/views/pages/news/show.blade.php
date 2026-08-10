<x-layout :title="$news->title" :description="$news->excerpt" :image="$news->image_path">
    <article class="pt-32 pb-20 max-w-3xl mx-auto px-6">
        <span class="text-xs font-bold text-primary uppercase tracking-wider">{{ $news->category->name }}</span>
        <h1 class="text-2xl md:text-headline-lg font-bold text-primary mt-2 mb-4">{{ $news->title }}</h1>
        <time datetime="{{ $news->published_at->toDateString() }}" class="text-sm text-on-surface-variant">
            {{ $news->published_at->translatedFormat('d F Y') }}
        </time>

        <img
            src="{{ $news->image_path }}"
            alt="{{ $news->title }}"
            class="w-full aspect-video object-cover rounded-xl my-8"
            loading="lazy"
        >

        <div class="prose max-w-none text-on-surface-variant leading-relaxed">
            {!! nl2br(e($news->body)) !!}
        </div>
    </article>
</x-layout>