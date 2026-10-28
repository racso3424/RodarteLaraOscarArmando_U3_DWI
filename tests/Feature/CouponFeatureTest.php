<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CouponFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Coupon::create([
            'code' => 'DWIU3',
            'discount_percent' => 15,
            'min_spend' => 0,
            'is_active' => true,
        ]);

        $category = Category::create(['name' => 'Audio', 'slug' => 'audio']);
        Product::create([
            'category_id' => $category->id,
            'title' => 'Audífonos Bluetooth',
            'slug' => 'audifonos-bluetooth',
            'short_desc' => 'Sonido Hi-Res',
            'price' => 100.00,
            'stock' => 10,
        ]);
    }

    /**
     * Prueba Feature: Aplicar cupón válido DWIU3 con éxito.
     */
    public function test_can_apply_valid_coupon_and_recalculate_totals(): void
    {
        // 1. Agregar producto de $100.00
        $product = Product::first();
        $this->postJson('/api/cart/add', ['product_id' => $product->id, 'quantity' => 1]);

        // 2. Aplicar cupón DWIU3 (15% OFF)
        $response = $this->postJson('/api/coupon/apply', ['code' => 'DWIU3']);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'coupon' => [
                'code' => 'DWIU3',
                'discount_percent' => 15,
            ],
        ]);

        // 3. Verificar recálculo en el carrito: $100 - $15 = $85 + Envío Gratis = $85.00
        $cartResponse = $this->getJson('/api/cart');
        $cartResponse->assertJson([
            'data' => [
                'subtotal' => 100.00,
                'discount' => 15.00,
                'shipping' => 0.00,
                'total' => 85.00,
            ],
        ]);
    }

    /**
     * Prueba Feature: Rechazo de cupón inválido o inexistente.
     */
    public function test_rejects_invalid_or_nonexistent_coupon(): void
    {
        $response = $this->postJson('/api/coupon/apply', ['code' => 'CUPON_FALSO_999']);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
        ]);
    }

    /**
     * Prueba Feature: Remover cupón aplicado de la sesión.
     */
    public function test_can_remove_applied_coupon(): void
    {
        $this->postJson('/api/coupon/apply', ['code' => 'DWIU3']);

        $response = $this->postJson('/api/coupon/remove');

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }
}
