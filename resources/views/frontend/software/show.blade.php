@extends('layouts.frontend.master')

@section('content')

    <!--// Breadcrumb Section Start //-->
    <section class="breadcrumb-section section" data-scroll-index="1" @if ($software->breadcrumb_status == "yes" && !empty($software->custom_breadcrumb_image))
    data-bg-image-path = "{{ asset('uploads/img/software/breadcrumb/'.$software->custom_breadcrumb_image) }}"
             @elseif (isset($breadcrumb)) data-bg-image-path = "{{ asset('uploads/img/general/'.$breadcrumb->breadcrumb_image) }}"
             @else data-bg-image-path="{{ asset('uploads/img/dummy/1920x750.jpg') }}"
            @endif>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb-inner">
                        <h1>{{ $software->title }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ $software->title }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Breadcrumb Section end //-->

    <!--// Product Details Section Start //-->
    <section class="section sidebar-wrapper pb-minus-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product-desc">
                        @if (!empty($software->software_image) && $software->image_status == "show")
                            <div class="product-desc-img">
                                <img src="{{ asset('uploads/img/software/'.$software->software_image) }}" alt="Product image" class="img-fluid">
                            </div>
                        @endif
                        <div class="product-desc-text">
                            <h4>{{ $software->title }}</h4>
                            <p>@php echo html_entity_decode($software->desc); @endphp</p>
                        </div>
                    </div>
                </div>
                @php
                    $str = $software->software_feature_list;
                    $array_features = explode(",", $str);
                @endphp
                <div class="col-lg-4">
                    @if ($str != null)
                        <div class="sidebar-demo-list">
                            <ul>
                                @foreach ($array_features as $tag)
                                    <li>{{ $tag }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="sidebar-demo-share">
                        <ul>
                            <li>
                                <a href="{{$software->getShareUrl('twitter')}}" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{$software->getShareUrl('whatsapp')}}" target="_blank">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{$software->getShareUrl('pinterest')}}" target="_blank">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-demo-price">
                        <h3>
                            @if ($software->period == "monthly")

                                @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($software->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($software->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif

                            @elseif ($software->period == "annually")

                                @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($software->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($software->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif

                            @else

                                @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($software->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($software->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif

                            @endif
                        </h3>
                        <h6>
                            @if ($software->period == "monthly")
                                ({{ __('frontend.monthly') }})
                            @elseif ($software->period == "annually")
                                ({{ __('frontend.annually') }})
                            @else
                                 ({{ __('frontend.onetime') }})
                            @endif
                        </h6>
                    </div>
                    <div class="sidebar-demo-buttons">
                        @isset($general_order_mode)
                            @if($general_order_mode->order_mode == "with_free_trial")
                                <a href="{{ route('demo-request-page.show_demo_software', ['slug' => $software->software_slug]) }}" class="demo-buy-btn">{{ __('frontend.lets_call_you') }}</a>
                            @elseif ($general_order_mode->order_mode == "via_whatsapp")
                                @if (!empty($software->demo_site_url))
                                    <a href="{{ $software->demo_site_url }}" class="demo-site-btn"><i class="fa fa-eye"></i> {{ __('frontend.demo_site') }}</a>
                                @endif
                                @if (!empty($software->demo_panel_url))
                                    <a href="{{ $software->demo_panel_url }}" class="demo-admin-btn"><i class="fa fa-cog"></i> {{ __('frontend.demo_panel') }}</a>
                                @endif
                                    @if (!empty($software->phone_number))
                                        <a href="tel:{{ $software->phone_number }}" class="demo-buy-btn">{{ __('frontend.call_now') }}</a>
                                    @endif
                                @if (!empty($software->whatsapp_phone_number))
                                        <a href="{{ route('order-via-whatsapp-page.show', ['slug' => $software->software_slug]) }}" class="demo-buy-btn">{{ __('frontend.via_whatsapp') }}</a>
                                    @endif
                            @else
                                @if (!empty($software->demo_site_url))
                                    <a href="{{ $software->demo_site_url }}" class="demo-site-btn"><i class="fa fa-eye"></i> {{ __('frontend.demo_site') }}</a>
                                @endif
                                @if (!empty($software->demo_panel_url))
                                    <a href="{{ $software->demo_panel_url }}" class="demo-admin-btn"><i class="fa fa-cog"></i> {{ __('frontend.demo_panel') }}</a>
                                @endif
                                <a href="{{ route('order-software-period-page.show', ['slug' => $software->software_slug]) }}" class="demo-buy-btn"><i class="fa fa-shopping-cart"></i> {{ __('frontend.buy_now') }}</a>
                            @endif
                        @else
                            <a href="{{ route('demo-request-page.show_demo_software', ['slug' => $software->software_slug]) }}" class="demo-buy-btn">{{ __('frontend.lets_call_you') }}</a>
                        @endisset
                    </div>
                        @php
                            $str2 = $software->server_requirement;
                            $array_requirements = explode(",", $str2);
                        @endphp
                        @if ($str2 != null)
                            <div class="sidebar-demo-requriments">
                                <h6>{{ __('frontend.requirements') }}</h6>
                                <ul>
                                    @foreach ($array_requirements as $requirement)
                                        <li>{{ $requirement }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                </div>
            </div>
        </div>
        <div class="container d-none">
            <div class="product-list-slider">
                <h2 class="product-list-header">Most Popular Scripts</h2>
                <div class="owl-carousel owl-theme" id="productListCarousel">
                    <div class="item">
                        <div class="product-list-item">
                            <div class="product-img">
                                <a href="product-detail.html">
                                    <img src="img/bg/digital-team-preview.png" alt="Blog image" class="img-fluid">
                                </a>
                                <div class="product-buttons">
                                    <a href="#"><i class="fa fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-body">
                                <span>Full Responsive</span>
                                <span>Cms</span>
                                <h5>
                                    <a href="product-detail.html">
                                        DigitalTeam - Creative Portfolio & Agency Script
                                    </a>
                                </h5>
                                <h3><sub>$</sub>49</h3>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-list-item">
                            <div class="product-img">
                                <a href="product-detail.html">
                                    <img src="img/bg/01_allegro_preview_img.png" alt="Blog image" class="img-fluid">
                                </a>
                                <div class="product-buttons">
                                    <a href="#"><i class="fa fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-body">
                                <span>Full Responsive</span>
                                <span>Cms</span>
                                <h5>
                                    <a href="product-detail.html">
                                        Allegro - Multipurpose Laravel CMS Script
                                    </a>
                                </h5>
                                <h3><sub>$</sub>69</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Product Details Section End //-->


@endsection
