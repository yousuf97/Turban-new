<?php 

class Model_groups extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
    public function get_group_data()
    {
        $sql="SELECT * FROM groupss ORDER BY id DESC";
        $query=$this->db->query($sql);
        return $query->result_array();
        
    }
	public function getGroupData($groupId = null)
    {
		if($groupId) {
			$sql = "SELECT * FROM groupss WHERE id = ?";
			$query = $this->db->query($sql, array($groupId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM groupss WHERE id != ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
        
	}

	public function create($data = '')
	{
		$create = $this->db->insert('groupss', $data);
		return ($create == true) ? true : false;
	}

	public function edit($data, $id)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('groupss', $data);
		return ($update == true) ? true : false;	
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('groupss');
		return ($delete == true) ? true : false;
	}

	public function existInUserGroup($id)
	{
		$sql = "SELECT * FROM user_group WHERE group_id = ?";
		$query = $this->db->query($sql, array($id));
		return ($query->num_rows() == 1) ? true : false;
	}

	public function getUserGroupByUserId($user_id) 
	{
		
		$sql = "SELECT * FROM user_group INNER JOIN groupss ON groupss.id = user_group.group_id	WHERE user_group.user_id = ?";
		$query = $this->db->query($sql, array($user_id));
		$result = $query->row_array();
//echo $this->db->last_query();
		return $result;

	}
}
