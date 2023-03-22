@extends('backend.default')

@push('meta')
    <meta name="description" content="Website HPV" />
    <meta name="keywords" content="Website HPV" />
    <meta name="author" content="CV" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Pengembalian Rental | Rental Mobil</title>
@endpush

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Rental /</span> Data Kembali Rental</h4>
        <hr class="my-5" />

        <!-- Responsive Table -->
        <div class="card">
            <h5 class="card-header">Data Pengembalian Rental Jatuh Tempo</h5>
            <div class="table-responsive text-nowrap">
                <table id="data-peserta" class="table table-hover table-bordered">
                    <thead style="background-color: beige"d">
                        <tr class="text-nowrap">
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>No HP</th>
                            <th>Mobil</th>
                            <th>Warna</th>
                            <th>No Polisi</th>
                            <th>Tahun Mobil</th>
                            <th>Tgl Rental</th>
                            <th>Tgl Kembali</th>
                            <th>Harga Sewa</th>
                            <th>Lama Sewa</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $value)
                            @if ($value->tgl_expired == 'Hari ini dikembalikan' || $value->tgl_expired == 'Expired tgl kembali')
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $value->nama }}</td>
                                    <td>{{ $value->no_hp }}</td>
                                    <td>{{ $value->merk_mobil }} {{ $value->nama_mobil }}</td>
                                    <td>{{ $value->no_pol }}</td>
                                    <td>{{ $value->warna }}</td>
                                    <td>{{ $value->th_mobil }}</td>
                                    <td>{{ $value->tgl_rental }}</td>
                                    <td>{{ $value->tgl_kembali }}</td>
                                    <td>Rp. {{ number_format($value->total_biaya) }}</td>
                                    <td>{{ $value->lama_sewa }} Hari</td>
                                    <td>{{ $value->tgl_expired }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#uploadbuktipembayaran"
                                            data-id="{{ $value->id_rental }}"
                                            class="btn btn-click btn-sm btn-danger">Konfirmasi Pengembalian</button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Responsive Table -->
    </div>
    <!-- / Content -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="uploadbuktipembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                </div>
                <form action="{{ route('rentalKembaliStore') }}" method="post" id="rentalKembali"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="id_rental" name="id_rental" value="">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tgl Diterima</label>
                            <input type="date" disabled class="form-control" name="tgl_diterima" id="tgl_diterima"
                                value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Kondisi Mobil</label>
                            <textarea name="kondisi_mobil" class="form-control" id="kondisi_mobil" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.btn-click').on('click', function() {
            $('#uploadbuktipembayaran').modal('show');
            var id_rental = $(this).attr('data-id');
            $('#id_rental').val(id_rental)
        });
        $('#rentalKembali').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('rentalKembaliStore') }}",
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success == true) {
                        $('#uploadbuktipembayaran').modal('hide'),
                            Swal.fire({
                                icon: 'success',
                                title: 'Data berhasil disimpan',
                                timer: 1500
                            });
                        location.reload();
                    }
                },
                error: function(err) {
                    alert('Data gagal disimpan')
                }
            })
        });
        $('#btn-close').on('click', function() {
            $('#uploadbuktipembayaran').modal('hide');
        });
    </script>
@endpush
