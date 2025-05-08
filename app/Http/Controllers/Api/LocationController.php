<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NearByPlaceRequest;
use App\Services\Api\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function searchPlace(Request $request)
    {
        return (new LocationService())->searchPlace($request);
    }

    public function getNearbyPlaces(NearByPlaceRequest $request)
    {
        return (new LocationService())->getNearbyPlaces($request);
    }
}
