<x-layouts.admin title="Koleksi">
    <div class="space-y-5">
        <section class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary/65">
                    Katalog
                </p>

                <h2 class="mt-1 text-xl font-bold tracking-tight text-on-surface">
                    Kelola Koleksi
                </h2>

                <p class="mt-1 text-sm text-on-surface-variant">
                    Kelola buku dan publikasi yang ditampilkan pada katalog publik BB Pustaka.
                </p>
            </div>

            <a
                href="{{ route('admin.collections.create') }}"
                class="inline-flex h-11 shrink-0 items-center justify-center gap-2 rounded-xl bg-primary px-4 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-container"
            >
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                    add
                </span>

                <span>Tambah Koleksi</span>
            </a>
        </section>

        <form
            method="GET"
            action="{{ route('admin.collections.index') }}"
            class="rounded-2xl border border-outline-variant/25 bg-white p-4"
        >
            <div class="grid gap-3 lg:grid-cols-[minmax(240px,1fr)_220px_190px_auto]">
                <div class="relative">
                    <span
                        class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[20px] text-on-surface-variant/60"
                        aria-hidden="true"
                    >
                        search
                    </span>

                    <input
                        type="search"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari judul atau penulis..."
                        class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white pl-10 pr-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                    >
                </div>

                <select
                    name="category"
                    class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white px-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                >
                    <option value="">Semua kategori</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected((string) request('category') === (string) $category->id)
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <select
                    name="featured"
                    class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white px-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                >
                    <option value="">Semua koleksi</option>
                    <option value="yes" @selected(request('featured') === 'yes')>
                        Koleksi Unggulan
                    </option>
                    <option value="no" @selected(request('featured') === 'no')>
                        Bukan Unggulan
                    </option>
                </select>

                <div class="flex gap-2">
                    <button
                        type="submit"
                        class="inline-flex h-11 flex-1 items-center justify-center gap-2 rounded-xl bg-primary px-4 text-sm font-semibold text-white transition hover:bg-primary-container lg:flex-none"
                    >
                        <span class="material-symbols-outlined text-[19px]" aria-hidden="true">
                            filter_alt
                        </span>

                        Terapkan
                    </button>

                    @if (request()->filled('q') || request()->filled('category') || request()->filled('featured'))
                        <a
                            href="{{ route('admin.collections.index') }}"
                            class="inline-flex h-11 items-center justify-center rounded-xl border border-outline-variant/50 px-3 text-on-surface-variant transition hover:bg-surface-container-low"
                            aria-label="Reset filter"
                            title="Reset filter"
                        >
                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                                restart_alt
                            </span>
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <section class="overflow-hidden rounded-2xl border border-outline-variant/25 bg-white">
            <div class="flex items-center justify-between border-b border-outline-variant/20 px-5 py-4">
                <div>
                    <h3 class="text-sm font-bold text-on-surface">
                        Daftar Koleksi
                    </h3>

                    <p class="mt-0.5 text-xs text-on-surface-variant">
                        {{ $collections->total() }} koleksi ditemukan
                    </p>
                </div>

                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-secondary/35 text-on-secondary-container">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                        menu_book
                    </span>
                </span>
            </div>

            <div class="hidden overflow-x-auto md:block">
                <table class="w-full min-w-[900px] text-sm">
                    <thead class="bg-surface-container-low/70 text-left">
                        <tr class="text-xs uppercase tracking-[0.05em] text-on-surface-variant">
                            <th class="px-5 py-3.5 font-semibold">Koleksi</th>
                            <th class="px-5 py-3.5 font-semibold">Kategori</th>
                            <th class="px-5 py-3.5 font-semibold">Tahun</th>
                            <th class="px-5 py-3.5 font-semibold">Unggulan</th>
                            <th class="px-5 py-3.5 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-outline-variant/15">
                        @forelse ($collections as $collection)
                            <tr class="transition-colors hover:bg-surface-container-low/45">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-14 w-11 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-outline-variant/25 bg-surface-container-low">
                                            @if ($collection->cover_path)
                                                <img
                                                    src="{{ $collection->cover_path }}"
                                                    alt=""
                                                    class="h-full w-full object-cover"
                                                >
                                            @else
                                                <span
                                                    class="material-symbols-outlined text-[22px] text-outline/60"
                                                    aria-hidden="true"
                                                >
                                                    book_2
                                                </span>
                                            @endif
                                        </div>

                                        <div class="min-w-0 max-w-xl">
                                            <p class="font-semibold leading-5 text-on-surface">
                                                {{ $collection->title }}
                                            </p>

                                            <p class="mt-1 text-xs text-on-surface-variant">
                                                {{ $collection->author ?: 'Penulis tidak dicantumkan' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-4 text-on-surface-variant">
                                    {{ $collection->category->name }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-on-surface-variant">
                                    {{ $collection->published_year ?: '-' }}
                                </td>

                                <td class="px-5 py-4">
                                    @if ($collection->is_featured)
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-secondary/30 px-2.5 py-1 text-xs font-semibold text-on-secondary-container">
                                            <span
                                                class="material-symbols-outlined text-[15px]"
                                                aria-hidden="true"
                                            >
                                                star
                                            </span>

                                            Unggulan
                                        </span>
                                    @else
                                        <span class="text-xs text-on-surface-variant/60">
                                            —
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a
                                            href="{{ route('admin.collections.edit', $collection) }}"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg text-primary transition hover:bg-primary/10"
                                            aria-label="Ubah {{ $collection->title }}"
                                            title="Ubah"
                                        >
                                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                                                edit
                                            </span>
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.collections.destroy', $collection) }}"
                                            onsubmit="return confirm('Hapus koleksi ini?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg text-error transition hover:bg-error-container/50"
                                                aria-label="Hapus {{ $collection->title }}"
                                                title="Hapus"
                                            >
                                                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                                                    delete
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-14 text-center">
                                    <span
                                        class="material-symbols-outlined text-4xl text-outline/50"
                                        aria-hidden="true"
                                    >
                                        menu_book
                                    </span>

                                    <p class="mt-2 text-sm font-semibold text-on-surface">
                                        Belum ada koleksi
                                    </p>

                                    <p class="mt-1 text-xs text-on-surface-variant">
                                        Tidak ada koleksi yang sesuai dengan data atau filter saat ini.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="divide-y divide-outline-variant/15 md:hidden">
                @forelse ($collections as $collection)
                    <article class="p-4">
                        <div class="flex gap-3">
                            <div class="flex h-20 w-14 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-outline-variant/25 bg-surface-container-low">
                                @if ($collection->cover_path)
                                    <img
                                        src="{{ $collection->cover_path }}"
                                        alt=""
                                        class="h-full w-full object-cover"
                                    >
                                @else
                                    <span
                                        class="material-symbols-outlined text-2xl text-outline/50"
                                        aria-hidden="true"
                                    >
                                        book_2
                                    </span>
                                @endif
                            </div>

                            <div class="min-w-0 flex-1">
                                <div class="flex items-start justify-between gap-2">
                                    <p class="text-sm font-semibold leading-5 text-on-surface">
                                        {{ $collection->title }}
                                    </p>

                                    @if ($collection->is_featured)
                                        <span class="shrink-0 rounded-full bg-secondary/30 px-2 py-1 text-[10px] font-semibold text-on-secondary-container">
                                            Unggulan
                                        </span>
                                    @endif
                                </div>

                                <p class="mt-1 text-xs text-on-surface-variant">
                                    {{ $collection->author ?: 'Penulis tidak dicantumkan' }}
                                </p>

                                <p class="mt-1 text-xs text-on-surface-variant">
                                    {{ $collection->category->name }}

                                    @if ($collection->published_year)
                                        <span class="mx-1">•</span>
                                        {{ $collection->published_year }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 flex gap-2">
                            <a
                                href="{{ route('admin.collections.edit', $collection) }}"
                                class="inline-flex h-9 flex-1 items-center justify-center gap-2 rounded-lg border border-primary/20 text-xs font-semibold text-primary transition hover:bg-primary/5"
                            >
                                <span class="material-symbols-outlined text-[18px]" aria-hidden="true">
                                    edit
                                </span>

                                Ubah
                            </a>

                            <form
                                method="POST"
                                action="{{ route('admin.collections.destroy', $collection) }}"
                                class="flex-1"
                                onsubmit="return confirm('Hapus koleksi ini?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex h-9 w-full items-center justify-center gap-2 rounded-lg border border-error/20 text-xs font-semibold text-error transition hover:bg-error-container/40"
                                >
                                    <span class="material-symbols-outlined text-[18px]" aria-hidden="true">
                                        delete
                                    </span>

                                    Hapus
                                </button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="px-5 py-12 text-center">
                        <span
                            class="material-symbols-outlined text-4xl text-outline/50"
                            aria-hidden="true"
                        >
                            menu_book
                        </span>

                        <p class="mt-2 text-sm font-semibold">
                            Belum ada koleksi
                        </p>

                        <p class="mt-1 text-xs text-on-surface-variant">
                            Tidak ada koleksi yang sesuai dengan filter saat ini.
                        </p>
                    </div>
                @endforelse
            </div>
        </section>

        @if ($collections->hasPages())
            <div>
                {{ $collections->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>