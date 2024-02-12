<?php
include "header.php";
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
/*img {vertical-align: middle;}*/

/* Slideshow container */
.slideshow-container {
	margin-top: 30%;
  /*margin-bottom: 100px;
  margin-right: 150px;
  margin-left: 80px;*/
  max-width: 100%;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
	color: #f2f2f2;
	font-size: 15px;
	padding: 8px 12px;
	position: absolute;
	bottom: 8px;
	width: 100%;
	text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
	color: #f2f2f2;
	font-size: 12px;
	padding: 8px 12px;
	position: absolute;
	top: 0;
}

/* The dots/bullets/indicators */
.dot {
	height: 15px;
	width: 15px;
	margin: 0 2px;
	background-color: #bbb;
	border-radius: 50%;
	display: inline-block;
	transition: background-color 0.6s ease;
}

.active {
	background-color: #717171;
}

/* Fading animation */
.fade {
	-webkit-animation-name: fade;
	-webkit-animation-duration: 7.5s;
	animation-name: fade;
	animation-duration: 7.5s;
}

@-webkit-keyframes fade {
	from {opacity: .4} 
	to {opacity: 1}
}

@keyframes fade {
	from {opacity: .4} 
	to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
	.text {font-size: 11px}
}
</style>
<!-- start banner Area -->

