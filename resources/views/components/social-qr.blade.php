@props(['links'])

<div class="mt-6 bg-white rounded-xl p-6 shadow-xl">
    <h3 class="text-sm font-bold text-primary uppercase tracking-wide mb-4 text-center">{{ t('Ikuti Kami') }}</h3>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($links as $link)
            <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" class="flex flex-col items-center gap-2 group">
                <div class="relative w-20 h-20 group-hover:scale-105 transition-transform">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($link['url']) }}" alt="QR {{ $link['label'] }}" class="w-20 h-20 rounded-lg border border-outline-variant" loading="lazy">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-7 h-7 rounded-lg border-2 border-white shadow overflow-hidden">
                        <x-social-icon :platform="strtolower($link['label'])" />
                    </div>
                </div>
                <span class="text-xs font-semibold text-on-surface-variant">{{ $link['label'] }}</span>
            </a>
        @endforeach
    </div>
</div>