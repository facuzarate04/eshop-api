<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateCity extends Model
{
    use HasFactory;

    protected $table = 'state_cities';

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function deliveryMethodSpecifications()
    {
        return $this->hasMany(DeliveryMethodSpecification::class);
    }
}
