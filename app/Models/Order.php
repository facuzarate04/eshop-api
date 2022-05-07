<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(StatusOrder::class, 'status_order_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function deliveryMethodSpecification()
    {
        return $this->belongsTo(DeliveryMethodSpecification::class, 'delivery_method_specification_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order', 'order_id', 'product_id')->withPivot(['quantity','price_paid'])->orderByPivot('quantity','asc');
    }

    public function calculatePricePaid() : float
    {
        $pricePaid = 0;
        foreach($this->products as $product)
        {
            $pricePaid = $pricePaid + ($product->price * $product->pivot->quantity);
        }
        return $pricePaid;
    }


}
