# FEATURES.md

## SELESAI

### Autentikasi & Role Admin
- Login admin native Laravel Auth (bukan Breeze/Jetstream), role check via Spatie (`role:admin`).
- File: `AuthController` (Public namespace, khusus admin), `routes/admin.php`, `admin/auth/login.blade.php`.
- Redirect guest ke `admin.login` via `redirectGuestsTo()` di `bootstrap/app.php`.

### Modul Berita
- CRUD penuh di admin (upload gambar, kategori, toggle publish).
- Publik: index dengan search (`?q=`), detail (route model binding by slug).
- File: `NewsController` (Public & Admin), `News`/`NewsCategory` model, `admin/news/*`.

### Modul Koleksi Buku
- CRUD penuh di admin (upload sampul, kategori, unggulan).
- Field: title, author, publisher, published_year, isbn, page_count, access_link, synopsis, cover_path, is_featured. **TIDAK ADA `stock`** (sengaja dihapus — BB Pustaka perpustakaan referensi, tidak ada peminjaman bawa pulang).
- Publik: index dengan search (`?q=` cari title/author), detail.
- File: `CollectionController` (Public & Admin), `Collection`/`CollectionCategory` model.

### Modul Agenda
- CRUD penuh di admin (upload gambar, kategori).
- **TIDAK PUNYA halaman publik terpisah** — ditampilkan sebagai section di Homepage (`agenda-section.blade.php`), bukan route `/agenda` (sempat dibuat lalu DIHAPUS atas permintaan user, "jangan di halaman berbeda, masukkan di portal saja").
- Fitur: featured agenda (dengan countdown kalau status "Akan Dimulai"), calendar picker (klik tanggal → fetch AJAX ke `/agenda/by-date`), list agenda lain, status dinamis (`Akan Dimulai`/`Sedang Berlangsung`/`Telah Selesai`) dihitung dari `starts_at`/`ends_at`.
- File: `Agenda` model (dengan `status()`, `statusColor()`, `scopeOnDate()`), `AgendaController` (Public — hanya method `byDate`, Admin — full CRUD), `components/agenda-section.blade.php`.

### Modul FAQ
- Publik: halaman `/faq` + accordion di sidebar Home (4 teratas).
- **Tidak ada CRUD admin** — data dikelola lewat seeder (`FaqSeeder`).
- File: `Faq` model, `FaqController`, `faq-accordion.blade.php`.

### Kontak
- Form kontak sederhana (nama, email, pesan), tersimpan... **TODO/UNKNOWN**: perlu verifikasi apakah data kontak benar tersimpan ke tabel `contacts` atau hanya validasi tanpa persist — di awal project ada `ContactController::store` dengan komentar "penyimpanan menyusul", TIDAK PERNAH DIKONFIRMASI ULANG apakah field persist sudah ditambahkan.

### Halaman Tentang Kami (redesign besar, berkali-kali iterasi)
- Hero pinned/sticky dengan foto gedung asli.
- Section "Tentang BB Pustaka" dengan foto kolase (2 foto — status file TODO, lihat `ARCHITECTURE.md`).
- Section Sejarah — visual journey scroll-activated, 5 milestone (1842/1850/2000/2023/2025).
- Visi & Misi — panel editorial (Visi 1 kalimat besar, Misi 1 kalimat).
- Peran & Fungsi — 4 poin numbered grid (gabungan dari data Tugas Pokok Fungsi, TIDAK ada 6 "peran" terpisah karena tidak ada sumber datanya).
- Struktur Organisasi — diagram 1 level CSS-only (Kepala Balai → 4 unit).
- CTA — panel hijau ke `/koleksi`.
- File: `pages/about.blade.php` (SATU FILE BESAR, paling sering diedit sepanjang project).

### Navbar Redesign (mengikuti struktur menu situs resmi)
- Struktur menu final: Home, Profil▾, Layanan▾, Publikasi▾, Kepustakawanan▾, Informasi Publik, Survey IKM, Zona Integritas▾.
- Sebagian besar item dropdown mengarah ke URL EKSTERNAL situs resmi (`pustaka.bppsdmp.pertanian.go.id` dan domain terkait: `kikp-pertanian.id`, `repository.pertanian.go.id`, `epublikasi.pertanian.go.id`, `ppid.pertanian.go.id`, Google Form Survey IKM).
- Item internal: Profil▾→Tentang/Koleksi dan Layanan/Berita & Artikel/FAQ/Kontak.
- Search box di navbar **SUDAH DIHAPUS** (redundant dengan search di Hero & halaman Koleksi/Berita) atas permintaan user.
- Ikon aksesibilitas di navbar **SUDAH DIHAPUS** (redundant dengan tombol mengambang).

### Sistem Bahasa (i18n) — id/en
- Middleware `SetLocale` (session-based), route `/bahasa/{locale}`.
- Mayoritas UI (navbar, footer, home, faq, chatbot widget, feedback widget, dll.) pakai `__()` + `lang/en.json` manual (~150+ entri).
- Fallback auto-translate (`t()` + `AutoTranslator` + MyMemory API) TERSEDIA tapi **BARU DIPAKAI DI SEBAGIAN KECIL** (feedback-widget, social-qr "Ikuti Kami") — user memutuskan TIDAK migrasi semua `__()`→`t()` karena terlalu banyak kerjaan manual. **Halaman About (redesign terbaru) BELUM DIBUNGKUS terjemahan sama sekali** (hardcode Indonesia) — gap diketahui.

