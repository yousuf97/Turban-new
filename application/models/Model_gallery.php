<?php

class Model_gallery extends CI_Model

{

    public function create($data= array())

	{

		if($data) {

			$insert = $this->db->insert('images', $data);

			return ($insert == true) ? true : false;

		}

	}



    public function getGalleryData($id = null)

	{

		if($id) {

			$sql = "SELECT * FROM images WHERE id = ?";

			$query = $this->db->query($sql, array($id));

			return $query->row_array();

		}



		$sql = "SELECT * FROM images ORDER BY id DESC";

		$query = $this->db->query($sql);
		return $query->result_array();

	}

    	public function update($id = null, $data = array())

	{

		if($id && $data) {

			$this->db->where('id', $id);

			$update = $this->db->update('images', $data);

			return ($update == true) ? true : false;

		}

	}



	public function remove($id = null)

	{

		if($id) {

			$this->db->where('id', $id);

			$delete = $this->db->delete('images');

			return ($delete == true) ? true : false;

		}
        else
        {
		return false;
        }
	}



	public function getActiveGallery()

	{

		$sql = "SELECT * FROM images WHERE status = ?";

		$query = $this->db->query($sql, array(1));

		return $query->result_array();

	}



}

?>