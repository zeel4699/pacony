@extends('layouts.frontend.master')

@section('content')

    <!--// Breadcrumb Section Start //-->
    <section class="breadcrumb-section section" data-scroll-index="1" @if (isset($breadcrumb))
    data-bg-image-path="{{ asset('uploads/img/general/'.$breadcrumb->breadcrumb_image) }}"
             @else data-bg-image-path="{{ asset('uploads/img/dummy/1920x750.jpg') }}"
            @endif>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb-inner">
                        <h1>{{ __('frontend.change_password') }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ __('frontend.change_password') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Breadcrumb Section end //-->


    <!--// Product List Section Start //-->
    <section class="section sidebar-wrapper padding-minus-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="widget-sidebar">
                        <div class="sidebar-widgets">
                            <ul class="sidebar-category-list clearfix">
                                <li>
                                    <a href="{{ route('profile-page.edit') }}">Profile</a>
                                </li>
                                <li class="active">
                                    <a href="{{ route('profile-page.change_password_edit') }}">Change Password</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                @if ($demo_mode == "on")
                    <!-- Include Alert Blade -->
                        @include('admin.demo_mode.demo-mode')
                    @else
                        <form action="{{ route('profile-page.change_password_update') }}" method="POST">
                            @method('PUT')
                            @csrf
                            @endif

                            <div class="custom-form-wrap">
                                <div class="form-group">
                                    <input type="password" class="custom-form-control" name="current_password" placeholder="Enter Current Password *" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="custom-form-control" name="password" placeholder="Enter New password *" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="custom-form-control" name="password_confirmation" placeholder="Enter Confirm password *" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="landing-button b-0">Update</button>
                                </div>
                            </div>

                        </form>
                </div>
            </div>
        </div>
    </section>
    <!--// Product List Section End //-->

@endsection
