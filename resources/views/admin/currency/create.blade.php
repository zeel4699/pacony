@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <!-- Form row -->
    <div class="row">
        <div class="col-xl-12 box-margin height-card">
            <div class="card card-body">
                <h4 class="card-title">{{ __('content.currency') }}</h4>
                @if (isset($currency))
                    <form action="{{ route('currency.update', $currency->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="currency">{{ __('content.currency') }}</label>
                                    <input type="text" name="currency" class="form-control" id="currency" value="{{ $currency->currency }}">
                                    <small id="currency" class="form-text text-muted">{{ __('content.example') }} $, ₺, €, ¥, ₩, ₽, ₹, TL, SR </small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="currency_position" class="col-form-label">{{ __('content.currency_position') }} </label>
                                    <select class="form-control" name="currency_position" id="currency_position">
                                        <option value="left" selected>{{ __('content.select_your_option') }}</option>
                                        <option value="left" {{ $currency->currency_position == "left" ? 'selected' : '' }}>{{ __('content.left') }}</option>
                                        <option value="right" {{ $currency->currency_position == "right" ? 'selected' : '' }}>{{ __('content.right') }}</option>
                                    </select>
                                    <small id="currency_position" class="form-text text-muted">{{ __('content.example') }} <span class="text-success">$</span>29 {{ __('content.or') }} 29<span class="text-success">$</span> </small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="decimal_digit" class="col-form-label">{{ __('content.decimal_digit') }} </label>
                                    <select class="form-control" name="decimal_digit" id="decimal_digit">
                                        <option value="0" selected>{{ __('content.select_your_option') }}</option>
                                        <option value="0" {{ $currency->decimal_digit == 0 ? 'selected' : '' }}>0</option>
                                        <option value="1" {{ $currency->decimal_digit == 1 ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ $currency->decimal_digit == 2 ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ $currency->decimal_digit == 3 ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ $currency->decimal_digit == 4 ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ $currency->decimal_digit == 5 ? 'selected' : '' }}>5</option>
                                    </select>
                                    <small id="decimal_digit" class="form-text text-muted">{{ __('content.example') }} $29 {{ __('content.or') }} $29<span class="text-success">,0</span> {{ __('content.or') }} $29<span class="text-success">,00</span> {{ __('content.or') }} $29<span class="text-success">,000</span> {{ __('content.or') }} $29<span class="text-success">,0000</span> {{ __('content.or') }} $29<span class="text-success">,00000</span></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="decimal_separator" class="col-form-label">{{ __('content.decimal_separator') }} </label>
                                    <select class="form-control" name="decimal_separator" id="decimal_separator">
                                        <option value="dot" selected>{{ __('content.select_your_option') }}</option>
                                        <option value="dot" {{ $currency->decimal_separator == "dot" ? 'selected' : '' }}>{{ __('content.dot') }}</option>
                                        <option value="comma" {{ $currency->decimal_separator == "comma" ? 'selected' : '' }}>{{ __('content.comma') }}</option>
                                        <option value="space" {{ $currency->decimal_separator == "space" ? 'selected' : '' }}>{{ __('content.space') }}</option>
                                    </select>
                                    <small id="currency_position" class="form-text text-muted">{{ __('content.example') }} $29<span class="text-success">.</span>00 {{ __('content.or') }} $29<span class="text-success">,</span>00  {{ __('content.or') }} $29<span class="text-success"> </span>00</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="thousand_separator" class="col-form-label">{{ __('content.thousand_separator') }} </label>
                                    <select class="form-control" name="thousand_separator" id="thousand_separator">
                                        <option value="dot" selected>{{ __('content.select_your_option') }}</option>
                                        <option value="dot" {{ $currency->thousand_separator == "dot" ? 'selected' : '' }}>{{ __('content.dot') }}</option>
                                        <option value="comma" {{ $currency->thousand_separator == "comma" ? 'selected' : '' }}>{{ __('content.comma') }}</option>
                                        <option value="space" {{ $currency->thousand_separator == "space" ? 'selected' : '' }}>{{ __('content.space') }}</option>
                                    </select>
                                    <small id="thousand_separator" class="form-text text-muted">{{ __('content.example') }} $29<span class="text-success">.</span>500,00 {{ __('content.or') }} $29<span class="text-success">,</span>500.00  {{ __('content.or') }} $29<span class="text-success"> </span>500 00</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <small class="form-text text-muted">{{ __('content.required_fields') }}</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('content.submit') }}</button>
                            </div>
                        </div>
                    </form>
                    @else
                    <form action="{{ route('currency.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="currency">{{ __('content.currency') }} <span class="text-red">*</span></label>
                                    <input type="text" name="currency" class="form-control" id="currency" required>
                                    <small id="currency" class="form-text text-muted">{{ __('content.example') }} $, ₺, €, ¥, ₩, ₽, ₹, TL, SR </small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="currency_position" class="col-form-label">{{ __('content.currency_position') }} </label>
                                    <select class="form-control" name="currency_position" id="currency_position">
                                        <option value="left" selected>{{ __('content.select_your_option') }}</option>
                                        <option value="left">{{ __('content.left') }}</option>
                                        <option value="right">{{ __('content.right') }}</option>
                                    </select>
                                    <small id="currency_position" class="form-text text-muted">{{ __('content.example') }} <span class="text-danger">$</span>29 {{ __('content.or') }} 29<span class="text-danger">$</span> </small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="decimal_digit" class="col-form-label">{{ __('content.decimal_digit') }} </label>
                                    <select class="form-control" name="decimal_digit" id="decimal_digit">
                                        <option value="2" selected>{{ __('content.select_your_option') }}</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <small id="decimal_digit" class="form-text text-muted">{{ __('content.example') }} $29 {{ __('content.or') }} $29<span class="text-danger">,0</span> {{ __('content.or') }} $29<span class="text-danger">,00</span> {{ __('content.or') }} $29<span class="text-danger">,000</span> {{ __('content.or') }} $29<span class="text-danger">,0000</span> {{ __('content.or') }} $29<span class="text-danger">,00000</span></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="decimal_separator" class="col-form-label">{{ __('content.decimal_separator') }} </label>
                                    <select class="form-control" name="decimal_separator" id="decimal_separator">
                                        <option value="dot" selected>{{ __('content.select_your_option') }}</option>
                                        <option value="dot">{{ __('content.dot') }}</option>
                                        <option value="comma">{{ __('content.comma') }}</option>
                                        <option value="space">{{ __('content.space') }}</option>
                                    </select>
                                    <small id="currency_position" class="form-text text-muted">{{ __('content.example') }} $29<span class="text-danger font-18">.</span>00 {{ __('content.or') }} $29<span class="text-danger font-18">,</span>00  {{ __('content.or') }} $29<span class="text-danger font-18"> </span>00</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="thousand_separator" class="col-form-label">{{ __('content.thousand_separator') }} </label>
                                    <select class="form-control" name="thousand_separator" id="thousand_separator">
                                        <option value="dot" selected>{{ __('content.select_your_option') }}</option>
                                        <option value="dot">{{ __('content.dot') }}</option>
                                        <option value="comma">{{ __('content.comma') }}</option>
                                        <option value="space">{{ __('content.space') }}</option>
                                    </select>
                                    <small id="thousand_separator" class="form-text text-muted">{{ __('content.example') }} $29<span class="text-danger font-18">.</span>500,00 {{ __('content.or') }} $29<span class="text-danger font-18">,</span>500.00  {{ __('content.or') }} $29<span class="text-danger font-18"> </span>500 00</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <small class="form-text text-muted">{{ __('content.required_fields') }}</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('content.submit') }}</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection