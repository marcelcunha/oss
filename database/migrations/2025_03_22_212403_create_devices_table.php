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
        Schema::dropIfExists('devices');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('type', 30);
            $table->string('model', 50)->nullable();
            $table->string('serial_number', 50)->nullable();
            $table->string('service_tag', 30)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('brand_id')->constrained('brands');
            $table->foreignId('client_id')->constrained('clients');
            $table->timestamps();
        });
    }
};
