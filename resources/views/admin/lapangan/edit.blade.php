@extends('admin.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Update Data Lapangan | Graha Futsal</title>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Update Data Lapangan</h2>
              <div class="row">
                <div class="col-md-6">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Data Lapangan</strong>
                    </div>
                    <div class="card-body">
                      <form method="POST" action="{{ route('lapanganUpdate') }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                          <div class="col-md-12 mb-3">
                            <input type="hidden" id="id_lapangan" name="id_lapangan" value="{{ $update->id_lapangan }}">
                            <label for="kode_lapangan">Kode Lapangan</label>
                            <input type="text" class="form-control" id="kode_lapangan" name="kode_lapangan" value="{{ $update->kode_lapangan }}" aria-describedby="kodeLapangan" required>
                            <div class="invalid-feedback"> Kode Lapangan tidak boleh kosong </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <label for="dsc_lapangan">Nama Lapangan</label>
                            <input type="text" class="form-control" id="dsc_lapangan" name="dsc_lapangan" value="{{ $update->dsc_lapangan }} " aria-describedby="namaLapangan" required>
                            <div class="invalid-feedback"> Nama Lapangan tidak boleh kosong </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <label for="tipe_lapangan">Tipe Lapangan</label>
                            <input type="text" class="form-control" id="tipe_lapangan" name="tipe_lapangan" value="{{ $update->tipe_lapangan }} " aria-describedby="tipeLapangan" required>
                            <div class="invalid-feedback"> Tipe Lapangan tidak boleh kosong </div>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="jam_buka">Jam Buka</label>
                            <select class="form-control" id="jam_buka" name="jam_buka" required>
                                <option selected value="{{ $update->jam_buka }}">{{ $update->jam_buka }}</option>
                                <option value="00:00:00">00:00 WIB</option>
                                <option value="01:00:00">01:00 WIB</option>
                                <option value="02:00:00">02:00 WIB</option>
                                <option value="03:00:00">03:00 WIB</option>
                                <option value="04:00:00">04:00 WIB</option>
                                <option value="05:00:00">05:00 WIB</option>
                                <option value="06:00:00">06:00 WIB</option>
                                <option value="07:00:00">07:00 WIB</option>
                                <option value="08:00:00">08:00 WIB</option>
                                <option value="09:00:00">09:00 WIB</option>
                                <option value="10:00:00">10:00 WIB</option>
                                <option value="11:00:00">11:00 WIB</option>
                                <option value="12:00:00">12:00 WIB</option>
                            </select>
                            <div class="valid-feedback"> Jam Buka wajib diisi </div>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="jam_buka">Jam Tutup</label>
                            <select class="form-control" id="jam_tutup" name="jam_tutup" required>
                                <option selected value="{{ $update->jam_tutup }}">{{ $update->jam_tutup }}</option>
                                <option value="00:00:00">00:00 WIB</option>
                                <option value="01:00:00">01:00 WIB</option>
                                <option value="02:00:00">02:00 WIB</option>
                                <option value="03:00:00">03:00 WIB</option>
                                <option value="04:00:00">04:00 WIB</option>
                                <option value="05:00:00">05:00 WIB</option>
                                <option value="06:00:00">06:00 WIB</option>
                                <option value="07:00:00">07:00 WIB</option>
                                <option value="08:00:00">08:00 WIB</option>
                                <option value="09:00:00">09:00 WIB</option>
                                <option value="10:00:00">10:00 WIB</option>
                                <option value="11:00:00">11:00 WIB</option>
                                <option value="12:00:00">12:00 WIB</option>
                            </select>
                            <div class="valid-feedback"> Jam Tutup tidak boleh kosong </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <label for="status_lapangan">Status Lapangan</label>
                            <select class="form-control" id="status_lapangan" name="status_lapangan" required>
                                <option selected value="{{ $update->status_lapangan }}"><?php if($update->status_lapangan == 1) { echo "Ready"; } else if($update->status_lapangan == 2) { echo "Tidak Ready"; } ?></option>
                                <option value="1">Ready</option>
                                <option value="2">Tidak Ready</option>
                            </select>
                            <div class="valid-feedback"> Jam Tutup tidak boleh kosong </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <label for="harga_lapangan">Harga Lapangan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Rp.</span>
                              </div>
                              <input type="text" class="form-control" id="harga_lapangan" name="harga_lapangan" value="{{ $update->harga_lapangan }} " aria-describedby="hargaLapangan" required>
                              <div class="invalid-feedback"> Harga Lapangan tidak boleh kosong. </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group mb-3">
                          <label for="dsc_fasilitas">Fasilitas Lapangan</label>
                          <textarea class="form-control" id="dsc_fasilitas" name="dsc_fasilitas" placeholder="fasilitas graha futsal" required> {{ $update->dsc_fasilitas }}</textarea>
                          <div class="invalid-feedback"> Fasilitas Lapangan tidak boleh kosong </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                      </form>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
@endsection