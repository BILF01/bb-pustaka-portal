# PROJECT_CONTEXT.md

## Identitas Project
- **Nama**: Redesain Portal BB Pustaka (Balai Besar Perpustakaan dan Literasi Pertanian)
- **Instansi**: BB Pustaka, di bawah Kementerian Pertanian RI (Kementan)
- **Situs resmi (referensi, bukan yang sedang dikerjakan)**: https://pustaka.bppsdmp.pertanian.go.id/
- **Repo lokal**: `C:\laragon\www\bb-pustaka-portal` (Windows, Laragon, PowerShell)
- **Database**: MySQL, nama DB `bb_pustaka_portal`

## Konteks Pengguna
- Pemilik project: Nabil, NPM 065123099, mahasiswa Ilmu Komputer FMIPA Universitas Pakuan.
- Project ini adalah proyek **Praktik Lapang (PL/magang)** di BB Pustaka.
- PL dijalani bersama 2 mahasiswa lain (total 3), masing-masing wajib membawa proyek berbeda.
- Periode PL: 27 Juli 2026 s.d. 4 September 2026.
- Instansi meminta website memiliki fitur aksesibilitas.

## Tujuan Project
Redesain penuh (bukan aplikasi baru dari nol secara konsep) portal BB Pustaka menjadi:
- Website informasi publik modern, enterprise-grade, siap dikembangkan sebagai sistem pemerintahan.
- CMS-ready untuk konten yang dikelola sendiri (Berita, Koleksi, Agenda).
- Untuk fitur yang **bukan tanggung jawab sistem ini** (reservasi kunjungan, pengajuan layanan, booking ruang rapat), portal **tidak membangun form sendiri** — diarahkan ke sistem terpadu buatan rekan tim lain (`external_system_url`, masih placeholder).
- Memiliki fitur aksesibilitas lengkap dan chatbot AI.

## Teknologi
- **Backend**: Laravel 12, PHP 8.3+ (lingkungan dev aktual: PHP 8.5.6)
- **Frontend**: Blade, Tailwind CSS v4 (via `@tailwindcss/vite`, konfigurasi di `resources/css/app.css` pakai `@theme`, BUKAN `tailwind.config.js`), Alpine.js (+ plugin `@alpinejs/focus`)
- **Build tool**: Vite (dev server dipaksa `host: 127.0.0.1` di `vite.config.js` — pernah bermasalah karena default bind ke IPv6 `[::1]` yang gagal diakses browser di Windows)
- **Auth/Role admin**: `spatie/laravel-permission`
- **Chatbot**: multi-provider (OpenAI-compatible/Ollama/Gemini/Claude), aktif memakai **OpenRouter** model gratis (model string sering berubah karena deprecation — cek `.env` `OPENROUTER_MODEL` untuk nilai terkini)
- **Terjemahan (i18n)**: campuran manual (`lang/en.json` + `__()`) dan auto-translate fallback (`t()` helper, MyMemory API) — lihat `DESIGN_SYSTEM.md`/`ARCHITECTURE.md` untuk detail, ini area yang tidak konsisten, WAJIB dibaca sebelum menyentuh teks UI.
- **Version control**: Git lokal sudah di-init, minimal 1 commit checkpoint pernah dibuat. Belum terhubung ke GitHub/remote (per permintaan user, "nanti aja").

## Identitas Visual (JANGAN DIUBAH tanpa instruksi eksplisit)
- **Primary**: `#056839`
- **Secondary/Accent**: `#FFE001`
- Logo asli: `public/images/logo-bbpustaka.png` (diunggah user, dipakai di navbar/footer/admin/favicon)
- Foto gedung asli: `public/images/gedung-bb-pustaka.jpeg` (diunggah user, dipakai di Home & Tentang Kami)

## Prinsip Utama Project
1. **Jangan mengarang data institusi.** Semua fakta sejarah, statistik, struktur organisasi, tugas pokok & fungsi HARUS berdasar data yang diberikan user secara eksplisit dalam percakapan. Kalau data tidak tersedia, tandai placeholder secara jujur, jangan isi dengan angka/klaim karangan.
2. **Untuk fitur/link yang belum dibangun di sistem ini**, arahkan ke URL resmi institusi (pola `integration_mode`: native/hybrid/external pada `ExternalServiceLink`, dan pola serupa dipakai manual di navbar untuk link ke situs asli).
3. **Desain mengikuti arahan user, bukan meniru mentah referensi visual** yang dilampirkan (referensi = inspirasi arah, bukan clone pixel-perfect) — ini pola berulang di seluruh sesi redesign.
4. Data statistik/angka besar (misal "50.000+ Koleksi") **tidak boleh dipakai** kalau tidak terverifikasi ada di database/sumber resmi — user secara eksplisit menolak angka karangan beberapa kali.

## Hal yang TIDAK Boleh Dilakukan AI (ringkas — detail lengkap di `AI_WORKFLOW.md`)
- Jangan kirim full file kalau perubahan kecil (patch-only untuk perubahan <30% file).
- Jangan refactor/rename/reformat di luar permintaan.
- Jangan tambah fitur yang tidak diminta.
- Jangan mengarang data institusi (sejarah, statistik, struktur organisasi).
- Jangan mengubah section/file yang tidak diminta saat revisi terfokus (misal "revisi Hero saja").
- Jangan bikin migration/database baru untuk perubahan yang murni visual.
- Jangan tambah dependency baru sebelum cek yang sudah ada.
