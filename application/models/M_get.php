<?php

class M_get extends CI_Model{
 
  function get_data_barang1($id){
    $query = $this->db->query("SELECT * FROM tbl_peminjaman_barang WHERE barang_kode='$id'");
    return $query->row();
  }
  function get_data_barang2($id){
    $query = $this->db->query("SELECT * FROM tbl_pemakaian_barang WHERE barang_kode='$id'");
    return $query->row();
  }
  function get_data_guru($nip){
    $query = $this->db->query("SELECT * FROM tbl_peminjaman_barang WHERE peminjam='$nip'");
    return $query->row();
  }
  function get_data_siswa($nis){
    $query = $this->db->query("SELECT * FROM tbl_peminjaman_barang WHERE peminjam='$nis'");
    return $query->row();
  }
  function get_data_sekolah($id){
    $query = $this->db->query("SELECT * FROM tbl_peminjaman_barang WHERE peminjam='$id'");
    return $query->row();
  }
  function get_data_kelas($id){
    $query = $this->db->query("SELECT * FROM tbl_siswa WHERE kelas='$id'");
    return $query->row();
  }
  function get_data_keperluan1($id){
    $query = $this->db->query("SELECT * FROM tbl_peminjaman_barang WHERE peminjaman_keperluan='$id'");
    return $query->row();
  }
  function get_data_keperluan2($id){
    $query = $this->db->query("SELECT * FROM tbl_pemakaian_barang WHERE pemakaian_keperluan='$id'");
    return $query->row();
  }

  function get_data_jaminan($id){
    $query = $this->db->query("SELECT * FROM tbl_peminjaman_barang WHERE peminjaman_jaminan='$id'");
    return $query->row();
  }

  function get_data_kategori($id){
    $query = $this->db->query("SELECT * FROM tbl_barang WHERE kategori_id='$id'");
    return $query->row();
  }

  function get_data_lokasi($id){
    $query = $this->db->query("SELECT * FROM tbl_barang WHERE lokasi_barang='$id'");
    return $query->row();
  }

  function get_data_supplier($id){
    $query = $this->db->query("SELECT * FROM tbl_barang WHERE kode_supplier='$id'");
    return $query->row();
  }
  function get_data_pemakaian($kd_barang){
    $query = $this->db->query("SELECT * FROM tbl_pemakaian_barang WHERE barang_kode='$kd_barang'");
    return $query->row();
  }
  function get_data_peminjaman($kd_barang){
    $query = $this->db->query("SELECT * FROM tbl_peminjaman_barang WHERE barang_kode='$kd_barang' AND peminjaman_status='invalid'");
    return $query->row();
  }
  function total_barang(){
    $query = $this->db->query("SELECT * FROM tbl_barang");
    return $query->num_rows();
  }
  function total_user(){
    $query = $this->db->query("SELECT * FROM tbl_user");
    return $query->num_rows();
  }
  function total_supplier(){
    $query = $this->db->query("SELECT * FROM tbl_supplier");
    return $query->num_rows();
  }
  function total_peminjaman(){
    $query = $this->db->query("SELECT * FROM tbl_peminjaman_barang WHERE peminjaman_status='invalid'");
    return $query->num_rows();
  }

}

?>