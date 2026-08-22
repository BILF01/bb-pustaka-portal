<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - Admin BB Pustaka</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-bbpustaka.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-surface-container-low text-on-surface"
    x-data="{ sidebarOpen: false, accountOpen: false }"
    :class="{ 'overflow-hidden lg:overflow-auto': sidebarOpen }"
>
    @php
        $navBase = 'group relative flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200';
        $navIdle = 'text-white/85 hover:bg-white/10 hover:text-white';
        $navActive = 'bg-white text-primary shadow-sm';
    @endphp

    <div class="flex min-h-screen">
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 flex w-60 flex-col bg-primary text-on-primary shadow-xl transition-transform duration-300 lg:sticky lg:top-0 lg:h-screen lg:translate-x-0 lg:self-start lg:shadow-none"
        >
            <div class="flex h-16 shrink-0 items-center justify-between border-b border-white/10 px-4">
                <div class="flex min-w-0 items-center gap-3">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white/10">
                        <img
                            src="{{ asset('images/logo-bbpustaka.png') }}"
                            alt="Logo BB Pustaka"
                            class="h-7 w-7 object-contain"
                        >
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-sm font-bold leading-tight text-white">
                            BB Pustaka
                        </p>
                        <p class="mt-0.5 truncate text-[10px] font-medium uppercase tracking-[0.12em] text-white/55">
                            Panel Administrasi
                        </p>
                    </div>
                </div>

                <button
                    type="button"
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-white/75 transition-colors hover:bg-white/10 hover:text-white lg:hidden"
                    @click="sidebarOpen = false"
                    aria-label="Tutup menu admin"
                >
                    <span class="material-symbols-outlined text-[21px]" aria-hidden="true">
                        close
                    </span>
                </button>
            </div>

            <nav
                class="flex-1 overflow-y-auto px-3 py-4"
                aria-label="Navigasi admin"
            >
                <div class="space-y-1">
                    @can('dashboard.view')
                        <a
                            href="{{ route('admin.dashboard') }}"
                            @click="sidebarOpen = false"
                            class="{{ $navBase }} {{ request()->routeIs('admin.dashboard') ? $navActive : $navIdle }}"
                        >
                            @if (request()->routeIs('admin.dashboard'))
                                <span class="absolute -left-3 h-6 w-1 rounded-r-full bg-secondary" aria-hidden="true"></span>
                            @endif

                            <span
                                class="material-symbols-outlined text-[21px]"
                                aria-hidden="true"
                            >
                                dashboard
                            </span>

                            <span>Dashboard</span>
                        </a>
                    @endcan

                    @can('news.manage')
                        <a
                            href="{{ route('admin.news.index') }}"
                            @click="sidebarOpen = false"
                            class="{{ $navBase }} {{ request()->routeIs('admin.news.*') ? $navActive : $navIdle }}"
                        >
                            @if (request()->routeIs('admin.news.*'))
                                <span class="absolute -left-3 h-6 w-1 rounded-r-full bg-secondary" aria-hidden="true"></span>
                            @endif

                            <span class="material-symbols-outlined text-[21px]" aria-hidden="true">
                                article
                            </span>

                            <span>Berita</span>
                        </a>
                    @endcan

                    @can('collections.manage')
                        <a
                            href="{{ route('admin.collections.index') }}"
                            @click="sidebarOpen = false"
                            class="{{ $navBase }} {{ request()->routeIs('admin.collections.*') ? $navActive : $navIdle }}"
                        >
                            @if (request()->routeIs('admin.collections.*'))
                                <span class="absolute -left-3 h-6 w-1 rounded-r-full bg-secondary" aria-hidden="true"></span>
                            @endif

                            <span class="material-symbols-outlined text-[21px]" aria-hidden="true">
                                menu_book
                            </span>

                            <span>Koleksi</span>
                        </a>
                    @endcan

                    @can('agendas.manage')
                        <a
                            href="{{ route('admin.agendas.index') }}"
                            @click="sidebarOpen = false"
                            class="{{ $navBase }} {{ request()->routeIs('admin.agendas.*') ? $navActive : $navIdle }}"
                        >
                            @if (request()->routeIs('admin.agendas.*'))
                                <span class="absolute -left-3 h-6 w-1 rounded-r-full bg-secondary" aria-hidden="true"></span>
                            @endif

                            <span class="material-symbols-outlined text-[21px]" aria-hidden="true">
                                event
                            </span>

                            <span>Agenda</span>
                        </a>
                    @endcan

                    @can('hero-slides.manage')
                        <a
                            href="{{ route('admin.hero-slides.index') }}"
                            @click="sidebarOpen = false"
                            class="{{ $navBase }} {{ request()->routeIs('admin.hero-slides.*') ? $navActive : $navIdle }}"
                        >
                            @if (request()->routeIs('admin.hero-slides.*'))
                                <span class="absolute -left-3 h-6 w-1 rounded-r-full bg-secondary" aria-hidden="true"></span>
                            @endif

                            <span class="material-symbols-outlined text-[21px]" aria-hidden="true">
                                image
                            </span>

                            <span>Banner Utama</span>
                        </a>
                    @endcan

                    @can('feedback.view')
                        <a
                            href="{{ route('admin.feedback.index') }}"
                            @click="sidebarOpen = false"
                            class="{{ $navBase }} {{ request()->routeIs('admin.feedback.*') ? $navActive : $navIdle }}"
                        >
                            @if (request()->routeIs('admin.feedback.*'))
                                <span class="absolute -left-3 h-6 w-1 rounded-r-full bg-secondary" aria-hidden="true"></span>
                            @endif

                            <span class="material-symbols-outlined text-[21px]" aria-hidden="true">
                                rate_review
                            </span>

                            <span>Umpan Balik</span>
                        </a>
                    @endcan

                    @can('contact-messages.manage')
                        <a
                            href="{{ route('admin.contact-messages.index') }}"
                            @click="sidebarOpen = false"
                            class="{{ $navBase }} {{ request()->routeIs('admin.contact-messages.*') ? $navActive : $navIdle }}"
                        >
                            @if (request()->routeIs('admin.contact-messages.*'))
                                <span class="absolute -left-3 h-6 w-1 rounded-r-full bg-secondary" aria-hidden="true"></span>
                            @endif

                            <span class="material-symbols-outlined text-[21px]" aria-hidden="true">
                                mail
                            </span>

                            <span>Pesan Masuk</span>
                        </a>
                    @endcan
                </div>

                @if (auth()->user()->can('users.manage') || auth()->user()->can('activity-log.view'))
                    <div class="mb-2 mt-6 flex items-center gap-3 px-3">
                        <span class="text-[10px] font-bold uppercase tracking-[0.14em] text-white/45">
                            Administrasi
                        </span>

                        <span class="h-px flex-1 bg-white/10" aria-hidden="true"></span>
                    </div>

                    <div class="space-y-1">
                        @can('users.manage')
                            <a
                                href="{{ route('admin.users.index') }}"
                                @click="sidebarOpen = false"
                                class="{{ $navBase }} {{ request()->routeIs('admin.users.*') ? $navActive : $navIdle }}"
                            >
                                @if (request()->routeIs('admin.users.*'))
                                    <span class="absolute -left-3 h-6 w-1 rounded-r-full bg-secondary" aria-hidden="true"></span>
                                @endif

                                <span class="material-symbols-outlined text-[21px]" aria-hidden="true">
                                    manage_accounts
                                </span>

                                <span>Kelola Petugas</span>
                            </a>
                        @endcan

                        @can('activity-log.view')
                            <a
                                href="{{ route('admin.activity-logs.index') }}"
                                @click="sidebarOpen = false"
                                class="{{ $navBase }} {{ request()->routeIs('admin.activity-logs.*') ? $navActive : $navIdle }}"
                            >
                                @if (request()->routeIs('admin.activity-logs.*'))
                                    <span class="absolute -left-3 h-6 w-1 rounded-r-full bg-secondary" aria-hidden="true"></span>
                                @endif

                                <span class="material-symbols-outlined text-[21px]" aria-hidden="true">
                                    history
                                </span>

                                <span>Activity Log</span>
                            </a>
                        @endcan
                    </div>
                @endif
            </nav>

            <div class="shrink-0 border-t border-white/10 px-4 py-3">
                <p class="text-[10px] leading-relaxed text-white/40">
                    Balai Besar Perpustakaan dan Literasi Pertanian
                </p>
            </div>
        </aside>

        <div
            x-show="sidebarOpen"
            x-cloak
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/40 backdrop-blur-[1px] lg:hidden"
            aria-hidden="true"
        ></div>

        <div class="flex min-w-0 flex-1 flex-col">
            <header
                class="sticky top-0 z-30 flex h-16 shrink-0 items-center justify-between border-b border-outline-variant/25 bg-white/95 px-4 backdrop-blur sm:px-6"
            >
                <div class="flex min-w-0 items-center gap-3">
                    <button
                        type="button"
                        class="-ml-2 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-on-surface-variant transition-colors hover:bg-surface-container-low hover:text-primary lg:hidden"
                        @click="sidebarOpen = true"
                        aria-label="Buka menu admin"
                    >
                        <span class="material-symbols-outlined text-[23px]" aria-hidden="true">
                            menu
                        </span>
                    </button>

                    <div class="min-w-0">
                        <p class="hidden text-[10px] font-semibold uppercase tracking-[0.12em] text-on-surface-variant/60 sm:block">
                            Panel Administrasi
                        </p>

                        <h1 class="truncate text-base font-bold leading-tight text-primary sm:text-lg">
                            {{ $title ?? 'Dashboard' }}
                        </h1>
                    </div>
                </div>

                <div
                    class="relative"
                    @click.outside="accountOpen = false"
                    @keydown.escape.window="accountOpen = false"
                >
                    <button
                        type="button"
                        @click="accountOpen = !accountOpen"
                        :aria-expanded="accountOpen.toString()"
                        class="flex max-w-[250px] items-center gap-2 rounded-xl px-2 py-1.5 transition-colors hover:bg-surface-container-low sm:max-w-[340px] sm:gap-3"
                        aria-haspopup="menu"
                    >
                        <div class="hidden min-w-0 text-right sm:block">
                            <p class="truncate text-sm font-semibold leading-tight text-on-surface">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="mt-0.5 text-[11px] text-on-surface-variant/70">
                                Akun Admin
                            </p>
                        </div>

                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary ring-1 ring-primary/10">
                            <span class="material-symbols-outlined text-[21px]" aria-hidden="true">
                                person
                            </span>
                        </span>

                        <span
                            class="material-symbols-outlined shrink-0 text-[18px] text-on-surface-variant transition-transform"
                            :class="accountOpen ? 'rotate-180' : ''"
                            aria-hidden="true"
                        >
                            expand_more
                        </span>
                    </button>

                    <div
                        x-show="accountOpen"
                        x-cloak
                        x-transition.origin.top.right
                        class="absolute right-0 mt-2 w-72 overflow-hidden rounded-2xl border border-outline-variant/30 bg-white shadow-[0_16px_40px_rgba(25,28,27,0.14)]"
                        role="menu"
                    >
                        <div class="border-b border-outline-variant/20 px-4 py-4">
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                                    <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                        person
                                    </span>
                                </span>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-on-surface">
                                        {{ auth()->user()->name }}
                                    </p>

                                    <p class="mt-0.5 truncate text-xs text-on-surface-variant">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-2">
                            <a
                                href="{{ route('admin.profile.edit') }}"
                                class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition-colors hover:bg-surface-container-low {{ request()->routeIs('admin.profile.*') ? 'bg-primary/5 font-semibold text-primary' : 'text-on-surface' }}"
                                role="menuitem"
                            >
                                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                                    person
                                </span>

                                <span>Profil Saya</span>
                            </a>

                            <div class="my-1 border-t border-outline-variant/20"></div>

                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf

                                <button
                                    type="submit"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm text-on-surface transition-colors hover:bg-error-container/50 hover:text-error"
                                    role="menuitem"
                                >
                                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                                        logout
                                    </span>

                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="min-w-0 flex-1 px-4 py-5 sm:px-6 sm:py-6 lg:px-8">
                <div class="mx-auto w-full max-w-[1600px]">
                    @if (session('success'))
                        <div
                            class="mb-5 flex items-start gap-3 rounded-xl border border-primary/15 bg-primary/5 px-4 py-3 text-sm text-primary"
                            role="status"
                        >
                            <span class="material-symbols-outlined mt-px text-[20px]" aria-hidden="true">
                                check_circle
                            </span>

                            <span class="leading-5">
                                {{ session('success') }}
                            </span>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>