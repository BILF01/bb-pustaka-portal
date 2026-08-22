<x-layouts.admin title="Tambah Berita">
    <form
        method="POST"
        action="{{ route('admin.news.store') }}"
        enctype="multipart/form-data"
        class="space-y-5"
    >
        @csrf

        <section class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <a
                    href="{{ route('admin.news.index') }}"
                    class="inline-flex items-center gap-1 text-xs font-semibold text-primary hover:underline"
                >
                    <span class="material-symbols-outlined text-[17px]" aria-hidden="true">
                        arrow_back
                    </span>
                    Daftar Berita
                </a>

                <h2 class="mt-2 text-xl font-bold tracking-tight text-on-surface">
                    Tambah Berita Baru
                </h2>

                <p class="mt-1 text-sm text-on-surface-variant">
                    Lengkapi informasi artikel sebelum disimpan atau diterbitkan.
                </p>
            </div>

            <div class="flex gap-2">
                <a
                    href="{{ route('admin.news.index') }}"
                    class="inline-flex h-11 items-center justify-center rounded-xl border border-outline-variant/50 px-4 text-sm font-semibold text-on-surface transition hover:bg-surface-container-low"
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
                            Informasi Berita
                        </h3>

                        <p class="mt-1 text-xs text-on-surface-variant">
                            Informasi utama yang akan tampil pada halaman publik.
                        </p>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label for="title" class="mb-1.5 block text-sm font-semibold text-on-surface">
                                Judul Berita
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

                        <div>
                            <label for="excerpt" class="mb-1.5 block text-sm font-semibold text-on-surface">
                                Ringkasan
                            </label>

                            <textarea
                                id="excerpt"
                                name="excerpt"
                                rows="3"
                                required
                                class="w-full resize-y rounded-xl border border-outline-variant/50 p-3.5 text-sm leading-6 outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                            >{{ old('excerpt') }}</textarea>

                            @error('excerpt')
                                <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl border border-outline-variant/25 bg-white p-5 sm:p-6">
                    <div class="mb-4">
                        <h3 class="text-sm font-bold text-on-surface">
                            Isi Artikel
                        </h3>

                        <p class="mt-1 text-xs text-on-surface-variant">
                            Tulis isi berita dengan struktur artikel yang jelas.
                        </p>
                    </div>

                    <textarea
                        id="body"
                        name="body"
                        rows="20"
                        required
                        class="w-full resize-y rounded-xl border border-outline-variant/50 p-4 font-sans text-sm leading-7 outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                    >{{ old('body') }}</textarea>

                    <div class="mt-3 rounded-xl border border-primary/10 bg-primary/5 px-4 py-3 text-xs leading-5 text-on-surface-variant">
                        <span class="font-bold text-primary">Format artikel:</span>
                        gunakan <code class="font-semibold">## Subjudul</code> untuk bagian artikel,
                        <code class="font-semibold">&gt; Kutipan</code> untuk highlight, dan
                        <code class="font-semibold">- Item</code> untuk daftar. Pisahkan setiap bagian dengan satu baris kosong.
                    </div>

                    @error('body')
                        <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                    @enderror
                </section>
            </div>

            <aside class="space-y-5">
                <section class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                    <div class="mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px] text-primary" aria-hidden="true">
                            tune
                        </span>

                        <h3 class="text-sm font-bold text-on-surface">
                            Pengaturan
                        </h3>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label for="news_category_id" class="mb-1.5 block text-sm font-semibold text-on-surface">
                                Kategori
                            </label>

                            <select
                                id="news_category_id"
                                name="news_category_id"
                                required
                                class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white px-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                            >
                                <option value="">Pilih kategori</option>

                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @selected(old('news_category_id') == $category->id)
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('news_category_id')
                                <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="image" class="mb-1.5 block text-sm font-semibold text-on-surface">
                                Gambar Sampul
                            </label>

                            <input
                                id="image"
                                name="image"
                                type="file"
                                accept="image/*"
                                class="block w-full rounded-xl border border-outline-variant/50 bg-white p-2.5 text-xs text-on-surface-variant file:mr-3 file:rounded-lg file:border-0 file:bg-primary/10 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-primary"
                            >

                            <p class="mt-2 text-xs leading-5 text-on-surface-variant">
                                Pilih gambar yang akan digunakan sebagai sampul berita.
                            </p>

                            @error('image')
                                <p class="mt-1.5 text-xs text-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                    <div class="mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px] text-primary" aria-hidden="true">
                            visibility
                        </span>

                        <h3 class="text-sm font-bold text-on-surface">
                            Publikasi
                        </h3>
                    </div>

                    <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-outline-variant/30 p-3.5 transition hover:bg-surface-container-low">
                        <input
                            type="checkbox"
                            name="is_published"
                            value="1"
                            @checked(old('is_published'))
                            class="mt-0.5 h-4 w-4 rounded border-outline text-primary focus:ring-primary"
                        >

                        <span>
                            <span class="block text-sm font-semibold text-on-surface">
                                Terbitkan sekarang
                            </span>

                            <span class="mt-1 block text-xs leading-5 text-on-surface-variant">
                                Jika tidak dipilih, berita akan disimpan sebagai draf.
                            </span>
                        </span>
                    </label>
                </section>
            </aside>
        </div>

        <div class="flex justify-end gap-2 border-t border-outline-variant/20 pt-5">
            <a
                href="{{ route('admin.news.index') }}"
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

                Simpan Berita
            </button>
        </div>
    </form>
</x-layouts.admin>