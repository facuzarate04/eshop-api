<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function stateCity()
    {
        return $this->belongsTo(StateCity::class, 'city_id');
    }

    //Scopes
    public function scopeByUser($q, User $user)
    {
        return $q->where('user_id', $user->id);
    }
}