### Aksesibilitas (lengkap)
- Dark Mode, High Contrast, Invert, Grayscale, Color Blind (3 jenis via SVG filter), font scale, letter spacing, line height, zoom, highlight links/headings, reading guide, reading mask, big cursor, stop animation, hide images, focus-strong, narasi teks (baca saat hover/touch — bukan baca-semua-otomatis, ini keputusan desain eksplisit user demi UX yang tidak berisik), perintah suara (voice command navigasi), reset, persist ke localStorage.

### Chatbot AI
- Widget floating, riwayat per `visitor_token` (localStorage + DB), markdown+syntax highlight, typing animation, suggestion prompts.
- Multi-provider architecture (Service Layer + Factory), provider aktif via `.env` `CHATBOT_PROVIDER`.
- **Status koneksi saat ini**: `openrouter` dengan model gratis — **riwayat model deprecated berkali-kali**, cek `.env` untuk nilai `OPENROUTER_MODEL` terkini sebelum asumsi chatbot berfungsi.

### Umpan Balik (Feedback)
- Widget popup di Home (bagian bawah, dekat Visit Section), form rating+ya/tidak+kritik saran+fitur diinginkan.
- Admin: halaman read-only list (`/admin/feedback`), TIDAK ADA fitur ubah status/reply.

### Sitemap
- `/sitemap.xml` dinamis dari data News+Collections.

### Custom Pagination
- Semua listing (Koleksi, Berita) pakai pagination custom (`vendor/pagination/bb-pustaka.blade.php`) — desain selaras brand, bukan default Laravel/Bootstrap.

## SEDANG DIKERJAKAN / BARU SAJA DIREVISI (perlu verifikasi user di sesi berikutnya)

- **Pinned Hero di About**: patch terakhir memperbaiki bug "ikut ke-drag pas scroll" + navbar tidak transparan + gambar kolase rusak (duplikat atribut `src`). **BELUM ADA KONFIRMASI dari user bahwa hasil akhir sudah benar** — ini adalah state di akhir percakapan sebelum handoff.
- **Foto kolase About** (`gedung01-bb-pustaka.jpeg`, `bb-pustaka.jpeg`): keberadaan file ini di `public/images/` TIDAK TERKONFIRMASI. Kalau halaman About error/gambar broken di titik ini, cek dulu apakah file-file ini benar ada.

## BELUM DIKERJAKAN

- Halaman `/layanan` (Services) — **route, controller, view SUDAH DIHAPUS SELURUHNYA** atas keputusan user (dianggap redundan dengan dropdown Layanan navbar yang sudah mengarah ke situs resmi). Kalau nanti user minta halaman ini lagi, ini BUKAN "melanjutkan yang sudah ada", tapi BUKA ULANG dari nol.
- Migrasi penuh sistem terjemahan ke `t()`/auto-translate — user menunda ("males banyak banget").
- Testing di perangkat mobile fisik — belum pernah dilakukan.
- Push project ke GitHub — user memilih "nanti aja", baru pakai Git lokal.
- `external_system_url` (SiteSetting) masih URL placeholder/contoh, menunggu URL asli dari sistem rekan tim (reservasi/pengajuan layanan terpadu).
- Foto interior/kegiatan asli BB Pustaka untuk mengganti placeholder Unsplash di section "Tentang BB Pustaka" — user menyebut akan menyusul.

## BUG / MASALAH DIKETAHUI (riwayat, kemungkinan berulang polanya)

1. **Pola berulang paling sering**: file Blade/PHP tertimpa PARSIAL saat proses copy-paste user (tag pembuka hilang, atribut dobel, class terpotong). Kalau ada elemen "terlihat sebagai teks mentah di halaman" atau class CSS tidak berefek, **curigai dulu file corrupt/tertimpa sebagian** — minta user `Get-Content` file terkait sebelum menebak penyebab lain.
2. **Overflow-x pada container dropdown** menyebabkan dropdown ter-clip (lihat `DESIGN_SYSTEM.md` bagian Navbar).
3. **Token Tailwind custom bentrok skala bawaan** (`--spacing-md` dll.) — sudah diperbaiki, tapi jadi pengingat jangan mengulang pola sama.
4. **Chatbot model OpenRouter free-tier deprecated periodik** — perlu ganti `OPENROUTER_MODEL` dari waktu ke waktu, cek https://openrouter.ai/models?max_price=0 untuk model gratis terkini.
5. **`accessibility.css` pernah kosong total** — selalu verifikasi isi file kalau fitur a11y dilaporkan mati semua.
6. **BOM (Byte Order Mark)** — pernah muncul dari `Set-Content -Encoding UTF8` di PowerShell, menyebabkan `ParseError: declare(strict_types=1) must be first statement`. Kalau user pakai PowerShell untuk overwrite file PHP, ingatkan pakai `[System.IO.File]::WriteAllText(..., [System.Text.UTF8Encoding]::new($false))` bukan `Set-Content -Encoding UTF8`.
7. **Eloquent pluralization salah tebak**: model `Feedback` butuh `protected $table = 'feedbacks'` eksplisit karena "feedback" uncountable dalam bahasa Inggris (Eloquent defaultnya cari tabel `feedback` tanpa -s).
8. **bfcache (back-forward cache) browser** sempat membuat state Alpine (panel navbar/chat) "membeku" saat user pakai tombol back/forward — sudah ditangani via `pageshow` event listener di `app.js` yang paksa reload kalau `event.persisted`.
