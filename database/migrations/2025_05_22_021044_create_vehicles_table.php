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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('code', 100);
            $table->string('plate', 20);
            $table->integer('year');
            $table->integer('load_capacity');
            $table->text('description')->nullable();
            $table->integer('status');

            // modelo
            $table->foreignId('model_id')->constrained('brandmodels')->onDelete('restrict');
            // marca
            $table->foreignId('brand_id')->constrained('brands')->onDelete('restrict');
            // tipo
            $table->foreignId('type_id')->constrained('vehiclestypes')->onDelete('restrict');
            // color
            $table->foreignId('color_id')->constrained('colors')->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
