<x-layouts.admin title="Agenda">
    <div class="flex justify-between items-center mb-6">
        <p class="text-on-surface-variant">Kelola jadwal kegiatan &amp; acara.</p>
        <a href="{{ route('admin.agendas.create') }}" class="px-5 h-11 bg-primary text-on-primary font-semibold rounded-lg hover:bg-primary-container transition-all inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-base" aria-hidden="true">add</span> Tambah Agenda
        </a>
    </div>

    <<div class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-x-auto">
        <table class="w-full text-sm min-w-[640px]">
            <thead class="bg-surface-container-low text-left">
                <tr>
                    <th class="p-4 font-bold">Judul</th>
                    <th class="p-4 font-bold">Lokasi</th>
                    <th class="p-4 font-bold">Waktu Mulai</th>
                    <th class="p-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($agendas as $agenda)
                    <tr class="border-t border-outline-variant/20">
                        <td class="p-4">{{ $agenda->title }}</td>
                        <td class="p-4">{{ $agenda->location ?? '-' }}</td>
                        <td class="p-4">{{ $agenda->starts_at->translatedFormat('d M Y, H:i') }}</td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.agendas.edit', $agenda) }}" class="text-primary font-semibold hover:underline">Ubah</a>
                            <form method="POST" action="{{ route('admin.agendas.destroy', $agenda) }}" class="inline" onsubmit="return confirm('Hapus agenda ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-error font-semibold hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-4 text-center text-on-surface-variant">Belum ada agenda.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $agendas->links() }}</div>
</x-layouts.admin>