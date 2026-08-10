@props(['faqs'])

<div class="space-y-2">
    @forelse ($faqs as $faq)
        <details class="group bg-white border border-outline-variant/30 rounded-lg">
            <summary class="cursor-pointer list-none p-4 flex justify-between items-center gap-3 font-semibold text-sm text-on-surface hover:text-primary">
                {{ __($faq->question) }}
                <span class="material-symbols-outlined text-on-surface-variant group-open:rotate-180 transition-transform shrink-0" aria-hidden="true">expand_more</span>
            </summary>
            <p class="px-4 pb-4 text-sm text-on-surface-variant leading-relaxed">{{ __($faq->answer) }}</p>
        </details>
    @empty
        <p class="text-on-surface-variant text-sm">{{ __('Belum ada pertanyaan yang tersedia.') }}</p>
    @endforelse
</div>