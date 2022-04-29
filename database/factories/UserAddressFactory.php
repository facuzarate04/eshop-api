<?php

namespace Database\Factories;

use App\Models\StateCity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first(),
            'city_id' => StateCity::inRandomOrder()->first(),
            'street' => $this->faker->streetName(),
            'street_number' => $this->faker->buildingNumber(),
            'building' => $this->faker->buildingNumber(),
            'building_number' => $this->faker->buildingNumber(),
            'references' => $this->faker->sentence()
        ];
    }
}
