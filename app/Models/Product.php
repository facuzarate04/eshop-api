<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsToMany(Order::class, 'product_order', 'product_id', 'order_id');
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
    
    


}
