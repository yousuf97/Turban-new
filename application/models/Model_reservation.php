<?php
class Model_reservation extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
    public function create()
	{
		/*if(!in_array('createTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}*/

		$response = array();

		$this->form_validation->set_rules('customer_name', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('capacity', 'Capacity', 'trim|integer');
		$this->form_validation->set_rules('telephone', 'Telephone No.', 'trim|required');
		$this->form_validation->set_rules('store', 'Store', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'table_name' => $this->input->post('table_name'),
        		'available' => 1,
        		'capacity' => $this->input->post('capacity'),	
        		'active' => $this->input->post('active'),	
        		'store_id' => $this->input->post('store'),	
        	);

        	$create = $this->model_tables->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}
    public function getReservationData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM order_table WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

			$sql = "SELECT * FROM order_table ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		
	}
    function get_available_tables()
    {
        $sql = "SELECT * FROM tables where available=1";
			$query = $this->db->query($sql);
			return $query->result_array();
    }
    public function add($data = array())
	{
		if($data) {
			$create = $this->db->insert('order_table', $data);
			return ($create == true) ? true : false;
		}
	}
    public function remove($id = null)
	{
		if($id) {
		  $this->db->select('table_no');
          $this->db->where('id',$id);
          $table_no=$this->db->get('order_table')->row()->table_no;
          
			$this->db->where('id', $id);
			$delete = $this->db->delete('order_table');
            if($delete)
            {
                $data['available']='1';
                $this->db->where('table_name', $table_no);
                $update=$this->db->update('tables',$data);
                if($update)
                {
                    return ($update == true) ? true : false;
                }
            }
		}
	}
}
?>