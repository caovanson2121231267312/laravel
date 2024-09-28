@extends('admins.layouts.app')

@section('title')
    <title>Quản lí đơn hàng </title>
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">Quản lí đơn hàng </h1>
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
                                <label>Trạng thái</label>
                                <select class="form-control" id="status">
                                    <option value="">-- Tất cả --</option>
                                    <option value="1">trong giỏ hàng</option>
                                    <option value="2">chờ duyệt</option>
                                    <option value="3">đã duyệt</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <div class="mb-3">
                                <label>Tạo lúc</label>
                                <input type="date" class="form-control" id="created_at">
                            </div>
                        </div>

                        <div
                            class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 d-flex align-items-end justify-content-between">
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-info" id="btn-search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-primary mr-1" data-toggle="modal"
                                    data-target="#ModalAddNew">
                                    <i class="fas fa-plus-circle mr-1"></i> Thêm người dùng
                                </button>
                                <button type="button" class="btn btn-outline-success">
                                    <i class="fas fa-file-download mr-1"></i> Xuất excel
                                </button>
                            </div>
                        </div>
                    </div>


                    <table id="datatables" class="table table-hover w-100">
                        <thead class="panels">
                            <tr>
                                <th> ID </th>
                                <th> User name </th>
                                <th> Số sản phẩm </th>
                                <th> Status </th>
                                <th> Tạo lúc </th>
                                <th> Cập nhật lúc </th>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAddNewLabel">
                        <b>Thêm tài khoản</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('users.store') }}" method="POST" id="submit_form_add" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1">Tên người dùng:</label>
                            <input type="text" class="form-control" name="name">
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Email:</label>
                            <input type="text" class="form-control" name="email">
                            <div id="email-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Avatar:</label>
                            <input type="file" class="form-control" name="avatar">
                            <div id="avatar-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Date:</label>
                            <input type="date" class="form-control" name="establish">
                            <div id="establish-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Password:</label>
                            <input type="text" class="form-control" name="password">
                            <div id="password-error" class="text-danger fs-6"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="btn-submit-add">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- modal show --}}
    <div class="modal fade" id="ModalShow" tabindex="-1" aria-labelledby="ModalShowLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="ModalShowLabel">Thông tin đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="ModalShowContent">

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
                url: '{{ route('order.index') }}',
                type: 'GET',
                data: function(param) {
                    param.keywords = $("#keywords").val();
                    param.establish = $("#establish").val();
                    param.created_at = $("#created_at").val();
                    param.status = $("#status").val();
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                },

                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'order_detail_count',
                    name: 'order_detail_count'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        var status = 1;
                        if (row.status == 1) {
                            status = "<div class='text-warning'>Giỏ hàng</div>";
                        } else if (row.status == 2) {
                            status = "<div class='text-info'>Chờ duyệt</div>";
                        } else if (row.status == 3) {
                            status = "<div class='text-success'>Đã duyệt</div>";
                        }

                        return status
                    }
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
                                            <a class="dropdown-item modal-show" data-id="${row?.id}" data-url="{{ route('order.show', ['id' => '/']) }}/${row?.id}" href="#">
                                                Chi tiết đơn hàng
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

        $(document).on('change', '#created_at', debounce(function() {
            datatables.ajax.reload();
        }, 300))

        $(document).on('change', '#status', debounce(function() {
            datatables.ajax.reload();
        }, 300))


        $(document).on('click', '.modal-show', function(event) {
            event.preventDefault();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: $(this).data('id'),
                },
                success: async function(response) {
                    if (response) {
                        await $("#ModalShowContent").html(response)
                        await $('#ModalShow').modal('show');
                    }
                },
                error: function(xhr) {
                    $('#ModalShow').modal('hide');
                    $("#ModalShowContent").html("")
                }
            });
        })


        $(document).on('click', '#btn-confirm', function(event) {
            event.preventDefault();
            var url = $("#confirm_order").attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    order_id: $("#order_id").val(),
                },
                success: function(response) {
                    if (response) {
                        // $("#ModalShowContent").html(response)
                        $('#ModalShow').modal('hide');
                        datatables.ajax.reload();
                        toastr.success(response?.success)
                    }
                },
                error: function(xhr) {
                    $('#ModalShow').modal('hide');
                    // $("#ModalShowContent").html("")
                }
            });
        })



        // });
    </script>
@endpush
