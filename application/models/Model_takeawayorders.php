<?php 

class Model_takeawayorders extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tables');
		$this->load->model('model_users');
	}

	/* get the orders data */
	public function getOrdersData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM take_away_orders WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM take_away_orders ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM take_away_orders WHERE store_id = ? ORDER BY id DESC";
			$query = $this->db->query($sql, array($user_data['store_id']));
			return $query->result_array();	
		}
	}

	// get the orders item data
	public function getOrdersItemData($order_id = null)
	{
		if(!$order_id) {
			return false;
		}

		$sql = "SELECT * FROM take_away_order_items WHERE order_id = ?";
		$query = $this->db->query($sql, array($order_id));
		return $query->result_array();
	}

	public function create()
	{
		$user_id = $this->session->userdata('id');
		// get store id from user id 
		$user_data = $this->model_users->getUserData($user_id);
		$store_id = $user_data['store_id'];

		$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'bill_no' => $bill_no,
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
			'customer_name' => $this->input->post('customer_name'),
			'customer_number' => $this->input->post('customer_number'),
    		'amount' => $this->input->post('gross_amount_value'),
    		'user_id' => $user_id,
			'paid_status' => $this->input->post('paid_status'),
    		'store_id' => $store_id,
    	);

		$insert = $this->db->insert('take_away_orders', $data);
		$order_id = $this->db->insert_id();
		$prod=array();
		$qty=0;
		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
				'product_id' => $this->input->post('product')[$x],
				'qty' => $this->input->post('qty')[$x],
				'price'=>$this->input->post('amount')[$x],
				'subtot' => $this->input->post('amount_value')[$x],
			);
			array_push($prod,$items);
			$qty = $qty+$this->input->post('qty')[$x];
		}#print_r($prod);
			$data1['order_id']= $order_id;
			$data1['product_id']=json_encode($prod);
			$data1['qty']= $qty;
			$data1['additional_notes']= $this->input->post('additional_notes');
			$data1['amount']= $this->input->post('gross_amount_value');
			$insert1 = $this->db->insert('take_away_order_items', $data1);
    	// update the table status
    	$this->load->model('model_tables');
    	$this->model_tables->update($this->input->post('table_name'), array('available' => 2));

		return ($order_id) ? $order_id : false;
	}

	public function countOrderItem($order_id)
	{
		if($order_id) {
			$sql = "SELECT * FROM take_away_order_items WHERE order_id = ?";
			$query = $this->db->query($sql, array($order_id));
			return $query->num_rows();
			echo $this->db->last_query();
		   // print_r($data); die;
		}
	}

	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			$user_data = $this->model_users->getUserData($user_id);
			$store_id = $user_data['store_id'];
			// update the table info
			$order_data = $this->getOrdersData($id);
			//$data = $this->model_tables->update($order_data['table_id'], array('available' => 1));

			if($this->input->post('paid_status') == 1) {
	    		$this->model_tables->update($this->input->post('table_name'), array('available' => 1));	
	    	}
	    	else {
	    		$this->model_tables->update($this->input->post('table_name'), array('available' => 2));	
	    	}

			$data = array(
	    		'amount' => $this->input->post('gross_amount_value'),	
	    		'user_id' => $user_id,
				'customer_name' => $this->input->post('customer_name'),
				'customer_number' => $this->input->post('customer_number'),
				'paid_status' => $this->input->post('paid_status'),
	    		'store_id' => $store_id
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('take_away_orders', $data);
			$prod=array();
			$qty=0;
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
	    			'product_id' => $this->input->post('product')[$x],
	    			'qty' => $this->input->post('qty')[$x],
	    			'amount' => $this->input->post('amount_value')[$x],
				);
				array_push($prod,$items);
				$qty = $qty+$this->input->post('qty')[$x]; 
			}
			$data1['order_id']= $id;
			$data1['product_id']=json_encode($prod);
			$data1['qty']= $qty;
			$data1['additional_notes']= $this->input->post('additional_notes');
			$data1['amount']= $this->input->post('gross_amount_value');
			$this->db->where('order_id', $id);
			$update_items = $this->db->update('take_away_order_items', $data1);
			if($update_items){
				return true;
			} else {
				return false;
			}
			
		}
	}
	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('take_away_orders');

			$this->db->where('order_id', $id);
			$delete_item = $this->db->delete('order_items');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidOrders()
	{
		$sql = "SELECT * FROM take_away_orders WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
    function online_update($id,$data)
    {
       $this->db->where('id', $id);
	   $update = $this->db->update('checkout', $data);
       return ($update== true)?true:false;
	}
	function takeaway_update($id,$data)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('take_away_orders', $data);
		return ($update== true)?true:false;
	 }
}