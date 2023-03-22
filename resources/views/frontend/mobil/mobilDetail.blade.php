@extends('frontend.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
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
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Mobil Detail</li>
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
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="{{ url('storage/img/mobil/'.$data->img_mobil) }}" alt="{{ $data->nama_mobil }}">
							</div>

							<div class="product-preview">
								<img src="{{ url('storage/img/mobil/'.$data->img_mobil) }}" alt="{{ $data->nama_mobil }}">
							</div>

							<div class="product-preview">
								<img src="{{ url('storage/img/mobil/'.$data->img_mobil) }}" alt="{{ $data->nama_mobil }}">
							</div>

							<div class="product-preview">
								<img src="{{ url('storage/img/mobil/'.$data->img_mobil) }}" alt="{{ $data->nama_mobil }}">
							</div>
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
                            <div class="product-preview">
								<img src="{{ url('storage/img/mobil/'.$data->img_mobil) }}" alt="{{ $data->nama_mobil }}">
							</div>

							<div class="product-preview">
								<img src="{{ url('storage/img/mobil/'.$data->img_mobil) }}" alt="{{ $data->nama_mobil }}">
							</div>

							<div class="product-preview">
								<img src="{{ url('storage/img/mobil/'.$data->img_mobil) }}" alt="{{ $data->nama_mobil }}">
							</div>

							<div class="product-preview">
								<img src="{{ url('storage/img/mobil/'.$data->img_mobil) }}" alt="{{ $data->nama_mobil }}">
							</div>
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name">{{ $data->merk_mobil }} - {{ $data->nama_mobil }}</h2>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="#">Tahun {{ substr($data->th_mobil, 0, 4) }} | {{ $data->no_pol }}</a>
							</div>
							<div>
								<h3 class="product-price">Rp. {{ number_format($data->harga_sewa) }} /Hari</h3>
								<span class="product-available"><?php if($data->status == 1) { echo 'Ready'; } ?></span>
							</div>
							<p>Mobil {{ $data->nama_mobil }} Tahun {{ substr($data->th_mobil, 0, 4) }} Warna {{ $data->warna }}. Harga sewa Rp. {{ number_format($data->harga_sewa) }}/Hari lepas kunci, untuk pengembalian lewat dari tanggal kembali yang telah disepakati akan dikenakan denda sebanyak Rp. {{ number_format($data->denda_sewa) }}/hari</p>

                            <form action="{{ route('addMobilRental') }}" method="post" id="create-rental">
                                @csrf
                                <div class="product-options">
                                    <label>
                                        Tanggal Rental
                                        <input type="date" id="tgl_rental" class="input-select">
                                    </label>
                                    <label>
                                        Tanggal Kembali
                                        <input type="date" id="tgl_kembali" class="input-select">
                                    </label>
                                </div>
                                <input type="hidden" value="{{ $data->id_mobil }}" id="id_mobil">
                                <div class="add-to-cart">
                                    <div class="qty-label">
                                        Cara Pembayaran
                                        <select name="cara_bayar" id="cara_bayar" class="input-select">
                                            <option selected disabled>Cara Bayar</option>
                                            <option value="1">Transfer</option>
                                            <option value="2">Tunai</option>
                                        </select>
                                    </div> <br><br>
                                    <button type="submit" class="add-to-cart-btn">
                                        <i class="fa fa-shopping-cart"></i> Confirmasi Rental</button>
                                </div>
                            </form>

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="#">{{ $data->merk_mobil }}</a></li>
								<li><a href="#">{{ $data->nama_mobil }}</a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"></li>
							</ul>
							<!-- /product tab nav -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Mobil Lainya</h3>
						</div>
					</div>

                    @foreach($mobil as $value)
					    <!-- product -->
                        <div class="col-md-3 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="{{ url('storage/img/mobil/'.$value->img_mobil) }}" alt="{{ $value->nama_mobil }}" style="border-radius: 12px; width: 100%; height: auto; aspect-ratio: 88 / 61; object-fit: cover;">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{ $value->merk_mobil }}</p>
                                    <h3 class="product-name"><a href="#">{{ $value->nama_mobil }}</a></h3>
                                    <h4 class="product-price">Rp. {{ number_format($value->harga_sewa) }} /Hari</h4>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <h5>Tahun {{ substr($value->th_mobil, 0, 4) }}</h5>
                                    <div class="product-btns">
                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <a href="{{ route('getMobilDetail', $value->id_mobil) }}">
                                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Rental Sekarang</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /product -->
                    @endforeach

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->
@endsection

@push('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function(){
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();
            var maxDate = year + '-' + month + '-' + day;

            // or instead:
            // var maxDate = dtToday.toISOString().substr(0, 10);
            $('#tgl_rental').attr('min', maxDate);
            $('#tgl_kembali').attr('min', maxDate);
        });

        $('#create-rental').submit(function(e) {
            e.preventDefault();
            var date = new Date($('#tgl_rental').val()),
                day  = ("0" + date.getDate()).slice(-2),
                mnth = ("0" + (date.getMonth() + 1)).slice(-2);
            var tgl_rental = [date.getFullYear(), mnth, day].join("-");
            var date1 = new Date($('#tgl_kembali').val()),
                day  = ("0" + date1.getDate()).slice(-2),
                mnth = ("0" + (date1.getMonth() + 1)).slice(-2);
            var tgl_kembali = [date1.getFullYear(), mnth, day].join("-");
            var id_mobil = $('#id_mobil').val();
            var cara_bayar = $('#cara_bayar').find(':selected').val();
            let token   = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "{{ route('addMobilRental') }}",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id_mobil: id_mobil,
                    tgl_rental: tgl_rental,
                    tgl_kembali: tgl_kembali,
                    cara_bayar: cara_bayar,
                    _token: token
                },
                success: function(response) {
					if(response.data.cara_bayar == "1") {
						Swal.fire({
							icon: 'success',
							title: 'Rental Berhasil',
							text: 'Confirmasi rental berhasil dilakukan, silahkan selesaikan pembayaran',
							timer: 2000,
							showCancelButton: false,
							showConfirmButton: false
						})
						.then (function () {
							const id_rental = response.data.id_rental
							console.log(id_rental);
							window.location.href = '/id/u/user/mobil/pembayaran/'+id_rental;
						});
					} else if(response.data.cara_bayar == "2") {
						Swal.fire({
							icon: 'success',
							title: 'Rental Berhasil',
							text: 'Confirmasi rental berhasil dilakukan, silahkan melakukan pembayaran saat mengambil mobil',
						})
						.then (function () {
							window.location.href = "{{ route('getDataRental') }}"
						});
					}
                },
                error: function(e){
                    console.log(e);
                }
            });
        });
    </script>
@endpush