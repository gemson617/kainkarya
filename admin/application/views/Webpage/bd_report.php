<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">10 BD Report</h3>
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo base_url('home/BD_Report') ?>" method="post">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="firstName">Financial Year</label>
                                        <select name="year" id="year" class="form-control">
                                            <?php $trust_year= $yr=$this->mcommon->specific_row_value('company_setting','','current_financial_year'); ?>
                                            <!-- <option value="">---select---</option> -->
                                            <?php foreach ($year as $key => $y) {
                        if(isset($sel_year)){
                          ?>
                                            <option value="<?php echo $y['year']; ?>"
                                                <?php echo ($y['year']==$sel_year) ? 'selected':''; ?>>
                                                <?php echo $y['year']; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $y['year']; ?>"
                                                <?php echo ($y['year']==$trust_year) ? 'selected':''; ?>>
                                                <?php echo $y['year']; ?></option>
                                            <?php } } ?>

                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="firstName">Select</label>
                                        <select name="option" id="option" onchange="selectOption(this.value)" class="form-control">
                                            <option value=''>--Select--</option>
                                            <option <?php echo ($option==1) ? 'selected':''; ?> value="1">Detailed</option>
                                            <option <?php echo ($option==2) ? 'selected':''; ?> value="2">Summary</option>

                                        </select>
                                    </div>

                                </div>
                                <br>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    <!-- END INPUT GROUPS -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" id="detailed">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">10 BD Reports</h3>

                            <?php
              $mnth=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                    $typ=array('',"Monthly","Corpus"," One Time");
                    $typ1=array('',"Others","Corpus","Others");
                    $pay_mode=array('','Cash','Electronic modes including account payee cheque/draft','Electronic modes including account payee cheque/draft','NEFT');
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
                        </div>

                        <?php

$donationArr=array("id_code"=>array(),"pan_num"=>array(),"name"=>array(),"type"=>array(),"mode"=>array(),"amount"=>array(),"receipt"=>array(),"date"=>array(),"month"=>array());
foreach($donation_result as $key=>$row){
  foreach($row as $ky=>$vl){
    array_push($donationArr['id_code'],1);
    array_push($donationArr['pan_num'],$vl->panNumber);
    array_push($donationArr['name'],$vl->name);
    array_push($donationArr['type'],$vl->corpusFund);
    array_push($donationArr['mode'],$vl->paymentMode);
    array_push($donationArr['amount'],$vl->amount);
    array_push($donationArr['recipt'],$vl->receipt_number);
    array_push($donationArr['date'],$vl->receipt_date);   
    array_push($donationArr['month'],$vl->receipt_month);    
  }
}


foreach($online_donation_result as $keys=>$rows){
  foreach($rows as $ky=>$vl){
    array_push($donationArr['id_code'],1);
    array_push($donationArr['pan_num'],$vl->panNumber);
    array_push($donationArr['name'],$vl->name);
    array_push($donationArr['type'],$vl->corpusFund);
    array_push($donationArr['mode'],$vl->paymentMode);
    array_push($donationArr['amount'],$vl->amount);
    array_push($donationArr['recipt'],$vl->transNumber);
    array_push($donationArr['date'],$vl->receipt_date);   
    array_push($donationArr['month'],$vl->receipt_month);    
  }
}

$don_cnt=$this->mcommon->record_counts('donation');
$don_cnt1=$this->mcommon->record_counts('online_donation');

