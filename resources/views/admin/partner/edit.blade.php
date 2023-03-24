@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <!-- Form row -->
    <div class="row">
        <div class="col-xl-12 box-margin height-card">
            <div class="card card-body">
                <div class="d-md-flex justify-content-between align-items-center mb-20">
                    <h4 class="card-title">{{ __('content.edit_partner') }}</h4>
                    <div>
                        <a href="{{ url()->previous() }}"  class="btn btn-primary"><i class="fas fa-angle-left"></i> {{ __('content.back') }}</a>
                    </div>
                </div>
            @if ($demo_mode == "on")
                <!-- Include Alert Blade -->
                    @include('admin.demo_mode.demo-mode')
                @else
                    <form action="{{ route('partner.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        @endif

                        <div class="row">
                            <div class="col-xl-12">
                               <div class="single-clint-area-content">
                                   <div class="form-group">
                                       <label for="image_status" class="col-form-label">{{ __('content.image_status') }} </label>
                                       <select class="form-control" name="image_status" id="image_status">
                                           <option value="show" selected>{{ __('content.select_your_option') }}</option>
                                           <option value="show" {{ $partner->image_status == "show" ? 'selected' : '' }}>{{ __('content.show') }}</option>
                                           <option value="hide" {{ $partner->image_status == "hide" ? 'selected' : '' }}>{{ __('content.hide') }}</option>
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label for="partner_image">{{ __('content.image') }} ({{ __('content.size') }} 120 x 120) (.svg, .jpg, .jpeg, .png)</label>
                                       <input type="file" name="partner_image" class="form-control-file" id="partner_image">
                                       <small id="partner_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                   </div>
                                   <div class="height-card box-margin">
                                       <div class="card">
                                           <div class="card-body">
                                               <div class="avatar-area text-center">
                                                   <div class="media">
                                                       @if (!empty($partner->partner_image))
                                                           <a  class="d-block mx-auto" href="#" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('content.current_image') }}">
                                                               <img src="{{ asset('uploads/img/partner/'.$partner->partner_image) }}" alt="image" class="rounded">
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
                                    <label for="title">{{ __('content.title') }} <span class="text-red">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title" value="{{ $partner->title }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="desc">{{ __('content.description') }}</label>
                                    <textarea name="desc" class="form-control" rows="3" id="desc">{{ $partner->desc }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="order">{{ __('content.order') }}</label>
                                    <input type="number" name="order" class="form-control" id="order" value="{{ $partner->order }}" required>
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