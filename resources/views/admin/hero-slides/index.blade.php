<x-layouts.admin title="Banner Utama">
    <div class="space-y-5">
        <section class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary/65">
                    Beranda
                </p>

                <h2 class="mt-1 text-xl font-bold tracking-tight text-on-surface">
                    Kelola Banner Utama
                </h2>

                <p class="mt-1 text-sm text-on-surface-variant">
                    Atur gambar utama yang ditampilkan pada bagian atas beranda portal BB Pustaka.
                </p>
            </div>

            <a
                href="{{ route('admin.hero-slides.create') }}"
                class="inline-flex h-11 shrink-0 items-center justify-center gap-2 rounded-xl bg-primary px-4 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-container"
            >
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                    add
                </span>

                <span>Tambah Banner</span>
            </a>
        </section>

        @if (session('error'))
            <div
                class="flex items-start gap-3 rounded-xl border border-error/20 bg-error-container/35 px-4 py-3 text-sm text-error"
                role="alert"
            >
                <span class="material-symbols-outlined mt-px text-[20px]" aria-hidden="true">
                    error
                </span>

                <span>{{ session('error') }}</span>
            </div>
        @endif

        <section class="grid gap-4 sm:grid-cols-2">
            <div class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">
                            Banner Tersimpan
                        </p>

                        <p class="mt-2 text-3xl font-bold tracking-tight text-on-surface">
                            {{ $heroSlides->count() }}
                        </p>
                    </div>

                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[23px]" aria-hidden="true">
                            photo_library
                        </span>
                    </span>
                </div>

                <p class="mt-3 text-xs leading-5 text-on-surface-variant">
                    Banner nonaktif tetap disimpan dan dapat digunakan kembali.
                </p>
            </div>

            <div class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">
                            Banner Aktif
                        </p>

                        <p class="mt-2 text-3xl font-bold tracking-tight text-on-surface">
                            {{ $activeCount }}
                            <span class="text-base font-semibold text-on-surface-variant">
                                / {{ $maxActiveSlides }}
                            </span>
                        </p>
                    </div>

                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-secondary/30 text-on-secondary-container">
                        <span class="material-symbols-outlined text-[23px]" aria-hidden="true">
                            visibility
                        </span>
                    </span>
                </div>

                <p class="mt-3 text-xs leading-5 text-on-surface-variant">
                    Maksimal {{ $maxActiveSlides }} banner tampil secara bersamaan di beranda.
                </p>
            </div>
        </section>

        <section class="rounded-2xl border border-outline-variant/25 bg-white p-4">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <div class="flex items-center gap-2">
                        <span
                            class="material-symbols-outlined text-[20px] text-primary"
                            aria-hidden="true"
                        >
                            bolt
                        </span>

                        <h3 class="text-sm font-bold text-on-surface">
                            Aksi Cepat
                        </h3>
                    </div>

                    <p class="mt-1 text-xs leading-5 text-on-surface-variant">
                        Aktifkan maksimal 5 banner berdasarkan urutan teratas atau nonaktifkan seluruh banner sekaligus.
                    </p>
                </div>

                <div class="flex flex-col gap-2 sm:flex-row">
                    <form
                        method="POST"
                        action="{{ route('admin.hero-slides.activate-top') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            @disabled($heroSlides->isEmpty())
                            class="inline-flex h-10 w-full items-center justify-center gap-2 rounded-xl border border-primary/25 px-3.5 text-xs font-semibold text-primary transition hover:bg-primary/5 disabled:cursor-not-allowed disabled:opacity-40 sm:w-auto"
                        >
                            <span
                                class="material-symbols-outlined text-[18px]"
                                aria-hidden="true"
                            >
                                vertical_align_top
                            </span>

                            Tampilkan 5 Teratas
                        </button>
                    </form>

                    <form
                        method="POST"
                        action="{{ route('admin.hero-slides.deactivate-all') }}"
                        onsubmit="return confirm('Nonaktifkan semua banner utama? Beranda akan menggunakan gambar bawaan sampai banner diaktifkan kembali.');"
                    >
                        @csrf

                        <button
                            type="submit"
                            @disabled($activeCount === 0)
                            class="inline-flex h-10 w-full items-center justify-center gap-2 rounded-xl border border-outline-variant/50 px-3.5 text-xs font-semibold text-on-surface-variant transition hover:bg-surface-container-low disabled:cursor-not-allowed disabled:opacity-40 sm:w-auto"
                        >
                            <span
                                class="material-symbols-outlined text-[18px]"
                                aria-hidden="true"
                            >
                                visibility_off
                            </span>

                            Nonaktifkan Semua
                        </button>
                    </form>
                </div>
            </div>
        </section>

        @if ($activeCount >= $maxActiveSlides)
            <div class="flex items-start gap-3 rounded-xl border border-secondary/40 bg-secondary/10 px-4 py-3">
                <span
                    class="material-symbols-outlined mt-px text-[20px] text-on-secondary-container"
                    aria-hidden="true"
                >
                    info
                </span>

                <p class="text-xs leading-5 text-on-surface-variant">
                    Kapasitas banner aktif sudah penuh. Nonaktifkan salah satu banner jika ingin mengaktifkan banner lain, atau gunakan
                    <span class="font-semibold">Tampilkan 5 Teratas</span>
                    untuk memilih otomatis berdasarkan urutan.
                </p>
            </div>
        @endif

        <section class="overflow-hidden rounded-2xl border border-outline-variant/25 bg-white">
            <div class="flex items-center justify-between border-b border-outline-variant/20 px-5 py-4">
                <div>
                    <h3 class="text-sm font-bold text-on-surface">
                        Daftar Banner
                    </h3>

                    <p class="mt-0.5 text-xs text-on-surface-variant">
                        Urutan lebih kecil akan ditampilkan lebih dahulu.
                    </p>
                </div>

                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                        imagesmode
                    </span>
                </span>
            </div>

            <div class="hidden overflow-x-auto md:block">
                <table class="w-full min-w-[820px] text-sm">
                    <thead class="bg-surface-container-low/70 text-left">
                        <tr class="text-xs uppercase tracking-[0.05em] text-on-surface-variant">
                            <th class="px-5 py-3.5 font-semibold">Preview</th>
                            <th class="px-5 py-3.5 font-semibold">Urutan</th>
                            <th class="px-5 py-3.5 font-semibold">Status</th>
                            <th class="px-5 py-3.5 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-outline-variant/15">
                        @forelse ($heroSlides as $slide)
                            <tr class="transition-colors hover:bg-surface-container-low/45">
                                <td class="px-5 py-4">
                                    <div class="w-48 overflow-hidden rounded-xl border border-outline-variant/25 bg-surface-container-low">
                                        <img
                                            src="{{ $slide->image_path }}"
                                            alt="Preview banner utama urutan {{ $slide->order }}"
                                            class="aspect-video w-full object-cover"
                                        >
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="inline-flex min-w-9 items-center justify-center rounded-lg bg-surface-container-low px-2.5 py-1.5 text-sm font-bold text-on-surface">
                                        {{ $slide->order }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    @if ($slide->is_active)
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 px-2.5 py-1 text-xs font-semibold text-primary">
                                            <span
                                                class="h-1.5 w-1.5 rounded-full bg-primary"
                                                aria-hidden="true"
                                            ></span>

                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">
                                            <span
                                                class="h-1.5 w-1.5 rounded-full bg-outline"
                                                aria-hidden="true"
                                            ></span>

                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <form
                                            method="POST"
                                            action="{{ route('admin.hero-slides.toggle-active', $slide) }}"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg transition {{ $slide->is_active ? 'text-on-surface-variant hover:bg-surface-container' : 'text-primary hover:bg-primary/10' }}"
                                                aria-label="{{ $slide->is_active ? 'Nonaktifkan' : 'Aktifkan' }} banner urutan {{ $slide->order }}"
                                                title="{{ $slide->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                            >
                                                <span
                                                    class="material-symbols-outlined text-[20px]"
                                                    aria-hidden="true"
                                                >
                                                    {{ $slide->is_active ? 'visibility_off' : 'visibility' }}
                                                </span>
                                            </button>
                                        </form>

                                        <a
                                            href="{{ route('admin.hero-slides.edit', $slide) }}"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg text-primary transition hover:bg-primary/10"
                                            aria-label="Ubah banner urutan {{ $slide->order }}"
                                            title="Ubah"
                                        >
                                            <span
                                                class="material-symbols-outlined text-[20px]"
                                                aria-hidden="true"
                                            >
                                                edit
                                            </span>
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.hero-slides.destroy', $slide) }}"
                                            onsubmit="return confirm('Hapus banner ini?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg text-error transition hover:bg-error-container/50"
                                                aria-label="Hapus banner urutan {{ $slide->order }}"
                                                title="Hapus"
                                            >
                                                <span
                                                    class="material-symbols-outlined text-[20px]"
                                                    aria-hidden="true"
                                                >
                                                    delete
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-14 text-center">
                                    <span
                                        class="material-symbols-outlined text-4xl text-outline/50"
                                        aria-hidden="true"
                                    >
                                        imagesmode
                                    </span>

                                    <p class="mt-2 text-sm font-semibold text-on-surface">
                                        Belum ada banner utama
                                    </p>

                                    <p class="mt-1 text-xs text-on-surface-variant">
                                        Beranda akan menggunakan gambar bawaan selama belum ada banner aktif.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="divide-y divide-outline-variant/15 md:hidden">
                @forelse ($heroSlides as $slide)
                    <article class="p-4">
                        <div class="overflow-hidden rounded-xl border border-outline-variant/25 bg-surface-container-low">
                            <img
                                src="{{ $slide->image_path }}"
                                alt="Preview banner utama urutan {{ $slide->order }}"
                                class="aspect-video w-full object-cover"
                            >
                        </div>

                        <div class="mt-3 flex items-center justify-between gap-3">
                            <div>
                                <p class="text-xs text-on-surface-variant">
                                    Urutan
                                </p>

                                <p class="mt-0.5 text-sm font-bold">
                                    {{ $slide->order }}
                                </p>
                            </div>

                            @if ($slide->is_active)
                                <span class="rounded-full bg-primary/10 px-2.5 py-1 text-xs font-semibold text-primary">
                                    Aktif
                                </span>
                            @else
                                <span class="rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">
                                    Nonaktif
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 grid grid-cols-3 gap-2">
                            <form
                                method="POST"
                                action="{{ route('admin.hero-slides.toggle-active', $slide) }}"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="inline-flex h-9 w-full items-center justify-center gap-1.5 rounded-lg border text-[11px] font-semibold transition {{ $slide->is_active ? 'border-outline-variant/50 text-on-surface-variant hover:bg-surface-container-low' : 'border-primary/20 text-primary hover:bg-primary/5' }}"
                                >
                                    <span
                                        class="material-symbols-outlined text-[17px]"
                                        aria-hidden="true"
                                    >
                                        {{ $slide->is_active ? 'visibility_off' : 'visibility' }}
                                    </span>

                                    {{ $slide->is_active ? 'Nonaktif' : 'Aktifkan' }}
                                </button>
                            </form>

                            <a
                                href="{{ route('admin.hero-slides.edit', $slide) }}"
                                class="inline-flex h-9 items-center justify-center gap-1.5 rounded-lg border border-primary/20 text-[11px] font-semibold text-primary transition hover:bg-primary/5"
                            >
                                <span
                                    class="material-symbols-outlined text-[17px]"
                                    aria-hidden="true"
                                >
                                    edit
                                </span>

                                Ubah
                            </a>

                            <form
                                method="POST"
                                action="{{ route('admin.hero-slides.destroy', $slide) }}"
                                onsubmit="return confirm('Hapus banner ini?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex h-9 w-full items-center justify-center gap-1.5 rounded-lg border border-error/20 text-[11px] font-semibold text-error transition hover:bg-error-container/40"
                                >
                                    <span
                                        class="material-symbols-outlined text-[17px]"
                                        aria-hidden="true"
                                    >
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
                            imagesmode
                        </span>

                        <p class="mt-2 text-sm font-semibold">
                            Belum ada banner utama
                        </p>

                        <p class="mt-1 text-xs text-on-surface-variant">
                            Tambahkan banner untuk mengatur tampilan utama beranda.
                        </p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</x-layouts.admin>