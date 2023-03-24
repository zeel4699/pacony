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
                        <h1>{{ __('frontend.order_period') }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ __('frontend.order_period') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Breadcrumb Section end //-->

    <!--// Order Details Section Start //-->
    <section class="section sidebar-wrapper" id="order-details">
        <div class="container">
            @include('frontend.alert.alert-general')
            <div class="row">
                <div class="col-lg-6 col-md-6 order-item-border">
                    <div class="order-item active">
                        <h2>1</h2>
                        <p>Service Period</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 order-item-border">
                    <div class="order-item">
                        <h2>2</h2>
                        <p>Go To Cart</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="form-heading">
                        <h2>Service Period Selection</h2>
                        <p>Select the renewal period for your service. Discounts for long-term rentals.</p>
                    </div>
                    <div class="step-one-form">
                        <form action="{{ route('add-to-cart-page.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="selection_price" value="@if ($service->period == "monthly") 0 @elseif ($service->period == "annually") 1 @else 2 @endif">
                            <input type="hidden" name="hidden_order_id" value="{{ $service->id }}">
                            <div class="row">
                                @if ($service->period == "monthly")
                                    <div class="col-lg-4">
                                        <div class="step-one-price-box active" data-price-value="0">
                                            <h5>Monthly</h5>
                                            <h2>
                                                @if ($currency_position == "left") {{ $currency_symbol }}{{ number_format($service->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($service->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }}{{ $currency_symbol }} @endif
                                            </h2>
                                        </div>
                                    </div>
                                @elseif ($service->monthly_price != null)
                                    <div class="col-lg-4">
                                        <div class="step-one-price-box" data-price-value="0">
                                            <h5>Monthly</h5>
                                            <h2>
                                                @if ($currency_position == "left") {{ $currency_symbol }}{{ number_format($service->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($service->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }}{{ $currency_symbol }} @endif
                                            </h2>
                                        </div>
                                    </div>
                                @endif
                                @if ($service->period == "annually")
                                    <div class="col-lg-4">
                                        <div class="step-one-price-box active" data-price-value="1">
                                            <h5>Annually</h5>
                                            <h2>
                                                @if ($currency_position == "left") {{ $currency_symbol }}{{ number_format($service->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($service->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }}{{ $currency_symbol }} @endif
                                            </h2>
                                        </div>
                                    </div>
                                @elseif ($service->annually_price != null)
                                        <div class="col-lg-4">
                                            <div class="step-one-price-box" data-price-value="1">
                                                <h5>Annually</h5>
                                                <h2>
                                                    @if ($currency_position == "left") {{ $currency_symbol }}{{ number_format($service->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($service->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }}{{ $currency_symbol }} @endif
                                                </h2>
                                            </div>
                                        </div>
                                @endif
                                    @if ($service->period == "onetime")
                                        <div class="col-lg-4">
                                            <div class="step-one-price-box active" data-price-value="2">
                                                <h5>One Time</h5>
                                                <h2>
                                                    @if ($currency_position == "left") {{ $currency_symbol }}{{ number_format($service->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($service->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }}{{ $currency_symbol }} @endif
                                                </h2>
                                            </div>
                                        </div>
                                    @elseif ($service->onetime_price != null)
                                        <div class="col-lg-4">
                                            <div class="step-one-price-box" data-price-value="2">
                                                <h5>One Time</h5>
                                                <h2>
                                                    @if ($currency_position == "left") {{ $currency_symbol }}{{ number_format($service->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($service->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }}{{ $currency_symbol }} @endif
                                                </h2>
                                            </div>
                                        </div>
                                    @endif
                            </div>
                            <button class="landing-button border-0 mt-4" type="submit">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Product Details Section End //-->

@endsection
