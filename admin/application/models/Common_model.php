<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [record_counts description]
     * @param  [type] $user_id [users id]
     * @return [INT]   user's id [description]
     * @author Ganesh Ananthan
     */

    public function record_counts($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    public function specific_record_counts($table, $constraint_array)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($constraint_array);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    public function sum_rows($table, $constraint_array)
    {
        $this->db->select('sum(amount) as amount');
        $this->db->from($table);
        $this->db->where($constraint_array);
        $sum_result = $this->db->get()->row_array();
        return $sum_result;
    }

    public function specific_record_counts_other($table, $constraint_array)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($constraint_array);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    public function get_sum_amount($table, $month,$type,$constraint_array)
    {
        $this->db->select("SUM(case when MONTH(receipt_date) ='$month' AND corpusFund='$type' then amount end) as amount");
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        $this->db->where('MONTH(receipt_date)',$month);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_count_month($table, $month,$type,$constraint_array)
    {
        $this->db->select("COUNT(case when MONTH(receipt_date) ='$month' AND corpusFund='$type' then corpusFund end) as cont");
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
       // $this->db->where('MONTH(receipt_date)',$month);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_count_month_general($table, $month,$type,$constraint_array)
    {
        $this->db->select("COUNT(case when MONTH(receipt_date) ='$month' AND corpusFund='$type' then corpusFund end) as cont");
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
       // $this->db->where('MONTH(receipt_date)',$month);
        $result = $this->db->get()->row_array();
        return $result;
    }
    public function get_sum_amount_general($table, $month,$type,$constraint_array)
    {
        $this->db->select("SUM(case when MONTH(receipt_date) ='$month' AND corpusFund='$type' then amount end) as amount");
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        $this->db->where('MONTH(receipt_date)',$month);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function specific_row($table, $constraint_array = '')
    {
        $this->db->select('*');
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function specific_row_value($table, $constraint_array = '', $get_field)
    {
        $this->db->select($get_field);
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        $result = $this->db->get()->row_array();
        return $result[$get_field];
    }


    public function get_specific_like($table,$date){
        $this->db->select('u.id,af.file_name,af.year,af.status,af.created_date, CONCAT(u.firstName, " ", u.lastName) as name');
        $this->db->from('users as u');
        $this->db->join('aid_file_pdf as af', 'af.userid = u.id', 'left'); 
        $this->db->like('af.created_date', $date, 'both'); 
        $this->db->order_by('u.firstName','asc'); 
         $results = $this->db->get()->result();
        return $results;     
        
    }



 



    public function get_records($table,$field1,$field2){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('firstName',$field1);
         $this->db->where('lastName',$field2);
        //$this->db->like('firstName', $field1, 'both'); 
        //$this->db->like('lastName', $field2, 'both');
        return $result = $this->db->get()->row_array();
    }

 public function get_email($table,$field1){

      //$data=$this->db->query("select id,email,CONCAT(firstName,' ',lastName) as name from users ")->result_array();
 $data=$this->db->query("select id,email,firstName,lastName from users where CONCAT(firstName,' ',lastName)='$field1'")->result_array()[0];
 return $data;
      // foreach($data as $row){
      //   if($row['name']==$field1){
      //       echo $row['email'];
      //   }
      // }
       
     }
    

       public function get_records_more($table,$field1,$field2,$field3){

        $firstname=$field1." ".$field2;
        $lastname=$field2." ".$field3;

       return $this->db->query("select * from users where firstName='$field1' OR firstName='$firstname' AND lastName='$field2' OR lastName='$lastname' ")->row_array();
        
    }


     public function get_records_more_name($table,$field1,$field2,$field3){

        $fname=$field1." ".$field2;
        $fname=$field2." ".$field3;

       return $this->db->query("select * from users where firstName='$field1' OR firstName='$fname' AND lastName='$fname' OR lastName='$field3'")->row_array();
        // $this->db->select('*');
        // $this->db->from($table);
        // $this->db->where('firstName',$field1);
        // $this->db->or_where('firstName',$field2." ".$field3);
        // $this->db->or_where('lastName',$field2." ".$field3);
        // $this->db->like('firstName', $field1, 'both'); 
        // // $this->db->or_like('firstName', $field2, 'after');
        // // $this->db->like('lastName', $field2." ".$field3, 'both');
        // //$this->db->or_like('lastName', $field3, 'after');
        
       // return $result = $this->db->get()->row_array();
    }

    public function records_all($table, $constraint_array = '', $order_by = '')
    {
        $this->db->select('*');
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        if (!empty($order_by)) {
            $this->db->order_by($order_by);           
        }
        $results = $this->db->get()->result();
        return $results;
    }

    public function exportCSV($table, $constraint_array = '')
    {
        $this->db->select('*');
        $this->db->from($table);
        // if (!empty($constraint_array)) {
        //     $this->db->where($constraint_array);
        // }
        $this->db->where('active', '1');
        $this->db->where_not_in('id', array(786,787,788,789));
        $this->db->where_in('auth_level', array(8,1,7,9,6));
        if (!empty($order_by)) {
            $this->db->order_by($order_by);           
        }

        $results = $this->db->get()->result();
        return $results;
    }

    public function records_all1($table,  $order_by = '')
    {
        $this->db->select('*');
        $this->db->from($table);       
        $this->db->order_by($order_by,'DESC');           
       $results = $this->db->get()->result();
        return $results;
    }

    public function records_all_rows($table,$constraint_array='')
    {
        $this->db->select('*');
        $this->db->from($table);
        if(!empty($constraint_array))
        {
            $this->db->where($constraint_array);    
        }
        $results= $this->db->get()->row_array();
        return $results;
    }

    public function specific_fields_records_all($table, $constraint_array = '', $get_field_array = '')
    {
        if (!empty($get_field_array)) {
            $this->db->select($get_field_array);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function common_insert($table, $data)
    {
        $this->db->insert($table, $data);
        $result = $this->db->insert_id();
        return $result;
    }

    public function common_edit($table, $data, $where_array)
    {
        $this->db->trans_start();
        $this->db->update($table, $data, $where_array);
        $this->db->trans_complete();
        if ($this->db->affected_rows() == '1') {
            return true;
        } else {
            if ($this->db->trans_status() === false) {
                return false;
            }
            return true;
        }
    }

    public function common_delete($table, $where_array)
    {
       
        $this->db->delete($table, $where_array);
        
        if ($this->db->affected_rows() == '1') {
            return true;
        } else {
            return false;
        }
    }

    public function in_array_rec($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_rec($needle, $item, $strict))) {
                return true;
            }
        }
        return 0;
    }

    public function last_record($table, $pm_key, $date_column)
    {
        $query = $this->db->query("SELECT * FROM $table ORDER BY $pm_key DESC LIMIT 1");
        $result = $query->result_array();
        return $result;
    }

    public function common_table_last_updated($table, $pm_key, $date_column)
    {
        $this->db->select($date_column);
        $this->db->from($table);
        $this->db->order_by($pm_key, 'desc');
        $this->db->limit('1');
        $result = $this->db->get()->row_array();
        return $this->time_elapsed_string($result[$date_column]);
    }

    public function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function clean_url($string)
    {
        $url = strtolower($string);
        $url = str_replace(array("'", '"'), '', $url);
        $url = str_replace(array(' ', '+', '!', '&', '-', '/', '.'), '-', $url);
        $url = str_replace("?", "", $url);
        $url = str_replace("---", "-", $url);
        $url = str_replace("--", "-", $url);
        return $url;
    }

    public function sendEmailWithTemplate($email_array)
    {
        $this->load->library('email');
        $this->email->set_newline("\r\n");

        $from_email_address = $this->dbvars->app_email;
        $from_email_name = $this->dbvars->app_name;
        $to_email_address = $email_array['to_email'];
        $email_subject = $email_array['subject'];
        $email_message = $email_array['message'];

        // Set to, from, message, etc.
        $this->email->from($from_email_address, $from_email_name);
        $this->email->to($to_email_address);
        $this->email->subject($email_subject);
        $this->email->message($email_message);
        $this->email->send();

        if (isset($email_array['cc'])) {
            $email_cc = $email_array['cc'];
            $this->email->cc($email_cc);
        }
        if (isset($email_array['bcc'])) {
            $email_bcc = $email_array['bcc'];
            $this->email->cc($email_bcc);
        }

        echo $this->email->print_debugger();
        $result = $this->email->send();
    }
    //  Dropdown Menu Simple
    /**
     * @param $get_field - mention only two params like KEY & VALUE
    - If you want CONCAT two or more fields in the Key OR Value section. pass like that
    - array( CONCAT(user_firstname, '.', user_surname) AS Key, fieldName as Value)
     */
    public function Dropdown($table, $get_field, $constraint_array = '', $groupBy = '', $orderby = '', $limit = '', $optionType = '', $joinArr)
    {

        $this->db->select($get_field);

        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }

        if ($groupBy != '') {
            $this->db->group_by($groupBy);
        }

        if (!empty($orderby)) {
            $this->db->order_by($orderby);
        }

        if ($limit != '') {
            $this->db->limit($limit);
        }
        if (!empty($constraint_array)) {
            foreach ($joinArr as $tableName => $condition) {
                $this->db->join($tableName, $condition, '=');
            }
        }

        $results = $this->db->get()->result();

        $options = array();

        if ($optionType == '') {
            $options[''] = "-- Select --";
        }

        foreach ($results as $item) {
            $options[$item->Key] = $item->Value;

        }
        return $options;
    }

    public function dataUpdate($table, $field, $where, $trans_set)
    {
        $this->db->set("$field", "$field+1", false);
        if ($where != '') {
            $this->db->where($where);
        }
        if ($trans_set != '') {
            foreach ($trans_set as $row => $val) {
                $val_array[] = $val;

            }
            $this->db->where_in('naming_series_id', $val_array);
        }
        $this->db->update($table);
        return $result = $this->db->affected_rows();
    }

    public function validate_vendor($table, $vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $result = 1;
            return $result;
        } else {
            $result = 2;
            return $result;
        }
    }

    // Generate Naming Series
    public function generateSeries($naming, $transaction_id)
    {
        //This can be deleted after changing naming series to array form
        $naming_avoid = $naming;
        if (!is_array($naming)) {
            $naming = array('0' => $naming);
        }
        //End of delete
        foreach ($naming as $key) {
            $naminglist[$key] = explode('_', $key);
        }
        foreach ($naminglist as $row => $val) {
            $namingtest1[$row] = $val[0];
            $namingtest2[$row] = $val[1];
        }
        foreach ($namingtest1 as $row => $val) {
            $const_array = array(
                'naming_series_id' => $val,
                'transaction_id' => $transaction_id,
            );
            $currentValue = $this->specific_row_value('set_naming_series', $const_array, 'current_value');
            $prefixLength = $this->specific_row_value('set_naming_series', $const_array, 'prefix_id');
            $result[$row] = $namingtest2[$row] . '/' . str_pad($currentValue, $prefixLength, 0, STR_PAD_LEFT);

        }
        //This can be deleted after changing naming series to array form
        if (!is_array($naming_avoid)) {
            foreach ($result as $key => $value) {
                $inter = $value;
            }
            return $inter;
        }
        //End of delete
        return $result;
    }

    public function join_records_all($fields, $table, $joinArr, $constraint_array = '', $groupBy = '', $orderby = '', $limitValue = '', $distinct = '')
    {
        $this->db->select(implode(',', $fields), false);
        $this->db->from($table);
        foreach ($joinArr as $tableName => $condition) {
            $this->db->join($tableName, $condition, 'left');
        }
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }

        if (!empty($orderby)) {
            $this->db->order_by($orderby);
        }

        if ($groupBy != '') {
            $this->db->group_by($groupBy);
        }

        if ($limitValue != '') {
            $this->db->limit($limitValue);
        }
        if ($distinct != '') {
            $this->db->limit($limitValue);
        }

        $results = $this->db->get();
        return $results;
    }

    public function validate_insert($table, $qr_code, $data)
    {
        $this->db->where('qr_code', $qr_code);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $result = 1;
            return $result;
        } else {
            $this->db->insert($table, $data);
        }
    }

    public function get_domain($url)
    {
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return false;
    }

    public function get_zo()
    {
        $this->db->select("*");
        $this->db->from("set_role");
        $this->db->like('role_name', 'z', 'both');
        $this->db->order_by("role_id", "desc");
        //$this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_ro()
    {
        $this->db->select("*");
        $this->db->from("set_role");
        $this->db->like('role_name', 'r', 'both');
        $this->db->order_by("role_id", "desc");
        //$this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_so()
    {
        $this->db->select("*");
        $this->db->from("set_role");
        $this->db->like('role_name', 's', 'both');
        $this->db->order_by("role_id", "desc");
        //$this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_products($group_id)
    {
        $this->db->select("*");
        $this->db->from("products");
        $this->db->where('group_id', $group_id);
        $this->db->group_by("product_name");
        $query = $this->db->get();
        return $query->result();
    }
    function get_print($id)
    {
        $this->db->select('p.po_id,p.vendor_id,v.vendor_name,v.address_first,v.vendor_gstin,v.ifsc_code,v.bank_ac_no,v.bank_name');
        $this->db->from('purchase_tbl as p');
        $this->db->where('p.po_id',$id);
        $this->db->join('vendor_details_tbl as v','v.vendor_id=p.vendor_id');

        $query=$this->db->get();
        return $query->result();
    }
     function get_print_product($id)
    {
        $this->db->select('p.po_id,m.material_name,m.hsn_sac,p.po_quantity,p.po_price,u.uom,u.per_uom,p.po_amount');
        $this->db->from('purchase_tbl as p');
        $this->db->where('p.po_id',$id);
        $this->db->join('material_tbl as m','m.material_id=p.m_name');
        $this->db->join('set_uom as u','u.u_id=p.po_uom');
        //$this->db->join('quantity_type as q','q.quantity_type_id=sp.quantity_type_id');
        //$this->db->join('tax_master as t','t.tax_id=sp.tax_id');

        $query=$this->db->get();
        return $query->result();
    }
    function get_payroll_details($id)
    {
        $this->db->select('s.*,e.f_name,e.l_name,e.doj,e.current_address,r.role_name');
        $this->db->from('salary_tbl as s');
        $this->db->where('s.salary_id',$id);
        $this->db->join('em_registation_tbl as e','e.em_registation_id=s.emp_id');
        $this->db->join('set_role as r','r.role_id=s.emp_id');

        $query=$this->db->get();
        return $query->result();
    }
     function get_product($id)
    {
        $this->db->select('p.*');
        $this->db->from('purchase_tbl as p');
        $this->db->where('p.po_id',$id);
        $query=$this->db->get();
        return $query->result();
    }
    function get_offer_letter($id)
    {
        $this->db->select('*,e.f_name,e.l_name,e.doj,e.current_address,r.role_name');
        $this->db->from('em_registation_tbl as e');
        $this->db->join('set_role as r','r.role_id=e.role_id');
        $this->db->join('salary_tbl as s','s.emp_id=e.em_registation_id','left');
 $this->db->where('e.em_registation_id',$id);
        $query=$this->db->get();
        return $query->result();
    }


    public function get_cl_leave()
    {
        $this->db->select('cl.l_role_id as l_role_id');
        $this->db->from('set_role as s');
      
        $this->db->join('cl_master_tbl as cl','cl.l_role_id=s.role_id');
        $results = $this->db->get()->result();
        $data = array();
        foreach ($results as $row) {
            $data[] = $row->l_role_id;

        }
        $this->db->select("*");
        $this->db->from("set_role as s ");
        //$this->db->join("assign_pincode as a","p.id=a.pincode");
        $this->db->where_not_in('s.role_id', $data);
        $results1 = $this->db->get()->result();
        return $results1;

    }
public function get_salary_master()
    {
        $this->db->select('cl.s_role_id as s_role_id');
        $this->db->from('set_role as s');
      
        $this->db->join('salary_master_tbl as cl','cl.s_role_id=s.role_id');
        $results = $this->db->get()->num_rows();

        if($results=='0')
        {
      $this->db->select("*,role_name as role_name,role_id as role_id");
     $this->db->from("set_role");
    $resultss = $this->db->get()->result();
   // print_r($resultss);exit();
    return $resultss;

       
    }
    else
    {
        $this->db->select('cl.s_role_id as s_role_id');
        $this->db->from('set_role as s');
      
        $this->db->join('salary_master_tbl as cl','cl.s_role_id=s.role_id');
        $results = $this->db->get()->result();
        $data = array();
        foreach ($results as $row) {
            $data[] = $row->s_role_id;

        }
       
        
    
      $this->db->select("*,role_name as role_name,role_id as role_id");
        $this->db->from("set_role");
        $this->db->where_not_in('role_id', $data);
        $results1 = $this->db->get()->result();
        return $results1;   
    }

    }
    public function get_update_salary_master($id)
    {
        $this->db->select('*');
        $this->db->from('salary_master_tbl as s');
        $this->db->join('salary_master_tbl_add as cl','cl.s_role_id=s.s_role_id');
         $this->db->where('s.s_role_id', $id);
        $results = $this->db->get()->result();
        //print_r($results);exit();
        return $results;

    }
    public function get_update_salary_master1($id,$id1)
    {
        $this->db->select('*');
        $this->db->from('salary_master_tbl as s');
        $this->db->join('salary_master_tbl_add as cl','cl.s_role_id=s.s_role_id','left');
         $this->db->where('cl.s_role_id', $id);
         $this->db->where('cl.b_details', $id1);
        $results = $this->db->get()->result();
        //print_r($results);exit();
        return $results;

    }
 public function fetch_salary_details($id)
    {
        $this->db->select('*');
        $this->db->from('em_registation_tbl as sem');
        $this->db->where('sem.role_id', $id);
       /*$this->db->group_by('sem.em_registation_id');*/
        
        $results = $this->db->get()->result();
        $data=array();
       foreach($results as $row)
       {
$data[]=$row->em_registation_id;
       }
       
        return $results;

    }
    public function fetch_salary_role_id($id)
    {
        $this->db->select('*');
        $this->db->from('em_registation_tbl as sem');
       
         $this->db->where('sem.em_registation_id', $id);
        
        $results = $this->db->get()->result();
        $result_array = array();
        foreach($results as $row)
        {
$role_id=$row->role_id;
        }
        $this->db->select('*,spm.pay_scale_name as pay_scale_name');
        $this->db->from('salary_master_tbl_add as sem');
        $this->db->join('em_registation_tbl as em','sem.s_role_id=em.role_id');
        $this->db->join('set_pay_scale as spm','spm.id=sem.b_details');
       
         $this->db->where('sem.s_role_id', $role_id);
         $this->db->where('em.em_registation_id', $id);
        
        $results1 = $this->db->get()->result();
      
  return  $results1;
    }
    function saverecords($emp_id,$emp_name,$role_id,$role_name,$total_working_days,$total_worked_days,$leave_days,$month,$year)
    {
        $query="insert into manual_attendance (emp_id,emp_name,role_id,role_name,total_working_days,total_worked_days,leave_days,month,year) values('$emp_id','$emp_name','$role_id','$role_name','$total_working_days','$total_worked_days','$leave_days','$month','$year')";
        // print_r($this->db->last_query());
        // die();
        $att = $this->db->query($query);
        return $att;
        
    }
    public function export_details()
    {
        $this->db->select('em.employee_no,em.f_name,sr.role_name,sr.role_id');
        $this->db->from('em_registation_tbl as em');
        $this->db->join('set_role as sr','sr.role_id=em.role_id');
       
       
        
        return $this->db->get();
    }
    public function emp_details()
    {
        $this->db->select('*');
        $this->db->from('em_registation_tbl as em');
        $this->db->join('set_role as sr','sr.role_id=em.role_id');
        $this->db->where("em.role_id!=",4);
        $this->db->where("em.role_id!=",6);
        $this->db->where("em.role_id!=",7);
        $this->db->order_by("em.em_registation_id","desc");
        $result = $this->db->get()->result();       
        return $result;
    }
    public function fetch_employee_salary_details($id)
    {
        $this->db->select('*');
        $this->db->from('salary_master_tbl_add as sem');
        $this->db->where('sem.s_role_id', $id);
        $results = $this->db->get()->result();
       return $results;

    }
    public function get_salary_details($id)
    {
        $this->db->select('*');
        $this->db->from('salary_tbl');
        
 $this->db->where('emp_id',$id);
        $query=$this->db->get();
        return $query->result();
    }
    public function get_salary_scale($id)
    {
        $this->db->select('*');
        $this->db->from('set_pay_scale as se');
        $this->db->join('salary_scale as sa','se.id=sa.pay_scale_id','inner');
        $this->db->join('salary_master_tbl_add as smt','smt.s_role_id=sa.salary_id','inner');
        $this->db->where('sa.emp_id',$id);
        //$this->db->where('smt.status','1');
        $this->db->group_by('sa.pay_scale_id');
        $query=$this->db->get();
        return $query->result();
    }
    public function get_salary_scale1($id)
    {

        $this->db->select('*,smt.status as status');
        $this->db->from('set_pay_scale as se');
        $this->db->join('salary_scale as sa','se.id=sa.pay_scale_id');
        $this->db->join('salary_master_tbl_add as smt','smt.s_role_id=sa.role_id','inner');
        $this->db->where('sa.emp_id',$id);
        $this->db->where('smt.status','0');
        $this->db->group_by('sa.pay_scale_id');
        $query=$this->db->get();
        return $query->result();
    }
    public function get_salary_scale2($id)
    {
        $this->db->select('*,smt.status as status');
        $this->db->from('salary_master_tbl_add as smt');
 
        $this->db->where('smt.status',0);
       
        $query=$this->db->get()->result();
        
       foreach($query as $row)
       {
 $role_id=$row->s_role_id;
 $status=$row->status;
       }
         $this->db->select('*,smt.status as status');
        $this->db->from('set_pay_scale as se');
       
         $this->db->join('salary_master_tbl_add as smt','smt.b_details=se.id','inner');
         /* $this->db->join('salary_scale as sa','smt.s_role_id=sa.role_id',"inner");*/
       /* $this->db->where('sa.emp_id',$id);*/
        $this->db->where('smt.status',$status);
        /*$this->db->group_by('sa.pay_scale_id');*/
        
        $query1=$this->db->get()->result();
        /*print_r($query1);exit();*/
        return $query1;
    }
}