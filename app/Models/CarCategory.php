<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarCategory extends Model
{
    protected $table = 'car_categories';

    protected $fillable = [
        'name',
        'image',
        'chauffer_price',
        'diesel_car_price',
        'luggage_carrier_price',
        'new_model_car_price',
        'price_per_km',
        'price_per_hour',
        'no_of_seats', 
        'luggage_capacity',
    ];



}
