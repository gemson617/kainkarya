<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Main_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
      public function get_slider()
    {
       $this->db->select("*");
       $this->db->from("slider");
       $this->db->order_by('sort_order',"ASC");
       $query = $this->db->get()->result();
       return $query;
    }
     public function get_financial_year()
    {
       $this->db->select("*");
       $this->db->from("financial_year");
       $this->db->order_by('id',"desc");
       $query = $this->db->get()->result();
       return $query;
    }
     public function donation_report($year)
    {
       $this->db->select("*");
       $this->db->from("donation");
       $this->db->where("user_id", $this->session->userdata('user_id'));
       $this->db->where("financial_year", $year);
       $this->db->order_by('donation_id',"desc");
       $query = $this->db->get()->result();
       return $query;
    }
     public function donation_report1($year)
    {
       $this->db->select("*");
       $this->db->from("donation");
       $this->db->where("user_id", $this->session->userdata('user_id'));
       $this->db->where("financial_year", $year);
       // $this->db->order_by('donation_id',"desc");
       $query = $this->db->get()->result();
       return $query;
    }
  public function check_users($username)
     {
       $this->db->select("*");
       $this->db->from("users");
       $this->db->where("email", $username);
       $this->db->or_where("mobile", $username);
      
       $query = $this->db->get()->result();
       return $query;
    }
   public function get_user_deatis()
     {
       
       $this->db->select("*");
       $this->db->from("users");
       $this->db->where("id!=", $this->session->userdata('user_id'));
       $this->db->order_by("firstName", "asc");

       $query = $this->db->get()->result();
       return $query;
       /* $this->db->select("*");
       $this->db->from("users");
       $this->db->where("id!=", $this->session->userdata('user_id'));
       $query = $this->db->get()->result();
       return $query;*/
    }

   public function get_donation($user_id,$fin_year)
    {
       $this->db->select("*");
       $this->db->from("donation");
       $this->db->where("user_id", $user_id);
        $this->db->where("financial_year", $fin_year);
       $this->db->order_by('donation_id',"desc");
       $query = $this->db->get()->result();
       return $query;
    }
    public function get_donation_details($donation_id)
    {
       $this->db->select("*,d.panNumber as pan,u.pan as pan1,d.address as address1,u.address as address1");
   $this->db->from("donation as d");
   $this->db->join('users as u',"u.id=d.user_id","left");
   $this->db->where("donation_id", $donation_id);

   $query = $this->db->get()->result_array();
   return $query;
    }

    public function get_dashboard()
    {

       //  $startDate = date('y-m-d',strtotime("-30 days"), "\n";);
       //  $endDate   = date('y-m-d',strtotime("now"), "\n";);

       //  $this->db->select("*");
       //  $this->db->from("users");
       //  $query = $this->db->get();
       //  $user_count =  $query->num_rows();

       //  $this->db->select("*");
       //  $this->db->from("m_news");
       //   $query = $this->db->get();
       //   $news_count =  $query->num_rows();

       //  $this->db->select("*");
       //  $this->db->from("m_news_comments");
       //  $query = $this->db->get();
       //  $command_count =  $query->num_rows();

       //  $this->db->select("*");
       //  $this->db->from("m_hashtag");
       //  $query = $this->db->get();
       //  $hashtag_count =  $query->num_rows();

       //  $this->db->select("*");
       //  $this->db->from("users");
       //   $this->db->where("created_at >="DATEADD(MONTH, -3, GETDATE()));
       //  $query = $this->db->get();
       //   $month_user_count =  $query->num_rows();
       //   print_r($month_user_count);exit('a');
       //  WHERE Date_Column >= DATEADD(MONTH, -3, GETDATE()) 


       // $final = array(
       //     'user_count' => $user_count,
       //     'news_count' => $news_count,
       //     'command_count'=> $command_count,
       //     'hashtag_count' => $hashtag_count,

       //  );

       //  return $final;

    }

    //public function update_device_id($user_id, $device_id)
    //{
       // $update_array = array(
      //      'device_id' => $device_id,
      //  );
      //  $this->db->where("user_id", $user_id);
      //  $this->db->update("users", $update_array);
      //  return $this->db->affected_rows();
    //}

}