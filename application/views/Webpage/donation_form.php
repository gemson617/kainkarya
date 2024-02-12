<?php
include "header.php";
?>
<?php $charges_set	=$this->mcommon->specific_row_value('company_setting','','charges'); ?>

<?php 
foreach ($users as $key => $u) {
   $user_id=$u->id;
   $email=$u->email;
   $firstName=$u->firstName;
   $lastName=$u->lastName;
   $phone=$u->mobile;
   $pan=$u->pan;
   $address=$u->address;
}
// Merchant key here as provided by Payu
$MERCHANT_KEY = "sIBBrT";//live
//$MERCHANT_KEY = "jQHVFz7d";//test

// Merchant Salt as provided by Payu
$SALT = "f4yBgqcuPvi4uA97YInP40JBAUIx4n3d";
//$SALT = "GKfv29UpjV";//test

// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://test.payu.in";
$PAYU_BASE_URL="https://secure.payu.in";
//$txnid = random_string('numeric', 5);
$length = 6;
$characters = 'ABCDEF12345GHIJK6789LMN$%@#&';
$txnid = '';    

for ($p = 0; $p < $length; $p++) {
    $txnid .= $characters[mt_rand(0, strlen($characters))];
}

/*if(!empty($_POST)) {

    $posted['amount'] = $_POST['amount'];
    $posted['phone'] = $_POST['phone'];
    $posted['firstname'] = $_POST['firstname'];
    $posted['email'] = $_POST['email'];
    $posted['key'] = $MERCHANT_KEY;
    $posted['txnid'] = $txnid;
    $posted['productinfo'] = 'This is a Test Product';
    $posted['email'] = $_POST['email'];
    $posted['firstname'] = $_POST['firstname'];
    $posted['phone'] = $_POST['phone'];
    $posted['surl'] = base_url("payumoney/success");
    $posted['furl'] = base_url("payumoney/error");
    $posted['curl'] = base_url("payumoney/cancel");
    $posted['service_provider'] = 'payu_paisa';

}*/
    $surl = base_url("home/pay_success");
    $furl = base_url("home/pay_error");
    $curl = base_url("home/pay_cancel");
    $service_provider = 'payu_paisa';
    $productinfo = 'Donation';

//$hash = '';

// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
//$hash = strtolower(hash('sha512', $txnid));
 $action = $PAYU_BASE_URL . '/_payment';
?>

<section class="banner-area organic-breadcrumb" style="">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first">
                <h2 class="">Donation Form</h2>
                <!-- <nav class="d-flex align-items-center justify-content-start">
                    <a href="#">About Us<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <a href="#">About Us</a>
                </nav> -->
            </div>
        </div>
    </div>
</section>
<!-- Start My Account -->
<div class="container" >
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
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
            <section class="category-area section-gap" id="about-us" style="background: #f8c8aa!important;">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="menu-content"><?php //echo base_url('home/donate'); ?>
                            <form method="post"  class="form-horizontal" action="<?php echo $action; ?>" name="payuForm">

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="firstName">First Name<strong style="color:#ff0000;">*</strong></label>
                                        <input type="text" class="form-control " name="firstName" id="firstName"
                                        placeholder="First Name" value="<?php echo $firstName; ?>" onblur="get_hash()"  required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastname">Last Name<strong style="color:#ff0000;">*</strong></label>
                                        <input type="text" class="form-control " name="lastname" id="lastname"
                                        placeholder="Last Name" value="<?php echo $lastName; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="email">Email Address<strong style="color:#ff0000;">*</strong></label>
                                        <input type="email" name="email" id="email" class="form-control " 
                                        placeholder="Email Address" value="<?php echo $email; ?>" onblur="get_hash()"  required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone">Mobile Number<strong style="color:#ff0000;">*</strong></label>
                                        <input type="text" maxlength="10" onkeyup="checkUser(this.value)" name="phone" id="phone" class="form-control" 
                                        placeholder="Mobile Number" value="<?php echo $phone; ?>"  required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="address2">PAN Number<strong style="color:#ff0000;">*</strong></label>
                                        <input type="text" name="address2" id="address2" class="form-control "
                                        placeholder="PAN Number" value="<?php echo $pan; ?>"  required>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- onblur="get_hash()" -->
                                        <label for="amount">Donation Amount</label>
                                        <input type="text" onchange="getOldAmount(this.value);get_hash()" name="amount" id="amount" class="form-control "
                                        placeholder="Donation Amount"   required>
                                        <input type="hidden" id="originalAMount" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address1">Address<strong style="color:#ff0000;">*</strong></label>
                                    <textarea name="address1" id="address1" class="form-control" placeholder="Address"
                                    style="height: 100px;" required><?php echo $address; ?></textarea>
                                </div>

                               <!--  <div class="form-group ">
                                    <label for="remarks">Remarks</label>
                                    <textarea class="form-control" rows="3" name="remarks"
                                    placeholder=" Enter Remarks "></textarea>
                                   
                                </div> -->
                                <div class="form-group">
                                    <input style="font-size:10px;opacity:0.6;" type="checkbox" name="charges" checked id="charges" onclick="get_hash()">
                                    <label for=""><span style="font-size:10px;opacity:0.6">Service Charges  &nbsp;<b> <?php echo $charges_set; ?>&nbsp;%</span> </b></label>
                                    <br />

                                </div>
                                <br>
                                <input type="hidden" name="key" id="key" value="<?php echo $MERCHANT_KEY; ?>" />
                                <input type="hidden" id="hash" name="hash" value="<?php echo $hash; ?>"/>
                                <input type="hidden" name="txnid" id="txnid" value="<?php echo $txnid; ?>" />

                                <input type="hidden" name="productinfo" id="productinfo" value="<?php echo $productinfo; ?>">
                                <input type="hidden" name="surl" value="<?php echo $surl; ?>" size="64" />
                                <input type="hidden" name="curl" value="<?php echo $curl; ?>" size="64" />
                                <input type="hidden" id="furl" name="furl" value="<?php echo $furl; ?>" size="64" />
                                <input type="hidden" name="service_provider" value="<?php echo $service_provider; ?>" size="64" />
                                <input type="hidden" name="city" id="city">
                                <input type="hidden" name="udf1" id="udf1">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <input type="hidden" name="lastname" value="">
                                <input type="hidden" name="zipcode" value="<?php echo $user_id; ?>">
                                <input type="submit" id="Button"  name="submit" class="btn btn-primary" value="Submit">

                            </form>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10"; -->
