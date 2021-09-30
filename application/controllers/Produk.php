<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

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
		$data['produk'] = $this->M_admin->select_all('produk')->result_array();

		$data['harga_produk']['max'] = [];
		$data['harga_produk']['min'] = [];

		foreach ($data['produk'] as $a) {
			$data['harga_produk']['max'][$a['id']] = $this->M_admin->select_query("SELECT max(harga) as harga FROM ukuran WHERE id_produk=".$a['id'])->row_array();
            $data['harga_produk']['min'][$a['id']] = $this->M_admin->select_query("SELECT min(harga) as harga FROM ukuran WHERE id_produk=".$a['id'])->row_array();
		}

		$this->load->view('layout/header');
		$this->load->view('produk', $data);
		$this->load->view('layout/footer');
	}
    public function detail()
    {
		$get = $this->input->get();

		$where_value = array(
			'id_alternative ' => $get['id'],
			'id_criteria' => '4' 
		);
		$data_value = $this->M_admin->select_where('wp_evaluations', $where_value)->row_array();
		if($data_value != null)
		{
			$set_value = array(
				'value' => $data_value['value']+1, 
			);
			$this->M_admin->update_data('wp_evaluations', $set_value, $where_value);
		}


		$data['rating'] = $this->M_admin->select_select('AVG(rating) as rating', 'ulasan')->row_array();

		$where = array('id' => $get['id'], );
		$where_ukuran = array('id_produk' => $get['id'], );
		$data['produk'] = $this->M_admin->select_where('produk', $where)->row_array();
		$data['ukuran'] = $this->M_admin->select_where('ukuran', $where_ukuran)->result_array();
		$data['produk_terbaru'] = $this->M_admin->select_select_limit_orderBy('produk.id, produk.foto, produk.nama, produk.kualitas', 'produk', '8', 'create_at DESC')->result_array();

		$where_ulasan = array('id_produk' => $get['id'], );
		$data['ulasan'] = $this->M_admin->select_select_where_join_3table_type_orderBy('ulasan.rating, ulasan.comment, ulasan.comment_at, ulasan.replay, ulasan.replay_at, pelanggan.nama as nama_pelanggan, user.nama', 'ulasan', 'pelanggan', 'ulasan.comment_by = pelanggan.id', 'left', 'user', 'ulasan.replay_by = user.id', 'left', $where_ulasan, 'comment_at DESC')->result_array();

		$this->load->view('layout/header');
		$this->load->view('produk_detail', $data);
		$this->load->view('layout/footer');
    }
	function tambah_rating()
	{
		$post = $this->input->post();

		$id_pelanggan = $this->session->userdata('id_kayu');

		$max_id = $this->M_admin->select_select('max(id) as max_id', 'ulasan')->row_array();

		if($max_id == null)
		{
			$id = 1;
		}
		else {
			$id = $max_id['max_id']+1;
		}

		$where_rating = array(
			'id_alternative ' => $post['id_produk'],
			'id_criteria' => '1' 
		);
		$where_comment = array(
			'id_alternative ' => $post['id_produk'],
			'id_criteria' => '2' 
		);
		$data_rating = $this->M_admin->select_where('wp_evaluations', $where_rating)->row_array();
		$data_comment = $this->M_admin->select_where('wp_evaluations', $where_comment)->row_array();

		$set_rating = array(
			'value' => $data_rating['value']+$post['rating'], 
		);
		$set_comment = array(
			'value' => $data_comment['value']+1, 
		);

		$this->M_admin->update_data('wp_evaluations', $set_rating, $where_rating);
		$this->M_admin->update_data('wp_evaluations', $set_comment, $where_comment);

		$data = array(
			'id' => $id,
			'id_produk' => $post['id_produk'],
			'rating' => $post['rating'],
			'comment' => $post['ulasan'],
			'comment_by' => $id_pelanggan
		);
		$this->M_admin->insert_data('ulasan', $data);

		redirect(base_url('produk/detail?id='.$post['id_produk']));
	}
}
