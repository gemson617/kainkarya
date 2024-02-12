<?php
include "header.php";
?>
<!--  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> 
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->

<!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->

<section class="banner-area organic-breadcrumb" style="">
	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center">
			<div class="col-first">
				<h2 class="">Gallery</h2>
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
						<div class="row gallery-item" id="sub_image">
							<?php foreach ($gallery_album as $key => $g) {

								?>
								<div class="col-md-3" >
									<div class="single-gallery-image" style="background: url(<?php echo base_url('admin/public/assets/gallery/'.$g->image)?>);" onclick="getimage(<?php echo $g->g_id;?>)"></div>
									   <div class="text" style=" color: blue;font-weight: bold;"><?php echo $g->caption; ?></div>

								</div>	
							<?php } ?>

						</div>
						<div class="row gallery-item" id="sub_image1"></div>
					</div>
				</div>
			</div>		
		</div>
	</div>
</div>

<!-- End My Account -->

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;">
      </div>
    </div>
  </div>
</div>
<script >
	function getimage(g_id){

       $('#sub_image').hide();
		//alert(g_id);
		var base_url = '<?php echo base_url(); ?>';

		$.ajax({
			url: "<?php echo site_url('home/get_images') ?>",
			method: 'POST',
			dataType: "json",
			data: {
				g_id: g_id,

			},
			success: function(data) {

				$('#sub_image1').html('');

				if (data != '') {
					$.each(data, function(i, item) {
							

						var noti_content = $('<div class="col-md-3" > <a href="#" class="pop" id="pop"> <img id="myImg'+i+'" src="'+base_url+'admin/public/assets/gallery/'+item.image+'" width="250" height="250" onclick="pou_up('+i+');"></a> <div class="text" style=" color: blue;font-weight: bold;">'+item.caption+'</div></div');

						noti_content.appendTo('#sub_image1');

					});

				} 
			}

		});
	}

</script>
<script>
	function pou_up(i){

var youtubeimgsrc = document.getElementById("myImg"+i).src;


              $('.imagepreview').attr('src', youtubeimgsrc);
              $('#imagemodal').modal('show');
	}
 
</script>
<?php
include "footer.php";
?>