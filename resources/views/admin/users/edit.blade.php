<x-layouts.admin title="Edit Akun">
    <div class="mb-6">
        <a
            href="{{ route('admin.users.index') }}"
            class="inline-flex items-center gap-1 text-sm text-primary font-semibold hover:underline"
        >
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true">arrow_back</span>
            Kembali ke Kelola Petugas
        </a>

        <p class="text-on-surface-variant mt-3">
            Kelola identitas, jobdesk, status, dan keamanan akun.
        </p>
    </div>

    <div class="max-w-2xl space-y-6">
        <form
            method="POST"
            action="{{ route('admin.users.update', $user) }}"
            class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-hidden"
        >
            @csrf
            @method('PUT')

            <div class="p-6 border-b border-outline-variant/20">
                <h2 class="font-bold text-lg">Informasi Akun</h2>
                <p class="text-sm text-on-surface-variant mt-1">
                    Informasi dasar akun yang digunakan pada panel administrasi.
                </p>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label for="name" class="text-sm font-semibold block mb-1">Nama</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name', $user->name) }}"
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
                        value="{{ old('email', $user->email) }}"
                        required
                        autocomplete="email"
                        class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                    >
                    @error('email')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="p-6 border-t border-outline-variant/20">
                <h2 class="font-bold text-lg">Akses & Jobdesk</h2>
                <p class="text-sm text-on-surface-variant mt-1 mb-5">
                    Tentukan role dan apakah akun dapat menggunakan panel administrasi.
                </p>

                <div class="space-y-5">
                    <div>
                        <label for="role" class="text-sm font-semibold block mb-1">Role / Jobdesk</label>
                        <select
                            id="role"
                            name="role"
                            required
                            class="w-full p-3 border border-outline-variant rounded-lg bg-white focus:ring-2 focus:ring-primary focus:border-primary"
                        >
                            @foreach ($roles as $value => $label)
                                <option
                                    value="{{ $value }}"
                                    @selected(old('role', $user->roles->first()?->name) === $value)
                                >
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>

                        <p class="text-xs text-on-surface-variant mt-1">
                            Perubahan role langsung mengubah menu dan hak akses akun.
                        </p>

                        @error('role')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <fieldset>
                        <legend class="text-sm font-semibold mb-2">Status Akun</legend>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="flex items-start gap-3 p-4 border border-outline-variant/50 rounded-lg cursor-pointer hover:bg-surface-container-low">
                                <input
                                    type="radio"
                                    name="is_active"
                                    value="1"
                                    class="mt-1 text-primary focus:ring-primary"
                                    @checked((string) old('is_active', $user->is_active ? '1' : '0') === '1')
                                >
                                <span>
                                    <span class="block text-sm font-semibold">Aktif</span>
                                    <span class="block text-xs text-on-surface-variant mt-0.5">
                                        Akun dapat login dan menggunakan panel.
                                    </span>
                                </span>
                            </label>

                            <label class="flex items-start gap-3 p-4 border border-outline-variant/50 rounded-lg cursor-pointer hover:bg-surface-container-low">
                                <input
                                    type="radio"
                                    name="is_active"
                                    value="0"
                                    class="mt-1 text-primary focus:ring-primary"
                                    @checked((string) old('is_active', $user->is_active ? '1' : '0') === '0')
                                >
                                <span>
                                    <span class="block text-sm font-semibold">Nonaktif</span>
                                    <span class="block text-xs text-on-surface-variant mt-0.5">
                                        Akun tidak dapat menggunakan panel administrasi.
                                    </span>
                                </span>
                            </label>
                        </div>

                        @error('is_active')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            <div class="p-6 border-t border-outline-variant/20 flex flex-wrap gap-3">
                <button
                    type="submit"
                    class="px-6 h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary/90 transition-colors"
                >
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="px-6 h-12 flex items-center border border-outline-variant rounded-lg font-semibold hover:bg-surface-container-low transition-colors"
                >
                    Batal
                </a>
            </div>
        </form>

        <form
            method="POST"
            action="{{ route('admin.users.password.update', $user) }}"
            class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-hidden"
        >
            @csrf
            @method('PATCH')

            <div class="p-6 border-b border-outline-variant/20">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-primary" aria-hidden="true">lock_reset</span>
                    <div>
                        <h2 class="font-bold text-lg">Keamanan Akun</h2>
                        <p class="text-sm text-on-surface-variant mt-1">
                            Reset password jika pemilik akun lupa atau password perlu diganti.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label for="password" class="text-sm font-semibold block mb-1">Password Baru</label>
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
                    <label for="password_confirmation" class="text-sm font-semibold block mb-1">
                        Konfirmasi Password Baru
                    </label>
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

                <div class="rounded-lg bg-surface-container-low p-4">
                    <p class="text-xs text-on-surface-variant">
                        Setelah password direset, sesi login akun tersebut akan diakhiri dan pengguna harus login kembali menggunakan password baru.
                    </p>
                </div>
            </div>

            <div class="p-6 border-t border-outline-variant/20">
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-5 h-11 border border-primary text-primary font-semibold rounded-lg hover:bg-primary/5 transition-colors"
                >
                    <span class="material-symbols-outlined text-[19px]" aria-hidden="true">lock_reset</span>
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>