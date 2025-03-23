<?php

namespace Database\Seeders;

use App\Models\DeviceType;
use Illuminate\Database\Seeder;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeviceType::insert(
            [
                ['name' => 'Desktop'],
                ['name' => 'Notebook'],
                ['name' => 'Roteador'],
                ['name' => 'Tablet'],
                ['name' => 'Celular'],
            ]
        );
    }
}
