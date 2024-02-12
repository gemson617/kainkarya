 <?php  
 foreach ($album_edit as  $i) {
   $id = $i->v_id;
   $caption = $i->caption;
   $image = $i->image;
 }
 $url  =  base_url('public/assets/gallery/');
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
             <h3 class="panel-title"> Video Album</h3>
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
            <form action="<?php echo base_url('video/album') ?>" method="post" enctype="multipart/form-data">
             <div class="form-group row">
              <div class="col-md-6">
                <label for="receipt_number"> Album Caption</label>
                <input type="text" name="caption" value="<?php echo $caption; ?>"  class="form-control" placeholder="Enter Your Caption">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <label for="transBank">Album Image</label>
                <input type="file" name="image" value="<?php echo $image; ?>" class="form-control">
                <?php if ($image) {?>
                  <img src="<?php echo $url."".$image; ?>" height=50px;>
                <?php }?>
              </div>
            </div> 
            <br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
             <input type="hidden" name="image1" value="<?php echo $image; ?>">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>

          </form>
        </div>
      </div>
      <!-- END INPUT GROUPS -->
      <div class="row">
        <div class="col-md-12">
          <!-- RECENT PURCHASES -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title"></h3>

            </div>
            <div class="panel-body no-padding">
              <table  class="table table-bordered">
                <thead>
                  <tr>
                    <th>S No.</th>
                    <th>Caption</th>
                    <th>Image</th>
                    <th>Action</th> 

                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($video_album as $g) { ?>
                   <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $g->caption; ?></td>
                    <td><img src="<?php echo $image=$url."".$g->image; ?>" height=50px;></td>
                    <td>
                      <a href="<?php echo base_url();?>video/album_edit/<?php echo $g->v_id;?>" target=""><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                      &nbsp;&nbsp;
                      <a href="<?php echo base_url();?>video/delete/<?php echo $g->v_id;?>/1" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td> 

                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

        </div>
        <!-- END RECENT PURCHASES -->
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- END MAIN CONTENT -->
</div>


