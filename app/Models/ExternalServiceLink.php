<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class ExternalServiceLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'icon',
        'description',
        'integration_mode',
        'external_url',
        'native_route',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function resolvedUrl(): string
    {
        $wantsNative = in_array($this->integration_mode, ['native', 'hybrid'], true);

        if ($wantsNative && $this->native_route && Route::has($this->native_route)) {
            return route($this->native_route);
        }

        return $this->external_url ?? '#';
    }

    public static function cachedActiveLinks(): Collection
    {
        return Cache::remember('external_service_links:active', 3600, function () {
            return static::active()->get()->map(fn (self $link): array => [
                'icon' => $link->icon,
                'label' => $link->name,
                'url' => $link->resolvedUrl(),
                'action' => $link->key === 'ai_assistant' ? 'open-chat' : null,
            ]);
        });
    }
}