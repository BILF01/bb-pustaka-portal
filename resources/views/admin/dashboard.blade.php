<x-layouts.admin title="Dashboard">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @can('news.manage')
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
        @endcan

        @can('hero-slides.manage')
            <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
                <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">image</span>
                <p class="text-3xl font-bold mt-2">{{ $stats['hero_slides'] }}</p>
                <p class="text-sm text-on-surface-variant">Total Hero Slider</p>
            </div>
        @endcan

        @can('collections.manage')
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
        @endcan

        @can('agendas.manage')
            <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
                <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">event</span>
                <p class="text-3xl font-bold mt-2">{{ $stats['agendas'] }}</p>
                <p class="text-sm text-on-surface-variant">Total Agenda</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
                <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">event_upcoming</span>
                <p class="text-3xl font-bold mt-2">{{ $stats['agendas_upcoming'] }}</p>
                <p class="text-sm text-on-surface-variant">Agenda Mendatang</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
                <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">schedule</span>
                <p class="text-3xl font-bold mt-2">{{ $stats['agendas_ongoing'] }}</p>
                <p class="text-sm text-on-surface-variant">Sedang Berlangsung</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
                <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">event_available</span>
                <p class="text-3xl font-bold mt-2">{{ $stats['agendas_completed'] }}</p>
                <p class="text-sm text-on-surface-variant">Agenda Selesai</p>
            </div>
        @endcan

        @can('feedback.view')
            <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
                <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">rate_review</span>
                <p class="text-3xl font-bold mt-2">{{ $stats['feedback'] }}</p>
                <p class="text-sm text-on-surface-variant">Total Umpan Balik</p>
            </div>
        @endcan

        @can('contact-messages.manage')
            <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
                <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">mail</span>
                <p class="text-3xl font-bold mt-2">{{ $stats['contact_messages'] }}</p>
                <p class="text-sm text-on-surface-variant">Total Pesan Masuk</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
                <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">mark_email_unread</span>
                <p class="text-3xl font-bold mt-2">{{ $stats['contact_messages_unread'] }}</p>
                <p class="text-sm text-on-surface-variant">Pesan Belum Dibaca</p>
            </div>
        @endcan
    </div>
</x-layouts.admin>