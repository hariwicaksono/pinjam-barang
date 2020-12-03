<?php

class M_web extends CI_Model{

  function read($table){
    $query = $this->db->query("SELECT * FROM $table");
    return $query;
  }
  function show($table, $id){
    $query = $this->db->query("SELECT * FROM $table WHERE pinjaman_id='$id'");
    return $query;
  }
  function show1($table, $id){
    $query = $this->db->query("SELECT * FROM $table WHERE barang_kode='$id'");
    return $query;
  }
  function show2($table, $kd_pakai){
    $query = $this->db->query("SELECT * FROM $table WHERE pemakaian_kode='$kd_pakai'");
    return $query;
  }
   function show3(){
    $query = $this->db->query("SELECT * FROM tbl_pinjaman_barang ORDER BY pinjaman_tgl_masuk ASC");
    return $query;
  }
  function read_barang($kd_barang){
    $query = $this->db->query("SELECT * FROM tbl_barang WHERE barang_kode='$kd_barang'");
    return $query->row();
  }
  function read_jml_pinjam($kd_pinjam){
    $query = $this->db->query("SELECT * FROM tbl_peminjaman_barang WHERE peminjaman_kode='$kd_pinjam'");
    return $query->row();
  }
  function read_jml_pakai($kd_pakai){
    $query = $this->db->query("SELECT * FROM tbl_pemakaian_barang WHERE pemakaian_kode='$kd_pakai'");
    return $query->row();
  }
  function insert($table, $data){
    $query = $this->db->insert($table, $data);
    return $query;
  }
  function update($id, $table, $data){
    $query = $this->db->where('id', $id);
    $query = $this->db->update($table, $data);
    return $query;
  }
  function update_pinjaman($id, $table, $data){
    $query = $this->db->where('pinjaman_id', $id);
    $query = $this->db->update($table, $data);
    return $query;
  }
  function update_jaminan($id, $table, $data){
    $query = $this->db->where('jaminan_id', $id);
    $query = $this->db->update($table, $data);
    return $query;
  }
  function update_barang($kd_barang, $table, $data){
    $query = $this->db->where('barang_kode', $kd_barang);
    $query = $this->db->update($table, $data);
    return $query;
  } 
  function update_keperluan($id, $table, $data){
    $query = $this->db->where('keperluan_id', $id);
    $query = $this->db->update($table, $data);
    return $query;
  }
  function update_lokasi($id, $table, $data){
    $query = $this->db->where('lokasi_id', $id);
    $query = $this->db->update($table, $data);
    return $query;
  }
  function update_peminjaman($kd_pinjam, $table, $data){
    $query = $this->db->where('peminjaman_kode', $kd_pinjam);
    $query = $this->db->update($table, $data);
    return $query;
  }
  function update_pemakaian($kd_pakai, $table, $data){
    $query = $this->db->where('pemakaian_kode', $kd_pakai);
    $query = $this->db->update($table, $data);
    return $query;
  }
  function update_stok_barang($kd_barang, $table, $data){
    $query = $this->db->where('barang_kode', $kd_barang);
    $query = $this->db->update($table, $data);
    return $query;
  }
  function update_stok_barang2($kd_barang, $table, $data){
    $query = $this->db->where('id_barang', $kd_barang);
    $query = $this->db->update($table, $data);
    return $query;
  }
  function delete($table, $id){
    $query = $this->db->where('id', $id);
    $query = $this->db->delete($table);
    return $query;
  }
  function delete_user($table, $id){
    $query = $this->db->where('id_user', $id);
    $query = $this->db->delete($table);
    return $query;
  }
  function delete_supplier($table, $id){
    $query = $this->db->where('kode_supplier', $id);
    $query = $this->db->delete($table);
    return $query;
  }
  function delete_barang($table, $id){
    $query = $this->db->where('barang_id', $id);
    $query = $this->db->delete($table);
    return $query;
  }
  function delete_keperluan($table, $id){
    $query = $this->db->where('keperluan_id', $id);
    $query = $this->db->delete($table);
    return $query;
  }
  function delete_lokasi($table, $id){
    $query = $this->db->where('lokasi_id', $id);
    $query = $this->db->delete($table);
    return $query;
  }
  function delete_peminjaman($table, $id){
    $query = $this->db->where('peminjaman_kode', $id);
    $query = $this->db->delete($table);
    return $query;
  }
  function delete_pemakaian($table, $id){
    $query = $this->db->where('pemakaian_kode', $id);
    $query = $this->db->delete($table);
    return $query;
  }
   function delete_pinjaman($table, $id){
    $query = $this->db->where('pinjaman_id', $id);
    $query = $this->db->delete($table);
    return $query;
  }
  function delete_jaminan($table, $id){
    $query = $this->db->where('jaminan_id', $id);
    $query = $this->db->delete($table);
    return $query;
  }
  function join1(){
    $query = $this->db->query("SELECT * FROM tbl_barang a, tbl_supplier b, tbl_kategori c, tbl_lokasi d WHERE a.lokasi_barang=d.id AND a.kategori_id=c.id AND a.kode_supplier=b.id");
    return $query;
  }
  function join2(){
    $query = $this->db->query("SELECT * FROM tbl_peminjaman_barang a, tbl_barang b, tbl_jaminan_peminjaman c, tbl_keperluan_peminjaman d WHERE a.barang_kode=b.barang_kode AND a.peminjaman_jaminan=c.jaminan_id AND a.peminjaman_keperluan=d.keperluan_id ORDER BY a.peminjaman_id DESC");
    return $query;
  }
  function join3(){
    $query = $this->db->query("SELECT * FROM tbl_siswa a, tbl_kelas b WHERE a.kelas=b.id");
    return $query;
  }
  function join4(){
    $query = $this->db->query("SELECT * FROM tbl_pemakaian_barang a, tbl_barang b, tbl_keperluan_peminjaman c WHERE a.barang_kode=b.barang_kode AND a.pemakaian_keperluan=c.keperluan_id");
    return $query;
  }
  function join5(){
    $query = $this->db->query("SELECT * FROM tbl_peminjaman_barang a, tbl_barang b, tbl_jaminan_peminjaman c, tbl_keperluan_peminjaman d WHERE a.barang_kode=b.barang_kode AND a.jaminan=c.id AND a.keperluan=d.id_keperluan ORDER BY a.tgl_pinjam ASC");
    return $query;
  }
  function join6($kode){
    $query = $this->db->query("SELECT * FROM tbl_pemakaian_barang a, tbl_barang b, tbl_keperluan_peminjaman c WHERE a.barang_kode=b.barang_kode AND a.pemakaian_keperluan=c.keperluan_id AND a.pemakaian_kode='$kode'");
    return $query;
  }
  function join7(){
    $query = $this->db->query("SELECT * FROM tbl_pemakaian_barang a, tbl_barang b, tbl_keperluan_peminjaman c WHERE a.barang_kode=b.barang_kode AND a.pemakaian_keperluan=c.keperluan_id ORDER BY a.pemakaian_tgl ASC");
    return $query;
  }
  function join8(){
    $query = $this->db->query("SELECT * FROM tbl_peminjaman_barang a, tbl_barang b, tbl_jaminan_peminjaman c, tbl_keperluan_peminjaman d WHERE a.barang_kode=b.barang_kode AND a.peminjaman_jaminan=c.jaminan_id AND a.peminjaman_keperluan=d.keperluan_id ORDER BY a.peminjaman_tgl ASC");
    return $query;
  }
  
