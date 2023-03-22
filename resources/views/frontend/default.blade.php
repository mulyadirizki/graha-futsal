<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>Rental Mobil</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<link type="text/css" rel="stylesheet" href="{{ url('frontend/css/bootstrap.min.css') }}"/>
		<link type="text/css" rel="stylesheet" href="{{ url('frontend/css/slick.css') }}"/>
		<link type="text/css" rel="stylesheet" href="{{ url('frontend/css/slick-theme.css') }}"/>
		<link type="text/css" rel="stylesheet" href="{{ url('frontend/css/nouislider.min.css') }}"/>
		<link type="text/css" rel="stylesheet" href="{{ url('frontend/css/font-awesome.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ url('frontend/css/style.css') }}"/>

    </head>
	<body>
		<!-- HEADER -->
		    @include('frontend.partials.header')
		<!-- /HEADER -->

		<!-- SECTION -->
			@yield('content')
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		@include('frontend.partials.footer')
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="{{ url('frontend/js/jquery.min.js') }}"></script>
		<!-- <script src="{{ url('frontend/js/bootstrap.min.js') }}"></script> -->
		<script src="{{ url('frontend/js/slick.min.js') }}"></script>
		<script src="{{ url('frontend/js/nouislider.min.js') }}"></script>
		<script src="{{ url('frontend/js/jquery.zoom.min.js') }}"></script>
		<script src="{{ url('frontend/js/main.js') }}"></script>

		<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

		@stack('script')
	</body>
</html>
