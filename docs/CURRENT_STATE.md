# CURRENT_STATE.md

> File paling penting untuk melanjutkan project ini di sesi baru. Mencerminkan kondisi di AKHIR percakapan sebelumnya, tepat sebelum handoff. **Selalu verifikasi ulang dengan `Get-Content`/audit source code sebelum coding** — dokumentasi ini adalah snapshot, bukan live-sync dengan project.

## Ringkasan Kondisi Terakhir

Project sudah melewati seluruh 14 STEP pembangunan awal (analisis → instalasi → routing/layout → navbar/hero → profil → layanan grid → berita → koleksi → footer → admin auth → admin CRUD → optimasi SEO → aksesibilitas → chatbot AI), lalu masuk fase **redesign & polish** yang jauh lebih panjang dari pembangunan awalnya: perbaikan navbar berkali-kali, penambahan modul Agenda ke Homepage, penambahan Feedback widget, penggantian ikon sosial media, dan **redesign total halaman Tentang Kami** (paling banyak iterasi — dari halaman teks polos menjadi halaman profil institusi dengan Pinned Hero, visual journey sejarah, dll).

## Homepage (`pages/home.blade.php`)

Urutan section (top to bottom):
1. Navbar (transparan, `:solid-nav="false"`)
2. Hero — slider background foto (Unsplash placeholder), headline, search bar, 4 statistik (`180+ Tahun`, `100k+ Koleksi`, `Terintegrasi`, `24/7`)
3. Quick Access bar — dari DB (`ExternalServiceLink`, 7 item, cached 1 jam)
4. Profile Section — foto gedung ASLI (`gedung-bb-pustaka.jpeg`), badge "1842 — Awal Berdirinya PUSTAKA" (**sudah diperbaiki dari "1817" yang salah di awal**)
5. Services Grid ("Inovasi dan Layanan", 15 item, array hardcode di `HomeController`)
6. **Agenda Section** (`agenda-section.blade.php`) — featured agenda + calendar + list lainnya
7. Layout 70/30: kiri (Berita & Artikel Terbaru 2 item, Koleksi Buku Unggulan 4 item) — kanan sidebar (Tanya Pustakawan, Layanan Publik [Pengumuman Terkini, Zona Integritas], FAQ box 4 item)
8. Visit Section — alamat/jam dari `SiteSetting`, Google Maps embed, kartu "Reservasi & Pengajuan Layanan" (link eksternal placeholder), Social QR (FB/IG/YouTube), Feedback widget
9. Footer

## Halaman Tentang Kami (`pages/about.blade.php`) — STATUS TERAKHIR

Ini file yang paling volatile di project. Struktur final (per patch terakhir sebelum handoff):

1. **Hero (Pinned/Sticky)** — dibungkus `<div class="relative h-[170vh]">`, section di dalamnya `sticky top-0 h-screen`, foto gedung asli sebagai background dengan gradient hijau dari kiri, teks putih (eyebrow kuning + garis, headline besar, deskripsi, CTA "Jelajahi Sejarah Kami" scroll ke `#sejarah`). Navbar transparan (`:solid-nav="false"`) style hitam-transparan/blur sesuai referensi provjabar.
2. **Section "Tentang BB Pustaka"** — TIDAK sticky (sudah diperbaiki dari percobaan sticky-ganda yang buggy), pakai `-mt-16 md:-mt-20` + `rounded-t-[2rem]` + shadow untuk efek "menutupi" Hero secara visual saat discroll. Isi: kolase 2 foto (1 foto utama `gedung01-bb-pustaka.jpeg` + 1 foto kecil overlap `bb-pustaka.jpeg` — **STATUS FILE INI TODO/UNKNOWN**, kemungkinan placeholder yang belum diganti user atau file baru yang belum dikonfirmasi keberadaannya di server), teks "Siapa Kami / Tentang BB Pustaka" + statistik "1842 — 2026 / 180+ Tahun Perjalanan Literasi Pertanian".
3. **Section Sejarah** (`id="sejarah"`) — Visual Journey scroll-activated. Data milestone (FINAL, terverifikasi user, JANGAN diubah tanpa instruksi):
   - **1842** — Awal Berdirinya PUSTAKA. Diawali dengan pembelian 25 judul buku milik Jacques Pierot yang disarankan oleh J.K. Hasskarl dan M. Diard.
   - **1850** — Bibliotheek's Land Plantentuin te Buitenzorg. Secara resmi menjadi perpustakaan dengan nama tersebut.
   - **2000** — Pusat Perpustakaan dan Penyebaran Teknologi Pertanian. Berdasarkan SK Menteri Pertanian Nomor 160/2000.
   - **2023** — Pusat Perpustakaan dan Literasi Pertanian. Nama berubah kembali mengikuti perkembangan organisasi.
   - **2025** — Balai Besar Perpustakaan dan Literasi Pertanian. Nama saat ini digunakan.
   - **PENTING**: 1817 BUKAN tahun berdiri PUSTAKA (itu tahun berdirinya Kebun Raya Bogor, sempat salah dipakai di awal project dan sudah dikoreksi user secara eksplisit — 1842 adalah tahun yang benar).
   - Desktop: horizontal timeline alternating. Mobile: vertical timeline. Scroll-activated via `IntersectionObserver`. TIDAK ada foto historis (sengaja, karena tidak ada aset foto sejarah asli — user melarang foto sejarah palsu).
