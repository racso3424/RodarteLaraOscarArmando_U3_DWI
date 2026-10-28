<?php

namespace Tests\Unit;

use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba Unitaria: Un cupón activo calcula el descuento correctamente.
     */
    public function test_active_coupon_applies_correct_discount(): void
    {
        $coupon = Coupon::create([
            'code' => 'DWIU3',
            'discount_percent' => 15,
            'min_spend' => 0,
            'is_active' => true,
        ]);

        $subtotal = 200.00;
        // 15% de 200 = 30.00
        $this->assertTrue($coupon->isValidForAmount($subtotal));
        $this->assertEquals(30.00, $coupon->calculateDiscount($subtotal));
    }

    /**
     * Prueba Unitaria: Un cupón inactivo no debe ser válido ni calcular descuento.
     */
    public function test_inactive_coupon_is_not_valid(): void
    {
        $coupon = Coupon::create([
            'code' => 'OFF50',
            'discount_percent' => 50,
            'min_spend' => 0,
            'is_active' => false,
        ]);

        $this->assertFalse($coupon->isValidForAmount(100.00));
        $this->assertEquals(0.00, $coupon->calculateDiscount(100.00));
    }

    /**
     * Prueba Unitaria: Un cupón no es válido si no cumple con el gasto mínimo.
     */
    public function test_coupon_fails_when_subtotal_is_below_minimum_spend(): void
    {
        $coupon = Coupon::create([
            'code' => 'VIP100',
            'discount_percent' => 20,
            'min_spend' => 150.00,
            'is_active' => true,
        ]);

        $this->assertFalse($coupon->isValidForAmount(100.00));
        $this->assertTrue($coupon->isValidForAmount(150.00));
        $this->assertTrue($coupon->isValidForAmount(200.00));
    }

    /**
     * Prueba Unitaria: Un cupón expirado es rechazado.
     */
    public function test_expired_coupon_is_invalid(): void
    {
        $coupon = Coupon::create([
            'code' => 'OLDYEAR',
            'discount_percent' => 10,
            'min_spend' => 0,
            'is_active' => true,
            'expires_at' => Carbon::now()->subDays(5),
        ]);

        $this->assertFalse($coupon->isValidForAmount(100.00));
        $this->assertEquals(0.00, $coupon->calculateDiscount(100.00));
    }
}
