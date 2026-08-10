<x-layout title="Koleksi">
    <section class="pt-32 pb-20 max-w-[1280px] mx-auto px-6">
        <h1 class="text-2xl md:text-headline-lg font-bold text-primary mb-8">Koleksi Buku</h1>

        <form method="GET" action="{{ route('collections.index') }}" class="mb-8 flex gap-2 max-w-xl">
            <label for="collection-search" class="sr-only">Cari judul atau penulis</label>
            <input
                id="collection-search"
                name="q"
                type="search"
                value="{{ request('q') }}"
                placeholder="Cari judul atau penulis..."
                class="flex-1 p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
            >
            <button type="submit" class="px-6 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">
                Cari
            </button>
        </form>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse ($collections as $collection)
                <x-book-card :collection="$collection" />
            @empty
                <p class="text-on-surface-variant col-span-full">Koleksi tidak ditemukan.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $collections->links() }}
        </div>
    </section>
</x-layout>