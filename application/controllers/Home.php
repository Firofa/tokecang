<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {
		$this->goToDefaultPage(); 		
		$data['title'] = 'Tokecang';
		$data['produks'] = $this->grosirmodel->getAllProductDetail();
		$this->load->view('guest/templates/header',$data);
		$this->load->view('guest/index',$data);
		$this->load->view('guest/templates/footer',$data);
	}

	private function goToDefaultPage() {
	  if ($this->session->userdata('role_id') == 1) {
	    redirect('admin');
	  } else if ($this->session->userdata('role_id') == 2) {
	    redirect('user');
	  }
	}

	public function daftar() {
		$this->goToDefaultPage();
		$this->form_validation->set_rules('nama_pelanggan', 'nama_pelanggan', 'required|trim');
		$this->form_validation->set_rules('alamat', 'alamat', 'required|trim');
		$this->form_validation->set_rules('kontak', 'kontak', 'required|trim');
		$this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[pelanggan.username]', [
					'is_unique' => 'Username sudah ada!'
			]);
		$this->form_validation->set_rules('email','email','required|trim|valid_email|is_unique[pelanggan.email]', [
					'is_unique' => 'This Email has already registered!'
			]);
		$this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[8]|matches[password2]' , [
					'matches' => 'Password dont match!',
					'min_length' => 'Password too short!',

			]);
		$this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Halaman Daftar';
			$this->load->view('templates/header',$data);
			$this->load->view('daftar',$data);
			$this->load->view('templates/footer');			
		} else {
			$email = $this->input->post('email', true);
			$data = [
				// true untuk menghindari XSS
				'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan', true)),
				'grup_pel' => 'member',
				'alamat' => htmlspecialchars($this->input->post('alamat', true)),
				'kontak' => htmlspecialchars($this->input->post('kontak', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'email' => htmlspecialchars($email),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];

			//Siapkan Token
			$token = base64_encode(random_bytes(32));
			$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
			
			];


			$this->grosirmodel->RegistData('pelanggan',$data);
			$this->grosirmodel->RegistData('user_token',$user_token);
			
			$this->_sendEmail($token, 'verify');


			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Well done!</strong> Daftar Akun Berhasil! Cek Email Anda Untuk Verifikasi.
				</div>');
			redirect('Home/login');
		}


	}

	private function _sendEmail($token, $type) {
		$this->load->library('email');

        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'firizkismurf@gmail.com';
        $config['smtp_pass'] = 'beruanghibernasi123';
        $config['smtp_port'] = 465;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $this->email->initialize($config);

        $this->email->set_newline("\r\n");		
		
		$this->email->from('firizkismurf@gmail.com','Admin Tokecang');
		$this->email->to($this->input->post('email'));

		if($type == 'verify') {
			$this->email->subject('Verifikasi Pendaftaran Grosir Tokecang');
			$this->email->message('Klik Link ini untuk verifikasi akun anda : <a href="'.base_url().'home/verify?email='.$this->input->post('email').'&token='.urlencode($token).'"> Verifikasi Akun </a>');
		} else if($type == 'forgot') {
			$this->email->subject('Reset Password Grosir Tokecang');
			$this->email->message('Klik Link ini untuk verifikasi akun anda : <a href="'.base_url().'home/resetpassword?email='.$this->input->post('email').'&token='.urlencode($token).'"> Reset Password </a>');
		}
		

		if($this->email->send()){
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}


	}

	public function verify() {
		$email = $this->input->get('email');
		$token = $this->input->get('token');
	
		$user = $this->db->get_where('pelanggan', ['email' => $email])->row_array(); 

		if($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if($user_token) {
				if(time() - $user_token['date_created'] < (60*60*24)) {
					$this->db->set('is_active',1);
					$this->db->where('email',$email);
					$this->db->update('pelanggan');
					$this->db->delete('user_token',['email' => $email]);
					$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Well done!</strong> '.$email.' You successfully activated account! Please Login.
				</div>');
			redirect('Home/login');
				} else {
					$this->db->delete('pelanggan',['email' => $email]);
					$this->db->delete('user_token',['email' => $email]);
					$this->session->set_flashdata('message', 
					'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Oops!</strong> Token Sudah Kadaluarsa!
					</div>');
					redirect('Home/login');
				}
			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Oops!</strong> Verifikasi Akun Gagal Karena Token Salah!
				</div>');
				redirect('Home/login');
			}
		} else {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Oops!</strong> Verifikasi Akun Gagal Karena Email Salah!
				</div>');
			redirect('Home/login');
		}
	} 

	public function login() {	
		$this->goToDefaultPage();	
		$this->form_validation->set_rules('username', 'username', 'required|trim');
		$this->form_validation->set_rules('password','password','trim|required');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Halaman Login';
			$this->load->view('templates/header',$data);
			$this->load->view('login',$data);
			$this->load->view('templates/footer');
		} else {
			$this->_login();
		}
	}

	private function _login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->db->get_where('pelanggan', ['username' => $username] )->row_array();
		//Jika User Ada
		if($user) {
			//Jika User Aktif
			if ($user['is_active'] == 1) {
				//Cek Password
				if(password_verify($password, $user['password'])) {
					$data = [
						'username' => $user['username'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					//Cek Role
					if($user['role_id'] == 1){
						redirect('admin');
		} else {
						redirect('user');
			}
		} else {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Wrong password!</strong>
				</div>');
				redirect('Home/login');
			}
		} else {
		$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>This email has not been activated!</strong>
				</div>');
				redirect('Home/login');
			}


		} else {
		$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Email is not registered!</strong> Please create an account first!
				</div>');
				redirect('Home/login');	
		}

	}

	public function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>You have been logged out!</strong>  Please Come Back Again Later..
				</div>');
			redirect('Home');
	}

	public function blocked() {
		$this->load->view('blocked');
	}

	public function forgotpassword() {

			$this->form_validation->set_rules('email','email','trim|required|valid_email');
			if($this->form_validation->run() == false) {
			$data['title'] = 'Halaman Lupa Password';
			$this->load->view('templates/header',$data);
			$this->load->view('forgot-password');
			$this->load->view('templates/footer');
			} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('pelanggan',['email' => $email, 'is_active' => 1])->row_array();

			if($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token,'forgot');
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Well Done!</strong>  Cek Email Untuk Reset Password..
				</div>');
				redirect('Home/forgotpassword');

			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Oops!</strong>  Email Belum Terdaftar atau Belum Aktif..
				</div>');
				redirect('Home/forgotpassword');
			}
			}
			
	}

	public function resetpassword() {
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('pelanggan',['email' => $email])->row_array();

		if($user) {
			$user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
			if($user_token)  {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();

			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Oops!</strong>  Reset Password Gagal Karena Token Salah!
				</div>');
				redirect('Home/login');	
			}

		} else {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Oops!</strong>  Reset Password Gagal Karena Email Salah!
				</div>');
				redirect('Home/login');
		}
	}

	public function changePassword() {

		if(!$this->session->userdata('reset_email')) {
			redirect('home/login');
		}

		$this->form_validation->set_rules('password1', 'New password', 'required|trim|min_length[8]|matches[password2]' , [
					'matches' => 'Password dont match!',
					'min_length' => 'Password too short!',
			]);
		$this->form_validation->set_rules('password2', 'Confirm new password', 'required|trim|matches[password1]');

			if($this->form_validation->run() == false) {
			$data['title'] = 'Halaman Lupa Password';
			$this->load->view('templates/header',$data);
			$this->load->view('auth/change-password');
			$this->load->view('templates/footer');		
			} else {
				$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
				$email = $this->session->userdata('reset_email');
				$this->db->set('password', $password);
				$this->db->where('email',$email);
				$this->db->update('pelanggan');
				$this->session->unset_userdata('reset_email');
				$this->db->delete('user_token', ['email' => $email]);
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						<strong>Well Done!</strong>  Password Berhasil Diubah! Silahkan Login..
				</div>');
				redirect('Home/login');

			}
	}
}