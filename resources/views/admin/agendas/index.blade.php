<x-layouts.admin title="Agenda">
    <div class="space-y-5">
        <section class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary/65">
                    Kegiatan
                </p>

                <h2 class="mt-1 text-xl font-bold tracking-tight text-on-surface">
                    Kelola Agenda
                </h2>

                <p class="mt-1 text-sm text-on-surface-variant">
                    Kelola jadwal kegiatan dan acara yang ditampilkan pada portal BB Pustaka.
                </p>
            </div>

            <a
                href="{{ route('admin.agendas.create') }}"
                class="inline-flex h-11 shrink-0 items-center justify-center gap-2 rounded-xl bg-primary px-4 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-container"
            >
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                    add
                </span>

                <span>Tambah Agenda</span>
            </a>
        </section>

        <form
            method="GET"
            action="{{ route('admin.agendas.index') }}"
            class="rounded-2xl border border-outline-variant/25 bg-white p-4"
        >
            <div class="grid gap-3 lg:grid-cols-[minmax(240px,1fr)_210px_190px_auto]">
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
                        placeholder="Cari agenda, lokasi, kategori..."
                        class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white pl-10 pr-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                    >
                </div>

                <div
                    class="relative"
                    x-data="{
                        open: false,
                        search: '',
                        selected: @js(request('category', '')),
                        categories: @js($categories->values()->all()),

                        get filteredCategories() {
                            const keyword = this.search.trim().toLocaleLowerCase('id-ID');

                            if (!keyword) {
                                return this.categories;
                            }

                            return this.categories.filter((category) =>
                                category.toLocaleLowerCase('id-ID').includes(keyword)
                            );
                        },

                        choose(category) {
                            this.selected = category;
                            this.search = '';
                            this.open = false;
                        }
                    }"
                    @click.outside="open = false"
                    @keydown.escape.window="open = false"
                >
                    <input
                        type="hidden"
                        name="category"
                        :value="selected"
                    >

                    <button
                        type="button"
                        @click="
                            open = !open;

                            if (open) {
                                $nextTick(() => $refs.categorySearch.focus());
                            }
                        "
                        class="flex h-11 w-full items-center justify-between gap-2 rounded-xl border border-outline-variant/50 bg-white px-3 text-left text-sm outline-none transition hover:border-primary/50 focus:border-primary focus:ring-2 focus:ring-primary/10"
                        role="combobox"
                        :aria-expanded="open.toString()"
                    >
                        <span
                            class="min-w-0 truncate"
                            :class="selected ? 'text-on-surface' : 'text-on-surface-variant'"
                            x-text="selected || 'Semua kategori'"
                        ></span>

                        <span
                            class="material-symbols-outlined shrink-0 text-[20px] text-on-surface-variant transition-transform"
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
                        <div class="border-b border-outline-variant/20 p-2.5">
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[18px] text-on-surface-variant/55"
                                    aria-hidden="true"
                                >
                                    search
                                </span>

                                <input
                                    x-ref="categorySearch"
                                    x-model="search"
                                    type="search"
                                    placeholder="Cari kategori..."
                                    autocomplete="off"
                                    class="h-10 w-full rounded-lg border border-outline-variant/40 bg-surface-container-low/40 pl-9 pr-3 text-sm outline-none transition focus:border-primary focus:bg-white focus:ring-2 focus:ring-primary/10"
                                >
                            </div>
                        </div>

                        <div class="max-h-64 overflow-y-auto p-1.5">
                            <button
                                type="button"
                                @click="choose('')"
                                class="flex w-full items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-left text-sm transition hover:bg-surface-container-low"
                                :class="selected === '' ? 'font-semibold text-primary' : 'text-on-surface'"
                            >
                                <span>Semua kategori</span>

                                <span
                                    x-show="selected === ''"
                                    class="material-symbols-outlined text-[18px]"
                                    aria-hidden="true"
                                >
                                    check
                                </span>
                            </button>

                            <template x-for="category in filteredCategories" :key="category">
                                <button
                                    type="button"
                                    @click="choose(category)"
                                    class="flex w-full items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-left text-sm transition hover:bg-surface-container-low"
                                    :class="selected === category ? 'font-semibold text-primary' : 'text-on-surface'"
                                >
                                    <span
                                        class="min-w-0 truncate"
                                        x-text="category"
                                    ></span>

                                    <span
                                        x-show="selected === category"
                                        class="material-symbols-outlined shrink-0 text-[18px]"
                                        aria-hidden="true"
                                    >
                                        check
                                    </span>
                                </button>
                            </template>

                            <div
                                x-show="filteredCategories.length === 0"
                                class="px-3 py-5 text-center text-xs text-on-surface-variant"
                            >
                                Kategori tidak ditemukan.
                            </div>
                        </div>
                    </div>
                </div>

                <select
                    name="status"
                    class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white px-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                >
                    <option value="">Semua status</option>
                    <option value="upcoming" @selected(request('status') === 'upcoming')>
                        Akan Dimulai
                    </option>
                    <option value="ongoing" @selected(request('status') === 'ongoing')>
                        Sedang Berlangsung
                    </option>
                    <option value="completed" @selected(request('status') === 'completed')>
                        Telah Selesai
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
                            href="{{ route('admin.agendas.index') }}"
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
                        Daftar Agenda
                    </h3>

                    <p class="mt-0.5 text-xs text-on-surface-variant">
                        {{ $agendas->total() }} agenda ditemukan
                    </p>
                </div>

                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                        calendar_month
                    </span>
                </span>
            </div>

            <div class="hidden overflow-x-auto md:block">
                <table class="w-full min-w-[960px] text-sm">
                    <thead class="bg-surface-container-low/70 text-left">
                        <tr class="text-xs uppercase tracking-[0.05em] text-on-surface-variant">
                            <th class="px-5 py-3.5 font-semibold">Agenda</th>
                            <th class="px-5 py-3.5 font-semibold">Kategori</th>
                            <th class="px-5 py-3.5 font-semibold">Lokasi</th>
                            <th class="px-5 py-3.5 font-semibold">Waktu</th>
                            <th class="px-5 py-3.5 font-semibold">Status</th>
                            <th class="px-5 py-3.5 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-outline-variant/15">
                        @forelse ($agendas as $agenda)
                            <tr class="transition-colors hover:bg-surface-container-low/45">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-14 w-20 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-outline-variant/25 bg-surface-container-low">
                                            @if ($agenda->image_path)
                                                <img
                                                    src="{{ $agenda->image_path }}"
                                                    alt=""
                                                    class="h-full w-full object-cover"
                                                >
                                            @else
                                                <span
                                                    class="material-symbols-outlined text-[22px] text-outline/55"
                                                    aria-hidden="true"
                                                >
                                                    event
                                                </span>
                                            @endif
                                        </div>

                                        <div class="min-w-0 max-w-md">
                                            <p class="font-semibold leading-5 text-on-surface">
                                                {{ $agenda->title }}
                                            </p>

                                            @if ($agenda->description)
                                                <p class="mt-1 line-clamp-1 text-xs text-on-surface-variant">
                                                    {{ $agenda->description }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-4 text-on-surface-variant">
                                    {{ $agenda->category ?: '-' }}
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex max-w-[200px] items-start gap-1.5 text-on-surface-variant">
                                        <span
                                            class="material-symbols-outlined mt-px text-[17px] text-outline"
                                            aria-hidden="true"
                                        >
                                            location_on
                                        </span>

                                        <span class="leading-5">
                                            {{ $agenda->location ?: '-' }}
                                        </span>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-on-surface-variant">
                                    <p>
                                        {{ $agenda->starts_at->translatedFormat('d M Y') }}
                                    </p>

                                    <p class="mt-0.5 text-xs">
                                        {{ $agenda->starts_at->format('H:i') }}

                                        @if ($agenda->ends_at)
                                            – {{ $agenda->ends_at->format('H:i') }}
                                        @endif
                                    </p>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-semibold {{ $agenda->statusColor() }}">
                                        <span
                                            class="h-1.5 w-1.5 rounded-full bg-current"
                                            aria-hidden="true"
                                        ></span>

                                        {{ $agenda->status() }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a
                                            href="{{ route('admin.agendas.edit', $agenda) }}"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg text-primary transition hover:bg-primary/10"
                                            aria-label="Ubah {{ $agenda->title }}"
                                            title="Ubah"
                                        >
                                            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                                                edit
                                            </span>
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.agendas.destroy', $agenda) }}"
                                            onsubmit="return confirm('Hapus agenda ini?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="flex h-9 w-9 items-center justify-center rounded-lg text-error transition hover:bg-error-container/50"
                                                aria-label="Hapus {{ $agenda->title }}"
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
                                <td colspan="6" class="px-5 py-14 text-center">
                                    <span
                                        class="material-symbols-outlined text-4xl text-outline/50"
                                        aria-hidden="true"
                                    >
                                        event_busy
                                    </span>

                                    <p class="mt-2 text-sm font-semibold text-on-surface">
                                        Belum ada agenda
                                    </p>

                                    <p class="mt-1 text-xs text-on-surface-variant">
                                        Tidak ada agenda yang sesuai dengan data atau filter saat ini.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="divide-y divide-outline-variant/15 md:hidden">
                @forelse ($agendas as $agenda)
                    <article class="p-4">
                        @if ($agenda->image_path)
                            <div class="mb-3 overflow-hidden rounded-xl bg-surface-container-low">
                                <img
                                    src="{{ $agenda->image_path }}"
                                    alt=""
                                    class="aspect-[16/7] w-full object-cover"
                                >
                            </div>
                        @endif

                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-sm font-semibold leading-5 text-on-surface">
                                    {{ $agenda->title }}
                                </p>

                                <p class="mt-1 text-xs text-on-surface-variant">
                                    {{ $agenda->category ?: 'Tanpa kategori' }}
                                </p>
                            </div>

                            <span class="shrink-0 rounded-full px-2.5 py-1 text-[10px] font-semibold {{ $agenda->statusColor() }}">
                                {{ $agenda->status() }}
                            </span>
                        </div>

                        <div class="mt-3 space-y-1.5 text-xs text-on-surface-variant">
                            <p class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-[17px]" aria-hidden="true">
                                    schedule
                                </span>

                                <span>
                                    {{ $agenda->starts_at->translatedFormat('d M Y, H:i') }}

                                    @if ($agenda->ends_at)
                                        – {{ $agenda->ends_at->translatedFormat('d M Y, H:i') }}
                                    @endif
                                </span>
                            </p>

                            @if ($agenda->location)
                                <p class="flex items-start gap-2">
                                    <span class="material-symbols-outlined text-[17px]" aria-hidden="true">
                                        location_on
                                    </span>

                                    <span>{{ $agenda->location }}</span>
                                </p>
                            @endif
                        </div>

                        @if ($agenda->description)
                            <p class="mt-3 line-clamp-2 text-xs leading-5 text-on-surface-variant">
                                {{ $agenda->description }}
                            </p>
                        @endif

                        <div class="mt-4 flex gap-2">
                            <a
                                href="{{ route('admin.agendas.edit', $agenda) }}"
                                class="inline-flex h-9 flex-1 items-center justify-center gap-2 rounded-lg border border-primary/20 text-xs font-semibold text-primary transition hover:bg-primary/5"
                            >
                                <span class="material-symbols-outlined text-[18px]" aria-hidden="true">
                                    edit
                                </span>

                                Ubah
                            </a>

                            <form
                                method="POST"
                                action="{{ route('admin.agendas.destroy', $agenda) }}"
                                class="flex-1"
                                onsubmit="return confirm('Hapus agenda ini?');"
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
                            event_busy
                        </span>

                        <p class="mt-2 text-sm font-semibold">
                            Belum ada agenda
                        </p>

                        <p class="mt-1 text-xs text-on-surface-variant">
                            Tidak ada agenda yang sesuai dengan filter saat ini.
                        </p>
                    </div>
                @endforelse
            </div>
        </section>

        @if ($agendas->hasPages())
            <div>
                {{ $agendas->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>