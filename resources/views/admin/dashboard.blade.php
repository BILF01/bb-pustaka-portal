<x-layouts.admin title="Dashboard">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
            <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">article</span>
            <p class="text-3xl font-bold mt-2">{{ $stats['news'] }}</p>
            <p class="text-sm text-on-surface-variant">Total Berita</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
            <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">check_circle</span>
            <p class="text-3xl font-bold mt-2">{{ $stats['news_published'] }}</p>
            <p class="text-sm text-on-surface-variant">Berita Terbit</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
            <span class="material-symbols-outlined text-secondary text-3xl" aria-hidden="true">menu_book</span>
            <p class="text-3xl font-bold mt-2">{{ $stats['collections'] }}</p>
            <p class="text-sm text-on-surface-variant">Total Koleksi</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
            <span class="material-symbols-outlined text-secondary text-3xl" aria-hidden="true">star</span>
            <p class="text-3xl font-bold mt-2">{{ $stats['collections_featured'] }}</p>
            <p class="text-sm text-on-surface-variant">Koleksi Unggulan</p>
        </div>
    </div>
</x-layouts.admin>