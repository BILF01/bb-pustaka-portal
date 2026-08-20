<x-layout title="Kontak" :solid-nav="false">
    <section class="relative overflow-hidden pt-40 pb-20 bg-[#F3F5F1]">
        <div class="absolute inset-x-0 top-0 h-[430px] pointer-events-none" aria-hidden="true">
            <img src="{{ asset('images/minimalist_botanical_books_background.png') }}" alt="" class="w-full h-full object-cover opacity-80">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#F3F5F1]/20 to-[#F3F5F1]"></div>
        </div>

        <div class="relative z-10 max-w-[1280px] mx-auto px-6">
            <div class="flex items-center gap-4 max-w-2xl mb-10">
                <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-primary text-3xl">contact_support</span>
                </div>
                <div>
                    <h1 class="text-3xl md:text-headline-lg font-bold text-primary">{{ __('Kontak') }}</h1>
                    <p class="text-on-surface-variant mt-2 leading-relaxed">{{ __('Kami siap membantu Anda. Silakan hubungi kami melalui formulir pesan atau informasi kontak yang tersedia.') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[1.45fr_.8fr] gap-6 lg:gap-8 items-start">
                <div class="bg-white/95 backdrop-blur-sm rounded-3xl border border-outline-variant/20 shadow-sm p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-7">
                        <div class="w-11 h-11 rounded-full bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">mail</span>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-primary">{{ __('Kirim Pesan') }}</h2>
                            <p class="text-sm text-on-surface-variant">{{ __('Isi formulir berikut dan tim kami akan segera merespons pesan Anda.') }}</p>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="mb-5 p-4 rounded-xl bg-primary/10 text-primary text-sm font-semibold">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="name" class="block mb-2 text-sm font-semibold">{{ __('Nama Lengkap') }}</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required placeholder="{{ __('Masukkan nama lengkap Anda') }}" class="w-full h-12 px-4 bg-white border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary">
                            @error('name') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-semibold">{{ __('Email') }}</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required placeholder="{{ __('Masukkan email Anda') }}" class="w-full h-12 px-4 bg-white border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary">
                            @error('email') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="message" class="block mb-2 text-sm font-semibold">{{ __('Pesan') }}</label>
                            <textarea id="message" name="message" rows="7" required placeholder="{{ __('Tulis pesan Anda di sini...') }}" class="w-full p-4 bg-white border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary resize-y">{{ old('message') }}</textarea>
                            @error('message') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <p class="flex items-center gap-1.5 text-xs text-on-surface-variant">
                                <span class="material-symbols-outlined text-base">info</span>
                                {{ __('Pastikan data yang Anda masukkan sudah benar.') }}
                            </p>
                            <button type="submit" class="inline-flex items-center justify-center gap-2 h-12 px-6 bg-primary text-on-primary font-bold rounded-xl hover:bg-primary-container transition-all">
                                <span class="material-symbols-outlined text-lg">send</span>
                                {{ __('Kirim Pesan') }}
                            </button>
                        </div>
                    </form>
                </div>

                <aside class="relative overflow-hidden bg-white/95 backdrop-blur-sm rounded-3xl border border-outline-variant/20 shadow-[0_12px_35px_rgba(0,0,0,.06)] p-6">
                    <img src="{{ asset('images/decoration-leaf-sprig.png') }}" alt="" class="absolute -top-6 -right-6 w-36 opacity-30 pointer-events-none" aria-hidden="true">

                    <div class="relative z-10 mb-6">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-[11px] font-bold uppercase tracking-[.16em]">
                            <span class="material-symbols-outlined text-sm">contact_phone</span>
                            {{ __('Hubungi Kami') }}
                        </span>
                        <h2 class="text-xl font-bold text-primary mt-3">{{ __('Informasi Kontak') }}</h2>
                        <span class="block w-10 h-[2px] bg-secondary rounded-full mt-2"></span>
                        <p class="text-xs text-on-surface-variant mt-3 leading-relaxed">{{ __('Informasi resmi untuk menghubungi Balai Besar Perpustakaan dan Literasi Pertanian.') }}</p>
                    </div>

                    <div class="relative z-10 space-y-3">
                        <div class="flex gap-3.5 p-4 rounded-2xl bg-surface-container-low/65 border border-outline-variant/15 transition-all hover:border-primary/20 hover:bg-primary/[0.04]">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary">location_on</span>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-sm font-bold text-primary">{{ __('Alamat') }}</h3>
                                <p class="text-sm text-on-surface-variant mt-1 leading-relaxed">{{ \App\Models\SiteSetting::get('address') }}</p>
                            </div>
                        </div>

                        <div class="flex gap-3.5 p-4 rounded-2xl bg-surface-container-low/65 border border-outline-variant/15 transition-all hover:border-primary/20 hover:bg-primary/[0.04]">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary">call</span>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-primary">{{ __('Telepon') }}</h3>
                                <a href="tel:{{ \App\Models\SiteSetting::get('phone') }}" class="block text-sm text-on-surface-variant mt-1 hover:text-primary transition-colors">{{ \App\Models\SiteSetting::get('phone') }}</a>
                            </div>
                        </div>

                        <div class="flex gap-3.5 p-4 rounded-2xl bg-surface-container-low/65 border border-outline-variant/15 transition-all hover:border-primary/20 hover:bg-primary/[0.04]">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary">mail</span>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-sm font-bold text-primary">{{ __('Email') }}</h3>
                                <a href="mailto:{{ \App\Models\SiteSetting::get('email') }}" class="block text-sm text-on-surface-variant mt-1 break-all hover:text-primary transition-colors">{{ \App\Models\SiteSetting::get('email') }}</a>
                            </div>
                        </div>

                        <div class="flex gap-3.5 p-4 rounded-2xl bg-surface-container-low/65 border border-outline-variant/15 transition-all hover:border-primary/20 hover:bg-primary/[0.04]">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary">account_balance</span>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-primary">NPP</h3>
                                <p class="text-sm text-on-surface-variant mt-1">3271034C1019314</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10 mt-5 pt-4 border-t border-outline-variant/20 flex items-center gap-2 text-xs text-on-surface-variant">
                        <span class="material-symbols-outlined text-primary text-base">verified</span>
                        {{ __('Informasi kontak resmi BB Pustaka') }}
                    </div>
                </aside>
            </div>
        </div>
    </section>
</x-layout>