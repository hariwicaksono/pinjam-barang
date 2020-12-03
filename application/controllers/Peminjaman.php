<?php

class Peminjaman extends CI_Controller {

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
	    	$data['jenis'] = "Peminjaman Barang";
			$data['judul'] = "Peminjaman Barang - Pinjam Barang";
			$data['desc'] = "Mengelola data peminjaman barang.";
			$data['peminjaman'] = $this->m_get->total_peminjaman();
			$data['content'] 	= $this->m_web->join2();
			$data['content2'] 	= $this->m_web->read('tbl_barang');
			$data['content3'] 	= $this->m_web->read('tbl_jaminan_peminjaman');
			$data['content4'] 	= $this->m_web->read('tbl_keperluan_peminjaman');
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
						->setCellValue('A1', 'LAPORAN PEMINJAMAN BARANG')
						->setCellValue('A2', 'No')
						->setCellValue('B2', 'Kode Pinjam')
						->setCellValue('C2', 'Nama Barang')
						->setCellValue('D2', 'Tanggal Pinjam')
						->setCellValue('E2', 'Peminjam')
						->setCellValue('F2', 'Jumlah Pinjam')
						->setCellValue('G2', 'Tanggal Kembali')
						->setCellValue('H2', 'Jaminan')
						->setCellValue('I2', 'Keperluan')
						->setCellValue('J2', 'Status');

			$data = $this->m_web->join8();
			$no = 1;
			$brs = 3;
			foreach ($data->result_array() as $i) {

				$tgl1 = tgl_indo($i['peminjaman_tgl']);
				$tgl2 = tgl_indo($i['peminjaman_tgl_kembali']);
				
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$brs, $no)
					->setCellValue('B'.$brs, $i['peminjaman_kode'])
					->setCellValue('C'.$brs, $i['barang_nama'])
					->setCellValue('D'.$brs, $tgl1)
					->setCellValue('E'.$brs, $i['peminjaman_peminjam'])
					->setCellValue('F'.$brs, $i['peminjaman_jml'])
					->setCellValue('G'.$brs, $tgl2)
					->setCellValue('H'.$brs, $i['jaminan_nama'])
					->setCellValue('I'.$brs, $i['keperluan_nama'])
					->setCellValue('J'.$brs, $i['peminjaman_status']);
									
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
			header('Content-Disposition: attachment;filename="laporan-peminjaman-barang-'.$acak.'.xls"');
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
				echo $this->session->set_flashdata(array('msg' => 'export', 'flash'=> 'Peminjaman Barang'));
				redirect(base_url('peminjaman'));
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
	    	$kd_pinjam		= rand(111111, 999999);
			$kd_barang 		= strip_tags($this->input->post('kd_barang'));
			$jumlah_pinjam 	= strip_tags($this->input->post('jml_pinjam'));
			$peminjam 		= strip_tags($this->input->post('peminjam'));
			$tgl_pinjam	 	= date('Y-m-d', strtotime($this->input->post('tgl_pinjam')));
			$tgl_kembali	= date('Y-m-d', strtotime($this->input->post('tgl_kembali')));
			$jaminan 		= strip_tags($this->input->post('jaminan'));
			$keperluan 		= strip_tags($this->input->post('keperluan'));

			$l_jml_barang 	= $this->m_web->read_barang($kd_barang);
			$t_jml_barang	= $l_jml_barang->barang_jml;

			if($jumlah_pinjam > $t_jml_barang){
				echo $this->session->set_flashdata(array('msg' => 'gagal-stok', 'flash'=> 'Peminjaman Barang'));
				redirect(base_url('peminjaman?core=hjfghdbvcghtresfghjjhgfdsdrtgvccdc'));
			} else {

				$data = array(
					'peminjaman_kode' 		=> $kd_pinjam,
					'barang_kode' 		=> $kd_barang,
					'peminjaman_tgl' 		=> $tgl_pinjam,
					'peminjaman_peminjam' 			=> $peminjam,
					'peminjaman_jml'		=> $jumlah_pinjam,
					'peminjaman_tgl_kembali' 		=> $tgl_kembali,
					'peminjaman_jaminan' 			=> $jaminan,
					'peminjaman_keperluan' 		=> $keperluan,
					'peminjaman_status' 			=> 'invalid'
					);
				// Insert data
				$this->m_web->insert('tbl_peminjaman_barang', $data);
				// Kurangi stok barang
				$total_jml_barang = $t_jml_barang-$jumlah_pinjam;
				// Update stok barang
				$upd_data = array(
					'barang_jml' => $total_jml_barang 
				);
				$this->m_web->update_stok_barang($kd_barang, 'tbl_barang', $upd_data);
				// Redirect
				echo $this->session->set_flashdata(array('msg' => 'tambah', 'flash'=> 'Peminjaman Barang'));
		   		redirect(base_url('peminjaman'));
			}
		}
	}
	function edit($kd_pinjam)
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
			// Update stok
			$t_jml_pinjam 		= $this->m_web->read_jml_pinjam($kd_pinjam);
			$total_jml_pinjam 	= $t_jml_pinjam->peminjaman_jml;
			$kd_barang 			= $t_jml_pinjam->barang_kode;
			// echo $kd_barang;
			// echo $total_jml_pinjam;
			// Kembalikan jumlah stok
			$l_jml_barang 	= $this->m_web->read_barang($kd_barang);
			$t_jml_barang	= $l_jml_barang->barang_jml;

			// echo $t_jml_barang;
			// Hitung
			$hitung 		= $total_jml_pinjam+$t_jml_barang;
			// echo $hitung;
			$upd_stok 		= array(
			  	'barang_jml' => $hitung 
			);
			$data = array(
			 	'peminjaman_status' 		=> 'valid'
			);
			$this->m_web->update_peminjaman($kd_pinjam, 'tbl_peminjaman_barang', $data);
			$this->m_web->update_stok_barang($kd_barang, 'tbl_barang', $upd_stok);
			echo $this->session->set_flashdata(array('msg' => 'edit', 'flash'=> 'Peminjaman Barang'));
		   	redirect(base_url('peminjaman'));
		}	
	}
	function delete($id)
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
    		$this->m_web->delete_peminjaman('tbl_peminjaman_barang', $id);
			echo $this->session->set_flashdata(array('msg' => 'hapus', 'flash'=> 'Peminjaman Barang'));
		   	redirect(base_url('peminjaman'));
		}
	}
}
?>