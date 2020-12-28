<?php

class Errors extends CI_Controller {

	public function index()
	{
		$data['error'] = '<div class="alert alert-warning" style="margin-top:3px;font-size:.875rem"><i class="fas fa-exclamation-circle"></i> Error 404! Link yang Ada cari tidak ada.</div>'; 
		$this->load->view('v_login', $data);
	}
}
