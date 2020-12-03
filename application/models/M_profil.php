<?php

class M_profil extends CI_Model{

  function read_profil($table){
    $query = $this->db->query("SELECT * FROM $table");
    return $query->row();
  }
  // ============================ INVENTARIS ============================
  function get($table, $id){
    $query = $this->db->query("SELECT * FROM $table WHERE user_level='45' AND user_id='$id'");
    return $query->row();
  }
  function updatex($table, $id, $data){
    $query = $this->db->where('user_id', $id);
    $query = $this->db->update($table, $data);
    return $query;
  }
  // ============================ PERPUSTAKAAN ============================
  function tampil($table){
    $query = $this->db->query("SELECT * FROM $table");
    return $query;
  }
  function insert($table, $data){
    $query = $this->db->insert($table, $data);
    return $query;
  }
  function update($table, $id, $data){
    $query = $this->db->where('profil_kode', $id);
    $query = $this->db->update($table, $data);
    return $query;
  }
}

?>