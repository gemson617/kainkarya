
<?php include('header.php'); ?>
<section class="banner-area organic-breadcrumb" style="">
	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center">
			<div class="col-first">
				<h2>Forgot Password </h2>
				
			</div>
		</div>
	</div>
</section>



<!-- Start My Account -->
<div class="container" style="margin-bottom: 60px;">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="login-form" style="background: #f8c8aa!important;">
				<!-- <h3 class="billing-title text-center">Login</h3> -->
				<h4 class="text-center mt-10 mb-10">Enter Your Email or Mobile Number</h4>
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
				<form action="<?= base_url('forgetpassword') ?>" method="post">
					<!--  <label>Enter Your OTP</label> -->
					<input type="text" name="email" placeholder="Enter Your Email or Mobile Number*"  class="common-input mt-20">
					
					
					<button class="view-btn color-2 mt-20" type="submit" name="submit"><span>Send OTP</span></button>
					
					
					
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
