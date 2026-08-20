<x-layout title="Koleksi" :solid-nav="false">
    <section class="pb-20 bg-[#F3F5F1]">
        <div class="max-w-[1280px] mx-auto px-6">

            <!-- Header + Search + Category in one background -->
            <div class="relative left-1/2 w-screen -translate-x-1/2 overflow-hidden mb-10">
                <img
                    src="{{ asset('images/minimal_botanical_book_banner.png') }}"
                    alt=""
                    class="absolute inset-0 w-full h-full object-cover pointer-events-none"
                    loading="lazy"
                    aria-hidden="true"
                >
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#F3F5F1] pointer-events-none"></div>

                <div class="relative z-10 max-w-[1280px] mx-auto px-6 pt-32 pb-10 md:pt-36">
                    <!-- Header -->
                    <div class="mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">menu_book</span>
                            </div>
                            <div>
                                <h1 class="text-2xl md:text-headline-lg font-bold text-primary">
                                    {{ __('Koleksi Buku') }}
                                </h1>
                                <p class="text-on-surface-variant mt-2 max-w-xl">
                                    {{ __('Jelajahi berbagai koleksi buku berkualitas seputar pertanian, literasi, dan pembangunan berkelanjutan.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Search + Filter -->
                    <form method="GET" action="{{ route('collections.index') }}" class="mb-6 flex flex-col sm:flex-row gap-3">
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        <div class="relative flex-1">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant" aria-hidden="true">search</span>
                            <label for="collection-search" class="sr-only">{{ __('Cari judul atau penulis') }}</label>
                            <input
                                id="collection-search"
                                name="q"
                                type="search"
                                value="{{ request('q') }}"
                                placeholder="{{ __('Cari judul atau penulis buku...') }}"
                                class="w-full h-12 pl-11 pr-4 rounded-full border border-outline-variant bg-white/80 backdrop-blur-sm focus:ring-2 focus:ring-primary focus:border-primary"
                            >
                        </div>

                        <button type="submit" class="h-12 px-6 bg-primary text-on-primary font-bold rounded-full hover:bg-primary-container transition-all shrink-0">
                            {{ __('Cari') }}
                        </button>
                    </form>

                    <!-- Category pills -->
                    <div class="flex flex-wrap gap-2.5">
                        <a
                            href="{{ route('collections.index', array_filter(['q' => request('q')])) }}"
                            class="inline-flex items-center gap-2 px-4 h-10 rounded-full text-sm font-semibold transition-colors {{ !request('category') ? 'bg-primary text-on-primary' : 'bg-white/90 border border-outline-variant text-on-surface-variant hover:border-primary/30' }}"
                        >
                            <span class="material-symbols-outlined text-base" aria-hidden="true">apps</span>
                            {{ __('Semua Koleksi') }}
                        </a>

                        @foreach ($categories as $cat)
                            <a
                                href="{{ route('collections.index', array_filter(['q' => request('q'), 'category' => $cat->slug])) }}"
                                class="inline-flex items-center gap-2 px-4 h-10 rounded-full text-sm font-semibold transition-colors {{ request('category') === $cat->slug ? 'bg-primary text-on-primary' : 'bg-white/90 border border-outline-variant text-on-surface-variant hover:border-primary/30' }}"
                            >
                                <span class="material-symbols-outlined text-base" aria-hidden="true">eco</span>
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Grid koleksi -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @forelse ($collections as $collection)
                    <x-book-card :collection="$collection" />
                @empty
                    <p class="text-on-surface-variant col-span-full">{{ __('Koleksi tidak ditemukan.') }}</p>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $collections->links() }}
            </div>
        </div>
    </section>
</x-layout>