
<style type="text/css">
b, strong {
  font-weight: bold;
}
</style>
<section class="banner-area organic-breadcrumb" style="">
  <div class="container">
    <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
      <div class="col-first">
        <h2>Know About Others</h2>
        
      </div>
    </div>
  </div>
</section>
<!-- Start My Account -->
<div class="container" style="margin-bottom: 60px !important;">
  <div class="row">
    <div class="col-xl-9 col-lg-8 col-md-7">
      <div class="card">
        <div class="card-body"> 
          <div class="col-md-5">
            <form action="<?php echo base_url('home/view_users') ?>" method="post"> 
              <div class="row">
                <select name="user_id" class="form-control" >
                  <option>---Select Users ---</option>
                  <?php foreach ($users as  $u) { ?>
                    <option value="<?php echo $u->id;?>"><?php echo $u->firstName; ?>&nbsp;<?php echo $u->lastName; ?></option>
                    <?php 
                  }
                  ?>
                </select>
              </div>
              <br>
              <div class="row">
               <button type="submit" name="submit" class="btn btn-primary">Submit</button>
             </div>
           </form>   
         </div>
       </div>
     </div>
     <br>
     <?php if (!empty($user_details)) { 
      foreach ($user_details as  $row) {

      }
      ?>
      <div class="card">
        <h3 class="card-header"></h3>
        <div class="card-body"> 
          <div class="specification-table">
            <div class="single-row">
              <span><strong>First Name</strong>&nbsp;&nbsp;
                <input type="text" name="firstName" id="firstName" value="<?php echo $row->firstName; ?>" class="input form-control-plaintext" readonly /></span>

                <span><strong>Last Name&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;
                  <input type="text" name="lastName" value="<?php echo $row->lastName; ?>" class="input form-control-plaintext" readonly /></span>
                </div>
                <div class="single-row">

                  <span><strong>About Me</strong>&nbsp;&nbsp;
                   <textarea name="about_me"  class="input form-control-plaintext" readonly rows="5" cols="80"><?php echo $row->about_me; ?></textarea></span>
                 </div>

               </div>           

             </div>
           </div>
         <?php } ?>
       </div>

       <div class="col-xl-3 col-lg-4 col-md-5">
         <?php include "user-sidebar.php"; ?>
       </div>
     </div>
   </div>
   <!-- End My Account -->


