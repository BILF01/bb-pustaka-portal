<x-layouts.admin title="Pesan Masuk">
    <div class="space-y-5">
        <section>
            <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary/65">
                Layanan Informasi
            </p>

            <h2 class="mt-1 text-xl font-bold tracking-tight text-on-surface">
                Pesan Masuk
            </h2>

            <p class="mt-1 text-sm text-on-surface-variant">
                Pantau pesan pengunjung dan status penanganannya dari satu tempat.
            </p>
        </section>

        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">
                            Total Pesan
                        </p>

                        <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                            {{ $totalMessages }}
                        </p>
                    </div>

                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                            inbox
                        </span>
                    </span>
                </div>

                <p class="mt-3 text-xs text-on-surface-variant/70">
                    {{ $unreadMessages }} pesan belum dibaca.
                </p>
            </div>

            <div class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">
                            Belum Ditangani
                        </p>

                        <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                            {{ $pendingMessages }}
                        </p>
                    </div>

                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-secondary/30 text-on-secondary-container">
                        <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                            pending_actions
                        </span>
                    </span>
                </div>

                <p class="mt-3 text-xs text-on-surface-variant/70">
                    Pesan yang masih menunggu tindak lanjut.
                </p>
            </div>

            <div class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">
                            Diproses
                        </p>

                        <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                            {{ $inProgressMessages }}
                        </p>
                    </div>

                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                            cycle
                        </span>
                    </span>
                </div>

                <p class="mt-3 text-xs text-on-surface-variant/70">
                    Pesan yang sedang ditindaklanjuti.
                </p>
            </div>

            <div class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">
                            Selesai
                        </p>

                        <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                            {{ $resolvedMessages }}
                        </p>
                    </div>

                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[22px]" aria-hidden="true">
                            task_alt
                        </span>
                    </span>
                </div>

                <p class="mt-3 text-xs text-on-surface-variant/70">
                    {{ $archivedMessages }} pesan berada di arsip.
                </p>
            </div>
        </section>

        <form
            method="GET"
            action="{{ route('admin.contact-messages.index') }}"
            class="rounded-2xl border border-outline-variant/25 bg-white p-4"
        >
            <div class="grid gap-3 xl:grid-cols-[minmax(260px,1fr)_180px_200px_auto]">
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
                        placeholder="Cari nama, email, atau isi pesan..."
                        class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white pl-10 pr-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                    >
                </div>

                <select
                    name="status"
                    class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white px-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                >
                    <option value="">Semua status baca</option>
                    <option value="unread" @selected(request('status') === 'unread')>
                        Belum dibaca
                    </option>
                    <option value="read" @selected(request('status') === 'read')>
                        Sudah dibaca
                    </option>
                </select>

                <select
                    name="handling_status"
                    class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white px-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                >
                    <option value="">Semua penanganan</option>
                    <option value="pending" @selected(request('handling_status') === 'pending')>
                        Belum Ditangani
                    </option>
                    <option value="in_progress" @selected(request('handling_status') === 'in_progress')>
                        Diproses
                    </option>
                    <option value="resolved" @selected(request('handling_status') === 'resolved')>
                        Selesai
                    </option>
                    <option value="archived" @selected(request('handling_status') === 'archived')>
                        Arsip
                    </option>
                </select>

                <div class="flex gap-2">
                    <button
                        type="submit"
                        class="inline-flex h-11 flex-1 items-center justify-center gap-2 rounded-xl bg-primary px-4 text-sm font-semibold text-on-primary transition hover:bg-primary-container xl:flex-none"
                    >
                        <span class="material-symbols-outlined text-[19px]" aria-hidden="true">
                            filter_alt
                        </span>

                        Terapkan
                    </button>

                    @if (
                        request()->filled('q') ||
                        request()->filled('status') ||
                        request()->filled('handling_status')
                    )
                        <a
                            href="{{ route('admin.contact-messages.index') }}"
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
                        Kotak Masuk
                    </h3>

                    <p class="mt-0.5 text-xs text-on-surface-variant">
                        {{ $messages->total() }} pesan ditemukan
                    </p>
                </div>

                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">
                        mail
                    </span>
                </span>
            </div>

            <div class="hidden md:block">
                <table class="w-full table-fixed text-sm">
                    <thead class="bg-surface-container-low/70 text-left">
                        <tr class="text-xs uppercase tracking-[0.05em] text-on-surface-variant">
                            <th class="w-[105px] px-4 py-3.5 font-semibold">
                                Status
                            </th>

                            <th class="w-[155px] px-4 py-3.5 font-semibold">
                                Penanganan
                            </th>

                            <th class="w-[205px] px-4 py-3.5 font-semibold">
                                Pengirim
                            </th>

                            <th class="px-4 py-3.5 font-semibold">
                                Pesan
                            </th>

                            <th class="w-[135px] px-4 py-3.5 font-semibold">
                                Tanggal
                            </th>

                            <th class="w-[48px] px-2 py-3.5"></th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-outline-variant/15">
                        @forelse ($messages as $item)
                            @php
                                $handlingClass = match ($item->handling_status) {
                                    'in_progress' => 'bg-primary/10 text-primary',
                                    'resolved' => 'bg-primary-container/20 text-primary',
                                    'archived' => 'bg-surface-container text-on-surface-variant',
                                    default => 'bg-secondary/30 text-on-secondary-container',
                                };

                                $handlingIcon = match ($item->handling_status) {
                                    'in_progress' => 'cycle',
                                    'resolved' => 'task_alt',
                                    'archived' => 'archive',
                                    default => 'pending_actions',
                                };

                                $detailUrl = route('admin.contact-messages.show', $item);
                            @endphp

                            <tr
                                role="link"
                                tabindex="0"
                                data-href="{{ $detailUrl }}"
                                onclick="window.location.href = this.dataset.href"
                                onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); window.location.href = this.dataset.href; }"
                                class="cursor-pointer transition-colors hover:bg-primary/[0.045] focus:bg-primary/[0.045] focus:outline-none {{ ! $item->is_read ? 'bg-primary/[0.025]' : '' }}"
                                aria-label="Buka pesan dari {{ $item->name }}"
                            >
                                <td class="px-4 py-4">
                                    @if ($item->is_read)
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-surface-container px-2.5 py-1 text-[11px] font-semibold text-on-surface-variant">
                                            <span
                                                class="h-1.5 w-1.5 rounded-full bg-outline"
                                                aria-hidden="true"
                                            ></span>

                                            Dibaca
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 px-2.5 py-1 text-[11px] font-semibold text-primary">
                                            <span
                                                class="h-1.5 w-1.5 rounded-full bg-primary"
                                                aria-hidden="true"
                                            ></span>

                                            Baru
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-4">
                                    <span class="inline-flex max-w-full items-center gap-1.5 rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $handlingClass }}">
                                        <span
                                            class="material-symbols-outlined shrink-0 text-[15px]"
                                            aria-hidden="true"
                                        >
                                            {{ $handlingIcon }}
                                        </span>

                                        <span class="truncate">
                                            {{ $item->handlingStatusLabel() }}
                                        </span>
                                    </span>
                                </td>

                                <td class="px-4 py-4">
                                    <div class="min-w-0">
                                        <p class="truncate font-semibold {{ ! $item->is_read ? 'text-primary' : 'text-on-surface' }}">
                                            {{ $item->name }}
                                        </p>

                                        <p class="mt-1 truncate text-xs text-on-surface-variant">
                                            {{ $item->email }}
                                        </p>
                                    </div>
                                </td>

                                <td class="px-4 py-4">
                                    <p class="line-clamp-2 leading-5 {{ ! $item->is_read ? 'font-medium text-on-surface' : 'text-on-surface-variant' }}">
                                        {{ $item->message }}
                                    </p>
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-on-surface-variant">
                                    <p class="text-xs">
                                        {{ $item->created_at->translatedFormat('d M Y') }}
                                    </p>

                                    <p class="mt-0.5 text-xs">
                                        {{ $item->created_at->format('H:i') }} WIB
                                    </p>
                                </td>

                                <td class="px-2 py-4 text-center">
                                    <span
                                        class="material-symbols-outlined text-[20px] text-primary transition-transform group-hover:translate-x-0.5"
                                        aria-hidden="true"
                                    >
                                        chevron_right
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-14 text-center">
                                    <span
                                        class="material-symbols-outlined text-4xl text-outline/50"
                                        aria-hidden="true"
                                    >
                                        inbox
                                    </span>

                                    <p class="mt-2 text-sm font-semibold text-on-surface">
                                        Tidak ada pesan
                                    </p>

                                    <p class="mt-1 text-xs text-on-surface-variant">
                                        Tidak ada pesan yang sesuai dengan filter saat ini.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="divide-y divide-outline-variant/15 md:hidden">
                @forelse ($messages as $item)
                    @php
                        $mobileHandlingClass = match ($item->handling_status) {
                            'in_progress' => 'bg-primary/10 text-primary',
                            'resolved' => 'bg-primary-container/20 text-primary',
                            'archived' => 'bg-surface-container text-on-surface-variant',
                            default => 'bg-secondary/30 text-on-secondary-container',
                        };

                        $detailUrl = route('admin.contact-messages.show', $item);
                    @endphp

                    <article
                        role="link"
                        tabindex="0"
                        data-href="{{ $detailUrl }}"
                        onclick="window.location.href = this.dataset.href"
                        onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); window.location.href = this.dataset.href; }"
                        class="cursor-pointer p-4 transition-colors hover:bg-primary/[0.04] focus:bg-primary/[0.04] focus:outline-none {{ ! $item->is_read ? 'bg-primary/[0.025]' : '' }}"
                        aria-label="Buka pesan dari {{ $item->name }}"
                    >
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-semibold {{ ! $item->is_read ? 'text-primary' : 'text-on-surface' }}">
                                    {{ $item->name }}
                                </p>

                                <p class="mt-0.5 truncate text-xs text-on-surface-variant">
                                    {{ $item->email }}
                                </p>
                            </div>

                            <span class="shrink-0 rounded-full px-2.5 py-1 text-[10px] font-semibold {{ $mobileHandlingClass }}">
                                {{ $item->handlingStatusLabel() }}
                            </span>
                        </div>

                        <div class="mt-3 flex items-center gap-2">
                            <span class="text-[10px] font-semibold {{ $item->is_read ? 'text-on-surface-variant' : 'text-primary' }}">
                                {{ $item->is_read ? 'Dibaca' : 'Pesan Baru' }}
                            </span>

                            <span class="text-outline-variant">
                                •
                            </span>

                            <span class="text-[10px] text-on-surface-variant">
                                {{ $item->created_at->translatedFormat('d M Y, H:i') }}
                            </span>
                        </div>

                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-on-surface-variant">
                            {{ $item->message }}
                        </p>

                        <div class="mt-4 flex items-center justify-end gap-1 text-xs font-semibold text-primary">
                            Buka Pesan

                            <span
                                class="material-symbols-outlined text-[17px]"
                                aria-hidden="true"
                            >
                                chevron_right
                            </span>
                        </div>
                    </article>
                @empty
                    <div class="px-5 py-12 text-center">
                        <span
                            class="material-symbols-outlined text-4xl text-outline/50"
                            aria-hidden="true"
                        >
                            inbox
                        </span>

                        <p class="mt-2 text-sm font-semibold">
                            Tidak ada pesan
                        </p>

                        <p class="mt-1 text-xs text-on-surface-variant">
                            Tidak ada pesan yang sesuai dengan filter saat ini.
                        </p>
                    </div>
                @endforelse
            </div>
        </section>

        @if ($messages->hasPages())
            <div>
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>