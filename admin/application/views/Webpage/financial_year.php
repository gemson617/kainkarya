
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
           
            <div class="row">
                <div class="col-md-12">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                          <h3 class="panel-title">Financial Year</h3>
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
                            <form action="<?php echo base_url('home/financial_year') ?>" method="post">


                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="firstName">Financial Year</label>
                                        <input type="text" class="form-control " name="year" id="year" placeholder="Financial Year" value="" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="firstName">Enter Pre Number</label>
                                        <input type="text" class="form-control " name="pre_number" placeholder="Enter Pre Number" value="" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="firstName">Status</label>
                                        <select name="status" class="form-control">
                                            <option>--select--</option>
                                            <option value="1">Active</option>
                                            <option value="0">In-Active</option>
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
                            <h3 class="panel-title">View Financial Year</h3>
                        </div>
                        <div class="panel-body">
                            <table   class="table table-bordered">
                             <thead>
                                <tr>
                                   <th>S.No</th>
                                   <th>Year</th>
                                   <th>Pre Number</th>
                                   <th>Status</th>
                                   <th>Created Date</th>
                                </tr>
                             </thead>
                             <tbody>
                             <!-- <span onclick="changeStatus('".$row['id']."','Active')' style='color:green'>Active</span>':"<span onclick='changeStatus('".$row['id']."','In-Active')' style='color:red'>In-Active</span>"; ?> -->
                                <?php $i=1; foreach($year as $row): 
                                    $id=$row['id'] ?>
                                <tr>
                                  <td><?php echo $i++; ?></td>
                                   <td><?php echo $row['year']; ?></td>
                                   <td><?php echo $row['pre_number']; ?></td>
                                   <td><?php echo ($row['status']==1) ? '<label onclick="changeStatus(this)" data-id='.$row['id'].' data-status="Active"  style="color:green">Active</label>':'<label onclick="changeStatus(this)" data-id='.$row['id'].' data-status="In-Active" style="color:red">In-Active</label>'; ?></td>
                                   <td><?php echo date('d-m-Y', strtotime($row['created_date'])); ?></td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script> 

<script type="text/javascript">
    $(function () {
      $("#select1").select2();
  });
 // In your Javascript (external .js resource or <script> tag)
/* $(document).ready(function() {
  $('#select1').select2();
});*/
function changeStatus(e){
  
    var id=e.dataset.id;
    var status=e.dataset.status;
   
    var sts=(status=='Active') ? 1:0;
    var con=confirm("Do you want to change status..?");
     if(con){      
       
        $.ajax({
          type: "POST",
          url: "<?php echo site_url() ?>home/changeStatus",
          data: {'id' : id,'status':sts},
          success: function(data)
          {
            window.location.reload();
          },
          });

     }else{
        return false;
       
     }
}
</script>

