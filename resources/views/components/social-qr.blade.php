@props(['links'])

<div class="bg-white/90 backdrop-blur-sm border border-outline-variant/30 rounded-2xl p-5 shadow-sm">
    <div class="flex items-center gap-3 mb-3">
        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
            <span class="material-symbols-outlined" aria-hidden="true">hub</span>
        </div>

        <div>
            <h3 class="font-bold text-primary">{{ __('Terhubung dengan Kami') }}</h3>
            <p class="text-xs text-on-surface-variant">{{ __('Kanal resmi BB Pustaka') }}</p>
        </div>
    </div>

    <div class="divide-y divide-outline-variant/20">
        @foreach ($links as $link)
            <a
                href="{{ $link['url'] }}"
                target="_blank"
                rel="noopener noreferrer"
                class="group flex items-center gap-3 py-4 first:pt-3 last:pb-1"
            >
                <div class="w-10 h-10 rounded-full bg-primary/8 flex items-center justify-center shrink-0 group-hover:bg-primary/15 transition-colors">
                    <x-social-icon :platform="strtolower($link['label'])" />
                </div>

                <div class="min-w-0 flex-1">
                    <span class="block text-sm font-bold text-on-surface group-hover:text-primary transition-colors">
                        {{ $link['label'] }}
                    </span>
                    <span class="block text-xs text-on-surface-variant">
                        {{ __('Buka Platform Resmi') }}
                    </span>
                </div>

                <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary group-hover:translate-x-1 transition-all" aria-hidden="true">
                    chevron_right
                </span>
            </a>
        @endforeach
    </div>
</div>