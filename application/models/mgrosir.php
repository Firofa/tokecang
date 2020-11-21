<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgrosir extends CI_Model {

		public function getAllProductDetailStok() {
		$res = $this->db->query("SELECT * FROM `produk` JOIN `kategori` ON `produk`.`id_kategori` = `kategori`.`id` JOIN `satuan_produk` ON `produk`.`id_satuan` = `satuan_produk`.`id` WHERE `produk`.`stok_produk` != 0");
		return $res->result_array();
		}


}


?>