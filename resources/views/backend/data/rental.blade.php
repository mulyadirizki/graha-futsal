@extends('backend.default')

@push('meta')
    <meta name="description" content="Website HPV" />
    <meta name="keywords" content="Website HPV" />
    <meta name="author" content="CV" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Rental Pelanggan | Rental Mobil</title>
@endpush

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Rental /</span> Data Rental</h4>
        <hr class="my-5" />
        <a href="{{ route('addMobilRentaldmin') }}">
            <button class="btn btn-info btn-sm">Tambah Rental</button>
        </a><br><br>
        <!-- Responsive Table -->
        <div class="card">
            <h5 class="card-header">Data Rental</h5>
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
                            <th>Nama Pelanggan</th>
                            <th>No HP</th>
                            <th>Mobil</th>
                            <th>No Polisi</th>
                            <th>Warna</th>
                            <th>Tahun Mobil</th>
                            <th>Tgl Rental</th>
                            <th>Tgl Kembali</th>
                            <th>Lama Sewa</th>
                            <th>Total Biaya</th>
                            <th>Cara Bayar</th>
                            <th>Status Pembayaran</th>
                            <th>Bukti Bayar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $value)
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
                                <td>{{ $value->lama_sewa }} Hari</td>
                                <td>Rp. {{ number_format($value->total_biaya) }} /Hari</td>
                                <td>
                                    <?php if ($value->cara_bayar == 1) {
                                        echo 'Transfer';
                                    } elseif ($value->cara_bayar == 2) {
                                        echo 'Tunai';
                                    } ?>
                                </td>
                                <td>
                                    <?php if (empty($value->id_pembayaran)) {
                                        echo 'Belum Bayar';
                                    } else {
                                        echo 'Sudah Bayar';
                                    } ?>
                                </td>
                                <td>
                                    <?php if(empty($value->id_pembayaran)) { ?>
                                    <p>Tidak Ada bukti pembayaran</p>
                                    <?php } else { ?>
                                    <img src="{{ url('storage/img/pembayaran/' . $value->bukti_transaksi) }}"
                                        alt="{{ $value->bukti_transaksi }}"
                                        style="border-radius: 12px; width: 100%; height: auto; aspect-ratio: 88 / 61; object-fit: cover;">
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if(empty($value->id_pembayaran)) { ?>
                                    <?php /*if($value->cara_bayar == '2')*/ { ?>
                                    <a href="{{ route('pembyaaranRental', $value->id_rental) }}"><button
                                            class="btn btn-sm btn-primary">Bayar</button></a>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <button class="btn btn-sm btn-primary" disabled>Bayar</button>
                                    <?php } ?>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('deleteMobilRentaldmin', $value->id_rental) }}" method="POST">
                                        <a href="{{ route('updateMobilRentaldmin', $value->id_rental) }}" class="btn btn-sm btn-primary">Edit</a>
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
