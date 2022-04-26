<?php

namespace App\Services;

use App\Models\Order;

class PaymentService
{

    public function payOrder(Order $order)
    {
        $payment_method = $order->payment_method;
        
        $response = match($payment_method->id) {
            1 => $this->cashPayment($order),
            2 => $this->mercadoPagoPayment($order)
        };

        return $response;
    }

    public function mercadoPagoPayment(Order $order)
    {

    }

    public function cashPayment(Order $order)
    {
        return $order->status === 1 ? $order->status : 4; //Internall error
    }

}