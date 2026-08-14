# DESIGN_SYSTEM.md

## Warna (didefinisikan di `resources/css/app.css`, `@theme` block — Tailwind v4)

| Token | Nilai | Pemakaian |
|---|---|---|
| `--color-primary` | `#056839` | Identitas utama BB Pustaka — JANGAN diubah tanpa instruksi |
| `--color-primary-container` | `#04532e` | hover state tombol primary |
| `--color-secondary` | `#FFE001` | Aksen kuning — JANGAN diubah tanpa instruksi |
| `--color-secondary-container` | `#fff082` | |
| `--color-gold` | `#D4A62A` | aksen tambahan, jarang dipakai |
| `--color-background` | `#f8faf8` | |
| `--color-surface`, `--color-surface-container-*` | skala abu-hijau sangat muda (mengikuti pola Material 3 tonal) | card, section alternating background |
| `--color-on-surface`, `--color-on-surface-variant` | teks utama/sekunder | |
| `--color-outline`, `--color-outline-variant` | border | |
| `--color-error`, `--color-error-container` | | pesan error form |

**PENTING**: Awalnya `@theme` juga berisi `--spacing-md`, `--radius-md`, dll. — token ini SUDAH DIHAPUS karena bentrok dengan skala bawaan Tailwind (`max-w-md`, `p-md` dst. jadi salah nilai, pernah menyebabkan bug visual "kotak login gepeng" karena `max-w-md` ke-override jadi 16px). **Jangan tambahkan token custom bernama sama dengan skala Tailwind bawaan** (`sm`/`md`/`lg`/`xl`/`2xl`).

## Typography
- Font: **Plus Jakarta Sans** (Google Fonts, di-load lewat `<link>` di `layout.blade.php`, bukan `@font-face` lokal)
- Skala custom via `@theme`: `--text-headline-xl/lg/md`, `--text-body-lg/md`, `--text-label-md`, `--text-caption` — masing-masing dengan `line-height`/`letter-spacing`/`font-weight` berpasangan.
- Untuk halaman yang sudah diredesign (About), banyak juga memakai skala Tailwind bawaan langsung (`text-4xl`, `text-2xl`, dll.) — **tidak 100% konsisten pakai token custom**, campuran keduanya valid di project ini.

## Komponen

### Navbar (`components/navbar.blade.php`)
- Prop `solid` (boolean, default `true`). Dipanggil dari `layout.blade.php` sebagai `<x-navbar :solid="$solidNav" />`, dan `$solidNav` adalah prop `layout` yang default `true`.
- Kalau `solid=true`: navbar SELALU solid putih (`bg-white shadow-md text-on-surface`) — dipakai di halaman tanpa hero foto (Koleksi, Berita, FAQ, dll).
- Kalau `solid=false`: navbar transparan (`bg-black/35 backdrop-blur-sm text-white`) di atas, berubah solid putih setelah scroll >80px — dipakai di halaman dengan hero foto full-bleed (Home, Tentang Kami). Cara pakai: `<x-layout ... :solid-nav="false">`.
- Struktur: grid 3 kolom (`grid-cols-[auto_1fr_auto]`) — logo kiri, menu tengah (center), bahasa+hamburger kanan.
- Menu utama (single row, TIDAK 2-tier): Home, Profil▾ (Tentang, Koleksi dan Layanan, Berita & Artikel, FAQ, Kontak), Layanan▾ (semua item external ke situs resmi + submenu nested via `<details>`), Publikasi▾, Kepustakawanan▾, Informasi Publik, Survey IKM, Zona Integritas▾.
- Dropdown: `x-data="{ open: false }"` + `@mouseenter/@mouseleave` + click toggle, transisi `x-transition:enter/leave` custom (fade+scale, durasi 150ms/100ms), style container: `bg-white/95 backdrop-blur-sm border-outline-variant/20 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.08)]` (shadow subtle, BUKAN shadow berat).
- **PENTING teknis**: JANGAN memberi `overflow-x-auto`/`overflow-hidden` pada container `<nav>` yang membungkus dropdown — CSS spec otomatis menganggap `overflow-y: auto` juga kalau `overflow-x` diset non-`visible`, ini pernah menyebabkan dropdown ter-clip/tidak muncul sama sekali.
- Mobile: hamburger → panel `<nav id="mobile-nav">` dengan `<details>` accordion per kategori, semua `x-show` pakai `x-cloak style="display:none"` ganda (jaga-jaga bfcache).
- Item dropdown yang linknya ke situs resmi (`target="_blank" rel="noopener noreferrer"`) diberi ikon kecil `arrow_outward`.

### Hero
- **Home** (`components/hero.blade.php`): slider background (Unsplash placeholder), overlay `bg-black/60`, headline putih, search bar SELALU `bg-white` eksplisit (Tailwind reset bikin `<input>` transparan default — WAJIB set bg eksplisit), 4 statistik.
- **Tentang Kami** (`pages/about.blade.php`): pola **Pinned/Sticky Hero** — wrapper `<div class="relative h-[170vh]">` membungkus `<section class="sticky top-0 h-screen ...">`, section berikutnya ("Tentang BB Pustaka") pakai `-mt-16 md:-mt-20` + `rounded-t-[2rem]` + shadow untuk efek "menutupi" Hero saat discroll (bukan sticky ganda — sempat dicoba sticky di kedua section dan itu BUGGY, sudah diperbaiki). Overlay `bg-black/45`→`bg-primary/70` (mobile) di atas foto gedung, gradient horizontal hijau di sisi kiri.

### Search bar
- Selalu `bg-white` eksplisit + shadow tegas kalau di atas foto (lihat catatan Hero di atas).

