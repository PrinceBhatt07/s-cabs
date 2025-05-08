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
        Schema::create('car_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->decimal('chauffer_price', 8, 2)->default(0);
            $table->decimal('diesel_car_price', 8, 2)->default(0);
            $table->decimal('luggage_carrier_price', 8, 2)->default(0);
            $table->decimal('new_model_car_price', 8, 2)->default(0);
            $table->decimal('price_per_km', 8, 2)->default(0);
            $table->decimal('price_per_hour', 8, 2)->default(0);
            $table->unsignedTinyInteger('no_of_seats')->default(0);
            $table->unsignedInteger('luggage_capacity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_categories');
    }
};
