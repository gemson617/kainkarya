 <?php  
 foreach ($video_edit as  $i) {
   $v_id = $i->v_id;
   $id = $i->id;
   $caption = $i->caption;
   $video = $i->video;
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
               <h3 class="panel-title">Video Management</h3>
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
                        <form action="<?php echo base_url('video') ?>" method="post">
                           <div class="form-group row">
                               <div class="col-md-4">
                                <label for="">Video Album</label>
                                <select name="v_id" class="form-control">
                                 <option>---Select---</option>
                                 <?php foreach ($video_album as $key => $row) {
                                    ?>
                                    <option value="<?php echo $row->v_id; ?>" <?php if($v_id==$row->v_id){ echo selected;} ?>><?php echo $row->caption; ?></option>
                                    <?php 
                                } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="receipt_number">Video Caption</label>
                            <input type="text" name="caption" value="<?php echo $caption; ?>"  class="form-control" placeholder="Enter Your Caption">
                        </div>
                         <div class="col-md-4">
                            <label for="transBank">Video Url </label>
                            <input type="text" name="video" value="<?php echo $video; ?>" class="form-control" placeholder="Ex:(https://www.youtube.com/embed/v202rmUuBis)">
                        </div>
                    </div>

                   
                    <br>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
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
                        <table id="dmstable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S No.</th>
                                    <th>Video Album</th>
                                    <th>Caption</th>
                                    <th>Video Url</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($video_data as $v) { ?>
                                   <tr>
                                    <td><?php echo $i++; ?></td>
                                    <th><?php echo $v->va_caption; ?></th>
                                    <td><?php echo $v->caption; ?></td>
                                    <td><?php echo $v->video; ?></td>
                                    <td>
                                      <a href="<?php echo base_url();?>video/edit/<?php echo $v->id;?>" target=""><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                      &nbsp;&nbsp;
                                      <a href="<?php echo base_url();?>video/delete/<?php echo $v->id;?>/2" ><i class="fa fa-trash" aria-hidden="true"></i></a>
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


