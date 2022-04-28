<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::factory()->has(
            Image::factory()->count(1)
        )->create([
            'name' => 'Mercado Pago',
            'code' => 'MP',
            'active' => true,
        ]);
        PaymentMethod::factory()->has(
            Image::factory()->count(1)
        )->create([
            'name' => 'Efectivo',
            'code' => 'CASH',
            'active' => true,
        ]);
    }
}
