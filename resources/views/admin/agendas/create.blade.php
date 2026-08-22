<x-layouts.admin title="Tambah Agenda">
    <form
        method="POST"
        action="{{ route('admin.agendas.store') }}"
        enctype="multipart/form-data"
        class="space-y-5"
    >
        @csrf

        <section class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <a
                    href="{{ route('admin.agendas.index') }}"
                    class="inline-flex items-center gap-1 text-xs font-semibold text-primary hover:underline"
                >
                    <span
                        class="material-symbols-outlined text-[17px]"
                        aria-hidden="true"
                    >
                        arrow_back
                    </span>

                    Daftar Agenda
                </a>

                <h2 class="mt-2 text-xl font-bold tracking-tight text-on-surface">
                    Tambah Agenda Baru
                </h2>

                <p class="mt-1 text-sm text-on-surface-variant">
                    Lengkapi informasi kegiatan yang akan ditampilkan pada portal.
                </p>
            </div>

            <div class="flex gap-2">
                <a
                    href="{{ route('admin.agendas.index') }}"
                    class="inline-flex h-11 items-center justify-center rounded-xl border border-outline-variant/50 px-4 text-sm font-semibold transition hover:bg-surface-container-low"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-primary px-5 text-sm font-semibold text-white transition hover:bg-primary-container"
                >
                    <span
                        class="material-symbols-outlined text-[19px]"
                        aria-hidden="true"
                    >
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
                            Informasi Kegiatan
                        </h3>

                        <p class="mt-1 text-xs text-on-surface-variant">
                            Informasi utama mengenai agenda atau kegiatan.
                        </p>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label
                                for="title"
                                class="mb-1.5 block text-sm font-semibold"
                            >
                                Judul Kegiatan
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
                                <p class="mt-1.5 text-xs text-error">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="description"
                                class="mb-1.5 block text-sm font-semibold"
                            >
                                Deskripsi
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="7"
                                class="w-full resize-y rounded-xl border border-outline-variant/50 p-3.5 text-sm leading-6 outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-1.5 text-xs text-error">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl border border-outline-variant/25 bg-white p-5 sm:p-6">
                    <div class="mb-5">
                        <h3 class="text-sm font-bold">
                            Jadwal Pelaksanaan
                        </h3>

                        <p class="mt-1 text-xs text-on-surface-variant">
                            Tentukan waktu mulai dan selesai kegiatan.
                        </p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label
                                for="starts_at"
                                class="mb-1.5 block text-sm font-semibold"
                            >
                                Waktu Mulai
                            </label>

                            <input
                                id="starts_at"
                                name="starts_at"
                                type="datetime-local"
                                value="{{ old('starts_at') }}"
                                required
                                class="h-11 w-full rounded-xl border border-outline-variant/50 px-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                            >

                            @error('starts_at')
                                <p class="mt-1.5 text-xs text-error">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="ends_at"
                                class="mb-1.5 block text-sm font-semibold"
                            >
                                Waktu Selesai
                            </label>

                            <input
                                id="ends_at"
                                name="ends_at"
                                type="datetime-local"
                                value="{{ old('ends_at') }}"
                                class="h-11 w-full rounded-xl border border-outline-variant/50 px-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                            >

                            <p class="mt-1.5 text-xs text-on-surface-variant">
                                Opsional. Tidak boleh lebih awal dari waktu mulai.
                            </p>

                            @error('ends_at')
                                <p class="mt-1.5 text-xs text-error">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </section>
            </div>

            <aside class="space-y-5">
                <section
                    class="rounded-2xl border border-outline-variant/25 bg-white p-5"
                    x-data="{
                        open: false,
                        value: @js(old('category', '')),
                        categories: @js($categories->values()->all()),

                        get filteredCategories() {
                            const keyword = this.value
                                .trim()
                                .toLocaleLowerCase('id-ID');

                            if (!keyword) {
                                return this.categories;
                            }

                            return this.categories.filter((category) =>
                                category
                                    .toLocaleLowerCase('id-ID')
                                    .includes(keyword)
                            );
                        },

                        choose(category) {
                            this.value = category;
                            this.open = false;
                        }
                    }"
                    @click.outside="open = false"
                    @keydown.escape.window="open = false"
                >
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

                    <label
                        for="category"
                        class="mb-1.5 block text-sm font-semibold"
                    >
                        Kategori Kegiatan
                    </label>

                    <div class="relative">
                        <input
                            id="category"
                            name="category"
                            type="text"
                            x-model="value"
                            @focus="open = true"
                            @input="open = true"
                            placeholder="Cari atau ketik kategori baru..."
                            autocomplete="off"
                            class="h-11 w-full rounded-xl border border-outline-variant/50 px-3.5 pr-10 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                        >

                        <button
                            type="button"
                            @click="open = !open"
                            class="absolute right-1 top-1 flex h-9 w-9 items-center justify-center rounded-lg text-on-surface-variant transition hover:bg-surface-container-low"
                            aria-label="Tampilkan kategori"
                        >
                            <span
                                class="material-symbols-outlined text-[20px] transition-transform"
                                :class="open ? 'rotate-180' : ''"
                                aria-hidden="true"
                            >
                                expand_more
                            </span>
                        </button>

                        <div
                            x-show="open"
                            style="display: none;"
                            class="absolute left-0 right-0 z-40 mt-2 overflow-hidden rounded-xl border border-outline-variant/30 bg-white shadow-[0_12px_35px_rgba(25,28,27,0.14)]"
                        >
                            <div class="max-h-64 overflow-y-auto p-1.5">
                                <template
                                    x-for="category in filteredCategories"
                                    :key="category"
                                >
                                    <button
                                        type="button"
                                        @click="choose(category)"
                                        class="flex w-full items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-left text-sm text-on-surface transition hover:bg-surface-container-low"
                                    >
                                        <span
                                            class="min-w-0 truncate"
                                            x-text="category"
                                        ></span>

                                        <span
                                            x-show="value === category"
                                            class="material-symbols-outlined shrink-0 text-[18px] text-primary"
                                            aria-hidden="true"
                                        >
                                            check
                                        </span>
                                    </button>
                                </template>

                                <div
                                    x-show="filteredCategories.length === 0"
                                    class="px-3 py-4 text-center"
                                >
                                    <p class="text-xs font-semibold text-on-surface">
                                        Kategori baru
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-on-surface-variant">
                                        Nilai yang diketik akan disimpan sebagai kategori baru.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="mt-2 text-xs leading-5 text-on-surface-variant">
                        Pilih kategori yang sudah ada atau ketik kategori baru.
                    </p>

                    @error('category')
                        <p class="mt-1.5 text-xs text-error">
                            {{ $message }}
                        </p>
                    @enderror
                </section>

                <section class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                    <div class="mb-4 flex items-center gap-2">
                        <span
                            class="material-symbols-outlined text-[20px] text-primary"
                            aria-hidden="true"
                        >
                            location_on
                        </span>

                        <h3 class="text-sm font-bold">
                            Lokasi
                        </h3>
                    </div>

                    <label
                        for="location"
                        class="mb-1.5 block text-sm font-semibold"
                    >
                        Tempat Kegiatan
                    </label>

                    <input
                        id="location"
                        name="location"
                        type="text"
                        value="{{ old('location') }}"
                        placeholder="Contoh: Aula BB Pustaka"
                        class="h-11 w-full rounded-xl border border-outline-variant/50 px-3.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                    >

                    @error('location')
                        <p class="mt-1.5 text-xs text-error">
                            {{ $message }}
                        </p>
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
                            Gambar Agenda
                        </h3>
                    </div>

                    <input
                        id="image"
                        name="image"
                        type="file"
                        accept="image/*"
                        class="block w-full rounded-xl border border-outline-variant/50 bg-white p-2.5 text-xs text-on-surface-variant file:mr-3 file:rounded-lg file:border-0 file:bg-primary/10 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-primary"
                    >

                    <p class="mt-2 text-xs leading-5 text-on-surface-variant">
                        Format gambar dengan ukuran maksimal 2 MB.
                    </p>

                    @error('image')
                        <p class="mt-1.5 text-xs text-error">
                            {{ $message }}
                        </p>
                    @enderror
                </section>

                <section class="rounded-2xl border border-primary/10 bg-primary/5 p-4">
                    <div class="flex gap-3">
                        <span
                            class="material-symbols-outlined text-[20px] text-primary"
                            aria-hidden="true"
                        >
                            info
                        </span>

                        <p class="text-xs leading-5 text-on-surface-variant">
                            Status agenda ditentukan otomatis berdasarkan waktu mulai dan waktu selesai.
                        </p>
                    </div>
                </section>
            </aside>
        </div>

        <div class="flex justify-end gap-2 border-t border-outline-variant/20 pt-5">
            <a
                href="{{ route('admin.agendas.index') }}"
                class="inline-flex h-11 items-center justify-center rounded-xl border border-outline-variant/50 px-4 text-sm font-semibold transition hover:bg-surface-container-low"
            >
                Batal
            </a>

            <button
                type="submit"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-primary px-5 text-sm font-semibold text-white transition hover:bg-primary-container"
            >
                <span
                    class="material-symbols-outlined text-[19px]"
                    aria-hidden="true"
                >
                    save
                </span>

                Simpan Agenda
            </button>
        </div>
    </form>
</x-layouts.admin>