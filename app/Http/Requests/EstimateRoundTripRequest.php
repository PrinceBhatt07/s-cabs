<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EstimateRoundTripRequest extends FormRequest
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
    public function rules()
    {
        return [
            'from_place_id' => ['required', 'string'],
            'to_place_id' => ['required', 'string'],
            'pickup_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:today',
                'before_or_equal:return_date',
            ],
            'return_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:pickup_date',
            ],
            'pickup_time' => ['required', 'date_format:H:i'],
        ];
    }

    public function messages()
    {
        return [
            'pickup_date.after_or_equal' => 'Pickup date must be today or later.',
            'pickup_date.before_or_equal' => 'Pickup date must be on or before the return date.',
            'return_date.after_or_equal' => 'Return date must be after or equal to pickup date.',
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
