<!DOCTYPE html>
<html lang="en-US">

<head>
	<!-- Meta
	============================================= -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, intial-scale=1, max-scale=1">

	<meta name="author" content="ExplicitConcepts">
	<!-- description -->
	<meta name="description" content="e-office Sumedang">
	<!-- keywords -->
	<meta name="keywords" content="e-office Kabupaten sumedang">

	<!-- Stylesheets
	============================================= -->
	<link href="<?php echo base_url() . "asset/e-office/"; ?>css/css-assets.css" rel="stylesheet">
	<link href="<?php echo base_url() . "asset/e-office/"; ?>css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700i,700" rel="stylesheet">

	<!-- Favicon
	============================================= -->
	<link rel="shortcut icon" href="<?php echo base_url() . "asset/e-office/"; ?>images/files/logo.png">
	<link rel="apple-touch-icon" href="images/general-elements/favicon/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/general-elements/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/general-elements/favicon/apple-touch-icon-114x114.png">

	<!-- Title
	============================================= -->
	<title>e-office Sumedang</title>
</head>

<body>

	<div id="scroll-progress">
		<div class="scroll-progress"><span class="scroll-percent"></span></div>
	</div>

	<!-- Document Full Container
	============================================= -->
	<div id="full-container">

		<!-- Header
		============================================= -->
		<header id="header">

			<div id="header-bar-1" class="header-bar">

				<div class="header-bar-wrap">

					<div class="container">
						<div class="row">
							<div class="col-md-12">

								<div class="hb-content">
									<a class="logo logo-header" href="#">
										<img src="<?php echo base_url() . "asset/e-office/"; ?>images/logo-office-sumedang.png" alt="" style="width: 200px;">
										<h3><span class="colored">e-office</span></h3>
										<span>Sumedang</span>
									</a><!-- .logo end -->
									<div class="hb-meta">
									</div><!-- .hb-meta end -->
								</div><!-- .hb-content end -->

							</div><!-- .col-md-12 end -->
						</div><!-- .row end -->
					</div><!-- .container end -->

				</div><!-- .header-bar-wrap -->

			</div><!-- #header-bar-1 end -->

		</header><!-- #header end -->

		<!-- Banner
		============================================= -->
		<section id="banner">

			<div class="banner-parallax" data-banner-height="800">
				<img src="<?php echo base_url() . "asset/e-office/"; ?>images/bg.jpeg" alt="">
				<div class="overlay-colored color-bg-gradient opacity-90"></div><!-- .overlay-colored end -->
				<div class="slide-content">

					<div class="container">
						<div class="row">
							<div class="col-md-7">

								<div class="banner-center-box text-white md-text-center">
									<h1>
										Sumedang Happy Digital Region
									</h1>
									<div class="description">
										Dari Sumedang Untuk Indonesia, Sumedang Satu Data untuk Satu Data Indonesia
									</div>
									<a class="btn-video lightbox-iframe mt-40" href="https://www.youtube.com/watch?v=3Nf8t9fI2nQ">
										<i class="fa fa-play"></i>
										<span class="title">Tonton Video</span>
									</a><!-- .video-btn end -->
								</div><!-- .banner-center-box end -->

							</div><!-- .col-md-7 end -->
							<div class="col-md-5">

								<div class="banner-center-box text-center text-white">
									<div class="cta-subscribe cta-subscribe-2 box-form">
										<div class="box-title text-white">
											<h3 class="title">e-office Sumedang</h3>
											<p>Silakan Login menggunakan akun anda</p>
											<img class="svg" src="<?php echo base_url() . "asset/e-office/"; ?>images/general-elements/section-separators/rounded.svg" alt="">
										</div><!-- .box-title end -->
										<div class="box-content">
											<form id="loginform" method="POST" id="form-cta-subscribe-2" class="form-inline" style="min-height: 300px;">

												<?php if (!empty($pesan)) {
													echo "
                        <div class='alert-danger' style='padding-bottom:20px'>Opps.. $pesan <br></div>
                      ";
												} ?>

												<div class="form-group">
													<label for="cs2Name">Username</label>
													<input type="text" name="username" id="cs2Name" class="form-control" placeholder="">
												</div><!-- .form-group end -->
												<div class="form-group">
													<label for="cs2Email">Password</label>
													<input type="password" name="password" class="form-control" placeholder="">
												</div><!-- .form-group end -->

												<div class="form-group">
													<input type="submit" class="form-control" value="Login">

												</div><!-- .form-group end -->
											</form><!-- #form-cta-subscribe-2 end -->
										</div><!-- .box-content end -->
									</div><!-- .box-form end -->
								</div><!-- .banner-center-box end -->

							</div><!-- .col-md-5 end -->
						</div><!-- .row end -->
					</div><!-- .container end -->

				</div><!-- .slide-content end -->
				<div class="section-separator wave-1 bottom">
					<div class="ss-content">
						<img class="svg" src="<?php echo base_url() . "asset/e-office/"; ?>images/general-elements/section-separators/wave-1.svg" alt="">
					</div><!-- .ss-content -->
				</div><!-- .section-separator -->
			</div><!-- .banner-parallax end -->

		</section><!-- #banner end -->

		<!-- Content
		============================================= -->
		<section id="">

			<div id="content-wrap">

				<!-- === Intro Features =========== -->
				<div id="intro-features" class="flat-section">

					<div class="section-content">

						<div class="container">
							<div class="row">
								<div class="col-md-12">

									<div class="col-md-8 col-md-offset-2">

										<div class="section-title text-center">
											<span>e-office sumedang</span>
											<h2>Dibangun dengan Budaya Gotong Royong</h2>
										</div><!-- .section-title end -->

									</div><!-- .col-md-8 end -->
									<div class="col-md-12">


										<div class="slider-clients">
											<ul class="owl-carousel">
												<li>
													<div class="slide">
														<div class="client-single"><a href="#"><img src="<?php echo base_url() . "asset/e-office/"; ?>images/kolaborasi/bsre.png" alt=""></a></div>
													</div><!-- .slide end -->
												</li>

												<li>
													<div class="slide">
														<div class="client-single"><a href="#"><img src="<?php echo base_url() . "asset/e-office/"; ?>images/kolaborasi/bps.png" alt=""></a></div>
													</div><!-- .slide end -->
												</li>


												<li>
													<div class="slide">
														<div class="client-single"><a href="#"><img src="<?php echo base_url() . "asset/e-office/"; ?>images/kolaborasi/bappenas.png" alt=""></a></div>
													</div><!-- .slide end -->
												</li>

												<li>
													<div class="slide">
														<div class="client-single"><a href="#"><img src="<?php echo base_url() . "asset/e-office/"; ?>images/kolaborasi/big.png" alt=""></a></div>
													</div><!-- .slide end -->
												</li>

												<li>
													<div class="slide">
														<div class="client-single"><a href="#"><img src="<?php echo base_url() . "asset/e-office/"; ?>images/kolaborasi/itb.png" alt=""></a></div>
													</div><!-- .slide end -->
												</li>

												<li>
													<div class="slide">
														<div class="client-single"><a href="#"><img src="<?php echo base_url() . "asset/e-office/"; ?>images/kolaborasi/kemendagri.png" alt=""></a></div>
													</div><!-- .slide end -->
												</li>

												<li>
													<div class="slide">
														<div class="client-single"><a href="#"><img src="<?php echo base_url() . "asset/e-office/"; ?>images/kolaborasi/kemendes.png" alt=""></a></div>
													</div><!-- .slide end -->
												</li>

												<li>
													<div class="slide">
														<div class="client-single"><a href="#"><img src="<?php echo base_url() . "asset/e-office/"; ?>images/kolaborasi/kominfo.png" alt=""></a></div>
													</div><!-- .slide end -->
												</li>

												<li>
													<div class="slide">
														<div class="client-single"><a href="#"><img src="<?php echo base_url() . "asset/e-office/"; ?>images/kolaborasi/menpan.png" alt=""></a></div>
													</div><!-- .slide end -->
												</li>

												<li>
													<div class="slide">
														<div class="client-single"><a href="#"><img src="<?php echo base_url() . "asset/e-office/"; ?>images/kolaborasi/sumedang.png" alt=""></a></div>
													</div><!-- .slide end -->
												</li>






											</ul>
										</div><!-- .slider-clients end -->
									</div>
								</div><!-- .col-md-12 end -->

								<div class="divider-140 divider-md-100"></div>


							</div><!-- .row end -->
						</div><!-- .container end -->

					</div><!-- .section-content end -->

				</div><!-- .flat-section end -->




			</div><!-- #content-wrap -->

		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" style="margin-top: -100px;">



			<div class="footer-bar-wrap">

				<div class="container">
					<div class="row">
						<div class="col-md-12">

							<img src="<?php echo base_url() . "asset/e-office/"; ?>images/bg-smd.png">

						</div><!-- .col-md-12 end -->
					</div><!-- .row end -->
				</div><!-- .container end -->

			</div><!-- .footer-bar-wrap -->



			<div id="footer-bar-2" class="footer-bar">

				<div class="footer-bar-wrap">

					<div class="container">
						<div class="row">
							<div class="col-md-12">

								<div class="fb-row">
									<div class="copyrights-message" style="text-align: center !important;">
										<center>2021 © <a href="https://sumedangkab.go.id" target="_blank"><span class="colored">Pemerintah Kabupaten Sumedang </span></a>. All Rights Reserved.</center>
									</div>

								</div><!-- .fb-row end -->

							</div><!-- .col-md-12 end -->
						</div><!-- .row end -->
					</div><!-- .container end -->

				</div><!-- .footer-bar-wrap -->

			</div><!-- #footer-bar-2 end -->

		</footer><!-- #footer end -->

	</div><!-- #full-container end -->

	<a class="scroll-top-icon scroll-top" href="#"><i class="fa fa-angle-up"></i></a>

	<!-- External JavaScripts
	============================================= -->
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jRespond.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.easing.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.waypoints.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.fitvids.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.stellar.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/owl.carousel.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.mb.YTPlayer.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.ajaxchimp.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/simple-scrollbar.min.js"></script>
	<script src='<?php echo base_url() . "asset/e-office/"; ?>js/functions.js'></script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-F4N9YKWXJL"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag() { dataLayer.push(arguments); }
	gtag('js', new Date());

	gtag('config', 'G-F4N9YKWXJL');
</script>
</body>

</html>
