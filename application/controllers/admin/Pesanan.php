<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

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
        $transaksi = $this->M_admin->select_select_orderBy('*', 'transaksi', 'checkout_at DESC')->result_array();
        $data['transaksi_pembayaran'] = $this->M_admin->select_select_where_orderBy('*', 'transaksi', array('status' => '1', ), 'checkout_at DESC')->result_array();
        $data['transaksi_kirim'] = $this->M_admin->select_select_where_orderBy('*', 'transaksi', array('status' => '2', ), 'checkout_at DESC')->result_array();
        $data['transaksi_selesai'] = $this->M_admin->select_select_where_orderBy('*', 'transaksi', array('status' => '4', ), 'checkout_at DESC')->result_array();

		$data['transaksi'] = $transaksi;

		$this->load->view('admin/layout/header');
		$this->load->view('admin/pesanan', $data);
		$this->load->view('admin/layout/footer');
	}
	public function detail()
	{
		$get = $this->input->get();

		$id_pelanggan = $this->session->userdata('id_kayu');
        $where_transaksi = array('ref' => $get['ref']);
        $transaksi = $this->M_admin->select_where('transaksi', $where_transaksi)->row_array();
        $where_pesanan = array('id_transaksi' => $transaksi['id'], );
        $pesanan = $this->M_admin->select_select_where_join_3table_type('produk.foto, produk.nama, ukuran.id as id_ukuran, ukuran.ukuran, pesanan.harga, pesanan.qty, pesanan.id, pesanan.id_produk', 'pesanan', 'produk', 'pesanan.id_produk = produk.id', 'left', 'ukuran', 'pesanan.id_ukuran = ukuran.id', 'left', $where_pesanan)->result_array();

        $where_ongkir = array('id' => $transaksi['wilayah'], );
        $data = array();
        $data['ongkir'] = $this->M_admin->select_where('ongkir', $where_ongkir)->row_array();

		$data['transaksi'] = $transaksi;
		$data['pesanan'] = $pesanan;

        $apiKey = 'DEV-dbBtg4qp0FmdzoCGqIhrf4nKrDv0q4nn2H2bO7bf';

		$payload = [
			'reference'	=> $get['ref']
		];

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_FRESH_CONNECT     => true,
		CURLOPT_URL               => "https://tripay.co.id/api-sandbox/transaction/detail?".http_build_query($payload),
		CURLOPT_RETURNTRANSFER    => true,
		CURLOPT_HEADER            => false,
		CURLOPT_HTTPHEADER        => array(
			"Authorization: Bearer ".$apiKey
		),
		CURLOPT_FAILONERROR       => false,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		$array_response = json_decode($response);
		$data_response = $array_response->data;
		$data['pembayaran'] = $data_response;


		$this->load->view('admin/layout/header');
		$this->load->view('admin/pesanan_detail', $data);
		$this->load->view('admin/layout/footer');
	}
	function aksi()
	{
		$get = $this->input->get();

		$where_transaksi = array('id' => $get['id'], );

		$today = date('Y-m-d H:i:s');

		switch ($get['status']) {
			case '3':
				$set_transaksi = array(
					'status' => $get['status'], 
					'send_at' => $today
				);
				break;
			case '4':
				$set_transaksi = array(
					'status' => $get['status'], 
					'done_at' => $today
				);
				break;
			case '5':
				$set_transaksi = array(
					'status' => $get['status'], 
					'return_at' => $today
				);
				break;
			default:
				redirect(base_url('admin/pesanan'));
				break;
		}

		$this->M_admin->update_data('transaksi', $set_transaksi, $where_transaksi);

		$this->session->set_flashdata('success', "Pesanan Berhasil diupdate");
		redirect(base_url('admin/pesanan'));

	}
}
