@extends('frontend.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Dashboard | Futsal</title>
@endpush

@section('content')
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
                            <img src="https://img.cintamobil.com/2021/01/12/E7uYC7dI/mobil-toyota-bc15.png" alt="">
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
                                                <h3 class="product-name"><a href="#">{{ $value->nama_mobil }}</a></h3>
                                                <h4 class="product-price">Rp. {{ number_format($value->harga_sewa) }} /Hari
                                                </h4>
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
                                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
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
@endsection
