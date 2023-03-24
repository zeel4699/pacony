@extends('layouts.frontend.master')

@section('content')

    <!--// Breadcrumb Section Start //-->
    <section class="breadcrumb-section section" data-scroll-index="1" @if (isset($service))
    @if (!empty($service->custom_breadcrumb_image) && $service->breadcrumb_status == "yes")
    data-bg-image-path="{{ asset('uploads/img/service/breadcrumb/'.$service->custom_breadcrumb_image) }}"
             @elseif (isset($breadcrumb))
             data-bg-image-path="{{ asset('uploads/img/general/'.$breadcrumb->breadcrumb_image) }}"
             @else data-bg-image-path="{{ asset('uploads/img/dummy/1920x750.jpg') }}"
             @endif
             @else
             @if (!empty($software->custom_breadcrumb_image) && $software->breadcrumb_status == "yes")
             data-bg-image-path="{{ asset('uploads/img/software/breadcrumb/'.$software->custom_breadcrumb_image) }}"
             @elseif (isset($breadcrumb))
             data-bg-image-path="{{ asset('uploads/img/general/'.$breadcrumb->breadcrumb_image) }}"
             @else data-bg-image-path="{{ asset('uploads/img/dummy/1920x750.jpg') }}"
            @endif
            @endif>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb-inner">
                        <h1>{{ __('frontend.order_via_whatsapp') }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ __('frontend.order_via_whatsapp') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Breadcrumb Section End //-->

    <!--// Price Section Start //-->
    <section class="section pb-minus-70" id="contact">
        <div class="container">
            <div class="row">
                @isset ($service)
                    <div class="col-lg-4 col-md-6 pricing-border">
                        <div class="pricing-card">
                            <div class="pricing-card-header">
                                <h2>{{ $service->service_name }}</h2>
                                @if (!empty($service->demo_link))
                                    <p><a href="{{ $service->demo_link }}">{{ __('frontend.see_demo') }} <i class="fa fa-arrow-right"></i></a></p>
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
                            </div>
                        </div>
                    </div>
                @else
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
                @endisset
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div id="demo">
                        <div class="landing-form-inner">
                            <form action="{{ route('order-via-whatsapp-page.store') }}" method="POST">
                                @csrf

                                @isset ($service)
                                    <input type="hidden" name="hidden_service_slug" value="{{ $slug }}">
                                @else
                                    <input type="hidden" name="hidden_software_slug" value="{{ $slug }}">
                                @endisset
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
                                            <button type="submit" class="contact-button">{{ __('frontend.order_via_whatsapp') }}</button>
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
    <!--// Price Section Start //-->


@endsection
