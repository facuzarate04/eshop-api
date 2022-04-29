<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
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

    public function setToOrder(array $client_products, Order $order)
    {
        foreach($client_products as $client_product)
        {
            $product = Product::findOrFail($client_product['id']);
            $product->stockDiscount($client_product['quantity']);
            $order->products()->attach($product->id, [
                'quantity' => $client_product['quantity'],
                'price_paid' => $product->price
            ]);
            $product->save(); 
        }
        return $order;
    }

}