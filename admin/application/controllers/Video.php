<?php


class Video extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		if($this->session->userdata('auth_level')!='10'){
			redirect('login');
		  }
	}
	
	public function index(){
		
		if (isset($_POST['submit'])) 
		{
			$v_id = $this->input->post('v_id');
			$caption = $this->input->post('caption');
			$video = $this->input->post('video');
			$id = $this->input->post('id');

			if (!empty($id)) {
				$insert_array = array(
					'v_id'=>$v_id,
					'caption' => $caption, 
					'video' => $video,
					'created_at' => $this->session->userdata('user_id'), 
					'status'=>1,
					'update_date' => date('Y-m-d h-i-s'));
				$update = $this->mcommon->common_edit('video', $insert_array,array('id'=>$id,));
				if ($update) {
					$this->session->set_flashdata('alert_success', 'video Updated  successfully!');
					redirect('video');
				}else{
					$this->session->set_flashdata('alert_danger', 'video Updated  failed!');
					redirect('video');
				}

			}else{
				$insert_array = array(
					'v_id'=>$v_id,
					'caption' => $caption, 
					'video' => $video,
					'created_at' => $this->session->userdata('user_id'), 
					'status'=>1,
					'created_date' => date('Y-m-d h-i-s'));
				$insert = $this->mcommon->common_insert('video', $insert_array);
				if ($insert) {
					$this->session->set_flashdata('alert_success', 'video upload  successfully!');
					redirect('video');
				}else{
					$this->session->set_flashdata('alert_danger', 'video upload  failed!');
					redirect('video');
				}
			}

			
		}

		$view_data['video_data']=$this->main->get_video($id='');
		$view_data['video_album']=$this->mcommon->records_all('video_album');
		$data = array(
			'title' => "Video Management",
			'content' => $this->load->view('Webpage/video', $view_data, TRUE),
		);
		$this->load->view('base/base_template', $data);


	}
	public function edit($id){

	    $view_data['video_edit']=$this->main->get_video($id);
		$view_data['video_data']=$this->main->get_video($id='');

		$view_data['video_album']=$this->mcommon->records_all('video_album');
		$data = array(
			'title' => "Video Management",
			'content' => $this->load->view('Webpage/video', $view_data, TRUE),
		);
		$this->load->view('base/base_template', $data);
	}
	public function album_edit($id){

	    $view_data['album_edit']=$this->main->get_video_album($id);
		$view_data['video_album']=$this->main->get_video_album($id='');

		
		$data = array(
			'title' => "Video Alubum ",
			'content' => $this->load->view('Webpage/video_album', $view_data, TRUE),
		);
		$this->load->view('base/base_template', $data);
	}
	public function delete($id,$id_for){
	if ($id_for==2) {
		$delete = $this->mcommon->common_delete('video', array('id' =>$id , ));
		if ($delete) {
			$this->session->set_flashdata('alert_success', 'video Delete  successfully!');
			redirect('video');
		}else{
			$this->session->set_flashdata('alert_danger', 'video Delete  failed!');
			redirect('video');
		}
	}elseif ($id_for==1) {

		$delete = $this->mcommon->common_delete('video_album', array('v_id' =>$id , ));
		if ($delete) {
			$this->session->set_flashdata('alert_success', 'video Album Delete  successfully!');
			redirect('video/album');
		}else{
			$this->session->set_flashdata('alert_danger', 'video Album Delete  failed!');
			redirect('video/album');
		}
	}
	}

	public function album(){
		
		if (isset($_POST['submit'])) 
		{
         
			$caption = $this->input->post('caption');
			$id = $this->input->post('id');

           if ($_FILES['image']['name']!='') {

			$config['upload_path']          ='./public/assets/gallery/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
			{
				
				$error = array('error' => $this->upload->display_errors());

				$this->session->set_flashdata('alert_danger', 'image upload  failed!');
				redirect('video/album');

			}
			else
			{
				$data = $this->upload->data(); 
                $video_image=$data['file_name'];
            }
            }else{
			$video_image = $this->input->post('image1');
	    	}

				if (!empty($id)) {
					$insert_array = array(
					'caption' => $caption, 
					'image' =>$video_image ,
					'created_at' => $this->session->userdata('user_id'), 
					'status'=>1,
					);
					
				$update = $this->mcommon->common_edit('video_album', $insert_array,array('v_id'=>$id,));
				if ($update) {
					$this->session->set_flashdata('alert_success', 'Video Album Updated!');
					redirect('video/album');
				}else{
					$this->session->set_flashdata('alert_danger', 'Video Album Updated  failed!');
					redirect('video/album');
				}

				}else{
				$insert_array = array(
					'caption' => $caption, 
					'image' => $data['file_name'],
					'created_at' => $this->session->userdata('user_id'), 
					'status'=>1,
					'created_date' => date('Y-m-d h-i-s'));
				$insert = $this->mcommon->common_insert('video_album', $insert_array);
				if ($insert) {
					$this->session->set_flashdata('alert_success', 'Gallery Album upload  successfully!');
					redirect('video/album');
				}else{
					$this->session->set_flashdata('alert_danger', 'Gallery Album upload  failed!');
					redirect('video/album');
				}
			}

			
		}

		$view_data['video_album']=$this->mcommon->records_all1('video_album','v_id');
		$data = array(
			'title' => "Video Album",
			'content' => $this->load->view('Webpage/video_album', $view_data, TRUE),
		);
		$this->load->view('base/base_template', $data);


	}	
}
