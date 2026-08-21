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
>
    <div class="flex min-h-screen">
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed lg:translate-x-0 lg:sticky lg:top-0 lg:bottom-auto lg:h-screen lg:self-start inset-y-0 left-0 w-64 bg-primary text-on-primary z-40 transition-transform duration-300 flex flex-col"
        >
            <div class="p-6 flex items-center gap-2 border-b border-white/10">
                <img
                    src="{{ asset('images/logo-bbpustaka.png') }}"
                    alt="Logo BB Pustaka"
                    class="w-8 h-8 object-contain"
                >
                <span class="font-bold">BB Pustaka Admin</span>
            </div>

            <nav class="flex-1 p-4 space-y-1 overflow-y-auto" aria-label="Navigasi admin">
                @can('dashboard.view')
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 font-semibold' : '' }}"
                    >
                        <span class="material-symbols-outlined" aria-hidden="true">dashboard</span>
                        Dashboard
                    </a>
                @endcan

                @can('news.manage')
                    <a
                        href="{{ route('admin.news.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.news.*') ? 'bg-white/15 font-semibold' : '' }}"
                    >
                        <span class="material-symbols-outlined" aria-hidden="true">article</span>
                        Berita
                    </a>
                @endcan

                @can('collections.manage')
                    <a
                        href="{{ route('admin.collections.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.collections.*') ? 'bg-white/15 font-semibold' : '' }}"
                    >
                        <span class="material-symbols-outlined" aria-hidden="true">menu_book</span>
                        Koleksi
                    </a>
                @endcan

                @can('agendas.manage')
                    <a
                        href="{{ route('admin.agendas.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.agendas.*') ? 'bg-white/15 font-semibold' : '' }}"
                    >
                        <span class="material-symbols-outlined" aria-hidden="true">event</span>
                        Agenda
                    </a>
                @endcan

                @can('hero-slides.manage')
                    <a
                        href="{{ route('admin.hero-slides.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.hero-slides.*') ? 'bg-white/15 font-semibold' : '' }}"
                    >
                        <span class="material-symbols-outlined" aria-hidden="true">image</span>
                        Hero Slider
                    </a>
                @endcan

                @can('feedback.view')
                    <a
                        href="{{ route('admin.feedback.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.feedback.*') ? 'bg-white/15 font-semibold' : '' }}"
                    >
                        <span class="material-symbols-outlined" aria-hidden="true">rate_review</span>
                        Umpan Balik
                    </a>
                @endcan

                @can('contact-messages.manage')
                    <a
                        href="{{ route('admin.contact-messages.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.contact-messages.*') ? 'bg-white/15 font-semibold' : '' }}"
                    >
                        <span class="material-symbols-outlined" aria-hidden="true">mail</span>
                        Pesan Masuk
                    </a>
                @endcan

                @if (auth()->user()->can('users.manage') || auth()->user()->can('activity-log.view'))
                    <div class="pt-5 pb-1 px-4">
                        <p class="text-[11px] font-bold tracking-[0.12em] uppercase text-white/50">
                            Administrasi
                        </p>
                    </div>

                    @can('users.manage')
                        <a
                            href="{{ route('admin.users.index') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.users.*') ? 'bg-white/15 font-semibold' : '' }}"
                        >
                            <span class="material-symbols-outlined" aria-hidden="true">manage_accounts</span>
                            Kelola Petugas
                        </a>
                    @endcan

                    @can('activity-log.view')
                        <a
                            href="{{ route('admin.activity-logs.index') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.activity-logs.*') ? 'bg-white/15 font-semibold' : '' }}"
                        >
                            <span class="material-symbols-outlined" aria-hidden="true">history</span>
                            Activity Log
                        </a>
                    @endcan
                @endif
            </nav>
        </aside>

        <div
            x-show="sidebarOpen"
            x-cloak
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black/40 z-30 lg:hidden"
        ></div>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white border-b border-outline-variant/30 h-16 flex items-center justify-between px-4 sm:px-6 sticky top-0 z-20">
                <div class="flex items-center gap-3 min-w-0">
                    <button
                        type="button"
                        class="lg:hidden p-2 -ml-2 rounded-lg hover:bg-surface-container-low transition-colors"
                        @click="sidebarOpen = !sidebarOpen"
                        aria-label="Buka menu admin"
                    >
                        <span class="material-symbols-outlined" aria-hidden="true">menu</span>
                    </button>

                    <h1 class="font-bold text-primary truncate">
                        {{ $title ?? 'Dashboard' }}
                    </h1>
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
                        class="flex items-center gap-2 sm:gap-3 max-w-[220px] sm:max-w-[320px] px-2.5 py-2 rounded-lg hover:bg-surface-container-low transition-colors"
                        aria-haspopup="menu"
                    >
                        <span class="hidden sm:block text-sm text-on-surface-variant truncate">
                            {{ auth()->user()->name }}
                        </span>

                        <span class="w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                                account_circle
                            </span>
                        </span>

                        <span
                            class="material-symbols-outlined text-[18px] text-on-surface-variant transition-transform shrink-0"
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
                        class="absolute right-0 mt-2 w-64 bg-white rounded-xl border border-outline-variant/30 shadow-lg overflow-hidden z-50"
                        role="menu"
                    >
                        <div class="px-4 py-3 border-b border-outline-variant/20">
                            <p class="text-sm font-semibold text-on-surface truncate">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-xs text-on-surface-variant truncate mt-0.5">
                                {{ auth()->user()->email }}
                            </p>
                        </div>

                        <div class="p-2">
                            <a
                                href="{{ route('admin.profile.edit') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm hover:bg-surface-container-low transition-colors {{ request()->routeIs('admin.profile.*') ? 'bg-primary/5 text-primary font-semibold' : '' }}"
                                role="menuitem"
                            >
                                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                                    person
                                </span>
                                Profil Saya
                            </a>

                            <div class="my-1 border-t border-outline-variant/20"></div>

                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf

                                <button
                                    type="submit"
                                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-left hover:bg-surface-container-low transition-colors"
                                    role="menuitem"
                                >
                                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                                        logout
                                    </span>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6">
                @if (session('success'))
                    <div
                        class="mb-6 p-4 rounded-lg bg-primary/10 text-primary text-sm"
                        role="status"
                    >
                        {{ session('success') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>