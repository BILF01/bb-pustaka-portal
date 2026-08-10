<x-layouts.admin title="Ubah Berita">
    <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm max-w-2xl space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="news_category_id" class="text-sm font-semibold block mb-1">Kategori</label>
            <select id="news_category_id" name="news_category_id" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('news_category_id', $news->news_category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('news_category_id') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="title" class="text-sm font-semibold block mb-1">Judul</label>
            <input id="title" name="title" type="text" value="{{ old('title', $news->title) }}" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            @error('title') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="excerpt" class="text-sm font-semibold block mb-1">Ringkasan</label>
            <textarea id="excerpt" name="excerpt" rows="2" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('excerpt', $news->excerpt) }}</textarea>
            @error('excerpt') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="body" class="text-sm font-semibold block mb-1">Isi Berita</label>
            <textarea id="body" name="body" rows="10" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('body', $news->body) }}</textarea>
            @error('body') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        @if ($news->image_path)
            <img src="{{ $news->image_path }}" alt="Gambar saat ini" class="w-40 aspect-video object-cover rounded-lg">
        @endif

        <div>
            <label for="image" class="text-sm font-semibold block mb-1">Ganti Gambar Sampul (opsional)</label>
            <input id="image" name="image" type="file" accept="image/*" class="w-full p-3 border border-outline-variant rounded-lg">
            @error('image') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $news->is_published)) class="w-5 h-5">
            <span class="text-sm font-semibold">Terbitkan</span>
        </label>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-6 h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">Perbarui</button>
            <a href="{{ route('admin.news.index') }}" class="px-6 h-12 flex items-center border border-outline-variant rounded-lg font-semibold">Batal</a>
        </div>
    </form>
</x-layouts.admin>