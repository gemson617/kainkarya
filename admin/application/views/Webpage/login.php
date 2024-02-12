<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | Admin Panel</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo base_url('public/adn-assets/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('public/adn-assets/vendor/font-awesome/css/font-awesome.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('public/adn-assets/vendor/linearicons/style.css');?>">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo base_url('public/adn-assets/css/main.css');?>">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?php echo base_url('public/adn-assets/css/demo.css');?>">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('public/adn-assets/img/apple-icon.png');?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('public/adn-assets/img/favicon.png');?>">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center" style="font-size:22px;color:#000080;font-weight: bold;">KAINKARYA CHARITABLE TRUST</div>
								<p class="lead">Login to your account</p>
							</div>
							<form action="<?php echo base_url('auth/login_submit'); ?>" method="post">
								<?php
								if ($this->session->flashdata('alert_success')) {
									?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<strong>Success!</strong> <?php echo $this->session->flashdata('alert_success'); ?>
									</div>
									<?php
								}

								if ($this->session->flashdata('alert_danger')) {
									?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<strong>ERROR!</strong> <?php echo $this->session->flashdata('alert_danger'); ?>
									</div>
									<?php
								}

								if ($this->session->flashdata('alert_warning')) {
									?>
									<div class="alert alert-warning alert-dismissible fade show" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<strong>Success!</strong> <?php echo $this->session->flashdata('alert_warning'); ?>
									</div>
									<?php
								}
								if (validation_errors()) {
									?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<?php echo validation_errors(); ?>
									</div>
									<?php
								}
								?>
								
								<div class="form-group">
									<label>Email</label>
									<input type="text" name="email" class="form-control" placeholder="Enter your Email">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="Password" name="password" class="form-control" placeholder="Enter your Password" id="myInput">
								</div>
								<div class="form-group" style="text-align: left;">
									<input id="chk" type="checkbox" name="remember" value="1">  <label for="chk">Remember Password</label>									
								</div>
								<div class="form-group" style="text-align: left;">
									 <label for='eye'><i id='eye' class="fa fa-eye" onclick="myFunction()"></i> Show Password</label>									
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
								</div>
								
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Just sign into your account to access your preferences, privacy and personalization controls</h1>
							<p></p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
<script>
	function myFunction() {
		var x = document.getElementById("myInput");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
		var y = document.getElementById("myInput1");
		if (y.type === "password") {
			y.type = "text";
		} else {
			y.type = "password";
		}
	}
</script>
</html>
