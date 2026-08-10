<?php

declare(strict_types=1);

namespace App\Services\Chatbot;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class GeminiProvider implements ChatProviderInterface
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
        $contents = [];

        foreach ($messages as $message) {
            if ($message['role'] === 'system') {
                $systemPrompt = $message['content'];
                continue;
            }

            $contents[] = [
                'role' => $message['role'] === 'assistant' ? 'model' : 'user',
                'parts' => [['text' => $message['content']]],
            ];
        }

        $body = ['contents' => $contents];

        if ($systemPrompt) {
            $body['systemInstruction'] = ['parts' => [['text' => $systemPrompt]]];
        }

        $response = Http::timeout(30)->post(
            "{$this->baseUrl}/models/{$this->model}:generateContent?key={$this->apiKey}",
            $body
        );

        if ($response->failed()) {
            throw new RuntimeException('Gemini gagal merespons: '.$response->body());
        }

        return (string) $response->json('candidates.0.content.parts.0.text', 'Maaf, saya belum bisa menjawab saat ini.');
    }
}