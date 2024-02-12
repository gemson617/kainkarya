<!doctype html>
<html lang="en">

<head>
	<title><?php echo (isset($title))?$title:'Kainkarya'; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?= base_url('public/adn-assets/vendor/bootstrap/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?= base_url('public/adn-assets/vendor/font-awesome/css/font-awesome.min.css');?>">
	<link rel="stylesheet" href="<?= base_url('public/adn-assets/vendor/linearicons/style.css');?>">
	<link rel="stylesheet" href="<?= base_url('public/adn-assets/vendor/chartist/css/chartist-custom.css');?>">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?= base_url('public/adn-assets/css/main.css');?>">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?= base_url('public/adn-assets/css/demo.css');?>">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('public/adn-assets/img/apple-icon.png');?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('public/adn-assets/img/favicon.png');?>">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="#"><img src="<?= base_url('public/adn-assets/img/logo-dark.png');?>" alt="" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<!-- <li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">5</span>
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
								<li><a href="#" class="more">See all notifications</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#">Basic Use</a></li>
								<li><a href="#">Working With Data</a></li>
								<li><a href="#">Security</a></li>
								<li><a href="#">Troubleshooting</a></li>
							</ul>
						</li> -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?= base_url('public/adn-assets/img/user.png');?>" class="img-circle" alt="Avatar"> <span><?php echo $this->session->userdata('firstName'); ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<!-- <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li> -->
								<!-- <li><a href="<?= base_url('auth/logout') ?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li> -->
								<!-- <li>hii</li> -->
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="<?= base_url('dashboard') ?>" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="<?= base_url('home/register') ?>" class="<?php echo ($segments == 'register') ? 'active' : '';?>"><i class="lnr lnr-user"></i> <span>User Registration</span></a></li>
						<li><a href="<?= base_url('home/donation') ?>" class="<?php echo ($segments == 'donation') ? 'active' : '';?>"><i class="lnr lnr-file-empty"></i> <span>Donation</span></a></li>
						<li><a href="<?= base_url('home/donation_list') ?>" class="<?php echo ($segments == 'donation-list') ? 'active' : '';?>"><i class="lnr lnr-code"></i> <span>Donation List</span></a></li>
						<!-- <li><a href="charts.html" class=""><i class="lnr lnr-chart-bars"></i> <span>Charts</span></a></li>
						<li><a href="panels.html" class=""><i class="lnr lnr-cog"></i> <span>Panels</span></a></li>
						<li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Notifications</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Pages</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="page-profile.html" class="">Profile</a></li>
									<li><a href="page-login.html" class="">Login</a></li>
									<li><a href="page-lockscreen.html" class="">Lockscreen</a></li>
								</ul>
							</div>
						</li>
						<li><a href="tables.html" class=""><i class="lnr lnr-dice"></i> <span>Tables</span></a></li>
						<li><a href="typography.html" class=""><i class="lnr lnr-text-format"></i> <span>Typography</span></a></li>
						<li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li> -->
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->


		<!-- MAIN CONTENT -->

	 <?php echo (isset($content))?$content:''; ?>

		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="<?= base_url('public/adn-assets/vendor/jquery/jquery.min.js');?>"></script>
	<script src="<?= base_url('public/adn-assets/vendor/bootstrap/js/bootstrap.min.js');?>"></script>
	<script src="<?= base_url('public/adn-assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
	<script src="<?= base_url('public/adn-assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js');?>"></script>
	<script src="<?= base_url('public/adn-assets/vendor/chartist/js/chartist.min.js');?>"></script>
	<script src="<?= base_url('public/adn-assets/scripts/klorofil-common.js');?>"></script>
	<script>
	$(function() {
	    
	    $('input:radio[name=donateMonthly]').on('click', function(){
	       
	       if($(this).val() >= 1){
	           $('#amount').removeAttr('readonly');
	       }
	        
	    });
	    
	    $('#amount').keyup(function(){
	        
	       if($(this).val() >=5000 && $('input:radio[name=donateMonthly]:checked').val() == 2) {
	           $('#declaration').css('display', 'block');
	       }else{
	           $('#declaration').css('display', 'none');
	       }
	       
	    });
	    
	

	});
	</script>
</body>

</html>
