<?php
include "header.php";
?>
<style>
	/*a{
		color:#000080!important;
	}*/
</style>
<section class="banner-area organic-breadcrumb" style="">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first">
                <h2 class="">Download Forms</h2>
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
					<h4>
					<!-- <ol>
						 <li><a href="<?php echo base_url('public/assets/downloads/Kainkarya_Charitable_Trust_Education_Aid_Form.pdf');?>" target="_blank">Application Form - Education - English</a></li>
						<li><a href="<?php echo base_url('public/assets/downloads/Kainkarya_Charitable_Trust_Last Rites_Aid_Form.pdf');?>" target="_blank">Application Form - Last Rites - English</a></li> 
						 <li><a class="text-blue" href="<?php echo base_url('public/assets/downloads/Kainkarya_Charitable_Trust_Last Rites_Aid_Form.pdf');?>" target="_blank">Application Form - Last Rites </a></li>
						
						<li><a class="text-blue" href="<?php echo base_url('public/assets/downloads/Kainkarya_Charitable_Trust_Education_Aid_Form.pdf');?>" target="_blank">Application Form - Education </a></li>
                       <li><a class="text-blue" href="<?php echo base_url('public/assets/downloads/Kainkarya_Charitable_Trust_Medical_Aid_Form_English.pdf');?>" target="_blank">Application Form - Medical  </a></li>
						<li><a class="text-blue" style="font-size: 16px;" href="<?php echo base_url('public/assets/downloads/KCT_Last Rites Aid Form.pdf');?>" target="_blank">இறுதிச் சடங்கு உதவிக்கான விண்ணப்பம்</a></li>
						<li><a class="text-blue" style="font-size: 16px;" href="<?php echo base_url('public/assets/downloads/KCT_Education Aid Form_Tamil.pdf');?>" target="_blank">கல்விக் கட்டண உதவிக்கான விண்ணப்பம்</a></li>
						
						<li><a class="text-blue" href="<?php echo base_url('public/assets/downloads/KCT_Disbursement-Voucher_Form.pdf');?>" target="_blank">Disbursement Voucher</a></li>
						<li><a class="text-blue" href="<?php echo base_url('public/assets/downloads/KCT_Aid_Last Rites_Documents Required.pdf');?>" target="_blank">List Documents Required - Last Rites</a></li>
						<li><a class="text-blue" href="<?php echo base_url('public/assets/downloads/KCT_Aid_Education_Documents Required.pdf');?>" target="_blank">List Documents Required - Education</a></li>					
					<ol> -->
					<?php
					if(isset($records)){
						foreach($records as $row){  ?>
						<li><a class="text-blue" style="font-size: 16px;" href="<?php echo $row->file_path ?>" target="_blank"><?php echo $row->title; ?></a></li>
						<?php }
					}
					?>
					</ol>
				</h4>
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