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
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register | Rental Mobil</title>

    <link rel="icon" type="image/x-icon" href="{{ url('assets/img/favicon/favicon.ico') }}" />

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
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-text demo text-body fw-bolder">Rental Mobil</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Registrasi</h4>
              <p class="mb-4">Silahkan isi data dengan benar</p>

              <form id="formAuthentication" class="mb-3" action="{{ route('registrasi') }}" method="POST">
                <div class="mb-3">
                  <label for="nik" class="form-label">NIK</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nik"
                    name="nik"
                    placeholder="NIK"
                    maxlength="16"
                    autofocus
                  />
                </div>
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama Lengkap</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nama"
                    name="nama"
                    placeholder="Nama Lengkap"
                    autofocus
                  />
                </div>
                <div class="mb-3">
                  <label for="tgl_lahir" class="form-label">Tgl Lahir</label>
                  <input
                    type="date"
                    class="form-control"
                    id="tgl_lahir"
                    name="tgl_lahir"
                    placeholder="Tgl Lahir"
                    autofocus
                  />
                </div>
                <div class="mb-3">
                  <label for="j_kel" class="form-label">Jenis Kelamin</label>
                  <select name="j_kel" id="j_kel" class="form-control">
                    <option selected disabled>Jenis Kelamin</option>
                    <option value="1">Laki - Laki</option>
                    <option value="2">Perempuan</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="no_hp" class="form-label">No HP</label>
                  <input
                    type="text"
                    class="form-control"
                    id="no_hp"
                    name="no_hp"
                    placeholder="No HP"
                    maxlength="13"
                    autofocus
                  />
                </div>
                <div class="mb-3">
                  <label for="pekerjaan" class="form-label">Pekerjaan</label>
                  <input
                    type="text"
                    class="form-control"
                    id="pekerjaan"
                    name="pekerjaan"
                    placeholder="Pekerjaan"
                    autofocus
                  />
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input
                    type="text"
                    class="form-control"
                    id="alamat"
                    name="alamat"
                    placeholder="Alamat"
                    autofocus
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
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
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                    <label class="form-check-label" for="terms-conditions">
                        Saya setuju dengan
                        <a href="javascript:void(0);">kebijakan privasi & persyaratan</a>
                    </label>
                  </div>
                </div>
              </form>
              <button class="btn btn-register btn-primary d-grid w-100">Sign up</button>

              <p class="text-center">
                <span>Sudah punya akun?</span>
                <a href="{{ route('login') }}">
                  <span>Sign In</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
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
            $('.btn-register').click(function() {
                var nik = $('#nik').val();
                var nama = $('#nama').val();
                var tgl_lahir = $('#tgl_lahir').val();
                var j_kel = $('#j_kel').val();
                var no_hp = $('#no_hp').val();
                var pekerjaan = $('#pekerjaan').val();
                var alamat = $('#alamat').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var token = $("meta[name='csrf-token']").attr('content');

                $.ajax({
                    url: "{{ '/api/register' }}",
                    type: 'POST',
                    dataType: 'JSON',
                    cache: false,
                    data: {
                        'nik': nik,
                        'nama': nama,
                        'tgl_lahir': tgl_lahir,
                        'j_kel': j_kel,
                        'no_hp': no_hp,
                        'pekerjaan': pekerjaan,
                        'alamat': alamat,
                        'email': email,
                        'password': password,
                        '_token': token
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registrasi Berhasil!',
                                text: 'Registrasi anda berhasil',
                                timer: 3000,
                                showCancelButton: false,
                                showConfirmButton: false
                            })

                            .then (function () {
                                window.location.href = "{{ route('login') }}";
                            });
                        }
                    },
                    error: function(e) {
                        console.log(e);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: e.responseJSON.message,
                        })
                    }
                });
            });
        });
    </script>
  </body>
</html>
