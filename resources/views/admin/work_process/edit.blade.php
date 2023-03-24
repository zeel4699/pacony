@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <!-- Form row -->
    <div class="row">
        <div class="col-xl-12 box-margin height-card">
            <div class="card card-body">
                <div class="d-md-flex justify-content-between align-items-center mb-20">
                    <h4 class="card-title">{{ __('content.edit_work_process') }}</h4>
                    <div>
                        <a href="{{ url()->previous() }}"  class="btn btn-primary"><i class="fas fa-angle-left"></i> {{ __('content.back') }}</a>
                    </div>
                </div>
            @if ($demo_mode == "on")
                <!-- Include Alert Blade -->
                    @include('admin.demo_mode.demo-mode')
                @else
                    <form action="{{ route('work-process.update', $work_process->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <div class="single-clint-area-content">
                                    <fieldset class="form-group">
                                        <legend class="font-14">{{ __('content.type') }}</legend>
                                        <div class="form-check pl-0 mb-2">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input mr-2" name="type" id="optionsRadios1" onclick="showHideTypeDiv()" value="icon" {{ $work_process->type == 'icon' ? 'checked' : '' }}><span class="ml-3">{{ __('content.icon') }}</span>
                                                <i class="input-helper"></i>
                                            </label>
                                        </div>
                                        <div class="form-check pl-0">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input mr-1" name="type" id="optionsRadios2" onclick="showHideTypeDiv()" value="image" {{ $work_process->type == 'image' ? 'checked' : '' }}><span class="ml-3">{{ __('content.image') }}</span>
                                                <i class="input-helper"></i>
                                            </label>
                                        </div>
                                    </fieldset>
                                    <div class="form-group" id="icon-type" style="{{ $work_process->type == 'icon' ? 'display:block' : 'display:none' }}">
                                        <label for="icon" class="d-block">{{ __('content.icon') }}</label>
                                        <div class="btn-group">
                                            <input type="hidden" name="icon" class="form-control" id="icon" value="{{ $work_process->icon }}">
                                            <button type="button" class="btn btn-primary  iconpicker-component"><i id="icon-value" class="{{ $work_process->icon }} iconpicker-component"></i></button>
                                            <button type="button" id="iconPickerBtn" class="icp icp-dd btn btn-primary dropdown-toggle iconpicker-component" data-selected="fa-car" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <div class="dropdown-menu"></div>
                                        </div>
                                    </div>
                                    <div id="image-type" style="{{ $work_process->type == 'image' ? 'display:block' : 'display:none' }}">
                                        <div class="form-group">
                                            <label for="image_status" class="col-form-label">{{ __('content.image_status') }}</label>
                                            <select class="form-control" name="image_status" id="image_status">
                                                <option value="show" selected>{{ __('content.select_your_option') }}</option>
                                                <option value="show" {{ $work_process->image_status == "show" ? 'selected' : '' }}>{{ __('content.show') }}</option>
                                                <option value="hide" {{ $work_process->image_status == "hide" ? 'selected' : '' }}>{{ __('content.hide') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="work_process_image">{{ __('content.image') }} ({{ __('content.size') }} 100 x 100) (.svg, .jpg, .jpeg, .png)</label>
                                            <input type="file" name="work_process_image" class="form-control-file" id="work_process_image">
                                            <small id="work_process_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                        </div>
                                    <div class="height-card box-margin">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="avatar-area text-center">
                                                    <div class="media">
                                                        @if (!empty($work_process->work_process_image))
                                                            <a  class="d-block mx-auto" href="#" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('content.current_image') }}">
                                                                <img src="{{ asset('uploads/img/work_process/'.$work_process->work_process_image) }}" alt="image" class="rounded">
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
                            <!--end col-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('content.title') }} <span class="text-red">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title" value="{{ $work_process->title }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="desc">{{ __('content.description') }}</label>
                                    <textarea name="desc" class="form-control" id="desc" rows="3">{{ $work_process->desc }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="order">{{ __('content.order') }}</label>
                                    <input type="number" name="order" class="form-control" id="order" value="{{ $work_process->order }}" required>
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