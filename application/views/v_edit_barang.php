<div class="box">
<div class="box-body">
<!-- Edit Barang -->
<?php
foreach ($content->result_array() as $i) :
  $id               = $i['barang_id'];
  $kd_barang        = $i['barang_kode'];
  $nm_barang        = $i['barang_nama'];
  $sp_barang        = $i['barang_spesifikasi'];
  $lk_barang        = $i['barang_lokasi'];
  $kt_barang        = $i['barang_kategori'];
  $jm_barang        = $i['barang_jml'];
  $tgl_masuk_barang = date('d-m-Y', strtotime($i['barang_tgl_masuk']));
  $kn_barang        = $i['barang_kondisi'];
  $sd_barang        = $i['barang_sumber'];
  $foto             = $i['barang_foto'];
?>
<?php echo $pemakaian;?>
<br>
<?php echo $peminjaman1;?>
      <form class="form-horizontal" action="<?php echo base_url('barang/edit/'.$kd_barang); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">

        <input type="hidden" class="form-control" name="ws_kode" value="<?php echo $kd_barang; ?>" placeholder="Masukan Kode Barang" required>
        
          <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Nama Barang *</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="ws_nama" value="<?php echo $nm_barang; ?>" placeholder="Masukan Nama Barang" required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Spesifikasi *</label>
            <div class="col-sm-8">
              <textarea name="ws_spesifikasi" class="form-control" placeholder="Spesifikasi Barang" required><?php echo $sp_barang; ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-3">Lokasi Barang *</label>
            <div class="col-sm-8">
            <select class="form-control select" name="ws_lokasi" style="width: 100%" required>
              <option value="">-- Pilih Lokasi --</option>
              <?php foreach ($content2->result_array() as $i) { ?>
              <option value="<?php echo $i['lokasi_id']; ?>" <?php if($i['lokasi_id']==$lk_barang){ echo 'selected="selected"'; } ?> ><?php echo $i['lokasi_nama']; ?></option>
              <?php } ?>
            </select>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Kategori Barang *</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="ws_kategori" value="<?php echo $kt_barang; ?>" placeholder="Kategori Barang" required>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Tanggal Masuk *</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="ws_tgl_masuk" id="datepicker1"  value="<?php echo $tgl_masuk_barang; ?>" placeholder="Tanggal Masuk" required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Jumlah Barang *</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" name="ws_jumlah" value="<?php echo $jm_barang; ?>" placeholder="0">
              <span class="">Kosongkan jumlah barang jika tidak mengedit jumlah barang, namun jika ingin memperbarui jumlah barang silahkan masukan jumlah barang yang terbaru.</span>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Kondisi *</label>
            <div class="col-sm-8">
              <select name="ws_kondisi" class="form-control select" style="width: 100%;" required> 
                <option value="<?php echo $kn_barang; ?>"><?php echo $kn_barang; ?></option>
                <?php if($kn_barang == "Baru"){
                  echo "<option value='Second'>Second</option>";
                } else {
                  echo "<option value='Baru'>Baru</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Sumber Dana *</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="ws_sumber"  value="<?php echo $sd_barang; ?>"placeholder="Dananya dari siapa?" required>
            </div>
          </div>

          <?php if(empty($foto)):?>
          <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Foto Sebelumnya *</label>
            <div class="col-sm-8">
              <td><img width="100" src="<?php echo base_url().'assets/img/no-image.jpg';?>"></td>
            </div>
          </div> 
          <?php else:?>
            <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Foto Sebelumnya *</label>
            <div class="col-sm-8">
              <td><img width="100" src="<?php echo base_url('assets/foto/barang/'.$foto); ?>"></td>
            </div>
          </div> 
          <?php endif;?>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Ganti Foto *</label>
            <div class="col-sm-8">
              <input type="file" name="filefoto"/>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Simpan</button>
            <button type="button" class="btn btn-danger" onclick="history.go(-1);"><span class="glyphicon glyphicon-remove-sign"></span> Back</button>
          </div>
      </form>
<?php endforeach; ?>
<!-- End Modal Edit Barang -->
</div>
</div>