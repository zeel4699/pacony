@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <!-- Form row -->
    <div class="row">
        <div class="col-xl-12 box-margin height-card">
            <div class="card card-body">
                <div class="d-md-flex justify-content-between align-items-center mb-20">
                    <h4 class="card-title">{{ __('content.edit_service') }}</h4>
                    <div>
                        <a href="{{ url()->previous() }}"  class="btn btn-primary"><i class="fas fa-angle-left"></i> {{ __('content.back') }}</a>
                    </div>
                </div>
            @if ($demo_mode == "on")
                <!-- Include Alert Blade -->
                    @include('admin.demo_mode.demo-mode')
                @else
                    <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        @endif

                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="service_name">{{ __('content.service_name') }} <span class="text-red">*</span></label>
                                            <input type="text" name="service_name" class="form-control" id="service_name" value="{{ $service->service_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="demo_url">{{ __('content.demo_url') }}</label>
                                            <input type="text" name="demo_url" class="form-control" id="demo_url" value="{{ $service->demo_url }}">
                                        </div>
                                    </div>
                                    @isset ($order_mode)
                                        @if ($order_mode->order_mode == "with_free_trial")
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="demo_admin_url">{{ __('content.demo_admin_url') }}</label>
                                                    <input type="text" name="demo_admin_url" class="form-control" id="demo_admin_url" value="{{ $service->demo_admin_url }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="summernote">{{ __('content.demo_other_info') }}</label>
                                                    <textarea name="demo_other_info" class="form-control" id="summernote">@php echo html_entity_decode($service->demo_other_info); @endphp</textarea>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="demo_admin_url">{{ __('content.demo_admin_url') }}</label>
                                                <input type="text" name="demo_admin_url" class="form-control" id="demo_admin_url" value="{{ $service->demo_admin_url }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="summernote">{{ __('content.demo_other_info') }}</label>
                                                <textarea name="demo_other_info" class="form-control" id="summernote">@php echo html_entity_decode($service->demo_other_info); @endphp</textarea>
                                            </div>
                                        </div>
                                    @endisset
                                    <div class="col-md-12">
                                        <div class="single-clint-area-content">
                                            <div class="form-group">
                                                <label for="image_status" class="col-form-label">{{ __('content.image_status') }}</label>
                                                <select class="form-control" name="image_status" id="image_status">
                                                    <option value="show" selected>{{ __('content.select_your_option') }}</option>
                                                    <option value="show" {{ $service->image_status == "show" ? 'selected' : '' }}>{{ __('content.show') }}</option>
                                                    <option value="hide" {{ $service->image_status == "hide" ? 'selected' : '' }}>{{ __('content.hide') }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="service_image">{{ __('content.image') }} ({{ __('content.size') }} 100 x 100) (.svg, .jpg, .jpeg, .png)</label>
                                                <input type="file" name="service_image" class="form-control-file" id="service_image">
                                                <small id="service_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                            </div>
                                            <div class="height-card box-margin">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="avatar-area text-center">
                                                            <div class="media">
                                                                @if(!empty($service->service_image))
                                                                    <a  class="d-block mx-auto" href="#" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('content.current_image') }}">
                                                                        <img src="{{ asset('uploads/img/service/'.$service->service_image) }}" alt="image" class="rounded">
                                                                    </a>
                                                                @else
                                                                    <a class="d-block mx-auto" href="#" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('content.not_yet_created') }}">
                                                                        <img src="{{ asset('uploads/img/dummy/no-image.jpg') }}" alt="no image" class="rounded w-25">
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!--end card-body-->
                                                    </div>
                                                </div>
                                                <!--end card-->
                                            </div>
                                            <!--end col-->
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="feature-list">{{ __('content.feature_list') }}</label>
                                            <input type="text" name="feature_list" class="form-control" id="feature-list" value="{{ $service->feature_list }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="non-feature-list">{{ __('content.non_feature_list') }}</label>
                                            <input type="text" name="non_feature_list" class="form-control" id="non-feature-list" value="{{ $service->non_feature_list }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 box-margin">
                                        <div id="accordion-">
                                            <div class="card mb-2">
                                                <div class="card-header bg-secondary">
                                                    <a class="collapsed text-white" data-toggle="collapse" href="#accordion-1" aria-expanded="false">
                                                        {{ __('content.seo_optimization') }}
                                                    </a>
                                                </div>

                                                <div id="accordion-1" class="collapse" data-parent="#accordion-" style="">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="meta_desc">{{ __('content.meta_desc') }} </label>
                                                                    <input id="title" name="meta_desc" type="text" class="form-control" value="{{ $service->meta_desc }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="meta_keyword">{{ __('content.meta_keyword') }} ({{ __('content.separate_with_commas') }})</label>
                                                                    <textarea id="meta_keyword" name="meta_keyword" class="form-control">{{ $service->meta_keyword }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header bg-secondary">
                                                    <a class="text-white" data-toggle="collapse" href="#accordion-2" aria-expanded="true">
                                                        {{ __('content.breadcrumb_customization') }}
                                                    </a>
                                                </div>
                                                <div id="accordion-2" class="collapse" data-parent="#accordion-" style="">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="breadcrumb_status" class="col-form-label">{{ __('content.please_use_recommended_sizes') }}</label>
                                                                    <select name="breadcrumb_status" class="form-control" id="breadcrumb_status">
                                                                        <option value="no" selected>{{ __('content.select_your_option') }}</option>
                                                                        <option value="yes" {{ $service->breadcrumb_status == "yes" ? 'selected' : '' }}>{{ __('content.yes') }}</option>
                                                                        <option value="no" {{ $service->breadcrumb_status == "no" ? 'selected' : '' }}>{{ __('content.no') }}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="custom_breadcrumb_image">{{ __('content.custom_breadcrumb_image') }} ({{ __('content.size') }} 1920 x 750) (.svg, .jpg, .jpeg, .png)</label>
                                                                    <input type="file" name="custom_breadcrumb_image" class="form-control-file" id="custom_breadcrumb_image">
                                                                    <small id="custom_breadcrumb_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                                                </div>
                                                                <div class="height-card box-margin">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="avatar-area text-center">
                                                                                <div class="media">
                                                                                    @if (!empty($service->custom_breadcrumb_image))
                                                                                        <a  class="d-block mx-auto" href="#" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('content.current_image') }}">
                                                                                            <img src="{{ asset('uploads/img/service/breadcrumb/'.$service->custom_breadcrumb_image) }}" alt="image" class="rounded">
                                                                                        </a>
                                                                                    @else
                                                                                        <a class="d-block mx-auto" href="#" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('content.not_yet_created') }}">
                                                                                            <img src="{{ asset('uploads/img/dummy/no-image.jpg') }}" alt="no image" class="rounded w-25">
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <!--end card-body-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end card-->
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="period" class="col-form-label">{{ __('content.period') }} <span class="text-red">*</span></label>
                                        <select class="form-control" name="period" id="period" required>
                                            <option value="">{{ __('content.select_your_option') }}</option>
                                            <option value="monthly" {{ $service->period == "monthly" ? 'selected' : '' }}>{{ __('content.monthly') }}</option>
                                            <option value="annually" {{ $service->period == "annually" ? 'selected' : '' }}>{{ __('content.annually') }}</option>
                                            <option value="onetime" {{ $service->period == "onetime" ? 'selected' : '' }}>{{ __('content.onetime') }}</option>
                                        </select>
                                        <small class="form-text text-muted">{{ __('content.choose_a_plan') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="monthly_price">{{ __('content.monthly_price') }}</label>
                                        <input id="monthly_price" name="monthly_price" type="number" min="0" step=@if ($decimal_digit == 0) @elseif ($decimal_digit == 1) 0.1 @elseif ($decimal_digit == 2) 0.01 @elseif ($decimal_digit == 3) 0.001 @elseif ($decimal_digit == 4) 0.0001 @else 0.00001 @endif class="form-control" value="@php if($service->monthly_price == null) { }else { echo number_format($service->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator); } @endphp">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="annually_price">{{ __('content.annually_price') }}</label>
                                        <input id="annually_price" name="annually_price" type="number" min="0" step=@if ($decimal_digit == 0) @elseif ($decimal_digit == 1) 0.1 @elseif ($decimal_digit == 2) 0.01 @elseif ($decimal_digit == 3) 0.001 @elseif ($decimal_digit == 4) 0.0001 @else 0.00001 @endif class="form-control" value="@php if($service->annually_price == null) { }else { echo number_format($service->annually_price, $decimal_digit, $decimal_separator, $thousand_separator); } @endphp">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="onetime_price">{{ __('content.onetime_price') }}</label>
                                        <input id="onetime_price" name="onetime_price" type="number" min="0" step=@if ($decimal_digit == 0) @elseif ($decimal_digit == 1) 0.1 @elseif ($decimal_digit == 2) 0.01 @elseif ($decimal_digit == 3) 0.001 @elseif ($decimal_digit == 4) 0.0001 @else 0.00001 @endif class="form-control" value="@php if($service->onetime_price == null) { }else { echo number_format($service->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator); } @endphp">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tax_value">{{ __('content.tax_value') }}</label>
                                        <input id="tax_value" name="tax_value" type="number" min="0" step=@if ($decimal_digit == 0) @elseif ($decimal_digit == 1) 0.1 @elseif ($decimal_digit == 2) 0.01 @elseif ($decimal_digit == 3) 0.001 @elseif ($decimal_digit == 4) 0.0001 @else 0.00001 @endif class="form-control" value="@php if($service->tax_value == null) { }else { echo number_format($service->tax_value, $decimal_digit, $decimal_separator, $thousand_separator); } @endphp">
                                    </div>
                                </div>
                                @isset ($order_mode)
                                    @if ($order_mode->order_mode == "via_whatsapp")
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="whatsapp_phone_number">{{ __('content.whatsapp_phone_number') }}</label>
                                                <input type="text" name="whatsapp_phone_number" class="form-control" id="whatsapp_phone_number" value="{{ $service->whatsapp_phone_number }}" placeholder="12126600065">
                                                <small class="form-text text-muted">{{ __('content.required_for_order') }}</small>
                                                <small class="form-text text-muted">{{ __('content.Enter your phone number along with your country\'s phone code.') }}</small>
                                            </div>
                                        </div>
                                    @endif
                                @endisset
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="order">{{ __('content.order') }}</label>
                                        <input type="number" name="order" class="form-control" id="order" value="{{ $service->order }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label">{{ __('content.status') }}</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="published" selected>{{ __('content.select_your_option') }}</option>
                                            <option value="published" {{ $service->status == "published" ? 'selected' : '' }}>{{ __('content.published') }}</option>
                                            <option value="draft" {{ $service->status == "draft" ? 'selected' : '' }}>{{ __('content.draft') }}</option>
                                        </select>
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
                        </div>
                    </form>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection