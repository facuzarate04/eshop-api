<?php

namespace Database\Seeders;

use App\Models\StatusOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusOrder::create([
            'name' => 'PENDING',
            'code' => '0',
            'reason' => 'Pendiente de pago'
        ]);

        StatusOrder::create([
            'name' => 'PROCESSING',
            'code' => '1',
            'reason' => 'En preparación'
        ]);

        StatusOrder::create([
            'name' => 'DELIVERED',
            'code' => '2',
            'reason' => 'Emntregada'
        ]);

        StatusOrder::create([
            'name' => 'CANCELLED',
            'code' => '3',
            'reason' => 'Falta de stock'
        ]);
    }
}
