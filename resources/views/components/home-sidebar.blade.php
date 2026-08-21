@props(['faqs'])

<aside class="lg:w-[30%] space-y-4">
    {{-- TANYA PUSTAKAWAN --}}
    <section class="relative overflow-hidden rounded-[22px] bg-gradient-to-br from-primary-container to-primary p-5 text-on-primary shadow-[0_12px_30px_rgba(5,83,46,.16)]">
        <img
            src="{{ asset('images/decoration-rice-badge.png') }}"
            alt=""
            class="absolute -top-1 -right-2 w-[105px] h-auto opacity-25 pointer-events-none"
            loading="lazy"
            aria-hidden="true"
        >

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-3">
                <span class="w-10 h-10 rounded-[13px] bg-white/12 border border-white/15 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">support_agent</span>
                </span>

                <div>
                    <span class="block text-[9px] font-extrabold uppercase tracking-[.1em] text-white/55">
                        {{ __('Bantuan Informasi') }}
                    </span>
                    <h3 class="mt-0.5 text-[15px] font-bold">{{ __('Tanya Pustakawan') }}</h3>
                </div>
            </div>

            <p class="text-[11px] leading-[1.65] text-white/80">
                {{ __('Butuh bantuan mencari koleksi atau referensi penelitian? Tim kami siap membantu Anda.') }}
            </p>

            <a
                href="{{ route('contact.index') }}"
                class="mt-4 inline-flex h-9 items-center gap-2 rounded-full bg-gold px-4 text-[11px] font-extrabold text-on-secondary-container shadow-sm transition-all hover:-translate-y-0.5 hover:shadow-md"
            >
                <span class="material-symbols-outlined text-[16px]" aria-hidden="true">forum</span>
                {{ __('Hubungi Pustakawan') }}
            </a>
        </div>
    </section>

    {{-- AKSES CEPAT --}}
    <section class="relative overflow-hidden rounded-[22px] border border-primary/10 bg-surface-container-lowest p-5 shadow-[0_7px_22px_rgba(22,61,44,.055)]">
        <img
            src="{{ asset('images/decoration-leaf-sprig.png') }}"
            alt=""
            class="absolute -top-5 -right-5 w-[110px] h-auto opacity-20 pointer-events-none"
            loading="lazy"
            aria-hidden="true"
        >

        <div class="relative z-10 flex items-center gap-2.5 mb-4">
            <span class="w-8 h-8 rounded-[10px] bg-primary/[.08] text-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-[17px]" aria-hidden="true">apps</span>
            </span>

            <div>
                <h3 class="text-[13px] font-bold text-primary">{{ __('Akses Cepat') }}</h3>
                <p class="text-[9px] text-on-surface-variant/65">{{ __('Informasi portal yang sering dibutuhkan') }}</p>
            </div>
        </div>

        <div class="relative z-10 space-y-2">
            <a href="{{ route('news.index') }}" class="group flex items-center gap-3 rounded-xl border border-primary/[.08] bg-surface-container-low/60 p-2.5 transition-all hover:border-primary/20 hover:bg-primary/[.04]">
                <span class="w-8 h-8 rounded-[10px] bg-secondary-container/60 text-primary flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">campaign</span>
                </span>
                <span class="flex-1 text-[11px] font-semibold text-on-surface group-hover:text-primary">
                    {{ __('Berita & Pengumuman') }}
                </span>
                <span class="material-symbols-outlined text-[16px] text-primary/50 transition-transform group-hover:translate-x-0.5" aria-hidden="true">chevron_right</span>
            </a>

            <a href="{{ route('about') }}" class="group flex items-center gap-3 rounded-xl border border-primary/[.08] bg-surface-container-low/60 p-2.5 transition-all hover:border-primary/20 hover:bg-primary/[.04]">
                <span class="w-8 h-8 rounded-[10px] bg-primary/[.08] text-primary flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">account_balance</span>
                </span>
                <span class="flex-1 text-[11px] font-semibold text-on-surface group-hover:text-primary">
                    {{ __('Profil BB Pustaka') }}
                </span>
                <span class="material-symbols-outlined text-[16px] text-primary/50 transition-transform group-hover:translate-x-0.5" aria-hidden="true">chevron_right</span>
            </a>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="relative overflow-hidden rounded-[22px] border border-primary/10 bg-surface-container-lowest p-5 shadow-[0_7px_22px_rgba(22,61,44,.055)]">
        <img
            src="{{ asset('images/decoration-book-leaf.png') }}"
            alt=""
            class="absolute -bottom-6 -right-5 w-[135px] h-auto opacity-15 pointer-events-none"
            loading="lazy"
            aria-hidden="true"
        >

        <div class="relative z-10">
            <div class="flex items-center gap-2.5 mb-4">
                <span class="w-8 h-8 rounded-[10px] bg-primary/[.08] text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[17px]" aria-hidden="true">help</span>
                </span>

                <div>
                    <h3 class="text-[13px] font-bold text-primary">{{ __('Pertanyaan Umum') }}</h3>
                    <p class="text-[9px] text-on-surface-variant/65">{{ __('Informasi singkat untuk pengunjung') }}</p>
                </div>
            </div>

            <x-faq-accordion :faqs="$faqs" />
        </div>
    </section>

    {{-- FEEDBACK --}}
    <x-feedback-widget />
</aside>