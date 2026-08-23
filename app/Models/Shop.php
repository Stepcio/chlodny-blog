<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Shop extends Model
{
    /** @use HasFactory<\Database\Factories\ShopFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'district',
        'address',
        'description',
        'body',
        'rating',
        'status',
        'is_featured',
        'visited_at',
        'website',
        'cover_image',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'visited_at' => 'date',
            'rating' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeVisited(Builder $query): Builder
    {
        return $query->where('status', 'visited');
    }
}
