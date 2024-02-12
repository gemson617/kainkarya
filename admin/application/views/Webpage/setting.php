<?php foreach ($setting as $s) {

  $id=$s->id;
  $trust_name=$s->trust_name;
  $trust_pan=$s->trust_pan;
  $trust_urn=$s->trust_urn;
  $contact_number=$s->contact_number;
  $trust_logo=$s->trust_logo;
  $receipt_prefix=$s->receipt_prefix;
  $address=$s->address;
  $trust_deed=$s->trust_deed;
  $current_financial_year=$s->current_financial_year;
  $charges=$s->charges;
  $marquee=$s->marquee;
  $active=$s->active;
} ?>
<style>
  .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;
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
               <h3 class="panel-title">Trust Settings</h3>
                        </div>
         
            <div class="panel-body">

              <form action="<?= base_url('home/settings') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
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
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <div class="form-group row" > 
                    <div class="col-md-6">                             
                      <label for="firstName">Trust Name</label>
                      <input type="text" name="trust_name" class="form-control" value="<?php echo $trust_name; ?>" >
                    </div>  
                    <div class="col-md-6">                                
                      <label for="trust_pan">Trust Pan </label>
                      <input type="text" name="trust_pan" class="form-control" value="<?php echo $trust_pan; ?>" placeholder="Enter Trust PAN">
                    </div>
                  </div>

                  <div class="form-group row" > 
                    <div class="col-md-6">
                      <label for="email">Trust URN</label>
                      <input type="text" name="trust_urn" class="form-control" placeholder="Enter Trust URN" value="<?php echo $trust_urn; ?>" >

                    </div>
                    <div class="col-md-6">
                      <label >Trust Contact number</label>
                      <input type="text" name="contact_number" value="<?php echo $contact_number; ?>"  class="form-control"  >
                    </div>
                  </div>
                  <div class="form-group row" > 
                   <div class="col-md-6">
                    <label >Trust Receipt prefix - KCT </label>
                    <input type="text" name="receipt_prefix" value="<?php echo $receipt_prefix; ?>" class="form-control" >
                  </div>
                  <div class="col-md-6">
                    <label >Current Financial Year</label>
                    <input type="text" name="current_financial_year" class="form-control" value="<?php echo $current_financial_year; ?>" >
                  </div>
                  
                </div>
                <div class="form-group">
                  <label >Trust Contact address</label>
                  <textarea name="address"  id="ckeditor"class="form-control" rows="5"><?php echo $address; ?></textarea>
                  <!-- <input type="text" name="address" value="" class="form-control"  > -->
                </div>
                <div class="form-group row" >
                <div class="col-md-6">
                  <label >Trust Deed</label>
                  <input type="file" name="trust_deed" class="form-control"  >
                  <img src="<?php echo base_url('public/adn-assets/img/pan/').$trust_deed; ?>" style="width: 50px;">
                </div>

                <div class="col-md-6">
                  <label for="email">Trust logo</label>
                  <input type="file" name="trust_logo" class="form-control"  >
                  <img src="<?php echo base_url('public/adn-assets/img/pan/').$trust_logo; ?>" style="width: 50px;">
                </div>
              </div>
              <div class="form-group">
                  <label for="">Marquee Management</label>
                  <textarea name="marquee" id="ckeditor1" class="form-control"><?php echo $marquee; ?></textarea>
                  <!-- <input type="text" name="marquee" class="form-control" placeholder="Enter Marquee Management" 
                  value="<?php echo $marquee; ?>"> -->
                </div>
             <div class="form-group row" >
                <div class="col-md-6">
                  <label for="">Charges Percentage</label>
                  <input type="text" name="charges" class="form-control" placeholder="Enter Charges Percentage "
                   value="<?php echo $charges; ?>">
                </div>

                <div class="col-md-6">
                  <label for="email">is active</label>
                  <input type="checkbox" name="active" value="1" <?php echo ($active==1) ? 'checked':''; ?> class="form-control"  >                 
                </div>
               
              </div>
                <br>

                <input type="hidden" name="trust_logo1" value="<?php echo $trust_logo; ?>">
                <input type="hidden" name="trust_deed1" value="<?php echo $trust_deed; ?>"> 

                <button type="submit" name="submit" class="btn btn-primary">Update Settings</button>
              </div>
            </form>

          </div>
        </div>
        <!-- END INPUT GROUPS -->
      </div>
    </div>
  </div>

</div>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/ckeditor.js"></script>
 <!-- <script type="text/javascript" src="//cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script> -->
 <!-- <script src="<?php echo base_url('public/ckeditor/ckeditor.js') ?>"></script> -->
<script>
/*   CKEDITOR.replace( 'marquee' ); */
</script>
<script>
  function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
    var y = document.getElementById("myInput1");
    if (y.type === "password") {
      y.type = "text";
    } else {
      y.type = "password";
    }
  }
</script>

<script>

// CKEDITOR.editorConfig = function(config) {
//         config.language = 'es';
//         config.uiColor = '#F7B42C';
//         config.height = 300;
//         config.toolbarCanCollapse = true;

//     };
//     CKEDITOR.replace('ckeditor');
//     CKEDITOR.replace('marquee');

        // CKEDITOR.replace("ckeditor", {
        //         extraPlugins: "wordcount,colorbutton,colordialog,font",
        //         wordcount: {
        //           showCharCount: !0,
        //           showWordCount: !0
        // },
        // removeButtons: "Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar"
        // });
        // CKEDITOR.replace("marquee", {
        //         extraPlugins: "wordcount,colorbutton,colordialog,font",
        //         wordcount: {
        //           showCharCount: !0,
        //           showWordCount: !0
        // },
        // removeButtons: "Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar"
        // });
      
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

<script>
            // This sample still does not showcase all CKEditor 5 features (!)
            // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
            CKEDITOR.ClassicEditor.create(document.getElementById("ckeditor1"), {
               
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