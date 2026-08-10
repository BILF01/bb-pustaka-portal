<x-layouts.admin title="Tambah Berita">
    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm max-w-2xl space-y-4">
        @csrf

        <div>
            <label for="news_category_id" class="text-sm font-semibold block mb-1">Kategori</label>
            <select id="news_category_id" name="news_category_id" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('news_category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('news_category_id') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="title" class="text-sm font-semibold block mb-1">Judul</label>
            <input id="title" name="title" type="text" value="{{ old('title') }}" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            @error('title') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="excerpt" class="text-sm font-semibold block mb-1">Ringkasan</label>
            <textarea id="excerpt" name="excerpt" rows="2" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('excerpt') }}</textarea>
            @error('excerpt') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="body" class="text-sm font-semibold block mb-1">Isi Berita</label>
            <textarea id="body" name="body" rows="10" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('body') }}</textarea>
            @error('body') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="image" class="text-sm font-semibold block mb-1">Gambar Sampul</label>
            <input id="image" name="image" type="file" accept="image/*" class="w-full p-3 border border-outline-variant rounded-lg">
            @error('image') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published')) class="w-5 h-5">
            <span class="text-sm font-semibold">Terbitkan sekarang</span>
        </label>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-6 h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">Simpan</button>
            <a href="{{ route('admin.news.index') }}" class="px-6 h-12 flex items-center border border-outline-variant rounded-lg font-semibold">Batal</a>
        </div>
    </form>
</x-layouts.admin>