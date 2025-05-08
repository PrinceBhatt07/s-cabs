<?php

namespace App\Services\Api;

use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Http;

class LocationService extends BaseService
{
    public function searchPlace($request)
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/place/autocomplete/json', [
            'input' => $request->query('query'),
            'components' => 'country:in',
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

    public function getNearbyPlaces($request)
    {

        try {

            $apiKey = env('GOOGLE_MAPS_API_KEY');
            $placeId = $request->place_id;
            $query = strtolower(trim($request['query']));

            $detailsResponse = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
                'place_id' => $placeId,
                'key' => $apiKey,
            ]);

            if ($detailsResponse->failed() || !isset($detailsResponse['result']['geometry']['location'])) {
                return $this->jsonResponse(false, 'Invalid place_id or unable to get location', [], 400);
            }

            $addressComponents = $detailsResponse['result']['address_components'] ?? [];

            $city = null;
            $state = null;

            foreach ($addressComponents as $component) {
                if (in_array('locality', $component['types'])) {
                    $city = $component['long_name'];
                }

                if (in_array('administrative_area_level_1', $component['types'])) {
                    $state = $component['long_name'];
                }
            }


            $textSearchResponse = Http::get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
                'query' => $query . ' in ' . $city . ',' . $state,
                'key' => $apiKey,
            ]);
            if ($textSearchResponse->failed()) {
                return response()->json(['status' => false,'message' => 'Failed to fetch nearby places'], 500);
            }
    
            $places = $textSearchResponse->json();

            $filteredPlaces = collect($places['results'])
            ->map(function ($place) use ($city, $state) {
                return [
                    'name' => $place['name'] . ', ' . $city . ', ' . $state,
                    'place_id' => $place['place_id'],
                    'location' => $place['geometry']['location'] ?? null,
                ];
            })
            ->values();
        
            return response()->json(['status' => true,'message' => 'Nearby places found','places' => $filteredPlaces]);
        } catch (Exception $e) {
            return $this->jsonResponse(false, $e->getMessage(), [], 500);
        }
    }
}
