<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Valida y aplica un cupón de descuento en la sesión.
     */
    public function apply(Request $request): JsonResponse
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = strtoupper(trim($request->input('code')));
        $coupon = Coupon::where('code', $code)->where('is_active', true)->first();

        if (! $coupon) {
            return response()->json([
                'success' => false,
                'message' => 'El código de cupón no es válido o ha expirado.',
            ], 422);
        }

        if ($coupon->expires_at && $coupon->expires_at->isPast()) {
            return response()->json([
                'success' => false,
                'message' => 'Este cupón ha expirado.',
            ], 422);
        }

        $cart = $request->session()->get('cart', []);
        $subtotal = 0.0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        if ($coupon->min_spend > 0 && $subtotal < $coupon->min_spend) {
            return response()->json([
                'success' => false,
                'message' => "Este cupón requiere una compra mínima de \${$coupon->min_spend} USD.",
            ], 422);
        }

        $request->session()->put('coupon', $coupon->code);

        return response()->json([
            'success' => true,
            'message' => "¡Cupón {$coupon->code} aplicado con éxito ({$coupon->discount_percent}% de descuento)!",
            'coupon' => [
                'code' => $coupon->code,
                'discount_percent' => $coupon->discount_percent,
            ],
        ]);
    }

    /**
     * Remueve el cupón de descuento de la sesión.
     */
    public function remove(Request $request): JsonResponse
    {
        $request->session()->forget('coupon');

        return response()->json([
            'success' => true,
            'message' => 'Cupón removido.',
        ]);
    }
}
