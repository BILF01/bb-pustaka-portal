<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\CollectionCategory;
use App\Models\ExternalServiceLink;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        /*
         * Hapus data collection dummy dari factory.
         * Seeder ini hanya mengganti data koleksi + kategorinya.
         * External service links tetap dipertahankan di bawah.
         */
        Collection::query()->delete();
        CollectionCategory::query()->delete();

        $categoryData = [
            [
                'name' => 'Ketahanan Pangan',
                'slug' => 'ketahanan-pangan',
            ],
            [
                'name' => 'Tanaman Pangan',
                'slug' => 'tanaman-pangan',
            ],
            [
                'name' => 'Perkebunan',
                'slug' => 'perkebunan',
            ],
            [
                'name' => 'Sumber Daya Lahan',
                'slug' => 'sumber-daya-lahan',
            ],
            [
                'name' => 'Pertanian Berkelanjutan',
                'slug' => 'pertanian-berkelanjutan',
            ],
            [
                'name' => 'Kebijakan Pertanian',
                'slug' => 'kebijakan-pertanian',
            ],
        ];

        $categories = collect($categoryData)
            ->mapWithKeys(function (array $category): array {
                $model = CollectionCategory::query()->create($category);

                return [$category['slug'] => $model];
            });

        $collections = [
            [
                'category' => 'ketahanan-pangan',
                'title' => 'Menjaga Keberlanjutan Swasembada Pangan',
                'author' => 'Andi Amran Sulaiman; Kuntoro Boga Andri; Abd. Haris Bahrun',
                'publisher' => 'Pertanian Press',
                'published_year' => 2023,
                'isbn' => null,
                'page_count' => '141',
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/23684',
                'synopsis' => 'Catatan perjalanan pembangunan pertanian Indonesia dalam mewujudkan ketahanan pangan dan menjaga keberlanjutan swasembada pangan nasional.',
                'cover_path' => null,
                'is_featured' => true,
            ],
            [
                'category' => 'tanaman-pangan',
                'title' => 'Pengendalian Hama dan Penyakit Utama Tanaman Padi',
                'author' => 'Andi Amran Sulaiman; Fadjry Djufry; Muhammad Thamrin; Priatna Sasmita; dkk.',
                'publisher' => 'Pertanian Press',
                'published_year' => 2024,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/23701',
                'synopsis' => 'Panduan mengenai jenis hama dan penyakit utama tanaman padi beserta rekomendasi teknologi pengendaliannya.',
                'cover_path' => null,
                'is_featured' => true,
            ],
            [
                'category' => 'kebijakan-pertanian',
                'title' => 'Kumpulan SNI Komoditas Pertanian BSIP Babel 2023',
                'author' => 'Nuraini; Agus Wahyana Anggara; Muzammil; Febi Oktria; dkk.',
                'publisher' => 'Pertanian Press',
                'published_year' => 2023,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/21156',
                'synopsis' => 'Kumpulan standar nasional untuk berbagai komoditas tanaman pangan, perkebunan, hortikultura, dan peternakan.',
                'cover_path' => null,
                'is_featured' => true,
            ],
            [
                'category' => 'pertanian-berkelanjutan',
                'title' => 'Pengelolaan Sumberdaya Menuju Pertanian Modern Berkelanjutan',
                'author' => 'Fadjry Djufry; Haryono Soeparno; Rusman Heriawan; Achmad Suryana; Effendi Pasandaran; dkk.',
                'publisher' => 'IAARD Press',
                'published_year' => 2021,
                'isbn' => '978-602-344-308-6',
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/16382',
                'synopsis' => 'Membahas pengelolaan sumber daya dan transformasi pembangunan menuju sistem pertanian modern yang produktif dan berkelanjutan.',
                'cover_path' => null,
                'is_featured' => true,
            ],
            [
                'category' => 'kebijakan-pertanian',
                'title' => 'Menuju Balitbangtan Terdepan dalam Penelitian Pangan dan Pertanian',
                'author' => 'Rusman Heriawan; Haryono Soeparno; Irsal Las; Achmad Suryana; dkk.',
                'publisher' => 'IAARD Press',
                'published_year' => 2019,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/8907',
                'synopsis' => 'Mengulas penguatan sistem penelitian dan inovasi untuk menghasilkan teknologi pertanian yang progresif dan berdaya saing.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'perkebunan',
                'title' => 'Aren: Untuk Pangan, Bioenergi, dan Konservasi',
                'author' => 'A. Lay; Muhammad Syakir; Andi Nur Alamsyah',
                'publisher' => 'IAARD Press',
                'published_year' => 2017,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/20176',
                'synopsis' => 'Membahas produksi, budidaya, panen, pengolahan, aspek sosial ekonomi, bioenergi, serta potensi konservasi tanaman aren.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'pertanian-berkelanjutan',
                'title' => 'Sinergi Sistem Penelitian dan Inovasi Pertanian Berkelanjutan',
                'author' => 'Irsal Las; Tjeppy D. Soedjana; Haryono Soeparno; Rusman Heriawan; Achmad Suryana; dkk.',
                'publisher' => 'IAARD Press',
                'published_year' => 2018,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/8908',
                'synopsis' => 'Membahas sinergi penelitian, pengembangan, dan inovasi sebagai landasan pembangunan pertanian berkelanjutan.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'perkebunan',
                'title' => 'Budidaya dan Pascapanen Tebu',
                'author' => 'Chandra Indrawanto; Purwono; Muhammad Syakir; Siswanto; Deciyanto Soetopo; dkk.',
                'publisher' => 'IAARD Press',
                'published_year' => 2017,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/21165',
                'synopsis' => 'Panduan teknik budidaya dan pascapanen tebu untuk mendukung peningkatan produktivitas dan rendemen.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'pertanian-berkelanjutan',
                'title' => 'Climate-Smart Agriculture (CSA) di Lahan Sawah Tadah Hujan',
                'author' => 'Prihasto Setyanto; A. Wihardjaka; Helena Lina Susilawati; Ali Pramono; dkk.',
                'publisher' => 'IAARD Press',
                'published_year' => 2018,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/21061',
                'synopsis' => 'Mengulas penerapan Climate-Smart Agriculture untuk meningkatkan produktivitas sekaligus adaptasi dan mitigasi perubahan iklim.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'pertanian-berkelanjutan',
                'title' => 'Sistem Pertanian Organik Mendukung Produktivitas Lahan Berkelanjutan',
                'author' => 'Badan Penelitian dan Pengembangan Pertanian',
                'publisher' => 'IAARD Press',
                'published_year' => 2015,
                'isbn' => '978-602-344-068-9',
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/15078',
                'synopsis' => 'Membahas sistem pertanian organik, pemupukan organik dan hayati, konservasi tanah, budidaya, sertifikasi, serta pemasaran produk organik.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'kebijakan-pertanian',
                'title' => 'Kesiapan Daerah Mendukung Pertanian Modern',
                'author' => 'Effendi Pasandaran; Fadjry Djufry; Kedi Suradisastra',
                'publisher' => 'IAARD Press',
                'published_year' => 2019,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/15786',
                'synopsis' => 'Membahas kesiapan daerah, kebijakan, dan kebutuhan inovasi untuk mendukung pembangunan sektor pertanian modern.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'sumber-daya-lahan',
                'title' => 'Sumber Hara Tanaman Berbahan Baku Lokal',
                'author' => 'Ladiyani Retno Widowati; Adha Fatmah Siregar; Heri Wibowo; Ibrahim Adamy Sipahutar; dkk.',
                'publisher' => 'Pertanian Press',
                'published_year' => 2023,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/21989',
                'synopsis' => 'Menguraikan berbagai sumber bahan baku lokal yang berpotensi dimanfaatkan sebagai sumber unsur hara bagi tanaman.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'pertanian-berkelanjutan',
                'title' => 'Mewujudkan Pertanian Berkelanjutan',
                'author' => 'Badan Penelitian dan Pengembangan Pertanian; Tahlim Sudaryanto; Ismeth Inounu',
                'publisher' => 'IAARD Press',
                'published_year' => 2018,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/15759',
                'synopsis' => 'Membahas pengelolaan sumber daya alam, sistem produksi pertanian, sosial ekonomi, dan arah kebijakan pertanian berkelanjutan.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'sumber-daya-lahan',
                'title' => 'Lahan Rawa Lebak: Sistem Pertanian dan Pengembangannya',
                'author' => 'H. Luthfi Fatah dkk.',
                'publisher' => 'IAARD Press',
                'published_year' => 2017,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/8370',
                'synopsis' => 'Mengulas karakteristik, pemanfaatan, pengelolaan air, serta pengembangan sistem pertanian di lahan rawa lebak.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'tanaman-pangan',
                'title' => 'Budidaya Padi di Lahan Rawa Lebak',
                'author' => 'Destika Cahyana; Isdijanto Ar-Riza; Muhammad Noor; Anna Khairani',
                'publisher' => 'IAARD Press',
                'published_year' => 2017,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/8342',
                'synopsis' => 'Membahas teknologi dan pola budidaya padi yang disesuaikan dengan karakteristik khas lahan rawa lebak.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'kebijakan-pertanian',
                'title' => 'Perdagangan Internasional Komoditas Pangan Strategis',
                'author' => 'Andi Amran Sulaiman; Kasdi Subagyono; Hermanto; Suwandi; Bambang Sayaka; dkk.',
                'publisher' => 'IAARD Press',
                'published_year' => 2018,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/21037',
                'synopsis' => 'Membahas perdagangan internasional dan kebijakan pangan strategis dalam kaitannya dengan kedaulatan pangan dan kesejahteraan petani.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'kebijakan-pertanian',
                'title' => 'Panduan Evaluasi Peraturan Perundang-undangan Sektoral',
                'author' => 'Novianto; Aji Kurnia Dermawan; Herawati Hadi; Asep M. Rahmat Shiddiq; dkk.',
                'publisher' => 'Pertanian Press',
                'published_year' => 2023,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/22991',
                'synopsis' => 'Panduan mengenai kerangka konsep, tahapan, variabel, metode, dan mekanisme evaluasi peraturan perundang-undangan sektoral.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'pertanian-berkelanjutan',
                'title' => 'Integrasi Tanaman-Ternak Solusi Meningkatkan Pendapatan Petani',
                'author' => 'Candra Irawanto; Atman',
                'publisher' => 'IAARD Press',
                'published_year' => 2017,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/10150',
                'synopsis' => 'Membahas integrasi usaha tanaman dan ternak sebagai sistem pertanian yang dapat meningkatkan efisiensi dan pendapatan petani.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'ketahanan-pangan',
                'title' => 'Transformasi Bantuan Pangan',
                'author' => 'Andi Amran Sulaiman',
                'publisher' => 'IAARD Press',
                'published_year' => 2018,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/28958',
                'synopsis' => 'Membahas transformasi kebijakan bantuan pangan dan pengembangan mekanisme distribusi bantuan pangan kepada masyarakat.',
                'cover_path' => null,
                'is_featured' => false,
            ],
            [
                'category' => 'perkebunan',
                'title' => 'Budi Daya dan Pascapanen Karet',
                'author' => 'Sabarman Damanik; Muhammad Syakir; Siswanto',
                'publisher' => 'IAARD Press',
                'published_year' => 2017,
                'isbn' => null,
                'page_count' => null,
                'access_link' => 'https://repository.pertanian.go.id/handle/123456789/21166',
                'synopsis' => 'Pedoman umum mengenai teknik budi daya dan pascapanen karet untuk mendukung usaha perkebunan yang tepat dan produktif.',
                'cover_path' => null,
                'is_featured' => false,
            ],
        ];

        foreach ($collections as $item) {
            $categorySlug = $item['category'];
            unset($item['category']);

            Collection::query()->create([
                'collection_category_id' => $categories[$categorySlug]->id,
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'author' => $item['author'],
                'publisher' => $item['publisher'],
                'published_year' => $item['published_year'],
                'isbn' => $item['isbn'],
                'page_count' => $item['page_count'],
                'access_link' => $item['access_link'],
                'synopsis' => $item['synopsis'],
                'cover_path' => $item['cover_path'],
                'is_featured' => $item['is_featured'],
            ]);
        }

        /*
         * Quick Access / External Service Link
         * Dipertahankan dari seeder existing.
         */
        $links = [
            [
                'key' => 'opac',
                'name' => 'Smart OPAC',
                'icon' => 'qr_code_scanner',
                'description' => 'Pencarian katalog koleksi cetak secara cerdas',
                'integration_mode' => 'external',
                'external_url' => 'https://opac.pustaka.bppsdmp.pertanian.go.id',
                'sort_order' => 1,
            ],
            [
                'key' => 'repository',
                'name' => 'Repository',
                'icon' => 'folder_special',
                'description' => 'Simpanan digital karya ilmiah pertanian',
                'integration_mode' => 'external',
                'external_url' => 'https://repository.pustaka.bppsdmp.pertanian.go.id',
                'sort_order' => 2,
            ],
            [
                'key' => 'ebook',
                'name' => 'E-Book',
                'icon' => 'menu_book',
                'description' => 'Koleksi buku elektronik pertanian lengkap',
                'integration_mode' => 'native',
                'native_route' => 'collections.index',
                'sort_order' => 3,
            ],
            [
                'key' => 'membership',
                'name' => 'Keanggotaan',
                'icon' => 'badge',
                'description' => 'Pendaftaran anggota perpustakaan',
                'integration_mode' => 'native',
                'native_route' => 'contact.index',
                'sort_order' => 4,
            ],
            [
                'key' => 'visit_schedule',
                'name' => 'Jadwal Kunjungan',
                'icon' => 'calendar_month',
                'description' => 'Reservasi kunjungan ke BB Pustaka',
                'integration_mode' => 'native',
                'native_route' => 'home',
                'sort_order' => 5,
            ],
            [
                'key' => 'ai_assistant',
                'name' => 'AI Assistant',
                'icon' => 'smart_toy',
                'description' => 'Asisten cerdas untuk pencarian literatur',
                'integration_mode' => 'external',
                'external_url' => '#',
                'sort_order' => 6,
            ],
            [
                'key' => 'library_tools',
                'name' => 'Library Tools',
                'icon' => 'build',
                'description' => 'Peralatan pendukung riset dan pustaka',
                'integration_mode' => 'native',
                'native_route' => 'services.index',
                'sort_order' => 7,
            ],
        ];

        foreach ($links as $link) {
            ExternalServiceLink::query()->updateOrCreate(
                ['key' => $link['key']],
                $link
            );
        }
    }
}