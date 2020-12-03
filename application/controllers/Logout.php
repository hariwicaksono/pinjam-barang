<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct(){
    parent::__construct();
    # Load model, helper dan library
	    $this->load->model('m_user');
	 }

	public function index()
	{
    $this->session->sess_destroy();
    $data['error'] = '<div class="alert alert-success" style="margin-top:3px;"><div class="header"><b><i class="fa fa-check"></i> Logout</b> berhasil.</div></div>'; 
    $this->load->view('v_login', $data);
	}
}
?>