    function import_barang($filename){
      ini_set('memory_limit', '-1');
        $inputFileName = './assets/file/barang/'.$filename;
        try {
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
        die('Error loading file :' . $e->getMessage());
        }

        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);

        for ($i=2; $i < ($numRows+1) ; $i++) { 

          $foto = $worksheet[$i]["J"];

          $tgl_masuk = date('Y-m-d');

          if (empty($foto)) {
            $data = array(
              'barang_kode'   => $worksheet[$i]["A"],
              'nama_barang'   => $worksheet[$i]["B"],
              'spesifikasi'   => $worksheet[$i]["C"],
              'lokasi_barang' => $worksheet[$i]["D"],
              'kategori'      => $worksheet[$i]["E"],
              'tgl_masuk'     => $tgl_masuk,
              'jml_barang'    => $worksheet[$i]["F"],
              'kondisi'       => $worksheet[$i]["G"],
              'sumber_dana'   => $worksheet[$i]["H"]
            );

            $this->db->insert('tbl_barang', $data);
          } else {
            $data = array(
              'barang_kode'   => $worksheet[$i]["A"],
              'nama_barang'   => $worksheet[$i]["B"],
              'spesifikasi'   => $worksheet[$i]["C"],
              'lokasi_barang' => $worksheet[$i]["D"],
              'kategori'      => $worksheet[$i]["E"],
              'tgl_masuk'     => $tgl_masuk,
              'jml_barang'    => $worksheet[$i]["F"],
              'kondisi'       => $worksheet[$i]["G"],
              'sumber_dana'   => $worksheet[$i]["H"],
              'foto'          => $worksheet[$i]["I"]
            );

            $this->db->insert('tbl_barang', $data);
          }
        }
    }

}

?>