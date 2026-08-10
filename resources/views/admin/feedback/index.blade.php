<x-layouts.admin title="Umpan Balik">
    <p class="text-on-surface-variant mb-6">Umpan balik pengunjung terhadap portal.</p>

    <div class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-x-auto">
        <table class="w-full text-sm min-w-[640px]">
            <thead class="bg-surface-container-low text-left">
                <tr>
                    <th class="p-4 font-bold">Kepuasan</th>
                    <th class="p-4 font-bold">Info Ditemukan</th>
                    <th class="p-4 font-bold">Kritik & Saran</th>
                    <th class="p-4 font-bold">Fitur Diinginkan</th>
                    <th class="p-4 font-bold">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($feedbacks as $item)
                    <tr class="border-t border-outline-variant/20 align-top">
                        <td class="p-4 text-xl">{{ $item->satisfactionEmoji() }}</td>
                        <td class="p-4">{{ $item->found_information ? 'Ya' : 'Tidak' }}</td>
                        <td class="p-4 max-w-xs">{{ $item->message }}</td>
                        <td class="p-4 max-w-xs">{{ $item->desired_feature ?: '-' }}</td>
                        <td class="p-4 whitespace-nowrap">{{ $item->created_at->translatedFormat('d M Y, H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-4 text-center text-on-surface-variant">Belum ada umpan balik.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $feedbacks->links() }}</div>
</x-layouts.admin>