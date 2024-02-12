<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- INPUT GROUPS -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title" style="text-align:center;">10 BE Certificates List</h3>

              <?php
             // error_reporting(0);
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
            <!-- <button style="    float: right;" type="submit" name="submit" class="btn btn-primary" id="excel">Export to Excel</button> -->
            <div class="panel-body">
              <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label>User List</label>
                      <select class="form-control" id="search_pdf">
                           <option value="">Select User</option>
                           <?php foreach($users_list as $row) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['firstName']." ".$row['lastName']; ?></option>
                           <?php } ?>
                      </select>
                    </div>
                </div>
                
                 <div class="col-md-5">
                    <div class="form-group">
                      <label>Financial Year</label>
                      <select class="form-control" id="search_year">
                           <option value="">Select Year</option>
                           <?php foreach($year as $row) { ?>
                            <option <?php echo ($cur_year==$row['year']) ? 'selected':''; ?> value="<?php echo $row['year']; ?>"><?php echo $row['year']; ?></option>
                           <?php } ?>
                      </select>
                    </div>
                </div>
                
              </div>
              <table id="dmstable" class="table table-bordered">
                <thead>
                  <tr>
                    <th>S.No</th>                   
                    <th>FileName</th>                    
                    <th>Year</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody id="userlist">
                  
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
                    <th>FileName</th>                    
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 
                </tbody>
</table>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script>
  $('#excel').on('click', function() {
    let table = document.getElementsByTagName("table");
    TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
      name: `Users PDF.xlsx`, // fileName you could use any name
      sheet: {
        name: 'Sheet 1' // sheetName
      }
    });
  });

  $('#search_pdf').on("change",function(){
      var userid=$('#search_pdf').val();
      var year=$('#search_year').val();
    $.post("<?php echo site_url() ?>home/get_pdf_users",{ 'userid':userid,'year':year },function(data){
      $("#dmstable").dataTable().fnDestroy()
      $('#userlist').html(data);
      setTimeout(function(){


        $("#dmstable").dataTable({
           
        });
      },1000)
      
          
          //console.log(data);
    })
    
  })
</script>