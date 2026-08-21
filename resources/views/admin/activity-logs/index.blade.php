<x-layouts.admin title="Activity Log">
    <div class="mb-6">
        <p class="text-on-surface-variant">
            Riwayat aktivitas penting pada panel administrasi BB Pustaka.
        </p>
    </div>

    <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="mb-5">
        <div class="grid grid-cols-1 md:grid-cols-[minmax(0,1fr)_240px_auto] gap-3">
            <div class="relative">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]"
                    aria-hidden="true"
                >
                    search
                </span>

                <input
                    type="search"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari pelaku, target, aktivitas, atau IP..."
                    class="w-full h-11 pl-10 pr-4 rounded-lg border border-outline-variant/50 bg-white text-sm focus:border-primary focus:ring-1 focus:ring-primary"
                >
            </div>

            <select
                name="action"
                class="h-11 px-3 rounded-lg border border-outline-variant/50 bg-white text-sm focus:border-primary focus:ring-1 focus:ring-primary"
            >
                <option value="">Semua Aktivitas</option>

                @foreach ($actions as $value => $label)
                    <option value="{{ $value }}" @selected(request('action') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <div class="flex gap-2">
                <button
                    type="submit"
                    class="h-11 px-5 rounded-lg bg-primary text-on-primary text-sm font-semibold hover:bg-primary/90 transition-colors"
                >
                    Filter
                </button>

                @if (request()->filled('q') || request()->filled('action'))
                    <a
                        href="{{ route('admin.activity-logs.index') }}"
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
                {{ $logs->firstItem() ?? 0 }}&ndash;{{ $logs->lastItem() ?? 0 }}
            </span>
            dari
            <span class="font-semibold text-on-surface">
                {{ $logs->total() }}
            </span>
            aktivitas
        </p>
    </div>

    <div class="bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-x-auto">
        <table class="w-full text-sm min-w-[1050px]">
            <thead class="bg-surface-container-low text-left">
                <tr>
                    <th class="p-4 font-bold whitespace-nowrap">Waktu</th>
                    <th class="p-4 font-bold">Pelaku</th>
                    <th class="p-4 font-bold">Aktivitas</th>
                    <th class="p-4 font-bold">Target</th>
                    <th class="p-4 font-bold whitespace-nowrap">IP Address</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($logs as $log)
                    <tr class="border-t border-outline-variant/20 align-top">
                        <td class="p-4 whitespace-nowrap text-on-surface-variant">
                            <span class="block font-medium text-on-surface">
                                {{ $log->created_at->translatedFormat('d M Y') }}
                            </span>
                            <span class="block text-xs mt-0.5">
                                {{ $log->created_at->format('H:i:s') }}
                            </span>
                        </td>

                        <td class="p-4">
                            @if ($log->actor)
                                <span class="block font-medium text-on-surface">
                                    {{ $log->actor->name }}
                                </span>
                                <span class="block text-xs text-on-surface-variant mt-0.5">
                                    {{ $log->actor->email }}
                                </span>
                            @else
                                <span class="text-on-surface-variant">
                                    Akun tidak tersedia
                                </span>
                            @endif
                        </td>

                        <td class="p-4">
                            <span class="inline-flex px-2.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold mb-2">
                                {{ $actions[$log->action] ?? $log->action }}
                            </span>

                            <p class="text-on-surface">
                                {{ $log->description }}
                            </p>
                        </td>

                        <td class="p-4">
                            @if ($log->subject_name)
                                <span class="font-medium text-on-surface">
                                    {{ $log->subject_name }}
                                </span>
                            @else
                                <span class="text-on-surface-variant">&mdash;</span>
                            @endif
                        </td>

                        <td class="p-4 whitespace-nowrap text-on-surface-variant">
                            {{ $log->ip_address ?? '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-10 text-center">
                            <span
                                class="material-symbols-outlined text-4xl text-on-surface-variant/50 mb-2"
                                aria-hidden="true"
                            >
                                history
                            </span>

                            <p class="text-on-surface-variant">
                                Belum ada aktivitas yang tercatat.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($logs->hasPages())
        <div class="mt-6">
            {{ $logs->links() }}
        </div>
    @endif
</x-layouts.admin>