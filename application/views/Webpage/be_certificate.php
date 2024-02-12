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
                <h2>10 BE Certificates</h2>
                <!-- <nav class="d-flex align-items-center justify-content-start">
                    <a href="<?= base_url('/') ?>">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <a href="#">My Receipts</a>
                </nav> -->
            </div>
        </div>
    </div>
</section>
<!-- Start My Account -->
<div class="container" style="margin-bottom: 60px !important;">
  <div class="row">
    <div class="col-xl-9 col-lg-8 col-md-7">
    
     <br>
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
            <!-- <h2 class="card-header">My Receipts</h2> -->
            <form method="POST" action="<?php echo base_url('home/view_certificate') ?>">
            <div class="col-md-4">
                    <label>Financial Year</label>
                    <select name="financial_year" class="form-control">
                    <option>---Select Financial Year---</option>
                    <?php foreach ($financial_year as $key => $y) { ?>
                        <option value="<?php echo $y->year;?>"><?php echo $y->year; ?></option>
                        <?php 
                    }
                    ?>
                    </select>

                </div>
                <input class="btn btn-primary" type="submit" name="submit" value="Search" />
            </form>
                
            
            <div class="card-body">            
                <table class="table table-striped">
                   <thead>
                    <tr>
                     <th>S.No</th>                    
                     <th>Name</th>
                     <th>Financial Year</th>
                     <th>Email</th>                     
                     <th>10 BE Certificates</th>
                 </tr>
             </thead>
          <tbody>
                
                <?php $i=1;foreach ($user_details as  $row) {
          
        ?>
                <tr>
                   <td><?= $i++ ?></td>
                   <td><?php echo $row->firstName. ' ' .$row->lastName; ?></td>
                   <td><?php echo (!empty($row->year)) ? $row->year : ''; ?></td> 
                    <td><?php echo $row->email; ?></td>  
                    <td><a download="<?php echo $row->file_name; ?>" href="<?php echo base_url('./public/adn-assets/img/aid_file_pdf/'.$row->file_name); ?>">Download</a></td>                  
                  
                   
                </tr>
               <?php  } ?>
                 </tbody> 
       </table>
   </div>
</div>
</div>

<div class="col-xl-3 col-lg-4 col-md-5">
   <?php include "user-sidebar.php"; ?>
</div>
</div>
</div>
<!-- End My Account -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php
include "footer.php";
?>

