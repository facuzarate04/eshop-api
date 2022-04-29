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
            $this->client = auth()->user();
            $this->order = new Order();

            $this->order->user_id = $this->client->id;
            $this->setPaymentMethod($data['payment_method_code']);
            $this->setDeliveryMethodSpecification($data['delivery_method_code']);
            $this->setStatusOrder(1); //Pending Status
            $this->order->number = uniqid($this->order->id);
            $this->order->save();
            $this->setProducts($data['products']);
            $this->order->update([
                'price_paid' => $this->order->calculatePricePaid()
            ]);
            $this->order->save();
            DB::commit();
            return OrderResource::collection($this->order);
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
        }
        
    }

    public function setPaymentMethod(string $payment_method)
    {
        $payment_method = PaymentMethod::where('code', $payment_method)->first();
        $this->order->payment_method_id = $payment_method->id;
        return $this->order;
    }
    
    public function setDeliveryMethodSpecification(string $delivery_method)
    {
        $deliveryMethodSpecificationService = new DeliveryMethodSpecificationService();
        $deliveryMethodSpecification = $deliveryMethodSpecificationService->getDeliverySpecification(client: $this->client, code: $delivery_method);
        $this->order->delivery_method_specification_id = $deliveryMethodSpecification ? $deliveryMethodSpecification->id : null;
        return $this->order;
    }
    
    public function setStatusOrder(int $id)
    {
        $status_order = StatusOrder::find($id);
        $this->order->status_order_id = $status_order->id;
        return $this->order;
    }
    
    public function setProducts(array $products)
    {
        $productService = new ProductService();
        $productService->setToOrder(client_products: $products, order: $this->order);
        return $this->order;
    }

}