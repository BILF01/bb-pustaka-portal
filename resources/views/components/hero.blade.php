@props(['slides', 'stats'])

<section class="relative w-full h-[600px] md:h-[800px] overflow-hidden" aria-label="{{ __('Sorotan utama') }}">
    <div x-data="{ current: 0, total: {{ count($slides) }} }" x-init="setInterval(() => current = (current + 1) % total, 6000)" class="absolute inset-0">
        @foreach ($slides as $index => $slide)
            <div
                x-show="current === {{ $index }}"
                x-transition:enter="transition ease-in-out duration-1000"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('{{ $slide['image'] }}')"
                aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
            >
                <div class="absolute inset-0 bg-black/60"></div>
            </div>
        @endforeach

        <div class="absolute bottom-16 left-1/2 -translate-x-1/2 flex items-center gap-2 z-20" role="tablist" aria-label="{{ __('Navigasi slide') }}">
            @foreach ($slides as $index => $slide)
                <button
                    type="button"
                    role="tab"
                    @click="current = {{ $index }}"
                    :aria-selected="current === {{ $index }} ? 'true' : 'false'"
                    :class="current === {{ $index }} ? 'w-8 bg-white' : 'w-3 bg-white/40'"
                    class="h-3 rounded-full transition-all duration-300"
                    aria-label="{{ __('Tampilkan slide') }} {{ $index + 1 }}"
                ></button>
            @endforeach
        </div>
    </div>

    <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-6 text-white max-w-[1280px] mx-auto">
        <h1 class="text-headline-lg md:text-headline-xl font-bold mb-4 drop-shadow-lg max-w-4xl">
            {{ __('Balai Besar Perpustakaan dan Literasi Pertanian') }}
        </h1>
        <p class="text-base md:text-body-lg mb-10 max-w-2xl text-white/90">
            {{ __('Pusat dokumentasi dan penyebaran informasi ilmu pengetahuan pertanian untuk mendukung kedaulatan pangan nasional.') }}
        </p>

        <form action="{{ route('collections.index') }}" method="GET" class="w-full max-w-3xl relative">
            <label for="hero-search" class="sr-only">{{ __('Cari koleksi, jurnal, atau arsip digital...') }}</label>
            <input
                id="hero-search"
                name="q"
                type="search"
                placeholder="{{ __('Cari koleksi, jurnal, atau arsip digital...') }}"
                class="w-full h-14 md:h-16 px-6 pr-32 md:pr-36 rounded-full text-on-surface bg-white placeholder:text-on-surface-variant border-2 border-white shadow-[0_10px_40px_rgba(0,0,0,0.45)] text-base md:text-body-lg focus:ring-2 focus:ring-secondary transition-all"
            >
            <button type="submit" class="absolute right-2 top-2 bottom-2 bg-primary px-4 md:px-6 rounded-full text-on-primary hover:bg-primary-container transition-all flex items-center gap-2">
                <span class="material-symbols-outlined" aria-hidden="true">search</span>
                <span class="font-bold hidden sm:inline">{{ __('Cari') }}</span>
            </button>
        </form>

        <div class="mt-10 grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-10 w-full max-w-4xl">
            @foreach ($stats as $stat)
                <div class="flex flex-col">
                    <span class="text-secondary font-bold text-2xl md:text-[32px]">{{ __($stat['value']) }}</span>
                    <span class="text-white/80 text-xs md:text-caption font-semibold uppercase tracking-wider">{{ __($stat['label']) }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>