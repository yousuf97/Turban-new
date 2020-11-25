<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Products';

		$this->load->model('model_products');
		$this->load->model('model_category');
        $this->load->model('model_stores');
        $this->load->library('csvimport');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('products/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchProductData()
	{
        if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$result = array('data' => array());

		$data = $this->model_products->getProductData();

		foreach ($data as $key => $value) {
            $store_ids = json_decode($value['store_id']);
            
            
            $store_name = array();
            foreach ($store_ids as $k => $v) {
                $store_data = $this->model_stores->getStoresData($v);
                $store_name[] = $store_data['name'];
            }

            $store_name = implode(', ', $store_name);
            

			// button
            $buttons = '';
            if(in_array('updateProduct', $this->permission)) {
    			$buttons .= '<a href="'.base_url('products/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteProduct', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			

			$img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

            $availability = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$img,
				$value['name'],
				$value['arabic_name'],
                $value['price'],
				$store_name,
                $availability,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	
    
    /*
    * view the product based on the store 
    * the admin can view all the product information
    */
    public function viewproduct()
    {
        if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $company_currency = $this->company_currency();
        // get all the category 
        $this->data['category'] = $this->model_category->getCategoryData();
        
        
        // based on the category get all the products 
        $this->render_template('products/view_products', $this->data);
        
    }

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
        $addons=$this->input->post('addons');
        $addon_price=$this->input->post('addon_price');
		if(!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
		$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {
            // true case
        	$upload_image = $this->upload_image();

        	$data = array(
        		'name' => $this->input->post('product_name'),
        		'arabic_name' => $this->input->post('arabic_product_name'),
        		'price' => $this->input->post('price'),
        		'image' => $upload_image,
        		'description' => $this->input->post('description'),
        		'category_id' => json_encode($this->input->post('category')),
                'store_id' => json_encode($this->input->post('store')),
        		'active' => $this->input->post('active'),
            );
            $create = $this->model_products->create($data);
            
            if($create == true) 
            {
                foreach($addons as $ky=>$value_addon)
                {
                    $addo['price']=$addon_price[$ky];
                    $addo['addon']=$value_addon;
                    $addo['product_id']=$create;

                    $create_addon = $this->model_products->create_addon($addo);
                }
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('products/', 'refresh');
        	}
            else 
            {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('products/create', 'refresh');
        	}        	
        }
        else {
            // false case

        	// attributes 
        	// $attribute_data = $this->model_attributes->getActiveAttributeData();


        	// $this->data['attributes'] = $attributes_final_data;
			// $this->data['brands'] = $this->model_brands->getActiveBrands();        	
			$this->data['category'] = $this->model_category->getActiveSubCategory();        	
			$this->data['stores'] = $this->model_stores->getActiveStore();        	

            $this->render_template('products/create', $this->data);
        }	
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
	public function upload_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/product_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('product_image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['product_image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function update($product_id)
	{      
        $addons=$this->input->post('addons');
        $addon_price=$this->input->post('addon_price');
        if(!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$product_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('active', 'active', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'name' => $this->input->post('product_name'),
                'arabic_name' => $this->input->post('arabic_product_name'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
                'category_id' => json_encode($this->input->post('category')),
                'store_id' => json_encode($this->input->post('store')),
                'active' => $this->input->post('active'),
            );

            
            if($_FILES['product_image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('image' => $upload_image);
                
                $this->model_products->update($upload_image, $product_id);
            }

            $update = $this->model_products->update($data, $product_id);
           
            if($update == true) {
                if($addons!=''){
                foreach($addons as $ky=>$value_addon)
                {
                    $addo['price']=$addon_price[$ky];
                    $addo['addon']=$value_addon;
                    $addo['product_id']=$product_id;
#print_r($addo);
                    $create_addon = $this->model_products->create_addon($addo);
                  #  echo $this->db->last_query();
                }
            }
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('products/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('products/update/'.$product_id, 'refresh');
            }
        }
        else {
                    
            $this->data['category'] = $this->model_category->getActiveSubCategory();           
            $this->data['stores'] = $this->model_stores->getActiveStore();          

            $product_data = $this->model_products->getProductData($product_id);
            $prod_addons=$this->model_products->get_product_addon($product_id);
            $this->data['product_data'] = $product_data;
            $this->data['addon_product']=$prod_addons;
            $this->render_template('products/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->model_products->remove($product_id);
            if($delete == true) {
                $addon=$this->model_products->remove_addon($product_id);
                if($addon)
                {
                    $response['success'] = true;
                    $response['messages'] = "Successfully removed";
                }
                else
                 {
                    $response['success'] = false;
                    $response['messages'] = "Error in the database while removing the addon";
                 }
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
    
    public function importproduct() {
        $this->render_template('products/importproduct', $this->data);
    }
    public function import() {
        $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
		foreach($file_data as $row)
		{
			$data[] = array(
				'category_id'	=>	'["'.$row["Category Id"].'"]',
        		'store_id'		=>	'["'.$row["Store Id"].'"]',
        		'name'			=>	$row["Name"],
        		'arabic_name'	=>	'',
        		'price'   =>	$row["Price"],
        		'description'   => '',
        		'image'   => '',
        		'active'   =>	$row["Active"]
			);
		}
		$this->model_products->create($data);
	}

}
