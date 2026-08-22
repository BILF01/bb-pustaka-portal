<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessageReply extends Model
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_LOGGED = 'logged';

    public const STATUS_SENT = 'sent';

    public const STATUS_FAILED = 'failed';

    protected $fillable = [
        'contact_message_id',
        'user_id',
        'recipient_email',
        'subject',
        'message',
        'delivery_status',
        'mailer',
        'error_message',
        'sent_at',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'sent_at' => 'datetime',
    ];

    public function contactMessage(): BelongsTo
    {
        return $this->belongsTo(ContactMessage::class);
    }

    public function deliveryStatusLabel(): string
    {
        return match ($this->delivery_status) {
            self::STATUS_LOGGED => 'Mode Pengujian',
            self::STATUS_SENT => 'Terkirim',
            self::STATUS_FAILED => 'Gagal',
            default => 'Menunggu',
        };
    }
}