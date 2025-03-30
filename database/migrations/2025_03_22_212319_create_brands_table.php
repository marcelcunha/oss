<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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
            ['name' => 'Dell', 'categories' => json_encode(['Laptop', 'Desktop'])],
            ['name' => 'Lenovo', 'categories' => json_encode(['Laptop', 'Desktop'])],
            ['name' => 'Acer', 'categories' => json_encode(['Laptop', 'Desktop'])],
            ['name' => 'Asus', 'categories' => json_encode(['Laptop', 'Desktop', 'Placa Mãe', 'GPU'])],
            ['name' => 'Apple', 'categories' => json_encode(['Laptop', 'Desktop'])],
            ['name' => 'Samsung', 'categories' => json_encode(['Laptop', 'Celular', 'Armazenamento'])],
            ['name' => 'Avell', 'categories' => json_encode(['Laptop'])],
            ['name' => 'Compaq', 'categories' => json_encode(['Laptop', 'Desktop'])],
            ['name' => 'HP', 'categories' => json_encode(['Laptop', 'Desktop'])],
            ['name' => 'Intel', 'categories' => json_encode(['CPU', 'GPU'])],
            ['name' => 'AMD', 'categories' => json_encode(['CPU'])],
            ['name' => 'NVIDIA', 'categories' => json_encode(['GPU'])],
            ['name' => 'MSI', 'categories' => json_encode(['GPU'])],
            ['name' => 'Gigabyte', 'categories' => json_encode(['GPU'])],
            ['name' => 'EVGA', 'categories' => json_encode(['GPU'])],
            ['name' => 'ASRock', 'categories' => json_encode(['Placa Mãe'])],
            ['name' => 'Biostar', 'categories' => json_encode(['Placa Mãe'])],
            ['name' => 'Corsair', 'categories' => json_encode(['Memória', 'Armazenamento'])],
            ['name' => 'Kingston', 'categories' => json_encode(['Memória', 'Armazenamento'])],
            ['name' => 'Crucial', 'categories' => json_encode(['Memória', 'Armazenamento'])],
            ['name' => 'Western Digital', 'categories' => json_encode(['Armazenamento'])],
            ['name' => 'Seagate', 'categories' => json_encode(['Armazenamento'])],
            ['name' => 'Toshiba', 'categories' => json_encode(['Armazenamento'])],
            ['name' => 'SanDisk', 'categories' => json_encode(['Armazenamento'])],
            ['name' => 'ADATA', 'categories' => json_encode(['Armazenamento'])],
            ['name' => 'Patriot', 'categories' => json_encode(['Armazenamento'])],
            ['name' => 'ZOTAC', 'categories' => json_encode(['GPU'])],
            ['name' => 'HyperX', 'categories' => json_encode(['Memória', 'Periféricos'])],
            ['name' => 'Cooler Master', 'categories' => json_encode(['Fonte'])],
            ['name' => 'EVGA', 'categories' => json_encode(['Fonte'])],
            ['name' => 'Corsair', 'categories' => json_encode(['Fonte'])],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert($brand);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
