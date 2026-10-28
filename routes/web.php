<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - NexusTech Store (Desarrollo Web Integral U3)
|--------------------------------------------------------------------------
*/

// Vista principal de la tienda (Catálogo, Drawer de Carrito, Modales)
Route::get('/', [ProductController::class, 'index'])->name('shop.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Rutas de API / AJAX para el Carrito de Compras
Route::prefix('api')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Cupones de descuento
    Route::post('/coupon/apply', [CouponController::class, 'apply'])->name('coupon.apply');
    Route::post('/coupon/remove', [CouponController::class, 'remove'])->name('coupon.remove');

    // Checkout y creación de órdenes
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});
