@extends('admins.layouts.app')

@section('title')
    <title>Admin - Product</title>
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">Sản Phẩm</h1>
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
                                <label>Danh mục</label>
                                <select class="form-control" id="search_category">
                                    <option selected value="">-- Tất Cả --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <div class="mb-3">
                                <label>Trạng thái</label>
                                <select class="form-control" id="status">
                                    <option selected value="">-- Tất Cả --</option>
                                    <option value="1">Sắp ra mắt</option>
                                    <option value="2">Đang được bán</option>
                                    <option value="3">Hết hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <div class="mb-3">
                                <label>Ngày sinh</label>
                                <input type="date" class="form-control" id="establish">
                            </div>
                        </div>
                        <div
                            class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 d-flex align-items-end justify-content-between">
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-info" id="btn-search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-primary mr-1" data-toggle="modal"
                                    data-target="#ModalAddNew">
                                    <i class="fas fa-plus-circle mr-1"></i> Thêm sản phẩm
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
                                <th> name </th>
                                <th> img </th>
                                <th> Danh mục </th>
                                <th> Người tạo </th>
                                <th> tồn kho </th>
                                <th> Giá tiền </th>
                                <th> status </th>
                                <th> sale </th>
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
                        <b>Thêm sản phẩm</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('product.store') }}" method="POST" id="submit_form_add"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1">Tên sản phẩm:</label>
                            <input type="text" class="form-control" name="name">
                            <div id="name-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Ảnh sản phẩm:</label>
                            <input type="file" class="form-control" name="img">
                            <div id="img-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Danh mục sản phẩm: </label>
                            <select class="form-control" name="category_id">
                                <option selected value="" disabled>-- Chọn danh mục sản phẩm --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div id="category_id-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Trạng thái sản phẩm: </label>
                            <select class="form-control" name="status">
                                <option value="1">Sắp ra mắt</option>
                                <option value="2">Đang được bán</option>
                                <option value="3">Hết hàng</option>
                            </select>
                            <div id="status-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Giá sản phẩm </label>
                            <input type="text" class="form-control" name="price">
                            <div id="price-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Giảm giá sản phẩm </label>
                            <input type="number" class="form-control" name="sale">
                            <div id="sale-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Số lượng tồn kho: </label>
                            <input type="number" class="form-control" name="stock">
                            <div id="stock-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Mô tả:</label>
                            <textarea class="form-control" name="description" cols="30" rows="3"></textarea>
                            <div id="description-error" class="text-danger fs-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="mb-1">Mô tả chi tiết sản phẩm:</label>
                            <textarea class="form-control" name="content" cols="30" rows="7"></textarea>
                            <div id="content-error" class="text-danger fs-6"></div>
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
                url: '{{ route('product.index') }}',
                type: 'GET',
                data: function(param) {
                    param.keywords = $("#keywords").val();
                    param.search_category = $("#search_category").val();
                    param.status = $("#status").val();
                    param.establish = $("#establish").val();
                }
            },
            columns: [{
                    data: 'name',
                    name: 'name',
                    render: function(data, type, row) {
                        // cons
                        let html =
                            `<a target="_blank" href="{{ config('app.url') }}/${row?.slug}">${row?.name}</a>`
                        return html
                    }
                },
                {
                    data: 'img',
                    name: 'img',
                    render: function(data, type, row) {
                        // cons
                        let html =
                            `<img class="border rounded-circle border-1" width="80" src="{{ config('app.url') }}/${row?.img}" />`
                        return html
                    }
                },
                {
                    data: 'category.name',
                    name: 'category.name'
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'stock',
                    name: 'stock'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        var status_value = 1;
                        if (row.status == 1) {
                            status_value = "<div class='text-info'>sắp ra mắt</div>";
                        } else if (row.status == 2) {
                            status_value = "<div class='text-success'>đang được bán</div>";
                        } else {
                            status_value = "<div class='text-danger'>hết hàng</div>";
                        }
                        return status_value
                    }
                },
                {
                    data: 'sale',
                    name: 'sale'
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
        $(document).on('change', '#search_category', debounce(function() {
            datatables.ajax.reload();
        }, 300))
        $(document).on('change', '#status', debounce(function() {
            datatables.ajax.reload();
        }, 300))


        // });
    </script>
@endpush
