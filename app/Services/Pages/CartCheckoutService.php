<?php

namespace App\Services\Pages;

use App\Http\Resources\DeliveryMethodResource;
use App\Http\Resources\DeliveryMethodSpecificationResource;
use App\Http\Resources\PaymentMethodResource;
use App\Models\DeliveryMethod;
use App\Models\DeliveryMethodSpecification;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Log;

class CartCheckoutService
{

    public function __construct()
    {
        $this->client = auth()->user();
    }

    public function buildCartCheckoutPage()
    {
        $paymentMethods = PaymentMethod::with('image')->active()->get();
        $paymentMethods = PaymentMethodResource::collection($paymentMethods);

        $deliveryMethods = $this->getDeliveryMethods();
        
        $deliveryMethods = DeliveryMethodResource::collection($deliveryMethods);

        return [
            'payment_methods' => $paymentMethods,
            'delivery_methods' => $deliveryMethods
        ];
    }

    public function getDeliveryMethods()
    {
        $deliveryMethods = DeliveryMethod::where('code', 'LOCAL')
            ->orWhereHas('specifications', function($q){
                $q->where('destination_id',$this->client->address->stateCity->id);
            })
            ->with([
                'specifications' => function($q) {
                    $q->where('destination_id', $this->client->address->stateCity->id)
                    ->orWhereHas('deliveryMethod', function($q2){
                        $q2->where('code', 'LOCAL');
                    });
                }
            ])
            ->get();

        return $deliveryMethods;
    }

}