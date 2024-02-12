<!doctype html>
<html lang="en">

<head>

	<title><?php echo (isset($title))?$title:'Kainkarya'; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?= base_url('public/adn-assets/vendor/bootstrap/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?= base_url('public/adn-assets/vendor/font-awesome/css/font-awesome.min.css');?>">
	<link rel="stylesheet" href="<?= base_url('public/adn-assets/vendor/linearicons/style.css');?>">
	<link rel="stylesheet" href="<?= base_url('public/adn-assets/vendor/chartist/css/chartist-custom.css');?>">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?= base_url('public/adn-assets/css/main.css');?>">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?= base_url('public/adn-assets/css/demo.css');?>">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('public/adn-assets/img/apple-icon.png');?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('public/adn-assets/img/favicon.png');?>">
	<script src="<?= base_url('public/adn-assets/vendor/jquery/jquery.min.js');?>"></script> 
	<script src="<?= base_url('public/adn-assets/scripts/klorofil-common.js');?>"></script>  
	<!-- <script src="<?= base_url('public/adn-assets/vendor/bootstrap/js/bootstrap.min.js');?>"></script>  -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script src="<?= base_url('public/adn-assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>  
	<script src="<?= base_url('public/adn-assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js');?>"></script>
	<script src="<?= base_url('public/adn-assets/vendor/chartist/js/chartist.min.js');?>"></script> 
	 <script src="<?php echo base_url();?>public/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo base_url();?>public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
         <script src="<?php echo base_url();?>public/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?php echo base_url();?>public/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <style type="text/css">
        	.sidebar .nav > li > a{
        		padding: 8px 30px!important;
        	}
        	.panel{
        		background:#f8c8aa!important;
        	}
        	#wrapper .sidebar{
        		background: #000080!important;
        	}
        	.sidebar .nav > li > a{
        		color:#ffffff!important;
        	}
        	.panel .panel-heading .panel-title{
        		color: #000080!important;
        		font-weight: bold!important;
        	}
        	.panel .panel-heading{
        		padding-top: 10px!important;
        		padding-bottom: 0px!important;
        	}

        	.upload-area{
   /* width: 70%;
    height: 200px;*/
    border: 2px solid lightgray;
    border-radius: 3px;
    margin: 0 auto;
   /* margin-top: 100px;*/
    text-align: center;
    overflow: auto;
}

.upload-area:hover{
    cursor: pointer;
}

.upload-area h1{
    text-align: center;
    font-weight: normal;
    font-family: sans-serif;
    line-height: 50px;
    color: darkslategray;
}

#aid_pdf_mail{
    display: none;
}

/* Thumbnail */
.thumbnail{
    width: 80px;
    height: 80px;
    padding: 2px;
    border: 2px solid lightgray;
    border-radius: 3px;
    float: left;
}

