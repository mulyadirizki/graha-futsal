<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rental Mobil</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="{{ url('frontend/css/bootstrap.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ url('frontend/css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ url('frontend/css/slick-theme.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ url('frontend/css/nouislider.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ url('frontend/css/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ url('frontend/css/style.css') }}" />

</head>

<body>
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
                    <!-- <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li> -->
                    <li><a href="{{ route('login') }}">Login / Daftar</a></li>
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
                            <!-- Wishlist -->

                            <div class="dropdown">
                                <a href="{{ route('getDataRental') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                </a>
                            </div>

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
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="{{ route('getMobil') }}">Mobil</a></li>
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

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="https://img.cintamobil.com/2021/01/12/E7uYC7dI/mobil-toyota-bc15.png"
                                alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Mobil<br>Toyota</h3>
                            <a href="{{ route('getMobil') }}" class="cta-btn">Lihat Detail <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="https://ad-cms-headless.imgix.net/assets/f18c9b98-89a7-4628-a5bf-ccecf0599f01?w=720&h=auto&q=65&fm=webp&auto=format&fit=max&crop=center"
                                alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Mobil<br>Daihatsu</h3>
                            <a href="{{ route('getMobil') }}" class="cta-btn">Lihat Detail <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="https://imgcdnblog.carbay.com/wp-content/uploads/2019/07/26141144/2019-Mitsubishi-Pajero-Sport-Thailand-accessories-1.jpg"
                                alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Mobil<br>Mitsubishi</h3>
                            <a href="{{ route('getMobil') }}" class="cta-btn">Lihat Detail <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Mobil Terbaru</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1">All</a></li>
                                <li><a data-toggle="tab" href="#tab1">Toyota</a></li>
                                <li><a data-toggle="tab" href="#tab1">Daihatsu</a></li>
                                <li><a data-toggle="tab" href="#tab1">Mitsubishi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach ($data as $value)
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="{{ url('storage/img/mobil/' . $value->img_mobil) }}"
                                                    alt="{{ $value->nama_mobil }}"
                                                    style="border-radius: 12px; width: 100%; height: auto; aspect-ratio: 88 / 61; object-fit: cover;">
                                                <!-- <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div> -->
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $value->merk_mobil }}</p>
                                                <h3 class="product-name"><a
                                                        href="#">{{ $value->nama_mobil }}</a></h3>
                                                <h4 class="product-price">Rp. {{ number_format($value->harga_sewa) }}
                                                    /Hari</h4>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <h5>Tahun {{ substr($value->th_mobil, 0, 4) }}</h5>
                                                <div class="product-btns">
                                                    {{-- <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                            class="tooltipp">add to wishlist</span></button>
                                                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                            class="tooltipp">add to compare</span></button>
                                                    <button class="quick-view"><i class="fa fa-eye"></i><span
                                                            class="tooltipp">quick view</span></button> --}}
                                                    <?php if($value->status == '2') 
															{ ?>
                                                    <h6 style="background-color: red ; color:white">Tidak Tersedia</h6>
                                                    <?php } else { ?>
                                                    <h6 style="background-color: green; color:white">Tersedia</h6>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <?php if($value->status == '2') { ?>
                                                <a href="{{ route('getMobilDetail', $value->id_mobil) }}">
                                                    <button class="add-to-cart-btn" disabled><i
                                                            class="fa fa-shopping-cart"></i>
                                                        Rental
                                                        Sekarang</button>
                                                </a>
                                                <?php } else { ?>
                                                <a href="{{ route('getMobilDetail', $value->id_mobil) }}">
                                                    <button class="add-to-cart-btn"><i
                                                            class="fa fa-shopping-cart"></i>
                                                        Rental
                                                        Sekarang</button>
                                                </a>
                                                <?php } ?>

                                                {{-- <a href="{{ route('getMobilDetail', $value->id_mobil) }}">
                                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Rental Sekarang</button>
                                                </a> --}}
                                            </div>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Days</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Hours</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Mins</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Secs</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">Promo Rental Mobil</h2>
                        <p>Diskon hingga 50%</p>
                        <a class="primary-btn cta-btn" href="#">Lidat Detail</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

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
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Tentang Kami</h3>
                            <p>Rental Mobil murah dan lepas kunci</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>Kota Padang</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>0822-0890-1991</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>rentalmobil@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                <li><a href="#">Hot deals</a></li>
                                <li><a href="#">Toyota</a></li>
                                <li><a href="#">Daihatsu</a></li>
                                <li><a href="#">Mitsubishi</a></li>
                                <li><a href="#">Nisan</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by MrP
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="{{ url('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ url('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('frontend/js/slick.min.js') }}"></script>
    <script src="{{ url('frontend/js/nouislider.min.js') }}"></script>
    <script src="{{ url('frontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ url('frontend/js/main.js') }}"></script>

</body>

</html>
