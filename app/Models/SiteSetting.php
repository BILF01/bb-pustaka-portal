<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Ambil satu nilai setting berdasarkan key, dengan cache 1 jam.
     * Menghindari query berulang ke tabel site_settings di setiap request,
     * karena data ini jarang berubah.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        return Cache::remember("site_setting:{$key}", 3600, function () use ($key, $default): ?string {
            return static::query()->where('key', $key)->value('value') ?? $default;
        });
    }
}