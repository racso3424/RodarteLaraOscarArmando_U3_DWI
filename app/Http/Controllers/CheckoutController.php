<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Procesa la compra y genera la orden en la base de datos.
     */
    public function process(Request $request): JsonResponse
    {
        $request->validate([
            'customer_name' => 'required|string|min:3|max:150',
            'customer_email' => 'required|email|max:150',
            'customer_phone' => 'required|string|min:7|max:30',
            'delivery_address' => 'required|string|min:10|max:300',
            'payment_method' => 'required|string|in:card,paypal,cash',
            'items' => 'nullable|array', // Soporta items enviados directamente o tomados de sesión
        ]);

        $cart = $request->session()->get('cart', []);

        // Si se enviaron items en el request (por ejemplo, desde el cliente con localStorage), los sincronizamos
        if ($request->has('items') && is_array($request->items) && count($request->items) > 0) {
            $cart = $request->items;
        }

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'No hay productos en el carrito para procesar.',
            ], 422);
        }

        // Calcular subtotales
        $subtotal = 0.0;
        foreach ($cart as $item) {
            $price = isset($item['price']) ? (float) $item['price'] : 0.0;
            $qty = isset($item['quantity']) ? (int) $item['quantity'] : (isset($item['qty']) ? (int) $item['qty'] : 1);
            $subtotal += $price * $qty;
        }
        $subtotal = round($subtotal, 2);

        // Descuento
        $discount = 0.0;
        $couponCode = $request->session()->get('coupon') ?? $request->input('coupon_code');
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->where('is_active', true)->first();
            if ($coupon && $coupon->isValidForAmount($subtotal)) {
                $discount = $coupon->calculateDiscount($subtotal);
            }
        }

        // Envío
        $shipping = $subtotal >= 50.0 ? 0.0 : 9.99;
        $total = max(0.0, round($subtotal - $discount + $shipping, 2));

        // Crear la orden en la base de datos dentro de una transacción
        $order = DB::transaction(function () use ($request, $cart, $subtotal, $discount, $shipping, $total) {
            $orderNumber = 'ORD-' . strtoupper(Str::random(6));

            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_name' => $request->input('customer_name'),
                'customer_email' => $request->input('customer_email'),
                'customer_phone' => $request->input('customer_phone'),
                'delivery_address' => $request->input('delivery_address'),
                'payment_method' => $request->input('payment_method'),
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'confirmed',
            ]);

            foreach ($cart as $item) {
                $productId = $item['id'] ?? null;
                $title = $item['title'] ?? 'Producto';
                $price = isset($item['price']) ? (float) $item['price'] : 0.0;
                $qty = isset($item['quantity']) ? (int) $item['quantity'] : (isset($item['qty']) ? (int) $item['qty'] : 1);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $title,
                    'price' => $price,
                    'quantity' => $qty,
                ]);
            }

            return $order;
        });

        // Limpiar la sesión
        $request->session()->forget(['cart', 'coupon']);

        return response()->json([
            'success' => true,
            'message' => '¡Pedido confirmado con éxito!',
            'order' => [
                'order_number' => $order->order_number,
                'total' => $order->total,
                'customer_name' => $order->customer_name,
                'status' => $order->status,
                'created_at' => $order->created_at->format('d/m/Y H:i'),
            ],
        ]);
    }
}
