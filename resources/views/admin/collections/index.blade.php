<x-layouts.admin title="Koleksi">
    <div class="flex justify-between items-center mb-6">
        <p class="text-on-surface-variant">Kelola koleksi buku yang tampil di katalog publik.</p>
        <a href="{{ route('admin.collections.create') }}" class="px-5 h-11 bg-primary text-on-primary font-semibold rounded-lg hover:bg-primary-container transition-all inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-base" aria-hidden="true">add</span> Tambah Koleksi
        </a>
    </div>

    <div class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-x-auto">
        <table class="w-full text-sm min-w-[640px]">
            <thead class="bg-surface-container-low text-left">
                <tr>
                    <th class="p-4 font-bold">Judul</th>
                    <th class="p-4 font-bold">Kategori</th>
                    <th class="p-4 font-bold">Unggulan</th>
                    <th class="p-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($collections as $collection)
                    <tr class="border-t border-outline-variant/20">
                        <td class="p-4">{{ $collection->title }}</td>
                        <td class="p-4">{{ $collection->category->name }}</td>
                        <td class="p-4">
                            @if ($collection->is_featured)
                                <span class="px-2 py-1 rounded-full bg-secondary/20 text-on-secondary-container text-xs font-semibold">Ya</span>
                            @else
                                <span class="text-on-surface-variant text-xs">-</span>
                            @endif
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.collections.edit', $collection) }}" class="text-primary font-semibold hover:underline">Ubah</a>
                            <form method="POST" action="{{ route('admin.collections.destroy', $collection) }}" class="inline" onsubmit="return confirm('Hapus koleksi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-error font-semibold hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-4 text-center text-on-surface-variant">Belum ada koleksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $collections->links() }}</div>
</x-layouts.admin>