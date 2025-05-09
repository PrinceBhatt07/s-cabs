<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payable_type',
        'payable_id',
        'amount',
        'payment_for',
        'payment_status',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
    ];

    public function payable()
    {
        return $this->morphTo();
    }
}
