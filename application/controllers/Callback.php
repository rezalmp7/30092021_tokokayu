<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Callback extends CI_Controller {

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
        
	}
	public function callback()
    {
		
		$json = file_get_contents("php://input");

		// ambil callback signature
		$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';

		$privatekey = 'lFOCe-owGns-j6F9x-wIqwd-D6zl0'; // input your private key to here
		$apikey = 'DEV-dbBtg4qp0FmdzoCGqIhrf4nKrDv0q4nn2H2bO7bf'; // input your api key to here

		// generate signature untuk dicocokkan dengan X-Callback-Signature
		$signature = hash_hmac('sha256', $json, 'lFOCe-owGns-j6F9x-wIqwd-D6zl0');

		echo $signature;

		$today = date('Y-m-d H:i:s');

		// validasi signature
		if($callbackSignature !== $signature) {
		    exit('Signature tidak valid'); // signature tidak valid, hentikan proses
		} else {
			// Data
			$data = json_decode($json);
			$event = $_SERVER['HTTP_X_CALLBACK_EVENT'];

			print_r($data);

			if($event == 'payment_status'){
			    if($data->status == 'PAID'){
			        // pembayaran sukses, lanjutkan proses sesuai sistem Anda, contoh:
					$where_transaksi = array('ref' => $data->reference, );
					$data_transaksi = $this->M_admin->select_where('transaksi', $where_transaksi)->row_array();

					$set_transaksi = array(
						'status' => '2', 
						'pay_at' => $today,
					);
					$this->M_admin->update_data('transaksi', $set_transaksi, $where_transaksi);

			        $where_pesanan = array('id_transaksi' => $data_transaksi['id'], );
					$data_pesanan = $this->M_admin->select_where('pesanan', $where_pesanan)->result_array();
					
					foreach ($data_pesanan as $a) {
						$where_ukuran = array('id' => $a['id_ukuran'], );
						$where_value = array(
							'id_alternative' => $a['id_produk'],
							'id_criteria' => '3'
						);
						$data_ukuran = $this->M_admin->select_where('ukuran', $where_ukuran)->row_array();
						$data_value = $this->M_admin->select_where('wp_evaluations', $where_value)->row_array();
						 
						$value = $data_value['value']+$a['qty'];
						$set_value = array('value' => $value, );
						$this->M_admin->update_data('wp_evaluations', $set_value, $where_value);

						$stock = $data_ukuran['stock']-$a['qty'];
						$set_stock = array(
							'stock' => $stock, );
						$this->M_admin->update_data('ukuran', $set_stock, $where_ukuran);
					}

			    } elseif($data->status == 'EXPIRED'){
			        // pembayaran expired, lanjutkan proses sesuai sistem Anda, contoh:
					$where_transaksi = array('id' => $data->merchant_ref, );
					$data_transaksi = $this->M_admin->select_where('transaksi', $where_transaksi)->row_array();

					$set_transaksi = array(
						'status' => '6', 
					);
					$this->M_admin->update_data('transaksi', $set_transaksi, $where_transaksi);
			        
			    } elseif($data->status == 'FAILED'){
			        // pembayaran gagal, lanjutkan proses sesuai sistem Anda, contoh:
					$where_transaksi = array('id' => $data->merchant_ref, );
					$data_transaksi = $this->M_admin->select_where('transaksi', $where_transaksi)->row_array();

					$set_transaksi = array(
						'status' => '7', 
					);
					$this->M_admin->update_data('transaksi', $set_transaksi, $where_transaksi);
			        
			    } elseif($data->status == 'REFUND'){
			        // pembayaran dikembalikan, lanjutkan proses sesuai sistem Anda, contoh:
					$where_transaksi = array('id' => $data->merchant_ref, );
					$data_transaksi = $this->M_admin->select_where('transaksi', $where_transaksi)->row_array();

					$set_transaksi = array(
						'status' => '8', 
					);
					$this->M_admin->update_data('transaksi', $set_transaksi, $where_transaksi);
			        
			    }
			}
		}
    }
}
