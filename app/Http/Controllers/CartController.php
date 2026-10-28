<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Retorna el contenido del carrito y el desglose de importes.
     */
    public function index(Request $request): JsonResponse
    {
        $cart = $request->session()->get('cart', []);
        $couponCode = $request->session()->get('coupon');

        $cartData = $this->calculateTotals($cart, $couponCode);

        return response()->json([
            'success' => true,
            'data' => $cartData,
        ]);
    }

    /**
     * Agrega un producto al carrito.
     */
    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $productId = (int) $request->input('product_id');
        $qty = (int) $request->input('quantity', 1);

        $product = Product::findOrFail($productId);
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $qty;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'title' => $product->title,
                'price' => (float) $product->price,
                'emoji' => $product->emoji,
                'quantity' => $qty,
            ];
        }

        $request->session()->put('cart', $cart);
        $couponCode = $request->session()->get('coupon');
        $cartData = $this->calculateTotals($cart, $couponCode);

        return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito con éxito.',
            'data' => $cartData,
        ]);
    }

    /**
     * Actualiza la cantidad de un artículo en el carrito.
     */
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|integer',
            'delta' => 'required|integer',
        ]);

        $productId = (int) $request->input('product_id');
        $delta = (int) $request->input('delta');

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $delta;
            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
            }
            $request->session()->put('cart', $cart);
        }

        $couponCode = $request->session()->get('coupon');
        $cartData = $this->calculateTotals($cart, $couponCode);

        return response()->json([
            'success' => true,
            'data' => $cartData,
        ]);
    }

    /**
     * Elimina un producto del carrito.
     */
    public function remove(Request $request, int $id): JsonResponse
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);
        }

        $couponCode = $request->session()->get('coupon');
        $cartData = $this->calculateTotals($cart, $couponCode);

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado del carrito.',
            'data' => $cartData,
        ]);
    }

    /**
     * Vacía por completo el carrito de compras.
     */
    public function clear(Request $request): JsonResponse
    {
        $request->session()->forget(['cart', 'coupon']);

        return response()->json([
            'success' => true,
            'message' => 'El carrito ha sido vaciado.',
            'data' => $this->calculateTotals([], null),
        ]);
    }

    /**
     * Método auxiliar para calcular subtotales, cupones, envíos y totales en USD y MXN.
     */
    private function calculateTotals(array $cart, ?string $couponCode): array
    {
        $items = array_values($cart);
        $totalItems = array_sum(array_column($items, 'quantity'));

        $subtotal = 0.0;
        foreach ($items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $subtotal = round($subtotal, 2);

        // Envío: Gratis si subtotal >= $50, si está vacío 0, de lo contrario $9.99
        $shipping = 0.0;
        if ($subtotal > 0) {
            $shipping = $subtotal >= 50.0 ? 0.0 : 9.99;
        }

        // Cupón de descuento
        $discount = 0.0;
        $couponData = null;

        if ($couponCode && $subtotal > 0) {
            $coupon = Coupon::where('code', $couponCode)->where('is_active', true)->first();
            if ($coupon && $coupon->isValidForAmount($subtotal)) {
                $discount = $coupon->calculateDiscount($subtotal);
                $couponData = [
                    'code' => $coupon->code,
                    'percent' => $coupon->discount_percent,
                    'amount' => $discount,
                ];
            }
        }

        $total = max(0.0, round($subtotal - $discount + $shipping, 2));
        $exchangeRate = 18.0;
        $totalMxn = (int) round($total * $exchangeRate);

        return [
            'items' => $items,
            'total_items' => $totalItems,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'shipping' => $shipping,
            'total' => $total,
            'total_mxn' => $totalMxn,
            'coupon' => $couponData,
        ];
    }
}
