<x-layouts.admin title="Pesan Masuk">
    <div class="flex items-end justify-between gap-4 mb-6">
        <div>
            <p class="text-on-surface-variant">Pesan yang dikirim pengunjung melalui halaman Kontak.</p>
        </div>
        @php($unread = \App\Models\ContactMessage::where('is_read', false)->count())
        @if ($unread)
            <span class="px-3 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold">{{ $unread }} belum dibaca</span>
        @endif
    </div>

    <div class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-x-auto">
        <table class="w-full text-sm min-w-[760px]">
            <thead class="bg-surface-container-low text-left">
                <tr>
                    <th class="p-4 font-bold">Status</th>
                    <th class="p-4 font-bold">Pengirim</th>
                    <th class="p-4 font-bold">Pesan</th>
                    <th class="p-4 font-bold">Tanggal</th>
                    <th class="p-4 font-bold"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $item)
                    <tr class="border-t border-outline-variant/20 {{ ! $item->is_read ? 'bg-primary/[0.03]' : '' }}">
                        <td class="p-4">
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold {{ $item->is_read ? 'bg-surface-container-low text-on-surface-variant' : 'bg-primary/10 text-primary' }}">
                                {{ $item->is_read ? 'Dibaca' : 'Baru' }}
                            </span>
                        </td>
                        <td class="p-4">
                            <p class="font-semibold {{ ! $item->is_read ? 'text-primary' : '' }}">{{ $item->name }}</p>
                            <p class="text-xs text-on-surface-variant mt-1">{{ $item->email }}</p>
                        </td>
                        <td class="p-4 max-w-sm"><p class="line-clamp-2">{{ $item->message }}</p></td>
                        <td class="p-4 whitespace-nowrap text-on-surface-variant">{{ $item->created_at->translatedFormat('d M Y, H:i') }}</td>
                        <td class="p-4 text-right">
                            <a href="{{ route('admin.contact-messages.show', $item) }}" class="inline-flex items-center gap-1 text-primary font-bold hover:underline">
                                Buka <span class="material-symbols-outlined text-base">chevron_right</span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-8 text-center text-on-surface-variant">Belum ada pesan masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $messages->links() }}</div>
</x-layouts.admin>