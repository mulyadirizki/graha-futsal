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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Rekening /</span> Data Rekening</h4>
        <hr class="my-5" />

        <a href="{{ route('addRekening') }}">
            <button class="btn btn-info btn-sm">Tambah Rekening</button>
        </a><br><br>
        <!-- Responsive Table -->
        <div class="card">
            <h5 class="card-header">Data Mobil</h5>
                <div class="table-responsive text-nowrap">
                    <table id="data-peserta" class="table table-hover table-bordered">
                        <thead>
                            <tr class="text-nowrap">
                                <th>No</th>
                                <th>Nama Pemilik</th>
                                <th>Nama Bank</th>
                                <th>No Rekening</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $value)
                                <tr>
                                    <td>{{ $index + 1}}</td>
                                    <td>{{ $value->nama_rek }}</td>
                                    <td>{{ $value->no_rek }}</td>
                                    <td>{{ $value->jenis_bank }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('deleteRekening', $value->id_rek) }}" method="POST">
                                            <a href="{{ route('upadteRekening', $value->id_rek) }}" class="btn btn-sm btn-primary">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Responsive Table -->
        </div>
        <!-- / Content -->
    </div>
@endsection
@push('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwtG5YjuP24l37yssdNn1s7Bj3x_SFD7c&callback=initMap&libraries=places&v=weekly" defer></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
@endpush