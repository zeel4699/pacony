@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <!-- Form row -->
    <div class="row">
        <div class="col-xl-12 box-margin height-card">
            <div class="card card-body">
                <h4 class="card-title">{{ __('content.demo_request_section') }}</h4>
                @if (isset($demo_request))
                    @if ($demo_mode == "on")
                        <!-- Include Alert Blade -->
                            @include('admin.demo_mode.demo-mode')
                        @else
                            <form action="{{ route('demo-request.update', $demo_request->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                @endif

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('content.title') }} <span class="text-red">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title" value="{{ $demo_request->title }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="summernote">{{ __('content.description') }} <span class="text-red">*</span></label>
                                    <textarea name="desc" class="form-control" id="summernote" required>@php echo html_entity_decode($demo_request->desc); @endphp</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                              <div class="single-clint-area-content">
                                  <div class="form-group">
                                      <label for="image_status" class="col-form-label">{{ __('content.image_status') }}</label>
                                      <select class="form-control" name="image_status" id="image_status">
                                          <option value="show" selected>{{ __('content.select_your_option') }}</option>
                                          <option value="show" {{ $demo_request->image_status == "show" ? 'selected' : '' }}>{{ __('content.show') }}</option>
                                          <option value="hide" {{ $demo_request->image_status == "hide" ? 'selected' : '' }}>{{ __('content.hide') }}</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label for="demo_request_image">{{ __('content.image') }} ({{ __('content.size') }} 600 x 550) (.svg, .jpg, .jpeg, .png)</label>
                                      <input type="file" name="demo_request_image" class="form-control-file" id="demo_request_image">
                                      <small id="demo_request_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                  </div>
                                  <div class="height-card box-margin">
                                      <div class="card">
                                          <div class="card-body">
                                              <div class="avatar-area text-center">
                                                  <div class="media">
                                                      @if(!empty($demo_request->demo_request_image))
                                                          <a  class="d-block mx-auto" href="#" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('content.current_image') }}">
                                                              <img src="{{ asset('uploads/img/demo_request/'.$demo_request->demo_request_image) }}" alt="image" class="rounded w-50">
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
                                    <small class="form-text text-muted">{{ __('content.required_fields') }}</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('content.submit') }}</button>
                            </div>
                        </div>
                    </form>
                    @else
                                @if ($demo_mode == "on")
                                <!-- Include Alert Blade -->
                                    @include('admin.demo_mode.demo-mode')
                                @else
                                    <form action="{{ route('demo-request.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('content.title') }} <span class="text-red">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="summernote">{{ __('content.description') }} <span class="text-red">*</span></label>
                                    <textarea name="desc" class="form-control" id="summernote" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                               <div class="single-clint-area-content">
                                   <div class="form-group">
                                       <label for="image_status" class="col-form-label">{{ __('content.image_status') }} </label>
                                       <select class="form-control" name="image_status" id="image_status">
                                           <option value="show" selected>{{ __('content.select_your_option') }}</option>
                                           <option value="show">{{ __('content.show') }}</option>
                                           <option value="hide">{{ __('content.hide') }}</option>
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label for="demo_request_image">{{ __('content.image') }} ({{ __('content.size') }} 600 x 550) (.svg, .jpg, .jpeg, .png)</label>
                                       <input type="file" name="demo_request_image" class="form-control-file" id="demo_request_image">
                                       <small id="demo_request_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                   </div>
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