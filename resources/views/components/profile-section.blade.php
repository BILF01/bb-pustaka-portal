@props(['profile'])
<section
    class="relative overflow-hidden pt-16 pb-14 lg:pt-[72px] lg:pb-16"
    style="background: radial-gradient(circle at 10% 20%, rgba(5,104,57,.055), transparent 31%), radial-gradient(circle at 92% 16%, rgba(212,166,42,.055), transparent 24%), linear-gradient(180deg, #fdfefb 0%, #f8fbf8 68%, #f1f7f2 100%);"
    aria-labelledby="profile-heading"
>
    <!-- Background Ornament Bottom -->
    <div class="profile-bottom-decoration" aria-hidden="true">
        <div class="bottom-wave bottom-wave-left"></div>
        <div class="bottom-wave bottom-wave-right"></div>

        <img src="{{ asset('images/leaf-decoration-left.png') }}" alt="" class="absolute bottom-[-8px] left-[-18px] w-[210px] md:w-[260px] lg:w-[300px] h-auto opacity-95" loading="lazy">

        <img src="{{ asset('images/leaf-decoration-right.png') }}" alt="" class="absolute bottom-[-8px] right-[-12px] w-[220px] md:w-[280px] lg:w-[320px] h-auto opacity-60" loading="lazy">
    </div>

    <div class="relative z-10 w-[92%] max-w-[1320px] mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-[1.08fr_0.92fr] gap-10 lg:gap-[58px] items-start">

            <!-- LEFT: Photo -->
            <div class="relative pb-10 lg:pb-[44px]">
                <div class="relative overflow-hidden rounded-[32px] bg-surface-container border border-primary/10 shadow-[0_18px_50px_rgba(18,62,43,.12)]">
                    <div class="absolute -left-0.5 -top-0.5 z-[2] w-[170px] h-2.5 rounded-full bg-gradient-to-r from-gold to-[#c98a13]"></div>
                    <div class="absolute -left-3.5 top-[52px] w-[18px] h-[180px] rounded-full bg-gradient-to-b from-primary to-primary-container"></div>
                    <img src="{{ $profile['image'] }}" alt="{{ $profile['image_alt'] }}" class="block w-full h-[260px] md:h-[340px] lg:h-[420px] object-cover" loading="lazy" width="800" height="600">
                </div>

                <article class="absolute right-0 md:right-[-10px] bottom-0 w-full md:w-[300px] overflow-hidden rounded-[20px] bg-white/97 backdrop-blur-md border border-primary/10 shadow-[0_16px_36px_rgba(18,62,43,.16)]">
                    <div class="absolute right-[-18px] bottom-[-28px] w-[80px] h-[80px] rotate-45 bg-gradient-to-br from-gold/30 to-gold"></div>

                    <div class="relative grid grid-cols-[48px_1fr] gap-3 p-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-gold bg-gradient-to-br from-primary to-primary-container shadow-[inset_0_0_0_1px_rgba(255,255,255,.14),0_8px_18px_rgba(6,74,49,.18)]">
                            <svg viewBox="0 0 64 64" fill="none" class="w-6 h-6">
                                <path d="M12 52h40M17 48V25h30v23M13 25h38L32 12 13 25Z" stroke="currentColor" stroke-width="3" stroke-linejoin="round"/>
                                <path d="M24 31v11M32 31v11M40 31v11" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-serif text-primary-container text-base leading-[1.15] mb-1.5">{{ __($profile['overlay_title']) }}</h3>
                            <p class="text-on-surface-variant text-xs leading-relaxed">{{ __($profile['overlay_description']) }}</p>
                        </div>
                    </div>

                    <div class="relative flex items-center gap-2 px-4 py-3 border-t border-outline-variant/30 bg-gradient-to-r from-surface-container-low to-surface-container text-primary-container font-extrabold text-sm">
                        <span class="material-symbols-outlined text-base" aria-hidden="true">calendar_today</span>
                        <span>{{ __($profile['founded_footer_label']) }} {{ $profile['founded_year'] }}</span>
                    </div>
                </article>
            </div>

            <!-- RIGHT: Content -->
            <div class="mt-6 lg:mt-0">
                <span class="inline-flex items-center gap-2 px-3.5 py-2 rounded-full bg-primary/10 text-primary text-xs font-extrabold uppercase tracking-wide">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true">eco</span>
                    {{ __($profile['badge_label']) }}
                </span>

                <h2 id="profile-heading" class="font-serif text-primary-container text-2xl md:text-[28px] lg:text-[32px] leading-[1.1] tracking-[-0.02em] mt-3 mb-2">{{ __($profile['heading']) }}</h2>

                <div class="flex items-center gap-2 my-3">
                    <span class="w-16 h-[3px] rounded-full bg-gold"></span>
                    <span class="w-[34px] h-[3px] rounded-full bg-gradient-to-r from-gold to-transparent"></span>
                </div>

                <p class="max-w-[650px] text-on-surface-variant text-sm md:text-[15px] leading-[1.6] mb-5">{{ __($profile['description']) }}</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <article class="relative overflow-hidden min-h-[130px] p-5 rounded-[22px] border border-outline-variant/30 bg-white shadow-[0_10px_30px_rgba(21,63,44,.07)]">
                        <div class="flex items-center gap-3.5 mb-3">
                            <div class="w-[50px] h-[50px] rounded-full flex items-center justify-center text-gold bg-secondary-container/60">
                                <span class="material-symbols-outlined" aria-hidden="true">visibility</span>
                            </div>
                            <h3 class="font-serif text-primary-container text-xl">{{ __('Visi') }}</h3>
                        </div>
                        <p class="text-on-surface-variant text-sm leading-relaxed">{{ __($profile['vision']) }}</p>
                        <span class="absolute left-6 right-6 bottom-0 h-[3px] rounded-full bg-gold"></span>
                    </article>

                    <article class="relative overflow-hidden min-h-[162px] p-6 rounded-[22px] border border-outline-variant/30 bg-white shadow-[0_10px_30px_rgba(21,63,44,.07)]">
                        <div class="flex items-center gap-3.5 mb-3">
                            <div class="w-[50px] h-[50px] rounded-full flex items-center justify-center text-primary bg-primary/10">
                                <span class="material-symbols-outlined" aria-hidden="true">track_changes</span>
                            </div>
                            <h3 class="font-serif text-primary-container text-xl">{{ __('Misi') }}</h3>
                        </div>
                        <p class="text-on-surface-variant text-sm leading-relaxed">{{ __($profile['mission']) }}</p>
                        <span class="absolute left-6 right-6 bottom-0 h-[3px] rounded-full bg-primary"></span>
                    </article>
                </div>

                <a href="{{ route('about') }}" class="inline-flex items-center gap-4 mt-7 pl-[22px] pr-2 py-2 rounded-2xl text-white font-extrabold bg-gradient-to-br from-primary to-primary-container shadow-[0_12px_26px_rgba(11,107,67,.19)] hover:opacity-95 transition-opacity">
                    <span>{{ __('Baca Selengkapnya') }}</span>
                    <span class="w-[34px] h-[34px] rounded-full bg-white text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-lg" aria-hidden="true">arrow_forward</span>
                    </span>
                </a>
            </div>
        </div>

        <!-- FEATURE BAR -->
        <div class="mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x lg:divide-x divide-outline-variant/15 p-5 rounded-[26px] border border-primary/10 bg-white shadow-[0_10px_28px_rgba(22,61,44,.06)]">
            @foreach ($profile['features'] as $feature)
                <div class="flex items-center gap-3.5 px-4 md:px-5 py-4">
                    <div class="w-[46px] h-[46px] rounded-full flex items-center justify-center text-primary bg-primary/10 shrink-0">
                        <span class="material-symbols-outlined text-xl" aria-hidden="true">{{ $feature['icon'] }}</span>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-on-surface text-sm mb-0.5">{{ __($feature['title']) }}</h4>
                        <p class="text-on-surface-variant text-xs leading-snug">{{ __($feature['description']) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>