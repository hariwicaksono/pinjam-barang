<?php

class Jaminan extends CI_Controller {

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
	    	$data['jenis'] = "Jaminan";
			$data['judul'] = "Jaminan - Pinjam Barang";
			$data['desc'] = "Mengelola data jaminan.";
			$data['peminjaman'] = $this->m_get->total_peminjaman();
			$data['content'] 	= $this->m_web->read('tbl_jaminan_peminjaman');
			$this->load->view('v_adminweb', $data);
		}
	}
	public function add(){
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
		    $a = strip_tags($this->input->post('ws_jaminan'));
			// Input Array
		    $data = array(
		   		'jaminan_nama' 	=> $a
		   	);

		    // Insert ke Database
		   	$this->m_web->insert('tbl_jaminan_peminjaman', $data);
		   	echo $this->session->set_flashdata(array('msg' => 'tambah', 'flash'=> 'Jaminan'));
		   	redirect(base_url('jaminan'));
		}
	}
	function edit($id)
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
    		// Input
		    $a = strip_tags($this->input->post('ws_jaminan'));
			// Input Array
		    $data = array(
		   		'jaminan_nama' 	=> $a
		   	);
			// Update ke Database
		    $this->m_web->update_jaminan($id, 'tbl_jaminan_peminjaman', $data);
		   	echo $this->session->set_flashdata(array('msg' => 'edit', 'flash'=> 'Jaminan'));
		   	redirect(base_url('jaminan'));
		}
	}
	function delete($id)
	{
		// Menampilkan kode jaminan pada table peminjaman barang
    	$kodeJaminan 	= $this->m_get->get_data_jaminan($id);
		$tampil 		= $kodeJaminan->peminjaman_jaminan;
		// Semua kode barang yang id supplier = $id
		if($tampil == $id){
			echo $this->session->set_flashdata(array('msg' => 'gagal', 'flash'=> 'Jaminan'));
		   	redirect(base_url('jaminan'));
		} else {
			$this->m_web->delete_jaminan('tbl_jaminan_peminjaman', $id);
			echo $this->session->set_flashdata(array('msg' => 'hapus', 'flash'=> 'Jaminan'));
		   	redirect(base_url('jaminan'));
		}
	}
}
?>