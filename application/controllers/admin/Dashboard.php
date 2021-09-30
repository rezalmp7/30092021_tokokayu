<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		if($this->session->userdata('status_kayu_admin') != "login_kayu_admin")
		{
			$this->session->set_flashdata('error', "Login Terlebih dahulu");
			redirect(base_url("admin/login"));
		}
		$this->load->model("M_admin");
	}
	public function index()
	{
		$data['jumlah_produk'] = $this->M_admin->select_all('produk')->num_rows();
		$data['jumlah_pelanggan'] = $this->M_admin->select_all('pelanggan')->num_rows();
		$data['jumlah_pesanan_selesai'] = $this->M_admin->select_where('transaksi', array('status' => '4'))->num_rows();
		$data['jumlah_pesanan_batal'] = $this->M_admin->select_where('transaksi', array('status' => '7', ))->num_rows();

		$date = date('m');
		$date1 = date('m', strtotime('-1 month'));
		$date2 = date('m', strtotime('-2 month'));
		$date3 = date('m', strtotime('-3 month'));
		$date4 = date('m', strtotime('-4 month'));

		$data['transaksi'] = $this->M_admin->select_query("SELECT * FROM `transaksi` WHERE month(checkout_at) = $date AND status = '4'")->num_rows();
		$data['transaksi1'] = $this->M_admin->select_query("SELECT * FROM `transaksi` WHERE month(checkout_at) = $date1 AND status = '4'")->num_rows();
		$data['transaksi2'] = $this->M_admin->select_query("SELECT * FROM `transaksi` WHERE month(checkout_at) = $date2 AND status = '4'")->num_rows();
		$data['transaksi3'] = $this->M_admin->select_query("SELECT * FROM `transaksi` WHERE month(checkout_at) = $date3 AND status = '4'")->num_rows();
		$data['transaksi4'] = $this->M_admin->select_query("SELECT * FROM `transaksi` WHERE month(checkout_at) = $date4 AND status = '4'")->num_rows();

		$this->load->view('admin/layout/header');
		$this->load->view('admin/dashboard',$data);
		$this->load->view('admin/layout/footer');
	}
}
