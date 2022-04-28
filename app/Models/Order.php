<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public function status()
    {
        return $this->belongsTo(StatusOrder::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function deliveryMethodSpecification()
    {
        return $this->belongsTo(DeliveryMethodSpecification::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order', 'order_id', 'product_id');
    }


}
