@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <!-- Form row -->
    <div class="row">
        <div class="col-xl-12 box-margin height-card">
            <div class="card card-body">
                <h4 class="card-title">{{ __('content.contact_info') }}</h4>
                @if (isset($contact))
                    <form action="{{ route('contact.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="section_title">{{ __('content.section_title') }}</label>
                                    <input type="text" name="section_title" class="form-control" id="section_title" value="{{ $contact->section_title }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tag-list">{{ __('content.subject') }}</label>
                                    <input type="text" name="subject" class="form-control" id="tag-list" value="{{ $contact->subject }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-clint-area-content">
                                    <div class="form-group">
                                        <label for="image_status" class="col-form-label">{{ __('content.image_status') }}</label>
                                        <select class="form-control" name="image_status" id="image_status">
                                            <option value="show" selected>{{ __('content.select_your_option') }}</option>
                                            <option value="show" {{ $contact->image_status == "show" ? 'selected' : '' }}>{{ __('content.show') }}</option>
                                            <option value="hide" {{ $contact->image_status == "hide" ? 'selected' : '' }}>{{ __('content.hide') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_image">{{ __('content.image') }} ({{ __('content.size') }} 600 x 550) (.svg, .jpg, .jpeg, .png)</label>
                                        <input type="file" name="contact_image" class="form-control-file" id="contact_image">
                                        <small id="contact_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                    </div>
                                    <div class="height-card box-margin">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="avatar-area text-center">
                                                    <div class="media">
                                                        @if (!empty($contact->contact_image))
                                                            <a  class="d-block mx-auto" href="#" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('content.current_image') }}">
                                                                <img src="{{ asset('uploads/img/contact/'.$contact->contact_image) }}" alt="image" class="rounded">
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
                    <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="section_title">{{ __('content.section_title') }}</label>
                                    <input type="text" name="section_title" class="form-control" id="section_title">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tag-list">{{ __('content.subject') }}</label>
                                    <input type="text" name="subject" class="form-control" id="tag-list">
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
                                        <label for="contact_image">{{ __('content.image') }} ({{ __('content.size') }} 600 x 550) (.svg, .jpg, .jpeg, .png)</label>
                                        <input type="file" name="contact_image" class="form-control-file" id="contact_image">
                                        <small id="contact_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
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