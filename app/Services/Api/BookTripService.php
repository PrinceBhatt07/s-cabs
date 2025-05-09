<?php

namespace App\Services\Api;

use App\Models\TripType;
use App\Models\BookingOrder;
use App\Services\BaseService;
use Razorpay\Api\Api;
use Exception;

class BookTripService extends BaseService
{
    public function bookOneWayTrip($request)
    {
        $tripType = TripType::where('name', 'One Way')->firstOrFail();
        return $this->createBookingWithPayment($request->all(), $tripType->id);
    }

    public function bookRoundTrip($request)
    {
        $tripType = TripType::where('name', 'Round Trip')->firstOrFail();
        return $this->createBookingWithPayment($request->all(), $tripType->id);
    }

    public function bookLocalTrip($request)
    {
        $tripType = TripType::where('name', 'Local Trip')->firstOrFail();
        return $this->createBookingWithPayment($request->all(), $tripType->id);
    }

    protected function createBookingWithPayment(array $data, int $tripTypeId)
    {
        try {
            $data['trip_type_id'] = $tripTypeId;

            $bookOrder = BookingOrder::create($data);

            if (!$bookOrder) {
                return $this->jsonResponse(false, 'Failed to create booking order', [], 500);
            }

            $payableAmount = match ($bookOrder->selected_payment_plan) {
                '25_percent' => $bookOrder->total_price * 0.25,
                '50_percent' => $bookOrder->total_price * 0.5,
                'full_payment' => $bookOrder->total_price,
                default => 0,
            };

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $razorpayOrder = $api->order->create([
                'receipt' => $bookOrder->booking_id,
                'amount' => $payableAmount * 100,
                'currency' => 'INR',
                'payment_capture' => 1
            ]);

            $bookOrder->payments()->create([
                'amount' => $payableAmount,
                'payment_for' => 'booking',
                'payment_status' => 'pending',
                'razorpay_order_id' => $razorpayOrder['id'],
            ]);

            return $this->jsonResponse(true, 'Trip Booked Successfully', [
                'booking' => $bookOrder,
                'razorpay' => [
                    'order_id' => $razorpayOrder['id'],
                    'amount' => $payableAmount,
                    'currency' => 'INR',
                    'key' => env('RAZORPAY_KEY'),
                ]
            ], 200);
        } catch (Exception $e) {
            return $this->jsonResponse(false, $e->getMessage(), [], 500);
        }
    }
}
