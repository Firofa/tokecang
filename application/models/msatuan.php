<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msatuan extends CI_Model {
	public function GetAllSatuan() {
		$res = $this->db->query("SELECT * FROM satuan_produk");
		return $res->result_array();
	}

	public function InsertDataSatuan($satuan) {
		$sql = "INSERT INTO `satuan_produk` (satuan) VALUES ('$satuan')";
		return $this->db->query($sql);
	}

	public function UpdateData($tableName, $data,$where) {
		$res = $this->db->Update($tableName,$data,$where);
		return $res;
	}

	public function DeleteData($tableName, $where) {
		$res = $this->db->Delete($tableName,$where);
		return $res;
	}
}