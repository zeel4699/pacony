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
        <link href="{{ asset('uploads/img/general/'.$general_site_image->favicon_image) }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
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
<body  data-spy="scroll" data-target="#fixedNavbar" @if (session()->has('language_direction_from_dropdown')) @if(session()->get('language_direction_from_dropdown') == 1)  class="rtl-mode" @endif @elseif (isset($language)) @if ($language->direction == 1) class="rtl-mode" @endif  @endif >

<!--// Page Wrapper Start //-->
<div class="page-wrapper" id="wrapper">

    <!--// Header Start //-->
    <header class="header fixed-top landing-header" id="header">
        <div id="header-topbar">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="phone-topbar">
                       @if (!empty($site_info->phone))
                            <a href="tel:{{ $site_info->phone }}">
                                <i class="fa fa-phone"></i>
                                <span>{{ $site_info->phone }}</span>
                            </a>
                           @else
                            <a href="tel:+1 200-444-4444">
                                <i class="fa fa-phone"></i>
                                <span>+1 200-444-4444</span>
                            </a>
                        @endif
                    </div>
                    <div class="language-topbar">
                        @isset ($general_order_mode)
                            @if ($general_order_mode->order_mode == "with_payment_method")
                                <a href="#" class="support-btn-navbar" data-toggle="tooltip" data-placement="top" title="Support"><i class="fas fa-life-ring"></i></a>
                                <a href="#" class="login-btn-navbar" data-toggle="tooltip" data-placement="top" title="Login / Register"><i class="fa fa-sign-in-alt"></i></a>
                            @endif
                            @endisset
                        @if (count($display_dropdowns) > 0)
                            <div class="dropdown">
                                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if (session()->has('language_name_from_dropdown')) {{ session()->get('language_name_from_dropdown') }} @else {{ $language->language_name }} @endif
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @foreach ($display_dropdowns as $display_dropdown)
                                        <a class="dropdown-item" href="{{ url('language/set-locale/'.$display_dropdown->id) }}">{{ $display_dropdown->language_name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div id="nav-menu-wrap">
            <div class="container">
                <nav class="navbar navbar-expand-lg p-0">
                    @if (!empty($general_site_image->site_name))
                        <a class="navbar-brand" title="Home" href="{{ url('/') }}">
                            <span>{{ $general_site_image->site_name }}</span>
                        </a>
                    @else
                        <a class="navbar-brand" title="Home" href="{{ url('/') }}">
                            <span>Pacony</span>
                        </a>
                    @endif
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#fixedNavbar"
                            aria-controls="fixedNavbar" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="togler-icon-inner">
                                <span class="line-1"></span>
                                <span class="line-2"></span>
                                <span class="line-3"></span>
                            </span>
                    </button>
                    <div class="collapse navbar-collapse main-menu justify-content-end" id="fixedNavbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link menu-link active" href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            @if ($section_arr['service_page'] == "show" || $section_arr['software_page'] == "show")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="themesDropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('frontend.products') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="themesDropdownMenu">
                                    @if ($section_arr['service_page'] == "show")
                                        <a class="dropdown-item" href="{{ route('service-page.index')  }}">{{ __('frontend.services') }}</a>
                                    @endif
                                    @if ($section_arr['software_page'] == "show")
                                        <a class="dropdown-item" href="{{ route('software-page.index') }}">{{ __('frontend.software') }}</a>
                                    @endif
                                </div>
                            </li>
                            @endif
                            @if ($section_arr['blog_page'] == "show")
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('blog-page.index') }}">{{ __('frontend.blogs') }}</a>
                            </li>
                            @endif
                            @if ($section_arr['pages_page'] == "show")
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ __('frontend.pages') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="pagesDropdownMenu">
                                        @foreach ($header_pages as $header_page)
                                            <a class="dropdown-item"  href="{{ route('any-page.show', ['page_slug' => $header_page->page_slug]) }}">{{ $header_page->page_title }}</a>
                                        @endforeach
                                    </div>
                                </li>
                                @endif
                            @if ($section_arr['contact_section'] == "show")
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#contact">{{ __('frontend.contact') }}</a>
                            </li>
                            @endif
                            @isset ($general_order_mode)
                                @if ($general_order_mode->order_mode == "with_payment_method")
                                    <li class="nav-item dropdown user-link">
                                        <a class="nav-link dropdown-toggle" href="#" id="themesDropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="" alt="" class="img-fluid">
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="themesDropdownMenu">
                                            <a class="dropdown-item" href="#">{{ __('frontend.my_account') }}</a>
                                            <a class="dropdown-item" href="#">{{ __('frontend.my_address') }}</a>
                                        </div>
                                    </li>
                                @endif
                            @endisset
                            @isset ($external_url)
                                @if ($external_url->status == "show")
                                    <li class="nav-item header-btn">
                                        <a href="{{ $external_url->btn_url }}" class="landing-button"><span>{{ $external_url->btn_name }}</span></a>
                                    </li>
                                @endif
                            @endisset
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!--// Header End  //-->

    <!--// Main Area Start //-->
    <main class="main-area">

    @if ($homepage_version->choose_version == "home")

        <!--// Landing Hero Start //-->
        @if (isset($fixed_content))
            <section id="landing-hero-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-xl-6 col-md-10 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="landing-hero-inner">
                                <h1>{{ $fixed_content->title }}</h1>
                                <h2>{{ $fixed_content->desc }}</h2>
                               @if (!empty($fixed_content->btn_name)) <a href="@if (!empty($fixed_content->btn_url)) {{ $fixed_content->btn_url }} @else # @endif" class="landing-button">{{ $fixed_content->btn_name }}</a> @endif
                            </div>
                        </div>
                      @if (!empty($fixed_content->thumbnail_image) && $fixed_content->image_status == "show")
                            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                                <div class="landing-hero-img">
                                    <img src="{{ asset('uploads/img/general/'.$fixed_content->thumbnail_image) }}" alt="Hero banner image" class="img-fluid">
                                </div>
                            </div>
                          @endif
                    </div>
                </div>
            </section>
        @else
            <section id="landing-hero-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-xl-6 col-md-10 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="landing-hero-inner">
                                <h1>It's easy to create your site now, try it now</h1>
                                <h2>Create your site with our saas application by finding the most suitable solution.</h2>
                                <a href="#" class="landing-button">Get Started</a>
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                            <div class="landing-hero-img">
                                <img src="{{ asset('uploads/img/dummy/570x360.jpg') }}" alt="Hero banner image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endif
        <!--// Landing Hero End //-->

        @else
        <!--// Hero Start //-->
          @if (count($sliders) > 0)
                <section id="landing-hero-section" class="p-0 slider-wrapper">
                    <div class="owl-carousel owl-theme hero-slider">
                        @foreach ($sliders as $slider)
                            <div class="item" data-bg-image-path="@if (!empty($slider->slider_image) && $slider->image_status == "show") {{ asset('uploads/img/slider/'.$slider->slider_image) }} @endif">
                                <div class="container">
                                    <div class="row h-100 align-items-center">
                                        <div class="col-lg-7 col-xl-6 col-md-10">
                                            <div class="landing-hero-inner">
                                                <h1>{{ $slider->title }}</h1>
                                                <h2>{{ $slider->desc }}</h2>
                                                @if (!empty($slider->btn_name))
                                                    <a href="{{ $slider->btn_url }}" class="landing-button">{{ $slider->btn_name }}</a>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
              @else
                <section id="landing-hero-section" class="p-0 slider-wrapper">
                    <div class="owl-carousel owl-theme hero-slider">
                        <div class="item" data-bg-image-path="{{ asset('uploads/img/dummy/1920x1080.jpg') }}">
                            <div class="container">
                                <div class="row h-100 align-items-center">
                                    <div class="col-lg-7 col-xl-6 col-md-10">
                                        <div class="landing-hero-inner">
                                            <h1>It's easy to create your site now, try it now</h1>
                                            <h2>Create your site with our saas application by finding the most suitable solution.</h2>
                                            <a href="#" class="landing-button">Get Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item" data-bg-image-path="{{ asset('uploads/img/dummy/1920x1080.jpg') }}">
                            <div class="container">
                                <div class="row h-100 align-items-center">
                                    <div class="col-lg-7 col-xl-6 col-md-10">
                                        <div class="landing-hero-inner">
                                            <h1>It's easy to create your site now, try it now</h1>
                                            <h2>Create your site with our saas application by finding the most suitable solution.</h2>
                                            <a href="#" class="landing-button">Get Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
              @endif
            <!--// Hero End //-->
        @endif


    @if ($section_arr['about_us_section'] == "show")
        <!--// About Section Start //-->
        @if (isset($about) || count($info_lists) > 0)
            <section class="section" id="about">
                <div class="container">
                    <div class="row">
                        @if (!empty($about->about_image) && $about->image_status == "show")
                            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" >
                                <img src="{{ asset('uploads/img/about/'.$about->about_image) }}" alt="About image" class="img-fluid">
                            </div>
                            @endif
                        <div class=" @if (!empty($about->about_image) && $about->image_status == "show") col-lg-6 @else col-lg-12 @endif wow fadeInUp" data-wow-delay="0.1s">
                            <div class="landing-a-inner">
                                @isset ($about)
                                    <h3>{{ $about->title }}</h3>
                                    <p>@php echo html_entity_decode($about->desc); @endphp</p>
                                    @endisset
                                @if (count($info_lists) > 0)
                                    <div class="about-list">
                                        <ul>
                                           @foreach ($info_lists as $info_list)
                                                <li>
                                                    @if ($info_list->type == "icon")
                                                        <i class="{{ $info_list->icon }}"></i>
                                                        @else
                                                        @if ($info_list->image_status == "show")
                                                            <img src="{{ asset('uploads/img/about/info_list/'.$info_list->info_image) }}" alt="about image" class="img-fluid">
                                                        @endif
                                                    @endif
                                                    <div class="text">
                                                        <h5>{{ $info_list->title }}</h5>
                                                        <p>{{ $info_list->desc }}</p>
                                                    </div>
                                                </li>
                                               @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (!empty($about->btn_name)) <a href="@if (!empty($about->btn_url)) {{ $about->btn_url }} @else # @endif" class="landing-button">{{ $about->btn_name }}</a> @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            <section class="section" id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" >
                            <img src="{{ asset('uploads/img/dummy/600x550.jpg') }}" alt="About image" class="img-fluid">
                        </div>
                        <div class="col-lg-6  wow fadeInUp" data-wow-delay="0.1s">
                            <div class="landing-a-inner">
                                <h3>
                                    Save time now and offer your customers the best solution as saas
                                </h3>
                                <p>
                                    Now customers are constantly looking for a solution to find a new solution to deliver sites.
                                    Now build your own site with better standards and multiple theme options
                                </p>
                                <div class="about-list">
                                    <ul>
                                        <li>
                                            <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="about image" class="img-fluid">
                                            <div class="text">
                                                <h5>Unique Design</h5>
                                                <p>
                                                    It is our basic principle to always be ready for innovations and to follow
                                                    trend designs and produce templates.
                                                </p>
                                            </div>
                                        </li>
                                        <li>
                                            <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="about image" class="img-fluid">
                                            <div class="text">
                                                <h5>Responsive Design</h5>
                                                <p>
                                                    Our designs are of high quality and fully responsive.And many of our customers
                                                    thank us as they easily create their own site.
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <a href="#" class="landing-button">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endif
        <!--// About Section End //-->
        @endif

        @if ($section_arr['work_process_section'] == "show")
    <!--//  How It Works Start //-->
        @if (isset($work_process_section) || count($work_processes) > 0)
            <section class="section pb-minus-70" id="how-it-works">
                <div class="container">
                    @isset ($work_process_section)
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="landing-section-heading">
                                    <h2>{{ $work_process_section->section_title }}</h2>
                                    <p>{{ $work_process_section->desc }}</p>
                                </div>
                            </div>
                        </div>
                        @endisset
                    <div class="row">
                        @php $i = 0; @endphp
                       @foreach ($work_processes as $work_process)
                            <div class="col-md-6 col-sm-6 col-lg-4 wow zoomIn" data-wow-delay="0.{{ $i }}s">
                                <div class="landing-hiw-item">
                                   @if ($work_process->type == "icon")
                                        <div class="hiw-item-img">
                                            <i class="{{ $work_process->icon }} custom-font-size"></i>
                                        </div>
                                       @else
                                        @if (!empty($work_process->work_process_image))
                                            @if ($work_process->image_status == "show")
                                                <div class="hiw-item-img">
                                                    <img src="{{ asset('uploads/img/work_process/'.$work_process->work_process_image) }}" alt="How it work" class="img-fluid">
                                                </div>
                                                @endif
                                           @else
                                            <div class="hiw-item-img">
                                                <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="How it work" class="img-fluid">
                                            </div>
                                            @endif
                                       @endif
                                    <div class="hiw-item-body">
                                        <h5>{{ $work_process->title }}</h5>
                                        @if (!empty($work_process->desc)) <p>{{ $work_process->desc }}</p> @endif
                                    </div>
                                </div>
                            </div>
                            @php $i = $i + 4; @endphp
                        @endforeach
                    </div>
                </div>
            </section>
        @else
            <section class="section pb-minus-70" id="how-it-works">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="landing-section-heading">
                                <h2>How It Work</h2>
                                <p>
                                    Easily create and enjoy your site by following the instructions
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-4 wow zoomIn">
                            <div class="landing-hiw-item">
                                <div class="hiw-item-img">
                                    <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="How it work" class="img-fluid">
                                </div>
                                <div class="hiw-item-body">
                                    <h5>Sign Up</h5>
                                    <p>
                                        Thousands of customers have gained a lot by
                                        becoming members of our site and succeeded by following the steps.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-4 wow zoomIn" data-wow-delay="0.5s">
                            <div class="landing-hiw-item">
                                <div class="hiw-item-img">
                                    <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="How it work" class="img-fluid">
                                </div>
                                <div class="hiw-item-body">
                                    <h5>Choose a Plan</h5>
                                    <p>
                                        Choose a plan that suits you right after signing
                                        up and follow step 3 to create a new site.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-4 wow zoomIn" data-wow-delay="0.8s">
                            <div class="landing-hiw-item">
                                <div class="hiw-item-img">
                                    <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="How it work" class="img-fluid">
                                </div>
                                <div class="hiw-item-body">
                                    <h5>Create Your Site</h5>
                                    <p>
                                        Now, if you have registered and selected one of the plans, say hello
                                        to your new job by selecting the template you want.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endif
        <!--//  How It Works End //-->
        @endif

        @if ($section_arr['feature_section'] == "show")
        <!--// Features Section Start //-->
        @if (isset($feature) || count($feature_info_lists) > 0)
            <section class="section" id="landing-features">
                <div class="container">
                    <div class="row">
                        @if (!empty($feature->feature_image) && $feature->image_status == "show")
                            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0s">
                                <img src="{{ asset('uploads/img/feature/'.$feature->feature_image) }}" alt="feature image" class="img-fluid">
                            </div>
                            @endif
                        <div class="@if (!empty($feature->feature_image) && $feature->image_status == "show") col-lg-6 @else col-lg-12 @endif wow fadeInRight" data-wow-delay="0.5s">
                            <div class="landing-features-inner">
                                <h3>{{ $feature->title }}</h3>
                                <p>@php echo html_entity_decode($feature->desc); @endphp</p>
                                <div class="features-list">
                                    <ul>
                                       @foreach ($feature_info_lists as $feature_info_list)
                                            <li>
                                                <div class="text">
                                                    <h5>{{ $feature_info_list->title }}</h5>
                                                    <p>{{ $feature_info_list->desc }}</p>
                                                </div>
                                            </li>
                                           @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            <section class="section" id="landing-features">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0s">
                            <img src="{{ asset('uploads/img/dummy/600x550.jpg') }}" alt="About image" class="img-fluid">
                        </div>
                        <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.5s">
                            <div class="landing-features-inner">
                                <h3>
                                    Don't worry about choosing us, we guarantee a lot of things.
                                </h3>
                                <p>
                                    As we always answer the questions that our customers have in mind,
                                    you can ask us many questions without purchasing more.And many customers recommend us
                                    to their friends and they are very satisfied with the service we provide.It will give you
                                    more confidence that our services are made by our fully experienced team and we gain experience
                                    to provide you the best solution
                                </p>
                                <div class="features-list">
                                    <ul>
                                        <li>
                                            <div class="text">
                                                <h5>Money Back Quarantee</h5>
                                                <p>
                                                    If you are not satisfied or encounter a problem,
                                                    we will refund your money unconditionally.
                                                </p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="text">
                                                <h5>Live Time Update</h5>
                                                <p>
                                                    Has a constantly updated and continuously improved infrastructure.However, it is very easy to install.
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endif
        <!--// Features Section End //-->
        @endif

        @if ($section_arr['testimonial_section'] == "show")
        <!--// Testimonial Section Start //-->
        @if (isset($testimonial_section) || count($testimonials) > 0)
            <section id="testimonial" class="section pb-minus-70">
                <div class="container">
                   @isset ($testimonial_section)
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="landing-section-heading-left">
                                    <h2>{{ $testimonial_section->section_title }}</h2>
                                    <p>{{ $testimonial_section->desc }}</p>
                                </div>
                            </div>
                        </div>
                       @endisset
                    <div class="owl-carousel owl-theme" id="landingClientsCarousel">
                       @foreach ($testimonials as $testimonial)
                            <div class="item">
                                <div class="landing-testimonial-item">
                                    <div class="landing-testimonial-header">
                                        <h5>{{ $testimonial->job }}</h5>
                                    </div>
                                    <div class="landing-testimonial-body">
                                       @if (!empty($testimonial->testimonial_image) && $testimonial->image_status == "show")
                                            <div class="landing-testimonial-img">
                                                <img src="{{ asset('uploads/img/testimonial/'.$testimonial->testimonial_image) }}" alt="testimonial image" class="img-fluid">
                                            </div>
                                           @endif
                                        <div class="text">
                                            <h5>{{ $testimonial->name }}</h5>
                                            <p>{{ $testimonial->desc }}</p>
                                        </div>
                                        <div class="rating">
                                            @for ($t = 0; $t < $testimonial->star; $t++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                            @for ($t = 0; $t < 5-$testimonial->star; $t++)
                                                <i class="far fa-star"></i>
                                            @endfor

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @else
            <section id="testimonial" class="section pb-minus-70">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="landing-section-heading-left">
                                <h2>Our Testimonials</h2>
                                <p>
                                    Many customers have chosen us and they know their
                                    happiness by saving time and creating their sites.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="owl-carousel owl-theme" id="landingClientsCarousel">
                        <div class="item">
                            <div class="landing-testimonial-item">
                                <div class="landing-testimonial-header">
                                    <h5>Envato Customer</h5>
                                </div>
                                <div class="landing-testimonial-body">
                                    <div class="landing-testimonial-img">
                                        <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="testimonial image" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h5>Thais Silva</h5>
                                        <p>
                                            Support is AMAZING not mentioning the quality of the design.
                                            This team is very responsive and helpful. Keep up the great job and thank you again.
                                        </p>
                                    </div>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="landing-testimonial-item">
                                <div class="landing-testimonial-header">
                                    <h5>Envato Customer</h5>
                                </div>
                                <div class="landing-testimonial-body">
                                    <div class="landing-testimonial-img">
                                        <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="testimonial image" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h5>John Doe</h5>
                                        <p>
                                            I'm extremely happy with the purchase. The author did an outstanding job
                                            and I can just highly recommend the product to anyone else.
                                        </p>
                                    </div>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="landing-testimonial-item">
                                <div class="landing-testimonial-header">
                                    <h5>Envato Customer</h5>
                                </div>
                                <div class="landing-testimonial-body">
                                    <div class="landing-testimonial-img">
                                        <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="testimonial image" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h5>Roger Reyes</h5>
                                        <p>
                                            This is the best and most beautiful web form. Easy integration and the best customer
                                            support and by far! I'm blessed to find this product!
                                        </p>
                                    </div>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="landing-testimonial-item">
                                <div class="landing-testimonial-header">
                                    <h5>Envato Customer</h5>
                                </div>
                                <div class="landing-testimonial-body">
                                    <div class="landing-testimonial-img">
                                        <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="testimonial image" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h5>Matheus Bertelli</h5>
                                        <p>
                                            This team loves to help, he helped me in many things, and the scripts is very excellent and without errors, and I can amend it easily, thank you very much
                                        </p>
                                    </div>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endif
        <!--// Testimonial Section End //-->
        @endif

        @if ($section_arr['service_page'] == "show")
        <!--// Pricing Section Start //-->
        @if (isset($service_section) || count($services) > 0)
            <section class="section pb-minus-70" id="pricing">
                <div class="container">
                  @isset ($service_section)
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="landing-section-heading">
                                    <h2>{{ $service_section->section_title }}</h2>
                                    <p>{{ $service_section->desc }}</p>
                                </div>
                            </div>
                        </div>
                      @endisset
                    <div class="row">
                       @foreach ($services as $service)
                            <div class="col-lg-4 col-md-6 pricing-border">
                                <div class="pricing-card">
                                    <div class="pricing-card-header">
                                        <h2>{{ $service->service_name }}</h2>
                                        @if (!empty($service->demo_url))
                                            <p><a href="{{ $service->demo_url }}">{{ __('frontend.see_demo') }} <i class="fa fa-arrow-right"></i></a></p>
                                        @endif
                                        @if (!empty($service->service_image) && $service->image_status == "show")
                                            <img src="{{ asset('uploads/img/service/'.$service->service_image) }}" alt="Price image" class="img-fluid">
                                        @endif
                                    </div>
                                    @php
                                        $str = $service->feature_list;
                                        $str2 = $service->non_feature_list;
                                        $array_features = explode(",", $str);
                                        $array_non_features = explode(",", $str2);
                                    @endphp
                                    <ul>
                                        @if ($str != null)
                                            @foreach ($array_features as $feature)
                                                <li class="listed">{{ $feature }}</li>
                                            @endforeach
                                            @endif
                                        @if ($str2 != null)
                                                @foreach ($array_non_features as $non_feature)
                                                    <li class="unlisted">{{ $non_feature }}</li>
                                                @endforeach
                                            @endif
                                    </ul>
                                    <div class="pricing-card-footer">
                                        <h3>
                                            @if ($service->period == "monthly")

                                                @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($service->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sub>{{ __('frontend.monthly') }}</sub> @else <sub>{{ __('frontend.monthly') }}</sub>{{ number_format($service->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif

                                            @elseif ($service->period == "annually")

                                                @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($service->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sub>{{ __('frontend.annually') }}</sub> @else <sub>{{ __('frontend.annually') }}</sub>{{ number_format($service->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif

                                            @else

                                                @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($service->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sub>{{ __('frontend.onetime') }}</sub> @else <sub>{{ __('frontend.onetime') }}</sub>{{ number_format($service->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif

                                            @endif
                                        </h3>
                                        @isset($general_order_mode)
                                            @if($general_order_mode->order_mode == "with_free_trial")
                                                <a href="{{ route('demo-request-page.show', ['slug' => $service->service_slug]) }}" class="landing-button block">{{ __('frontend.lets_call_you') }}</a>
                                            @elseif ($general_order_mode->order_mode == "via_whatsapp")
                                                <a href="{{ route('order-via-whatsapp-page.show', ['slug' => $service->service_slug]) }}" class="landing-button block">{{ __('frontend.via_whatsapp') }}</a>
                                            @else
                                                <a href="{{ route('order-period-page.show', ['slug' => $service->service_slug]) }}" class="landing-button block">{{ __('frontend.buy_now') }}</a>
                                            @endif
                                        @else
                                            <a href="{{ route('demo-request-page.show', ['slug' => $service->service_slug]) }}" class="landing-button block">{{ __('frontend.lets_call_you') }}</a>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @else
            <section class="section pb-minus-70" id="pricing">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="landing-section-heading">
                                <h2>Our Service Pricing</h2>
                                <p>
                                    Subscribe to our system and buy one of the packages and benefit from the advantages.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 pricing-border">
                            <div class="pricing-card">
                                <div class="pricing-card-header">
                                    <h2>Free</h2>
                                    <p><a href="#">See Demo <i class="fa fa-arrow-right"></i></a></p>
                                    <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="Price image" class="img-fluid">
                                </div>
                                <ul>
                                    <li class="listed">1 Template</li>
                                    <li class="listed">5GB Diskspace</li>
                                    <li class="listed">10GB Bandwith</li>
                                    <li class="listed">Free Subdomain</li>
                                    <li class="listed">WordPress Installs</li>
                                    <li class="unlisted">Sales System</li>
                                    <li class="unlisted">Email Accounts</li>
                                </ul>
                                <div class="pricing-card-footer">
                                    <h3><sup>$</sup>0<sub>/Monthly</sub></h3>
                                    <a href="#" class="landing-button block">Buy Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 pricing-border">
                            <div class="pricing-card popular">
                                <div class="pricing-card-header">
                                    <h2>Premium</h2>
                                    <p><a href="#">See Demo <i class="fa fa-arrow-right"></i></a></p>
                                    <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="Price image" class="img-fluid">
                                </div>
                                <ul>
                                    <li class="listed">5 Template</li>
                                    <li class="listed">250GB Diskspace</li>
                                    <li class="listed">100GB Bandwith</li>
                                    <li class="listed">Subdomain + (Domain)</li>
                                    <li class="listed">WordPress Installs </li>
                                    <li class="listed">Sales System</li>
                                    <li class="listed">3 Email Accounts</li>
                                </ul>
                                <div class="pricing-card-footer">
                                    <h3><sup>$</sup>59<sub>/Monthly</sub></h3>
                                    <a href="#" class="landing-button block">Buy Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 pricing-border">
                            <div class="pricing-card">
                                <div class="pricing-card-header">
                                    <h2>Ultimate</h2>
                                    <p><a href="#">See Demo <i class="fa fa-arrow-right"></i></a></p>
                                    <img src="{{ asset('uploads/img/dummy/100x100.jpg') }}" alt="Price image" class="img-fluid">
                                </div>
                                <ul>
                                    <li class="listed">5 Template</li>
                                    <li class="listed">500GB Diskspace</li>
                                    <li class="listed">250GB Bandwith</li>
                                    <li class="listed">Subdomain + (Domain)</li>
                                    <li class="listed">WordPress Installs </li>
                                    <li class="listed">Sales System</li>
                                    <li class="listed">10 Email Accounts</li>
                                </ul>
                                <div class="pricing-card-footer">
                                    <h3><sup>$</sup>79<sub>/Monthly</sub></h3>
                                    <a href="#" class="landing-button block">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!--// Pricing Section End //-->
        @endif

        @if ($section_arr['software_page'] == "show")
        <!--// Product List Section Start //-->
        @if (isset($software_section) || count($softwares) > 0)
            <section class="section pb-minus-70">
                <div class="container">
                    @isset ($software_section)
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="landing-section-heading">
                                    <h2>{{ $software_section->section_title }}</h2>
                                    <p>{{ $software_section->desc }}</p>
                                </div>
                            </div>
                        </div>
                    @endisset
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                               @foreach ($softwares as $software)
                                    <div class="col-lg-4 col-md-4">
                                        <div class="product-list-item">
                                            <div class="product-img">
                                                <a href="{{ route('software-page.show', ['slug' => $software->software_slug]) }}">
                                                    @if (!empty($software->software_image))
                                                        <img src="{{ asset('uploads/img/software/thumbnail1/'.$software->software_image) }}" alt="image" class="img-fluid">
                                                    @else
                                                        <img src="{{ asset('uploads/img/dummy/310x160.jpg') }}" alt="image" class="img-fluid">
                                                    @endif
                                                </a>
                                                <div class="product-buttons">
                                                    <a href="{{ route('software-page.show', ['slug' => $software->software_slug]) }}"><i class="fa fa-eye"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                @php
                                                    $str = $software->tag;
                                                    $array_tags = explode(",", $str);
                                                @endphp
                                                @if ($str != null)
                                                    @foreach ($array_tags as $tag)
                                                        <span>{{ $tag }} </span>
                                                    @endforeach
                                                @endif
                                                <h5>
                                                    <a href="{{ route('software-page.show', ['slug' => $software->software_slug]) }}">{{ $software->title }}</a>
                                                </h5>
                                                <h3>
                                                    @if ($software->period == "monthly")

                                                        @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($software->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($software->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif

                                                    @elseif ($software->period == "annually")

                                                        @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($software->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($software->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif

                                                    @else

                                                        @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($software->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($software->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif

                                                    @endif
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('software-page.index') }}" class="landing-button d-block mx-auto">{{ __('frontend.see_all') }}</a>
                    </div>

                </div>
            </section>
        @else
            <section class="section pb-minus-70">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="landing-section-heading">
                                <h2>Our Software</h2>
                                <p>
                                    For a professional start, you can examine our software in detail.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="product-list-item">
                                        <div class="product-img">
                                            <a href="#">
                                                <img src="{{ asset('uploads/img/dummy/310x160.jpg') }}" alt="image" class="img-fluid">
                                            </a>
                                            <div class="product-buttons">
                                                <a href="#"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <span>Full Responsive</span>
                                            <span>Cms</span>
                                            <h5>
                                                <a href="#">
                                                    DigitalTeam - Creative Portfolio & Agency Script
                                                </a>
                                            </h5>
                                            <h3><sub>$</sub>49</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="product-list-item">
                                        <div class="product-img">
                                            <a href="#">
                                                <img src="{{ asset('uploads/img/dummy/310x160.jpg') }}" alt="image" class="img-fluid">
                                            </a>
                                            <div class="product-buttons">
                                                <a href="#"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <span>Full Responsive</span>
                                            <span>Cms</span>
                                            <h5>
                                                <a href="#">
                                                    Allegro - Multipurpose Laravel CMS Script
                                                </a>
                                            </h5>
                                            <h3><sub>$</sub>69</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="product-list-item">
                                        <div class="product-img">
                                            <a href="#">
                                                <img src="{{ asset('uploads/img/dummy/310x160.jpg') }}" alt="image" class="img-fluid">
                                            </a>
                                            <div class="product-buttons">
                                                <a href="#"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <span>Full Responsive</span>
                                            <span>Cms</span>
                                            <h5>
                                                <a href="#">
                                                    Tempo - Multipurpose Laravel CMS Script
                                                </a>
                                            </h5>
                                            <h3><sub>$</sub>69</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="product-list-item">
                                        <div class="product-img">
                                            <a href="#">
                                                <img src="{{ asset('uploads/img/dummy/310x160.jpg') }}" alt="image" class="img-fluid">
                                            </a>
                                            <div class="product-buttons">
                                                <a href="#"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <span>Full Responsive</span>
                                            <span>Cms</span>
                                            <h5>
                                                <a href="#">
                                                    DigitalTeam - Creative Portfolio & Agency Script
                                                </a>
                                            </h5>
                                            <h3><sub>$</sub>49</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="product-list-item">
                                        <div class="product-img">
                                            <a href="#">
                                                <img src="{{ asset('uploads/img/dummy/310x160.jpg') }}" alt="image" class="img-fluid">
                                            </a>
                                            <div class="product-buttons">
                                                <a href="#"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <span>Full Responsive</span>
                                            <span>Cms</span>
                                            <h5>
                                                <a href="#">
                                                    Allegro - Multipurpose Laravel CMS Script
                                                </a>
                                            </h5>
                                            <h3><sub>$</sub>69</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="product-list-item">
                                        <div class="product-img">
                                            <a href="#">
                                                <img src="{{ asset('uploads/img/dummy/310x160.jpg') }}" alt="image" class="img-fluid">
                                            </a>
                                            <div class="product-buttons">
                                                <a href="#"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <span>Full Responsive</span>
                                            <span>Cms</span>
                                            <h5>
                                                <a href="#">
                                                    Tempo - Multipurpose Laravel CMS Script
                                                </a>
                                            </h5>
                                            <h3><sub>$</sub>69</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="landing-button d-block mx-auto">See All</a>
                    </div>

                </div>
            </section>
        @endif
        <!--// Product List Section End //-->
        @endif

        @if ($section_arr['partner_section'] == "show")
        <!--// Partners Section Start //-->
        @if (isset($partner_section) || count($partners) > 0)
            <section class="section pb-minus-70" id="partners">
                <div class="container">
                   @isset ($partner_section)
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="landing-section-heading">
                                    <h2>{{ $partner_section->section_title }}</h2>
                                    <p>{{ $partner_section->desc }}</p>
                                </div>
                            </div>
                        </div>
                       @endisset
                    <div class="row">
                       @foreach ($partners as $partner)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="brand-item">
                                    @if (!empty($partner->partner_image) && $partner->image_status == "show")
                                        <img src="{{ asset('uploads/img/partner/'.$partner->partner_image) }}" alt="Partner image" class="img-fluid">
                                    @endif
                                    <h5>{{ $partner->title }}</h5>
                                    @if (!empty($partner->desc)) <p>{{ $partner->desc }}</p> @endif
                                </div>
                            </div>
                           @endforeach
                    </div>
                </div>
            </section>
        @else
            <section class="section pb-minus-70" id="partners">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="landing-section-heading">
                                <h2>Some Of Our Partners</h2>
                                <p>
                                    Trusted Partner For Thousands Of Leading Digital Brands
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="brand-item">
                                <img src="{{ asset('uploads/img/dummy/120x120.jpg') }}" alt="Partner image" class="img-fluid">
                                <h5>Google</h5>
                                <p>Logo Designer</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="brand-item">
                                <img src="{{ asset('uploads/img/dummy/120x120.jpg') }}" alt="Partner image" class="img-fluid">
                                <h5>Netflix</h5>
                                <p>UI/Designer</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="brand-item">
                                <img src="{{ asset('uploads/img/dummy/120x120.jpg') }}" alt="Partner image" class="img-fluid">
                                <h5>Amazon</h5>
                                <p>Marketing</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="brand-item">
                                <img src="{{ asset('uploads/img/dummy/120x120.jpg') }}" alt="Partner image" class="img-fluid">
                                <h5>Dropbox</h5>
                                <p>Web Developer</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="brand-item">
                                <img src="{{ asset('uploads/img/dummy/120x120.jpg') }}" alt="Partner image" class="img-fluid">
                                <h5>Microsoft</h5>
                                <p>Seo Manager</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="brand-item">
                                <img src="{{ asset('uploads/img/dummy/120x120.jpg') }}" alt="Partner image" class="img-fluid">
                                <h5>Envato</h5>
                                <p>Theme Developer</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="brand-item">
                                <img src="{{ asset('uploads/img/dummy/120x120.jpg') }}" alt="Partner image" class="img-fluid">
                                <h5>Dribbble</h5>
                                <p>UI/Designer</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="brand-item">
                                <img src="{{ asset('uploads/img/dummy/120x120.jpg') }}" alt="Partner image" class="img-fluid">
                                <h5>Youtube</h5>
                                <p>Logo Designer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endif
        <!--// Partners Section End //-->
        @endif

        @if ($section_arr['blog_page'] == "show")
        <!--// Latest Blog Section Start //-->
        @if (isset($blog_section) || count($recent_posts) > 0)
            <section id="latest-blog" class="section pb-minus-70">
                <div class="container">
                  @isset ($blog_section)
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="landing-section-heading-left">
                                    <h2>{{ $blog_section->section_title }}</h2>
                                    <p>{{ $blog_section->desc }}</p>
                                </div>
                            </div>
                        </div>
                      @endisset
                    <div class="owl-carousel owl-theme" id="latestBlogCarousel">
                        @foreach ($recent_posts as $recent_post)
                            <div class="item">
                                <div class="landing-blog-item">
                                    @if (!empty($recent_post->blog_image))
                                        <div class="blog-img">
                                            <a href="{{ route('blog-page.show', ['slug' => $recent_post->slug]) }}">
                                                <img src="{{ asset('uploads/img/blog/thumbnail/'.$recent_post->blog_image) }}" alt="Blog image" class="img-fluid">
                                            </a>
                                        </div>
                                    @else
                                        <div class="blog-img">
                                            <a href="{{ route('blog-page.show', ['slug' => $recent_post->slug]) }}">
                                                <img src="{{ asset('uploads/img/dummy/no-image.jpg') }}" alt="Blog image" class="img-fluid">
                                            </a>
                                        </div>
                                    @endif

                                    <div class="blog-body">
                                        <div class="blog-meta">
                                            <a href="#"><span><i class="far fa-user"></i>@if ($recent_post->type == "with_this_account") {{ $recent_post->author_name }} @else {{ __('frontend.anonymous') }} @endif</span></a>
                                            <a href="#"><span><i class="far fa-bookmark"></i>{{ $recent_post->category_name }}</span></a>
                                        </div>
                                        <h5>
                                            <a href="{{ route('blog-page.show', ['slug' => $recent_post->slug]) }}">{{ $recent_post->title }}</a>
                                        </h5>
                                        @if (!empty($recent_post->short_desc)) <p>{{ $recent_post->short_desc }}</p> @endif
                                        <a href="{{ route('blog-page.show', ['slug' => $recent_post->slug]) }}" class="blog-link">
                                            {{ __('frontend.read_more') }}
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @else
            <section id="latest-blog" class="section pb-minus-70">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="landing-section-heading-left">
                                <h2>Latest Blog</h2>
                                <p>
                                    Stay up to date with our latest news and support
                                    your ideas by reviewing the latest blogs
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="owl-carousel owl-theme" id="latestBlogCarousel">
                        <div class="item">
                            <div class="landing-blog-item">
                                <div class="blog-img">
                                    <a href="#">
                                        <img src="{{ asset('uploads/img/dummy/600x400.jpg') }}" alt="Blog image" class="img-fluid">
                                    </a>
                                </div>
                                <div class="blog-body">
                                    <div class="blog-meta">
                                        <a href="#"><span><i class="far fa-user"></i>By Admin</span></a>
                                        <a href="#"><span><i class="far fa-bookmark"></i>Design</span></a>
                                    </div>
                                    <h5>
                                        <a href="#">
                                            How To Create A Design Brief
                                        </a>
                                    </h5>
                                    <p>
                                        It is a long established fact that a reader will be distracted [..]
                                    </p>
                                    <a href="#" class="blog-link">
                                        Read More
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="landing-blog-item">
                                <div class="blog-img">
                                    <a href="#">
                                        <img src="{{ asset('uploads/img/dummy/600x400.jpg') }}" alt="Blog image" class="img-fluid">
                                    </a>
                                </div>
                                <div class="blog-body">
                                    <div class="blog-meta">
                                        <a href="#"><span><i class="far fa-user"></i>By Admin</span></a>
                                        <a href="#"><span><i class="far fa-bookmark"></i>Design</span></a>
                                    </div>
                                    <h5>
                                        <a href="#">
                                            Work On The Latest UI Design Models
                                        </a>
                                    </h5>
                                    <p>
                                        It is a long established fact that a reader will be distracted [..]
                                    </p>
                                    <a href="#" class="blog-link">
                                        Read More
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="landing-blog-item">
                                <div class="blog-img">
                                    <a href="#">
                                        <img src="{{ asset('uploads/img/dummy/600x400.jpg') }}" alt="Blog image" class="img-fluid">
                                    </a>
                                </div>
                                <div class="blog-body">
                                    <div class="blog-meta">
                                        <a href="#"><span><i class="far fa-user"></i>By Admin</span></a>
                                        <a href="#"><span><i class="far fa-bookmark"></i>Design</span></a>
                                    </div>
                                    <h5>
                                        <a href="#">
                                            The Golden Rule Between Unique Design
                                        </a>
                                    </h5>
                                    <p>
                                        It is a long established fact that a reader will be distracted [..]
                                    </p>
                                    <a href="#" class="blog-link">
                                        Read More
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="landing-blog-item">
                                <div class="blog-img">
                                    <a href="#">
                                        <img src="{{ asset('uploads/img/dummy/600x400.jpg') }}" alt="Blog image" class="img-fluid">
                                    </a>
                                </div>
                                <div class="blog-body">
                                    <div class="blog-meta">
                                        <a href="#"><span><i class="far fa-user"></i>By Admin</span></a>
                                        <a href="#"><span><i class="far fa-bookmark"></i>Wordpress</span></a>
                                    </div>
                                    <h5>
                                        <a href="#">
                                            How to set up a Wordpress website ?
                                        </a>
                                    </h5>
                                    <p>
                                        It is a long established fact that a reader will be distracted [..]
                                    </p>
                                    <a href="#" class="blog-link">
                                        Read More
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endif
        <!--// Latest Blog Section End //-->
        @endif

        @if ($section_arr['faq_page'] == "show")
        <!--// Faq Question Section Start //-->
        @if (isset($faq_section) || count($faqs) > 0)
            <section class="section" id="faq-question">
                <div class="container">
                   @isset ($faq_section)
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="landing-section-heading">
                                    <h2>{{ $faq_section->section_title }}</h2>
                                    <p>{{ $faq_section->desc }}</p>
                                </div>
                            </div>
                        </div>
                       @endisset
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="faq-accordion-wrap">
                                @foreach ($faqs as $faq)
                                    <div class="accordion-item">
                                        <div class="accordion-item-header" id="accordionHeader{{ $loop->index }}">
                                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#accordionItem{{ $loop->index }}" aria-expanded="false" aria-controls="accordionItem{{ $loop->index }}" class="collapsed">
                                                <span>{{ $faq->question }}</span>
                                            </a>
                                        </div>
                                        <div id="accordionItem{{ $loop->index }}" class="collapse" aria-labelledby="accordionHeader{{ $loop->index }}" style="">
                                            <div class="accordion-body">
                                                <p>{{ $faq->answer }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('any-page.show_faq') }}" class="landing-button d-block mx-auto mt-5">{{ __('frontend.see_all') }}</a>
                    </div>
                </div>
            </section>
        @else
            <section class="section" id="faq-question">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="landing-section-heading">
                                <h2>Faq Question</h2>
                                <p>
                                    Subscribe to our system and buy one of the packages and benefit from the advantages.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="faq-accordion-wrap">
                                <div class="accordion-item">
                                    <div class="accordion-item-header" id="accordionHeaderOne">
                                        <a href="javascript:void(0)" data-toggle="collapse" data-target="#accordionItemOne" aria-expanded="false" aria-controls="accordionItemOne" class="collapsed">
                                            <span>How can i buy package ?</span>
                                        </a>
                                    </div>
                                    <div id="accordionItemOne" class="collapse" aria-labelledby="accordionHeaderOne" style="">
                                        <div class="accordion-body">
                                            <p>
                                                It is a long established fact that a reader will be distracted by the
                                                readable content of a page when looking at its layout. The point of using
                                                Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                                                as opposed to using 'Content here, content here', making it look like readable
                                                English.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div class="accordion-item-header" id="accordionHeaderTwo">
                                        <a href="javascript:void(0)" data-toggle="collapse" data-target="#accordionItemTwo" aria-expanded="false" aria-controls="accordionItemTwo">
                                            <span>How do i return the package ?</span>
                                        </a>
                                    </div>
                                    <div id="accordionItemTwo" class="collapse" aria-labelledby="accordionHeaderTwo">
                                        <div class="accordion-body">
                                            <p>
                                                It is a long established fact that a reader will be distracted by the
                                                readable content of a page when looking at its layout. The point of using
                                                Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                                                as opposed to using 'Content here, content here', making it look like readable
                                                English.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div class="accordion-item-header" id="accordionHeaderThree">
                                        <a href="javascript:void(0)" data-toggle="collapse" data-target="#accordionItemThree" aria-expanded="false" aria-controls="accordionItemThree">
                                            <span>How to change profile info ?</span>
                                        </a>
                                    </div>
                                    <div id="accordionItemThree" class="collapse" aria-labelledby="accordionHeaderThree">
                                        <div class="accordion-body">
                                            <p>
                                                It is a long established fact that a reader will be distracted by the
                                                readable content of a page when looking at its layout. The point of using
                                                Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                                                as opposed to using 'Content here, content here', making it look like readable
                                                English.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div class="accordion-item-header" id="accordionHeaderFour">
                                        <a href="javascript:void(0)" data-toggle="collapse" data-target="#accordionItemFour" aria-expanded="false" aria-controls="accordionItemFour">
                                            <span>How do i open notifications ?</span>
                                        </a>
                                    </div>
                                    <div id="accordionItemFour" class="collapse" aria-labelledby="accordionHeaderFour">
                                        <div class="accordion-body">
                                            <p>
                                                It is a long established fact that a reader will be distracted by the
                                                readable content of a page when looking at its layout. The point of using
                                                Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                                                as opposed to using 'Content here, content here', making it look like readable
                                                English.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endif
        <!--// Faq Question Section End //-->
        @endif

        @if ($section_arr['contact_section'] == "show")
        <!--// Contact Section Start //-->
        @isset ($contact)
            <section id="contact" class="section">
                <div class="container">
                    @include('frontend.alert.alert-contact')
                    <div class="row align-items-center">
                        @if (!empty($contact->contact_image) && $contact->image_status == "show")
                            <div class="col-lg-5">
                                <img src="{{ asset('uploads/img/contact/'.$contact->contact_image) }}" alt="image" class="img-fluid">
                            </div>
                            @endif
                        <div class="@if (!empty($contact->contact_image) && $contact->image_status == "show") col-lg-7 @else col-lg-12 @endif">
                            <div class="landing-form-inner">
                                @if (!empty($contact->section_title)) <h2>{{ $contact->section_title }}</h2> @endif
                                @if (!empty($contact->subject))
                                    @php
                                        $str = $contact->subject;
                                        $array_subjects = explode(",",$str);
                                    @endphp
                                @endif
                                <form action="{{ route('message.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="landing-f-group">
                                                <label for="name">{{ __('frontend.your_name') }} <span class="text-danger">*</span></label>
                                                <input id="name" type="text" class="landing-f-control" autocomplete="off" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="landing-f-group">
                                                <label for="email">{{ __('frontend.your_email') }} <span class="text-danger">*</span></label>
                                                <input id="email" type="email" class="landing-f-control" autocomplete="off" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group">
                                                <label for="contactSubject">{{ __('frontend.subject') }} <span class="text-danger">*</span></label>
                                                <select name="subject" class="landing-f-control" id="contactSubject" required>
                                                    <option value="">{{ __('frontend.choose_subject') }}</option>
                                                    @if (!empty($contact->subject))
                                                        @foreach ($array_subjects as $subject)
                                                            <option value="{{ $subject }}">{{ $subject }}</option>
                                                        @endforeach
                                                    @endif
                                                    <option value="{{ __('frontend.other') }}">{{ __('frontend.other') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group">
                                                <label for="message">{{ __('frontend.your_message') }}  <span class="text-danger">*</span></label>
                                                <textarea name="message" id="message" class="landing-f-control" cols="30" rows="6" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group mb-0">
                                                <button type="submit" class="contact-button">{{ __('frontend.send_message') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @else
            <section id="contact" class="section">
                <div class="container">
                    @include('frontend.alert.alert-contact')
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <img src="{{ asset('uploads/img/dummy/600x550.jpg') }}" alt="image" class="img-fluid">
                        </div>
                        <div class="col-lg-7">
                            <div class="landing-form-inner">
                                <h2>Get In Touch</h2>
                                @if (!empty($contact->subject))
                                    @php
                                        $str = $contact->subject;
                                        $array_subjects = explode(",",$str);
                                    @endphp
                                @endif
                                <form action="{{ route('message.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="landing-f-group">
                                                <label for="name">{{ __('frontend.your_name') }} <span class="text-danger">*</span></label>
                                                <input id="name" type="text" class="landing-f-control" autocomplete="off" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="landing-f-group">
                                                <label for="email">{{ __('frontend.your_email') }} <span class="text-danger">*</span></label>
                                                <input id="email" type="email" class="landing-f-control" autocomplete="off" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group">
                                                <label for="contactSubject">{{ __('frontend.subject') }} <span class="text-danger">*</span></label>
                                                <select name="subject" class="landing-f-control" id="contactSubject" required>
                                                    <option value="">{{ __('frontend.choose_subject') }}</option>
                                                    @if (!empty($contact->subject))
                                                        @foreach ($array_subjects as $subject)
                                                            <option value="{{ $subject }}">{{ $subject }}</option>
                                                        @endforeach
                                                    @endif
                                                    <option value="{{ __('frontend.other') }}">{{ __('frontend.other') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group">
                                                <label for="message">{{ __('frontend.your_message') }} <span class="text-danger">*</span></label>
                                                <textarea name="message" id="message" class="landing-f-control" cols="30" rows="6" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="landing-f-group mb-0">
                                                <button type="submit" class="contact-button">{{ __('frontend.send_message') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endisset
        <!--// Contact Section End //-->
        @endif

        @if ($section_arr['footer_section'] == "show")
        <!--// Footer Start //-->
        @if (isset($site_info) || count($socials) > 0 || count($footer_pages) > 0)
            <footer class="footer footer-landing">
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 footer-widget-resp">
                                <div class="footer-widget">
                                    <h6 class="footer-title">{{ __('frontend.about_us') }}</h6>
                                    @if (!empty($general_site_image->site_colored_logo_image))
                                        <img src="{{ asset('uploads/img/general/'.$general_site_image->site_colored_logo_image) }}" alt="logo image" class="img-fluid footer-logo">
                                    @endif
                                    @if (!empty($site_info->short_desc)) <p class="footer-desc">{{ $site_info->short_desc }}</p> @endif
                                    <div class="footer-social-links">
                                        @foreach ($socials as $social)
                                            <a href="@if (!empty($social->link)) {{ $social->link }} @else # @endif">
                                                <i class="{{ $social->social_media }}"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if (count($footer_pages) > 0)
                                <div class="col-md-6 col-lg-4 footer-widget-resp">
                                    <div class="footer-widget footer-widget-pl">
                                        <h6 class="footer-title">{{ __('frontend.helper_links') }}</h6>
                                        <ul class="footer-links">
                                            @foreach ($footer_pages as $footer_page)
                                                <li>
                                                    <a href="{{ route('any-page.show', ['page_slug' => $footer_page->page_slug]) }}">{{ $footer_page->page_title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6 col-lg-4 footer-widget-resp">
                                <div class="footer-widget">
                                    <h6 class="footer-title">Contact Info</h6>
                                    <div class="footer-contact-info-wrap">
                                        <ul class="footer-contact-info-list">
                                            @if (!empty($site_info->address))
                                                <li>
                                                    <span class="fa fa-map-marker"></span>
                                                    <p>{{ $site_info->address }} </p>
                                                    @if (!empty($site_info->address_map_link))
                                                        <a href="{{ $site_info->address_map_link }}" class="mr-3 ml-3"> <span class="fas fa-link"></span></a>
                                                    @endif
                                                </li>
                                            @endif
                                                @if (!empty($site_info->phone))
                                                    <li>
                                                        <span class="fa fa-phone-volume"></span>
                                                        <p>{{ $site_info->phone }}</p>
                                                    </li>
                                                @endif
                                            @if (!empty($site_info->email))
                                                <li>
                                                    <span class="fa fa-envelope-open-text"></span>
                                                    <p>{{ $site_info->email }}</p>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               @if (!empty($site_info->copyright))
                    <div class="copyright">
                        <div class="container">
                            <p class="copyright-text">{{ $site_info->copyright }}</p>
                        </div>
                    </div>
                   @endif
            </footer>
        @else
            <footer class="footer footer-landing">
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 footer-widget-resp">
                                <div class="footer-widget">
                                    <h6 class="footer-title">About Us</h6>
                                    <img src="{{ asset('uploads/img/dummy/logo-footer-black.png') }}" alt="logo image" class="img-fluid footer-logo">
                                    <p class="footer-desc">
                                        We use the latest version products to advance
                                        our company, we provide continuous support
                                    </p>
                                    <div class="footer-social-links">
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 footer-widget-resp">
                                <div class="footer-widget footer-widget-pl">
                                    <h6 class="footer-title">Helper Links</h6>
                                    <ul class="footer-links">
                                        <li>
                                            <a href="javascript:void(0)">Support</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Services</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Testimonial</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Documentation</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Privacy Policy</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Terms & Condition</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 footer-widget-resp">
                                <div class="footer-widget">
                                    <h6 class="footer-title">Contact Info</h6>
                                    <div class="footer-contact-info-wrap">
                                        <ul class="footer-contact-info-list">
                                            <li>
                                                <span class="fa fa-map-marker"></span>
                                                <p>
                                                    1395 Nixon Avenue Etowah,
                                                    <br>
                                                    TN 37331
                                                    United States
                                                </p>
                                            </li>
                                            <li>
                                                <span class="fa fa-phone-volume"></span>
                                                <div class="text">
                                                    <p> +1 200-444-4444 <br> +1 200-555-2244</p>

                                                </div>
                                            </li>
                                            <li>
                                                <span class="fa fa-envelope-open-text"></span>
                                                <p>
                                                    paconyoffice@info.com
                                                    <br>
                                                    paconyshop@info.com
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <div class="container">
                        <p class="copyright-text">© Copyright 2022. Pacony</p>
                    </div>
                </div>
            </footer>
    @endif
        <!--// Footer End //-->
        @endif

    </main>
    <!--// Main Area End //-->

    @if ($section_arr['scroll_top_btn'] == "show")
    <a href="#" class="landing scroll-top-btn" data-scroll-goto="1">
        <i class="fa fa-arrow-up"></i>
    </a>
    <!--// .scroll-top-btn // -->
    @endif

    @if ($section_arr['preloader'] == "show")
    <div id="preloader-wrap">
        <div class="preloader-inner">
            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
    <!--// Preloader // -->
    @endif


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


    @if ($section_arr['whatsapp_button'] == "show")
    @if (isset($whatsapp_chat_section) || count($whatsapp_chats) > 0)
        @if (count($whatsapp_chats) == 1)
        <!--// Only Button //-->

            @foreach ($whatsapp_chats as $whatsapp_chat)
                <a href="#" id="whatsappButtonOnly"  data-phone-number="{{ $whatsapp_chat->phone }}" data-text="">
                    <i class="fab fa-whatsapp" id="iconWhtsapp"></i>
                </a>
                @php unset($whatsapp_chat); @endphp
                @endforeach

            @else
            <!--// Multiple Team Button //-->
            <a href="#" id="whatsappMultipleBtn">
                <i class="fab fa-whatsapp" id="iconWhtsapp"></i>
                <i class="fa fa-times" id="iconTimes"></i>
            </a>

            <!--// Whatsapp Popup Start //-->
            <div class="whatsapp-wrapp" id="whatsappMultipleChat">
                    <div class="wtsp-header">
                        @isset ($whatsapp_chat_section)
                        <h6>{{ $whatsapp_chat_section->title }}</h6>
                        <p>{{ $whatsapp_chat_section->desc }}</p>
                        @endisset
                        <button id="whatsappMultipleChatCloseBtn"><i class="fa fa-times"></i></button>
                    </div>
                <div class="wtsp-body">
                    @foreach ($whatsapp_chats as $whatsapp_chat)
                        <div class="wtsp-team-item @if ($whatsapp_chat->accessibility == "online") online @else ofline @endif" data-phone-number="{{ $whatsapp_chat->phone }}" data-text="">
                            <div class="img">
                               @if (!empty($whatsapp_chat->whatsapp_chat_image) && $whatsapp_chat->image_status == "show")
                                    <img src="{{ asset('uploads/img/whatsapp_chat/'.$whatsapp_chat->whatsapp_chat_image) }}" alt="image" class="img-fluid">
                                @else
                                    <img src="{{ asset('uploads/img/dummy/70x70.jpg') }}" alt="image" class="img-fluid">
                                   @endif
                                <span></span>
                            </div>
                            <div class="details">
                                <h6>{{ $whatsapp_chat->name }}</h6>
                                <p>{{ $whatsapp_chat->job }}</p>
                                @if ($whatsapp_chat->accessibility == "online")
                                    <span>{{ __('frontend.i_am_online') }}</span>
                                    @else
                                    <span>{{ __('frontend.i_am_not_available_today') }}</span>
                                @endif
                            </div>
                        </div>
                        @endforeach

                </div>
            </div>
            <!--// Whatsapp Popup End //-->
            @endif

        @else
    <!--// Multiple Team Button //-->
        <a href="#" id="whatsappMultipleBtn">
            <i class="fab fa-whatsapp" id="iconWhtsapp"></i>
            <i class="fa fa-times" id="iconTimes"></i>
        </a>

        <!--// Only Button //-->
        <a href="#" id="whatsappButtonOnly" class="d-none" data-phone-number="+905415972553" data-text="Hi,Im John Doe.">
            <i class="fab fa-whatsapp" id="iconWhtsapp"></i>
        </a>

        <!--// Whatsapp Popup Start //-->
        <div class="whatsapp-wrapp" id="whatsappMultipleChat">
            <div class="wtsp-header">
                <h6>Need help? chat with us</h6>
                <p>Click on one of our teams below.</p>
                <button id="whatsappMultipleChatCloseBtn"><i class="fa fa-times"></i></button>
            </div>
            <div class="wtsp-body">
                <div class="wtsp-team-item online" data-phone-number="+905415972553" data-text="Hi,Im John Doe.">
                    <div class="img">
                        <img src="{{ asset('uploads/img/dummy/70x70.jpg') }}" alt="image" class="img-fluid">
                        <span></span>
                    </div>
                    <div class="details">
                        <h6>John Doe</h6>
                        <p>Sales Support</p>
                        <span>I'm Online</span>
                    </div>
                </div>
                <div class="wtsp-team-item online" data-phone-number="+905415972553" data-text="Hi,Im John Doe.">
                    <div class="img">
                        <img src="{{ asset('uploads/img/dummy/70x70.jpg') }}" alt="image" class="img-fluid">
                        <span></span>
                    </div>
                    <div class="details">
                        <h6>Robert William</h6>
                        <p>Customer Support</p>
                        <span>I'm Online</span>
                    </div>
                </div>
                <div class="wtsp-team-item ofline" data-phone-number="+905416931618">
                    <div class="img">
                        <img src="{{ asset('uploads/img/dummy/70x70.jpg') }}" alt="image" class="img-fluid">
                        <span></span>
                    </div>
                    <div class="details">
                        <h6>John Doe</h6>
                        <p>Customer Support</p>
                        <span>I am not available today</span>
                    </div>
                </div>

            </div>
        </div>
        <!--// Whatsapp Popup End //-->
    @endif
    @endif


</div>
<!--// Page Wrapper End //-->






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

@if ($section_arr['tawk_to_button'] == "show")
    @isset ($tawk_to)
        <script>
            @php echo html_entity_decode($tawk_to->tawk_to); @endphp
        </script>
    @endisset
@endif

</body>
</html>