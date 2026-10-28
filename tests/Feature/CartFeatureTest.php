<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected Product $expensiveProduct;
    protected Product $cheapProduct;

    protected function setUp(): void
    {
        parent::setUp();

        $category = Category::create(['name' => 'Tech', 'slug' => 'tech']);

        $this->expensiveProduct = Product::create([
            'category_id' => $category->id,
            'title' => 'Gadget Caro',
            'slug' => 'gadget-caro',
            'short_desc' => 'Producto mayor a 50 USD',
            'price' => 120.00,
            'stock' => 10,
        ]);

        $this->cheapProduct = Product::create([
            'category_id' => $category->id,
            'title' => 'Cable USB',
            'slug' => 'cable-usb',
            'short_desc' => 'Producto menor a 50 USD',
            'price' => 20.00,
            'stock' => 50,
        ]);
    }

    /**
     * Prueba Feature: Obtener carrito vacío inicialmente.
     */
    public function test_can_get_cart_contents_and_empty_state(): void
    {
        $response = $this->getJson('/api/cart');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'data' => [
                'total_items' => 0,
                'subtotal' => 0,
                'total' => 0,
            ],
        ]);
    }

    /**
     * Prueba Feature: Agregar producto al carrito y calcular subtotal.
     */
    public function test_can_add_product_to_cart_and_calculate_subtotal(): void
    {
        $response = $this->postJson('/api/cart/add', [
            'product_id' => $this->expensiveProduct->id,
            'quantity' => 2,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'data' => [
                'total_items' => 2,
                'subtotal' => 240.00,
            ],
        ]);
    }

    /**
     * Prueba Feature: Envío gratuito cuando el subtotal supera los $50 USD.
     */
    public function test_shipping_is_free_when_subtotal_is_over_50_dollars(): void
    {
        $response = $this->postJson('/api/cart/add', [
            'product_id' => $this->expensiveProduct->id,
            'quantity' => 1, // $120.00 > $50.00
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'subtotal' => 120.00,
                'shipping' => 0.00,
                'total' => 120.00,
            ],
        ]);
    }

    /**
     * Prueba Feature: Cobro de envío cuando el subtotal es menor a $50 USD.
     */
    public function test_shipping_is_charged_when_subtotal_is_under_50_dollars(): void
    {
        $response = $this->postJson('/api/cart/add', [
            'product_id' => $this->cheapProduct->id,
            'quantity' => 1, // $20.00 < $50.00 -> Envío $9.99
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'subtotal' => 20.00,
                'shipping' => 9.99,
                'total' => 29.99,
            ],
        ]);
    }

    /**
     * Prueba Feature: Actualizar cantidad de un producto en el carrito.
     */
    public function test_can_update_product_quantity_in_cart(): void
    {
        $this->postJson('/api/cart/add', [
            'product_id' => $this->expensiveProduct->id,
            'quantity' => 1,
        ]);

        $response = $this->postJson('/api/cart/update', [
            'product_id' => $this->expensiveProduct->id,
            'delta' => 1,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'total_items' => 2,
                'subtotal' => 240.00,
            ],
        ]);
    }

    /**
     * Prueba Feature: Eliminar un producto del carrito.
     */
    public function test_can_remove_product_from_cart(): void
    {
        $this->postJson('/api/cart/add', [
            'product_id' => $this->expensiveProduct->id,
            'quantity' => 1,
        ]);

        $response = $this->deleteJson("/api/cart/remove/{$this->expensiveProduct->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'total_items' => 0,
                'subtotal' => 0,
            ],
        ]);
    }

    /**
     * Prueba Feature: Vaciar todo el carrito.
     */
    public function test_can_clear_entire_cart(): void
    {
        $this->postJson('/api/cart/add', ['product_id' => $this->expensiveProduct->id]);
        $this->postJson('/api/cart/add', ['product_id' => $this->cheapProduct->id]);

        $response = $this->postJson('/api/cart/clear');

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'total_items' => 0,
            ],
        ]);
    }
}
