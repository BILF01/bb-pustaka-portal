<footer class="bg-surface-container-lowest border-t border-outline-variant/30 pt-16 pb-8">
    <div class="max-w-[1280px] mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10">
        <div class="space-y-4">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo-bbpustaka.png') }}" alt="Logo BB Pustaka" class="w-8 h-8 object-contain">
                <span class="text-lg font-bold text-primary">{{ \App\Models\SiteSetting::get('site_name', 'BB Pustaka') }}</span>
            </div>
            <p class="text-sm text-on-surface-variant leading-relaxed">
                {{ \App\Models\SiteSetting::get('site_tagline') }}<br>
                {{ \App\Models\SiteSetting::get('org_name') }}
            </p>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-on-surface">{{ __('Tautan Cepat') }}</h4>
            <ul class="space-y-2 text-sm">
                @foreach ($quickLinks as $link)
                    <li><a href="{{ $link->url }}" class="text-on-surface-variant hover:text-primary hover:underline">{{ __($link->label) }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-on-surface">{{ __('Informasi') }}</h4>
            <ul class="space-y-2 text-sm">
                @foreach ($informationLinks as $link)
                    <li><a href="{{ $link->url }}" class="text-on-surface-variant hover:text-primary hover:underline">{{ __($link->label) }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-on-surface uppercase tracking-wide">{{ __('Kontak & Ikuti Kami') }}</h4>
            <ul class="space-y-2 text-sm text-on-surface-variant">
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">location_on</span>
                    <span>{{ \App\Models\SiteSetting::get('address') }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">mail</span>
                    <a href="mailto:{{ \App\Models\SiteSetting::get('email') }}" class="hover:text-primary hover:underline">{{ \App\Models\SiteSetting::get('email') }}</a>
                </li>
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base text-secondary" aria-hidden="true">call</span>
                    <span>{{ \App\Models\SiteSetting::get('phone') }}</span>
                </li>
            </ul>

            <div class="flex flex-wrap gap-3 pt-2">
                @foreach ($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $link->label }}" class="w-11 h-11 rounded-lg overflow-hidden hover:scale-105 transition-transform">
                        <x-social-icon :platform="$link->icon" />
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="max-w-[1280px] mx-auto px-6 mt-12 pt-6 border-t border-outline-variant/30 flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-on-surface-variant">
        <p>&copy; {{ now()->year }} {{ \App\Models\SiteSetting::get('copyright_text') }}</p>
        <div class="flex gap-6">
            <a href="#" class="hover:text-primary">{{ __('Kebijakan Privasi') }}</a>
            <a href="#" class="hover:text-primary">{{ __('Syarat & Ketentuan') }}</a>
            <a href="#" class="hover:text-primary">{{ __('Peta Situs') }}</a>
        </div>
    </div>
</footer>