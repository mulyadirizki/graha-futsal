@extends('admin.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Booking | Futsal</title>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Booking</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%" id="dataTable-1">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemain</th>
                                            <th>Lapangan</th>
                                            <th>Harga Lapangan</th>
                                            <th>Tgl Booking</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Berakhir</th>
                                            <th>Lama Main</th>
                                            <th>Total Biaya</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1}}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->dsc_lapangan }}</td>
                                                <td>Rp. {{ number_format($item->harga_lapangan) }} /Jam</td>
                                                <td>{{ $item->tgl_booking }}</td>
                                                <td>{{ substr($item->jam_mulai, 0, 5) }} WIB</td>
                                                <td>{{ substr($item->jam_berakhir, 0, 5) }} WIB</td>
                                                <td>{{ substr($item->diff, 0, 2) }} Jam</td>
                                                <td>Rp. {{ number_format($item->total_biaya) }}</td>
                                                <td><span class="badge badge-primary">{{ $item->status_booking }}</span></td>
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
    <!-- <script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/js/dataTables.bootstrap4.min.js') }}"></script> -->
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
