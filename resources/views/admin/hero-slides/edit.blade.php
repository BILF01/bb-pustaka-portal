<x-layouts.admin title="Ubah Slide Hero">
    <form method="POST" action="{{ route('admin.hero-slides.update', $heroSlide) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm max-w-xl space-y-4">
        @csrf
        @method('PUT')

        @if ($heroSlide->image_path)
            <img src="{{ $heroSlide->image_path }}" alt="Gambar saat ini" class="w-32 aspect-video object-cover rounded-lg">
        @endif

        <div>
            <label for="image" class="text-sm font-semibold block mb-1">Ganti Gambar (opsional)</label>
            <input id="image" name="image" type="file" accept="image/*" class="w-full p-3 border border-outline-variant rounded-lg">
            @error('image') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="order" class="text-sm font-semibold block mb-1">Urutan</label>
            <input id="order" name="order" type="number" min="0" value="{{ old('order', $heroSlide->order) }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            @error('order') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-6 h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">Perbarui</button>
            <a href="{{ route('admin.hero-slides.index') }}" class="px-6 h-12 flex items-center border border-outline-variant rounded-lg font-semibold">Batal</a>
        </div>
    </form>
</x-layouts.admin>