4. **Visi & Misi** — panel hijau besar untuk Visi ("Menjadi pusat literasi pertanian yang handal dan mandiri."), panel untuk Misi **1 kalimat saja** ("Mengelola pengetahuan dan teknologi pertanian untuk kemaslahatan masyarakat.") — **JANGAN dipecah jadi beberapa poin**, itu bukan data asli.
5. **Peran & Fungsi** (gabungan, bukan section terpisah "Peran Kami" + "Tugas Pokok Fungsi") — 4 poin numbered (01-04): Pengembangan Koleksi, Layanan Referensi, Publikasi, Pembinaan Kepustakawanan.
6. **Struktur Organisasi** — diagram 1 level: Kepala Balai → 4 unit (Bagian Tata Usaha, Bidang Pengembangan Koleksi dan Repository, Bidang Layanan dan Literasi Pertanian, Kelompok Jabatan Fungsional Pustakawan). **TIDAK ADA sub-divisi** (data sub-divisi di referensi visual yang pernah dilampirkan user adalah karangan mockup AI, bukan data project).
7. **CTA** — panel hijau, tombol "Jelajahi Koleksi" → `route('collections.index')`.

**Yang BELUM dikerjakan di halaman ini**: pembungkusan `__()`/`t()` untuk terjemahan (semua teks masih hardcode Indonesia).

## Navbar — Status Final
Lihat `DESIGN_SYSTEM.md` bagian Navbar untuk detail visual. Ringkasan struktural: sudah melalui banyak iterasi (2-tier lalu dikembalikan 1-tier, dropdown sempat ter-clip lalu diperbaiki, shadow/spacing dropdown dihaluskan beberapa kali, warna transparan navbar disesuaikan jadi `bg-black/35 backdrop-blur-sm` meniru referensi portal Jabar). Item Agenda sempat ditambahkan ke dropdown Profil lalu **DIHAPUS LAGI** setelah Agenda dipindah jadi section Homepage (bukan halaman terpisah).

## Footer — Status Final
Ikon sosial media sudah diganti dari Material Symbols generik → SVG brand custom dengan background abu terang (`#F1F1F1`) + ikon abu gelap (`#606060`), meniru referensi visual yang dilampirkan user. Data link sosial: Facebook, Instagram, YouTube (Twitter/X ada di `social-icon.blade.php` tapi TODO cek apakah ada datanya di seeder — `FooterLinkSeeder` terakhir dikonfirmasi berisi FB/IG/YouTube saja, Twitter mungkin belum ada entri DB-nya meski komponennya siap).

## Database — Status Final
- Kolom `stock` di `collections` **SUDAH DIHAPUS PERMANEN** (drop column, bukan cuma disembunyikan dari UI).
- Kolom `page_count`, `access_link` ditambahkan ke `collections`.
- Kolom `category`, `image_path` ditambahkan ke `agendas`.
- Tabel `reservations`, `service_requests`, `service_request_types` MASIH ADA di database tapi **TIDAK DIPAKAI** (dead code — form publik dan CRUD admin untuk ini sudah dihapus semua).

## Chatbot — Status Terakhir
Menggunakan provider `openrouter`. **Riwayat**: sempat pakai model `inclusionai/ling-3.0-flash:free` → deprecated → ganti beberapa kali. **Nilai `OPENROUTER_MODEL` di `.env` TERAKHIR TIDAK TERCATAT PASTI di percakapan ini** — WAJIB cek `.env` langsung di sesi baru, jangan asumsikan chatbot langsung berfungsi tanpa verifikasi.

## Aksesibilitas — Status Terakhir
Semua fitur sudah diimplementasi dan (di titik-titik tertentu) sempat rusak karena file CSS kosong, lalu diperbaiki full-restore. **Belum ada laporan bug aksesibilitas yang belum diperbaiki** di akhir percakapan.

## Git — Status Terakhir
- `git init` sudah dijalankan, `.gitignore` sudah dibuat.
- Minimal 1 commit terkonfirmasi: `d38be17 checkpoint: homepage, terjemahan EN lengkap, favicon`.
- Banyak perubahan besar (navbar redesign, Agenda feature, About redesign total, foto asli) terjadi **SETELAH** commit itu — **KEMUNGKINAN BESAR BELUM DI-COMMIT**. Sangat disarankan sesi baru menyarankan user commit checkpoint baru sebelum lanjut development, supaya kondisi "About sudah bagus" ini punya titik restore.
- Belum terhubung ke remote/GitHub (keputusan sadar user, "nanti aja").

## Loading Screen
**TODO/UNKNOWN** — tidak ada bukti eksplisit di percakapan bahwa loading screen khusus (splash/skeleton) pernah diminta atau dibangun. Kalau user menyinggung ini di sesi baru, anggap sebagai fitur BARU, bukan lanjutan.

## Responsive (Desktop/Mobile)
Semua komponen dirancang responsive dari awal (mobile-first class Tailwind dipakai konsisten), tapi **TIDAK PERNAH DIUJI di perangkat fisik** — hanya via resize DevTools browser oleh AI melalui deskripsi user, tidak ada screenshot mobile asli yang pernah dikirim user. Fokus testing berikutnya yang disarankan.

## Fokus Pekerjaan Saat Handoff
Percakapan berakhir tepat setelah memperbaiki 3 bug pada Pinned Hero About (navbar tidak transparan, gambar kolase rusak/duplikat src, efek scroll "ikut ke-drag"). **Belum ada konfirmasi user bahwa perbaikan ini sudah benar dan sesuai referensi** (referensi terakhir: https://buahtropika.brmp.pertanian.go.id/organisasi/overview , pola pinned-hero-lalu-tertutup-section-berikutnya). Ini kemungkinan besar hal pertama yang perlu ditindaklanjuti/diverifikasi di sesi baru.
