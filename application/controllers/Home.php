<?php


class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('Pdf');
		/* $this->load->helper(array('url','language'));
  $this->lang->load('auth');
  $this->load->helper('form');
  $this->load->helper('datatables_helper');
  $this->load->library('form_validation');
  $this->load->model('common_model','mcommon',TRUE);*/
		$user_id = $this->session->userdata('user_id');
		/* if (empty($user_id)) {

   redirect('Auth/logout');
 }*/
	}


	public function index()
	{
		$view_data['slider'] = $this->main->get_slider();
		// echo "<pre>";print_r($view_data['slider']);exit();
		$this->load->view('Webpage/home.php', $view_data);
	}


	public function view_certificate()
	{		
		if ($this->session->userdata('user_id')) {

			$user_id = $this->session->userdata('user_id');
			$setting = $this->mcommon->records_all('company_setting');
			if (isset($_POST['submit'])) {
				$year=$this->input->post('financial_year');
				$view_data['user_details'] = $this->mcommon->get_certification($this->session->userdata('user_id'),$year);
			}else{

				$view_data['user_details'] = $this->mcommon->get_certification();
			}

			$view_data['financial_year'] = $this->main->get_financial_year();
			

			$this->load->view('Webpage/be_certificate.php', $view_data);
		} else {
			redirect('login');
		}
	}

	public function checkUser(){
		$mobile=$this->input->post('mobile');
		$result=$this->mcommon->specific_row('users',array('mobile'=>$mobile));
		$userDetails=array($result['firstName'],$result['lastName'],$result['email'],$result['pan'],$result['address']);
		
		echo (empty($result)) ? 0:json_encode($userDetails);

	}

	public function donate()
	{
		if (isset($_POST['submit'])) {
		}
		$data[] = '';
		if ($this->session->userdata('user_id')) {

			$data['users'] = $this->mcommon->records_all('users', array('id' => $this->session->userdata('user_id'),));
		}

		$this->load->view('Webpage/donation_form', $data);
	}

	public function pay_success()
	{
		//echo "<pre>";print_r($_POST);exit();
		$setting = $this->mcommon->records_all('company_setting');
		foreach ($setting as $s) {

			$prefix = $s->receipt_prefix;
			$financial_year = $s->current_financial_year;
		}
		$count_no = $this->mcommon->specific_record_counts('donation', array('financial_year' => $financial_year,));
		$fin_data = $this->mcommon->records_all('financial_year', array('year' => $financial_year,));

		foreach ($fin_data as  $fd) {
			$pre_number = $fd->pre_number;
		}

		$added = $pre_number + $count_no + 1;

		if ($_POST['net_amount_debit'] > 4999) {
			$corpus = 2;
		} else {
			$corpus = 1;
		}
		if (!empty($_POST['zipcode'])) {
			$user_id = $_POST['zipcode'];
		} else {
			$insert_array = array(
				'firstName' => $_POST['firstname'],
				'lastName' => $_POST['city'],
				'email' => $_POST['email'],
				'password_hash' => $this->hash_passwd('Welcome@123'),
				'mobile' => $_POST['phone'],
				'pan'      => $_POST['address2'],
				'address'   => $_POST['address1'],
				'auth_level' => 1,
				'active' => 1,
				'created_at' => date('Y-m-d')
			);
			$userid=$this->mcommon->specific_row_value('users',array('mobile'=>$_POST['phone'],'email'=>$_POST['email']),'id');
			if(!$userid){
			//insert values in database
			$insert_user = $this->mcommon->common_insert('users', $insert_array);			
			$user_id = $insert_user;
			if ($insert_user > '0') {
				$this->load->library('email');
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'smtp-relay.sendinblue.com';
				$config['smtp_port'] = '587';
				$config['smtp_timeout'] = '7';
				$config['smtp_user']    = 'selaiyumravikaiyum@gmail.com';
				$config['smtp_pass']    = 'dFbWRC163hVBSfHD';
				$config['charset'] = 'utf-8';
				$config['newline'] = "\r\n";
				$config['mailtype'] = 'html';
				$config['validation'] = true;

				$this->email->initialize($config);
				$this->email->from('kainkaryatrust@gmail.com', 'kainkaryatrust');

				$this->email->to($_POST['email']);
				$this->email->subject('Welcome to kainkarya Trust With Us,');

				/*$message_mail='Dear,'.$firstName.'<br> Thank you for your contribution to service for noble causes. You can download the receipt using your credentials into our website www.kainkarya.com - Kainkarya Charitable Trust<br> Your Password:'.$password.'.';*/
				$message_mail = 'Dear ' . $_POST['firstname'] . '&nbsp;' . $_POST['city'] . '<last Name>,<br><br>
	   Warm Greetings from Kainkarya Charitable Trust.<br><br>
	   We are happy in welcoming you to the Kainkarya Charitable Trust Family of members who have joined hands in the service for noble causes which include helping the needy/destitute  to perform the last rites of their deceased kith or kin, honorary funeral to unclaimed bodies, help to the poor for their deprived dependents for their food or education or medicines .<br><br>
	   We have come with the web portal www.kainkarya.com which showcases the activities of the Kainkarya Charitable Trust and also provides details required to avail the support from the Trust . You can login to this portal with your personal credentials mentioned below and get receipts for your periodical donations.<br><br>
	   Login id : Your Mobile number or email id registered with us.<br>
	   Password : Welcome@123<br><br>
	   We request you to change the password to your convenience immediately on your first login.<br><br>
	   You may also refer to our Trust the deserving cases whom you may come across for Aid.<br><br>
	   In the words of Swamy Vivekananda:<br>
	   “That which tends to increase the divinity in you is virtue. The poor, the illiterate, the ignorant, the afflicted…. Let these be your God. Know that services to that alone vis the highest religion.”
	   Let’s go forward and do yet greater things…<br>
	   With best regards,<br><br><br>Team, KAINKARYA CHARITABLE TRUST.';


				$this->email->message($message_mail);
				$this->email->send();
			}
		}
		}


		$receipt_number = $prefix . "" . $added;

		$insert_Data = array(

			'receipt_date'   => date('Y-m-d'),
			'financial_year' => $financial_year,
			'receipt_month'  => date('n'),
			'user_id'        => ($user_id > 0) ? $user_id:$userid,
			'firstName'      => $_POST['firstname'],
			'lastName'       => $_POST['city'],
			'email'          => $_POST['email'],
			'mobileNo'       => $_POST['phone'],
			'panNumber'      => $_POST['address2'],
			'address'        => $_POST['address1'],
			'amount'         => $_POST['amount'],
			'corpusFund'     => $corpus,
			'paymentMode'    => '2',
			'transNumber'    => $_POST['payuMoneyId'],
			'transDate'      => date('Y-m-d'),
			//'transBank'      =>$transBank,
			//'remarks'        =>$remarks,
			'created_at'     => date('Y-m-d H:i:s'),
			'status'         => 1,
			'o_mihpayid'     => $_POST['mihpayid'],
			'o_mode'         => $_POST['mode'],
			'o_status'       => $_POST['status'],
			'o_hash'         => $_POST['hash'],
			'o_field8'       => $_POST['field8'],
			'o_encryptedPaymentId' => $_POST['encryptedPaymentId'],
			'o_bank_ref_num' => $_POST['bank_ref_num'],
			'o_bankcode'     => $_POST['bankcode'],
			'o_name_on_card' => $_POST['name_on_card'],
			'o_cardnum'      => $_POST['cardnum'],
			'o_payuMoneyId'  => $_POST['payuMoneyId'],

		);

		$insert = $this->mcommon->common_insert('online_donation', $insert_Data);
		//echo $insert;

		if ($insert) {
			/*  $pdf=$this->generatePdf($insert);
		$pdf_file=base_url().$pdf; 
		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp-relay.sendinblue.com';
		$config['smtp_port'] = '587';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'selaiyumravikaiyum@gmail.com';
		$config['smtp_pass']    = 'dFbWRC163hVBSfHD';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html'; 
		$config['validation'] = true; 

		$this->email->initialize($config);
		$this->email->from('kainkaryatrust@gmail.com','kainkaryatrust');

		$this->email->to($_POST['email']);
		$this->email->subject('Welcome to kainkarya Trust With Us,');
		$mail_date=date("M-Y");

		$message_mail='Dear &nbsp;'.$_POST['firstname'].'&nbsp;'.$_POST['city'].',<br><br>
						               Greetings from Kainkarya Charitable Trust.<br><br>
						               We thank you for donating to our Trust serving for the noble causes<br>
									   Please find attached the receipt for the month of '.$mail_date.'.<br><br>
									   Thanking you once again.<br><br>
									   Regards<br><br>
									   Authorised Signatory<br><br>
						               Kainkarya Charitable Trust<br>';
		$this->email->message($message_mail);
		$this->email->attach($pdf_file);
		$this->email->send(); */

			$sms_temp = 'Dear ' . $_POST['firstname'] . ', Thank you for your contribution to the service for noble causes. You can download the receipt using your credentials into our website www.kainkarya.com - Kainkarya Charitable Trust.';

			$this->sendsms($_POST['phone'], $sms_temp, $_POST['firstname'], '2');



			$this->session->set_flashdata('alert_success', 'Donated successfully!');
			unset($_POST);
			redirect('home/donate/');
		} else {
			$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
			unset($_POST);
			redirect('home/donate/');
		}
	}
	public function pay_error()
	{
		unset($_POST);
		$this->session->set_flashdata('alert_danger', "Your payment was failed. Try again..");
		redirect('home/donate/');
	}

	//Method that handles when payment was cancelled.
	public function pay_cancel()
	{
		unset($_POST);
		$this->session->set_flashdata('alert_danger', "Your payment was cancelled. Try again..");
		redirect('home/donate/');
	}
	public function check_hash_pay()
	{

		$key = $this->input->post('key');
		$txnid = $this->input->post('txnid');
		$amount = $this->input->post('amount');
		$productinfo = $this->input->post('productinfo');
		$firstName = $this->input->post('firstName');
		$email = $this->input->post('email');
		$salt = $this->input->post('salt');
		//$seq = "xxxxxxxx|11aa|400.00|Cleaning|Ankush|ankush@gmail.com|||||||||||xxxxxx";

			


		//$hashSequence = $key . "|" . $txnid . "|" . $amount . "|" . $productinfo . "|" . $firstName . "|" . $email . "||||||" . $salt;
		$hashSequence = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstName . '|' . $email . '|||||||||||' . $salt;

		$hash = strtolower(hash('sha512', $hashSequence));
		//$hash = hash("sha512", $hashSequence);
		echo json_encode($hash);
	}
	public function privacy_policy()
	{

		$this->load->view('Webpage/privacy_policy.php');
	}
	public function disclaimer()
	{

		$this->load->view('Webpage/disclaimer.php');
	}
	public function terms()
	{

		$this->load->view('Webpage/terms.php');
	}
	public function refund_policy()
	{

		$this->load->view('Webpage/refunds.php');
	}
	public function view_users()
	{
		if ($this->session->userdata('user_id')) {

			if (isset($_POST['submit'])) {
				$user_id = $this->input->post('user_id');
				$view_data['user_details'] = $this->mcommon->records_all('users', array('id' => $user_id,));
			}

			$view_data['users'] = $this->main->get_user_deatis();
			$data = array(
				'title' => "View Users ",
				'content' => $this->load->view('Webpage/view_users', $view_data, TRUE),
			);
			$this->load->view('Webpage/base_template', $data);
		} else {
			redirect('login');
		}
	}

	public function view_aid()
	{

		if ($this->session->userdata('auth_level') >= 6) {

			$view_data['aid'] = $this->mcommon->records_all('aid_file');

			$this->load->view('Webpage/aid_file.php', $view_data);
		} else {
			redirect('login');
			exit();
		}
	}
	public function annual_report()
	{

		if ($this->session->userdata('user_id')) {

			if (isset($_POST['submit'])) {

				$financial_year = $this->input->post('financial_year');
			}

			if (!empty($financial_year)) {
				$view_data['fin_year'] = $financial_year;
				$fin_year = $financial_year;

				$view_data['reports'] = $this->main->donation_report($fin_year);
			} else {
				$view_data['reports'] = '';
				/*$setting=$this->mcommon->records_all('company_setting');
			foreach ($setting as $key => $s) {
				$fin_year=$s->current_financial_year;
			}
			$view_data['fin_year']=$fin_year;*/
			}



			$view_data['user_details'] = $this->mcommon->records_all('users', array('id' => $this->session->userdata('user_id'),));

			$view_data['financial_year'] = $this->main->get_financial_year();

			$this->load->view('Webpage/annual_reports.php', $view_data);
		} else {
			redirect('login');
		}
	}
	public function print_annual($fin_year)
	{
		/*print_r($fin_year);exit();*/
		/*$setting=$this->mcommon->records_all('company_setting');
	$view_data['setting']=$setting;
	foreach ($setting as $key => $s) {
		$fin_year=$s->current_financial_year;
	}*/
		$setting = $this->mcommon->records_all('company_setting');
		$view_data['setting'] = $setting;
		$view_data['fin_year'] = $fin_year;
		$view_data['reports'] = $this->main->donation_report1($fin_year);
		//echo "<pre>";print_r($view_data['reports']);exit();
		$view_data['user_details'] = $this->mcommon->records_all(
			'users',
			array('id' => $this->session->userdata('user_id'),)
		);

		$this->load->view('Webpage/print_annual.php', $view_data);
	}
	public function otpcon()
	{

		$mobile = "9894748382";
		$name = "MURARI";

		$otp = '098765';
		$message = 'Dear Sir/Madam, OTP to login to your KAINKARYA CHARITABLE TRUST is' . $otp . '.Welcome to the service for noble causes - Kainkarya Charitable Trust.';
		$this->sendsms($mobile, $message, $name, '1');
	}

	public function sendsms($phone, $msg, $name1, $sms_type)
	{
		$mobile = $phone;
		$message = urlencode($msg);

		if ($sms_type == 1) {
			$url = "http://reseller.alphasoftz.info/api/sendsms.php?user=kainkarya&apikey=TzaeBRxqJfWU6EhpdrUK&mobile=$mobile&message=$message&senderid=KKARYA&type=txt&tid=1507166067551464055";
		} elseif ($sms_type == 2) {
			$url = "http://reseller.alphasoftz.info/api/sendsms.php?user=kainkarya&apikey=TzaeBRxqJfWU6EhpdrUK&mobile=$mobile&message=$message&senderid=KKARYA&type=txt&tid=1507166067555518943";
		}

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$curl_scraped_page = curl_exec($ch);
		curl_close($ch);
		$result = explode(' ', $curl_scraped_page);
		return $result;
	}

	public function AboutUs($id)
	
	{	
		$view_data['content']=$this->mcommon->specific_row_value('about_us',array('menu'=>$id),'content');
		$this->load->view('Webpage/about-us.php',$view_data);
	}
	public function getAboutContent(){
		$id=$this->input->post('id');
		$content=$this->mcommon->specific_row_value('about_us',array('menu'=>$id),'content');
		if($content){
			echo json_encode($content);
		}		
	}

	public function OurInspiration()
	{

		$this->load->view('Webpage/our-inspiration.php');
	}

	public function OurVision()
	{

		$this->load->view('Webpage/our-vision.php');
	}

	// public function OurMission(){
	// 	// view('Webpage/our-mission.php');
	// 	$this->load->view('Webpage/our-mission.php');
	// }

	public function OurObjectives()
	{

		$this->load->view('Webpage/our-objectives.php');
	}



	public function OurActivities()
	{

		$this->load->view('Webpage/our-activities.php');
	}

	public function DownloadPamphlet()
	{
		$view_data['records']=$this->mcommon->records_all('download_management',array('file_type'=>1));

		$this->load->view('Webpage/download-pamphlet.php',$view_data);
	}

	public function DownloadForms()
	{
		$view_data['records']=$this->mcommon->records_all('download_management',array('file_type'=>2));
		$this->load->view('Webpage/download-forms.php',$view_data);
	}

	public function Gallery()
	{

		$view_data['gallery_album'] = $this->mcommon->records_all1('gallery_album','g_id');
		$this->load->view('Webpage/gallery.php', $view_data);
	}

	public function get_images()
	{

		$g_id = $this->input->post('g_id');
		$result = $this->mcommon->records_all('gallery', array('g_id' => $g_id));
		echo json_encode($result);
	}
	public function get_video()
	{

		$v_id = $this->input->post('v_id');
		$result = $this->mcommon->records_all('video', array('v_id' => $v_id));
		echo json_encode($result);
	}
	public function Videos()
	{

		$view_data['video_album'] = $this->mcommon->records_all1('video_album','v_id');
		$this->load->view('Webpage/videos.php', $view_data);
	}
	public function Trustees()
	{

		$this->load->view('Webpage/trustees-page.php');
	}
	public function Guiding()
	{

		$this->load->view('Webpage/guiding-page.php');
	}
	public function UserLogin()
	{


		$this->load->view('Webpage/user-login.php');
	}

	public function forgetpassword()
	{

		///mobile otp fixed
		if (isset($_POST['submit'])) {
			$email = $this->input->post('email');
			$check_mail = $this->main->check_users($email);
			if (empty($check_mail)) {
				$this->session->set_flashdata('alert_danger', 'Invalid Username ');
				redirect('forgetpassword');
			} else {
				foreach ($check_mail as  $u) {
					$user_mail = $u->email;
					$user_mobile = $u->mobile;
					$user_id = $u->id;
					$firstName = $u->firstName;
				}
				$this->session->set_userdata("user_id", $user_id);
				$this->session->set_userdata("firstName", $firstName);
				$this->session->set_userdata("email", $user_mail);
				$this->session->set_userdata("mobile", $user_mobile);
				//$this->session->set_userdata("password", $password);
				$otp = random_int(100000, 999999);

				$update_array = array(

					'otp' => $otp,
				);
				//insert values in database
				$update = $this->mcommon->common_edit('users', $update_array, array('id' => $user_id,));
				$this->load->library('email');
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'smtp-relay.sendinblue.com';
				$config['smtp_port'] = '587';
				$config['smtp_timeout'] = '7';
				$config['smtp_user']    = 'selaiyumravikaiyum@gmail.com';
				$config['smtp_pass']    = 'dFbWRC163hVBSfHD';
				$config['charset'] = 'utf-8';
				$config['newline'] = "\r\n";
				$config['mailtype'] = 'html';
				$config['validation'] = true;

				$this->email->initialize($config);
				$this->email->from('kainkaryatrust@gmail.com', 'kainkaryatrust');

				$this->email->to($user_mail);
				$this->email->subject('Welcome to kainkarya Trust With Us,');


				$message_mail = 'Dear Sir/Madam, OTP to login to your KAINKARYA CHARITABLE TRUST is ' . $otp . '.Welcome to the service for noble causes - Kainkarya Charitable Trust.';
				$this->email->message($message_mail);
				$this->email->send();
				$this->sendsms($user_mobile, $message_mail, $firstName, '1');
				redirect('home/otp_verify');
			}
		}


		$this->load->view('Webpage/forgetpassword.php');
	}
	public function password_change()
	{



		if (isset($_POST['Submit'])) {

			$user_id = $this->session->userdata('user_id');
			$firstName = $this->session->userdata('firstName');
			$email = $this->session->userdata('email');
			$mobile = $this->session->userdata('mobile');

			$password = $this->input->post('password');
			$pass_confirm = $this->input->post('confirm_password');
			$user_id = $this->session->userdata('user_id');
			if ($password == $pass_confirm) {
				$update_data = array(
					'password_hash' => $this->hash_passwd($password),
					'reset_at' => date('Y-m-d h-i-s')
				);
				$update = $this->mcommon->common_edit('users', $update_data, array('id' => $user_id,));

				$smsmessage = 'Dear ' . ucfirst($this->session->userdata('firstName')) . '<br>Your New Password is &nbsp;' . $this->input->post('password') . ' You can download the receipt using your credentials into our website www.kainkarya.com - Kainkarya Charitable Trust.';
				$this->sendsms($this->session->userdata('mobile'), $smsmessage, $this->session->userdata('firstName'), '1');
				//print_r($smsmessage);exit();
				if ($update > '0') {

					$this->load->library('email');
					$config['protocol'] = 'smtp';
					$config['smtp_host'] = 'smtp-relay.sendinblue.com';
					$config['smtp_port'] = '587';
					$config['smtp_timeout'] = '7';
					$config['smtp_user']    = 'selaiyumravikaiyum@gmail.com';
					$config['smtp_pass']    = 'dFbWRC163hVBSfHD';
					$config['charset'] = 'utf-8';
					$config['newline'] = "\r\n";
					$config['mailtype'] = 'html';
					$config['validation'] = true;

					$this->email->initialize($config);
					$this->email->from('kainkaryatrust@gmail.com', 'kainkaryatrust');

					$this->email->to($email);
					$this->email->subject('Welcome to kainkarya Trust With Us,');


					$message_mail = 'Dear ' . ucfirst($this->session->userdata('firstName')) . '<br>Your New Password is &nbsp;' . $this->input->post('password') . ' You can download the receipt using your credentials into our website www.kainkarya.com - Kainkarya Charitable Trust.';
					$this->email->message($message_mail);
					$this->email->send();
					session_destroy();
					$this->session->set_flashdata('alert_success', ' your Password Change  successfully!');

					redirect('login');
				} else {
					$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
					redirect('password_change');
				}
			} else {
				$this->session->set_flashdata('alert_danger', 'Password And Confirm Password Not to be Same');
				redirect('change_password');
			}
		}
		$this->load->view('Webpage/new_password.php');
	}
	public function otp_verify()
	{

		if (isset($_POST['submit'])) {

			$user_id = $this->session->userdata('user_id');
			$firstName = $this->session->userdata('firstName');
			$email = $this->session->userdata('email');
			$mobile = $this->session->userdata('mobile');

			$otp = $this->input->post('otp');
			$result = $this->mcommon->records_all('users', array(
				'id' => $user_id,
				'otp' => $otp,
			));
			if ($result) {
				$update_array = array(

					'active' => 1,
				);
				//insert values in database
				$update = $this->mcommon->common_edit('users', $update_array, array('id' => $user_id,));
				if ($update) {

					// $this->session->set_flashdata('alert_success', 'Login successfully!..');
					redirect('Home/password_change');
				}
			} else {
				$this->session->set_flashdata('alert_danger', 'Invalid OTP');
			}
		}
		$this->load->view('Webpage/forgot_otp.php');
	}
	public function otp_send1()
	{

		$user_id = $this->session->userdata('user_id');
		$firstName = $this->session->userdata('firstName');
		$email = $this->session->userdata('email');
		$mobile = $this->session->userdata('mobile');

		$otp = random_int(100000, 999999);
		$update_array = array(

			'otp' => $otp,
		);
		//insert values in database
		$update = $this->mcommon->common_edit('users', $update_array, array('id' => $user_id,));
		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp-relay.sendinblue.com';
		$config['smtp_port'] = '587';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'selaiyumravikaiyum@gmail.com';
		$config['smtp_pass']    = 'dFbWRC163hVBSfHD';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';
		$config['validation'] = true;

		$this->email->initialize($config);
		$this->email->from('kainkaryatrust@gmail.com', 'kainkaryatrust');

		$this->email->to($email);
		$this->email->subject('Welcome to kainkarya Trust With Us,');


		$message_mail = 'Dear Sir/Madam, OTP to login to your KAINKARYA CHARITABLE TRUST is ' . $otp . '.Welcome to the service for noble causes - Kainkarya Charitable Trust.';
		$this->email->message($message_mail);
		$this->email->send();

		$this->sendsms($mobile, $message_mail, $firstName, '1');

		redirect('home/otp_verify');
	}
	public function UserRegister()
	{
		if (isset($_POST['submit'])) {

			$firstName = $this->input->post('firstName');
			$lastName = $this->input->post('lastName');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$mobile_number = $this->input->post('mobile_number');
			$pass_confirm = $this->input->post('pass_confirm');
			$otp = random_int(100000, 999999);

			$check_mail = $this->mcommon->records_all('users', array('email' => $email,));
			$check_mobile = $this->mcommon->records_all('users', array('mobile' => $mobile_number,));
			if ($check_mail) {
				$this->session->set_flashdata('alert_danger', 'This Mail is already used ');
				redirect('home/UserRegister');
			} elseif ($check_mobile) {
				$this->session->set_flashdata('alert_danger', 'This Mobile Number is already used ');
				redirect('home/UserRegister');
			} elseif ($password != $pass_confirm) {
				$this->session->set_flashdata('alert_danger', 'Password And Confirm Password Not to be Same ');
				redirect('home/UserRegister');
			} else {


				//Set validation Rules
				// $this->form_validation->set_rules('firstName', 'First NAME', 'required');
				// $this->form_validation->set_rules('lasttName', 'Last Name', 'required');
				// $this->form_validation->set_rules('email', 'Email', 'required');
				// $this->form_validation->set_rules('password_hash', 'Password', 'required');
				// $this->form_validation->set_rules('password_hash', 'Password', 'required');

				//check is the validation returns no error
				//if ($this->form_validation->run() == true) {
				//prepare insert array
				$insert_array = array(
					'firstName' => $firstName,
					'lastName' => $lastName,
					'email' => $email,
					'password_hash' => $this->hash_passwd($password),
					'otp' => $otp,
					'mobile' => $mobile_number,
					'auth_level' => 1,
					'active' => 0,
					'created_at' => date('Y-m-d')
				);
				//insert values in database
				$insert = $this->mcommon->common_insert('users', $insert_array);


				if ($insert > '0') {
					$this->session->set_userdata("user_id", $insert);
					$this->session->set_userdata("firstName", $firstName);
					$this->session->set_userdata("email", $email);
					$this->session->set_userdata("mobile", $mobile_number);
					$this->session->set_userdata("password", $password);

					$this->load->library('email');
					$config['protocol'] = 'smtp';
					$config['smtp_host'] = 'smtp-relay.sendinblue.com';
					$config['smtp_port'] = '587';
					$config['smtp_timeout'] = '7';
					$config['smtp_user']    = 'selaiyumravikaiyum@gmail.com';
					$config['smtp_pass']    = 'dFbWRC163hVBSfHD';
					$config['charset'] = 'utf-8';
					$config['newline'] = "\r\n";
					$config['mailtype'] = 'html';
					$config['validation'] = true;

					$this->email->initialize($config);
					$this->email->from('kainkaryatrust@gmail.com', 'kainkaryatrust');

					$this->email->to($email);
					$this->email->subject('Welcome to kainkarya Trust With Us,');

					$message_mail = 'Dear Sir/Madam, OTP to login to your KAINKARYA CHARITABLE TRUST is ' . $otp . '.Welcome to the service for noble causes - Kainkarya Charitable Trust.';
					$this->email->message($message_mail);
					$this->email->send();
					$this->sendsms($mobile_number, $message_mail, $firstName, '1');
					redirect('home/otp_verification');
				} else {
					$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
				}
			}
		} else {
			$this->load->view('Webpage/user-register.php');
		}
		//}

	}

	public function otp_verification()
	{
		if (isset($_POST['submit'])) {

			$user_id = $this->session->userdata('user_id');
			$firstName = $this->session->userdata('firstName');
			$email = $this->session->userdata('email');
			$mobile = $this->session->userdata('mobile');

			$otp = $this->input->post('otp');
			$result = $this->mcommon->records_all('users', array(
				'id' => $user_id,
				'otp' => $otp,
			));
			if ($result) {
				$update_array = array(

					'active' => 1,
				);
				//insert values in database
				$update = $this->mcommon->common_edit('users', $update_array, array('id' => $user_id,));
				if ($update) {
					$this->load->library('email');
					$config['protocol'] = 'smtp';
					$config['smtp_host'] = 'smtp-relay.sendinblue.com';
					$config['smtp_port'] = '587';
					$config['smtp_timeout'] = '7';
					$config['smtp_user']    = 'selaiyumravikaiyum@gmail.com';
					$config['smtp_pass']    = 'dFbWRC163hVBSfHD';
					$config['charset'] = 'utf-8';
					$config['newline'] = "\r\n";
					$config['mailtype'] = 'html';
					$config['validation'] = true;

					$this->email->initialize($config);
					$this->email->from('kainkaryatrust@gmail.com', 'kainkaryatrust');

					$this->email->to($email);
					$this->email->subject('Welcome to kainkarya Trust With Us,');

					$message_mail = 'Dear ' . $firstName . ', Thank you for your contribution to the service for noble causes. You can download the receipt using your credentials into our website www.kainkarya.com - Kainkarya Charitable Trust. ';
					$this->email->message($message_mail);
					$this->email->send();

					$this->sendsms($mobile, $message_mail, $firstName, '2');
				}
				$this->session->set_flashdata('alert_success', 'Login successfully!..');
				redirect('Home/Profile');
			} else {

				$this->session->set_flashdata('alert_danger', 'Invalid OTP');
			}
		}


		$this->load->view('Webpage/otp_verification.php');
	}
	public function otp_send()
	{

		$user_id = $this->session->userdata('user_id');
		$firstName = $this->session->userdata('firstName');
		$email = $this->session->userdata('email');
		$mobile = $this->session->userdata('mobile');

		$otp = random_int(100000, 999999);
		$update_array = array(

			'otp' => $otp,
		);
		//insert values in database
		$update = $this->mcommon->common_edit('users', $update_array, array('id' => $user_id,));
		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp-relay.sendinblue.com';
		$config['smtp_port'] = '587';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'selaiyumravikaiyum@gmail.com';
		$config['smtp_pass']    = 'dFbWRC163hVBSfHD';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';
		$config['validation'] = true;

		$this->email->initialize($config);
		$this->email->from('kainkaryatrust@gmail.com', 'kainkaryatrust');

		$this->email->to($email);
		$this->email->subject('Welcome to kainkarya Trust With Us,');


		$message_mail = 'Dear Sir/Madam, OTP to login to your KAINKARYA CHARITABLE TRUST is ' . $otp . '.Welcome to the service for noble causes - Kainkarya Charitable Trust.';
		$this->email->message($message_mail);
		$this->email->send();
		$this->sendsms($mobile, $message_mail, $firstName, '1');

		redirect('home/otp_verification');
	}

	public function hash_passwd($password, $random_salt = '')
	{
		// If no salt provided for older PHP versions, make one
		if (!is_php('5.5') && empty($random_salt)) {
			$random_salt = $this->random_salt();
		}

		// PHP 5.5+ uses new password hashing function
		if (is_php('5.5')) {
			return password_hash($password, PASSWORD_BCRYPT, ['cost' => 11]);
		}

		// PHP < 5.5 uses crypt
		else {
			return crypt($password, '$2y$10$' . $random_salt);
		}
	}
	public function random_salt()
	{
		$this->CI->load->library('encryption');

		$salt = substr(bin2hex($this->CI->encryption->create_key(64)), 0, 22);

		return strlen($salt) != 22
			? substr(md5(mt_rand()), 0, 22)
			: $salt;
	}

	public function change_password()
	{

		if ($this->session->userdata('user_id')) {

			if (isset($_POST['Submit'])) {
				$password = $this->input->post('password');
				$pass_confirm = $this->input->post('pass_confirm');
				$user_id = $this->session->userdata('user_id');
				if ($password == $pass_confirm) {
					$update_data = array(
						'password_hash' => $this->hash_passwd($password),
						'reset_at' => date('Y-m-d h-i-s')
					);
					$update = $this->mcommon->common_edit('users', $update_data, array('id' => $user_id,));

					$smsmessage = 'Dear ' . ucfirst($this->session->userdata('firstName')) . '<br>Your New Password is &nbsp;' . $this->input->post('password') . ' You can download the receipt using your credentials into our website www.kainkarya.com - Kainkarya Charitable Trust.';
					$this->sendsms($this->session->userdata('mobile'), $smsmessage, $this->session->userdata('firstName'), '1');

					if ($update > '0') {
						$this->session->set_flashdata('alert_success', ' your Password Change  successfully!');

						redirect('change_password');
					} else {
						$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
						redirect('change_password');
					}
				} else {
					$this->session->set_flashdata('alert_danger', 'Password And Confirm Password Not to be Same');
					redirect('change_password');
				}
			}
			$this->load->view('Webpage/change_password.php');
		} else {
			redirect('login');
		}
	}

	public function UserLogout()
	{
		if ($this->session->userdata('user_id')) {
			session_destroy();
		}

		redirect('login');
	}

	public function MyReceipts()
	{

		if ($this->session->userdata('user_id')) {

			$user_id = $this->session->userdata('user_id');
			$setting = $this->mcommon->records_all('company_setting');
			if (isset($_POST['submit'])) {

				$fin_year = $this->input->post('financial_year');
			$view_data['receipt'] = $this->main->get_donation($user_id, $fin_year);
			$view_data['user_details'] = $this->mcommon->records_all('users', array('id' => $user_id,));
			} else {
				foreach ($setting as $key => $s) {
					$fin_year = $s->current_financial_year;
				}
			}
			
			$view_data['financial_year'] = $this->main->get_financial_year();
			

			$this->load->view('Webpage/my-receipts.php', $view_data);
		} else {
			redirect('login');
		}
	}

	public function PrintMyReceipts($donation_id)
	{

		if ($this->session->userdata('user_id')) {

			$view_data['setting'] = $this->mcommon->records_all('company_setting');
			$view_data['receipt_data'] = $this->main->get_donation_details($donation_id);

			$this->load->view('Webpage/print-my-receipt.php', $view_data);
		} else {
			redirect('login');
		}
	}

	public function Profile()
	{

		if ($this->session->userdata('user_id')) {

			$user_id = $this->session->userdata('user_id');

			$view_data['user'] = $this->mcommon->records_all('users', array('id' => $user_id,));


			$this->load->view('Webpage/my-profile.php', $view_data);
		} else {
			redirect('login');
		}
	}
	public function Update_profile()
	{

		if (isset($_POST['Submit'])) {

			$email = $this->input->post('email');
			$firstName = $this->input->post('firstName');
			$lastName = $this->input->post('lastName');
			$user_id = $this->input->post('user_id');
			$pan = $this->input->post('pan');
			$address = $this->input->post('address');
			$about_me = $this->input->post('about_me');
			$dob = $this->input->post('dob');
			$dob1 = $this->input->post('dob1');
			if (empty($dob)) {
				$dob = $dob1;
			}

			$update_data = array(
				'firstName' => $firstName,
				'lastName' => $lastName,
				'pan' => $pan,
				'dob' => $dob,
				'about_me' => $about_me,
				'address' => $address,
				'updated_at' => date('Y-m-d'),
			);
			$update = $this->mcommon->common_edit('users', $update_data, array('id' => $user_id,));

			if ($update > '0') {
				$this->session->set_flashdata('alert_success', 'Update your Profiles  successfully!');

				redirect('home/Profile');
			} else {
				$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
				redirect('home/Profile');
			}
		}
	}
	public function generatePdf($donation_id)
	{

		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Cascade RMS');
		$pdf->SetTitle('Donation PDF');
		$pdf->SetSubject('Donation PDF');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 004', PDF_HEADER_STRING);
		//$pdf->SetFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 004', PDF_HEADER_STRING);
		// set header and footer fonts
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		$pdf->SetMargins('10', '10', '10');
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->SetFont('times', '', 8);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		// add a page
		$pdf->AddPage();


		$view_data['receipt_data'] = $this->main->get_donation_details($donation_id);
		$view_data['setting'] = $this->mcommon->records_all('company_setting');

		$html = $this->load->view('Webpage/pdf', $view_data, TRUE);

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		//Generate Order PDF Number
		$order_number                   =  time();

		$base = base_url();

		$fileName       = './admin/public/pdf/' . $donation_id . '.pdf';
		//$fileName       =   'public/pdf/'.$donation_id.'.pdf';

		ob_clean();

		$pdf->Output(FCPATH . $fileName, 'F');
		return $fileName;
	}

	public function questionnaire()
	{
		$id = $this->uri->segment(4);
		$view_data['polling_id'] = $id;
		$this->load->view('Webpage/new_polling.php', $view_data);
	}

	public function polling_submit()
	{
		if (isset($_POST['submit'])) {
			$mobile = $this->input->post("mobile");
			$polling_id = $this->input->post("polling_id");
			$user_auth_level = $this->mcommon->specific_row_value("users", array("mobile" => $mobile), "auth_level");
			if ($user_auth_level) {
				// $check_polling = $this->mcommon->specific_row_value("polling_questions", array("user_type" => $user_auth_level), "id");
				$check_polling = $this->mcommon->specific_row_value("polling_user", array("user_type" => $user_auth_level,"question_id" => $polling_id), "question_id");
				if ($check_polling) {
					// echo "<pre>";
					// print_r($polling_id);
					// die();
					$this->start_polling($mobile,$user_auth_level,$check_polling,$polling_id);
					
				} else {
					$this->session->set_flashdata('alert_danger', 'Questionnaire Not Available for this role.');
					redirect('home/questionnaire/' . $polling_id);
				}
			} else {
				$this->session->set_flashdata('alert_danger', 'Mobile Number Not Found');
				redirect('home/questionnaire/' . $polling_id);
			}
		} else {
			$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
			redirect('home/Profile');
		}
	}


	function start_polling($mobile,$user_auth_level,$check_polling,$polling_id){
		$view_data['polling_id'] = $polling_id;
		
		$view_data['mobile']=$mobile;
		$view_data['user_auth_level']=$user_auth_level;
		$view_data['polling']=$this->mcommon->get_polling_by_id($user_auth_level,$polling_id);
		$view_data['user_id'] = $this->mcommon->specific_row_value("users", array("mobile" => $mobile), "id");
		// print_r($view_data['polling']);
		// exit();
		$check_polling = $this->mcommon->specific_row_value("poll_result", array("user_id" => $view_data['user_id'],'question_id'=>$polling_id), "id");
		if($check_polling){
			$view_data['error']="Questionnaire Already Submitted";
			$this->load->view('Webpage/poll_failure.php',$view_data);
		}else{
			$this->load->view('Webpage/start_pol.php', $view_data);
		}
	
	}

	function submit_poll(){
		$question=$this->input->post('question');
		$answer=$this->input->post('answer');
		$user_id=$this->input->post('user_id');
		$reason=$this->input->post('reason');
		
		$insert_array=array(
			'question_id'=>$question,
			'answer_id'=>$answer,
			'user_id'=>$user_id,
			'reason'=>$reason,
		);
		$insert_poll = $this->mcommon->common_insert('poll_result', $insert_array);
		if($insert_poll){
			redirect("poll_success");
		}else{
			redirect('poll_failure');
		}
	}

	function poll_success(){
		$this->load->view('Webpage/poll_success.php');
	}

	function poll_failure(){
		$view_data['error']="Questionnaire Submission Error";
		$this->load->view('Webpage/poll_failure.php',$view_data);
	}

	/*	public function login()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        //date_default_timezone_set($this->dbvars->timezone);
        // Method should not be directly accessible
        if ($this->uri->uri_string() == 'auth/login') {
            show_404();
        }

        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->require_min_level(1);
        }

        $this->setup_login_form();
        $sqlRawQuery="set global sql_mode=''";
        $query=$this->db->query($sqlRawQuery);
        $view_data = '';
        // $data = array(
        //     'title' => $this->lang->line('login_page_title'),
        //     'content' => $this->load->view('auth/login_form', $view_data, true),
        // );
        $this->load->view('Webpage/user-login.php');
      }*/
}
