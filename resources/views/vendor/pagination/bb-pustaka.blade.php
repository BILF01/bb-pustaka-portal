@if ($paginator->hasPages())
    <nav class="flex flex-col sm:flex-row items-center justify-between gap-4" aria-label="Navigasi halaman">
        <p class="text-sm text-on-surface-variant">
            Menampilkan {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }} hasil
        </p>

        <div class="flex items-center gap-1">
            @if ($paginator->onFirstPage())
                <span class="w-9 h-9 flex items-center justify-center rounded-full text-on-surface-variant/40 cursor-not-allowed">
                    <span class="material-symbols-outlined text-lg" aria-hidden="true">chevron_left</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-lg" aria-hidden="true">chevron_left</span>
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="w-9 h-9 flex items-center justify-center text-on-surface-variant/50 text-sm">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-9 h-9 flex items-center justify-center rounded-full bg-primary text-on-primary text-sm font-bold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center rounded-full text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-lg" aria-hidden="true">chevron_right</span>
                </a>
            @else
                <span class="w-9 h-9 flex items-center justify-center rounded-full text-on-surface-variant/40 cursor-not-allowed">
                    <span class="material-symbols-outlined text-lg" aria-hidden="true">chevron_right</span>
                </span>
            @endif
        </div>
    </nav>
@endif