<?php
class Banner extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Banners';
        $this->load->model('model_banner');
    
    }
    function index()
    {
        $this->render_template('banner/index', $this->data);
    }
    public function create()
    {
       
        $this->form_validation->set_rules('banner_name', 'Banner name', 'trim|required');
        $this->form_validation->set_rules('sort_order', 'Sort Order ', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');
        if ($this->form_validation->run() == TRUE)
        {
            $upload_image = $this->upload_image();
            $data = array(
                'banner_name'=>$this->input->post('banner_name'),
                'sort_order'=>$this->input->post('sort_order'),
                'head'=>$this->input->post('head'),
                'link'=>$this->input->post('link'),
                'active'     =>$this->input->post('active'),
                'image'=>$upload_image
            );
           // print_r($data);
            $create = $this->model_banner->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('banner/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('banner/create', 'refresh');
        	}
        }
        else
        {#echo 's';
            $this->render_template('banner/create', $this->data);
        }

    }
    public function upload_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/banner_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
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
    function fetchBannerData()
    {
        if(!in_array('viewBanner', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $result = array('data' => array());

		$data = $this->model_banner->getBannerData();
        foreach($data as $key => $value) {
			// button
            $buttons = '';
            if(in_array('updateBanner', $this->permission)) {
    			$buttons .= '<a href="'.base_url('banner/update/'.$value['banner_id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteBanner', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['banner_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			

			$img = '<img src="'.base_url($value['image']).'" alt="'.$value['banner_name'].'" class="img-circle" width="50" height="50" />';

            $availability = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				
				$value['banner_name'],
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
        if(!in_array('updateBanner', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$product_id) {
           # redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('banner_name', 'Banner name', 'trim|required');
        $this->form_validation->set_rules('active', 'active', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'banner_name' => $this->input->post('banner_name'),
                'sort_order' => $this->input->post('sort_order'),
                'head' => $this->input->post('head'),
                'link' => $this->input->post('link'),
                'active' => $this->input->post('active'),
            );

            
            if($_FILES['image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('image' => $upload_image);
                
                $this->model_banner->update($product_id,$upload_image);
            }

            $update = $this->model_banner->update($product_id,$data);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('banner/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('banner/update/'.$product_id, 'refresh');
            }
        }
        else {
                    
            
            $banner_data = $this->model_banner->getBannerData($product_id);
            $this->data['banner_data'] = $banner_data;
            $this->render_template('banner/edit', $this->data); 
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
            $delete = $this->model_banner->remove($product_id);
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