<?php
class Gallery extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Gallery';
        $this->load->model('model_gallery');
    
    }
    function index()
    {
        $this->render_template('gallery/index', $this->data);
    }
    public function create()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
        if ($this->form_validation->run() == TRUE)
        {
            $upload_gallery_image = $this->upload_gallery_image();
            $data = array(
                'title'=>$this->input->post('title'),
                'status'     =>$this->input->post('status'),
                'file_name'=>$upload_gallery_image
            );
            $create = $this->model_gallery->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('gallery', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('gallery/create', 'refresh');
        	}
        }
        else
        { #echo 's';
            //$this->render_template('gallery/create', $this->data);
            $this->render_template('gallery/test', $this->data);
        }
    }
    public function upload_gallery_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/gallery_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';

        $config['max_width']  = '1000';
       $config['max_height']  = '667';

       /* $size = getimagesize($_FILES['image']['tmp_name']);
        $width = $size[0];
        $height = $size[1]; */
        
            
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
    function fetchGalleryData()
    {
        if(!in_array('viewGallery', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $result = array('data' => array());

		$data = $this->model_gallery->getGalleryData(); 
		foreach($data as $key => $value) {
            $buttons = '';
            if(in_array('updateGallery', $this->permission)) {
    			$buttons .= '<a href="'.base_url('gallery/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteGallery', $this->permission)) { 
    			$buttons .= '<button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			$img = '<img src="'.base_url($value['file_name']).'" alt="'.$value['title'].'" class="img-circle" width="100" height="100" />';

            $availability = ($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['title'],
                $img,
                $availability,
				$buttons
			);
		}
		echo json_encode($result);
    }
   public function update()
    {
        $product_id=$this->uri->segment(3);
        if(!in_array('updateGallery', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$product_id) {
           # redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'title' => $this->input->post('title'),
                'status' => $this->input->post('status'),
            );

            
            if($_FILES['image']['size'] > 0) {
                $upload_gallery_image = $this->upload_gallery_image();
                $upload_gallery_image = array('file_name' => $upload_gallery_image);
                
                $this->model_gallery->update($product_id,$upload_gallery_image);
            }

            $update = $this->model_gallery->update($product_id,$data);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('gallery/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('gallery/update/'.$product_id, 'refresh');
            }
        }
        else {
                    
            
            $gallery_data = $this->model_gallery->getGalleryData($product_id);
            $this->data['gallery_data'] = $gallery_data;
            $this->render_template('gallery/edit', $this->data); 
        } 
    }
    public function remove()
	{
        if(!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->model_gallery->remove($product_id);
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