<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductService
{

    public function getAllProducts()
    {
        $products = QueryBuilder::for(Product::class)
            ->active()
            ->with(['images', 'subCategory.category'])
            ->allowedFilters([
                'name',
                AllowedFilter::exact('sub', 'subCategory.id')->ignore(null),
                AllowedFilter::exact('category', 'subCategory.category.id')->ignore(null)
                ])
            ->paginate(10);
        return ProductResource::collection($products);
    }

}