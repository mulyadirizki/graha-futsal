@extends('backend.default')

@push('meta')
    <meta name="description" content="Website HPV" />
    <meta name="keywords" content="Website HPV" />
    <meta name="author" content="CV" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Rental | Rental Mobil</title>
@endpush

@section('content')
<!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Rental/</span> Add Rental</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Add Rental</h5>
                <small class="text-muted float-end">Default label</small>
            </div>
            <div class="card-body">
                <form action="{{ route('addMobilRentaldminStore') }}" method="post" id="add-rental" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="id_tuser">Nama Pelanggan</label>
                        <div class="col-sm-10">
                            <select name="id_tuser" id="id_tuser" class="form-control">
                                <option selected disabled>Pilih Pelanggan</option>
                                @foreach($user as $s)
                                    <option value="{{ $s->iduser }}" >{{ $s->nama }} - (Hp: {{ $s->no_hp }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="id_mobil">Mobil</label>
                        <div class="col-sm-10">
                            <select name="id_mobil" id="id_mobil" class="form-control">
                                <option selected disabled>Pilih Mobil</option>
                                @foreach($mobil as $m)
                                    <option value="{{ $m->id_mobil }}" >{{ $m->merk_mobil }} {{ $m->nama_mobil }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="tgl_rental">Tgl Rental</label>
                        <div class="col-sm-10">
                        <input
                            type="date"
                            id="tgl_rental"
                            name="tgl_rental"
                            class="form-control phone-mask"
                            placeholder="Tgl Rental"
                            aria-label="Tgl Rental"
                            aria-describedby="tgl_rental"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="tgl_kembali">Tgl Kembali</label>
                        <div class="col-sm-10">
                        <input
                            type="date"
                            id="tgl_kembali"
                            name="tgl_kembali"
                            class="form-control phone-mask"
                            placeholder="Tgl Kembali"
                            aria-label="Tgl Kembali"
                            aria-describedby="tgl_kembali"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="cara_bayar">Cara Bayar</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <select name="cara_bayar" id="cara_bayar" class="form-control">
                                    <option selected disabled>Cara Bayar</option>
                                    <option value="1">Transfer</option>
                                    <option value="2">Tunai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('getMobilRentaldmin') }}">
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

        $('#add-rental').submit(function (e) {
			e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
				url: "{{ route('addMobilRentaldminStore') }}",
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function(response) {
					Swal.fire({
						icon: 'success',
						title: 'Tambah data rental berhasil',
						timer: 1500
					})
                    .then (function () {
                      window.location.href = "{{ route('getMobilRentaldmin') }}";
                    });
				},
				error: function(err) {
					alert('Tambah data rental gagal')
				}
			});
        });
    </script>
@endpush