@extends('admins.layouts.app')

@section('title')
    <title>Quản lí chức vụ</title>
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">Tài khoản</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active">Tài khoản</li>
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
                                <label>Tìm kiếm</label>
                                <input type="text" class="form-control" placeholder="Nhập tên" id="keywords">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <div class="mb-3">
                                <label>Ngày sinh</label>
                                <input type="date" class="form-control" id="establish">
                            </div>
                        </div>
                        <div
                            class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 d-flex align-items-end justify-content-between">
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-info" id="btn-search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-primary mr-1" data-toggle="modal"
                                    data-target="#ModalAddNew">
                                    <i class="fas fa-plus-circle mr-1"></i> Thêm chức vụ
                                </button>
                            </div>
                        </div>
                    </div>


                    <table id="datatables" class="table table-hover w-100">
                        <thead class="panels">
                            <tr>
                                <th> ID </th>
                                <th> Name </th>
                                <th> Số quyền </th>
                                <th> Cập nhập lúc </th>
                                <th> Tạo lúc </th>
                                <th class="text-center">Action</th>
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
                    <h5 class="modal-title" id="ModalAddNewLabel">
                        <b>Thêm chức vụ</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('role.store') }}" method="POST" id="submit_form_add" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1">Tên chức vụ:</label>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="btn-submit-add">Thêm mới</button>
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
                    <h5 class="modal-title" id="ModalEditLabel">chỉnh sửa chức vụ </h5>
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
        // $(document).ready(function() {
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
                "sZeroRecords": "<div class='alert alert-info'>Danh sách trống</div>",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ khách hàng",
                "sProcessing": "<div id='loader-datatable'></div>",
            },
            ajax: {
                url: '{{ route('role.index') }}',
                type: 'GET',
                data: function(param) {
                    param.keywords = $("#keywords").val();
                    param.establish = $("#establish").val();
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
                    data: 'permissions_count',
                    name: 'permissions_count'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item modal-edit" data-id="${row?.id}" data-url="{{ route('role.edit', ['id' => '/']) }}/${row?.id}" href="#">
                                                Edit
                                            </a>
                                            <a class="dropdown-item detele_item" data-id="${row?.id}" data-url="{{ route('users.delete', ['id' => '/']) }}/${row?.id}" href="#">
                                                Delete
                                            </a>

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

        $(document).on('change', '#establish', debounce(function() {
            datatables.ajax.reload();
        }, 300))


        $('.select-all').on('change', function() {
            var groupIndex = $(this).attr('id').split('-').pop();
            var isChecked = $(this).is(':checked');
            $('input[data-group="' + groupIndex + '"]').prop('checked', isChecked);
        });





        // $(document).on("click", "#export-excel", function() {
        //     $.ajax({
        //         url: '{{ route('users.export') }}',
        //         type: 'POST',
        //         // data: formData,
        //         processData: false,
        //         contentType: false,
        //         success: function(result, status, xhr) {
        //             var disposition = xhr.getResponseHeader('content-disposition');
        //             var matches = /"([^"]*)"/.exec(disposition);
        //             var filename = (matches != null && matches[1] ? matches[1] : "users.xlsx");

        //             var blob = new Blod([result], {
        //                 type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        //             })

        //             var link = document.createElement('a');
        //             link.href = windown.URL.createObjectURL(blob);
        //             link.download = filename
        //             document.appendChild(link)
        //             link.click()
        //             document.body.removeChild(link);
        //         },
        //         error: function(xhr) {
        //             check_message_error(xhr, "edit")
        //         }
        //     });
        // })
        // });
    </script>
@endpush
