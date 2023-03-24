<!DOCTYPE html>
<html dir="@if (session()->has('language_direction_from_dropdown')) @if(session()->get('language_direction_from_dropdown') == 1) {{ __('rtl') }} @else {{ __('ltr') }} @endif @else {{ __('ltr') }} @endif" lang="@if (session()->has('language_code_from_dropdown')){{ str_replace('_', '-', session()->get('language_code_from_dropdown')) }}@else{{ str_replace('_', '-',   $language->language_code) }}@endif">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="title" content="@if (isset($general_seo)){{ $general_seo->site_name }} @endif">
    <meta name="description" content="@if (isset($general_seo)){{ $general_seo->site_desc }} @endif">
    <meta name="keywords" content="@if (isset($general_seo)){{ $general_seo->site_keywords }} @endif">
    <meta name="author" content="elsecolor">
    <meta property="fb:app_id" content="@if (isset($general_seo)){{ $general_seo->fb_app_id }} @endif">
    <meta property="og:title" content="@if (isset($general_seo)){{ $general_seo->site_name }} @endif">
    <meta property="og:url" content="@if (isset($general_seo)){{ url()->current() }} @endif">
    <meta property="og:description" content="@if (isset($general_seo)){{ $general_seo->site_desc }} @endif">
    <meta property="og:image" content="@if (!empty($general_site_image->favicon_image)){{ asset('uploads/img/general/'.$general_site_image->favicon_image) }} @endif">
    <meta itemprop="image" content="@if (!empty($general_site_image->favicon_image)){{ asset('uploads/img/general/'.$general_site_image->favicon_image) }} @endif">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="@if (!empty($general_site_image->favicon_image)){{ asset('uploads/img/general/'.$general_site_image->favicon_image) }} @endif">
    <meta property="twitter:title" content="@if (isset($general_seo)){{ $general_seo->site_name }} @endif">
    <meta property="twitter:description" content="@if (isset($general_seo)){{ $general_seo->site_desc }} @endif">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ __('frontend.home') }} @if (isset($general_seo)) - {{ $general_seo->site_name }} @endif</title>

@if (!empty($general_site_image->favicon_image))
    <!-- Favicon -->
        <link href="{{ asset('uplods/img/general/'.$general_site_image->favicon_image) }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
        <link href="{{ asset('uploads/img/general/'.$general_site_image->favicon_image) }}" sizes="128x128" rel="shortcut icon" />
@else
    <!-- Favicon -->
        <link href="{{ asset('uploads/img/dummy/favicon.png') }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
        <link href="{{ asset('uploads/img/dummy/favicon.png') }}" sizes="128x128" rel="shortcut icon" />
@endif

<!--// Boostrap //-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/css/bootstrap.min.css') }}">
    <!--// Animate Css //-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/css/animate.min.css') }}">
    <!--// Owl Carousel //-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/css/owl.carousel.min.css') }}">
    <!--// Owl Carousel Default //-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/css/owl.carousel.default.min.css') }}">
    <!--// Font Awesome //-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/fonts/font_awesome/css/all.css') }}">
    <!--// Nice Select //-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/css/nice-select.css') }}">
    <!--// Theme Main Css //-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">

@if (isset($google_analytic))
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $google_analytic->google_analytic }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '{{ $google_analytic->google_analytic }}');
        </script>
    @endif

</head>
<body @if (session()->has('language_direction_from_dropdown')) @if(session()->get('language_direction_from_dropdown') == 1)  class="rtl-mode" @endif @elseif (isset($language)) @if ($language->direction == 1) class="rtl-mode" @endif  @endif >

