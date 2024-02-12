<?php
include "header.php";
?>
<style type="text/css">
b, strong {
    font-weight: bold;
}
</style>
<section class="banner-area organic-breadcrumb" style="">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first">
                <h2>Change Password</h2>
                <!-- <nav class="d-flex align-items-center justify-content-start">
                    <a href="<?= base_url('/') ?>">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <a href="#"> change Password</a>
                </nav> -->
            </div>
        </div>
    </div>
</section>

<?php foreach ($user as $key => $u) {
        # code...
}   ?>
<!-- Start My Account -->
<div class="container" style="margin-bottom: 60px !important;">
    <div class="row">
        <div class="col-xl-9 col-lg-8 col-md-7">
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
           <div class="card">
                <!-- <h2 class="card-header">Change Password</h2> -->
                <div class="card-body">            
                    <form action="<?= base_url('home/change_password') ?>" method="post">
                
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control "name="password" id="myInput">
                        </div>
                        <div class="form-group">
                            <label for="pass_confirm">Repeat New Password</label>
                            <input type="password" class="form-control "name="pass_confirm" id="myInput1">
                        </div>
                        <div class="form-group">
                           
                            <input type="checkbox" onclick="myFunction()"> <label>Show Password</label>
                        </div>
                        <br>
                        <!-- <input type="hidden" name="email" value="<?= $auth->email ?>"> -->
                        <button type="submit"  name="Submit" class="btn btn-primary">Reset Password</button>
                    </form>
                </div>
            </div>  

        </div>
        <div class="col-xl-3 col-lg-4 col-md-5">
           <?php include "user-sidebar.php"; ?>
       </div>
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
</script>
<!-- <script>

    $(document).ready(function () {
        
        $('#edit-profile-btn').on('click', function(){

            $(this).addClass('d-none');
            $('#submit-btn').removeClass('d-none');
            $('.input').removeClass('form-control-plaintext').addClass('form-control');
            $('.input').removeAttr('readonly');

        });

        $('#cancel-btn').on('click', function(){
            $('#edit-profile-btn').removeClass('d-none');
            $('#submit-btn').addClass('d-none');
            $('.input').addClass('form-control-plaintext').removeClass('form-control');
            $('.input').addAttr('readonly');
        });

    });
</script>
-->

