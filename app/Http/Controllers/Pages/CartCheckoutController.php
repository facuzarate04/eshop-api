<?php

namespace App\Http\Controllers\Pages;

use App\Services\Pages\CartCheckoutService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CartCheckoutController extends Controller
{
    public function index(CartCheckoutService $cartCheckoutService)
    {
        try {
            $response = $cartCheckoutService->buildCartCheckoutPage();
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
