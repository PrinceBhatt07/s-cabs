<?php

namespace App\Services\Api;

use App\Http\Resources\EstimateTourPriceResource;
use App\Models\CarCategory;
use App\Models\FixedTourPrice;
use App\Services\BaseService;
use Illuminate\Support\Facades\Http;
use Exception;

class EstimateTripCostService extends BaseService
{
    public function getOneWayPrice($request)
    {
        try {
            $fromPlaceId = $request->input('from_place_id');
            $toPlaceId = $request->input('to_place_id');
            $pickupDate = $request->input('pickup_date');
            $pickupTime = $request->input('pickup_time');

            $calculatedDistance = $this->calculateDistance($fromPlaceId, $toPlaceId);
            $fixedPrices = $this->checkFixedPrice($fromPlaceId, $toPlaceId);

            $getfromPlaceDetails =  (new LocationService())->getPlaceDetails($fromPlaceId);
            $getfromPlaceName =  $getfromPlaceDetails->json()['result']['formatted_address'] ?? '';
            $getFromPlaceLattitude =  $getfromPlaceDetails->json()['result']['geometry']['location']['lat'] ?? '';
            $getFromPlaceLongitude =  $getfromPlaceDetails->json()['result']['geometry']['location']['lng'] ?? '';

            $getToPlaceDetails =  (new LocationService())->getPlaceDetails($toPlaceId);
            $getToPlaceName =  $getToPlaceDetails->json()['result']['formatted_address'] ?? '';
            $getToPlaceLattitude =  $getToPlaceDetails->json()['result']['geometry']['location']['lat'] ?? '';
            $getToPlaceLongitude =  $getToPlaceDetails->json()['result']['geometry']['location']['lng'] ?? '';

            $fixedPrices->map(function ($item) use ($getfromPlaceName, $getToPlaceName , $getFromPlaceLattitude, $getFromPlaceLongitude, $getToPlaceLattitude, $getToPlaceLongitude) {
                $item->from_place_lattitude = $getFromPlaceLattitude;
                $item->from_place_longitude = $getFromPlaceLongitude;
                $item->to_place_lattitude = $getToPlaceLattitude;
                $item->to_place_longitude = $getToPlaceLongitude;
                $item->trip_type = 'one_way';
                $item->from_place_name = $getfromPlaceName;
                $item->to_place_name = $getToPlaceName;
                return $item;
            });


            if ($fixedPrices->isNotEmpty()) {
                $resources = $fixedPrices->map(function ($item) use ($pickupDate, $pickupTime, $calculatedDistance) {
                    return new EstimateTourPriceResource($item, $pickupDate, $pickupTime, $calculatedDistance);
                });
                return $this->jsonResponse(true, 'Fixed price found for one way', $resources);
            } else {
                return $this->jsonResponse(false, 'No fixed price found for this route', []);
            }
        } catch (Exception $e) {
            return $this->jsonResponse(false, $e->getMessage(), [], 500);
        }
    }

    public function calculateDistance($originPlaceId, $destinationPlaceId)
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json';

        $response = Http::get($url, [
            'origins' => "place_id:$originPlaceId",
            'destinations' => "place_id:$destinationPlaceId",
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (
                isset($data['rows'][0]['elements'][0]['status']) &&
                $data['rows'][0]['elements'][0]['status'] === 'OK'
            ) {
                return [
                    'distance_text' => $data['rows'][0]['elements'][0]['distance']['text'],
                    'distance_meters' => $data['rows'][0]['elements'][0]['distance']['value'],
                    'duration' => $data['rows'][0]['elements'][0]['duration']['text'],
                ];
            } else {
                return ['error' => 'No route found.'];
            }
        }

        return ['error' => 'API request failed.'];
    }

    public function checkFixedPrice($fromPlaceId, $toPlaceId)
    {
        return FixedTourPrice::where('from_place_id', $fromPlaceId)
            ->where('to_place_id', $toPlaceId)
            ->with('carCategory')
            ->get();
    }

