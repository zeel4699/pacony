@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <div class="row">
        <div class="col-12 box-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex justify-content-between align-items-center mb-20">
                        <h6 class="card-title mb-0">{{ __('content.partners') }}</h6>
                        <div>
                            <button type="button" class="btn btn-primary mb-3 mr-2" data-toggle="modal" data-target="#partnerSectionModal">{{ __('content.section_title_and_desc') }}</button>
                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#partnerModal">+ {{ __('content.add_partner') }}</button>
                        </div>
                    </div>
                    @if (count($partners) > 0)
                        <div class="mr-3">
                            <input id="check_all" type="checkbox" onclick="showHideDeleteButton(this)">
                            <label for="check_all">{{ __('content.all') }}</label>
                            <a id="deleteChecked" class="ml-2" href="#" data-toggle="modal" data-target="#deleteCheckedModal">
                                <i class="fa fa-trash text-danger font-18"></i>
                            </a>
                        </div>
                        @if ($demo_mode == "on")
                        <!-- Include Alert Blade -->
                            @include('admin.demo_mode.demo-mode')
                        @else
                            <form onsubmit="return btnCheckListGet()" action="{{ route('partner.destroy_checked') }}" method="POST">
                                @method('DELETE')
                                @csrf
                                @endif

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
                        <table id="basic-datatable" class="table table-striped dt-responsive w-100">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>{{ __('content.image') }}</th>
                                <th>{{ __('content.title') }}</th>
                                <th>{{ __('content.description') }}</th>
                                <th>{{ __('content.order') }}</th>
                                <th class="custom-width-action">{{ __('content.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $desc = count($partners); $asc=0; @endphp
                            @foreach ($partners as $partner)
                                <tr>
                                    <td>
                                        <input  name="check_list[]" type="checkbox" value="{{ $partner->id }}" onclick="showHideDeleteButton2(this)"> <span class="d-none">{{ $asc++ }}{{ $desc-- }}</span>
                                    </td>
                                    <td>
                                            @if (!empty($partner->partner_image))
                                                <img class="image-size img-fluid" src="{{ asset('uploads/img/partner/'.$partner->partner_image) }}" alt="image">
                                            @else
                                                <img class="image-size img-fluid" src="{{ asset('uploads/img/dummy/no-image.jpg') }}" alt="no image">
                                            @endif
                                    </td>
                                    <td>{{ $partner->title }}</td>
                                    <td>{{ $partner->desc }}</td>
                                    <td>{{ $partner->order }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('partner.edit', $partner->id) }}" class="mr-2">
                                                <i class="fa fa-edit text-info font-18"></i>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $partner->id }}">
                                                <i class="fa fa-trash text-danger font-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $partner->id }}" tabindex="-1" role="dialog" aria-labelledby="partnerModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="partnerModalCenterTitle">{{ __('content.delete') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('content.close') }}">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                {{ __('content.you_wont_be_able_to_revert_this') }}
                                            </div>
                                            <div class="modal-footer">
                                            @if ($demo_mode == "on")
                                                <!-- Include Alert Blade -->
                                                    @include('admin.demo_mode.demo-mode')
                                                @else
                                                    <form class="d-inline-block" action="{{ route('partner.destroy', $partner->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        @endif

                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('content.cancel') }}</button>
                                                    <button type="submit" class="btn btn-success">{{ __('content.yes_delete_it') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <span>{{ __('content.not_yet_created') }}</span>
                    @endif

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div><!-- end row-->
    <div class="modal fade" id="partnerSectionModal" tabindex="-1" role="dialog" aria-labelledby="partnerSectionModalLabel" aria-modal="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0 font-16" id="partnerModalLabel">{{ __('content.section_title_and_desc') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    @if (isset($partner_section))
                        @if ($demo_mode == "on")
                            <!-- Include Alert Blade -->
                                @include('admin.demo_mode.demo-mode')
                            @else
                                <form action="{{ route('partner-section.update', $partner_section->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="section_title">{{ __('content.section_title') }} <span class="text-red">*</span></label>
                                        <input type="text" name="section_title" class="form-control" id="section_title" value="{{ $partner_section->section_title }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="desc">{{ __('content.description') }} <span class="text-red">*</span></label>
                                        <textarea name="desc" class="form-control" id="desc" rows="3" required>{{ $partner_section->desc }}</textarea>
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
                    @else
                                    @if ($demo_mode == "on")
                                    <!-- Include Alert Blade -->
                                        @include('admin.demo_mode.demo-mode')
                                    @else
                                        <form action="{{ route('partner-section.store') }}" method="POST">
                                            @csrf
                                            @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="section_title">{{ __('content.section_title') }} <span class="text-red">*</span></label>
                                        <input type="text" name="section_title" class="form-control" id="section_title" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="desc">{{ __('content.description') }} <span class="text-red">*</span></label>
                                        <textarea name="desc" class="form-control" id="desc" rows="3" required></textarea>
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
                    @endif
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="partnerModal" tabindex="-1" role="dialog" aria-labelledby="partnerModalLabel" aria-modal="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0 font-16" id="partnerModalLabel">{{ __('content.add_new') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                @if ($demo_mode == "on")
                    <!-- Include Alert Blade -->
                        @include('admin.demo_mode.demo-mode')
                    @else
                        <form action="{{ route('partner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @endif

                        <div class="row">
                            <div class="col-xl-12">
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
                                      <label for="partner_image">{{ __('content.image') }} ({{ __('content.size') }} 120 x 120) (.svg, .jpg, .jpeg, .png)</label>
                                      <input type="file" name="partner_image" class="form-control-file" id="partner_image">
                                      <small id="partner_image" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
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
                                    <label for="desc">{{ __('content.description') }}</label>
                                    <textarea name="desc" class="form-control" rows="3" id="desc"></textarea>
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