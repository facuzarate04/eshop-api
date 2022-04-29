<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order', 'product_id', 'order_id')->withPivot('quantity')->orderBy('created_at');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getpreviewImageAttribute()
    {
        return $this->images->first()->preview_image;
    }


    //Scopes
    public function scopeActive($q)
    {
        $q->where('status','ACTIVE')->where('stock','>', 0);
    }

    //Business logic
    public function stockDiscount(int $quantity)
    {
        if($this->stock >= $quantity)
        {
            $this->stock = $this->stock - $quantity;
            return $this;
        }
        throw new Exception('Error al intentar descontar stock',500);
        Log::error('Error al intentar descontar stock de un producto');
    }
    
    


}
