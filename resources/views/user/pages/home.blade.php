@extends('user.layouts.app')

@section('content')
<!-- slider section -->
    <section class="slider_section long_section">
      <div id="customCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-5">
                  <div class="detail-box">
                    <h1>
                      For All Your <br>
                      Furniture Needs
                    </h1>
                    <p>
                      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus quidem maiores perspiciatis, illo maxime voluptatem a itaque suscipit.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Contact Us
                      </a>
                      <a href="" class="btn2">
                        About Us
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="img-box">
                    <img src="{{ asset('user/images/slider-img.png') }}" alt="" style="width: 900px;height: 470px;">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-5">
                  <div class="detail-box">
                    <h1>
                      For All Your <br>
                      Furniture Needs
                    </h1>
                    <p>
                      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus quidem maiores perspiciatis, illo maxime voluptatem a itaque suscipit.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Contact Us
                      </a>
                      <a href="" class="btn2">
                        About Us
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="img-box">
                    <img src=" {{ asset('user/images/slider-img1.png') }}" alt="" style="width: 900px;height: 470px;">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-5">
                  <div class="detail-box">
                    <h1>
                      For All Your <br>
                      Furniture Needs
                    </h1>
                    <p>
                      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus quidem maiores perspiciatis, illo maxime voluptatem a itaque suscipit.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Contact Us
                      </a>
                      <a href="" class="btn2">
                        About Us
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="img-box">
                    <img src=" {{ asset('user/images/slider-img2.png') }}" alt="" style="width: 900px;height: 470px;">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <ol class="carousel-indicators">
          <li data-target="#customCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel" data-slide-to="1"></li>
          <li data-target="#customCarousel" data-slide-to="2"></li>
        </ol>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- furniture section -->

  <section class="furniture_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          our products
        </h2>
        <p>
          which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't an
        </p>
      </div>
      <div class="row">
        @foreach($dtProduct as $product)
        <div class="col-md-6 col-lg-4">
          <div class="box">
            <div class="img-box">
              <a href="{{ route('user.detailProduct', ['id' => $product->id]) }}"><img src="{{ asset($product->image) }}" alt=""></a>
            </div>
            <div class="detail-box">
              <h5>
                <a href="{{ route('user.detailProduct', ['id' => $product->id]) }}" style="text-decoration: none; color: inherit;"> 
               {{ strlen($product->product_name) > 50 ? substr($product->product_name, 0, 50) . '...' : $product->product_name }}
               </a>
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

  <!-- end furniture section -->

  <!-- furniture section -->

  <section class="furniture_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2 class="mb-0">new products</h2>
        <p>
          which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't an
        </p>
      </div>
      <div class="row">
        @foreach($dtNewProduct as $product)
        <div class="col-md-6 col-lg-4">
          <div class="box">
            <div class="img-box">
              <a href="{{ route('user.detailProduct', ['id' => $product->id]) }}"><img src="{{ asset($product->image) }}" alt=""></a>
            </div>
            <div class="detail-box">
              <h5>
                <a href="{{ route('user.detailProduct', ['id' => $product->id]) }}" style="text-decoration: none; color: inherit;"> 
               {{ strlen($product->product_name) > 50 ? substr($product->product_name, 0, 50) . '...' : $product->product_name }}
               </a>
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

  <!-- end furniture section -->

  <!-- about section -->

  <section class="about_section layout_padding long_section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <img src="images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About Us
              </h2>
            </div>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolorem eum consequuntur ipsam repellat dolor soluta aliquid laborum, eius odit consectetur vel quasi in quidem, eveniet ab est corporis tempore.
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- blog section -->

  <section class="blog_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Latest Blog
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-4 mx-auto">
          <div class="box">
            <div class="img-box">
              <img src="images/b1.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Look even slightly believable. If you are
              </h5>
              <p>
                alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
              </p>
              <a href="">
                Read More
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mx-auto">
          <div class="box">
            <div class="img-box">
              <img src="images/b2.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Anything embarrassing hidden in the middle
              </h5>
              <p>
                alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
              </p>
              <a href="">
                Read More
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mx-auto">
          <div class="box">
            <div class="img-box">
              <img src="images/b3.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Molestias magni natus dolores odio commodi. Quaerat!
              </h5>
              <p>
                alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
              </p>
              <a href="">
                Read More
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- <script>
  $(document).ready(function () {
    $.ajax({
      url: "{{ route('index.data') }}",
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        const routeTemplate = "{{ route('user.detailProduct', ['id' => '__ID__']) }}";
        let html = '';
        let html1 = '';
        data.data.forEach(product => {
          const url = routeTemplate.replace('__ID__', product.id);
          html += `
            <div class="col-md-6 col-lg-4">
              <div class="box">
                <div class="img-box">
                  <a href="${url}">
                    <img src="/${product.image}" alt="">
                  </a>
                </div>
                <div class="detail-box">
                  <h5>
                    <a href="${url}" style="text-decoration: none; color: inherit;">
                      ${product.product_name.length > 50 ? product.product_name.substring(0, 50) + '...' : product.product_name}
                    </a>
                  </h5>
                  <div class="price_box">
                    <h6 class="price_heading">
                      ${Number(product.product_details_min_price).toLocaleString('vi-VN')} <span>VNĐ</span>
                    </h6>
                    <a href="#">Buy Now</a>
                  </div>
                </div>
              </div>
            </div>
          `;
        });

        data.dataNew.forEach(product => {
          const url = routeTemplate.replace('__ID__', product.id);
          html1 += `
            <div class="col-md-6 col-lg-4">
              <div class="box">
                <div class="img-box">
                  <a href="${url}">
                    <img src="/${product.image}" alt="">
                  </a>
                </div>
                <div class="detail-box">
                  <h5>
                    <a href="${url}" style="text-decoration: none; color: inherit;">
                      ${product.product_name.length > 50 ? product.product_name.substring(0, 50) + '...' : product.product_name}
                    </a>
                  </h5>
                  <div class="price_box">
                    <h6 class="price_heading">
                      ${Number(product.product_details_min_price).toLocaleString('vi-VN')} <span>VNĐ</span>
                    </h6>
                    <a href="#">Buy Now</a>
                  </div>
                </div>
              </div>
            </div>
          `;
        });
        console.log(html1)
        $('#productNew-list').html(html1);
        $('#product-list').html(html);
      },
      error: function (xhr, status, error) {
        console.error('Lỗi gọi sản phẩm:', error);
      }
    });
  });
</script> -->
  <!-- end blog section -->
@endsection