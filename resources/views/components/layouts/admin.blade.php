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
<body class="bg-surface-container-low text-on-surface" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed lg:translate-x-0 lg:sticky lg:top-0 lg:bottom-auto lg:h-screen lg:self-start inset-y-0 left-0 w-64 bg-primary text-on-primary z-40 transition-transform duration-300 flex flex-col">
            <div class="p-6 flex items-center gap-2 border-b border-white/10">
                <img src="{{ asset('images/logo-bbpustaka.png') }}" alt="Logo BB Pustaka" class="w-8 h-8 object-contain">
                <span class="font-bold">BB Pustaka Admin</span>
            </div>

            <nav class="flex-1 p-4 space-y-1 overflow-y-auto" aria-label="Navigasi admin">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 font-semibold' : '' }}">
                    <span class="material-symbols-outlined" aria-hidden="true">dashboard</span> Dashboard
                </a>
                <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.news.*') ? 'bg-white/15 font-semibold' : '' }}">
                    <span class="material-symbols-outlined" aria-hidden="true">article</span> Berita
                </a>
                <a href="{{ route('admin.collections.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.collections.*') ? 'bg-white/15 font-semibold' : '' }}">
                    <span class="material-symbols-outlined" aria-hidden="true">menu_book</span> Koleksi
                </a>
                <a href="{{ route('admin.agendas.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.agendas.*') ? 'bg-white/15 font-semibold' : '' }}">
                    <span class="material-symbols-outlined" aria-hidden="true">event</span> Agenda
                </a>
                <a href="{{ route('admin.feedback.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all {{ request()->routeIs('admin.feedback.*') ? 'bg-white/15 font-semibold' : '' }}">
                    <span class="material-symbols-outlined" aria-hidden="true">rate_review</span> Umpan Balik
                </a>
            </nav>

            <div class="p-4 border-t border-white/10">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all text-left">
                        <span class="material-symbols-outlined" aria-hidden="true">logout</span> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 bg-black/40 z-30 lg:hidden"></div>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white border-b border-outline-variant/30 h-16 flex items-center justify-between px-6 sticky top-0 z-20">
                <button type="button" class="lg:hidden p-2" @click="sidebarOpen = !sidebarOpen" aria-label="Buka menu admin">
                    <span class="material-symbols-outlined" aria-hidden="true">menu</span>
                </button>
                <h1 class="font-bold text-primary">{{ $title ?? 'Dashboard' }}</h1>
                <span class="text-sm text-on-surface-variant">{{ auth()->user()->name }}</span>
            </header>

            <main class="flex-1 p-6">
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-lg bg-primary/10 text-primary text-sm" role="status">
                        {{ session('success') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>