
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
                $tong_so_luong=0;
            @endphp
            @foreach ($data as $value)
            @php
                $tong += $value->product->price * $value->amount;
                $tong_so_luong +=$value->amount;
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
        <h5><b>Tổng tiền đơn: </b>{{number_format($tong, 0, ',', '.')}}</h5>

        <h5>Tổng số lượng :{{$tong_so_luong}}</h5>
    </div>


</div>
