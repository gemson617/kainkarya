<?php
foreach ($get_type as $value) 
{    
   $usertype[] = $value->user_type;
}

?>
<style>
      .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;
            }

    #pageloader {
        background: rgba(255, 255, 255, 0.8);
        display: none;
        height: 100%;
        position: fixed;
        width: 100%;
        z-index: 9999;
    }

    #pageloader img {
        left: 50%;
        margin-left: -32px;
        margin-top: -32px;
        position: absolute;
        top: 50%;
    }
</style>
<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
          <!-- INPUT GROUPS -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title"> Questionnaire</h3>
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

             <form action="<?php echo base_url('questionnaire/edit/'.$default[0]->id) ?>" method="post">
                                <div class="form-group ">
                                    <label for="firstName">User Type</label>
                                    <select name="user_type[]" class="form-control select2" multiple required>
                                        <option value="">----Select ---</option>

                                        <?php foreach($user_type as $row){ 
                                            ?>
                                            <option <?php if ( in_array($row->type_id,$usertype)) {                                                
                                                 echo 'selected';
                                                } ?> value="<?php echo $row->type_id; ?>"><?php  echo $row->type_name; ?></option>
                                        <?php  } 
                                        ?>

                                      <!-- <option <?php if($default[0]->user_type==9){ echo "selected";}?> value="9">Trustee</option>
                                        <option <?php if($default[0]->user_type==6){ echo "selected";}?> value="6">Managing Trustee</option>
                                        <option <?php if($default[0]->user_type==8){ echo "selected";}?> value="8">General Council Member</option>
                                        <option <?php if($default[0]->user_type==7){ echo "selected";}?> value="7">Monthly Contributor </option>
                                        <option <?php if($default[0]->user_type==1){ echo "selected";}?> value="1">Other Contributor</option>  -->

                                    </select>
                                </div>
                                <div class="form-group">
                                    <!-- <div class="col-md-12"> -->
                                        <label for="">Question</label>
                                        <!-- <input type="text" name="question" class="form-control" placeholder="Enter Question" value="<?php echo $default[0]->question;?>"> -->
                                        <!-- <textarea name="question" class="form-control" placeholder="Enter Question"><?php echo $default[0]->question;?></textarea> -->
                                        <textarea name="question" id="editor1" type="text" class="form-control" placeholder="Enter Product Description">
                                        <?php echo (isset($_POST['question']))?$_POST['question']:$default[0]->question; ?></textarea>
                                    <!-- </div> -->
                                </div>
                                    <div class="form-group">
                                    <?php foreach($default as $d){?>
                                    <!-- <div class="col-md-12"> -->
                                        <label>Answer</label>
                                        <div class="multi-field-wrapper">
                                            <div class="multi-fields">
                                                <div class="multi-field">
                                                    <input type="text" name="answer[]" class="form-control" placeholder="Enter Answer" value="<?php echo $d->answer;?>">
                                                    <input type="hidden" name="answer_id[]" value="<?php echo $d->a_id;?>">
                                                    <button type="button" class="add-field">Add More Answer</button>
                                                    <button type="button" class="remove-field">Remove Answer</button>
                                                </div>
                                            </div><br>
                                        </div>
                                    <!-- </div> -->
                                    <?php } $yr=$this->mcommon->specific_row_value('company_setting','','current_financial_year'); ?>
                                </div>


                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <a type="button" href="<?php echo base_url('questionnaire/show/'.$yr);?>"name ="button" class="btn btn-primary">Back</a>
                                
                            </form>
                            <hr />
          </div>
        </div>
        <!-- END INPUT GROUPS -->
      </div>
    </div>
   
</div>
</div>
<!-- END MAIN CONTENT -->
</div>
<div id="pageloader">
    <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." />
</div>

<!-- <script type="text/javascript" src="//cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script> -->
<!-- <script src="<?php //echo base_url('public/ckeditor/ckeditor.js') ?>"></script> -->
<!-- include summernote css/js -->

<!-- <script type="text/javascript">
    CKEDITOR.editorConfig = function(config) {
        config.language = 'es';
        config.uiColor = '#F7B42C';
        config.height = 300;
        config.toolbarCanCollapse = true;

    };
    CKEDITOR.replace('editor1');
</script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script>
  $('#excel').on('click', function(){
   let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
           name: `Questionnaire Lists.xlsx`, // fileName you could use any name
           sheet: {
              name: 'Sheet 1' // sheetName
            }
          });
      });
</script>
<script>
    $(document).ready(function() {
           $(".select2").select2();
        $("#myform").on("submit", function() {
            $("#pageloader").fadeIn();
        }); //submit
    });
</script>
<script type="text/javascript">
    $('.multi-field-wrapper').each(function() {
        var $wrapper = $('.multi-fields', this);
        $(".add-field", $(this)).click(function(e) {
            var lengths = $('.multi-field').length + 1;
            if (lengths >= 10) {
                Swal.fire({
                    icon: 'error',
                    // title: 'Oops...',
                    text: 'Only Nine Answers Allowed!',

                })
            } else {
                $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
            }
        });
        $('.multi-field .remove-field', $wrapper).click(function() {
            // if ($('.multi-field', $wrapper).length > 1)
                $(this).parent('.multi-field').remove();
        });
    });

    $(function() {
        $("#select1").select2();
    });
    // In your Javascript (external .js resource or <script> tag)
    /* $(document).ready(function() {
      $('#select1').select2();
    });*/
</script>
<script>
    function get_users(user_id) {

        $.ajax({
            url: "<?php echo site_url() ?>home/get_userdata",
            method: "POST",
            type: "ajax",
            data: {
                user_id: user_id
            },
            success: function(result) {
                var data = JSON.parse(result);

                $('#firstName').val(data[0].firstName);
                $('#lastName').val(data[0].lastName);
                $('#email').val(data[0].email);
                $('#mobileNo').val(data[0].mobile);
                $('#address').val(data[0].address);
                $('#panNumber').val(data[0].pan);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function get_type(value) {

        if (value == 2) {
            $('#users_name').show();
        } else {
            $('#users_name').hide();
        }
    }
</script>
<script>
            // This sample still does not showcase all CKEditor 5 features (!)
            // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
            CKEDITOR.ClassicEditor.create(document.getElementById("editor1"), {
               
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
                placeholder: 'Welcome to CKEditor 5!',
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