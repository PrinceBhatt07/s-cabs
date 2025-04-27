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
            <div class="latest-booking-table">
                <h2>Drivers Management</h2>
                <div class="add-btn-container">
                    <button>
                        Add Driver
                    </button>
                </div>
                <table class="table-style">
                    <thead>
                        <tr>
                            <td>
                                #UserId
                            </td>
                            <td>
                                Name
                            </td>
                            <td>
                                Driving Licence
                            </td>
                            <td>
                                Mobile Number
                            </td>
                            <td>
                                Availability
                            </td>
                            <td>
                                Approval Status
                            </td>
                            <td>
                                Email
                            </td>
                            <td>
                                Actions
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1</td>
                            <td>Kylie</td>
                            <td>956321487</td>
                            <td>9876543231</td>
                            <td>Tayota</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                  </label>
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                  </label>
                            </td>
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