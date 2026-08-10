@props(['faqs'])

<aside class="lg:w-[30%] space-y-6">
    <div class="bg-primary text-on-primary p-6 rounded-xl shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h3 class="text-lg font-bold mb-2">{{ __('Tanya Pustakawan') }}</h3>
            <p class="text-sm mb-6 opacity-90">{{ __('Butuh bantuan mencari koleksi atau referensi penelitian? Tim kami siap membantu Anda.') }}</p>
            <a href="{{ route('contact.index') }}" class="w-full h-12 bg-secondary text-on-secondary font-bold rounded-lg hover:bg-white transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined" aria-hidden="true">chat</span>
                {{ __('Mulai Chat') }}
            </a>
        </div>
        <span class="material-symbols-outlined absolute -bottom-4 -right-4 text-white/10 text-[120px] pointer-events-none" aria-hidden="true">support_agent</span>
    </div>

    <div class="bg-white p-6 rounded-xl border border-outline-variant/30 shadow-sm">
        <h3 class="font-bold text-primary mb-4 border-b border-outline-variant/30 pb-2">{{ __('Layanan Publik') }}</h3>
        <ul class="space-y-1">
            <li>
                <a href="{{ route('news.index') }}" class="flex items-center gap-3 p-2 hover:bg-surface-container-low rounded-lg transition-all group">
                    <span class="material-symbols-outlined text-secondary" aria-hidden="true">campaign</span>
                    <span class="text-on-surface-variant font-medium group-hover:text-primary">{{ __('Pengumuman Terkini') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="flex items-center gap-3 p-2 hover:bg-surface-container-low rounded-lg transition-all group">
                    <span class="material-symbols-outlined text-secondary" aria-hidden="true">verified</span>
                    <span class="text-on-surface-variant font-medium group-hover:text-primary">{{ __('Zona Integritas') }}</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="bg-surface-container-low p-6 rounded-xl border border-outline-variant shadow-sm">
        <div class="flex justify-between items-center mb-4 border-b border-outline-variant pb-2">
            <h3 class="font-bold text-primary uppercase tracking-wider">{{ __('FAQ') }}</h3>
            <a href="{{ route('faq.index') }}" class="text-xs font-bold text-primary hover:underline">{{ __('Lihat Semua') }}</a>
        </div>
        <x-faq-accordion :faqs="$faqs" />
    </div>
</aside>