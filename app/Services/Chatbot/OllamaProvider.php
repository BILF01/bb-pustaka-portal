<?php

declare(strict_types=1);

namespace App\Services\Chatbot;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class OllamaProvider implements ChatProviderInterface
{
    public function __construct(
        private readonly string $baseUrl,
        private readonly string $model,
    ) {
    }

    public function reply(array $messages): string
    {
        $response = Http::baseUrl($this->baseUrl)->timeout(60)->post('/api/chat', [
            'model' => $this->model,
            'messages' => $messages,
            'stream' => false,
        ]);

        if ($response->failed()) {
            throw new RuntimeException('Ollama gagal merespons: '.$response->body());
        }

        return (string) $response->json('message.content', 'Maaf, saya belum bisa menjawab saat ini.');
    }
}