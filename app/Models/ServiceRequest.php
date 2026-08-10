<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_request_type_id',
        'full_name',
        'email',
        'phone',
        'description',
        'status',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ServiceRequestType::class, 'service_request_type_id');
    }
}