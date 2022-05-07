<?php

namespace Database\Factories;

use App\Models\DeliveryMethod;
use App\Models\StateCity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryMethodSpecification>
 */
class DeliveryMethodSpecificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'delivery_method_id' => DeliveryMethod::inRandomOrder()->first(),
            'origin_id' => StateCity::factory(),
            'destination_id' => StateCity::factory(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'delay_time' => rand(0,7)
        ];
    }
}
