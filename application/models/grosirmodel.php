<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grosirmodel extends CI_Model {
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

	public function getAllProductDetail() {
		$res = $this->db->query("SELECT * FROM `produk` JOIN `kategori` ON `produk`.`id_kategori` = `kategori`.`id` JOIN `satuan_produk` ON `produk`.`id_satuan` = `satuan_produk`.`id`");
		return $res->result_array();
	}


	public function GetAllCategories() {
		$res = $this->db->query("SELECT * FROM kategori");
		return $res->result_array();
	}

	public function GetAllSatuan() {
		$res = $this->db->query("SELECT * FROM satuan_produk");
		return $res->result_array();
	}

	public function GetDetailProduct($id) {
		$res = $this->db->query("SELECT * FROM `produk` JOIN `kategori` ON `produk`.`id_kategori` = `kategori`.`id` WHERE `id_produk` = ".$id);
		return $res->row_array();
	}

	public function GetAllUserNotAdmin() {
		$res = $this->db->query("SELECT * FROM `pelanggan` WHERE `grup_pel` != 'Admin'");
		return $res->result_array();
	}


	public function GetKeranjangById($id_produk, $id_user) {
		$res = $this->db->query("SELECT * FROM `keranjang` WHERE `keranjang`.`id_produk` = ".$id_produk." AND `keranjang`.`id_user` = ".$id_user);
		return $res;
	}

	public function updateKeranjang($id_produk, $id_user) {
		$res = $this->db->query("UPDATE `keranjang` SET `jumlah` = `jumlah` + 1 WHERE `keranjang`.`id_produk` = ".$id_produk." AND `keranjang`.`id_user` = ".$id_user);
		return $res;
	}

	

	
}
