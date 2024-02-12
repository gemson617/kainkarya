<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- INPUT GROUPS -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Users Profiles</h3>

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
                    <th>Active</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Pan</th>
                    <th>User Type</th>
                    <!-- <th>Address </th> -->
                     <th>Created at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  // echo base_url(); Home/user_status/$row['id']; 
                
                  foreach ($users as $row) : ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php if ($row['active'] == 1) { ?>
                          <a href="javascript:changeStatus(1,'<?= $row['id'] ?>')" target=""><span class="text-success">Active</span></a>
                        <?php } else { ?>
                          <a href="javascript:changeStatus(0,'<?= $row['id'] ?>')" target=""><span class="text-danger">In-Active</span></a>
                        <?php  } ?>

                      </td>

                      <th><?php echo $row['id']; ?></th>
                      <td><?php echo strtoupper($row['firstName'] . ' ' . $row['lastName']); ?></td>
                      <td><?php echo $row['mobile']; ?></td>
                      <td><?php echo $row['email']; ?></td>

                      <td><?php echo $row['pan']; ?></td>
                      <td><?php if ($row['auth_level'] == 9) {
                            echo "Trustee";
                          } elseif ($row['auth_level'] == 6) {
                            echo "Managing Trustee";
                          } elseif ($row['auth_level'] == 8) {
                            echo "Governing Council Member";
                          } elseif ($row['auth_level'] == 7) {
                            echo "Monthly Contributor";
                          } elseif ($row['auth_level'] == 1) {
                            echo "Other Contributor";
                          } elseif ($row['auth_level'] == 5) {
                            echo "No Details";
                          }  ?></td>
                      <!-- <td><?php echo strtoupper($row['address']); ?></td> -->
                      <!-- <td><?php if ($row['active'] == 1) {
                                  echo "Active";
                                } else {
                                  echo "In-Active";
                                } ?></td> -->
                                <td><?php echo date('d-m-Y',strtotime(str_replace('/','-',$row['created_at']))); ?></td>
                      <td>
                        <a href="<?php echo base_url(); ?>Home/edit_user/<?php echo $row['id']; ?>" target=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                         <a href="javascript:void(0)" onclick="delete_user(<?php echo $row['id']; ?>)" target=""><i class="fa fa-trash" aria-hidden="true"></i></a>
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
      <th>Created at</th>
      <th>Address </th>

    </tr>
  </thead>
  <tbody>
    <?php $i = 1;
    foreach ($records as $row) : ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <th><?php echo $row['id']; ?></th>
        <td><?php echo strtoupper($row['firstName'] . ' ' . $row['lastName']); ?></td>
        <td><?php echo $row['mobile']; ?></td>
        <td><?php echo $row['email']; ?></td>

        <td><?php echo $row['pan']; ?></td>
        <td><?php if ($row['auth_level'] == 9) {
              echo "Trustee";
            } elseif ($row['auth_level'] == 6) {
              echo "Managing Trustee";
            } elseif ($row['auth_level'] == 8) {
              echo "Governing Council Member";
            } elseif ($row['auth_level'] == 7) {
              echo "Monthly Contributor";
            } elseif ($row['auth_level'] == 1) {
              echo "Other Contributor";
            } elseif ($row['auth_level'] == 5) {
              echo "No Details";
            }  ?></td>
             <td><?php echo date('d/m/Y',strtotime(str_replace('/','-',$row['created_at']))); ?></td>
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
      name: "KCT_User Profile_<?php echo date('d-m-Y'); ?>.xlsx", // fileName you could use any name
      sheet: {
        name: 'Sheet 1' // sheetName
      }
    });
  });
  function delete_user(id){
    if(confirm("Are you sure you want to delete..?")==true){
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
  
    function changeStatus(status,Id)
  {
    if(confirm("Are you sure you want to Change Status?")==true){
       $.ajax({
            url: "<?php echo site_url() ?>home/changeUserStatus",
            method: "POST",
            type: "ajax",
            data: {
                "id": Id,
                "status":status,
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
</script>