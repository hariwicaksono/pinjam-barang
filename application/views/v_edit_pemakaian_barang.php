<div class="box">
<div class="box-body">
<!-- Edit Pinjaman -->
<?php
foreach ($content->result_array() as $i) :
  $a = $i['pemakaian_id'];
  $b = $i['pemakaian_kode'];
  $c = $i['pemakaian_jml'];
  $d = date('d-m-Y', strtotime($i['pemakaian_tgl']));
  $e = $i['pemakaian_deskripsi'];
  $f = $i['barang_kode'];
  $g = $i['keperluan_id'];
?>
      <form class="form-horizontal" action="<?php echo base_url('pemakaian/edit/'.$b); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="form-group">
              <label for="" class="col-sm-3">Barang *</label>
              <div class="col-sm-8">
              <select class="form-control" id="select3" name="ws_kode" style="width: 100%;" required>
                <option value="">Pilih Barang</option>
                <?php foreach ($content2->result_array() as $i) { 
                  $id=$i['barang_kode'];
                  ?>
                <option <?php if($f == $id) echo 'selected'; ?> value="<?php echo $i['barang_kode']; ?>"><?php echo $i['barang_nama']; ?></option>
                <?php } ?>
              </select>
              </div>
            </div>

          <div class="form-group">
            <label for="" class="col-sm-3">Tanggal Pakai *</label>
              <div class="col-sm-8">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" name="ws_tgl" id="datepicker1" value="<?php echo $d;?>"placeholder="Tanggal Pemakaian" required>
            </div>  
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-3">Keperluan *</label>
              <div class="col-sm-8">
            <select class="form-control select3" name="ws_keperluan" style="width: 100%" required>
              <option value="">Pilih Keperluan</option>
              <?php foreach ($content4->result_array() as $i) { 
                $ids = $i['keperluan_id']; 
                ?>
              <option <?php if($g == $ids) echo 'selected'; ?> value="<?php echo $i['keperluan_id']; ?>"><?php echo $i['keperluan_nama']; ?></option>
              <?php } ?>
            </select>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-3">Deskripsi *</label>
              <div class="col-sm-8">
              <textarea name="ws_deskripsi" class="form-control" placeholder="Deskripsi pembagian pamakaian barang"><?php echo $e; ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Simpan</button>
            <button type="button" class="btn btn-danger" onclick="history.go(-1);"><span class="glyphicon glyphicon-remove-sign"></span> Back</button>
          </div>

      </form>
<?php endforeach; ?>
<!-- End Edit Keperluan -->
</div>
</div>