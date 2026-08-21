@props(['pastAgendas'])

@if($pastAgendas->isNotEmpty())
    <section>
        <div class="flex items-end justify-between gap-4 mb-3">
            <div>
                <div class="flex items-center gap-2">
                    <span
                        class="material-symbols-outlined text-primary text-[19px]"
                        aria-hidden="true"
                    >
                        history
                    </span>

                    <h3 class="font-bold text-[17px] text-primary">
                        {{ __('Agenda Sebelumnya') }}
                    </h3>
                </div>

                <p class="mt-0.5 text-[9.5px] text-on-surface-variant">
                    {{ __('Dokumentasi kegiatan yang telah dilaksanakan.') }}
                </p>
            </div>

            @if($pastAgendas->count()>3)
                <span class="hidden sm:inline-flex items-center gap-1 text-[9px] font-semibold text-on-surface-variant">
                    {{ __('Geser untuk melihat lainnya') }}

                    <span
                        class="material-symbols-outlined text-[14px] text-primary"
                        aria-hidden="true"
                    >
                        arrow_forward
                    </span>
                </span>
            @endif
        </div>

        <div
            class="flex gap-3 overflow-x-auto overscroll-x-contain scroll-smooth snap-x snap-mandatory pb-2 [&::-webkit-scrollbar]:hidden"
            style="scrollbar-width:none;"
        >
            @foreach($pastAgendas as $agenda)
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
                    @keydown.enter.prevent="$el.click()"
                    @keydown.space.prevent="$el.click()"
                    class="group flex-none w-[82%] sm:w-[48%] lg:w-[32%] snap-start cursor-pointer overflow-hidden bg-surface-container-lowest rounded-[14px] border border-outline-variant/25 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_10px_26px_rgba(31,73,44,.10)] focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/40"
                >
                    <div class="relative h-[118px] overflow-hidden bg-surface">
                        @if($agenda->image_path)
                            <img
                                src="{{ $agenda->image_path }}"
                                alt="{{ $agenda->title }}"
                                class="w-full h-full object-cover grayscale-[35%] transition-all duration-500 group-hover:grayscale-0 group-hover:scale-[1.025]"
                                loading="lazy"
                            >
                        @else
                            <div class="absolute inset-0 flex items-center justify-center bg-primary/[.06]">
                                <span
                                    class="material-symbols-outlined text-[34px] text-primary/30"
                                    aria-hidden="true"
                                >
                                    event
                                </span>
                            </div>
                        @endif

                        <span class="absolute left-2.5 bottom-2.5 inline-flex items-center h-5 px-2 rounded-full bg-white/90 text-primary text-[7.5px] font-extrabold">
                            {{ $agenda->status() }}
                        </span>
                    </div>

                    <div class="p-3">
                        <div class="flex items-start gap-2">
                            <h4 class="min-h-[34px] flex-1 text-[11.5px] font-bold leading-[1.45] line-clamp-2 group-hover:text-primary transition-colors">
                                {{ $agenda->title }}
                            </h4>

                            <span
                                class="material-symbols-outlined shrink-0 mt-0.5 text-[16px] text-primary/30 group-hover:text-primary group-hover:translate-x-0.5 transition-all"
                                aria-hidden="true"
                            >
                                chevron_right
                            </span>
                        </div>

                        <div class="mt-2 space-y-1 text-[8.5px] text-on-surface-variant">
                            <span class="flex items-center gap-1">
                                <span
                                    class="material-symbols-outlined text-[12px]"
                                    aria-hidden="true"
                                >
                                    calendar_today
                                </span>

                                {{ $agenda->starts_at->translatedFormat('d M Y') }}
                            </span>

                            @if($agenda->location)
                                <span class="flex items-center gap-1 min-w-0">
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
                </article>
            @endforeach
        </div>
    </section>
@endif