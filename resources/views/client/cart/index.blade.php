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
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                                $total_amount = 0;
                            @endphp
                            @foreach ($order->order_detail as $value)
                                <tr>
                                    <td>
                                        <a class="fw-bold text-dark" href="{{ route("product", ["slug" => $value->product->slug ])}}">
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
                                </tr>
                                @php
                                    $total += $value->product->price * $value->amount;
                                    $total_amount += $value->amount;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
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
