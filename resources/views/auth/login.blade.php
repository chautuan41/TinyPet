<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('backend/assets/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('backend/assets/css/styles.min.css')}}" />
 
  
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
                <form method="POST" id="loginForm">
                  @csrf
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tài khoản</label>
                    <input type="email" class="form-control" id="user_email" name="email" >
                    
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="user_password" name="password" >
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
                  <button type="button" id='postLogin' class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" onclick="login(`{{route('login.post')}}`)">Đăng nhập</button>
                  
                </form>
                <button type="button" id="googleLoginBtn" class="btn  w-100 py-8 fs-4 mb-4 rounded-2" >Đăng nhập bằng Google</button>
                
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Bạn muốn đăng ký {{ config('app.name', 'Laravel') }}?</p>
                    <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Đăng ký</a>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('backend/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<script>
  
  function login(url){
    let formData = $('#loginForm').serialize();
      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        success: function(result) {
          if(result.success){
            window.location.replace(result.url);
          }
          else{
            Swal.fire({
              title: result.mess,
              icon: "warning"
            });
          }
        },
      })
  }

</script>

 <script type="module">
    // ✅ Import Firebase modules
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-app.js";
    import { getAuth, signInWithPopup, signOut, GoogleAuthProvider, FacebookAuthProvider  } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-auth.js";

    // ✅ Firebase config - thay bằng config của bạn
    const firebaseConfig = {
        apiKey: "AIzaSyCFO41spuKSoaEr9Q8pzvGr1UFN4h6x82M",
        authDomain: "tinypet-7c266.firebaseapp.com",
        projectId: "tinypet-7c266",
        storageBucket: "tinypet-7c266.firebasestorage.app",
        messagingSenderId: "947181491207",
        appId: "1:947181491207:web:6c11ebf859e0091ef586a2",
        measurementId: "G-WFZEZ31NP0"
    };

    // ✅ Init app & auth
    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);
    const provider = new GoogleAuthProvider();
    

    const loginBtn = document.getElementById("googleLoginBtn");
    

    loginBtn.addEventListener("click", async () => {
      
      try {
        const result = await signInWithPopup(auth, provider);
        const user = result.user;
        const idToken = await user.getIdToken();

        console.log("ID token:", idToken);

        // ✅ Gửi token lên Laravel API
        const res = await fetch("/api/login-firebase", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ id_token: idToken })
        });

        const data = await res.json();
        
        window.location.replace(data.url);
        
      } catch (error) {
        console.error("Lỗi đăng nhập:", error);
        alert("Đăng nhập thất bại.");
      }
    });

    
  </script>


</html>