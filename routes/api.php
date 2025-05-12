<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerificationController;
use App\Http\Controllers\Api\BookTripController;
use App\Http\Controllers\Api\EstimatePriceController;
use App\Http\Controllers\Api\LocationController;
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
    
    Route::get('/location/search', [LocationController::class, 'searchPlace']);
    Route::get('/nearby-places', [LocationController::class, 'getNearbyPlaces']);
    
    Route::post('/get-one-way-price', [EstimatePriceController::class, 'getOneWayPrice']);
    Route::post('/get-round-trip-price', [EstimatePriceController::class, 'getRoundTripPrice']);
    Route::post('/get-local-trip-price', [EstimatePriceController::class, 'getLocalTripPrice']);
    
    Route::post('/book-one-way-trip', [BookTripController::class, 'bookOneWayTrip']);
    Route::post('/book-round-trip', [BookTripController::class, 'bookRoundTrip']);
    Route::post('/book-local-trip', [BookTripController::class, 'bookLocalTrip']);

    

    Route::post('/logout', [LoginController::class, 'logout']);
});
