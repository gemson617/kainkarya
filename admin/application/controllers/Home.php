<?php


class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url','cookie'));
    $this->load->library('M_pdf');
    if($this->session->userdata('auth_level')!='10'){
      redirect('login');
    }
  }


  public function index()
  {
   
    //print_r(base_url());exit();
    //echo view('Webpage/header.php');
    //echo view('Webpage/home.php');
    //echo view('Webpage/footer.php');
    $this->load->view('Webpage/header.php');
    $this->load->view('Webpage/home.php');
    $this->load->view('Webpage/footer.php');
  }
  public function show_online_data($od_id)
  {
    $view_data['records'] = $this->mcommon->records_all('online_donation',array('od_id'=>$od_id));
   //echo "<pre>";print_r($view_data['records']);exit();
    $data = array(
      'title' => "Online Donation ",
      'content' => $this->load->view('Webpage/show_online_data', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }
  public function delete_receipt($donation_id,$month)
  {

    $delete = $this->mcommon->common_delete('donation', array('donation_id' => $donation_id,));
    if ($delete) {
      $this->session->set_flashdata('alert_success', 'Receipt Deleted successfully!');
      redirect('home/donation_list/'.$month);
    } else {
      $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
      redirect('home/donation_list/'.$month);
    }
  }
  public function get_online_donation()
  {

    if (isset($_POST['submit'])) {

      $year = $this->input->post('year');
      $receipt_month = $this->input->post('receipt_month');
      $view_data['online_donation'] = $this->main->get_online_donation($year, $receipt_month);
      $view_data['year'] = $this->main->get_financial_year();  
      $view_data['sel_year']=$year;
      $view_data['month']=$receipt_month;   
    } else {
      $view_data['online_donation'] = $this->main->get_online_donation();      
      $view_data['year'] = $this->main->get_financial_year();
    }


    $data = array(
      'title' => "Online Donation list",
      'content' => $this->load->view('Webpage/online_donation_list', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }
  
  public function resetUserPassword(){
      $userid=$this->input->post('userid');
      $password="Welcome@123";      
      $update = $this->mcommon->common_edit('users',array('password_hash'=>$this->hash_passwd($password)), array('id' => $userid));
      if ($update > '0') {
        $this->session->set_flashdata('alert_success', 'Reset User Password Successfully!');        
      } else {
        $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');        
      }
  }


  

  public function sendmail($donation_id,$mnth)
  {
   
    $view_data['setting'] = $this->mcommon->records_all('company_setting');
    $view_data['receipt_data'] = $this->main->get_donation_details($donation_id);

    foreach ($view_data['receipt_data'] as $d) {
      $email = $d['email'];
      $firstName = $d['firstName'];
      $lastName = $d['lastName'];
      $receipt_month = $d['receipt_month'];
      $receipt_date = $d['receipt_date'];     
      $fy=$d['financial_year'];
    }
   if($fy=='2021-2022'){
      $txtMsg="DONATIONS FROM 29TH NOVEMBER 2021 ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT";
    }elseif($fy=='2022-2023'){
      $txtMsg="DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT";
     }else{
      //$txtMsg="DONATIONS FROM 29TH NOVEMBER 2021 ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT";
      $txtMsg="DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT";
      
     }

    $convertDate = '01-' . $receipt_month . date("-Y");
    $mail_date = date("d-m-Y", strtotime($receipt_date));

    $pdf = $this->pdf_conv($donation_id);
   

    $pdf_file = base_url('public/pdf/') . $pdf . '.pdf';

    $this->load->library('email');
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'smtp-relay.sendinblue.com';
    $config['smtp_port'] = '587';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'kainkaryatrust@gmail.com';
    // $config['smtp_pass']    = 'pUZa3E61OTg4cwLj';
  //  $config['smtp_user']    = 'info@alphasoftz.com';
    //$config['smtp_pass']    = 'KFdL2yO6tH75SnZW';
    $config['smtp_pass']    = 'tnP6DjWLmS2xQf7w';
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
        '.$txtMsg.'<br><br>
        Thanking you once again.<br><br>
        Regards<br><br>
        Authorised Signatory<br><br>
              Kainkarya Charitable Trust<br>';
    $this->email->message($message_mail);
    $this->email->attach($pdf_file);


    if ($this->email->send()) {
      $this->session->set_flashdata('alert_success', 'Mail Send   successfully!');
      // echo $this->email->print_debugger();
      // echo "<pre>";print_r($this->email->send());
      redirect('home/donation_list/'.$mnth);
    } else {
      $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
      redirect('home/donation_list/');
    }
  }

  public function updateRecipt(){
   //  print_r($this->input->post());
     $data=array();
     $id=$this->input->post('donation_id');
     foreach($this->input->post() as $key=>$val){  
      if($key != 'donation_id'){
        $data[$key]=$val;
      }
     }
     $this->mcommon->common_edit('donation',$data,array('donation_id'=>$id));
     redirect('home/donation_list/');
    
  }

  public function editRecipt(){
   $id=$this->input->get('id');
   if($id != 0 || $id != '')
   {
    $this->db->select('u.email as usermail, u.firstName as fname, u.lastName as lname, d.donation_id, d.user_id, d.Fullname, d.firstName, d.lastName, d.email, d.mobileNo, d.amount, d.receipt_month, d.corpusFund, d.status');
    $this->db->from('donation as d');
    $this->db->join('users as u', 'u.id = d.user_id', 'left');
    $this->db->where('d.donation_id', $id);
    $query = $this->db->get();
    $result = $query->row();
    echo json_encode($result);
   }
  

  //  $data=$this->mcommon->specific_row('donation',array('donation_id'=>$id));
  //  print_r($this->db);
   
  }
  
public function aboutUs(){
     if (isset($_POST['submit'])) { 
         if($this->input->post('id') == ''){
              $content=$this->input->post('content');
         $menu=$this->input->post('menu_name');
         $insertArr=array(
             'content'=>$content,
              'menu'=>$menu
             );
            $id=$this->db->insert('about_us',$insertArr);
            if($id){
                 $this->session->set_flashdata('alert_success', 'About us Added successfully!');
                    redirect('home/aboutUs/');
            }
         }else{
             $id=$this->input->post('id');
              $content=$this->input->post('content');
             $menu=$this->input->post('menu_name');
             $insertArr=array(
                 'content'=>$content,
                  'menu'=>$menu
                 );
                $id=$this->mcommon->common_edit('about_us',$insertArr,array('id'=>$id));
                if($id){
                     $this->session->set_flashdata('alert_success', 'About us Updated successfully!');
                        redirect('home/aboutUs/');
                }
         }
        
         
     }else{
         $view_data['records']=$this->mcommon->records_all('about_us');
         $data = array(
          'title' => " About Us",
          'content' => $this->load->view('Webpage/aboutus', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
         
     }
     
 }  


 public function download(){
  $view_data['records']=$this->mcommon->records_all('download_management');
  $data = array(
   'title' => " About Us",
   'content' => $this->load->view('Webpage/download', $view_data, TRUE),
 );
 $this->load->view('base/base_template', $data);
 }
 public function downloadDelete($id=''){
    $path=$this->mcommon->specific_row_value('download_management',array('id'=>$id),'file_path');
    if($path){
      unlink($path);
      $this->mcommon->common_delete('download_management',array('id'=>$id));   
      $this->session->set_flashdata('alert_success','Deleted Successfully');
            redirect('home/download'); 
    }
           
 }

 public function downloadEdit($id=''){
  if(isset($_POST['submit'])){
    $id=$this->input->post('id'); 
    $title=$this->input->post('title');  
    $file_type=$this->input->post('file_type');
    $exist_file=$this->input->post('exist_file');
    $filePrefix=($file_type==1) ? 'Pamphlet':'Forms'; 

      $ext = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
      $fileName=$filePrefix."_".uniqid().'_'.date("y_m_s");
      $config['file_name']=$fileName.".".$ext;
      $config['upload_path']="./public/adn-assets/img/downloads/";         
      $config['allowed_types']        = 'docx|doc|DOC|DOCX|pdf|csv';
      $this->load->library('upload',$config);   
      $this->upload->initialize($config);          
      $nm=$fileName.".".$ext;
      if($_FILES['files']['name'] !=''){
      if($this->upload->do_upload('files')){
          $data=$this->upload->data();         
      } else{        
          $this->session->set_flashdata('alert_danger', $this->upload->display_errors());
          redirect('home/download');
          die();
      } 
    }
      
     
      $pdf_file1 = base_url('/public/adn-assets/img/downloads/'.$nm);
      $insert_Data = array(
        'title' => $title,
        'file_type'=>$file_type,
        'file_path' =>($_FILES['files']['name'] !='') ? $pdf_file1:$exist_file,                
      ); 
      $edit = $this->mcommon->common_edit('download_management', $insert_Data,array('id'=>$id));            
      if($_FILES['files']['name'] > 0){
        unlink($exist_file);
      }
      $this->session->set_flashdata('alert_success', 'upload Done!');
      redirect('home/download');

    }
  
  $view_data['records']=$this->mcommon->records_all('download_management',array('id'=>$id));
  $data = array(
   'title' => " About Us",
   'content' => $this->load->view('Webpage/edit_download', $view_data, TRUE),
 );
 $this->load->view('base/base_template', $data);
 }

 public function saveDownload(){
  $title=$this->input->post('title');  
  $file_type=$this->input->post('file_type');
  $filePrefix=($file_type==1) ? 'Pamphlet':'Forms';
 foreach($title as $key=>$row){
          $_FILES['img']['name']=$_FILES['files']['name'][$key];
          $_FILES['img']['type']= $_FILES['files']['type'][$key];
          $_FILES['img']['size']= $_FILES['files']['size'][$key];          
          $_FILES['img']['tmp_name']=$_FILES['files']['tmp_name'][$key];  
          $ext = pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION);
          $fileName=$filePrefix."_".uniqid().'_'.date("y_m_s");
          $config['file_name']=$fileName.".".$ext;
          $config['upload_path']="./public/adn-assets/img/downloads/";         
          $config['allowed_types']        = 'docx|doc|DOC|DOCX|pdf|csv';
          $this->load->library('upload',$config);   
          $this->upload->initialize($config);          
          $nm=$fileName.".".$ext;
          if($this->upload->do_upload('img')){
              $data=$this->upload->data();
              $filenm = $data['file_name'];  
              $pdf_file = base_url('/public/adn-assets/img/downloads/'.$filenm);
              $insert_Data = array(
                'title' => $title[$key],
                'file_type'=>$file_type,
                'file_path' => $pdf_file,                
              ); 
              $insert = $this->mcommon->common_insert('download_management', $insert_Data);            

          }   else{
              echo $this->upload->display_errors();
              $this->session->set_flashdata('alert_danger', $this->upload->display_errors());
              redirect('home/download');
              die();
          } 

          $this->session->set_flashdata('alert_success', 'upload Done!');
          redirect('home/download');
        }


 }
 
 public function editAbout($id){
      $view_data['editData']=$this->mcommon->records_all('about_us',array('id'=>$id));
         $data = array(
          'title' => " Edit About Us",
          'content' => $this->load->view('Webpage/aboutus', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
 }

  public function donation_list()
  {
    if (isset($_POST['submit'])) {

      $year = $this->input->post('year');
      $receipt_month = $this->input->post('receipt_month');
      $types=$this->input->post('types');
      $view_data['donation'] = $this->main->get_donation($year, $receipt_month,$types);
      $view_data['year'] = $this->main->get_financial_year();
      $view_data['sel_year']=$year;
      $view_data['month']=$receipt_month;   
      $view_data['types']=$types; 
      /*  $data = array(
        'title' => " Donation list",
        'content' => $this->load->view('Webpage/donation_list', $view_data, TRUE),
      );
      $this->load->view('base/base_template', $data); */
    } else {
      $mn=($this->uri->segment(3) > 0) ? $this->uri->segment(3):date('n');
      $yr=$this->mcommon->specific_row_value('company_setting','','current_financial_year');
      $view_data['donation'] = $this->main->get_donation($yr,$mn);
      $view_data['year'] = $this->main->get_financial_year();
    }




    $data = array(
      'title' => " Donation list",
      'content' => $this->load->view('Webpage/donation_list', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }
  public function search_donation()
  {
    if (isset($_POST['submit'])) {
      $year = $this->input->post('year');
      $view_data['records'] = $this->main->donation_register_data($year);
     // print_r($view_data['records']);
      $view_data['year'] = $this->main->get_financial_year();

      $data = array(
        'title' => "Donation Register",
        'content' => $this->load->view('Webpage/donation_register', $view_data, TRUE),
      );
      $this->load->view('base/base_template', $data);
    }
  }
  public function donation_register()
  {


    $view_data['year'] = $this->main->get_financial_year();
    $data = array(
      'title' => "Donation Register",
      'content' => $this->load->view('Webpage/donation_register', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }
  public function annual_upload()
  {

    if (isset($_POST['submit'])) {
      $id = $this->input->post('id');
      $title = $this->input->post('title');

      if ($_FILES['file']['name'] != '') {

        $config['upload_path']          = './public/adn-assets/img/annual_reports/';
        $config['allowed_types']        = 'docx|doc|DOC|DOCX|pdf|csv';
        // $config['max_size']             = 2048;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')) {
          $error = array('error' => $this->upload->display_errors());
          // print_r($error);exit();
          $this->session->set_flashdata('alert_danger', 'Annual Reports upload  failed!');
          redirect('home/annual_upload');
        } else {
          $data = $this->upload->data();
          $file = $data['file_name'];
        }
      }

      $insert_Data = array(
        'caption' => $title,
        'file' => $file,
        'created_date' => date('Y-m-d H:i:s'),
        'status' => 1,
      );
      $insert = $this->mcommon->common_insert('annual_reports', $insert_Data);
      if ($insert) {
        $this->session->set_flashdata('alert_success', 'Annual Reports Added   successfully!');
        redirect('home/annual_upload/');
      } else {
        $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
        redirect('home/annual_upload/');
      }
    }

    $view_data['aid_file'] = $this->mcommon->records_all('aid_file');
    $data = array(
      'title' => "Annual Reports",
      'content' => $this->load->view('Webpage/annual_reports', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }


  public function aid_upload_pdf(){
   
      $cnt=count($_FILES['pdf_files']['name']);
      $row=array(); 
     $year=$this->input->post('year');
      for($i=0;$i<$cnt;$i++){
              $_FILES['img']['name']=$_FILES['pdf_files']['name'][$i];
              $_FILES['img']['type']= $_FILES['pdf_files']['type'][$i];
              $_FILES['img']['size']= $_FILES['pdf_files']['size'][$i];
         

               $names=explode("_",$_FILES['pdf_files']['name'][$i])[1];
               $fname=explode(" ",$names)[0];
               $lname=explode(" ",$names)[1];
               $fullname=str_replace(' ', '_', $names);
                 
               $nums=explode("_",$_FILES['pdf_files']['name'][$i])[3];
               $nos=substr($nums,14,7);
              

                $ext = pathinfo($_FILES['pdf_files']['name'][$i], PATHINFO_EXTENSION);
           $file_name="10BE_".$year."_".$fullname."_".$nos."_".date("y_m_s");
           $config['file_name']=$file_name.".".$ext;
              $_FILES['img']['tmp_name']=$_FILES['pdf_files']['tmp_name'][$i];  
              $config['upload_path']="./public/adn-assets/img/aid_file_pdf/";
             // $config['max_size']='100';
              $config['allowed_types']="pdf";
              $this->load->library('upload',$config);   
              $this->upload->initialize($config);
               $lastname=explode(" ",$names);
             
           $result=$this->mcommon->get_email('users',$names);
              
              $nm=$file_name.".".$ext;

              if($this->upload->do_upload('img')){
                  $data=$this->upload->data();
                  $filenm = $data['file_name'];
       
              }   else{
                  echo $this->upload->display_errors(); die();
              } 

             

                         $pdf_file = base_url('/public/adn-assets/img/aid_file_pdf/'.$filenm);
                  $this->load->library('email');
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'smtp-relay.sendinblue.com';
    $config['smtp_port'] = '587';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'kainkaryatrust@gmail.com';
   // $config['smtp_user']    = 'info@alphasoftz.com';
   $config['smtp_pass']    = 'tnP6DjWLmS2xQf7w';
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['mailtype'] = 'html';
    $config['validation'] = true;

    $this->email->initialize($config);
    $this->email->from('kainkaryatrust@gmail.com', 'kainkaryatrust');

    $this->email->to($result['email']);
    $this->email->subject('Kainkarya Charitable Trust - 10BE Certificate');
    $message_mail = 'Dear &nbsp;' . $names . '&nbsp;,<br><br>
              Greetings from Kainkarya Charitable Trust.<br><br>             
        Please find attached the 10 BE Certificate,being the Certificate of donation under clause (ix) of sub-section (5) of section 80G and under clause (ii) to sub-section (1A) of section 35 of the Income-tax Act, 1961.<br><br>
        This certificate has been issued by the Income Tax Department after our filing the data of donations collected during the year.<br>
        This certificate can be used for filing the income tax returns for the relevant financial year.<br>
        The certificate can also be downloaded logging to our website - kainkarya.com under tab  10 BE Certificates<br><br>        
        Regards<br><br>
        Authorised Signatory<br><br>
        Kainkarya Charitable Trust<br>';
    $this->email->message($message_mail);
    $this->email->attach($pdf_file);



    if ($this->email->send()) {

        $insert_Data = array(
                  'userid' => $result['id'],
                  'file_name' => $nm,
                  'year'=>$year,
                  'created_date' => date('Y-m-d H:i:s'),
                  'status' => 1,
             );
            $insert = $this->mcommon->common_insert('aid_file_pdf', $insert_Data);

      $this->session->set_flashdata('alert_msg', 'Mail Send   successfully!');
      $this->email->clear(TRUE);
      //redirect('home/aid_upload/');
      echo "1";
    } else {
      $this->session->set_flashdata('alert_dan', 'Something went wrong. Please try again later');
      //redirect('home/aid_upload/');
      echo 'Something went wrong. Please try again later';
    }
              
     
 
             
         }

  }

public function pdf_users(){

   
    $view_data['users_list'] = $this->main->view_users_dropdown();
     $view_data['records']=$this->mcommon->records_all('aid_file_pdf');
  $view_data['year'] = $this->main->get_financial_year1();  
  $view_data['cur_year'] =$this->mcommon->specific_row_value('financial_year', array('status' => 1), 'year');
    $data = array(
      'title' => " 10 BE  Certificate List",
      'content' => $this->load->view('Webpage/user_list_pdf', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
}

public function be_summary(){

   
    $view_data['users_list'] = $this->main->view_users_dropdown();
    $data = array(
      'title' => " 10 BE  Summary ",
      'content' => $this->load->view('Webpage/be_summary', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
}


public function get_pdf_users(){
  $userid=$this->input->post('userid');
   $year=$this->input->post('year');
  $users = $this->mcommon->records_all('aid_file_pdf',array('userid'=>$userid,'year'=>$year));
   $output='';
  if(count($users) > 0){
  $i=1;
  foreach($users as $row){
    $status=($row->status == 1) ? 'Mail sent':'Mail not send';
    $output .="<tr class='even'>
    <td>".$i++."</td>
    <td><a download='".$row->file_name."' href='".base_url('public/adn-assets/img/aid_file_pdf/').$row->file_name."'>".$row->file_name."</a></td>
    <td>".$row->year."</td>
    <td>".date('Y-m-d h:i A',strtotime($row->created_date))."</td>
    <td>".$status."</td>
    </tr>";
  }
  }else{
echo "<p style='text-align:center;'>No Data Available</p>";
  }
 

  echo $output;
 
}

public function get_summary_users(){
   $date=date('Y-m-d',strtotime($this->input->post('date')));
  $users = $this->mcommon->get_specific_like('aid_file_pdf',$date);
  
   $output='';
 if(count($users) > 0){
 $i=1;
  foreach($users as $row){
    $status=($row->status == 1) ? 'Mail sent':'Mail not send';
    $output .="<tr class='even'>
    <td>".$i++."</td>
    <td>".$row->name."</td>
    <td><a download='".$row->file_name."' href='".base_url('../../public/adn-assets/img/aid_file_pdf/').$row->file_name."'>".$row->file_name."</a></td>
    <td>".$row->year."</td>
    <td>".date('Y-m-d h:i A',strtotime($row->created_date))."</td>
    <td>".$status."</td>
    </tr>";
  }
  }else{
echo "<p style='text-align:center;'>No Data Available</p>";
  }
 

 echo $output;
}



public function aid_pdf(){

   // $view_data['users'] = $this->mcommon->records_all('aid_file_pdf',array('userid'=>$this->session->userdata('user_id')));
     $view_data['aid_file'] = $this->main->get_aid_file();
      $view_data['year'] = $this->main->get_financial_year();
    $data = array(
      'title' => " Upload BE PDF ",
      'content' => $this->load->view('Webpage/aid_upload_pdf',$view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
}


  public function aid_upload()
  {

    if (isset($_POST['submit'])) {

      $id = $this->input->post('id');
      $title = $this->input->post('title');
      $year = $this->input->post('financial_year');
      $type = $this->input->post('report_type');

      if ($_FILES['aid_pdf']['name'] != '') {

        $config['upload_path']          = './public/adn-assets/img/aid_file/';
        $config['allowed_types']        = 'docx|doc|DOC|DOCX|pdf|csv';
        // $config['max_size']             = 2048;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('aid_pdf')) {
          $error = array('error' => $this->upload->display_errors());

          $this->session->set_flashdata('alert_danger', 'Aid Regiser upload  failed!');
          redirect('home/aid_upload');
        } else {
          $pan_data = $this->upload->data();
          $aid_file = $pan_data['file_name'];
        }
      }

      $insert_Data = array(
        'title' => $title,
        'aid_file' => $aid_file,
        'financial_year'=>$year,
        'report_type'=>$type,
        'created_date' => date('Y-m-d H:i:s'),
        'status' => 1,
      );
      $insert = $this->mcommon->common_insert('aid_file', $insert_Data);
      if ($insert) {
        $this->session->set_flashdata('alert_success', 'Aid Register Added   successfully!');
        redirect('home/aid_upload/');
      } else {
        $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
        redirect('home/aid_upload/');
      }
    }

    $view_data['aid_file'] = $this->main->get_aid_file();
    $view_data['year'] = $this->main->get_financial_year();
    $data = array(
      'title' => "Document Upload",
      'content' => $this->load->view('Webpage/aid_upload', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }

  public function aid_delete($id){
    //echo $id;
    $delete = $this->mcommon->common_delete('aid_file', array('id' => $id));
    if ($delete) {
      $this->session->set_flashdata('alert_success', 'Document Deleted Success!');
      redirect('home/aid_upload/');
    } else {
      $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
      redirect('home/aid_upload/');
    }
  }


  public function BD_Report(){
    $year=$this->input->post('year');

    $this->db->select("d.donation_id,d.receipt_number,d.receipt_date,d.receipt_month,d.firstName,d.lastName,od.address,d.amount,d.paymentMode,d.corpusFund,d.panNumber");
    $this->db->from("donation as d");
    $this->db->join("online_donation as od","od.user_id=d.user_id",'left');
    if($year){
      $this->db->where('d.financial_year',$year);
    }
    $this->db->where('d.status','1');
     $this->db->order_by('d.receipt_number','ASC');
    $this->db->group_by('d.corpusFund,d.receipt_month');
    $result=$this->db->get()->result();
 // echo "<pre>";print_r($result);
 // exit();
    foreach ($result as $o) {
      $response[$o->receipt_month][] = $o;
    }
    $this->db->select("d.donation_id,d.receipt_number,d.panNumber,d.receipt_month,d.receipt_month,d.receipt_date,d.corpusFund,CONCAT(d.firstName,' ',d.lastName) as name,d.corpusFund,d.paymentMode,d.amount,d.financial_year,u.address");
    $this->db->from("donation as d");
    $this->db->join("users as u","u.id=d.user_id",'left');  
    if($year){
      $this->db->where('d.financial_year',$year);
    }
    $this->db->where('d.status','1');
     $this->db->order_by('d.receipt_number','ASC');
    $donation=$this->db->get()->result();
    foreach ($donation as $o) {
      $donation_result[$o->receipt_month][] = $o;
    }

    $this->db->select("d.od_id,d.transNumber,d.panNumber,d.receipt_month,d.receipt_month,d.receipt_date,d.corpusFund,CONCAT(d.firstName,' ',d.lastName) as name,d.corpusFund,d.paymentMode,d.amount,d.financial_year,d.address");
    $this->db->from("online_donation as d"); 
    if($year){
      $this->db->where('d.financial_year',$year);
    }  
   // $this->db->order_by('d.receipt_number','ASC');
    $donation=$this->db->get()->result();
    foreach ($donation as $o) {
      $online_donation_result[$o->receipt_month][] = $o;
    }
    $this->db->select("d.paymentMode as mode,d.firstName,d.corpusFund,d.lastName,SUM(d.amount) as amount,d.user_id,d.panNumber,u.address");
    $this->db->from("donation as d");
    $this->db->join("users as u","u.id=d.user_id",'left'); 
    if($year){
      $this->db->where('financial_year',$year);
    } 
    $this->db->group_by("d.user_id,d.corpusFund");
    $summary=$this->db->get()->result();
    // foreach($summary as $row){
    //   $summaryArr[$row->user_id][]=$row;
    // }
  
    $view_data['option'] =$this->input->post('option');
    $view_data['summaryArr'] = $summary;
    $view_data['users'] = $response; //$this->main->view_users_level();
    $view_data['donation_result'] = $donation_result;
    $view_data['online_donation_result'] = $online_donation_result;
    $view_data['year'] = $this->main->get_financial_year();
    $data = array(
      'title' => " Users Profiles",
      'content' => $this->load->view('Webpage/bd_report', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);

  }




  public function settings()
  {
    if (isset($_POST['submit'])) {
      //echo"<pre>"; print_r($_POST);exit();
      $id = $this->input->post('id');
      $trust_name = $this->input->post('trust_name');
      $contact_number = $this->input->post('contact_number');
      $address = $this->input->post('address');
      $receipt_prefix = $this->input->post('receipt_prefix');
      $current_financial_year = $this->input->post('current_financial_year');
      $trust_pan = $this->input->post('trust_pan');
      $trust_urn = $this->input->post('trust_urn');
      $charges = $this->input->post('charges');
      $marquee = $this->input->post('marquee');
      $active = $this->input->post('active');

      if ($_FILES['trust_logo']['name'] != '') {

        $config['upload_path']          = './public/adn-assets/img/pan/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        // $config['max_size']             = 2048;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('trust_logo')) {
          $error = array('error' => $this->upload->display_errors());
          $this->session->set_flashdata('alert_danger', 'Trust logo upload  failed!');
          redirect('home/settings');
        } else {
          $logo_data = $this->upload->data();
          $logo_image = $logo_data['file_name'];
        }
      } else {
        $logo_image = $this->input->post('trust_logo1');
      }
      if ($_FILES['trust_deed']['name'] != '') {

        $config['upload_path']          = './public/adn-assets/img/pan/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        // $config['max_size']             = 2048;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('trust_deed')) {
          $error = array('error' => $this->upload->display_errors());
          $this->session->set_flashdata('alert_danger', 'Trust logo upload  failed!');
          redirect('home/settings');
        } else {
          $deed_data = $this->upload->data();
          $deed_image = $deed_data['file_name'];
        }
      } else {
        $deed_image = $this->input->post('trust_deed1');
      }

      $insert_Data = array(
        'trust_name' => $trust_name,
        'address' => $address,
        'receipt_prefix' => $receipt_prefix,
        'contact_number' => $contact_number,
        'trust_pan' => $trust_pan,
        'trust_urn' => $trust_urn,
        'trust_logo' => $logo_image,
        'trust_deed' => $deed_image,
        'charges' => $charges,
        'current_financial_year' => $current_financial_year,
        'marquee' => $marquee,
        'active' =>$active,
      );
      //echo "<pre>";print_r($insert_Data);exit();
      $update = $this->mcommon->common_edit('company_setting', $insert_Data, array('id' => $id,));
      if ($update) {
        $this->session->set_flashdata('alert_success', 'Setting  Updated !');
        redirect('home/settings/');
      } else {
        $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
        redirect('home/settings/');
      }
    }

    $view_data['setting'] = $this->mcommon->records_all('company_setting');

    $data = array(
      'title' => "Trust Settings",
      'content' => $this->load->view('Webpage/setting', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }

  public function dashboard()
  {
    if ($this->session->userdata('auth_level') == 10) {
      $setting = $this->mcommon->records_all('company_setting');
      foreach ($setting as $key => $s) {
        $current_financial_year = $s->current_financial_year;
      }

      $today = date('Y-m-d');
      $fy=date('Y')."-".date('Y',strtotime("+1 Year"));
      //$view_data['users'] = $this->main->get_trust_users();
      $view_data['trust_users'] = $this->mcommon->records_all('users', array(
        'auth_level' => 9,'active'=>1
      ));
      $view_data['general'] = $this->mcommon->records_all('users', array('auth_level' => 8,'active'=>1));
      $view_data['member'] = $this->mcommon->records_all('users', array('auth_level' => 1,'active'=>1));
      $view_data['monthly'] = $this->mcommon->records_all('users', array('auth_level' => 7,'active'=>1));
      $view_data['no_details'] = $this->mcommon->records_all('users', array('auth_level' => 5,'active'=>1));
//,'financial_year'=>$fy

      $view_data['onetime_donation'] = $this->mcommon->records_all('donation', array('status'=>1,'corpusFund' => 3,'financial_year'=>$current_financial_year));
      $view_data['corpos_donation'] = $this->mcommon->records_all('donation', array('status'=>1,'corpusFund' => 2,'financial_year'=>$current_financial_year));
      $view_data['monthly_donation'] = $this->mcommon->records_all('donation', array('status'=>1,'corpusFund' => 1,'financial_year'=>$current_financial_year));
      $view_data['month_data'] = $this->main->get_donation_month($current_financial_year);

      $view_data['onetime_donation_amount'] = $this->mcommon->sum_rows('donation', array('status'=>1,'corpusFund' => 3,'financial_year'=>$current_financial_year));
      $view_data['corpos_donation_amount'] = $this->mcommon->sum_rows('donation', array('status'=>1,'corpusFund' => 2,'financial_year'=>$current_financial_year));
      $view_data['monthly_donation_amount'] = $this->mcommon->sum_rows('donation', array('status'=>1,'corpusFund' => 1,'financial_year'=>$current_financial_year));

      $view_data['fin_year']=$current_financial_year;
      $view_data['users'] = $this->main->get_users();
      $view_data['today_amount'] = $this->mcommon->records_all('donation', array(
        'DATE_FORMAT(created_at,"%Y-%m-%d")' => $today,'status'=>1,
      ));
      $month_first = date('Y-m-01', strtotime($today));
      $month_last = date('Y-m-t', strtotime($today));
      $view_data['month_amount'] = $this->mcommon->records_all('donation', array(
        'DATE_FORMAT(created_at,"%Y-%m-%d")>=' => $month_first,
        'DATE_FORMAT(created_at,"%Y-%m-%d")<=' => $month_last,
        'status'=>1,
      ));
      //pan!= address!= 'active'=>1,'active'=>1,

      $view_data['update_pan_users'] = $this->mcommon->records_all('users', array('auth_level !=' => '10','active'=>1,'pan!='=>''));     
      $view_data['update_address_users'] = $this->mcommon->records_all('users', array('auth_level !=' => '10','active'=>1,'address!='=>''));
      $view_data['total_users'] = $this->mcommon->records_all('users', array(
        'auth_level!=' => 10,'active'=>1,'auth_level !=' => '5'
      ));
      $view_data['overall_data']=$this->main->get_overall_amount();
   
      $view_data['current_year']=$this->main->get_current_year_amount();
     

      $data = array(
        'title' => "Dashboard",
        'content' => $this->load->view('Webpage/dashboard', $view_data, TRUE),
      );
      $this->load->view('base/base_template', $data);
    } else {
      redirect('login');
    }
  }

  public function get_userdata()
  {
    $user_id = $this->input->post('user_id');
    $result = $this->mcommon->records_all('users', array('id' => $user_id,));
    echo json_encode($result);
  }

  public function export_excel(){
     $this->db->select("pq.question,pa.answer")
      ->from("polling_questions as pq")
      ->join("polling_answer as pa","pa.question_id=pq.id",'left');
      $result=$this->db->get()->result();

       $filename = 'Questionnaire1' .'.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");

    // file creation
    $file = fopen('php://output', 'w');

    $header = array("S.NO", "User Type", "First Name", "Last Name", "Email ID ", "Mobile Number");
    fputcsv($file, $header);
    fputcsv($file, array('1', 'Trustee (or) Managing Trustee (or)General Council Member (or) Monthly Contributor (or)Other Contributor', 'Vasanth', 'Ram', 'example@gmail.com', '9936386333'));
    fclose($file);


      echo json_encode($result);

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

  public function user_import()
  {


    $filename = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
      $file = fopen($filename, "r");
      fgets($file);

      $sno = 0;

      while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE) {
        $check_mail = 0;
        $check_mobile = 0;
        $users = $this->mcommon->records_all('users');
        foreach ($users as  $u) {
          $id = $u->id + 1;
        }

        if ($importdata[0] !== 'S.NO') {

          $user_type        = stripslashes($importdata[1]);
          $firstName        = stripslashes($importdata[2]);
          $lastName         = stripslashes($importdata[3]);
          $email            = stripslashes($importdata[4]);
          $mobileNo         = stripslashes($importdata[5]);
          if (!empty($email)) {

            $check_mail = $this->mcommon->specific_record_counts('users', array('email' => $email,));
          }
          if (!empty($mobileNo)) {


            $check_mobile = $this->mcommon->specific_record_counts('users', array('mobile' => $mobileNo,));
          }

          $check1 = "Trustee";
          $check2 = "Managing Trustee";
          $check3 = "General Council Member";
          $check4 = "Monthly Contributor";
          $check5 = "Other Contributor";


          if (strncasecmp($user_type, $check1, 3) == 0) {
            $type = 9;
          } elseif (strncasecmp($user_type, $check2, 3) == 0) {
            $type = 6;
          } elseif (strncasecmp($user_type, $check3, 3) == 0) {
            $type = 8;
          } elseif (strncasecmp($user_type, $check4, 3) == 0) {
            $type = 7;
          } elseif (strncasecmp($user_type, $check5, 3) == 0) {
            $type = 1;
          }

          if ($type) {

            $insert_array = array(
              'firstName' => $firstName,
              'lastName' => $lastName,
              'email' => $email,
              'password_hash' => $this->hash_passwd('Welcome@123'),
              'mobile' => $mobileNo,
              'active' => 1,
              'auth_level' => $type,
              'created_at' => date('Y-m-d')
            );

           
            if ($check_mail != 0) {
              $update = $this->mcommon->common_edit('users', $insert_array, array('email' => $email,));             
            } elseif ($check_mobile != 0) {
              $update = $this->mcommon->common_edit('users', $insert_array, array('mobile' => $mobileNo,));
            } else {
              $insert = $this->mcommon->common_insert('users', $insert_array);
            }
            // if($check_mail == 0) {
            //   echo $type." ".$check_mail." ".$check_mobile;
            //   echo "<pre>";print_r($insert_array);
            //   die();
            // }          

            if ($insert) {
              $this->load->library('email');
              $config['protocol'] = 'smtp';
              $config['smtp_host'] = 'smtp-relay.sendinblue.com';
              $config['smtp_port'] = '587';
              $config['smtp_timeout'] = '7';
              $config['smtp_user']    = 'kainkaryatrust@gmail.com';
              //$config['smtp_user']    = 'info@alphasoftz.com';
              $config['smtp_pass']    = 'tnP6DjWLmS2xQf7w';
              $config['charset'] = 'utf-8';
              $config['newline'] = "\r\n";
              $config['mailtype'] = 'html';
              $config['validation'] = true;

              $this->email->initialize($config);
              $this->email->from('kainkaryatrust@gmail.com', 'kainkaryatrust');

              $this->email->to($email);
              $this->email->subject('Welcome to kainkarya Trust With Us,');

              $message_mail = 'Dear ' . $firstName . '&nbsp;' . $lastName . '<last Name>,<br><br>
     Warm Greetings from Kainkarya Charitable Trust.<br><br>
     We are happy in welcoming you to the Kainkarya Charitable Trust Family of members who have joined hands in the service for noble causes which include helping the needy/destitute  to perform the last rites of their deceased kith or kin, honorary funeral to unclaimed bodies, help to the poor for their deprived dependents for their food or education or medicines .<br><br>
     We have come with the web portal www.kainkarya.com which showcases the activities of the Kainkarya Charitable Trust and also provides details required to avail the support from the Trust . You can login to this portal with your personal credentials mentioned below and get receipts for your periodical donations.<br><br>
     Login id : Your Mobile number or email id registered with us.<br>
     Password : Welcome@123 <br><br>
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
        $sno++;
      }
      fclose($file);

      if ($insert || $update) {
        $this->session->set_flashdata('alert_success', 'Users  uploaded!');
        redirect('home/register/');
      } else {
        $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
        redirect('home/register/');
      }
    }
  }
  public function register()
  {

    if (isset($_POST['submit'])) {

      $firstName = $this->input->post('firstName');
      $lastName = $this->input->post('lastName');
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $mobile_number = $this->input->post('mobile');
      $user_type = $this->input->post('user_type');
      $pass_confirm = $this->input->post('password1');
      if($user_type !=5){
      $check_mail = $this->mcommon->records_all('users', array('email' => $email,));
      $check_mobile = $this->mcommon->records_all('users', array('mobile' => $mobile_number,));
      if ($check_mail) {
        $this->session->set_flashdata('alert_danger', 'This Mail is already used ');
        redirect('home/register');
      } elseif ($check_mobile) {
        $this->session->set_flashdata('alert_danger', 'This Mobile Number is already used ');
        redirect('home/register');
      } elseif ($password != $pass_confirm) {
        $this->session->set_flashdata('alert_danger', 'Password And Confirm Password should be Same ');
        redirect('home/register');
      } else {
        $insert_array = array(
          'firstName' => $firstName,
          'lastName' => $lastName,
          'email' => $email,
          'password_hash' => $this->hash_passwd($password),
          'mobile' => $mobile_number,
          'active' => 1,
          'auth_level' => $user_type,
          'created_at' => date('Y-m-d')
        );

        $insert = $this->mcommon->common_insert('users', $insert_array);

        if ($insert > '0' &&  $user_type != 5) {
          $this->load->library('email');
          $config['protocol'] = 'smtp';
          $config['smtp_host'] = 'smtp-relay.sendinblue.com';
          $config['smtp_port'] = '587';
          $config['smtp_timeout'] = '7';
          $config['smtp_user']    = 'kainkaryatrust@gmail.com';
          //$config['smtp_user']    = 'info@alphasoftz.com';
          $config['smtp_pass']    = 'tnP6DjWLmS2xQf7w';
          $config['charset'] = 'utf-8';
          $config['newline'] = "\r\n";
          $config['mailtype'] = 'html';
          $config['validation'] = true;

          $this->email->initialize($config);
          $this->email->from('kainkaryatrust@gmail.com', 'kainkaryatrust');

          $this->email->to($email);
          $this->email->subject('Welcome to kainkarya Trust With Us,');

          /*$message_mail='Dear,'.$firstName.'<br> Thank you for your contribution to service for noble causes. You can download the receipt using your credentials into our website www.kainkarya.com - Kainkarya Charitable Trust<br> Your Password:'.$password.'.';*/
          $message_mail = 'Dear ' . $firstName . '&nbsp;' . $lastName . '<last Name>,<br><br>
     Warm Greetings from Kainkarya Charitable Trust.<br><br>
     We are happy in welcoming you to the Kainkarya Charitable Trust Family of members who have joined hands in the service for noble causes which include helping the needy/destitute  to perform the last rites of their deceased kith or kin, honorary funeral to unclaimed bodies, help to the poor for their deprived dependents for their food or education or medicines .<br><br>
     We have come with the web portal www.kainkarya.com which showcases the activities of the Kainkarya Charitable Trust and also provides details required to avail the support from the Trust . You can login to this portal with your personal credentials mentioned below and get receipts for your periodical donations.<br><br>
     Login id : Your Mobile number or email id registered with us.<br>
     Password :' . $password . ' <br><br>
     We request you to change the password to your convenience immediately on your first login.<br><br>
     You may also refer to our Trust the deserving cases whom you may come across for Aid.<br><br>
     In the words of Swamy Vivekananda:<br>
     “That which tends to increase the divinity in you is virtue. The poor, the illiterate, the ignorant, the afflicted…. Let these be your God. Know that services to that alone vis the highest religion.”
     Let’s go forward and do yet greater things…<br>
     With best regards,<br><br><br>Team, KAINKARYA CHARITABLE TRUST.';


          $this->email->message($message_mail);
          $this->email->send();

          $this->session->set_flashdata('alert_success', 'Register successfully!');
          redirect('home/register');
        } else {
          $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
          redirect('home/register');
        }
      }
    }else{
     
      $insert_array1 = array(
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'password_hash' => $this->hash_passwd($password),
        'mobile' => $mobile_number,
        'active' => 1,
        'auth_level' => $user_type,
        'created_at' => date('Y-m-d')
      );

      $insert = $this->mcommon->common_insert('users', $insert_array1);
        // print_r($this->db);
        // exit();
      $this->session->set_flashdata('alert_success', 'Register successfully!');
      redirect('home/register');
    }
    }
    $view_data['users'] = $this->main->get_users();
    $data = array(
      'title' => "User Registration ",
      'content' => $this->load->view('Webpage/register', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }

  public function view_users()
  {

    $view_data['users'] = $this->main->view_users_level();
    $view_data['records'] = $this->main->view_users_level_active();

    $data = array(
      'title' => " Users Profiles",
      'content' => $this->load->view('Webpage/user_list', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }
  public function delete_user(){
    $id=$this->input->post('id');
    $result=$this->mcommon->common_edit('users',array('active'=>0),array('id'=>$id));
     $this->session->set_flashdata('alert_success', 'Deleted successfully!');
    echo "Deleted";

  }
  public function edit_user($id)
  {

    if (isset($_POST['submit'])) {

      $user_type = $this->input->post('user_type');
      $firstName = $this->input->post('firstName');
      $lastName = $this->input->post('lastName');
      $email = $this->input->post('email');
      $mobile = $this->input->post('mobile');
      $pan = $this->input->post('pan');
      $dob = $this->input->post('dob');
      $address = $this->input->post('address');
      $about_me = $this->input->post('about_me');
      $user_id = $this->input->post('user_id');
       $created_at = $this->input->post('created_at');


      $update_data = array(
        'auth_level' => $user_type,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'mobile' => $mobile,
        'dob' => $dob,
        'pan' => $pan,
        'about_me' => $about_me,
        'address' => $address,
         'created_at'=>date('Y-m-d',strtotime($created_at)),
        'updated_at' => date('Y-m-d'),
      );

      $update = $this->mcommon->common_edit('users', $update_data, array('id' => $user_id,));

      if ($update > '0') {
        $this->session->set_flashdata('alert_success', 'Update User Details!');

        redirect('home/view_users');
      } else {
        $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
        redirect('home/view_users');
      }
    }
    $view_data['users_details'] = $this->mcommon->records_all('users', array('id' => $id,));

    $data = array(
      'title' => "Edit User Details",
      'content' => $this->load->view('Webpage/edit_users', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }
  public function financial_year()
  {

    if (isset($_POST['submit'])) {

      $year = $this->input->post('year');
      $pre_number = $this->input->post('pre_number');
      $status = $this->input->post('status');

      $insert_array = array(
        'pre_number' => $pre_number,
        'year' => $year,
        'status' => $status,
        'created_date' => date('Y-m-d h-i-s')
      );
      $insert = $this->mcommon->common_insert('financial_year', $insert_array);

      if($this->input->post('status') == 1)
      {
        $this->mcommon->common_edit('financial_year', array('status' => 0), array('id !=' => $insert));
      }

      if ($insert > '0') {
        $this->session->set_flashdata('alert_success', 'Financial year Add successfully!');
        redirect('home/financial_year');
      } else {
        $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
        redirect('home/financial_year');
      }
    }

    $view_data['year'] = $this->main->get_financial_year1();
    $data = array(
      'title' => "Financial Year",
      'content' => $this->load->view('Webpage/financial_year', $view_data, TRUE),
    );
    $this->load->view('base/base_template', $data);
  }

  public function changeStatus(){
    $id=$this->input->post('id');
 //   $id=$this->input->post('status');
 
    if($this->input->post('status') == 1)
    {
      $this->mcommon->common_edit('financial_year', array('status' => 0), array('id !=' => $id));
     
     
    }else{
      $this->mcommon->common_edit('financial_year', array('status' => 1), array('id =' => $id));
      $this->mcommon->common_edit('financial_year', array('status' => 0), array('id !=' => $id));
      $year =$this->mcommon->specific_row_value('financial_year', array('id' => $id), 'year');
      $this->mcommon->common_edit('company_setting',array('current_financial_year' => $year), array('id' => 1));
    }
   

  
  }

  public function PrintMyReceipts($donation_id)
  {

    $view_data['setting'] = $this->mcommon->records_all('company_setting');
    $view_data['receipt_data'] = $this->main->get_donation_details($donation_id);
    //echo "<pre>";print_r($view_data['setting']);exit();
    $this->load->view('Webpage/print-receipt.php', $view_data);
  }
  public function UserRegister()
  {
    if (isset($_POST['submit'])) {

      $firstName = $this->input->post('firstName');
      $lastName = $this->input->post('lastName');
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $mobile_number = $this->input->post('mobile_number');
      //Set validation Rules
      // $this->form_validation->set_rules('firstName', 'First NAME', 'required');
      // $this->form_validation->set_rules('lasttName', 'Last Name', 'required');
      // $this->form_validation->set_rules('email', 'Email', 'required');
      // $this->form_validation->set_rules('password_hash', 'Password', 'required');
      // $this->form_validation->set_rules('password_hash', 'Password', 'required');

      //check is the validation returns no error
      //if ($this->form_validation->run() == true) {
      //prepare insert array
      
       $check_mail = $this->mcommon->records_all('users', array('email' => $email,));
      $check_mobile = $this->mcommon->records_all('users', array('mobile' => $mobile_number,));
      if ($check_mail) {
        $this->session->set_flashdata('alert_danger', 'This Mail is already used ');
        redirect('home/register');
      } elseif ($check_mobile) {
        $this->session->set_flashdata('alert_danger', 'This Mobile Number is already used ');
        redirect('home/register');
      }else{
          $insert_array = array(
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'password_hash' => $this->hash_passwd($password),
        'mobile' => $mobile_number,
        'active' => 1,
        'created_at' => date('Y-m-d')
      );
      //insert values in database
      $insert = $this->mcommon->common_insert('users', $insert_array);

      }
      
      
      
      if ($insert > '0') {
        $this->session->set_flashdata('alert_success', 'Register successfully!');
        $this->load->view('Webpage/user-login.php');
      } else {
        $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
      }
    } else {
      $this->load->view('Webpage/user-register.php');
    }
    //}

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

  public function UserLogout()
  {
    if ($this->session->userdata('user_id')) {
      session_destroy();
    }

    redirect('login');
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
  public function user_status($id)
  {

    $get_status = $this->mcommon->specific_row_value('users', array('id' => $id,), 'active');

    if ($get_status == 1) {
      $status = 0;
    } else {
      $status = 1;
    }
    $result = $this->mcommon->common_edit('users', array('active' => $status,), array('id' => $id,));
    if ($result) {
      $this->session->set_flashdata('alert_success', 'Updated  users status!');

      redirect('home/view_users');
    } else {
      $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
      redirect('home/view_users');
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

      $update_data = array(
        'firstName' => $firstName,
        'lastName' => $lastName,
        'pan' => $pan,
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
  public function sendsms($phone, $msg, $name1, $sms_type)
  {
    $mobile = $phone;
    $message = urlencode($msg);

    if ($sms_type == 1) {
      $url = "http://reseller.alphasoftz.info/api/sendsms.php?user=kainkarya&apikey=TzaeBRxqJfWU6EhpdrUK&mobile=$mobile&message=$message&senderid=KKARYA&type=txt&tid=1507163550577157789";
    } elseif ($sms_type == 2) {
      $url = "http://reseller.alphasoftz.info/api/sendsms.php?user=kainkarya&apikey=TzaeBRxqJfWU6EhpdrUK&mobile=$mobile&message=$message&senderid=KKARYA&type=txt&tid=1507163550596602305";
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $curl_scraped_page = curl_exec($ch);
    curl_close($ch);
    $result = explode(' ', $curl_scraped_page);
    return $result;
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
    $pdfFilePath =  $_SERVER['DOCUMENT_ROOT'] . '/admin/public/pdf/' . $receipt_number . '.pdf';    
    if(file_exists($pdfFilePath)){
      unlink($pdfFilePath);
      //$m_pdf=new M_pdf();
    }
    //load mPDF library
    $this->load->library('m_pdf');
    //generate the PDF from the given html
    $this->m_pdf->pdf->WriteHTML($html);
    ob_clean();
    $this->m_pdf->pdf->Output($pdfFilePath, 'F');
    return $receipt_number;
  }
  
   public function changeUserStatus()
    {
        $id = $this->input->post('id');     

        if($this->input->post('status') == 1) {
            $this->mcommon->common_edit('users', array('active' => 0), array('id' => $id));
        } else {
          $this->mcommon->common_edit('users', array('active' => 1), array('id' => $id));
        }
    }
  
  
}
