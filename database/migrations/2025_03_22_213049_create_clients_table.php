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
        Schema::dropIfExists('clients');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('phone', 16)->nullable();
            $table->string('address', 60)->nullable();
            $table->unsignedSmallInteger('num')->nullable();
            $table->string('complement', 60)->nullable();
            $table->timestamps();
        });
    }
};
