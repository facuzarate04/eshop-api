<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethodSpecification extends Model
{
    use HasFactory;

    protected $table = 'delivery_method_specifications';

    public function deliveryMethod()
    {
        return $this->belongsTo(DeliveryMethod::class, 'delivery_method_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
