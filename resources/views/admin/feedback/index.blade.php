<x-layouts.admin title="Umpan Balik">
    <div class="space-y-5">
        <section>
            <p class="text-xs font-semibold uppercase tracking-[0.12em] text-primary/65">
                Layanan Informasi
            </p>

            <h2 class="mt-1 text-xl font-bold tracking-tight text-on-surface">
                Umpan Balik Pengunjung
            </h2>

            <p class="mt-1 text-sm text-on-surface-variant">
                Pantau penilaian, kritik, saran, dan kebutuhan fitur dari pengunjung portal BB Pustaka.
            </p>
        </section>

        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">
                            Total Umpan Balik
                        </p>

                        <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                            {{ $totalFeedback }}
                        </p>
                    </div>

                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <span
                            class="material-symbols-outlined text-[22px]"
                            aria-hidden="true"
                        >
                            reviews
                        </span>
                    </span>
                </div>

                <p class="mt-3 text-xs text-on-surface-variant/70">
                    Seluruh respons yang telah diterima.
                </p>
            </div>

            <div class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">
                            Rata-rata Kepuasan
                        </p>

                        <div class="mt-3 flex items-baseline gap-1">
                            <span class="text-3xl font-bold tracking-tight text-on-surface">
                                {{ number_format($averageSatisfaction, 1) }}
                            </span>

                            <span class="text-sm font-semibold text-on-surface-variant">
                                / 5
                            </span>
                        </div>
                    </div>

                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-secondary/30 text-on-secondary-container">
                        <span
                            class="material-symbols-outlined text-[22px]"
                            aria-hidden="true"
                        >
                            star
                        </span>
                    </span>
                </div>

                <p class="mt-3 text-xs text-on-surface-variant/70">
                    Nilai rata-rata dari seluruh respons.
                </p>
            </div>

            <div class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">
                            Informasi Ditemukan
                        </p>

                        <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                            {{ $foundInformationPercentage }}%
                        </p>
                    </div>

                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <span
                            class="material-symbols-outlined text-[22px]"
                            aria-hidden="true"
                        >
                            search_check
                        </span>
                    </span>
                </div>

                <p class="mt-3 text-xs text-on-surface-variant/70">
                    {{ $foundInformationCount }} pengunjung menemukan informasi.
                </p>
            </div>

            <div class="rounded-2xl border border-outline-variant/25 bg-white p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">
                            Usulan Fitur
                        </p>

                        <p class="mt-3 text-3xl font-bold tracking-tight text-on-surface">
                            {{ $desiredFeatureCount }}
                        </p>
                    </div>

                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <span
                            class="material-symbols-outlined text-[22px]"
                            aria-hidden="true"
                        >
                            lightbulb
                        </span>
                    </span>
                </div>

                <p class="mt-3 text-xs text-on-surface-variant/70">
                    Respons yang menyertakan usulan fitur.
                </p>
            </div>
        </section>

        <form
            method="GET"
            action="{{ route('admin.feedback.index') }}"
            class="rounded-2xl border border-outline-variant/25 bg-white p-4"
        >
            <div class="grid gap-3 lg:grid-cols-[minmax(240px,1fr)_190px_210px_auto]">
                <div class="relative">
                    <span
                        class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[20px] text-on-surface-variant/60"
                        aria-hidden="true"
                    >
                        search
                    </span>

                    <input
                        type="search"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari kritik, saran, atau fitur..."
                        class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white pl-10 pr-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                    >
                </div>

                <select
                    name="satisfaction"
                    class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white px-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                >
                    <option value="">Semua kepuasan</option>

                    <option value="5" @selected(request('satisfaction') === '5')>
                        ★★★★★
                    </option>
                    <option value="4" @selected(request('satisfaction') === '4')>
                        ★★★★☆
                    </option>
                    <option value="3" @selected(request('satisfaction') === '3')>
                        ★★★☆☆
                    </option>
                    <option value="2" @selected(request('satisfaction') === '2')>
                        ★★☆☆☆
                    </option>
                    <option value="1" @selected(request('satisfaction') === '1')>
                        ★☆☆☆☆
                    </option>
                </select>

                <select
                    name="found_information"
                    class="h-11 w-full rounded-xl border border-outline-variant/50 bg-white px-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                >
                    <option value="">Semua hasil pencarian</option>

                    <option
                        value="1"
                        @selected(request('found_information') === '1')
                    >
                        Informasi ditemukan
                    </option>

                    <option
                        value="0"
                        @selected(request('found_information') === '0')
                    >
                        Informasi tidak ditemukan
                    </option>
                </select>

                <div class="flex gap-2">
                    <button
                        type="submit"
                        class="inline-flex h-11 flex-1 items-center justify-center gap-2 rounded-xl bg-primary px-4 text-sm font-semibold text-white transition hover:bg-primary-container lg:flex-none"
                    >
                        <span
                            class="material-symbols-outlined text-[19px]"
                            aria-hidden="true"
                        >
                            filter_alt
                        </span>

                        Terapkan
                    </button>

                    @if (
                        request()->filled('q')
                        || request()->filled('satisfaction')
                        || request()->filled('found_information')
                    )
                        <a
                            href="{{ route('admin.feedback.index') }}"
                            class="inline-flex h-11 items-center justify-center rounded-xl border border-outline-variant/50 px-3 text-on-surface-variant transition hover:bg-surface-container-low"
                            aria-label="Reset filter"
                            title="Reset filter"
                        >
                            <span
                                class="material-symbols-outlined text-[20px]"
                                aria-hidden="true"
                            >
                                restart_alt
                            </span>
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <section class="overflow-hidden rounded-2xl border border-outline-variant/25 bg-white">
            <div class="flex items-center justify-between border-b border-outline-variant/20 px-5 py-4">
                <div>
                    <h3 class="text-sm font-bold text-on-surface">
                        Daftar Umpan Balik
                    </h3>

                    <p class="mt-0.5 text-xs text-on-surface-variant">
                        {{ $feedbacks->total() }} respons ditemukan
                    </p>
                </div>

                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <span
                        class="material-symbols-outlined text-[20px]"
                        aria-hidden="true"
                    >
                        forum
                    </span>
                </span>
            </div>

            <div class="hidden overflow-x-auto md:block">
                <table class="w-full min-w-[1120px] table-fixed text-sm">
                    <thead class="bg-surface-container-low/70 text-left">
                        <tr class="text-xs uppercase tracking-[0.05em] text-on-surface-variant">
                            <th class="w-[190px] px-5 py-3.5 font-semibold">
                                Kepuasan
                            </th>

                            <th class="w-[155px] px-5 py-3.5 font-semibold">
                                Informasi
                            </th>

                            <th class="w-[330px] px-5 py-3.5 font-semibold">
                                Kritik & Saran
                            </th>

                            <th class="w-[290px] px-5 py-3.5 font-semibold">
                                Fitur Diinginkan
                            </th>

                            <th class="w-[155px] px-5 py-3.5 font-semibold">
                                Tanggal
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-outline-variant/15">
                        @forelse ($feedbacks as $item)
                            <tr class="align-top transition-colors hover:bg-surface-container-low/45">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="flex">
                                            @for ($star = 1; $star <= 5; $star++)
                                                <span
                                                    class="material-symbols-outlined text-[17px] {{ $star <= $item->satisfaction_level ? 'text-primary' : 'text-outline/35' }}"
                                                    aria-hidden="true"
                                                >
                                                    star
                                                </span>
                                            @endfor
                                        </div>

                                        <span class="font-semibold text-on-surface">
                                            {{ $item->satisfaction_level }}/5
                                        </span>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    @if ($item->found_information)
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 px-2.5 py-1 text-xs font-semibold text-primary">
                                            <span
                                                class="h-1.5 w-1.5 rounded-full bg-primary"
                                                aria-hidden="true"
                                            ></span>

                                            Ditemukan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-error-container/40 px-2.5 py-1 text-xs font-semibold text-error">
                                            <span
                                                class="h-1.5 w-1.5 rounded-full bg-error"
                                                aria-hidden="true"
                                            ></span>

                                            Tidak ditemukan
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    <div class="max-w-sm">
                                        <p class="whitespace-pre-line leading-5 text-on-surface">
                                            {{ $item->message }}
                                        </p>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="max-w-xs">
                                        @if ($item->desired_feature)
                                            <p class="whitespace-pre-line leading-5 text-on-surface-variant">
                                                {{ $item->desired_feature }}
                                            </p>
                                        @else
                                            <span class="text-on-surface-variant/50">
                                                -
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-on-surface-variant">
                                    <p>
                                        {{ $item->created_at->translatedFormat('d M Y') }}
                                    </p>

                                    <p class="mt-0.5 text-xs">
                                        {{ $item->created_at->format('H:i') }}
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-14 text-center">
                                    <span
                                        class="material-symbols-outlined text-4xl text-outline/50"
                                        aria-hidden="true"
                                    >
                                        reviews
                                    </span>

                                    <p class="mt-2 text-sm font-semibold text-on-surface">
                                        Belum ada umpan balik
                                    </p>

                                    <p class="mt-1 text-xs text-on-surface-variant">
                                        Tidak ada respons yang sesuai dengan data atau filter saat ini.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="divide-y divide-outline-variant/15 md:hidden">
                @forelse ($feedbacks as $item)
                    <article class="p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="flex items-center gap-2">
                                    <div class="flex">
                                        @for ($star = 1; $star <= 5; $star++)
                                            <span
                                                class="material-symbols-outlined text-[17px] {{ $star <= $item->satisfaction_level ? 'text-primary' : 'text-outline/35' }}"
                                                aria-hidden="true"
                                            >
                                                star
                                            </span>
                                        @endfor
                                    </div>

                                    <span class="text-xs font-bold text-on-surface">
                                        {{ $item->satisfaction_level }}/5
                                    </span>
                                </div>

                                <p class="mt-1 text-xs text-on-surface-variant">
                                    {{ $item->created_at->translatedFormat('d M Y, H:i') }}
                                </p>
                            </div>

                            @if ($item->found_information)
                                <span class="shrink-0 rounded-full bg-primary/10 px-2.5 py-1 text-[10px] font-semibold text-primary">
                                    Ditemukan
                                </span>
                            @else
                                <span class="shrink-0 rounded-full bg-error-container/40 px-2.5 py-1 text-[10px] font-semibold text-error">
                                    Tidak ditemukan
                                </span>
                            @endif
                        </div>

                        <div class="mt-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.06em] text-on-surface-variant/70">
                                Kritik & Saran
                            </p>

                            <p class="mt-1.5 whitespace-pre-line text-sm leading-6 text-on-surface">
                                {{ $item->message }}
                            </p>
                        </div>

                        @if ($item->desired_feature)
                            <div class="mt-4 rounded-xl bg-surface-container-low/70 p-3">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.06em] text-on-surface-variant/70">
                                    Fitur Diinginkan
                                </p>

                                <p class="mt-1.5 whitespace-pre-line text-xs leading-5 text-on-surface-variant">
                                    {{ $item->desired_feature }}
                                </p>
                            </div>
                        @endif
                    </article>
                @empty
                    <div class="px-5 py-12 text-center">
                        <span
                            class="material-symbols-outlined text-4xl text-outline/50"
                            aria-hidden="true"
                        >
                            reviews
                        </span>

                        <p class="mt-2 text-sm font-semibold">
                            Belum ada umpan balik
                        </p>

                        <p class="mt-1 text-xs text-on-surface-variant">
                            Tidak ada respons yang sesuai dengan filter saat ini.
                        </p>
                    </div>
                @endforelse
            </div>
        </section>

        @if ($feedbacks->hasPages())
            <div>
                {{ $feedbacks->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>
