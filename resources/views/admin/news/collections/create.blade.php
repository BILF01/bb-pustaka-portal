<x-layouts.admin title="Tambah Koleksi">
    <form method="POST" action="{{ route('admin.collections.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm max-w-2xl space-y-4">
        @csrf

        <div>
            <label for="collection_category_id" class="text-sm font-semibold block mb-1">Kategori</label>
            <select id="collection_category_id" name="collection_category_id" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('collection_category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('collection_category_id') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="title" class="text-sm font-semibold block mb-1">Judul Buku</label>
            <input id="title" name="title" type="text" value="{{ old('title') }}" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            @error('title') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="author" class="text-sm font-semibold block mb-1">Penulis</label>
                <input id="author" name="author" type="text" value="{{ old('author') }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('author') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="publisher" class="text-sm font-semibold block mb-1">Penerbit</label>
                <input id="publisher" name="publisher" type="text" value="{{ old('publisher') }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('publisher') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="published_year" class="text-sm font-semibold block mb-1">Tahun Terbit</label>
                <input id="published_year" name="published_year" type="number" value="{{ old('published_year') }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('published_year') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="isbn" class="text-sm font-semibold block mb-1">ISBN</label>
                <input id="isbn" name="isbn" type="text" value="{{ old('isbn') }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('isbn') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="stock" class="text-sm font-semibold block mb-1">Stok</label>
                <input id="stock" name="stock" type="number" value="{{ old('stock', 0) }}" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('stock') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="synopsis" class="text-sm font-semibold block mb-1">Sinopsis</label>
            <textarea id="synopsis" name="synopsis" rows="4" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('synopsis') }}</textarea>
            @error('synopsis') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="cover" class="text-sm font-semibold block mb-1">Sampul Buku</label>
            <input id="cover" name="cover" type="file" accept="image/*" class="w-full p-3 border border-outline-variant rounded-lg">
            @error('cover') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured')) class="w-5 h-5">
            <span class="text-sm font-semibold">Tampilkan sebagai koleksi unggulan</span>
        </label>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-6 h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">Simpan</button>
            <a href="{{ route('admin.collections.index') }}" class="px-6 h-12 flex items-center border border-outline-variant rounded-lg font-semibold">Batal</a>
        </div>
    </form>
</x-layouts.admin>