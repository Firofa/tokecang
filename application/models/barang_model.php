<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {
	public function GetData($table, $where) {
		$data = $this->db->get_where($table,$where);
		return $data->result_array();
	}

	public function UpdateData($tableName, $data,$where) {
		$res = $this->db->Update($tableName,$data,$where);
		return $res;
	}


}

?>