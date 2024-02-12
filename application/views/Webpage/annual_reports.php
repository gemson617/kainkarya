<?php
include "header.php";
?>
<style type="text/css">
b, strong {
  font-weight: bold;
}
</style>
 <?php foreach ($user_details as $key => $u) {
          $pan=$u->pan;
          $address=$u->address;
        } ?>
<section class="banner-area organic-breadcrumb" style="">
  <div class="container">
    <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
      <div class="col-first">
        <h2>Annual Statements</h2>
        
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
            <form action="<?php echo base_url('home/annual_report') ?>" method="post"> 
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
     
          <?php if (!empty($reports)) { ?>
       <div class="card">
        <h3 class="card-header">Financial Year <?php echo $fin_year ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php if (!empty($pan) && !empty($address)) { ?>
          <a href="<?php echo base_url('home/print_annual/'.$fin_year); ?>" target="_blank">Print</a>
        <?php }else{
                    ?>
                    <a>Print</a>
                    <?php
                  } ?></h3>
        <div class="card-body">            
          <table class="table table-striped">
           <thead>
            <tr>
             <th>S.No</th>
             <th>Date</th>
             <th>Receipt Number</th>
             <th style="text-align: right;">Amount </th>
             <th>Donation Type</th>
             <th>Mode of Payment </th>

           </tr>
         </thead>
         <tbody>

          <?php $i=1; foreach($reports as $row){ ?>
            <tr>
             <td><?php echo $i++; ?></td>
             <td><?php echo date('d-m-Y', strtotime($row->receipt_date)); ?></td>
             <td><?php echo $row->receipt_number; ?></td>
             <td align="right"><?php echo $row->amount; ?></td>
             <td><?php if ($row->corpusFund== 1) {
               echo "Monthly";
             }elseif ($row->corpusFund== 2) {
               echo "Corpus";
             }elseif ($row->corpusFund== 3) {
               echo "One Time";
             } ?></td>
             <td><?php if ($row->paymentMode==1) {
            echo "Cash";
          }elseif ($row->paymentMode==2) {
             echo "Online";
          }elseif ($row->paymentMode==3) {
             echo "Cheque";
          }elseif ($row->paymentMode==4) {
             echo "NEFT";
          } ?></td>

           </tr>
         <?php  } ?>
       </tbody> 
     </table>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script >
    $( document ).ready(function() {
   var pan="<?php echo $pan; ?>";//
   var address="<?php echo $address; ?>";

   if (pan) {
     
   }else{

      Swal.fire({
          icon: 'info',
          // title: 'Oops...',
          text: 'Update Your PAN Details!',

      })
      /*window.location.href = "<?php echo base_url('Profile'); ?>";*/
   
  }
  if (address) {
     
   }else{
      Swal.fire({
          icon: 'info',
          // title: 'Oops...',
          text: 'Update Your Address Details!',

      })
      /*window.location.href = "<?php echo base_url('Profile'); ?>";*/
  }
});
</script>
<?php
include "footer.php";
?>

