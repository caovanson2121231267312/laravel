<div class="p-3">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Danh mục</th>
                <th>Số lượng</th>
                <th>Tiền</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tong = 0;
                $tong_so_luong = 0;
            @endphp
            @foreach ($data as $value)
                @php
                    $tong += $value->product->price * $value->amount;
                    $tong_so_luong += $value->amount;
                @endphp
                <tr>
                    <td>{{ $value->product->name }}</td>
                    <td>{{ $value->product->category->name }}</td>
                    <td>{{ $value->amount }}</td>
                    <td>{{ number_format($value->product->price, 0, ',', '.') }}</td>
                    <td>{{ number_format($value->product->price * $value->amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="d-flex justify-content-between">
        <h5><b>Tổng tiền đơn: </b>{{ number_format($tong, 0, ',', '.') }}</h5>

        <h5>Tổng số lượng :{{ $tong_so_luong }}</h5>
    </div>
    <div>
        <table class="table">
            <tbody>
                <tr>
                    <td>Địa chỉ</td>
                    <td>{{empty($order->address) ? "Chưa cập nhật địa chỉ"  : $order->address }}</td>
                </tr>
                <tr>
                    <td>Thanh toán</td>
                    <td>{{$order->payment}}</td>
                </tr>
                <tr>
                    <td>Note</td>
                    <td>{{$order->note}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <form action="{{ route('order.confirm') }}" id="confirm_order" method="POST">
        @csrf
        <input type="text" hidden name="order_id" id="order_id" value="{{ $order->id }}">
        <button class="btn btn-primary" id="btn-confirm" type="submit">Xác nhận đơn hàng</button>
    </form>


</div>
