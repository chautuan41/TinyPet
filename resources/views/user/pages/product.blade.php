@extends('user.layouts.app')

@section('content')
<!-- furniture section -->

  <section class="furniture_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          @if($keyword)
            Search by result "{{$keyword}}"
          @else
            Our Furniture
          @endif
        </h2>
        <p>
          which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't an
        </p>
      </div>
      <div class="row">
        @foreach($data as $product)
        <div class="col-md-6 col-lg-4">
          <div class="box">
            <div class="img-box">
              <a href="#"><img src="images/f1.png" alt=""></a>
            </div>
            <div class="detail-box">
              <h5>
                <a href="{{ route('user.detailProduct', ['id' => $product->id]) }}" style="text-decoration: none; color: inherit;"> 
                  {{ strlen($product->product_name) > 50 ? substr($product->product_name, 0, 50) . '...' : $product->product_name }}</a>
              </h5>
              <div class="price_box">
                <h6 class="price_heading">
                   {{ number_format($product->product_details_min_price, 0, ',', '.') }} <span>VNĐ</span>
                </h6>
                <a href="">
                  Buy Now
                </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        
      </div>
    </div>
  </section>
  @endsection