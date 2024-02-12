<?php
include "header.php";
?>

<section class="banner-area organic-breadcrumb" style="">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first">
                <h2 class="">Pamphlet</h2>
                 <!-- <nav class="d-flex align-items-center justify-content-start">
                    <a href="#">About Us<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <a href="#">Our Vision</a>
                </nav> -->
            </div>
        </div>
    </div>
</section>
<!-- Start My Account -->
<div class="container">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
	<section class="category-area section-gap" id="about-us">
		<div class="container">
			<div class="row d-flex">
				<div class="menu-content">
					<!-- <h4><a class="text-blue" href="<?php echo base_url('public/assets/downloads/KainkaryaCharitableTrustPamphletFinal.pdf');?>" target="_blank" title="Download Pamphlet">Pamphlet - Kainkarya Charitable Trust Pamphlet Final.pdf</a></h4>					 -->
					<?php
					if(isset($records)){
						foreach($records as $row){  ?>
						<h4><a class="text-blue" style="font-size: 16px;" href="<?php echo $row->file_path ?>" target="_blank"><?php echo $row->title; ?></a></h4>
						<?php }
					}
					?>
					
				</div>
			</div>					
		</div>	
	</section>			
		</div>
	</div>
</div>
<!-- End My Account -->

<?php
include "footer.php";
?>