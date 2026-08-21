@props(['upcomingAgendas'])

<aside class="overflow-hidden bg-surface-container-lowest rounded-[20px] border border-outline-variant/25 shadow-[0_10px_28px_rgba(31,73,44,.08)]">
    <div class="flex items-center justify-between gap-3 px-4 py-3 border-b border-outline-variant/20">
        <div class="flex items-center gap-2">
            <span
                class="material-symbols-outlined text-primary text-[19px]"
                aria-hidden="true"
            >
                event_upcoming
            </span>

            <div>
                <h3 class="font-bold text-[15px] text-primary">
                    {{ __('Agenda Mendatang') }}
                </h3>

                @if($upcomingAgendas->count()>3)
                    <p class="mt-0.5 text-[8px] text-on-surface-variant">
                        {{ __('Scroll untuk melihat agenda lainnya.') }}
                    </p>
                @endif
            </div>
        </div>

        @if($upcomingAgendas->isNotEmpty())
            <span class="inline-flex items-center justify-center min-w-6 h-6 px-1.5 rounded-full bg-primary/[.08] text-primary text-[8px] font-extrabold">
                {{ $upcomingAgendas->count() }}
            </span>
        @endif
    </div>

    <div
        class="max-h-[260px] overflow-y-auto overscroll-y-contain divide-y divide-outline-variant/20"
        style="scrollbar-width:thin;scrollbar-color:rgba(31,73,44,.28) transparent;"
    >
        @forelse($upcomingAgendas as $agenda)
            <article
                role="button"
                tabindex="0"
                aria-label="{{ __('Lihat detail agenda: :title',['title'=>$agenda->title]) }}"
                @click="openAgenda({
                    title:@js($agenda->title),
                    description:@js($agenda->description),
                    location:@js($agenda->location),
                    category:@js($agenda->category ?? __('Agenda')),
                    starts_at:@js($agenda->starts_at?->toIso8601String()),
                    ends_at:@js($agenda->ends_at?->toIso8601String()),
                    image_path:@js($agenda->image_path),
                    status:@js($agenda->status())
                })"
                @keydown.enter.prevent="openAgenda({
                    title:@js($agenda->title),
                    description:@js($agenda->description),
                    location:@js($agenda->location),
                    category:@js($agenda->category ?? __('Agenda')),
                    starts_at:@js($agenda->starts_at?->toIso8601String()),
                    ends_at:@js($agenda->ends_at?->toIso8601String()),
                    image_path:@js($agenda->image_path),
                    status:@js($agenda->status())
                })"
                @keydown.space.prevent="openAgenda({
                    title:@js($agenda->title),
                    description:@js($agenda->description),
                    location:@js($agenda->location),
                    category:@js($agenda->category ?? __('Agenda')),
                    starts_at:@js($agenda->starts_at?->toIso8601String()),
                    ends_at:@js($agenda->ends_at?->toIso8601String()),
                    image_path:@js($agenda->image_path),
                    status:@js($agenda->status())
                })"
                class="group relative p-3 cursor-pointer hover:bg-primary/[.045] focus:outline-none focus-visible:bg-primary/[.055] transition-colors"
            >
                <div class="flex gap-3">
                    <div class="w-[48px] h-[52px] shrink-0 rounded-[10px] bg-primary text-white flex flex-col items-center justify-center shadow-sm">
                        <strong class="text-[16px] leading-none">
                            {{ $agenda->starts_at->format('d') }}
                        </strong>

                        <span class="mt-1 text-[8px] font-bold uppercase">
                            {{ $agenda->starts_at->translatedFormat('M') }}
                        </span>
                    </div>

                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-2">
                            <h4 class="text-[11px] leading-[1.4] font-bold line-clamp-2 group-hover:text-primary transition-colors">
                                {{ $agenda->title }}
                            </h4>

                            <span class="shrink-0 inline-flex items-center h-5 px-2 rounded-full bg-primary/[.07] text-primary text-[7px] font-extrabold">
                                {{ $agenda->status() }}
                            </span>
                        </div>

                        <div class="mt-1.5 flex flex-wrap gap-x-3 gap-y-1 text-[8.5px] text-on-surface-variant">
                            @if($agenda->starts_at->format('H:i')==='00:00')
                                <span class="inline-flex items-center gap-1">
                                    <span
                                        class="material-symbols-outlined text-[12px]"
                                        aria-hidden="true"
                                    >
                                        schedule
                                    </span>

                                    {{ __('Sepanjang Hari') }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1">
                                    <span
                                        class="material-symbols-outlined text-[12px]"
                                        aria-hidden="true"
                                    >
                                        schedule
                                    </span>

                                    {{ $agenda->starts_at->format('H:i') }}

                                    @if($agenda->ends_at)
                                        –{{ $agenda->ends_at->format('H:i') }}
                                    @endif

                                    WIB
                                </span>
                            @endif

                            @if($agenda->location)
                                <span class="inline-flex items-center gap-1 min-w-0 max-w-[150px]">
                                    <span
                                        class="material-symbols-outlined text-[12px]"
                                        aria-hidden="true"
                                    >
                                        location_on
                                    </span>

                                    <span class="truncate">
                                        {{ $agenda->location }}
                                    </span>
                                </span>
                            @endif
                        </div>
                    </div>

                    <span
                        class="material-symbols-outlined self-center shrink-0 text-[17px] text-primary/35 group-hover:text-primary group-hover:translate-x-0.5 transition-all"
                        aria-hidden="true"
                    >
                        chevron_right
                    </span>
                </div>
            </article>
        @empty
            <div class="px-5 py-8 text-center">
                <span
                    class="material-symbols-outlined text-[26px] text-on-surface-variant/30"
                    aria-hidden="true"
                >
                    event_busy
                </span>

                <p class="mt-2 text-[10px] text-on-surface-variant">
                    {{ __('Belum ada agenda mendatang.') }}
                </p>
            </div>
        @endforelse
    </div>
</aside>