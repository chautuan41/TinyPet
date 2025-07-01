<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="shortcut icon" type="image/png" href="../backend/assets/images/logos/favicon.png" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('user/css/bootstrap.css') }}" />

 

  <!-- font awesome style -->
  <link href="{{ asset('user/css/font-awesome.min.css') }}" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="{{ asset('user/css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('user/css/responsive.css') }}" rel="stylesheet" />
  <!-- jQery -->
  <script src="{{ asset('user/js/jquery-3.4.1.min.js') }}"></script>
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

  <div class="hero_area">
    @include('user.layouts.header')

    @yield('content')

    @include('user.layouts.footer')

  <script>
    function addCart(){
        let formData = $('#addCart').serialize();
    
        $.ajax({
          url: "{{ route('user.cart.add') }}", // Laravel route
          method: 'POST',
          data: formData,
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
              alert('Đã thêm vào giỏ hàng!');
              
          },
          error: function (xhr) {
              alert('Lỗi khi thêm vào giỏ hàng!');
              console.log(xhr.responseText);
          }
        });
    }
  </script>
  
  <!-- bootstrap js -->
  <script src="{{ asset('user/js/bootstrap.js') }}"></script>
  <!-- custom js -->
  <script src="{{ asset('user/js/custom.js') }}"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

</body>

</html>