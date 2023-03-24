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
                            <h5 class="inner-header-title">{{ Auth::user()->name }}</h5>
                            <ul class="sidebar-category-list clearfix">
                                <li class="active">
                                    <a href="#" >Web Software<span class="category-count">(10)</span></a>
                                </li>
                                <li>
                                    <a href="#">Premium Web Software<span class="category-count">(15)</span></a>
                                </li>
                                <li>
                                    <a href="#">Laravel Scripts<span class="category-count">(5)</span></a>
                                </li>
                                <li>
                                    <a href="#">All Software & Scripts<span class="category-count">(30)</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Product List Section End //-->

@endsection
