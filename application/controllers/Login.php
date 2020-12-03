<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
    parent::__construct();
    # Load model, helper dan library
	    $this->load->model('m_user');
	 }

	public function index()
	{
			if($this->session->userdata('user_level') == 45){
		      redirect(base_url('home'));
		    } else {
		      $this->load->view('v_login');
		    }
    
	}
	public function log($xss = "")
	{
		$config = array(
        array(
                'field' => 'ws_user',
                'label' => 'Username',
                'rules' => 'required|alpha_numeric|min_length[3]|max_length[15]',
                'errors' => array(
                        'required' => '%s harus diisi.',
                        'alpha_numeric' => '%s harus kombinasi huruf dan angka.',
                        'min_length[3]' => '%s harus lebih dari 3 karakter.',
                        'max_length[15]' => '%s harus kurang dari 15 karakter.',
                ),
        	),
        array(
                'field' => 'ws_pass',
                'label' => 'Password',
                'rules' => 'required|alpha_numeric|min_length[3]|max_length[15]',
                'errors' => array(
                        'required' => '%s harus diisi.',
                        'alpha_numeric' => '%s harus kombinasi huruf dan angka.',
                        'min_length[3]' => '%s harus lebih dari 3 karakter.',
                        'max_length[15]' => '%s harus kurang dari 15 karakter.',
                ),
        	)
		);
		if (isset($xss)) {
			$a = set_cleanpost($xss);  
	      if($a)
	      {
	        $data['error'] = '<div class="alert alert-danger" style="margin-top:3px;"><div class="header"><b><i class="fa fa-warning"></i> MAAF !!! </b> Link yang Anda cari tidak tersedia.</div></div>'; 
	        $this->load->view('v_login', $data);
	      } 
		}
		$this->form_validation->set_rules($config);   
	    if($this->form_validation->run() == TRUE)
	    {
	    //   $this->load->view('v_login');
	    // } else {
	      $this->load->model('m_user');
	      // $user = set_cleanpost($this->input->post('ws_user'));
	      // $pass = md5($this->input->post('ws_pass'));
	      $u = $this->m_user->cekdb();  
	      if($u == FALSE)
	      {
	        $data['error'] = '<div class="alert alert-danger" style="margin-top:3px;"><div class="header"><b><i class="fa fa-warning"></i> ERROR</b> Username atau Password salah.</div></div>'; 
	        $this->load->view('v_login', $data);
	      } else {
	        // if the username and password is a match
	        $this->session->set_userdata('user_id', $u->user_id);
	        $this->session->set_userdata('user_nama', $u->user_nama);
	        $this->session->set_userdata('username', $u->username);
	        $this->session->set_userdata('user_level', $u->user_level);
	        $this->session->set_userdata('user_foto', $u->user_foto);
	            
	        switch($u->user_level){
	          case "45" : redirect('home'); break;
	        default: break; 
        }
      }
    } else {
	    $this->load->view('v_login');
    }
	
}
}
?>
