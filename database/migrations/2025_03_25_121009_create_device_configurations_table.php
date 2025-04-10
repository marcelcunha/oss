<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_configurations');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('device_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('os', 30);
            $table->json('cpu', 30);
            $table->json('mobo', 30)->nullable();
            $table->json('memory')->nullable();
            $table->json('storage')->nullable();
            $table->json('gpu')->nullable();
            $table->json('power_supply')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('device_id')->constrained();
            $table->foreignId('checkin_id')->constrained();
            $table->timestamps();
        });
    }
};
