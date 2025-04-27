<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', [AdminController::class, 'login'])->name('login');
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::get('/cars', [AdminController::class, 'cars'])->name('cars');
Route::get('/drivers', [AdminController::class, 'drivers'])->name('drivers');
Route::get('/drivers-requests', [AdminController::class, 'driversRequests'])->name('drivers-requests');
Route::get('/tour-pricing', [AdminController::class, 'tourPricing'])->name('tour-pricing');
Route::get('/trip-categories', [AdminController::class, 'tripCategories'])->name('trip-categories');
Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
Route::get('/transactions', [AdminController::class, 'transactions'])->name('transactions');
Route::get('/verify-payments', [AdminController::class, 'verifyPayments'])->name('verify-payments');