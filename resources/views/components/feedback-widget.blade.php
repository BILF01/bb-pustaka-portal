<div
    x-data="{
        open: false,
        sending: false,
        sent: false,
        level: 0,
        foundInfo: null,
        message: '',
        desired: '',
        ratings: [
            {
                value: 1,
                emoji: String.fromCodePoint(0x1F61E),
                label: 'Sangat tidak puas'
            },
            {
                value: 2,
                emoji: String.fromCodePoint(0x1F610),
                label: 'Tidak puas'
            },
            {
                value: 3,
                emoji: String.fromCodePoint(0x1F642),
                label: 'Cukup puas'
            },
            {
                value: 4,
                emoji: String.fromCodePoint(0x1F604),
                label: 'Puas'
            },
            {
                value: 5,
                emoji: String.fromCodePoint(0x1F970),
                label: 'Sangat puas'
            }
        ],

        closeModal() {
            this.open = false;
        },

        resetForm() {
            this.sending = false;
            this.sent = false;
            this.level = 0;
            this.foundInfo = null;
            this.message = '';
            this.desired = '';
        },

        closeSuccess() {
            this.open = false;

            setTimeout(() => {
                this.resetForm();
            }, 200);
        }
    }"
>
    <button
        type="button"
        @click="open = true"
        class="group w-full rounded-2xl border border-outline-variant/30 bg-white/90 p-5 text-left shadow-sm backdrop-blur-sm transition-all hover:bg-white hover:shadow-md"
    >
        <div class="flex items-start gap-3">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                <span
                    class="material-symbols-outlined"
                    aria-hidden="true"
                >
                    forum
                </span>
            </div>

            <div class="min-w-0 flex-1">
                <span class="block font-bold text-primary">
                    {{ t('Beri Umpan Balik') }}
                </span>

                <span class="mt-1 block text-sm leading-relaxed text-on-surface-variant">
                    {{ __('Pendapat Anda sangat berarti untuk meningkatkan layanan kami.') }}
                </span>

                <span class="mt-4 inline-flex items-center gap-1 text-sm font-bold text-primary">
                    {{ __('Sampaikan Masukan') }}

                    <span
                        class="material-symbols-outlined text-[18px] transition-transform group-hover:translate-x-1"
                        aria-hidden="true"
                    >
                        arrow_forward
                    </span>
                </span>
            </div>
        </div>
    </button>

    <div
        x-show="open"
        x-cloak
        style="display: none;"
        x-transition.opacity
        class="fixed inset-0 z-[110] flex items-center justify-center bg-black/50 p-3 sm:p-5"
        @keydown.escape.window="closeModal()"
    >
        <div
            @click.outside="closeModal()"
            class="flex max-h-[calc(100dvh-24px)] w-full max-w-[580px] flex-col overflow-hidden rounded-2xl bg-white text-on-surface shadow-2xl sm:max-h-[calc(100dvh-40px)]"
            role="dialog"
            aria-modal="true"
            aria-label="Umpan Balik Portal"
        >
            <header class="shrink-0 border-b border-outline-variant/20 bg-white px-5 py-4 sm:px-6">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-[0.1em] text-primary/65">
                            Umpan Balik
                        </p>

                        <h2 class="mt-1 text-lg font-bold leading-snug text-primary">
                            {{ t('Berikan Masukan untuk Perbaikan Portal BB Pustaka') }}
                        </h2>
                    </div>

                    <button
                        type="button"
                        @click="closeModal()"
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-on-surface-variant transition hover:bg-surface-container-low hover:text-on-surface"
                        aria-label="{{ t('Tutup') }}"
                    >
                        <span
                            class="material-symbols-outlined text-[21px]"
                            aria-hidden="true"
                        >
                            close
                        </span>
                    </button>
                </div>
            </header>

            <template x-if="!sent">
                <form
                    @submit.prevent="
                        sending = true;

                        fetch('{{ route('feedback.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                satisfaction_level: level,
                                found_information: foundInfo,
                                message: message,
                                desired_feature: desired
                            })
                        })
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error('Gagal mengirim umpan balik.');
                            }

                            sending = false;
                            sent = true;
                        })
                        .catch(() => {
                            sending = false;
                        });
                    "
                    class="flex min-h-0 flex-1 flex-col"
                >
                    <div class="min-h-0 flex-1 overflow-y-auto px-5 py-5 sm:px-6">
                        <div class="space-y-6">
                            <section>
                                <div class="mb-3">
                                    <p class="text-sm font-semibold text-on-surface">
                                        {{ t('Seberapa Puas Anda dengan Portal Ini?') }}
                                        <span class="text-error">*</span>
                                    </p>

                                    <p class="mt-1 text-xs text-on-surface-variant">
                                        Pilih tingkat kepuasan Anda terhadap pengalaman menggunakan portal.
                                    </p>
                                </div>

                                <div class="grid grid-cols-5 gap-2">
                                    <template
                                        x-for="rating in ratings"
                                        :key="rating.value"
                                    >
                                        <button
                                            type="button"
                                            @click="level = rating.value"
                                            :aria-label="rating.label"
                                            :title="rating.label"
                                            :aria-pressed="(level === rating.value).toString()"
                                            :class="
                                                level === rating.value
                                                    ? 'border-primary bg-primary/10 ring-2 ring-primary/20'
                                                    : 'border-transparent bg-surface-container-low hover:border-primary/20 hover:bg-primary/5'
                                            "
                                            class="flex min-h-[58px] items-center justify-center rounded-xl border text-2xl transition-all sm:min-h-[64px] sm:text-[28px]"
                                        >
                                            <span x-text="rating.emoji"></span>
                                        </button>
                                    </template>
                                </div>

                                <div
                                    x-show="level"
                                    x-transition
                                    class="mt-2 text-center text-xs font-semibold text-primary"
                                    x-text="ratings.find((rating) => rating.value === level)?.label"
                                ></div>
                            </section>

                            <section>
                                <div class="mb-3">
                                    <p class="text-sm font-semibold leading-5 text-on-surface">
                                        {{ t('Apakah Anda dapat menemukan berita/informasi/layanan yang Anda cari?') }}
                                        <span class="text-error">*</span>
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <button
                                        type="button"
                                        @click="foundInfo = false"
                                        :aria-pressed="(foundInfo === false).toString()"
                                        :class="
                                            foundInfo === false
                                                ? 'border-error/40 bg-error-container/40 text-error ring-2 ring-error/10'
                                                : 'border-outline-variant/40 bg-white text-on-surface-variant hover:bg-surface-container-low'
                                        "
                                        class="flex h-11 items-center justify-center gap-2 rounded-xl border text-sm font-semibold transition"
                                    >
                                        <span
                                            class="material-symbols-outlined text-[19px]"
                                            aria-hidden="true"
                                        >
                                            close
                                        </span>

                                        {{ t('Tidak') }}
                                    </button>

                                    <button
                                        type="button"
                                        @click="foundInfo = true"
                                        :aria-pressed="(foundInfo === true).toString()"
                                        :class="
                                            foundInfo === true
                                                ? 'border-primary/40 bg-primary/10 text-primary ring-2 ring-primary/10'
                                                : 'border-outline-variant/40 bg-white text-on-surface-variant hover:bg-surface-container-low'
                                        "
                                        class="flex h-11 items-center justify-center gap-2 rounded-xl border text-sm font-semibold transition"
                                    >
                                        <span
                                            class="material-symbols-outlined text-[19px]"
                                            aria-hidden="true"
                                        >
                                            check
                                        </span>

                                        {{ t('Ya') }}
                                    </button>
                                </div>
                            </section>

                            <section>
                                <label
                                    for="fb-message"
                                    class="mb-1.5 block text-sm font-semibold text-on-surface"
                                >
                                    {{ t('Kritik dan saran Anda untuk portal ini?') }}
                                    <span class="text-error">*</span>
                                </label>

                                <textarea
                                    id="fb-message"
                                    x-model="message"
                                    maxlength="500"
                                    rows="4"
                                    required
                                    placeholder="{{ t('Masukkan jawaban Anda di sini') }}"
                                    class="w-full resize-y rounded-xl border border-outline-variant/50 p-3.5 text-sm leading-6 outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                                ></textarea>

                                <div class="mt-1.5 flex justify-end">
                                    <p
                                        class="text-xs text-on-surface-variant"
                                        x-text="message.length + ' / 500'"
                                    ></p>
                                </div>
                            </section>

                            <section>
                                <label
                                    for="fb-desired"
                                    class="mb-1.5 block text-sm font-semibold text-on-surface"
                                >
                                    {{ t('Fitur apa yang Anda inginkan namun belum tersedia?') }}
                                </label>

                                <textarea
                                    id="fb-desired"
                                    x-model="desired"
                                    maxlength="500"
                                    rows="3"
                                    placeholder="{{ t('Opsional') }}"
                                    class="w-full resize-y rounded-xl border border-outline-variant/50 p-3.5 text-sm leading-6 outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                                ></textarea>

                                <div class="mt-1.5 flex items-center justify-between gap-3">
                                    <p class="text-xs text-on-surface-variant">
                                        Opsional
                                    </p>

                                    <p
                                        class="text-xs text-on-surface-variant"
                                        x-text="desired.length + ' / 500'"
                                    ></p>
                                </div>
                            </section>
                        </div>
                    </div>

                    <footer class="shrink-0 border-t border-outline-variant/20 bg-white px-5 py-4 sm:px-6">
                        <div class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                            <button
                                type="button"
                                @click="closeModal()"
                                class="inline-flex h-11 items-center justify-center rounded-xl border border-outline-variant/50 px-5 text-sm font-semibold text-on-surface transition hover:bg-surface-container-low"
                            >
                                {{ t('Tutup') }}
                            </button>

                            <button
                                type="submit"
                                :disabled="sending || !level || foundInfo === null || !message.trim()"
                                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-primary px-5 text-sm font-bold text-on-primary transition hover:bg-primary-container disabled:cursor-not-allowed disabled:opacity-40"
                            >
                                <span
                                    x-show="sending"
                                    class="material-symbols-outlined animate-spin text-[18px]"
                                    aria-hidden="true"
                                >
                                    progress_activity
                                </span>

                                <span
                                    x-text="sending ? '{{ t('Mengirim...') }}' : '{{ t('Kirim Masukan') }}'"
                                ></span>
                            </button>
                        </div>
                    </footer>
                </form>
            </template>

            <template x-if="sent">
                <div class="flex min-h-[360px] flex-col">
                    <div class="flex flex-1 items-center justify-center px-6 py-10">
                        <div class="max-w-sm text-center">
                            <span
                                class="material-symbols-outlined text-6xl text-primary"
                                aria-hidden="true"
                            >
                                check_circle
                            </span>

                            <h3 class="mt-4 text-lg font-bold text-on-surface">
                                Masukan berhasil dikirim
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-on-surface-variant">
                                {{ t('Terima kasih atas masukan Anda.') }}
                            </p>
                        </div>
                    </div>

                    <footer class="shrink-0 border-t border-outline-variant/20 bg-white px-5 py-4 sm:px-6">
                        <button
                            type="button"
                            @click="closeSuccess()"
                            class="inline-flex h-11 w-full items-center justify-center rounded-xl bg-primary px-5 text-sm font-bold text-on-primary transition hover:bg-primary-container sm:ml-auto sm:w-auto"
                        >
                            {{ t('Tutup') }}
                        </button>
                    </footer>
                </div>
            </template>
        </div>
    </div>
</div>