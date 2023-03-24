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
                        <h1>{{ __('frontend.profile') }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ __('frontend.profile') }}
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
                                <li class="active">
                                    <a href="{{ route('profile-page.edit') }}">Profile</a>
                                </li>
                                <li>
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
                        <form  action="{{ route('profile-page.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            @endif

                            <div class="custom-form-wrap">
                                <div class="form-group">
                                    <input type="text" class="custom-form-control" name="name" placeholder="Enter Username *"  value="{{ $user->name }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="custom-form-control" name="email" placeholder="Enter Email *"  value="{{ $user->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">{{ __('content.image') }} ({{ __('content.size') }} 32 x 32)(.png, .jpg, .jpeg)</label>
                                    <input id="image" name="profile_photo_path" type="file" class="form-control-file">
                                    @if (!empty($user->profile_photo_path))
                                        <img src="{{ asset('uploads/img/profile/'.$user->profile_photo_path) }}" class="img-fluid mt-3" alt="profile image">
                                    @else
                                        <img src="{{ asset('uploads/img/dummy/32x32.jpg') }}" class="img-fluid mt-3" alt="profile image">
                                    @endif
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
