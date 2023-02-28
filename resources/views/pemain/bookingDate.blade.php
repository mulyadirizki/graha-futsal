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

@push('css')
<link rel="stylesheet" href="{{ url('assets/front/css/bootstrap.css') }}">
@endpush

@section('content')
	<!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Booking</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">Lapangan</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-4">
                    <div id="holder"></div>
    <div id="datepicker1"></div>
                        <p>Date: <input type="text" id="datepicker"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
     $(function() {
        $("#datepicker1").datepicker({
          numberOfMonths:3
        });
      });
      $('#datepicker').on('change', function() {
        const val =  document.getElementById('datepicker').value;
        console.log(val);
      })
    </script>
@endpush
