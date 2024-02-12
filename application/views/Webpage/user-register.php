<?php
include "header.php";
?>
<section class="banner-area organic-breadcrumb" style="">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first">
                <h2>User Registration</h2>
                <!--  <nav class="d-flex align-items-center justify-content-start">
                    <a href="<?= base_url('/') ?>">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <a href="#">Register</a>
                </nav> -->
            </div>
        </div>
    </div>
</section>

<div class="row"></div>
<!-- Start My Account -->
<div class="container" style="margin-bottom: 60px;">
	<div class="row">
		<div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="register-form" style="background: #f8c8aa!important">
                <h3 class="billing-title text-center">Sign Up</h3>
                <p class="text-center mt-10 mb-10 text-blueb">Create Your Own Account </p>
                <div class="panel-body">

                    <form action="<?= base_url('UserRegister') ?>" method="post">
                     <?php
                     if ($this->session->flashdata('alert_success')) {
                        ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Success!</strong> <?php echo $this->session->flashdata('alert_success'); ?>
                        </div>
                        <?php
                    }

                    if ($this->session->flashdata('alert_danger')) {
                        ?>
                        <div class="alert alert-danger alert-dismissible  " role="alert">
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
                        <div class="alert alert-danger alert-dismissible " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <?php echo validation_errors(); ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="form-group row">

                        <div class="col-md-6">                                
                            <label for="firstName" class="text-blue">First Name</label>
                            <input type="text" class="form-control" name="firstName" placeholder="First Name" value="" required>
                        </div>

                        <div class="col-md-6">                                
                            <label for="lastName" class="text-blue">Last Name</label>
                            <input type="text" class="form-control" name="lastName" 
                            placeholder="Last Name" value="" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6"> 
                            <label for="email" class="text-blue">Email</label>
                            <input type="email" class="form-control"
                            name="email" aria-describedby="emailHelp" placeholder="Email" value="" required>
                            <small id="emailHelp" class="form-text text-muted" style="color:#000 !important;"></small>
                        </div>

                        <div class="col-md-6">
                            <label for="number" class="text-blue">Mobile Number</label>
                            <input type="text" class="form-control"
                            name="mobile_number" aria-describedby="emailHelp" placeholder="Phone Number" onkeypress="this.value=this.value.replace(/^0+/, '');return isNumberKey(event);"  maxlength="10" value="" required>
                            <small id="emailHelp" class="form-text text-muted" style="color:#000 !important;"></small>
                        </div>
                    </div>    
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="password" class="text-blue">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="" autocomplete="off" id="myInput" required>
                        </div>

                        <div class="col-md-6">
                            <label for="pass_confirm" class="text-blue">Repeat Password</label>
                            <input type="password" name="pass_confirm" class="form-control" placeholder="Password" autocomplete="off" id="myInput1" required>
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 0px!important;">

                        <input type="checkbox" onclick="myFunction()"> <label>Show Password</label>
                    </div>
                    
                    <button type="submit" name="submit" class="view-btn color-2 float-right"><span>Register</span></button>
                </form>
            </div>
            <div class="clear" style="clear:both"></div>
            <div class="login-form" style="background: none!important;padding: 10px!important;">
                    <h6>Already have Login and Password? <a href="<?php echo base_url('UserLogin'); ?>">Sign in</a></h6>
            </div>
				<!-- <form action="#">
					<input type="text" placeholder="Full name*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Full name*'" required class="common-input mt-20">
					<input type="email" placeholder="Email address*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Email address*'" required class="common-input mt-20">
					<input type="text" placeholder="Phone number*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Phone number*'" required class="common-input mt-20">
					<input type="text" placeholder="Username*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Username*'" required class="common-input mt-20">
					<input type="password" placeholder="Password*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password*'" required class="common-input mt-20">
					<button class="view-btn color-2 mt-20 w-100"><span>Register</span></button>
				</form> -->
			</div>
		</div>
        <div class="col-md-3"></div>
	</div>
</div>
<!-- End My Account -->

<?php
include "footer.php";
?>
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
function isNumberKey(evt)
       {
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if ((charCode < 48 || charCode > 57))
             return false;
         return true;
       }
</script>