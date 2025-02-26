<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="shortcut icon" type="image/png" href="../backend/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../backend/assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <p class="fs-4 mb-0 fw-bold">{{ config('app.name', 'Laravel') }}</p>
                </a>
                <p class="text-center">Thương hiệu Tinypet</p>
                <form method="POST">
                  @csrf
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tài khoản</label>
                    <input type="email" class="form-control" id="user_email">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="user_password">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Ghi nhớ tài khoản
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="./index.html">Quên mật khẩu?</a>
                  </div>
                  <button type="button" id='postLogin' class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Đăng nhập</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Bạn muốn đăng ký {{ config('app.name', 'Laravel') }}?</p>
                    <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Đăng ký</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../backend/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<script>
  $('#postLogin').on('click', function() {
    let formData = new FormData();
    formData.append('_token', $("input[name='_token']").val());
    formData.append('email', $('#user_email').val());
    formData.append('password', $('#user_password').val());
      $.ajax({
        url: `{{route('login.post')}}`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result) {
          if(result.success){
            window.location.href = result.url;
          }
          else{
            Swal.fire({
              title: result.mess,
              icon: "warning"
            });
          }
        }
      })
  });
</script>

</html>