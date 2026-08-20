@props(['faqs'])
<div class="space-y-2">
    @forelse ($faqs as $faq)
        <details class="group bg-surface-container-low/60 border border-outline-variant/20 rounded-xl">
            <summary class="cursor-pointer list-none p-3.5 flex justify-between items-center gap-2 font-semibold text-sm text-on-surface hover:text-primary">
                {{ __($faq->question) }}
                <span class="material-symbols-outlined text-on-surface-variant text-lg group-open:rotate-180 transition-transform shrink-0" aria-hidden="true">expand_more</span>
            </summary>
            <p class="px-3.5 pb-3.5 text-xs text-on-surface-variant leading-relaxed">{{ __($faq->answer) }}</p>
        </details>
    @empty
        <p class="text-on-surface-variant text-sm">{{ __('Belum ada pertanyaan yang tersedia.') }}</p>
    @endforelse
</div>