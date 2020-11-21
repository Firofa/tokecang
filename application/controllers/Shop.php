<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_logged_in();
	}

  public function index() {
    $data['title'] = "Shop";
    $data['user'] = $this->db->get_where('pelanggan', [
      'username' => $this->session->userdata('username')])->row_array();
    $this->load->model('mgrosir','grosir');
    $data['produks'] = $this->grosir->getAllProductDetailStok();
    $data['status'] = $data['user']['grup_pel']; 
    $this->load->view('fiturtoko/templates/header',$data);
    $this->load->view('fiturtoko/index',$data);
    $this->load->view('fiturtoko/templates/footer',$data);
  }

  public function singleProduct($id = 0) {
    $data['title'] = "Shop";
    $data['user'] = $this->db->get_where('pelanggan', [
      'username' => $this->session->userdata('username')])->row_array();

    $data['detail_produk'] = $this->grosirmodel->getDetailProduct($id);
    $data['status'] = $data['user']['grup_pel'];
    if($data['detail_produk'] == NULL) {
      redirect('Shop');
    } else {
    $data['produks'] = $this->grosirmodel->getAllProductDetail();
    $this->load->view('fiturtoko/templates/header',$data);
    $this->load->view('fiturtoko/single_product',$data);
    $this->load->view('fiturtoko/templates/footer',$data);

    }
    
  } 


  public function cart() {
    $data['title'] = "Keranjang Belanja";
    $data['user'] = $this->db->get_where('pelanggan', [
      'username' => $this->session->userdata('username')])->row_array();

    $this->load->model('mkeranjang','keranjang');
    $data['cekKeranjang'] = $this->keranjang->getKeranjangDetail($data['user']['no_pelanggan']);
    $this->load->model('msatuan','satuan');
    $data['satuan'] = $this->satuan->GetAllSatuan();
        $data['status'] = $data['user']['grup_pel'];

    
    $this->load->view('fiturtoko/templates/header',$data);
    $this->load->view('fiturtoko/shopping_cart',$data);
    $this->load->view('fiturtoko/templates/footer',$data);
}

    public function addtocart($id = 0) {
      $data['title'] = "Keranjang Belanja";
        $data['user'] = $this->db->get_where('pelanggan', [
      'username' => $this->session->userdata('username')])->row_array();
        $id_user = $data['user']['no_pelanggan'];
       $data['detail_produk'] = $this->grosirmodel->getDetailProduct($id);
      
       if($data['detail_produk'] == NULL) {
        redirect('Shop');
        } else {
          $data['keranjang'] = $this->grosirmodel->getKeranjangById($id, $id_user)->num_rows();
          if($data['keranjang'] == 0) {
            //Jika Barang Belum Ada di Keranjang
              $inputData = [
                'id_produk' => $data['detail_produk']['id_produk'],
                'id_user' => $data['user']['no_pelanggan'],
                'jumlah' => 1             
              ];  
              $this->grosirmodel->InsertData('keranjang',$inputData);
          } else  {
            //Jika Barang Sudah Ada di Keranjang
            $this->grosirmodel->updateKeranjang($id, $id_user);
          }
          

        redirect('shop/cart');
        }
    }

    public function checkout() {
      $data['title'] = "Keranjang Belanja";
        $data['user'] = $this->db->get_where('pelanggan', [
      'username' => $this->session->userdata('username')])->row_array();
      $id = $data['user']['no_pelanggan'];
      $this->load->model('mkeranjang','keranjang');
      $sql = $this->keranjang->getKeranjang($id)->result_array();
      $jml = $this->keranjang->getKeranjang($id)->num_rows();
      $tanggal = time();
      for ($i=0; $i < $jml; $i++) { 
        $this->db->query("INSERT INTO `pemesanan` (`id_produk`,`id_user`,`jumlah`,`id_status`,`tanggal_pemesanan`) VALUES ({$sql[$i]['id_produk']},{$sql[$i]['id_user']},{$sql[$i]['jumlah']},1,{$tanggal})");
      }
      for ($j = 0; $j < $jml; $j++) {
        $this->db->query("DELETE FROM `keranjang` WHERE `no_keranjang` = {$sql[$j]['no_keranjang']} ");
      }

      redirect('shop/pesanan');

      
    }

    public function changeJumlahKeranjang() {
      $noKeranjang = $this->input->post('no_keranjang');
      $jumlah = $this->input->post('jumlah');
      if($jumlah > 0) {
      $this->load->model('mkeranjang','keranjang');
      $sql = $this->keranjang->ubahJumlahKeranjang($jumlah, $noKeranjang);
      $this->session->set_flashdata('message', 
        '<div class="alert alert-dismissible alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Well done!</strong> Quantity Change!
        </div>');
    } else if($jumlah == 0) {
      $this->load->model('mkeranjang','keranjang');
      $sql = $this->keranjang->hapusProdukKeranjang($noKeranjang);
       $this->session->set_flashdata('message', 
        '<div class="alert alert-dismissible alert-warning">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Oops!</strong> Karena jumlah produk 0, barang dihapus dari keranjang!
        </div>');
    } else {
       $this->session->set_flashdata('message', 
        '<div class="alert alert-dismissible alert-warning">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Oops!</strong> Jumlah Produk Tidak Boleh "minus (-)"
        </div>');
    }
    
    }

    public function changeSatuanKeranjang() {
      $noKeranjang = $this->input->post('no_keranjang');
      $satuan = $this->input->post('satuan');

      $this->load->model('mkeranjang','keranjang');
      $this->keranjang->ubahSatuanKeranjang($satuan, $noKeranjang);
    }

    public function pesanan() {
      $data['title'] = "Status Pesanan Anda";
      $data['user'] = $this->db->get_where('pelanggan', [
      'username' => $this->session->userdata('username')])->row_array();
      $id_user = $data['user']['no_pelanggan'];

      
      $this->load->model('mpesanan','pesanan');
    $data['pesanan'] = $this->pesanan->getAllDataPesananDetailByUser($id_user);
    $data['status'] = $data['user']['grup_pel'];
    $this->load->view('templates/header_after',$data);
    $this->load->view('templates/sidebar_after',$data);
    $this->load->view('templates/topbar_after',$data);
    $this->load->view('fiturtoko/data-pesanan',$data);
    $this->load->view('templates/footer_after');
    
    }
}