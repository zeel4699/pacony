@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <div class="row">
        <div class="col-12 box-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-20">
                        <h6 class="card-title mb-0">{{ __('content.whatsapp_order_requests') }}</h6>
                        <div>
                            <form class="d-block  ml-auto" action="{{ route('whatsapp-order-request.mark_all_read_update') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary mb-3ine">
                                    <i class="fas fa-bookmark"></i> {{ __('content.mark_all_as_read') }}
                                </button>
                            </form>
                            </div>
                    </div>

                    @if (count($whatsapp_order_requests) > 0)
                        <table id="basic-datatable" class="table table-striped dt-responsive w-100">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>{{ __('content.name') }}</th>
                                <th>{{ __('content.email') }}</th>
                                <th>{{ __('content.phone') }}</th>
                                <th>{{ __('content.note') }}</th>
                                <th>{{ __('content.view') }}</th>
                                <th>{{ __('content.read_status') }}</th>
                                <th>{{ __('content.action') }}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $i = 1; @endphp
                            @foreach ($whatsapp_order_requests as $whatsapp_order_request)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $whatsapp_order_request->name }}</td>
                                    <td>{{ $whatsapp_order_request->email }}</td>
                                    <td>{{ $whatsapp_order_request->phone }}</td>
                                    <td>{{ $whatsapp_order_request->note }}</td>
                                    <td>
                                        @if ($whatsapp_order_request->type == "service")
                                            <a href="{{ route('service-page.show', $whatsapp_order_request->product_slug) }}" class="mr-2">
                                                <i class="fas fa-eye text-info font-18"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('software-page.show', $whatsapp_order_request->product_slug) }}" class="mr-2">
                                                <i class="fas fa-eye text-info font-18"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($whatsapp_order_request->read == 0)
                                            <span>{{ __('content.unread') }}</span>
                                        @else
                                            <span>{{ __('content.read') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            @if ($whatsapp_order_request->read == 0)
                                                <form class="d-inline" action="{{ route('whatsapp-order-request.update_mark', $whatsapp_order_request->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button type="submit" data-toggle="tooltip"  class="btn btn-primary mr-2 pt-2 pb-2 pr-3 pl-3" data-original-title="{{ __('content.mark') }}">
                                                        <i class="fas fa-bookmark"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $whatsapp_order_request->id }}">
                                                <i class="fa fa-trash text-danger font-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $whatsapp_order_request->id }}" tabindex="-1" role="dialog" aria-labelledby="messageModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="messageModalCenterTitle">{{ __('content.delete') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('content.close') }}">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                {{ __('content.you_wont_be_able_to_revert_this') }}
                                            </div>
                                            <div class="modal-footer">
                                                <form class="d-inline-block" action="{{ route('whatsapp-order-request.destroy', $whatsapp_order_request->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
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
@endsection