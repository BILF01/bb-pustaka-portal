@props(['links'])

<section
    class="relative z-30 -mt-7 md:-mt-9 w-fit max-w-[calc(100vw-2rem)] mx-auto"
    aria-label="{{ __('Akses cepat') }}"
>
    <div class="relative">
        <div class="absolute inset-x-10 top-3 bottom-0 bg-primary/10 blur-2xl rounded-full pointer-events-none"></div>

        <div class="relative bg-white/90 backdrop-blur-xl border border-white/80 rounded-[26px] shadow-[0_16px_45px_rgba(31,73,44,0.13)] px-3 py-3 md:px-4 md:py-4">
            <div class="flex items-center justify-center gap-2 sm:gap-3 md:gap-4">
                @foreach ($links as $link)
                    @php
                        $isChat=($link['action'] ?? null)==='open-chat';

                        $displayIcon=match($link['label'] ?? ''){
                            'Koleksi'=>'local_library',
                            'Berita & Artikel'=>'breaking_news',
                            'Repository'=>'database',
                            'AI Assistant'=>'auto_awesome',
                            'Kontak & Lokasi'=>'location_on',
                            'Tentang Kami'=>'account_balance',
                            default=>$link['icon'] ?? 'apps'
                        };
                    @endphp

                    <div class="relative group">
                        @if($isChat)
                            <button
                                type="button"
                                x-data
                                @click="$store.chat.open = true"
                                title="{{ __($link['label']) }}"
                                aria-label="{{ __($link['label']) }}"
                                class="relative w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-2xl flex items-center justify-center
                                       bg-gradient-to-br from-primary to-primary-container text-on-primary
                                       border border-primary/20
                                       shadow-[0_8px_20px_rgba(31,73,44,0.18)]
                                       transition-all duration-300 ease-out
                                       hover:-translate-y-1.5 hover:scale-105
                                       hover:shadow-[0_14px_28px_rgba(31,73,44,0.25)]
                                       focus:outline-none focus:ring-4 focus:ring-primary/15"
                            >
                                <span class="absolute inset-[5px] rounded-[13px] border border-white/15 pointer-events-none"></span>

                                <span
                                    class="material-symbols-outlined text-[24px] sm:text-[27px] md:text-[30px] relative z-10"
                                    aria-hidden="true"
                                >
                                    {{ $displayIcon }}
                                </span>

                                <span class="absolute -top-1 -right-1 w-4 h-4 md:w-[18px] md:h-[18px] rounded-full bg-secondary border-2 border-white flex items-center justify-center">
                                    <span class="text-[7px] md:text-[8px] leading-none font-black text-on-secondary">AI</span>
                                </span>
                            </button>
                        @else
                            <a
                                href="{{ $link['url'] }}"
                                @if($link['external'] ?? false)
                                    target="_blank"
                                    rel="noopener noreferrer"
                                @endif
                                title="{{ __($link['label']) }}"
                                aria-label="{{ __($link['label']) }}"
                                class="relative w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-2xl flex items-center justify-center
                                       bg-gradient-to-br from-white to-primary/[0.06]
                                       text-primary
                                       border border-primary/10
                                       shadow-[0_6px_16px_rgba(31,73,44,0.07)]
                                       transition-all duration-300 ease-out
                                       hover:-translate-y-1.5 hover:scale-105
                                       hover:bg-primary hover:text-on-primary
                                       hover:border-primary
                                       hover:shadow-[0_14px_26px_rgba(31,73,44,0.18)]
                                       focus:outline-none focus:ring-4 focus:ring-primary/15"
                            >
                                <span class="absolute inset-[5px] rounded-[13px] border border-primary/[0.06] group-hover:border-white/10 transition-colors pointer-events-none"></span>

                                <span
                                    class="material-symbols-outlined text-[24px] sm:text-[27px] md:text-[30px] relative z-10"
                                    aria-hidden="true"
                                >
                                    {{ $displayIcon }}
                                </span>

                                @if($link['external'] ?? false)
                                    <span class="absolute top-1.5 right-1.5 material-symbols-outlined text-[11px] opacity-50 group-hover:text-white group-hover:opacity-80">
                                        north_east
                                    </span>
                                @endif
                            </a>
                        @endif

                        <div
                            class="hidden md:block absolute left-1/2 -translate-x-1/2 top-full mt-3
                                   opacity-0 invisible translate-y-1
                                   group-hover:opacity-100 group-hover:visible group-hover:translate-y-0
                                   group-focus-within:opacity-100 group-focus-within:visible group-focus-within:translate-y-0
                                   transition-all duration-200 z-50 pointer-events-none"
                        >
                            <div class="relative whitespace-nowrap rounded-lg bg-[#163D2A] text-white text-xs font-semibold px-3 py-2 shadow-xl">
                                {{ __($link['label']) }}

                                <span class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 rotate-45 bg-[#163D2A]"></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>