<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class BaseService 
{
    public function jsonResponse($success , $message , $data = null , $code = 200) : JsonResponse
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}