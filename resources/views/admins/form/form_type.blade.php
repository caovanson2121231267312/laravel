@extends('admins.layouts.app')

@section('title')
    <title>Admin - {{ __('messages.form_type') }}</title>
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('messages.form_type') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">{{ __('messages.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('messages.form_type') }}</li>
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
                                    <i class="fas fa-plus-circle mr-1"></i> {{ __('messages.add_new') }}
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
                                <th> {{ __('messages.form_type') }} </th>
                                <th> {{ __('messages.created_at') }} </th>
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
                    <h5 class="modal-title" id="ModalAddNewLabel">{{ __('messages.add_new_form_type') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.form.type_create') }}" method="POST" id="submit_form_add">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1">{{ __('messages.form_type') }}:</label>
                            <input type="text" class="form-control" name="name">
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>
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
                    <h5 class="modal-title" id="ModalEditLabel">{{ __('messages.edit_form_type') }}</h5>
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
                url: '{{ route('admin.form.type') }}',
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
                    data: 'created_at',
                    name: 'created_at'
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
                                    <a class="dropdown-item modal-edit" data-id="${row?.id}" data-url="{{ route('admin.form.show_form_type', ['id' => '/']) }}/${row?.id}" href="#">{{ __('messages.edit') }}</a>
                                    <a class="dropdown-item detele_item" data-id="${row?.id}" data-url="{{ route('admin.form.delete_form_type', ['id' => '/']) }}/${row?.id}" data-content="{{ __('messages.content_delete') }}" data-confirm="{{ __('messages.confirm') }}" href="#">{{ __('messages.delete') }}</a>
                                </div>
                            </div>`
                        return html
                    }
                },

            ],
        });

        $(document).on('click', '#btn-search', function() {
            datatables.ajax.reload();
        })

        $(document).on('change', '#keywords', debounce(function() {
            datatables.ajax.reload();
        }, 300))

    </script>
@endpush
