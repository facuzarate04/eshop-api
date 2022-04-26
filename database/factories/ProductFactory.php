<?php

namespace Database\Factories;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = ['ACTIVE', 'DISABLED', 'INSUFICIENT_STOCK'];
        
        return [
            'name' => $this->faker->unique()->name(),
            'status' => $this->faker->randomElement($status),
            'price' => $this->faker->randomFloat(2, 20, 99999),
            'stock' => $this->faker->numberBetween($min = 0, $max = 9999),
            'description' => $this->faker->text(120),
            'sub_category_id' => SubCategory::factory()
        ];
    }
}
