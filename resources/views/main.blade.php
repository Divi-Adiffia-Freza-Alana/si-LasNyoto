<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<meta name="author" content="SemiColonWeb">
	<meta name="description" content="Get Canvas to build powerful websites easily with the Highly Customizable &amp; Best Selling Bootstrap Template, today.">

	<!-- Font Imports -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;1,400&family=Montserrat:wght@300;400;500;600;700&family=Merriweather:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">

	<!-- Core Style -->
	<link rel="stylesheet" href="../css/style.css">
	<!-- Font Icons -->
	<link rel="stylesheet" href="../css/font-icons.css">
	 <!-- Font Awesome -->
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- Plugins/Components CSS -->
	<link rel="stylesheet" href="../css/swiper.css">

	

	<!-- Niche Demos -->
	<link rel="stylesheet" href="../css/demos/shop/shop.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/custom.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Document Title
	============================================= -->
	<title>E commerce Las Nyoto</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper">

		


		<!-- Login Modal -->
		<div class="modal1 mfp-hide" id="modal-register">
			<div class="card mx-auto" style="max-width: 540px;">
				<div class="card-header py-3 bg-transparent text-center">
					<h3 class="mb-0 fw-normal">Hello, Welcome Back</h3>
				</div>
				<div class="card-body mx-auto py-5" style="max-width: 70%;">



					<form id="login-form" name="login-form" class="mb-0 row" action="#" method="post">

						<div class="col-12">
							<input type="text" id="login-form-username" name="login-form-username" value="" class="form-control not-dark" placeholder="Username">
						</div>

						<div class="col-12 mt-4">
							<input type="password" id="login-form-password" name="login-form-password" value="" class="form-control not-dark" placeholder="Password">
						</div>

						<div class="col-12 text-end">
							<a href="#" class="text-dark fw-light mt-2">Forgot Password?</a>
						</div>

						<div class="col-12 mt-4">
							<button class="button w-100 m-0" id="login-form-submit" name="login-form-submit" value="login">Login</button>
						</div>
					</form>
				</div>
				<div class="card-footer py-4 text-center">
					<p class="mb-0">Don't have an account? <a href="#"><u>Sign up</u></a></p>
				</div>
			</div>
		</div>


		<!-- Header
		============================================= -->
		<header id="header" class="full-header header-size-md">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row justify-content-lg-between">

						<!-- Logo
						============================================= -->
						<div id="logo" class="me-lg-4">
							<a href="demo-shop.html">
								<img class="logo-default" srcset="" src="{{asset('/')}}img/logonyotopng.png" alt="Las Nyoto Logo">
							</a>
						</div><!-- #logo end -->

						<div class="header-misc">

							<!-- Top Search
							============================================= -->
							<div id="top-account">
								<a href="/logout"  ><i class=" fa-solid fa-right-from-bracket me-1 position-relative" style="top: 1px;"></i><span class="d-none d-sm-inline-block font-primary fw-medium">Logout</span></a>
							</div><!-- #top-search end -->

							<!-- Top Cart
							============================================= -->
							<div id="top-cart" class="header-misc-icon d-none d-sm-block">
								<a href="/cart" id=""><i class="uil uil-shopping-bag"></i></a>
								<!--<a href="/cart" id=""><i class="uil uil-shopping-bag"></i><span class="top-cart-number">5</span></a>-->
								<div class="top-cart-content">
									<div class="top-cart-title">
										<h4>Shopping Cart</h4>
									</div>
									<div class="top-cart-items">
										<div class="top-cart-item">
											<div class="top-cart-item-image">
												<a href="#"><img src="images/shop/small/1.jpg" alt="Blue Round-Neck Tshirt"></a>
											</div>
											<div class="top-cart-item-desc">
												<div class="top-cart-item-desc-title">
													<a href="#">Blue Round-Neck Tshirt with a Button</a>
													<span class="top-cart-item-price d-block">$19.99</span>
												</div>
												<div class="top-cart-item-quantity">x 2</div>
											</div>
										</div>
										<div class="top-cart-item">
											<div class="top-cart-item-image">
												<a href="#"><img src="images/shop/small/6.jpg" alt="Light Blue Denim Dress"></a>
											</div>
											<div class="top-cart-item-desc">
												<div class="top-cart-item-desc-title">
													<a href="#">Light Blue Denim Dress</a>
													<span class="top-cart-item-price d-block">$24.99</span>
												</div>
												<div class="top-cart-item-quantity">x 3</div>
											</div>
										</div>
									</div>
									<div class="top-cart-action">
										<span class="top-checkout-price">$114.95</span>
										<a href="#" class="button button-3d button-small m-0">View Cart</a>
									</div>
								</div>
							</div><!-- #top-cart end -->

							<!-- Top Search
							============================================= -->
							<div id="top-search" class="header-misc-icon">
								<!--<a href="#" id="top-search-trigger"><i class="uil uil-search"></i><i class="bi-x-lg"></i></a>-->
							</div><!-- #top-search end -->

						</div>

						<div class="primary-menu-trigger">
							<button class="cnvs-hamburger" type="button" title="Open Mobile Menu">
								<span class="cnvs-hamburger-box"><span class="cnvs-hamburger-inner"></span></span>
							</button>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu with-arrows me-lg-auto">

							<ul class="menu-container">
								<li class="menu-item current"><a class="menu-link" href="#"><div>Produk</div></a></li>
								<li class="menu-item current"><a class="menu-link" href="/transaksi-customer"><div>Transaksi</div></a></li>
								
							</ul>

						</nav><!-- #primary-menu end -->

						<form class="top-search-form" action="search.html" method="get">
							<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
						</form>

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->

		<!-- Slider
		============================================= -->
		<section id="slider" class="slider-element swiper_wrapper" data-autoplay="6000" data-speed="800" data-loop="true" data-grab="true" data-effect="fade" data-arrow="false" style="height: 600px;">

			<div class="swiper-container swiper-parent">
				<div class="swiper-wrapper">
					<div class="swiper-slide dark">
						<div class="container">
							<div class="slider-caption slider-caption-center">
								<div>
									<div class="h5 mb-2 font-secondary"></div>
									<h2 class="mb-4 text-white"></h2>
									<a href="#" class="button bg-white text-dark button-light"></a>
								</div>
							</div>
						</div>
						<div class="swiper-slide-bg" style="background-image: url('{{asset('/')}}img/banner1.jpg');"></div>
					</div>
					<div class="swiper-slide dark">
						<div class="container">
							<div class="slider-caption slider-caption-center">
								<div>
									<div class="h5 mb-2 font-secondary"></div>
									<h2 class="mb-4 text-white"></h2>
									<a href="#" class="button bg-white text-dark button-light"></a>
								</div>
							</div>
						</div>
						<div class="swiper-slide-bg" style="background-image: url('{{asset('/')}}img/banner2.jpg'); background-position: center 20%;"></div>
					</div>
					<div class="swiper-slide dark">
						<div class="container">
							<div class="slider-caption slider-caption-center">
								<div>
									<h2 class="mb-4 text-white"></h2>
									<a href="#" class="button bg-white text-dark button-light"></a>
								</div>
							</div>
						</div>
						<div class="swiper-slide-bg" style="background-image: url('{{asset('/')}}img/banner3.jpg'); background-position: center 40%;"></div>
					</div>
				</div>
				<div class="swiper-pagination"></div>
			</div>

		</section><!-- #Slider End -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container">

	
				<div class="clear"></div>

				<!-- New Arrivals Men
				============================================= -->
				<div class="container">

					<div class="fancy-title title-border mt-4 mb-4 title-center">
						<h4>Produk</h4>
					</div>

					<div class="row col-mb-30">

						@foreach ($dataproduk as $d)
						<!-- Shop Item 1
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<a href="#"><img src="{{$d->foto_url}}" alt="Image 1"></a>
									<a href="#"><img src="{{$d->foto_url}}" alt="Image 1"></a>
								<!--	<div class="sale-flash badge bg-danger p-2">Sale!</div>-->
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="/add-to-cart/{{$d->id}}" class="btn btn-dark me-2" title="Add to Cart"><i class="bi-bag-plus"></i></a>
											<!--<a href="../css/demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="bi-eye"></i></a>-->
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>

								<div class="product-desc">
									<!--<div class="product-title mb-1"><h3><a href="#">{{$d->nama}}</a></h3></div>-->
									<div class="product-title mb-1"><h3><a href="#">{{$d->nama}}</a></h3></div>
									<!--<div class="product-price font-primary">Rp. <ins class="money">{{$d->harga}}</ins></div>-->
									<div style=" text-align: justify;text-justify: inter-word;"><h6>{{$d->deskripsi}} </h6></div></div>
								<a style="display:block;margin: auto;" href="/add-to-cart/{{$d->id}}" class="button button-3d button-small m-0"><i class="bi-bag-plus m-0"></i></a>

							</div>
						</div>

						@endforeach

		

					</div>

				</div>

				<!-- Sign Up
				============================================= -->
				<!--<div class="section my-4 py-5">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="row align-items-stretch align-items-center">
									<div class="col-md-7 min-vh-50" style="background: url('../css/demos/shop/images/sections/3.jpg') center center no-repeat; background-size: cover;">
										<div class="vertical-middle ps-5">
											<h2 class="ps-5"><strong>40%</strong> Off<br>First Order*</h2>
										</div>
									</div>
									<div class="col-md-5 bg-white">
										<div class="card border-0 py-2">
											<div class="card-body">
												<h3 class="card-title mb-4 ls-0">Sign up to get the most out of shopping.</h3>
												<ul class="iconlist ms-3">
													<li><i class="bi-check-circle"></i> Receive Exclusive Sale Alerts</li>
													<li><i class="bi-check-circle"></i> 30 Days Return Policy</li>
													<li><i class="bi-check-circle"></i> Cash on Delivery Accepted</li>
												</ul>
												<a href="#" class="button button-rounded ls-0 fw-semibold ms-0 mb-2 text-transform-none px-4">Sign Up</a><br>
												<small class="fst-italic text-black-50">Don't worry, it's totally free.</small>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>-->



				<div class="clear"></div>



		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" class="bg-transparent border-0">

			

			<!-- Copyrights
			============================================= -->
			<div id="copyrights" class="bg-transparent">

				<div class="container">

					<div class="row justify-content-between align-items-center">
						<div class="col-md-6">
							Copyrights &copy; 2023 All Rights Reserved by Las Nyoto.<br>
							<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
						</div>

						<div class="col-md-6 d-md-flex flex-md-column align-items-md-end mt-4 mt-md-0">
							<div class="copyrights-menu copyright-links">
								<a href="#">About</a>/<a href="#">Features</a>/<a href="#">FAQs</a>/<a href="#">Contact</a>
							</div>
						</div>
					</div>

				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="bi-arrow-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="../js/functions.js"></script>

		<!-- jQuery -->
	<script src="{{asset('/')}}plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{asset('/')}}plugins/jquery-ui/jquery-ui.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
	$(document).ready(function(){
		// Format mata uang.
		$('.money').mask('0.000.000.000', {reverse: true});
	  })
	</script>
</body>
</html>