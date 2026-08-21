@props(['profile'])

<section class="relative pt-10 pb-10 md:pt-14 md:pb-12 lg:pt-[72px] lg:pb-16" aria-labelledby="profile-heading">
    <div class="w-[92%] max-w-[1320px] mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-[1.08fr_0.92fr] gap-7 md:gap-9 lg:gap-[58px] items-start">

            {{-- VISUAL --}}
            <div class="relative md:pb-10 lg:pb-[44px]">
                <div class="relative overflow-hidden rounded-[22px] md:rounded-[28px] lg:rounded-[32px] bg-surface-container border border-primary/10 shadow-[0_14px_38px_rgba(18,62,43,.10)] lg:shadow-[0_18px_50px_rgba(18,62,43,.12)]">
                    <div class="absolute -left-0.5 -top-0.5 z-[2] w-[135px] md:w-[170px] h-2 md:h-2.5 rounded-full bg-gradient-to-r from-gold to-[#c98a13]"></div>
                    <div class="hidden md:block absolute -left-3.5 top-[52px] w-[18px] h-[180px] rounded-full bg-gradient-to-b from-primary to-primary-container"></div>

                    <img
                        src="{{ $profile['image'] }}"
                        alt="{{ $profile['image_alt'] }}"
                        class="block w-full h-[215px] sm:h-[245px] md:h-[340px] lg:h-[420px] object-cover"
                        loading="lazy"
                        width="800"
                        height="600"
                    >
                </div>

                <article class="relative z-[3] mx-3 -mt-8 md:mx-0 md:mt-0 md:absolute md:right-[-10px] md:bottom-0 md:w-[300px] overflow-hidden rounded-[18px] md:rounded-[20px] bg-surface-container-lowest/95 backdrop-blur-md border border-primary/10 shadow-[0_12px_28px_rgba(18,62,43,.13)] md:shadow-[0_16px_36px_rgba(18,62,43,.16)]">
                    <div class="absolute right-[-18px] bottom-[-28px] w-[80px] h-[80px] rotate-45 bg-gradient-to-br from-gold/30 to-gold"></div>

                    <div class="relative grid grid-cols-[42px_1fr] md:grid-cols-[48px_1fr] gap-3 p-3.5 md:p-4">
                        <div class="w-[42px] h-[42px] md:w-12 md:h-12 rounded-full flex items-center justify-center text-gold bg-gradient-to-br from-primary to-primary-container shadow-[inset_0_0_0_1px_rgba(255,255,255,.14),0_8px_18px_rgba(6,74,49,.18)]">
                            <svg viewBox="0 0 64 64" fill="none" class="w-5 h-5 md:w-6 md:h-6" aria-hidden="true">
                                <path d="M12 52h40M17 48V25h30v23M13 25h38L32 12 13 25Z" stroke="currentColor" stroke-width="3" stroke-linejoin="round"/>
                                <path d="M24 31v11M32 31v11M40 31v11" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <h3 class="font-serif text-primary-container text-[15px] md:text-base leading-[1.2] mb-1">
                                {{ __($profile['overlay_title']) }}
                            </h3>

                            <p class="text-on-surface-variant text-[11px] md:text-xs leading-[1.55]">
                                {{ __($profile['overlay_description']) }}
                            </p>
                        </div>
                    </div>

                    <div class="relative flex items-center gap-2 px-3.5 md:px-4 py-2.5 md:py-3 border-t border-outline-variant/30 bg-gradient-to-r from-surface-container-low to-surface-container text-primary-container font-extrabold text-[12px] md:text-sm">
                        <span class="material-symbols-outlined text-[16px]" aria-hidden="true">calendar_today</span>
                        <span>{{ __($profile['founded_footer_label']) }} {{ $profile['founded_year'] }}</span>
                    </div>
                </article>
            </div>

            {{-- CONTENT --}}
            <div class="lg:mt-0">
                <span class="inline-flex items-center gap-2 px-3 py-1.5 md:px-3.5 md:py-2 rounded-full bg-primary/10 text-primary text-[10px] md:text-xs font-extrabold uppercase tracking-wide">
                    <span class="material-symbols-outlined text-[14px]" aria-hidden="true">eco</span>
                    {{ __($profile['badge_label']) }}
                </span>

                <h2 id="profile-heading" class="font-serif text-primary-container text-[25px] md:text-[28px] lg:text-[32px] font-bold leading-[1.12] tracking-[-.02em] mt-3 mb-2">
                    {{ __($profile['heading']) }}
                </h2>

                <div class="flex items-center gap-2 my-3">
                    <span class="w-14 md:w-16 h-[3px] rounded-full bg-gold"></span>
                    <span class="w-[28px] md:w-[34px] h-[3px] rounded-full bg-gradient-to-r from-gold to-transparent"></span>
                </div>

                <p class="max-w-[650px] text-on-surface-variant text-[12px] md:text-[15px] leading-[1.65] mb-5">
                    {{ __($profile['description']) }}
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                    <article class="relative overflow-hidden min-h-[125px] md:min-h-[145px] p-4 md:p-5 rounded-[18px] md:rounded-[22px] border border-outline-variant/30 bg-surface-container-lowest shadow-[0_8px_24px_rgba(21,63,44,.06)]">
                        <div class="flex items-center gap-3 mb-2.5 md:mb-3">
                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center text-gold bg-secondary-container/60">
                                <span class="material-symbols-outlined text-[19px] md:text-[24px]" aria-hidden="true">visibility</span>
                            </div>

                            <h3 class="font-serif text-primary-container text-lg md:text-xl">
                                {{ __('Visi') }}
                            </h3>
                        </div>

                        <p class="text-on-surface-variant text-[12px] md:text-sm leading-relaxed">
                            {{ __($profile['vision']) }}
                        </p>

                        <span class="absolute left-5 right-5 md:left-6 md:right-6 bottom-0 h-[3px] rounded-full bg-gold"></span>
                    </article>

                    <article class="relative overflow-hidden min-h-[125px] md:min-h-[145px] p-4 md:p-5 rounded-[18px] md:rounded-[22px] border border-outline-variant/30 bg-surface-container-lowest shadow-[0_8px_24px_rgba(21,63,44,.06)]">
                        <div class="flex items-center gap-3 mb-2.5 md:mb-3">
                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center text-primary bg-primary/10">
                                <span class="material-symbols-outlined text-[19px] md:text-[24px]" aria-hidden="true">track_changes</span>
                            </div>

                            <h3 class="font-serif text-primary-container text-lg md:text-xl">
                                {{ __('Misi') }}
                            </h3>
                        </div>

                        <p class="text-on-surface-variant text-[12px] md:text-sm leading-relaxed">
                            {{ __($profile['mission']) }}
                        </p>

                        <span class="absolute left-5 right-5 md:left-6 md:right-6 bottom-0 h-[3px] rounded-full bg-primary"></span>
                    </article>
                </div>

                <a
                    href="{{ route('about') }}"
                    class="inline-flex items-center gap-3 mt-5 md:mt-7 pl-4 md:pl-[22px] pr-1.5 md:pr-2 py-1.5 md:py-2 rounded-xl md:rounded-2xl text-white font-extrabold text-[11px] md:text-sm bg-gradient-to-br from-primary to-primary-container shadow-[0_10px_22px_rgba(11,107,67,.17)] hover:-translate-y-0.5 hover:shadow-[0_16px_30px_rgba(11,107,67,.23)] transition-all"
                >
                    <span>{{ __('Baca Selengkapnya') }}</span>

                    <span class="w-8 h-8 md:w-[34px] md:h-[34px] rounded-full bg-white text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[17px]" aria-hidden="true">arrow_forward</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>