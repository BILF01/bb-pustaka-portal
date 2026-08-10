<x-layouts.admin title="Reservasi Kunjungan">
    <p class="text-on-surface-variant mb-6">Kelola pengajuan reservasi kunjungan yang masuk dari publik.</p>

    <div class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-surface-container-low text-left">
                <tr>
                    <th class="p-4 font-bold">Nama</th>
                    <th class="p-4 font-bold">Tujuan</th>
                    <th class="p-4 font-bold">Tanggal</th>
                    <th class="p-4 font-bold">Jumlah</th>
                    <th class="p-4 font-bold">Status</th>
                    <th class="p-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    <tr class="border-t border-outline-variant/20">
                        <td class="p-4">
                            {{ $reservation->full_name }}
                            @if ($reservation->institution)
                                <span class="block text-xs text-on-surface-variant">{{ $reservation->institution }}</span>
                            @endif
                        </td>
                        <td class="p-4">{{ $reservation->purposeLabel() }}</td>
                        <td class="p-4">{{ $reservation->visit_date->translatedFormat('d M Y') }}</td>
                        <td class="p-4">{{ $reservation->person_count }} orang</td>
                        <td class="p-4">
                            <span @class([
                                'px-2 py-1 rounded-full text-xs font-semibold',
                                'bg-surface-container text-on-surface-variant' => $reservation->status === 'pending',
                                'bg-primary/10 text-primary' => $reservation->status === 'confirmed',
                                'bg-error-container text-on-error-container' => $reservation->status === 'rejected',
                                'bg-secondary/20 text-on-secondary-container' => $reservation->status === 'completed',
                            ])>
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <details class="inline-block text-left">
                                <summary class="cursor-pointer text-primary font-semibold hover:underline">Ubah Status</summary>
                                <form method="POST" action="{{ route('admin.reservations.update-status', $reservation) }}" class="mt-2 p-3 bg-surface-container-low rounded-lg space-y-2 w-56">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="w-full p-2 text-xs border border-outline-variant rounded">
                                        <option value="pending" @selected($reservation->status === 'pending')>Pending</option>
                                        <option value="confirmed" @selected($reservation->status === 'confirmed')>Confirmed</option>
                                        <option value="rejected" @selected($reservation->status === 'rejected')>Rejected</option>
                                        <option value="completed" @selected($reservation->status === 'completed')>Completed</option>
                                    </select>
                                    <textarea name="admin_note" rows="2" placeholder="Catatan (opsional)" class="w-full p-2 text-xs border border-outline-variant rounded">{{ $reservation->admin_note }}</textarea>
                                    <button type="submit" class="w-full py-2 bg-primary text-on-primary text-xs font-bold rounded">Simpan</button>
                                </form>
                            </details>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-4 text-center text-on-surface-variant">Belum ada reservasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $reservations->links() }}</div>
</x-layouts.admin>