<x-layouts.admin title="Pengajuan Layanan">
    <p class="text-on-surface-variant mb-6">Kelola pengajuan layanan yang masuk dari publik.</p>

    <div class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-surface-container-low text-left">
                <tr>
                    <th class="p-4 font-bold">Pemohon</th>
                    <th class="p-4 font-bold">Jenis</th>
                    <th class="p-4 font-bold">Detail</th>
                    <th class="p-4 font-bold">Status</th>
                    <th class="p-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($requests as $item)
                    <tr class="border-t border-outline-variant/20">
                        <td class="p-4">
                            {{ $item->full_name }}
                            <span class="block text-xs text-on-surface-variant">{{ $item->email }}</span>
                        </td>
                        <td class="p-4">{{ $item->type->name }}</td>
                        <td class="p-4 max-w-xs truncate">{{ $item->description }}</td>
                        <td class="p-4">
                            <span @class([
                                'px-2 py-1 rounded-full text-xs font-semibold',
                                'bg-surface-container text-on-surface-variant' => $item->status === 'pending',
                                'bg-primary/10 text-primary' => $item->status === 'processed',
                                'bg-secondary/20 text-on-secondary-container' => $item->status === 'completed',
                                'bg-error-container text-on-error-container' => $item->status === 'rejected',
                            ])>
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <details class="inline-block text-left">
                                <summary class="cursor-pointer text-primary font-semibold hover:underline">Ubah Status</summary>
                                <form method="POST" action="{{ route('admin.service-requests.update-status', $item) }}" class="mt-2 p-3 bg-surface-container-low rounded-lg space-y-2 w-48">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="w-full p-2 text-xs border border-outline-variant rounded">
                                        <option value="pending" @selected($item->status === 'pending')>Pending</option>
                                        <option value="processed" @selected($item->status === 'processed')>Processed</option>
                                        <option value="completed" @selected($item->status === 'completed')>Completed</option>
                                        <option value="rejected" @selected($item->status === 'rejected')>Rejected</option>
                                    </select>
                                    <button type="submit" class="w-full py-2 bg-primary text-on-primary text-xs font-bold rounded">Simpan</button>
                                </form>
                            </details>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-4 text-center text-on-surface-variant">Belum ada pengajuan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $requests->links() }}</div>
</x-layouts.admin>