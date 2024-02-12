<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Downloads</h3>
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

                            <?php
if(isset($editData)){
    foreach($editData as $row){
        $menu=$row->menu;
        $content=$row->content;
        $id=$row->id;
    }
    
}else{
        $menu=$this->input->post('menu_name');
        $content=$this->input->post('content');
        $id=$this->input->post('id'); 
    
}
?>
                            <form action="<?php echo base_url('home/saveDownload') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $id ?>" />

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="">File Types</label>
                                        <select name="file_type" class="form-control">
                                            <option>--select--</option>
                                            <option <?php echo ($menu==1) ? 'selected':''; ?> value="1">Pamphlet
                                            </option>
                                            <option <?php echo ($menu==2) ? 'selected':''; ?> value="2">Forms</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="max rtl-bc">
                                    <div class="multi-fields">
                                        <div class="multi-field" style="margin: 15px;">
                                            <div class="row" id="add_cal">
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>Attachment</label>
                                                        <input name="files[]" id="files[]" type="file" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-8">
                                                    <div class="form-group">
                                                        <label>Title</label><span class="mandatory">*</span>
                                                        <input name="title[]" id="title" type="text"
                                                            class="form-control" placeholder="Enter Title">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4 col-lg-4"><br />
                                        <button type="button" id="button1"
                                            class="add-field btn btn-default btn-circle"><i class="fa fa-plus-circle"
                                                aria-hidden="true"></i></button>&nbsp;&nbsp;
                                        <button type="button" id="button2"
                                            class="remove-field btn btn-default btn-circle1"><i
                                                class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                    </div>
                                </div>

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
                            <h3 class="panel-title">Download Management</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>File</th>   
                                        <th>Action</th>                                     
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($records)){ 
                                     $i=1;
                                    
                                 foreach($records as $row){
                                 ?>
                                 <tr>
                                     <td><?php echo $i; ?></td>
                                     <td><?php echo $row->title; ?></td>
                                     <td><?php echo ($row->file_type==1) ? 'Pamphlet':'Forms'; ?></td>
                                     <td><a href="<?php echo $row->file_path; ?>"><i class="fa fa-file"></i></a></td>
                                     <td>
                                        <a href="<?= base_url('home/downloadEdit/').$row->id; ?>"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" onclick="deleteDownload('<?= $row->id ?>')"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                                 <?php $i++;}  } ?>
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


<script type="text/javascript">
$(function() {
    $("#select1").select2();
});
// In your Javascript (external .js resource or <script> tag)
/* $(document).ready(function() {
  $('#select1').select2();
});*/
function changeStatus(e) {

    var id = e.dataset.id;
    var status = e.dataset.status;

    var sts = (status == 'Active') ? 1 : 0;
    var con = confirm("Do you want to change status..?");
    if (con) {

        $.ajax({
            type: "POST",
            url: "<?php echo site_url() ?>home/changeStatus",
            data: {
                'id': id,
                'status': sts
            },
            success: function(data) {
                window.location.reload();
            },
        });

    } else {
        return false;

    }
}
function deleteDownload(id){
    if(confirm("Are you sure you want to delete?")===true){
        window.location="<?php echo  base_url("home/downloadDelete/") ?>"+id;
    }

}
$('.max').each(function() {
        var $wrapper = $('.multi-fields', this);
        $(".add-field", $(this)).click(function(e, count) {
            
            var count = $('.multi-field').length;               
        //$('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus(); 
               
      

        var row = $(
                '<div class="multi-fields rtl-bc"> <div class="multi-field"> <div class="row" id="add_cal" style="margin-top: 30px; padding: 18px;"> <div class="col-md-4 col-lg-3"> <label>Attachment</label><span class="mandatory">*</span> <input name="files[]" id="files'+count+'" type="file" class="form-control partno" ></div><div class="col-md-8 col-lg-8"><label>Title</label><span class="mandatory">*</span> <input name="title[]" id="title'+count+'" type="text" class="form-control price'+
                    count + '" placeholder="Enter Title"></div>'+
                    '</div></div></div>' );
            row.appendTo($wrapper);
           
            
        });
        $('.remove-field', $(this)).click(function() {
            if ($('.multi-field').length > 1)
                $('.multi-field').last().remove();
        });
    });
</script>