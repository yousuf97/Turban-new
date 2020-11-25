<?php 

class Model_category extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getCategoryData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM category WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM category ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($table,$data = array())
	{
		if($data) {
			$create = $this->db->insert($table, $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($table,$id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update($table, $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($table,$id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete($table);
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveCategory()
	{
		$sql = "SELECT * FROM category WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	public function getActiveSubCategory()
	{
		$sql = "SELECT * FROM sub_category WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	public function getsubCategoryData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM sub_category WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM sub_category ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_parentcategory_name($id)
	{
		$sql = "SELECT name FROM category WHERE id = ".$id;
		$query = $this->db->query($sql);
		return $query->row_array();
	}
}