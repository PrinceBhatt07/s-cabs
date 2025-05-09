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
        Schema::create('booking_orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('booking_id')->unique();
            $table->unsignedBigInteger('trip_type_id');
            $table->foreign('trip_type_id')->references('id')->on('trip_types')->onDelete('cascade');
            $table->string('from_place_id');
            $table->string('from_place_name');
            $table->string('from_place_lattitude')->nullable();
            $table->string('from_place_longitude')->nullable();
            $table->string('to_place_lattitude')->nullable();
            $table->string('to_place_longitude')->nullable();
            $table->string('to_place_id')->nullable();
            $table->string('to_place_name')->nullable();
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->date('return_date')->nullable();
            $table->unsignedBigInteger('car_category_id');
            $table->foreign('car_category_id')->references('id')->on('car_categories')->onDelete('cascade');
            $table->boolean('is_chauffer_price_included')->default(false);
            $table->boolean('is_diesel_car_price_included')->default(false);
            $table->boolean('is_luggage_carrier_price_included')->default(false);
            $table->boolean('is_new_model_car_price_included')->default(false);
            $table->string('total_distance');
            $table->decimal('total_price', 10, 2);
            $table->json('pickup_locations')->nullable();
            $table->json('drop_locations')->nullable();
            $table->enum('selected_payment_plan',['25_percent','50_percent','full_payment','cash_on_completion']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_orders');
    }
};
