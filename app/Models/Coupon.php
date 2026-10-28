<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_percent',
        'min_spend',
        'is_active',
        'expires_at',
    ];

    protected $casts = [
        'discount_percent' => 'integer',
        'min_spend' => 'float',
        'is_active' => 'boolean',
        'expires_at' => 'date',
    ];

    /**
     * Determina si el cupón es válido para un subtotal dado.
     */
    public function isValidForAmount(float $subtotal): bool
    {
        if (! $this->is_active) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return $subtotal >= $this->min_spend;
    }

    /**
     * Calcula el monto a descontar para un subtotal dado.
     */
    public function calculateDiscount(float $subtotal): float
    {
        if (! $this->isValidForAmount($subtotal)) {
            return 0.0;
        }

        return round($subtotal * ($this->discount_percent / 100), 2);
    }
}
