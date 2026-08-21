                {{-- CALENDAR --}}
                <aside class="bg-surface-container-lowest rounded-[20px] border border-outline-variant/25 shadow-[0_10px_28px_rgba(31,73,44,.08)] p-4">

                    <div class="flex items-center gap-2 pb-3 border-b border-outline-variant/20">
                        <span
                            class="material-symbols-outlined text-primary text-[21px]"
                            aria-hidden="true"
                        >
                            calendar_month
                        </span>

                        <div>
                            <h3 class="font-bold text-[17px] text-primary">
                                {{ __('Kalender Kegiatan') }}
                            </h3>

                            <p class="mt-0.5 text-[8.5px] text-on-surface-variant">
                                {{ __('Pilih tanggal untuk melihat agenda.') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-3 mb-2">
                        <button
                            type="button"
                            @click="prevMonth()"
                            class="w-8 h-8 flex items-center justify-center rounded-full text-primary hover:bg-primary/10 transition-colors"
                            aria-label="{{ __('Bulan sebelumnya') }}"
                        >
                            <span
                                class="material-symbols-outlined text-[20px]"
                                aria-hidden="true"
                            >
                                chevron_left
                            </span>
                        </button>

                        <span
                            class="font-bold text-[16px]"
                            x-text="monthLabel()"
                        ></span>

                        <button
                            type="button"
                            @click="nextMonth()"
                            class="w-8 h-8 flex items-center justify-center rounded-full text-primary hover:bg-primary/10 transition-colors"
                            aria-label="{{ __('Bulan berikutnya') }}"
                        >
                            <span
                                class="material-symbols-outlined text-[20px]"
                                aria-hidden="true"
                            >
                                chevron_right
                            </span>
                        </button>
                    </div>

                    <button
                        type="button"
                        @click="goToday()"
                        class="mx-auto mb-3 h-8 px-3.5 rounded-full border border-primary/25 text-primary text-[10px] font-bold flex items-center gap-1.5 hover:bg-primary/[.04] transition-colors"
                    >
                        <span
                            class="material-symbols-outlined text-[15px]"
                            aria-hidden="true"
                        >
                            today
                        </span>

                        {{ __('Agenda Hari Ini') }}
                    </button>

                    <div class="grid grid-cols-7 text-center">
                        @foreach([__('Sen'),__('Sel'),__('Rab'),__('Kam'),__('Jum'),__('Sab'),__('Min')] as $day)
                            <span class="py-1.5 text-[10px] font-bold text-on-surface-variant">
                                {{ $day }}
                            </span>
                        @endforeach

                        <template x-for="d in monthGrid()" :key="iso(d)">
                            <button
                                type="button"
                                @click="pick(d)"
                                class="relative h-9 rounded-lg flex items-center justify-center text-[12px] transition-colors"
                                :class="{
                                    'text-on-surface-variant/35':!isCurrentMonth(d),
                                    'bg-primary text-white font-bold shadow-sm':iso(d)===selectedDate,
                                    'hover:bg-primary/10':iso(d)!==selectedDate
                                }"
                            >
                                <span x-text="d.getDate()"></span>

                                <span
                                    x-show="hasAgenda(d) && iso(d)!==selectedDate"
                                    class="absolute bottom-1 w-1.5 h-1.5 rounded-full bg-primary"
                                ></span>
                            </button>
                        </template>
                    </div>

                    {{-- SELECTED DATE RESULT --}}
                    <div class="border-t border-outline-variant/20 mt-3 pt-3 min-h-[76px] max-h-[150px] overflow-y-auto">

                        <div
                            x-show="loading"
                            class="h-[60px] flex items-center justify-center"
                        >
                            <span
                                class="material-symbols-outlined animate-spin text-primary text-[21px]"
                                aria-hidden="true"
                            >
                                progress_activity
                            </span>
                        </div>

                        <template x-if="!loading && selectedItems.length">
                            <div class="space-y-2">
                                <template x-for="item in selectedItems" :key="item.title+item.starts_at">
                                    <button
                                        type="button"
                                        @click="openAgenda(item)"
                                        class="w-full text-left rounded-[10px] bg-primary/[.045] p-2.5 hover:bg-primary/[.08] transition-colors"
                                    >
                                        <div class="flex items-start justify-between gap-2">
                                            <div class="min-w-0">
                                                <p
                                                    class="text-[11px] font-bold text-primary line-clamp-1"
                                                    x-text="item.title"
                                                ></p>

                                                <p
                                                    class="mt-1 text-[9px] text-on-surface-variant truncate"
                                                    x-text="item.location ?? 'Lokasi belum tersedia'"
                                                ></p>
                                            </div>

                                            <span
                                                class="material-symbols-outlined text-[15px] text-primary shrink-0"
                                                aria-hidden="true"
                                            >
                                                arrow_forward
                                            </span>
                                        </div>
                                    </button>
                                </template>
                            </div>
                        </template>

                        <template x-if="!loading && !selectedItems.length">
                            <div class="h-[60px] flex flex-col items-center justify-center text-center">
                                <span
                                    class="material-symbols-outlined text-[22px] text-on-surface-variant/30"
                                    aria-hidden="true"
                                >
                                    event_busy
                                </span>

                                <p class="text-[10px] font-bold text-primary mt-1">
                                    {{ __('Tidak ada agenda') }}
                                </p>
                            </div>
                        </template>
                    </div>
                </aside>
