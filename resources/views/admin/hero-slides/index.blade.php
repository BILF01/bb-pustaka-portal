<x-layouts.admin title="Hero Slider">
    <div class="flex justify-between items-center mb-6">
        <p class="text-on-surface-variant">Kelola gambar slider pada Hero Homepage (maksimal 5 gambar).</p>
        @if ($heroSlides->count() < 5)
            <a href="{{ route('admin.hero-slides.create') }}" class="px-5 h-11 bg-primary text-on-primary font-semibold rounded-lg hover:bg-primary-container transition-all inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-base" aria-hidden="true">add</span> Tambah Slide
            </a>
        @endif
    </div>

    @if (session('error'))
        <div class="mb-6 p-4 rounded-lg bg-error/10 text-error text-sm" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-x-auto">
        <table class="w-full text-sm min-w-[640px]">
            <thead class="bg-surface-container-low text-left">
                <tr>
                    <th class="p-4 font-bold">Preview</th>
                    <th class="p-4 font-bold">Urutan</th>
                    <th class="p-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($heroSlides as $slide)
                    <tr class="border-t border-outline-variant/20">
                        <td class="p-4">
                            <img src="{{ $slide->image_path }}" alt="Preview slide hero" class="w-32 aspect-video object-cover rounded-lg">
                        </td>
                        <td class="p-4">{{ $slide->order }}</td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="text-primary font-semibold hover:underline">Ubah</a>
                            <form method="POST" action="{{ route('admin.hero-slides.destroy', $slide) }}" class="inline" onsubmit="return confirm('Hapus slide ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-error font-semibold hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="p-4 text-center text-on-surface-variant">Belum ada slide hero. Homepage akan memakai gambar bawaan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.admin>