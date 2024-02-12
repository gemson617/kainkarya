
<div class="main">
<!-- MAIN CONTENT -->
<div class="main-content">
  <div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <!-- INPUT GROUPS -->
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title"> User Report</h3>
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
            <form action="<?php echo base_url('reports/user_polling') ?>" method="post">
              <div class="form-group row">
                <div class="col-md-3">
                    <label for="firstName">User</label>
                    <select name="user_type" class="form-control select2" required>
                        <option value="">----Select ---</option>
                        <?php foreach($users as $u){
                          ?>
                        <option value="<?php echo $u->id;?>"><?php echo $u->firstName. " " .$u->lastName;?></option>
                          <?php }
                        ?>
                        <!-- <option value="6">Managing Trustee</option>
                        <option value="8">General Council Member</option>
                        <option value="7">Monthly Contributor </option>
                        <option value="1">Other Contributor</option> -->

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
        <!-- INPUT GROUPS -->
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">User Report</h3>
          </div>
          <button style="    float: right;" type="submit" name="submit" class="btn btn-primary" id="excel">Export to Excel</button> 
          <div class="panel-body">
            <table id="dmstable"  class="table table-striped">
             <thead>
              <tr>
                <th>S.No</th>
                <th>User Type</th>
                <th>User Name</th>
                <th>Question</th>
                <th>Option</th>
                <th>Status</th>
                <!-- <th>Email</th> -->
                <!-- <th>Amount</th>
                <th>ReptDate</th>
                <th>Send Mail</th>
                <th>Print</th> -->
                <!-- <th>Delete</th> -->
              </tr>
            </thead>
            <tbody>

              <?php $i=1; foreach($usertype_qa as $row): ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['type_name']; ?></td>
                <td><?php echo $row['firstName']; ?></td>               
                <td><?php echo strtoupper($row['question']); ?></td>
                <td><?php echo strtoupper($row['answer']); ?></td>
                <!-- <td><?php if ($row['answer_id'] != "") {
                    echo"yes";
                    }else{
                    echo "no"; 
                    } ?>
                </td>  -->
                <td>
                    <?php if ($row['status']==1) {
                echo"Active";
                }else{
                echo "InActive"; 
                } ?></td>
              <!-- <td><?php echo $row['mobileNo']; ?></td>             -->
             
           </tr>
         <?php endforeach; ?>
         <!-- <?= '/home/PrintMyReceipts/'.$row['usertype_qa_id'] ?> -->
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
<table   class="table table-striped" style="display: none;">
<thead>
<tr>
    <th>S.No</th>
    <th>User Type</th>
    <th>User Name</th>
    <th>Question</th>
    <th>Option</th>
    <th>Status</th> 
</tr>
</thead>
<tbody>

<?php $i=1; foreach($usertype_qa as $row): ?>
<tr>
<td><?php echo $i++; ?></td>
    <td><?php echo $row['type_name']; ?></td>
    <td><?php echo $row['firstName']; ?></td>               
    <td><?php echo strtoupper($row['question']); ?></td>
    <td><?php echo strtoupper($row['answer']); ?></td>
    <td><?php if ($row['status']==1) {
    echo"Active";
    }else{
    echo "InActive"; 
    } ?></td>       
</tr>
<?php endforeach; ?>
<!-- <?= '/home/PrintMyReceipts/'.$row['usertype_qa_id'] ?> -->
</tbody>
</table>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script>
$('#excel').on('click', function(){
 let table = document.getElementsByTagName("table");
      TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
         name: `User Report.xlsx`, // fileName you could use any name
         sheet: {
            name: 'Sheet 1' // sheetName
          }
        });
    });
  </script>