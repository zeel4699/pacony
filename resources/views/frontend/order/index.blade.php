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
                        <h1>{{ __('frontend.cart') }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ __('frontend.cart') }}
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

                            @if (session()->has('cart'))
                                @foreach (session()->get('cart') as $details)
                                    @php
                                        // Order id
                                           $id = $details['product_id'].$details['type'];

                                              if ($details['tax_value'] == null) {
                                                  $details['tax_value'] = 0;
                                              }

                                              $order_price = $order_price + $details['quantity']*$details['price'];
                                              $tax = $tax + $details['quantity'] * ($details['price'] * ($details['tax_value'] / 100));
                                              $total_order_price = $order_price + $tax;
                                    @endphp
                                    <div class="shopping-card-list-item">
                                        <div class="shopping-card-uhinfo">
                                            <h6>{{ $details['name'] }}</h6>
                                           <!--
                                            <a href="#">Web Scripts</a>
                                            <p>(www.example.com)</p>
                                           -->
                                        </div>
                                        <div class="shopping-card-uhperiod">
                                            <p>
                                                @php
                                                    if ($details['selected_price'] == 0) {
                                                    echo "Monthly";
                                                   } elseif ($details['selected_price'] == 1) {
                                                         echo "Annually";
                                                    } else {
                                                          echo "One Time";
                                                     }
                                                @endphp
                                            </p>
                                        </div>
                                        <div class="shopping-card-uhprice">
                                            <h5> {{ $details['quantity'] }} x @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($details['price'], $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($details['price'], $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif</h5>
                                        </div>
                                        <div class="shopping-card-dbtn">
                                            <button type="button" class="shopping-card-delete-btn" data-toggle="modal" data-target="#deleteCartModal{{ $loop->index }}"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="modal fade custom-modal delete" id="deleteCartModal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="deleteCartModalLabel{{ $loop->index }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="deleteCartModalLabel{{ $loop->index }}">Delete Product</h6>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure about deleting?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ url('cart/destroy-order/'.$id) }}" class="modal-btn-yes">Yes</a>
                                                    <button type="button" class="modal-btn-no" data-dismiss="modal">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                @if (session()->has('cart'))
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
