<!-- HEADER -->
<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 0822-0890-1991</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> rentalmobil@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Kota Padang</a></li>
					</ul>
					<ul class="header-links pull-right">
						<div class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<span style="color: white">{{ Auth::user()->email }}</span>
							</a>
							<div class="cart-dropdown">
								<h5 class="product-name"><a href="{{ route('logout') }}">Logout</a></h5>
							</div>
						</div>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<!-- <img src="{{ url('frontend/img/logo.png') }}" alt=""> -->
                                    <h2 style="color: white; padding-top:20px">Rental Mobil</h2>
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Toyota</option>
										<option value="1">Daihatsu</option>
                                        <option value="1">Mitsubishi</option>
                                        <option value="1">Nissan</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">

								<!-- Cart -->
								<div class="dropdown">
									<a href="{{ route('getDataRental') }}">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
									</a>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

        <!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="{{ route('user') }}">Home</a></li>
						<li><a href="{{ route('getMobil') }}">Mobil</a></li>
						<li><a href="{{ route('getDataRental') }}">Data Rental</a></li>
						<li><a href="#">Kontak Kami</a></li>
						<li><a href="#">Syarat & Ketentuan</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->