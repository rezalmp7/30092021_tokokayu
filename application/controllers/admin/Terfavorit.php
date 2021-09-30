<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terfavorit extends CI_Controller {

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
		$data['wp_criterias'] = $this->M_admin->select_all('wp_criterias')->result_array();
		$data['alternative'] = $this->M_admin->select_all('produk')->result_array();
		$data['wp_evaluation'] = $this->M_admin->select_all('wp_evaluations')->result_array();
		$data['wp_evaluations_order_by'] = $this->M_admin->select_query('SELECT * FROM wp_evaluations ORDER BY id_alternative,id_criteria')->result_array();

		$this->load->view('admin/layout/header');
		$this->load->view('admin/terfavorit', $data);
		$this->load->view('admin/layout/footer');
	}
	function criteria_edit_aksi()
	{
		$post = $this->input->post();

		$id = $post['id']; //array of id

		$updateArray = array();

		for($x = 0; $x < sizeof($id); $x++){

			$updateArray[] = array(
				'id_criteria'=>$post['id'][$x],
				'weight' => $post['weight'][$x],
				'attribute' => $post['attribute'][$x]
			);
		}
		$this->M_admin->updateBatch('wp_criterias', $updateArray, 'id_criteria');

		redirect(base_url('admin/terfavorit'));
	}
}
