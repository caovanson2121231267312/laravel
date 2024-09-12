@extends('admins.layouts.app')

@section('title')
    <title>Admin - {{ __('messages.account_management') }}</title>
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('messages.account_management') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">{{ __('messages.home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('messages.list_of_accounts') }}</li>
        </ol>
    </div>
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                            <div class="mb-3">
                                <label>{{ __('messages.search') }}</label>
                                <input type="text" class="form-control"
                                    placeholder="{{ __('messages.keywords_seach_user') }}" id="keywords">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <div class="mb-3">
                                <label>{{ __('messages.position') }}</label>
                                <select class="custom-select rounded-0" id="roles">
                                    <option value="0">Tất cả</option>
                                    @foreach ($roles as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <div class="mb-3">
                                <label>{{ __('messages.date_of_birth') }}</label>
                                <input type="date" class="form-control" id="date_of_birth">
                            </div>
                        </div>
                        {{-- <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <div class="mb-3">
                                <label>{{ __('messages.date_join') }}</label>
                                <input type="date" class="form-control" id="date_join">
                            </div>
                        </div> --}}
                        <div
                            class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 d-flex align-items-end justify-content-between">
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-info" id="btn-search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-primary mr-1">
                                    <i class="fas fa-plus-circle mr-1"></i> {{ __('messages.add_users') }}
                                </button>
                                <button type="button" class="btn btn-outline-success">
                                    <i class="fas fa-file-download mr-1"></i> {{ __('messages.export_excel') }}
                                </button>
                            </div>
                        </div>
                        {{-- <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <div class="mb-3">
                                <label>{{ __('messages.departments') }}</label>
                                <select class="form-control select2 w-100" id="departments">
                                    <option value="0">{{ __('messages.all_departments') }}</option>
                                    @foreach ($departments as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                    </div>

                    <div class="mb-3">
                        <div class="mb-2 text-center">
                            <a class="text-secondary" data-toggle="collapse" href="#collapseExample" role="button"
                                aria-expanded="false" aria-controls="collapseExample">
                                <span class="mr-1">{{ __('messages.advanced_filter') }}</span> <i class="fas fa-caret-down"></i>
                            </a>
                        </div>
                        <div class="collapse" id="collapseExample">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-2 col-lg-32 col-xl-2">
                                    <div class="mb-3">
                                        <label>{{ __('messages.employee_code') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ __('messages.employee_code') }}" id="employee_code">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <div class="mb-3">
                                        <label>{{ __('messages.areas') }}</label>
                                        <select class="form-control select2 w-100" id="areas">
                                            <option value="0">{{ __('messages.all_areas') }}</option>
                                            @foreach ($areas as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <div class="mb-3">
                                        <label>{{ __('messages.province') }}</label>
                                        <select class="form-control select2 w-100" id="provinces">
                                            <option value="0">{{ __('messages.all_province') }}</option>
                                            @foreach ($provinces as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <div class="mb-3">
                                        <label>{{ __('messages.district') }}</label>
                                        <select class="form-control select2 w-100" id="districts">
                                            <option value="0">{{ __('messages.all_district') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <div class="mb-3">
                                        <label>{{ __('messages.departments') }}</label>
                                        <select class="form-control select2 w-100" id="departments">
                                            <option value="0">{{ __('messages.all_departments') }}</option>
                                            @foreach ($departments as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <table id="datatables" class="table table-hover">
                        <thead class="panels">
                            <tr>
                                <th> {{ __('ID') }} </th>
                                <th> {{ __('messages.user_name') }} </th>
                                <th> {{ __('messages.email') }} </th>
                                <th> {{ __('messages.phone') }} </th>
                                <th> {{ __('messages.date_of_birth') }} </th>
                                <th> {{ __('messages.position') }} </th>
                                <th> {{ __('messages.status') }} </th>
                                <th class="text-center"> {{ __('messages.action') }} </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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
                    // "sProcessing": '<div id="loader-wrapper"><div id="loader"></div><div class="loader-section section-left"></div><div class="loader-section section-right"></div></div>',
                    // "sInfoEmpty": "Showing 0 to 0 of 0 records",
                    // "sInfoFiltered": "(filtered from _MAX_ total records)"
                },
                ajax: {
                    url: '{{ route('management.users.index') }}',
                    type: 'GET',
                    data: function(param) {
                        param.keywords = $("#keywords").val();
                        param.roles = $("#roles").val();
                        param.date_of_birth = $("#date_of_birth").val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        // render: function(data, type, row, meta) {
                        //     return meta.row + meta.settings._iDisplayStart + 1 + ((currentPage -1) * 10);
                        // }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'date_of_birth',
                        name: 'date_of_birth'
                    },
                    {
                        data: 'roles',
                        name: 'roles',
                        orderable: false,
                        render: function(data, type, row) {
                            // console.log(row)
                            let html = `<div>`
                            $(row?.roles).each(function(index, item) {
                                console.log(index, item);
                                html +=
                                    `<a href="#" class="badge bg-info">${item?.name}</a>`
                            });
                            html += `</div>`
                            return html
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            return $.parseHTML(row?.status)[0]?.textContent;
                        }
                    },
                    {
                        data: 'action',
                        orderable: false,
                        render: function(data, type, row) {
                            let user_status = ''
                            if (row?.status_check == 1) {
                                user_status +=
                                    `<a class="dropdown-item lock_users" href="javascript:void(0)" data-id="${row?.id}" data-status="${row?.status_check}">{{ __('messages.lock_account') }}</a>`
                            } else {
                                user_status +=
                                    `<a class="dropdown-item lock_users" href="javascript:void(0)" data-id="${row?.id}" data-status="${row?.status_check}">{{ __('messages.open_account') }}</a>`
                            }
                            let html = `<div class="text-center">
                                        <button type="button" class="btn" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v text-primary"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            ${user_status}
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

            $(document).on('change', '#roles', function() {
                datatables.ajax.reload();
            })

            $(document).on('change', '#date_of_birth', debounce(function() {
                datatables.ajax.reload();
            }, 300))

            $(document).on('change', '#provinces', function() {
                var code = $(this).val();
                if (code != "" && Number(code)) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('app.district') }}",
                        data: {
                            code: code
                        },
                        dataType: "json",
                        success: function(data) {
                            var arr = data?.data
                            var option =
                                '<option value="0">{{ __('messages.all_district') }}</option>';
                            for (let i = 0; i < arr.length; i++) {
                                option += '<option value="' + arr[i]['id'] + '">' + arr[i][
                                    'name'
                                ] + '</option>';
                            }
                            $('#districts').html(option);
                            $('#districts').select2();
                        }
                    });
                } else if (code == 0) {
                    $('#districts').html('<option value="0">{{ __('messages.all_district') }} </option>');
                }
            });

            $(document).on('click', '.lock_users', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');

                if (status == 1) {
                    var content_html = `{{ __('messages.content_lock_account') }}`;
                } else {
                    var content_html = `{{ __('messages.content_open_account') }}`;
                }

                Swal.fire({
                    // title: content_html,
                    text: content_html,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "{{ __('messages.confirm') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('management.users.lock_account') }}',
                            type: 'POST',
                            data: {
                                user_id: id,
                                status: status,
                            },
                            success: function(response) {
                                toastr.success(response?.success)
                                datatables.ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                check_message_error(xhr)
                                datatables.ajax.reload();
                            }
                        });
                    }
                });

            });

        });
    </script>
@endpush
