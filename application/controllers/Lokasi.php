<?php
 
class Lokasi extends CI_Controller {

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
	    	$data['jenis'] = "Lokasi";
			$data['judul'] = "Lokasi - Pinjam Barang";
			$data['desc'] = "Mengelola data keperluan inventaris barang.";
			$data['peminjaman'] = $this->m_get->total_peminjaman();
			$data['content'] 	= $this->m_web->read('tbl_lokasi_ruangan');
			$this->load->view('v_adminweb', $data);
		}
	}
	public function add(){
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
			$a = strip_tags($this->input->post('ws_lokasi'));
			$b = strip_tags($this->input->post('ws_ruangan_gedung'));
			// Input Array
		    $data = array(
				   'lokasi_nama' 	=> $a,
				   'ruangan_gedung' => $b,
		   	);

		    // Insert ke Database
		   	$this->m_web->insert('tbl_lokasi_ruangan', $data);
		   	echo $this->session->set_flashdata(array('msg' => 'tambah', 'flash'=> 'Lokasi'));
		   	redirect(base_url('lokasi'));
		}
	}
	function edit($id)
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
    		// Input
			$a = strip_tags($this->input->post('ws_lokasi'));
			$b = strip_tags($this->input->post('ws_ruangan_gedung'));
			// Input Array
		    $data = array(
				   'lokasi_nama' 	=> $a,
				   'ruangan_gedung' => $b
		   	);
			// Update ke Database
		    $this->m_web->update_lokasi($id, 'tbl_lokasi_ruangan', $data);
		   	echo $this->session->set_flashdata(array('msg' => 'edit', 'flash'=> 'Lokasi'));
		   	redirect(base_url('lokasi'));
		}
	}
	function delete($id)
	{
		if($this->session->userdata('user_level') != 45){ 
			$this->cek();
	  } else {
			$this->m_web->delete_lokasi('tbl_lokasi_ruangan', $id);
			echo $this->session->set_flashdata(array('msg' => 'hapus', 'flash'=> 'Lokasi'));
			redirect(base_url('lokasi'));
	  }
		
	}
}
?>