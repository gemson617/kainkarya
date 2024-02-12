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
                <h2>My Profile</h2>

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

            <div class="card" >
                <!-- <h2 class="card-header">My Personal Information</h2> -->
                <div class="card-body" style="padding:0 0">            
                    <div class="specification-table">
                        <form action="<?= base_url('home/Update_profile') ?>" method="post">
                            <!--  <div class="single-row">
                                <span><strong>User Type :</strong>&nbsp;&nbsp;
                                     <label><?php if ($u->auth_level==9) {
                                        echo "Trustee";
                                     }elseif ($u->auth_level==6) {
                                        echo "Managing Trustee";
                                     }elseif ($u->auth_level==8) {
                                        echo "General Council Member";
                                     }elseif ($u->auth_level==7) {
                                        echo "Monthly Contributor ";
                                     }elseif ($u->auth_level==6) {
                                        echo " Other Contributor";
                                     } ?></label>
                               </span>                              
                           </div>  -->             
                           <div class="single-row">
                            <span><strong>First Name<strong style="color:#ff0000;">*</strong></strong>&nbsp;&nbsp;
                                <input type="text" name="firstName" id="firstName" value="<?php echo $u->firstName; ?>" class="input form-control-plaintext" required/></span>

                                <span><strong>Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;
                                    <input type="text" name="lastName" value="<?php echo $u->lastName; ?>" class="input form-control-plaintext"  required/></span>
                                </div>
                                <div class="single-row">
                                    <span><strong>Mobile No.</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="mobile" value="<?php echo $u->mobile; ?>" class="input form-control-plaintext" readonly /></span>

                                        <span><strong>Email Id&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;
                                            <input type="text" maxlength="20" name="email" id="email" value="<?php echo $u->email; ?>" class="input form-control-plaintext" readonly /></span>
                                        </div>
                                        <div class="single-row">
                                            <span><strong>PAN<strong style="color:#ff0000;">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;
                                                <input type="text" name="pan" id="pan" value="<?php echo $u->pan; ?>" class="input form-control-plaintext" required  onblur="pan_check(this.value)"/></span>
                                                <span><strong>Date of Birth</strong>&nbsp;&nbsp;
                                                    <input type="date" name="dob" class="input form-control-plaintext" value="<?php echo $u->dob;?>"  placeholder="dd/mm/yyyy" /></span>

                                                </div> 

                                                <div class="single-row">
                                                    <span><strong>Address<strong style="color:#ff0000;">*</strong></strong>&nbsp;&nbsp;
                                                        <textarea name="address"  class="input form-control-plaintext" required rows="5" cols="40" ><?php echo $u->address; ?></textarea></span>

                                                        <span><strong>About Me</strong>&nbsp;&nbsp;
                                                         <textarea name="about_me"  class="input form-control-plaintext"  rows="5" cols="45"><?php echo $u->about_me; ?></textarea></span>
                                                     </div>


                                                     <input type="hidden" name="user_id" value="<?php echo $u->id; ?>"></input>
                                                     <input type="hidden" name="dob1" value="<?php echo $u->dob; ?>">

                                                     <div class="single-row " align="right" id="submit-btn">
                                                        <!-- <span><a href="javascript:void(0);" class="btn btn-danger" id="cancel-btn" style="float: right;">Cancel</a></span> -->
                                                        <span>
                                                            <input type="submit" name="Submit" value="Update" class="btn btn-primary" style="float: right; margin-left: 0px;" />
                                                        </span>
                                                    </div>
                                                </form>
                                            </div>

                                            <!--   <a href="javascript:void(0);" class="btn btn-secondary" id="edit-profile-btn" style="float: right;">Edit Profile</a> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-5">
                                   <?php include "user-sidebar.php"; ?>
                               </div>
                           </div>
                       </div>
                       <!-- End My Account -->
                       <script type="text/javascript">

                        function pan_check(pan){

                            var panVal = $('#pan').val();
                            var regpan = /^([A-Z]){5}([0-9]){4}([A-Z]){1}?$/;

                            if(regpan.test(pan)){
   // valid pan card number
} else {
    alert('invalid pan card number');
    $('#pan').val('');
   // invalid pan card number
}
}
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script >
    $( document ).ready(function() {
   var pan="<?php echo $u->pan; ?>";//
   var address="<?php echo $u->address; ?>";
   if (pan) {
     
   }else{
      Swal.fire({
          icon: 'info',
          // title: 'Oops...',
          text: 'Update Your PAN Details!',

      })
  }
  if (address) {
     
   }else{
      Swal.fire({
          icon: 'info',
          // title: 'Oops...',
          text: 'Update Your Address Details!',

      })
  }
});
</script>

<?php
include "footer.php";
?>

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

