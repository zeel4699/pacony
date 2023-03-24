@extends('layouts.frontend.master')

@section('content')

    <!--// Breadcrumb Section Start //-->
    <section class="breadcrumb-section section" data-scroll-index="1"
             @if (!empty($software->custom_breadcrumb_image) && $software->breadcrumb_status == "yes")
             data-bg-image-path="{{ asset('uploads/img/software/breadcrumb/'.$software->custom_breadcrumb_image) }}"
             @elseif (isset($breadcrumb))
             data-bg-image-path="{{ asset('uploads/img/general/'.$breadcrumb->breadcrumb_image) }}"
             @else
             data-bg-image-path="{{ asset('uploads/img/dummy/1920x750.jpg') }}"
            @endif>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb-inner">
                        <h1>{{ __('frontend.demo_request') }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ __('frontend.demo_request') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Breadcrumb Section end //-->

    <!--// About Section Start //-->
    @if (isset($demo_request))
        <section class="section" id="contact">
            <div class="container">
                <div class="row">
                    @if (!empty($demo_request->demo_request_image) && $demo_request->image_status == "show")
                        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" >
                            <img src="{{ asset('uploads/img/demo_request/'.$demo_request->demo_request_image) }}" alt="image" class="img-fluid">
                        </div>
                    @endif
                    <div class=" @if (!empty($demo_request->demo_request_image) && $demo_request->image_status == "show") col-lg-6 @else col-lg-12 @endif wow fadeInUp" data-wow-delay="0.1s">
                        <div class="landing-a-inner">
                            <h3>{{ $demo_request->title }}</h3>
                            <p>@php echo html_entity_decode($demo_request->desc); @endphp</p>
                        </div>
                        <div id="demo">
                            <div class="landing-form-inner">
                                <form action="{{ route('demo-request-page.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="hidden_software_slug" value="{{ $slug }}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="landing-f-group">
                                                <label>{{ __('frontend.your_name') }} <span class="text-danger">*</span></label>
                                                <input type="text" class="landing-f-control" autocomplete="off" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group">
                                                <label>{{ __('frontend.your_email') }}  <span class="text-danger">*</span></label>
                                                <input type="email" class="landing-f-control" autocomplete="off" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group">
                                                <label>{{ __('frontend.your_phone') }} <span class="text-danger">*</span></label>
                                                <input type="number" class="landing-f-control" autocomplete="off" name="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group">
                                                <label>{{ __('frontend.your_note') }}</label>
                                                <input type="text" class="landing-f-control" autocomplete="off" name="note">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group mb-0">
                                                <button type="submit" class="contact-button">{{ __('frontend.try_it_free') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="section" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" >
                        <img src="{{ asset('uploads/img/dummy/600x550.jpg') }}" alt="About image" class="img-fluid">
                    </div>
                    <div class="col-lg-6  wow fadeInUp" data-wow-delay="0.1s">
                        <div class="landing-a-inner">
                            <h3>
                                Try it Free
                            </h3>
                            <p>Try and test all its features for free. Get started now.</p>
                        </div>
                        <div id="demo">
                            <div class="landing-form-inner">
                                <form action="{{ route('demo-request-page.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="hidden_software_slug" value="{{ $slug }}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="landing-f-group">
                                                <label>{{ __('frontend.your_name') }} <span class="text-danger">*</span></label>
                                                <input type="text" class="landing-f-control" autocomplete="off" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group">
                                                <label>{{ __('frontend.your_email') }}  <span class="text-danger">*</span></label>
                                                <input type="email" class="landing-f-control" autocomplete="off" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group">
                                                <label>{{ __('frontend.your_phone') }} <span class="text-danger">*</span></label>
                                                <input type="number" class="landing-f-control" autocomplete="off" name="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group">
                                                <label>{{ __('frontend.your_note') }}</label>
                                                <input type="text" class="landing-f-control" autocomplete="off" name="note">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group mb-0">
                                                <button type="submit" class="contact-button">{{ __('frontend.try_it_free') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--// About Section End //-->

@endsection