<section class="banner-area " id="home">
		<!-- <div class="container-fluid">
			<div class="row fullscreen align-items-center justify-content-center"> -->
				<div class="slideshow-container">
					<?php foreach ($slider as  $s) {?>
						<div class="mySlides fade">

							<img src="<?php echo base_url('admin/public/assets/gallery/').$s->image;?>" style="width:100%">
							<div class="text" style=" color: white;font-weight: bold; font-size: 30px;"><?php echo $s->caption; ?></div> 
						</div>
					<?php } ?>
				</div>
				<div style="text-align:center">
					<?php foreach ($slider as  $s) {?>
						<span class="dot"></span> 
					<?php } ?>
					
				</div>
				<!-- <div class="col-lg-12 col-md-12 d-flex align-self-end img-right no-padding">
					<img class="img-fluid" src="<?php echo base_url('public/assets/img/gallery/header-bg.jpg');?>" alt="">
				</div> -->
				<!-- <div class="banner-content col-lg-6 col-md-12" style="margin-top: 10%;">
					<h1 class="text-uppercase">
						"நற்செயலில் ஈடுபடுபவர்களைக் கடவுள் ஒருபோதும் கைவிட மாட்டார்."
					</h1>
					<h1 class="title-top" align="center"><span>― மகா பெரியவா</span></h1>
					<button class="primary-btn text-uppercase"><a href="#">DONATE NOW</a></button>
				</div> -->							
			<!-- </div>
			</div> -->
		</section>
		<!-- End banner Area -->	

		<!-- Start category Area -->
		<section class="category-area section-gap section-gap" id="about-us">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="menu-content pb-40 mt-10">
						<div class="title">
							<h1 class="mb-10">KAINKARYA CHARITABLE TRUST</h1>
							<br />
							<p align="justify">
								<b>"HIS HOLINESS CHANDRASEKARENDRA SARASWATHI SWAMIGAL"</b>, the MAHAPERIYAVA of Kanchi Kamakoti Peetam in one of his discourses enlightens us about the performance of the last rites to the departed souls. Talking extensively on the need of the Pretha Samskaram, HE questions, should we not offer due tribute to a person, who had done a lot of good deeds using his body? Explaining in detail on this, an individual can perform lot of yagas and yagnas himself to relate to his merits and demerits (Papa and Punya) but cannot perform his final yagna, the Antha Ishti where his body is offered back to the Lord who created it. 
							</p>
							<p align="justify">
								HE concludes that the body which is the greatest creation of God should be returned to HIM with due respects after it is dead. While the relatives perform the final yagna, the last rites, for the departed soul, HE questions the plight of the destitute or orphans who have no relatives. Under these circumstances he directs that it is the responsibility of the members of the society to perform the last rites of such orphans. He emphasizes that it is a sin to dispose of the bodies without any rites as done by the authorities of Municipal and Panchayat. 
							</p>

							<div align="center"><img src="<?php echo base_url('public/assets/img/kainkarya-quotes.jpg');?>"></div>

							<p align="justify">
								In his words, <b>“Doing Paropakaram"</b> (social service) itself is equivalent to performing Ashwamedha Yaga. And with that we can get the grace of Ambal, I have till not told you which Paropakaram gives the same benefits as that of performing an Ashwamedha Yaga! What Paropakaram is that? The answer is Pretha Samskara. It is the most supreme amongst all Paropakarams. Shastra says <b>“Anatha Pretha Samskarath Ashwamedha Phalam Labet”</b> When we help perform Pretha Samskara for orphaned or unclaimed bodies, it saves us from committing the impending sins and thus helps us help our own selves too. On the death of an orphan, irrespective of the religion or caste he belongs to, we must help is own community in doing the Pretha Samskara rituals as stipulated for the community. One should take special interest and liberally offer money and inputs to the bereaved family to carry out Pretha Samskara rituals as per Shastras.
							</p>
						</div>
					</div>
				</div>
				<div class="countdown-content pb-40">
					<div class="title text-center">
						<h1 class="mb-10">Main Objectives</h1>
						<p>Inspired by HIS advices, few of us have joined to form the KAINKARYA CHARITABLE TRUST. <b>"We contribute our mite on a monthly basis to fund this Trust."</b> 
							<img src="http://kainkarya.com/public/assets/img/gallery/SV23.jpeg" style="margin-left: 25px;width: 300px;">
							<img src="http://kainkarya.com/public/assets/img/gallery/SV17.jpeg" style="margin-left: 25px;width: 300px;">
							<img src="http://kainkarya.com/public/assets/img/gallery/SV22.jpeg" style="margin-left: 25px;width: 300px;">
						</p>
					</div>
					<div class="mt-10">
						<ul class="color-with-marker">
							<li>To provide moral, physical, financial and accessorial assistance to the poor, old and infirm people and/or destitute, for the performance of the last rites of their deceased kin and thereby provide such deceased an honourable funeral.<img src="http://kainkarya.com/public/assets/img/gallery/SV14.jpeg" style="float: right; margin-left: 25px;width: 300px;"></li>
							<li><img src="http://kainkarya.com/public/assets/img/gallery/SV24.jpeg" style="float: left; margin-right: 25px;width: 200px;"> To facilitate with Persons and accessories such as Freezer boxes, Funeral Van and such other accessories that are required in the performance of the last ites of any deceased person from the time of last breath to cremation or burial of the deceased as per their customs. </li>
							<li>To provide basic education, render help, assistance whether in cash or kind to the poor, needy, orphan-students without discrimination of sex, caste, creed and language.</li>
						</ul>
					</div>
				</div>
				
			<!-- <div class="row">
				<div class="col-lg-12 col-md-12 mb-10">
					<div class="row category-bottom">
						<div class="col-lg-12">
							<div class="content">
								<a href="#" target="_blank">
							  		<img class="content-image img-fluid d-block mx-auto" src="<?php echo base_url('public/assets/img/c3.jpg');?>" alt="">
							    </a>
							</div>
					  	</div>
					</div>
				</div>
			</div> -->
		</div>	
	</section>
	<!-- End category Area -->
	
	<!-- Start men-product Area -->
	<section class="men-product-area section-gap relative pt-40" id="trustees">
		<div class="overlay overlay-bg"></div>
		<div class="container-fluid">
			<div class="row d-flex justify-content-center">
				<div class="menu-content">
					<div class="title text-center">
						<img src="<?php echo base_url('public/assets/img/logo.png');?>" width="100">
						<h1 class="mb-10 mt-10">Board of Trustees </h1>
						<!-- <p class="text-white">Lorem Ipsum has been the industry's standard dummy text.</p> -->
					</div>
				</div>
			</div>
			<div class="row justify-content-md-center">
				<div class="col-lg-2 col-md-6 single-product">
					<div class="content">
						<div class="content-overlay"></div>
						<img class="content-image img-fluid d-block mx-auto" src="<?php echo base_url('public/assets/img/trustees/KUMAR.jpg');?>" alt="">
					</div>
					<div class="price" align="center">
						<h5 class="text-blueb">Sri. V. V. KUMAR </h5>
						<h5 class="text-white">Managing Trustee </h5>
						<h6 class="text-blue pt-1"><i class="fa fa-phone fa-2"></i> +91 9600087618</h6>
					</div>
				</div>	
				<div class="col-lg-2 col-md-6 single-product">
					<div class="content">
						<div class="content-overlay"></div>
						<img class="content-image img-fluid d-block mx-auto" src="<?php echo base_url('public/assets/img/trustees/DEVANATHAN.jpg');?>" alt="">				      
					</div>
					<div class="price" align="center">
						<h5 class="text-blueb">Sri. V. DEVANATHAN</h5>
						<h5 class="text-white">Trustee</h5>
						<h6 class="text-blue pt-1"><i class="fa fa-phone fa-2"></i> +91 9442514161</h6>					  		
					</div>							  
				</div>	
				<div class="col-lg-2 col-md-6 single-product">
					<div class="content">
						<div class="content-overlay"></div>
						<img class="content-image img-fluid d-block mx-auto" src="<?php echo base_url('public/assets/img/trustees/VENKATASUBRAMANIAN.jpg');?>" alt="">
					</div>
					<div class="price" align="center">
						<h5 class="text-blueb">Sri. S. VENKATASUBRAMANIAN</h5>
						<h5 class="text-white">Trustee</h5>
						<h6 class="text-blue pt-1"><i class="fa fa-phone fa-2"></i> +91 9444069446</h6>
					</div>
				</div>	
				<div class="col-lg-2 col-md-6 single-product">
					<div class="content">
						<div class="content-overlay"></div>
						<img class="content-image img-fluid d-block mx-auto" src="<?php echo base_url('public/assets/img/trustees/HARIHARAMURTHY.jpg');?>" alt="">
					</div>
					<div class="price" align="center">
						<h5 class="text-blueb">Sri. S. HARIHARA MURTHY</h5>
						<h5 class="text-white">Trustee</h5>
						<h6 class="text-blue pt-1"><i class="fa fa-phone fa-2"></i> +91 9380615154</h6>
					</div>
				</div>						
				<div class="col-lg-2 col-md-6 single-product">
					<div class="content">
						<div class="content-overlay"></div>
						<img class="content-image img-fluid d-block mx-auto" src="<?php echo base_url('public/assets/img/trustees/GANESAN.jpg');?>" alt="" height="300">
					</div>
					<div class="price" align="center">
						<h5 class="text-blueb">Sri. A. V. GANESAN</h5>
						<h5 class="text-white">Trustee</h5>
						<h6 class="text-blue pt-1"><i class="fa fa-phone fa-2"></i> +91 9444277786</h6>
					</div>
				</div>																		
			</div>
		</div>	
	</section>
	<!-- End men-product Area -->

	<!-- Start women-product Area -->
	<section class="women-product-area section-gap relative pt-40" id="guiding" style="background-image: -webkit-linear-gradient(45deg, #ff5722 0%, #ff9800 45%, #ff5722 100%);">
		<div class="container-fluid">
			<div class="row d-flex justify-content-center">
				<div class="menu-content">
					<div class="title text-center">
						<img src="<?php echo base_url('public/assets/img/logo.png');?>" width="100">
						<h1 class="mb-10 mt-10">Governing Council Members</h1>
					</div>
				</div>
			</div>
			<div class="row d-flex justify-content-center">
				<div class="col-md-8">
					<div class="table-responsive">
						<table class="table table-stripped">
							<tr>
								<th>BADRINARAYANAN K R</th>
								<th>9444454492</th>
								<th>JAGADISH G</th>
								<th>9940632809</th>
							</tr>
							<tr>
								<th>KARTHIKEYAN M</th>
								<th>9790953769</th>
								<th>KESAVAN T A</th>
								<th>9444182067</th>
							</tr>
							<tr>
								<th>PATTABIRAMAN R</th>
								<th>9004600516</th>
								<th>RAMASWAMY R</th>
								<th>9884468030</th>
							</tr>
							<tr>
								<th>RANGARAJAN V L</th>
								<th>9600087450</th>
								<th>SIVASANKARAN M</th>
								<th>9840178044</th>
							</tr>
							<tr>
								<th>SRINIVASAN R</th>
								<th>9444013173</th>
								<th>THYAGARAJAN R</th>
								<th>9444248755</th>
							</tr>
							<tr>
								<th>VEDAVYAS K</th>
								<th>8939638200</th>
								<th>VENKATARAMAN N</th>
								<th>9962066018</th>
							</tr>
							<tr>
								<th>VIJAYAKUMAR S</th>
								<th>9444255701</th>
								<th>VISWANATHAN B</th>
								<th>9380261274</th>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>	
	</section>
	<!-- End women-product Area -->
	<div class="whole-wrap pb-30">
		<div class="container">
			<div class="section-top-border">
				<h3>Our Gallery</h3>
				<div class="row gallery-item">
					<div class="col-md-6">
						<a href="<?php echo base_url('public/assets/img/gallery/SV15.jpeg')?>" class="img-pop-up"><div class="single-gallery-image" style="background: url(<?php echo base_url('public/assets/img/gallery/SV15.jpeg')?>);"></div></a>
					</div>
					<div class="col-md-6">
						<a href="<?php echo base_url('public/assets/img/gallery/SV16.jpeg')?>" class="img-pop-up"><div class="single-gallery-image" style="background: url(<?php echo base_url('public/assets/img/gallery/SV16.jpeg')?>);"></div></a>
					</div>					
					<div class="col-md-6">
						<a href="<?php echo base_url('public/assets/img/gallery/SV17.jpeg')?>" class="img-pop-up"><div class="single-gallery-image" style="background: url(<?php echo base_url('public/assets/img/gallery/SV17.jpeg')?>);"></div></a>
					</div>					
					<div class="col-md-6">
						<a href="<?php echo base_url('public/assets/img/gallery/SV18.jpeg')?>" class="img-pop-up"><div class="single-gallery-image" style="background: url(<?php echo base_url('public/assets/img/gallery/SV18.jpeg')?>);"></div></a>
					</div>					
					<div class="col-md-4">
						<a href="<?php echo base_url('public/assets/img/gallery/SV14.jpeg')?>" class="img-pop-up"><div class="single-gallery-image" style="background: url(<?php echo base_url('public/assets/img/gallery/SV14.jpeg')?>);"></div></a>
					</div>					
					<div class="col-md-4">
						<a href="<?php echo base_url('public/assets/img/gallery/SV24.jpeg')?>" class="img-pop-up"><div class="single-gallery-image" style="background: url(<?php echo base_url('public/assets/img/gallery/SV24.jpeg')?>);"></div></a>
					</div>		
					<div class="col-md-4">
						<a href="<?php echo base_url('public/assets/img/gallery/SV23.jpeg')?>" class="img-pop-up"><div class="single-gallery-image" style="background: url(<?php echo base_url('public/assets/img/gallery/SV23.jpeg')?>);"></div></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="countdown-area" id="donate">
		<div class="container">
			<div class="countdown-content">
				<div class="title text-center">
					<h1 class="mb-10">Liberal Donations are WELCOME</h1>
					<p>One should take special interest and liberally offer money and inputs to the bereaved family to carry out Pretha Samskara rituals as per Shastras.</p>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-xl-4 col-lg-4 text-right">
					<img src="<?php echo base_url('public/assets/img/Donate.png');?>" class="img-fluid cd-img" alt=""></div>
					<div class="col-xl-8 col-lg-8 text-left">

						<h4 class="dontes-info">
							Account Number: 39728941580 <br />
							Bank Name: STATE BANK OF INDIA, <br />
							Branch Name: MANDAVELI, CHENNAI - 600028. <br />
							IFSC Code: SBIN0001854 <br />
							MICR: 600002028 <br />
							PAN: AAETK3106D<br/>
							12AA&nbsp;URN: AAETK3106DE20219<br/>
							80G&nbsp;&nbsp;URN: AAETK3106DF20217<br/>
							
						</h4>
						<!-- <p>We are coming shortly with online payment gateway</p> -->
					 <div class="col-md-2">
					 <div class="donate-btn" style="font-weight: bold;"><a href="<?php echo base_url('donate'); ?>" class="">DONATE</a></div> 
						</div> 

					</div>
				</div>
			</div>

		</section>

		<script>
			var slideIndex = 0;
			showSlides();

			function showSlides() {

				var i;
				var slides = document.getElementsByClassName("mySlides");
				var dots = document.getElementsByClassName("dot");
				for (i = 0; i < slides.length; i++) {
					slides[i].style.display = "none";  
				}
				slideIndex++;
				if (slideIndex > slides.length) {slideIndex = 1}    
					for (i = 0; i < dots.length; i++) {
						dots[i].className = dots[i].className.replace(" active", "");
					}
					slides[slideIndex-1].style.display = "block";  
					dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 3000); // Change image every 2 seconds
}
</script>
<?php
include "footer.php";
?>