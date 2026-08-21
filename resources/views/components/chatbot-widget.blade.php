<div x-data x-init="$store.chat.init()">
    <button
        x-show="!$store.chat.open && !$store.a11y.open"
        x-transition
        type="button"
        @click="$store.a11y.open = false; $store.chat.open = true"
        aria-controls="chat-window"
        aria-label="{{ __('Buka Tanya AI Pustaka') }}"
        class="group fixed bottom-3 right-[64px] sm:bottom-[94px] sm:right-6 z-40 sm:z-[100] w-11 h-11 sm:w-[58px] sm:h-[58px] rounded-[14px] sm:rounded-[20px] bg-primary text-white border border-white/40 shadow-[0_7px_20px_rgba(5,104,57,.24)] sm:shadow-[0_10px_28px_rgba(5,104,57,.28)] flex items-center justify-center transition-all hover:-translate-y-1 hover:shadow-[0_14px_34px_rgba(5,104,57,.34)]"
    >
        <span class="material-symbols-outlined text-[22px] sm:text-[29px] group-hover:rotate-6 group-hover:scale-110 transition-transform" aria-hidden="true">auto_awesome</span>

        <span class="absolute -top-1 -right-1 w-3 h-3 sm:w-3.5 sm:h-3.5 rounded-full bg-secondary border-2 border-white shadow-sm motion-safe:animate-pulse" aria-hidden="true"></span>

        <span class="pointer-events-none absolute right-[70px] hidden sm:block whitespace-nowrap rounded-lg bg-[#173c2c] px-3 py-2 text-[11px] font-bold text-white opacity-0 translate-x-1 shadow-lg transition-all group-hover:opacity-100 group-hover:translate-x-0">
            {{ __('Tanya AI Pustaka') }}
        </span>
    </button>

    <div
        id="chat-window"
        x-show="$store.chat.open"
        x-cloak
        style="display:none"
        x-transition
        @keydown.escape.window="$store.chat.open = false"
        role="dialog"
        aria-modal="true"
        aria-label="{{ __('AI Pustaka') }}"
        class="fixed inset-x-3 top-3 bottom-3 sm:inset-x-auto sm:top-[150px] sm:bottom-[92px] sm:right-6 z-[110] sm:w-[410px] sm:max-w-[calc(100vw-2rem)] min-h-0 sm:min-h-[420px] bg-white border border-primary/10 shadow-[0_24px_60px_rgba(18,55,36,.22)] rounded-[18px] sm:rounded-[22px] overflow-hidden flex flex-col"
    >

        {{-- Header --}}
        <header class="h-[60px] px-4 bg-primary text-white flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <span class="w-9 h-9 rounded-[12px] bg-white/12 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[21px]" aria-hidden="true">auto_awesome</span>
                </span>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-[14px] font-bold leading-none">{{ __('AI Pustaka') }}</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-secondary shadow-[0_0_0_3px_rgba(255,224,1,.12)]"></span>
                    </div>
                    <span class="block mt-1.5 text-[9px] font-medium tracking-[.02em] text-white/65">{{ __('Asisten virtual BB Pustaka') }}</span>
                </div>
            </div>

            <button type="button" @click="$store.chat.open = false" aria-label="{{ __('Tutup jendela chat') }}" class="w-9 h-9 rounded-xl flex items-center justify-center text-white/75 hover:text-white hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined text-[21px]" aria-hidden="true">close</span>
            </button>
        </header>

        {{-- Messages --}}
        <div id="chat-messages" class="flex-1 min-h-0 overflow-y-auto overscroll-contain px-4 py-4 space-y-4 bg-[#f6f9f6]">
            <div class="flex items-start gap-2.5">
                <span class="w-8 h-8 rounded-[11px] bg-[#e3f1e8] text-primary flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[17px]" aria-hidden="true">auto_awesome</span>
                </span>
                <div class="max-w-[81%] rounded-[18px] rounded-tl-[5px] bg-white border border-primary/10 px-4 py-3 text-[13px] leading-[1.65] text-on-surface shadow-[0_3px_12px_rgba(24,75,46,.045)]">
                    {{ __('Halo! Saya asisten cerdas BB Pustaka. Ada yang bisa saya bantu terkait literasi pertanian?') }}
                </div>
            </div>

            <template x-for="(message, index) in $store.chat.messages" :key="index">
                <div class="flex items-start gap-2.5" :class="message.role === 'user' ? 'flex-row-reverse' : ''">
                    <span class="w-8 h-8 rounded-[11px] flex items-center justify-center shrink-0" :class="message.role === 'user' ? 'bg-[#fff6b8] text-[#756500]' : 'bg-[#e3f1e8] text-primary'">
                        <span class="material-symbols-outlined text-[17px]" x-text="message.role === 'user' ? 'person' : 'auto_awesome'"></span>
                    </span>

                    <div class="min-w-0 max-w-[81%]">
                        <div x-html="message.html" class="px-4 py-3 text-[13px] leading-[1.65] break-words prose prose-sm max-w-none [&_p]:my-0 [&_p+p]:mt-2.5 [&_ul]:my-2 [&_ol]:my-2 [&_li]:my-1" :class="message.role === 'user' ? 'rounded-[18px] rounded-tr-[5px] bg-[#edf7f0] border border-primary/10 text-on-surface' : 'rounded-[18px] rounded-tl-[5px] bg-white border border-primary/10 text-on-surface shadow-[0_3px_12px_rgba(24,75,46,.045)]'"></div>
                        <span class="block mt-1 px-1 text-[9px] text-on-surface-variant/55" x-text="message.time" :class="message.role === 'user' ? 'text-right' : ''"></span>
                    </div>
                </div>
            </template>

            <div x-show="$store.chat.loading" x-cloak style="display:none" class="flex items-start gap-2.5">
                <span class="w-8 h-8 rounded-[11px] bg-[#e3f1e8] text-primary flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[17px]" aria-hidden="true">auto_awesome</span>
                </span>
                <div class="h-11 px-4 rounded-[18px] rounded-tl-[5px] bg-white border border-primary/10 shadow-sm flex items-center gap-1.5" aria-live="polite" aria-label="AI sedang mengetik">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary/50 motion-safe:animate-bounce"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-primary/50 motion-safe:animate-bounce" style="animation-delay:150ms"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-primary/50 motion-safe:animate-bounce" style="animation-delay:300ms"></span>
                </div>
            </div>
        </div>

        {{-- Quick actions --}}
        <div class="h-[48px] px-3 bg-white border-t border-primary/10 flex items-center gap-2 shrink-0">
            <span class="w-8 h-8 rounded-[10px] bg-primary/[.07] text-primary flex items-center justify-center shrink-0" title="{{ __('Pertanyaan cepat') }}">
                <span class="material-symbols-outlined text-[17px]" aria-hidden="true">bolt</span>
            </span>

            <div class="min-w-0 flex-1 flex items-center gap-1.5 overflow-x-auto no-scrollbar">
                <template x-for="suggestion in $store.chat.suggestions" :key="suggestion">
                    <button type="button" @click="$store.chat.useSuggestion(suggestion)" :disabled="$store.chat.loading" class="shrink-0 h-8 max-w-[180px] px-3 rounded-[10px] border border-primary/10 bg-[#f5f8f5] text-[10px] font-semibold text-on-surface truncate hover:bg-primary/[.07] hover:border-primary/20 hover:text-primary disabled:opacity-40 disabled:pointer-events-none transition-colors" x-text="suggestion" :title="suggestion"></button>
                </template>
            </div>
        </div>

        {{-- Composer --}}
        <form @submit.prevent="$store.chat.send()" class="h-[66px] px-3.5 bg-[#fbfcfb] border-t border-primary/10 flex items-center gap-2 shrink-0">
            <label for="chat-input" class="sr-only">{{ __('Ketik pesan...') }}</label>
            <div class="min-w-0 flex-1 h-11 rounded-[14px] bg-white border border-outline-variant/45 flex items-center focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/10 transition-all">
                <span class="material-symbols-outlined ml-3 text-[18px] text-on-surface-variant/35" aria-hidden="true">chat_bubble</span>
                <input id="chat-input" x-model="$store.chat.input" type="text" placeholder="{{ __('Tulis pertanyaan Anda...') }}" :disabled="$store.chat.loading" autocomplete="off" class="min-w-0 flex-1 h-full px-2.5 bg-transparent border-0 outline-none ring-0 text-[13px] placeholder:text-on-surface-variant/40 focus:ring-0 disabled:opacity-50">
            </div>

            <button type="submit" :disabled="$store.chat.loading || !$store.chat.input.trim()" aria-label="{{ __('Kirim pesan') }}" class="w-11 h-11 rounded-[14px] bg-primary text-white flex items-center justify-center shadow-[0_5px_14px_rgba(5,104,57,.18)] hover:bg-primary-container hover:-translate-y-0.5 disabled:opacity-30 disabled:shadow-none disabled:translate-y-0 transition-all">
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">arrow_upward</span>
            </button>
        </form>
    </div>
</div>