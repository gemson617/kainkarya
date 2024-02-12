<?php
foreach ($qa_summary as $row) {
}
// foreach($row['option_type'] as $op){
//   echo "<pre>";
// print_r($op->answer);
//  print_r($row['option_type']);
// EXIT();
// }

// echo "<pre>";
// print_r($qa_summary);
// // print_r($row['option_type']);
// EXIT();
?>
<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- INPUT GROUPS -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title"> Summary Report</h3>
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
              <form action="<?php echo base_url('reports/summary_report') ?>" method="post">
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="firstName">Summary</label>
                    <select name="question" class="form-control select2" required>
                      <option value="">----Select ---</option>
                      <?php foreach ($question as $q) {
                      ?>
                        <option value="<?php echo $q->id; ?>"><?php echo $q->question; ?></option>
                      <?php }
                      ?>
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
              <h3 class="panel-title">Summary Report</h3>
            </div>
            <button style="    float: right;" type="submit" name="submit" class="btn btn-primary" id="excel">Export to Excel</button>
            <div class="panel-body">
              <table id="dmstable" class="table table-striped">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <?php
                    if($qa_summary !="")
                    {
                     foreach ($qa_summary as $op) {
                    ?>
                      <th>Option</th>
                      <th>Count</th>
                    <?php 
                    }
                    }
                    else{?>
                     <th>Option</th>
                      <th>Count</th>
                      <?php
                    }
                    ?>


                  </tr>
                </thead>
                <tbody>

                  <?php $i = 1;
                  // foreach ($qa_summary as $row) : 
?>
                  
                    <tr>
                      <?php
                    if($qa_summary != "")
                  {?>
                      <td><?php echo $i++; ?></td>
                      <?php  foreach ($qa_summary as $op) {
                      ?>
                        <td><?php echo $op['answer']; ?></td>
                        <td><?php echo $op['Count']; ?></td>
                      <?php
                      }
                     }else{ ?>
                        <td colspan="3"> Choose the summary to get report</td>
                      <?php
                     }?>

                    </tr>
                 
                  <!-- <?= '/home/PrintMyReceipts/' . $row['qa_summary_id'] ?> -->
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
      <th>User Type</th>
      <th>User Name</th>
      <th>Question</th>
      <th>Option</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>

    <?php $i = 1;
    foreach ($qa_summary as $row) : ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row['type_name']; ?></td>
        <td><?php echo $row['firstName']; ?></td>
        <td><?php echo strtoupper($row['question']); ?></td>
        <td><?php echo strtoupper($row['answer']); ?></td>
        <td><?php if ($row['status'] == 1) {
              echo "Active";
            } else {
              echo "InActive";
            } ?></td>
      </tr>
    <?php endforeach; ?>
    <!-- <?= '/home/PrintMyReceipts/' . $row['qa_summary_id'] ?> -->
  </tbody>
</table>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script>
  $('#excel').on('click', function() {
    let table = document.getElementsByTagName("table");
    TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
      name: `User Report.xlsx`, // fileName you could use any name
      sheet: {
        name: 'Sheet 1' // sheetName
      }
    });
  });
</script>