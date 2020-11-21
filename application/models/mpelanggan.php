<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpelanggan extends CI_Model {

	public function getOneDataPelanggan($id) {
		$sql = "SELECT * FROM `pelanggan` WHERE `no_pelanggan` =".$id;
		return $this->db->query($sql)->row_array();
	}

	public function updateStatusPelanggan($id, $id_status) {
		$sql = "UPDATE `pelanggan` SET `grup_pel` = '".$id_status."' WHERE `no_pelanggan` = ".$id;
		return $this->db->query($sql);
	}


}

?>