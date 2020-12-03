<?php

class Home extends CI_Controller {

	function __construct(){
    parent::__construct();
    # Load model, helper dan library
    	$this->load->model('m_get');
	    $this->load->model('m_web');
	 }

	public function index()
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
			$data['jenis'] 		= "Beranda";
			$data['judul'] 		= "Beranda - Pinjam Barang";
			$data['desc'] 		= "Selamat datang di aplikasi pinjam barang";
			$data['barang'] 	= $this->m_get->total_barang();
			$data['user'] 		= $this->m_get->total_user();
			$data['peminjaman'] = $this->m_get->total_peminjaman();
			$this->load->view('v_adminweb', $data);
		}
	}
}
