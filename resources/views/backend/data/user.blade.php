@extends('backend.default')

@push('meta')
    <meta name="description" content="Website HPV" />
    <meta name="keywords" content="Website HPV" />
    <meta name="author" content="CV" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Users | Rental Mobil</title>
@endpush

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users /</span> Data Users</h4>
        <hr class="my-5" />

        <!-- Responsive Table -->
        <div class="card">
            <h5 class="card-header">Data Mobil</h5>
                <div class="table-responsive text-nowrap">
                    <table id="data-peserta" class="table table-hover table-bordered">
                        <thead>
                            <tr class="text-nowrap">
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama User</th>
                                <th>Tgl Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Pekerjaan</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $value)
                                <tr>
                                    <td>{{ $index + 1}}</td>
                                    <td>{{ $value->nik }}</td>
                                    <td>{{ $value->nama }}</td>
                                    <td>{{ $value->tgl_lahir }}</td>
                                    <td>{{ $value->jkel }}</td>
                                    <td>{{ $value->no_hp }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->pekerjaan }}</td>
                                    <td>{{ $value->alamat }}</td>
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