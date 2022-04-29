<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DeliveryMethod;
use App\Models\DeliveryMethodSpecification;
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
        
        Category::factory(5)->has(
                SubCategory::factory()->has(
                    Product::factory()->has(
                        Image::factory()->count(1)
                    )->count(2)
                )->count(2)
            )->create();

            $this->call([
                DeliveryMethodSeeder::class,
                PaymentMethodSeeder::class,
                StatusOrderSeeder::class,
            ]);

        DeliveryMethodSpecification::factory(4)->create();
        User::factory(10)->hasAddress()->create();
        User::factory()->hasAddress()->create([
            'is_owner' => 1
        ]);

        
    }
}
