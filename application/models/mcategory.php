<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcategory extends CI_Model {
	public function GetAllCategory() {
		$res = $this->db->query("SELECT * FROM kategori");
		return $res->result_array();
	}

	public function InsertDataCategory($kategori) {
		$sql = "INSERT INTO `kategori` (kategori) VALUES ('$kategori')";
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