.size{
    font-size:12px;
}
        </style>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="#" style="font-size:15px;color:#000080;font-weight: bold;">KAINKARYA CHARITABLE TRUST</a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<!-- <li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">5</span>
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
								<li><a href="#" class="more">See all notifications</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#">Basic Use</a></li>
								<li><a href="#">Working With Data</a></li>
								<li><a href="#">Security</a></li>
								<li><a href="#">Troubleshooting</a></li>
							</ul>
						</li> -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><!-- <img src="<?= base_url('public/adn-assets/img/user.png');?>" class="img-circle" alt="Avatar"> --><i class="icon-submenu lnr lnr-chevron-down"></i><span><?php echo $this->session->userdata('firstName'); ?></span> </a>
						<!-- 	<ul class="dropdown-menu"> -->
								<!-- <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li> -->
								<!-- <li><a href="<?= base_url('auth/logout') ?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li> -->
								<!-- <li>hii</li> -->
						<!-- 	</ul> -->
						</li>
						<li><a href="<?= base_url('auth/logout') ?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="<?= base_url('dashboard') ?>" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="<?= base_url('home/settings') ?>" class=""><i class="lnr lnr-laptop-phone"></i> <span>Trust Settings</span></a></li>
						<li><a href="<?= base_url('home/financial_year') ?>" class=""><i class="lnr lnr-calendar-full"></i> <span>Financial Year</span></a></li>
						<li><a href="<?= base_url('home/register') ?>" class=""><i class="lnr lnr-user"></i> <span>User Registration</span></a></li>
						 <li><a href="<?= base_url('home/view_users') ?>"><i class="lnr lnr-user"></i> <span>User Profiles</span></a></li> 
						<li><a href="<?= base_url('donation/donation') ?>" class=""><i class="lnr lnr-file-empty"></i> <span>Donation</span></a></li>
						<li><a href="<?= base_url('home/donation_list') ?>" class=""><i class="lnr lnr-list"></i> <span>Donation List</span></a></li>
						<li><a href="<?= base_url('home/get_online_donation') ?>" class=""><i class="lnr lnr-list"></i> <span>Online Donation List</span></a></li>
						<li><a href="<?= base_url('home/donation_register') ?>"><i class="lnr lnr-menu"></i> <span>Donation Register</span></a></li>
						<li><a href="<?= base_url('gallery/gallery_album') ?>" ><i class="lnr lnr-picture"></i> <span> Gallery Album </span></a></li>
						<li><a href="<?= base_url('gallery/gallery') ?>" class=""><i class="lnr lnr-picture"></i> <span> Gallery Management </span></a></li>
						<li><a href="<?= base_url('video/album') ?>" ><i class="lnr lnr-camera-video"></i> <span> Video Album</span></a></li> 
						<li><a href="<?= base_url('video') ?>" class=""><i class="lnr lnr-camera-video"></i> <span> Video Management</span></a></li> 
						<li><a href="<?= base_url('home/aid_upload') ?>" class=""><i class="lnr lnr-upload"></i> <span>Document Upload</span></a></li>
						<li><a href="<?= base_url('home/aid_pdf') ?>" class=""><i class="lnr lnr-upload"></i> <span>10 BE upload</span></a></li>
						<!-- <li><a href="<?= base_url('home/pdf_users') ?>" class=""><i class="lnr lnr-upload"></i> <span>Pdf List</span></a></li> -->
						<li><a href="<?= base_url('gallery/slider') ?>" class=""><i class="lnr lnr-layers"></i> <span>Slider Management</span></a></li>
						
						<!-- <li><a href="<?= base_url('home/annual_upload') ?>" class=""><i class="lnr lnr-upload"></i> <span>Annual Reports Upload</span></a></li> -->

						<!-- <li><a href="charts.html" class=""><i class="lnr lnr-chart-bars"></i> <span>Charts</span></a></li>
						<li><a href="panels.html" class=""><i class="lnr lnr-cog"></i> <span>Panels</span></a></li>
						<li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Notifications</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Pages</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="page-profile.html" class="">Profile</a></li>
									<li><a href="page-login.html" class="">Login</a></li>
									<li><a href="page-lockscreen.html" class="">Lockscreen</a></li>
								</ul>
							</div>
						</li>
						<li><a href="tables.html" class=""><i class="lnr lnr-dice"></i> <span>Tables</span></a></li>
						<li><a href="typography.html" class=""><i class="lnr lnr-text-format"></i> <span>Typography</span></a></li>
						<li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li> -->
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->


		<!-- MAIN CONTENT -->

		<?php echo (isset($content))?$content:''; ?>

		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy;<?php echo date('Y'); ?> <a href="#" target="_blank">Kainkarya</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->

	
	<script>
		$(function() {

			$('input:radio[name=donateMonthly]').on('click', function(){

				if($(this).val() >= 1){
					$('#amount').removeAttr('readonly');
				}

			});

			$('#amount').keyup(function(){

				if($(this).val() >=5000 && $('input:radio[name=donateMonthly]:checked').val() == 2) {
					$('#declaration').css('display', 'block');
				}else{
					$('#declaration').css('display', 'none');
				}

			});



		});
	</script>
</body>

</html>
<script type="text/javascript">
   $(function(){
        $("#dmstable").dataTable();

   // preventing page from redirecting
    $("html").on("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#drg_txt").text("Drag here");
    });

    $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });

    // Drag enter
    $('.upload-area').on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("#drg_txt").text("Drop");
    });

    // Drag over
    $('.upload-area').on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("#drg_txt").text("Drop");
    });

    // Drop
    $('.upload-area').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();
	
  		var fd = new FormData();
        var year=$('#year').val();
        if(year.length > 0){
        	  $("#drg_txt").text("Uploading...");
        var file = e.originalEvent.dataTransfer.files;

           //console.log(files_list);  
           for(var i=0; i<file.length; i++)  
           {  
                fd.append('pdf_files[]', file[i]);  
           }  
   		 fd.append("year",year);   
        	uploadData(fd);
        }else{
        	alert('Please Choose year');
        }
    });

    // Open file selector on div click
    $("#uploadfile").click(function(){
        $("#aid_pdf_mail").click();
    });

    // file selected
    $("#aid_pdf_mail").change(function(){

    	var fileInput =document.getElementById('aid_pdf_mail');
    var filePath = fileInput.value;
    // Allowing file type
    var allowedExtensions = /(\.pdf)$/i;
    
    if (!allowedExtensions.exec(filePath)) {
        alert("File Format Not Support");
    fileInput.value = '';
    $('#aid_pdf_mail').val('');
    $("#drg_txt").text("Drag and Drop file here Or Click to select file");
    return false;
    } 

var year=$('#year').val();
 if(year.length > 0){
        var fd = new FormData();
 			var files = $('#aid_pdf_mail')[0].files;
       for (var i = 0; i < files.length; i++) {
        fd.append("pdf_files[]", document.getElementById('aid_pdf_mail').files[i]);
    }
         
         fd.append("year",year);

        uploadData(fd);
    }else{
    	alert('Please Choose year');
    }
    });

    // Sending AJAX request and upload file
function uploadData(formdata){

    $.ajax({
        url:  "<?php echo site_url() ?>home/aid_upload_pdf",
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(response){
            	//console.log(response);
            	window.location="<?php echo site_url() ?>home/aid_pdf";
            }
            
        }
    });
}

});





   
</script>
