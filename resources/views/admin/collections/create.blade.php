<x-layouts.admin title="Tambah Koleksi">
    <form
        method="POST"
        action="{{ route('admin.collections.store') }}"
        enctype="multipart/form-data"
        class="space-y-5"
    >
        @csrf

        <section class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <a
                    href="{{ route('admin.collections.index') }}"
                    class="inline-flex items-center gap-1 text-xs font-semibold text-primary hover:underline"
                >
                    <span class="material-symbols-outlined text-[17px]" aria-hidden="true">
                        arrow_back
                    </span>

                    Daftar Koleksi
                </a>

                <h2 class="mt-2 text-xl font-bold tracking-tight text-on-surface">
                    Tambah Koleksi Baru
                </h2>

                <p class="mt-1 text-sm text-on-surface-variant">
                    Lengkapi informasi bibliografi dan akses koleksi.
                </p>
            </div>

            <div class="flex gap-2">
                <a
                    href="{{ route('admin.collections.index') }}"
                    class="inline-flex h-11 items-center justify-center rounded-xl border border-outline-variant/50 px-4 text-sm font-semibold transition hover:bg-surface-container-low"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-primary px-5 text-sm font-semibold text-white transition hover:bg-primary-container"
                >
                    <span class="material-symbols-outlined text-[19px]" aria-hidden="true">
                        save
                    </span>

                    Simpan
                </button>
            </div>
        </section>

        <div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_320px]">
            <div class="space-y-5">
                <section class="rounded-2xl border border-outline-variant/25 bg-white p-5 sm:p-6">
                    <div class="mb-5">
                        <h3 class="text-sm font-bold text-on-surface">
                            Informasi Utama
                        </h3>

                        <p class="mt-1 text-xs text-on-surface-variant">
                            Data utama yang digunakan untuk mengenali koleksi.
                        </p>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label
                                for="title"
                                class="mb-1.5 block text-sm font-semibold text-on-surface"
                            >
                                Judul Buku
                            </label>

                            <input
                                id="title"
                                name="title"
                                type="text"
                                value="{{ old('title') }}"
                                required
                                class="h-11 w-full rounded-xl border border-outline-variant/50 px-3.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                            >

                            @error('title')
                                <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label
                                    for="author"
                                    class="mb-1.5 block text-sm font-semibold"
                                >
                                    Penulis
                                </label>

                                <input
                                    id="author"
                                    name="author"
                                    type="text"
                                    value="{{ old('author') }}"
                                    class="h-11 w-full rounded-xl border border-outline-variant/50 px-3.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                                >

                                @error('author')
                                    <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    for="publisher"
                                    class="mb-1.5 block text-sm font-semibold"
                                >
                                    Penerbit
                                </label>

                                <input
                                    id="publisher"
                                    name="publisher"
                                    type="text"
                                    value="{{ old('publisher') }}"
                                    class="h-11 w-full rounded-xl border border-outline-variant/50 px-3.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                                >

                                @error('publisher')
                                    <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-3">
                            <div>
                                <label
                                    for="published_year"
                                    class="mb-1.5 block text-sm font-semibold"
                                >
                                    Tahun Terbit
                                </label>

                                <input
                                    id="published_year"
                                    name="published_year"
                                    type="number"
                                    value="{{ old('published_year') }}"
                                    min="1900"
                                    max="{{ date('Y') + 1 }}"
                                    class="h-11 w-full rounded-xl border border-outline-variant/50 px-3.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                                >

                                @error('published_year')
                                    <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    for="isbn"
                                    class="mb-1.5 block text-sm font-semibold"
                                >
                                    ISBN
                                </label>

                                <input
                                    id="isbn"
                                    name="isbn"
                                    type="text"
                                    value="{{ old('isbn') }}"
                                    class="h-11 w-full rounded-xl border border-outline-variant/50 px-3.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                                >

                                @error('isbn')
                                    <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    for="page_count"
                                    class="mb-1.5 block text-sm font-semibold"
                                >
                                    Tebal Buku
                                </label>

                                <input
                                    id="page_count"
                                    name="page_count"
                                    type="text"
                                    value="{{ old('page_count') }}"
                                    placeholder="94 halaman"
                                    class="h-11 w-full rounded-xl border border-outline-variant/50 px-3.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                                >

                                @error('page_count')
                                    <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl border border-outline-variant/25 bg-white p-5 sm:p-6">
                    <div class="mb-5">
                        <h3 class="text-sm font-bold">
                            Akses & Deskripsi
                        </h3>

                        <p class="mt-1 text-xs text-on-surface-variant">
                            Informasi tambahan yang tampil pada detail koleksi.
                        </p>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label
                                for="access_link"
                                class="mb-1.5 block text-sm font-semibold"
                            >
                                Tautan Akses Repository
                            </label>

                            <div class="relative">
                                <span
                                    class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[19px] text-on-surface-variant/55"
                                    aria-hidden="true"
                                >
                                    link
                                </span>

                                <input
                                    id="access_link"
                                    name="access_link"
                                    type="url"
                                    value="{{ old('access_link') }}"
                                    placeholder="https://repository.pertanian.go.id/..."
                                    class="h-11 w-full rounded-xl border border-outline-variant/50 pl-10 pr-3.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                                >
                            </div>

                            @error('access_link')
                                <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="synopsis"
                                class="mb-1.5 block text-sm font-semibold"
                            >
                                Sinopsis
                            </label>

                            <textarea
                                id="synopsis"
                                name="synopsis"
                                rows="7"
                                class="w-full resize-y rounded-xl border border-outline-variant/50 p-3.5 text-sm leading-6 outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                            >{{ old('synopsis') }}</textarea>

                            @error('synopsis')
                                <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>
            </div>

            <aside class="space-y-5">
                <section class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                    <div class="mb-4 flex items-center gap-2">
                        <span
                            class="material-symbols-outlined text-[20px] text-primary"
                            aria-hidden="true"
                        >
                            category
                        </span>

                        <h3 class="text-sm font-bold">
                            Kategori
                        </h3>
                    </div>

                    <select
                        id="collection_category_id"
                        name="collection_category_id"
                        required
                        class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white px-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                    >
                        <option value="">Pilih kategori</option>

                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                @selected(old('collection_category_id') == $category->id)
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('collection_category_id')
                        <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                    @enderror
                </section>

                <section class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                    <div class="mb-4 flex items-center gap-2">
                        <span
                            class="material-symbols-outlined text-[20px] text-primary"
                            aria-hidden="true"
                        >
                            image
                        </span>

                        <h3 class="text-sm font-bold">
                            Sampul Buku
                        </h3>
                    </div>

                    <input
                        id="cover"
                        name="cover"
                        type="file"
                        accept="image/*"
                        class="block w-full rounded-xl border border-outline-variant/50 bg-white p-2.5 text-xs text-on-surface-variant file:mr-3 file:rounded-lg file:border-0 file:bg-primary/10 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-primary"
                    >

                    <p class="mt-2 text-xs leading-5 text-on-surface-variant">
                        Format gambar dengan ukuran maksimal 2 MB.
                    </p>

                    @error('cover')
                        <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                    @enderror
                </section>

                <section class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                    <div class="mb-4 flex items-center gap-2">
                        <span
                            class="material-symbols-outlined text-[20px] text-on-secondary-container"
                            aria-hidden="true"
                        >
                            star
                        </span>

                        <h3 class="text-sm font-bold">
                            Koleksi Unggulan
                        </h3>
                    </div>

                    <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-outline-variant/30 p-3.5 transition hover:bg-surface-container-low">
                        <input
                            type="checkbox"
                            name="is_featured"
                            value="1"
                            @checked(old('is_featured'))
                            class="mt-0.5 h-4 w-4 rounded border-outline text-primary focus:ring-primary"
                        >

                        <span>
                            <span class="block text-sm font-semibold">
                                Tampilkan sebagai unggulan
                            </span>

                            <span class="mt-1 block text-xs leading-5 text-on-surface-variant">
                                Koleksi akan mendapat penanda unggulan pada portal.
                            </span>
                        </span>
                    </label>
                </section>
            </aside>
        </div>

        <div class="flex justify-end gap-2 border-t border-outline-variant/20 pt-5">
            <a
                href="{{ route('admin.collections.index') }}"
                class="inline-flex h-11 items-center justify-center rounded-xl border border-outline-variant/50 px-4 text-sm font-semibold transition hover:bg-surface-container-low"
            >
                Batal
            </a>

            <button
                type="submit"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-primary px-5 text-sm font-semibold text-white transition hover:bg-primary-container"
            >
                <span class="material-symbols-outlined text-[19px]" aria-hidden="true">
                    save
                </span>

                Simpan Koleksi
            </button>
        </div>
    </form>
</x-layouts.admin>