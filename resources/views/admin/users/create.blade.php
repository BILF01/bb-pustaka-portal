<x-layouts.admin title="Tambah Akun">
    <div class="mb-6">
        <a
            href="{{ route('admin.users.index') }}"
            class="inline-flex items-center gap-1 text-sm text-primary font-semibold hover:underline"
        >
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true">arrow_back</span>
            Kembali ke Kelola Petugas
        </a>

        <p class="text-on-surface-variant mt-3">
            {{ $isSuperAdmin
                ? 'Buat akun Administrator atau petugas operasional.'
                : 'Buat akun baru untuk petugas operasional.' }}
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('admin.users.store') }}"
        class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm max-w-xl space-y-5"
    >
        @csrf

        <div>
            <label for="name" class="text-sm font-semibold block mb-1">Nama</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                required
                autocomplete="name"
                class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
            >
            @error('name')
                <p class="text-error text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="text-sm font-semibold block mb-1">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
            >
            @error('email')
                <p class="text-error text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="role" class="text-sm font-semibold block mb-1">Role / Jobdesk</label>
            <select
                id="role"
                name="role"
                required
                class="w-full p-3 border border-outline-variant rounded-lg bg-white focus:ring-2 focus:ring-primary focus:border-primary"
            >
                <option value="">Pilih Role</option>

                @foreach ($roles as $value => $label)
                    <option value="{{ $value }}" @selected(old('role') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('role')
                <p class="text-error text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="text-sm font-semibold block mb-1">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                required
                minlength="8"
                autocomplete="new-password"
                class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
            >
            <p class="text-xs text-on-surface-variant mt-1">Minimal 8 karakter.</p>
            @error('password')
                <p class="text-error text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="text-sm font-semibold block mb-1">Konfirmasi Password</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                required
                minlength="8"
                autocomplete="new-password"
                class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
            >
        </div>

        <label class="flex items-start gap-3 p-4 rounded-lg bg-surface-container-low cursor-pointer">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                @checked(old('is_active', '1') === '1')
                class="mt-0.5 rounded border-outline-variant text-primary focus:ring-primary"
            >
            <span>
                <span class="block text-sm font-semibold">Aktifkan akun</span>
                <span class="block text-xs text-on-surface-variant mt-0.5">
                    Akun aktif dapat langsung digunakan untuk login.
                </span>
            </span>
        </label>

        @error('is_active')
            <p class="text-error text-xs">{{ $message }}</p>
        @enderror

        <div class="flex flex-wrap gap-3 pt-2">
            <button
                type="submit"
                class="px-6 h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary/90 transition-colors"
            >
                Simpan Akun
            </button>

            <a
                href="{{ route('admin.users.index') }}"
                class="px-6 h-12 flex items-center border border-outline-variant rounded-lg font-semibold hover:bg-surface-container-low transition-colors"
            >
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>