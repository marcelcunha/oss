<?php

namespace Database\Seeders;

use App\Models\Checkin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CheckinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Checkin::factory()
            ->count(15)
            ->create();
    }
}
