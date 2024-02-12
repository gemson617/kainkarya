<style>
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
 
  .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;
            }

</style>
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Questionnaire </h3>
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
                            <form action="<?php echo base_url('questionnaire/add') ?>" method="post">
                                <div class="form-group ">
                                    <label for="firstName">User Type</label>
                                    <select name="user_type[]" class="form-control select2" multiple required>
                                        <option value="">----Select ---</option>
                                        <option value="9">Trustee</option>
                                        <option value="6">Managing Trustee</option>
                                        <option value="8">Governing Council Member</option>
                                        <option value="7">Monthly Contributor </option>
                                        <option value="1">Other Contributor</option>

                                    </select>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-md-12">
                                        <label for="">Question</label>
                                        <!-- <input type="text" required name="question" class="form-control" placeholder="Enter Question"> -->

                                        <!-- <input type="text" required name="question" class="form-control" placeholder="Enter Question"> -->
                                        <!-- <textarea name="question" class="form-control" placeholder="Enter Question"></textarea> -->
                                        <textarea name="question" type="text" id="editor1" class="form-control" placeholder="Enter Product Description">
                                    <?php echo (isset($_POST['question'])) ? $_POST['question'] : $default['question']; ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Answer</label>
                                        <div class="multi-field-wrapper">
                                            <div class="multi-fields">
                                                <div class="multi-field">
                                                    <input type="text" required name="answer[]" class="form-control" placeholder="Enter Answer">
                                                    <button type="button" class="add-field">Add More Answer</button>
                                                    <button type="button" class="remove-field">Remove Answer</button>
                                                </div>
                                            </div><br>

                                        </div>

                                    </div>
                                </div>


                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <a type="button" href="<?php echo base_url('questionnaire'); ?>" name="button" class="btn btn-primary">Back</a>

                            </form>
                            <hr />
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
                            <h3 class="panel-title">Questionnaire List</h3>
                        </div>
                       
                        <button style="    float: right;" type="submit" name="submit" class="btn btn-primary" id="excel">Export to Excel</button>
                        <!--   <button style="float: right;" type="button" name="submit" class="btn btn-success" id="export-excel">Export to Excel</button> -->
                        <!--  <button onclick="copyToClipboard()" style="float: right;" type="button" class="btn" id="copy-link">Copy</button> -->
                        <div class="panel-body">
                            <table id="dmstable11" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Question</th>                                       
                                          <th>Action</th>
                                        <th>Link</th>    
                                        <th style="font-size:14px;">User Type</th>                                  
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                <?php  $cur_year=$this->mcommon->specific_row_value('financial_year',array('status'=>1),'year'); ?>
                                    <?php $i = 1;
                                    $type_name = "";
                                    $cnt=count($polling_list);
                                    foreach ($polling_list as $key=>$row) :
                                        $object = $row['user_type'];
                                        $array = [];
                                        foreach ($object as $value) {
                                            $array[] = $value->type_name;
                                        }
                                        $type_name = implode(",", $array);

                                    ?>

                                        <tr>
                                            <td><?php echo $cnt;
                                            ?></td>
                                            <td><?php echo $row['question'];                                           
                                            ?></td>
                                            
                                               <td>
                                                <a class="btn" href="<?php echo base_url(); ?>questionnaire/edit/<?php echo  $row['id']; ?>" target="">Edit</a>
                                                &nbsp;&nbsp;
                                                <a class="btn" onclick="deleteQuestion(<?php echo  $row['id']; ?>)" href="javascript:void(0)">Delete</a>

                                                <!--<a class="btn" href="<?php echo base_url(); ?>questionnaire/export_excel/<?php echo  $row['id']; ?>">Excel</i></a>-->

                                                <a class="btn" onclick="copyToClipboard(<?php echo $i; ?>)" id='copy<?php echo $i; ?>' href="javascript:void(0)">Copy</i></a>
                                            
                                                <a class="btn" href="<?php echo base_url(); ?>questionnaire/export_pdf/<?php echo  $row['id']; ?>/<?= $cnt ?>">PDF</i></a>
                                            </td>
                                            <!-- <td><a href="http://localhost/kainkariya/home/questionnaire/<?php echo $row['id']; ?>">http://localhost/kainkariya/home/questionnaire/<?php echo  $row['id']; ?></a></td> -->
                                            <td><a id="cp<?php echo $i; ?>" href="https://kainkarya.com/home/questionnaire/<?php echo $cur_year.'/'.$row['id'].'/'.$cnt; ?>">https://kainkarya.com/home/questionnaire/<?php echo  $cur_year.'/'.$row['id'].'/'.$cnt; ?></a></td>
                                            <td style="font-size:14px;"><?php
                                                echo $type_name;
                                                ?></td>

                                             

                                        </tr>
                                    <?php $cnt--;$i++; endforeach;
                                    //  exit();
                                    ?>
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
<div id="pageloader">
    <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." />
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/ckeditor.js"></script>
<!-- <script type="text/javascript" src="//cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script> -->
<!-- include summernote css/js -->
<!-- <script src="<?php //echo base_url('public/ckeditor/ckeditor.js') ?>"></script> -->
<script type="text/javascript">
    // CKEDITOR.editorConfig = function(config) {
    //     config.language = 'es';
    //     config.uiColor = '#F7B42C';
    //     config.height = 300;
    //     config.toolbarCanCollapse = true;

    // };
    // CKEDITOR.replace('editor1');


    // CKEDITOR.replace("editor1", {
    //             extraPlugins: "wordcount,colorbutton,colordialog,font",
    //             wordcount: {
    //               showCharCount: !0,
    //               showWordCount: !0
    //     },
    //     removeButtons: "Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar"
    //     });
    //     CKEDITOR.replace("marquee", {
    //             extraPlugins: "wordcount,colorbutton,colordialog,font",
    //             wordcount: {
    //               showCharCount: !0,
    //               showWordCount: !0
    //     },
    //     removeButtons: "Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar"
    //     });
</script>
<script>
    $('#excel').on('click', function() {

        $("#dmstable").table2excel({
            filename: "Questionnaire Lists.xlsx"
        });
        //let table = document.getElementsByTagName("table");
        // let table=$('#dmstable').find('table');
        //      TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
        //         name: `Questionnaire Lists.xlsx`, // fileName you could use any name
        //         sheet: {
        //            name: 'Sheet 1' // sheetName
        //          }
        //        });
    });

    function copyToClipboard(id) {
        var copyText = document.getElementById("cp" + id).innerHTML;
        navigator.clipboard
            .writeText(copyText)
            .then(() => alert("Copied"))
            .catch((err) => console.error(`Error copying to clipboard: ${err}`));
    }
    function deleteQuestion(id){
        if(confirm("Are you sure want to delete?")===true){
            window.location.href="<?php echo base_url(); ?>questionnaire/delete/"+id;
        }
    }
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
            if ($('.multi-field', $wrapper).length > 1)
                $(this).parent('.multi-field').remove();
        });
    });

    $(function() {
        $("#select1").select2();
    });

    $('#export-excel').on("click", function() {

        $.ajax({
            url: "<?php echo site_url() ?>home/export_excel",
            method: "POST",
            type: "ajax",
            data: {
                "excel": 1
            },
            success: function(result) {
                console.log(data);
            },
            error: function(error) {
                console.log(error);
            }
        });

    })


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

    $(function(){
        setTimeout(() => {
            $("#dmstable11").dataTable({
            order: [[0, 'DESC']],
			dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-5'i><'col-sm-7'p>>",
		}); 
        }, 1500);
       
    });
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