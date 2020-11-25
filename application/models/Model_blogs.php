<?php
class Model_blogs extends CI_Model {
	public function create($data= array()){
		if($data) {
			$insert = $this->db->insert('blogs', $data);
			return ($insert == true) ? true : false;
		}
	}
	
    public function getBlogsData($id = null){
		if($id) {
			$sql = "SELECT * FROM blogs WHERE blog_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM blogs ORDER BY blog_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
    public function update($id = null, $data = array()) {
		if($id && $data) {
			$this->db->where('blog_id', $id);
			$update = $this->db->update('blogs', $data);
			return ($update == true) ? true : false;
		}
	}

	
	public function remove($id = null) {
		if($id) {
			$this->db->where('blog_id', $id);
			$delete = $this->db->delete('blogs');
			return ($delete == true) ? true : false;
		}
        else
        {
			return false;
        }
	}	
}
?>