<?php

class Keperluan extends CI_Controller {

	function __construct(){
    parent::__construct();
    # Load model, helper dan library
	    $this->load->model('m_get');
	    $this->load->model('m_web');
	 }

	function index()
	{
      	if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
	    	$data['jenis'] = "Keperluan";
			$data['judul'] = "Keperluan - Pinjam Barang";
			$data['desc'] = "Mengelola data keperluan inventaris barang.";
			$data['peminjaman'] = $this->m_get->total_peminjaman();
			$data['content'] 	= $this->m_web->read('tbl_keperluan_peminjaman');
			$this->load->view('v_adminweb', $data);
		}
	}
	public function add(){
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
		    $a = strip_tags($this->input->post('ws_keperluan'));
			// Input Array
		    $data = array(
		   		'keperluan_nama' 	=> $a
		   	);

		    // Insert ke Database
		   	$this->m_web->insert('tbl_keperluan_peminjaman', $data);
		   	echo $this->session->set_flashdata(array('msg' => 'tambah', 'flash'=> 'Keperluan'));
		   	redirect(base_url('keperluan'));
		}
	}
	function edit($id)
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
    		// Input
		    $a = strip_tags($this->input->post('ws_keperluan'));
			// Input Array
		    $data = array(
		   		'keperluan_nama' 	=> $a
		   	);
			// Update ke Database
		    $this->m_web->update_keperluan($id, 'tbl_keperluan_peminjaman', $data);
		   	echo $this->session->set_flashdata(array('msg' => 'edit', 'flash'=> 'Keperluan'));
		   	redirect(base_url('keperluan'));
		}
	}
	function delete($id)
	{
		// Menampilkan kode keperluan pada table peminjaman barang
    	$kodeKeperluan 	= $this->m_get->get_data_keperluan1($id);
		$tampil 		= $kodeKeperluan->peminjaman_keperluan;

		// Menampilkan kode keperluan pada table pemakaian barang
    	$a 	= $this->m_get->get_data_keperluan2($id);
		$b 		= $a->pemakaian_keperluan;
		// Semua kode barang yang id supplier = $id
		if($tampil == $id){
			echo $this->session->set_flashdata(array('msg' => 'gagal', 'flash'=> 'Keperluan'));
		   	redirect(base_url('keperluan'));
		} else if($b == $id){
			echo $this->session->set_flashdata(array('msg' => 'gagal', 'flash'=> 'Keperluan'));
		   	redirect(base_url('keperluan'));
		} {
			$this->m_web->delete_keperluan('tbl_keperluan_peminjaman', $id);
			echo $this->session->set_flashdata(array('msg' => 'hapus', 'flash'=> 'Keperluan'));
		   	redirect(base_url('keperluan'));
		}
	}
}
?>