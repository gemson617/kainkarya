<?php


class Gallery extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		if($this->session->userdata('auth_level')!='10'){
			redirect('login');
		  }
	}
	
	public function gallery(){
		
		if (isset($_POST['submit'])) 
		{
			//print_r($_POST);exit();
			$g_id = $this->input->post('g_id');
			$caption = $this->input->post('caption');
			$id = $this->input->post('id');

         if ($_FILES['image']['name']!='') {

			$config['upload_path']          ='./public/assets/gallery/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			/*$config['max_size']             = 2048;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;*/


			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
			{
				
				$error = array('error' => $this->upload->display_errors());

				$this->session->set_flashdata('alert_danger', 'image upload  failed!');
				redirect('gallery/gallery');

			}
			else
			{
				$data = $this->upload->data(); 

                   $images=$data['file_name'];
			}
		}else{
			$images=$this->input->post('image1');

		}
				if (!empty($id)) {
					$insert_array = array(
						'g_id'	=>$g_id,
						'caption' => $caption, 
						'image' =>  $images,
						'created_at' => $this->session->userdata('user_id'), 
						'status'=>1,
						'update_date' => date('Y-m-d h-i-s'));
					$update = $this->mcommon->common_edit('gallery', $insert_array,array('id'=>$id,));
					if ($update) {
						$this->session->set_flashdata('alert_success', 'Gallery Updated  successfully!');
						redirect('gallery/gallery');
					}else{
						$this->session->set_flashdata('alert_danger', 'Gallery Updated  failed!');
						redirect('gallery/gallery');
					}

				}else{
					$insert_array = array(
						'g_id'	=>$g_id,
						'caption' => $caption, 
						'image' => $data['file_name'],
						'created_at' => $this->session->userdata('user_id'), 
						'status'=>1,
						'created_date' => date('Y-m-d h-i-s'));
					$insert = $this->mcommon->common_insert('gallery', $insert_array);
					if ($insert) {
						$this->session->set_flashdata('alert_success', 'image upload  successfully!');
						redirect('gallery/gallery');
					}else{
						$this->session->set_flashdata('alert_danger', 'image upload  failed!');
						redirect('gallery/gallery');
					}
				}

			
		}
		$view_data['gallery_album']=$this->mcommon->records_all('gallery_album');

		$view_data['gallery']=$this->main->get_gallery($id='');
		$data = array(
			'title' => "Gallery Management",
			'content' => $this->load->view('Webpage/gallery', $view_data, TRUE),
		);
		$this->load->view('base/base_template', $data);


	}
	public function edit($id){
		
	
		$view_data['image']=$this->main->get_gallery($id);
		$view_data['gallery']=$this->main->get_gallery($id='');
		$view_data['gallery_album']=$this->mcommon->records_all('gallery_album');
		
		$data = array(
			'title' => "Gallery",
			'content' => $this->load->view('Webpage/gallery', $view_data, TRUE),
		);
		$this->load->view('base/base_template', $data);
	}
	
	public function delete($id,$id_for){
		
		
		if ($id_for==1) {
			$delete = $this->mcommon->common_delete('gallery', array('id' =>$id , ));
			if ($delete) {
				$this->session->set_flashdata('alert_success', 'Gallery Delete  successfully!');
				redirect('gallery/gallery');
			}else{
				$this->session->set_flashdata('alert_danger', 'Gallery Delete  failed!');
				redirect('gallery/gallery');
			}
		}elseif($id_for==2){
			$delete = $this->mcommon->common_delete('slider', array('id' =>$id , ));
			if ($delete) {
				$this->session->set_flashdata('alert_success', 'slider Delete  successfully!');
				redirect('gallery/slider');
			}else{
				$this->session->set_flashdata('alert_danger', 'slider Delete  failed!');
				redirect('gallery/slider');
			}

		}elseif($id_for==3){
			$delete = $this->mcommon->common_delete('gallery_album', array('g_id' =>$id , ));
			if ($delete) {
				$this->session->set_flashdata('alert_success', 'Gallery Album Delete  successfully!');
				redirect('gallery/gallery_album');
			}else{
				$this->session->set_flashdata('alert_danger', 'Gallery Album Delete  failed!');
				redirect('gallery/gallery_album');
			}

		}

	}

	public function gallery_album(){
		
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
				redirect('gallery/gallery_album');

			}
			else
			{
				$data = $this->upload->data(); 
                 $image=$data['file_name'];

			}

		}else{
			$image = $this->input->post('image1');
		}
				if (!empty($id)) {
					$insert_array = array(
						'caption' => $caption, 
						'image' =>$image ,
						'created_at' => $this->session->userdata('user_id'), 
						'status'=>1,
						);
				
					$update = $this->mcommon->common_edit('gallery_album', $insert_array,array('g_id'=>$id,));
					
					if ($update) {
						$this->session->set_flashdata('alert_success', 'Gallery Album Updated  successfully!');
						redirect('gallery/gallery_album');
					}else{
						$this->session->set_flashdata('alert_danger', 'Gallery Album Updated  failed!');
						redirect('gallery/gallery_album');
					}

				}else{
					$insert_array = array(
						'caption' => $caption, 
						'image' => $data['file_name'],
						'created_at' => $this->session->userdata('user_id'), 
						'status'=>1,
						'created_date' => date('Y-m-d h-i-s'));
					$insert = $this->mcommon->common_insert('gallery_album', $insert_array);
					if ($insert) {
						$this->session->set_flashdata('alert_success', 'Gallery Album upload  successfully!');
						redirect('gallery/gallery_album');
					}else{
						$this->session->set_flashdata('alert_danger', 'Gallery Album upload  failed!');
						redirect('gallery/gallery_album');
					}
				}

			
		}

		$view_data['gallery_album']=$this->mcommon->records_all1('gallery_album','g_id');
		$data = array(
			'title' => "Gallery Album",
			'content' => $this->load->view('Webpage/gallery_album', $view_data, TRUE),
		);
		$this->load->view('base/base_template', $data);


	}	
