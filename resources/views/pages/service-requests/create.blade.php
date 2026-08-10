<x-layout :title="$type->name">
    <section class="pt-32 pb-20 max-w-xl mx-auto px-6">
        <h1 class="text-2xl md:text-headline-lg font-bold text-primary mb-8">{{ $type->name }}</h1>

        <form method="POST" action="{{ route('service-requests.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="service_request_type_id" value="{{ $type->id }}">

            <div>
                <label for="full_name" class="text-sm font-semibold block mb-1">Nama Lengkap</label>
                <input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('full_name') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="text-sm font-semibold block mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('email') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="text-sm font-semibold block mb-1">No. Telepon (opsional)</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                @error('phone') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="text-sm font-semibold block mb-1">Detail Pengajuan</label>
                <textarea id="description" name="description" rows="5" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('description') }}</textarea>
                @error('description') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">
                Kirim Pengajuan
            </button>
        </form>
    </section>
</x-layout>