<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('device_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('os', 30);
            $table->string('mobo_brand', 30)->nullable();
            $table->string('mobo_model', 30)->nullable();
            $table->string('cpu_brand', 30);
            $table->string('cpu_model', 30);
            $table->string('ram_brand', 30)->nullable();
            $table->string('ram_model', 30)->nullable();
            $table->unsignedSmallInteger('ram_capacity')->nullable();
            $table->string('gpu_brand', 30)->nullable();
            $table->string('gpu_model', 30)->nullable();
            $table->string('storage1_brand', 30)->nullable();
            $table->string('storage1_model', 30)->nullable();
            $table->unsignedSmallInteger('storage1_capacity')->nullable();
            $table->string('storage2_brand', 30)->nullable();
            $table->string('storage2_model', 30)->nullable();
            $table->unsignedSmallInteger('storage2_capacity')->nullable();
            $table->string('storage3_brand', 30)->nullable();
            $table->string('storage3_model', 30)->nullable();
            $table->unsignedSmallInteger('storage3_capacity')->nullable();
            $table->string('storage4_brand', 30)->nullable();
            $table->string('storage4_model', 30)->nullable();
            $table->unsignedSmallInteger('storage4_capacity')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_configurations');
    }
};
