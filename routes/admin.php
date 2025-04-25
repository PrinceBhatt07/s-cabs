<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/customers', [AdminController::class, 'index'])->name('admin.customers');
    Route::post('/customers/{user}/approve-id', [AdminController::class, 'approveID'])->name('admin.approve.id');
    Route::post('/customers/{user}/reject-id', [AdminController::class, 'rejectID'])->name('admin.reject.id');

    Route::get('/drivers', [AdminController::class, 'drivers'])->name('admin.drivers');
    Route::post('/drivers/{user}/approve', [AdminController::class, 'approveDriver'])->name('admin.driver.approve');
    Route::post('/drivers/{user}/reject', [AdminController::class, 'rejectDriver'])->name('admin.driver.reject');
});