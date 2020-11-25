<?php
class Special extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Today`s Special';
        $this->load->model('model_special');
    
    }
    function index()
    {
        $this->render_template('special/index',$this->data);
    }
    function fetchSpecialData()
    {
        if(!in_array('viewSpecial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $result = array('data' => array());

		$data = $this->model_special->getSpecialData(); #echo $this->db->last_query();
		foreach($data as $key => $value) {
            $buttons = '';
            if(in_array('updateSpecial', $this->permission)) {
    			$buttons .= '<a href="'.base_url('special/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteSpecial', $this->permission)) { 
    			$buttons .= '<button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			

            $availability = ($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['menu_id'],
                $value['special_date'],
                $availability,
				$buttons
			);
		}
		echo json_encode($result);
    }
    function create()
    {
        
            $this->data['category']=$this->model_special->get_category();
            $this->render_template('special/spcreate', $this->data);
    }
    function add_specials()
    {
        $data = array(
                'menu_id'=>$this->input->post('menu'),
                'special_date' =>$this->input->post('s_date'),
                'status'=>$this->input->post('status'),
                'category_id'=>$this->input->post('category')
            );
            $create = $this->model_special->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('special', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('special/create', 'refresh');
        	}
    }
    function get_menus()
    {
        $category=$this->input->post('category');
        $this->db->select('id,name');
        $menus=$this->model_special->getmenusby_category($category);#echo $this->db->last_query();
        $html='';
        if($menus)
        {
            foreach($menus as $key => $value)
            {
                $html.='<option value="'.$value['id'].'">'.$value['name'].'</option>';
            }
        }
        else
        {
            $html.='<option>No Data Available</option>';
        }   
        echo $html;
    }
    public function update()
    {
        $product_id=$this->uri->segment(3);
        if(!in_array('updateSpecial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$product_id) {
           # redirect('dashboard', 'refresh');
        }

        $data = array(
                'menu_id'=>$this->input->post('menu'),
                'special_date' =>$this->input->post('s_date'),
                'status'=>$this->input->post('status'),
                'category_id'=>$this->input->post('category')
            );
        $this->form_validation->set_rules('menu', 'Menu ID', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
        if ($this->form_validation->run() == TRUE) {
            // true case

            $update = $this->model_special->update($product_id,$data);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('special/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('special/update/'.$product_id, 'refresh');
            }
        }
        else {
                    
            
            $gallery_data = $this->model_special->get_category();
            $this->data['category'] = $gallery_data;
            $this->data['specials']=$this->model_special->getSpecialData($product_id);
            $this->render_template('special/edit', $this->data); 
        } 
    }
    public function remove()
	{
        if(!in_array('deleteSpecial', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->model_special->remove($product_id);#echo $this->db->last_query();
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