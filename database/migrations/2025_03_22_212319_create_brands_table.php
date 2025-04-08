<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->json('categories')->nullable();
            $table->timestamps();
        });

        $brands = [
            ['name' => 'Dell', 'categories' => json_encode(['laptop', 'desktop'])],
            ['name' => 'Lenovo', 'categories' => json_encode(['laptop', 'desktop'])],
            ['name' => 'Acer', 'categories' => json_encode(['laptop', 'desktop'])],
            ['name' => 'Asus', 'categories' => json_encode(['laptop', 'desktop', 'mobo', 'gpu'])],
            ['name' => 'Apple', 'categories' => json_encode(['laptop', 'desktop'])],
            ['name' => 'Samsung', 'categories' => json_encode(['laptop', 'storage'])],
            ['name' => 'Avell', 'categories' => json_encode(['laptop'])],
            ['name' => 'Compaq', 'categories' => json_encode(['laptop', 'desktop'])],
            ['name' => 'HP', 'categories' => json_encode(['laptop', 'desktop'])],
            ['name' => 'Intel', 'categories' => json_encode(['cpu', 'gpu'])],
            ['name' => 'AMD', 'categories' => json_encode(['cpu'])],
            ['name' => 'NVIDIA', 'categories' => json_encode(['gpu'])],
            ['name' => 'MSI', 'categories' => json_encode(['gpu'])],
            ['name' => 'Gigabyte', 'categories' => json_encode(['gpu', 'mobo'])],
            ['name' => 'EVGA', 'categories' => json_encode(['gpu', 'psuply'])],
            ['name' => 'ASRock', 'categories' => json_encode(['mobo'])],
            ['name' => 'Biostar', 'categories' => json_encode(['mobo'])],
            ['name' => 'Corsair', 'categories' => json_encode(['ram', 'storage'])],
            ['name' => 'Kingston', 'categories' => json_encode(['ram', 'storage'])],
            ['name' => 'Crucial', 'categories' => json_encode(['ram', 'storage'])],
            ['name' => 'Western Digital', 'categories' => json_encode(['storage'])],
            ['name' => 'Seagate', 'categories' => json_encode(['storage'])],
            ['name' => 'Toshiba', 'categories' => json_encode(['storage'])],
            ['name' => 'SanDisk', 'categories' => json_encode(['storage'])],
            ['name' => 'ADATA', 'categories' => json_encode(['storage'])],
            ['name' => 'Patriot', 'categories' => json_encode(['storage'])],
            ['name' => 'ZOTAC', 'categories' => json_encode(['gpu'])],
            ['name' => 'HyperX', 'categories' => json_encode(['ram'])],
            ['name' => 'Cooler Master', 'categories' => json_encode(['psuply'])],
            ['name' => 'Corsair', 'categories' => json_encode(['psuply'])],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert($brand);
        }
    }
};
