<!-- header section strats -->
<header class="header_section long_section px-0">
  <nav class="navbar navbar-expand-lg custom_nav-container ">
    <a class="navbar-brand" href="index.html">
      <span>
        TinyPet
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class=""> </span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
        <ul class="navbar-nav  ">
          <li class="nav-item active">
            <a class="nav-link" href="{{route('user.index')}}">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('user.product')}}">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="furniture.html">Chó</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="blog.html">Mèo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Phụ kiện</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Hàng mới</a>
          </li>
        </ul>
      </div>
      <div class="quote_btn-container">
        <a href="{{route('user.cart')}}">
          
          <span>
            Cart
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          </span>
          
        </a>
        <a href="{{route('user.search')}}">
          <i class="fa fa-search" aria-hidden="true"></i>
        </a>
        <div class="dropdown">
          @auth
          <a class="btn btn-light dropdown-toggle" href="#" role="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <div class="dropdown-menu" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="">Trang cá nhân</a>
            <a class="dropdown-item" href="">Đơn hàng</a>
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" class="px-3">
              @csrf
              <button type="submit" class="btn btn-link dropdown-item">Đăng xuất</button>
            </form>
          </div>
          @else
          <a class="btn2" href="{{ route('login') }}">Đăng nhập</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>
</header>
<!-- end header section -->