<?php

class Pinjaman extends CI_Controller {

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
	    	$data['jenis'] = "Pinjaman Barang";
			$data['judul'] = "Pinjaman Barang - Pinjam Barang";
			$data['desc'] = "Mengelola data pinjaman barang.";
			$data['peminjaman'] = $this->m_get->total_peminjaman();
			$data['content'] 	= $this->m_web->read('tbl_pinjaman_barang');
			$this->load->view('v_adminweb', $data);
		}
	}
	function export()
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {

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
						->setCellValue('A1', 'LAPORAN PINJAMAN BARANG')
						->setCellValue('A2', 'No')
						->setCellValue('B2', 'Nama Barang')
						->setCellValue('C2', 'Tanggal Masuk')
						->setCellValue('D2', 'Jumlah Pinjaman')
						->setCellValue('E2', 'Pemberi Pinjaman')
						->setCellValue('F2', 'Deskripsi');

			$data = $this->m_web->show3();
			$no = 1;
			$brs = 3;
			foreach ($data->result_array() as $i) {

				$tgl = tgl_indo($i['pinjaman_tgl_masuk']);
				
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$brs, $no)
					->setCellValue('B'.$brs, $i['pinjaman_nama'])
					->setCellValue('C'.$brs, $i['pinjaman_nama'])
					->setCellValue('D'.$brs, $tgl)
					->setCellValue('E'.$brs, $i['pinjaman_pemberi'])
					->setCellValue('F'.$brs, $i['pinjaman_deskripsi']);
									
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
			header('Content-Disposition: attachment;filename="laporan-pinjaman-barang-'.$acak.'.xls"');
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
				echo $this->session->set_flashdata(array('msg' => 'export', 'flash'=> 'Pinjaman Barang'));
				redirect(base_url('pinjaman'));
			} else {
				redirect(base_url('errors'));
			}
		}
	}
	function add()
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
	    	$nm_barang		= strip_tags($this->input->post('nm_barang'));
			$jml_barang 	= strip_tags($this->input->post('jml_barang'));
			$tgl_pakai	 	= date('Y-m-d', strtotime($this->input->post('tgl_pakai')));
			$pemberi 		= strip_tags($this->input->post('pemberi_pinjaman'));
			$deskripsi 		= $this->input->post('deskripsi');

			$data = array(
				'pinjaman_nama' 		=> $nm_barang,
				'pinjaman_jml' 			=> $jml_barang,
				'pinjaman_tgl_masuk' 	=> $tgl_pakai,
				'pinjaman_pemberi' 		=> $pemberi,
				'pinjaman_deskripsi'	=> $deskripsi
			);
			// Insert data
			$this->m_web->insert('tbl_pinjaman_barang', $data);
			echo $this->session->set_flashdata(array('msg' => 'tambah', 'flash'=> 'Pinjaman Barang'));
		   	redirect(base_url('pinjaman'));
		}
	}
	function edit($id)
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
			if($_POST == NULL){
    			$data['jenis'] = "Edit Pinjaman Barang";
				$data['judul'] = "Edit Pinjaman Barang - Aplikasi Inventaris Barang WinSchool.";
				$data['desc'] = "Mengelola edit data pinjaman barang inventaris barang.";
				$data['peminjaman'] = $this->m_get->total_peminjaman();
				$data['content'] 	= $this->m_web->show('tbl_pinjaman_barang', $id);
				$this->load->view('v_adminweb', $data);
    		} else {
				$nm_barang		= strip_tags($this->input->post('nm_barang'));
				$jml_barang 	= strip_tags($this->input->post('jml_barang'));
				$tgl_pakai	 	= date('Y-m-d', strtotime($this->input->post('tgl_pakai')));
				$pemberi 		= strip_tags($this->input->post('pemberi_pinjaman'));
				$deskripsi 		= $this->input->post('deskripsi');

				$data = array(
					'pinjaman_nama' 		=> $nm_barang,
					'pinjaman_jml' 			=> $jml_barang,
					'pinjaman_tgl_masuk' 	=> $tgl_pakai,
					'pinjaman_pemberi' 		=> $pemberi,
					'pinjaman_deskripsi'	=> $deskripsi
				);

				$this->m_web->update_pinjaman($id, 'tbl_pinjaman_barang', $data);
				echo $this->session->set_flashdata(array('msg' => 'edit', 'flash'=> 'Pinjaman Barang'));
				redirect(base_url('pinjaman'));
			}	
		}
	}
	function delete($id)
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
    		$this->m_web->delete_pinjaman('tbl_pinjaman_barang', $id);
			echo $this->session->set_flashdata(array('msg' => 'hapus', 'flash'=> 'Pinjaman Barang'));
		   	redirect(base_url('pinjaman'));
		}
	}
}
?>