<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    
    protected $table = 'payment_methods';

    public function orders()
    {
        return $this->hasMany(Order::class);
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

}
