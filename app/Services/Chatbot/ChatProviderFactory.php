<?php

declare(strict_types=1);

namespace App\Services\Chatbot;

use InvalidArgumentException;

class ChatProviderFactory
{
    public static function make(): ChatProviderInterface
    {
        $provider = config('chatbot.provider');
        $settings = config("chatbot.providers.{$provider}");

        if (! $settings) {
            throw new InvalidArgumentException("Provider chatbot [{$provider}] tidak dikonfigurasi.");
        }

        return match ($provider) {
            'ollama' => new OllamaProvider($settings['base_url'], $settings['model']),
            'openai', 'openrouter', 'lmstudio', 'gemini', 'claude', 'groq' => new OpenAiCompatibleProvider(
                $settings['base_url'],
                $settings['api_key'] ?? null,
                $settings['model'],
                $settings['options'] ?? [],
            ),
            default => throw new InvalidArgumentException("Provider chatbot [{$provider}] belum didukung."),
        };
    }
}