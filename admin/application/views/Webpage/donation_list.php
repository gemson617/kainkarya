<?php $month=($this->uri->segment(3) > 0) ? $this->uri->segment(3):$month; ?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Donation List</h3>
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
                            <form action="<?php echo base_url('home/donation_list') ?>" method="post">
                                <div class="form-group row">
                                    <div class="col-md-3">

                                        <label for="">Receipt Month</label>
                                        <select name="receipt_month" class="form-control" id="month">
                                            <option value="" selected>-- Month --</option>
                                            <option <?php echo ($month==1) ? 'selected':'' ?> value="1">Jan</option>
                                            <option <?php echo ($month==2) ? 'selected':'' ?> value="2">Feb</option>
                                            <option <?php echo ($month==3) ? 'selected':'' ?> value="3">Mar</option>
                                            <option <?php echo ($month==4) ? 'selected':'' ?> value="4">Apr</option>
                                            <option <?php echo ($month==5) ? 'selected':'' ?> value="5">May</option>
                                            <option <?php echo ($month==6) ? 'selected':'' ?> value="6">Jun</option>
                                            <option <?php echo ($month==7) ? 'selected':'' ?> value="7">Jul</option>
                                            <option <?php echo ($month==8) ? 'selected':'' ?> value="8">Aug</option>
                                            <option <?php echo ($month==9) ? 'selected':'' ?> value="9">Sep</option>
                                            <option <?php echo ($month==10) ? 'selected':'' ?> value="10">Oct</option>
                                            <option <?php echo ($month==11) ? 'selected':'' ?> value="11">Nov</option>
                                            <option <?php echo ($month==12) ? 'selected':'' ?> value="12">Dec</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <?php $yr=$this->mcommon->specific_row_value('company_setting','','current_financial_year'); ?>
                                        <label for="firstName">Financial Year</label>
                                        <select id="year" name="year" class="form-control">
                                            <!-- <option value="">---select---</option> -->

                                            <?php foreach ($year as $key => $y) {
                        if(isset($sel_year)){
                        ?>
                                            <option value="<?php echo $y['year']; ?>"
                                                <?php echo ($y['year']==$sel_year) ? 'selected':''; ?>>
                                                <?php echo $y['year']; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $y['year']; ?>"
                                                <?php echo ($y['year']==$yr) ? 'selected':''; ?>>
                                                <?php echo $y['year']; ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                     <div class="col-md-3">
                                        <label for="">Types</label>
                                        <select name="types" class="form-control" id="types">
                                            <option value="" selected>-- Select --</option>
                                            <option <?php echo ($types==1) ? 'selected':'' ?> value="1">Monthly</option>
                                            <option <?php echo ($types==2) ? 'selected':'' ?> value="2">Corpus</option>
                                            <option <?php echo ($types==3) ? 'selected':'' ?> value="3">One Time</option>
                                            <option <?php echo ($types==4) ? 'selected':'' ?> value="4">Cancelled</option>
                                           
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
                <div class="col-md-12">
                    <!-- INPUT GROUPS onclick="tableToExcel('dmstable2', 'W3C Example Table')" -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Donation List</h3>
                        </div>
                        <button style="float: right;" type="button"
                             name="submit"
                            class="btn btn-primary" id="excel">Export to Excel</button>
                        <div class="panel-body">
                            <table id="dmstable1" class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th style="text-align:right;">Rept No</th>
                                        <th>ReptDate</th>
                                        <th>Userid</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <!-- <th>Email</th> -->
                                        <th style="text-align:right;">Amount</th>
                                        <th>DonType</th>
                                        <th>User Type</th>
                                        <th>Month</th>
                                        <th>Status</th>
                                        <th class="hidecol">Send Mail</th>
                                        <th class="hidecol">Print</th>
                                        <th>Edit</th>
                                        <th class="hidecol">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                 $mnth=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                $i=1; foreach($donation as $row): ?>
                                    <tr style="background:<?= ($row['status']=='0') ? '#e7a8a8':'' ?>;color:<?= ($row['status']=='0') ? 'red':'' ?>">
                                        <td><?php echo $i++; ?></td>
                                        <td align="right"><?php echo $row['receipt_number']; ?></td>
                                        <td><?php echo date('d-m-y', strtotime($row['receipt_date'])); ?></td>
                                        <td><?php echo $row['user_id'].$row['fullname']; ?></td>
                                        <td><?php echo ($row['firstName']==null || $row['firstName']=='') ? $row['Fullname']:strtoupper($row['firstName']. ' ' .$row['lastName']); ?></td>
                                        <td><?php echo $row['mobileNo']; ?></td>
                                        <!--  <td><?php echo $row['email']; ?></td> -->
                                        <td align="right"><?php echo $row['amount']; ?></td>
                                        <td><?php if ($row['corpusFund']==1) {
                                                echo"Monthly";
                                                }elseif($row['corpusFund']==2){
                                                echo "Corpus"; 
                                                }elseif($row['corpusFund']==3){
                                                echo "One Time"; 
                                                } ?></td>
                                                <td>
                                                    <?php 
                                                    $typ=array("1"=>"Other Contributor","9"=>"Trustee","9"=>"Trustee","6"=>"Managing Trustee","8"=>"Governing Council Member","7"=>"Monthly Contributor");
                                                    $level=$this->mcommon->specific_row_value('users',array('id'=>$row['user_id']),'auth_level');
                                                    echo $typ[$level];
                                                    ?>
                                                </td>
                                        <td><?php echo $mnth[$row['receipt_month']]; ?></td>
                                        <td><?= ($row['status']=='0') ? 'Cancelled':'Active' ?></td>
                                        <td class="hidecol"><a
                                                href="<?php echo base_url();?>Home/sendmail/<?php echo $row['donation_id'].'/'.$row['receipt_month'];?>"><i
                                                    class="fa fa-telegram" style="font-size:18px;color:blue"
                                                    aria-hidden="true"></i></a></td>
                                        <td class="hidecol">
                                            <a href="<?php echo base_url();?>Home/PrintMyReceipts/<?php echo $row['donation_id'];?>"
                                                target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                        <a href="javascript:void(0)"
                                                onclick="editRecipt('<?php echo $row['donation_id'];?>')"><i
                                                    class="fa fa-edit" aria-hidden="true"></i></a>
                                        </td>
                                        <td class="hidecol"><a
                                                href="<?php echo base_url();?>Home/delete_receipt/<?php echo $row['donation_id'].'/'.$row['receipt_month'];?>"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <!-- <?= '/home/PrintMyReceipts/'.$row['donation_id'] ?> -->
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <!-- END INPUT GROUPS -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<table id="dmstable2" class="table table-striped" style="display: none;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th style="text-align:right;">Rept No</th>
                                        <th>ReptDate</th>
                                        <th>Userid</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <!-- <th>Email</th> -->
                                        <th style="text-align:right;">Amount</th>
                                        <th>DonType</th>
                                        <th>Month</th>   
                                        <th>Status</th>                                     
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                   
                 $mnth=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                $i=1; foreach($donation as $row): ?>
                                    <tr >
                                        <td><?php echo $i++; ?></td>
                                        <td style="text-align: right;" align="right"><?php echo (int)str_replace("'",'',$row['receipt_number']); ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($row['receipt_date'])); ?></td>
                                        <td><?php echo $row['user_id']; ?></td>
                                        <td><?php echo ($row['firstName']==null || $row['firstName']=='') ? $row['Fullname']:strtoupper($row['firstName']. ' ' .$row['lastName']); ?></td>
                                        <td><?php echo $row['mobileNo']; ?></td>
                                        <!--  <td><?php echo $row['email']; ?></td> -->
                                        <td style="text-align: right;" align="right"><?php echo (int)str_replace("'",'',$row['amount']); ?></td>
                                        <td><?php if ($row['corpusFund']==1) {
                   echo"Monthly";                  
                 }elseif($row['corpusFund']==2){
                  echo "Corpus"; 
                }elseif($row['corpusFund']==3){
                  echo "One Time"; 
                } ?></td>
                                        <td><?php echo $mnth[$row['receipt_month']]; ?></td>

                                        <td><?= ($row['status']=='0') ? 'Cancelled':'Active' ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <!-- <?= '/home/PrintMyReceipts/'.$row['donation_id'] ?> -->
                                </tbody>
                            </table>

<!--  model -->
<div class="modal fade" id="editmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header p-3">
                <h4 id="exampleModalLabel" class="modal-title text-center">Edit Receipt
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?php echo base_url("/home/updateRecipt"); ?>">
                <div class="modal-body" id="historyLog" style="min-height: 225px">
                    <div class="row">
                        <div class="col-md-6">
                            <label>firstName</label>
                            <input readonly id="fname" type="text" name="firstName" class="form-control" />
                            <input type="hidden" id="id" name="donation_id" />
                        </div>
                        <div class="col-md-6">
                            <label>lastName</label>
                            <input id="lname" readonly type="text" name="lastName" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Full Name</label>
                            <input readonly id="fullname" type="text" name="fullName" class="form-control" />                              
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Mobile</label>
                            <input id="mobile" readonly type="text" name="mobileNo" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input id="email" readonly type="text" name="email" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Month</label>
                            <select name="receipt_month" class="form-control" id="months">
                                <option value="" selected>-- Month --</option>
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
                            <label>Amount</label>
                            <input id="amount" readonly type="text" name="amount" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Donation Type</label>
                            <select name="corpusFund" class="form-control" id="corpusfund">
                                <option value="" selected>-- Select --</option>
                                <option value="1">Monthly</option>
                                <option value="2">Corpus</option>
                                <option value="3">One Time</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Status</label>
                            <select name="status" class="form-control" id="status">                               
                                <option value="1">Active</option>
                                <option value="0">Cancelled</option>                                
                            </select>
                        </div>
                    </div>

                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success btn-sm">Update</button>
        </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script>
$('#excel').on('click', function() {
    var type = $('#types').val();
    var typ= ['','Monthly','Corpus',"OneTime"]
    var year = $('#year').val();
    var month = $('#month').val();
    var mnth = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var year1 = year.split('-');
    // "KCT_Donation_List_"+mnth[month].toUpperCase()+year+"_<?php echo date('d-m-Y'); ?>

    if (year.length > 0 && month.length != '' && type.length > 0) {
        let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
            name: "KCT_Donation_List_"+year+'_'+mnth[month].toUpperCase()+'_'+typ[type]+'_'+
                "_<?php echo date('d-m-Y'); ?>.xlsx", // fileName you could use any name
            sheet: {
                name: 'Sheet 1' // sheetName
            }
        });
    } else if (year.length > 0 && type.length > 0) {
        let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
            name: "KCT_Donation_List_"+year+'_'+typ[type]+'_'+
                "_<?php echo date('d-m-Y'); ?>.xlsx", // fileName you could use any name
            sheet: {
                name: 'Sheet 1' // sheetName
            }
        });
    } else if (month.length != '') {
        let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
            name: "KCT_Donation_List_" + mnth[month].toUpperCase() + year1[0] +
                "_<?php echo date('d-m-Y'); ?>.xlsx", // fileName you could use any name
            sheet: {
                name: 'Sheet 1' // sheetName
            }
        });

    } else if (year.length > 0) {
        let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
            name: "KCT_Donation_List_" + year +
                "_<?php echo date('d-m-Y'); ?>.xlsx", // fileName you could use any name
            sheet: {
                name: 'Sheet 1' // sheetName
            }
        });
    } else if (type.length > 0) {
        let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
            name: "KCT_Donation_List_" +'_'+ year +'_'+typ[type] +
                "_<?php echo date('d-m-Y'); ?>.xlsx", // fileName you could use any name
            sheet: {
                name: 'Sheet 1' // sheetName
            }
        });
    }    
    else {

    }
});



