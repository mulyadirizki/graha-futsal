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
                            <h3>Fasilitas</h3>
						</div>
                        <div class="product-info row">
                            @foreach($fasilitas as $ft)
                                <div class="col-lg-4">
                                    @if ($ft->jenis_fasilitas == 1)
                                    <div class="info_item">
                                        <i class="fas fa-toilet"></i>
                                        <p>Toilet</p>
                                    </div>
                                    @elseif ($ft->jenis_fasilitas == 2)
                                    <a href="{{ route('pemainFasilitasDetail', ['id' => $ft->id_mfasilitas]) }}">
                                        <div class="info_item">
                                            <i class="fas fa-circle"></i>
                                            <p>Bola</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4">
                                    @elseif ($ft->jenis_fasilitas == 3)
                                    <a href="{{ route('pemainFasilitasDetail', ['id' => $ft->id_mfasilitas]) }}">
                                        <div class="info_item">
                                            <i class="fas fa-tshirt"></i>
                                            <p>Rompi</p>
                                        </div>
                                    </a>
                                    @elseif ($ft->jenis_fasilitas == 4)
                                    <div class="info_item">
                                        <i class="lnr lnr-car"></i>
                                        <p>Parkir Motor & Mobil</p>
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area offset-lg-1">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
					 aria-selected="false">Pilih Lapangan</a>
				</li>
			</ul>
            <div class="col-6">
                <div id="datepicker"></div>
            </div>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
					<div class="row">
						<div class="col-lg-12">
                            @foreach($data as $item)
                                <div class="row total_rate">
                                    <div class="col-md-4 col-4">
                                        <img src="https://lh3.googleusercontent.com/p/AF1QipM9ItiQ9M0D5rsMKr-VizgPoV0Teib2d0VYXYBi=s680-w680-h510" class="d-block img-fluid venue-pic" alt="..." style="border-radius: 12px; width: 100%; height: auto; aspect-ratio: 88 / 61; object-fit: cover;">
                                    </div>
                                    <div class="col-md-3 col-8">
                                        <div class="rating_list">
                                            <h3>{{ $item->dsc_lapangan }}</h3>
                                            <p>Mulai dari Rp. {{ number_format($item->harga_lapangan) }} /Jam</p>
                                            <ul class="blog_meta list">
                                                <li><a href="#"><i class="lnr lnr-user"></i> Futsal</a></li>
                                                <li><a href="#"><i class="lnr lnr-calendar-full"></i> Indoor</a></li>
                                                <li><a href="#"><i class="lnr lnr-eye"></i> {{ $item->tipe_lapangan }}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <input type="hidden" id="id_tuser" value="{{ Auth::user()->id_tuser }}">
                                    <div class="col-md-5">
                                        <form class="row contact_form" method="post" id="contactForm_{{ $item->id_lapangan }}" novalidate="novalidate">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">Jam Main :</label>
                                                <div class="form-group col-md-8">
                                                    <select id="jam_mulai_{{ $item->id_lapangan }}" name="jam_mulai" class="form-control">
                                                        <option disabled selected>Jam Mulai</option>
                                                        <!-- Options should be dynamically populated -->
                                                    </select>
                                                </div>
                                                <label for="staticEmail" class="col-sm-4 col-form-label">Jam Berakhir :</label>
                                                <div class="form-group col-md-8">
                                                    <select id="jam_berakhir_{{ $item->id_lapangan }}" name="jam_berakhir" class="form-control">
                                                        <option disabled selected>Jam Berakhir</option>
                                                        <!-- Options should be dynamically populated -->
                                                    </select>
                                                </div>
                                                <div class="col-md-12 text-right">
                                                    <button type="button" onclick="addbooking('{{ $item->id_lapangan }}')" class="btn primary-btn">Booking Sekarang</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->
@endsection

@push('script')
<script src="{{ asset('assets/js/booking.js') }}"></script>
<script>
    $( function() {
        $('#datepicker').datepicker({
            // startDate: new Date(),
            format: 'mm/dd/yyyy',
            // minDate: 0,
            showOtherMonths: true,
            weekHeader: "W",
            autoOpen:true,
		    autoclose: true,
		    todayHighlight: true,
            dayNamesMin: ['Min', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        });
    });
</script>
@endpush
