<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->model("M_admin");
	}
	public function index()
	{
		$this->load->view('admin/login');
	}
	function aksi_login()
	{
		$username = $this->input->post("username");
		$pass = $this->input->post("password");
		if($username=="" || $pass=="")
		{
			$this->session->set_flashdata('error', "Data harus diisi");
			redirect(base_url("login?asda"));
		}
		else
		{
			$md_pass = md5($pass);

			$where = array(
				'username' => $username,
				'password' => $md_pass
			);
			
			$cek_login = $this->M_admin->select_where('user', $where)->num_rows();
			
			if ($cek_login != null) {
				$data_user = $this->M_admin->select_where('user', $where)->result_array();
				foreach($data_user as $a)
				{
					$id_user = $a['id'];
					$nama = $a['nama'];
				}
				$data_session = array(
					'status_kayu_admin' => "login_kayu_admin",
					'nama_kayu_admin' => $nama,
					'id_kayu_admin' => $id_user,
				);
				$this->session->set_userdata($data_session);
				
				$this->session->set_flashdata('success', "Berhasil Login");
				redirect(base_url('admin/dashboard'));
			} else {
				$this->session->set_flashdata('error', "Data Pelanggan tidak ditemukan");
				redirect(base_url("admin/login?salah"));
			}
			
		}
	}
	function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', "Berhasil Logout dari akun");
		redirect(base_url('admin/login'));
	}
}