<!-- End My Account -->

<script >
     var arr = [];
     var ca = [];
    
     function getOldAmount(val)
     {
        $('#originalAMount').val(Number(val));
        var charges="<?php echo $charges_set; ?>";
        var amount1=$('#amount').val();
        var isChecked = $('#charges').is(':checked');
        if (isChecked){
            var currentAmount = parseFloat($('#amount').val());
            var charges_p = (currentAmount * charges) / 100;
            var tot_amt = currentAmount + charges_p;
            $('#amount').val(tot_amt.toFixed(2));
        }
       
     }
$('#charges').on("change",()=>{
     var charges="<?php echo $charges_set; ?>";
        var amount1=$('#amount').val();
        var originalAmount = parseFloat($('#originalAMount').val());
        console.log("Orginal Amount ="+originalAmount+"\n"+"Amount ="+amount1);
        var isChecked = $('#charges').is(':checked');
        if (isChecked) {
            var currentAmount = parseFloat($('#amount').val());
            var charges_p = (currentAmount * charges) / 100;
            var tot_amt = currentAmount + charges_p;
            $('#amount').val(tot_amt.toFixed(2));
        }else{
            $('#amount').val(originalAmount.toFixed(2));
        }
});



    function get_hash() {
        $('#Button').hide();
        var check = $('#charges:checked').val();
        var charges="<?php echo $charges_set; ?>";
        var amount1=$('#amount').val();

      
        // if(check=='on')
        // {
        //     arr.push(amount1);
        //     var charges_p=Number(amount1)*Number(charges)/Number('100');
        //     var tot_amt=Number(amount1)+Number(charges_p);
        //        $('#amount').val(tot_amt);
             
        //     //$('#udf1').val(charges_p);
        //        arr.push(tot_amt);
        //        ca.push(charges_p);
          
           
        // }else{
        //     arr.pop();
        //     ca.pop();
        // var last_amount=    arr[arr.length - 1];
        // var last_ca=    ca[ca.length - 1];
        
        // $('#amount').val(last_amount);
        // //$('#udf1').val(last_ca);
          
        // }
       
        
        var key=$('#key').val();
        var txnid=$('#txnid').val();
        var amount=$('#amount').val();
        var productinfo=$('#productinfo').val();
        var firstName=$('#firstName').val();
        var email=$('#email').val();
        var salt="<?php echo $SALT; ?>";
        var lastname=$('#lastname').val();
        $('#city').val(lastname);
         $.ajax({
            url:"<?php echo base_url('home/check_hash_pay'); ?>",
            method: "POST",
            type: "ajax",
            data:{
              key:key,
              txnid:txnid,
              amount:amount,
              productinfo:productinfo,
              firstName:firstName,
              email:email,
              salt:salt,
            },success:function(result) {
                var data = JSON.parse(result);
                if(data.length > 0)
                {
                    $('#hash').val(data);
                    $('#Button').show();
                }else{
                    $('#Button').hide();
                }
                

            },error:function (error) {
                console.log(error);
            }
         });
    }

    

   


    function checkUser(mno){
        if(mno.length >=10){
             $('#firstName').val('');
             $('#lastname').val('');
             $('#email').val('');
             $('#address2').val('');
            $.ajax({
            url:"<?php echo base_url('home/checkUser'); ?>",
            method: "POST",
            type: "ajax",
            data:{
             'mobile':mno
            },success:function(result) {
                if(result != 0){
                    var data = JSON.parse(result);
                   //  console.log(data);
                     $('#firstName').val(data[0]);
                    $('#lastname').val(data[1]);
                    $('#email').val(data[2]);
                    $('#address2').val(data[3]);
                    $('#address1').val(data[4])
                }
               
               
            },error:function (error) {
                console.log(error);
            }
         });
        }
    }
</script>
<?php
include "footer.php";
?>