<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
        $this->load->model('M_admin');
    }
	public function index()
	{
        $data['user'] = $this->M_admin->select_all('user')->result_array();
		$this->load->view('admin/layout/header');
		$this->load->view('admin/user', $data);
		$this->load->view('admin/layout/footer');
	}
    public function tambah()
    {
        $this->load->view('admin/layout/header');
		$this->load->view('admin/user_tambah');
		$this->load->view('admin/layout/footer');
    }
    function tambah_aksi()
    {
        $post = $this->input->post();

        $max_id = $this->M_admin->select_select('max(id) as max_id', 'user')->row_array();
        if($max_id == null)
        {
            $id = 1;
        }
        else {
            $id = $max_id['max_id']+1;
        }

        $password = md5($post['password']);

        $data = array(
            'id' => $id,
            'username' => $post['username'],
            'password' => $password,
            'nama' => $post['nama'], 
        );
        $this->M_admin->insert_data('user', $data);

        redirect(base_url('admin/user'));
    }
    public function edit()
    {
        $get = $this->input->get();

        $where = array('id' => $get['id'] );
        $data['user'] = $this->M_admin->select_where('user', $where)->row_array();

        
        $this->load->view('admin/layout/header');
		$this->load->view('admin/user_edit', $data);
		$this->load->view('admin/layout/footer');
    }
    function edit_aksi()
    {
        $post = $this->input->post();

        if($post['password'] == null)
        {
            $password = $post['password_lama'];
        }
        else {
            $password = md5($post['password']);
        }
        
        $where = array('id' => $post['id'], );
        $set = array(
            'username' => $post['username'], 
            'password' => $password, 
            'nama' => $post['nama'], 
        );
        $this->M_admin->update_data('user', $set, $where);

        redirect(base_url('admin/user'));
    }
    function hapus()
    {
        $get = $this->input->get();

        $where = array('id' => $get['id'], );
        $this->M_admin->delete_data('user', $where);

        redirect(base_url('admin/user'));
    }
}
