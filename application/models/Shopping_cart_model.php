<?php
class Shopping_cart_model extends CI_Model
{
 public function fetch_all()
 {
  $query = $this->db->get("product");
  return $query->result();
 }

 public function save_batch($data){
    return $this->db->insert_batch('product', $data);
  }

}