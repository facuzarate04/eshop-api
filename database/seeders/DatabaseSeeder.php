<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DeliveryMethod;
use App\Models\Image;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Category::factory(5)->has(
                SubCategory::factory()->has(
                    Product::factory()->has(
                        Image::factory()->count(2)
                    )->count(2)
                )->count(2)
            )->create();

            $this->call([
                DeliveryMethodSeeder::class,
                PaymentMethodSeeder::class
            ]);

        
    }
}
