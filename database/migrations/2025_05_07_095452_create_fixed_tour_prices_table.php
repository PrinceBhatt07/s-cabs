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
        Schema::create('fixed_tour_prices', function (Blueprint $table) {
            $table->id();
            $table->string('from_place_id');
            $table->string('to_place_id');
            $table->decimal('price', 8, 2)->default(0);
            $table->unsignedBigInteger('car_category_id');
            $table->foreign('car_category_id')->references('id')->on('car_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixed_tour_prices');
    }
};
