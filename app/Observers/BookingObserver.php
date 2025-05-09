<?php

namespace App\Observers;

use App\Models\BookingOrder;
use Illuminate\Support\Str;

class BookingObserver
{
    public function creating(BookingOrder $booking)
    {
        do {
            $bookingId = 'BO-' . strtoupper(Str::random(7));
        } while (BookingOrder::where('booking_id', $bookingId)->exists());

        $booking->booking_id = $bookingId;
    }
}
