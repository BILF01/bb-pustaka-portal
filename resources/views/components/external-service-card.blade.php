@props(['heading', 'description', 'buttonLabel' => null])

<div class="bg-white rounded-xl p-6 md:p-8 text-on-surface shadow-2xl text-center">
<span class="material-symbols-outlined text-primary text-[48px]" aria-hidden="true">open_in_new</span>
<h3 class="text-xl md:text-headline-md font-bold text-primary mt-4 mb-2">{{ $heading }}</h3>
<p class="text-sm text-on-surface-variant mb-6">{{ $description }}</p>
<a href="{{ \App\Models\SiteSetting::get('external_system_url', '#') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">
{{ $buttonLabel ?? __('Buka Layanan') }}
<span class="material-symbols-outlined text-base" aria-hidden="true">arrow_outward</span>
</a>
</div>