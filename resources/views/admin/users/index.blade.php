<x-layouts.admin title="Kelola Petugas">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <p class="text-on-surface-variant">
            {{ $isSuperAdmin
                ? 'Daftar akun administrator dan petugas pada panel administrasi.'
                : 'Daftar akun petugas yang berada dalam pengelolaan Administrator.' }}
        </p>

        <a
            href="{{ route('admin.users.create') }}"
            class="inline-flex items-center justify-center gap-2 h-11 px-4 rounded-lg bg-primary text-on-primary text-sm font-semibold hover:bg-primary/90 transition-colors shrink-0"
        >
            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">person_add</span>
            Tambah Akun
        </a>
    </div>

    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-5">
        <div class="grid grid-cols-1 md:grid-cols-[minmax(0,1fr)_220px_180px_auto] gap-3">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]" aria-hidden="true">search</span>
                <input
                    type="search"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari nama atau email..."
                    class="w-full h-11 pl-10 pr-4 rounded-lg border border-outline-variant/50 bg-white text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                >
            </div>

            <select
                name="role"
                class="h-11 px-3 rounded-lg border border-outline-variant/50 bg-white text-sm focus:border-primary focus:ring-1 focus:ring-primary"
            >
                <option value="">Semua Role</option>

                @foreach ($roles as $value => $label)
                    <option value="{{ $value }}" @selected(request('role') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <select
                name="status"
                class="h-11 px-3 rounded-lg border border-outline-variant/50 bg-white text-sm focus:border-primary focus:ring-1 focus:ring-primary"
            >
                <option value="">Semua Status</option>
                <option value="active" @selected(request('status') === 'active')>Aktif</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Nonaktif</option>
            </select>

            <div class="flex gap-2">
                <button
                    type="submit"
                    class="h-11 px-5 rounded-lg bg-primary text-on-primary text-sm font-semibold hover:bg-primary/90 transition-colors"
                >
                    Filter
                </button>

                @if (request()->filled('q') || request()->filled('role') || request()->filled('status'))
                    <a
                        href="{{ route('admin.users.index') }}"
                        class="h-11 px-4 rounded-lg border border-outline-variant/50 bg-white text-sm font-medium flex items-center justify-center hover:bg-surface-container-low transition-colors"
                    >
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    <div class="flex items-center justify-between mb-3">
        <p class="text-sm text-on-surface-variant">
            Menampilkan
            <span class="font-semibold text-on-surface">
                {{ $users->firstItem() ?? 0 }}&ndash;{{ $users->lastItem() ?? 0 }}
            </span>
            dari
            <span class="font-semibold text-on-surface">{{ $users->total() }}</span>
            {{ $isSuperAdmin ? 'akun' : 'petugas' }}
        </p>
    </div>

    <div class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-x-auto">
        <table class="w-full text-sm min-w-[860px]">
            <thead class="bg-surface-container-low text-left">
                <tr>
                    <th class="p-4 font-bold">Nama</th>
                    <th class="p-4 font-bold">Email</th>
                    <th class="p-4 font-bold">Role</th>
                    <th class="p-4 font-bold">Status</th>
                    <th class="p-4 font-bold">Terdaftar</th>
                    <th class="p-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr class="border-t border-outline-variant/20">
                        <td class="p-4 font-medium text-on-surface">
                            {{ $user->name }}
                        </td>

                        <td class="p-4 text-on-surface-variant">
                            {{ $user->email }}
                        </td>

                        <td class="p-4">
                            @forelse ($user->roles as $role)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold">
                                    {{ $roles[$role->name] ?? match ($role->name) {
                                        'super_admin' => 'Super Admin',
                                        'admin' => 'Administrator',
                                        'publikasi' => 'Petugas Publikasi',
                                        'pustakawan' => 'Pustakawan',
                                        'kegiatan' => 'Petugas Kegiatan',
                                        'layanan' => 'Petugas Layanan Informasi',
                                        default => $role->name,
                                    } }}
                                </span>
                            @empty
                                <span class="text-on-surface-variant">Tanpa Role</span>
                            @endforelse
                        </td>

                        <td class="p-4">
                            @if ($user->is_active)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-error-container text-on-error-container text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-on-error-container"></span>
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <td class="p-4 whitespace-nowrap text-on-surface-variant">
                            {{ $user->created_at->translatedFormat('d M Y') }}
                        </td>

                        <td class="p-4 text-right">
                            <a
                                href="{{ route('admin.users.edit', $user) }}"
                                class="inline-flex items-center gap-1.5 h-9 px-3 rounded-lg border border-outline-variant/50 text-sm font-semibold text-primary hover:bg-primary/5 transition-colors"
                            >
                                <span class="material-symbols-outlined text-[18px]" aria-hidden="true">edit</span>
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center">
                            <span class="material-symbols-outlined text-4xl text-on-surface-variant/50 mb-2" aria-hidden="true">person_search</span>
                            <p class="text-on-surface-variant">
                                Tidak ada akun yang sesuai dengan filter.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($users->hasPages())
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    @endif
</x-layouts.admin>