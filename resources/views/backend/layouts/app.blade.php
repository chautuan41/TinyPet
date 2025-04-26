<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="shortcut icon" type="image/png" href="../backend/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../backend/assets/css/styles.min.css" />

  <!-- <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" /> -->

  <!--- FONT-ICONS CSS -->
  <!-- <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" /> -->

  <!-- COLOR SKIN CSS -->
  <!-- <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/colors/color1.css')}}" /> -->
  <!-- <script src="../backend/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../backend/assets/js/sidebarmenu.js"></script>
  <script src="../backend/assets/js/app.min.js"></script>
  <script src="../backend/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../backend/assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../backend/assets/js/dashboard.js"></script> -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
  <link href="{{ asset('backend/plugins/multiple-select/multiple-select.css') }}" rel="stylesheet" />
  <!-- <link href="{{ asset('backend/assets/plugins/parsley/parsley.css') }}" rel="stylesheet" /> -->
  <link href="{{ asset('backend/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" />

  <script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>

  <script src="{{asset('backend/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

  <script src="{{asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>

  <script src="{{ asset('backend/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/multiple-select/multiple-select.js') }}"></script>
  <script src="{{ asset('backend/plugins/parsley/parsley.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/sweetalerts/sweetalert2.min.js') }}"></script>

  <script src="{{asset('backend/assets/plugins/select2/select2.full.min.js')}}"></script>
  <script src="{{asset('backend/plugins/select2/js/select2.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2-bootstrap4.css')}}">

  <script src="{{asset('backend/fontawesome/js/all.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('backend/fontawesome/all.min.css')}}">

  <script src="{{asset('backend/plugins/moment/moment.js')}}"></script>

  <style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      margin-top: 20px;
    }

    .dataTables_info {
      margin-top: 10px;
    }
  </style>

  <!-- TAGIFY JS -->
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="../backend/assets/images/logos/dark-logo.svg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Trang chủ</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.index')}}" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-gauge"></i>
                </span>
                <span class="hide-menu">Thống kê</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Quản lí bảng</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.role')}}" aria-expanded="false">
                <span>
                  <i class="fa-regular fa-user"></i>
                </span>
                <span class="hide-menu">Vai trò</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.account')}}" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-user"></i>
                </span>
                <span class="hide-menu">Tài khoản</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.product')}}" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-paw"></i>
                </span>
                <span class="hide-menu">Sản phẩm</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.supplier')}}" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-truck-field"></i>
                </span>
                <span class="hide-menu">Nhà cung cấp</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="" aria-expanded="false">
                <span>
                <i class="fa-regular fa-calendar"></i>
                </span>
                <span class="hide-menu">Loại sản phẩm</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="" aria-expanded="false">
                <span>
                  <i class="fa-regular fa-rectangle-list"></i>
                </span>
                <span class="hide-menu">Danh mục</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="" aria-expanded="false">
                <span>
                <i class="fa-regular fa-chess-queen"></i>
                </span>
                <span class="hide-menu">Thương hiệu</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="" aria-expanded="false">
                <span>
                  <i class="fa-regular fa-image"></i>
                </span>
                <span class="hide-menu">Hình ảnh</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Quản lí kho</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="" aria-expanded="false">
                <span>
                <i class="fa-regular fa-file-lines"></i>
                </span>
                <span class="hide-menu">Hóa đơn bán hàng</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="" aria-expanded="false">
                <span>
                <i class="fa-regular fa-clipboard"></i>
                </span>
                <span class="hide-menu">Hóa đơn nhập hàng</span>
              </a>
            </li>
            <!-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.shipping')}}" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-truck"></i>
                </span>
                <span class="hide-menu">Vận chuyển</span>
              </a>
            </li> -->
          </ul>

        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../backend/assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="{{route('logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <!--  Main wrapper -->
      @yield('content')
    </div>
  </div>





</body>

</html>