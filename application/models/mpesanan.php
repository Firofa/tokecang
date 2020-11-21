<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpesanan extends CI_Model {
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

	public function getAllDataPesanan() {
		$sql = "SELECT * FROM pemesanan";
		return $this->db->query($sql)->result_array();
	}

	public function getAllDataPesananDetail() {
		$sql = "SELECT * FROM `pemesanan` JOIN 	`produk` ON `pemesanan`.`id_produk` = `produk`.`id_produk` JOIN `pelanggan` ON `pemesanan`.`id_user` = `pelanggan`.`no_pelanggan` JOIN `status_produk` ON `pemesanan`.`id_status` = `status_produk`.`id_status` WHERE `pemesanan`.`id_status` != 4";
		return $this->db->query($sql)->result_array();
	}

	public function getAllHistoryDataPesananDetail() {
		$sql = "SELECT * FROM `pemesanan` JOIN 	`produk` ON `pemesanan`.`id_produk` = `produk`.`id_produk` JOIN `pelanggan` ON `pemesanan`.`id_user` = `pelanggan`.`no_pelanggan` JOIN `status_produk` ON `pemesanan`.`id_status` = `status_produk`.`id_status` WHERE `pemesanan`.`id_status` = 4";
		return $this->db->query($sql)->result_array();
	}

	public function getAllDataPesananDetailByUser($id_user) {
		$sql = "SELECT * FROM `pemesanan` JOIN 	`produk` ON `pemesanan`.`id_produk` = `produk`.`id_produk` JOIN `pelanggan` ON `pemesanan`.`id_user` = `pelanggan`.`no_pelanggan` JOIN `status_produk` ON `pemesanan`.`id_status` = `status_produk`.`id_status` WHERE `pemesanan`.`id_user` = ".$id_user." AND `pemesanan`.`id_status` != 4";
		return $this->db->query($sql)->result_array();
	}

	public function getOneDataPesanan($id) {
		$sql = "SELECT * FROM `pemesanan` WHERE `id_pemesanan` =".$id;
		return $this->db->query($sql)->row_array();
	}

	public function updateStatusPesanan($id, $id_status) {
		$sql = "UPDATE `pemesanan` SET `id_status` =".$id_status." WHERE `id_pemesanan` = ".$id;
		return $this->db->query($sql);
	}

	public function getDataPendapatan() {
		$sql = "SELECT * FROM `pemesanan` JOIN `produk` ON `pemesanan`.`id_produk` = `produk`.`id_produk` JOIN `pelanggan` ON `pemesanan`.`id_user` = `pelanggan`.`no_pelanggan` WHERE `id_status` = 4";
		return $this->db->query($sql)->result_array();
	}

	public function getJumlahAllDataPesananDetail() {
		$sql = "SELECT * FROM `pemesanan` JOIN 	`produk` ON `pemesanan`.`id_produk` = `produk`.`id_produk` JOIN `pelanggan` ON `pemesanan`.`id_user` = `pelanggan`.`no_pelanggan` JOIN `status_produk` ON `pemesanan`.`id_status` = `status_produk`.`id_status` WHERE `pemesanan`.`id_status` != 4";
		return $this->db->query($sql)->num_rows();
	}

	public function updateStokProduk($jumlah, $id_produk){
		$sql = "UPDATE `produk` SET `stok_produk` = `stok_produk` -".$jumlah." WHERE `id_produk` = ".$id_produk;
		return $this->db->query($sql);
	}

	public function getDataProduk($id_produk) {
		$sql = "SELECT * FROM `produk` WHERE `id_produk` =".$id_produk;
		return $this->db->query($sql)->row_array();
	}

}