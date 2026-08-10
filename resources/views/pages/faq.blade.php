<x-layout title="FAQ">
    <section class="pt-32 pb-20 max-w-3xl mx-auto px-6">
        <h1 class="text-2xl md:text-headline-lg font-bold text-primary mb-2">Pertanyaan yang Sering Diajukan</h1>
        <p class="text-on-surface-variant mb-8">Temukan jawaban atas pertanyaan umum seputar layanan BB Pustaka.</p>

        <x-faq-accordion :faqs="$faqs" />
    </section>
</x-layout>