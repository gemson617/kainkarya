<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <!-- INPUT GROUPS -->
          <div class="panel">
             <div class="panel-heading">
               <h3 class="panel-title"> User Registration</h3>
                        </div>
            <div class="panel-body">

              <form action="<?= base_url('home/register') ?>" method="post">
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
                    <select name="user_type" onchange="addAttribute(this.value)" class="form-control" required>
                      <option value="">----Select ---</option>
                      <option value="9">Trustee</option>
                      <option value="6">Managing Trustee</option>
                      <option value="8">Governing Council Member</option>
                      <option value="7">Monthly Contributor </option>
                      <option value="1">Other Contributor</option>
                      <option value="5">No Details</option>
                    </select>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-6">                                
                      <label for="firstName">First Name</label>
                      <input type="text" name="firstName" class="form-control" placeholder="Enter Your first name" required="">
                    </div>

                    <div class="col-md-6">                                
                      <label for="lastName">Last Name</label>
                      <input type="text" name="lastName" class="form-control" placeholder="Enter Your Last name" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-6">
                      <label for="email">Email</label>
                      <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your  Email" required>
                    </div>
                    <div class="col-md-6">
                      <label for="email">Mobile Number</label>
                      <input type="text" id="mobile" onkeypress="return isNumberKey(event)"  name="mobile" maxlength="10" class="form-control" placeholder="Enter Your  Mobile" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-6">
                      <label for="password">Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Enter  password" id="myInput" required>
                    </div>

                    <div class="col-md-6">
                      <label for="pass_confirm">Confirm Password</label>
                      <input type="password" name="password1" class="form-control" placeholder="Enter  Confirm password" id="myInput1" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="checkbox" onclick="myFunction()"> <label>Show Password</label>
                  </div>

                  <button type="submit" name="submit" class="btn btn-primary" style="    float: right;">Register</button>
                </div>
              </form>
              <hr />
              <p align="center"><b>(OR)</b></p>
              <hr />
                <form action="<?php echo base_url('home/user_import'); ?>" method="post" enctype="multipart/form-data">

                <div class="row form-group">
                    <label class="col-md-2">Select file</label>
                    <div class="col-md-4"><input type="file" name="file" id="donationFile" class="form-control" accept=".csv" required=""></div>
                    <div class="col-md-6"><input style="float:right" type="submit" name="SubmitImport" value="Import Users Data" class="btn btn-primary"></div><br>                    
                </div>
                <label class="pull-right"><a href="<?php echo base_url('home/exportCSV'); ?>">Download CSV File</a></label>
                <div class="form-group">
                    
                </div>
            </form>
            </div>

          </div>
          <!-- END INPUT GROUPS -->
        </div>
      </div>
    </div>
   <!--  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
         
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Users List</h3>
            </div>
            <div class="panel-body">
              <table id="dmstable" class="table table-striped">
               <thead>
                <tr>
                 <th>S.No</th>
                 <th>Name</th>
                 <th>Mobile Number</th>
                 <th>Email</th>
               </tr>
             </thead>
             <tbody>

              <?php 
              $i=1;
              foreach($users as $row):?>
                <tr>
                 <td><?php echo $i++; ?></td>
                 <td><?php echo $row->firstName. ' ' .$row->lastName; ?></td>
                 <td><?php echo $row->mobile; ?></td>
                 <td><?php echo $row->email; ?></td>
               </tr>
             <?php endforeach; ?>

           </tbody>
         </table>
         
       </table>
     </div>
   </div> -->
   
 </div>
</div>     
</div>   
</div>
<!-- END MAIN CONTENT -->
</div>

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

  function addAttribute(val){
    if(val==5){
      $('#email').removeAttr('required');
      $('#mobile').removeAttr('required');
    }else{
      $('#email').attr('required',true);
      $('#mobile').attr('required',true);
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