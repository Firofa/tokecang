<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkeranjang extends CI_Model {

	public function ubahJumlahKeranjang($jumlah, $no_keranjang) {
		$sql = "UPDATE `keranjang` SET `jumlah` = ".$jumlah." WHERE `no_keranjang` = ".$no_keranjang;
		return $this->db->query($sql);
	}

	public function GetKeranjangDetail($id_user) {
		$res = $this->db->query("SELECT * FROM `keranjang` JOIN `produk` ON `keranjang`.`id_produk` = `produk`.`id_produk` WHERE `keranjang`.`id_user` =".$id_user);
		return $res->result_array();
	}

	public function hapusProdukKeranjang($no_keranjang) {
		$this->db->Delete('keranjang','`no_keranjang` = '.$no_keranjang);
		return $res;
	}

	public function getKeranjang($id) {
		$sql = "SELECT * FROM `keranjang` WHERE `id_user` = ".$id;
		return $this->db->query($sql);
	} 



}