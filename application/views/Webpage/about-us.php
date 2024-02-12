<?php
include "header.php";
?>

<section class="banner-area organic-breadcrumb" style="">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first">
                <h2 class="" id="title">About Us</h2>
                 <!-- <nav class="d-flex align-items-center justify-content-start">
                    <a href="#">About Us<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <a href="#">About Us</a>
                </nav> -->
            </div>
        </div>
    </div>
</section>
<!-- Start My Account -->
<div class="container">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12" id="content">
			<?php //$content=$this->mcommon->specific_row_value('about_us',array('menu'=>1),'content'); ?>
			<?php echo $content ?>
		<!-- <section class="category-area section-gap" id="about-us">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="menu-content">
						<p align="justify">
							<strong>OHM…</strong><br/>
							
							By Grace of God and inspired by the sayings of His Holiness Sri Chandrasekarendra Saraswathi of Kanchi Kamakoti Mutt, 20 minds and hearts in May 2020, came together to unite and work for a
							noble cause of “honorary disposal of orphaned / unclaimed bodies&quot; and to help the families who could
							not afford to perform the last rites of their deceased kin. These persons decided to initiate their
							thoughts with a monthly contribution of Rs.1000 each, leading to the formation of <strong>Kainkarya Charitable
							Trust</strong>. A Trust open to all irrespective of caste, creed, religion and sex.
						</p>
						<p align="justify">
							The Trust was Registered on <strong>September 9, 2020</strong>.						
						</p>
						<p align="justify">
							Approval under <strong>Sec 12AA</strong> of the Income Tax Act was received on <strong>March 10, 2021</strong>.						
						</p>
						<p align="justify">
							The Trust accelerated its service from March 31 2021.						
						</p>
						<p align="justify">
							Steadily, many good souls joined hands and today, Kainkarya has more than 100 members as monthly
							contributors apart from many other donors.						
						</p>
						<p align="justify">
							Apart from the main objective of providing financial help for honorary disposal of orphaned / unclaimed
							bodies and to help the families who could not afford to perform the last rites of their deceased kin,
							<strong>Kainkarya Charitable Trust</strong> also expanded its horizon in its other objectives for providing Aid for
							Education, Medical and Food to the needy.						
						</p>
						<p align="justify">
							Buying apt vehicle(s) for carrying the mortals of the deceased and getting a good place for performance
							of last rites are long term objectives of Kainkarya.						
						</p>
						<p align="justify">
							<strong>KAINKARYA CHARITABLE TRUST</strong> would be grateful if generous people from all stakes could also join this
							noble cause either by contributing monthly or through donations, as you please.						
						</p>
						<p align="justify">
							You may also refer to our Trust the deserving cases whom you may come across for Aid.						
						</p>
						<p align="justify">
							In the words of <strong>Swamy Vivekananda:</strong>					
						</p>
						<p align="justify">
							“That which tends to increase the divinity in you is virtue. The poor, the illiterate, the ignorant, the
							afflicted…. Let these be your God. Know that services to that alone vis the highest religion.”						
						</p>
						<p align="justify">
							Let’s go forward and do yet greater things…
						</p>
					</div>
				</div>					
			</div>	
		</section>			 -->
		</div>
	</div>
</div>
<!-- End My Account -->
<script>
var arr=['','About Us','Our Inspiration','Our Vision & Mission','Our Objectives','Our Activities'];
$('#title').text(arr['<?= $this->uri->segment(2) ?>']);
$('#content').html('<?= $content ?>'); 
function getContent(id){
	var arr=['','About Us','Our Inspiration','Our Vision & Mission','Our Objectives','Our Activities'];
	
	$.ajax({
            url:"<?php echo base_url('home/getAboutContent'); ?>",
            method: "POST",
            type: "ajax",
            data:{
             'id':id
            },success:function(result) {
                if(result != 0){
					$('#content').html('');
                    var data = JSON.parse(result); 
					$('#title').text(arr[id]);
					$('#content').html(data);                 
                }
            },error:function (error) {
                console.log(error);
            }
         });
}

</script>
<?php
include "footer.php";
?>