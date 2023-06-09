@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <div class="row">
        <div class="col-12 box-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex justify-content-between align-items-center mb-20">
                        <h6 class="card-title mb-0">{{ __('content.whatsapp_chat') }}</h6>
                        <div>
                            <button type="button" class="btn btn-primary mb-3 mr-2" data-toggle="modal" data-target="#whatsappChatSectionModal">{{ __('content.section_title_and_desc') }}</button>
                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#whatsappChatModal">+ {{ __('content.add_whatsapp_chat') }}</button>
                        </div>
                    </div>
                    @if (count($whatsapp_chats) > 0)
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
                            <form onsubmit="return btnCheckListGet()" action="{{ route('whatsapp-chat.destroy_checked') }}" method="POST">
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
                                <th>{{ __('content.name') }}</th>
                                <th>{{ __('content.job') }}</th>
                                <th>{{ __('content.phone') }}</th>
                                <th>{{ __('content.accessibility') }}</th>
                                <th>{{ __('content.status') }}</th>
                                <th>{{ __('content.order') }}</th>
                                <th class="custom-width-action">{{ __('content.action') }}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $desc = count($whatsapp_chats); $asc=0; @endphp
                            @foreach ($whatsapp_chats as $whatsapp_chat)
                                <tr>
                                    <td>
                                        <input  name="check_list[]" type="checkbox" value="{{ $whatsapp_chat->id }}" onclick="showHideDeleteButton2(this)"> <span class="d-none">{{ $asc++ }}{{ $desc-- }}</span>
                                    </td>
                                    <td>
                                        @if (!empty($whatsapp_chat->whatsapp_chat_image))
                                            <img class="image-size img-fluid" src="{{ asset('uploads/img/whatsapp_chat/'.$whatsapp_chat->whatsapp_chat_image) }}" alt="whatsapp_chat image">
                                        @else
                                            <img class="image-size img-fluid" src="{{ asset('uploads/img/dummy/no-image.jpg') }}" alt="no image">
                                        @endif
                                    </td>
                                    <td>{{ $whatsapp_chat->name }}</td>
                                    <td>{{ $whatsapp_chat->job }}</td>
                                    <td>{{ $whatsapp_chat->phone }}</td>
                                    <td>
                                        @if ($whatsapp_chat->accessibility == "online")
                                            <span class="badge badge-success">{{ __('content.online') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('content.offline') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($whatsapp_chat->status == "published")
                                            <span class="badge badge-success">{{ __('content.published') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('content.draft') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $whatsapp_chat->order }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('whatsapp-chat.edit', $whatsapp_chat->id) }}" class="mr-2">
                                                <i class="fa fa-edit text-info font-18"></i>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $whatsapp_chat->id }}">
                                                <i class="fa fa-trash text-danger font-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $whatsapp_chat->id }}" tabindex="-1" role="dialog" aria-labelledby="whatsapp_chatModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="whatsapp_chatModalCenterTitle">{{ __('content.delete') }}</h5>
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
                                                    <form class="d-inline-block" action="{{ route('whatsapp-chat.destroy', $whatsapp_chat->id) }}" method="POST">
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
    <div class="modal fade" id="whatsappChatSectionModal" tabindex="-1" role="dialog" aria-labelledby="whatsappChatSectionModalLabel" aria-modal="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0 font-16" id="whatsappChatSectionModalLabel">{{ __('content.section_title_and_desc') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    @if (isset($whatsapp_chat_section))
                        @if ($demo_mode == "on")
                            <!-- Include Alert Blade -->
                                @include('admin.demo_mode.demo-mode')
                            @else
                                <form action="{{ route('whatsapp-chat-section.update', $whatsapp_chat_section->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="section_title">{{ __('content.section_title') }} <span class="text-red">*</span></label>
                                        <input type="text" name="section_title" class="form-control" id="section_title" value="{{ $whatsapp_chat_section->section_title }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="desc">{{ __('content.description') }} <span class="text-red">*</span></label>
                                        <textarea name="desc" class="form-control" id="desc" rows="3" required>{{ $whatsapp_chat_section->desc }}</textarea>
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
                                        <form action="{{ route('whatsapp-chat-section.store') }}"  method="POST">
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
    <div class="modal fade" id="whatsappChatModal" tabindex="-1" role="dialog" aria-labelledby="whatsappChatModalLabel" aria-modal="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0 font-16" id="whatsappChatModalLabel">{{ __('content.add_new') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                @if ($demo_mode == "on")
                    <!-- Include Alert Blade -->
                        @include('admin.demo_mode.demo-mode')
                    @else
                        <form action="{{ route('whatsapp-chat.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @endif

                        <div class="row">
                            <div class="col-md-12">
                               <div class="single-clint-area-content">
                                   <div class="form-group">
                                       <label for="image_status" class="col-form-label">{{ __('content.image_status') }}</label>
                                       <select name="image_status" class="form-control" id="image_status">
                                           <option value="show" selected>{{ __('content.select_your_option') }}</option>
                                           <option value="show">{{ __('content.show') }}</option>
                                           <option value="hide">{{ __('content.hide') }}</option>
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label for="whatsapp_chat_image2">{{ __('content.image') }} ({{ __('content.size') }} 70 x 70) (.svg, .jpg, .jpeg, .png)</label>
                                       <input type="file" name="whatsapp_chat_image" class="form-control-file" id="whatsapp_chat_image2">
                                       <small id="whatsapp_chat_image2" class="form-text text-muted">{{ __('content.please_use_recommended_sizes') }}</small>
                                   </div>
                               </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">{{ __('content.name') }} <span class="text-red">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="job">{{ __('content.job') }} <span class="text-red">*</span></label>
                                    <input type="text" name="job" class="form-control" id="job" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">{{ __('content.phone') }} <span class="text-red">*</span></label>
                                    <input type="text" name="phone" class="form-control" id="phone" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="accessibility" class="col-form-label">{{ __('content.accessibility') }} </label>
                                    <select class="form-control" name="accessibility" id="accessibility">
                                        <option value="online" selected>{{ __('content.select_your_option') }}</option>
                                        <option value="online">{{ __('content.online') }}</option>
                                        <option value="offline">{{ __('content.offline') }}</option>
                                    </select>
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