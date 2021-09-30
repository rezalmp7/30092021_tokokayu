<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        error_reporting(0);
		$data['produk'] = $this->M_admin->select_select_limit('produk.id, produk.foto, produk.nama, produk.kualitas', 'produk', '8')->result_array();

        $data['harga_produk']['max'] = [];
        $data['harga_produk']['min'] = [];

        foreach ($data['produk'] as $a) {
            $data['harga_produk']['max'][$a['id']] = $this->M_admin->select_query("SELECT max(harga) as harga FROM ukuran WHERE id_produk=".$a['id'])->row_array();
            $data['harga_produk']['min'][$a['id']] = $this->M_admin->select_query("SELECT min(harga) as harga FROM ukuran WHERE id_produk=".$a['id'])->row_array();
        }

		$data['produk_terbaru'] = $this->M_admin->select_select_limit_orderBy('produk.id, produk.foto, produk.nama, produk.kualitas', 'produk', '8', 'create_at DESC')->result_array();
        
        $data['harga_produk_terbaru']['max'] = [];
        $data['harga_produk_terbaru']['min'] = [];

        foreach ($data['produk_terbaru'] as $b) {
            $data['harga_produk_terbaru']['max'][$b['id']] = $this->M_admin->select_query("SELECT max(harga) as harga FROM ukuran WHERE id_produk=".$b['id'])->row_array();
            $data['harga_produk_terbaru']['min'][$b['id']] = $this->M_admin->select_query("SELECT min(harga) as harga FROM ukuran WHERE id_produk=".$b['id'])->row_array();
        }
		
        $data['peringkat'] = $this->peringkat();

		$terfavorit = $data['peringkat'];

		$total_peringkat = count($terfavorit);
		$data['total_peringkat'] = $total_peringkat;

		if($total_peringkat <= 5)
        {
            $view = $total_peringkat;
        }
        else {
            $view = 5;
        }

		$o = 1;
		$terfavorit_produk = array();
		for ($i=0; $i < $view; $i++) { 
			$where_produk = array('nama' => $terfavorit[$o], );
			$select_produk = $this->M_admin->select_where('produk', $where_produk)->row_array();

			$terfavorit_produk[] = array(
				'foto' => $select_produk['foto'], 
				'nama' => $select_produk['nama']
			);
			$o++;
		}

		$data['terfavorit_produk'] = $terfavorit_produk;

		$this->load->view('layout/header');
		$this->load->view('home', $data);
		$this->load->view('layout/footer');
	}
	function peringkat()
	{

        error_reporting(E_ALL ^  E_NOTICE);
		$wp_criterias = $this->M_admin->select_all('wp_criterias')->result_array();
		$alternative = $this->M_admin->select_all('produk')->result_array();
		$wp_evaluation = $this->M_admin->select_all('wp_evaluations')->result_array();
		$wp_evaluations_order_by = $this->M_admin->select_query('SELECT * FROM wp_evaluations ORDER BY id_alternative,id_criteria')->result_array();

		// --  Pengambilan Nilai Kriteria
        //-- menyiapkan variable penampung berupa array
        $kriteria=array();
        $bobot=array();
        //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
        foreach ($wp_criterias as $row) {
            $kriteria[$row['id_criteria']]=array($row['criteria'],$row['attribute']);
            $bobot[$row['id_criteria']]=$row['weight']/100;
        }

        //  --  Pengambilan Nilai Alternatif
        //-- menyiapkan variable penampung berupa array
        $alternatif=array();
        //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
        foreach ($alternative as $row) {
            $alternatif[$row['id']]=$row['nama'];
        }

        // -- Pengambilan Nilai Penilaian
        //-- menyiapkan variable penampung berupa array
        $sample=array();
        //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
        foreach ($wp_evaluations_order_by as $row) {
            //-- jika array $sample[$row['id_alternatif']] belum ada maka buat baru
            //-- $row['id_alternatif'] adalah id kandidat/alternatif
            if (!isset($sample[$row['id_alternative']])) {
                $sample[$row['id_alternative']] = array();
            }
            $sample[$row['id_alternative']][$row['id_criteria']] = $row['value'];
        }

        
        $X=$sample;
        
        // -- Membuat Matrik Normalisasi (R)
        //-- inisialisasi array pembagi
        $pembagi=array();
        //-- melakukan iterasi utk setiap kriteria
        foreach($kriteria as $id_kriteria=>$value){
            $pembagi[$id_kriteria]=0;
            //-- melakukan iterasi utk setiap alternatif
            foreach($alternatif as $id_alternatif=>$a_value){
                $pembagi[$id_kriteria]=pow($X[$id_alternatif][$id_kriteria],2);
            }
        }
        //-- inisialisasi matrik Normalisasi R
        $R=array();
        //-- melakukan iterasi utk setiap alternatif
        foreach($X as $id_alternatif=>$a_kriteria) {
            $R[$id_alternatif]=array();
            //-- melakukan iterasi utk setiap kriteria
            foreach($a_kriteria as $id_kriteria=>$nilai){
                $R[$id_alternatif][$id_kriteria]= ($nilai ?: 1)/(sqrt($pembagi[$id_kriteria]) ?: 1);
            }
        }

        // -- Membuat Matrik Normalisasi Terbobot (Y)
        //-- inisialisasi matrik Normalisasi Terbobot Y
        $Y=array();
        //-- melakukan iterasi utk setiap alternatif
        foreach($R as $id_alternatif=>$a_kriteria) {
            $Y[$id_alternatif]=array();
            //-- melakukan iterasi utk setiap kriteria
            foreach($a_kriteria as $id_kriteria=>$nilai){
                $Y[$id_alternatif][$id_kriteria] = $nilai * $bobot[$id_kriteria];
            }
        }   
                                    
        // -- Perhitungan Solusi Ideal (A)
        //-- inisialisasi Solusi Ideal A Positif dan Negatif 
        $A_max=$A_min=array();
        //-- melakukan iterasi utk setiap kriteria
        foreach($kriteria as $id_kriteria=>$a_kriteria) {
            $A_max[$id_kriteria]=0;
            $A_min[$id_kriteria]=100;
            //-- melakukan iterasi utk setiap alternatif
            foreach($alternatif as $id_alternatif=>$nilai){
                if($A_max[$id_kriteria]<$Y[$id_alternatif][$id_kriteria]){
                    $A_max[$id_kriteria] = $Y[$id_alternatif][$id_kriteria];
                }
                if($A_min[$id_kriteria]>$Y[$id_alternatif][$id_kriteria]){
                    $A_min[$id_kriteria] = $Y[$id_alternatif][$id_kriteria];
                };
            }
        }   
                                    
        // -- Perhitungan Jarak Solusi Ideal (D)
        //-- inisialisasi Jarak Solusi Ideal Positif/Negatif
        $D_plus=$D_min=array();
        //-- melakukan iterasi utk setiap alternatif
        foreach($Y as $id_alternatif=>$n_a){
            $D_plus[$id_alternatif]=0;
            $D_min[$id_alternatif]=0;
            //-- melakukan iterasi utk setiap kriteria
            foreach($n_a as $id_kriteria=>$y){
                $D_plus[$id_alternatif]+=pow($y-$A_max[$id_kriteria],2);
                $D_min[$id_alternatif]+=pow($y-$A_min[$id_kriteria],2);
            }
            $D_plus[$id_alternatif]=sqrt($D_plus[$id_alternatif]);
            $D_min[$id_alternatif]=sqrt($D_min[$id_alternatif]);
        }

        //-- inisialisasi variabel array V 
        $V=array();
        //-- melakukan iterasi utk setiap alternatif
        foreach($D_min as $id_alternatif=>$d_min){
            //-- perhitungan nilai Preferensi V dari nilai jarak solusi ideal D
            if($D_plus[$id_alternatif] != 0)
            {
                $DevisionZero = true;
                $V[$id_alternatif] = $d_min/($d_min + $D_plus[$id_alternatif]);
            }
            else {
                $DevisionZero = false;
            }
        }

        if($DevisionZero == true)
        {
                
            // PERANKINGAN
            //--mengurutkan data secara descending dengan tetap mempertahankan key/index array-nya
            arsort($V);
            //-- mendapatkan key/index item array yang pertama
            $index=key($V);
            //-- menampilkan hasil akhir:
            return $alternatif;
        }
        else
        {
		    $alternative = $this->M_admin->select_select('nama', 'produk')->result_array();

            return $alternatif;
        }
	}
}
