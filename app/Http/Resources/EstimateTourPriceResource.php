<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EstimateTourPriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    protected $pickupDate;
    protected $pickupTime;
    protected $calculatedDistance;
    protected $returnDate;

    public function __construct($resource, $pickupDate = null, $pickupTime = null , $calculatedDistance = null , $returnDate = null)

    {
        parent::__construct($resource);
        $this->pickupDate = $pickupDate;
        $this->pickupTime = $pickupTime;
        $this->calculatedDistance = $calculatedDistance;
        $this->returnDate = $returnDate;
    }

    public function toArray(Request $request): array
    {
        return [
            "from_place_id"=> $this->from_place_id,
            "to_place_id"=> $this->to_place_id ?? null,
            "pickupDate"=> $this->pickupDate,
            "pickupTime"=> $this->pickupTime,
            "returnDate"=> $this->returnDate ?? null,
            "trip_type"=> $this->trip_type,
            "total_distance"=> $this->calculatedDistance['distance_text'],
            "total_distance_meters"=> $this->calculatedDistance['distance_meters'],
            "total_duration"=> $this->calculatedDistance['duration'],
            "price"=> $this->price,
            "car_category_id"=> $this->car_category_id ?? $this->id,
            "name"=> $this->carCategory->name ?? $this->name,
            "image"=> $this->carCategory->image ?? $this->image,
            "chauffer_price"=> $this->carCategory->chauffer_price ?? $this->chauffer_price,
            "diesel_car_price"=> $this->carCategory->diesel_car_price ?? $this->diesel_car_price,
            "luggage_carrier_price"=> $this->carCategory->luggage_carrier_price ?? $this->luggage_carrier_price,
            "new_model_car_price"=> $this->carCategory->new_model_car_price ?? $this->new_model_car_price,
            "price_per_km"=> $this->carCategory->price_per_km ?? $this->price_per_km,
            "price_per_hour"=> $this->carCategory->price_per_hour ?? $this->price_per_hour,
            "price_per_location"=> $this->carCategory->price_per_location ?? $this->price_per_location,
            "no_of_seats"=> $this->carCategory->no_of_seats ?? $this->no_of_seats,
            "luggage_capacity"=> $this->carCategory->luggage_capacity ?? $this->luggage_capacity,
        ];
    }
}
