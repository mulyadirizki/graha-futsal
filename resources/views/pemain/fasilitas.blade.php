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
					<h1>Graha Futsal</h1>
					<nav class="d-flex align-items-center">
						<a href="">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Booking<span class="lnr lnr-arrow-right"></span></a>
						<a href="">Lapangan</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-8 offset-lg-1">
					<div class="s_product_text">
						<h1>Graha Futsal</h1>
						<h2>Kec. Banuhampu, Kabupaten Agam, Sumatera Barat</h2>
						<ul class="list">
                        <img src="{{ url('assets/front/img/football.png') }}" alt="" height="16" width="16" style="margin-right: 4px;"> Futsal
						</ul>
						<p>Lapangan Futsal. Lokasi Jl. By Pass, Taluak Ampek Suku, Kec. Banuhampu, Kabupaten Agam, Sumatera Barat 26181</p>
						<div class="product_count">
                            <h3>Detail Fasilitas</h3>
						</div>
                        <div class="product-info row">
                            <div class="col-lg-4">
                                @if ($fasilitas->jenis_fasilitas == 1)
                                <div class="info_item">
                                    <i class="fas fa-toilet"></i>
                                    <h4>Toilet</h4>
                                    <p>{{ $fasilitas->desc_fasilitas }}</p>
                                </div>
                                @elseif ($fasilitas->jenis_fasilitas == 2)
                                <div class="info_item">
                                    <i class="fas fa-circle"></i>
                                    <h4>Bola</h4>
                                    <p>{{ $fasilitas->desc_fasilitas }}</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                @elseif ($fasilitas->jenis_fasilitas == 3)
                                <div class="info_item">
                                    <i class="fas fa-tshirt"></i>
                                    <h4>Rompi</h4>
                                    <p>{{ $fasilitas->desc_fasilitas }}</p>
                                </div>
                                @elseif ($fasilitas->jenis_fasilitas == 4)
                                <div class="info_item">
                                    <i class="lnr lnr-car"></i>
                                    <h4>Parkir Motor & Mobil</h4>
                                    <p>{{ $fasilitas->desc_fasilitas }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div><br><br>
	<!--================End Single Product Area =================-->
@endsection
