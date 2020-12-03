<?php

class User extends CI_Controller {

	function __construct(){
    parent::__construct();
    # Load model, helper dan library
	    $this->load->model('m_profil');
	    $this->load->library('upload');
	 }

	public function index()
	{
		$data['jenis'] = "User";
		$data['judul'] = "User - Pinjam Barang";
		$data['desc'] = "Menampilkan data user Inventaris Peminjaman";
		$id = $this->session->userdata('user_id');
		$data['content'] = $this->m_profil->get('tbl_user', $id);
		$this->load->view('v_adminweb', $data);
	}
	public function edit($id)
	{
		if($this->session->userdata('user_level') != 45){
			redirect(base_url('wadmin'));
		} else {
			    $config['upload_path'] = './assets/foto/user/'; //path folder
			    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
				$this->upload->initialize($config);
				$file = $_FILES['filefoto']['name'];
			        if(!empty($_FILES['filefoto']['name']))
			        {
			           	if ($this->upload->do_upload('filefoto'))
			            {
			            	$gbr = $this->upload->data();
			                //Compress Image
			            	$config['image_library']='gd2';
			            	$config['source_image']='./assets/foto/user/'.$gbr['file_name'];
			            	$config['create_thumb']= FALSE;
			            	$config['maintain_ratio']= FALSE;
			            	$config['quality']= '60%';
			            	$config['width']= 300;
			            	$config['height']= 300;
			            	$config['new_image']= './assets/foto/user/'.$gbr['file_name'];
			            	$this->load->library('image_lib', $config);
			            	$this->image_lib->resize();
			            	$a = strip_tags($this->input->post('ws_nama'));
							$b = $gbr['file_name'];

							$data = array(
								'user_nama' 		=> $a,
								'user_foto' 		=> $b
							);

							// Update Data
							$this->m_profil->updatex('tbl_user', $id, $data);
							// Set Session
							$this->session->set_userdata('user_nama', $a);
							$this->session->set_userdata('user_foto', $b);
							echo $this->session->set_flashdata(array('msg' => 'edit', 'flash' => 'User'));
							redirect(base_url('user'));
						}
					} else {
			            $a = strip_tags($this->input->post('ws_nama'));

						$data = array(
							'user_nama' 		=> $a
						);
						// Update Data
						$this->m_profil->updatex('tbl_user', $id, $data);
						// Set Session
						$this->session->set_userdata('user_nama', $a);
						echo $this->session->set_flashdata(array('msg' => 'edit', 'flash' => 'User'));
						redirect(base_url('user'));
					}
	    }
	}
}
?>
