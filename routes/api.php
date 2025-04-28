<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerificationController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/verify-otp', [VerificationController::class, 'verifyOTP']);
Route::post('/resend-otp', [VerificationController::class, 'resendOTP']);
Route::post('/id-proof-upload', [VerificationController::class, 'uploadID']);


Route::middleware('auth:api')->group(function () {

    

    Route::post('/logout', [LoginController::class, 'logout']);
});
