<?php

class Model_banner extends CI_Model

{

    public function create($data= array())

	{

		if($data) {

			$insert = $this->db->insert('banners', $data);

			return ($insert == true) ? true : false;

		}

	}



    	public function getBannerData($id = null)

	{

		if($id) {

			$sql = "SELECT * FROM banners WHERE banner_id = ?";

			$query = $this->db->query($sql, array($id));

			return $query->row_array();

		}



		$sql = "SELECT * FROM banners ORDER BY banner_id DESC";

		$query = $this->db->query($sql);

		return $query->result_array();

	}

    	public function update($id = null, $data = array())

	{

		if($id && $data) {

			$this->db->where('banner_id', $id);

			$update = $this->db->update('banners', $data);

			return ($update == true) ? true : false;

		}

	}



	public function remove($id = null)

	{

		if($id) {

			$this->db->where('banner_id', $id);

			$delete = $this->db->delete('banners');

			return ($delete == true) ? true : false;

		}
        else
        {
		return false;
        }
	}



	public function getActiveBanner()

	{

		$sql = "SELECT * FROM banners WHERE active = ?";

		$query = $this->db->query($sql, array(1));

		return $query->result_array();

	}



/*	public function countTotalBanners()

	{

		$sql = "SELECT * FROM banners WHERE active = ?";

		$query = $this->db->query($sql, array(1));

		return $query->num_rows();

	} */

}

?>