# CHANGELOG.md

> Ringkasan perjalanan project, dikelompokkan per area — bukan log per-perubahan-kecil. Tanpa tanggal presisi kecuali disebutkan eksplisit di percakapan (periode PL: 27 Juli – 4 September 2026).

## Setup Project (STEP 1-3)
- Analisis kebutuhan berdasar referensi visual (`code.html`) dan design system (`DESIGN.md`) yang disiapkan user di awal.
- Instalasi Laravel 12 + Tailwind CSS v4 (via Vite) + Alpine.js.
- Setup token warna brand (Primary `#056839`, Secondary `#FFE001`) di `@theme` Tailwind — sempat bentrok dengan skala bawaan Tailwind (`spacing-md` dll.), diperbaiki dengan menghapus token yang nama-nya bentrok skala default.
- Fix Vite dev server bind ke IPv6 (`[::1]`) yang gagal diakses browser Windows — solusi: `server.host: '127.0.0.1'` di `vite.config.js`.
- Routing dasar, layout master Blade, komponen navbar/footer awal.

## Modul Konten Inti (STEP 4-9)
- Hero + Quick Access + Profile Section di Homepage.
- Grid "Inovasi dan Layanan" (15 item, hardcode array).
- Modul Berita (migration, model, CRUD-ready struktur, halaman index/detail).
- Modul Koleksi Buku + `ExternalServiceLink` (integrasi adaptif OPAC/Repository — native/hybrid/external).
- Modul Reservasi & Pengajuan Layanan publik — **DIBANGUN lalu KEMUDIAN DIHAPUS TOTAL** setelah user mengklarifikasi bahwa fitur ini adalah tanggung jawab sistem terpisah buatan rekan tim, bukan portal ini. Diganti kartu CTA eksternal (`external-service-card.blade.php`) yang mengarah ke `external_system_url` (placeholder, menunggu URL asli).

## Footer & Admin (STEP 10-11)
- Footer dinamis dari `site_settings`+`footer_links`, integrasi peta lokasi.
- Sistem admin: auth native Laravel, role Spatie, layout admin, dashboard, CRUD Berita (modul referensi), lalu CRUD Koleksi & Agenda.
- **Perubahan lingkup admin** (permintaan user eksplisit): admin HANYA mengelola Berita, Koleksi, Agenda. Reservasi & Pengajuan Layanan dijadikan halaman dummy dulu (interim), lalu akhirnya **dihapus total** (controller Admin untuk keduanya dihapus, link sidebar dihapus).

## Optimasi & Aksesibilitas (STEP 12-13)
- SEO dasar (meta tag, Open Graph, sitemap.xml), lazy loading gambar, caching untuk data statis (`SiteSetting`, `ExternalServiceLink`).
- Modul FAQ ditambahkan (menggantikan rencana awal "Pengajuan Layanan" di sidebar Home yang sudah tidak relevan).
- Aksesibilitas lengkap dibangun (20+ kontrol) — sempat mengalami bug file CSS kosong total, diperbaiki dengan full restore file.
- Revisi fitur "narasi teks": awalnya rencana baca-semua-halaman-otomatis, diubah user jadi baca-saat-hover/touch saja (UX lebih senyap), lalu label tombol disempurnakan jadi lebih profesional.

## Chatbot AI (STEP 14)
- Service Layer multi-provider (OpenAI-compatible, Ollama, Gemini, Claude), Factory pattern, config `.env`-driven.
- Widget floating dengan riwayat per-visitor, markdown, syntax highlight.
- **Riwayat masalah berulang**: model gratis OpenRouter beberapa kali deprecated (`inclusionai/ling-3.0-flash:free` dan lainnya), butuh ganti `OPENROUTER_MODEL` periodik. Sempat juga dicoba Gemini API tapi kena limit kuota gratis (`RESOURCE_EXHAUSTED`), akhirnya pindah permanen ke OpenRouter.

## Bug Fixing Besar (tersebar sepanjang project, pola berulang)
- File Blade/PHP tertimpa parsial saat copy-paste user → berbagai gejala (tag hilang, teks mentah muncul di halaman, class CSS tidak berefek, class dobel menyebabkan "Cannot redeclare").
- Sidebar admin: `lg:static` menyebabkan tombol Keluar hilang dari viewport → diperbaiki jadi `lg:sticky lg:top-0 lg:h-screen`.
- Kolom `stock` di Koleksi dihapus setelah user klarifikasi BB Pustaka adalah perpustakaan referensi (tidak ada peminjaman bawa pulang) — diganti `page_count` + `access_link` (link ke Repository resmi).
- Bug bfcache browser (state Alpine "membeku" saat pakai tombol back/forward) — diperbaiki via `pageshow` event listener paksa reload.

