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
   $this->db->join("video_album as va","va.v_id=v.v_id");
   if ($id) {
      $this->db->where("v.id",$id);
   }
  
   $result = $this->db->get()->result();
   return $result;
 }
  public function get_video_album($id)
  {

   $this->db->select("*");
   $this->db->from("video_album ");
  
   if ($id) {
      $this->db->where("v_id",$id);
   }
  
   $result = $this->db->get()->result();
   return $result;
 }
 public function get_gallery_album($id)
  {

   $this->db->select("*");
   $this->db->from("gallery_album as g");
   if ($id) {
      $this->db->where("g.g_id",$id);
   }
  
   $result = $this->db->get()->result();
   return $result;
 }

  public function get_gallery($id)
  {

   $this->db->select("*,g.caption as caption,ga.caption as ga_caption,g.image as image,g.g_id");
   $this->db->from("gallery as g");
   $this->db->join("gallery_album as ga","ga.g_id=g.g_id");
   if ($id) {
      $this->db->where("g.id",$id);
   }
  
   $result = $this->db->get()->result();
   return $result;
 }
 public function get_slider($id)
  {

   $this->db->select("*");
   $this->db->from("slider");
  
   if ($id) {
      $this->db->where("id",$id);
   }
   $this->db->order_by('id',"desc");
   $result = $this->db->get()->result();
   return $result;
 }
  public function donation_register_data($year)
  {
 
   $this->db->select("CONCAT(u.firstName,' ',u.lastName) as name,d.receipt_month as month,d.amount,u.id as user_id");
   $this->db->from("donation as d");
   $this->db->join("users as u","u.id=d.user_id");
  /* $this->db->where("u.id",$user_id);*/
   $this->db->where("d.financial_year",$year);
    $this->db->order_by('u.firstName',"asc");
  /* $this->db->where("d.donateMonthly",1);*/
   $query1 = $this->db->get()->result_array();

$response=array();
    foreach($query1 as $q){



    $response[$q['name']][] = $q;
}
   return $response;
 }

 public function get_donation_month($year)
 {
   $this->db->select("*");
   $this->db->from("donation");
   $this->db->where("financial_year", $year);
   $this->db->order_by('donation_id',"desc");
   $query = $this->db->get()->result();

   foreach($query as $o){
     $response[$o->receipt_month][] = $o;
   }
   return $response;
 }

  public function get_aid_file()
 {
   $this->db->select("*");
   $this->db->from("aid_file");
    
   $this->db->order_by('id',"desc");
   $query = $this->db->get()->result();
   return $query;
 }
 public function get_financial_year()
 {
   $this->db->select("*");
   $this->db->from("financial_year");
    
   $this->db->order_by('id',"desc");
   $query = $this->db->get()->result_array();
   return $query;
 }
 public function view_users()
 {
   $this->db->select("*");
   $this->db->from("users");
   $this->db->where("auth_level!=", 10);
   $this->db->order_by('id',"desc");
   $query = $this->db->get()->result_array();
   return $query;
 }

  public function view_users_level()
 {
   $this->db->select("*");
   $this->db->from("users");
   $this->db->where("auth_level!=", 10);
   $this->db->order_by('auth_level',"desc");
   $query = $this->db->get()->result_array();
   return $query;
 }


 public function view_users_dropdown()
 {
    $this->db->select("*");
   $this->db->from("users");
   $this->db->where("auth_level!=", 10);
   $this->db->order_by('firstName',"asc");
   $query = $this->db->get()->result_array();
   return $query;
 }
  


 public function get_users()
 {
   $this->db->select("*");
   $this->db->from("users");
   $this->db->where("auth_level!=", 10);
   $this->db->order_by('id',"desc");
   $query = $this->db->get()->result();
   return $query;
 }







 public function get_donation($year='',$receipt_month='')
 {
   $this->db->select("*");  
   $this->db->from("donation");
   if(!empty($year)){
     $this->db->where("financial_year", $year);
   }
   if(!empty($receipt_month)){
    $this->db->where("receipt_month", $receipt_month);
   }
      // $this->db->where("user_id", $user_id);
   $this->db->order_by('receipt_number',"ASC");
   $query = $this->db->get()->result_array();
   return $query;
 }
 public function get_online_donation($year='',$receipt_month='')
 {
   $this->db->select("*");
   $this->db->from("online_donation");
   if(!empty($year)){
     $this->db->where("financial_year", $year);
   }
   if(!empty($receipt_month)){
    $this->db->where("receipt_month", $receipt_month);
   }
      // $this->db->where("user_id", $user_id);
   $this->db->order_by('od_id',"DESC");
   $this->db->where('status<>',"0");

   $query = $this->db->get()->result();
   return $query;
 }

 public function get_donation_details($donation_id)
 {
    $this->db->select("*,d.panNumber as pan,u.pan as pan1,d.address as address,u.address as address1,d.firstName,d.lastName,d.email");
$this->db->from("donation as d");
$this->db->join('users as u',"u.id=d.user_id","left");
$this->db->where("donation_id", $donation_id);

$query = $this->db->get()->result_array();
return $query;
 }
}