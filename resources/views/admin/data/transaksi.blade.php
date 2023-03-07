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
                                <table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%" id="dataTable">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemain</th>
                                            <th>ID Booking</th>
                                            <th>Bank Tujuan</th>
                                            <th>No Rekening</th>
                                            <th>Tgl Pembayaran</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $item)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->id_booking }}</td>
                                                <td>{{ $item->jenis_bank }}</td>
                                                <td>{{ $item->no_rek }}</td>
                                                <td>{{ $item->tgl_transaksi }}</td>
                                                <td><img src="{{ url('storage/img/pembayaran/'.$item->bukti_transaksi) }}" alt="" style="width: 200px"></td>
                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                      <a class="dropdown-item" href="#">Remove</a>
                                                    </div>
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
      // $('#dataTable-1').DataTable(
      // {
      //   scrollX:        true,
      //   scrollCollapse: true,
      //   autoWidth:         true,
      //   paging:         true,
      //   columnDefs: [
      //     { "width": "200px", "targets": [1] },
      //     { "width": "100px", "targets": [2, 3, 4, 5, 8] }
      //   ]
      // });
      $(document).ready(function() {
          $('#dataTable').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ],
              "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
              ],
              scrollX:        true,
              scrollCollapse: true,
              autoWidth:         true,
              paging:         true,
              columnDefs: [
                { "width": "200px", "targets": [1] },
                { "width": "100px", "targets": [2, 3, 4, 5, 8] }
              ]
          } );
      } );
    </script>
@endpush
