<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    protected $table = 'places';

    protected $fillable = [
        'name',
        'state_id',
        'latitude',
        'longitude',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
