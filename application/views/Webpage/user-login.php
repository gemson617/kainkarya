
<?php include('header.php'); ?>
<section class="banner-area organic-breadcrumb" style="">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first">
                <h2>User Login</h2>
                <!--  <nav class="d-flex align-items-center justify-content-start">
                    <a href="<?= base_url('/') ?>">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <a href="#">Login</a>
                </nav> -->
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
				<h3 class="text-center mt-10 mb-10">Sign in to Your Account </h3>
				<form action="<?= base_url('auth/login_submit') ?>" method="post">
					<?php
								if ($this->session->flashdata('alert_success')) {
									?>
									<div class="alert alert-success alert-dismissible  " role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<strong>Success!</strong> <?php echo $this->session->flashdata('alert_success'); ?>
									</div>
									<?php
								}

								if ($this->session->flashdata('alert_danger')) {
									?>
									<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<strong>ERROR!</strong> <?php echo $this->session->flashdata('alert_danger'); ?>
									</div>
									<?php
								}

								if ($this->session->flashdata('alert_warning')) {
									?>
									<div class="alert alert-warning alert-dismissible  " role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<strong>Success!</strong> <?php echo $this->session->flashdata('alert_warning'); ?>
									</div>
									<?php
								}
								if (validation_errors()) {
									?>
									<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<?php echo validation_errors(); ?>
									</div>
									<?php
								}
								?>
								<div class="row">
								<input type="text" name="login" placeholder="User Email or Mobile No*" required class="form-control">
					
								</div>
								<br>
								<div class="row">
								<input type="password" name="password" placeholder="Password*" required class="form-control" id="pass_log_id"><span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
					
								</div>
					<!-- </div> -->
					
					<button class="view-btn color-2 mt-20"><span>Login</span></button>
					<div class="mt-20 d-flex align-items-center justify-content-between">
						<div class="d-flex align-items-center"><input type="checkbox" name="remember"  checked  class="pixel-checkbox" id="login-1"><label for="login-1">Remember me</label></div>
						<a style="font-weight: bold" href="<?= base_url('forgetpassword') ?>">Forgot your password?</a>
					</div>
					<br />
					<strong>Don't have an account yet? <a href="<?php echo base_url('/UserRegister'); ?>">Register now</a> </strong>
				</form>
			</div>
		</div>
		<div class="col-md-3"></div>

		<!-- <div class="col-md-6">
			<div class="" align="center" style="padding-top: 50%;">

				<h5>Don't have an account yet? <a href="<?php echo base_url('/UserRegister'); ?>">Register now</a> </h5>
				<img class="img-fluid" src="<?php echo base_url('public/assets/img/header-img.png');?>" alt="">
			</div>
		</div> -->
	</div>
</div>
<!-- End My Account -->

<?php
include "footer.php";
?>
<script type="text/javascript">
	$(document).on('click', '.toggle-password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    
    var input = $("#pass_log_id");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
</script>