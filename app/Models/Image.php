<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    public function imageable()
    {
        return $this->morphTo();
    }


    //Accessors

    public function getsmallImageAttribute()
    {
        return asset($this->small_webp_url);
    }

    public function getmediumImageAttribute()
    {
        return asset($this->medium_webp_url);
    }

    public function getlargeImageAttribute()
    {
        return asset($this->large_webp_url);
    }

    public function getpreviewImageAttribute()
    {
        return asset($this->medium_webp_url);
    }
    
}
