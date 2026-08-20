@props(['featuredAgenda','upcomingAgendas','pastAgendas'])

<section
    id="kegiatan"
    class="relative overflow-visible scroll-mt-32 -mt-[2px] pt-[42px] pb-10"
    style="background:linear-gradient(180deg,#f1f7f2 0%,#f3f8f4 18%,#f5f9f5 38%,#f7faf7 58%,#f9fbf9 78%,#fff 100%);"
    x-data="{
        selectedDate:new Date().toISOString().slice(0,10),
        viewYear:new Date().getFullYear(),viewMonth:new Date().getMonth()+1,
        selectedItems:[],agendaDates:[],loading:false,
        iso(d){return d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0')},
        monthLabel(){return new Date(this.viewYear,this.viewMonth-1,1).toLocaleDateString('id-ID',{month:'long',year:'numeric'})},
        monthGrid(){
            const f=new Date(this.viewYear,this.viewMonth-1,1),s=new Date(f);
            s.setDate(s.getDate()-((f.getDay()+6)%7));
            return Array.from({length:42},(_,i)=>{const d=new Date(s);d.setDate(s.getDate()+i);return d})
        },
        isCurrentMonth(d){return d.getMonth()+1===this.viewMonth},
        hasAgenda(d){return this.agendaDates.includes(this.iso(d))},
        prevMonth(){if(--this.viewMonth<1){this.viewMonth=12;this.viewYear--}this.loadMonthDates()},
        nextMonth(){if(++this.viewMonth>12){this.viewMonth=1;this.viewYear++}this.loadMonthDates()},
        goToday(){const d=new Date();this.viewYear=d.getFullYear();this.viewMonth=d.getMonth()+1;this.loadMonthDates();this.pick(d)},
        loadMonthDates(){fetch('{{ route('agenda.dates-in-month') }}?year='+this.viewYear+'&month='+this.viewMonth).then(r=>r.json()).then(d=>this.agendaDates=d)},
        pick(d){this.selectedDate=this.iso(d);this.loading=true;fetch('{{ route('agenda.by-date') }}?date='+this.selectedDate).then(r=>r.json()).then(d=>{this.selectedItems=d;this.loading=false}).catch(()=>this.loading=false)}
    }"
    x-init="pick(new Date());loadMonthDates()"
