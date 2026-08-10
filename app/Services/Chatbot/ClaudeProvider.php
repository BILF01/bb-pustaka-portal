<?php

declare(strict_types=1);

namespace App\Services\Chatbot;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class ClaudeProvider implements ChatProviderInterface
{
    public function __construct(
        private readonly string $baseUrl,
        private readonly ?string $apiKey,
        private readonly string $model,
    ) {
    }

    public function reply(array $messages): string
    {
        $systemPrompt = null;
        $chatMessages = [];

        foreach ($messages as $message) {
            if ($message['role'] === 'system') {
                $systemPrompt = $message['content'];
                continue;
            }

            $chatMessages[] = ['role' => $message['role'], 'content' => $message['content']];
        }

        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'anthropic-version' => '2023-06-01',
        ])->timeout(30)->post("{$this->baseUrl}/messages", [
            'model' => $this->model,
            'max_tokens' => 1024,
            'system' => $systemPrompt,
            'messages' => $chatMessages,
        ]);

        if ($response->failed()) {
            throw new RuntimeException('Claude gagal merespons: '.$response->body());
        }

        return (string) $response->json('content.0.text', 'Maaf, saya belum bisa menjawab saat ini.');
    }
}