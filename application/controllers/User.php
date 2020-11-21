<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_logged_in();
	}

	public function index() {
		$data['title'] = "My Profile";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('user/index',$data);
		$this->load->view('templates/footer_after');
		
	}

	public function edit() {
		$data['title'] = "Edit Profile";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('nama_pelanggan','Full Name','required|trim');
		$this->form_validation->set_rules('alamat','Alamat','required|trim');
		$this->form_validation->set_rules('kontak','Kontak','required|trim|numeric|min_length[10]');


		if($this->form_validation->run() == false ) {
			$this->load->view('templates/header_after',$data);
			$this->load->view('templates/sidebar_after',$data);
			$this->load->view('templates/topbar_after',$data);
			$this->load->view('user/edit',$data);
			$this->load->view('templates/footer_after');			
		} else {
			$nama_pelanggan = $this->input->post('nama_pelanggan');
			$alamat = $this->input->post('alamat');
			$email = $this->input->post('email');
			$kontak = $this->input->post('kontak');

			//cek jika ada gambar yang akan di upload
			$upload_image = $_FILES['image']['name'];

			if($upload_image) {
				$config['upload_path'] = './assets/img/profiles/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['user']['image'];
					if($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/img/profiles/'.$old_image);
					}


					$new_image = $this->upload->data('file_name');
					$this->db->set('image',$new_image);
				} else {
					echo $this->upload->display_errors();
				}

			}

			$this->db->set('nama_pelanggan',$nama_pelanggan);
			$this->db->set('alamat',$alamat);
			$this->db->set('kontak',$kontak);
			$this->db->where('email', $email);
			$this->db->update('pelanggan');

			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Well done!</strong> Profile anda sudah di update!
				</div>');
			redirect('user');
		}
	}

	public function changepassword() {
		$data['title'] = "Change Password";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('currentPassword','Current password','required|trim');
		$this->form_validation->set_rules('new_password1', 'New password', 'required|trim|min_length[8]|matches[new_password2]' , [
					'matches' => 'Password dont match!',
					'min_length' => 'Password too short!',
			]);
		$this->form_validation->set_rules('new_password2', 'Confirm new password', 'required|trim|matches[new_password1]');

		if ($this->form_validation->run() == false) {
			
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('user/ubahpassword',$data);
		$this->load->view('templates/footer_after');
		
		} else {

		$currentPassword = $this->input->post('currentPassword');
		$newPassword = $this->input->post('new_password1');
		if(!password_verify($currentPassword, $data['user']['password'])) {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Oops!</strong> Password Lama Salah!
				</div>');
			redirect('user/changepassword');
		} else {
			if($currentPassword	== $newPassword) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-warning">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Oops!</strong> Password Lama Dan Baru Tidak Boleh Sama!
				</div>');
				redirect('user/changepassword');
			} else {
				$password_hash = password_hash($newPassword,PASSWORD_DEFAULT);
				$this->db->set('password',$password_hash);
				$this->db->where('email',$this->session->userdata('email'));
				$this->db->update('pelanggan');

				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Well Done!</strong> Password Berhasil Diubah!
				</div>');
			redirect('user/changepassword');
			}
		}

		}
	}


}