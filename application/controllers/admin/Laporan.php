<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
		$where_laporan = array('status' => '4', );
		$data['transaksi'] = $this->M_admin->select_select_where_orderBy('*', 'transaksi', $where_laporan, 'checkout_at DESC')->result_array();

		$transaksi = $data['transaksi'];
        
        $pesanan = [];
		foreach ($transaksi as $a) {
			$where_pesanan = array('id_transaksi' => $a['id'], );
			$pesanan[$a['id']] = $this->M_admin->select_select_where_join_3table_type('produk.foto, produk.nama, ukuran.id as id_ukuran, ukuran.ukuran, pesanan.harga, pesanan.qty, pesanan.id, pesanan.id_produk', 'pesanan', 'produk', 'pesanan.id_produk = produk.id', 'left', 'ukuran', 'pesanan.id_ukuran = ukuran.id', 'left', $where_pesanan)->result_array();
		}

		$data['pesanan'] = $pesanan;


		$this->load->view('admin/layout/header');
		$this->load->view('admin/laporan', $data);
		$this->load->view('admin/layout/footer');
	}
	public function cetak()
	{
		$where_laporan = array('status' => '4', );
		$data['transaksi'] = $this->M_admin->select_select_where_orderBy('*', 'transaksi', $where_laporan, 'checkout_at DESC')->result_array();

		$transaksi = $data['transaksi'];

		foreach ($transaksi as $a) {
			$where_pesanan = array('id_transaksi' => $a['id'], );
			$pesanan[$a['id']] = $this->M_admin->select_select_where_join_3table_type('produk.foto, produk.nama, ukuran.id as id_ukuran, ukuran.ukuran, pesanan.harga, pesanan.qty, pesanan.id, pesanan.id_produk', 'pesanan', 'produk', 'pesanan.id_produk = produk.id', 'left', 'ukuran', 'pesanan.id_ukuran = ukuran.id', 'left', $where_pesanan)->result_array();
		}

		$data['pesanan'] = $pesanan;


		$this->load->view('admin/laporan_cetak', $data);
	}
}
