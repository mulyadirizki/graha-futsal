@extends('backend.default')

@push('meta')
    <meta name="description" content="Website HPV" />
    <meta name="keywords" content="Website HPV" />
    <meta name="author" content="CV" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Mobil | Rental Mobil</title>
@endpush

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Mobil /</span> Data Mobil</h4>
        <hr class="my-5" />

        <a href="{{ route('addMobil') }}">
            <button class="btn btn-info btn-sm">Tambah Mobil</button>
        </a><br><br>
        <!-- Responsive Table -->
        <div class="card">
            <h5 class="card-header">Data Mobil</h5>
                <div class="table-responsive text-nowrap">
                    <table id="data-peserta" class="table table-hover table-bordered">
                        <thead>
                            <tr class="text-nowrap">
                                <th>No</th>
                                <th>Nama Mobil</th>
                                <th>No Polisi</th>
                                <th>Warna</th>
                                <th>Tahun Mobil</th>
                                <th>Merk Mobil</th>
                                <th>Foto Mobil</th>
                                <th>Harga Sewa</th>
                                <th>Denda Sewa</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $value)
                                <tr>
                                    <td>{{ $index + 1}}</td>
                                    <td>{{ $value->nama_mobil }}</td>
                                    <td>{{ $value->no_pol }}</td>
                                    <td>{{ $value->warna }}</td>
                                    <td>{{ $value->th_mobil }}</td>
                                    <td>{{ $value->merk_mobil }}</td>
                                    <td>{{ $value->nama_mobil }}</td>
                                    <td>Rp. {{ number_format($value->harga_sewa) }} /Hari</td>
                                    <td>Rp. {{ number_format($value->denda_sewa) }} /Hari</td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('deleteMobil', $value->id_mobil) }}" method="POST">
                                            <a href="{{ route('upadteMobil', $value->id_mobil) }}" class="btn btn-sm btn-primary">Edit</a>
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