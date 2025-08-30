<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodsController extends Controller
{
    public function getAllPaymentMethods(Request $request)
    {
        $user = Auth::user();
        $lang = $request->header('lang', 'en'); // Default to 'en' if 'lang' header is missing
        $wallet_balance = (double) $user->wallet_balance;

        // Fetch payment methods
        $paymentMethods = PaymentMethod::where('status', '1')
            ->select(['id', 'name_en', 'name_ar', 'description_en', 'description_ar', 'web_view', 'icon'])
            ->get();

        // Modify the response based on the 'lang' header
        $paymentMethods = $paymentMethods->map(function ($method) use ($lang) {
            return [
                'id' => $method->id,
                'name_en' => ($lang === 'ar') ? $method->name_ar : $method->name_en, // Dynamic name based on 'lang'
                'name_ar' => $method->name_ar, // Dynamic name based on 'lang'
                'description_en' => ($lang === 'ar') ? $method->description_ar : $method->description_en, // Dynamic description based on 'lang'
                'description_ar' => $method->description_ar, // Dynamic description based on 'lang'
                'web_view' => $method->web_view,
                'icon' => $method->icon,
            ];
        });

        return response()->json([
            'wallet_balance' => $wallet_balance,
            'payment_methods' => $paymentMethods,
        ]);
    }
}
