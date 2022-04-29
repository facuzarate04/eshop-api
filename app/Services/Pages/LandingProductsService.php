<?php

namespace App\Services\Pages;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LandingProductsService
{

    public function buildLandingProductsPage()
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
        $products = ProductResource::collection($products);

        $categories = Category::with('subCategories')
                ->whereHas('subCategories', function($q){
                    $q->has('products');
                })
                ->take(10)
                ->get();

        $categories = CategoryResource::collection($categories);

        return [
            'products' => $products,
            'categories' => $categories
        ];
    }

}