<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';

    protected $fillable = [
        'car_category_id',
        'car_number',
        'car_manfacturing_year',
        'car_front_image',
        'car_back_image',
    ];

    public function carCategory()
    {
        return $this->belongsTo(CarCategory::class, 'car_category_id');
    }
}
