@extends('frontend.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Rental Mobil | Detail</title>
@endpush

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Data Rental</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="#">Home</a></li>
                        <li class="active">Data-Rental</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Data Rental</h3>
                        </div>
                        <table id="data-rental" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mobil</th>
                                    <th>Tgl Rental</th>
                                    <th>Tgl Kembali</th>
                                    <th>Harga Sewa</th>
                                    <th>Lama Rental</th>
                                    <th>Total Sewa</th>
                                    <th>Cara Bayar</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $value => $item)
                                    <tr>
                                        <td>{{ $value + 1 }}</td>
                                        <td>{{ $item->merk_mobil }} - {{ $item->nama_mobil }}</td>
                                        <td>{{ $item->tgl_rental }}</td>
                                        <td>{{ $item->tgl_kembali }}</td>
                                        <td>Rp. {{ number_format($item->harga_sewa) }}/Hari</td>
                                        <td>{{ $item->lama_sewa }} Hari</td>
                                        <td>Rp. {{ number_format($item->total_biaya) }}</td>
                                        <td>
                                            <?php if ($item->cara_bayar == '1') {
                                                echo 'Transfer';
                                            } elseif ($item->cara_bayar == '2') {
                                                echo 'Tunai';
                                            } ?>
                                        </td>
                                        <td>
                                            <?php if(empty($item->id_pembayaran)) { ?>
                                            <h5>Belum Bayar</h5>
                                            <?php } else { ?>
                                            <h5>Sudah Bayar</h5>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if(empty($item->id_pembayaran)) { ?>
                                            <?php if($item->cara_bayar == '1') { ?>
                                            <a href="{{ route('pembyaranRental', $item->id_rental) }}"><button
                                                    class="btn btn-sm btn-primary">Bayar</button></a>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <button class="btn btn-sm btn-primary" disabled>Bayar</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /Billing Details -->

                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
