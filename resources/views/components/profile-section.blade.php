@props(['profile'])

<section class="py-16 md:py-20 max-w-[1280px] mx-auto px-6" aria-labelledby="profile-heading">
    <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 items-center">
        <div class="w-full lg:w-1/2 relative">
            <div class="aspect-[4/3] rounded-xl overflow-hidden shadow-lg border border-outline-variant/20">
                <img src="{{ $profile['image'] }}" alt="{{ $profile['image_alt'] }}" class="w-full h-full object-cover" loading="lazy" width="800" height="600">
            </div>
            <div class="absolute -bottom-6 -right-4 md:-right-6 w-36 h-36 md:w-48 md:h-48 bg-primary-container p-4 md:p-6 rounded-xl text-on-primary shadow-xl flex flex-col justify-center">
                <span class="text-2xl md:text-headline-md font-bold">{{ $profile['founded_year'] }}</span>
                <span class="text-xs md:text-caption">{{ __($profile['founded_label']) }}</span>
            </div>
        </div>

        <div class="w-full lg:w-1/2 space-y-4 mt-8 lg:mt-0">
            <h2 id="profile-heading" class="text-2xl md:text-headline-lg font-bold text-primary">{{ __($profile['heading']) }}</h2>
            <p class="text-on-surface-variant leading-relaxed">{{ __($profile['description']) }}</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
                <div class="p-4 bg-surface-container-low rounded-xl border-l-4 border-secondary">
                    <h3 class="font-bold text-primary mb-1">{{ __('Visi') }}</h3>
                    <p class="text-sm text-on-surface-variant">{{ __($profile['vision']) }}</p>
                </div>
                <div class="p-4 bg-surface-container-low rounded-xl border-l-4 border-primary">
                    <h3 class="font-bold text-primary mb-1">{{ __('Misi') }}</h3>
                    <p class="text-sm text-on-surface-variant">{{ __($profile['mission']) }}</p>
                </div>
            </div>

            <a href="{{ route('about') }}" class="mt-6 inline-flex px-6 h-12 bg-primary text-on-primary rounded-lg font-semibold hover:bg-primary-container transition-all items-center gap-2">
                {{ __('Baca Selengkapnya') }}
                <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
            </a>
        </div>
    </div>
</section>