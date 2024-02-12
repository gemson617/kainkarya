<?php


class Questionnaire extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('M_pdf');
        if ($this->session->userdata('auth_level') != '10') {
            redirect('login');
        }
    }

    public function index()
    {
        $view_data['polling_list'] = $this->main->get_polling_list();
        $data = array(
            'title' => "Questionnaire",
            'content' => $this->load->view('Webpage/questionnaire', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
    }

    public function show($year)
    {
        
        $view_data['polling_list'] = $this->main->get_polling_list($year);
        $data = array(
            'title' => "Questionnaire",
            'content' => $this->load->view('Webpage/questionnaire', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
    }

    public function add()
    {
        $yr=$this->mcommon->specific_row_value('company_setting',array('id'=>1),'current_financial_year');
       
        if (isset($_POST['submit'])) {
            $question = $this->input->post('question');
            $answer = $this->input->post('answer');
            $user_type = $this->input->post('user_type');
            $count = count($answer);
            $user_count = count($user_type);
            $insert_array = array(
                'question' => $question,
                // 'user_type' => 6,
                'financial_year'=>$yr,
                'status' => 1,
                'created_date' => date('Y-m-d h-i-s')
            );
            $insert = $this->mcommon->common_insert('polling_questions', $insert_array);
            for ($i = 0; $i < $count; $i++) {
                $insert_array1 = array(
                    'question_id' => $insert,
                    'answer' => $answer[$i],
                    'status' => 1,
                    'created_date' => date('Y-m-d h-i-s')
                );
                $insert1 = $this->mcommon->common_insert('polling_answer', $insert_array1);
            }
            for ($u = 0; $u < $user_count; $u++) {

                $user_polling = array(
                    'question_id' => $insert,
                    'user_type' => $user_type[$u],
                    'status' => 1,
                    'created_date' => date('Y-m-d h-i-s')
                );
                $insert2 = $this->mcommon->common_insert('polling_user', $user_polling);
            }
            //die();
            if ($insert1 > '0') {
                $this->session->set_flashdata('alert_success', 'Questionnaire Added successfully!');
                $cur_year=$this->mcommon->specific_row_value('financial_year',array('status'=>1),'year');               
                redirect('questionnaire/show/'.$cur_year);
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }
        $view_data['users'] = $this->main->get_users();
        $view_data['polling_list'] = $this->main->get_polling_list();
        $data = array(
            'title' => "Questionnaire",
            'content' => $this->load->view('Webpage/questionnaire', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
    }

    public function export_excel($id)
    {
        $result1 = $this->main->default_question_answer_excel($id);
        $polling_list = $this->main->get_polling_list();
        $question = $this->mcommon->specific_row_value('polling_questions', array('id' => $id), 'question');
        $answer = $this->mcommon->specific_fields_records_all('polling_answer', array('question_id' => $id), 'answer');
        // echo "<pre>";print_r($result1);

        $filename = "Questionnaire" . $id . '.csv';
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);

        $header = array("S.No", "Name", "Mobile", "Type", "Answer","Comment");
        $filenm = fopen('php://output', 'w');
        fputcsv($filenm, array('Kainkarya Charitable Trust'));
        fputcsv($filenm, array('Questionaire'));
        fputcsv($filenm, array('Link', 'https://kainkarya.com/home/questionnaire/' . $id));
        fputcsv($filenm, array('Question', $question));
        $t = 1;
        foreach ($answer as $row) {
            fputcsv($filenm, array('Answer ' . $t++, $row['answer']));
        }



        fputcsv($filenm, $header);
        $return = array();
        foreach ($result1 as $val) {
            if (!isset($return[$val->answer])) {
                $return[$val->answer] = array();
            }
            $return[$val->answer][] = $val;
        }
        //echo "<pre>";print_r($return);
        $i = 1;
        foreach ($return as $key => $row) {
            foreach ($row as $ky => $r) {
                // echo $return[$key][$ky]->user_type."<br>";
                $name = $return[$key][$ky]->name;
                $mobile = $return[$key][$ky]->mobile;
                $answer = $return[$key][$ky]->answer;
                // echo "count ".count($return[$key]);
                $type = $return[$key][$ky]->user_type;//$this->mcommon->specific_row_value('user_type', array('type_id' => $return[$key][$ky]->user_type), 'type_name');
                $reason = $return[$key][$ky]->reason;
                fputcsv($filenm, array($i++, $name, $mobile, $type, $answer,$reason));
            }
        }
        $j = 1;
        $k = 0;
        foreach ($return as $r) {
            $k = $k + count($r);
            fputcsv($filenm, array('Answer ' . $j++, '', '', '', count($r)));
        }
        fputcsv($filenm, array('Total', '', '', '', $k));
        //  fclose($filenm);
        //   exit;
    }

    public function export_pdf($id)
    {        
        $result1 = $this->main->default_question_answer_excel($id);       
        $polling_list = $this->main->get_polling_list();
        // echo "<pre>";print_r($result1);

        $return = array();
        foreach ($result1 as $val) {
            if (!isset($return[$val->answer])) {
                $return[$val->answer] = array();
            }
            $return[$val->answer][] = $val;
        }
        //echo "<pre>";print_r($return);
        // foreach($return as $key=>$row){
        //    foreach($row as $ky=>$r){
        //        // echo $return[$key][$ky]->user_type."<br>";
        //     $name=$return[$key][$ky]->name;
        //     $mobile=$return[$key][$ky]->mobile;
        //     $answer=$return[$key][$ky]->answer;
        //    // echo "count ".count($return[$key]);
        //     $type=$this->mcommon->specific_row_value('user_type',array('type_id'=>$return[$key][$ky]->user_type),'type_name');
        //     fputcsv($filenm,array($name,$mobile,$type,$answer));
        //    }
        // }
        $view_data['data'] = $return;
        // echo "<pre>";
        // print_r($view_data['data']);
        // exit();
        $data = array(
            'title' => "Kainkarya Charitable Trust",
            'content' => $this->load->view('Webpage/questionnaire_pdf', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {

            $question = $this->input->post('question');
            $answer = $this->input->post('answer');
            $user_type = $this->input->post('user_type');
            $count = count($answer);
            $get_extra_answer = $this->mcommon->specific_fields_records_all('polling_answer', array('question_id' => $id), 'a_id');
           
            $del_count = count($get_extra_answer);
            $user_count = count($user_type);           
            
            if ($del_count) {
                for ($j = 0; $j < $del_count; $j++) {
                    $answer_id = $_POST['answer_id'][$j];
                    $extra_id = $get_extra_answer[$j]['a_id'];
                    if ($answer_id == $extra_id) {
                    } else {
                        $delete_array1 = array(
                            'a_id' => $extra_id,
                        );
                        $update1 = $this->mcommon->common_delete('polling_answer', $delete_array1);
                    }
                }
            }


            $update_question = array(
                'question' => $question
            );
            $update = $this->mcommon->common_edit('polling_questions', $update_question, array('id' => $id));

            if ($update) {

                for ($i = 0; $i < $count; $i++) {
                    $answer_id = $_POST['answer_id'][$i];
                    if ($answer_id) {
                        $update_answer = array(
                            'answer' => $answer[$i]
                        );
                        $update1 = $this->mcommon->common_edit('polling_answer', $update_answer, array('a_id' => $answer_id, 'question_id' => $id));
                    } else {
                        $insert_array1 = array(
                            'question_id' => $id,
                            'answer' => $answer[$i],
                            'status' => 1,
                            'created_date' => date('Y-m-d h-i-s')
                        );
                        $update1 = $this->mcommon->common_insert('polling_answer', $insert_array1);
                    }
                }
            }
            //             echo "<pre>";
            // print_r($update_answer);
            // echo "<br>";
            // print_r($insert_array1);
            // die();
            if ($update1) {
                $delete2 = $this->mcommon->common_delete('polling_user', array('question_id' => $id));
                for ($u = 0; $u < $user_count; $u++) {

                    $user_polling = array(
                        'question_id' => $id,
                        'user_type' => $user_type[$u],
                        'status' => 1,
                        'created_date' => date('Y-m-d h-i-s')
                    );
                    $insert2 = $this->mcommon->common_insert('polling_user', $user_polling);
                }
            }

            if ($update > '0') {
                $this->session->set_flashdata('alert_success', 'Questionnaire Edited successfully!');
               // redirect('questionnaire/questionnaire_list');
                $cur_year=$this->mcommon->specific_row_value('financial_year',array('status'=>1),'year');               
                redirect('questionnaire/show/'.$cur_year);
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }

        $view_data['default'] = $this->main->default_question_answer($id);
        $view_data['user_type'] = $this->main->get_user_type();
        $view_data['get_type'] = $this->main->get_type($id);
        $view_data['polling_list'] = $this->main->get_polling_list();

        $data = array(
            'title' => "Questionnaire",
            'content' => $this->load->view('Webpage/edit_questionnaire', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
    }

    public function questionnaire_list()
    {
        $view_data['polling_list'] = $this->main->get_polling_list();

        $data = array(
            'title' => "Questionnaire",
            'content' => $this->load->view('Webpage/questionnaire', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
    }

    public function delete($id)
    {
        $cur_year=$this->mcommon->specific_row_value('financial_year',array('status'=>1),'year');
        $delete = $this->mcommon->common_delete('polling_questions', array('id' => $id));
        redirect('questionnaire/show/'.$cur_year);
    }
}
