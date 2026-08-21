<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ChatSession extends Model
{
    use MassPrunable;

    protected $fillable = ['uuid', 'visitor_token', 'title'];

    protected static function booted(): void
    {
        static::creating(function (ChatSession $session): void {
            $session->uuid ??= (string) Str::uuid();
        });
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class)->orderBy('created_at');
    }

    public function prunable(): Builder
    {
        return static::query()->where('created_at', '<=', now()->subDays(30));
    }
}