<x-layout :title="$collection->title">
    <article class="pt-32 pb-20 max-w-[1280px] mx-auto px-6">
        <div class="flex flex-col md:flex-row gap-10">
            <div class="w-full md:w-1/3">
                <img
                    src="{{ $collection->cover_path }}"
                    alt="Sampul buku {{ $collection->title }}"
                    class="w-full aspect-[3/4] object-cover rounded-xl shadow-lg"
                    loading="lazy"
                >
            </div>
            <div class="w-full md:w-2/3">
                <span class="text-xs font-bold text-primary uppercase tracking-wider">{{ $collection->category->name }}</span>
                <h1 class="text-2xl md:text-headline-lg font-bold text-primary mt-2 mb-4">{{ $collection->title }}</h1>

                <dl class="grid grid-cols-2 gap-4 mb-6 text-sm">
                    <div>
                        <dt class="text-on-surface-variant">Penulis</dt>
                        <dd class="font-semibold">{{ $collection->author ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-on-surface-variant">Penerbit</dt>
                        <dd class="font-semibold">{{ $collection->publisher ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-on-surface-variant">Tahun Terbit</dt>
                        <dd class="font-semibold">{{ $collection->published_year ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-on-surface-variant">Tebal Buku</dt>
                        <dd class="font-semibold">{{ $collection->page_count ?? '-' }}</dd>
                    </div>
                    @if ($collection->access_link)
                        <div class="col-span-2">
                            <dt class="text-on-surface-variant">Tautan Akses</dt>
                            <dd class="font-semibold"><a href="{{ $collection->access_link }}" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline">{{ $collection->access_link }}</a></dd>
                        </div>
                    @endif
                </dl>

                <h2 class="font-bold text-primary mb-2">Sinopsis</h2>
                <p class="text-on-surface-variant leading-relaxed">{{ $collection->synopsis }}</p>
            </div>
        </div>
    </article>
</x-layout>