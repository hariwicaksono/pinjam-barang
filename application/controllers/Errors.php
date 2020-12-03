<?php

class Errors extends CI_Controller {

	public function index()
	{
		$data['error'] = '<div class="alert alert-danger" style="margin-top:3px;"><div class="header"><b><i class="fa fa-warning"></i>    Maaf !!!</b> Link yang Ada cari tidak tersedia.</div></div>'; 
		$this->load->view('v_login', $data);
	}
}
