<?php


class Reports extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library('M_pdf');
    if($this->session->userdata('auth_level')!='10'){
      redirect('login');
    }
  }

  public function index()
  {
    $this->load->view('Webpage/header.php');
    $this->load->view('Webpage/home.php');
    $this->load->view('Webpage/footer.php');
  }
 
  public function user_polling()
  {
    if (isset($_POST['submit'])) {
    $user_type = $this->input->post('user_type');    
     $view_data['usertype_qa'] = $this->main->get_polling_by_usertype($user_type);
    $view_data['users'] = $this->mcommon->records_all('users',array('active'=>1));    
    } else {    
        $view_data['users'] = $this->mcommon->records_all('users',array('active'=>1));
         $view_data['usertype_qa'] = $this->main->get_polling_by_usertype();
    }
    $data = array(
      'title' => " User Report",
      'content' => $this->load->view('Webpage/usertype_report', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }

  public function summary_report()
  {
    if (isset($_POST['submit'])) {
    $user_type = $this->input->post('user_type');    
     $view_data['usertype_qa'] = $this->main->get_polling_by_usertype($user_type);
    $view_data['users'] = $this->mcommon->records_all('users',array('active'=>1));    
    } else {    
        $view_data['users'] = $this->mcommon->records_all('users',array('active'=>1));
         $view_data['usertype_qa'] = $this->main->get_polling_by_usertype();
    }
    $data = array(
      'title' => " Donation list",
      'content' => $this->load->view('Webpage/summary_report', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }

  public function search_donation()
  {
    if (isset($_POST['submit'])) {
      $year = $this->input->post('year');
      $view_data['records'] = $this->main->donation_register_data($year);

      $view_data['year'] = $this->main->get_financial_year();

      $data = array(
        'title' => "Donation Register",
        'content' => $this->load->view('Webpage/donation_register', $view_data, TRUE),
      );
      $this->load->view('base/base_template', $data);
    }
  }
  public function exportCSV()
  {

    // file name
    $filename = 'user' . date('Ymd') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");

    // file creation
    $file = fopen('php://output', 'w');

    $header = array("S.NO", "User Type", "First Name", "Last Name", "Email ID ", "Mobile Number");
    fputcsv($file, $header);
    fputcsv($file, array('1', 'Trustee (or) Managing Trustee (or)General Council Member (or) Monthly Contributor (or)Other Contributor', 'Vasanth', 'Ram', 'example@gmail.com', '9936386333'));
    fclose($file);
    exit;
  }



  public function pdf_conv($donation_id)
  {

    //load the view and saved it into $html variable
    $view_data['setting'] = $this->mcommon->records_all('company_setting');
    $receipt_data = $this->main->get_donation_details($donation_id);

    $view_data['receipt_data'] = $receipt_data;
    foreach ($receipt_data as $r) {
      $receipt_number = $r['receipt_number'];
    }
    $html = $this->load->view('Webpage/test_pdf', $view_data, TRUE);
    // echo"<pre>";print_r($html);exit();
    $pdfFilePath =  $_SERVER['DOCUMENT_ROOT'] . '/admin/public/pdf/' . $receipt_number . '.pdf';

    //load mPDF library
    $this->load->library('m_pdf');
    //generate the PDF from the given html
    $this->m_pdf->pdf->WriteHTML($html);
    ob_clean();
    $this->m_pdf->pdf->Output($pdfFilePath, 'F');
    return $receipt_number;
  }
}
