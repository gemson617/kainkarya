
<style>
    /* th,td{
  width:50px !important;
} */
.td_date{
    color: red;
  padding: 8px;
  width:50px;
}
</style>

<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
  <div class="row">
        <div class="col-md-12">
          <!-- INPUT GROUPS -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title"> Online Donation List</h3>
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
              <form action="<?php echo base_url('home/get_online_donation') ?>" method="post">
                <div class="form-group row">
                <div class="col-md-3">
                                <label for="">Receipt Month</label>
                                <select name="receipt_month" class="form-control">
                                    <option  value="">-- Month --</option>
                                    <option <?php echo ($month==1) ? 'selected':'' ?>  value="1">Jan</option>
                                    <option <?php echo ($month==2) ? 'selected':'' ?>  value="2">Feb</option>
                                    <option <?php echo ($month==3) ? 'selected':'' ?>  value="3">Mar</option>
                                    <option <?php echo ($month==4) ? 'selected':'' ?>  value="4">Apr</option>
                                    <option <?php echo ($month==5) ? 'selected':'' ?>  value="5">May</option>
                                    <option <?php echo ($month==6) ? 'selected':'' ?>  value="6">Jun</option>
                                    <option <?php echo ($month==7) ? 'selected':'' ?>  value="7">Jul</option>
                                    <option <?php echo ($month==8) ? 'selected':'' ?>  value="8">Aug</option>
                                    <option <?php echo ($month==9) ? 'selected':'' ?>  value="9">Sep</option>
                                    <option <?php echo ($month==10) ? 'selected':'' ?>  value="10">Oct</option>
                                    <option <?php echo ($month==11) ? 'selected':'' ?>  value="11">Nov</option>
                                    <option <?php echo ($month==12) ? 'selected':'' ?>  value="12">Dec</option>
                                </select>
                        </div>
                  <div class="col-md-3">
                    <label for="firstName">Financial Year</label>
                    <?php $trust_year= $yr=$this->mcommon->specific_row_value('company_setting','','current_financial_year'); ?>
                    <select name="year" class="form-control">
                     <!-- <option value="">---select---</option> -->
                     <?php foreach ($year as $key => $y) {
                        if(isset($sel_year)){
                        ?>
                      <option value="<?php echo $y['year']; ?>"  <?php echo ($y['year']==$sel_year) ? 'selected':''; ?>><?php echo $y['year']; ?></option>
                    <?php }else{ ?> 
                        <option value="<?php echo $y['year']; ?>"  <?php echo ($y['year']==$trust_year) ? 'selected':''; ?>><?php echo $y['year']; ?></option>
                        <?php } } ?>
                  </select>
                </div>

              </div>
              <br>
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>











            <div class="row">
                <div class="col-md-12">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Online Donation List</h3>
                        </div>
                        <button style="    float: right;" type="submit" name="submit" class="btn btn-primary" id="excel">Export to Excel</button>
                        
                        <div class="panel-body">
                            <table id="dmstable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th >S.No</th>
                                        <th >OD.NO</th>
                                        <th >User ID</th>
                                        <th >FullName</th>
                                        <th >Mobile</th>
                                        <th >Email</th>
                                        <th >Amount</th>
                                        <th width="200">ReptDate</th>
                                        <th >Transcation No</th>
                                        <th >Action</th>
                                      

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1;
                                    foreach ($online_donation as $row) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td align="right"><?php echo $row->od_id; ?></td>
                                            <td><?php echo $row->user_id; ?></td>
                                            <td><?php echo strtoupper($row->firstName . ' ' . $row->lastName); ?></td>
                                            <td><?php echo $row->mobileNo; ?></td>
                                            <td><?php echo $row->email; ?></td>
                                            <td align="right"><?php echo $row->amount; ?></td>
                                            <td width="200"><?php echo date('d-m-y', strtotime($row->receipt_date)); ?></td>
                                            <td><?php echo $row->transNumber; ?></td>
                                           <!--  <td><?php echo $row->panNumber; ?></td>
                                            <td><?php echo $row->address; ?></td> -->
                                             <td>
                                                <a href="<?php echo base_url(); ?>Home/show_online_data/<?php echo $row->od_id; ?>" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </td> 
                                        </tr>
                                    <?php endforeach; ?>

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
<table class="table table-striped" style="display: none;">
    <thead>
        <tr>
            <th>S.No</th>
            <th>OD.NO</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Amount</th>
            <th>ReptDate</th>
            <th>Transcation No</th>
            <th>PAN</th>
            <th>Address</th>

        </tr>
    </thead>
    <tbody>

        <?php $i = 1;
        foreach ($online_donation as $row) : ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row->od_id; ?></td>
                <td><?php echo $row->user_id; ?></td>
                <td><?php echo strtoupper($row->firstName . ' ' . $row->lastName); ?></td>
                <td><?php echo $row->mobileNo; ?></td>
                <td><?php echo $row->email; ?></td>
                <td><?php echo $row->amount; ?></td>
                <td><?php echo date('d-m-Y', strtotime($row->receipt_date)); ?></td>
                <td><?php echo $row->transNumber; ?></td>
                <td><?php echo $row->panNumber; ?></td>
                <td><?php echo $row->address; ?></td>
                <!-- <td>
                                                <a href="<?php echo base_url(); ?>Home/PrintMyReceipts/<?php echo $row->od_id; ?>" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                            </td> -->
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script>
    $('#excel').on('click', function() {
        let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
            name:  "KCT_Online_Donation_List_<?php echo date('d-m-Y'); ?>.xlsx",  // fileName you could use any name
            sheet: {
                name: 'Sheet 1' // sheetName
            }
        });
    });
</script>