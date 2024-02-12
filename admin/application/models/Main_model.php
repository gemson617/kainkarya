<?php if (!defined('BASEPATH')) {
  exit('No direct script access allowed');
}

class Main_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function get_video($id)
  {

    $this->db->select("*,v.caption as caption,va.caption as va_caption,v.video as video,v.v_id,v.id");
    $this->db->from("video as v");
    $this->db->join("video_album as va", "va.v_id=v.v_id");
    if ($id) {
      $this->db->where("v.id", $id);
    }
    $this->db->order_by('v.id','DESC');   
    

    $result = $this->db->get()->result();
    return $result;
  }
  public function get_video_album($id)
  {

    $this->db->select("*");
    $this->db->from("video_album ");

    if ($id) {
      $this->db->where("v_id", $id);
    }

    $result = $this->db->get()->result();
    return $result;
  }
  public function get_gallery_album($id)
  {

    $this->db->select("*");
    $this->db->from("gallery_album as g");
    if ($id) {
      $this->db->where("g.g_id", $id);
    }

    $result = $this->db->get()->result();
    return $result;
  }

  public function get_gallery($id)
  {

    $this->db->select("*,g.caption as caption,ga.caption as ga_caption,g.image as image,g.g_id");
    $this->db->from("gallery as g");
    $this->db->join("gallery_album as ga", "ga.g_id=g.g_id");
    if ($id) {
      $this->db->where("g.id", $id);
    }
    $this->db->order_by('g.id','DESC');   

    $result = $this->db->get()->result();
    return $result;
  }
  public function get_slider($id)
  {

    $this->db->select("*");
    $this->db->from("slider");

    if ($id) {
      $this->db->where("id", $id);
    }
    $this->db->order_by('sort_order', "ASC");
    
    $result = $this->db->get()->result();  
    return $result;
  }
  public function donation_register_data($year)
  {

    $this->db->select("CONCAT(u.firstName,' ',u.lastName) as name,d.receipt_month as month,d.amount,u.id as user_id,d.corpusFund");
    $this->db->from("donation as d");
    $this->db->join("users as u", "u.id=d.user_id");
    $this->db->where("d.corpusFund",1);
    $this->db->where("d.financial_year", $year);
    $this->db->order_by('user_id', "asc");
    /* $this->db->where("d.donateMonthly",1);*/
    $query1 = $this->db->get()->result_array();

    $response = array();
    foreach ($query1 as $q) {



      $response[$q['name']][] = $q;
    }
    return $response;
  }

  
 public function get_overall_amount(){

  $yr=$this->mcommon->specific_row_value('company_setting',array('id'=>1),'current_financial_year');
  $yr_id=$this->mcommon->specific_row_value('financial_year',array('year'=>$yr),'id');

  $sql="select year from financial_year WHERE  year !='$yr' ";

  $years=$this->db->query($sql)->result_array();
  $in_years=[];
  foreach($years as $row){   
    $in_years[]="'".$row['year']."'";   
    }
  $in_yr=implode(",",$in_years);
  
  // $this->db->select("count(amount) as total,GROUP_CONCAT(DISTINCT(`corpusFund`)) as corpusFund,financial_year,sum(amount) as Amount");
  // $this->db->from("donation");
  // $this->db->where_in('financial_year',$in_yr);
  // $this->db->group_by('corpusFund');
  // $sql1="SELECT count(amount) as total, GROUP_CONCAT(DISTINCT(`corpusFund`)) as corpusFund, `financial_year`, sum(amount) as Amount
  // FROM `donation`
  // WHERE `financial_year` IN($in_yr)
  // GROUP BY `corpusFund`,`financial_year`";

  $qry="SELECT COUNT(CASE WHEN corpusFund=1 THEN corpusFund END) as general_cont,
  COUNT(CASE WHEN corpusFund=2 THEN corpusFund END) as corpus_cont,
  COUNT(CASE WHEN corpusFund=3 THEN corpusFund END) as onetime_cont,
  SUM(CASE WHEN corpusFund=1 THEN amount END) as General,SUM(CASE WHEN corpusFund=2 THEN amount END) as Corpus,SUM(CASE WHEN corpusFund=3 THEN amount END) as Onetime, `financial_year`
    FROM `donation` 
    WHERE `financial_year` IN($in_yr)
    GROUP BY `financial_year`";  
    

  $result=$this->db->query($qry)->result();
 // $result=$this->db->get()->result(); 
  //$result['yr']=$in_years;
  // echo "<pre>";print_r($result);
  // die();
  return $result; 
 }

 public function get_current_year_amount(){
  $this->db->select("receipt_month,SUM(amount) as Amount,count(amount) as Number,corpusFund");
  $this->db->from("donation");
  $this->db->where('financial_year','2022-2023');
  $this->db->group_by('corpusFund,receipt_month');
  $result=$this->db->get()->result();
  foreach ($result as $o) {
    $response[$o->receipt_month][] = $o;
  }
  // echo "<pre>";print_r($response);
  // exit();
  return $response;
  //return $result; 
 }

  public function get_donation_month($year)
  {
    $this->db->select("*");
    $this->db->from("donation");
    $this->db->where("financial_year", $year);
   // $this->db->order_by('donation_id', "desc");
    $query = $this->db->get()->result();

    foreach ($query as $o) {
      $response[$o->receipt_month][] = $o;
    }
    
    return $response;
  }

  public function get_aid_file()
  {
    $this->db->select("*");
    $this->db->from("aid_file");

    $this->db->order_by('id', "desc");
    $query = $this->db->get()->result();
    return $query;
  }
  public function get_financial_year()
  {
    $this->db->select("*");
    $this->db->from("financial_year");
    $this->db->where("status",1);
    $this->db->order_by('id', "desc");
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function get_financial_year1()
  {
    $this->db->select("*");
    $this->db->from("financial_year");
   // $this->db->where("status",1);
    $this->db->order_by('id', "desc");
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function view_users()
  {
    $this->db->select("*");
    $this->db->from("users");
    $this->db->where("auth_level!=", 10);
    $this->db->order_by('id', "desc");
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function view_users_level()
  {
    $this->db->select("*");
    $this->db->from("users");
    $this->db->where("auth_level!=", 10);
    //$this->db->where("active", 1);
   // $this->db->where('pan!=','');
    $this->db->order_by('id', "desc");
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function view_users_level_active()
  {
    $this->db->select("*");
    $this->db->from("users");
    $this->db->where("auth_level!=", 10);
    $this->db->where("active", 1);
    $this->db->where('auth_level!=',5);
    $this->db->order_by('id', "desc");
    $query = $this->db->get()->result_array();
    return $query;
  }


  public function view_users_dropdown()
  {
    $this->db->select("*");
    $this->db->from("users");
    $this->db->where("auth_level!=", 10);
    $this->db->order_by('firstName', "asc");
    $query = $this->db->get()->result_array();
    return $query;
  }



  public function get_users()
  {
    $this->db->select("*");
    $this->db->from("users");
    $this->db->where("auth_level!=", 10);
    $this->db->order_by('id', "desc");
    $query = $this->db->get()->result();
    return $query;
  }


  public function get_user_type(){
    $this->db->select("*");
    $this->db->from("user_type");
    $query = $this->db->get()->result();
    return $query;

  }

   public function get_type($id){
    $this->db->select("user_type");
    $this->db->from("polling_user");
    $this->db->where('question_id',$id);
    $query = $this->db->get()->result();
    return $query;

  }




  public function get_donation($year = '', $receipt_month = '',$types='')
  {
    $this->db->select("*");
    $this->db->from("donation");
    if (!empty($year)) {
      $this->db->where("financial_year", $year);
    }
    if (!empty($receipt_month)) {
     // $this->db->where("receipt_month", $receipt_month);
      $this->db->where("MONTH(receipt_date)", $receipt_month);
    //  MONTH(receipt_date)
    }    
     if(!empty($types)) {
        if($types == '4')
        {
          $this->db->where("status",'0');
        }
        else{
          $this->db->where("corpusFund", $types); 
          $this->db->where("status", 1);         
        }      
     }
     if(empty($types)){
      $this->db->where("status", 1);
     }
    // $this->db->where("user_id", $user_id);
    $this->db->order_by('receipt_number', "ASC");
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function get_online_donation($year = '', $receipt_month = '')
  {
    $this->db->select("*");
    $this->db->from("online_donation");
    if (!empty($year)) {
      $this->db->where("financial_year", $year);
    }
    if (!empty($receipt_month)) {
      $this->db->where("receipt_month", $receipt_month);
    }
    // $this->db->where("user_id", $user_id);
    $this->db->order_by('od_id', "DESC");
    $this->db->where('status<>', "0");

    $query = $this->db->get()->result();
    return $query;
  }

  public function get_donation_details($donation_id)
  {
    $this->db->select("*,d.Fullname,d.panNumber as pan,u.pan as pan1,d.address as address,u.address as address1,d.firstName,d.lastName,d.email,d.financial_year");
    $this->db->from("donation as d");
    $this->db->join('users as u', "u.id=d.user_id", "left");
    $this->db->where("donation_id", $donation_id);

    $query = $this->db->get()->result_array();
    return $query;
  }

  public function get_donation_details1($donation_id)
  {
    $this->db->select("*,d.Fullname,d.panNumber as pan,u.pan as pan1,d.address as address,u.address as address1,d.firstName,d.lastName,d.email,d.financial_year");
    $this->db->from("donation as d");
    $this->db->join('users as u', "u.id=d.user_id", "left");
    $this->db->where("receipt_number", $donation_id);

    $query = $this->db->get()->result_array();
    return $query;
  }

  public function get_polling_list($year='')
  {
    $this->db->select("*");
    $this->db->from("polling_questions as pq");
    $this->db->order_by('id','DESC');
    if(!empty($year)){
      $this->db->where('pq.financial_year',$year);
    }
    $query = $this->db->get();
    $result = $query->result();

    // $userid = array();
    $output = array();
    foreach ($result as &$res) {
      $this->db->select("u.type_name");
      $this->db->from("polling_user as pa");
      $this->db->join("user_type as u", "u.type_id=pa.user_type");
      $this->db->where("pa.question_id", $res->id);
      
      $query = $this->db->get();
      $user_type = $query->result();
      // foreach($user_type as $urow)
      // {
      // $userid[]=$urow->type_name;
      // }
      $output[] = array(
        'id' => $res->id,
        'question' => $res->question,
        'status' => $res->status,
        'created_date' => $res->created_date,
        'user_type' => $user_type,
        'financial_year'=>$res->financial_year,
      );
    }


    return $output;
  }

  public function default_question_answer($id)
  {
    $this->db->select("*");
    $this->db->from("polling_questions as pq");
    $this->db->join("polling_answer as pa", "pa.question_id=pq.id");
    $this->db->where("pq.id", $id);
    $query = $this->db->get();
    return $query->result();
  }

   public function default_question_answer_excel($id)
  {
    //,pu.user_type ,u.mobile,CONCAT(u.firstName,' ',u.lastName) as name
    $this->db->select("u.mobile,CONCAT(u.firstName,' ',u.lastName) as name,pa.answer,pq.question,ut.type_name as user_type,pr.reason");
    $this->db->from("polling_questions as pq");
    $this->db->join("poll_result as pr", "pr.question_id=pq.id","left");
    $this->db->join("polling_answer as pa", "pa.a_id=pr.answer_id","left");    
    $this->db->join("users as u", "u.id=pr.user_id");
    $this->db->join("user_type as ut", "ut.type_id=u.auth_level  ");
  
    $this->db->where("pq.id", $id);
   // $this->db->group_by('pa.answer','pq.question');
    $query = $this->db->get();
   
    return $query->result();
  }

  public function get_polling_by_usertypeold($user_auth_level = "")
  {
    $this->db->select("*");
    $this->db->from("polling_questions as pq");
    $this->db->join("polling_user as pu", "pu.question_id=pq.id");
    if ($user_auth_level != "") {
      $this->db->where("pu.user_type", $user_auth_level);
    }

    //  $this->db->where("pq.id", $polling_id);
    $this->db->group_by('pq.id', "ASC");
    $query = $this->db->get()->result_array();
    //  $result = $query->result();
    //  $output = array();
    //  foreach ($result as $res) {
    //      $this->db->select("*");
    //      $this->db->from("polling_answer as pa");
    //      $this->db->where("pa.question_id", $res->id);
    //      $query = $this->db->get();
    //      $answer = $query->result();

    //      $output[] = array(
    //          'id' => $res->id,
    //          'question' => $res->question,
    //          'user_type' => $res->user_type,
    //          'status' => $res->status,
    //          'created_date' => $res->created_date,
    //          'answer'=>$answer
    //      );
    //  }
    return $query;
  }
  public function get_polling_by_usertype($user_type = "")
  {
    $this->db->select("*");
    $this->db->from("poll_result as pr");
    $this->db->join("polling_answer as pa", "pa.a_id=pr.answer_id");
    $this->db->join("polling_questions as pq", "pq.id=pr.question_id");
    $this->db->join("users as u", "u.id=pr.user_id");
    $this->db->join("user_type as ut", "ut.type_id=u.auth_level");
    if ($user_type != "") {
      $this->db->where("pr.user_id", $user_type);
    }

    $query = $this->db->get()->result_array();

    return $query;
  }
  public function get_donation2($year = '', $receipt_month = '')
  {
    $this->db->select("*");
    $this->db->from("donation");
    if (!empty($year)) {
      $this->db->where("financial_year", $year);
    }
    if (!empty($receipt_month)) {
      $this->db->where("receipt_month", $receipt_month);
    }
    // $this->db->where("user_id", $user_id);
    $this->db->order_by('receipt_number', "ASC");
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function get_summary_report($question)
  {
    $this->db->select("*");
    $this->db->from("polling_questions as pq");
    $this->db->where("pq.id",$question);
    $query = $this->db->get();
    $result = $query->result();
    $output = array();
    $output1=array();
    foreach ($result as &$res) {
      $this->db->select("*");
      $this->db->from("polling_answer as pa");
      $this->db->where("pa.question_id", $res->id);
      $query1 = $this->db->get();
      $option_type = $query1->result();
      $opt=$query1->row();
      $opta=$opt->answer;
      //  $opt_count = $option_type;
      foreach ($option_type as &$op) {
        $this->db->select("*");
        $this->db->from("poll_result as pr");
        $this->db->where("pr.question_id", $res->id);
        $this->db->where("pr.answer_id", $op->a_id);
        $query = $this->db->get();
        $option = $query->result();

        $output1[]=array(
          // 'result' => $result,
          'a_id' => $op->a_id,
          'question_id' => $op->question_id,
          'answer' => $op->answer,
          'status' => $op->status,
          'created_date' => $op->created_date,
          'Question'=>$res->id,
          'Answer'=>$op->a_id,
          'Count'=>count($option),

        );
        $output[]=array(
          $summary = $output1,
          $qa_summ = $result
        );


      }
    }

    return $output1;
  }


}
