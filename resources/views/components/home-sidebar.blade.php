@props(['faqs'])
<aside class="lg:w-[30%] space-y-6">

    <!-- Tanya Pustakawan -->
    <div class="relative overflow-hidden rounded-2xl p-5 text-on-primary shadow-lg" style="background: linear-gradient(135deg, var(--color-primary-container) 0%, var(--color-primary) 100%);">
        <img src="{{ asset('images/decoration-rice-badge.png') }}" alt="" class="absolute top-3 right-2 w-[100px] h-auto opacity-90 pointer-events-none" loading="lazy" aria-hidden="true">

        <div class="relative z-10">
            <div class="w-10 h-10 rounded-full bg-white/15 flex items-center justify-center border border-white/20 mb-3">
                <span class="material-symbols-outlined text-lg" aria-hidden="true">support_agent</span>
            </div>

            <h3 class="text-base font-bold mb-1.5">{{ __('Tanya Pustakawan') }}</h3>
            <p class="text-xs mb-4 opacity-90 leading-relaxed">{{ __('Butuh bantuan mencari koleksi atau referensi penelitian? Tim kami siap membantu Anda.') }}</p>

            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-1.5 px-4 h-10 bg-gold text-on-secondary-container font-bold text-sm rounded-full hover:opacity-90 transition-opacity">
                <span class="material-symbols-outlined text-base" aria-hidden="true">chat</span>
                {{ __('Mulai Chat') }}
            </a>
        </div>
    </div>

    <!-- Layanan Publik -->
    <div class="relative overflow-hidden bg-white p-5 rounded-2xl border border-outline-variant/20 shadow-sm">
        <img src="{{ asset('images/decoration-leaf-sprig.png') }}" alt="" class="absolute -top-3 -right-3 w-[120px] h-auto opacity-70 pointer-events-none" loading="lazy" aria-hidden="true">

        <h3 class="relative z-10 text-sm font-bold text-primary">{{ __('Layanan Publik') }}</h3>
        <span class="relative z-10 block w-8 h-[2px] rounded-full bg-gold mt-1.5 mb-3"></span>

        <ul class="relative z-10 space-y-2">
            <li>
                <a href="{{ route('news.index') }}" class="flex items-center gap-2.5 p-2.5 rounded-xl border border-outline-variant/20 hover:border-primary/30 hover:bg-surface-container-low/50 transition-all group">
                    <span class="w-8 h-8 rounded-full bg-secondary-container/50 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary text-base" aria-hidden="true">campaign</span>
                    </span>
                    <span class="text-on-surface-variant font-semibold text-sm group-hover:text-primary">{{ __('Pengumuman Terkini') }}</span>
                    <span class="material-symbols-outlined text-gold text-lg ml-auto shrink-0" aria-hidden="true">chevron_right</span>
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="flex items-center gap-2.5 p-2.5 rounded-xl border border-outline-variant/20 hover:border-primary/30 hover:bg-surface-container-low/50 transition-all group">
                    <span class="w-8 h-8 rounded-full bg-secondary-container/50 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary text-base" aria-hidden="true">verified</span>
                    </span>
                    <span class="text-on-surface-variant font-semibold text-sm group-hover:text-primary">{{ __('Zona Integritas') }}</span>
                    <span class="material-symbols-outlined text-gold text-lg ml-auto shrink-0" aria-hidden="true">chevron_right</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- FAQ -->
    <div class="relative overflow-hidden bg-white p-5 rounded-2xl border border-outline-variant/20 shadow-sm">
        <img src="{{ asset('images/decoration-book-leaf.png') }}" alt="" class="absolute -bottom-3 -right-3 w-[150px] h-auto opacity-80 pointer-events-none" loading="lazy" aria-hidden="true">

        <div class="relative z-10">
            <h3 class="text-sm font-bold text-primary">{{ __('FAQ') }}</h3>
        </div>
        <span class="relative z-10 block w-8 h-[2px] rounded-full bg-gold mt-1.5 mb-3"></span>

        <div class="relative z-10">
            <x-faq-accordion :faqs="$faqs" />
        </div>
    </div>
</aside>