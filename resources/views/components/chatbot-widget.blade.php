<div x-data x-init="$store.chat.init()">
    <button type="button" @click="$store.chat.open = !$store.chat.open" :aria-expanded="$store.chat.open" aria-controls="chat-window" aria-label="{{ __('Buka Tanya AI Pustaka') }}" class="fixed bottom-24 right-6 z-[100] w-16 h-16 bg-primary text-on-primary rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-transform border-4 border-white/20">
        <span class="material-symbols-outlined text-[32px]" aria-hidden="true">smart_toy</span>
        <span class="absolute -top-1 -right-1 w-4 h-4 bg-secondary rounded-full border-2 border-white motion-safe:animate-pulse" aria-hidden="true"></span>
    </button>

    <div id="chat-window" x-show="$store.chat.open" x-cloak style="display:none" x-transition @keydown.escape.window="$store.chat.open = false" role="dialog" aria-modal="true" aria-label="{{ __('AI Pustaka') }}" class="fixed bottom-44 right-6 z-[101] w-96 max-w-[calc(100vw-3rem)] h-[520px] max-h-[70vh] bg-white border border-outline-variant shadow-2xl rounded-xl flex flex-col">
        <div class="p-4 bg-primary text-on-primary rounded-t-xl flex justify-between items-center shrink-0">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined" aria-hidden="true">smart_toy</span>
                <span class="font-bold">{{ __('AI Pustaka') }}</span>
            </div>
            <button type="button" @click="$store.chat.open = false" aria-label="{{ __('Tutup jendela chat') }}">
                <span class="material-symbols-outlined" aria-hidden="true">close</span>
            </button>
        </div>

        <div id="chat-messages" class="flex-1 p-4 overflow-y-auto space-y-4 text-sm bg-surface">
            <div class="flex gap-2">
                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0" aria-hidden="true">
                    <span class="material-symbols-outlined text-sm text-primary">smart_toy</span>
                </div>
                <div class="bg-white p-3 rounded-lg border border-outline-variant">
                    {{ __('Halo! Saya asisten cerdas BB Pustaka. Ada yang bisa saya bantu terkait literasi pertanian?') }}
                </div>
            </div>

            <template x-for="(message, index) in $store.chat.messages" :key="index">
                <div class="flex gap-2" :class="message.role === 'user' ? 'flex-row-reverse' : ''">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0" :class="message.role === 'user' ? 'bg-secondary/30' : 'bg-primary/10'" aria-hidden="true">
                        <span class="material-symbols-outlined text-sm" :class="message.role === 'user' ? 'text-on-secondary-container' : 'text-primary'" x-text="message.role === 'user' ? 'person' : 'smart_toy'"></span>
                    </div>
                    <div>
                        <div class="p-3 rounded-lg border prose prose-sm max-w-none" :class="message.role === 'user' ? 'bg-primary/5 border-primary/20' : 'bg-white border-outline-variant'" x-html="message.html"></div>
                        <span class="text-[10px] text-on-surface-variant mt-1 block" x-text="message.time" :class="message.role === 'user' ? 'text-right' : ''"></span>
                    </div>
                </div>
            </template>

            <div x-show="$store.chat.loading" x-cloak style="display:none" class="flex gap-2">
                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0" aria-hidden="true">
                    <span class="material-symbols-outlined text-sm text-primary">smart_toy</span>
                </div>
                <div class="bg-white p-3 rounded-lg border border-outline-variant flex gap-1" aria-live="polite" aria-label="AI sedang mengetik">
                    <span class="w-1.5 h-1.5 bg-on-surface-variant rounded-full motion-safe:animate-bounce" style="animation-delay:0ms"></span>
                    <span class="w-1.5 h-1.5 bg-on-surface-variant rounded-full motion-safe:animate-bounce" style="animation-delay:150ms"></span>
                    <span class="w-1.5 h-1.5 bg-on-surface-variant rounded-full motion-safe:animate-bounce" style="animation-delay:300ms"></span>
                </div>
            </div>
        </div>

        <div x-show="$store.chat.messages.length === 0" x-cloak style="display:none" class="px-4 pb-2 shrink-0 flex flex-wrap gap-2">
            <template x-for="suggestion in $store.chat.suggestions" :key="suggestion">
                <button type="button" @click="$store.chat.useSuggestion(suggestion)" class="text-xs px-3 py-1.5 bg-surface-container-low border border-outline-variant rounded-full hover:bg-surface-container transition-all" x-text="suggestion"></button>
            </template>
        </div>

        <form @submit.prevent="$store.chat.send()" class="p-4 border-t border-outline-variant bg-white flex gap-2 shrink-0">
            <label for="chat-input" class="sr-only">{{ __('Ketik pesan...') }}</label>
            <input id="chat-input" x-model="$store.chat.input" type="text" placeholder="{{ __('Ketik pesan...') }}" :disabled="$store.chat.loading" class="flex-1 text-sm border border-outline-variant rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-primary disabled:opacity-50">
            <button type="submit" :disabled="$store.chat.loading || !$store.chat.input.trim()" aria-label="{{ __('Kirim pesan') }}" class="bg-primary text-on-primary p-2 rounded-lg disabled:opacity-50 hover:bg-primary-container transition-all">
                <span class="material-symbols-outlined" aria-hidden="true">send</span>
            </button>
        </form>
    </div>
</div>