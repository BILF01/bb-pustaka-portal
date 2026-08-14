# AI_WORKFLOW.md

> Aturan kerja WAJIB untuk Claude/AI yang melanjutkan project ini. Ditetapkan eksplisit oleh user di pertengahan project setelah lelah menerima full-file berulang untuk perubahan kecil. **Pelanggaran aturan ini adalah penyebab utama keluhan user sepanjang project.**

## Aturan Format Output (WAJIB, tanpa pengecualian)

1. **Tag di awal jawaban**: `[PATCH]` atau `[FULL FILE]` — pilih SATU, tidak boleh dua-duanya untuk file yang sama dalam satu jawaban.
2. **`[PATCH]`** dipakai kalau perubahan < ~30% isi file:
   - Tunjukkan HANYA bagian yang berubah.
   - Sertakan path file dengan jelas.
   - Format: `Cari:` (kode lama persis) → `Ganti:` (kode baru).
   - JANGAN kirim ulang bagian file yang tidak berubah.
3. **`[FULL FILE]`** dipakai HANYA kalau perubahan > ~30% file atau file benar-benar baru:
   - Kirim isi file lengkap siap timpa.
   - Beri keterangan "Timpa seluruh file berikut."
4. **Kalau banyak file berubah dalam satu permintaan**: tampilkan DAFTAR file dulu (dengan tanda ✔), baru detail patch/full-file per file.
5. **Penjelasan sesingkat mungkin** — maksimal "apa yang berubah" + "kenapa berubah". Tidak perlu teori panjang, tidak perlu restate semua kode yang tidak berubah.

## Aturan Perilaku Coding

6. **Jangan refactor** di luar permintaan — jangan rename variable, jangan reformat, jangan "optimasi" tak diminta.
7. **Jangan tambah fitur** yang tidak diminta eksplisit.
8. **Jangan ubah section/file lain** yang tidak disebut user, SEKALIPUN "related" secara desain — kalau user bilang "revisi Hero saja", JANGAN sentuh Sejarah/Visi-Misi/Footer/Navbar dll walau "demi konsistensi".
9. **Jangan bikin migration/database baru** untuk perubahan yang murni visual/CSS.
10. **Jangan tambah dependency baru** (npm/composer) sebelum audit dulu apakah kebutuhan itu sudah bisa dipenuhi oleh dependency yang sudah ada (Alpine.js, native browser API seperti `IntersectionObserver`, native CSS `sticky`, dll. — pola yang berulang dipakai project ini untuk menghindari dependency baru).
11. **Jangan ubah arsitektur** (struktur folder, pola Service/Repository, dll.) tanpa alasan jelas dan izin.
12. **Jangan bikin file baru** kalau file existing masih bisa dipakai/diperluas.
13. **Sebelum coding**, identifikasi dulu file mana saja yang benar-benar perlu diubah — audit dulu (baca file terkait via `Get-Content` yang diminta ke user, atau infer dari riwayat percakapan) sebelum menulis kode.
14. **Kalau menemukan bug DI LUAR scope permintaan saat ini**: JANGAN langsung perbaiki. Laporkan singkat, tunggu instruksi user.
15. **Pertahankan struktur kode existing** sebisa mungkin — kalau harus kirim FULL FILE, kode yang tidak berkaitan dengan permintaan HARUS tetap dipertahankan persis seperti sebelumnya (bukan ditulis ulang gaya/pola berbeda).
16. **Kalau tidak yakin soal struktur/fungsi tertentu**: minta user cek source code (`Get-Content`), JANGAN MENEBAK.
17. **Source code project adalah sumber kebenaran utama.** File dokumentasi `.md` ini (termasuk `CURRENT_STATE.md`) HANYA konteks bantuan — kalau bertentangan dengan apa yang ditemukan di source code aktual user, PERCAYA SOURCE CODE, bukan dokumentasi ini.

## Pola Debugging yang Sudah Terbukti Efektif di Project Ini

Karena project sering dikerjakan di lingkungan Windows/PowerShell dengan user yang meng-copy-paste kode dari chat ke editor, **penyebab bug paling sering** adalah:

1. **File tertimpa parsial** — tag pembuka hilang, class terpotong, atribut dobel (contoh nyata: `<img src="..." src="...">` dua kali). Gejala: teks/atribut mentah muncul sebagai konten halaman, atau CSS tidak berefek walau file "sudah benar" menurut user.
   - **Langkah diagnosis**: minta `Get-Content <path>` dulu SEBELUM memberi solusi lain.
2. **Cache tidak di-clear** — `php artisan view:clear`, `config:clear`, `cache:clear` setelah HAMPIR SETIAP perubahan Blade/`.env`/config. Jadikan ini instruksi default di akhir setiap patch, bukan opsional.
3. **`npm run dev` tidak berjalan/mati** — perubahan CSS/JS tidak ter-bundle. Selalu ingatkan cek proses ini kalau visual tidak berubah padahal kode sudah benar.
4. **Vite bind ke IPv6** — kalau CSS sama sekali tidak termuat (bukan sekadar salah styling), curigai Vite dev server jalan di `[::1]` bukan `127.0.0.1`. Solusi permanen sudah diterapkan (`vite.config.js` server.host), tapi kalau file itu diubah lagi, bug bisa muncul lagi.
5. **BOM di file PHP** kalau user overwrite file lewat PowerShell `Set-Content -Encoding UTF8` — gunakan `[System.IO.File]::WriteAllText(path, content, [System.Text.UTF8Encoding]::new($false))` sebagai instruksi alternatif kalau user melapor `ParseError` di baris `declare(strict_types=1)`.
6. **`overflow-x-auto` pada container dropdown/menu** menyebabkan overflow-y ikut ter-clip (aturan CSS spec) — jangan pakai trik ini untuk navbar yang mengandung dropdown absolute-positioned.

## Prinsip Data & Konten

18. **JANGAN mengarang data institusi** — fakta sejarah, statistik, struktur organisasi, tugas pokok fungsi, dll. HARUS berdasar apa yang user berikan eksplisit dalam percakapan (lihat `CURRENT_STATE.md` untuk data yang SUDAH terverifikasi). Kalau user minta section baru yang butuh data institusi dan datanya belum ada, TANYA dulu, jangan isi dengan placeholder yang terlihat seperti fakta asli.
19. **Referensi visual yang dilampirkan user (screenshot/gambar) adalah ARAH DESAIN, bukan untuk di-clone mentah-mentah** — kecuali user secara eksplisit bilang "persis seperti ini". Pola berulang: user kasih referensi → AI overshoot ke arah generic template → user koreksi "jangan seperti landing page SaaS" → iterasi ulang lebih dekat ke referensi. Baca instruksi user dengan teliti soal SEBERAPA MIRIP yang diinginkan.

## Preferensi Komunikasi

20. Jawab **fokus pada kode**, hindari pembukaan/penutup panjang yang tidak perlu.
21. Kalau user memberi instruksi terstruktur panjang (numbered list dengan banyak `====` separator, gaya "prompt teknis"), ikuti strukturnya secara harfiah — user familiar dengan pola prompting terstruktur dan mengharapkan AI comply persis, bukan menyederhanakan/meringkas instruksinya sendiri.
