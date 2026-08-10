<x-layouts.admin title="Ubah Koleksi">
    <form method="POST" action="{{ route('admin.collections.update', $collection) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm max-w-2xl space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="collection_category_id" class="text-sm font-semibold block mb-1">Kategori</label>
            <select id="collection_category_id" name="collection_category_id" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('collection_category_id', $collection->collection_category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('collection_category_id') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="title" class="text-sm font-semibold block mb-1">Judul Buku</label>
            <input id="title" name="title" type="text" value="{{ old('title', $collection->title) }}" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            @error('title') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="author" class="text-sm font-semibold block mb-1">Penulis</label>
                <input id="author" name="author" type="text" value="{{ old('author', $collection->author) }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('author') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="publisher" class="text-sm font-semibold block mb-1">Penerbit</label>
                <input id="publisher" name="publisher" type="text" value="{{ old('publisher', $collection->publisher) }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('publisher') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="published_year" class="text-sm font-semibold block mb-1">Tahun Terbit</label>
                <input id="published_year" name="published_year" type="number" value="{{ old('published_year', $collection->published_year) }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('published_year') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="isbn" class="text-sm font-semibold block mb-1">ISBN</label>
                <input id="isbn" name="isbn" type="text" value="{{ old('isbn', $collection->isbn) }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('isbn') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="page_count" class="text-sm font-semibold block mb-1">Tebal Buku</label>
                <input id="page_count" name="page_count" type="text" placeholder="94 halaman" value="{{ old('page_count', $collection->page_count) }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('page_count') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="access_link" class="text-sm font-semibold block mb-1">Tautan Akses (Repository)</label>
            <input id="access_link" name="access_link" type="url" value="{{ old('access_link', $collection->access_link) }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            @error('access_link') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="synopsis" class="text-sm font-semibold block mb-1">Sinopsis</label>
            <textarea id="synopsis" name="synopsis" rows="4" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('synopsis', $collection->synopsis) }}</textarea>
            @error('synopsis') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        @if ($collection->cover_path)
            <img src="{{ $collection->cover_path }}" alt="Sampul saat ini" class="w-32 aspect-[3/4] object-cover rounded-lg">
        @endif

        <div>
            <label for="cover" class="text-sm font-semibold block mb-1">Ganti Sampul Buku (opsional)</label>
            <input id="cover" name="cover" type="file" accept="image/*" class="w-full p-3 border border-outline-variant rounded-lg">
            @error('cover') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $collection->is_featured)) class="w-5 h-5">
            <span class="text-sm font-semibold">Tampilkan sebagai koleksi unggulan</span>
        </label>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-6 h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">Perbarui</button>
            <a href="{{ route('admin.collections.index') }}" class="px-6 h-12 flex items-center border border-outline-variant rounded-lg font-semibold">Batal</a>
        </div>
    </form>
</x-layouts.admin>