## Sistem Bahasa (i18n)
- Dibangun sistem `__()` + `lang/en.json` manual untuk seluruh UI utama.
- User mengeluhkan repetisi kerja manual tiap ada teks baru → dibangun sistem fallback auto-translate (`t()` + `AutoTranslator` + MyMemory API, gratis) sebagai opsi hybrid.
- User memutuskan TIDAK migrasi semua `__()` ke `t()` (terlalu banyak pekerjaan) — kedua sistem berjalan paralel, `t()` baru dipakai di 2 komponen kecil.
- Beberapa section baru (Agenda, redesign About) sempat lupa dibungkus terjemahan — pola berulang yang perlu diwaspadai di sesi baru.

## Redesign Navbar (iterasi banyak)
- Awal: navbar sederhana transparan-di-atas-hero.
- Direstruktur total mengikuti pola menu situs resmi BB Pustaka (audit langsung ke situs asli via web fetch) — banyak dropdown dengan submenu bertingkat, sebagian besar link eksternal.
- Sempat dicoba jadi 2-tier (bar utilitas + menu utama) meniru pola portal pemerintah generik → user tolak, dikembalikan ke 1-tier.
- Dropdown sempat ter-clip/tidak muncul karena `overflow-x-auto` pada container — diperbaiki.
- Shadow & spacing dropdown dihaluskan beberapa kali menuju gaya "premium, subtle, editorial" atas permintaan user.
- Warna navbar transparan disesuaikan (`bg-transparent` → `bg-black/35 backdrop-blur-sm`) meniru referensi Portal Jabar untuk memastikan teks selalu terbaca di atas foto latar apa pun.

## Fitur Baru di Fase Redesign
- **Modul Agenda di Homepage**: dibangun sebagai section baru (bukan halaman terpisah — sempat dibuat halaman terpisah `/agenda` lalu DIHAPUS dan dipindah jadi section Home atas permintaan user), dengan featured agenda + calendar interaktif + countdown.
- **Ikon Sosial Media**: diganti dari Material Symbols generik ke SVG brand custom (menghindari isu lisensi logo asli), dengan treatment visual mengikuti referensi (background bulat abu, ikon abu gelap).
- **QR Code Sosial Media**: ditambahkan di Homepage (Visit Section), QR mengarah ke link sosial asli dengan logo platform di tengah.
- **Widget Umpan Balik (Feedback)**: form popup + tabel admin read-only, terinspirasi pola survey kepuasan portal pemerintah lain.
- **Logo & Foto Asli**: logo resmi BB Pustaka dan foto gedung asli diunggah user, menggantikan seluruh placeholder ikon Material Symbols/Unsplash di navbar, footer, admin, favicon, Home Profile Section, dan Hero About.

## Redesign Total Halaman Tentang Kami (fase terakhir, paling panjang)
1. Awal: konten teks polos (Sejarah 1 paragraf, Visi/Misi 2 card sejajar, Struktur Organisasi bullet list, Tugas Pokok Fungsi bullet list).
2. Iterasi 1: Section Sejarah dibuat jadi timeline visual 5 milestone (data dikonfirmasi ulang — 1817 yang salah dikoreksi jadi 1842).
3. Iterasi 2 (redesign total, multi-step audit → izin → implementasi): seluruh halaman dirombak jadi Hero editorial + Tentang BB Pustaka (foto+statistik) + Sejarah (scroll journey) + Visi Misi editorial + Peran & Fungsi (gabungan) + Struktur Organisasi (diagram) + CTA.
4. Hero direvisi berkali-kali (5+ iterasi) karena komposisi dianggap "masih landing page generik" — akhirnya mengarah ke pola "teks besar di atas foto full-bleed dengan overlay gelap", meniru referensi ChatGPT-generated mockup yang dilampirkan user.
5. Iterasi terakhir: Hero diubah jadi pola **Pinned/Sticky Hero** terinspirasi halaman organisasi BRMP Buah Tropika — sempat buggy (double-sticky, navbar tidak transparan, gambar kolase src dobel), diperbaiki di patch terakhir sebelum handoff percakapan.

## Version Control
- `git init` dijalankan, `.gitignore` dibuat, minimal 1 commit checkpoint terkonfirmasi (`d38be17`).
- Banyak perubahan besar terjadi setelah commit itu — kemungkinan besar belum ter-checkpoint ulang di akhir percakapan.
- Belum dihubungkan ke GitHub (keputusan sadar, ditunda).

## Dokumentasi Handoff
- 7 file `.md` ini (`PROJECT_CONTEXT`, `ARCHITECTURE`, `DESIGN_SYSTEM`, `FEATURES`, `CURRENT_STATE`, `AI_WORKFLOW`, `CHANGELOG`) dibuat di akhir percakapan untuk memindahkan konteks ke sesi chat baru tanpa user perlu menjelaskan ulang dari awal.
