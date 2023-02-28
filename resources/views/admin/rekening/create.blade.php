@extends('admin.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Tambah Data Rekening | Graha Futsal</title>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Tambah Data Rekening</h2>
              <div class="row">
                <div class="col-md-6">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Data Rekening</strong>
                    </div>
                    <div class="card-body">
                      <form method="POST" action="{{ route('transaksiAdd') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                          <div class="col-md-12 mb-3">
                            <label for="nama_rek">Nama Pemilik Rekening</label>
                            <input type="text" class="form-control" id="nama_rek" name="nama_rek" aria-describedby="amaPemilikRekening" required>
                            <div class="invalid-feedback"> Nama Pemilik Rekening tidak boleh kosong </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <label for="no_rek">No Rekening</label>
                            <input type="text" class="form-control" id="no_rek" name="no_rek" aria-describedby="noRekening" required>
                            <div class="invalid-feedback"> No Rekening tidak boleh kosong </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <label for="jenis_bank">Nama Bank</label>
                            <input type="text" class="form-control" id="jenis_bank" name="jenis_bank" aria-describedby="namaBank" required>
                            <div class="invalid-feedback"> Nama Bank tidak boleh kosong </div>
                          </div>
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