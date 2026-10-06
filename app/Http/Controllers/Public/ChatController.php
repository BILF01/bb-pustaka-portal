<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChatMessageRequest;
use App\Models\ChatSession;
use App\Models\Faq;
use App\Models\SiteSetting;
use App\Services\Chatbot\ChatProviderFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class ChatController extends Controller
{
    public function startSession(Request $request): JsonResponse
    {
        $visitorToken = $request->string('visitor_token')->toString() ?: (string) Str::uuid();

        $session = ChatSession::create([
            'visitor_token' => $visitorToken,
        ]);

        return response()->json([
            'session_uuid' => $session->uuid,
            'visitor_token' => $visitorToken,
        ]);
    }

    public function messages(ChatSession $session): JsonResponse
    {
        return response()->json(
            $session->messages()->get(['role', 'content', 'created_at'])
        );
    }

    public function sendMessage(StoreChatMessageRequest $request, ChatSession $session): JsonResponse
    {
        $session->messages()->create([
            'role' => 'user',
            'content' => $request->validated('message'),
        ]);

        $history = $session->messages()
            ->get(['role', 'content'])
            ->map(fn ($message): array => ['role' => $message->role, 'content' => $message->content])
            ->toArray();

        $siteKnowledge = [
            'Nama' => SiteSetting::get('site_name'),
            'Nama instansi' => SiteSetting::get('site_tagline'),
            'Organisasi' => SiteSetting::get('org_name'),
            'Alamat' => SiteSetting::get('address'),
            'Jam operasional' => SiteSetting::get('operational_hours'),
            'Email' => SiteSetting::get('email'),
            'Telepon' => SiteSetting::get('phone'),
            'URL layanan' => SiteSetting::get('external_system_url'),
        ];

        $siteContext = collect($siteKnowledge)
            ->filter(fn ($value): bool => filled($value))
            ->map(fn ($value, $key): string => "{$key}: {$value}")
            ->implode("\n");

        $faqContext = Faq::ordered()
            ->get(['question', 'answer'])
            ->map(fn (Faq $faq): string => "Pertanyaan: {$faq->question}\nJawaban: {$faq->answer}")
            ->implode("\n\n");

        $knowledge = <<<TEXT
        INFORMASI RESMI BB PUSTAKA:
        {$siteContext}

        FAQ RESMI BB PUSTAKA:
        {$faqContext}

        ATURAN SUMBER DAN CARA MENJAWAB:
        - Informasi resmi dan FAQ di atas adalah sumber fakta untuk pertanyaan spesifik tentang BB Pustaka.
        - Jangan mengarang, menebak, menyimpulkan sendiri, atau menambahkan fakta spesifik yang tidak didukung oleh informasi resmi di atas.
        - Jangan membuat sendiri alamat, jam operasional, nomor telepon, email, biaya, prosedur, persyaratan, fasilitas, nama pejabat, tanggal, maupun informasi institusi lainnya.
        - FAQ adalah sumber fakta, bukan template jawaban. Jangan menyalin seluruh jawaban FAQ jika pengguna hanya menanyakan sebagian informasinya.
        - Jawab hanya inti yang ditanyakan pengguna. Jangan memperluas jawaban ke informasi lain yang tidak diperlukan.
        - Sesuaikan jawaban dengan maksud pertanyaan, termasuk jika pengguna menggunakan bahasa singkat, santai, tidak baku, atau pertanyaan lanjutan yang bergantung pada konteks percakapan.
        - Gunakan jawaban yang natural, jelas, dan langsung. Jangan terdengar seperti menyalin data mentah atau FAQ.
        - Jika fakta yang dibutuhkan tersedia, gunakan hanya bagian informasi yang relevan untuk menjawab pertanyaan tersebut.
        - Jika fakta yang dibutuhkan tidak tersedia dalam informasi resmi di atas, katakan secara jujur dan singkat bahwa informasi tersebut belum tersedia. Jangan mencoba mengisi kekosongan dengan pengetahuan umum atau tebakan.
        - Jangan otomatis memberikan email, nomor telepon, URL layanan, atau arahan ke halaman Kontak setiap kali informasi tidak tersedia.
        - Berikan informasi kontak hanya jika pengguna meminta cara menghubungi BB Pustaka, meminta kontak, atau jika kontak benar-benar diperlukan untuk melanjutkan kebutuhan pengguna.
        - Untuk pertanyaan sederhana, prioritaskan jawaban langsung dan singkat. Tambahkan penjelasan hanya jika membantu menjawab pertanyaan.
        - Jika informasi dari percakapan bertentangan dengan informasi resmi di atas, prioritaskan informasi resmi di atas.
        - Jangan mengubah arti informasi resmi. Jangan menyatakan sesuatu lebih spesifik atau lebih luas daripada yang didukung sumber.
        - Parafrase diperbolehkan hanya untuk membuat jawaban lebih natural dan mudah dipahami. Parafrase tidak boleh menambahkan fakta, langkah, syarat, hubungan, atau detail baru.
        - Untuk pertanyaan tentang prosedur atau cara melakukan sesuatu, sebutkan hanya langkah yang secara eksplisit tersedia dalam informasi resmi. Jangan melengkapi langkah yang hilang berdasarkan kebiasaan umum.
        - Jangan menciptakan persyaratan atau prosedur tambahan seperti cara pendaftaran anggota, proses yang dilakukan petugas, batas waktu peminjaman, denda, dokumen yang harus dibawa, atau ketentuan lainnya jika tidak tertulis dalam informasi resmi.
        - Jangan menghubungkan dua informasi hanya karena terlihat berkaitan. Contohnya, keberadaan sebuah URL layanan tidak berarti URL tersebut adalah Katalog Online, Repository, Smart OPAC, halaman pendaftaran, atau layanan tertentu kecuali hubungan tersebut dinyatakan secara eksplisit dalam informasi resmi.
        - Jangan menganggap informasi yang tidak disebutkan sebagai fakta. Tidak disebutkan bukan berarti "tidak", "tutup", "tidak tersedia", "gratis", "wajib", "boleh", atau kesimpulan lainnya.
        - Jangan menarik kesimpulan implisit dari informasi resmi untuk menghasilkan fakta baru.
        - Contoh: jika jam operasional hanya mencantumkan Senin sampai Jumat, jangan menyimpulkan bahwa Sabtu atau Minggu tutup. Katakan bahwa informasi mengenai Sabtu atau Minggu tidak tercantum dalam data resmi yang tersedia.
        - Saat menjawab berdasarkan FAQ, ambil hanya fakta yang diperlukan untuk pertanyaan pengguna dan susun ulang secara natural. Jangan memperluas cakupan jawaban hanya karena FAQ memuat informasi tambahan.
        - Bedakan dengan jelas antara fakta yang tertulis dan informasi yang tidak tersedia. Untuk pertanyaan faktual tentang BB Pustaka, hanya nyatakan sebagai fakta apa yang secara eksplisit didukung oleh informasi resmi.
        
        TEXT;

        $payload = [
            [
                'role' => 'system',
                'content' => config('chatbot.system_prompt')."\n\n".$knowledge,
            ],
            ...$history,
        ];

        try {
            $reply = ChatProviderFactory::make()->reply($payload);
        } catch (Throwable $e) {
            report($e);
            $reply = 'Maaf, terjadi kendala teknis saat menghubungi asisten AI. Silakan coba lagi nanti atau hubungi kami melalui halaman Kontak.';
        }

        $assistantMessage = $session->messages()->create([
            'role' => 'assistant',
            'content' => $reply,
        ]);

        return response()->json([
            'reply' => $assistantMessage->content,
            'created_at' => $assistantMessage->created_at,
        ]);
    }
}