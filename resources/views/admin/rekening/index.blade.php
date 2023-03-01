@extends('admin.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Lapangan | Futsal</title>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Rekening</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                              <div class="toolbar row mb-3">
                                  <div class="col ml-auto">
                                    <div class="dropdown float-right">
                                      <a href="{{ route('rekeningCreatePage') }}">
                                        <button class="btn btn-primary float-right ml-3" type="button">Add Rekening +</button>
                                      </a>
                                      <button class="btn btn-primary float-right ml-3" type="button">Export</button>
                                    </div>
                                  </div>
                                </div>
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>Nama Pemilik Rekening</th>
                                            <th>No Rekening</th>
                                            <th>Nama Bank</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $item)
                                            <tr>
                                                <td>{{ $item->nama_rek }}</td>
                                                <td>{{ $item->no_rek }}</td>
                                                <td>{{ $item->jenis_bank }}</td>
                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                          <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksiDelete', $item->id_mtransaksi) }}" method="POST">
                                                          <a href="{{ route('rekeningUpdatePage', $item->id_mtransaksi) }}" class="btn btn-sm btn-primary">Edit</a>
                                                          @csrf
                                                          @method('DELETE')
                                                          <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                      </form>
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
    <!-- <script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/js/dataTables.bootstrap4.min.js') }}"></script> -->
    <script>
    //   $('#dataTable-1').DataTable(
    //   {
    //     autoWidth: true,
    //     "lengthMenu": [
    //       [16, 32, 64, -1],
    //       [16, 32, 64, "All"]
    //     ]
    //   });
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
