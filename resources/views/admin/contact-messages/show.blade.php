<x-layouts.admin title="Detail Pesan">
    @php
        $handlingClass = match ($contactMessage->handling_status) {
            'in_progress' => 'bg-primary/10 text-primary',
            'resolved' => 'bg-primary-container/20 text-primary',
            'archived' => 'bg-surface-container text-on-surface-variant',
            default => 'bg-secondary/30 text-on-secondary-container',
        };
    @endphp

    <div class="mx-auto max-w-6xl space-y-5">
        <section class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <a
                    href="{{ route('admin.contact-messages.index') }}"
                    class="inline-flex items-center gap-1 text-xs font-semibold text-primary hover:underline"
                >
                    <span
                        class="material-symbols-outlined text-[17px]"
                        aria-hidden="true"
                    >
                        arrow_back
                    </span>

                    Pesan Masuk
                </a>

                <h2 class="mt-2 text-xl font-bold tracking-tight text-on-surface">
                    Detail Pesan
                </h2>

                <p class="mt-1 text-sm text-on-surface-variant">
                    Kelola tindak lanjut dan riwayat komunikasi pengunjung.
                </p>
            </div>

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                <span class="inline-flex h-10 items-center justify-center rounded-xl px-3 text-xs font-semibold {{ $handlingClass }}">
                    {{ $contactMessage->handlingStatusLabel() }}
                </span>

                <form
                    method="POST"
                    action="{{ route('admin.contact-messages.status.update', $contactMessage) }}"
                    class="flex gap-2"
                >
                    @csrf
                    @method('PATCH')

                    <select
                        name="handling_status"
                        class="h-10 rounded-xl border border-outline-variant/50 bg-white px-3 text-xs font-semibold outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                    >
                        <option
                            value="pending"
                            @selected($contactMessage->handling_status === 'pending')
                        >
                            Belum Ditangani
                        </option>

                        <option
                            value="in_progress"
                            @selected($contactMessage->handling_status === 'in_progress')
                        >
                            Diproses
                        </option>

                        <option
                            value="resolved"
                            @selected($contactMessage->handling_status === 'resolved')
                        >
                            Selesai
                        </option>

                        <option
                            value="archived"
                            @selected($contactMessage->handling_status === 'archived')
                        >
                            Arsip
                        </option>
                    </select>

                    <button
                        type="submit"
                        class="inline-flex h-10 items-center justify-center rounded-xl bg-primary px-4 text-xs font-semibold text-on-primary transition hover:bg-primary-container"
                    >
                        Simpan Status
                    </button>
                </form>
            </div>
        </section>

        @if (session('error'))
            <div
                class="flex items-start gap-3 rounded-xl border border-error/20 bg-error-container/35 px-4 py-3 text-sm text-error"
                role="alert"
            >
                <span
                    class="material-symbols-outlined mt-px text-[20px]"
                    aria-hidden="true"
                >
                    error
                </span>

                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if (config('mail.default') === 'log')
            <div class="flex items-start gap-3 rounded-xl border border-secondary/40 bg-secondary/10 px-4 py-3">
                <span
                    class="material-symbols-outlined mt-px text-[20px] text-on-secondary-container"
                    aria-hidden="true"
                >
                    info
                </span>

                <div>
                    <p class="text-xs font-semibold text-on-surface">
                        Mode email pengujian
                    </p>

                    <p class="mt-1 text-xs leading-5 text-on-surface-variant">
                        Balasan disimpan ke histori dan log aplikasi, tetapi belum dikirim ke alamat email nyata.
                    </p>
                </div>
            </div>
        @endif

        <div class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_390px]">
            <div class="space-y-5">
                <section class="overflow-hidden rounded-2xl border border-outline-variant/25 bg-white">
                    <div class="border-b border-outline-variant/20 px-5 py-5 sm:px-6">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                                    <span
                                        class="material-symbols-outlined text-[22px]"
                                        aria-hidden="true"
                                    >
                                        person
                                    </span>
                                </div>

                                <div class="min-w-0">
                                    <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-primary/70">
                                        Pesan dari
                                    </p>

                                    <h3 class="mt-0.5 truncate text-lg font-bold leading-tight text-on-surface">
                                        {{ $contactMessage->name }}
                                    </h3>

                                    <p class="mt-1 truncate text-sm text-on-surface-variant">
                                        {{ $contactMessage->email }}
                                    </p>
                                </div>
                            </div>

                            <div class="inline-flex w-fit shrink-0 items-center gap-2 rounded-xl bg-surface-container-low px-3 py-2 text-xs text-on-surface-variant">
                                <span
                                    class="material-symbols-outlined text-[18px] text-primary"
                                    aria-hidden="true"
                                >
                                    schedule
                                </span>

                                <span>
                                    {{ $contactMessage->created_at->translatedFormat('d M Y') }},
                                    {{ $contactMessage->created_at->format('H:i') }} WIB
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6">
                        <div class="mb-3 flex items-center gap-2">
                            <span
                                class="material-symbols-outlined text-[19px] text-primary"
                                aria-hidden="true"
                            >
                                chat
                            </span>

                            <h3 class="text-sm font-bold text-on-surface">
                                Isi Pesan
                            </h3>
                        </div>

                        <div class="whitespace-pre-line rounded-2xl border border-outline-variant/15 bg-surface-container-low/60 p-5 text-[15px] leading-7 text-on-surface">{{ $contactMessage->message }}</div>
                    </div>

                    <div class="border-t border-outline-variant/20 bg-surface-container-low/30 px-5 py-4 sm:px-6">
                        <form
                            method="POST"
                            action="{{ route('admin.contact-messages.unread', $contactMessage) }}"
                        >
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="inline-flex h-10 items-center justify-center gap-2 rounded-xl border border-outline-variant/50 bg-white px-4 text-sm font-semibold text-on-surface-variant transition hover:border-primary/40 hover:text-primary"
                            >
                                <span
                                    class="material-symbols-outlined text-[18px]"
                                    aria-hidden="true"
                                >
                                    mark_email_unread
                                </span>

                                Tandai Belum Dibaca
                            </button>
                        </form>
                    </div>
                </section>

                <section class="overflow-hidden rounded-2xl border border-outline-variant/25 bg-white">
                    <div class="border-b border-outline-variant/20 px-5 py-4 sm:px-6">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-sm font-bold text-on-surface">
                                    Riwayat Balasan
                                </h3>

                                <p class="mt-0.5 text-xs text-on-surface-variant">
                                    {{ $contactMessage->replies->count() }} balasan tercatat
                                </p>
                            </div>

                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <span
                                    class="material-symbols-outlined text-[20px]"
                                    aria-hidden="true"
                                >
                                    history
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6">
                        @forelse ($contactMessage->replies as $reply)
                            @php
                                $deliveryClass = match ($reply->delivery_status) {
                                    'sent' => 'bg-primary/10 text-primary',
                                    'failed' => 'bg-error-container/40 text-error',
                                    'logged' => 'bg-secondary/30 text-on-secondary-container',
                                    default => 'bg-surface-container text-on-surface-variant',
                                };
                            @endphp

                            <article class="{{ ! $loop->first ? 'mt-5 border-t border-outline-variant/20 pt-5' : '' }}">
                                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                    <div class="min-w-0">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <p class="text-sm font-bold text-on-surface">
                                                Balasan Petugas
                                            </p>

                                            <span class="rounded-full px-2.5 py-1 text-[10px] font-semibold {{ $deliveryClass }}">
                                                {{ $reply->deliveryStatusLabel() }}
                                            </span>
                                        </div>

                                        <p class="mt-1 text-xs text-on-surface-variant">
                                            Kepada {{ $reply->recipient_email }}
                                        </p>
                                    </div>

                                    <span class="shrink-0 text-xs text-on-surface-variant">
                                        {{ $reply->created_at->translatedFormat('d M Y, H:i') }} WIB
                                    </span>
                                </div>

                                <div class="mt-4">
                                    <p class="text-xs font-semibold text-on-surface-variant">
                                        {{ $reply->subject }}
                                    </p>

                                    <div class="mt-2 whitespace-pre-line rounded-xl border border-outline-variant/15 bg-surface-container-low/60 p-4 text-sm leading-6 text-on-surface">{{ $reply->message }}</div>
                                </div>

                                @if ($reply->delivery_status === 'failed' && $reply->error_message)
                                    <div class="mt-3 rounded-xl bg-error-container/30 px-3 py-2 text-xs leading-5 text-error">
                                        Pengiriman gagal dan telah dicatat oleh sistem.
                                    </div>
                                @endif
                            </article>
                        @empty
                            <div class="py-6 text-center">
                                <span
                                    class="material-symbols-outlined text-4xl text-outline/40"
                                    aria-hidden="true"
                                >
                                    forum
                                </span>

                                <p class="mt-2 text-sm font-semibold text-on-surface">
                                    Belum ada balasan
                                </p>

                                <p class="mt-1 text-xs text-on-surface-variant">
                                    Balasan yang dikirim akan tercatat di bagian ini.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>

            <aside class="h-fit rounded-2xl border border-outline-variant/25 bg-white p-5 xl:sticky xl:top-5">
                <div class="mb-5 flex items-start gap-2">
                    <span
                        class="material-symbols-outlined mt-px text-[20px] text-primary"
                        aria-hidden="true"
                    >
                        reply
                    </span>

                    <div>
                        <h3 class="text-sm font-bold text-on-surface">
                            Balas Pesan
                        </h3>

                        <p class="mt-0.5 text-xs leading-5 text-on-surface-variant">
                            Balasan akan disimpan ke histori komunikasi.
                        </p>
                    </div>
                </div>

                <form
                    method="POST"
                    action="{{ route('admin.contact-messages.reply', $contactMessage) }}"
                    class="space-y-4"
                >
                    @csrf

                    <div>
                        <label
                            for="reply-to"
                            class="mb-1.5 block text-xs font-semibold text-on-surface"
                        >
                            Kepada
                        </label>

                        <input
                            id="reply-to"
                            type="email"
                            value="{{ $contactMessage->email }}"
                            readonly
                            class="h-11 w-full cursor-not-allowed rounded-xl border border-outline-variant/40 bg-surface-container-low px-3.5 text-sm text-on-surface-variant"
                        >
                    </div>

                    <div>
                        <label
                            for="subject"
                            class="mb-1.5 block text-xs font-semibold text-on-surface"
                        >
                            Subjek
                        </label>

                        <input
                            id="subject"
                            name="subject"
                            type="text"
                            maxlength="255"
                            required
                            value="{{ old('subject', 'Balasan BB Pustaka atas pesan Anda') }}"
                            class="h-11 w-full rounded-xl border border-outline-variant/50 px-3.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                        >

                        @error('subject')
                            <p class="mt-1.5 text-xs text-error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label
                            for="reply_message"
                            class="mb-1.5 block text-xs font-semibold text-on-surface"
                        >
                            Isi Balasan
                        </label>

                        <textarea
                            id="reply_message"
                            name="reply_message"
                            rows="10"
                            maxlength="5000"
                            required
                            placeholder="Tulis balasan untuk pengunjung..."
                            class="w-full resize-y rounded-xl border border-outline-variant/50 p-3.5 text-sm leading-6 outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                        >{{ old('reply_message') }}</textarea>

                        @error('reply_message')
                            <p class="mt-1.5 text-xs text-error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="inline-flex h-11 w-full items-center justify-center gap-2 rounded-xl bg-primary px-4 text-sm font-semibold text-on-primary transition hover:bg-primary-container"
                    >
                        <span
                            class="material-symbols-outlined text-[19px]"
                            aria-hidden="true"
                        >
                            send
                        </span>

                        Kirim Balasan
                    </button>
                </form>
            </aside>
        </div>

        @if ($contactMessage->read_at)
            <p class="text-right text-xs text-on-surface-variant/65">
                Terakhir dibaca
                {{ $contactMessage->read_at->translatedFormat('d M Y, H:i') }}
                WIB
            </p>
        @endif
    </div>
</x-layouts.admin>