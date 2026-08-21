<x-layout title="Beranda" :solid-nav="false">
    <x-hero :slides="$slides" :stats="$stats" />

    <x-quick-access :links="$quickLinks" />

    <x-profile-section :profile="$profile" />

    <x-information-sources-section :sources="$informationSources" />

    <x-agenda-section
        :featured-agenda="$featuredAgenda"
        :upcoming-agendas="$upcomingAgendas"
        :past-agendas="$pastAgendas"
    />

    <x-reservation-cta-section />

    <section class="pt-12 pb-6 md:py-16 max-w-[1280px] mx-auto px-4 md:px-6">
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-10">
            <div class="min-w-0 lg:w-[70%] space-y-10 md:space-y-12">

                {{-- BERITA --}}
                <div>
                    <div class="flex justify-between items-end gap-4 mb-5 md:mb-8">
                        <h2 class="font-serif text-[22px] md:text-headline-md font-bold leading-[1.15] text-primary">
                            {{ __('Berita & Artikel Terbaru') }}
                        </h2>

                        <a
                            href="{{ route('news.index') }}"
                            class="shrink-0 pb-0.5 text-[11px] md:text-sm text-primary font-bold hover:underline"
                        >
                            {{ __('Lihat Semua') }}
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        @foreach ($latestNews as $news)
                            <x-news-card :news="$news" />
                        @endforeach
                    </div>
                </div>

                {{-- KOLEKSI --}}
                <div>
                    <div class="flex justify-between items-end gap-4 mb-5 md:mb-8">
                        <h2 class="max-w-[190px] sm:max-w-none font-serif text-[22px] md:text-headline-md font-bold leading-[1.18] text-primary">
                            {{ __('Koleksi Buku Unggulan') }}
                        </h2>

                        <a
                            href="{{ route('collections.index') }}"
                            class="shrink-0 pb-0.5 text-[11px] md:text-sm leading-tight text-primary font-bold hover:underline"
                        >
                            {{ __('Jelajahi Katalog') }}
                        </a>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
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