>
    {{-- background dekoratif --}}
    <div class="absolute inset-x-0 top-0 h-[460px] pointer-events-none z-0" aria-hidden="true">
        <img src="{{ asset('images/leaf-decoration-left.png') }}" alt="" class="absolute top-0 left-[-18px] w-[210px] md:w-[260px] lg:w-[300px] h-auto opacity-60 -scale-y-100" loading="lazy">
        <img src="{{ asset('images/leaf-decoration-right.png') }}" alt="" class="absolute top-0 right-[-12px] w-[220px] md:w-[280px] lg:w-[320px] h-auto opacity-40 -scale-y-100" loading="lazy">
    </div>

    <div class="relative z-10 max-w-[1240px] mx-auto px-4 md:px-6">

        {{-- HEADER --}}
        <div class="text-center mb-7">
            <div class="flex items-center justify-center gap-3 text-primary">
                <span class="material-symbols-outlined opacity-60">eco</span>
                <h2 class="font-serif text-3xl md:text-4xl font-bold">
                    {{ __('Agenda dan Kegiatan BB Pustaka') }}
                </h2>
                <span class="material-symbols-outlined opacity-60 scale-x-[-1]">eco</span>
            </div>
            <p class="mt-2 text-sm text-on-surface-variant">
                {{ __('Ikuti agenda terkini, literasi pertanian, dan dokumentasi kegiatan BB Pustaka.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_360px] gap-4 lg:items-stretch">

            {{-- KIRI --}}
            <div class="min-w-0 space-y-4 lg:space-y-0 lg:h-full lg:flex lg:flex-col lg:justify-between lg:gap-4">

                {{-- TERKINI --}}
                @if($featuredAgenda)
                    <div class="group hover:-translate-y-0.5 transition-transform duration-300">
                        <article class="relative h-[350px] overflow-hidden rounded-t-[20px] bg-primary shadow-md group-hover:shadow-[0_18px_42px_rgba(31,73,44,.16)] transition-shadow duration-300">
                            <img
                                src="{{ $featuredAgenda->image_path ?? 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=1200&q=80' }}"
                                alt="{{ $featuredAgenda->title }}"
                                class="absolute inset-0 w-full h-full object-cover"
                                loading="lazy"
                            >

                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/25 to-transparent"></div>

                            <span class="absolute top-4 left-4 inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary text-white text-[11px] font-bold shadow">
                                <span class="w-2 h-2 rounded-full bg-white"></span>
                                {{ __('Terkini') }}
                            </span>

                            <div class="absolute inset-x-0 bottom-0 p-5 text-white">
                                <div class="flex flex-wrap items-center gap-4 mb-2 text-xs text-white/90">
                                    <span class="inline-flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[17px]">calendar_today</span>
                                        {{ $featuredAgenda->starts_at->translatedFormat('d M Y') }}
                                    </span>

                                    @if($featuredAgenda->location)
                                        <span class="inline-flex items-center gap-1.5">
                                            <span class="material-symbols-outlined text-[17px]">location_on</span>
                                            {{ $featuredAgenda->location }}
                                        </span>
                                    @endif
                                </div>

                                <h3 class="text-xl md:text-2xl font-bold">
                                    {{ $featuredAgenda->title }}
                                </h3>

                                @if($featuredAgenda->description)
                                    <p class="mt-2 text-sm leading-relaxed text-white/90 line-clamp-2">
                                        {{ $featuredAgenda->description }}
                                    </p>
                                @endif
                            </div>
                        </article>

                        {{-- BAR --}}
                        <div class="grid grid-cols-2 md:grid-cols-4 overflow-hidden rounded-b-[20px] bg-white border border-t-0 border-outline-variant/25 shadow-sm group-hover:shadow-[0_12px_30px_rgba(31,73,44,.14)] transition-shadow duration-300 divide-x divide-outline-variant/20">
                            <div class="px-4 py-3 flex items-center gap-2 text-xs hover:bg-primary/[.03] transition-colors">
                                <span class="material-symbols-outlined text-primary text-[18px]">schedule</span>
                                <span>
                                    @if($featuredAgenda->starts_at->format('H:i')==='00:00')
                                        {{ __('Sepanjang Hari') }}
                                    @else
                                        {{ $featuredAgenda->starts_at->format('H:i') }}
                                        @if($featuredAgenda->ends_at)-{{ $featuredAgenda->ends_at->format('H:i') }}@endif WIB
                                    @endif
                                </span>
                            </div>

                            <div class="px-4 py-3 flex items-center gap-2 text-xs min-w-0 hover:bg-primary/[.03] transition-colors">
                                <span class="material-symbols-outlined text-primary text-[18px]">sell</span>
                                <span class="truncate">{{ $featuredAgenda->category ?? __('Agenda') }}</span>
                            </div>

                            <div class="px-4 py-3 flex items-center gap-2 text-xs min-w-0 hover:bg-primary/[.03] transition-colors">
                                <span class="material-symbols-outlined text-primary text-[18px]">location_on</span>
                                <span class="truncate">{{ $featuredAgenda->location ?? '-' }}</span>
                            </div>

                            <div class="px-4 py-3 flex items-center justify-center gap-2 text-xs font-bold text-primary hover:bg-primary/[.03] transition-colors">
                                <span class="w-2 h-2 rounded-full bg-primary"></span>
                                {{ $featuredAgenda->status() }}
                            </div>
                        </div>
                    </div>
                @endif

                {{-- SEBELUMNYA --}}
                @if($pastAgendas->isNotEmpty())
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-[20px]">history</span>
                                    <h3 class="font-bold text-lg text-primary">{{ __('Agenda Sebelumnya') }}</h3>
                                </div>
                                <p class="text-[10px] text-on-surface-variant">{{ __('Dokumentasi agenda yang telah dilaksanakan.') }}</p>
                            </div>
                            <span class="text-[11px] font-bold text-primary">{{ __('Lihat Semua') }}</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            @foreach($pastAgendas->take(3) as $agenda)
                                <article class="group overflow-hidden bg-white rounded-xl border border-outline-variant/25 shadow-sm hover:-translate-y-1 hover:shadow-[0_12px_28px_rgba(31,73,44,.12)] transition-all duration-300">
                                    <div class="h-[125px] overflow-hidden bg-surface">
                                        <img
                                            src="{{ $agenda->image_path ?? 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=500&q=80' }}"
                                            alt="{{ $agenda->title }}"
                                            class="w-full h-full object-cover grayscale opacity-80 group-hover:grayscale-[70%] group-hover:scale-[1.03] transition-all duration-500"
                                            loading="lazy"
                                        >
                                    </div>

                                    <div class="p-3">
                                        <h4 class="text-[12px] font-bold leading-snug line-clamp-2 min-h-[34px]">
                                            {{ $agenda->title }}
                                        </h4>

                                        <div class="mt-2 flex flex-wrap gap-2 text-[9px] text-on-surface-variant">
                                            <span class="inline-flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[13px]">calendar_today</span>
                                                {{ $agenda->starts_at->translatedFormat('d M Y') }}
                                            </span>

                                            @if($agenda->location)
                                                <span class="inline-flex items-center gap-1 min-w-0">
                                                    <span class="material-symbols-outlined text-[13px]">location_on</span>
                                                    <span class="truncate">{{ $agenda->location }}</span>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- KANAN --}}
            <div class="space-y-4 lg:space-y-0 lg:h-full lg:flex lg:flex-col lg:justify-between lg:gap-4">

                {{-- KALENDER --}}
                <aside class="bg-white rounded-[20px] border border-outline-variant/25 shadow-[0_10px_28px_rgba(31,73,44,.08)] p-5">
                    <div class="flex items-center gap-2 pb-3 border-b border-outline-variant/20">
                        <span class="material-symbols-outlined text-primary text-[24px]">calendar_month</span>
                        <h3 class="font-bold text-[20px] text-primary">{{ __('Kalender Kegiatan') }}</h3>
                    </div>

                    <div class="flex items-center justify-between mt-4 mb-3">
                        <button type="button" @click="prevMonth()" class="w-9 h-9 flex items-center justify-center rounded-full text-primary hover:bg-primary/10 transition-colors">
                            <span class="material-symbols-outlined text-[22px]">chevron_left</span>
                        </button>

                        <span class="font-bold text-[18px]" x-text="monthLabel()"></span>

                        <button type="button" @click="nextMonth()" class="w-9 h-9 flex items-center justify-center rounded-full text-primary hover:bg-primary/10 transition-colors">
                            <span class="material-symbols-outlined text-[22px]">chevron_right</span>
                        </button>
                    </div>

                    <button
                        type="button"
                        @click="goToday()"
                        class="mx-auto mb-4 h-10 px-5 rounded-full border border-primary/30 text-primary text-[13px] font-bold flex items-center gap-2 hover:bg-primary/5 transition-colors"
                    >
                        <span class="material-symbols-outlined text-[18px]">today</span>
                        {{ __('Lihat Agenda Hari Ini') }}
                    </button>

                    <div class="grid grid-cols-7 text-center">
                        @foreach([__('Sen'),__('Sel'),__('Rab'),__('Kam'),__('Jum'),__('Sab'),__('Min')] as $day)
                            <span class="py-2 text-[12px] font-bold text-on-surface-variant">{{ $day }}</span>
                        @endforeach

                        <template x-for="d in monthGrid()" :key="iso(d)">
                            <button
                                type="button"
                                @click="pick(d)"
                                class="relative h-10 rounded-lg flex items-center justify-center text-[14px] transition-colors"
                                :class="{
                                    'text-on-surface-variant/35': !isCurrentMonth(d),
                                    'bg-primary text-white font-bold shadow-sm': iso(d) === selectedDate,
                                    'hover:bg-primary/10': iso(d) !== selectedDate
                                }"
                            >
                                <span x-text="d.getDate()"></span>
                                <span
                                    x-show="hasAgenda(d) && iso(d) !== selectedDate"
                                    class="absolute bottom-1.5 w-1.5 h-1.5 rounded-full bg-primary"
                                ></span>
                            </button>
                        </template>
                    </div>

                    <div class="border-t border-outline-variant/20 mt-4 pt-4 h-[82px] overflow-y-auto">
                        <div x-show="loading" class="text-center">
                            <span class="material-symbols-outlined animate-spin text-primary text-[22px]">progress_activity</span>
                        </div>

                        <template x-if="!loading && selectedItems.length">
                            <div class="space-y-2">
                                <template x-for="item in selectedItems" :key="item.id">
                                    <div class="rounded-lg bg-primary/[.05] p-3">
                                        <p class="text-[13px] font-bold text-primary line-clamp-1" x-text="item.title"></p>
                                        <p class="text-[12px] text-on-surface-variant mt-1" x-text="item.location ?? ''"></p>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <template x-if="!loading && !selectedItems.length">
                            <div class="h-[58px] flex flex-col items-center justify-center text-center">
                                <span class="material-symbols-outlined text-[24px] text-on-surface-variant/35">event_busy</span>
                                <p class="text-[12px] font-bold text-primary mt-1">{{ __('Tidak ada agenda') }}</p>
                            </div>
                        </template>
                    </div>
                </aside>

                {{-- MENDATANG --}}
                <aside class="overflow-hidden bg-white rounded-[20px] border border-outline-variant/25 shadow-[0_10px_28px_rgba(31,73,44,.08)]">
                    <div class="flex items-center justify-between px-4 py-3 border-b border-outline-variant/20">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[20px]">event_upcoming</span>
                            <h3 class="font-bold text-base text-primary">{{ __('Agenda Mendatang') }}</h3>
                        </div>
                        <span class="text-[10px] font-bold text-primary">{{ __('Lihat Semua') }}</span>
                    </div>

                    <div class="divide-y divide-outline-variant/20">
                        @forelse($upcomingAgendas->take(3) as $agenda)
                            <article class="group flex gap-3 p-3 hover:bg-primary/[.025] transition-colors">
                                <div class="w-[86px] h-[72px] rounded-lg overflow-hidden shrink-0 bg-surface">
                                    <img
                                        src="{{ $agenda->image_path ?? 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=400&q=80' }}"
                                        alt="{{ $agenda->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy"
                                    >
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="flex gap-2">
                                        <div class="w-10 shrink-0 rounded-md bg-primary text-white text-center py-1">
                                            <strong class="block text-sm leading-none">{{ $agenda->starts_at->format('d') }}</strong>
                                            <span class="text-[8px] uppercase">{{ $agenda->starts_at->translatedFormat('M') }}</span>
                                        </div>

                                        <h4 class="text-[11px] leading-snug font-bold line-clamp-2">
                                            {{ $agenda->title }}
                                        </h4>
                                    </div>

                                    <div class="mt-1.5 space-y-0.5 text-[9px] text-on-surface-variant">
                                        @if($agenda->starts_at->format('H:i')!=='00:00')
                                            <p class="flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[12px]">schedule</span>
                                                {{ $agenda->starts_at->format('H:i') }}
                                                @if($agenda->ends_at)-{{ $agenda->ends_at->format('H:i') }}@endif WIB
                                            </p>
                                        @endif

                                        @if($agenda->location)
                                            <p class="flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[12px]">location_on</span>
                                                <span class="truncate">{{ $agenda->location }}</span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @empty
                            <p class="p-5 text-center text-xs text-on-surface-variant">
                                {{ __('Belum ada agenda mendatang.') }}
                            </p>
                        @endforelse
                    </div>
                </aside>

            </div>
        </div>
    </div>
</section>