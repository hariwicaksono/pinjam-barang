<?php

class Pemakaian extends CI_Controller {

	function __construct(){
    parent::__construct();
    # Load model, helper dan library
	    $this->load->model('m_get');
	    $this->load->model('m_web');
	    $this->load->library('upload');
	    $this->load->library('PHPExcel');
	 }

	function index()
	{
      	if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
	    	$data['jenis'] = "Pemakaian Barang";
			$data['judul'] = "Pemakaian Barang - Pinjam Barang";
			$data['desc'] = "Mengelola data pemakaian barang.";
			$data['peminjaman'] = $this->m_get->total_peminjaman();
			$data['content'] 	= $this->m_web->join4();
			$data['content2'] 	= $this->m_web->read('tbl_barang');
			$data['content4'] 	= $this->m_web->read('tbl_keperluan_peminjaman');
			$this->load->view('v_adminweb', $data);
		}
	}
	public function export()
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
    		$tgl_awal 	= date('d-m-Y', strtotime($this->input->post('tgl_awal')));
    		$tgl_akhir 	= date('d-m-Y', strtotime($this->input->post('tgl_akhir')));
    		$tgl_awal_baru 	= tgl_indo($this->input->post('tgl_awal'));
    		$tgl_akhir_baru 	= tgl_indo($this->input->post('tgl_akhir'));

    		error_reporting(E_ALL);
			ini_set('display_errors', TRUE);
			ini_set('display_startup_errors', TRUE);
			date_default_timezone_set('Europe/London');

			if (PHP_SAPI == 'cli')
				die('This example should only be run from a Web Browser');

	    	// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();


			// Add some data
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'LAPORAN PEMAKAIAN BARANG HABIS PAKAI')
						->setCellValue('A2', 'No')
						->setCellValue('B2', 'Kode Pakai')
						->setCellValue('C2', 'Nama Barang')
						->setCellValue('D2', 'Tanggal Pakai')
						->setCellValue('E2', 'Jumlah Pakai')
						->setCellValue('F2', 'Keperluan')
						->setCellValue('G2', 'Deskripsi');

			$data = $this->m_web->join7();
			$no = 1;
			$brs = 3;
			foreach ($data->result_array() as $i) {

				$tgl = tgl_indo($i['pemakaian_tgl']);
				
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$brs, $no)
					->setCellValue('B'.$brs, $i['pemakaian_kode'])
					->setCellValue('C'.$brs, $i['barang_nama'])
					->setCellValue('D'.$brs, $tgl)
					->setCellValue('E'.$brs, $i['pemakaian_jml'])
					->setCellValue('F'.$brs, $i['keperluan_nama'])
					->setCellValue('G'.$brs, $i['pemakaian_deskripsi']);
									
				$brs++;
				$no++;
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Simple');


			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);


			/*// Save Excel 2007 file
			$callStartTime = microtime(true);

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$acak = rand(00,99);
			$objWriter->save("../../file/laporan_all_kategori_$acak.xlsx");
			$callEndTime = microtime(true);
			$callTime = $callEndTime - $callStartTime;*/
			$acak = rand(00,99);
			$jam = date('H:i:s');
			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="laporan-pemakaian-barang-'.$acak.'.xlsx"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
			
			if($objWriter) {
				echo $this->session->set_flashdata(array('msg' => 'export', 'flash'=> 'Pemakaian Barang'));
		   		redirect(base_url('pemakaian'));
			} else {
				echo "maumu apa?";
			}
		}
	}
	public function add(){
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
		    $a = rand(111111, 999999);
			$b = strip_tags($this->input->post('ws_kode'));
			$c = strip_tags($this->input->post('ws_jumlah'));
			$d = date('Y-m-d', strtotime($this->input->post('ws_tgl')));
			$e = strip_tags($this->input->post('ws_keperluan'));
			$f = $this->input->post('ws_deskripsi');

			$l_jml_barang 	= $this->m_web->read_barang($b);
			$t_jml_barang	= $l_jml_barang->barang_jml;

			if($jumlah_pakai > $t_jml_barang){
				echo $this->session->set_flashdata(array('msg' => 'gagal-stok', 'flash'=> 'Pemakaian Barang'));
		   		redirect(base_url('pemakaian'));
			} else {

				$data = array(
					'pemakaian_kode' 		=> $a,
					'barang_kode' 			=> $b,
					'pemakaian_jml' 		=> $c,
					'pemakaian_tgl' 		=> $d,
					'pemakaian_keperluan' 	=> $e,
					'pemakaian_deskripsi' 	=> $f
				);
				// Insert data
				$this->m_web->insert('tbl_pemakaian_barang', $data);
				// Kurangi stok barang
				$total_jml_barang = $t_jml_barang-$jumlah_pakai;
				// Update stok barang
				$upd_data = array(
					'barang_jml' => $total_jml_barang 
				);
				$this->m_web->update_stok_barang($kd_barang, 'tbl_barang', $upd_data);
				// Redirect
				echo $this->session->set_flashdata(array('msg' => 'tambah', 'flash'=> 'Pemakaian Barang'));
		   		redirect(base_url('pemakaian'));
			}
		}
	}
	function edit($kode)
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
    		if($_POST == NULL){
    			$data['jenis'] = "Edit Pemakaian Barang";
				$data['judul'] = "Edit Pemakaian Barang - Aplikasi Inventaris Barang WinSchool.";
				$data['desc'] = "Mengelola update data pemakaian barang.";
				$data['peminjaman'] = $this->m_get->total_peminjaman();
				$data['content2'] 	= $this->m_web->read('tbl_barang');
				$data['content'] 	= $this->m_web->join6($kode);
				$data['content45'] 	= $this->m_web->read('tbl_keperluan_peminjaman');
				$this->load->view('v_adminweb', $data);
    		} else {
				$b = strip_tags($this->input->post('ws_kode'));
				$c = strip_tags($this->input->post('ws_jml'));
				$d = date('Y-m-d', strtotime($this->input->post('ws_tgl')));
				$e = strip_tags($this->input->post('ws_keperluan'));
				$f = $this->input->post('ws_deskripsi');

				$l_jml_barang 	= $this->m_web->read_barang($b);
				$t_jml_barang	= $l_jml_barang->barang_jml;

				if($c > $t_jml_barang){
					echo $this->session->set_flashdata(array('msg' => 'gagal-stok', 'flash'=> 'Pemakaian Barang'));
					redirect(base_url('pemakaian'));
				} else {

					$data = array(
						'pemakaian_kode' 		=> $kode,
						'barang_kode' 			=> $b,
						'pemakaian_tgl' 		=> $d,
						'pemakaian_keperluan' 	=> $e,
						'pemakaian_deskripsi' 	=> $f
					);
					// Update data
					$this->m_web->update_pemakaian($kode, 'tbl_pemakaian_barang', $data);
			   		echo $this->session->set_flashdata(array('msg' => 'edit', 'flash'=> 'Pemakaian Barang'));
			   		redirect(base_url('pemakaian'));
		   		}
			}
		}
	}
	function delete($id)
	{
		if($this->session->userdata('user_level') != 45){ 
      		$this->cek();
    	} else {
    		$this->m_web->delete_pemakaian('tbl_pemakaian_barang', $id);
			echo $this->session->set_flashdata(array('msg' => 'hapus', 'flash'=> 'Pemakaian Barang'));
			redirect(base_url('pemakaian'));
		}
	}
}
?>