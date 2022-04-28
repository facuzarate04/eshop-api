<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    use HasFactory;

    protected $table = 'delivery_methods';

    public function specifications()
    {
        return $this->hasMany(DeliveryMethodSpecification::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, DeliveryMethodSpecification::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    //Scopes
    public function scopeActive($q)
    {
        $q->where('active',1);
    }

    public function scopeByCode($q, $code)
    {
        return $q->where('code', $code);
    }
}
