<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_logged_in();
	}

	public function index() {
		$this->load->model('mpesanan','pesanan');
		$data = $this->pesanan->getDataPendapatan();
		$total = 0;
		foreach ($data as $pdptn) {
			if($pdptn['grup_pel'] == 'Member') {
			$total += $pdptn['harga_jual']*$pdptn['jumlah'];
			} else {
			$total += $pdptn['harga_pokok']*$pdptn['jumlah'];
			}
		}
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();
		$data['title'] = "Dashboard";
		$data['total'] = $total;
		$data['pesanan'] = $this->pesanan->getJumlahAllDataPesananDetail();


		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/index',$data);
		$this->load->view('templates/footer_after');
		
	}

	public function role() {
		$data['title'] = "Role";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();

		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/role',$data);
		$this->load->view('templates/footer_after');
		
	}

	public function roleAccess($role_id) {
		$data['title'] = "Role Access";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();

		$data['role'] = $this->db->get_where('user_role',['id' => $role_id])->row_array();

		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();


		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/role-access',$data);
		$this->load->view('templates/footer_after');
		
	}


	public function changeAccess() {
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');
		
		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if($result->num_rows() < 1) {
			$this->db->insert('user_access_menu',$data);
		} else {
			$this->db->delete('user_access_menu',$data);
		}

		$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Well done!</strong> Access Changed!
				</div>');
	}

	public function dataanggota() {
		$data['title'] = "Data Pelanggan";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();



		$data['pelanggan'] = $this->grosirmodel->GetAllUserNotAdmin();
		

		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/data-pelanggan',$data);
		$this->load->view('templates/footer_after');
	}


	public function databarang() {
		$data['title'] = "Data Barang";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('kode_produk','Kode Produk','trim|required');
		$this->form_validation->set_rules('nama_produk','Nama Produk','trim|required');
		$this->form_validation->set_rules('stok_produk','Stok','trim|required|numeric');
		$this->form_validation->set_rules('id_satuan','Jenis Satuan','trim|required');
		$this->form_validation->set_rules('id_kategori','Kategori','trim|required');
		$this->form_validation->set_rules('harga_pokok','Harga Pokok','trim|required|numeric');
		$this->form_validation->set_rules('harga_jual','Harga Jual','trim|required|numeric');
		$this->form_validation->set_rules('keterangan','Keterangan','trim|required');

		if($this->form_validation->run() == false ) {
		$data['produks'] = $this->grosirmodel->getAllProductDetail();
		$data['kategori'] = $this->grosirmodel->getAllCategories();
		$data['satuan'] = $this->grosirmodel->getAllSatuan();

		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/data-barang',$data);
		$this->load->view('templates/footer_after');
		} else {
			$data = [
					'kode_produk' => $this->input->post('kode_produk'),
					'nama_produk' => $this->input->post('nama_produk'),
					'stok_produk' => $this->input->post('stok_produk'),
					'id_satuan' => $this->input->post('id_satuan'),
					'id_kategori' => $this->input->post('id_kategori'),
					'harga_pokok' => $this->input->post('harga_pokok'),
					'harga_jual' => $this->input->post('harga_pokok'),
					'keterangan' => $this->input->post('keterangan'),
					'image' => 'noImage.png',
					'date_updated' => time()
		];
		//Cek gambar
			$upload_image = $_FILES['image'];
			if($upload_image == '') {
				$upload_image = 'noImage.png';
				$data['image'] = $upload_image;
			} else {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';
				$config['upload_path'] = './assets/img/product/';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$data['image'] = $new_image;
				} else {
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>'); 
				}
			}
			$this->grosirmodel->InsertData('produk', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Barang Berhasil Ditambahkan!</strong>
				</div>');
			redirect('admin/databarang');
		
		}


		}

		public function pesanan() {
			$data['title'] = "Data Pesanan";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();

		$this->load->model('mpesanan','pesanan');
		$data['pesanan'] = $this->pesanan->getAllDataPesananDetail();
		$data['status'] = $data['user']['grup_pel'];

		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/data-pesanan',$data);
		$this->load->view('templates/footer_after');
		}

		public function changeStatusToProcess($id) {
			
			$id_pemesanan = $id;
			$this->load->model('mpesanan','pesanan');
			$data = $this->pesanan->getOneDataPesanan($id_pemesanan);
			$id_status = 1;
			$this->pesanan->updateStatusPesanan($id_pemesanan, $id_status);		
			
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-info">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Status Changed!</strong> Status Pesanan menjadi sedang diproses 
				</div>');
			redirect('admin/pesanan');

		}


		public function changeStatusToReady($id) {
			
			$id_pemesanan = $id;
			$this->load->model('mpesanan','pesanan');
			$data = $this->pesanan->getOneDataPesanan($id_pemesanan);
			$jumlah = $data['jumlah'];
			$id_produk = $data['id_produk'];
			$id_status = 2;
			$data_produk = $this->pesanan->getDataProduk($id_produk);
			$stok = $data_produk['stok_produk'];
			$hasil = $stok - $jumlah;
			if($hasil < 0) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-warning">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Stok Kurang!</strong> Harap isi stok barang terlebih dahulu
				</div>');
			redirect('admin/pesanan');
			} else {
			$this->pesanan->updateStokProduk($jumlah, $id_produk);				
			$this->pesanan->updateStatusPesanan($id_pemesanan, $id_status);		
			
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-info">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Status Changed!</strong> Pesanan siap ambil mengirim notifikasi ke pelanggan
				</div>');
			redirect('admin/pesanan');
			}

		}

		public function changeStatusToDone($id) {
			
			$id_pemesanan = $id;
			$this->load->model('mpesanan','pesanan');
			$data = $this->pesanan->getOneDataPesanan($id_pemesanan);
			$id_status = 4;
			$this->pesanan->updateStatusPesanan($id_pemesanan, $id_status);		
			
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Status Changed!</strong> Karena produk sudah diambil pelanggan pesanan selesai 
				</div>');
			redirect('admin/pesanan');

		}

		public function changeStatusToPemilik($id) {
			
			$no_pelanggan = $id;
			$this->load->model('mpelanggan','pelanggan');
			$data = $this->pelanggan->getOneDataPelanggan($no_pelanggan);
			$status_pel = "Pemilik Warung";
			$this->pelanggan->updateStatusPelanggan($no_pelanggan, $status_pel);		
			
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Status Changed!</strong> Status Anggota Diubah Jadi Pemilik 
				</div>');
			redirect('admin/dataanggota');

		}

		public function changeStatusToMember($id) {
			
			$no_pelanggan = $id;
			$this->load->model('mpelanggan','pelanggan');
			$data = $this->pelanggan->getOneDataPelanggan($no_pelanggan);
			$status_pel = "Member";
			$this->pelanggan->updateStatusPelanggan($no_pelanggan, $status_pel);		
			
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Status Changed!</strong> Status Anggota Diubah Jadi Member 
				</div>');
			redirect('admin/dataanggota');

		}

	public function historyPesanan() {
		$data['title'] = "History Pesanan";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();

		$this->load->model('mpesanan','pesanan');
		$data['pesanan'] = $this->pesanan->getAllHistoryDataPesananDetail();

		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/history-pesanan',$data);
		$this->load->view('templates/footer_after');
	}

	public function dataKas() {
		$data['title'] = "Data Pendapatan";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();

		$this->load->model('mpesanan','pesanan');
		$data['kas'] = $this->pesanan->getDataPendapatan();

		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/data-kas',$data);
		$this->load->view('templates/footer_after');
	}

	public function editDataBarang($id) {
		$data['title'] = "Edit Data Barang";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->grosirmodel->getAllCategories();
		$data['satuan'] = $this->grosirmodel->getAllSatuan();
		$this->load->model('barang_model');
		$barang = $this->barang_model->GetData("produk","id_produk = '$id'");
		$mainData = array(
				'id_produk' => $barang[0]['id_produk'],
				'kode_produk' => $barang[0]['kode_produk'],
				'nama_produk' => $barang[0]['nama_produk'],
				'image' => $barang[0]['image'],
				'stok_produk' => $barang[0]['stok_produk'],
				'id_satuan' => $barang[0]['id_satuan'],
				'id_kategori' => $barang[0]['id_kategori'],
				'harga_pokok' => $barang[0]['harga_pokok'],
				'harga_jual' => $barang[0]['harga_jual'],
				'keterangan' => $barang[0]['keterangan'],
				'date_updated' => time()
		);
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/edit-data-barang',$mainData);
		$this->load->view('templates/footer_after');
	}

	public function doeditbarang() {
		$id_produk = $_POST['id_produk'];
		$kode_produk = $_POST['kode_produk'];
		$nama_produk = $_POST['nama_produk'];
		$stok_produk = $_POST['stok_produk'];
		$id_satuan = $_POST['id_satuan'];
		$id_kategori = $_POST['id_kategori'];
		$harga_pokok = $_POST['harga_pokok'];
		$harga_jual = $_POST['harga_jual'];
		$keterangan = $_POST['keterangan'];

		$data = [
			'id_produk' => $id_produk,
			'kode_produk' => $kode_produk,
			'nama_produk' => $nama_produk,
			'stok_produk' => $stok_produk,
			'id_satuan' => $id_satuan,
			'id_kategori' => $id_kategori,
			'harga_pokok' => $harga_pokok,
			'harga_jual' => $harga_jual,
			'keterangan' => $keterangan,
			'date_updated' => time()
		];

		$upload_image = $_FILES['image']['name'];
		if($upload_image) {
				$config['upload_path'] = './assets/img/product/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';
		
				$this->load->library('upload',$config);
				if($this->upload->do_upload('image')) {	
				$new_image = $this->upload->data('file_name');
				$data['image'] = $new_image;
				} else if(!$this->upload->do_upload('image')) {
				$data['image'] = 'noimage.png';


				} else {
					echo $this->upload->display_errors();
				}

		}
		$where = ['id_produk' => $id_produk];
		$this->load->model('barang_model','barang');
		$result = $this->barang->updateData('produk',$data,$where);
		if($result >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Produk Telah Diupdate!
				</div>');
				redirect('admin/databarang');
			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Produk Gagal Diupdate
				</div>');
				redirect('admin/editdatabarang/'.$id);
			}


	}

	public function hapusDataBarang($id) {
		$where = array('id_produk' => $id);
	$res = $this->grosirmodel->DeleteData('produk',$where);
	if($res >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Barang Berhasil Dihapus!
				</div>');
				redirect('admin/databarang');


			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Barang Gagal Dihapus!
				</div>');
				redirect('admin/databarang');
			}

	}

	public function category() {
		$data['title'] = "Data Kategori";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('kategori','Kategori','required');

		if($this->form_validation->run() == false ) {
		$this->load->model('mcategory','category');
		$data['kategori'] = $this->category->getAllCategory();
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/data-kategori',$data);
		$this->load->view('templates/footer_after');
	} else {
		$kategori = $this->input->post('kategori');
		$this->load->model('mcategory','category');
		$hasil = $this->category->InsertDataCategory($kategori);
		if ($hasil == TRUE) {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Kategori Berhasil Dibuat!
				</div>');
				redirect('admin/category');
		} else {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Kategori Gagal Dibuat!
				</div>');
				redirect('admin/category');

		}
	}

	}

	public function deleteDataKategori($id) {
		$where = array('id' => $id);
	$this->load->model('mcategory');
	$res = $this->mcategory->DeleteData('kategori',$where);
	if($res >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Kategori Berhasil Dihapus!
				</div>');
				redirect('admin/category');


			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Kategori Gagal Dihapus!
				</div>');
				redirect('admin/category');
			}

	}

	public function datasatuan() {
		$data['title'] = "Data Satuan";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('satuan','Satuan','required');

		if($this->form_validation->run() == false ) {
		$this->load->model('msatuan','satuan');
		$data['satuan'] = $this->satuan->getAllSatuan();
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('admin/data-satuan',$data);
		$this->load->view('templates/footer_after');
	} else {
		$satuan = $this->input->post('satuan');
		$this->load->model('msatuan','satuan');
		$hasil = $this->satuan->InsertDataSatuan($satuan);
		if ($hasil == TRUE) {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Satuan Berhasil Dibuat!
				</div>');
				redirect('admin/datasatuan');
		} else {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Satuan Gagal Dibuat!
				</div>');
				redirect('admin/datasatuan');

		}
	}
	}

	public function deleteDataSatuan($id) {
		$where = array('id' => $id);
	$this->load->model('msatuan');
	$res = $this->msatuan->DeleteData('satuan_produk',$where);
	if($res >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Satuan Berhasil Dihapus!
				</div>');
				redirect('admin/datasatuan');


			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Satuan Gagal Dihapus!
				</div>');
				redirect('admin/datasatuan');
			}

	}


}

	

	

