@props(['slides', 'stats'])

<section class="relative bg-background overflow-hidden" aria-label="{{ __('Sorotan utama') }}">
        <div
        class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('{{ asset('images/hero-home-bg.png') }}'); filter: saturate(1.18) contrast(1.04);"
        aria-hidden="true"
    ></div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-background/35" aria-hidden="true"></div>
    <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-b from-transparent via-background/20 to-background/90" aria-hidden="true"></div>

    <div
        x-data="{ navHeight: 149 }"
        x-init="
            const updateNavHeight = () => { const el = document.getElementById('site-header'); if (el) navHeight = el.offsetHeight; };
            updateNavHeight();
            window.addEventListener('resize', updateNavHeight);
            new ResizeObserver(updateNavHeight).observe(document.getElementById('site-header'));
        "
        :style="`padding-top: ${navHeight + 18}px`"
        class="relative z-10 w-full pb-10 md:pb-14 flex items-center justify-center px-4"
    >
        <div
            x-data="{ current: 0, total: {{ count($slides) }} }"
            @if (count($slides) > 1)
                x-init="setInterval(() => current = (current + 1) % total, 6000)"
            @endif
            class="relative w-[94%] max-w-[1050px] mx-auto"
        >
            <div class="relative">
                <div class="relative aspect-[1600/795] rounded-[28px] overflow-hidden bg-[#F8FAF6] border border-white/70 shadow-[0_18px_50px_rgba(31,73,44,0.12)] isolate">
                    @foreach ($slides as $index => $slide)
                        <img
                            x-show="current === {{ $index }}"
                            x-transition:enter="transition-opacity duration-700 ease-out"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition-opacity duration-700 ease-in"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            @if ($index > 0) style="display:none" @endif
                            :aria-hidden="current === {{ $index }} ? 'false' : 'true'"
                            src="{{ $slide['image'] }}"
                            alt="{{ __('Banner') }} {{ $index + 1 }}"
                            class="absolute inset-0 w-full h-full object-contain block"
                            loading="eager"
                        >
                    @endforeach
                </div>

                @if (count($slides) > 1)
                        <button
                            type="button"
                            @click="current = (current - 1 + total) % total"
                            class="absolute -left-3 md:-left-16 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/95 backdrop-blur border border-black/5 text-primary shadow-lg flex items-center justify-center transition-all hover:scale-110 hover:bg-white"
                            aria-label="{{ __('Slide sebelumnya') }}"
                        >
                            <span class="material-symbols-outlined text-primary text-lg md:text-2xl" aria-hidden="true">chevron_left</span>
                        </button>
                        <button
                            type="button"
                            @click="current = (current + 1) % total"
                            class="absolute -right-3 md:-right-16 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/95 backdrop-blur border border-black/5 text-primary shadow-lg flex items-center justify-center transition-all hover:scale-110 hover:bg-white"
                            aria-label="{{ __('Slide berikutnya') }}"
                        >
                            <span class="material-symbols-outlined text-primary text-lg md:text-2xl" aria-hidden="true">chevron_right</span>
                        </button>
                @endif

                @if (count($slides) > 1)
                    <div class="flex items-center justify-center gap-2 w-fit mx-auto mt-3 px-3.5 py-2 rounded-full bg-white/90 backdrop-blur border border-black/5 shadow-sm" role="tablist" aria-label="{{ __('Navigasi slide') }}">
                        @foreach ($slides as $index => $slide)
                            <button
                                type="button"
                                role="tab"
                                @click="current = {{ $index }}"
                                :aria-selected="current === {{ $index }} ? 'true' : 'false'"
                                :class="current === {{ $index }} ? 'bg-primary' : 'bg-gray-300'"
                                class="w-2 h-2 rounded-full transition-all duration-300"
                                aria-label="{{ __('Tampilkan slide') }} {{ $index + 1 }}"
                            ></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>