@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <!-- Form row -->
    <div class="row">
        <div class="col-xl-12 box-margin height-card">
            <div class="card card-body">
                <h4 class="card-title">{{ __('content.order_mode') }}</h4>
                @if (isset($order_mode))
                    <form action="{{ route('order-mode.update', $order_mode->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mr-3">
                                    <input type="radio" name="order_mode" value="with_free_trial" {{ ($order_mode->order_mode == "with_free_trial")? "checked" : "" }}>
                                    {{ __('content.with_free_trial') }}
                                </label>
                                <label class="mr-3">
                                    <input type="radio" name="order_mode" value="via_whatsapp" {{ ($order_mode->order_mode == "via_whatsapp")? "checked" : "" }}>
                                    {{ __('content.via_whatsapp') }}
                                </label>
                                <label class="d-none">
                                    <input type="radio" name="order_mode" value="with_payment_method" {{ ($order_mode->order_mode == "with_payment_method")? "checked" : "" }}>
                                    {{ __('content.with_payment_method') }}
                                </label>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mr-2 mt-3">{{ __('content.submit') }}</button>
                            </div>
                        </div>
                    </form>
                    @else
                    <form action="{{ route('order-mode.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">

                                <label class="mr-3">
                                    <input type="radio" name="order_mode" value="with_free_trial">
                                    {{ __('content.with_free_trial') }}
                                </label>
                                <label class="mr-3">
                                    <input type="radio" name="order_mode" value="via_whatsapp">
                                    {{ __('content.via_whatsapp') }}
                                </label>
                                <label class="d-none">
                                    <input type="radio" name="order_mode" value="with_payment_method">
                                    {{ __('content.with_payment_method') }}
                                </label>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mr-2 mt-3">{{ __('content.submit') }}</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection