@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <!-- Form row -->
    <div class="row">
        <div class="col-xl-12 box-margin height-card">
            <div class="card card-body">
                <h4 class="card-title">{{ __('content.about') }}</h4>
                @if (isset($about))
                    <form action="{{ route('about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('content.title') }} <span class="text-red">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title" value="{{ $about->title }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="summernote">{{ __('content.description') }}</label>
                                    <textarea name="desc" class="form-control" id="summernote">@php echo html_entity_decode($about->desc); @endphp</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="btn_name">{{ __('content.btn_name') }}</label>
                                    <input type="text" name="btn_name" class="form-control" id="btn_name" value="{{ $about->btn_name }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="btn_url">{{ __('content.btn_url') }}</label>
                                    <input type="text" name="btn_url" class="form-control" id="btn_url" value="{{ $about->btn_url }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                              <div class="single-clint-area-content">
                                  <div class="form-group">
                                      <label for="image_status" class="col-form-label">{{ __('content.image_status') }}</label>
                                      <select class="form-control" name="image_status" id="image_status">
                                          <option value="show" selected>{{ __('content.select_your_option') }}</option>
                                          <option value="show" {{ $about->image_status == "show" ? 'selected' : '' }}>{{ __('content.show') }}</option>
                                          <option value="hide" {{ $about->image_status == "hide" ? 'selected' : '' }}>{{ __('content.hide') }}</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label for="about_image">{{ __('content.image') }} ({{ __('content.size') }} 600 x 550) (.svg, .jpg, .jpeg, .png)</label>
                                      <input type="file" name="about_image" class="form-control-file" id="about_image">
                                      <small id="about_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                  </div>
                                  <div class="height-card box-margin">
                                      <div class="card">
                                          <div class="card-body">
                                              <div class="avatar-area text-center">
                                                  <div class="media">
                                                      @if (!empty($about->about_image))
                                                      <a  class="d-block mx-auto" href="#" data-toggle="tooltip" data-placement="top" data-original-title="{{ __('content.current_image') }}">
                                                          <img src="{{ asset('uploads/img/about/'.$about->about_image) }}" alt="image" class="rounded">
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
                    <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('content.title') }} <span class="text-red">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="summernote">{{ __('content.description') }}</label>
                                    <textarea name="desc" class="form-control" id="summernote"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="btn_name">{{ __('content.btn_name') }}</label>
                                    <input type="text" name="btn_name" class="form-control" id="btn_name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="btn_url">{{ __('content.btn_url') }}</label>
                                    <input type="text" name="btn_url" class="form-control" id="btn_url">
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
                                        <label for="about_image">{{ __('content.image') }} ({{ __('content.size') }} 600 x 550) (.svg, .jpg, .jpeg, .png)</label>
                                        <input type="file" name="about_image" class="form-control-file" id="about_image">
                                        <small id="about_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
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

    <div class="row">
        <div class="col-12">
            <div class="card mb-30">
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-20">
                        <h6 class="card-title mb-0">{{ __('content.information_list') }}</h6>
                        <button type="button" class="btn btn-primary waves-effect waves-light float-right mb-3" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg">+ {{ __('content.add_info') }}</button>
                    </div>
                    <div class="table-responsive order-stats">
                        @if (count($info_lists) > 0)
                            <div>
                                <input id="check_all" type="checkbox" onclick="showHideDeleteButton(this)">
                                <label for="check_all">{{ __('content.all') }}</label>
                                <a id="deleteChecked" class="ml-2" href="#" data-toggle="modal" data-target="#deleteCheckedModal">
                                    <i class="fa fa-trash text-danger font-18"></i>
                                </a>
                            </div>
                            <form onsubmit="return btnCheckListGet()" action="{{ route('about.destroy_checked') }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" id="checked_lists" name="checked_lists" value="">

                                <!-- Modal -->
                                <div class="modal fade" id="deleteCheckedModal" tabindex="-1" role="dialog" aria-labelledby="deleteCheckedModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteCheckedModalCenterTitle">{{ __('content.delete') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('content.close') }}">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                {{ __('content.delete_selected') }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('content.cancel') }}</button>
                                                <button onclick="btnCheckListGet()" type="submit" class="btn btn-success">{{ __('content.yes_delete_it') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="basic-datatable"  class="table table-striped dt-responsive w-100">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th>{{ __('content.image') }}</th>
                                    <th>{{ __('content.description') }}</th>
                                    <th>{{ __('content.order') }}</th>
                                    <th class="custom-width-action">{{ __('content.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $desc = count($info_lists); $asc=0; @endphp
                                @foreach ($info_lists as $info_list)
                                    <tr>
                                        <td>
                                            <input  name="check_list[]" type="checkbox" value="{{ $info_list->id }}" onclick="showHideDeleteButton2(this)"> <span class="d-none">{{ $asc++ }}{{ $desc-- }}</span>
                                        </td>
                                        <td>
                                            @if ($info_list->type == 'icon')
                                                <i class="{{ $info_list->icon }}"></i> {{ $info_list->icon }}
                                            @else
                                                @if (!empty($info_list->info_image))
                                                    <img class="image-size img-fluid" src="{{ asset('uploads/img/about/info_list/'.$info_list->info_image) }}" alt="image">
                                                @else
                                                    <img class="image-size img-fluid" src="{{ asset('uploads/img/dummy/no-image.jpg') }}" alt="no image">
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $info_list->desc }}</td>
                                        <td>{{ $info_list->order }}</td>
                                        <td>
                                            <div>
                                                <a href="{{ route('about.edit_info_list', $info_list->id) }}" class="mr-2">
                                                    <i class="fa fa-edit text-info font-18"></i>
                                                </a>
                                                <form class="d-inline-block" action="{{ route('about.destroy_info_list', $info_list->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <span data-toggle="modal" data-target="#deleteModel{{ $info_list->id }}">
                                                            <a type="button">
                                                            <i class="fa fa-trash text-danger font-18"></i>
                                                        </a>
                                                       </span>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="deleteModel{{ $info_list->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('content.delete') }}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('content.close') }}">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    {{ __('content.you_wont_be_able_to_revert_this') }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('content.cancel') }}</button>
                                                                    <button type="submit" class="btn btn-success">{{ __('content.yes_delete_it') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>{{ __('content.not_yet_created') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0 font-16" id="myLargeModalLabel">{{ __('content.add_new') }}</h5><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('about.store_info_list') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                              <div class="single-clint-area-content">
                                  <fieldset class="form-group">
                                      <legend class="font-14">{{ __('content.type') }}</legend>
                                      <div class="form-check pl-0 mb-2">
                                          <label class="form-check-label">
                                              <input type="radio" class="form-check-input mr-2" name="type" id="optionsRadios1" onclick="showHideTypeDiv()" value="icon" checked=""><span class="ml-3">{{ __('content.icon') }}</span>
                                              <i class="input-helper"></i>
                                          </label>
                                      </div>
                                      <div class="form-check pl-0">
                                          <label class="form-check-label">
                                              <input type="radio" class="form-check-input mr-1" name="type" id="optionsRadios2" onclick="showHideTypeDiv()" value="image"><span class="ml-3">{{ __('content.image') }}</span>
                                              <i class="input-helper"></i></label>
                                      </div>
                                  </fieldset>
                                  <div class="form-group" id="icon-type">
                                      <label for="icon" class="d-block">{{ __('content.icon') }}</label>
                                      <div class="btn-group">
                                          <input type="hidden" name="icon" class="form-control" id="icon">
                                          <button type="button" class="btn btn-primary  iconpicker-component"><i id="icon-value" class="iconpicker-component"></i></button>
                                          <button type="button" id="iconPickerBtn" class="icp icp-dd btn btn-primary dropdown-toggle iconpicker-component" data-selected="fa-car" data-toggle="dropdown">
                                              <span class="caret"></span>
                                          </button>
                                          <div class="dropdown-menu"></div>
                                      </div>
                                  </div>
                                  <div id="image-type" style="display: none;">
                                      <div class="form-group">
                                          <label for="image_status" class="col-form-label">{{ __('content.image_status') }} </label>
                                          <select class="form-control" name="image_status" id="image_status">
                                              <option value="show" selected>{{ __('content.select_your_option') }}</option>
                                              <option value="show">{{ __('content.show') }}</option>
                                              <option value="hide">{{ __('content.hide') }}</option>
                                          </select>
                                      </div>
                                      <div class="form-group" >
                                          <label for="info_image">{{ __('content.image') }} ({{ __('content.size') }} 100 x 100) (.svg, .jpg, .jpeg, .png)</label>
                                          <input type="file" name="info_image" class="form-control-file" id="info_image">
                                          <small id="info_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('content.title') }} <span class="text-red">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="desc">{{ __('content.description') }} <span class="text-red">*</span></label>
                                    <input type="text" name="desc" class="form-control" id="desc" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="order">{{ __('content.order') }}</label>
                                    <input type="number" name="order" class="form-control" id="order" value="0" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <small class="form-text text-muted">{{ __('content.required_fields') }}</small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">{{ __('content.submit') }}</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection