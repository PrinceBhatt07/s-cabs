<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <main class="main_content">
        <aside class="admin-navbar">
            <div class="outer-container">
                <div class="inner-container">
                    <div class="logo-humburger">
                        <img src="{{ asset('admin/images/sardarji-logo.png') }}" alt="logo" class="logo"/>
                        <img src="{{ asset('admin/images/hamburger-icon.png') }}" alt="Hamburger Icon" class="hamburger-icon" />
                    </div>
                    <div class="admin-details">
                        <div class="admin_image">
                            <img class="image_admin" src="{{ asset('admin/images/demo-user.jpg') }}" alt="user-image" />
                        </div>
                        <div class="details_box">
                            <h3 class="admim-name">Admin</h3>
                            <p class="user-email">admin@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="nav_Links_container">
                    <a href="{{ route('admin.dashboard') }}"  class="nav-links {{ request()->is('admin/dashboard') ? 'active-link' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                    <a href="{{ route('admin.cars') }}" class="nav-links {{ request()->is('admin/cars') ? 'active-link' : ''}}"><i class="fa-solid fa-car"></i> Car Management</a>
                    <a href="{{ route('admin.drivers') }}" class="nav-links {{ request()->is('admin/drivers') ? 'active-link' : ''}}"><i class="fa-solid fa-user"></i> Driver Management</a>
                    <a href="{{ route('admin.drivers-requests') }}" class="nav-links {{ request()->is('admin/drivers-requests') ? 'active-link' : ''}}"><i class="fa-solid fa-hand"></i> Driver Request</a>
                    <a href="{{ route('admin.tour-pricing') }}" class="nav-links {{ request()->is('admin/tour-pricing') ? 'active-link' : ''}}"> <i class="fa-solid fa-tag"></i> Tour Pricing</a>
                    <a href="{{ route('admin.trip-categories') }}" class="nav-links {{ request()->is('admin/trip-categories') ? 'active-link' : ''}}"><i class="fa-solid fa-list"></i> Trip Catrgories</a>
                    <a href="{{ route('admin.customers') }}" class="nav-links {{ request()->is('admin/customers') ? 'active-link' : ''}}"><i class="fa-solid fa-users"></i> Customers</a>
                    <a href="{{ route('admin.bookings') }}" class="nav-links {{ request()->is('admin/bookings') ? 'active-link' : ''}}"><i class="fa-solid fa-cash-register"></i> Bookings</a>
                    <a href="{{ route('admin.transactions') }}" class="nav-links {{ request()->is('admin/transactions') ? 'active-link' : ''}}"><i class="fa-solid fa-credit-card"></i> Transactions</a>
                    <a href="{{ route('admin.verify-payments') }}" class="nav-links {{ request()->is('admin/verify-payments') ? 'active-link' : ''}}"><i class="fa-solid fa-circle-check"></i> Verify Payments</a>
                </div>
            </div>
        </aside>
        @yield('content')
    </main>
</body>
</html>