@props(['links'])

<div class="relative z-30 -mt-10 md:-mt-12 max-w-[1280px] mx-auto px-4 md:px-6">
    <div class="bg-white rounded-xl shadow-xl p-3 md:p-4 flex flex-wrap justify-center items-center gap-x-6 gap-y-3 md:gap-x-10 border border-outline-variant/30">
        @foreach ($links as $link)
            @if (($link['action'] ?? null) === 'open-chat')
                <button type="button" x-data @click="$store.chat.open = true" class="flex flex-col items-center gap-1 px-2 py-2 hover:bg-surface-container-low rounded-lg transition-all group w-20 md:w-24">
                    <span class="w-10 h-10 md:w-12 md:h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-all">
                        <span class="material-symbols-outlined" aria-hidden="true">{{ $link['icon'] }}</span>
                    </span>
                    <span class="text-[10px] md:text-xs font-semibold text-center leading-tight">{{ __($link['label']) }}</span>
                </button>
            @else
                <a href="{{ $link['url'] }}" class="flex flex-col items-center gap-1 px-2 py-2 hover:bg-surface-container-low rounded-lg transition-all group w-20 md:w-24">
                    <span class="w-10 h-10 md:w-12 md:h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-all">
                        <span class="material-symbols-outlined" aria-hidden="true">{{ $link['icon'] }}</span>
                    </span>
                    <span class="text-[10px] md:text-xs font-semibold text-center leading-tight">{{ __($link['label']) }}</span>
                </a>
            @endif
        @endforeach
    </div>
</div>