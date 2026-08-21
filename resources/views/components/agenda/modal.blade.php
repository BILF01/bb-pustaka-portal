    {{-- DETAIL MODAL / BOTTOM SHEET --}}
    <div
        x-show="modalOpen"
        x-cloak
        class="fixed inset-0 z-[250] flex items-end md:items-center justify-center md:p-6"
        role="dialog"
        aria-modal="true"
        aria-label="{{ __('Detail agenda') }}"
    >
        <button
            type="button"
            @click="closeAgenda()"
            class="absolute inset-0 bg-black/45 backdrop-blur-[2px]"
            aria-label="{{ __('Tutup detail agenda') }}"
        ></button>

        <div
            x-show="modalOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-6 md:translate-y-2 md:scale-[.98]"
            x-transition:enter-end="opacity-100 translate-y-0 md:scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0 md:scale-100"
            x-transition:leave-end="opacity-0 translate-y-6 md:translate-y-2 md:scale-[.98]"
            class="relative w-full md:max-w-[620px] max-h-[88vh] overflow-y-auto rounded-t-[26px] md:rounded-[24px] bg-white shadow-[0_24px_70px_rgba(0,0,0,.22)]"
        >
            {{-- IMAGE --}}
            <template x-if="activeAgenda?.image_path">
                <div class="relative h-[180px] md:h-[230px] overflow-hidden">
                    <img
                        :src="activeAgenda.image_path"
                        :alt="activeAgenda.title"
                        class="w-full h-full object-cover"
                    >

                    <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-transparent to-transparent"></div>
                </div>
            </template>

            <button
                type="button"
                @click="closeAgenda()"
                class="absolute top-3 right-3 z-10 w-9 h-9 rounded-full bg-white/95 text-on-surface flex items-center justify-center shadow"
                aria-label="{{ __('Tutup') }}"
            >
                <span
                    class="material-symbols-outlined text-[20px]"
                    aria-hidden="true"
                >
                    close
                </span>
            </button>

            <div class="p-5 md:p-6">
                <div class="flex flex-wrap items-center gap-2 mb-3">
                    <span
                        class="inline-flex items-center gap-1.5 h-6 px-2.5 rounded-full bg-primary/[.08] text-primary text-[8.5px] font-extrabold uppercase tracking-[.06em]"
                    >
                        <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>

                        <span x-text="statusLabel(activeAgenda)"></span>
                    </span>

                    <template x-if="activeAgenda?.category">
                        <span
                            class="inline-flex items-center h-6 px-2.5 rounded-full border border-primary/10 text-[8.5px] font-bold text-on-surface-variant"
                            x-text="activeAgenda.category"
                        ></span>
                    </template>
                </div>

                <h3
                    class="font-serif text-[22px] md:text-[26px] font-bold leading-[1.25] text-primary-container"
                    x-text="activeAgenda?.title"
                ></h3>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <div class="rounded-[12px] bg-surface-container-low p-3">
                        <span class="flex items-center gap-1.5 text-[8px] font-bold uppercase tracking-wide text-on-surface-variant">
                            <span
                                class="material-symbols-outlined text-[14px] text-primary"
                                aria-hidden="true"
                            >
                                calendar_today
                            </span>

                            {{ __('Tanggal') }}
                        </span>

                        <strong
                            class="block mt-1 text-[11px] text-on-surface"
                            x-text="formatDate(activeAgenda?.starts_at)"
                        ></strong>
                    </div>

                    <div class="rounded-[12px] bg-surface-container-low p-3">
                        <span class="flex items-center gap-1.5 text-[8px] font-bold uppercase tracking-wide text-on-surface-variant">
                            <span
                                class="material-symbols-outlined text-[14px] text-primary"
                                aria-hidden="true"
                            >
                                schedule
                            </span>

                            {{ __('Waktu') }}
                        </span>

                        <strong
                            class="block mt-1 text-[11px] text-on-surface"
                            x-text="formatTimeRange(activeAgenda?.starts_at,activeAgenda?.ends_at)"
                        ></strong>
                    </div>

                    <div class="rounded-[12px] bg-surface-container-low p-3">
                        <span class="flex items-center gap-1.5 text-[8px] font-bold uppercase tracking-wide text-on-surface-variant">
                            <span
                                class="material-symbols-outlined text-[14px] text-primary"
                                aria-hidden="true"
                            >
                                location_on
                            </span>

                            {{ __('Lokasi') }}
                        </span>

                        <strong
                            class="block mt-1 text-[11px] text-on-surface line-clamp-2"
                            x-text="activeAgenda?.location || '-'"
                        ></strong>
                    </div>
                </div>

                <template x-if="activeAgenda?.description">
                    <div class="mt-5 pt-5 border-t border-outline-variant/20">
                        <p class="text-[9px] font-bold uppercase tracking-[.08em] text-primary">
                            {{ __('Tentang Kegiatan') }}
                        </p>

                        <p
                            class="mt-2 text-[12px] md:text-[13px] leading-[1.75] text-on-surface-variant whitespace-pre-line"
                            x-text="activeAgenda.description"
                        ></p>
                    </div>
                </template>

                <button
                    type="button"
                    @click="closeAgenda()"
                    class="mt-5 w-full h-10 rounded-xl bg-primary text-on-primary text-[11px] font-bold hover:bg-primary-container transition-colors"
                >
                    {{ __('Tutup') }}
                </button>
            </div>
        </div>
    </div>
