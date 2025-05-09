<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookOneWayTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'from_place_id' => ['required', 'string'],
            'from_place_name' => ['required', 'string'],
            "from_place_lattitude" => [ 'required', 'numeric'],
            "from_place_longitude" => [ 'required', 'numeric'],
            'to_place_id' => ['required', 'string'],
            'to_place_name' => ['required', 'string'],
            "to_place_lattitude" => [ 'required', 'numeric'],
            "to_place_longitude" => [ 'required', 'numeric'],
            'pickup_date' => ['required', 'date_format:Y-m-d'],
            'pickup_time' => ['required', 'date_format:H:i'],
            'car_category_id' => ['required', 'integer' , 'exists:car_categories,id'],
            'is_chauffer_price_included' => ['required', 'boolean'],
            'is_diesel_car_price_included' => ['required', 'boolean'],
            'is_luggage_carrier_price_included' => ['required', 'boolean'],
            'is_new_model_car_price_included' => ['required', 'boolean'],
            'total_distance' => ['required', 'integer', 'min:1'],
            'total_price' => ['required', 'integer', 'min:1'],
            'pickup_locations' => ['required', 'array' , 'min:1'],
            'drop_locations' => ['required', 'array' , 'min:1'],
            'selected_payment_plan' => ['required', 'string', 'in:25_percent,50_percent,full_payment,cash_on_completion'],
        ];
    }

    public function messages()
    {
        return [
            'from_place_id.required' => 'From Place ID is required',
            'to_place_id.required' => 'To Place ID is required',
            'pickup_date.required' => 'Pickup Date is required',
            'pickup_time.required' => 'Pickup Time is required',
            'car_category_id.required' => 'Car Category ID is required',
            'is_chauffer_price_included.required' => 'Is Chauffer Price Included is required',
            'is_diesel_car_price_included.required' => 'Is Diesel Car Price Included is required',
            'is_luggage_carrier_price_included.required' => 'Is Luggage Carrier Price Included is required',
            'is_new_model_car_price_included.required' => 'Is New Model Car Price Included is required',
            'total_distance.required' => 'Total Distance is required',
            'total_price.required' => 'Total Price is required',
            'pickup_location_place_ids.required' => 'Pickup Location Place IDs is required',
            'drop_location_place_ids.required' => 'Drop Location Place IDs is required',
            'selected_payment_plan.required' => 'Selected Payment Plan is required',
            'selected_payment_plan.in' => 'Selected Payment Plan is invalid choose from 25_percent,50_percent,full_payment,cash_on_completion',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation Error',
            'errors' => $validator->errors(),
        ], 422));
    }
}
