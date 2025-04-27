@extends('admin.layout.app')
@section('content')
<section class="upper_details_section">
            <div class="conntainer">
                <div class="top-section">
                    <h2 class="dashboard-title">Dashboard</h2>
                    <div class="drop_down_bell">
                        <div class="admin_dropdown">
                            <img src="{{ asset('admin/images/demo-user.jpg') }}" alt="user-icon" class="user-iamge" />
                            <h3>Admin</h3>
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                        <div class="notification_panel">
                            <img src="{{ asset('admin/images/notification.svg') }}" class="bell-icon" alt="ball icon" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="container quick-boxs">
                <div class="single_box">
                    <div class="icon_image">
                        <img src="{{ asset('admin/images/booking.png') }}" alt='booking' />
                    </div>
                    <div class="heading_text">
                        <h3>65</h3>
                        <h5>New Bookings</h5>
                    </div>
                </div>
                <!-- 2nd  -->
                <div class="single_box">
                    <div class="icon_image">
                        <img src="{{ asset('admin/images/car.png') }}" alt='booking' />
                    </div>
                    <div class="heading_text">
                        <h3>4</h3>
                        <h5>Total Cars</h5>
                    </div>
                </div>
                <!-- 3rd -->
                <div class="single_box">
                    <div class="icon_image">
                        <img src="{{ asset('admin/images/users.png') }}" alt='booking' />
                    </div>
                    <div class="heading_text">
                        <h3>88</h3>
                        <h5>User Registrations</h5>
                    </div>
                </div>
                <!-- 4th -->
                <div class="single_box">
                    <div class="icon_image">
                        <img src="{{ asset('admin/images/driver.png') }}" alt='booking' />
                    </div>
                    <div class="heading_text">
                        <h3>5</h3>
                        <h5>Available Drivers</h5>
                    </div>
                </div>
            </div>
            <div class="latest-booking-table">
                <h2>Latest Bookings</h2>
                <table class="table-style">
                    <thead>
                        <tr>
                            <td>
                                #UserId
                            </td>
                            <td>
                                Customer
                            </td>
                            <td>
                                Car
                            </td>
                            <td>
                                Date
                            </td>
                            <td>
                                Time
                            </td>
                            <td>
                                Status
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1</td>
                            <td>Rohit Tandon</td>
                            <td>HatchBack</td>
                            <td>25-04-2025</td>
                            <td>12:55:00</td>
                            <td><span class="status-tag status-rejected">Rejected</span></td>
                        </tr>
                        <tr>
                            <td>#1</td>
                            <td>Rohit Tandon</td>
                            <td>HatchBack</td>
                            <td>25-04-2025</td>
                            <td>12:55:00</td>
                            <td><span class="status-tag status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>#1</td>
                            <td>Rohit Tandon</td>
                            <td>HatchBack</td>
                            <td>25-04-2025</td>
                            <td>12:55:00</td>
                            <td><span class="status-tag status-upcoming">Upcoming</span></td>
                        </tr>
                        <tr>
                            <td>#1</td>
                            <td>Rohit Tandon</td>
                            <td>HatchBack</td>
                            <td>25-04-2025</td>
                            <td>12:55:00</td>
                            <td><span class="status-tag status-upcoming">Upcoming</span></td>
                        </tr>
                        <tr>
                            <td>#1</td>
                            <td>Rohit Tandon</td>
                            <td>HatchBack</td>
                            <td>25-04-2025</td>
                            <td>12:55:00</td>
                            <td><span class="status-tag status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>#1</td>
                            <td>Rohit Tandon</td>
                            <td>HatchBack</td>
                            <td>25-04-2025</td>
                            <td>12:55:00</td>
                            <td><span class="status-tag status-rejected">Rejected</span></td>
                        </tr>
                    </tbody>
                </table>
                <div class="view-all-btn">
                    <a href="#" class="view_all_btn">
                        View All
                    </a>
                </div>
            </div>
        </section>
@endsection