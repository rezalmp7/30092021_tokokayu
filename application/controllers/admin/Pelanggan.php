<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

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
        $data['user'] = $this->M_admin->select_all('pelanggan')->result_array();
		$this->load->view('admin/layout/header');
		$this->load->view('admin/pelanggan', $data);
		$this->load->view('admin/layout/footer');
	}
    public function tambah()
    {
        $this->load->view('admin/layout/header');
		$this->load->view('admin/pelanggan_tambah');
		$this->load->view('admin/layout/footer');
    }
	function upload_foto($nama_file){
		$config['upload_path']          = './assets/img/pelanggan/';
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['file_name']            = $nama_file;
	    $config['overwrite']			= true;
		$config['max_size']             = 1500;
 
		$this->load->library('upload', $config);
        $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('foto')){ 
			$error = $this->upload->display_errors();
			echo $error;
			return 'false';
		}else{
			$data = $this->upload->data('file_name');
			echo $nama_file."<br><pre>";
			print_r($this->upload->data());
			echo "<pre>";
			return $data;
		}
	}
    function tambah_aksi()
    {
        $post = $this->input->post();

        $max_id = $this->M_admin->select_select('max(id) as max_id', 'pelanggan')->row_array();

        if($max_id == null)
        {
            $id = 1;
        }
        else {
            $id = $max_id['max_id']+1;
        }

        $nama_foto = 'foto'.$id;
        $foto = $this->upload_foto($nama_foto);

        if($foto == 'false')
        {
            redirect(base_url('admin/pelanggan/tambah'));
        }
        else {
            $password = md5($post['password']);
            $data = array(
                'id' => $id,
                'nama' => $post['nama'], 
                'no_hp' => $post['no_hp'], 
                'password' => $password, 
                'foto' => $foto
            );
            $this->M_admin->insert_data('pelanggan', $data);

            redirect(base_url('admin/pelanggan'));
        }
    }
    public function edit()
    {
        $get = $this->input->get();

        $where = array('id' => $get['id'] );
        $data['pelanggan'] = $this->M_admin->select_where('pelanggan', $where)->row_array();

        
        $this->load->view('admin/layout/header');
		$this->load->view('admin/pelanggan_edit', $data);
		$this->load->view('admin/layout/footer');
    }
    function edit_aksi()
    {
        $post = $this->input->post();

        $where = array('id' => $post['id'], );
        $select_foto = $this->M_admin->select_where('pelanggan', $where)->row_array();

        $nama_foto = 'foto'.$post['id'];

        if ($_FILES['foto']['size'] != 0) {
            $foto = $this->upload_foto($nama_foto);
        }
        else {
            $foto = $post['foto_lama'];
        }
        
        if($foto == 'false')
        {
            redirect(base_url('admin/pelanggan/edit?id='.$post['id']));
        }
        else {
            if($foto != $select_foto['foto'])
            {
                unlink('./assets/img/pelanggan/'.$select_foto['foto']);
            }
            if($post['password'] == null)
            {
                $password = $post['password_lama'];
            }
            else {
                $password = md5($post['password']);
            }
            
            $set = array(
                'nama' => $post['nama'], 
                'no_hp' => $post['no_hp'], 
                'foto' => $foto, 
                'password' => $password, 
                'nama' => $post['nama'], 
            );
            $this->M_admin->update_data('pelanggan', $set, $where);

            redirect(base_url('admin/pelanggan'));
        }
    }
    function hapus()
    {
        $get = $this->input->get();

        $where = array('id' => $get['id'], );
        $foto = $this->M_admin->select_where('pelanggan', $where)->row_array();
        
        unlink('./assets/img/pelanggan/'.$foto['foto']);

        $this->M_admin->delete_data('pelanggan', $where);

        redirect(base_url('admin/pelanggan'));
    }
}
