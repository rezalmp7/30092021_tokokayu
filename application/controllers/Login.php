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

		$this->load->model('M_admin');
	}
	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('login');
		$this->load->view('layout/footer');
	}
	function aksi_login()
	{
		$no_hp = $this->input->post("no_hp");
		$pass = $this->input->post("password");
		if($no_hp=="" || $pass=="")
		{
			$this->session->set_flashdata('error', "Data harus diisi");
			redirect(base_url("login?asda"));
		}
		else
		{
			$md_pass = md5($pass);

			$where = array(
				'no_hp' => $no_hp,
				'password' => $md_pass
			);
			
			$cek_login = $this->M_admin->select_where('pelanggan', $where)->num_rows();
			
			if ($cek_login != null) {
				$data_perawat = $this->M_admin->select_where('pelanggan', $where)->result_array();
				foreach($data_perawat as $a)
				{
					$id_user = $a['id'];
					$nama = $a['nama'];
				}
				$data_session = array(
					'status_kayu' => "login_kayu",
					'nama_kayu' => $nama,
					'id_kayu' => $id_user,
				);
				$this->session->set_userdata($data_session);
				
				$this->session->set_flashdata('success', "Berhasil Login");
				redirect(base_url('home'));
			} else {
				$this->session->set_flashdata('error', "Data Pelanggan tidak ditemukan");
				redirect(base_url("login?salah"));
			}
			
		}
	}
	function aksi_daftar()
	{
		$post = $this->input->post();

		$where_cek_nohp = array('no_hp' => $post['no_hp'], );
		$cek_nohp = $this->M_admin->select_where('pelanggan', $where_cek_nohp)->num_rows();

		if($cek_nohp >= 1)
		{
		    $this->session->set_flashdata('error', "No HP telah terdaftar");
			redirect(base_url('login'));
		}
		else {
			if($post['password'] == $post['kpassword'])
			{
				$password = md5($post['password']);
				$max_id = $this->M_admin->select_select('max(id) as max_id', 'pelanggan')->row_array();
				
				if($max_id == null)
				{
				    $id = 1;
				}
				else
				{
				    $id = $max_id['max_id']+1;
				}
				
				$data = array(
					'id' => $id,
					'nama' => $post['nama'],
					'no_hp' => $post['no_hp'],
					'password' => $password,
				);
				$this->M_admin->insert_data('pelanggan', $data); 

				$this->session->set_flashdata('success', "Register Berhasil");
				redirect(base_url("login"));
			}
			else {
			    $this->session->set_flashdata('error', "Password Tidak Sama");
				redirect(base_url('login'));
			}
		}
	}
	function logout()
	{
		
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', "Berhasil Logout dari akun");
		redirect(base_url('login'));
	}
}
