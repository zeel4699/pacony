@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <!-- Form row -->
    <div class="row">
        <div class="col-xl-12 box-margin height-card">
            <div class="card card-body">
                <h4 class="card-title">{{ __('content.add_software') }}</h4>
            @if ($demo_mode == "on")
                <!-- Include Alert Blade -->
                    @include('admin.demo_mode.demo-mode')
                @else
                    <form action="{{ route('software.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @endif

                        <div class="row">
                          <div class="col-md-8">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="title">{{ __('content.title') }} <span class="text-red">*</span></label>
                                          <input id="title" name="title" type="text" class="form-control" required>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="summernote">{{ __('content.description') }}</label>
                                          <textarea id="summernote" name="desc" class="form-control"></textarea>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="software-feature-list">{{ __('content.software_feature_list') }}</label>
                                          <input type="text" name="software_feature_list" class="form-control" id="software-feature-list">
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="server-requirement">{{ __('content.server_requirements') }}</label>
                                          <input type="text" name="server_requirement" class="form-control" id="server-requirement">
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="tag-list">{{ __('content.tags') }}</label>
                                          <input type="text" name="tag" class="form-control" id="tag-list">
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
                                                                  <input id="title" name="meta_desc" type="text" class="form-control">
                                                              </div>
                                                          </div>
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label for="meta_keyword">{{ __('content.meta_keyword') }} ({{ __('content.separate_with_commas') }})</label>
                                                                  <textarea id="meta_keyword" name="meta_keyword" class="form-control"></textarea>
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
                                                                  <label for="breadcrumb_status" class="col-form-label">{{ __('content.use_special_breadcrumb') }}</label>
                                                                  <select name="breadcrumb_status" class="form-control" id="breadcrumb_status">
                                                                      <option value="no" selected>{{ __('content.select_your_option') }}</option>
                                                                      <option value="yes">{{ __('content.yes') }}</option>
                                                                      <option value="no">{{ __('content.no') }}</option>
                                                                  </select>
                                                              </div>
                                                          </div>
                                                          <div class="col-md-12">
                                                              <div class="form-group">
                                                                  <label for="custom_breadcrumb_image">{{ __('content.custom_breadcrumb_image') }} ({{ __('content.size') }} 1920 x 750) (.svg, .jpg, .jpeg, .png)</label>
                                                                  <input type="file" name="custom_breadcrumb_image" class="form-control-file" id="custom_breadcrumb_image">
                                                                  <small id="custom_breadcrumb_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                                              </div>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label for="category">{{ __('content.categories') }} <span class="text-red">*</span></label>
                                            <select  class="form-control" name="category_id" id="category" required>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="period" class="col-form-label">{{ __('content.period') }} <span class="text-red">*</span></label>
                                            <select name="period" class="form-control" id="period" required>
                                                <option value="">{{ __('content.select_your_option') }}</option>
                                                <option value="monthly">{{ __('content.monthly') }}</option>
                                                <option value="annually">{{ __('content.annually') }}</option>
                                                <option value="onetime">{{ __('content.onetime') }}</option>
                                            </select>
                                            <small class="form-text text-muted">{{ __('content.choose_a_plan') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="monthly_price">{{ __('content.monthly_price') }} </label>
                                            <input id="monthly_price" name="monthly_price" type="number" min="0" step=@if ($decimal_digit == 0) @elseif ($decimal_digit == 1) 0.1 @elseif ($decimal_digit == 2) 0.01 @elseif ($decimal_digit == 3) 0.001 @elseif ($decimal_digit == 4) 0.0001 @else 0.00001 @endif class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="annually_price">{{ __('content.annually_price') }} </label>
                                            <input id="annually_price" name="annually_price" type="number" min="0" step=@if ($decimal_digit == 0) @elseif ($decimal_digit == 1) 0.1 @elseif ($decimal_digit == 2) 0.01 @elseif ($decimal_digit == 3) 0.001 @elseif ($decimal_digit == 4) 0.0001 @else 0.00001 @endif class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="onetime_price">{{ __('content.onetime_price') }} </label>
                                            <input id="onetime_price" name="onetime_price" type="number" min="0" step=@if ($decimal_digit == 0) @elseif ($decimal_digit == 1) 0.1 @elseif ($decimal_digit == 2) 0.01 @elseif ($decimal_digit == 3) 0.001 @elseif ($decimal_digit == 4) 0.0001 @else 0.00001 @endif class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tax_value">{{ __('content.tax_value') }} </label>
                                            <input id="tax_value" name="tax_value" type="number" min="0" step=@if ($decimal_digit == 0) @elseif ($decimal_digit == 1) 0.1 @elseif ($decimal_digit == 2) 0.01 @elseif ($decimal_digit == 3) 0.001 @elseif ($decimal_digit == 4) 0.0001 @else 0.00001 @endif class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="demo_site_url">{{ __('content.demo_site_url') }}</label>
                                            <input type="text" name="demo_site_url" class="form-control" id="demo_site_url">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="demo_panel_url">{{ __('content.demo_panel_url') }}</label>
                                            <input type="text" name="demo_panel_url" class="form-control" id="demo_panel_url">
                                        </div>
                                    </div>
                                    @isset ($general_order_mode)
                                        @if ($general_order_mode->order_mode == "with_free_trial")
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="summernote2">{{ __('content.demo_other_info') }}</label>
                                                    <textarea type="text" name="demo_other_info" class="form-control" id="summernote2"></textarea>
                                                </div>
                                            </div>
                                        @endif
                                        @else
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="summernote2">{{ __('content.demo_other_info') }}</label>
                                                <textarea type="text" name="demo_other_info" class="form-control" id="summernote2"></textarea>
                                            </div>
                                        </div>
                                    @endisset
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
                                                <label for="software_image">{{ __('content.image') }} ({{ __('content.size') }} 770 x 580)(.svg, .png, .jpg, .jpeg)</label>
                                                <input id="software_image" name="software_image" type="file" class="form-control-file">
                                                <small id="software_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    @isset ($general_order_mode)
                                        @if ($general_order_mode->order_mode == "via_whatsapp")
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="phone_number">{{ __('content.phone_number') }}</label>
                                                    <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="12126600065">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="whatsapp_phone_number">{{ __('content.whatsapp_phone_number') }}</label>
                                                    <input type="text" name="whatsapp_phone_number" class="form-control" id="whatsapp_phone_number" placeholder="12126600065">
                                                    <small class="form-text text-muted">{{ __('content.required_for_order') }}</small>
                                                    <small class="form-text text-muted">{{ __('content.with_your_country_phone_code') }}</small>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="order">{{ __('content.order') }}</label>
                                            <input type="number" name="order" class="form-control" id="order" value="0">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="status" class="col-form-label">{{ __('content.status') }} </label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="published" selected>{{ __('content.select_your_option') }}</option>
                                                <option value="published">{{ __('content.published') }}</option>
                                                <option value="draft">{{ __('content.draft') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <small class="form-text text-muted">{{ __('content.required_fields') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary col-12">{{ __('content.submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection