<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Reservation';
		$this->load->model('model_reservation');
        $this->load->model('model_tables');
        //error_reporting(0);
	}

	public function index()
	{	
		if(!in_array('viewReservation', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$this->data['page_title'] = 'Manage Table Reservation';
		$this->render_template('reservation/index', $this->data);
	}
    public function fetchReservationData()
    {
        if(!in_array('viewReservation', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_reservation->getReservationData();#echo $this->db->last_query();

		foreach ($data as $key => $value) {

		
			// button
			$buttons = '';

			#if(in_array('viewReservation', $this->permission)) {
			#	$buttons .= '<a target="__blank" href="'.base_url('orders/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
		#	}

			if(in_array('updateReservation', $this->permission)) {
				$buttons .= ' <a onclick="editFunc('.$value['id'].','.$value['capacity'].')" class="btn btn-default" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteReservation', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

    if($value['status'] == 1) {
				$resrved = '<span class="label label-warning">Pending</span>';
			}
			else {
				$resrved = '<span class="label label-success">Reserved</span>';	
			}
			$result['data'][$key] = array(
                $value['id'],
				$value['customer_name'],
				$value['customer_phone'],
				$value['cust_email'],
				$value['capacity'],
				$value['reserv_date'],
                $value['reserv_time'],
                $value['table_no'],
                $resrved,
				$buttons
			);
		} // /foreach
#print_r($result);
		echo json_encode($result);
    }
    function update()
    {
        $id=$this->uri->segment(3);
        #$c=$this->input->post('c');
        if(!in_array('updateReservation', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $data['table_no']= $this->input->post('edit_table_no');
        $data['status']= 2;//reserved
        $this->db->where('id', $id);
		$update = $this->db->update('order_table', $data);
        
        $tables['available']=2;
        $this->db->where('table_name', $this->input->post('edit_table_no'));
        $update_table = $this->db->update('tables', $tables);#echo $this->db->last_query();
        
        if($update == true)
        {
            if($update_table == true)
            {
                $response['success'] = true;
        		$response['messages'] = 'Succesfully updated';
            }
            else
            {
                $response['success'] = false;
        		$response['messages'] = 'Error in the database while updating';	
            }
        }
        else
        {
                $response['success'] = false;
        		$response['messages'] = 'Error in the database while updating';	
        }
        echo json_encode($response);
    }
	function create()
    {
        if(!in_array('createReservation', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $this->data['page_title'] = 'Add Table Reservation';
        
        $this->form_validation->set_rules('customer_name', 'Customer name', 'trim|required');
        $this->form_validation->set_rules('customer_phone', 'Contact # ', 'trim|required');
		$this->form_validation->set_rules('capacity', 'No. of Persons', 'trim|required');
        $this->form_validation->set_rules('reserv_date', 'Reservation Date', 'trim|required');
        $this->form_validation->set_rules('reserv_time', 'Reservation Time', 'trim|required');
        
        if ($this->form_validation->run() == TRUE)
        {
            $data = array(
                'customer_name'=>$this->input->post('customer_name'),
                'customer_phone'=>$this->input->post('customer_phone'),
                'capacity'=>$this->input->post('capacity'),
                'reserv_date'=>date('Y-m-d',strtotime($this->input->post('reserv_date'))),
                'reserv_time'=>$this->input->post('reserv_time'),
                'table_no'=>$this->input->post('table_no'),
                'status'=>'0'
            );
            #print_r($data);
            $create = $this->model_reservation->add($data);
            if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('reservation/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('reservation/create', 'refresh');
        	}
        }
        else
        {
         $this->render_template('reservation/create', $this->data);   
        }
    }
    public function remove()
	{
		if(!in_array('deleteReservation', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$order_id = $this->input->post('order_id');

        $response = array();
        if($order_id) {
            $delete = $this->model_reservation->remove($order_id);
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