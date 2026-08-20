@php
    $address=\App\Models\SiteSetting::get('address');
    $operationalHours=\App\Models\SiteSetting::get('operational_hours');
    $mapEmbedUrl=\App\Models\SiteSetting::get('map_embed_url');
    $siteName=\App\Models\SiteSetting::get('site_name');
    $mapsUrl='https://www.google.com/maps/search/?api=1&query='.urlencode($address);
@endphp

<section class="relative py-16 md:py-20 bg-[#F8F6EE] text-on-surface overflow-hidden" aria-labelledby="visit-heading">
    <div
        class="absolute inset-0 bg-cover bg-center opacity-80"
        style="background-image:url('{{ asset('images/visit-section-bg.png') }}')"
        aria-hidden="true"
    ></div>
    <div class="absolute inset-0 bg-gradient-to-b from-[#FFFDF8]/35 via-[#FFFDF8]/20 to-[#F8F6EE]/75 pointer-events-none" aria-hidden="true"></div>

    <div class="absolute inset-x-0 top-0 h-32 md:h-40 bg-gradient-to-b from-[#F8FAF6] via-[#F8FAF6]/75 to-transparent pointer-events-none" aria-hidden="true"></div>

    <div class="absolute inset-x-0 bottom-0 h-36 md:h-48 bg-gradient-to-b from-transparent via-surface-container-lowest/60 to-surface-container-lowest pointer-events-none" aria-hidden="true"></div>

    <div class="relative z-10 max-w-[1280px] mx-auto px-6">
        <div class="max-w-3xl mb-8 md:mb-10">
            <div class="inline-flex items-center gap-2 text-primary text-xs md:text-sm font-bold uppercase tracking-[0.14em] mb-3">
                <span class="material-symbols-outlined text-[19px]" aria-hidden="true">home_pin</span>
                {{ __('Kunjungan & Lokasi') }}
            </div>

            <h2 id="visit-heading" class="font-serif text-3xl md:text-5xl font-bold text-primary leading-tight">
                {{ __('Kunjungi BB Pustaka') }}
            </h2>

            <p class="mt-4 max-w-2xl text-on-surface-variant leading-relaxed">
                {{ __('Kami menyambut kunjungan perorangan maupun kelompok untuk studi pustaka dan wisata literasi sejarah.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
            <div class="lg:col-span-4 space-y-4">
                <div class="bg-white/90 backdrop-blur-sm border border-outline-variant/30 rounded-2xl p-5 shadow-sm">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined" aria-hidden="true">location_on</span>
                        </div>

                        <div class="min-w-0">
                            <h3 class="font-bold text-primary">{{ __('Alamat') }}</h3>
                            <p class="mt-1 text-sm leading-relaxed text-on-surface-variant">
                                {{ $address }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-sm border border-outline-variant/30 rounded-2xl p-5 shadow-sm">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined" aria-hidden="true">schedule</span>
                        </div>

                        <div class="min-w-0">
                            <h3 class="font-bold text-primary">{{ __('Jam Operasional') }}</h3>
                            <div class="mt-1 text-sm leading-relaxed text-on-surface-variant">
                                {!! nl2br(e($operationalHours)) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    x-data="{copied:false,address:@js($address)}"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-3 pt-1"
                >
                    <a
                        href="{{ $mapsUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="h-12 px-5 rounded-xl bg-primary text-on-primary font-bold text-sm flex items-center justify-center gap-2 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all"
                    >
                        <span class="material-symbols-outlined text-[19px]" aria-hidden="true">near_me</span>
                        {{ __('Arah ke Lokasi') }}
                    </a>

                    <button
                        type="button"
                        @click="navigator.clipboard.writeText(address);copied=true;setTimeout(()=>copied=false,1500)"
                        class="h-12 px-5 rounded-xl bg-white/90 border border-primary/25 text-primary font-bold text-sm flex items-center justify-center gap-2 hover:bg-white hover:border-primary/40 transition-all"
                    >
                        <span class="material-symbols-outlined text-[19px]" aria-hidden="true">content_copy</span>
                        <span x-text="copied?'Alamat disalin':'Salin Alamat'">{{ __('Salin Alamat') }}</span>
                    </button>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="h-[360px] md:h-[430px] lg:h-full lg:min-h-[430px] bg-white rounded-2xl p-2 border border-outline-variant/30 shadow-[0_12px_35px_rgba(31,73,44,0.10)]">
                    <div class="relative w-full h-full rounded-xl overflow-hidden bg-surface">
                        <iframe
                            src="{{ $mapEmbedUrl }}"
                            class="absolute inset-0 w-full h-full border-0"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Peta lokasi {{ $siteName }}"
                        ></iframe>

                        <a
                            href="{{ $mapsUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="absolute left-4 bottom-4 z-10 inline-flex items-center gap-2 px-4 h-10 rounded-lg bg-white/95 backdrop-blur text-primary text-sm font-bold shadow-md hover:bg-white transition-colors"
                        >
                            <span class="material-symbols-outlined text-[18px]" aria-hidden="true">open_in_new</span>
                            {{ __('Buka Google Maps') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3 space-y-4">
                <x-social-qr :links="[
                    ['label' => 'Facebook', 'url' => 'https://www.facebook.com/pustakakementan/?locale=id_ID'],
                    ['label' => 'Instagram', 'url' => 'https://www.instagram.com/pustaka.kementan/'],
                    ['label' => 'YouTube', 'url' => 'https://www.youtube.com/@PustakaKementerianPertanian/featured'],
                ]" />

                <x-feedback-widget />
            </div>
        </div>
    </div>
</section>