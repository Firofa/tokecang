<?php 	

function is_logged_in() {

	$tokecang = get_instance(); // untuk memanggil library CI di dalam function ini karena helper tidak termasuk ke kerangka MVC
	if(!$tokecang->session->userdata('username')) {
		redirect('Home/login');
	} else {
		$role_id = $tokecang->session->userdata('role_id');
		$menu = $tokecang->uri->segment(1);
		$queryMenu = $tokecang->db->get_where('user_menu', ['menu' => $menu])->row_array();
		$menu_id = $queryMenu['id'];
		$user_access = $tokecang->db->get_where('user_access_menu', [
			'role_id' => $role_id,
			'menu_id' => $menu_id ]);
		if($user_access->num_rows()<1){
			redirect('Home/blocked');
		}
	}


}

function check_access($role_id,$menu_id) {
	$tokecang = get_instance();

	$tokecang->db->where('role_id', $role_id);
	$tokecang->db->where('menu_id', $menu_id);
	$result = $tokecang->db->get('user_access_menu');

	if($result->num_rows() > 0) {
		return "checked = 'checked'";
	}
}


?>