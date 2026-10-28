<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba Unitaria: Cálculo de porcentaje de descuento cuando existe precio anterior.
     */
    public function test_product_calculates_discount_percentage_correctly(): void
    {
        $category = Category::create(['name' => 'Audio', 'slug' => 'audio']);

        $product = Product::create([
            'category_id' => $category->id,
            'title' => 'Auriculares Test',
            'slug' => 'auriculares-test',
            'short_desc' => 'Descripción de prueba',
            'price' => 80.00,
            'old_price' => 100.00,
            'stock' => 10,
        ]);

        // (100 - 80) / 100 = 20%
        $this->assertEquals(20, $product->discount_percent);
    }

    /**
     * Prueba Unitaria: Verifica que retorne 0% de descuento si no hay old_price.
     */
    public function test_product_returns_zero_discount_when_no_old_price(): void
    {
        $category = Category::create(['name' => 'Audio', 'slug' => 'audio-2']);

        $product = Product::create([
            'category_id' => $category->id,
            'title' => 'Teclado Test',
            'slug' => 'teclado-test',
            'short_desc' => 'Descripción sin descuento',
            'price' => 120.00,
            'old_price' => null,
            'stock' => 5,
        ]);

        $this->assertEquals(0, $product->discount_percent);
    }

    /**
     * Prueba Unitaria: Comprobación de disponibilidad de stock.
     */
    public function test_product_in_stock_determination(): void
    {
        $category = Category::create(['name' => 'Gaming', 'slug' => 'gaming']);

        $inStockProduct = Product::create([
            'category_id' => $category->id,
            'title' => 'Mouse Gaming In Stock',
            'slug' => 'mouse-in-stock',
            'short_desc' => 'En existencia',
            'price' => 50.00,
            'stock' => 5,
        ]);

        $outOfStockProduct = Product::create([
            'category_id' => $category->id,
            'title' => 'Mouse Gaming Agotado',
            'slug' => 'mouse-out-of-stock',
            'short_desc' => 'Sin existencias',
            'price' => 50.00,
            'stock' => 0,
        ]);

        $this->assertTrue($inStockProduct->isInStock());
        $this->assertFalse($outOfStockProduct->isInStock());
    }

    /**
     * Prueba Unitaria: Relación de pertenencia a categoría.
     */
    public function test_product_belongs_to_category(): void
    {
        $category = Category::create(['name' => 'Wearables', 'slug' => 'wearables']);

        $product = Product::create([
            'category_id' => $category->id,
            'title' => 'Smartwatch Pro',
            'slug' => 'smartwatch-pro',
            'short_desc' => 'Reloj inteligente',
            'price' => 199.99,
            'stock' => 15,
        ]);

        $this->assertInstanceOf(Category::class, $product->category);
        $this->assertEquals('wearables', $product->category->slug);
    }
}
