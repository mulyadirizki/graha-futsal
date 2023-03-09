@extends('admin.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Transaksi | Futsal</title>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Transaksi</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-striped table-bordered nowrap" id="dataTable-1">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemain</th>
                                            <th>ID Booking</th>
                                            <th>Bank Tujuan</th>
                                            <th>No Rekening</th>
                                            <th>Tgl Pembayaran</th>
                                            <th>Bukti Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1}}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->id_booking }}</td>
                                                <td>{{ $item->jenis_bank }}</td>
                                                <td>{{ $item->no_rek }}</td>
                                                <td>{{ $item->tgl_transaksi }}</td>
                                                <td>
                                                    <img src="{{ url('storage/img/pembayaran/'.$item->bukti_transaksi) }}" alt="" style="width: 200px">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
@push('script')
    <script>
      $(document).ready(function() {
          $('#dataTable-1').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ],
              "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
              ],
          } );
      } );
    </script>
@endpush
