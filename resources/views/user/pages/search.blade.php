@extends('user.layouts.app')

@section('content')
<!-- blog section -->
  <section class="blog_section layout_padding">     
    <div class="container">
      <div class="heading_container">
        <h2 class="mt-3">
          SEARCH
        </h2>
      </div>
      <div class="row">
            <div class="col-md-8 col-lg-4 mx-auto"></div>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                        </svg>
                    </span>
                    
                      <input type="text" id="searchInput" class="form-control" placeholder="Search..." aria-label="Input group example" aria-describedby="basic-addon1">
                        <ul class="dropdown-menu w-100" id="searchDropdown"></ul>
                   
                    <form action="" id="searchForm">

                    </form>
                </div>
            </div>
        </div>
            <h2 class="text-center mt-3">
          Latest Blog
        </h2>
        <div class="row">
             
        <div class="col-md-6 col-lg-3 mx-auto">
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
        <div class="col-md-6 col-lg-3 mx-auto">
          <div class="box">
            <div class="img-box">
              <img src="images/b1.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Look even slightly believable. If you are If you are If you are 
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
        <div class="col-md-6 col-lg-3 mx-auto">
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
  <!-- end blog section -->
  <!-- SEARCH-->
<script>
     $('#searchInput').on('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Ngăn form submit
            const keyword = this.value.trim();
            if (keyword) {
                window.location.href = `/search-result?keyword=${encodeURIComponent(keyword)}`;
            }
        }
    });

    $('#searchInput').on('input', function () {
        let query = $(this).val();
        if (query.length > 1) {
            $.ajax({
                url: "{{ route('user.search.get') }}",
                type: "GET",
                data: { query: query },
                success: function (data) {
                    let dropdown = $('#searchDropdown');
                    dropdown.empty();

                    if (data.length > 0) {
                        const maxResults = 5;

                        data.slice(0, maxResults).forEach(item => {
                            const baseUrl = "{{ route('user.detailProduct', ['id' => '__ID__']) }}";
                            const url = baseUrl.replace('__ID__', item.id);

                            dropdown.append(`<li><a class="dropdown-item" href="${url}">${item.product_name}</a></li>`);
                        });
                        // Nếu có nhiều hơn 5 sản phẩm thì hiển thị nút "Xem thêm"
                        if (data.length > maxResults) {
                            dropdown.append(`
                                <li>
                                    <a class="dropdown-item text-center text-primary fw-bold" href="/search-result?keyword=${encodeURIComponent(query)}">
                                        Xem thêm...
                                    </a>
                                </li>
                            `);
                        }
                        dropdown.show();
                    } else {
                        dropdown.hide();
                    }
                }
            });
        } else {
            $('#searchDropdown').hide();
        }
    });

    // Khi click item
    $('#searchDropdown').on('click', 'a', function () {
        
        $('#searchDropdown').hide();
    });

     

</script>
@endsection