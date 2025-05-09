<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingOrder extends Model
{
    protected $fillable = [
        'booking_id',
        'trip_type_id',
        'from_place_id',
        'from_place_name',
        'from_place_lattitude',
        'from_place_longitude',
        'to_place_lattitude',
        'to_place_longitude',
        'to_place_id',
        'to_place_name',
        'pickup_date',
        'pickup_time',
        'return_date',
        'car_category_id',
        'is_chauffer_price_included',
        'is_diesel_car_price_included',
        'is_luggage_carrier_price_included',
        'is_new_model_car_price_included',
        'total_distance',
        'total_price',
        'pickup_locations',
        'drop_locations',
        'selected_payment_plan',
    ];

    protected $casts = [
        'pickup_locations' => 'array',
        'drop_locations' => 'array',
        'pickup_date' => 'date',
        'return_date' => 'date',
        'pickup_time' => 'datetime:H:i',
        'is_chauffer_price_included' => 'boolean',
        'is_diesel_car_price_included' => 'boolean',
        'is_luggage_carrier_price_included' => 'boolean',
        'is_new_model_car_price_included' => 'boolean',
    ];

    public function tripType()
    {
        return $this->belongsTo(TripType::class);
    }

    public function carCategory()
    {
        return $this->belongsTo(CarCategory::class);
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }
}
