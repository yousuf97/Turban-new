<?php
class Model_chefs extends CI_Model {
	public function create($data= array()){
		if($data) {
			$insert = $this->db->insert('chefs', $data);
			return ($insert == true) ? true : false;
		}
	}
	
    public function getChefsData($id = null){
		if($id) {
			$sql = "SELECT * FROM chefs WHERE chef_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM chefs ORDER BY chef_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
    public function update($id = null, $data = array()) {
		if($id && $data) {
			$this->db->where('chef_id', $id);
			$update = $this->db->update('chefs', $data);
			return ($update == true) ? true : false;
		}
	}

	
	public function remove($id = null) {
		if($id) {
			$this->db->where('chef_id', $id);
			$delete = $this->db->delete('chefs');
			return ($delete == true) ? true : false;
		}
        else
        {
			return false;
        }
	}
	
	public function getActiveChef() {
		$sql = "SELECT * FROM chefs WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	
}
?>