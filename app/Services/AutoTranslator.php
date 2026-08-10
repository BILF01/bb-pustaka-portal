<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class AutoTranslator
{
    protected static ?array $dictionary = null;

    public static function translate(string $text): string
    {
        if (app()->getLocale() !== 'en' || trim($text) === '') {
            return $text;
        }

        self::loadDictionary();

        if (isset(self::$dictionary[$text])) {
            return self::$dictionary[$text];
        }

        return Cache::rememberForever('auto_translate:'.md5($text), function () use ($text) {
            $translated = self::callApi($text);
            self::persist($text, $translated);

            return $translated;
        });
    }

    protected static function loadDictionary(): void
    {
        if (self::$dictionary !== null) {
            return;
        }

        $path = base_path('lang/en.json');
        self::$dictionary = file_exists($path)
            ? (json_decode(file_get_contents($path), true) ?? [])
            : [];
    }

    protected static function callApi(string $text): string
    {
        try {
            $response = Http::timeout(5)->get('https://api.mymemory.translated.net/get', [
                'q' => $text,
                'langpair' => 'id|en',
            ]);

            return $response->json('responseData.translatedText') ?: $text;
        } catch (Throwable $e) {
            Log::warning('AutoTranslator gagal: '.$e->getMessage());

            return $text;
        }
    }

    protected static function persist(string $original, string $translated): void
    {
        self::$dictionary[$original] = $translated;

        file_put_contents(
            base_path('lang/en.json'),
            json_encode(self::$dictionary, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
    }
}