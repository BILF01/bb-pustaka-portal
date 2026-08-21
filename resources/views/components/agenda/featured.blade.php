@props(['featuredAgenda'])

@if($featuredAgenda)
    <div
        class="group cursor-pointer rounded-[20px] focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/40"
        role="button"
        tabindex="0"
        aria-label="{{ __('Lihat detail agenda: :title',['title'=>$featuredAgenda->title]) }}"
        @click="openAgenda({
            title:@js($featuredAgenda->title),
            description:@js($featuredAgenda->description),
            location:@js($featuredAgenda->location),
            category:@js($featuredAgenda->category ?? __('Agenda')),
            starts_at:@js($featuredAgenda->starts_at?->toIso8601String()),
            ends_at:@js($featuredAgenda->ends_at?->toIso8601String()),
            image_path:@js($featuredAgenda->image_path),
            status:@js($featuredAgenda->status())
        })"
        @keydown.enter.prevent="$el.click()"
        @keydown.space.prevent="$el.click()"
    >
        <article class="relative h-[250px] md:h-[290px] lg:h-[460px] overflow-hidden rounded-t-[20px] bg-primary shadow-md transition-shadow duration-300 group-hover:shadow-[0_18px_42px_rgba(31,73,44,.15)]">

            @if($featuredAgenda->image_path)
                <img
                    src="{{ $featuredAgenda->image_path }}"
                    alt="{{ $featuredAgenda->title }}"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.02]"
                    loading="lazy"
                >
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary-container to-primary"></div>

                <span
                    class="material-symbols-outlined absolute right-8 top-1/2 -translate-y-1/2 text-[110px] text-white/10"
                    aria-hidden="true"
                >
                    event
                </span>
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-black/5"></div>

            <span class="absolute top-4 left-4 inline-flex items-center gap-2 h-7 px-3 rounded-full bg-white/95 text-primary text-[9px] font-extrabold uppercase tracking-[.07em] shadow">
                <span class="relative flex w-2 h-2">
                    <span class="absolute inline-flex w-full h-full rounded-full bg-primary/30 animate-ping"></span>
                    <span class="relative inline-flex w-2 h-2 rounded-full bg-primary"></span>
                </span>

                {{ $featuredAgenda->status() }}
            </span>

            <div class="absolute inset-x-0 bottom-0 p-4 md:p-5 text-white">
                <div class="flex flex-wrap items-center gap-x-4 gap-y-1.5 mb-2 text-[10px] md:text-[11px] text-white/90">
                    <span class="inline-flex items-center gap-1.5">
                        <span
                            class="material-symbols-outlined text-[16px]"
                            aria-hidden="true"
                        >
                            calendar_today
                        </span>

                        {{ $featuredAgenda->starts_at->translatedFormat('d M Y') }}
                    </span>

                    @if($featuredAgenda->starts_at->format('H:i')==='00:00')
                        <span class="inline-flex items-center gap-1.5">
                            <span
                                class="material-symbols-outlined text-[16px]"
                                aria-hidden="true"
                            >
                                schedule
                            </span>

                            {{ __('Sepanjang Hari') }}
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5">
                            <span
                                class="material-symbols-outlined text-[16px]"
                                aria-hidden="true"
                            >
                                schedule
                            </span>

                            {{ $featuredAgenda->starts_at->format('H:i') }}

                            @if($featuredAgenda->ends_at)
                                –{{ $featuredAgenda->ends_at->format('H:i') }}
                            @endif

                            WIB
                        </span>
                    @endif

                    @if($featuredAgenda->location)
                        <span class="inline-flex items-center gap-1.5">
                            <span
                                class="material-symbols-outlined text-[16px]"
                                aria-hidden="true"
                            >
                                location_on
                            </span>

                            {{ $featuredAgenda->location }}
                        </span>
                    @endif
                </div>

                <h3 class="max-w-[760px] text-[18px] md:text-[22px] font-bold leading-[1.3]">
                    {{ $featuredAgenda->title }}
                </h3>

                @if($featuredAgenda->description)
                    <p class="mt-2 max-w-[760px] text-[11px] md:text-[12px] leading-[1.6] text-white/85 line-clamp-2">
                        {{ $featuredAgenda->description }}
                    </p>
                @endif
            </div>
        </article>

        <div class="grid grid-cols-2 md:grid-cols-4 overflow-hidden rounded-b-[20px] bg-surface-container-lowest border border-t-0 border-outline-variant/25 shadow-sm divide-x divide-outline-variant/20 group-hover:bg-primary/[.012] transition-colors">

            <div class="px-3 md:px-4 py-3 flex items-center gap-2 text-[10px] md:text-[11px]">
                <span
                    class="material-symbols-outlined text-primary text-[17px]"
                    aria-hidden="true"
                >
                    event
                </span>

                <div>
                    <span class="block text-[8px] uppercase tracking-wide text-on-surface-variant">
                        {{ __('Tanggal') }}
                    </span>

                    <strong class="font-bold text-on-surface">
                        {{ $featuredAgenda->starts_at->translatedFormat('d M Y') }}
                    </strong>
                </div>
            </div>

            <div class="px-3 md:px-4 py-3 flex items-center gap-2 text-[10px] md:text-[11px] min-w-0">
                <span
                    class="material-symbols-outlined text-primary text-[17px]"
                    aria-hidden="true"
                >
                    sell
                </span>

                <div class="min-w-0">
                    <span class="block text-[8px] uppercase tracking-wide text-on-surface-variant">
                        {{ __('Kategori') }}
                    </span>

                    <strong class="block truncate font-bold text-on-surface">
                        {{ $featuredAgenda->category ?? __('Agenda') }}
                    </strong>
                </div>
            </div>

            <div class="px-3 md:px-4 py-3 flex items-center gap-2 text-[10px] md:text-[11px] min-w-0">
                <span
                    class="material-symbols-outlined text-primary text-[17px]"
                    aria-hidden="true"
                >
                    location_on
                </span>

                <div class="min-w-0">
                    <span class="block text-[8px] uppercase tracking-wide text-on-surface-variant">
                        {{ __('Lokasi') }}
                    </span>

                    <strong class="block truncate font-bold text-on-surface">
                        {{ $featuredAgenda->location ?? '-' }}
                    </strong>
                </div>
            </div>

            <div class="px-3 md:px-4 py-3 flex items-center gap-2 text-[10px] md:text-[11px] min-w-0">
                <span
                    class="material-symbols-outlined text-primary text-[17px]"
                    aria-hidden="true"
                >
                    schedule
                </span>

                <div class="min-w-0">
                    <span class="block text-[8px] uppercase tracking-wide text-on-surface-variant">
                        {{ __('Waktu') }}
                    </span>

                    <strong class="block truncate font-bold text-on-surface">
                        @if($featuredAgenda->starts_at->format('H:i')==='00:00')
                            {{ __('Sepanjang Hari') }}
                        @else
                            {{ $featuredAgenda->starts_at->format('H:i') }}
                            @if($featuredAgenda->ends_at)
                                –{{ $featuredAgenda->ends_at->format('H:i') }}
                            @endif
                            WIB
                        @endif
                    </strong>
                </div>
            </div>
        </div>
    </div>
@endif