<?php

namespace App\Services;

use App\Models\DeliveryMethod;
use App\Models\DeliveryMethodSpecification;
use App\Models\Order;
use App\Models\StateCity;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Log;

class DeliveryMethodSpecificationService
{

    public function getDeliverySpecification(User $client, $code)
    {
        $deliveryMethod = DeliveryMethod::byCode(code: $code)->firstOrFail();
        $clientAddress = UserAddress::byUser(user: $client)->firstOrFail();
        $destination = $clientAddress->stateCity;
        $origin = User::where('is_owner', 1)->first()->address->stateCity;
        $deliverySpecification = DeliveryMethodSpecification::where('delivery_method_id', $deliveryMethod->id)
            ->where('origin_id', $origin->id)
            ->where('destination_id', $destination->id)
            ->first();

        return $deliverySpecification ? $deliverySpecification : false;
    }

}