<?php

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    private Order $order;
    
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
            $this->order = new Order();
            $this->order->user_id = $data['user_id'];
            $this->setProducts($data['products']);
            $this->setPaymentMethod($data['payment_method']);
            $this->setOrderStatus(1); //Pending Status
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
        $payment_method = PaymentMethod::where('name', 'payment_method')->first();
        $this->payment_method_id = $payment_method->id;
        return $this->order;
    }

    public function setOrderStatus(int $id)
    {
        $order_status = OrderStatus::find($id);
        $this->order_status_id = $order_status->id;
        return $this->order;
    }

}