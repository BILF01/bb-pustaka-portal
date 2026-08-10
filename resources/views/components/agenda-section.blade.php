@props(['featuredAgenda', 'otherAgendas'])

<section class="py-16 max-w-[1280px] mx-auto px-6" x-data="{
    selectedDate: new Date().toISOString().slice(0,10),
    weekOffset: 0,
    selectedItems: [],
    loading: false,
    days() {
        const base = new Date();
        base.setDate(base.getDate() - base.getDay() + 1 + (this.weekOffset * 7));
        return Array.from({length: 7}, (_, i) => {
            const d = new Date(base);
            d.setDate(base.getDate() + i);
            return d;
        });
    },
    pick(date) {
        const iso = date.toISOString().slice(0, 10);
        this.selectedDate = iso;
        this.loading = true;
        fetch('{{ route('agenda.by-date') }}?date=' + iso)
            .then(r => r.json())
            .then(data => { this.selectedItems = data; this.loading = false; });
    }
}" x-init="pick(new Date())">
    <div class="text-center mb-10">
        <h2 class="text-2xl md:text-headline-lg font-bold text-primary uppercase tracking-tight">{{ __('Agenda') }}</h2>
        <p class="text-on-surface-variant mt-2">{{ __('Agenda dan kegiatan terbaru dari BB Pustaka.') }}</p>
    </div>

    @if ($featuredAgenda)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div
                class="lg:col-span-2 bg-white rounded-xl border border-outline-variant/30 shadow-sm overflow-hidden"
                x-data="{ expanded: false }"
            >
                <div class="relative aspect-video">
                    <img src="{{ $featuredAgenda->image_path ?? 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=1000&q=80' }}" alt="{{ $featuredAgenda->title }}" class="w-full h-full object-cover" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-5 text-white">
                        <h3 class="text-xl font-bold">{{ $featuredAgenda->title }}</h3>
                        <p class="text-sm text-white/90 mt-1">
                            {{ $featuredAgenda->starts_at->format('H:i') }}{{ $featuredAgenda->ends_at ? '-'.$featuredAgenda->ends_at->format('H:i') : '' }} WIB &middot; {{ $featuredAgenda->starts_at->translatedFormat('l, d F Y') }}
                        </p>
                    </div>
                </div>

                <div class="p-5">
                    <p class="text-sm text-on-surface-variant" :class="expanded ? '' : 'line-clamp-2'">
                        {{ $featuredAgenda->description }}
                    </p>
                    <button type="button" @click="expanded = !expanded" class="text-primary text-sm font-bold mt-1" x-text="expanded ? '{{ __('Sembunyikan') }}' : '{{ __('Selengkapnya') }}'"></button>

                    <div class="flex flex-wrap gap-2 mt-4">
                        @if ($featuredAgenda->category)
                            <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $featuredAgenda->statusColor() }}">{{ $featuredAgenda->category }}</span>
                        @endif
                        <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $featuredAgenda->statusColor() }}">{{ $featuredAgenda->status() }}</span>
                        @if ($featuredAgenda->location)
                            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-surface-container text-on-surface-variant flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm" aria-hidden="true">location_on</span>{{ $featuredAgenda->location }}
                            </span>
                        @endif
                    </div>

                    @if ($featuredAgenda->status() === 'Akan Dimulai')
                        <div
                            class="mt-4 flex gap-3"
                            x-data="{ remaining: {}, target: new Date('{{ $featuredAgenda->starts_at->toIso8601String() }}').getTime() }"
                            x-init="setInterval(() => {
                                const diff = Math.max(0, target - Date.now());
                                remaining = {
                                    d: Math.floor(diff / 86400000),
                                    h: Math.floor(diff / 3600000) % 24,
                                    m: Math.floor(diff / 60000) % 60,
                                    s: Math.floor(diff / 1000) % 60,
                                };
                            }, 1000)"
                        >
                            <template x-for="[label, val] in Object.entries({ '{{ __('Hari') }}':'d', '{{ __('Jam') }}':'h', '{{ __('Menit') }}':'m', '{{ __('Detik') }}':'s' })" :key="label">
                                <div class="bg-surface-container-low rounded-lg px-3 py-2 text-center min-w-[56px]">
                                    <div class="font-bold text-primary" x-text="String(remaining[val]).padStart(2,'0')"></div>
                                    <div class="text-[10px] text-on-surface-variant" x-text="label"></div>
                                </div>
                            </template>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-xl border border-outline-variant/30 shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <button type="button" @click="weekOffset--" class="p-1 text-on-surface-variant hover:text-primary">
                        <span class="material-symbols-outlined" aria-hidden="true">chevron_left</span>
                    </button>
                    <span class="text-sm font-semibold" x-text="new Date().toLocaleDateString('id-ID', { month: 'long', year: 'numeric' })"></span>
                    <button type="button" @click="weekOffset++" class="p-1 text-on-surface-variant hover:text-primary">
                        <span class="material-symbols-outlined" aria-hidden="true">chevron_right</span>
                    </button>
                </div>

                <div class="grid grid-cols-7 gap-1">
                    <template x-for="d in days()" :key="d.toISOString()">
                        <button
                            type="button"
                            @click="pick(d)"
                            :class="d.toISOString().slice(0,10) === selectedDate ? 'bg-primary text-on-primary' : 'hover:bg-surface-container-low'"
                            class="flex flex-col items-center py-2 rounded-lg transition-colors min-h-[44px]"
                        >
                            <span class="text-[9px] uppercase" x-text="d.toLocaleDateString('id-ID', { weekday: 'short' })"></span>
                            <span class="font-bold text-sm" x-text="d.getDate()"></span>
                        </button>
                    </template>
                </div>

                <div class="mt-5 border-t border-outline-variant/20 pt-4">
                    <template x-if="loading">
                        <p class="text-center text-xs text-on-surface-variant py-6">{{ __('Memuat...') }}</p>
                    </template>
                    <template x-if="!loading && selectedItems.length === 0">
                        <div class="text-center py-6">
                            <span class="material-symbols-outlined text-on-surface-variant text-4xl" aria-hidden="true">event_busy</span>
                            <p class="font-bold text-primary text-sm mt-2">{{ __('Tidak ada agenda') }}</p>
                            <p class="text-xs text-on-surface-variant">{{ __('Belum ada agenda untuk tanggal ini') }}</p>
                        </div>
                    </template>
                    <template x-for="item in selectedItems" :key="item.title">
                        <div class="py-2 border-b border-outline-variant/10 last:border-0">
                            <p class="text-sm font-semibold" x-text="item.title"></p>
                            <p class="text-xs text-on-surface-variant" x-text="item.starts_at.slice(11,16) + ' WIB'"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    @endif

    @if ($otherAgendas->isNotEmpty())
        <div class="bg-white rounded-xl border border-outline-variant/30 shadow-sm divide-y divide-outline-variant/10">
            @foreach ($otherAgendas as $agenda)
                <div class="flex items-center gap-4 p-4">
                    <img src="{{ $agenda->image_path ?? 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=200&q=80' }}" alt="{{ $agenda->title }}" class="w-14 h-14 rounded-lg object-cover shrink-0" loading="lazy">
                    <div class="min-w-0 flex-1">
                        <p class="font-semibold truncate">{{ $agenda->title }}</p>
                        <p class="text-xs text-on-surface-variant">{{ $agenda->starts_at->translatedFormat('d M Y, H:i') }} @if($agenda->category) &middot; {{ $agenda->category }} @endif</p>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 rounded-full shrink-0 {{ $agenda->statusColor() }}">{{ $agenda->status() }}</span>
                </div>
            @endforeach
        </div>
    @endif
</section>