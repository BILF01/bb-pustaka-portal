<x-layouts.admin title="Berita">
    <div class="space-y-5">
        <section class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary/65">
                    Publikasi
                </p>

                <h2 class="mt-1 text-xl font-bold tracking-tight text-on-surface">
                    Kelola Berita
                </h2>

                <p class="mt-1 text-sm text-on-surface-variant">
                    Kelola berita dan artikel yang ditampilkan pada portal BB Pustaka.
                </p>
            </div>

            <a
                href="{{ route('admin.news.create') }}"
                class="inline-flex h-11 shrink-0 items-center justify-center gap-2 rounded-xl bg-primary px-4 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-container"
            >
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                    add
                </span>

                <span>Tambah Berita</span>
            </a>
        </section>

        <form
            method="GET"
            action="{{ route('admin.news.index') }}"
            class="rounded-2xl border border-outline-variant/25 bg-white p-4"
        >
            <div class="grid gap-3 lg:grid-cols-[minmax(240px,1fr)_220px_180px_auto]">
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
                        placeholder="Cari judul atau ringkasan..."
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
                    name="status"
                    class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white px-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                >
                    <option value="">Semua status</option>
                    <option value="published" @selected(request('status') === 'published')>
                        Terbit
                    </option>
                    <option value="draft" @selected(request('status') === 'draft')>
                        Draf
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

                    @if (request()->filled('q') || request()->filled('category') || request()->filled('status'))
                        <a
                            href="{{ route('admin.news.index') }}"
                            class="inline-flex h-11 items-center justify-center rounded-xl border border-outline-variant/50 px-3 text-on-surface-variant transition hover:bg-surface-container-low"
                            aria-label="Reset filter"
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
                        Daftar Berita
                    </h3>

                    <p class="mt-0.5 text-xs text-on-surface-variant">
                        {{ $newsList->total() }} berita ditemukan
                    </p>
                </div>

                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                        article
                    </span>
                </span>
            </div>

            <div class="hidden overflow-x-auto md:block">
                <table class="w-full min-w-[820px] text-sm">
                    <thead class="bg-surface-container-low/70 text-left">
                        <tr class="text-xs uppercase tracking-[0.05em] text-on-surface-variant">
                            <th class="px-5 py-3.5 font-semibold">Berita</th>
                            <th class="px-5 py-3.5 font-semibold">Kategori</th>
                            <th class="px-5 py-3.5 font-semibold">Status</th>
                            <th class="px-5 py-3.5 font-semibold">Tanggal</th>
                            <th class="px-5 py-3.5 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-outline-variant/15">
                        @forelse ($newsList as $news)
                            <tr class="transition-colors hover:bg-surface-container-low/45">
                                <td class="px-5 py-4">
                                    <div class="max-w-xl">
                                        <p class="font-semibold leading-5 text-on-surface">
                                            {{ $news->title }}
                                        </p>

                                        <p class="mt-1 line-clamp-1 text-xs text-on-surface-variant">
                                            {{ $news->excerpt }}
                                        </p>
                                    </div>
                                </td>

                                <td class="px-5 py-4 text-on-surface-variant">
                                    {{ $news->category->name }}
                                </td>

                                <td class="px-5 py-4">
                                    @if ($news->is_published)
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 px-2.5 py-1 text-xs font-semibold text-primary">
                                            <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                                            Terbit
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">
                                            <span class="h-1.5 w-1.5 rounded-full bg-outline"></span>
                                            Draf
                                        </span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-on-surface-variant">
                                    {{ $news->created_at->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a
                                            href="{{ route('admin.news.edit', $news) }}"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg text-primary transition hover:bg-primary/10"
                                            aria-label="Ubah {{ $news->title }}"
                                            title="Ubah"
                                        >
                                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                                                edit
                                            </span>
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.news.destroy', $news) }}"
                                            onsubmit="return confirm('Hapus berita ini?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg text-error transition hover:bg-error-container/50"
                                                aria-label="Hapus {{ $news->title }}"
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
                                    <span class="material-symbols-outlined text-4xl text-outline/50" aria-hidden="true">
                                        article
                                    </span>

                                    <p class="mt-2 text-sm font-semibold text-on-surface">
                                        Belum ada berita
                                    </p>

                                    <p class="mt-1 text-xs text-on-surface-variant">
                                        Tidak ada berita yang sesuai dengan data atau filter saat ini.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="divide-y divide-outline-variant/15 md:hidden">
                @forelse ($newsList as $news)
                    <article class="p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-sm font-semibold leading-5 text-on-surface">
                                    {{ $news->title }}
                                </p>

                                <p class="mt-1 text-xs text-on-surface-variant">
                                    {{ $news->category->name }}
                                    <span class="mx-1">•</span>
                                    {{ $news->created_at->translatedFormat('d M Y') }}
                                </p>
                            </div>

                            @if ($news->is_published)
                                <span class="shrink-0 rounded-full bg-primary/10 px-2.5 py-1 text-[11px] font-semibold text-primary">
                                    Terbit
                                </span>
                            @else
                                <span class="shrink-0 rounded-full bg-surface-container px-2.5 py-1 text-[11px] font-semibold text-on-surface-variant">
                                    Draf
                                </span>
                            @endif
                        </div>

                        <p class="mt-3 line-clamp-2 text-xs leading-5 text-on-surface-variant">
                            {{ $news->excerpt }}
                        </p>

                        <div class="mt-4 flex items-center gap-2">
                            <a
                                href="{{ route('admin.news.edit', $news) }}"
                                class="inline-flex h-9 flex-1 items-center justify-center gap-2 rounded-lg border border-primary/20 text-xs font-semibold text-primary transition hover:bg-primary/5"
                            >
                                <span class="material-symbols-outlined text-[18px]" aria-hidden="true">
                                    edit
                                </span>

                                Ubah
                            </a>

                            <form
                                method="POST"
                                action="{{ route('admin.news.destroy', $news) }}"
                                class="flex-1"
                                onsubmit="return confirm('Hapus berita ini?');"
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
                        <span class="material-symbols-outlined text-4xl text-outline/50" aria-hidden="true">
                            article
                        </span>

                        <p class="mt-2 text-sm font-semibold">
                            Belum ada berita
                        </p>

                        <p class="mt-1 text-xs text-on-surface-variant">
                            Tidak ada berita yang sesuai dengan filter saat ini.
                        </p>
                    </div>
                @endforelse
            </div>
        </section>

        @if ($newsList->hasPages())
            <div>
                {{ $newsList->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>