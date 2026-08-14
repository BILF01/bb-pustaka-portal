<x-layout title="Beranda" :solid-nav="false">
    <x-hero :slides="$slides" :stats="$stats" />

    <x-quick-access :links="$quickLinks" />

    <x-profile-section :profile="$profile" />

    <x-services-grid :services="$services" />

    <x-agenda-section :featured-agenda="$featuredAgenda" :other-agendas="$otherAgendas" />

    <section class="py-16 max-w-[1280px] mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-10">
            <div class="lg:w-[70%] space-y-12">
                <div>
                    <div class="flex justify-between items-end mb-8">
                        <h2 class="text-xl md:text-headline-md font-bold text-primary">{{ __('Berita & Artikel Terbaru') }}</h2>
                        <a href="{{ route('news.index') }}" class="text-primary font-bold hover:underline">{{ __('Lihat Semua') }}</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($latestNews as $news)
                            <x-news-card :news="$news" />
                        @endforeach
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-end mb-8">
                        <h2 class="text-xl md:text-headline-md font-bold text-primary">{{ __('Koleksi Buku Unggulan') }}</h2>
                        <a href="{{ route('collections.index') }}" class="text-primary font-bold hover:underline">{{ __('Jelajahi Katalog') }}</a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach ($featuredCollections as $collection)
                            <x-book-card :collection="$collection" />
                        @endforeach
                    </div>
                </div>
            </div>

            <x-home-sidebar :faqs="$faqs" />
        </div>
    </section>

    <x-visit-section />
</x-layout>