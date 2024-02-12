<?php


class Polling extends CI_Controller
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
        $view_data[''] = "";
        $data = array(
            'title' => "Polling",
            'content' => $this->load->view('Webpage/polling', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
    }


    public function add()
    {
        if (isset($_POST['submit'])) {
            // print_r($_POST);
            // die();
            $question = $this->input->post('question');
            $answer = $this->input->post('answer');
            $user_type = $this->input->post('user_type');

            $count = count($answer);
            $user_count = count($user_type);
            // print_r($user_count);
            // die();
            $insert_array = array(
                'question' => $question,
                'user_type' => 6,
                'status' => 1,
                'created_date' => date('Y-m-d h-i-s')
            );
            // echo "<pre>";
            // print_r($insert_array);
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
                // echo "<pre>";
                // print_r($insert_array);
                $insert2 = $this->mcommon->common_insert('polling_user', $user_polling);
                
            }
     
            //die();
            if ($insert1 > '0') {
                $this->session->set_flashdata('alert_success', 'Questionnaire Added successfully!');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }

        }

        $view_data['users'] = $this->main->get_users();
        $data = array(
            'title' => "Polling",
            'content' => $this->load->view('Webpage/polling', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            // print_r($_POST);
            // die();
            $question = $this->input->post('question');
            $answer = $this->input->post('answer');
            $user_type = $this->input->post('user_type');

            $count = count($answer);
            $delete = $this->mcommon->common_delete('polling_questions', array('id' => $id));
            $count = count($answer);
            $user_count = count($user_type);
            // print_r($user_count);
            // die();
            for ($u = 0; $u < $user_count; $u++) {
                $insert_array = array(
                    'question' => $question,
                    'user_type' => $user_type[$u],
                    'status' => 1,
                    'created_date' => date('Y-m-d h-i-s')
                );
                // echo "<pre>";
                // print_r($insert_array);
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
            }

            if ($insert1 > '0') {
                $this->session->set_flashdata('alert_success', 'Questionnaire Edited successfully!');
                redirect('polling/polling_list');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }

        $view_data['default'] = $this->main->default_question_answer($id);
        // echo "<pre>";
        // print_r($view_data['default']);
        // die();
        $data = array(
            'title' => "Polling",
            'content' => $this->load->view('Webpage/edit_polling', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
    }

    public function polling_list()
    {
        $view_data['polling_list'] = $this->main->get_polling_list();
       
        $data = array(
            'title' => "Polling",
            'content' => $this->load->view('Webpage/polling_list', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
    }

    public function delete($id){
        $delete = $this->mcommon->common_delete('polling_questions', array('id' => $id));
        redirect('polling/polling_list');
    }
}
