<x-layouts.admin title="Tambah Slide Hero">
    <form method="POST" action="{{ route('admin.hero-slides.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm max-w-xl space-y-4">
        @csrf

        <div>
            <label for="image" class="text-sm font-semibold block mb-1">Gambar Slide</label>
            <input id="image" name="image" type="file" accept="image/*" required class="w-full p-3 border border-outline-variant rounded-lg">
            @error('image') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="order" class="text-sm font-semibold block mb-1">Urutan (opsional)</label>
            <input id="order" name="order" type="number" min="0" value="{{ old('order') }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            @error('order') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-6 h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">Simpan</button>
            <a href="{{ route('admin.hero-slides.index') }}" class="px-6 h-12 flex items-center border border-outline-variant rounded-lg font-semibold">Batal</a>
        </div>
    </form>
</x-layouts.admin>