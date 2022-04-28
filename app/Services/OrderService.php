<?php

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\StatusOrder;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    private Order $order;
    private User $client;
    
    /**
     * store
     *
     * @param  mixed $data
     * @return Order $order
     */
    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $this->client = User::findOrFail($data['user_id']);
            $this->order = new Order();

            $this->order->user_id = $this->client->id;
            $this->setProducts($data['products']);
            $this->setPaymentMethod($data['payment_method_code']);
            $this->setDeliveryMethodSpecification($data['delivery_method_code']);
            $this->setStatusOrder(1); //Pending Status
            $this->order->price_paid = $this->order->getPricePaid($data['products']);
            DB::commit();
            return OrderResource::collection($this->order);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
        }
        
    }

    public function setProducts(array $products)
    {
        $productsIds = Arr::pluck($products, 'id');
        $this->order->sync($productsIds);
        return $this->order;
    }

    public function setPaymentMethod(string $payment_method)
    {
        $paymentMethodService = new PaymentMethodService();
        $payment_method = PaymentMethod::where('code', 'payment_method')->first();
        $this->payment_method_id = $payment_method->id;
        return $this->order;
    }

    public function setDeliveryMethodSpecification(string $delivery_method)
    {
        $deliveryMethodSpecificationService = new DeliveryMethodSpecificationService();
        $deliveryMethodSpecification = $deliveryMethodSpecificationService->getDeliverySpecification(client: $this->client, code: $delivery_method);
        $this->order->delivery_method_specification_id = $deliveryMethodSpecification->id;
        return $this->order;
    }

    public function setStatusOrder(int $id)
    {
        $order_status = StatusOrder::find($id);
        $this->order_status_id = $order_status->id;
        return $this->order;
    }

}