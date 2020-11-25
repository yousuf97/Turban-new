<?php
class Chefs extends Admin_Controller {
    public function __construct(){
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Chefs';
        $this->load->model('model_chefs');
    
    }
    function index(){
        $this->render_template('chefs/index', $this->data);
    }
	public function create() {
        $this->form_validation->set_rules('chef_name', 'Chef name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');
        if ($this->form_validation->run() == TRUE)
        {
            $upload_image = $this->upload_image();
            $data = array(
                'chef_name'=>$this->input->post('chef_name'),
				'chef_img'=>$upload_image,
                'fb_link'=>$this->input->post('fb_link'),
                'insta_link'=>$this->input->post('insta_link'),
                'designation'=>$this->input->post('chef_designation'),
                'active'     =>$this->input->post('active')    
            );
           // print_r($data);
            $create = $this->model_chefs->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');	
        		redirect('chefs/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('chefs/create', 'refresh');
        	}
        }
        else
        {
            $this->render_template('chefs/create', $this->data);
        }
    }
	public function upload_image() {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/chefs_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '2000';
        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }
	function fetchChefsData() {
        if(!in_array('viewChefs', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $result = array('data' => array());

		$data = $this->model_chefs->getChefsData();
        foreach($data as $key => $value) {
			// button
            $buttons = '';
            if(in_array('updateChefs', $this->permission)) {
    			$buttons .= '<a href="'.base_url('chefs/update/'.$value['chef_id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }
            if(in_array('deleteChefs', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['chef_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			$img = '<img src="'.base_url($value['chef_img']).'" alt="'.$value['chef_name'].'" class="img-circle" width="50" height="50" />';

            $availability = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				
				$value['chef_name'],
                $img,
                $availability,
				$buttons
			);
		}
		echo json_encode($result);
    }
	public function update() {
        $product_id=$this->uri->segment(3);
        if(!in_array('updateChefs', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        if(!$product_id) {
           # redirect('dashboard', 'refresh');
        }
        $this->form_validation->set_rules('chef_name', 'Chef name', 'trim|required');
        $this->form_validation->set_rules('active', 'active', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            // true case  
            $data = array(
				'chef_name'=>$this->input->post('chef_name'),
                'fb_link'=>$this->input->post('fb_link'),
                'insta_link'=>$this->input->post('insta_link'),
                'designation'=>$this->input->post('chef_designation'),
                'active'     =>$this->input->post('active')    
            );
            if($_FILES['image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('chef_img' => $upload_image);
                $this->model_chefs->update($product_id,$upload_image);
            }
            $update = $this->model_chefs->update($product_id,$data);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('chefs/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('chefs/update/'.$product_id, 'refresh');
            }
        }
        else {
            $chef_data = $this->model_chefs->getChefsData($product_id);
            $this->data['chef_data'] = $chef_data;
            $this->render_template('chefs/edit', $this->data); 
        } 
    }
	public function remove(){
        if(!in_array('deleteChefs', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->model_chefs->remove($product_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}
}
?>