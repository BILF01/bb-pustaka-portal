<div x-data="{ open: false, sending: false, sent: false, level: 0, foundInfo: null, message: '', desired: '' }">
    <button type="button" @click="open = true" class="group w-full p-5 bg-white/90 hover:bg-white backdrop-blur-sm border border-outline-variant/30 rounded-2xl text-left shadow-sm hover:shadow-md transition-all">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined" aria-hidden="true">forum</span>
            </div>

            <div class="flex-1 min-w-0">
                <span class="block font-bold text-primary">{{ t('Beri Umpan Balik') }}</span>
                <span class="block mt-1 text-sm leading-relaxed text-on-surface-variant">
                    {{ __('Pendapat Anda sangat berarti untuk meningkatkan layanan kami.') }}
                </span>

                <span class="inline-flex items-center gap-1 mt-4 text-sm font-bold text-primary">
                    {{ __('Sampaikan Masukan') }}
                    <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform" aria-hidden="true">arrow_forward</span>
                </span>
            </div>
        </div>
    </button>

    <div x-show="open" x-cloak style="display:none" x-transition class="fixed inset-0 z-[110] bg-black/50 flex items-center justify-center p-4" @keydown.escape.window="open = false">
        <div @click.outside="open = false" class="bg-white text-on-surface rounded-xl shadow-2xl w-full max-w-md max-h-[85vh] overflow-y-auto p-6" role="dialog" aria-modal="true" aria-label="Umpan Balik Portal">
            <h2 class="text-lg font-bold text-primary mb-4">{{ t('Berikan Masukan untuk Perbaikan Portal BB Pustaka') }}</h2>

            <template x-if="!sent">
                <form @submit.prevent="
                    sending = true;
                    fetch('{{ route('feedback.store') }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content, Accept: 'application/json' },
                        body: JSON.stringify({ satisfaction_level: level, found_information: foundInfo, message: message, desired_feature: desired })
                    }).then(() => { sending = false; sent = true; }).catch(() => { sending = false; })
                " class="space-y-5">
                    <div>
                        <p class="text-sm font-semibold mb-2">{{ t('Seberapa Puas Anda dengan Portal Ini?') }}</p>
                        <div class="flex gap-2">
                            <template x-for="i in 5" :key="i">
                                <button type="button" @click="level = i" :class="level === i ? 'bg-primary/10 ring-2 ring-primary' : 'bg-surface-container-low'" class="flex-1 py-2 rounded-lg text-2xl">
                                    <span x-text="['😞','😐','🙂','😄','🥰'][i-1]"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-semibold mb-2">{{ t('Apakah Anda dapat menemukan berita/informasi/layanan yang Anda cari?') }} <span class="text-error">*</span></p>
                        <div class="flex gap-4 text-sm">
                            <label class="flex items-center gap-2"><input type="radio" @change="foundInfo = false" name="found"> {{ t('Tidak') }}</label>
                            <label class="flex items-center gap-2"><input type="radio" @change="foundInfo = true" name="found"> {{ t('Ya') }}</label>
                        </div>
                    </div>

                    <div>
                        <label for="fb-message" class="text-sm font-semibold block mb-1">{{ t('Kritik dan saran Anda untuk portal ini?') }} <span class="text-error">*</span></label>
                        <textarea id="fb-message" x-model="message" maxlength="500" rows="3" required placeholder="{{ t('Masukkan jawaban Anda di sini') }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm"></textarea>
                        <p class="text-xs text-on-surface-variant mt-1" x-text="(500 - message.length) + ' karakter tersisa'"></p>
                    </div>

                    <div>
                        <label for="fb-desired" class="text-sm font-semibold block mb-1">{{ t('Fitur apa yang Anda inginkan namun belum tersedia?') }}</label>
                        <textarea id="fb-desired" x-model="desired" maxlength="500" rows="2" placeholder="{{ t('Opsional') }}" class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm"></textarea>
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" @click="open = false" class="px-5 h-11 border border-outline-variant rounded-lg font-semibold text-sm">{{ t('Tutup') }}</button>
                        <button type="submit" :disabled="sending || !level || foundInfo === null || !message" class="px-5 h-11 bg-primary text-on-primary rounded-lg font-bold text-sm disabled:opacity-40">
                            <span x-text="sending ? '{{ t('Mengirim...') }}' : '{{ t('Kirim Masukan') }}'"></span>
                        </button>
                    </div>
                </form>
            </template>

            <template x-if="sent">
                <div class="text-center py-8">
                    <span class="material-symbols-outlined text-primary text-5xl" aria-hidden="true">check_circle</span>
                    <p class="mt-3 font-semibold">{{ t('Terima kasih atas masukan Anda.') }}</p>
                    <button type="button" @click="open = false" class="mt-4 px-5 h-11 bg-primary text-on-primary rounded-lg font-bold text-sm">{{ t('Tutup') }}</button>
                </div>
            </template>
        </div>
    </div>
</div>