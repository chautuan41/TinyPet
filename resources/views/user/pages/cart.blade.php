@extends('user.layouts.app')

@section('content')
<!-- about section -->
<section class="about_section layout_padding long_section">
    <div class="container">
        <h2 class="text-center">Cart</h2>
        @if(session('success'))
        <div>{{ session('success') }}</div>
        @endif
        <form action="">
            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sản Phẩm</th>
                            <th scope="col">Trọng Lượng</th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Thành Tiền</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(auth()->check())
                        @php
                        $stt = 1;
                        $total = 0;
                        @endphp
                        @foreach($data as $cart)
                        <tr>
                            <td>{{$stt}}</td>
                            <td>{{ strlen($cart->product->product_name) > 28 ? substr($cart->product->product_name, 0, 28) . '...' : $cart->product->product_name }}</td>
                            <td>{{ $cart->productDetail->size }}</td>
                            <td>
                                <input class="inputQuantity" data-id_pd="{{ $cart->productDetail->id }}"  data-id_product="{{ $cart->product->id }}" data-price="{{ $cart->productDetail->price }}" data-id="{{ $cart->id }}" type="number" name="quantity" value="{{ $cart->quantity }}" min="1">
                            </td>
                            <td>{{ number_format($cart->productDetail->price, 0, ',', '.') }}</td>
                            <td class="total">{{ number_format($cart->productDetail->price * $cart->quantity, 0, ',', '.')}}</td>
                            <td><button id="btnRemove" class="btn btn-danger btn-sm" onclick="remove({{ $cart->id }})"><i class="fa fa-trash"></i></button></td>
                        </tr>
                        @php $stt =$stt + 1 ;
                        $total = $total + ($cart->productDetail->price * $cart->quantity) ;
                        @endphp
                        @endforeach
                        @if(count($data) > 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Tổng tiền:</strong></td>
                            <td ><strong id="sumTotal">{{number_format($total, 0, ',', '.')}}</strong></td>
                        </tr>
                        @else
                        <tr>
                            <td>Chưa có sản phẩm trong giỏ hàng</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td ></td>
                        </tr>
                        @endif
                        @else
                        @php
                        $stt = 1;
                        $total = 0;
                        @endphp
                        @foreach($data as $id => $details )
                        <tr>
                            <td>{{$stt}}</td>
                            <td>{{ strlen($details['name']) > 28 ? substr($details['name'], 0, 28) . '...' : $details['name'] }}</td>
                            <td>{{ $details['size'] }}</td>
                            <td>
                                <input class="inputQuantity" data-price="{{ $details['price'] }}" data-id="{{ $id }}" type="number" name="quantity" value="{{ $details['quantity'] }}" min="1">
                            </td>
                            <td>{{ number_format($details['price'], 0, ',', '.') }}</td>
                            <td class="total">{{ number_format($details['quantity'] * $details['price'], 0, ',', '.') }}</td>
                            <td><button id="btnRemove" class="btn btn-danger btn-sm" onclick="remove({{ $id }})"><i class="fa fa-trash"></i></button></td>
                        </tr>
                        @php $stt =$stt + 1 ;
                        $total = $total + ($details['price'] * $details['quantity']);
                        @endphp
                        @endforeach
                        @if($data)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Tổng tiền:</strong></td>
                            <td ><strong id="sumTotal">{{number_format($total, 0, ',', '.')}}</strong></td>
                        </tr>
                        @else
                        <tr>
                            <td>Chưa có sản phẩm trong giỏ hàng</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td ></td>
                        </tr>
                        @endif
                        @endif
                    </tbody>
                </table>
                @if(count($data) > 0)
                <a href="{{ route('cart.clear') }}">Xóa toàn bộ</a>
                <div class="d-flex gap-2 justify-content-end py-3">
                    <a href="{{ route('user.checkout') }}" class="btn btn-primary rounded-pill px-3" type="submit">Thanh Toán</a>
                </div>
                @endif
            </div>
        </form>
    </div>
</section>
<script>
    function updateCart(input) {
        let id = input.data('id');
        let quantity = parseInt(input.val());
        let price = parseInt(input.data('price'));
        
        let formData = {
            id: input.data('id'),
            quantity: parseInt(input.val()),
            id_product:input.data('id_product'),
            id_productDetail:input.data('id_pd'),
        };

    $.ajax({
        url: "{{ route('cart.update') }}",
        method: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            let total = quantity * price;
            input.closest('tr').find('.total').text(total.toLocaleString('vi-VN'));

            let sum = 0;
            $('.inputQuantity').each(function () {
                let qty = parseInt($(this).val());
                let prc = parseInt($(this).data('price'));
                sum += qty * prc;
            });

            $('strong#sumTotal').text(sum.toLocaleString('vi-VN'));
        },
        error: function(xhr) {
            alert('Lỗi khi cập nhật vào giỏ hàng!');
            console.log(xhr.responseText);
        }
    });
}

let enterPressed = false; // Biến cờ để tránh xử lý trùng

$('.inputQuantity').on('keydown', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        enterPressed = true; // Đánh dấu là enter vừa được nhấn
        updateCart($(this));
    }
});

$('.inputQuantity').on('change', function () {
    // Nếu vừa nhấn Enter, thì bỏ qua change này
    if (enterPressed) {
        enterPressed = false; // Reset lại flag
        return;
    }

    updateCart($(this));
});

function remove(id){
    $.ajax({
        url: "{{ route('cart.remove') }}",
        method: 'POST',
        data: {id : id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            location.reload(); // ✅ Reload lại trang để cập nhật giao diện
        },
        error: function(xhr) {
            alert('Lỗi khi cập nhật vào giỏ hàng!');
            console.log(xhr.responseText);
        }
    })
}

    
</script>
<!-- end about section -->
@endsection