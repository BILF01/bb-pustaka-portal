<x-layouts.admin title="Berita">
    <div class="flex justify-between items-center mb-6">
        <p class="text-on-surface-variant">Kelola berita &amp; artikel yang tampil di halaman publik.</p>
        <a href="{{ route('admin.news.create') }}" class="px-5 h-11 bg-primary text-on-primary font-semibold rounded-lg hover:bg-primary-container transition-all inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-base" aria-hidden="true">add</span> Tambah Berita
        </a>
    </div>

    <div class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-x-auto">
        <table class="w-full text-sm min-w-[640px]">
            <thead class="bg-surface-container-low text-left">
                <tr>
                    <th class="p-4 font-bold">Judul</th>
                    <th class="p-4 font-bold">Kategori</th>
                    <th class="p-4 font-bold">Status</th>
                    <th class="p-4 font-bold">Tanggal</th>
                    <th class="p-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($newsList as $news)
                    <tr class="border-t border-outline-variant/20">
                        <td class="p-4">{{ $news->title }}</td>
                        <td class="p-4">{{ $news->category->name }}</td>
                        <td class="p-4">
                            @if ($news->is_published)
                                <span class="px-2 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold">Terbit</span>
                            @else
                                <span class="px-2 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs font-semibold">Draf</span>
                            @endif
                        </td>
                        <td class="p-4">{{ $news->created_at->translatedFormat('d M Y') }}</td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.news.edit', $news) }}" class="text-primary font-semibold hover:underline">Ubah</a>
                            <form method="POST" action="{{ route('admin.news.destroy', $news) }}" class="inline" onsubmit="return confirm('Hapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-error font-semibold hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-4 text-center text-on-surface-variant">Belum ada berita.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $newsList->links() }}</div>
</x-layouts.admin>