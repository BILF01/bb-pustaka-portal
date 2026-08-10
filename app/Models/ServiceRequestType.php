<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceRequestType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'sort_order'];

    public function requests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }
}