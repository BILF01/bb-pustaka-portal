<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FooterLink extends Model
{
    protected $fillable = ['group', 'label', 'url', 'icon', 'sort_order'];

    public function scopeGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group)->orderBy('sort_order');
    }
}