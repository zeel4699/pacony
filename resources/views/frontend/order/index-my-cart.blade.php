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
                        <h1>{{ __('frontend.my_cart') }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ __('frontend.my_cart') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Breadcrumb Section end //-->


    <!--// Shopping Card Section Start //-->
    <section class="section sidebar-wrapper">
        <div class="container">
            @include('frontend.alert.alert-general')
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping-card-header">
                        <div class="shopping-card-header-info">
                            <h6>Ürün / Hizmet</h6>
                        </div>
                        <div class="shopping-card-header-period">
                            <h6>Period</h6>
                        </div>
                        <div class="shopping-card-header-price">
                            <h6>Price</h6>
                        </div>
                    </div>
                    <div class="shopping-card-wrapper">
                        @php
                            $tax = 0;
                            $order_price = 0;
                            $total_order_price = 0;
                        @endphp
                        @if (count($carts) > 0)
                            @foreach ($carts as  $cart)
                                @if ($cart->type == "service" && $cart->service->status == "published")
                                    @php
                                        // If there is an update in the price periods by the admin, the active price will be presented to the user.
                                        // 0 = monthly, 1 = annually, 2 = onetime (represents the payment.)
                                        if ($cart->selected_price == 0) {

                                        if ($cart->service->monthly_price == null) {

                                          if ($cart->service->period == "annually") {
                                          $service_price = $cart->service->annually_price;
                                          } elseif ($cart->service->period == "onetime") {
                                          $service_price = $cart->service->onetime_price;
                                          }

                                        } else {
                                          $service_price = $cart->service->monthly_price;
                                        }

                                        } elseif ($cart->selected_price == 1) {

                                        if ($cart->service->annually_price == null) {

                                          if ($cart->service->period == "monthly") {
                                          $service_price = $cart->service->monthly_price;
                                          } elseif ($cart->service->period == "onetime") {
                                          $service_price = $cart->service->onetime_price;
                                          }

                                        } else {
                                          $service_price = $cart->service->annually_price;
                                        }

                                        } elseif ($cart->selected_price == 2) {

                                        if ($cart->service->onetime_price == null) {

                                          if ($cart->service->period == "monthly") {
                                          $service_price = $cart->service->monthly_price;
                                          } elseif ($cart->service->period == "annually") {
                                          $service_price = $cart->service->annually_price;
                                          }

                                        } else {
                                          $service_price = $cart->service->onetime_price;
                                        }

                                        }

                                        // Tax value check
                                            if ($cart->service->tax_value == null) {
                                                $tax_value = 0;
                                            }

                                            $order_price = $order_price + $cart->product_quantity * $service_price;
                                            $tax = $tax + $cart->product_quantity * ($cart->service->onetime_price * ($tax_value / 100));
                                            $total_order_price = $order_price + $tax;
                                    @endphp
                                    <div class="shopping-card-list-item">
                                        <div class="shopping-card-uhinfo">
                                            <h6>{{ $cart->service->service_name }}</h6>
                                            <!--
                                             <a href="#">Web Scripts</a>
                                             <p>(www.example.com)</p>
                                            -->
                                        </div>
                                        <div class="shopping-card-uhperiod">
                                            <p>
                                                @php
                                                    if ($cart->selected_price == 0) {

                                    if ($cart->service->monthly_price == null) {

                                      if ($cart->service->period == "annually") {
                                      echo "Annually";
                                      } elseif ($cart->service->period == "onetime") {
                                      echo "One Time";
                                     }

                                    } else {
                                      echo "Monthly";
                                    }

                                    } elseif ($cart->selected_price == 1) {

                                    if ($cart->service->annually_price == null) {

                                      if ($cart->service->period == "monthly") {
                                      echo "Monthly";
                                      } elseif ($cart->service->period == "onetime") {
                                      echo "One Time";
                                      }

                                    } else {
                                      echo "Annually";
                                    }

                                    } elseif ($cart->selected_price == 2) {

                                    if ($cart->service->onetime_price == null) {

                                      if ($cart->service->period == "monthly") {
                                      echo "Monthly";
                                      } elseif ($cart->service->period == "annually") {
                                      echo "Annually";
                                      }

                                    } else {
                                      echo "One Time";
                                    }

                                    }

                                                @endphp
                                            </p>
                                        </div>
                                        <div class="shopping-card-uhprice">
                                            <h5> {{ $cart->product_quantity }} x @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($service_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($service_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif</h5>
                                        </div>
                                        <div class="shopping-card-dbtn">
                                            <button type="button" class="shopping-card-delete-btn" data-toggle="modal" data-target="#deleteCartModal{{ $loop->index }}"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="modal fade custom-modal delete" id="deleteCartModal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="deleteCartModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="deleteCartModalLabel">Delete Product</h6>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure about deleting?
                                                </div>
                                                <div class="modal-footer">
                                                @if ($demo_mode == "on")
                                                    <!-- Include Alert Blade -->
                                                        @include('admin.demo_mode.demo-mode')
                                                    @else
                                                        <form class="d-inline-block" action="{{ route('cart-page.destroy_my_cart_order', $cart->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            @endif
                                                    <button type="submit" class="modal-btn-yes">Yes</button>
                                                    <button type="button" class="modal-btn-no" data-dismiss="modal">No</button>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @elseif ($cart->type == "software" && $cart->software->status == "published")

                                    @php
                                        // If there is an update in the price periods by the admin, the active price will be presented to the user.
                                        // 0 = monthly, 1 = annually, 2 = onetime (represents the payment.)
                                        if ($cart->selected_price == 0) {

                                        if ($cart->software->monthly_price == null) {

                                          if ($cart->software->period == "annually") {
                                          $service_price = $cart->software->annually_price;
                                          } elseif ($cart->software->period == "onetime") {
                                          $service_price = $cart->software->onetime_price;
                                          }

                                        } else {
                                          $service_price = $cart->software->monthly_price;
                                        }

                                        } elseif ($cart->selected_price == 1) {

                                        if ($cart->software->annually_price == null) {

                                          if ($cart->software->period == "monthly") {
                                          $service_price = $cart->software->monthly_price;
                                          } elseif ($cart->software->period == "onetime") {
                                          $service_price = $cart->software->onetime_price;
                                          }

                                        } else {
                                          $service_price = $cart->software->annually_price;
                                        }

                                        } elseif ($cart->selected_price == 2) {

                                        if ($cart->software->onetime_price == null) {

                                          if ($cart->software->period == "monthly") {
                                          $service_price = $cart->software->monthly_price;
                                          } elseif ($cart->software->period == "annually") {
                                          $service_price = $cart->software->annually_price;
                                          }

                                        } else {
                                          $service_price = $cart->software->onetime_price;
                                        }

                                        }

                                        // Tax value check
                                            if ($cart->service->tax_value == null) {
                                                $tax_value = 0;
                                            }

                                            $order_price = $order_price + $cart->product_quantity * $service_price;
                                            $tax = $tax + $cart->product_quantity * ($cart->service->onetime_price * ($tax_value / 100));
                                            $total_order_price = $order_price + $tax;
                                    @endphp
                                    <div class="shopping-card-list-item">
                                        <div class="shopping-card-uhinfo">
                                            <h6>{{ $cart->software->title }}</h6>
                                            <!--
                                             <a href="#">Web Scripts</a>
                                             <p>(www.example.com)</p>
                                            -->
                                        </div>
                                        <div class="shopping-card-uhperiod">
                                            <p>
                                                @php
                                                    if ($cart->selected_price == 0) {

                                    if ($cart->software->monthly_price == null) {

                                      if ($cart->software->period == "annually") {
                                      echo "Annually";
                                      } elseif ($cart->software->period == "onetime") {
                                      echo "One Time";
                                     }

                                    } else {
                                      echo "Monthly";
                                    }

                                    } elseif ($cart->selected_price == 1) {

                                    if ($cart->software->annually_price == null) {

                                      if ($cart->software->period == "monthly") {
                                      echo "Monthly";
                                      } elseif ($cart->software->period == "onetime") {
                                      echo "One Time";
                                      }

                                    } else {
                                      echo "Annually";
                                    }

                                    } elseif ($cart->selected_price == 2) {

                                    if ($cart->software->onetime_price == null) {

                                      if ($cart->software->period == "monthly") {
                                      echo "Monthly";
                                      } elseif ($cart->software->period == "annually") {
                                      echo "Annually";
                                      }

                                    } else {
                                      echo "One Time";
                                    }

                                    }

                                                @endphp
                                            </p>
                                        </div>
                                        <div class="shopping-card-uhprice">
                                            <h5> {{ $cart->product_quantity }} x @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($service_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($service_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif</h5>
                                        </div>
                                        <div class="shopping-card-dbtn">
                                            <button type="button" class="shopping-card-delete-btn" data-toggle="modal" data-target="#deleteCartModal{{ $loop->index }}"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="modal fade custom-modal delete" id="deleteCartModal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="deleteCartModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="deleteCartModalLabel">Delete Product</h6>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure about deleting?
                                                </div>
                                                <div class="modal-footer">
                                                @if ($demo_mode == "on")
                                                    <!-- Include Alert Blade -->
                                                        @include('admin.demo_mode.demo-mode')
                                                    @else
                                                        <form class="d-inline-block" action="{{ route('cart-page.destroy_my_cart_order', $cart->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            @endif
                                                            <button type="submit" class="modal-btn-yes">Yes</button>
                                                            <button type="button" class="modal-btn-no" data-dismiss="modal">No</button>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                @endif
                            @endforeach
                        @else
                            <div class="shopping-card-list-item">
                                <div class="shopping-card-uhinfo">
                                    <h6>Your cart is currently empty.</h6>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="btn-center">
                        <a href="{{ url('/') }}" class="outline-shopping-button"><i class="fa fa-chevron-left"></i> Keep Shopping</a>
                    </div>
                </div>
                @if (count($carts) > 0)
                    <div class="col-lg-4">
                        <div class="shopping-card-detail">
                            <div class="shopping-card-header-detail">
                                <h6>Order Summary</h6>
                            </div>
                            <div class="total-order-price">
                                <h6>Order Price</h6>
                                <h5>@if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($order_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($order_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif</h5>
                            </div>
                            <div class="total-order-price">
                                <h6>Tax</h6>
                                <h5>@if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($tax, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($tax, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif</h5>
                            </div>
                            <div class="total-price">
                                <h6>Total Price</h6>
                                <h3>@if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($total_order_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($total_order_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif</h3>
                            </div>
                        </div>
                        <a href="{{ route('sign-in-page.index') }}" class="continue-btn">Continue</a>
                    </div>
                @else
                    <div class="col-lg-4">
                        <div class="shopping-card-detail">
                            <div class="shopping-card-header-detail">
                                <h6>Order Summary</h6>
                            </div>
                            <div class="total-order-price">
                                <h6>Order Price</h6>
                                <h5>-</h5>
                            </div>
                            <div class="total-order-price">
                                <h6>Tax</h6>
                                <h5>-</h5>
                            </div>
                            <div class="total-price">
                                <h6>Total Price</h6>
                                <h3>-</h3>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!--// Shopping Card Section End //-->

@endsection
