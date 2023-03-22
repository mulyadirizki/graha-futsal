<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rental Mobil</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/pages/page-auth.css') }}" />

    <script src="{{ url('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ url('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">Log In</span>
                </a>
              </div>
              <!-- /Logo -->
              <!-- <h4 class="mb-2">Rental Mobil</h4> -->
              <p class="mb-4">Please sign-in to your account</p>

              <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
              @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email-username"
                    placeholder="Enter your email"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="auth-forgot-password-basic.html">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
              </form>

              <div class="mb-3">
                <button class="btn btn-login btn-primary d-grid w-100" type="submit">Sign in</button>
              </div>

              <p class="text-center">
                <span>Belum punya akun?</span>
                <a href="{{ route('registrasi') }}">
                  <span>Create an account</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- cdn -->
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        },
      });
      $(document).ready(function() {
        $('.btn-login').click(function() {
          var email = $('#email').val();
          var password = $('#password').val();
          var token = $("meta[name='csrf-token']").attr('content');

          if(email.length == ""){
            Swal.fire({
              icon: 'warning',
              title: 'Oops...',
              text: 'Email Wajib diisi',
            })
          }else if(password.length == ""){
            Swal.fire({
              icon: 'warning',
              title: 'Oops...',
              text: 'Password Wajib Diisi !'
            });
          }else  {
            $.ajax({
              url: "{{ route('loginStore') }}",
              type: 'POST',
              dataType: 'JSON',
              cache: false,
              data: {
                'email': email,
                'password': password,
                '_token': token
              },
              success: function(response) {
                if(response.user.roles == 1){
                  if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil!',
                        text: 'Anda akan di arahkan dalam 3 Detik',
                        timer: 3000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                    .then (function () {
                      window.location.href = "{{ route('admin') }}";
                    });
                  } else {
                      console.log(response.success);

                      Swal.fire({
                          icon: 'error',
                          title: 'Login Gagal!',
                          text: 'silahkan coba lagi!'
                      });
                  }
                } else if(response.user.roles == 2){
                  if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil!',
                        text: 'Anda akan di arahkan dalam 3 Detik',
                        timer: 3000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                    .then (function () {
                      window.location.href = "{{ route('user') }}";
                    });
                  } else {
                      console.log(response.success);

                      Swal.fire({
                          icon: 'error',
                          title: 'Login Gagal!',
                          text: 'silahkan coba lagi!'
                      });
                  }
                }
              },
              error: function(e) {
                console.log(e.responseJSON.message);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: e.responseJSON.message,
                })
              }
            });
          }
        });
      });
    </script>
  </body>
</html>
