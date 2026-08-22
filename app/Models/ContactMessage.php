<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactMessage extends Model
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_RESOLVED = 'resolved';

    public const STATUS_ARCHIVED = 'archived';

    public const HANDLING_STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_IN_PROGRESS,
        self::STATUS_RESOLVED,
        self::STATUS_ARCHIVED,
    ];

    protected $fillable = [
        'name',
        'email',
        'message',
        'is_read',
        'read_at',
        'handling_status',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    public function replies(): HasMany
    {
        return $this
            ->hasMany(ContactMessageReply::class)
            ->oldest();
    }

    public function handlingStatusLabel(): string
    {
        return match ($this->handling_status) {
            self::STATUS_IN_PROGRESS => 'Diproses',
            self::STATUS_RESOLVED => 'Selesai',
            self::STATUS_ARCHIVED => 'Arsip',
            default => 'Belum Ditangani',
        };
    }
}