    public function getRoundTripPrice($request)
    {
        try {
            $fromPlaceId = $request->input('from_place_id');
            $toPlaceId = $request->input('to_place_id');
            $pickupDate = $request->input('pickup_date');
            $pickupTime = $request->input('pickup_time');
            $returnDate = $request->input('return_date');


            $calculatedDistance = $this->calculateDistance($fromPlaceId, $toPlaceId);
            $calculatedDistance['distance_meters'] *= 2;

            preg_match('/([\d,.]+)\s*km/', $calculatedDistance['distance_text'], $matches);
            if (isset($matches[1])) {
                $numericDistance = floatval(str_replace(',', '', $matches[1]));
                $doubledDistance = $numericDistance * 2;
                $calculatedDistance['distance_text'] = round($doubledDistance) . ' km';
            }
            $durationString = $calculatedDistance['duration'];
            $totalMinutes = 0;
            if (preg_match('/(\d+)\s*hour/', $durationString, $hoursMatch)) {
                $totalMinutes += intval($hoursMatch[1]) * 60;
            }
            if (preg_match('/(\d+)\s*min/', $durationString, $minsMatch)) {
                $totalMinutes += intval($minsMatch[1]);
            }
            $totalMinutes *= 2;
            $hours = intdiv($totalMinutes, 60);
            $minutes = $totalMinutes % 60;
            $durationParts = [];
            if ($hours > 0) {
                $durationParts[] = $hours . ' hours';
            }
            if ($minutes > 0) {
                $durationParts[] = $minutes . ' min';
            }
            $calculatedDistance['duration'] = implode(' ', $durationParts);

            $getAllCars = $this->getAllCars();
            $getfromPlaceDetails =  (new LocationService())->getPlaceDetails($fromPlaceId);
            $getfromPlaceName =  $getfromPlaceDetails->json()['result']['formatted_address'] ?? '';
            $getFromPlaceLattitude =  $getfromPlaceDetails->json()['result']['geometry']['location']['lat'] ?? '';
            $getFromPlaceLongitude =  $getfromPlaceDetails->json()['result']['geometry']['location']['lng'] ?? '';

            $getToPlaceDetails =  (new LocationService())->getPlaceDetails($toPlaceId);
            $getToPlaceName =  $getToPlaceDetails->json()['result']['formatted_address'] ?? '';
            $getToPlaceLattitude =  $getToPlaceDetails->json()['result']['geometry']['location']['lat'] ?? '';
            $getToPlaceLongitude =  $getToPlaceDetails->json()['result']['geometry']['location']['lng'] ?? '';
 
            $getAllCars->map(function ($item) use ($fromPlaceId, $toPlaceId, $returnDate ,$calculatedDistance , $getfromPlaceName , $getToPlaceName , $getFromPlaceLattitude, $getFromPlaceLongitude, $getToPlaceLattitude, $getToPlaceLongitude) {
                $item->price = $item->price_per_km * $calculatedDistance['distance_meters'] / 1000;
                $item->from_place_id = $fromPlaceId;
                $item->to_place_id = $toPlaceId;
                $item->return_date = $returnDate;
                $item->trip_type = 'round_trip';
                $item->from_place_name = $getfromPlaceName;
                $item->to_place_name = $getToPlaceName;
                $item->from_place_lattitude = $getFromPlaceLattitude;
                $item->from_place_longitude = $getFromPlaceLongitude;
                $item->to_place_lattitude = $getToPlaceLattitude;
                $item->to_place_longitude = $getToPlaceLongitude;
                return $item;
            });

            $resources = $getAllCars->map(function ($item) use ($pickupDate, $pickupTime, $returnDate, $calculatedDistance) {
                return new EstimateTourPriceResource($item, $pickupDate, $pickupTime,  $calculatedDistance , $returnDate);
            });

            return $this->jsonResponse(true, 'Estimate price for round trip', $resources);

        } catch (Exception $e) {
            return $this->jsonResponse(false, $e->getMessage(), [], 500);
        }
    }

    public function getAllCars()
    {
        return CarCategory::get();
    }

    public function getLocalTripPrice($request)
    {
        try {
            $fromPlaceId = $request->input('from_place_id');
            $pickupDate = $request->input('pickup_date');
            $pickupTime = $request->input('pickup_time');
            $totalHours = $request->input('total_hours');
            $totalKm = $request->input('total_km');

            $getAllCars = $this->getAllCars();

            $calculatedDistance = [
                'distance_text' => $totalKm . ' km',
                'distance_meters' => $totalKm * 1000,
                'duration' => $totalHours . ' hours',
            ];

            $getfromPlaceDetails =  (new LocationService())->getPlaceDetails($fromPlaceId);
            $getfromPlaceName =  $getfromPlaceDetails->json()['result']['formatted_address'] ?? '';
            $getFromPlaceLattitude =  $getfromPlaceDetails->json()['result']['geometry']['location']['lat'] ?? '';
            $getFromPlaceLongitude =  $getfromPlaceDetails->json()['result']['geometry']['location']['lng'] ?? '';

 
            $getAllCars->map(function ($item) use ($fromPlaceId ,$totalHours,$getfromPlaceName , $getFromPlaceLattitude, $getFromPlaceLongitude) {
                $item->price = ($item->price_per_hour * $totalHours);
                $item->from_place_id = $fromPlaceId;
                $item->trip_type = 'local_trip';
                $item->from_place_name = $getfromPlaceName;
                $item->from_place_lattitude = $getFromPlaceLattitude;
                $item->from_place_longitude = $getFromPlaceLongitude;
                return $item;
            });

            $resources = $getAllCars->map(function ($item) use ($pickupDate, $pickupTime,  $calculatedDistance) {
                return new EstimateTourPriceResource($item, $pickupDate, $pickupTime,  $calculatedDistance);
            });

            return $this->jsonResponse(true, 'Estimate price for local trip', $resources);

        } catch (Exception $e) {
            return $this->jsonResponse(false, 'Error: ' . $e->getMessage(), [], 500);
        }
    }
}
