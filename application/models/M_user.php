<?php

class M_user extends CI_Model{

	function cekdb()
	{
		$user = set_cleanpost(set_value('ws_user'));
		$pass = md5(set_value('ws_pass'));
		$hasil = $this->db->where('username', $this->db->escape_str($user))
							->where('password', $this->db->escape_str($pass))
							->limit(1)
							->get('tbl_user');
		if($hasil->num_rows() > 0){
			return $hasil->row();
		} else {
			return array();
		}
	}
}

?>