public function album_edit($id){
		
	    
		$view_data['image']=$this->main->get_gallery_album($id);
		$view_data['gallery_album']=$this->main->get_gallery_album($id='');
		/*$view_data['gallery_album']=$this->mcommon->records_all('gallery_album');*/
		
		$data = array(
			'title' => "Gallery Album",
			'content' => $this->load->view('Webpage/gallery_album', $view_data, TRUE),
		);
		$this->load->view('base/base_template', $data);
	}

	public function slider(){
		/*print_r("hai");exit();*/
		
		if (isset($_POST['submit'])) 
		{
			
			$caption = $this->input->post('caption');
			$sort_order = $this->input->post('sort_order');
			$id = $this->input->post('id');


			if ($_FILES['image']['name']!='') {
				$config['upload_path']          ='./public/assets/gallery/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
			/*$config['max_size']             = 2048;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;*/


			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
			{
				
				$error = array('error' => $this->upload->display_errors());

				$this->session->set_flashdata('alert_danger', 'image upload  failed!');
				redirect('gallery/slider');

			}
			else
			{
				$data = $this->upload->data(); 
				$slide_image=$data['file_name'];
			}
		}else{
			$slide_image=$this->input->post('slide_image');
		}	
		if (!empty($id)) {
			$insert_array = array(
				
				'caption' => $caption, 
				'image' => $slide_image,
				'sort_order'=>$sort_order,
				'create_at' => $this->session->userdata('user_id'), 
				'status'=>1,
				'update_date' => date('Y-m-d h-i-s'));
			$update = $this->mcommon->common_edit('slider', $insert_array,array('id'=>$id,));
			if ($update) {
				$this->session->set_flashdata('alert_success', 'Gallery Updated  successfully!');
				redirect('gallery/slider');
			}else{
				$this->session->set_flashdata('alert_danger', 'Gallery Updated  failed!');
				redirect('gallery/slider');
			}

		}else{
			$insert_array = array(
				'caption' => $caption, 
				'sort_order'=>$sort_order,
				'image' => $data['file_name'],
				'create_at' => $this->session->userdata('user_id'), 
				'status'=>1,
				'created_date' => date('Y-m-d h-i-s'));

			$insert = $this->mcommon->common_insert('slider', $insert_array);
			if ($insert) {
				$this->session->set_flashdata('alert_success', 'Slider  added!');
				redirect('gallery/slider');
			}else{
				$this->session->set_flashdata('alert_danger', 'Slider added failed!');
				redirect('gallery/slider');
			}
		}

		
	}
	$view_data['slider']=$this->main->get_slider($id='');
	$data = array(
		'title' => "slider Management",
		'content' => $this->load->view('Webpage/slider', $view_data, TRUE),
	);
	$this->load->view('base/base_template', $data);


}

public function slider_edit($id){
	
	
	$view_data['slider_details']=$this->main->get_slider($id);
	$view_data['slider']=$this->main->get_slider($id='');
	$data = array(
		'title' => "Edit Slider",
		'content' => $this->load->view('Webpage/slider', $view_data, TRUE),
	);
	$this->load->view('base/base_template', $data);
}

public function sortSlider(){
    $id=$this->input->post('id');
    $caption=$this->input->post('caption');
    foreach($caption as $key=>$val){
        	$update = $this->mcommon->common_edit('slider', array('caption'=>$caption[$key]),array('id'=>$id[$key]));
    }
    	if ($update) {
				$this->session->set_flashdata('alert_success', 'Caption Updated  successfully!');
				redirect('gallery/slider');
			}else{
				$this->session->set_flashdata('alert_danger', 'Caption Updated  failed!');
				redirect('gallery/slider');
			}
    
    
}


}
