<style>
#pageloader
{
  background: rgba( 255, 255, 255, 0.8 );
  display: none;
  height: 100%;
  position: fixed;
  width: 100%;
  z-index: 9999;
}

#pageloader img
{
  left: 50%;
  margin-left: -32px;
  margin-top: -32px;
  position: absolute;
  top: 50%;
}
</style>


<?php /* foreach ($donation as  $d) {
   $id = $d->donation_id;
}*/
foreach ($setting as $s) {

  $prefix=$s->receipt_prefix;
  $fin_year=$s->current_financial_year;
  
} 

$count_no= $this->mcommon->specific_record_counts('donation',array('financial_year' => $fin_year, ));
$fin_data= $this->mcommon->records_all('financial_year',array('year' => $fin_year, ));

foreach ($fin_data as  $fd) {
    $pre_number = $fd->pre_number;

}

$re_number=$pre_number+$count_no+1;
?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                         <h3 class="panel-title">Donation</h3>
                     </div>
                     <div class="panel-body">
                        <?php
                        if ($this->session->flashdata('alert_success')) {
                            ?>
                            <div class="alert alert-success alert-dismissible " role="alert">
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
                            <div class="alert alert-warning alert-dismissible " role="alert">
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
                        <form action="<?php echo base_url('donation/donation') ?>" method="post">
                            <div class="form-group row ">
                                <div class="col-md-6">
                                  <label for="donateMonthly">Users</label>
                                  <label class="checkbox-inline">
                                      <input type="radio" name="user" id="user" value="1" onclick="get_type(this.value)"> New
                                  </label>
                                  <label class="checkbox-inline">
                                      <input type="radio"  name="user" id="user" value="2"onclick="get_type(this.value)"> Existing
                                  </label>
                              </div>
                              <div class="col-md-6">
                                <label for="receipt_number">Receipt Number</label>
                                <input type="text" name="receipt_number" value=""  class="form-control">
                            </div>

                        </div> 
                        <div class="form-group row ">
                            <div class="col-md-6">
                                <label for="">Receipt Month</label>
                                <select name="receipt_month" class="form-control"required>
                                    <option value="">-- Month --</option>
                                    <option value="1">Jan</option>
                                    <option value="2">Feb</option>
                                    <option value="3">Mar</option>
                                    <option value="4">Apr</option>
                                    <option value="5">May</option>
                                    <option value="6">Jun</option>
                                    <option value="7">Jul</option>
                                    <option value="8">Aug</option>
                                    <option value="9">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                        </div>
                        <div class="col-md-6">
                            <label>Financial Year</label>
                            <input type="text" name="financial_year" value="<?php echo $fin_year; ?>" class="form-control" readonly>
                            <!-- <select name="financial_year" class="form-control">
                                <option value="">----Year----</option>
                                <?php 
                                foreach ($fin_year as  $y) {
                                    ?>
                                    <option value="<?php echo $y['year'];?>"><?php echo $y['year'];?></option>
                                    <?php 
                                }
                                ?>
                            </select> -->
                        </div>
                    </div>
                    <div class="form-group" id="users_name" style="display:none;">
                        <label for="corpusFund"> Select Your Users</label>
                        <select  name="user_id" class="form-control " onchange="get_users(this.value)" >
                            <option value="">---select---</option>
                            <?php foreach ($users_list as $row) {?>
                                <option value="<?php echo $row->id; ?>"><?php echo $row->firstName." ".$row->lastName; ?></option>
                            <?php }  ?>
                        </select>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control " name="firstName" id="firstName" placeholder="First Name" value="" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control " name="lastName" id="lastName" placeholder="Last Name" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control " value="" placeholder="Email Address" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="mobileNo">Mobile Number</label>
                        <input type="text" name="mobileNo" id="mobileNo" class="form-control" value="" placeholder="Mobile Number" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control" placeholder="Address" style="height: 100px;" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="panNumber">PAN Number</label>
                        <input type="text" name="panNumber" id="panNumber" class="form-control " value="" placeholder="PAN Number" autocomplete="off" required>
                    </div>
                       <!--  <div class="form-group">
                            <label for="donateMonthly">Donate Monthly</label>
                            <label class="checkbox-inline">
                              <input type="radio"  name="donateMonthly" id="donateMonthly1" value="1" <?= ($donateMonthly == 1) ? 'checked' : '' ?>> Yes
                          </label>
                          <label class="checkbox-inline">
                              <input type="radio"  name="donateMonthly" id="donateMonthly2" value="2" <?= ($donateMonthly == 2) ? 'checked' : '' ?>> No
                          </label>
                      </div> -->

                      <div class="form-group">
                        <label for="amount">Donation Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control " placeholder="Donation Amount" autocomplete="off"  value="<?= $amount ?>" required>
                    </div>  
                    <div class="form-group">
                        <label for="corpusFund">Donation Type</label>
                        <select name="donation_type" class="form-control" required>
                            <option value="">---select---</option>
                            <option value="1">Monthly</option>
                            <option value="2">Corpus</option>
                            <option value="3">One Time</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="paymentMode">Mode of Payment</label>
                        <br />
                        <label class="checkbox-inline">
                          <input type="radio" name="paymentMode"  id="paymentMode1" value="1" <?= ($paymentMode == 1) ? 'checked' : '' ?>> Cash
                      </label>

                      <label class="checkbox-inline">
                          <input type="radio" name="paymentMode" id="paymentMode2" value="2" <?= ($paymentMode == 2) ? 'checked' : '' ?>> Online
                      </label>

                      <label class="checkbox-inline">
                          <input type="radio" name="paymentMode" id="paymentMode3" value="3" <?= ($paymentMode == 3) ? 'checked' : '' ?>> Cheque
                      </label>

                      <label class="checkbox-inline">
                          <input type="radio" name="paymentMode" id="paymentMode3" value="4" <?= ($paymentMode == 4) ? 'checked' : '' ?>> NEFT
                      </label>
                  </div> 
                  <div class="form-group row">
                    <div class="col-md-4">
                        <label for="transNumber">Trans/Cheque Number</label>
                        <input type="text" name="transNumber" class="form-control " value="<?= $transNumber ?>" placeholder="Number" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label for="transDate">Transaction/Cheque Date</label>
                        <input type="date" name="transDate" class="form-control " value="<?= $transDate ?>" placeholder="Date" autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label for="transBank">Bank & Branch Name</label>
                        <input type="text" name="transBank" class="form-control" value="<?= $transBank ?>" placeholder="Bank & Branch" autocomplete="off">
                    </div>
                </div> 
                <div class="form-group ">
                    <label for="remarks">Remarks</label>
                    <textarea class="form-control" rows="3" name="remarks" placeholder=" Enter Remarks "></textarea>
                       <!--  <input type="text" name="remarks" id="remarks" class="form-control " placeholder="Remarks " > -->
                </div>
                <br>
            <!--     <input type="hidden" name="created_by" value="<?= $this->session->userdata('user_id'); ?>">
            -->
            <input type="hidden" name="donation_id" value="<?= $donation_id ?>">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>

        </form>
        <hr />
        <p align="center"><b>(OR)</b></p>
        <hr />
        <form action="<?php echo base_url('donation/donation_import'); ?>" method="post" enctype="multipart/form-data" id="myform">

        <div class="row form-group">
                <label class="col-md-2">Select file </label>
                <div class="col-md-4"><input type="file" name="file" id="donationFile" class="form-control" accept=".csv"></div>
                <div class="col-md-6"><input style="float: right;" type="submit" name="SubmitImport" value="Import Donation" class="btn btn-primary"></div>                
            </div>
            <label class="pull-right"><a href="<?php echo base_url('donation/exportCSV'); ?>">Download CSV File</a></label>
            <div class="form-group">

            </div>
        </form>
         <!--<form action="<?php echo base_url('donation/updateDate'); ?>" method="post" enctype="multipart/form-data" id="myform">-->

         <!--                       <div class="row form-group">-->
         <!--                           <label class="col-md-2">Select file </label>-->
         <!--                           <div class="col-md-4"><input type="file" name="file" id="donationFile" class="form-control" accept=".csv"></div>-->
         <!--                           <div class="col-md-6"><input style="float: right;" type="submit" name="SubmitImport" value="Update Date" class="btn btn-primary"></div>-->
         <!--                       </div>                                -->
         <!--                   </form>-->
    </div>
</div>
<!-- END INPUT GROUPS -->
</div>
</div>
</div>
</div>
<!-- END MAIN CONTENT -->
</div>
<div id="pageloader">
   <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." />
</div>
<!--  <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script> 
<script>
$(document).ready(function(){
  $("#myform").on("submit", function(){
    $("#pageloader").fadeIn();
  });//submit
});
</script>
<script type="text/javascript">
    $(function () {
      $("#select1").select2();
  });
 // In your Javascript (external .js resource or <script> tag)
/* $(document).ready(function() {
  $('#select1').select2();
});*/
</script>
<script>
    function get_users(user_id){

        $.ajax({
            url: "<?php echo site_url() ?>home/get_userdata",
            method: "POST",
            type: "ajax",
            data: {
                user_id: user_id
            },
            success: function(result) {
                var data = JSON.parse(result);

                $('#firstName').val(data[0].firstName);
                $('#lastName').val(data[0].lastName);
                $('#email').val(data[0].email);
                $('#mobileNo').val(data[0].mobile);
                $('#address').val(data[0].address);
                $('#panNumber').val(data[0].pan);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    function get_type(value) {

        if (value==2) {
            $('#users_name').show();
        }else{
            $('#users_name').hide();
        }
    }

</script>
