<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /* $imageable = [
            Product::class,
        ];
        $imageableType = $this->faker->randomElement($imageable);
        $imageable = $imageableType::factory()->create();
    
        return [
            'imageable_type' => $imageableType,
            'imageable_id' => $imageable->id,
        ]; */
        
        $filepath = public_path('storage/images');

        if(!File::exists($filepath)){
            File::makeDirectory($filepath);
        }
        $small = $this->faker->image($filepath,400,300, null, false);
        $large = $this->faker->image($filepath,1200,800, null, false);
        return [
            'small_webp_url' => 'images/'.$small,
            'large_webp_url' => 'images/'.$large,
        ];
    }
}
