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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_category_id');
            $table->string('car_number');
            $table->year('car_manfacturing_year')->nullable();
            $table->string('car_front_image')->nullable();
            $table->string('car_back_image')->nullable();
            $table->timestamps();

            $table->foreign('car_category_id')->references('id')->on('car_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
