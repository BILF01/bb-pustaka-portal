<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'location', 'category', 'image_path', 'starts_at', 'ends_at'];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('starts_at', '>=', now())->orderBy('starts_at');
    }

    public function status(): string
    {
        $now = now();
        $end = $this->ends_at ?? $this->starts_at;

        if ($now->lt($this->starts_at)) {
            return __('Akan Dimulai');
        }

        if ($now->between($this->starts_at, $end)) {
            return __('Sedang Berlangsung');
        }

        return __('Telah Selesai');
    }
    
    public function statusColor(): string
    {
        return match ($this->status()) {
            'Akan Dimulai' => 'bg-primary/10 text-primary',
            'Sedang Berlangsung' => 'bg-secondary/20 text-on-secondary-container',
            default => 'bg-surface-container text-on-surface-variant',
        };
    }

    public function scopeOnDate(Builder $query, string $date): Builder
    {
        return $query->whereDate('starts_at', $date)->orderBy('starts_at');
    }

    public function scopeInMonth(Builder $query, int $year, int $month): Builder
    {
        return $query->whereYear('starts_at', $year)->whereMonth('starts_at', $month);
    }
}