<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class UploadCustomerIDRequest extends FormRequest
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
            'customer_id' => ['required', 'string', 'exists:users,id'],
            'id_type' => ['required', 'string', 'in:passport,driver_license,adhar_card,pan_card'],
            'id_image' => ['required', 'file', 'mimes:jpeg,png,jpg,webp,pdf', 'max:2048'],
            'fcm_token' => ['required', 'string'],
        ];
    }
    

    protected function failedValidation(Validator $validator)
    {

        if($validator->errors()->has('id_type')) {
            $validator->errors()->add('id_type', 'Select a valid ID type like passport, driver_license, adhar_card or pan_card.');
        }

        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation Error',
            'errors' => $validator->errors(),
        ], 422));
    }
}
