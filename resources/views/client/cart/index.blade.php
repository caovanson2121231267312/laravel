@extends('extends.client')

@section('head')
    <title>
        Giỏ hàng
    </title>
@endsection

@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- Product tab -->
                <div class="col-md-12">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Số lượng</th>
                                <th>Giá sản phẩm</th>
                                <th>Tổng tiền</th>
                                <th>Action </th>
                            </tr>
                        </thead>
                        @if (!empty($order))
                            <tbody>
                                @php
                                    $total = 0;
                                    $total_amount = 0;
                                @endphp
                                @foreach ($order->order_detail as $value)
                                    <tr>
                                        <td>
                                            <a class="fw-bold text-dark"
                                                href="{{ route('product', ['slug' => $value->product->slug]) }}">
                                                {{ $value->product->name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $value->product->category->name }}
                                        </td>
                                        <td>
                                            {{ $value->amount }}
                                        </td>
                                        <td>
                                            {{ number_format($value->product->price, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            {{ number_format($value->product->price * $value->amount, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <form class="d-inline"
                                                action="{{ route('remove_form_cart', ['id' => $value->id]) }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa nó?')"
                                                    class="btn btn-danger">
                                                    Delete

                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @php
                                        $total += $value->product->price * $value->amount;
                                        $total_amount += $value->amount;
                                    @endphp
                                @endforeach
                            </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="text-center">Chưa có dơn nào trong giỏ hàng</div>
                                </td>
                            </tr>
                        </tbody>
                        @endif
                    </table>

                    @if (!empty($order))
                        <form action="{{ route('buy', ['id' => $order->id]) }}" method="POST">
                            @csrf
                            <div>
                                <label class="form-label" for="">Địa chỉ</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div>
                                <label class="form-label" for="">Phương thức thanh toán</label>
                                <select class="form-control" name="payment">
                                    <option value="1">Thanh toán khi nhận hàng</option>
                                    <option value="2">Chuyển khoản ngân hàng</option>
                                    <option value="3">Thanh toán VNPAY</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="">Ghi chú</label>
                                <textarea class="form-control" name="note" id="" cols="30" rows="10"></textarea>
                            </div>

                            <div class="mt-3">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <b>Tổng tiền: </b>
                                        </td>
                                        <td>
                                            <b>{{ number_format($total, 0, ',', '.') }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Tổng số sản phẩm: </b>
                                        </td>
                                        <td>
                                            <b>{{ $total_amount }}</b>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Đặt hàng
                                </button>
                            </div>
                        </form>
                    @endif

                </div>

                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection


@section('script')
    <script>
        $("#not_login").click(function() {
            alert("Bạn cần đăng nhập để tiếp tục")
        })
    </script>
@endsection
