@extends('pemain.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
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
						<a href="#">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Konfirmasi Pembayaran</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Order Details Area =================-->
	<section class="order_details section_gap">
		<div class="container">
			<h3 class="title_confirmation">Bukti Pembayaran Booking Lapangan Graha Futsal.</h3>
			<div class="row order_d_inner">
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Booking Info</h4>
						<ul class="list">
							<li><a href="#"><span>ID Booking</span> : {{ $dataBooking->id_booking }}</a></li>
							<li><a href="#"><span>Lapangan</span> : {{ $dataBooking->dsc_lapangan }}</a></li>
							<li><a href="#"><span>Jenis Lapangan</span> : {{ $dataBooking->tipe_lapangan }}</a></li>
							<li><a href="#"><span>Tgl Booking</span> : {{ $dataBooking->tgl_booking }}</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Rekening Pembayaran</h4>
						<ul class="list">
							<li><a href="#"><span>Nama</span> : {{ $dataRekening->nama_rek }}</a></li>
							<li><a href="#"><span>Bank</span> : {{ $dataRekening->jenis_bank }}</a></li>
							<li><a href="#"><span>No Rek</span> : {{ $dataRekening->no_rek }}</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="order_details_table">
				<h2>Booking Details</h2>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Product</th>
                                <th scope="col"></th>
								<th scope="col">Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<p>{{ $dataBooking->dsc_lapangan }}</p>
								</td>
                                <td></td>
								<td>
									<p>{{ $dataBooking->tipe_lapangan }}</p>
								</td>
							</tr>
							<tr>
								<td>
									<p>Jam Mulai</p>
								</td>
                                <td></td>
								<td>
									<p>{{ substr($dataBooking->jam_mulai, 0, 5) }} WIB</p>
								</td>
							</tr>
							<tr>
								<td>
									<p>Jam Berakhir</p>
								</td>
                                <td></td>
								<td>
									<p>{{ substr($dataBooking->jam_berakhir, 0, 5) }} WIB</p>
								</td>
							</tr>
                            <tr>
								<td>
									<p>Lama Main</p>
								</td>
                                <td></td>
								<td>
									<p>{{ substr($dataBooking->lama_main, 0, 2) }} Jam</p>
								</td>
							</tr>
                            <tr>
								<td>
									<p>Harga Sewa Lapangan</p>
								</td>
                                <td></td>
								<td>
									<p>Rp. {{ number_format($dataBooking->harga_lapangan) }} /Jam</p>
								</td>
							</tr>
							<tr>
								<td>
									<h4>Subtotal</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p>Rp. {{ number_format($dataBooking->total_biaya) }}</p>
								</td>
							</tr>
							<tr>
								<td>
									<h4>Total</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p>Rp. {{ number_format($dataBooking->total_biaya) }}</p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div><br>
			<div class="row order_d_inner">
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Transaksi Info</h4>
						<ul class="list">
							<li><a href="#"><span>Tanggal Pembayaran</span> : {{ $dataTransaksi->tgl_transaksi }}</a></li>
							<li><a href="#"><span>Status Pembayarn</span> : <label class="badge badge-success">Sudah dibayarkan</label></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="details_item">
						<h4>Bukti Pembayaran</h4>
						<ul class="list">
						<img src="{{ asset('storage/img/pembayaran/' . $dataTransaksi->bukti_transaksi) }}" alt="Bukti Transaksi" style="width: 350px;">
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Order Details Area =================-->

	<!-- Modal -->
	<div class="modal fade" id="uploadbuktipembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="{{ route('pembayarangAdd') }}" method="post" id="image-upload" enctype="multipart/form-data">
					<div class="modal-body">
						@csrf
						<input type="hidden" id="id_tuser" name="id_tuser" value="{{ $dataBooking->id_tuser }}">
						<input type="hidden" id="id_booking" name="id_booking" value="{{ $dataBooking->id_booking }}">
						<input type="hidden" id="id_mtransaksi" name="id_mtransaksi" value="{{ $dataRekening->id_mtransaksi }}">
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Tgl Pembayaran:</label>
							<input type="date" disabled class="form-control" name="tgl_transaksi" id="tgl_transaksi"  value="<?php echo date('Y-m-d'); ?>">
						</div>
						<div class="form-group">
							<label for="message-text" class="col-form-label">Upload Bukti Pembayaran</label>
							<input type="file" class="form-control" name="image" id="image" accept="image/png, image/gif, image/jpeg" onchange="previewFile(this);">
						</div>
						<div class="holder">
							<img id="imgPreview" style="width: 100%" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="pic" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Kirim</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@push('script')
	<script>
		$.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            },
        });

		function previewFile(input) {
			var file = $("input[type=file]").get(0).files[0];

			if (file) {
				var reader = new FileReader();

				reader.onload = function(){
					$("#imgPreview").attr("src", reader.result);
				}

				reader.readAsDataURL(file);
			}
		}

		$('#image-upload').submit(function (e) {
			e.preventDefault();
           	let formData = new FormData(this);

			$.ajax({
				url: "{{ route('pembayarangAdd') }}",
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function(response) {
					$('#uploadbuktipembayaran').modal('hide'),
					Swal.fire({
						icon: 'success',
						title: 'Upload bukti pembayaran berhasil',
						timer: 1500
					});
				},
				error: function(err) {
					alert('Upload bukti pembayaran gagal')
				}
			})
		});
	</script>
@endpush