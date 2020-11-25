<?php
class Model_special extends CI_Model
{
    function getSpecialData($id = null)
    {
        if($id) {

			$sql = "SELECT * FROM todays_special WHERE id = ?";

			$query = $this->db->query($sql, array($id));

			return $query->row_array();

		}



		$sql = "SELECT * FROM todays_special ORDER BY id DESC";

		$query = $this->db->query($sql);

		return $query->result_array();
    }
    public function create($data= array())

	{

		if($data) {

			$insert = $this->db->insert('todays_special', $data);

			return ($create == true) ? true : false;

		}

	}
    function getmenusby_category($id)
    {
        

			$sql = "SELECT * FROM products WHERE category_id like '%".$id."%'";

			$query = $this->db->query($sql, array($id));

			return $query->result_array();

		
    }
    function get_category()
    {
        $sql = "SELECT * FROM category ORDER BY id DESC";

		$query = $this->db->query($sql);

		return $query->result_array();
    }
    function remove($id=null)
    {
        if($id) {

			$this->db->where('id', $id);

			$delete = $this->db->delete('todays_special');

			return ($delete == true) ? true : false;

		}
        else
        {
		return false;
        }
    }
    public function update($id = null, $data = array())

	{

		if($id && $data) {

			$this->db->where('id', $id);

			$update = $this->db->update('todays_special', $data);

			return ($update == true) ? true : false;

		}

	}
    function get_menu_name($id=null)
    {

        $sql = "SELECT name FROM products WHERE id = ?";

			$query = $this->db->query($sql, array($id));

			return $query->row_array();
    }
}
?>