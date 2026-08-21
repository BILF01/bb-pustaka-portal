<?php

declare(strict_types=1);

namespace App\Services\Chatbot;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class OpenAiCompatibleProvider implements ChatProviderInterface
{
    public function __construct(
        private readonly string $baseUrl,
        private readonly ?string $apiKey,
        private readonly string $model,
        private readonly array $options = [],
    ) {
    }

    public function reply(array $messages): string
    {
        $request = Http::baseUrl($this->baseUrl)->timeout(30);

        if ($this->apiKey) {
            $request = $request->withToken($this->apiKey);
        }

        $response = $request->post('/chat/completions', [
            'model' => $this->model,
            'messages' => $messages,
            ...$this->options,
        ]);

        if ($response->failed()) {
            throw new RuntimeException('Chatbot provider gagal merespons: '.$response->body());
        }

        return (string) $response->json('choices.0.message.content', 'Maaf, saya belum bisa menjawab saat ini.');
    }
}