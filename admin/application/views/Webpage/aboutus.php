
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
           
            <div class="row">
                <div class="col-md-12">
                    <!-- INPUT GROUPS -->
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


if($id > 0){
?>                    
                    <div class="panel">
                        <!-- <div class="panel-heading">
                          <h3 class="panel-title">About Us</h3>
                        </div> -->
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
                            

                            <form action="<?php echo base_url('home/aboutUs') ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $id ?>" />

                                <div class="form-group row">
                                    
                                    <div class="col-md-4">
                                        <label for="">Menu Names</label>
                                        <select name="menu_name" class="form-control">
                                            <option>--select--</option>
                                            <option <?php echo ($menu==1) ? 'selected':''; ?> value="1">About Us</option>
                                            <option  <?php echo ($menu==2) ? 'selected':''; ?> value="2">Our Inspiration</option>
                                            <option  <?php echo  ($menu==3) ? 'selected':''; ?> value="3">Our Vision & Mission</option>
                                            <option <?php echo ($menu==4) ? 'selected':''; ?>  value="4">Our Objectives</option>
                                            <option <?php echo ($menu==5) ? 'selected':''; ?>  value="5">Our Activities</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                       <textarea name="content"  id="ckeditor" class="form-control" rows="5"><?php echo $content ?></textarea>
                                    </div>
                                </div>
                                <br>

                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                            </form>
                            

                        </div>
                    </div>
                    <!-- END INPUT GROUPS -->
                </div>
            </div><?php } ?>
             <div class="row">
                <div class="col-md-12">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">AboutUs Management</h3>
                        </div>
                        <div class="panel-body">
                            <table   class="table table-bordered">
                             <thead>
                                <tr>
                                   <th>S.No</th>
                                   <th>Menu Name</th>
                                   <th>Action</th>
                                </tr>
                             </thead>
                             <tbody>
                                 <?php if(isset($records)){ 
                                     $i=1;
                                     $arr=array('','About Us','Our Inspiration','Our Vision & Mission','Our Objectives','Our Activities');
                                 foreach($records as $row){
                                 ?>
                                 <tr>
                                     <td><?php echo $i; ?></td>
                                     <td><?php echo $arr[$row->menu]; ?></td>
                                     <td><a href="<?php echo base_url(); ?>home/editAbout/<?php echo  $row->id ?>"><i class="fa fa-pencil"></i> Edit</a></td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script> 
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/ckeditor.js"></script>

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
<script>
            // This sample still does not showcase all CKEditor 5 features (!)
            // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
            CKEDITOR.ClassicEditor.create(document.getElementById("ckeditor"), {
               
                toolbar: {
                    items: [                        
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',                      
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'About us content',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
               
                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',                   
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',                    
                ]
            });
        </script>

