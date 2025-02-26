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
              <a class="sidebar-link" href="./index.html" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Thống kê</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Trang quản lí</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Phân quyền</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
                <span>
                  <i class="ti ti-id-badge"></i>
                </span>
                <span class="hide-menu">Tài khoản nhân viên</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                <span>
                  <i class="ti ti-id-badge"></i>
                </span>
                <span class="hide-menu">Tài khoản khách hàng</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Forms</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                <span>
                  <i class="ti ti-typography"></i>
                </span>
                <span class="hide-menu">Typography</span>
              </a>
            </li>
          </ul>
          
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    @yield('content')
  </div>
  
  



</body>

</html>
