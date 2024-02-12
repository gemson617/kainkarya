<?php foreach ($records as $r) {
} ?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <!-- INPUT GROUPS -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Online Donation</h3>
                        </div>

                        <div class="panel-body">
                            <div class="form-group row">

                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="firstName">First Name</label>
                                        <input type="text"  class="form-control" value="<?php echo $r->firstName; ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="trust_pan">Last Name </label>
                                        <input type="text" class="form-control" value="<?php echo $r->lastName; ?>" placeholder="Enter Trust PAN" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" placeholder="Enter Trust URN" value="<?php echo $r->email; ?>" readonly>

                                    </div>
                                    <div class="col-md-6">
                                        <label>Mobile Number</label>
                                        <input type="text"  value="<?php echo $r->mobileNo; ?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>PAN Number</label>
                                        <input type="text" value="<?php echo $r->panNumber; ?>" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Amount</label>
                                        <input type="text" class="form-control" value="<?php echo $r->amount; ?>" readonly>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" rows="5"><?php echo str_replace('br',PHP_EOL, $r->address); ?></textarea>

                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Donation Date</label>
                                        <input type="text"  class="form-control" readonly value="<?php echo date('d-m-Y', strtotime($r->receipt_date)); ?>">
                                       
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email">Transcation Number</label>
                                        <input type="text"  class="form-control" readonly value="<?php echo $r->transNumber; ?>">
                                       
                                    </div>
                                </div>
                               <!--  <div class="form-group">
                                    <label for="">Marquee Management</label>
                                    <textarea name="marquee" id="ckeditor" class="form-control"><?php echo $marquee; ?></textarea>

                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="">Charges Percentage</label>
                                        <input type="text" name="charges" class="form-control" placeholder="Enter Charges Percentage " value="<?php echo $charges; ?>" readonly>
                                    </div>

                                </div> -->
                                <br>

                                <a href="<?php echo base_url('home/get_online_donation'); ?>" class="btn btn-primary">Back</a>
                            </div>


                        </div>
                    </div>
                    <!-- END INPUT GROUPS -->
                </div>
            </div>
        </div>

    </div>