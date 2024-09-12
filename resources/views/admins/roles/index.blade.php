@extends('admins.layouts.app')

@section('title')
    <title>Admin - {{ __('messages.positions_management') }}</title>
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('messages.positions_management') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">{{ __('messages.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('messages.list_of_positions') }}</li>
        </ol>
    </div>
@endsection

@section('body')
    <div class="row">

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                            <div class="mb-3">
                                <label>{{ __('messages.search') }}</label>
                                <input type="text" class="form-control"
                                    placeholder="{{ __('messages.search_keywords') }}" id="keywords">
                            </div>
                        </div>

                        <div
                            class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 d-flex align-items-end justify-content-between">
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-info" id="btn-search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-primary mr-1" data-toggle="modal"
                                    data-target="#ModalAddNew">
                                    <i class="fas fa-plus-circle mr-1"></i> {{ __('messages.add_position') }}
                                </button>
                                <button type="button" class="btn btn-outline-success">
                                    <i class="fas fa-file-download mr-1"></i> {{ __('messages.export_excel') }}
                                </button>
                            </div>
                        </div>

                    </div>

                    <table id="datatables" class="table table-hover">
                        <thead class="panels">
                            <tr>
                                <th> {{ __('ID') }} </th>
                                <th> {{ __('messages.position') }} </th>
                                <th> {{ __('messages.account') }} </th>
                                <th> {{ __('messages.permission') }} </th>
                                <th> {{ __('messages.updated_at') }} </th>
                                <th class="text-center"> {{ __('messages.action') }} </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- modal create --}}
    <div class="modal fade" id="ModalAddNew" tabindex="-1" aria-labelledby="ModalAddNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAddNewLabel">{{ __('messages.add_new_positions') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('management.roles.store') }}" method="POST" id="submit_form_add">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1">{{ __('messages.position') }}:</label>
                            <input type="text" class="form-control" name="name">
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>

                        @foreach ($arr_permissions as $key => $permission_group)
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label class="my-input">
                                        {{ $key }}
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input select-all input-checkbox-m" type="checkbox" value="" id="select-all-{{ $key }}">
                                        <label class="form-check-label pl-0" for="select-all-{{ $key }}">
                                            Chọn tất cả
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" style="border: 1px solid rgba(0, 0, 0, .15);">
                                    <div class="d-flex flex-wrap pt-3 pb-3">
                                        @foreach ($permission_group as $permission)
                                            <div class="col-md-4 pl-3">
                                                <div class="form-check">
                                                    <input class="form-check-input input-checkbox-m" name="permission[]" type="checkbox" data-group="{{ $key }}"
                                                        value="{{ $permission['id'] }}" id="permission{{ $permission['id'] }}">
                                                    <label class="form-check-label pl-0" for="permission{{ $permission['id'] }}">
                                                        {{ $permission['title'] }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-primary"
                            id="btn-submit-add">{{ __('messages.save_changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditLabel">{{ __('messages.edit_position') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="ModalEditContent">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var datatables = $('#datatables').DataTable({
            dom: 'rtp',
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            bPaginate: true,
            autofill: true,
            "order": [
                [0, "DESC"]
            ],
            "oLanguage": {
                "sLengthMenu": "Hiển thị _MENU_",
                "sZeroRecords": "<div class='alert alert-info'>{{ __('messages.empty_list') }}</div>",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ khách hàng",
                "sProcessing": "<div id='loader-datatable'></div>",
            },
            ajax: {
                url: '{{ route('management.roles.index') }}',
                type: 'GET',
                data: function(param) {
                    param.keywords = $("#keywords").val();
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'users_count',
                    name: 'users_count'
                },
                {
                    data: 'permissions_count',
                    name: 'permissions_count'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    orderable: false,
                    render: function(data, type, row) {
                        let html = `<div class="text-center">
                                <button type="button" class="btn" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v text-primary"></i>
                                </button>
                                <div class="dropdown-menu" role="menu" style="">
                                    <a class="dropdown-item modal-edit" data-id="${row?.id}" data-url="{{ route('management.roles.show', ['id' => '/']) }}/${row?.id}" href="#">{{ __('messages.edit') }}</a>
                                </div>
                            </div>`
                        return html
                    }
                },

            ],
        });

        $('.select-all').on('change', function() {
            var groupIndex = $(this).attr('id').split('-').pop();
            var isChecked = $(this).is(':checked');
            $('input[data-group="' + groupIndex + '"]').prop('checked', isChecked);
        });

        $(document).on('click', '#btn-search', function() {
            datatables.ajax.reload();
        })

        $(document).on('change', '#keywords', debounce(function() {
            datatables.ajax.reload();
        }, 300))

    </script>
@endpush
