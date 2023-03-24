@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <div class="row">
        <div class="col-12 box-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex justify-content-between align-items-center mb-20">
                        <h6 class="card-title mb-0">{{ __('content.software') }}</h6>
                        <div>
                            <button type="button" class="btn btn-primary mb-3 mr-2" data-toggle="modal" data-target="#softwareSectionModal">{{ __('content.section_title_and_desc') }}</button>
                            <a href="{{ url('admin/software/create') }}" class="btn btn-primary float-right mb-3">+ {{ __('content.add_software') }}</a>
                        </div>
                    </div>

                    @if (count($softwares) > 0)
                        <div>
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
                            <form onsubmit="return btnCheckListGet()" action="{{ route('software.destroy_checked') }}" method="POST">
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
                                <th>{{ __('content.title') }}</th>
                                <th>{{ __('content.category_name') }}</th>
                                <th>{{ __('content.period') }}</th>
                                <th>{{ __('content.price') }}</th>
                                <th>{{ __('content.order') }}</th>
                                <th>{{ __('content.status') }}</th>
                                <th class="custom-width-action">{{ __('content.action') }}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $desc = count($softwares); $asc=0; @endphp
                            @foreach ($softwares as $software)
                                <tr>
                                    <td>
                                        <input  name="check_list[]" type="checkbox" value="{{ $software->id }}" onclick="showHideDeleteButton2(this)"> <span class="d-none">{{ $asc++ }}{{ $desc-- }}</span>
                                    </td>
                                    <td>{{ $software->title }}</td>
                                    <td>{{ $software->category_name }}</td>
                                    <td>
                                        @if ($software->period == "monthly")
                                            <span class="badge badge-success">{{ __('content.monthly') }}</span>
                                        @elseif ($software->period == "annually")
                                            <span class="badge badge-success">{{ __('content.annually') }}</span>
                                        @else
                                            <span class="badge badge-success">{{ __('content.onetime') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($software->period == "monthly")

                                            @if ($currency_position == "left") {{ $currency_symbol }}{{ number_format($software->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($software->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }}{{ $currency_symbol }} @endif

                                        @elseif ($software->period == "annually")

                                            @if ($currency_position == "left") {{ $currency_symbol }}{{ number_format($software->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($software->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }}{{ $currency_symbol }} @endif

                                        @else

                                            @if ($currency_position == "left") {{ $currency_symbol }}{{ number_format($software->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($software->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator) }}{{ $currency_symbol }} @endif

                                        @endif
                                    </td>
                                    <td>{{ $software->order }}</td>
                                    <td>
                                        @if ($software->status == "published")
                                            <span class="badge badge-success">{{ __('content.published') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('content.draft') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ route('software.edit', $software->id) }}" class="mr-2">
                                                <i class="fa fa-edit text-info font-18"></i>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $software->id }}">
                                                <i class="fa fa-trash text-danger font-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $software->id }}" tabindex="-1" role="dialog" aria-labelledby="counterModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="counterModalCenterTitle">{{ __('content.delete') }}</h5>
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
                                                    <form class="d-inline-block" action="{{ route('software.destroy', $software->id) }}" method="POST">
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
    <div class="modal fade" id="softwareSectionModal" tabindex="-1" role="dialog" aria-labelledby="softwareSectionModalLabel" aria-modal="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0 font-16" id="softwareSectionModalLabel">{{ __('content.section_title_and_desc') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    @if (isset($software_section))
                        @if ($demo_mode == "on")
                            <!-- Include Alert Blade -->
                                @include('admin.demo_mode.demo-mode')
                            @else
                                <form action="{{ route('software-section.update', $software_section->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="section_title">{{ __('content.section_title') }} <span class="text-red">*</span></label>
                                        <input type="text" name="section_title" class="form-control" id="section_title" value="{{ $software_section->section_title }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="desc">{{ __('content.description') }} <span class="text-red">*</span></label>
                                        <input type="text" name="desc" class="form-control" id="desc" value="{{ $software_section->desc }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="homepage_item_count">{{ __('content.homepage_item_count') }} <span class="text-red">*</span></label>
                                        <input type="number" name="homepage_item_count" class="form-control" id="homepage_item_count" value="{{ $software_section->homepage_item_count }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="paginate">{{ __('content.paginate') }} <span class="text-red">*</span></label>
                                        <input type="number" name="paginate" class="form-control" id="paginate" value="{{ $software_section->paginate }}" required>
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
                                        <form action="{{ route('software-section.store') }}"  method="POST">
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
                                        <input type="text" name="desc" class="form-control" id="desc" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="homepage_item_count">{{ __('content.homepage_item_count') }} <span class="text-red">*</span></label>
                                        <input type="number" name="homepage_item_count" class="form-control" id="homepage_item_count" value="6" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="paginate">{{ __('content.paginate') }} <span class="text-red">*</span></label>
                                        <input type="number" name="paginate" class="form-control" id="paginate" value="9" required>
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
@endsection