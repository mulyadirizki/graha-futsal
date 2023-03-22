@extends('backend.default')

@push('meta')
    <meta name="description" content="Website HPV" />
    <meta name="keywords" content="Website HPV" />
    <meta name="author" content="CV" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Mobil | Rental Mobil</title>
@endpush

@section('content')
<!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Mobil/</span> Tambah Mobil</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Tambah Mobil</h5>
                <small class="text-muted float-end">Default label</small>
            </div>
            <div class="card-body">
                <form action="{{ route('upadteMobilStore') }}" method="post" id="add-mobil" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $mobil->id_mobil }}" name="id_mobil" id="id_mobil">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nama_mobil">Nama Mobil</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" value="{{ $mobil->nama_mobil }}" placeholder="Nama Mobil" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="no_pol">No Polisi</label>
                        <div class="col-sm-10">
                        <input
                            type="text"
                            class="form-control"
                            id="no_pol"
                            name="no_pol"
                            value="{{ $mobil->no_pol }}"
                            placeholder="BA 1234 XX"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="warna">Warna Mobil</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input
                                type="text"
                                id="warna"
                                name="warna"
                                value="{{ $mobil->warna }}"
                                class="form-control"
                                placeholder="Warna Mobil"
                                aria-label="Warna Mobil"
                                aria-describedby="warna"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="th_mobil">Tahun Mobil</label>
                        <div class="col-sm-10">
                        <input
                            type="date"
                            id="th_mobil"
                            name="th_mobil"
                            value="{{ $mobil->th_mobil }}"
                            class="form-control phone-mask"
                            placeholder="Tahun Mobil"
                            aria-label="Tahun Mobil"
                            aria-describedby="th_mobil"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="merk_mobil">Merk Mobil</label>
                        <div class="col-sm-10">
                        <input
                            type="text"
                            id="merk_mobil"
                            name="merk_mobil"
                            value="{{ $mobil->merk_mobil }}"
                            class="form-control phone-mask"
                            placeholder="Merk Mobil"
                            aria-label="Merk Mobil"
                            aria-describedby="merk_mobil"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="img_mobil">Foto Mobil</label>
                        <div class="col-sm-10">
                        <input
                            type="file"
                            id="img_mobil"
                            name="image"
                            value="{{ $mobil->img_mobil }}"
                            class="form-control phone-mask"
                            placeholder="Foto Mobil"
                            aria-label="Foto Mobil"
                            aria-describedby="img_mobil"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="harga_sewa">Harga Sewa</label>
                        <div class="col-sm-10">
                        <input
                            type="text"
                            id="harga_sewa"
                            name="harga_sewa"
                            value="{{ $mobil->harga_sewa }}"
                            class="form-control phone-mask"
                            placeholder="Harga Sewa Perhari"
                            aria-label="Harga Sewa Perhari"
                            aria-describedby="harga_sewa"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="denda_sewa">Denda Sewa</label>
                        <div class="col-sm-10">
                        <input
                            type="text"
                            id="denda_sewa"
                            name="denda_sewa"
                            value="{{ $mobil->denda_sewa }}"
                            class="form-control phone-mask"
                            placeholder="Denda Sewa Perhari"
                            aria-label="Denda Sewa Perhari"
                            aria-describedby="denda_sewa"
                        />
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('getMobilAdmin') }}">
                                <button type="submit" class="btn btn-danger">Kembali</button>
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
        $('#add-mobil').submit(function (e) {
			e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
				url: "{{ route('upadteMobilStore') }}",
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function(response) {
					Swal.fire({
						icon: 'success',
						title: 'Data mobil berhasil diupdate',
						timer: 1500
					})
                    .then (function () {
                      window.location.href = "{{ route('getMobilAdmin') }}";
                    });
				},
				error: function(err) {
					alert('Data mobil gagal diupdate')
				}
			});
        });
    </script>
@endpush