@props(['collection'])

<div class="flex flex-col gap-2">
    <a href="{{ route('collections.show', $collection) }}" class="aspect-[3/4] bg-surface-container-low rounded-lg shadow-md overflow-hidden relative group block">
        <img
            src="{{ $collection->cover_path }}"
            alt="Sampul buku {{ $collection->title }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform"
            loading="lazy"
            width="300"
            height="400"
        >
        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center p-4">
            <span class="bg-white text-primary px-4 py-1 rounded-lg font-bold text-xs">Lihat Detail</span>
        </div>
    </a>
    <h4 class="font-bold text-sm text-center line-clamp-2">{{ $collection->title }}</h4>
</div>