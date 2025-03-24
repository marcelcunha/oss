<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::insert([
            ['name' => 'Dell'],
            ['name' => 'Samsung'],
            ['name' => 'Acer'],
            ['name' => 'Asus'],
            ['name' => 'TP-Link'],
            ['name' => 'Genérico'],
            ['name' => 'Apple'],
            ['name' => 'HP'],
            ['name' => 'Avell'],
            ['name' => 'Compaq'],
            ['name' => 'Lenovo'],
        ]);
    }
}
