<x-layout title="Kontak">
    <section class="pt-32 pb-20 max-w-[1280px] mx-auto px-6">
        <h1 class="text-headline-lg font-bold text-primary">Kontak</h1>

        @if (session('success'))
            <div class="mt-4 p-4 rounded-lg bg-primary/10 text-primary" role="status">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" class="mt-6 space-y-4 max-w-xl">
            @csrf
            <div>
                <label for="name" class="font-label-md block mb-1">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('name') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="email" class="font-label-md block mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('email') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="message" class="font-label-md block mb-1">Pesan</label>
                <textarea id="message" name="message" rows="5" required
                    class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('message') }}</textarea>
                @error('message') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="h-12 px-6 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">
                Kirim Pesan
            </button>
        </form>
    </section>
</x-layout>