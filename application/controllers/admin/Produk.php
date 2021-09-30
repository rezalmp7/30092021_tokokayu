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
        if($this->session->userdata('status_kayu_admin') != "login_kayu_admin")
		{
			$this->session->set_flashdata('error', "Login Terlebih dahulu");
			redirect(base_url("admin/login"));
		}
        $this->load->model('M_admin');
    }
	public function index()
	{
        $produk = $this->M_admin->select_all('produk')->result_array();

        $data['harga_produk']['max'] = [];
        $data['harga_produk']['min'] = [];

        $data['ukuran'] = array();
        foreach ($produk as $a) {
            $where = array('id_produk' => $a['id'], );
            $id_produk = $a['id'];
            $data['ukuran'][$id_produk] = $this->M_admin->select_where('ukuran', $where)->result_array();
            
        }
        $data['produk'] = $produk;
		$this->load->view('admin/layout/header');
		$this->load->view('admin/produk', $data);
		$this->load->view('admin/layout/footer');
	}
    public function tambah()
    {
        $this->load->view('admin/layout/header');
		$this->load->view('admin/produk_tambah');
		$this->load->view('admin/layout/footer');
    }
	function upload_foto($nama_file){
		$config['upload_path']          = './assets/img/produk/';
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

        $max_id = $this->M_admin->select_select('max(id) as max_id', 'produk')->row_array();

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
            redirect(base_url('admin/produk/tambah'));
        }
        else {
            $data = array(
                'id' => $id,
                'nama' => $post['nama'],
                'kualitas' => $post['kualitas'], 
                'keterangan' => $post['keterangan'],
                'foto' => $foto
            );
            $this->M_admin->insert_data('produk', $data);

            $data_batch = array(
                array(
                    'id_alternative' => $id, 
                    'id_criteria' => 1, 
                    'value' => 0, 
                ),
                array(
                    'id_alternative' => $id, 
                    'id_criteria' => 2, 
                    'value' => 0, 
                ),array(
                    'id_alternative' => $id, 
                    'id_criteria' => 3, 
                    'value' => 0, 
                ),array(
                    'id_alternative' => $id, 
                    'id_criteria' => 4, 
                    'value' => 0, 
                ),array(
                    'id_alternative' => $id, 
                    'id_criteria' => 5, 
                    'value' => 0, 
                )
            );
            $this->M_admin->insertBatch('wp_evaluations', $data_batch);

            redirect(base_url('admin/produk'));
        }
    }
    public function edit()
    {
        $get = $this->input->get();

        $where = array('id' => $get['id'] );
        $data['produk'] = $this->M_admin->select_where('produk', $where)->row_array();

        
        $this->load->view('admin/layout/header');
		$this->load->view('admin/produk_edit', $data);
		$this->load->view('admin/layout/footer');
    }
    function edit_aksi()
    {
        $post = $this->input->post();

        $where = array('id' => $post['id'], );
        $select_foto = $this->M_admin->select_where('produk', $where)->row_array();

        $nama_foto = 'foto'.$post['id'];

        if ($_FILES['foto']['size'] != 0)
        {
            unlink('./assets/img/produk/'.$select_foto['foto']);
            $foto = $this->upload_foto($nama_foto);
        }
        else 
        {
            $foto = $post['foto_lama'];
        }
        
        if($foto == 'false')
        {
            redirect(base_url('admin/produk/edit?id='.$post['id']));
        }
        else {

            $set = array(
                'nama' => $post['nama'],
                'kualitas' => $post['kualitas'], 
                'keterangan' => $post['keterangan'],
                'foto' => $foto
            );
            $this->M_admin->update_data('produk', $set, $where);

            redirect(base_url('admin/produk'));
        }
    }
    function hapus()
    {
        $get = $this->input->get();

        $where = array('id' => $get['id'], );
        $where_ukuran = array('id_produk' => $get['id'], );
        $where_wp = array('id_alternative ' => $get['id'], );
        $produk = $this->M_admin->select_where('produk', $where)->row_array();
        if($produk != null)
        {
            $ukuran = $this->M_admin->select_where('ukuran', $where_ukuran)->result_array();
            foreach ($ukuran as $a) {
                $where_list_pkt = array('id_ukuran' => $a['id'], );
                $list_pkt = $this->M_admin->select_where('list_pkt', $where_list_pkt)->row_array();
                $this->M_admin->delete_data('list_pkt', $where_list_pkt);
            }        
                
            unlink('./assets/img/produk/'.$produk['foto']);

            $this->M_admin->delete_data('produk', $where);
            $this->M_admin->delete_data('ukuran', $where_ukuran);
            $this->M_admin->delete_data('wp_evaluations', $where_wp);
        }

        redirect(base_url('admin/produk'));
    }
    function tambah_ukuran()
    {
        $get = $this->input->get();

        $where = array('id' => $get['id_pr'], );
        $data['data_produk'] = $this->M_admin->select_where('produk', $where)->row_array();
        
        $this->load->view('admin/layout/header');
        $this->load->view('admin/ukuran_tambah',$data);
        $this->load->view('admin/layout/footer');
    }
    function ukuran_tambah_aksi()
    {
        $post = $this->input->post();

        $max_id = $this->M_admin->select_select('max(id) as max_id', 'ukuran')->row_array();

        if($max_id != null)
        {
            $id = $max_id['max_id']+1;
        }
        else {
            $id = 1;
        }

        $data = array(
            'id' => $id,
            'id_produk' => $post['id'],
            'ukuran' => $post['ukuran'],
            'stock' => $post['stok'],
            'harga' => $post['harga']
        );

        $this->M_admin->insert_data('ukuran', $data);

        redirect(base_url('admin/produk'));
    }
    public function edit_ukuran()
    {
        $get = $this->input->get();

        $where = array('id' => $get['id_pr'], );
        $data['data_produk'] = $this->M_admin->select_where('produk', $where)->row_array();
        $data['id'] = $get['id'];
        $where_ukuran = array('id' => $get['id'], );
        $data['ukuran'] = $this->M_admin->select_where('ukuran', $where_ukuran)->row_array();

        $this->load->view('admin/layout/header');
        $this->load->view('admin/ukuran_edit', $data);
        $this->load->view('admin/layout/footer');
    }
    function aksi_edit_ukuran()
    {
        $post = $this->input->post();

        $where = array('id' => $post['id'], );

        $set = array(
            'ukuran' => $post['ukuran'],
            'stock' => $post['stok'],
            'harga' => $post['harga']
        );

        $this->M_admin->update_data('ukuran', $set, $where);

        redirect(base_url('admin/produk'));
    }
    function hapus_ukuran()
    {
        $get = $this->input->get();

        $where = array('id' => $get['id'], );
        $where_list = array('id_ukuran' => $get['id'], );
        
        $this->M_admin->delete_data('ukuran', $where);
        $this->M_admin->delete_data('list_pkt', $where_list);

        redirect(base_url('admin/produk'));
    }
    public function comment()
    {
        $get = $this->input->get();

        $where = array('id_produk' => $get['id'], );
        $where_produk = array('id' => $get['id'], );
        
        $data['produk'] = $this->M_admin->select_where('produk', $where_produk)->row_array();
        $data['ulasan'] = $this->M_admin->select_select_where_join_3table_type_orderBy('ulasan.id, ulasan.rating, ulasan.comment, ulasan.comment_at, ulasan.replay, ulasan.replay_at, pelanggan.nama as nama_pelanggan, user.nama', 'ulasan', 'pelanggan', 'ulasan.comment_by = pelanggan.id', 'left', 'user', 'ulasan.replay_by = user.id', 'left', $where, 'comment_at DESC')->result_array();
        $this->load->view('admin/layout/header');
		$this->load->view('admin/comment', $data);
		$this->load->view('admin/layout/footer');
    }
    function update_ulasan()
    {
        $post = $this->input->post();
        $today = date('Y-m-d H:i:s');
        $id_user = $this->session->userdata('id_kayu_admin');

        $where = array('id' => $post['id'], );
        $set = array(
            'replay' => $post['jawaban'],
            'replay_at' => $today,
            'replay_by' =>  $id_user
        );
        $this->M_admin->update_data('ulasan', $set, $where);

        redirect(base_url('admin/produk/comment?id='.$post['id_produk']));
    }
}
