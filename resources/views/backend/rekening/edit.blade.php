@extends('backend.default')

@push('meta')
    <meta name="description" content="Website HPV" />
    <meta name="keywords" content="Website HPV" />
    <meta name="author" content="CV" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Rekening | Rental Mobil</title>
@endpush

@section('content')
<!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Rekening/</span> Tambah Rekening</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
        <!-- Basic Layout -->
        <div class="col-6">
            <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Tambah Rekening</h5>
                <small class="text-muted float-end">Default label</small>
            </div>
            <div class="card-body">
                <form action="{{ route('upadteRekeningStore') }}" method="post" id="add-mobil" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $rekening->id_rek }}" name="id_rek" id="id_rek">
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label" for="nama_rek">Nama Pemilik</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_rek" name="nama_rek" value="{{ $rekening->nama_rek }}" placeholder="Nama Pemilik Rekening" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label" for="jenis_bank">Nama Bank</label>
                        <div class="col-sm-8">
                        <input
                            type="text"
                            class="form-control"
                            id="jenis_bank"
                            value="{{ $rekening->jenis_bank }}"
                            name="jenis_bank"
                            placeholder="Nama Bank"
                        />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label" for="no_rek">No Rekening</label>
                        <div class="col-sm-8">
                            <div class="input-group input-group-merge">
                                <input
                                type="text"
                                id="no_rek"
                                name="no_rek"
                                value="{{ $rekening->no_rek }}"
                                class="form-control"
                                placeholder="No Rekening"
                                aria-label="No Rekening"
                                aria-describedby="rekening"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('getRekeningAdmin') }}">
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
				url: "{{ route('upadteRekeningStore') }}",
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function(response) {
					Swal.fire({
						icon: 'success',
						title: 'Update data Rekening berhasil',
						timer: 1500
					})
                    .then (function () {
                      window.location.href = "{{ route('getRekeningAdmin') }}";
                    });
				},
				error: function(err) {
					alert('Update data Rekening gagal')
				}
			});
        });
    </script>
@endpush