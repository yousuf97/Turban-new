<?php
class User_interface extends Admin_Controller 
{
  	public function __construct() {
		parent::__construct();

		$this->not_logged_in();
		$this->data['page_title'] = 'Dashboard';

		$this->load->model('model_category');
		$this->load->model('model_getrows');
		$this->load->model('model_tables');
		$this->load->model('model_users');

	}
   	public function index() {
		$this->data['category'] = $this->model_category->getCategoryData(); 
		$this->load->view('templates/header',$this->data);
		$this->data['page_title'] = 'Take Orders';
		$this->load->view('TakeAwayOrders/takeOrder', $this->data);		
		$this->load->view('templates/takeOrderFooter',$this->data);
  	 }
  	function save_cart() {
		$data = array();
	 	$total=0;
		$product_id = $this->input->post('item_id');
		$get_prod = $this->model_getrows->get_product_by_id($product_id); 
		$data=array(
			'id'=>$get_prod->id,
		 	'name'=>$get_prod->name,
		 	'price'=>$get_prod->price,
		 	'qty'=>'1',
		 	'image'=>$get_prod->image
		 );
		$cart= $this->cart->insert($data); 
		$cart_items=$this->cart->contents();
		if($cart) {
			foreach($cart_items as $cart_item => $c) {
				$total = $total + $c['subtotal'];
			}	
			echo 'Qr.'.$total;
  		} else {
			echo 'Item not added';
  		}
	}
	function remove_cart() {
		$total=0; $html='';
        $data = $this->input->post('rowid');
        $remove=$this->cart->remove($data);
        $cart_items=$this->cart->contents();
		if($remove) {
			$html.='<table class="table table-bordered">';
			foreach($cart_items as $cart_item => $c) { 
				$row="'".$c["rowid"]."'";
				$id="'".$c["id"]."'";
				$total = $total + $c['subtotal'];
			$html.='<tr><td class="p-2 align-middle"><p><button onclick="decrease_cart('.$row.','.$id.')" class="btn btn-sm b-r"><i class="fa fa-minus"></i></button><span id="qty'.$c["id"].'" class="p-11">'.$c["qty"].'</span><button onclick="increase_cart('.$row.','.$id.')" class="btn btn-sm b-r"><i class="fa fa-plus"></i></button></p></td><td class="p-2 align-middle">'.$c["name"].'</td><td class="p-2">'. $c["subtotal"].'</td><td class="p-2"><a onclick="remove_cart('.$row.')"><i class="fa fa-minus-circle"></i></a></td></tr>';
			}
			$html.='</table><div class="d-flex justify-content-end"><h5>Total Amount:<span class="text-success pull-right modal-cart-total">Qr.'.$total.'</span></h5></div>';
			echo $html;
  		} else {
			echo 'Item not removed';
  		}
	}
	function update_cart() {
		$total=0; $html='';
        $data = array();
        $data['qty'] = $this->input->post('qty');
        $data['rowid'] = $this->input->post('rowid');
		$update=$this->cart->update($data);
		$cart_items=$this->cart->contents();
        if($update)
        {
			$html.='<table class="table table-bordered">';
			foreach($cart_items as $cart_item => $c) { 
				$row="'".$c["rowid"]."'";
				$id="'".$c["id"]."'";
				$total = $total + $c['subtotal'];
			$html.='<tr><td class="p-2 align-middle"><p><button onclick="decrease_cart('.$row.','.$id.')"  class="btn btn-sm b-r"><i class="fa fa-minus"></i></button><span id="qty'.$c["id"].'" class="p-11">'.$c["qty"].'</span><button onclick="increase_cart('.$row.','.$id.')" class="btn btn-sm b-r"><i class="fa fa-plus"></i></button></p></td><td class="p-2 align-middle">'.$c["name"].'</td><td class="p-2">'. $c["subtotal"].'</td><td class="p-2"><a onclick="remove_cart('.$row.')"><i class="fa fa-minus-circle"></i></a></td></tr>';
			}
			$html.='</table><div class="d-flex justify-content-end"><h5>Total Amount:<span class="text-success pull-right modal-cart-total">Qr.'.$total.'</span></h5></div>';
			echo $html;
        }
        else
        {
            echo 'Quantity not updated';
        }
	}
	function update_model() {
		$total=0; $html='';
		$cart_items=$this->cart->contents();
		$html.='<table class="table table-bordered">';
		foreach($cart_items as $cart_item => $c) { 
			$row="'".$c["rowid"]."'";
			$id="'".$c["id"]."'";
			$total = $total + $c['subtotal'];
		$html.='<tr><td class="p-2 align-middle"><p><button onclick="decrease_cart('.$row.','.$id.')" class="btn btn-sm b-r"><i class="fa fa-minus"></i></button><span id="qty'.$c["id"].'" class="p-11">'.$c["qty"].'</span><button onclick="increase_cart('.$row.','.$id.')" class="btn btn-sm b-r"><i class="fa fa-plus"></i></button></p></td><td class="p-2 align-middle">'.$c["name"].'</td><td class="p-2">'. $c["subtotal"].'</td><td class="p-2"><a onclick="remove_cart('.$row.')"><i class="fa fa-minus-circle"></i></a></td></tr>';
		}
		$html.='</table><div class="d-flex justify-content-end"><h5>Total Amount:<span class="text-success pull-right modal-cart-total">Qr.'.$total.'</span></h5></div>';
		echo $html;
	}
	function create_order() {
		$prod=array();
		$qty=0;
		$user_id = $this->session->userdata('id');
		$user_data = $this->model_users->getUserData($user_id);
		$store_id = $user_data['store_id'];
		$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
		$amount = $this->input->post('amt');
		$notes = $this->input->post('notes');
    	$data = array(
    		'bill_no' => $bill_no,
			'date_time' => strtotime(date('Y-m-d h:i:s a')),
			'customer_name' => '',
			'customer_number' => '',
    		'amount' => $amount,
			'user_id' => $user_id,
			'paid_status' => '', //''- waiting for confirmation
    		'store_id' => $store_id,
    	);
		$insert = $this->db->insert('take_away_orders', $data);
		$order_id = $this->db->insert_id();
		$cart_items=$this->cart->contents();
		foreach($cart_items as $cart_item => $c) { 
			$products_array=array(
				'product_id'=>$c['id'],
				'qty'=>$c['qty'],
				'price'=>$c['price'],
				'subtot'=>$c['subtotal']
			);
			array_push($prod,$products_array);
			$qty= $qty+$c['qty'];
		}
		$data1['order_id']= $order_id;
		$data1['product_id']=json_encode($prod);
		$data1['qty']= $qty;
		$data1['additional_notes']= $notes;
		$data1['amount']= $amount;
		$insert_order = $this->db->insert('take_away_order_items', $data1);
		if($insert_order){
			$this->cart->destroy();
			echo 'Order Placed';
		} else {
			echo 'Error';
    }
  }
}
?>