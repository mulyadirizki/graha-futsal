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

        <a href="{{ route('addUserAdmin') }}">
            <button class="btn btn-info btn-sm">Tambah User</button>
        </a><br><br>
        <!-- Responsive Table -->
        <div class="card">
            <h5 class="card-header">Data Mobil</h5>
                @if(session('success'))
					<p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if($errors->any())
                    @foreach($errors->all() as $err)
                        <p class="alert alert-danger">{{ $err }}</p>
                    @endforeach
                @endif
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
                                <th>Roles</th>
                                <th>Action</th>
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
                                    <td>
                                        <?php
                                            if($value->roles == '1') {
                                                echo 'Admin';
                                            } else if ($value->roles == '2') {
                                                echo 'User';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('deleteUserdmin', $value->iduser) }}" method="POST">
                                            <a href="{{ route('upadteUserAdmin', $value->iduser) }}" class="btn btn-sm btn-primary">Edit</a>
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
    <script>
        @if(session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');

        @endif
    </script>
@endpush