<?php foreach ($users_details as $r) {

  $email=$r->email;
  $firstName=$r->firstName;
  $lastName=$r->lastName;
  $mobile=$r->mobile;
  $pan=$r->pan;
  $dob=$r->dob;
  $user_type=$r->auth_level;
  $address=$r->address;
  $about_me=$r->about_me;
  $id=$r->id;
  $created_at=date('Y-m-d',strtotime($r->created_at));

  # code...
} ?>
<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <!-- INPUT GROUPS -->
          <div class="panel">
           <div class="panel-heading">
             <h3 class="panel-title">Edit User Details</h3>
           </div>
           <div class="panel-body">

            <form action="<?= base_url('home/edit_user/0') ?>" method="post">
              <div class="form-group row">
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
                  <div class="alert alert-danger alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                    <strong>ERROR!</strong> <?php echo $this->session->flashdata('alert_danger'); ?>
                  </div>
                  <?php
                }

                if ($this->session->flashdata('alert_warning')) {
                  ?>
                  <div class="alert alert-warning alert-dismissible" role="alert">
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
                <div class="form-group ">                                
                  <label for="firstName">User Type</label>
                  <select name="user_type" class="form-control" >
                    <option value="">----Select ---</option>
                    <option value="9" <?php if ($user_type==9) {
                    echo selected;
                    } ?>>Trustee</option>
                    <option value="6" <?php if ($user_type==6) {
                    echo selected;
                    } ?>>Managing Trustee</option>
                    <option value="8" <?php if ($user_type==8) {
                    echo selected;
                    } ?>>General Council Member</option>
                    <option value="7" <?php if ($user_type==7) {
                    echo selected;
                    } ?>>Monthly Contributor </option>
                    <option value="1" <?php if ($user_type==1) {
                    echo selected;
                    } ?>>Other Contributor</option>
                      <option value="5" <?php if ($user_type==5) {
                    echo selected;
                    } ?>>No Details</option>

                  </select>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">                                
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" class="form-control" placeholder="Enter Your first name" value="<?php echo $firstName; ?>" >
                  </div>

                  <div class="col-md-6">                                
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" class="form-control" placeholder="Enter Your Last name" value="<?php echo $lastName; ?>" >
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter Your  Email" value="<?php echo $email; ?>" >
                  </div>
                  <div class="col-md-6">
                    <label for="email">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" placeholder="Enter Your  Mobile" value="<?php echo $mobile; ?>" >
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="pan">Pan Number</label>
                    <input type="text" name="pan" class="form-control" placeholder="Enter  Pan Number" value="<?php echo $pan; ?>" >
                  </div>

                  <div class="col-md-6">
                    <label for="pass_confirm">Date Of Birth</label>
                    <input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>" >
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="pan">Address</label>
                    <textarea name="address" rows="4" class="form-control"><?php echo str_replace("br",'',$address); ?></textarea>
                  </div>

                  <div class="col-md-6">
                    <label for="pass_confirm">About Me</label>
                    <textarea name="about_me"  rows="4" class="form-control"><?php echo $about_me; ?></textarea>
                  </div>
                </div>
                 <div class="form-group row">
                  <div class="col-md-6">
                     <label for="pass_confirm">Created at</label>
                    <input type="date" name="created_at" class="form-control" value="<?php echo $created_at; ?>" >
                  </div>
                </div>
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $id; ?>">
                 <button type="button" id="resetPwd" name="reset-password" class="btn btn-danger" style="    float: left;">Reset Password</button>&nbsp;
                <button type="submit" name="submit" class="btn btn-primary" style="    float: right;">Update</button>
              </div>
            </form>
          </div>

        </div>
        <!-- END INPUT GROUPS -->
      </div>
    </div>
  </div>   
</div>
</div>     
</div>   
</div>
<!-- END MAIN CONTENT -->
</div>
<script>
  $('#resetPwd').on('click',function(){
    var userid=$('#user_id').val();
    if(confirm("Are you sure want to reset?")===true){
      $.ajax({
            url: "<?php echo site_url() ?>home/resetUserPassword",
            method: "POST",
            type: "ajax",
            data: {
                "userid": userid
            },
            success: function(result) {              
                window.location="<?php echo site_url('home/view_users') ?>";
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    
  })
  </script>
