<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TakeAwayOrders extends Admin_Controller 
{
	var $currency_code = '';

	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Take Away Orders';

		$this->load->model('Model_takeawayorders');
		$this->load->model('model_products');
		$this->load->model('model_category');
		$this->load->model('model_company');
		$this->load->model('model_stores');
		$this->load->model('model_users');

		$this->currency_code = $this->company_currency();
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewTakeAwayOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Orders';
		$this->render_template('TakeAwayOrders/index', $this->data);		
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchOrdersData()
	{
		if(!in_array('viewTakeAwayOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->Model_takeawayorders->getOrdersData();
		foreach ($data as $key => $value) {
			$store_data = $this->model_stores->getStoresData($value['store_id']);
			$user_data = $this->model_users->getUserData($value['user_id']);
			$user_name=  $user_data['firstname'].' '.$user_data['lastname'];
		 	$count_total_item = $this->Model_takeawayorders->countOrderItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);
			$date_time = $date . ' ' . $time;
			// button
			$buttons = '';
			if(in_array('viewTakeAwayOrder', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('TakeAwayOrders/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateTakeAwayOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('TakeAwayOrders/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteTakeAwayOrder', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if($value['paid_status'] == '1') {
				$paid_status = '<span class="label label-success">Paid</span>';	
			}
			else if($value['paid_status']=='0'){
				$paid_status = '<span class="label label-warning">Not Paid</span>';
			}
			else
			{$id=$value['id'];
				$paid_status = '<a href=""  data-toggle="modal" data-target="#confirmModal_'.$id.'" ><span class="label label-danger">Not Confirmed</span></a><div class="modal fade" tabindex="-1" role="dialog" id="confirmModal_'.$id.'">
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <h4 class="modal-title">Order Confirmation</h4>
					</div>
			  
					<form role="form" action="'.base_url("TakeAwayOrders/confirm").'" method="post" id="confirmForm">
					  <div class="modal-body">
						<p>Do you really want to confirm the Order?</p>
					  </div><input type="hidden" value="'.$id.'" name="order_id" />
					  <div class="modal-footer">
						
						<button type="submit" class="btn btn-primary">Send to Kitchen</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel Order</button>
					  </div>
					</form>
			  
			  
				  </div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			  </div><!-- /.modal -->';
			}

			$result['data'][$key] = array(
				$value['bill_no'],
				$user_name,
				$date,
                $time,
				$value['customer_name'],
				$count_total_item,
				$value['amount'],
				$paid_status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{
		if(!in_array('createTakeAwayOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	$order_id = $this->Model_takeawayorders->create();
        	
        	if($order_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('TakeAwayOrders', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('TakeAwayOrders/create/', 'refresh');
        	}
        }
        else {
            // false case
            $this->data['table_data'] = $this->model_tables->getActiveTable();
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['products'] = $this->model_products->getActiveProductData(); 
        	$this->data['category'] = $this->model_category->getCategoryData(); 
            $this->render_template('TakeAwayOrders/create', $this->data);
        }	
	}

    /*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the category id 
	* and return the data into the json format.
	*/
	public function getProductByCategoryId()
	{
		$cat_id = $this->input->post('cat_id');
		if($cat_id) {
			$product_data = $this->model_products->getProductDataByCat($cat_id);
			echo json_encode($product_data);
		}
	}
	
	/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
	*/
	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the order page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products['products'] = $this->model_products->getActiveProductData();
		$products['category'] = $this->model_category->getCategoryData();
		echo json_encode($products);
	}
	

	/*
	* If the validation is not valid, then it redirects to the edit orders page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updateTakeAwayOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	

        	$update = $this->Model_takeawayorders->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('TakeAwayOrders/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('TakeAwayOrders/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$this->data['table_data'] = $this->model_tables->getActiveTable();

        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$result = array();
        	$orders_data = $this->Model_takeawayorders->getOrdersData($id);

        	if(empty($orders_data)) {
        		$this->session->set_flashdata('errors', 'The request data does not exists');
        		redirect('TakeAwayOrders', 'refresh');
        	}

    		$result['order'] = $orders_data;
    		$orders_item = $this->Model_takeawayorders->getOrdersItemData($orders_data['id']);

    		foreach($orders_item as $k => $v) {
    			$result['order_item'][] = $v;
    		}
    		$this->data['order_data'] = $result;
        	$this->data['products'] = $this->model_products->getActiveProductData();      		
            $this->render_template('TakeAwayOrders/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteTakeAwayOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$order_id = $this->input->post('order_id');

        $response = array();
        if($order_id) {
            $delete = $this->Model_takeawayorders->remove($order_id);
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
	/*
	* It gets the product id and fetch the order data. 
	* The order print logic is done here 
	*/
	public function printDiv($id)
	{
		if(!in_array('viewTakeAwayOrder', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->data['order_data'] = $this->Model_takeawayorders->getOrdersData($id);
		$this->data['orders_items'] = $this->Model_takeawayorders->getOrdersItemData($id);
		$this->data['company_info'] = $this->model_company->getCompanyData(1);
		$this->load->view('TakeAwayOrders/printDiv', $this->data);
	}
	function confirm()
	{
		$order_id = $this->input->post('order_id');
		$data['paid_status']='0';
		$confirm=$this->Model_takeawayorders->takeaway_update($order_id,$data);
		if($confirm)
		{
			$this->data['order_data'] = $this->Model_takeawayorders->getOrdersData($order_id);
			$this->data['orders_items'] = $this->Model_takeawayorders->getOrdersItemData($order_id);
			$this->data['company_info'] = $this->model_company->getCompanyData(1);
			$this->load->view('TakeAwayOrders/printDiv', $this->data);
			echo "<script>window.print();</script>";
		}
		else
		{
			echo 'error';
		}
		
	}
   
}
