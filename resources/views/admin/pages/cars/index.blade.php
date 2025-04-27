@extends('admin.layout.app')
@section('content')
<section class="upper_details_section">
            <div class="conntainer">
                <div class="top-section">
                    <h2 class="dashboard-title">Cars</h2>
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
            <div class="latest-booking-table">
                <h2>Cars</h2>
                <div class="add-btn-container">
                    <button>
                        Add Car
                    </button>
                </div>
                <table class="table-style">
                    <thead>
                        <tr>
                            <td>
                                #UserId
                            </td>
                            <td>
                                Car Image
                            </td>
                            <td>
                                Car Number
                            </td>
                            <td>
                                Car Manufacturing Year
                            </td>
                            <td>
                                Car Name
                            </td>
                            <td>
                                Actions
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1</td>
                            <td><img src="{{ asset('admin/images/tayota.png')}}"  class="car_image"/></td>
                            <td>PB10HF2779</td>
                            <td>2025</td>
                            <td>Tayota</td>
                            <td>
                                <div class="action-btns-group">
                                    <button class="action-btns edit-btn">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="action-btns edit-btn">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button class="action-btns edit-btn">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#2</td>
                            <td><img src="{{ asset('admin/images/tayota.png')}}"  class="car_image"/></td>
                            <td>PB10HF9589</td>
                            <td>2015</td>
                            <td>Tayota</td>
                            <td>
                                <div class="action-btns-group">
                                    <button class="action-btns edit-btn">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="action-btns edit-btn">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button class="action-btns edit-btn">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#3</td>
                            <td><img src="{{ asset('admin/images/wagon.png')}}"  class="car_image"/></td>
                            <td>PB10HF2546</td>
                            <td>2005</td>
                            <td>Wagon</td>
                            <td>
                                <div class="action-btns-group">
                                    <button class="action-btns edit-btn">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="action-btns edit-btn">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button class="action-btns edit-btn">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#4</td>
                            <td><img src="{{ asset('admin/images/pickup.png')}}"  class="car_image"/></td>
                            <td>PB10HF8679</td>
                            <td>2021</td>
                            <td>Pickup</td>
                            <td>
                                <div class="action-btns-group">
                                    <button class="action-btns edit-btn">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="action-btns edit-btn">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button class="action-btns edit-btn">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
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