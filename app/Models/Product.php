<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'short_desc',
        'price',
        'old_price',
        'rating',
        'reviews_count',
        'badge',
        'badge_text',
        'emoji',
        'specs',
        'stock',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'float',
        'old_price' => 'float',
        'rating' => 'float',
        'reviews_count' => 'integer',
        'stock' => 'integer',
        'is_featured' => 'boolean',
        'specs' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Calcula el porcentaje de descuento si existe un precio anterior.
     */
    public function getDiscountPercentAttribute(): int
    {
        if ($this->old_price && $this->old_price > $this->price) {
            return (int) round((($this->old_price - $this->price) / $this->old_price) * 100);
        }
        return 0;
    }

    /**
     * Verifica si el producto tiene stock disponible.
     */
    public function isInStock(): bool
    {
        return $this->stock > 0;
    }
}