$data=array();
foreach($donationArr as $key=>$val){
  $data[$key]=$val; 
}
?>

  <!-- onclick="tableToExcel('dmstables2', 'W3C Example Table')" -->
                        <button style="float: right;" type="submit" name="submit" class="btn btn-primary" id="excel1"
                           >Export to Excel</button>
                        <div class="panel-body">
                            <?php //print_r($users); ?>
                            <table id="dmstable" class="table table-bordered" style="display: none;">
                                <thead>
                                    <tr>
                                        <th>Id Code</th>
                                        <th>Unique Identification Number</th>
                                        <th>Name of Donor</th>
                                        <!-- <th>Address of Donor</th> -->
                                        <th>Donation Type</th>
                                        <th>Mode of receipt</th>
                                        <th>Amount of donation</th>
                                        <th>Receipt No</th>
                                        <th>Receipt Date</th>
                                        <!-- <th>Address </th> -->
                                        <!--  <th>Status</th> -->
                                        <!-- <th>Month</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                      //$j=0;
                   foreach($donation_result as $key=>$row){                      
                       foreach($row as $ky=>$vl){
                       
                    ?>
                                    <tr>
                                        <td><?php echo 1; ?></td>
                                        <td><?php echo $vl->panNumber; ?></td>
                                        <td><?php echo $vl->name; ?></td>
                                        <!-- <td><?php //echo $vl->address; ?></td> -->
                                        <td><?php echo $typ[$vl->corpusFund]; ?></td>
                                        <td><?php echo $pay_mode[$vl->paymentMode]; ?></td>
                                        <td style="text-align: right;"><?php echo $vl->amount; ?></td>
                                        <td><?php echo $vl->receipt_number; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($vl->receipt_date)); ?></td>
                                        <!-- <td><?php //echo $mnth[$vl->receipt_month]; ?></td> -->
                                    </tr>

                                    <?php  } } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <!-- END INPUT GROUPS -->
                </div>
                
                <div class="col-md-12" id='tab-div' style="display: none;">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Summary</h3>
                        </div>
                        <button style="float: right;" type="submit" name="submit" class="btn btn-primary" id="excel">Export to Excel</button>           
                        <div class="panel-body">
                          
                            <table id="dmstable1" class="table table-responsive">
                                <thead>
                                    <tr>
                                    <th>Id Code</th>
                                        <th>Unique Identification Number</th>
                                        <th>Name of Donor</th>                                      
                                        <th>Donation Type</th>
                                        <th>Mode of receipt</th>
                                        <th>Amount of donation</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
              
                                    // print_R($summaryArr);
                                      foreach($summaryArr as $row){ 
                                      // foreach($row as $vl){
                                        ?>

                                    <tr>
                                        <td><?php echo 1; ?></td>
                                        <td><?php echo $row->panNumber; ?></td>
                                        <td><?php echo $row->firstName.' '.$row->lastName; ?></td>
                                        <td><?php echo $typ[$row->corpusFund]; ?></td>  
                                        <td><?php echo $pay_mode[$row->mode]; ?></td>                                      
                                        <td style="text-align: right;"><?php echo $row->amount; ?></td>
                                    </tr>
                                    <?php } //} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                





                <div class="col-md-12" id='tab-div' style="display: none;">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Donation</h3>
                        </div>
                        <div class="panel-body">
                            <table id="dmstables2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id Code</th>
                                        <th>Unique Identification Number</th>
                                        <th>Name of Donor</th>
                                        <th>Address of Donor</th>
                                        <th>Donation Type</th>
                                        <th>Mode of receipt</th>
                                        <th>Amount of donation</th>
                                        <th>Receipt No</th>
                                        <th>Receipt Date</th>
                                        <!-- <th>Address </th> -->
                                        <!--  <th>Status</th> -->
                                        <!-- <th>Month</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                    
                    foreach($donation_result as $key=>$row){
                        foreach($row as $ky=>$vl){
                    ?>
                                    <tr>
                                        <td><?php echo 1; ?></td>
                                        <td><?php echo $vl->panNumber; ?></td>
                                        <td><?php echo $vl->name; ?></td>
                                        <td><?php echo $vl->address; ?></td>
                                        <td><?php echo $typ1[$vl->corpusFund]; ?></td>
                                        <td><?php echo $pay_mode[$vl->paymentMode]; ?></td>
                                        <td><?php echo $vl->amount; ?></td>
                                        <td><?php echo $vl->receipt_number; ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($vl->receipt_date)); ?></td>
                                        <!-- <td><?php //echo $mnth[$vl->receipt_month]; ?></td> -->
                                    </tr>

                                    <?php } } 
                    
                
                    
                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php 
//echo "testttt";
//print_r($online_donation_result);

//print_r($donationArr);
?>

            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>

