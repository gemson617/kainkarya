<style type="text/css">
  #progress{
    display: none;
    margin-left: 32%;
  }
</style>
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

} ?>
<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-1">
          <!-- INPUT GROUPS -->
          
          <!-- END INPUT GROUPS -->
        </div>
        <div class="col-md-8">

            <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Upload PDF</h3>
              <?php // ini_set('max_file_uploads','50'); echo ini_get('max_file_uploads'); ?>
            </div>
            <div class="panel-body">

              <form action="<?= base_url('home/aid_upload_mail_pdf') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                  <?php
                  if ($this->session->flashdata('alert_msg')) {
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <strong>Success!</strong> <?php echo $this->session->flashdata('alert_success'); ?>
                    </div>
                    <?php
                  }

                  if ($this->session->flashdata('alert_dan')) {
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
                  <div id="progress">
                      <img  src="../public/adn-assets/img/ajax-loader_dark.gif"/>
                  </div>
                 <div class="form-group">                                
                    <label for="firstName">Year</label>
                    <select name="financial_year" id="year" class="form-control">
                  <option value="">---Select Financial Year---</option>
                  <?php foreach ($year as $row) { ?>
                    <option value="<?php echo $row['year']; ?>"><?php echo $row['year']; ?></option>
                    <?php 
                  }
                  ?>
                </select>
                  </div>

                  <div class="form-group">                                
                   
                    <input type="file" id="aid_pdf_mail" multiple name="aid_pdf_mail[]" class="form-control" >
                     <!-- Drag and Drop container-->
                      <div class="upload-area"  id="uploadfile">
                          <h1 id="drg_txt">Drag and Drop file here<br/>Or<br/>Click to select file</h1>
                      </div>
                  </div>

                  <br>
                <!--   <button type="submit" name="submit" class="btn btn-primary">Submit</button> -->
                </div>
              </form>

            </div>
          </div>
          
        </div>
      </div>
    
  </div>

</div>
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