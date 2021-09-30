<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Controller {

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

        if($this->session->userdata('status_kayu') != "login_kayu")
        {
            $this->session->set_flashdata('error', "Login Terlebih dahulu");
			redirect(base_url("login"));
        }

		$this->load->model("M_admin");
	}
	public function index()
	{
        $id_pelanggan = $this->session->userdata('id_kayu');
        
        $where_keranjang = array('id_pelanggan' => $id_pelanggan, );
		$data['keranjang'] = $this->M_admin->select_select_where_join_3table_type('produk.foto, produk.nama, ukuran.id as id_ukuran, ukuran.ukuran, ukuran.harga, keranjang.qty, keranjang.id, keranjang.id_produk', 'keranjang', 'produk', 'keranjang.id_produk = produk.id', 'left', 'ukuran', 'keranjang.id_ukuran = ukuran.id', 'left', $where_keranjang)->result_array();
        
        $data['ongkir'] = $this->M_admin->select_all('ongkir')->result_array();

        $data['channel'] = $this->all_channel();

		$this->load->view('layout/header');
		$this->load->view('keranjang', $data);
		$this->load->view('layout/footer');
	}
    function tambah_aksi()
    {
        $post = $this->input->post();
        $id_pelanggan = $this->session->userdata('id_kayu');

        $where_ukuran_stock = array('id' => $post['ukuran'], );
        $select_ukuran_stock = $this->M_admin->select_where('ukuran', $where_ukuran_stock)->row_array();
        
        if($post['qty'] <= $select_ukuran_stock['stock'])
        {
            $where_cek_ukuran_pelanggan = array('id_ukuran' => $post['ukuran'], 'id_pelanggan' => $id_pelanggan );
            $cek_ukuran_pelanggan = $this->M_admin->select_where('keranjang', $where_cek_ukuran_pelanggan)->num_rows();

            if($cek_ukuran_pelanggan >= 1)
            {
                
                $this->session->set_flashdata('error', "Produk yang sama sudah ada di keranjang");
                redirect(base_url("keranjang"));
            }
            else {
                $max_id = $this->M_admin->select_select('max(id) as max_id', 'keranjang')->row_array();
                if($max_id != null)
                {
                    $id = $max_id['max_id']+1;
                }
                else {
                    $id = 1;
                }

                $data = array(
                    'id' => $id,
                    'id_produk' => $post['id_produk'],
                    'id_ukuran' => $post['ukuran'],
                    'id_pelanggan' => $id_pelanggan,
                    'qty' => $post['qty']
                );
                $this->M_admin->insert_data('keranjang', $data);

                $this->session->set_flashdata('success', "Produk berhasil dimasukkan ke keranjang");
                redirect(base_url("keranjang"));
            }
        }
        else {
            $this->session->set_flashdata('error', "Stok Barang Tidak mencukupi");
            redirect(base_url("produk/detail?id=".$post['id_produk']));
        }
    }
    function update_cart()
    {
        $post = $this->input->post();

        $id = $post['id'];

        $i = 0;
        $set = array();
        foreach ($id as $a) {
            $where_cek_kayu = array('id' => $post['id_ukuran'][$i], );
            $cek_kayu = $this->M_admin->select_where('ukuran', $where_cek_kayu)->row_array();
            if($cek_kayu['stock'] < $post['qty'][$i])
            {
                $this->session->set_flashdata('error', "Stok barang kurang");
		        redirect(base_url("keranjang"));
            }
            else {
                
                $set[] = array(
                    'id' => $post['id'][$i],
                    'qty' => $post['qty'][$i]
                );
                $i++;
            }
        }
        $this->M_admin->updateBatch('keranjang', $set, 'id');
        
        $this->session->set_flashdata('success', "Keranjang Berhasil diupdate");
		redirect(base_url("keranjang"));
    }
    function hapus()
    {
        $get = $this->input->get();

        $where = array('id' => $get['id'], );
        $this->M_admin->delete_data('keranjang', $where);

        $this->session->set_flashdata('success', "Produk berhasil dimasukkan ke keranjang");
		redirect(base_url("keranjang"));
    }
    public function checkout()
    {
        $post = $this->input->post();

        $data['post'] = $post;
        $id_pelanggan = $this->session->userdata('id_kayu');
        $where_keranjang = array('id_pelanggan' => $id_pelanggan, );
        $data['keranjang'] = $this->M_admin->select_select_where_join_3table_type('produk.foto, produk.nama, ukuran.id as id_ukuran, ukuran.ukuran, ukuran.harga, keranjang.qty, keranjang.id, keranjang.id_produk', 'keranjang', 'produk', 'keranjang.id_produk = produk.id', 'left', 'ukuran', 'keranjang.id_ukuran = ukuran.id', 'left', $where_keranjang)->result_array();

        $where_wilayah = array('id' => $post['wilayah'], );
        $data['ongkir'] = $this->M_admin->select_where('ongkir', $where_wilayah)->row_array();
        $data['pembayaran'] = $this->channel($post['pembayaran']);

        $id_pelanggan = $this->session->userdata('id_kayu');

        $this->load->view('layout/header');
        $this->load->view('checkout', $data);
        $this->load->view('layout/footer');
    }
    public function wishlist()
    {
        $id_pelanggan = $this->session->userdata('id_kayu');
        $where = array('wishlist.id_pelanggan' => $id_pelanggan, );
        $data['wishlist'] = $this->M_admin->select_select_where_join_2table_type('wishlist.id, produk.id as id_produk, produk.foto, produk.nama, produk.kualitas', 'wishlist', 'produk', 'wishlist.id_produk = produk.id', $where, 'left')->result_array();
        $this->load->view('layout/header');
        $this->load->view('wishlist', $data);
        $this->load->view('layout/footer');
    }
    function tambah_wishlist()
    {
        $get = $this->input->get();
        
        $id_pelanggan = $this->session->userdata('id_kayu');

        $where_cek_kayu = array('id_produk' => $get['id_prd'], );
        $data_cek_kayu = $this->M_admin->select_where('wishlist', $where_cek_kayu)->num_rows();

        if($data_cek_kayu < 1)
        {
            $data = array(
                'id_produk' => $get['id_prd'],
                'id_pelanggan' => $id_pelanggan 
            );

            $this->M_admin->insert_data('wishlist', $data);
            
            $this->session->set_flashdata('success', "Produk berhasil dimasukkan ke daftar suka");
            redirect(base_url("keranjang/wishlist"));
        }
        else {
            $this->session->set_flashdata('error', "Produk Sudah ada di daftar suka");
            redirect(base_url("keranjang/wishlist"));
        }

    }
    function hapus_wishlist()
    {
        $get = $this->input->get();

        $where = array('id' => $get['id'], );
        $this->M_admin->delete_data('wishlist', $where);

        $this->session->set_flashdata('success', "Produk berhasil dihapus dari daftar suka");
        redirect(base_url("keranjang/wishlist"));
    }
    //membuat signature tripay
	function create_signature($merchantRef, $amount)
	{
		$privateKey = 'lFOCe-owGns-j6F9x-wIqwd-D6zl0';
		$merchantCode = 'T5548';
		$merchantRef = $merchantRef;
		$amount = $amount;

		$signature = hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey);

		return $signature;
	}
	public function bayar_aksi()
	{
		$post = $this->input->post();
		$id_pelanggan = $this->session->userdata('id_kayu');

        $where = array('id' => $id_pelanggan, );
        $pelanggan = $this->M_admin->select_where('pelanggan', $where)->row_array();

		$apiKey = 'DEV-dbBtg4qp0FmdzoCGqIhrf4nKrDv0q4nn2H2bO7bf';
		$privateKey = 'lFOCe-owGns-j6F9x-wIqwd-D6zl0';
		$merchantCode = 'T5548';

        $max_id = $this->M_admin->select_select('max(id) as  max_id', 'transaksi')->row_array();

        if($max_id == null)
        {
            $id = 1;
        }
        else {
            $id = $max_id['max_id']+1;
        }

		// $merchantRef = $post['merchantRef'];
		$merchantRef = $id;
		$amount = $post['amount'];

        $produk = null;
        $i = 0;
        foreach ($post['id'] as $a) {
            
            $where_produk = array('id' => $post['id_produk'][$i], );
            $where_ukuran = array('id' => $post['id_ukuran'][$i], );
            $data_produk = $this->M_admin->select_where('produk', $where_produk)->row_array();
            $data_ukuran = $this->M_admin->select_where('ukuran', $where_ukuran)->row_array();

            $produk[] = array(
                'sku'       => 'Kayu',
                'name'      => $data_produk['nama'].' '.$data_ukuran['ukuran'],
                'price'     => $post['harga'][$i],
                'quantity'  => $post['qty'][$i],
            );
            $i++;
        }
        $where_ongkir = array('id' => $post['wilayah'], );
        $data_ongkir = $this->M_admin->select_where('ongkir', $where_ongkir)->row_array();
        $produk[] = array(
            'sku'       => 'Ongkir',
            'name'      => $data_ongkir['nama'],
            'price'     => $data_ongkir['biaya'],
            'quantity'  => '1',
        );
        $json_produk = json_encode($produk);

		$data = [
		'method'            => $post['metode'],
		'merchant_ref'      => $merchantRef,
		'amount'            => $amount,
		'customer_name'     => $pelanggan['nama'],
		'customer_email'    => 'pelanggan@gmail.com',
		'customer_phone'    => $pelanggan['no_hp'],
		'order_items'       => $produk,
		'callback_url'      => base_url('user_panel/dashboard/callback'),
		'return_url'        => base_url('user_panel/dashboard/detail_riwayat_saldo'),
		'expired_time'      => (time()+(24*60*60)), // 24 jam
		'signature'         => $this->create_signature($merchantRef, $amount)
		];
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_FRESH_CONNECT     => true,
		CURLOPT_URL               => "https://tripay.co.id/api-sandbox/transaction/create",
		CURLOPT_RETURNTRANSFER    => true,
		CURLOPT_HEADER            => false,
		CURLOPT_HTTPHEADER        => array(
			"Authorization: Bearer ".$apiKey
		),
		CURLOPT_FAILONERROR       => false,
		CURLOPT_POST              => true,
		CURLOPT_POSTFIELDS        => http_build_query($data)
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		$array_response = json_decode($response);
		$data_response = $array_response->data;

        $where_keranjang = array('id_pelanggan' => $id_pelanggan);
        $this->M_admin->delete_data('keranjang', $where_keranjang);

        $i = 0;
        $data_pesanan = array();
        foreach ($post['id'] as $a) {
            $data_pesanan[] = array(
                'id_produk' => $post['id_produk'][$i],
                'id_ukuran' => $post['id_ukuran'][$i],
                'harga' => $post['harga'][$i],
                'qty' => $post['qty'][$i],
                'id_transaksi' => $id
            );
            $i++;
        }
        $this->M_admin->insertBatch('pesanan', $data_pesanan);

		$data_insert = array(
			'id' => $id,
            'ref' => $data_response->reference,
            'id_pelanggan' => $id_pelanggan,
            'nama_penerima' => $post['nama'],
            'no_hp_penerima' => $post['no_hp'],
            'wilayah' => $post['wilayah'],
            'harga_akhir' => $post['harga_akhir'],
            'exp_pay' => date('Y-m-d H:i:s', strtotime('+1 day')),
            'alamat' => $post['alamat'],
            'metode' => $post['metode'],
            'status' => '1'
		);
		$this->M_admin->insert_data('transaksi', $data_insert);

		redirect(base_url('transaksi/detail?ref='.$data_response->reference));

	}
    //get semua channel pembayaran
	function all_channel()
	{
		$apiKey = 'DEV-dbBtg4qp0FmdzoCGqIhrf4nKrDv0q4nn2H2bO7bf';

		$payload = [
		'code'	=> ''
		];

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_FRESH_CONNECT     => true,
		CURLOPT_URL               => "https://tripay.co.id/api-sandbox/merchant/payment-channel?".http_build_query($payload),
		CURLOPT_RETURNTRANSFER    => true,
		CURLOPT_HEADER            => false,
		CURLOPT_HTTPHEADER        => array(
			"Authorization: Bearer ".$apiKey
		),
		CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		$array_response = json_decode($response, true);
		return $array_response;
	}
	function channel($code)
	{
		$apiKey = 'DEV-dbBtg4qp0FmdzoCGqIhrf4nKrDv0q4nn2H2bO7bf';

		$payload = [
		'code'	=> $code
		];

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_FRESH_CONNECT     => true,
		CURLOPT_URL               => "https://tripay.co.id/api-sandbox/merchant/payment-channel?".http_build_query($payload),
		CURLOPT_RETURNTRANSFER    => true,
		CURLOPT_HEADER            => false,
		CURLOPT_HTTPHEADER        => array(
			"Authorization: Bearer ".$apiKey
		),
		CURLOPT_FAILONERROR       => false
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		$array_response = json_decode($response, true);
		return $array_response;
	}
}
