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
                <div class="col-md-8">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Document Upload</h3>
                        </div>
                        <div class="panel-body">

                            <form action="<?= base_url('home/aid_upload') ?>" method="post"
                                enctype="multipart/form-data">
                                <div class="form-group row">
                                    <?php
                  if ($this->session->flashdata('alert_success')) {
                    ?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Success!</strong>
                                        <?php echo $this->session->flashdata('alert_success'); ?>
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
                                        <strong>Success!</strong>
                                        <?php echo $this->session->flashdata('alert_warning'); ?>
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
                                        <label for="firstName">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="<?php echo $title; ?>" placeholder="Enter Your Tilte">
                                    </div>

                                    <div class="form-group">
                                        <label for="firstName">Financial Year</label>
                                        <select name="financial_year" id="year" class="form-control">
                                            <?php $trust_year= $yr=$this->mcommon->specific_row_value('company_setting','','current_financial_year'); ?>
                                            <!-- <option value="">---Select Financial Year---</option> -->
                                            <?php foreach ($year as $row) { ?>
                                            <option <?php echo ($row['year']==$trust_year) ? 'selected':''; ?>
                                                value="<?php echo $row['year']; ?>"><?php echo $row['year']; ?></option>
                                            <?php 
                  }
                  ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="firstName">Report Type</label>
                                        <select name="report_type" id="year" class="form-control">                                           
                                            <option value="">---Select Type---</option>
                                            <option value="1">Aid Register</option>
                                            <option value="2">Aid Summary</option>
                                            <option value="3">Collection Register</option>                                          
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="trust_pan">Upload File</label>
                                        <input type="file" name="aid_pdf" class="form-control"
                                            value="<?php echo $aid_pdf; ?>">
                                        <!--  <img src="<?php echo base_url('public/adn-assets/img/pan/').$trust_pan; ?>" style="width: 50px;"> -->
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
            <div class="row">
                <div class="col-md-12">
                    <!-- RECENT PURCHASES -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"> </h3>

                        </div>
                        <div class="panel-body no-padding">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S No.</th>
                                        <th>Title</th>
                                        <th>File</th>
                                        <th>Financial Year</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                    $typ=array('','Aid Register','Aid Summary','Collection Register');
                                    foreach ($aid_file as $g) { ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $g->title; ?></td>
                                        <td><?php echo $g->aid_file; ?></td>
                                        <td><?php echo $g->financial_year; ?></td>
                                        <td><?php echo $typ[$g->report_type]; ?></td>
                                        <td>                     
                                      <a href="<?php echo base_url();?>home/aid_delete/<?php echo $g->id;?>" ><i class="fa fa-trash" aria-hidden="true"></i></a>
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