<div class="col-md-12" id='tab-div1' style="display: none;">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Summary</h3>
                        </div>
                        <button style="float: right;" type="submit" name="submit" class="btn btn-primary" id="excel">Excel</button>           
                        <div class="panel-body">
                          
                            <table id="dmstable1" class="table table-responsive">
                                <thead>
                                    <tr>
                                    <th>Id Code</th>
                                        <th>Unique Identification Number</th>
                                        <th>Name of Donor</th>  
                                        <th>Address</th>                                    
                                        <th>Donation Type</th>
                                        <th>Mode of receipt</th>
                                        <th>Amount of donation</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
              
                                    // print_R($summaryArr);
                                      foreach($summaryArr as $row){ 
                                      // foreach($row as $vl){
                                        ?>

                                    <tr>
                                        <td><?php echo 1; ?></td>
                                        <td><?php echo $row->panNumber; ?></td>
                                        <td><?php echo $row->firstName.' '.$row->lastName; ?></td>
                                        <td><?php echo $row->address; ?></td>
                                        <td><?php echo $typ1[$row->corpusFund]; ?></td>  
                                        <td><?php echo $pay_mode[$row->mode]; ?></td>                                      
                                        <td style="text-align: right;"><?php echo $row->amount; ?></td>
                                    </tr>
                                    <?php } //} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script>

<?php
if(isset($option)){ ?>
selectOption(<?php echo $option; ?>);
<?php } ?>


  function selectOption(val){
    if(val==1){
      $('#detailed').show();
      $('#dmstable').show();
      $('#tab-div').hide();
    }else{
      $('#detailed').hide();
      $('#tab-div').show();
      $('#dmstable').hide();
    }
  }

$("#dmstable1").dataTable({
  "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
 // order: [[7, 'asc']],
    dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
});



$('#excel').on('click', function() {

    setTimeout(() => {
      var year=$('#year').val();
    let table = document.getElementsByTagName("table");
    TableToExcel.convert(table[3], { // html code may contain multiple tables so here we are refering to 1st table tag
      name: "10_BD_Report_Summary_"+year+"_<?php echo date('d-m-Y'); ?>.xlsx", // fileName you could use any name
      sheet: {
        name: 'Sheet 1' // sheetName
      }
    });
   // $('#dmstables2').hide();
    }, 1000);

});


$('#excel1').on('click', function() {

setTimeout(() => {
  var year=$('#year').val();
let table = document.getElementsByTagName("table");
TableToExcel.convert(table[2], { // html code may contain multiple tables so here we are refering to 1st table tag
  name: "10_BD_Report_Detailed_"+year+"_<?php echo date('d-m-Y'); ?>.xlsx", // fileName you could use any name
  sheet: {
    name: 'Sheet 1' // sheetName
  }
});
// $('#dmstables2').hide();
}, 1000);

});

function delete_user(id) {
    if (confirm("Are you sure you want to delete..?") == true) {
        $.ajax({
            url: "<?php echo site_url() ?>home/delete_user",
            method: "POST",
            type: "ajax",
            data: {
                "id": id
            },
            success: function(result) {
                window.location.reload();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
}

var tableToExcel = (function() {


    var year = $('#year').val();
    var month = $('#month').val();
    var mnth = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var filename = '';
    var year1 = year.split('-');
    filename = "KCT_Donation_List_" + year + "_<?php echo date('d-m-Y'); ?>";

    var uri = 'data:application/vnd.ms-excel;base64,',
        template =
        '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
        base64 = function(s) {
            return window.btoa(unescape(encodeURIComponent(s)))
        },
        format = function(s, c) {
            return s.replace(/{(\w+)}/g, function(m, p) {
                return c[p];
            })
        }
    return function(table, name) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {
            worksheet: name + "test" || 'Worksheet',
            table: table.innerHTML
        }
        var a = document.createElement('a');
        a.href = uri + base64(format(template, ctx))
        a.download = filename + '.xls';
        //triggering the function
        a.click();

        //window.location.href = uri + base64(format(template, ctx))
    }
    // setTimeout(() => {
    //   $('.hidecol').show();
    // }, 1000);

})()
</script>