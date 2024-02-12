<?php

use Dompdf\Dompdf;
class Donation extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	//	$this->load->library('m_pdf');
		$this->load->library('html2pdf');
		//$this->load->library('Pdf');
		if($this->session->userdata('auth_level')!='10'){
			redirect('login');
		  }
	}
public function updateDate(){

		$filename = $_FILES["file"]["tmp_name"];

		if ($_FILES["file"]["size"] > 0) {
			$file = fopen($filename, "r");
			fgets($file);
			$sno = 0;
			while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE) {
			   
				if ($importdata[0] !== 'S.NO') {
					$user_id    = stripslashes($importdata[1]);
					$create_at    = date('Y-m-d',strtotime($importdata[7]));	
				
					$data=$this->mcommon->common_edit('users',array('created_at'=>$create_at),array('id'=>$user_id));					
				}
			}
		
		}
		redirect('donation/donation');

	}
	public function exportCSV()
	{
		$myData = $this->mcommon->exportCSV('users',array('active'=>'1'));

		// file name
		$filename = 'Donation' . date('d') . '.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; ");

		// file creation
		$file = fopen('php://output', 'w');
		
					$fullname         = stripslashes($importdata[1]); 
					$user_id          = stripslashes($importdata[2]);
					$mobileNo         = stripslashes($importdata[3]);
					$pan              = stripslashes($importdata[4]);
					$receipt_date     = stripslashes($importdata[5]);
					$receipt_number   = stripslashes($importdata[6]);
					$corpusFund       = stripslashes($importdata[7]);
					$receipt_month    = stripslashes($importdata[8]);
					$remarks          = stripslashes($importdata[9]);
					$amount           = stripslashes($importdata[10]);
					$financial_year   = stripslashes($importdata[11]);
					$paymentMode      = stripslashes($importdata[12]);
					$transNumber      = stripslashes($importdata[13]);
					$transDate1       = stripslashes($importdata[14]);
					$transBank        = stripslashes($importdata[15]);

		//$header = array("S.NO","Full Name","User ID", "Mobile Number", "Pan Number","Receipt Date", "Receipt Number","Donation type", "Receipt month","Remarks", "Amount","Financial Year","Payment Mode", "Transcation Number", "Transcation Date", "Transcation Bank");
		$header = array("S.NO","Full Name","User ID","Email","Mobile Number", "Pan Number","Voucher Number","Receipt Date","Amount","Remarks","Donation type","Receipt month","Financial Year","Payment Mode", "Transcation Number", "Transcation Date", "Transcation Bank");
		fputcsv($file, $header);
		/*fputcsv($file,array('','','','','','','','','like number (1,2,3..etc)','10000','Monthly (or) Corpus (or)OneTime ','NEFT (or) Online (or) Cash  (or) Cheque','check Number',"date format(dd-mm-yyyy)",'SBI','2021-2022','date format(dd-mm-yyyy)'));*/
		$i = 1;
		foreach ($myData as $r) {
			fputcsv($file, array($i++,$r->firstName." ".$r->lastName,$r->id,$r->email,$r->mobile, $r->pan));
		}
		fclose($file);
		exit;
	}
	public function donation_import()
	{

		$filename = $_FILES["file"]["tmp_name"];

		if ($_FILES["file"]["size"] > 0) {
			$file = fopen($filename, "r");
			fgets($file);


			$sno = 0;
			while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE) {
                
                // echo "<pre>"; print_r($importdata);
                // die();

				$setting = $this->mcommon->records_all('company_setting');
				foreach ($setting as $s) {

					$prefix = $s->receipt_prefix;
				}

				if ($importdata[0] !== 'S.NO') {

					$fullname         = stripslashes($importdata[1]); 
					$user_id          = stripslashes($importdata[2]);
					$email            = stripslashes($importdata[3]);
					$mobileNo         = stripslashes($importdata[4]);
					$pan              = stripslashes($importdata[5]);
					$receipt_number   = stripslashes($importdata[6]);
					$receipt_date     = stripslashes($importdata[7]);
					$amount           = stripslashes($importdata[8]);
					$remarks          = stripslashes($importdata[9]);
					$corpusFund       = stripslashes($importdata[10]);
					$receipt_month    = stripslashes($importdata[11]);
					$financial_year   = stripslashes($importdata[12]);
					$paymentMode      = stripslashes($importdata[13]);
					$transNumber      = stripslashes($importdata[14]);
					$transDate1       = stripslashes($importdata[15]);
					$transBank        = stripslashes($importdata[16]);

					// $firstName        = stripslashes($importdata[3]);
					// $lastName         = stripslashes($importdata[4]);
					// $email            = stripslashes($importdata[5]);
					
					
					
					
				//	$receipt_date1    = stripslashes($importdata[17]);
				
					///$receipt_number          = stripslashes($importdata[18]);
					$transDate = date("Y-m-d", strtotime($transDate1));
					$receipt_date = date("Y-m-d", strtotime($receipt_date));

					$convertDate = date('d-') . $receipt_month . date("-Y");
					$mail_date = date("d-m-Y", strtotime($receipt_date)); //date("M-Y", strtotime($convertDate));

					$count_no = $this->mcommon->specific_record_counts('donation', array('financial_year' => $financial_year,));
					$fin_data = $this->mcommon->records_all('financial_year', array('year' => $financial_year,));

					foreach ($fin_data as  $fd) {
						$pre_number = $fd->pre_number;
					}
					$added = $pre_number + $count_no + 1;

					//$receipt_number=$prefix."".$added;

					$don1 = "OneTime";
					$don2 = "Corpus";
					$don3 = "Monthly";
					$pay1 = "Cheque";
					$pay2 = "Online";
					$pay3 = "Cash";
					$pay4 = "NEFT";


					if (strncasecmp($corpusFund, $don1, 3) == 0) {
						$corpus = 3;
					} elseif (strncasecmp($corpusFund, $don2, 3) == 0) {
						$corpus = 2;
					} elseif (strncasecmp($corpusFund, $don3, 3) == 0) {
						$corpus = 1;
					}

					if (strncasecmp($paymentMode, $pay1, 3) == 0) {
						$paymentMode = 3;
					} elseif (strncasecmp($paymentMode, $pay2, 3) == 0) {
						$paymentMode = 2;
					} elseif (strncasecmp($paymentMode, $pay3, 3) == 0) {
						$paymentMode = 1;
					} elseif (strncasecmp($paymentMode, $pay4, 3) == 0) {
						$paymentMode = 4;
					}

					// if ($receipt_month != '' && $amount != '' && $corpus != '' && $paymentMode != '' && $receipt_date != '' && $financial_year != '' && $receipt_number != '') 
					// {

						$insert_Data = array(
							'receipt_number' => $receipt_number,
							'receipt_date'  => $receipt_date,
							'financial_year' => $financial_year,
							'receipt_month'  => $receipt_month,
							'user_id' => $user_id,
							'Fullname' => $fullname,
							//'firstName'  => $firstName,
							//'lastName'  => $lastName,
							//'email' => $email,
							'mobileNo' => $mobileNo,
							'panNumber' => $pan,
							//'address'=>$address,
							'amount' => $amount,
							'corpusFund' => $corpus,
							'paymentMode' => $paymentMode,
							'transNumber' => $transNumber,
							'transDate' => $transDate ? $transDate:date('Y-m-d'),
							'transBank' => $transBank,
							'remarks' => $remarks,
							'created_at' => date('Y-m-d H:i:s'),
							'status' => 1,

						);

					

						$insert = $this->mcommon->common_insert('donation', $insert_Data);
						$print_data['setting'] = $this->mcommon->records_all('company_setting');
						$receipt_data = $this->main->get_donation_details($insert);
						$print_data['receipt_data'] = $receipt_data;
                        
						 if($financial_year=='2021-2022'){
					      $txtMsg="DONATIONS FROM 29TH NOVEMBER 2021 ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT";
					    }elseif($financial_year=='2022-2023'){
					      $txtMsg="DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT";
					     }else{
					      $txtMsg="DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT";
					     }
           // $pdf=$this->genpdf1($receipt_number,$print_data);

                    $this->load->library('m_pdf');
        			$print_data['setting'] = $this->mcommon->records_all('company_setting');
        			$html = $this->load->view('Webpage/test_pdf', $print_data, TRUE);					
            		$pdfFilePath =  $_SERVER['DOCUMENT_ROOT'] . '/admin/public/pdf/' . $receipt_number . '.pdf';
            		unlink($pdfFilePath);
            		$m_pdf=new M_pdf();
            		$m_pdf->pdf->WriteHTML($html);
            		$pdf=$m_pdf->pdf->Output($pdfFilePath,'F');	
        			ob_clean();


				

		// 				$html = $this->load->view('Webpage/test_pdf', $print_data, TRUE);
	//	$pdfFilePath =  $_SERVER['DOCUMENT_ROOT'] . '/admin/public/pdf/' . $receipt_number . '.pdf';
		// $this->m_pdf->pdf->WriteHTML($html);
		// $this->m_pdf->pdf->Output($pdfFilePath,'F');
		
		//$this->html2pdf->set_option('enable_html5_parser', TRUE);

		   //Set folder to save PDF to
	//	   $this->html2pdf->folder($_SERVER['DOCUMENT_ROOT'] . '/admin/public/pdf/');
	    
		   //Set the filename to save/download as
	//	   $this->html2pdf->filename($receipt_number . '.pdf');
		   
		   //Set the paper defaults
//		   $this->html2pdf->paper('a4', 'portrait');
		   
		   $data = array(
			   'title' => 'PDF Created',
			   'message' => 'Hello World!'
		   );
		  // ob_clean();
		   //Load html view $this->html2pdf->create('save')
	//	   $this->html2pdf->html($this->load->view('Webpage/donation_pdf', $print_data, true));
		  // if($pdf) {
			   //PDF was successfully saved or downloaded
						$pdf_file= base_url('public/pdf/') . $receipt_number.'.pdf';
						$this->load->library('email');
						$config['protocol'] = 'smtp';
						$config['smtp_host'] = 'smtp-relay.sendinblue.com';
						$config['smtp_port'] = '587';
						$config['smtp_timeout'] = '7';
						$config['smtp_user']    = 'kainkaryatrust@gmail.com';
						$config['smtp_pass']    = 'tnP6DjWLmS2xQf7w';
						//$config['smtp_user']    = 'info@alphasoftz.com';
    				//	$config['smtp_pass']    = 'KFdL2yO6tH75SnZW';
						$config['charset'] = 'utf-8';
						$config['newline'] = "\r\n";
						$config['mailtype'] = 'html'; 
						$config['validation'] = true; 

						$this->email->initialize($config);
						$this->email->from('kainkaryatrust@gmail.com','kainkaryatrust');

						$this->email->to($email);
						$this->email->subject('RECEIPT FROM KAINKARYA CHARITABLE TRUST.-'.$mail_date);

						$message_mail='Dear &nbsp;'.$fullname.'&nbsp;<br><br>
						               Greetings from Kainkarya Charitable Trust.<br><br>
						               We thank you for donating to our Trust serving for the noble causes.<br>
									   Please find attached the receipt for the donation on &nbsp;'.$mail_date.'.<br><br>
									   '.$txtMsg.'<br><br>
									   Thanking you once again.<br><br>
									   Regards<br><br>
									   Authorised Signatory<br><br>
						               Kainkarya Charitable Trust<br>';
						$this->email->message($message_mail);
						$this->email->attach($pdf_file);
						$this->email->send();
						$this->email->clear(TRUE);
						// $msg=	'Dear '.$firstName.''.$$lastName.' , Thank you for your contribution to the service for noble causes. The receipt has been sent to the email id registered with us. You can also download the receipt logging into our website www.kainkarya.com - Kainkarya Charitable Trust.';
						$msg ='Dear '.$fullname.',Thank you for your contribution to the service for the noble causes. The receipt has been sent to the email id registered with us. You can also download the receipt logging into our website www.kainkarya.com - Kainkarya Charitable Trust.';

					$this->sendsms($mobileNo,$msg,$fullname,'3');
		   //}


				//	}
				}
				$sno++;
			}

			fclose($file);
			
			if ($insert) {
				$this->session->set_flashdata('alert_success', 'Donation  upload successfully!');
				redirect('donation/donation/');

			} else {

				$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
				redirect('donation/donation/');

			}

		}
	}
	
		public function genpdf1($receipt_number,$print_data){
// 		$this->load->library('Pdf1');
// 		ob_get_clean();
// 		$dompdf = new Dompdf();
// 		//$pdfFilePath ='public/pdf/'.$receipt_number.'tst.pdf';
// 		$html    =   $this->load->view('Webpage/donation_pdf',$print_data, TRUE);		
// 		$pdfFilePath ='public/pdf/'.$receipt_number.'.pdf';
// 		//$this->pdf->createPDF($html, 'mypdf', false);
//         $dompdf->set_option('isHtml5ParserEnabled', true);
// 		$dompdf->loadHtml($html); 
//         $dompdf->setPaper('A4', 'landscape');		
//         $dompdf->render(); 
       
// 		if(file_exists($_SERVER['DOCUMENT_ROOT'] . 'admin/public/pdf/' . $receipt_number . '.pdf')){
// 			unlink($_SERVER['DOCUMENT_ROOT'] . 'admin/public/pdf/' . $receipt_number . '.pdf');
// 		}else{
// 			$dompdf->output(FCPATH.$pdfFilePath, 'F');
// 			//$dompdf->stream();
// 			//$this->pdf->Output(FCPATH.$pdfFilePath, 'F');
// 		}
    $this->load->library('m_pdf');
			$print_data['setting'] = $this->mcommon->records_all('company_setting');
			$html = $this->load->view('Webpage/test_pdf', $print_data, true);
		$pdfFilePath =  $_SERVER['DOCUMENT_ROOT'] . '/admin/public/pdf/' . $receipt_number . '.pdf';
		unlink($pdfFilePath);
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath,'F');	
			ob_clean();
		return TRUE;
		
	//	return TRUE;
	}
	
	/** Test PDF  */
	
	public function testpdfs(){
	    
		$print_data['receipt_data'] = $this->mcommon->records_all('donation',array('receipt_number'=>'22231643'));
		$print_data['setting'] = $this->mcommon->records_all('company_setting');
					//	print_r($print_data);
						 	// $data = array(
        //             			'title' => "Donation",
        //             			'content' =>$this->load->view('Webpage/donation_pdf',$print_data, TRUE),
        //             		);
	            	//$this->load->view('base/base_template', $data);
	            	$this->load->view('Webpage/donation_pdf',$print_data);
	}
	
	
	
	public function donation()
	{

		if (isset($_POST['submit'])) {

			$receipt_number = $this->input->post('receipt_number');
			$receipt_month = $this->input->post('receipt_month');
			$remarks = $this->input->post('remarks');
			$firstName = $this->input->post('firstName');
			$lastName = $this->input->post('lastName');
			$email = $this->input->post('email');
			$mobileNo = $this->input->post('mobileNo');
			$address = $this->input->post('address');
			$panNumber = $this->input->post('panNumber');
			$amount = $this->input->post('amount');
			$paymentMode = $this->input->post('paymentMode');
			$transNumber = $this->input->post('transNumber');
			$transDate = $this->input->post('transDate');
			$transBank = $this->input->post('transBank');
			$created_by = $this->session->userdata('user_id');
			$user_id = $this->input->post('user_id');
			$donation_type = $this->input->post('donation_type');
			$financial_year = $this->input->post('financial_year');

			$convertDate = '01-' . $receipt_month . date("-Y");
			$mail_date = date('d-m-Y'); //date("M-Y", strtotime($convertDate));

			if (empty($user_id)) {
				$user_id = '';
			}

			if ($paymentMode == 3) {

				$insert_array = array(
					'receipt_number' => $receipt_number,
					'receipt_month' => $receipt_month,
					'financial_year' => $financial_year,
					'firstName' => $firstName,
					'lastName' => $lastName,
					'email' => $email,
					'mobileNo' => $mobileNo,
					'address' => $address,
					'panNumber' => $panNumber,
					'amount' => $amount,
					'paymentMode' => $paymentMode,
					'transNumber' => $transNumber,
					'corpusFund' => $donation_type,
					'transBank' => $transBank,
					'transDate' => $transDate,
					'created_by' => $created_by,
					'remarks' => $remarks,
					'status' => 1,
					'user_id' => $user_id,
					'receipt_date' => date('Y-m-d'),
					'created_at' => date('Y-m-d h-i-s')
				);
			} else {
				$insert_array = array(
					'receipt_number' => $receipt_number,
					'receipt_month' => $receipt_month,
					'financial_year' => $financial_year,
					'firstName' => $firstName,
					'lastName' => $lastName,
					'email' => $email,
					'mobileNo' => $mobileNo,
					'address' => $address,
					'panNumber' => $panNumber,
					'amount' => $amount,
					'remarks' => $remarks,
					'paymentMode' => $paymentMode,
					'corpusFund' => $donation_type,
					'created_by' => $created_by,
					'status' => 1,
					'user_id' => $user_id,
					'receipt_date' => date('Y-m-d'),
					'created_at' => date('Y-m-d h-i-s')
				);
			}


			$insert = $this->mcommon->common_insert('donation', $insert_array);

			if ($insert > '0') {

				$filename = $this->generatePdf($insert);
				$pdf_file = base_url('public/pdf/') . $filename . '.pdf';
				//$pdf_file=base_url().$filename;
				$this->load->library('email');
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'smtp-relay.sendinblue.com';
				$config['smtp_port'] = '587';
				$config['smtp_timeout'] = '7';
				$config['smtp_user']    = 'info@alphasoftz.com';
   			    $config['smtp_pass']    = 'KFdL2yO6tH75SnZW';
				$config['charset'] = 'utf-8';
				$config['newline'] = "\r\n";
				$config['mailtype'] = 'html';
				$config['validation'] = true;

				$this->email->initialize($config);
				$this->email->from('kainkaryatrust@gmail.com', 'kainkaryatrust');

				$this->email->to($email);
				$this->email->subject('RECEIPT FROM KAINKARYA CHARITABLE TRUST.-' . $mail_date);


				$message_mail = 'Dear &nbsp;' . $firstName . '&nbsp;' . $lastName . ',<br><br>
						               Greetings from Kainkarya Charitable Trust.<br><br>
						               We thank you for donating to our Trust serving for the noble causes.<br>
									   Please find attached the receipt for the donation on &nbsp;' . $mail_date . '.<br><br>
									   Thanking you once again.<br><br>
									   Regards<br><br>
									   Authorised Signatory<br><br>
						               Kainkarya Charitable Trust<br>';
				$this->email->message($message_mail);
				$this->email->attach($pdf_file);
				$this->email->send();

				// $msg = 'Dear ' . $firstName . '' . $lastName . ' , Thank you for your contribution to the service for noble causes. The receipt has been sent to the email id registered with us. You can also download the receipt logging into our website www.kainkarya.com - Kainkarya Charitable Trust.';
				$msg = 'Dear ' . $firstName . '' . $lastName . ' , Thank you for your contribution to the service for the noble causes. The receipt has been sent to the email id registered with us. You can also download the receipt logging into our website www.kainkarya.com - Kainkarya Charitable Trust.';

				$this->sendsms($mobileNo, $msg, $firstName, '3');

				$this->session->set_flashdata('alert_success', 'Donation add successfully!');
				redirect('donation/donation');
			} else {
				$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
				redirect('donation/donation');
			}
		}

		$view_data['donation'] = $this->mcommon->records_all('donation');
		$view_data['setting'] = $this->mcommon->records_all('company_setting');
		$view_data['users_list'] = $this->main->get_users();
		$view_data['fin_year'] = $this->main->get_financial_year();

		$data = array(
			'title' => "Donation",
			'content' => $this->load->view('Webpage/add_donation', $view_data, TRUE),
		);
		$this->load->view('base/base_template', $data);
	}

	public function sendsms($phone, $msg, $name1, $sms_type)
	{
		$mobile = $phone;
		$message = urlencode($msg);

		if ($sms_type == 1) {
			$url = "http://reseller.alphasoftz.info/api/sendsms.php?user=kainkarya&apikey=TzaeBRxqJfWU6EhpdrUK&mobile=$mobile&message=$message&senderid=KKARYA&type=txt&tid=1507166067551464055";
		} elseif ($sms_type == 2) {
			$url = "http://reseller.alphasoftz.info/api/sendsms.php?user=kainkarya&apikey=TzaeBRxqJfWU6EhpdrUK&mobile=$mobile&message=$message&senderid=KKARYA&type=txt&tid=1507166067555518943";
		} elseif ($sms_type == 3) {
			$url = "http://reseller.alphasoftz.info/api/sendsms.php?user=kainkarya&apikey=TzaeBRxqJfWU6EhpdrUK&mobile=$mobile&message=$message&senderid=KKARYA&type=txt&tid=1507166067559104786";
		}

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$curl_scraped_page = curl_exec($ch);
		curl_close($ch);
		$result = explode(' ', $curl_scraped_page);
		return $result;
	}


	public function generatePdf($donation_id)
	{
		//load the view and saved it into $html variable
		$view_data['setting'] = $this->mcommon->records_all('company_setting');
		$receipt_data = $this->main->get_donation_details($donation_id);
		$view_data['receipt_data'] = $receipt_data;		
		$receipt_number = $receipt_data[0]['receipt_number'];
		$html = $this->load->view('Webpage/test_pdf', $view_data, TRUE);
		$pdfFilePath =  $_SERVER['DOCUMENT_ROOT'] . '/admin/public/pdf/' . $receipt_number . '.pdf';
		unlink($pdfFilePath);
		$this->m_pdf->pdf->WriteHTML($html);
		ob_clean();
		$this->m_pdf->pdf->Output($pdfFilePath,'F');	
		return $receipt_number;
	}
}
