<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- INPUT GROUPS -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Questionnaire List</h3>

              <?php
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
            <button style="    float: right;" type="submit" name="submit" class="btn btn-primary" id="excel">Export to Excel</button>
            <div class="panel-body">
              <table id="dmstable" class="table table-bordered">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Question</th>
                    <th>User Type</th>
                    <th>Link</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  $type_name="";
                 
                  foreach ($polling_list as $row) : 
                    $object = $row['user_type'];
                    $array=[];                    
                    foreach ($object as $value)
                    {
                      $array[] = $value->type_name;
                    }
                    $type_name = implode(",",$array);
                   
                  ?>
                  
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $row['question'];?></td>
                      <td><?php 
                      echo $type_name;
                      ?></td>
                      <!-- <td><a href="http://localhost/kain/home/questionnaire/<?php echo $row->id; ?>">http://localhost/kain/home/questionnaire/<?php echo $row->id; ?></a></td> -->
                      <td><a href="https://kainkarya.com/home/questionnaire/<?php echo $row->id; ?>">https://kainkarya.com/home/questionnaire/<?php echo $row->id; ?></a></td>
                      <td>
                        <a href="<?php echo base_url(); ?>polling/edit/<?php echo $row->id; ?>" target=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        &nbsp;&nbsp;
                      <a href="<?php echo base_url();?>polling/delete/<?php echo $row->id;?>" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                      </td>

                    </tr>
                  <?php endforeach; 
                  //  exit();?>
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

<table class="table table-bordered" style="display: none;">
  <thead>
    <tr>
      <th>S.No</th>
      <th>User ID</th>
      <th>Name</th>
      <th>Mobile</th>
      <th>Email</th>
      <th>Pan</th>
      <th>User Type</th>
      <th>Address </th>

    </tr>
  </thead>
  <tbody>
    <?php $i = 1;
    foreach ($users as $row) : ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <th><?php echo $row['id']; ?></th>
        <td><?php echo strtoupper($row['firstName'] . ' ' . $row['lastName']); ?></td>
        <td><?php echo $row['mobile']; ?></td>
        <td><?php echo $row['email']; ?></td>

        <td><?php echo $row['pan']; ?></td>
        <td><?php
         if ($row['auth_level'] == 9) {
              echo "Trustee";
            } elseif ($row['auth_level'] == 6) {
              echo "Managing Trustee";
            } elseif ($row['auth_level'] == 8) {
              echo "General Council Member";
            } elseif ($row['auth_level'] == 7) {
              echo "Monthly Contributor";
            } elseif ($row['auth_level'] == 1) {
              echo "Other Contributor";
            } ?></td>
        <td><?php echo strtoupper($row['address']); ?></td>

      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script>
  $('#excel').on('click', function() {
    let table = document.getElementsByTagName("table");
    TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
      name: `Users Profiles.xlsx`, // fileName you could use any name
      sheet: {
        name: 'Sheet 1' // sheetName
      }
    });
  });
</script>