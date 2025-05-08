<?php

namespace App\Services\Api;

use App\Services\BaseService;
use Exception;

class BookTripService extends BaseService
{
    public function bookOneWayTrip($request)
    {
        try{
            
        }
        catch(Exception $e)
        {
            return $this->jsonResponse(false, $e->getMessage(), [], 500);
        }
    }
}
