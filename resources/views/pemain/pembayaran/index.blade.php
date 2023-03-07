@extends('pemain.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
<title>Booking | Futsal</title>
@endpush

@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Data Booking</h1>
                    <nav class="d-flex align-items-center">
                        <a href="">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="">Pembayaran</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Lapangan</th>
                                <th scope="col">Tgl Booking</th>
                                <th scope="col">Jam Mulai</th>
                                <th scope="col">Jam Berakhir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $value)
                                <?php if ($value->tgl_booking < new Date()) { ?>
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                            <img src="https://api.ayo.co.id/image/venue-field/165839009833230.image_cropper_1658390027623.jpg" width="150px">
                                            </div>
                                            <div class="media-body">
                                                <p>{{ $value->dsc_lapangan }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>{{ $value->tgl_booking }}</h5>
                                    </td>
                                    <td>
                                        <h5>{{ substr($value->jam_mulai, 0, 5) }} WIB</h5>
                                    </td>
                                    <td>
                                        <h5>{{ substr($value->jam_berakhir, 0, 5) }} WIB</h5>
                                    </td>
                                    <td>
                                        <a href="{{ route('pemainPembayaranKonfirmasi', $value->id_booking) }}">Bayar</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
@endsection