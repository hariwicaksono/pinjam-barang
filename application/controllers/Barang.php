<?php

class Barang extends CI_Controller {

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
	    	$data['jenis'] = "Barang";
			$data['judul'] = "Barang - Pinjam Barang";
			$data['desc'] = "Mengelola data barang.";
			$data['peminjaman'] = $this->m_get->total_peminjaman();
			$data['content'] 	= $this->m_web->read('tbl_barang');
			$data['content2'] 	= $this->m_web->read('tbl_lokasi_ruangan');
			$this->load->view('v_adminweb', $data);
		}
	}
	public function export()
	{
		if($this->session->userdata('user_level') != 45){ 
      		$this->cek();
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
					->setCellValue('F'.$brs, $i['pemakaian_keperluan'])
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
		    $config['upload_path'] = './assets/foto/barang/'; //path folder
	        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
			$this->upload->initialize($config);
	        if(!empty($_FILES['filefoto']['name']))
	        {
	           	if ($this->upload->do_upload('filefoto'))
	            {
	            	$gbr = $this->upload->data();
	                //Compress Image
	            	$config['image_library']='gd2';
	            	$config['source_image']='./assets/foto/barang/'.$gbr['file_name'];
	            	$config['create_thumb']= FALSE;
	            	$config['maintain_ratio']= FALSE;
	            	$config['quality']= '60%';
	            	$config['width']= 300;
	            	$config['height']= 300;
	            	$config['new_image']= './assets/foto/barang/'.$gbr['file_name'];
	            	$this->load->library('image_lib', $config);
	            	$this->image_lib->resize();
					// Input	
				    $kd_barang 		= rand(111111, 999999);
					$nama 			= strip_tags($this->input->post('ws_nama'));
					$spesifikasi 	= $this->input->post('ws_spesifikasi');
					$lokasi 		= strip_tags($this->input->post('ws_lokasi'));
					$kategori 		= strip_tags($this->input->post('ws_kategori'));
					$tgl_masuk 		= date('Y-m-d', strtotime($this->input->post('ws_tgl_masuk')));
					$jumlah 		= strip_tags($this->input->post('ws_jumlah'));
					$kondisi 		= strip_tags($this->input->post('ws_kondisi'));
					$sumber 		= strip_tags($this->input->post('ws_sumber'));
					$foto			= $gbr['file_name'];

					$data = array(
						'barang_kode' 		=> $kd_barang,
						'barang_nama' 		=> $nama,
						'barang_spesifikasi'=> $spesifikasi,
						'barang_lokasi' 	=> $lokasi,
						'barang_kategori' 	=> $kategori,
						'barang_tgl_masuk' 	=> $tgl_masuk,
						'barang_jml' 		=> $jumlah,
						'barang_kondisi'  	=> $kondisi,
						'barang_sumber' 	=> $sumber,
						'barang_foto' 		=> $foto
					);
					// Insert ke Database
		   		 	$this->m_web->insert('tbl_barang', $data);
		   		 	echo $this->session->set_flashdata(array('msg' => 'tambah', 'flash'=> 'Barang'));
		   			redirect(base_url('barang'));
				} 
		    } else {
		    	// Input	
				$kd_barang 		= rand(111111, 999999);
				$nama 			= strip_tags($this->input->post('ws_nama'));
				$spesifikasi 	= $this->input->post('ws_spesifikasi');
				$lokasi 		= strip_tags($this->input->post('ws_lokasi'));
				$kategori 		= strip_tags($this->input->post('ws_kategori'));
				$tgl_masuk 		= date('Y-m-d', strtotime($this->input->post('ws_tgl_masuk')));
				$jumlah 		= strip_tags($this->input->post('ws_jumlah'));
				$kondisi 		= strip_tags($this->input->post('ws_kondisi'));
				$sumber 		= strip_tags($this->input->post('ws_sumber'));
				$foto			= $gbr['file_name'];

				$data = array(
					'barang_kode' 		=> $kd_barang,
					'barang_nama' 		=> $nama,
					'barang_spesifikasi'=> $spesifikasi,
					'barang_lokasi' 	=> $lokasi,
					'barang_kategori' 	=> $kategori,
					'barang_tgl_masuk' 	=> $tgl_masuk,
					'barang_jml' 		=> $jumlah,
					'barang_kondisi'  	=> $kondisi,
					'barang_sumber' 	=> $sumber,
					'barang_foto' 		=> $foto
				);
				// Insert ke Database
		   		$this->m_web->insert('tbl_barang', $data);
		    	echo $this->session->set_flashdata(array('msg' => 'tambah', 'flash'=> 'Barang'));
		   		redirect(base_url('barang'));
		    }
		}
	}
	public function edit($kd_barang)
	{
		if($this->session->userdata('user_level') != 45){ 
      		redirect(base_url('login'));
    	} else {
    		if($_POST == NULL){
    			$data['jenis'] = "Edit Barang";
				$data['judul'] = "Edit Barang - Aplikasi Inventaris Barang.";
				$data['desc'] = "Mengelola edit data inventaris barang.";
				$data['peminjaman'] = $this->m_get->total_peminjaman();
				$data['content'] 	= $this->m_web->show1('tbl_barang', $kd_barang);
				$data['content2'] 	= $this->m_web->read('tbl_lokasi_ruangan');

				// Panggil Total Pemakaian
				$pemakaian = $this->m_get->get_data_pemakaian($kd_barang);
				if($pemakaian == NULL){
					$t_pemakaian = 0;
				} else {
					$t_pemakaian = $pemakaian->pemakaian_jml;
				}

				// Panggil Total Peminjaman
				$peminjaman = $this->m_get->get_data_peminjaman($kd_barang);
				if($peminjaman == NULL){
					$t_peminjaman = 0;
				} else {
					$t_peminjaman = $peminjaman->peminjaman_jml;
				}

				// $haha = $t_pemakaian+$t_peminjaman;
				// $hihi = 8-$haha;
				// echo $hihi;

				$data['pemakaian'] = "Data Pemakaian Barang ini: $t_pemakaian";
				$data['peminjaman1'] = "Data Peminjaman Barang ini: $t_peminjaman";

				$this->load->view('v_adminweb', $data);

    		} else {

	    		$config['upload_path'] = './assets/foto/barang/'; //path folder
		        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
				
				$this->upload->initialize($config);
	
		        if(!empty($_FILES['filefoto']['name']))
		        {
		           	if ($this->upload->do_upload('filefoto'))
		            {
		            	$gbr = $this->upload->data();
		                //Compress Image
		            	$config['image_library']='gd2';
		            	$config['source_image']='./assets/foto/barang/'.$gbr['file_name'];
		            	$config['create_thumb']= FALSE;
		            	$config['maintain_ratio']= FALSE;
		            	$config['quality']= '60%';
		            	$config['width']= 300;
		            	$config['height']= 300;
		            	$config['new_image']= './assets/foto/barang/'.$gbr['file_name'];
		            	$this->load->library('image_lib', $config);
		            	$this->image_lib->resize();

						// Input	
						$nama 			= strip_tags($this->input->post('ws_nama'));
						$spesifikasi 	= $this->input->post('ws_spesifikasi');
						$lokasi 		= strip_tags($this->input->post('ws_lokasi'));
						$kategori 		= strip_tags($this->input->post('ws_kategori'));
						$tgl_masuk 		= date('Y-m-d', strtotime($this->input->post('ws_tgl_masuk')));
						$jumlah 		= strip_tags($this->input->post('ws_jumlah'));
						$kondisi 		= strip_tags($this->input->post('ws_kondisi'));
						$sumber 		= strip_tags($this->input->post('ws_sumber'));
						$foto			= $gbr['file_name'];

						$data = array(
							'barang_nama' 		=> $nama,
							'barang_spesifikasi'=> $spesifikasi,
							'barang_lokasi' 	=> $lokasi,
							'barang_kategori' 	=> $kategori,
							'barang_tgl_masuk' 	=> $tgl_masuk,
							'barang_jml' 		=> $jumlah,
							'barang_kondisi'  	=> $kondisi,
							'barang_sumber' 	=> $sumber,
							'barang_foto' 		=> $foto
						);


							// Update ke Database
				    		$this->m_web->update_barang($kd_barang, 'tbl_barang', $data);
				    		echo $this->session->set_flashdata(array('msg' => 'edit', 'flash'=> 'Barang'));
		   					redirect(base_url('barang'));

				    	} else {

							// Panggil Total Pemakaian
							$pemakaian = $this->m_get->get_data_pemakaian($kd_barang);
							if($pemakaian == NULL){
								$t_pemakaian = 0;
							} else {
								$t_pemakaian = $pemakaian->pemakaian_jml;
							}

							// Panggil Total Peminjaman
							$peminjaman = $this->m_get->get_data_peminjaman($kd_barang);
							if($peminjaman == NULL){
								$t_peminjaman = 0;
							} else {
								$t_peminjaman = $peminjaman->peminjaman_jml;
							}

							$total_jml_barang_baru1 = $t_pemakaian+$t_peminjaman;
							$total_jml_barang_baru2 = $jumlah-$total_jml_barang_baru1;

							$kd_barang 		= strip_tags($this->input->post('ws_kode'));
							$nama 			= strip_tags($this->input->post('ws_nama'));
							$spesifikasi 	= $this->input->post('ws_spesifikasi');
							$lokasi 		= strip_tags($this->input->post('ws_lokasi'));
							$kategori 		= strip_tags($this->input->post('ws_kategori'));
							$tgl_masuk 		= date('Y-m-d', strtotime($this->input->post('ws_tgl_masuk')));
							$jumlah 		= strip_tags($this->input->post('ws_jumlah'));
							$kondisi 		= strip_tags($this->input->post('ws_kondisi'));
							$sumber 		= strip_tags($this->input->post('ws_sumber'));

							$data = array(
								'barang_kode' 		=> $kd_barang,
								'barang_nama' 		=> $nama,
								'barang_spesifikasi'=> $spesifikasi,
								'barang_lokasi' 	=> $lokasi,
								'barang_kategori' 	=> $kategori,
								'barang_tgl_masuk' 	=> $tgl_masuk,
								'barang_jml' 		=> $jumlah,
								'barang_kondisi'  	=> $kondisi,
								'barang_sumber' 	=> $sumber
							);


							// Update ke Database
				    		$this->m_web->update_barang($kd_barang, 'tbl_barang', $data);
				    		echo $this->session->set_flashdata(array('msg' => 'edit', 'flash'=> 'Barang'));
		   					redirect(base_url('barang'));
				    	}
			    } else {
					$kd_barang 		= strip_tags($this->input->post('ws_kode'));
					$nama 			= strip_tags($this->input->post('ws_nama'));
					$spesifikasi 	= $this->input->post('ws_spesifikasi');
					$lokasi 		= strip_tags($this->input->post('ws_lokasi'));
					$kategori 		= strip_tags($this->input->post('ws_kategori'));
					$tgl_masuk 		= date('Y-m-d', strtotime($this->input->post('ws_tgl_masuk')));
					$jumlah 		= strip_tags($this->input->post('ws_jumlah'));
					$kondisi 		= strip_tags($this->input->post('ws_kondisi'));
					$sumber 		= strip_tags($this->input->post('ws_sumber'));

					if ($jumlah == "") {

						$data = array(
							'barang_kode' 		=> $kd_barang,
							'barang_nama' 		=> $nama,
							'barang_spesifikasi'=> $spesifikasi,
							'barang_lokasi' 	=> $lokasi,
							'barang_kategori' 	=> $kategori,
							'barang_tgl_masuk' 	=> $tgl_masuk,
							'barang_jml' 		=> $jumlah,
							'barang_kondisi'  	=> $kondisi,
							'barang_sumber' 	=> $sumber
						);


						// Update ke Database
				    	$this->m_web->update_barang($kd_barang, 'tbl_barang', $data);
				   		echo $this->session->set_flashdata(array('msg' => 'edit', 'flash'=> 'Barang'));
		   				redirect(base_url('barang'));

				    	} else {

							// Panggil Total Pemakaian
							$pemakaian = $this->m_get->get_data_pemakaian($kd_barang);
							if($pemakaian == NULL){
								$t_pemakaian = 0;
							} else {
								$t_pemakaian = $pemakaian->pemakaian_jml;
							}

							// Panggil Total Peminjaman
							$peminjaman = $this->m_get->get_data_peminjaman($kd_barang);
							if($peminjaman == NULL){
								$t_peminjaman = 0;
							} else {
								$t_peminjaman = $peminjaman->peminjaman_jml;
							}

							$total_jml_barang_baru1 = $t_pemakaian+$t_peminjaman;
							$total_jml_barang_baru2 = $jumlah-$total_jml_barang_baru1;

							$data = array(
								'barang_kode' 		=> $kd_barang,
								'barang_nama' 		=> $nama,
								'barang_spesifikasi'=> $spesifikasi,
								'barang_lokasi' 	=> $lokasi,
								'barang_kategori' 	=> $kategori,
								'barang_tgl_masuk' 	=> $tgl_masuk,
								'barang_jml' 		=> $jumlah,
								'barang_kondisi'  	=> $kondisi,
								'barang_sumber' 	=> $sumber
							);


							// Update ke Database
				    		$this->m_web->update_barang($kd_barang, 'tbl_barang', $data);
				    		echo $this->session->set_flashdata(array('msg' => 'edit', 'flash'=> 'Barang'));
		   					redirect(base_url('barang'));
				    	}
			   
			   	}
			}
		}
	}
	public function delete($id)
	{
		if($this->session->userdata('user_level') != 45){ 
      		$this->cek();
    	} else {
    		$kodeBarang = $this->m_get->get_data_barang1($id);
			$tampil 	= $kodeBarang->barang_kode;

			$a 			= $this->m_get->get_data_barang2($id);
			$b 			= $a->barang_kode;

			if($tampil == $id){
				echo $this->session->set_flashdata(array('msg' => 'gagal', 'flash'=> 'Barang'));
		   		redirect(base_url('barang'));
			} else if($b == $id){
				echo $this->session->set_flashdata(array('msg' => 'gagal', 'flash'=> 'Barang'));
		   		redirect(base_url('barang'));
			} {
				$this->m_web->delete_barang('tbl_barang', $id);
				echo $this->session->set_flashdata(array('msg' => 'hapus', 'flash'=> 'Barang'));
		   		redirect(base_url('barang'));
			}
		}
	}
}
?>