### Card
- Radius umum: `rounded-xl`/`rounded-2xl`. Shadow umum: `shadow-sm` untuk card biasa, custom rgba rendah-opacity untuk elemen premium (dropdown, hero card).

### Dropdown/Accordion konten (FAQ, submenu navbar, mobile nav)
- Pakai elemen native `<details>/<summary>` sebisa mungkin (aksesibel bawaan, tanpa JS tambahan) — bukan selalu Alpine.

### Footer
- 4 kolom: Brand+logo, Tautan Cepat (dari `footer_links` group `quick_links`), Informasi (group `information`), Kontak & Ikuti Kami (alamat/email/telp dari `site_settings` + ikon sosial media).
- Ikon sosial (`components/social-icon.blade.php`): SVG brand custom (bukan Material Symbols generik lagi, sempat 2 iterasi) — background bulat abu terang `#F1F1F1`, ikon warna `#606060`, platform: youtube, instagram, facebook, twitter(X).

### Chatbot Widget
- Tombol bulat mengambang `bg-primary`, posisi `fixed bottom-24 right-6`, badge kuning berkedip.
- Panel chat: header hijau, area pesan `bg-surface`, bubble user vs assistant beda warna, markdown render, suggestion prompts, input+kirim.

### Accessibility Widget
- Tombol bulat putih `fixed bottom-6 right-6` (di bawah tombol chat).
- Panel: grouped sections (Ukuran Teks, Spasi Huruf, Tinggi Baris, Perbesar Halaman, Tampilan [Dark/Contrast/Invert/Grayscale], Mode Buta Warna, Bantuan Membaca, Navigasi & Fokus, Pembaca Layar [narasi teks hover/touch — BUKAN baca-semua-otomatis], Bahasa, Reset).

### Social QR (`components/social-qr.blade.php`)
- Grid QR code (via `api.qrserver.com`, tanpa dependency npm) dengan overlay logo platform bulat di tengah (pakai `social-icon` component).

### Feedback Widget (`components/feedback-widget.blade.php`)
- Tombol + modal popup (Alpine), form: rating emoji 1-5, radio ya/tidak, textarea kritik+saran (max 500 char, counter), textarea fitur diinginkan (opsional), submit via `fetch` ke `/feedback`.

### Section Sejarah (About) — Visual Journey
- Data milestone: **1842, 1850, 2000, 2023, 2025** (lihat `CURRENT_STATE.md` untuk isi lengkap tiap milestone — JANGAN diubah/ditambah tanpa instruksi eksplisit user, ini fakta sejarah terverifikasi).
- Desktop: horizontal timeline, kartu alternating di atas/bawah garis tengah.
- Mobile: vertical timeline, garis di kiri.
- Scroll-activated: `IntersectionObserver` native (BUKAN library scroll-animation npm) di dalam `x-init`, threshold 0.55, toggle class `.milestone-active` yang didefinisikan di `app.css` `@layer utilities`.
- Menghormati `motion-reduce:` (Tailwind variant) di semua transisi.

## Spacing & Layout
- Container umum: `max-w-[1280px] mx-auto px-6` (beberapa bagian pakai `max-w-[1400px]` untuk navbar).
- Section vertical padding: `py-16 md:py-20` pola umum, `py-16 md:py-24` untuk section besar (Sejarah).

## Border Radius
- `rounded-lg` (tombol, input), `rounded-xl`/`rounded-2xl` (card besar, hero image).

## Breakpoint
- Standar Tailwind: `sm`(640), `md`(768), `lg`(1024), `xl`(1280). Navbar desktop-menu breakpoint di `lg:`.

## Icon
- **Material Symbols Outlined** (Google Fonts, load via `<link>`), dipakai hampir di semua tempat KECUALI ikon brand sosial media (SVG custom di `social-icon.blade.php`).

## Animasi/Transisi
- Dropdown: custom `x-transition:enter/leave` (opacity+scale+translate, 150ms/100ms).
- Semua animasi dekoratif diberi `motion-reduce:` fallback atau dicek lewat toggle aksesibilitas "Hentikan Animasi" (`a11y-stop-animation` class, `resources/css/accessibility.css`).

## Accessibility CSS (`resources/css/accessibility.css`)
- **RIWAYAT BUG PENTING**: file ini pernah KOSONG TOTAL akibat proses edit yang gagal tersimpan, menyebabkan SEMUA fitur aksesibilitas berbasis class (`a11y-dark`, `a11y-big-cursor`, dll.) tidak berfungsi sama sekali sementara fitur berbasis inline-style (font-size, zoom) tetap jalan. **Kalau user lapor "banyak fitur aksesibilitas tidak berfungsi", CEK DULU apakah file ini kosong** sebelum menebak penyebab lain.
- Berisi rules untuk: `.a11y-dark`, `.a11y-high-contrast`, letter-spacing/line-height via CSS var, `.a11y-highlight-links`, `.a11y-highlight-headings`, `.a11y-hide-images`, `.a11y-stop-animation`, `.a11y-focus-strong`, `.a11y-big-cursor` (custom SVG cursor data-URI), `#a11y-reading-guide`, `#a11y-reading-mask-*`.
- Juga berisi `.milestone-active` rules untuk section Sejarah (ditambahkan belakangan, bukan murni aksesibilitas tapi disatukan di file yang sama via `@layer utilities`).

## Responsive Behavior
- Mobile-first tidak ketat diterapkan (banyak `lg:` untuk switch ke desktop layout), tapi SEMUA komponen WAJIB dicek: tidak ada horizontal overflow, timeline vertical di mobile, grid collapse ke 1 kolom, navbar jadi hamburger di bawah `lg:`.
- **BELUM PERNAH DITES di perangkat mobile fisik** — hanya resize browser DevTools. Lihat `FEATURES.md` bagian testing.
