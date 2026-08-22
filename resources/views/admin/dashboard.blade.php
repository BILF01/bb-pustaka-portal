<x-layouts.admin title="Dashboard">
    <div class="space-y-6">
        <section class="overflow-hidden rounded-2xl border border-outline-variant/25 bg-white">
            <div class="flex flex-col gap-4 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary/65">
                        Ringkasan Panel
                    </p>

                    <h2 class="mt-1 text-xl font-bold tracking-tight text-on-surface sm:text-2xl">
                        Selamat datang, {{ auth()->user()->name }}
                    </h2>

                    <p class="mt-1.5 max-w-2xl text-sm leading-6 text-on-surface-variant">
                        Pantau ringkasan konten dan layanan BB Pustaka sesuai akses akun Anda.
                    </p>
                </div>

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-[26px]" aria-hidden="true">
                        space_dashboard
                    </span>
                </div>
            </div>
        </section>

        @canany(['news.manage', 'hero-slides.manage'])
            <section>
                <div class="mb-3 flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true">
                            campaign
                        </span>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-on-surface">
                            Publikasi
                        </h2>

                        <p class="text-xs text-on-surface-variant">
                            Ringkasan berita dan konten utama portal.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                    @can('news.manage')
                        <div class="group min-h-[138px] rounded-2xl border border-outline-variant/25 bg-white p-5 transition-all duration-200 hover:-translate-y-0.5 hover:border-primary/20 hover:shadow-[0_10px_28px_rgba(25,28,27,0.07)]">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-medium text-on-surface-variant">
                                        Total Berita
                                    </p>

                                    <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                                        {{ $stats['news'] }}
                                    </p>
                                </div>

                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                    <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                        article
                                    </span>
                                </span>
                            </div>

                            <p class="mt-3 text-xs text-on-surface-variant/70">
                                Seluruh berita yang tersimpan.
                            </p>
                        </div>

                        <div class="group min-h-[138px] rounded-2xl border border-outline-variant/25 bg-white p-5 transition-all duration-200 hover:-translate-y-0.5 hover:border-primary/20 hover:shadow-[0_10px_28px_rgba(25,28,27,0.07)]">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-medium text-on-surface-variant">
                                        Berita Terbit
                                    </p>

                                    <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                                        {{ $stats['news_published'] }}
                                    </p>
                                </div>

                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                    <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                        check_circle
                                    </span>
                                </span>
                            </div>

                            <p class="mt-3 text-xs text-on-surface-variant/70">
                                Berita yang sudah dipublikasikan.
                            </p>
                        </div>
                    @endcan

                    @can('hero-slides.manage')
                        <div class="group min-h-[138px] rounded-2xl border border-outline-variant/25 bg-white p-5 transition-all duration-200 hover:-translate-y-0.5 hover:border-primary/20 hover:shadow-[0_10px_28px_rgba(25,28,27,0.07)]">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-medium text-on-surface-variant">
                                        Banner Utama Aktif
                                    </p>

                                    <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                                        {{ $stats['hero_slides'] }}
                                    </p>
                                </div>

                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                    <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                        image
                                    </span>
                                </span>
                            </div>

                            <p class="mt-3 text-xs text-on-surface-variant/70">
                                Konten visual pada bagian utama portal.
                            </p>
                        </div>
                    @endcan
                </div>
            </section>
        @endcanany

        @can('collections.manage')
            <section>
                <div class="mb-3 flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-secondary/35 text-on-secondary-container">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true">
                            menu_book
                        </span>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-on-surface">
                            Koleksi
                        </h2>

                        <p class="text-xs text-on-surface-variant">
                            Ringkasan koleksi perpustakaan.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="group min-h-[138px] rounded-2xl border border-outline-variant/25 bg-white p-5 transition-all duration-200 hover:-translate-y-0.5 hover:border-primary/20 hover:shadow-[0_10px_28px_rgba(25,28,27,0.07)]">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-on-surface-variant">
                                    Total Koleksi
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                                    {{ $stats['collections'] }}
                                </p>
                            </div>

                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-secondary/35 text-on-secondary-container">
                                <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                    menu_book
                                </span>
                            </span>
                        </div>

                        <p class="mt-3 text-xs text-on-surface-variant/70">
                            Seluruh koleksi yang tersimpan.
                        </p>
                    </div>

                    <div class="group min-h-[138px] rounded-2xl border border-outline-variant/25 bg-white p-5 transition-all duration-200 hover:-translate-y-0.5 hover:border-primary/20 hover:shadow-[0_10px_28px_rgba(25,28,27,0.07)]">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-on-surface-variant">
                                    Koleksi Unggulan
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                                    {{ $stats['collections_featured'] }}
                                </p>
                            </div>

                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-secondary/35 text-on-secondary-container">
                                <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                    star
                                </span>
                            </span>
                        </div>

                        <p class="mt-3 text-xs text-on-surface-variant/70">
                            Koleksi yang ditandai sebagai unggulan.
                        </p>
                    </div>
                </div>
            </section>
        @endcan

        @can('agendas.manage')
            <section>
                <div class="mb-3 flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true">
                            calendar_month
                        </span>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-on-surface">
                            Kegiatan
                        </h2>

                        <p class="text-xs text-on-surface-variant">
                            Status pelaksanaan agenda BB Pustaka.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="min-h-[138px] rounded-2xl border border-outline-variant/25 bg-white p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-on-surface-variant">
                                    Total Agenda
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                                    {{ $stats['agendas'] }}
                                </p>
                            </div>

                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                    event
                                </span>
                            </span>
                        </div>

                        <p class="mt-3 text-xs text-on-surface-variant/70">
                            Seluruh agenda kegiatan.
                        </p>
                    </div>

                    <div class="min-h-[138px] rounded-2xl border border-outline-variant/25 bg-white p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-on-surface-variant">
                                    Mendatang
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                                    {{ $stats['agendas_upcoming'] }}
                                </p>
                            </div>

                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                    event_upcoming
                                </span>
                            </span>
                        </div>

                        <p class="mt-3 text-xs text-on-surface-variant/70">
                            Agenda yang belum dimulai.
                        </p>
                    </div>

                    <div class="min-h-[138px] rounded-2xl border border-outline-variant/25 bg-white p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-on-surface-variant">
                                    Berlangsung
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                                    {{ $stats['agendas_ongoing'] }}
                                </p>
                            </div>

                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                    schedule
                                </span>
                            </span>
                        </div>

                        <p class="mt-3 text-xs text-on-surface-variant/70">
                            Agenda yang sedang berjalan.
                        </p>
                    </div>

                    <div class="min-h-[138px] rounded-2xl border border-outline-variant/25 bg-white p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-on-surface-variant">
                                    Selesai
                                </p>

                                <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                                    {{ $stats['agendas_completed'] }}
                                </p>
                            </div>

                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                    event_available
                                </span>
                            </span>
                        </div>

                        <p class="mt-3 text-xs text-on-surface-variant/70">
                            Agenda yang telah selesai.
                        </p>
                    </div>
                </div>
            </section>
        @endcan

        @canany(['feedback.view', 'contact-messages.manage'])
            <section>
                <div class="mb-3 flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true">
                            support_agent
                        </span>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-on-surface">
                            Layanan Informasi
                        </h2>

                        <p class="text-xs text-on-surface-variant">
                            Ringkasan interaksi dan pesan dari pengguna portal.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                    @can('feedback.view')
                        <div class="min-h-[138px] rounded-2xl border border-outline-variant/25 bg-white p-5">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-medium text-on-surface-variant">
                                        Total Umpan Balik
                                    </p>

                                    <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                                        {{ $stats['feedback'] }}
                                    </p>
                                </div>

                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                    <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                        rate_review
                                    </span>
                                </span>
                            </div>

                            <p class="mt-3 text-xs text-on-surface-variant/70">
                                Umpan balik yang diterima dari pengguna.
                            </p>
                        </div>
                    @endcan

                    @can('contact-messages.manage')
                        <div class="min-h-[138px] rounded-2xl border border-outline-variant/25 bg-white p-5">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-medium text-on-surface-variant">
                                        Total Pesan Masuk
                                    </p>

                                    <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                                        {{ $stats['contact_messages'] }}
                                    </p>
                                </div>

                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                    <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                        mail
                                    </span>
                                </span>
                            </div>

                            <p class="mt-3 text-xs text-on-surface-variant/70">
                                Seluruh pesan yang diterima.
                            </p>
                        </div>

                        <div class="min-h-[138px] rounded-2xl border border-outline-variant/25 bg-white p-5">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-medium text-on-surface-variant">
                                        Belum Dibaca
                                    </p>

                                    <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                                        {{ $stats['contact_messages_unread'] }}
                                    </p>
                                </div>

                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                    <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                        mark_email_unread
                                    </span>
                                </span>
                            </div>

                            <p class="mt-3 text-xs text-on-surface-variant/70">
                                Pesan yang masih membutuhkan perhatian.
                            </p>
                        </div>
                    @endcan
                </div>
            </section>
        @endcanany
    </div>
</x-layouts.admin>