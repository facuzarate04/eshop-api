<?php

namespace Database\Seeders;

use App\Models\DeliveryMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $domicilio = DeliveryMethod::create([
            'name' => 'Envío a domicilio',
            'code' => 'CAR',
            'active' => true,
        ]);
        $local = DeliveryMethod::create([
            'name' => 'Retiro en el local',
            'code' => 'LOCAL',
            'active' => true,
        ]);
    }
}
