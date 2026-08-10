<section class="py-16 md:py-20 bg-primary-container text-on-primary" aria-labelledby="visit-heading">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-10 lg:gap-16">
            <div class="w-full lg:w-1/2 space-y-4">
                <h2 id="visit-heading" class="text-2xl md:text-headline-lg font-bold">{{ __('Kunjungi Pustaka') }}</h2>
                <p class="opacity-90">{{ __('Kami menyambut kunjungan perorangan maupun kelompok untuk studi pustaka dan wisata literasi sejarah.') }}</p>

                <div class="space-y-4 pt-2">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary" aria-hidden="true">location_on</span>
                        <div>
                            <span class="block font-bold">{{ __('Alamat') }}</span>
                            <span class="text-sm opacity-80">{{ \App\Models\SiteSetting::get('address') }}</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary" aria-hidden="true">schedule</span>
                        <div>
                            <span class="block font-bold">{{ __('Jam Operasional') }}</span>
                            <span class="text-sm opacity-80">{!! nl2br(e(\App\Models\SiteSetting::get('operational_hours'))) !!}</span>
                        </div>
                    </div>
                </div>

                <div class="w-full aspect-video rounded-xl overflow-hidden mt-4 shadow-2xl border-4 border-white/10">
                    <iframe
                        src="{{ \App\Models\SiteSetting::get('map_embed_url') }}"
                        class="w-full h-full border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Peta lokasi {{ \App\Models\SiteSetting::get('site_name') }}"
                    ></iframe>
                </div>
            </div>

            <div class="w-full lg:w-1/2">
                <x-external-service-card
                    :heading="__('Reservasi & Pengajuan Layanan')"
                    :description="__('Ajukan reservasi kunjungan, booking ruang rapat, usulan koleksi, dan layanan publik lainnya melalui portal layanan terpadu kami.')"
                    :button-label="__('Buka Portal Layanan')"
                />
                <x-social-qr :links="[
                    ['label' => 'Facebook', 'url' => 'https://www.facebook.com/pustakakementan/?locale=id_ID'],
                    ['label' => 'Instagram', 'url' => 'https://www.instagram.com/pustaka.kementan/'],
                    ['label' => 'YouTube', 'url' => 'https://www.youtube.com/@PustakaKementerianPertanian/featured'],
                ]" />
                <br>
                <x-feedback-widget />
            </div>
        </div>
    </div>
</section>