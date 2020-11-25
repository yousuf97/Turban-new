<?php
class Blogs extends Admin_Controller {
    public function __construct(){
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Blogs';
        $this->load->model('model_blogs');
    
    }
    function index(){
        $this->render_template('blogs/index', $this->data);
    }
	public function create() {
        $this->form_validation->set_rules('blog_title', 'Blog name', 'trim|required');
        if ($this->form_validation->run() == TRUE)
        {
            $upload_image = $this->upload_image();
            $data = array(
                'blog_title'=>$this->input->post('blog_title'),
				'blog_description'=>$this->input->post('blog_description'),
				'blog_image'=>$upload_image   
            );
           // print_r($data);
            $create = $this->model_blogs->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');	
        		redirect('blogs/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('blogs/create', 'refresh');
        	}
        }
        else
        {
            $this->render_template('blogs/create', $this->data);
        }
    }
	public function upload_image() {
        $config['upload_path'] = 'assets/images/blog_image';
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
	function fetchBlogsData() {
        if(!in_array('viewBlogs', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $result = array('data' => array());

		$data = $this->model_blogs->getBlogsData();
        foreach($data as $key => $value) {
			// button
            $buttons = '';
            if(in_array('updateBlogs', $this->permission)) {
    			$buttons .= '<a href="'.base_url('blogs/update/'.$value['blog_id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }
            if(in_array('deleteBlogs', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['blog_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			$img = '<img src="'.base_url($value['blog_image']).'" alt="'.$value['blog_image'].'" class="img-circle" width="50" height="50" />';
			$result['data'][$key] = array(	
				$value['blog_title'],
                $img,
				$buttons
			);
		}
		echo json_encode($result);
    }
	public function update() {
        $product_id=$this->uri->segment(3);
        if(!in_array('updateBlogs', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        if(!$product_id) {
           # redirect('dashboard', 'refresh');
        }
        $this->form_validation->set_rules('blog_title', 'Blog title', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            // true case  
            $data = array(
				'blog_title'=>$this->input->post('blog_title'),
				'blog_description'=>$this->input->post('blog_description')
			);
            if($_FILES['image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('blog_image' => $upload_image);
                $this->model_blogs->update($product_id,$upload_image);
            }
            $update = $this->model_blogs->update($product_id,$data);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('blogs/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('blogs/update/'.$product_id, 'refresh');
            }
        }
        else {
            $chef_data = $this->model_blogs->getBlogsData($product_id);
            $this->data['blog_data'] = $chef_data;
            $this->render_template('blogs/edit', $this->data); 
        } 
    }
	public function remove(){
        if(!in_array('deleteBlogs', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->model_blogs->remove($product_id);
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