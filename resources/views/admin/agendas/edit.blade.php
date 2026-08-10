<x-layouts.admin title="Ubah Agenda">
    <form method="POST" action="{{ route('admin.agendas.update', $agenda) }}" class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm max-w-xl space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="text-sm font-semibold block mb-1">Judul Kegiatan</label>
            <input id="title" name="title" type="text" value="{{ old('title', $agenda->title) }}" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            @error('title') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="text-sm font-semibold block mb-1">Deskripsi</label>
            <textarea id="description" name="description" rows="4" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('description', $agenda->description) }}</textarea>
            @error('description') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="location" class="text-sm font-semibold block mb-1">Lokasi</label>
            <input id="location" name="location" type="text" value="{{ old('location', $agenda->location) }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            @error('location') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="category" class="text-sm font-semibold block mb-1">Kategori</label>
            <input id="category" name="category" type="text" value="{{ old('category', $agenda->category) }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            @error('category') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        @if ($agenda->image_path)
            <img src="{{ $agenda->image_path }}" alt="Gambar saat ini" class="w-32 aspect-video object-cover rounded-lg">
        @endif

        <div>
            <label for="image" class="text-sm font-semibold block mb-1">Ganti Gambar (opsional)</label>
            <input id="image" name="image" type="file" accept="image/*" class="w-full p-3 border border-outline-variant rounded-lg">
            @error('image') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="starts_at" class="text-sm font-semibold block mb-1">Waktu Mulai</label>
                <input id="starts_at" name="starts_at" type="datetime-local" value="{{ old('starts_at', $agenda->starts_at->format('Y-m-d\TH:i')) }}" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('starts_at') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="ends_at" class="text-sm font-semibold block mb-1">Waktu Selesai</label>
                <input id="ends_at" name="ends_at" type="datetime-local" value="{{ old('ends_at', $agenda->ends_at?->format('Y-m-d\TH:i')) }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('ends_at') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-6 h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">Perbarui</button>
            <a href="{{ route('admin.agendas.index') }}" class="px-6 h-12 flex items-center border border-outline-variant rounded-lg font-semibold">Batal</a>
        </div>
    </form>
</x-layouts.admin>