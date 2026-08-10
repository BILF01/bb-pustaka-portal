<x-layout title="Berita">
    <section class="pt-32 pb-20 max-w-[1280px] mx-auto px-6">
        <h1 class="text-2xl md:text-headline-lg font-bold text-primary mb-8">Berita &amp; Artikel</h1>

        <form method="GET" action="{{ route('news.index') }}" class="mb-8 flex gap-2 max-w-xl">
            <label for="news-search" class="sr-only">Cari judul berita</label>
            <input id="news-search" name="q" type="search" value="{{ request('q') }}" placeholder="Cari judul berita..." class="flex-1 p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            <button type="submit" class="px-6 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">Cari</button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($newsList as $news)
                <x-news-card :news="$news" />
            @empty
                <p class="text-on-surface-variant col-span-full">Belum ada berita.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $newsList->links() }}
        </div>
    </section>
</x-layout>