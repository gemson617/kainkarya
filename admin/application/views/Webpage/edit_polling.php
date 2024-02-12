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
                            <h3 class="panel-title">Polling</h3>
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
                            <form action="<?php echo base_url('Polling/edit/'.$default[0]->id) ?>" method="post">
                                <div class="form-group ">
                                    <label for="firstName">User Type</label>
                                    <select name="user_type" class="form-control select2" multiple required>
                                        <option value="">----Select ---</option>
                                        <option <?php if($default[0]->user_type==9){ echo "selected";}?> value="9">Trustee</option>
                                        <option <?php if($default[0]->user_type==6){ echo "selected";}?> value="6">Managing Trustee</option>
                                        <option <?php if($default[0]->user_type==8){ echo "selected";}?> value="8">General Council Member</option>
                                        <option <?php if($default[0]->user_type==7){ echo "selected";}?> value="7">Monthly Contributor </option>
                                        <option <?php if($default[0]->user_type==1){ echo "selected";}?> value="1">Other Contributor</option>

                                    </select>
                                </div>
                                <div class="form-group row ">
                              
                                    <div class="col-md-12">
                                        <label for="">Question</label>
                                        <input type="text" name="question" class="form-control" placeholder="Enter Question" value="<?php echo $default[0]->question;?>">
                                    </div>
                                    <?php foreach($default as $d){?>
                                    <div class="col-md-12">
                                        <label>Answer</label>
                                        <div class="multi-field-wrapper">
                                            <div class="multi-fields">
                                                <div class="multi-field">
                                                    <input type="text" name="answer[]" class="form-control" placeholder="Enter Answer" value="<?php echo $d->answer;?>">
                                                    <button type="button" class="add-field">Add More Answer</button>
                                                    <button type="button" class="remove-field">Remove Answer</button>
                                                </div>
                                            </div><br>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>


                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>

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
<!--  <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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