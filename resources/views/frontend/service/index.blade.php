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
                        <h1>{{ __('frontend.services') }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ __('frontend.services') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Breadcrumb Section end //-->

    <!--// Pricing Section Start //-->
    @if (count($services) > 0)
        <section class="section pb-minus-70" id="pricing">
            <div class="container">
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
                <div class="row">
                    <div class="col-xl-12">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="section sidebar-wrapper padding-minus-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                          {{ __('frontend.updating') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--// Pricing Section End //-->

@endsection
