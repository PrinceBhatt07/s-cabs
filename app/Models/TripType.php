<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripType extends Model
{
    protected $table = 'trip_types';

    protected $fillable = ['name' , 'slug'];
}
