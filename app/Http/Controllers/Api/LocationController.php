<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function searchPlace(Request $request)
    {
        return (new LocationService())->searchPlace($request);
    }

    public function selectPlace(Request $request)
    {
        return (new LocationService())->selectPlace($request);
    }
}
