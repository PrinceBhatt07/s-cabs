<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.pages.login');
    }

    public function index()
    {
        return view('admin.pages.dashboard');
    }

    public function cars()
    {
        return view('admin.pages.cars.index');
    }

    public function drivers()
    {
        return view('admin.pages.drivers.index');
    }

    public function driversRequests()
    {
        return view('admin.pages.driver-requests');
    }

    public function tourPricing()
    {
        return view('admin.pages.tour-pricing');
    }

    public function tripCategories()
    {
        return view('admin.pages.trip-categories');
    }

    public function customers()
    {
        return view('admin.pages.customer-management');
    }

    public function bookings()
    {
        return view('admin.pages.booking-management');
    }

    public function transactions()
    {
        return view('admin.pages.transaction-management');
    }

    public function verifyPayments()
    {
        return view('admin.pages.verify-payments');
    }
}
