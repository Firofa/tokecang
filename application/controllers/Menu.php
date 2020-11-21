<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_logged_in();
	}

	public function index() {
		$data['title'] = "Menu Management";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu','Menu','trim|required');

		if($this->form_validation->run() == false) {
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('menu/index',$data);
		$this->load->view('templates/footer_after');
	} else {
		$this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Menu Added</div>');
		redirect('menu');

		
	}
	}

	public function subMenu() {
		$data['title'] = "Sub Menu Management";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();
		$this->load->model('menu_model','menu');
		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title','Title','trim|required');
		$this->form_validation->set_rules('menu_id','Menu','trim|required');
		$this->form_validation->set_rules('url','URL','trim|required');
		$this->form_validation->set_rules('icon','Icon','trim|required');

		if($this->form_validation->run() == false ) {
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('menu/subMenu',$data);
		$this->load->view('templates/footer_after');
	} else {
		$data = [
					'title' => $this->input->post('title'),
					'menu_id' => $this->input->post('menu_id'),
					'url' => $this->input->post('url'),
					'icon' => $this->input->post('icon'),
					'is_active' => $this->input->post('is_active')
		];
		$this->db->insert('user_sub_menu', $data);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Sub Menu Added</div>');
		redirect('menu/submenu');


	}
}

public function editMenu($id) {
		$data['title'] = "Edit Menu";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();
		$this->load->model('menu_model');
		$menu = $this->menu_model->GetData("user_menu","id = '$id'");
		$mainData = array(
			'id' => $menu[0]['id'],
			'menu' => $menu[0]['menu']
		);
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('menu/edit-menu',$mainData);
		$this->load->view('templates/footer_after');
	}

	public function doEditMenu() {
		$id = $_POST['id'];
		$menu = $_POST['menu'];

		$data = [
			'id' => $id,
			'menu' => $menu
			];
		$where = ['id' => $id];
		$this->load->model('menu_model');
		$result = $this->menu_model->updateData('user_menu',$data,$where);
		if($result >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Menu Has Been Updated
				</div>');
				redirect('menu');
			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Update menu failed!
				</div>');
				redirect('menu/editmenu/'.$id);
			}
	}

	public function hapus_menu($id) {
	$where = array('id' => $id);
	$this->load->model('menu_model');
	$res = $this->menu_model->DeleteData('user_menu',$where);
	if($res >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Menu has been Deleted!
				</div>');
				redirect('menu');


			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Delete menu failed!
				</div>');
				redirect('menu');
			}

	} 

	public function editSubMenu($id) {
		$data['title'] = "Edit Sub Menu";
		$data['user'] = $this->db->get_where('pelanggan', [
			'username' => $this->session->userdata('username')])->row_array();;
		$this->load->model('menu_model','menu');

		$subMe = $this->menu->getSubMenuWhere("`id` = $id");
		$this->load->view('templates/header_after',$data);
		$this->load->view('templates/sidebar_after',$data);
		$this->load->view('templates/topbar_after',$data);
		$this->load->view('menu/edit-sub-menu',$subMe);
		$this->load->view('templates/footer_after');
	

	}

	public function hapus_sub_menu($id) {
		$where = array('id' => $id);
		$this->load->model('menu_model');
	$res = $this->menu_model->DeleteData('user_sub_menu',$where);
	if($res >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Sub Menu has been Deleted!
				</div>');
				redirect('menu/submenu');


			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Deleted Sub menu failed!
				</div>');
				redirect('menu/submenu');
			}
	}

	public function doEditSubMenu() {
		$this->form_validation->set_rules('id','Id','required');
		$this->form_validation->set_rules('menu_id','Menu Id','required|trim|numeric');
		$this->form_validation->set_rules('url','URL','required|trim');
		$this->form_validation->set_rules('icon','Icon','required');
		$this->form_validation->set_rules('is_active','Is Active','required');

		$id = $_POST['id'];
		$menu_id = $_POST['menu_id'];
		$title = $_POST['title'];
		$url = $_POST['url'];
		$icon = $_POST['icon'];
		$is_active = $_POST['is_active'];

		$data = [
			'id' => $id,
			'menu_id' => $menu_id,
			'title' => $title,
			'url' => $url,
			'icon' => $icon,
			'is_active' => $is_active,
			];
		$where = ['id' => $id];
		$this->load->model('menu_model');
		$result = $this->menu_model->updateData('user_sub_menu',$data,$where);
		if($result >= 1) {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-success">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Sub Menu Has Been Updated
				</div>');
				redirect('menu/submenu');
			} else {
				$this->session->set_flashdata('message', 
				'<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  						Update sub menu failed!
				</div>');
				redirect('menu/editsubmenu/'.$id);
			}
		

	}

}