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
                <h2 class="mb-2 page-title">Data Fasilitas</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                              <div class="toolbar row mb-3">
                                <div class="col ml-auto">
                                  <div class="dropdown float-right">
                                    <a href="{{ route('fasilitasCreatePage') }}">
                                      <button class="btn btn-primary float-right ml-3" type="button">Add Fasilitas +</button>
                                    </a>
                                  </div>
                                </div>
                              </div>
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <!-- <th>Title Fasilitas</th> -->
                                            <th>Jenis Fasilitas</th>
                                            <th>Desc Fasilitas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1}}</td>
                                                <td>{{ $item->title_fasilitas }}</td>
                                                <td>{{ $item->desc_fasilitas }}</td>
                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                          <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('fasilitasDelete', $item->id_mfasilitas) }}" method="POST">
                                                          <a href="{{ route('fasilitasUpdatePage', $item->id_mfasilitas) }}" class="btn btn-sm btn-primary">Edit</a>
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
    </div>
    <!-- .container-fluid -->
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
              ]
          } );
      } );
      //message with toastr
      @if(session()->has('success'))

        toastr.success('{{ session('success') }}', 'BERHASIL!');

      @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!');

      @endif
    </script>
@endpush