<!--// Page Wrapper Start //-->
<div class="page-wrapper" id="wrapper">

    <!--// Main Area Start //-->
    <main class="main-area">

        <!--// Login Page Start //-->
        <section class="section register-page">
            <div class="container">
                @include('frontend.alert.alert-general')
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="custom-form-wrap">
                            <h4>Register Form</h4>
                            <form method="POST" action="{{ route('sign-up-page.store') }}">
                                @csrf
                                <input name="type" type="hidden" value="1">
                                <div class="form-group">
                                    <input id="name" type="text" class="custom-form-control" name="name" placeholder="Your Full Name" required autocomplete="name" autofocus>
                                </div>
                                <div class="form-group">
                                    <input id="email" type="email" class="custom-form-control" name="email" placeholder="Your Username / Email *" required autocomplete="email">
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="custom-form-control" name="password"  placeholder="Password" required autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="custom-form-control" name="password_confirmation" placeholder="Enter Password Repeat"  required autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox d-flex align-items-center">
                                        <input type="checkbox" class="custom-control-input" name="agree_term_and_condition" id="termsCheckBox" required>
                                        <label class="custom-control-label" for="termsCheckBox"></label>
                                        <span>I accepted DigitalTeam <a href="#" data-toggle="modal" data-target="#termsModal">Terms & Conditions</a></span>
                                    </div>
                                </div>
                                <div class="form-group form-button">
                                    <button type="submit" class="landing-button b-0">Sign Up</button>
                                </div>
                                <div class="form-group  mb-0">
                                    <span>Already a Member Then Login <a href="{{ route('sign-in-page.index') }}" class="custom-link">Here</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--// Login Page End //-->

    </main>
    <!--// Main Area End //-->

    <div id="preloader-wrap">
        <div class="preloader-inner">
            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
    <!--// Preloader // -->

    <a href="#" class="landing scroll-top-btn" data-scroll-goto="1">
        <i class="fa fa-arrow-up"></i>
    </a>
    <!--// .scroll-top-btn // -->

</div>
<!--// Page Wrapper End //-->

<!-- Terms Modal Start -->
<div class="modal fade custom-modal" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header terms">
                <h5 class="modal-title" id="termsModalLabel">Terms & Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in
                    laying out print, graphic or web designs. The passage is attributed to
                    an unknown typesetter in the 15th century who is thought to have scrambled
                    parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                    book. It usually begins with.The placeholder text, beginning with the line
                    “Lorem ipsum dolor sit amet, consectetur adipiscing elit”, looks like Latin
                    because in its youth, centuries ago, it was Latin.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Terms Modal End -->

<!--// Cookie Wrap Start //-->
<div class="cookie-wrap d-none">
    <h4>I Use Cookies</h4>
    <p>My website uses essential cookies necessary for its functioning. By continuing browsing, you consent to my use of cookies and other technologies.</p>
    <div class="button-wrap">
        <a href="#" class="landing-button">I understand</a>
        <a href="#" class="learn-more-link">Learn More</a>
    </div>
</div>
<!--// Cookie Wrap End //-->






    <!--// JQuery //-->
    <script src="{{ asset('assets/frontend/vendor/js/jquery.min.js') }}"></script>
    <!--// Popper //-->
    <script src="{{ asset('assets/frontend/vendor/js/popper.min.js') }}"></script>
    <!--// Bootstrap //-->
    <script src="{{ asset('assets/frontend/vendor/js/bootstrap.min.js') }}"></script>
    <!--// Images Loaded Js //-->
    <script src="{{ asset('assets/frontend/vendor/js/images.loaded.min.js') }}"></script>
    <!--// Wow Js //-->
    <script src="{{ asset('assets/frontend/vendor/js/wow.min.js') }}"></script>
    <!--// Waypoint Js //-->
    <script src="{{ asset('assets/frontend/vendor/js/waypoint.min.js') }}"></script>
    <!--// JQuery Easing Functions //-->
    <script src="{{ asset('assets/frontend/vendor/js/jquery.easing.min.js') }}"></script>
    <!--// Owl Carousel //-->
    <script src="{{ asset('assets/frontend/vendor/js/owl.carousel.min.js') }}"></script>
    <!--// Nice Select Js //-->
    <script src="{{ asset('assets/frontend/vendor/js/jquery.nice-select.min.js') }}"></script>
    <!--// Main Js //-->
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>

    </body>

