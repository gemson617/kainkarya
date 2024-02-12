<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<?php //print_r($this->session->userdata());exit(); 
	?>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="public/assets/img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>KAINKARYA CHARITABLE TRUST</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/linearicons.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/nice-select.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/magnific-popup.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/ion.rangeSlider.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/ion.rangeSlider.skinFlat.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/bootstrap.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/main.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/assets/css/overwrite.css'); ?>">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="<?php echo base_url('public/assets/js/vendor/jquery-2.2.4.min.js'); ?>"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<!-- <script src="<?php echo base_url('public/assets/js/vendor/bootstrap.min.js'); ?>"></script> -->
	<script src="<?php echo base_url('public/assets/js/jquery.ajaxchimp.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/assets/js/jquery.nice-select.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/assets/js/jquery.sticky.js'); ?>"></script>
	<!--  <script src="<?php echo base_url('public/assets/js/jquery.magnific-popup.min.js'); ?>"></script> -->
	<!-- <script src="<?php echo base_url('public/assets/js/owl.carousel.min.js'); ?>"></script>	 -->
	<script src="<?php echo base_url('public/assets/js/main.js'); ?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body>
<?php $marquee=$this->mcommon->specific_row_value('company_setting','','marquee'); ?>
	<!-- Start Header Area -->
	<header class="default-header">
		<div class="menutop-wrap">
			<div class="menu-top container" style="padding: 15px 0;">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<marquee width="90%" direction="left">
							<?php echo $marquee; ?>
						</marquee>
					</div>
				</div>
					<div class="row">
						<div class="col-md-3">
							<a href="https://www.kainkarya.com"><img src="<?php echo base_url('public/assets/img/logo.png'); ?>" alt="KAINKARYA CHARITABLE TRUST" class="logo-img" style="margin-right: 10px;"></a>
						</div>
						<div class="col-md-7">
							<h2 style="margin: 35px 0px 0px 0px;font-size: 40px;">KAINKARYA CHARITABLE TRUST</h2>
						</div>
						<div class="col-md-2">
							<div class="donate-btn"><a href="<?php echo base_url('donate'); ?>" class="">DONATE</a></div>
						</div>
					</div>
					<!-- <div class="d-flex justify-content-between align-items-center">
					<ul class="list">
						<li><h2 style="margin: 0;"><img src="<?php echo base_url('public/assets/img/logo.png'); ?>" alt="KAINKARYA CHARITABLE TRUST" class="logo-img" style="height: 45px;"> KAINKARYA CHARITABLE TRUST</h2></li>
						<li><a href="mailto:support@colorlib.com" class="tab-li-text">kainkaryatrust@gmail.com</a></li>
					</ul>
					<ul class="list">
						<li class="donate-btn"><a href="#donate" class="">DONATE</a></li>
					</ul>
				</div> -->
				</div>
			</div>
			<nav class="navbar navbar-expand-lg  navbar-light" style="padding: 0px!important;">
				<div class="container">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse align-items-center" id="navbarSupportedContent">
						<ul class="navbar-nav">
							<li><a href="<?= base_url(); ?>">Home</a></li>
							<li class="dropdown show">
								<a class="dropdown-toggle"  href="#" id="navbardrop" data-toggle="dropdown" aria-expanded="true">About Us</a>
								<div class="dropdown-menu show" style="display: none;">
									<a class="dropdown-item" onclick="window.location='<?php echo  base_url('AboutUs/1') ?>'" >About Us</a>
									<a class="dropdown-item" href="<?php echo  base_url('AboutUs/2') ?>">Our Inspiration</a>
									<a class="dropdown-item" href="<?php echo  base_url('AboutUs/3') ?>">Our Vision &amp; Mission</a>
									<!-- <a class="dropdown-item" href="<?php // base_url('OurMission') ?>">Our Mission</a> -->
									<a class="dropdown-item" href="<?php echo  base_url('AboutUs/4') ?>">Our Objectives</a>
									<a class="dropdown-item" href="<?php echo  base_url('AboutUs/5') ?>">Our Activities</a>
								</div>
							</li>
							<li><a href="<?= base_url('Trustees') ?>">Trustees</a></li>
							<li><a href="<?= base_url('Guiding') ?>">Governing Council</a></li>
							<li class="dropdown show">
								<a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" aria-expanded="true">Downloads</a>
								<div class="dropdown-menu show" style="display: none;">
									<a class="dropdown-item" href="<?= base_url('DownloadPamphlet') ?>">Pamphlet</a>
									<a class="dropdown-item" href="<?= base_url('DownloadForms') ?>">Forms</a>
								</div>
							</li>
							<li class="dropdown show">
								<a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" aria-expanded="true">Gallery</a>
								<div class="dropdown-menu show" style="display: none;">
									<a class="dropdown-item" href="<?= base_url('Gallery') ?>">Photos</a>
									<a class="dropdown-item" href="<?= base_url('Videos') ?>">Videos</a>
								</div>
							</li>
							<!-- <?php
									$auth_level = $this->session->userdata('auth_level');

									if ($auth_level == 9 || $auth_level == 8) {
									?>
							<li><a href="<?= base_url('home/view_aid') ?>">Aid Upload</a></li>
							<?php } ?> -->
							<?php if ($this->session->userdata('user_id')) {
							?>
								<li><a href="<?= base_url('UserLogin') ?>">My Account </a></li>
								<li><a href="<?= base_url('UserLogout') ?>">Logout </a></li>
							<?php } else { ?>
								<li><a href="<?= base_url('UserLogin') ?>">Login</a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</nav>
	</header>
	<!-- End Header Area -->