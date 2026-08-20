<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $berita=NewsCategory::query()->firstOrCreate(['slug'=>'berita'],['name'=>'Berita']);
        $literasi=NewsCategory::query()->firstOrCreate(['slug'=>'info-literasi'],['name'=>'Info Literasi']);

        $items=[
            [
                'news_category_id'=>$berita->id,
                'title'=>'HUT ke-81 RI, BB Pustaka Teguhkan Peran Literasi Dukung Swasembada Pangan',
                'slug'=>'hut-ke-81-ri-bb-pustaka-teguhkan-peran-literasi-dukung-swasembada-pangan',
                'excerpt'=>'Peringatan HUT ke-81 RI menjadi momentum BB Pustaka meneguhkan peran literasi pertanian dalam mendukung pembangunan pertanian dan swasembada pangan.',
                'body'=>"## Sekilas Peringatan\n\nPeringatan HUT ke-81 Kemerdekaan Republik Indonesia menjadi momentum bagi BB Pustaka untuk memperkuat komitmen mendukung pembangunan pertanian, swasembada pangan, dan peningkatan kualitas layanan publik.\n\n## Peran Literasi untuk Swasembada Pangan\n\nDalam rangkaian peringatan kemerdekaan, BB Pustaka menekankan pentingnya kerja nyata, kolaborasi, serta penyediaan akses informasi dan literasi pertanian sebagai bagian dari dukungan terhadap pembangunan sektor pertanian nasional.\n\n## Komitmen BB Pustaka\n\nBB Pustaka terus berupaya memperkuat perannya sebagai pusat informasi dan literasi pertanian agar pengetahuan dan teknologi pertanian semakin mudah diakses masyarakat.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/index-berita/hut-ke-81-ri-bb-pustaka-teguhkan-peran-literasi-dukung-swasembada-pangan",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Agustus/WhatsApp_Image_2026-08-17_at_101320.jpeg',
                'is_published'=>true,
                'published_at'=>'2026-08-17 08:00:00',
            ],
            [
                'news_category_id'=>$berita->id,
                'title'=>'Kementerian Pertanian Kuatkan Mimpi Sekolah Rakyat',
                'slug'=>'kementerian-pertanian-kuatkan-mimpi-sekolah-rakyat',
                'excerpt'=>'BB Pustaka mendukung kegiatan Sekolah Rakyat Rintisan 5 Bogor melalui fasilitas belajar, penguatan literasi, dan akses ke Perpustakaan dan Pengetahuan Pertanian Digital.',
                'body'=>"## Dukungan untuk Sekolah Rakyat\n\nKementerian Pertanian melalui BB Pustaka memberikan dukungan bagi kegiatan Sekolah Rakyat Rintisan 5 Bogor. Sebagian fasilitas di lingkungan BB Pustaka dimanfaatkan sebagai tempat belajar setelah melalui proses renovasi.\n\n## Akses Fasilitas Literasi\n\nSiswa dan guru juga mendapat kesempatan memanfaatkan fasilitas Gedung Perpustakaan dan Pengetahuan Pertanian Digital (P3D), termasuk koleksi buku pertanian dan pengetahuan umum, ruang belajar, serta ruang diskusi.\n\n## Penguatan Budaya Membaca\n\nKehadiran Sekolah Rakyat di lingkungan BB Pustaka diharapkan memperkuat kegiatan edukatif sekaligus menumbuhkan budaya membaca dan literasi sejak dini.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/index-berita/kementerian-pertanian-kuatkan-mimpi-sekolah-rakyat",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Agustus/DSCF0669.jpg',
                'is_published'=>true,
                'published_at'=>'2026-08-15 08:00:00',
            ],
            [
                'news_category_id'=>$berita->id,
                'title'=>'HUT ke-81 RI, BB Pustaka Teguhkan Pengabdian Pertanian',
                'slug'=>'hut-ke-81-ri-bb-pustaka-teguhkan-pengabdian-pertanian',
                'excerpt'=>'Keluarga besar BB Pustaka memperingati HUT ke-81 RI dengan semangat pengabdian, kolaborasi, dan kontribusi bagi kemajuan pertanian Indonesia.',
                'body'=>"## Semangat Pengabdian\n\nBB Pustaka memperingati HUT ke-81 Republik Indonesia dengan menguatkan semangat kebersamaan, pengabdian, dan kinerja untuk pembangunan pertanian Indonesia.\n\n## Kolaborasi untuk Pertanian\n\nMomentum kemerdekaan digunakan untuk meneguhkan komitmen seluruh pegawai dalam memberikan pelayanan terbaik serta memperkuat kolaborasi dengan berbagai pihak di sektor pertanian.\n\n## Peran Literasi Pertanian\n\nBB Pustaka juga menegaskan perannya dalam menyediakan akses informasi, meningkatkan literasi pertanian, dan menyebarluaskan pengetahuan serta teknologi kepada masyarakat untuk mendukung swasembada pangan yang berkelanjutan.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/index-berita/hut-ke-81-ri-bb-pustaka-teguhkan-pengabdian-pertanian",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Agustus/hut_RI.jpg',
                'is_published'=>true,
                'published_at'=>'2026-08-14 08:00:00',
            ],
            [
                'news_category_id'=>$berita->id,
                'title'=>'Semarak Kemerdekaan, BB Pustaka Hadirkan Bazar Murah Dua Hari',
                'slug'=>'semarak-kemerdekaan-bb-pustaka-hadirkan-bazar-murah-dua-hari',
                'excerpt'=>'BB Pustaka menghadirkan Bazar Murah pada 11–12 Agustus 2026 sebagai bagian dari rangkaian semarak HUT ke-81 Kemerdekaan Republik Indonesia.',
                'body'=>"## Semarak Kemerdekaan\n\nDalam rangka memeriahkan HUT ke-81 Kemerdekaan Republik Indonesia, BB Pustaka menyelenggarakan Bazar Murah selama dua hari pada 11–12 Agustus 2026 di halaman kantor BB Pustaka, Bogor.\n\n## Bazar Murah Dua Hari\n\nKegiatan menghadirkan berbagai produk dan kebutuhan dengan harga terjangkau serta mendapat antusiasme dari pegawai dan pengunjung. Bazar juga menjadi ruang interaksi yang memperkuat suasana kebersamaan menjelang peringatan kemerdekaan.\n\n## Kebersamaan di BB Pustaka\n\nMelalui kegiatan tersebut, semangat kemerdekaan diwujudkan tidak hanya melalui kegiatan seremonial, tetapi juga melalui kebersamaan, kepedulian, dan gotong royong di lingkungan BB Pustaka.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/index-berita/semarak-kemerdekaan-bb-pustaka-hadirkan-bazar-murah-dua-hari",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Agustus/fdd06316-ba1e-45a4-9cc6-de30bf6cccf5.jpg',
                'is_published'=>true,
                'published_at'=>'2026-08-11 08:00:00',
            ],
            [
                'news_category_id'=>$berita->id,
                'title'=>'Perkuat Swasembada Pangan, Kementan Dorong Teknologi PM-AAS dan KUR',
                'slug'=>'perkuat-swasembada-pangan-kementan-dorong-teknologi-pm-aas-dan-kur',
                'excerpt'=>'BB Pustaka memperkuat literasi teknologi pertanian dan akses pembiayaan KUR bagi petani serta penyuluh di Leuwiliang, Kabupaten Bogor.',
                'body'=>"## Penguatan Literasi Pertanian\n\nBB Pustaka memperkuat literasi pertanian bagi petani dan penyuluh di BPP Wilayah IV Leuwiliang.\n\n## Teknologi PM-AAS dan KUR\n\nPeserta mendapatkan informasi mengenai teknologi PM-AAS untuk mendukung produktivitas pertanian serta edukasi mengenai Kredit Usaha Rakyat sebagai alternatif pembiayaan usaha tani.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/index-berita/perkuat-swasembada-pangan-kementan-dorong-teknologi-pm-aas-dan-kur",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Agustus/IMG_2761_1.jpg',
                'is_published'=>true,
                'published_at'=>'2026-08-10 08:00:00',
            ],
            [
                'news_category_id'=>$berita->id,
                'title'=>'GERTAM di Propinsi Banten Dorong Peningkatan Produksi Pangan Nasional',
                'slug'=>'gertam-di-propinsi-banten-dorong-peningkatan-produksi-pangan-nasional',
                'excerpt'=>'Gerakan Tanam di Kabupaten Lebak menjadi bagian dari upaya meningkatkan produksi dan memperkuat ketahanan pangan nasional.',
                'body'=>"## Gerakan Tanam di Banten\n\nGerakan Tanam dilaksanakan di Desa Cikeucang, Kecamatan Wanasalam, Kabupaten Lebak sebagai bagian dari upaya meningkatkan produksi pangan nasional.\n\n## Kolaborasi Mendukung Produksi Pangan\n\nKegiatan melibatkan pemerintah, penyuluh, Brigade Pangan dan petani dengan dukungan penerapan pertanian modern.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/index-berita/gertam-di-propinsi-banten-dorong-peningkatan-produksi-pangan-nasional",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Juli/WhatsApp_Image_2026-07-31_at_144553.jpeg',
                'is_published'=>true,
                'published_at'=>'2026-07-31 08:00:00',
            ],
            [
                'news_category_id'=>$berita->id,
                'title'=>'BB Pustaka Perkuat Akreditasi Perpustakaan BRMP Pengelola Hasil',
                'slug'=>'bb-pustaka-perkuat-akreditasi-perpustakaan-brmp-pengelola-hasil',
                'excerpt'=>'BB Pustaka mendampingi visitasi akreditasi Perpustakaan BRMP Pengelola Hasil untuk meningkatkan mutu tata kelola dan layanan informasi.',
                'body'=>"## Pendampingan Akreditasi\n\nBB Pustaka mendampingi Tim Asesor Perpustakaan Nasional dalam visitasi akreditasi Perpustakaan BRMP Pengelola Hasil.\n\n## Aspek Penilaian\n\nPenilaian mencakup fasilitas, koleksi, layanan, tata kelola dan penguatan layanan digital.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/index-berita/bb-pustaka-perkuat-akreditasi-perpustakaan-brmp-pengelola-hasil",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Juli/Akreditasi_BRMP_UAT.jpg',
                'is_published'=>true,
                'published_at'=>'2026-07-30 09:00:00',
            ],
            [
                'news_category_id'=>$berita->id,
                'title'=>'BB Pustaka Sukses Dampingi Perpustakaan BRMP Unggas Raih Akreditasi A',
                'slug'=>'bb-pustaka-sukses-dampingi-perpustakaan-brmp-unggas-raih-akreditasi-a',
                'excerpt'=>'Perpustakaan BRMP Unggas dan Aneka Ternak meraih predikat Akreditasi A setelah memperoleh pendampingan dari BB Pustaka.',
                'body'=>"## Capaian Akreditasi A\n\nPerpustakaan BRMP Unggas dan Aneka Ternak berhasil memperoleh Predikat Akreditasi A dari Perpustakaan Nasional.\n\n## Penguatan Mutu Perpustakaan\n\nCapaian tersebut menjadi pengakuan terhadap kualitas layanan, pengelolaan koleksi dan tata kelola perpustakaan.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/index-berita/bb-pustaka-sukses-dampingi-perpustakaan-brmp-unggas-raih-akreditasi-a",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Juli/WhatsApp_Image_2026-07-31_at_143649.jpeg',
                'is_published'=>true,
                'published_at'=>'2026-07-30 08:00:00',
            ],
            [
                'news_category_id'=>$berita->id,
                'title'=>'BB Pustaka Perkuat Literasi Melalui Akreditasi Lingkup Kementan',
                'slug'=>'bb-pustaka-perkuat-literasi-melalui-akreditasi-lingkup-kementan',
                'excerpt'=>'BB Pustaka mendampingi proses akreditasi sejumlah perpustakaan di lingkungan Kementerian Pertanian.',
                'body'=>"## Pendampingan Akreditasi\n\nBB Pustaka mendampingi tim asesor Perpustakaan Nasional dalam proses akreditasi sejumlah perpustakaan lingkup Kementerian Pertanian yang dipusatkan di BBPKH Cinagara.\n\n## Penguatan Layanan dan Literasi\n\nKegiatan dilakukan untuk memperkuat mutu layanan informasi, literasi dan tata kelola perpustakaan.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/index-berita/perkuat-literasi-bb-pustaka-dampingi-asesor-perpusnas-untuk-akreditasi-perpustakaan-lingkup-kementerian-pertanian-di-bbpkh-cinagara",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Juli/8cc62506-eec6-4f01-997e-69a2cc4625c3.jpg',
                'is_published'=>true,
                'published_at'=>'2026-07-28 08:00:00',
            ],
            [
                'news_category_id'=>$berita->id,
                'title'=>'Layanan BB Pustaka',
                'slug'=>'layanan-bb-pustaka',
                'excerpt'=>'BB Pustaka menyediakan layanan perpustakaan, literasi dan penerbitan pertanian bagi masyarakat.',
                'body'=>"## Layanan Perpustakaan dan Literasi\n\nBB Pustaka menyediakan Layanan Perpustakaan dan Literasi Pertanian serta Layanan Penerbitan Pertanian.\n\n## Akses Informasi Pertanian\n\nLayanan dapat dimanfaatkan petani, penyuluh, akademisi, mahasiswa, pelajar dan masyarakat untuk memperoleh informasi pertanian yang akurat dan mudah diakses.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/index-berita/layanan-bb-pustaka",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Juli/WhatsApp_Image_2026-07-22_at_083804.jpeg',
                'is_published'=>true,
                'published_at'=>'2026-07-22 08:00:00',
            ],
            [
                'news_category_id'=>$literasi->id,
                'title'=>'Info Literasi: Ubi Kelapa: Potensi dan Diversifikasi Umbi Lokal yang Mendunia',
                'slug'=>'info-literasi-ubi-kelapa-potensi-dan-diversifikasi-umbi-lokal-yang-mendunia',
                'excerpt'=>'Ubi kelapa atau uwi memiliki potensi sebagai pangan lokal bernilai tambah yang dapat dikembangkan untuk diversifikasi pangan dan berbagai produk olahan.',
                'body'=>"## Mengenal Ubi Kelapa\n\nUbi kelapa atau uwi (Dioscorea alata) merupakan salah satu umbi lokal yang telah lama dikenal di berbagai wilayah Indonesia. Umbinya memiliki warna beragam, mulai dari putih dan krem hingga ungu yang dikenal pula melalui tren ube.\n\n## Potensi Budidaya\n\nTanaman ini cukup adaptif terhadap lingkungan tropis dan dapat dibudidayakan secara monokultur maupun tumpangsari. Selain sebagai sumber karbohidrat, ubi kelapa memiliki potensi untuk dikembangkan menjadi berbagai produk pangan bernilai tambah.\n\n## Diversifikasi Produk Olahan\n\nPengolahannya dapat dilakukan dalam bentuk pangan langsung maupun tepung yang kemudian dimanfaatkan untuk aneka produk seperti mi, kue, cake, muffin, dan berbagai olahan lainnya. Pengembangan ubi kelapa dapat mendukung diversifikasi pangan sekaligus membuka peluang bagi industri pengolahan dan UMKM.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/info-literasi/info-literasi-ubi-kelapa-potensi-dan-diversifikasi-umbi-lokal-yang-mendunia-2",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/INFO_LITERASI/2026/AGUSTUS/UbiKelapa_1.png',
                'is_published'=>true,
                'published_at'=>'2026-08-11 07:00:00',
            ],
            [
                'news_category_id'=>$literasi->id,
                'title'=>'Info Literasi: Cegah Penyakit Sejak Dini, Kunci Sukses Budi Daya Bawang Putih',
                'slug'=>'info-literasi-cegah-penyakit-sejak-dini-kunci-sukses-budi-daya-bawang-putih',
                'excerpt'=>'Deteksi gejala penyakit sejak dini dan penerapan langkah pencegahan menjadi bagian penting untuk menjaga kesehatan serta produktivitas tanaman bawang putih.',
                'body'=>"## Pentingnya Pengendalian Penyakit\n\nKeberhasilan budi daya bawang putih tidak hanya bergantung pada benih dan pemupukan, tetapi juga pada pengendalian penyakit tanaman sejak dini.\n\n## Penyakit pada Bawang Putih\n\nBawang putih dapat terserang berbagai penyakit yang disebabkan jamur maupun virus, antara lain antraknosa, bercak ungu, embun tepung, bercak daun, layu Fusarium, mati pucuk, dan penyakit virus kompleks.\n\n## Langkah Pencegahan\n\nPencegahan dapat dilakukan melalui penggunaan benih sehat, pemupukan berimbang, sanitasi lahan, pengaturan drainase dan jarak tanam, rotasi tanaman, serta pengendalian organisme penyebab penyakit sesuai kondisi tanaman. Pengenalan gejala sejak awal membantu menekan risiko kerusakan dan kehilangan hasil.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/info-literasi/info-literasi-cegah-penyakit-sejak-dini-kunci-sukses-budi-daya-bawang-putih",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/INFO_LITERASI/2026/AGUSTUS/IL-Penyakit_bawang_1.png',
                'is_published'=>true,
                'published_at'=>'2026-08-04 08:00:00',
            ],
            [
                'news_category_id'=>$literasi->id,
                'title'=>'Info Literasi: Anggur Tropis Indonesia: Saatnya Menguasai Pasar Domestik',
                'slug'=>'info-literasi-anggur-tropis-indonesia-saatnya-menguasai-pasar-domestik',
                'excerpt'=>'Varietas anggur tropis Indonesia memiliki peluang dikembangkan untuk memperkuat produksi buah lokal dan mengurangi ketergantungan pasar terhadap produk impor.',
                'body'=>"## Peluang Anggur Tropis Indonesia\n\nPermintaan anggur di Indonesia terus berkembang sementara pasar domestik masih banyak dipenuhi produk impor. Kondisi ini membuka peluang bagi pengembangan varietas anggur yang mampu beradaptasi dengan iklim tropis Indonesia.\n\n## Kunci Keberhasilan Budidaya\n\nKeberhasilan budi daya anggur tropis membutuhkan varietas unggul, benih berkualitas, lokasi yang sesuai, dan penerapan teknologi budi daya yang tepat. Beberapa varietas hasil pemuliaan dalam negeri juga memiliki karakter yang berpotensi bersaing di pasar.\n\n## Potensi Produk Olahan\n\nSelain dikonsumsi sebagai buah segar, anggur dapat diolah menjadi jus, selai, kismis dan produk lainnya sehingga memiliki peluang nilai tambah dalam sektor pengolahan dan pemasaran hasil pertanian.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/info-literasi/info-literasi-anggur-tropis-indonesia-saatnya-menguasai-pasar-domestik",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Juli/IL-Anggur_1.png',
                'is_published'=>true,
                'published_at'=>'2026-07-30 08:00:00',
            ],
            [
                'news_category_id'=>$literasi->id,
                'title'=>'Info Teknologi: Pengairan Basah-Kering (AWD): Strategi Efektif Menjaga Air Tanah pada Musim Kemarau',
                'slug'=>'info-teknologi-pengairan-basah-kering-awd-strategi-efektif-menjaga-air-tanah-pada-musim-kemarau',
                'excerpt'=>'Alternate Wetting and Drying atau AWD merupakan metode pengairan sawah secara berselang untuk meningkatkan efisiensi penggunaan air pada musim kemarau.',
                'body'=>"## Tantangan Ketersediaan Air\n\nKetersediaan air menjadi salah satu tantangan produksi pertanian pada musim kemarau. Salah satu pendekatan pengelolaan air yang dapat digunakan pada sawah adalah Alternate Wetting and Drying (AWD) atau pengairan basah-kering.\n\n## Cara Kerja AWD\n\nDalam metode ini, penggenangan dan pengeringan dilakukan secara bergantian dan terukur. Kondisi muka air dapat dipantau menggunakan alat sederhana berbahan paralon yang dipasang pada lahan.\n\n## Manfaat Pengairan Basah-Kering\n\nPenerapan AWD membantu penggunaan air menjadi lebih efisien sekaligus menjaga kebutuhan tanaman. Pengelolaan yang tepat juga dapat memberikan manfaat bagi kondisi akar, tanah, dan keberlanjutan produksi padi pada wilayah dengan pasokan air terbatas.\n\nSumber asli: https://pustaka.bppsdmp.pertanian.go.id/info-literasi/info-teknologi-pengairan-basah-kering-awd-strategi-efektif-menjaga-air-tanah-pada-musim-kemarau",
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Juli/IL-AWD_1.png',
                'is_published'=>true,
                'published_at'=>'2026-07-29 08:00:00',
            ],
        ];

        foreach($items as $item){
            News::query()->updateOrCreate(['slug'=>$item['slug']],$item);
        }
    }
}