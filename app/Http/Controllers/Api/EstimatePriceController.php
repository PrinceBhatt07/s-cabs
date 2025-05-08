<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstimateRoundTripRequest;
use App\Http\Requests\GetOneWayPriceRequest;
use App\Services\Api\EstimateTripCostService;
use Exception;
use Illuminate\Http\Request;

class EstimatePriceController extends Controller
{
    public function getOneWayPrice(GetOneWayPriceRequest $request)
    {
       return (new EstimateTripCostService())->getOneWayPrice($request);
    }

    public function getRoundTripPrice(EstimateRoundTripRequest $request)
    {
        return (new EstimateTripCostService())->getRoundTripPrice($request);
    }
}
