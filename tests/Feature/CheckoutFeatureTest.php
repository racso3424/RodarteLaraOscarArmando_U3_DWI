<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $category = Category::create(['name' => 'Tech', 'slug' => 'tech']);

        $this->product = Product::create([
            'category_id' => $category->id,
            'title' => 'Dispositivo de Prueba',
            'slug' => 'dispositivo-prueba',
            'short_desc' => 'Prueba de checkout',
            'price' => 75.00,
            'stock' => 20,
        ]);

        Coupon::create([
            'code' => 'DWIU3',
            'discount_percent' => 15,
            'is_active' => true,
        ]);
    }

    /**
     * Prueba Feature: Validación de campos obligatorios en el formulario de Checkout.
     */
    public function test_checkout_validates_required_customer_fields(): void
    {
        $response = $this->postJson('/api/checkout', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'customer_name',
            'customer_email',
            'customer_phone',
            'delivery_address',
            'payment_method',
        ]);
    }

    /**
     * Prueba Feature: El checkout es rechazado si no hay artículos en el carrito.
     */
    public function test_checkout_rejects_empty_cart(): void
    {
        $response = $this->postJson('/api/checkout', [
            'customer_name' => 'Oscar Rodarte',
            'customer_email' => 'oscar@ejemplo.com',
            'customer_phone' => '5512345678',
            'delivery_address' => 'Av. Universidad #123, CP 76000',
            'payment_method' => 'card',
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'No hay productos en el carrito para procesar.',
        ]);
    }

    /**
     * Prueba Feature: Checkout exitoso registra la orden y los items en la base de datos.
     */
    public function test_successful_checkout_creates_order_and_order_items_in_database(): void
    {
        // 1. Agregar producto al carrito
        $this->postJson('/api/cart/add', [
            'product_id' => $this->product->id,
            'quantity' => 2, // 2 * $75 = $150
        ]);

        // 2. Aplicar cupón de 15% (15% de 150 = $22.50) -> Total = $127.50
        $this->postJson('/api/coupon/apply', ['code' => 'DWIU3']);

        // 3. Procesar checkout
        $response = $this->postJson('/api/checkout', [
            'customer_name' => 'Oscar Armando Rodarte Lara',
            'customer_email' => 'oscar.rodarte@ejemplo.com',
            'customer_phone' => '55 9876 5432',
            'delivery_address' => 'Calle Tecnología #404, Ciudad de México',
            'payment_method' => 'card',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => '¡Pedido confirmado con éxito!',
        ]);

        $orderNumber = $response->json('order.order_number');
        $this->assertNotEmpty($orderNumber);

        // 4. Verificar inserción en la base de datos
        $this->assertDatabaseHas('orders', [
            'order_number' => $orderNumber,
            'customer_name' => 'Oscar Armando Rodarte Lara',
            'customer_email' => 'oscar.rodarte@ejemplo.com',
            'subtotal' => 150.00,
            'discount' => 22.50,
            'shipping' => 0.00,
            'total' => 127.50,
            'status' => 'confirmed',
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => $this->product->id,
            'product_name' => 'Dispositivo de Prueba',
            'price' => 75.00,
            'quantity' => 2,
        ]);
    }

    /**
     * Prueba Feature: Checkout exitoso vacía el carrito de compras.
     */
    public function test_successful_checkout_clears_session_cart(): void
    {
        $this->postJson('/api/cart/add', [
            'product_id' => $this->product->id,
            'quantity' => 1,
        ]);

        $this->postJson('/api/checkout', [
            'customer_name' => 'Carlos Mendoza',
            'customer_email' => 'carlos@ejemplo.com',
            'customer_phone' => '55 1122 3344',
            'delivery_address' => 'Blvd. Innovación #777, Monterrey, NL',
            'payment_method' => 'paypal',
        ]);

        $cartResponse = $this->getJson('/api/cart');
        $cartResponse->assertJson([
            'data' => [
                'total_items' => 0,
                'subtotal' => 0,
            ],
        ]);
    }
}
