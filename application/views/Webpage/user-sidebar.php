<style type="text/css">
.main-nav-list a{
	font-weight: bold;
}
</style>
<div class="sidebar-categories">
	<!-- <div class="head">My Account</div> -->
	<ul class="main-categories">
		<!-- <li class="main-nav-list"><a href="<?= base_url('MyDashboard') ?>">Dashboard</a></li> -->
		<li class="main-nav-list"><a href="<?= base_url('Profile') ?>">My Profile</a></li>
		<li class="main-nav-list"><a href="<?= base_url('change_password') ?>">Change Password</a></li>
		<li class="main-nav-list"><a href="<?= base_url('MyReceipts') ?>">My Receipts</a></li>
		<li class="main-nav-list"><a href="<?= base_url('home/annual_report') ?>"> Annual Statements</a></li>
		<li class="main-nav-list"><a href="<?= base_url('home/view_certificate') ?>">10 BE Certificates</a></li>
		<?php 
		$auth_level=$this->session->userdata('auth_level');

		if ($auth_level == 6 || $auth_level == 8 || $auth_level == 9 || $auth_level == 10) {
			?>
			<li class="main-nav-list"><a href="<?= base_url('home/view_aid') ?>">Trust Reports</a></li>
		<?php }?> 
		<li class="main-nav-list"><a href="<?= base_url('home/donate') ?>">Donate Now</a></li>
		
		<li class="main-nav-list"><a href="<?= base_url('home/view_users') ?>">Know About Others</a></li>
		<!-- <li class="main-nav-list"><a href="<?= base_url('UserLogout') ?>">Logout</a></li> -->
	</ul>
</div>