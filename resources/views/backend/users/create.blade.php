@extends('backend.default')

@push('meta')
    <meta name="description" content="Website HPV" />
    <meta name="keywords" content="Website HPV" />
    <meta name="author" content="CV" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data User | Rental Mobil</title>
@endpush

@section('content')
<!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User/</span> Tambah User</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Tambah User</h5>
                <small class="text-muted float-end">Default label</small>
            </div>
            <div class="card-body">
                <form action="{{ route('addUserAdminStore') }}" method="post" id="add-user" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nik">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" maxlength="16" onkeypress="return hanyaAngka(event)" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                        <div class="col-sm-10">
                        <input
                            type="text"
                            class="form-control"
                            id="nama"
                            name="nama"
                            placeholder="Nama Lengkap"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="tgl_lahir">Tgl Lahir</label>
                        <div class="col-sm-10">
                        <input
                            type="date"
                            id="tgl_lahir"
                            name="tgl_lahir"
                            class="form-control phone-mask"
                            placeholder="Tgl Lahir"
                            aria-label="Tgl Lahir"
                            aria-describedby="tgl_lahir"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="j_kel">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <select name="j_kel" id="j_kel" class="form-control">
                                    <option selected disabled>Jenis Kelamin</option>
                                    <option value="1">Laki - Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="no_hp">No HP</label>
                        <div class="col-sm-10">
                        <input
                            type="text"
                            id="no_hp"
                            name="no_hp"
                            class="form-control phone-mask"
                            placeholder="No HP"
                            aria-label="No HP"
                            aria-describedby="no_hp"
                            maxlength="13" onkeypress="return hanyaAngka(event)"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="pekerjaan">Pekerjaan</label>
                        <div class="col-sm-10">
                        <input
                            type="text"
                            id="pekerjaan"
                            name="pekerjaan"
                            class="form-control phone-mask"
                            placeholder="Pekerjaan"
                            aria-label="Pekerjaan"
                            aria-describedby="pekerjaan"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                        <div class="col-sm-10">
                        <input
                            type="text"
                            id="alamat"
                            name="alamat"
                            class="form-control phone-mask"
                            placeholder="Alamat"
                            aria-label="Alamat"
                            aria-describedby="alamat"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="email">Email</label>
                        <div class="col-sm-10">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control phone-mask"
                            placeholder="Email"
                            aria-label="Email"
                            aria-describedby="email"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="password">Password</label>
                        <div class="col-sm-10">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control phone-mask"
                            placeholder="Password"
                            aria-label="Password"
                            aria-describedby="password"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="roles">Roles</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <select name="roles" id="roles" class="form-control">
                                    <option selected disabled>Roles</option>
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('getUserdmin') }}">
                                <button type="button" class="btn btn-danger">Kembali</button>
                            </a>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
@push('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwtG5YjuP24l37yssdNn1s7Bj3x_SFD7c&callback=initMap&libraries=places&v=weekly" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
            return true;
        }

        $('#add-user').submit(function (e) {
			e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
				url: "{{ route('addUserAdminStore') }}",
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function(response) {
					Swal.fire({
						icon: 'success',
						title: 'Tambah data User berhasil',
						timer: 1500
					})
                    .then (function () {
                      window.location.href = "{{ route('getUserdmin') }}";
                    });
				},
				error: function(err) {
					alert('Tambah data user gagal')
				}
			});
        });
    </script>
@endpush