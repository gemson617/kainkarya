<?php
include "header.php";
?>

<section class="banner-area organic-breadcrumb" style="">
	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center">
			<div class="col-first">
				<h2 class="">Videos</h2>
                <!--  <nav class="d-flex align-items-center justify-content-start">
                    <a href="#">About Us<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <a href="#">Our Mission</a>
                </nav> -->
            </div>
        </div>
    </div>
</section>
<!-- Start My Account -->
<div class="container">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="whole-wrap pb-30">
				<div class="container">
					<div class="section-top-border">
						<div class="row gallery-item" id="sub_video">
							<?php foreach ($video_album as $key => $v) {
								?>
								<div class="col-md-3">
									<div class="single-gallery-image" style="background: url(<?php echo base_url('admin/public/assets/gallery/'.$v->image)?>);" onclick="getvideo(<?php echo $v->v_id;?>)"></div>
									   <div class="text" style=" color: blue;font-weight: bold;"><?php echo $v->caption; ?></div>
								</div>	
							<?php } ?>
						</div>
						<div class="row gallery-item" id="sub_video1"></div>
					</div>
				</div>
			</div>		
		</div>
	</div>
</div>
<!-- End My Account -->
<script >
	function getvideo(v_id){

       $('#sub_video').hide();
		
		var base_url = '<?php echo base_url(); ?>';

		$.ajax({
			url: "<?php echo site_url('home/get_video') ?>",
			method: 'POST',
			dataType: "json",
			data: {
				v_id: v_id,

			},
			success: function(data) {

				$('#sub_video1').html('');

				if (data != '') {
					$.each(data, function(i, item) {
							

						var noti_content = $('<div class="col-md-3" > <iframe width="560" height="315" src="'+item.video+'" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div');

						noti_content.appendTo('#sub_video1');

					});

				} 
			}

		});
	}

</script>
<?php
include "footer.php";
?>