$("#dmstable1").dataTable({
    // order: [[1, 'desc']],
    dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
});

var tableToExcel = (function() {


    var year = $('#year').val();
    var month = $('#month').val();
    var mnth = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var filename = '';
    var year1 = year.split('-');
    if (year.length > 0 && month.length != '') {
        filename = "KCT_Donation_List_" + mnth[month].toUpperCase() + year + "_<?php echo date('d-m-Y'); ?>";
    } else if (month.length != '') {
        filename = "KCT_Donation_List_" + mnth[month].toUpperCase() + year1[0] +
            "_<?php echo date('d-m-Y'); ?>";
    } else if (year.length > 0) {
        filename = "KCT_Donation_List_" + year + "_<?php echo date('d-m-Y'); ?>";
    }



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

        $('.hidecol').hide();

        setTimeout(() => {
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
            $('.hidecol').show();
        }, 1000);


        //window.location.href = uri + base64(format(template, ctx))
    }


})()


function capitalizeFirstLetter(str) {
    var words = str.toLowerCase().split(' ');
    for (var i = 0; i < words.length; i++) {
        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
    }
    return words.join(' ');
}

function editRecipt(id) {
    $('#editmodel').modal('show');
    var url = '<?php echo site_url('home/editRecipt') ?>';
    $.ajax({
        url: url,
        method: "GET",
        type: "ajax",
        data: {
            "id": id
        },
        success: function(result) {
            var rows = JSON.parse(result);
            var email = rows.email ? rows.email:rows.usermail;
            var fname = rows.firstName ? rows.firstName:rows.fname;
            var lname = rows.lastName ? rows.lastName:rows.lname;
            console.log(capitalizeFirstLetter(rows.firstName));
            $('#fname').val(capitalizeFirstLetter(rows.fname));
            $('#fullname').val(capitalizeFirstLetter(rows.Fullname));
            $('#lname').val(capitalizeFirstLetter(rows.lname));
            $('#mobile').val(rows.mobileNo);
            $('#email').val(email);
            $('#id').val(rows.donation_id);
            $('#amount').val(rows.amount);
            $('#months').val(rows.receipt_month);
            $('#corpusfund').val(rows.corpusFund);
            $('#status').val(rows.status);

        },
        error: function(error) {
            console.log(error);
        }
    });
}
</script>