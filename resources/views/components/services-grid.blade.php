@props(['services', 'heading' => 'Inovasi dan Layanan'])

<section class="py-16 md:py-20 bg-surface-container-lowest border-y border-outline-variant/30" aria-labelledby="services-heading">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="text-center mb-12">
            <h2 id="services-heading" class="text-2xl md:text-headline-lg font-bold text-primary uppercase tracking-tight">
                {{ __($heading) }}
            </h2>
            <div class="w-20 h-1 bg-secondary mx-auto mt-2"></div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-x-6 gap-y-10 md:gap-y-12">
            @foreach ($services as $service)
                <a href="{{ $service['url'] ?? '#' }}" class="flex flex-col items-center text-center group focus:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded-lg p-2">
                    <span class="w-20 h-20 md:w-24 md:h-24 mb-3 md:mb-4 flex items-center justify-center transition-transform duration-300 group-hover:-translate-y-1 motion-reduce:group-hover:translate-y-0">
                        <span class="material-symbols-outlined text-primary text-[48px] md:text-[64px]" aria-hidden="true">{{ $service['icon'] }}</span>
                    </span>
                    <h3 class="font-bold text-sm text-on-surface mb-1 group-hover:text-primary transition-colors">{{ $service['name'] }}</h3>
                    <p class="text-[11px] text-on-surface-variant leading-tight px-1">{{ $service['description'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
