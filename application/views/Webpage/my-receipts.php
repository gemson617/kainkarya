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
                <h2>My Receipts</h2>
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
    <div class="card">
        <div class="card-body"> 
          <div class="col-md-4">
            <form action="<?php echo base_url('home/MyReceipts') ?>" method="post"> 
              <div class="row">
               
                <select name="financial_year" class="form-control">
                  <option>---Select Financial Year---</option>
                  <?php foreach ($financial_year as $key => $y) { ?>
                    <option value="<?php echo $y->year;?>"><?php echo $y->year; ?></option>
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
        <?php error_reporting(0); foreach ($user_details as $key => $u) {
          $pan=$u->pan;
          $address=$u->address;
        } ?>
        <div class="card">
            <!-- <h2 class="card-header">My Receipts</h2> -->
            <div class="card-body">            
                <table class="table table-striped">
                   <thead>
                    <tr>
                     <th>Receipt No.</th>
                     <!-- <th>Receipt Month</th> -->
                      <th>Receipt Date</th>
                     <th>Name</th>
                     <th style="text-align: right;">Amount</th>
                     <th>Mode</th>
                    
                     <th>Print</th>
                 </tr>
             </thead>
          <tbody>
                
                <?php foreach($receipt as $row){ ?>
                <tr>
                   <td><?php echo $row->receipt_number; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row->receipt_date)); ?></td>
                  <!--  <td><?php
                    if ($row->receipt_month==1) {
                       echo "Jan";
                   }elseif ($row->receipt_month==2) {
                      echo "Feb";
                   }elseif ($row->receipt_month==3) {
                      echo "Mar";
                   }elseif ($row->receipt_month==4) {
                      echo "Apr";
                   } elseif ($row->receipt_month==5) {
                      echo "May";
                   } elseif ($row->receipt_month==6) {
                      echo "Jun";
                   } elseif ($row->receipt_month==7) {
                      echo "Jul";
                   } elseif ($row->receipt_month==8) {
                      echo "Aug";
                   } elseif ($row->receipt_month==9) {
                      echo "Sep";
                   } elseif ($row->receipt_month==10) {
                      echo "Oct";
                   } elseif ($row->receipt_month==11) {
                      echo "Nov";
                   } elseif ($row->receipt_month==12) {
                      echo "Dec";
                   }    ?></td>-->
                   <td><?php echo $row->firstName. ' ' .$row->lastName; ?></td>
                   <td align="right"><?php echo $row->amount; ?></td> 
                    <td ><?php if ($row->paymentMode==1) {
                            echo "Cash";
                          }elseif ($row->paymentMode==2) {
                             echo "Online";
                          }elseif ($row->paymentMode==3) {
                             echo "Cheque";
                          }elseif ($row->paymentMode==4) {
                             echo "NEFT";
                          } ?></td>
                  
                   <td><?php if (!empty($pan) && !empty($address)) { ?>
                    <a id="a" href="<?php echo base_url();?>Home/PrintMyReceipts/<?php echo $row->donation_id;?>" target="_blank" ><i class="fa fa-print" aria-hidden="true"></i></a>
                  <?php }else{
                    ?>
                    <a><i class="fa fa-print" aria-hidden="false"></i></a>
                    <?php
                  } ?>

                  </td>
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

<script >
    $( document ).ready(function() {
   var pan="<?php echo $pan; ?>";//
   var address="<?php echo $address; ?>";

   if (pan) {
     
   }else{

      // Swal.fire({
      //     icon: 'info',
      //     // title: 'Oops...',
      //     text: 'Update Your PAN Details!',

      // })
      /*window.location.href = "<?php echo base_url('Profile'); ?>";*/
   
  }
  if (address) {
     
   }else{
      //Swal.fire({
      //    icon: 'info',
          // title: 'Oops...',
      //    text: 'Update Your Address Details!',

     // })
      /*window.location.href = "<?php echo base_url('Profile'); ?>";*/
  }
});
</script>
<?php
include "footer.php";
?>

