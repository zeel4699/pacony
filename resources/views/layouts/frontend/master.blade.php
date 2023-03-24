<!DOCTYPE html>
<html dir="@if (session()->has('language_direction_from_dropdown')) @if(session()->get('language_direction_from_dropdown') == 1) {{ __('rtl') }} @else {{ __('ltr') }} @endif @else {{ __('ltr') }} @endif" lang="@if (session()->has('language_code_from_dropdown')){{ str_replace('_', '-', session()->get('language_code_from_dropdown')) }}@else{{ str_replace('_', '-',   $language->language_code) }}@endif">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="title" content="@if (isset($general_seo)){{ $general_seo->site_name }} @endif">
    <meta name="description" content="@if (isset($service)) {{ $service->meta_desc }} @elseif (isset($software)) {{ $software->meta_desc }} @elseif (isset($general_seo)) {{ $general_seo->site_desc }} @endif">
    <meta name="keywords" content="@if (isset($service)) {{ $service->meta_keyword }} @elseif (isset($software)) {{ $software->meta_keyword }} @elseif (isset($general_seo)) {{ $general_seo->site_keywords }} @endif">
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
<body  data-spy="scroll" data-target="#fixedNavbar" @if (session()->has('language_direction_from_dropdown')) @if(session()->get('language_direction_from_dropdown') == 1)  class="rtl-mode" @endif @elseif (isset($language)) @if ($language->direction == 1) class="rtl-mode" @endif  @endif>

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
                                        <a href="{{ $external_url->btn_link }}" class="landing-button"><span>{{ $external_url->btn_name }}</span></a>
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

    @yield('content')

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
                                        <h6 class="footer-title">{{ __('frontend.contact_info') }}</h6>
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

    @if ($section_arr['preloader'] == "show")
        <div id="preloader-wrap">
            <div class="preloader-inner">
                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
        </div>
        <!--// Preloader // -->
    @endif

    @if ($section_arr['scroll_top_btn'] == "show")
        <a href="#" class="landing scroll-top-btn" data-scroll-goto="1">
            <i class="fa fa-arrow-up"></i>
        </a>
        <!--// .scroll-top-btn // -->
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