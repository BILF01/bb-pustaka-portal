<x-layouts.admin title="Detail Pesan">
    <div class="max-w-4xl">
        <a href="{{ route('admin.contact-messages.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-primary mb-5">
            <span class="material-symbols-outlined text-base">arrow_back</span> Kembali ke Pesan Masuk
        </a>

        <div class="bg-white rounded-2xl border border-outline-variant/30 shadow-[0_8px_28px_rgba(0,0,0,.06)] overflow-hidden">
            <div class="px-6 py-5 border-b border-outline-variant/20 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary">person</span>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-primary uppercase tracking-[.14em]">Pesan dari</span>
                        <h2 class="text-lg font-bold leading-tight mt-0.5">{{ $contactMessage->name }}</h2>
                        <a href="mailto:{{ $contactMessage->email }}" class="text-sm text-on-surface-variant hover:text-primary transition-colors">{{ $contactMessage->email }}</a>
                    </div>
                </div>

                <div class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-surface-container-low text-sm text-on-surface-variant shrink-0">
                    <span class="material-symbols-outlined text-base text-primary">schedule</span>
                    <span>{{ $contactMessage->created_at->translatedFormat('d M Y') }}, {{ $contactMessage->created_at->format('H:i') }} WIB</span>
                </div>
            </div>

            <div class="p-6">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-primary text-lg">chat</span>
                    <h3 class="text-sm font-bold text-primary">Isi Pesan</h3>
                </div>
                <div class="p-5 rounded-2xl bg-surface-container-low/70 border border-outline-variant/15 text-[15px] leading-7 whitespace-pre-line">{{ $contactMessage->message }}</div>
            </div>

            <div class="px-6 py-4 bg-surface-container-low/40 border-t border-outline-variant/20 flex flex-wrap items-center gap-3">
                <a href="mailto:{{ $contactMessage->email }}" class="inline-flex items-center gap-2 h-10 px-5 bg-primary text-on-primary rounded-xl font-bold text-sm hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined text-lg">reply</span> Balas via Email
                </a>
                <form method="POST" action="{{ route('admin.contact-messages.unread', $contactMessage) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="inline-flex items-center gap-2 h-10 px-5 bg-white border border-outline-variant/60 rounded-xl font-semibold text-sm hover:border-primary hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-lg">mark_email_unread</span> Tandai Belum Dibaca
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>