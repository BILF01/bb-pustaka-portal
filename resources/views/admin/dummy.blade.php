<x-layouts.admin :title="$title">
    <div class="bg-white p-10 rounded-xl border border-outline-variant/30 shadow-sm text-center max-w-xl mx-auto">
        <span class="material-symbols-outlined text-on-surface-variant text-[48px]" aria-hidden="true">swap_horiz</span>
        <h2 class="text-lg font-bold text-primary mt-4 mb-2">{{ $title }}</h2>
        <p class="text-on-surface-variant text-sm">{{ $message }}</p>
    </div>
</x-layouts.admin>