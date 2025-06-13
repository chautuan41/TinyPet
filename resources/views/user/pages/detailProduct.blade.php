@extends('user.layouts.app')

@section('content')
<!-- about section -->

<section class="about_section layout_padding long_section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="bd-example">
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/slider-img1.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="images/slider-img2.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="images/slider-img3.png" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-box">
                    <div class="heading_container">

                        <h2>
                            {{ $data->product_name}}
                        </h2>
                    </div>
                    <p>
                        Thương hiệu: {{ $data->brand_name}}
                    </p>
                    <p  class="price-display">
                        Giá: {{ $data->price}} VNĐ
                    </p>
                    <p>
                        Trọng lượng:
                    </p>
                    <form action="" id="searchForm">
                        <div class="checkbox-group ">
                            @foreach($sizes as $size )
                            <label><input class="inputSearch" name="inputSearch" type="radio" data-id="{{ $size->id }}" data-price="{{ $size->price }}"  value="{{$size->id}}" {{ $data->size == $size->size ? 'checked' : '' }}> {{ $size->size}}</label><br>
                            @endforeach
                        </div>
                    </form>

                    
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolorem eum consequuntur ipsam repellat dolor soluta aliquid laborum, eius odit consectetur vel quasi in quidem, eveniet ab est corporis tempore.
                    </p>
                   
                    <form action="" id="addCart">
                         <p>
                            Số lượng:
                        </p>
                    <div class="quantity-selector">
                        <button type="button" onclick="decreaseQty()">−</button>
                        <input type="number" id="quantity" value="1" min="1" name="quantity">
                        <button type="button" onclick="increaseQty()">+</button>
                    </div>
                        <input type="hidden" name="id_product" value="{{$data->id}}">
                        <input class="id_productDetail" type="hidden" name="id_productDetail" value="">

                        <button type="button" class="btn2 mt-3" onclick="addCart()"> Thêm vào giỏ hàng</button>
                    </form>
                    



                </div>
            </div>
        </div>
    </div>
</section>

<!-- end about section -->
<script>
    $(document).ready(function() {
        $('.inputSearch').on('change', function() {
            btnSearch();
        });

        //Load url
        urlLoad();
    });

    function btnSearch() {
        let formData = new FormData($('#searchForm')[0]);
        let object = {};
        formData.forEach(function(value, key) {
            object[key] = value;
        });
        let selectedInput = $('input[name="inputSearch"]:checked');
        let price = selectedInput.data('price'); // <-- lấy từ data-price
        let id_product = selectedInput.data('id');

        let id = @json($data);
        // Thay đổi URL mà không load lại trang
        history.pushState({}, null, "/product/" + id.id + "?search=" + btoa(encodeURIComponent(JSON.stringify(object))));

       
       
        $('.id_productDetail').val(id_product);

        $('p.price-display').text(`Giá: ${price} VNĐ`);
    }

    function urlLoad() {
        let url = window.location.href;
        let param = new URL(url).searchParams.get("search");
        if (param) {
            let data = JSON.parse(decodeURIComponent(atob(param)));
            if (data.inputSearch) {
                let selectedInput = $('.inputSearch[value="' + data.inputSearch + '"]');
                selectedInput.prop('checked', true);
                selectedInput.trigger('change');

                // Cập nhật giá luôn
                let price = selectedInput.data('price');
                $('p.price-display').text(`Giá: ${price} VNĐ`);

                
            }
        }
    }

    function addCart(){
        let formData= $('#addCart').serialize();
        console.log(formData);
    }
</script>
@endsection