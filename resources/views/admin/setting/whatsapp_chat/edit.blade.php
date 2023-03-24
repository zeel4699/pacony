@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <!-- Form row -->
    <div class="row">
        <div class="col-xl-12 box-margin height-card">
            <div class="card card-body">
                <div class="d-md-flex justify-content-between align-items-center mb-20">
                    <h4 class="card-title">{{ __('content.edit_whatsapp_chat') }}</h4>
                    <div>
                        <a href="{{ url()->previous() }}"  class="btn btn-primary"><i class="fas fa-angle-left"></i> {{ __('content.back') }}</a>
                    </div>
                </div>
            @if ($demo_mode == "on")
                <!-- Include Alert Blade -->
                    @include('admin.demo_mode.demo-mode')
                @else
                    <form action="{{ route('whatsapp-chat.update', $whatsapp_chat->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <div class="single-clint-area-content">
                                    <div class="form-group">
                                        <label for="image_status" class="col-form-label">{{ __('content.image_status') }}</label>
                                        <select class="form-control" name="image_status" id="image_status">
                                            <option value="show" selected>{{ __('content.select_your_option') }}</option>
                                            <option value="show" {{ $whatsapp_chat->image_status == "show" ? 'selected' : '' }}>{{ __('content.show') }}</option>
                                            <option value="hide" {{ $whatsapp_chat->image_status == "hide" ? 'selected' : '' }}>{{ __('content.hide') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="whatsapp_chat_image">{{ __('content.image') }} ({{ __('content.size') }} 100 x 100) (.svg, .jpg, .jpeg, .png)</label>
                                        <input type="file" name="whatsapp_chat_image" class="form-control-file" id="whatsapp_chat_image">
                                        <small id="whatsapp_chat_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                    </div>
                                    <div class="height-card box-margin">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="avatar-area text-center">
                                                    <div class="media">
                                                        @if (!empty($whatsapp_chat->whatsapp_chat_image))
                                                            <a  class="d-block mx-auto" href="#" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('content.current_image') }}">
                                                                <img src="{{ asset('uploads/img/whatsapp_chat/'.$whatsapp_chat->whatsapp_chat_image) }}" alt="whatsapp_chat image" class="rounded w-25">
                                                            </a>
                                                        @else
                                                            <a  class="d-block mx-auto" href="#" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('content.current_image') }}">
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
                                    <label for="name">{{ __('content.name') }} <span class="text-red">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $whatsapp_chat->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="job">{{ __('content.job') }} <span class="text-red">*</span></label>
                                    <input type="text" name="job" class="form-control" id="job" value="{{ $whatsapp_chat->job }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">{{ __('content.phone') }} <span class="text-red">*</span></label>
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{ $whatsapp_chat->phone }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="accessibility" class="col-form-label">{{ __('content.accessibility') }}</label>
                                    <select class="form-control" name="accessibility" id="accessibility">
                                        <option value="online" selected>{{ __('content.select_your_option') }}</option>
                                        <option value="online" {{ $whatsapp_chat->accessibility == "online" ? 'selected' : '' }}>{{ __('content.online') }}</option>
                                        <option value="offline" {{ $whatsapp_chat->accessibility == "offline" ? 'selected' : '' }}>{{ __('content.offline') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status" class="col-form-label">{{ __('content.status') }}</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="published" selected>{{ __('content.select_your_option') }}</option>
                                        <option value="published" {{ $whatsapp_chat->status == "published" ? 'selected' : '' }}>{{ __('content.published') }}</option>
                                        <option value="draft" {{ $whatsapp_chat->status == "draft" ? 'selected' : '' }}>{{ __('content.draft') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="order">{{ __('content.order') }}</label>
                                    <input type="number" name="order" class="form-control" id="order" value="{{ $whatsapp_chat->order }}">
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
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection