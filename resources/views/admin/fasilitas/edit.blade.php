@extends('admin.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Update Data Fasilitas | Graha Futsal</title>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Update Data Fasilitas</h2>
              <div class="row">
                <div class="col-md-6">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Data Fasilitas</strong>
                    </div>
                    <div class="card-body">
                      <form method="POST" action="{{ route('fasilitasUpdate') }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                            <div class="form-row">
                                <input type="hidden" id="id_mfasilitas" name="id_mfasilitas" value="{{ $update->id_mfasilitas }}">
                                <div class="col-md-12 mb-3">
                                    <label for="jenis_fasilitas">Status Fasilitas</label>
                                    <select class="form-control" id="jenis_fasilitas" name="jenis_fasilitas" required>
                                        <option selected value="{{ $update->jenis_fasilitas }}">
                                            <?php
                                                if($update->jenis_fasilitas == 1) { echo "Toilet";
                                                } else if($update->jenis_fasilitas == 2) { echo "Bola";
                                                } else if($update->jenis_fasilitas == 3) { echo "Rompi";
                                                } else if($update->jenis_fasilitas == 4) { echo "Area Parkir"; }
                                            ?>
                                        </option>
                                        <option value="1">Toilet</option>
                                        <option value="2">Bola</option>
                                        <option value="3">Rompi</option>
                                        <option value="4">Area Parkir</option>
                                    </select>
                                    <div class="valid-feedback"> Jenis Fasilitas tidak boleh kosong </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="desc_fasilitas">Fasilitas Fasilitas</label>
                                    <textarea class="form-control" id="desc_fasilitas" name="desc_fasilitas" placeholder="fasilitas graha futsal" rows="5" required> {{ $update->desc_fasilitas }}</textarea>
                                    <div class="invalid-feedback"> Keterangan Fasilitas tidak boleh kosong </div>
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