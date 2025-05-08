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
            'to_place_id' => ['required', 'string'],
            'pickup_date' => ['required', 'date_format:Y-m-d'],
            'pickup_time' => ['required', 'date_format:H:i'],
            'car_category_id' => ['required', 'integer' , 'exists:car_categories,id'],
            'is_chauffer_price_included' => ['required', 'boolean'],
            'is_diesel_car_price_included' => ['required', 'boolean'],
            'is_luggage_carrier_price_included' => ['required', 'boolean'],
            'is_new_model_car_price_included' => ['required', 'boolean'],
            'total_distance' => ['required', 'integer', 'min:1'],
            'total_price' => ['required', 'integer', 'min:1'],
            'pickup_location_place_ids' => ['required', 'array' , 'min:1'],
            'drop_location_place_ids' => ['required', 'array' , 'min:1'],
            'selected_payment_plan' => ['required', 'string', 'in:25_percent,50_percent,full_payment,cash_on_completion'],
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
