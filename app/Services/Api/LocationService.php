<?php

namespace App\Services\Api;

use App\Services\BaseService;
use Illuminate\Support\Facades\Http;

class LocationService extends BaseService
{
    public function searchPlace($request)
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/place/autocomplete/json', [
            'input' =>$request->query('query'),
            'key' => env('GOOGLE_MAPS_API_KEY'),
        ]);
    
        if ($response->successful()) {
            $predictions = $response->json()['predictions'];

            $places = array_map(function ($place) {
                return [
                    'description' => $place['description'] ?? '',
                    'place_id' => $place['place_id'] ?? '',
                ];
            }, $predictions);
    
    
            return $this->jsonResponse(true, 'Places fetched successfully', $places);
        }
    
        return $this->jsonResponse(false, 'Unable to fetch places');
    }

    public function selectPlace($request)
    {
        $placeId = $request->input('place_id');
        if (!$placeId) {
            return $this->jsonResponse(false, 'Place ID is required');
        }
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'place_id' => $placeId,
            'key' => env('GOOGLE_MAPS_API_KEY'),
        ]);

        if ($response->successful()) {
            $locationData = $response->json();

            return $this->jsonResponse(true, 'Location data fetched successfully', $locationData);
        }

        return $this->jsonResponse(false, 'Unable to fetch location data');
    }
}