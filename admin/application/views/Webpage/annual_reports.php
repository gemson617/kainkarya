
<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">
      <h3 class="page-title"> Annual Reports</h3>
      <div class="row">
        <div class="col-md-8">
          <!-- INPUT GROUPS -->
          <div class="panel">
            <div class="panel-heading">

            </div>
            <div class="panel-body">

              <form action="<?= base_url('home/annual_upload') ?>" method="post" enctype="multipart/form-data">
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
<div class="form-group">                                
    <label for="firstName">Caption</label>
    <input type="text" name="title" class="form-control" value="<?php echo $title; ?>" placeholder="Enter Your Tilte">
</div>

<div class="form-group">                                
    <label for="trust_pan">Upload Reports</label>
    <input type="file" name="file" class="form-control" value="<?php echo $file; ?>">
</div>

<br>
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</div>
</form>

</div>
</div>
<!-- END INPUT GROUPS -->
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