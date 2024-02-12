
<?php include('header.php'); ?>
<section class="banner-area organic-breadcrumb" style="">
	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center">
			<div class="col-first">
				<h2>OTP Verification</h2>
				
			</div>
		</div>
	</div>
</section>



<!-- Start My Account -->
<div class="container" style="margin-bottom: 60px;">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="login-form style="background: #f8c8aa!important;">
				<!-- <h3 class="billing-title text-center">Login</h3> -->
				<h3 class="text-center mt-10 mb-10">Enter Your OTP </h3>
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
				<form action="<?= base_url('home/otp_verify') ?>" method="post">
					<!--  <label>Enter Your OTP</label> -->
					<input type="text" name="otp" placeholder="Enter Your Otp*"  class="common-input mt-20">
					
					<a href="<?php echo base_url('home/otp_send1') ?>">Resend OTP</a>
					<button class="view-btn color-2 mt-20" type="submit" name="submit"><span>verify</span></button>
					
					
					
				</form>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
<!-- End My Account -->

<?php
include "footer.php";
?>

<?php include('header.php'); ?>
<section class="banner-area organic-breadcrumb" style="">
	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center">
			<div class="col-first">
				<h1>OTP Verification</h1>
				
			</div>
		</div>
	</div>
</section>



<!-- Start My Account -->
<div class="container" style="margin-bottom: 60px;">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="login-form">
				<!-- <h3 class="billing-title text-center">Login</h3> -->
				<h3 class="text-center mt-50 mb-40">Enter Your OTP </h3>
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
				<form action="<?= base_url('home/otp_verify') ?>" method="post">
					<!--  <label>Enter Your OTP</label> -->
					<input type="text" name="otp" placeholder="Enter Your Otp*"  class="common-input mt-20">
					<input type="hidden" name="forget_otp" value="10">
					
					<a href="<?php echo base_url('home/otp_send1') ?>">Resend OTP</a>
					<button class="view-btn color-2 mt-20 w-100" type="submit" name="submit"><span>Verify</span></button>
					
					
					
				</form>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
<!-- End My Account -->

<?php
include "footer.php";
?>
