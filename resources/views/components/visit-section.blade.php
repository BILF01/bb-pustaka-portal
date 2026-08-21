@php
    $address=\App\Models\SiteSetting::get('address');
    $operationalHours=\App\Models\SiteSetting::get('operational_hours');
    $mapEmbedUrl=\App\Models\SiteSetting::get('map_embed_url');
    $siteName=\App\Models\SiteSetting::get('site_name');
    $mapsUrl='https://www.google.com/maps/search/?api=1&query='.urlencode($address);
@endphp

<section class="relative pt-7 pb-10 md:py-12 bg-[#F8F6EE] text-on-surface overflow-hidden" aria-labelledby="visit-heading">
    <div
        class="absolute inset-0 bg-cover bg-center opacity-75"
        style="background-image:url('{{ asset('images/visit-section-bg.png') }}')"
        aria-hidden="true"
    ></div>

    <div class="absolute inset-0 bg-gradient-to-b from-[#FFFDF8]/40 via-[#FFFDF8]/25 to-[#F8F6EE]/78 pointer-events-none" aria-hidden="true"></div>
    <div class="absolute inset-x-0 top-0 h-20 md:h-28 bg-gradient-to-b from-background via-background/70 to-transparent pointer-events-none" aria-hidden="true"></div>
    <div class="absolute inset-x-0 bottom-0 h-24 md:h-32 bg-gradient-to-b from-transparent via-surface-container-lowest/50 to-surface-container-lowest pointer-events-none" aria-hidden="true"></div>

    <div class="relative z-10 max-w-[1240px] mx-auto px-4 md:px-6">
        <div class="max-w-[700px] mb-5 md:mb-7">
            <div class="inline-flex items-center gap-2 text-primary text-[10px] md:text-[11px] font-extrabold uppercase tracking-[.12em] mb-2">
                <span class="material-symbols-outlined text-[17px]" aria-hidden="true">home_pin</span>
                {{ __('Kunjungan & Lokasi') }}
            </div>

            <h2
                id="visit-heading"
                class="font-serif text-[28px] md:text-[36px] lg:text-[40px] font-bold text-primary leading-[1.08] tracking-[-.02em]"
            >
                {{ __('Kunjungi BB Pustaka') }}
            </h2>

            <p class="mt-2.5 max-w-[620px] text-[11.5px] md:text-[13px] leading-[1.65] text-on-surface-variant">
                {{ __('Kami menyambut kunjungan perorangan maupun kelompok untuk studi pustaka dan wisata literasi sejarah.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-start">
            {{-- INFO --}}
            <div class="lg:col-span-4 space-y-3">
                <div class="bg-white/90 backdrop-blur-sm border border-outline-variant/25 rounded-[18px] p-4 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[19px]" aria-hidden="true">location_on</span>
                        </div>

                        <div class="min-w-0">
                            <h3 class="font-bold text-[13px] text-primary">{{ __('Alamat') }}</h3>
                            <p class="mt-1 text-[11px] md:text-[12px] leading-[1.55] text-on-surface-variant">
                                {{ $address }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-sm border border-outline-variant/25 rounded-[18px] p-4 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[19px]" aria-hidden="true">schedule</span>
                        </div>

                        <div class="min-w-0">
                            <h3 class="font-bold text-[13px] text-primary">{{ __('Jam Operasional') }}</h3>
                            <div class="mt-1 text-[11px] md:text-[12px] leading-[1.55] text-on-surface-variant">
                                {!! nl2br(e($operationalHours)) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div x-data="{copied:false,address:@js($address)}" class="grid grid-cols-2 gap-2.5">
                    <a
                        href="{{ $mapsUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="h-[42px] px-3 rounded-xl bg-primary text-on-primary font-bold text-[11px] flex items-center justify-center gap-2 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all"
                    >
                        <span class="material-symbols-outlined text-[17px]" aria-hidden="true">near_me</span>
                        {{ __('Arah ke Lokasi') }}
                    </a>

                    <button
                        type="button"
                        @click="navigator.clipboard.writeText(address);copied=true;setTimeout(()=>copied=false,1500)"
                        class="h-[42px] px-3 rounded-xl bg-white/90 border border-primary/20 text-primary font-bold text-[11px] flex items-center justify-center gap-2 hover:bg-white hover:border-primary/35 transition-all"
                    >
                        <span class="material-symbols-outlined text-[17px]" aria-hidden="true">content_copy</span>
                        <span x-text="copied?'Alamat disalin':'Salin Alamat'">{{ __('Salin Alamat') }}</span>
                    </button>
                </div>
            </div>

            {{-- MAP --}}
            <div class="lg:col-span-5">
                <div class="h-[320px] md:h-[350px] lg:h-[365px] bg-white rounded-[18px] p-1.5 border border-outline-variant/25 shadow-[0_10px_28px_rgba(31,73,44,.09)]">
                    <div class="relative w-full h-full rounded-[14px] overflow-hidden bg-surface">
                        @if($mapEmbedUrl)
                            <iframe
                                src="{{ $mapEmbedUrl }}"
                                class="absolute inset-0 w-full h-full border-0"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Peta lokasi {{ $siteName }}"
                            ></iframe>
                        @else
                            <div class="absolute inset-0 flex flex-col items-center justify-center p-8 text-center">
                                <span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">map</span>
                                <p class="mt-2 text-xs font-bold text-primary">{{ __('Peta belum tersedia') }}</p>
                            </div>
                        @endif

                        <a
                            href="{{ $mapsUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="absolute left-3 bottom-3 z-10 inline-flex items-center gap-2 px-3 h-9 rounded-lg bg-white/95 backdrop-blur text-primary text-[10px] font-bold shadow-md hover:bg-white transition-colors"
                        >
                            <span class="material-symbols-outlined text-[16px]" aria-hidden="true">open_in_new</span>
                            {{ __('Buka Google Maps') }}
                        </a>
                    </div>
                </div>
            </div>

            {{-- MEDIA SOSIAL --}}
            <div class="lg:col-span-3">
                <x-social-qr :links="[
                    ['label' => 'Facebook', 'url' => 'https://www.facebook.com/pustakakementan/?locale=id_ID'],
                    ['label' => 'Instagram', 'url' => 'https://www.instagram.com/pustaka.kementan/'],
                    ['label' => 'YouTube', 'url' => 'https://www.youtube.com/@PustakaKementerianPertanian/featured'],
                ]" />
            </div>
        </div>
    </div>
</section>