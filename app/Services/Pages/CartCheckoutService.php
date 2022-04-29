<?php

namespace App\Services\Pages;

use App\Http\Resources\DeliveryMethodResource;
use App\Http\Resources\PaymentMethodResource;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;

class CartCheckoutService
{

    public function buildCartCheckoutPage()
    {
        $paymentMethods = PaymentMethod::with('image')->active()->get();
        $paymentMethods = PaymentMethodResource::collection($paymentMethods);

        $deliveryMethods = DeliveryMethod::active()->get();
        $deliveryMethods = DeliveryMethodResource::collection($deliveryMethods);

        return [
            'payment_methods' => $paymentMethods,
            'delivery_methods' => $deliveryMethods
        ];
    }

}