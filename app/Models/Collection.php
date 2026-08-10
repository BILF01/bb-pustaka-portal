<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_category_id',
        'title',
        'slug',
        'author',
        'publisher',
        'published_year',
        'isbn',
        'page_count',
        'access_link',
        'synopsis',
        'cover_path',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_year' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CollectionCategory::class, 'collection_category_id');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (blank($term)) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term): void {
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('author', 'like', "%{$term}%");
        });
    }
}