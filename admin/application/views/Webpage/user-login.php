
<?php include('header.php'); ?>
<section class="banner-area organic-breadcrumb" style="">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first">
                <h1>User Login</h1>
                 <nav class="d-flex align-items-center justify-content-start">
                    <a href="<?= base_url('/') ?>">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <a href="#">Login</a>
                </nav>
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
				<h3 class="text-center mt-50 mb-40">Sign in to your account </h3>
				<form action="<?= base_url('auth/login_submit') ?>" method="post">
					<input type="text" name="login" placeholder="User Email*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Email or Mobile Number*'" required class="common-input mt-20">
					<!-- </div> -->
					<input type="password" name="password" placeholder="Password*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password*'" required class="common-input mt-20" id="pass_log_id"><span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
					
					<button class="view-btn color-2 mt-20 w-100"><span>Login</span></button>
					<div class="mt-20 d-flex align-items-center justify-content-between">
						<div class="d-flex align-items-center"><input type="checkbox" name="remember"  checked  class="pixel-checkbox" id="login-1"><label for="login-1">Remember me</label></div>
						<a href="<?= base_url('UserForgot') ?>">Forgot your password?</a>
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