<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCatalogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $catAudio = Category::create(['name' => 'Audio', 'slug' => 'audio']);
        $catGaming = Category::create(['name' => 'Gaming', 'slug' => 'gaming']);

        Product::create([
            'category_id' => $catAudio->id,
            'title' => 'Aura Pro Headphones',
            'slug' => 'aura-pro-headphones',
            'short_desc' => 'Auriculares inalámbricos con cancelación activa de ruido',
            'price' => 189.99,
            'rating' => 4.9,
            'stock' => 50,
        ]);

        Product::create([
            'category_id' => $catGaming->id,
            'title' => 'CyberDeck Mechanical Keyboard',
            'slug' => 'cyberdeck-mechanical-keyboard',
            'short_desc' => 'Teclado para gaming competitivo',
            'price' => 129.99,
            'rating' => 4.8,
            'stock' => 40,
        ]);
    }

    /**
     * Prueba de Integración: La página principal carga con código HTTP 200 y muestra los productos.
     */
    public function test_shop_page_returns_status_200_and_renders_products(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Aura Pro Headphones');
        $response->assertSee('CyberDeck Mechanical Keyboard');
    }

    /**
     * Prueba de Integración: Filtrado de productos por categoría vía API/AJAX.
     */
    public function test_can_filter_products_by_category(): void
    {
        $response = $this->getJson('/?category=audio');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'products');
        $response->assertJsonFragment(['title' => 'Aura Pro Headphones']);
        $response->assertJsonMissing(['title' => 'CyberDeck Mechanical Keyboard']);
    }

    /**
     * Prueba de Integración: Búsqueda de productos por palabra clave.
     */
    public function test_can_search_products_by_keyword(): void
    {
        $response = $this->getJson('/?search=Headphones');

        $response->assertStatus(200);
        $response->assertJsonFragment(['title' => 'Aura Pro Headphones']);
        $response->assertJsonMissing(['title' => 'CyberDeck Mechanical Keyboard']);
    }

    /**
     * Prueba de Integración: Ordenamiento de productos por precio ascendente.
     */
    public function test_can_sort_products_by_price_ascending(): void
    {
        $response = $this->getJson('/?sort=price-asc');

        $response->assertStatus(200);
        $data = $response->json('products');

        // El primer producto debe ser el de menor precio ($129.99 < $189.99)
        $this->assertEquals('CyberDeck Mechanical Keyboard', $data[0]['title']);
        $this->assertEquals('Aura Pro Headphones', $data[1]['title']);
    }

    /**
     * Prueba de Integración: Ver detalles de un producto específico por ID.
     */
    public function test_can_view_single_product_details(): void
    {
        $product = Product::first();

        $response = $this->getJson("/products/{$product->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'product' => [
                'id' => $product->id,
                'title' => $product->title,
            ],
        ]);
    }
}
