<?php 
defined('BASEPATH') or exit('No Direct Access Allowed');

class Menu_model extends CI_Model { 


	public function getSubMenu() {
		$query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
				 FROM `user_sub_menu` JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
		";

		return $this->db->query($query)->result_array();

	}

	public function getSubMenuWhere($where) {
		$query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
				 FROM `user_sub_menu` JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id` WHERE `user_sub_menu`.
		".$where;
		return $this->db->query($query)->row_array();

	}

	public function GetData($table, $where) {
		$data = $this->db->get_where($table,$where);
		return $data->result_array();
	}

	public function RegistData($tableName, $data) {
		$res = $this->db->insert($tableName,$data);
		return $res;
	}

	public function InsertData($tableName, $data) {
		$res = $this->db->insert($tableName,$data);
		return $res;
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

?>