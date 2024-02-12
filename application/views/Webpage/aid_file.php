<?php
include "header.php";
?>
<style type="text/css">
b, strong {
	font-weight: bold;
}
</style>
<section class="banner-area organic-breadcrumb" style="">
	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center">
			<div class="col-first">
				<h2> Trust Reports</h2>
                <!-- <nav class="d-flex align-items-center justify-content-start">
                    <a href="<?= base_url('/') ?>">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <a href="#">Annual Reports</a>
                </nav> -->
            </div>
        </div>
    </div>
</section>
<!-- Start My Account -->
<div class="container" style="margin-bottom: 60px !important;">
	<div class="row">
		<div class="col-xl-9 col-lg-8 col-md-7">
			<?php
			if ($this->session->flashdata('alert_success')) {
				?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<strong>Success!</strong> <?php echo $this->session->flashdata('alert_success'); ?>
				</div>
				<?php
			}

			if ($this->session->flashdata('alert_danger')) {
				?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<strong>ERROR!</strong> <?php echo $this->session->flashdata('alert_danger'); ?>
				</div>
				<?php
			}

			if ($this->session->flashdata('alert_warning')) {
				?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<strong>Success!</strong> <?php echo $this->session->flashdata('alert_warning'); ?>
				</div>
				<?php
			}
			if (validation_errors()) {
				?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<?php echo validation_errors(); ?>
				</div>
				<?php
			}
			?>
			<div class="card">
				<h3 class="card-header">Trust Reports</h3>
				<div class="card-body">            
					<table class="table table-striped">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Title</th>
								<th>File</th>
								<th>Financial Year</th>
                                <th>Type</th>
								<th>Created Date</th>
								
							</tr>
						</thead>
						<tbody>
							<?php
							$i=1; 
							$typ=array('','Aid Register','Aid Summary','Collection Register');
							foreach ($aid as $key => $a) { ?>

								<tr>
									<th><?php echo $i++; ?></th>
									<th><?php echo $a->title; ?></th>
									<th><a href="<?= base_url('admin/public/adn-assets/img/aid_file/' . $a->aid_file); ?>"> Download </a></th>
									<td><?php echo $a->financial_year; ?></td>
                                        <td><?php echo $typ[$a->report_type]; ?></td>
									<th><?php echo date("d-m-Y", strtotime($a->created_date)) ;?></th>
								</tr>
							<?php } ?>
						</tbody> 
					</table>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-lg-4 col-md-5">
			<?php include "user-sidebar.php"; ?>
		</div>
	</div>
</div>
<!-- End My Account -->

<?php
include "footer.php";
?>

