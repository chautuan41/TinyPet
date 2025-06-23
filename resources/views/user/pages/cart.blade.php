@extends('user.layouts.app')

@section('content')
<!-- about section -->
  <section class="about_section layout_padding long_section">
    <div class="container">
        <h2 class="text-center">Cart</h2>
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
                        </tr> 
                    </thead> 
                    <tbody> 
                        @foreach($data as $cart)
                        <tr> 
                            <td>{{$cart->id}}</td> 
                            <td>{{ $cart->product->product_name }}</td> 
                            <td>{{ $cart->productDetail->size }}</td> 
                            <td>{{ $cart->quantity  }}</td> 
                            <td>{{ number_format($cart->productDetail->price, 0, ',', '.') }}</td> 
                            <td>{{ number_format($cart->productDetail->price * $cart->quantity, 0, ',', '.')   }}</td> 
                        </tr>
                        @endforeach
                    </tbody> 
                </table>
                <div class="d-flex gap-2 justify-content-end py-3">
                    <button class="btn btn-primary rounded-pill px-3" type="submit">Checkout</button>
                </div>
                
            </div>
         </form>
    </div>
  </section>

  <!-- end about section -->
@endsection