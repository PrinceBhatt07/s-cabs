<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookOneWayTripRequest;
use App\Services\Api\BookTripService;
use Illuminate\Http\Request;

class BookTripController extends Controller
{
    public function bookOneWayTrip(BookOneWayTripRequest $request)
    {
        return (new BookTripService())->bookOneWayTrip($request);
    }

    public function bookRoundTrip(Request $request)
    {
        // Logic to book a round trip
        return response()->json(['message' => 'Round trip booked successfully']);
    }

    public function bookLocalTrip(Request $request)
    {
        // Logic to book a local trip
        return response()->json(['message' => 'Local trip booked successfully']);
    }
}
