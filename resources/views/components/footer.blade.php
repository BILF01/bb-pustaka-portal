<footer class="bg-primary text-white">
    <div class="h-[3px] bg-secondary"></div>

    <div class="max-w-[1280px] mx-auto px-6 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7 lg:gap-10">

            {{-- Brand --}}
            <div>
                <div class="flex items-center gap-2.5">
                    <img src="{{ asset('images/logo-bbpustaka.png') }}" alt="Logo BB Pustaka" class="w-10 h-10 object-contain shrink-0">

                    <div class="min-w-0">
                        <p class="text-[8px] sm:text-[9px] font-medium uppercase tracking-[0.02em] text-white/75 leading-tight whitespace-nowrap mb-1">
                            {{ __('Kementerian Pertanian Republik Indonesia') }}
                        </p>

                        <h3 class="text-[13px] sm:text-[14px] font-bold uppercase leading-[1.3] text-white max-w-[250px]">
                            {{ \App\Models\SiteSetting::get('site_tagline') }}
                        </h3>
                    </div>
                </div>
            </div>

            {{-- Tautan Cepat --}}
            <div>
                <h4 class="font-bold mb-3">
                    {{ __('Tautan Cepat') }}
                </h4>

                <div class="w-8 h-0.5 bg-secondary mb-3"></div>

                <ul class="space-y-2 text-sm">
                    @foreach ($quickLinks as $link)
                        <li>
                            <a href="{{ $link->url }}" class="group inline-flex items-center gap-2 text-white/75 hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[15px] text-secondary transition-transform group-hover:translate-x-0.5" aria-hidden="true">chevron_right</span>
                                <span>{{ __($link->label) }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Informasi --}}
            <div>
                <h4 class="font-bold mb-3">
                    {{ __('Informasi') }}
                </h4>

                <div class="w-8 h-0.5 bg-secondary mb-3"></div>

                <ul class="space-y-2 text-sm">
                    @foreach ($informationLinks as $link)
                        <li>
                            <a href="{{ $link->url }}" class="group inline-flex items-center gap-2 text-white/75 hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[15px] text-secondary transition-transform group-hover:translate-x-0.5" aria-hidden="true">chevron_right</span>
                                <span>{{ __($link->label) }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Kontak --}}
            <div>
                <h4 class="font-bold mb-3">
                    {{ __('Kontak & Ikuti Kami') }}
                </h4>

                <div class="w-8 h-0.5 bg-secondary mb-3"></div>

                <ul class="space-y-2.5 text-sm text-white/80">
                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-[19px] text-secondary shrink-0" aria-hidden="true">location_on</span>
                        <span class="leading-5">{{ \App\Models\SiteSetting::get('address') }}</span>
                    </li>

                    <li class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[19px] text-secondary shrink-0" aria-hidden="true">mail</span>
                        <a href="mailto:{{ \App\Models\SiteSetting::get('email') }}" class="break-all hover:text-white transition-colors">
                            {{ \App\Models\SiteSetting::get('email') }}
                        </a>
                    </li>

                    <li class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[19px] text-secondary shrink-0" aria-hidden="true">call</span>
                        <span>{{ \App\Models\SiteSetting::get('phone') }}</span>
                    </li>
                </ul>

                @if ($socialLinks->isNotEmpty())
                    <div class="flex gap-2 mt-4">
                        @foreach ($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $link->label }}" title="{{ $link->label }}" class="w-8 h-8 rounded-full overflow-hidden ring-1 ring-white/20 hover:ring-secondary hover:-translate-y-0.5 transition-all">
                                <x-social-icon :platform="$link->icon" />
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Bottom Footer --}}
    <div class="border-t border-white/15 bg-black/10">
        <div class="max-w-[1280px] mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center justify-between gap-3 text-xs text-white/70">
            <p>
                &copy; {{ now()->year }} {{ \App\Models\SiteSetting::get('copyright_text') }}
            </p>

            <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
                <a href="#" class="hover:text-white transition-colors">
                    {{ __('Kebijakan Privasi') }}
                </a>

                <a href="#" class="hover:text-white transition-colors">
                    {{ __('Syarat & Ketentuan') }}
                </a>

                <a href="#" class="hover:text-white transition-colors">
                    {{ __('Peta Situs') }}
                </a>
            </div>
        </div>
    </div>
</footer>