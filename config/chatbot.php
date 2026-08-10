<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Provider Aktif
    |--------------------------------------------------------------------------
    | Ganti nilai ini (atau set CHATBOT_PROVIDER di .env) untuk berpindah
    | penyedia AI tanpa mengubah kode sama sekali.
    | Pilihan: openai, ollama, lmstudio, openrouter, gemini, claude
    */
    'provider' => env('CHATBOT_PROVIDER', 'openai'),

    'system_prompt' => 'Anda adalah asisten virtual BB Pustaka (Balai Besar Perpustakaan dan Literasi Pertanian). '
        .'Jawab pertanyaan seputar layanan perpustakaan, koleksi pertanian, dan literasi pertanian dengan ramah, '
        .'ringkas, dan dalam Bahasa Indonesia formal. Jika tidak tahu jawabannya, arahkan pengguna untuk menghubungi '
        .'pustakawan melalui halaman Kontak.',

    'providers' => [
        'openai' => [
            'base_url' => env('OPENAI_BASE_URL', 'https://api.openai.com/v1'),
            'api_key' => env('OPENAI_API_KEY'),
            'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
        ],

        'ollama' => [
            'base_url' => env('OLLAMA_BASE_URL', 'http://localhost:11434'),
            'model' => env('OLLAMA_MODEL', 'llama3.1'),
        ],

        'lmstudio' => [
            'base_url' => env('LMSTUDIO_BASE_URL', 'http://localhost:1234/v1'),
            'model' => env('LMSTUDIO_MODEL', 'local-model'),
        ],

        'openrouter' => [
            'base_url' => env('OPENROUTER_BASE_URL', 'https://openrouter.ai/api/v1'),
            'api_key' => env('OPENROUTER_API_KEY'),
            'model' => env('OPENROUTER_MODEL', 'openai/gpt-4o-mini'),
        ],

        'gemini' => [
            'base_url' => env('GEMINI_BASE_URL', 'https://generativelanguage.googleapis.com/v1beta'),
            'api_key' => env('GEMINI_API_KEY'),
            'model' => env('GEMINI_MODEL', 'gemini-1.5-flash'),
        ],

        'claude' => [
            'base_url' => env('CLAUDE_BASE_URL', 'https://api.anthropic.com/v1'),
            'api_key' => env('CLAUDE_API_KEY'),
            'model' => env('CLAUDE_MODEL', 'claude-3-5-haiku-20241022'),
        ],
    ],
];