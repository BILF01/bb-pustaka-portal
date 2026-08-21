<x-layouts.admin title="Profil Saya">
    <div class="mb-6">
        <p class="text-on-surface-variant">
            Kelola informasi akun dan keamanan akun Anda.
        </p>
    </div>

    <div class="max-w-2xl space-y-6">
        <form
            method="POST"
            action="{{ route('admin.profile.update') }}"
            class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-hidden"
        >
            @csrf
            @method('PUT')

            <div class="p-6 border-b border-outline-variant/20">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-primary" aria-hidden="true">person</span>

                    <div>
                        <h2 class="text-lg font-bold">Informasi Akun</h2>
                        <p class="text-sm text-on-surface-variant mt-1">
                            Informasi identitas akun yang digunakan pada panel administrasi.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label for="name" class="text-sm font-semibold block mb-1">
                        Nama
                    </label>

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
                    <label for="email" class="text-sm font-semibold block mb-1">
                        Email
                    </label>

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

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-semibold mb-1">Role / Jobdesk</p>

                        <div class="min-h-12 px-4 py-3 rounded-lg bg-surface-container-low border border-outline-variant/30">
                            <span class="inline-flex items-center gap-2 text-sm font-medium">
                                <span class="material-symbols-outlined text-[19px] text-primary" aria-hidden="true">
                                    badge
                                </span>
                                {{ $roleLabel }}
                            </span>
                        </div>

                        <p class="text-xs text-on-surface-variant mt-1">
                            Role hanya dapat diubah oleh pengelola akun yang berwenang.
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold mb-1">Status Akun</p>

                        <div class="min-h-12 px-4 py-3 rounded-lg bg-surface-container-low border border-outline-variant/30">
                            @if ($user->is_active)
                                <span class="inline-flex items-center gap-2 text-sm font-semibold text-primary">
                                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 text-sm font-semibold text-error">
                                    <span class="w-2 h-2 rounded-full bg-error"></span>
                                    Nonaktif
                                </span>
                            @endif
                        </div>

                        <p class="text-xs text-on-surface-variant mt-1">
                            Status tidak dapat diubah melalui Profil Saya.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-outline-variant/20">
                <button
                    type="submit"
                    class="px-6 h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary/90 transition-colors"
                >
                    Simpan Profil
                </button>
            </div>
        </form>

        <form
            method="POST"
            action="{{ route('admin.profile.password.update') }}"
            class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-hidden"
        >
            @csrf
            @method('PATCH')

            <div class="p-6 border-b border-outline-variant/20">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-primary" aria-hidden="true">password</span>

                    <div>
                        <h2 class="text-lg font-bold">Keamanan Akun</h2>
                        <p class="text-sm text-on-surface-variant mt-1">
                            Ubah password dengan melakukan verifikasi password yang sedang digunakan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label for="current_password" class="text-sm font-semibold block mb-1">
                        Password Saat Ini
                    </label>

                    <input
                        id="current_password"
                        name="current_password"
                        type="password"
                        required
                        autocomplete="current-password"
                        class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                    >

                    @error('current_password')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="text-sm font-semibold block mb-1">
                        Password Baru
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        minlength="8"
                        autocomplete="new-password"
                        class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                    >

                    <p class="text-xs text-on-surface-variant mt-1">
                        Minimal 8 karakter dan harus berbeda dari password saat ini.
                    </p>

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
                        Setelah password diganti, sesi akun lain akan diakhiri. Sesi yang sedang Anda gunakan tetap aktif.
                    </p>
                </div>
            </div>

            <div class="p-6 border-t border-outline-variant/20">
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-5 h-11 border border-primary text-primary font-semibold rounded-lg hover:bg-primary/5 transition-colors"
                >
                    <span class="material-symbols-outlined text-[19px]" aria-hidden="true">password</span>
                    Ubah Password
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>