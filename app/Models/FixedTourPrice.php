<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixedTourPrice extends Model
{
    protected $table = 'fixed_tour_prices';

    protected $fillable = [
        'from_place_id',
        'to_place_id',
        'price',
        'car_category_id',
    ];

    public function carCategory()
    {
        return $this->belongsTo(CarCategory::class, 'car_category_id');
    }
}
