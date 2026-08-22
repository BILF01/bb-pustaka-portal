<x-layouts.admin title="Ubah Banner Utama">
    <form
        method="POST"
        action="{{ route('admin.hero-slides.update', $heroSlide) }}"
        enctype="multipart/form-data"
        class="space-y-5"
    >
        @csrf
        @method('PUT')

        <section class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <a
                    href="{{ route('admin.hero-slides.index') }}"
                    class="inline-flex items-center gap-1 text-xs font-semibold text-primary hover:underline"
                >
                    <span class="material-symbols-outlined text-[17px]" aria-hidden="true">
                        arrow_back
                    </span>

                    Daftar Banner
                </a>

                <h2 class="mt-2 text-xl font-bold tracking-tight text-on-surface">
                    Ubah Banner Utama
                </h2>

                <p class="mt-1 text-sm text-on-surface-variant">
                    Perbarui gambar, urutan, atau status banner.
                </p>
            </div>

            <div class="flex gap-2">
                <a
                    href="{{ route('admin.hero-slides.index') }}"
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

                    Perbarui
                </button>
            </div>
        </section>

        <div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_320px]">
            <section class="rounded-2xl border border-outline-variant/25 bg-white p-5 sm:p-6">
                <div class="mb-5">
                    <h3 class="text-sm font-bold">
                        Gambar Banner
                    </h3>

                    <p class="mt-1 text-xs text-on-surface-variant">
                        Preview banner yang saat ini tersimpan.
                    </p>
                </div>

                <div class="overflow-hidden rounded-2xl border border-outline-variant/25 bg-surface-container-low">
                    <img
                        src="{{ $heroSlide->image_path }}"
                        alt="Banner utama saat ini"
                        class="aspect-[16/7] w-full object-cover"
                    >
                </div>

                <div class="mt-5">
                    <label for="image" class="mb-1.5 block text-sm font-semibold">
                        Ganti Gambar
                    </label>

                    <input
                        id="image"
                        name="image"
                        type="file"
                        accept="image/*"
                        class="block w-full rounded-xl border border-outline-variant/50 bg-white p-2.5 text-sm text-on-surface-variant file:mr-3 file:rounded-lg file:border-0 file:bg-primary/10 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-primary"
                    >

                    <p class="mt-2 text-xs leading-5 text-on-surface-variant">
                        Kosongkan jika tidak ingin mengganti gambar. Ukuran maksimal 2 MB.
                    </p>

                    @error('image')
                        <p class="mt-1.5 text-xs text-error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </section>

            <aside class="space-y-5">
                <section class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                    <div class="mb-4 flex items-center gap-2">
                        <span
                            class="material-symbols-outlined text-[20px] text-primary"
                            aria-hidden="true"
                        >
                            reorder
                        </span>

                        <h3 class="text-sm font-bold">
                            Urutan Tampil
                        </h3>
                    </div>

                    <label for="order" class="mb-1.5 block text-sm font-semibold">
                        Posisi Tampil
                    </label>

                    <input
                        id="order"
                        name="order"
                        type="number"
                        min="1"
                        max="{{ $maxOrder }}"
                        value="{{ old('order', $heroSlide->order) }}"
                        class="h-11 w-full rounded-xl border border-outline-variant/50 px-3.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                    >

                    <div class="mt-2 flex items-center justify-between gap-3 text-xs text-on-surface-variant">
                        <span>Banner lain akan bergeser otomatis.</span>
                        <span class="shrink-0 font-semibold">
                            1–{{ $maxOrder }}
                        </span>
                    </div>

                    @error('order')
                        <p class="mt-1.5 text-xs text-error">
                            {{ $message }}
                        </p>
                    @enderror

                    @error('order')
                        <p class="mt-1.5 text-xs text-error">
                            {{ $message }}
                        </p>
                    @enderror
                </section>

                <section class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                    <div class="mb-4 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2">
                            <span
                                class="material-symbols-outlined text-[20px] text-primary"
                                aria-hidden="true"
                            >
                                visibility
                            </span>

                            <h3 class="text-sm font-bold">
                                Status
                            </h3>
                        </div>

                        <span class="text-xs font-semibold text-on-surface-variant">
                            {{ $activeCount }}/{{ $maxActiveSlides }} aktif
                        </span>
                    </div>

                    <label
                        class="flex items-start gap-3 rounded-xl border border-outline-variant/30 p-3.5 {{ $canActivate ? 'cursor-pointer transition hover:bg-surface-container-low' : 'cursor-not-allowed bg-surface-container-low/70' }}"
                    >
                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked(old('is_active', $heroSlide->is_active))
                            @disabled(! $canActivate)
                            class="mt-0.5 h-4 w-4 rounded border-outline text-primary focus:ring-primary disabled:cursor-not-allowed disabled:opacity-50"
                        >

                        <span>
                            <span class="block text-sm font-semibold">
                                Banner aktif
                            </span>

                            <span class="mt-1 block text-xs leading-5 text-on-surface-variant">
                                @if ($canActivate)
                                    Aktifkan untuk menampilkan banner pada beranda.
                                @else
                                    Maksimal {{ $maxActiveSlides }} banner aktif sudah tercapai. Nonaktifkan salah satu banner lain terlebih dahulu.
                                @endif
                            </span>
                        </span>
                    </label>

                    @error('is_active')
                        <p class="mt-2 text-xs text-error">
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
                            Banner nonaktif tetap tersimpan dan dapat diaktifkan kembali tanpa perlu mengunggah ulang gambar.
                        </p>
                    </div>
                </section>
            </aside>
        </div>

        <div class="flex justify-end gap-2 border-t border-outline-variant/20 pt-5">
            <a
                href="{{ route('admin.hero-slides.index') }}"
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

                Perbarui Banner
            </button>
        </div>
    </form>
</x-layouts.admin>