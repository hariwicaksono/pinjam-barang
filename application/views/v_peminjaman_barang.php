<html>
<body>
<div class="box">
  <div class="box-header">
    <a data-toggle="modal" href="#ModalAdd" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Tambah</a>
    <a data-toggle="modal" href="#ModalExport" class="btn btn-success"><span class="glyphicon glyphicon-download"></span> Export To Excel</a>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

  <div class="alert text-info alert dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa fa-info"></i> Penting!</h4>
    <h5>1. Anda tidak akan bisa meminjam barang jika jumlah peminjaman lebih besar dari stok barang</h5>
    <h5>2. Periksa kembali kondisi barang apabila peminjam telah mengembalikannya.</h5>
  </div>

  <table id="example1" class="table table-bordered table-striped">
    <thead class="thead-default">
      <tr>
        <td><b>No</b></td>
        <td><b>Tgl Pinjam</b></td>
        <td><b>Nama Barang</b></td>
        <td><b>Jumlah</b></td>
        <td><b>Peminjam</b></td>
        <td><b>Tgl Kembali</b></td>
        <td><b>Jaminan</b></td>
        <td><b>Keperluan</b></td>
        <td><b>Status</b></td>
        <td><b>Aksi</b></td>
      </tr>
    </thead>
    <tbody>
  <?php
  $no = 1;
  foreach($content->result_array() as $i):
    $id             = $i['peminjaman_id'];
    $kd_pinjam      = $i['peminjaman_kode'];
    $tgl1 = date('d-m-Y', strtotime($i['peminjaman_tgl']));
    $tgl2 = date('d-m-Y', strtotime($i['peminjaman_tgl_kembali']));
  ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $tgl1; ?></td>
      <td><?php echo $i['barang_nama']; ?></td>
      <td><?php echo $i['peminjaman_jml']; ?></td>
      <td><?php echo $i['peminjaman_peminjam']; ?></td>
      <td><?php echo $tgl2; ?></td>
      <td><p><?php echo $i['jaminan_nama']; ?></p></td>
      <td><p><?php echo $i['keperluan_nama']; ?></p></td>
      <?php
        if($i['peminjaman_status'] == "invalid"){
      ?>
      <td><button class="btn btn-danger disabled"><?php echo $i['peminjaman_status']; ?></button></td>
      <td>
        <a href='<?php echo base_url('peminjaman/edit/'.$i['peminjaman_kode']); ?>' class='btn btn-danger'><span class="glyphicon glyphicon-refresh"></span> Kembalikan</a>
      </td>
      <?php } else { ?>
      <td><button class="btn btn-success disabled"><?php echo $i['peminjaman_status']; ?></button></td>
      <td>
        <button class="btn"><span class="glyphicon glyphicon-check"></span></button>
        <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $kd_pinjam;?>" title="Hapus Barang"><span class="fa fa-trash"></span></a>
      </td>
        <?php } ?>
    </tr>
  <?php
  $no++;
  endforeach;
  ?>
  </tbody>
</table>
</div>
</div>
<!-- Modal Peminjaman Barang -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Peminjaman</h3>
      </div>
      <!-- Body -->
      <div class="modal-body">

        <div class="col-md-12">
          <!-- Form Tambah Peminjaman -->
          <form class="form-horizontal" action="<?php echo base_url('peminjaman/add');?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="" class="col-sm-4 control-label">Barang *</label>
              <div class="col-sm-7">
              <select class="form-control select2" name="kd_barang" style="width: 100%" required>
                <option value="">-- Pilih Barang --</option>
                <?php foreach ($content2->result_array() as $i) { ?>
                <option value="<?php echo $i['barang_kode']; ?>"><?php echo $i['barang_nama']; ?></option>
                <?php } ?>
              </select>
              </div>
            </div>

          <div class="form-group">
            <label for="" class="col-sm-4 control-label">Jumlah Pinjam *</label>
            <div class="col-sm-7">
              <input type="number" class="form-control" name="jml_pinjam" placeholder="Jumlah Pinjam" required>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-4 control-label">Nama Peminjam *</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="peminjam" placeholder="Nama Peminjam" required>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-4 control-label">Tanggal Pinjam *</label>
            <div class="col-sm-7">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" name="tgl_pinjam" id="datepicker1" placeholder="Tanggal Peminjaman" required>
            </div>  
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-4 control-label">Tanggal Kembali *</label>
            <div class="col-sm-7">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" name="tgl_kembali" id="datepicker2" placeholder="Tanggal Pengembalian" required>
            </div>  
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-4 control-label">Jaminan *</label>
            <div class="col-sm-7">
            <select class="form-control select7" name="jaminan" style="width: 100%" required>
              <option value="">-- Pilih Jaminan --</option>
              <?php foreach ($content3->result_array() as $i) { ?>
              <option value="<?php echo $i['jaminan_id']; ?>"><?php echo $i['jaminan_nama']; ?></option>
              <?php } ?>
            </select>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-4 control-label">Keperluan *</label>
            <div class="col-sm-7">
            <select class="form-control select8" name="keperluan" style="width: 100%" required>
              <option value="">-- Pilih Keperluan --</option>
              <?php foreach ($content4->result_array() as $i) { ?>
              <option value="<?php echo $i['keperluan_id']; ?>"><?php echo $i['keperluan_nama']; ?></option>
              <?php } ?>
            </select>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-4"></div>
            <div class="col-sm-7">
              <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Simpan</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Batal</button>
            </div>
          </div>

          </form>
        </div>  
      </div> <!-- modal body -->
      <div class="modal-footer">
        <!-- footer -->
      </div>
    </div>
  </div>
</div>
<!-- End Peminjaman Barang -->

<!--Modal Export Peminjaman Barang-->
<div class="modal fade" id="ModalExport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-download"></span> Export To Excel</h3>
      </div>
      <form class="form-horizontal" action="<?php echo base_url('peminjaman/export');?>" method="post" enctype="multipart/form-data">
        
        <div class="modal-body"> 
                      
          <div class="form-group">
            <div class="col-sm-11">
            <i class="fa fa-info"></i> <b>Penting!</b>
              <p>Data yang akan diexport adalah data peminjaman barang.</p>
            </div>
          </div>
        
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Close</button>
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-download"></span> Lanjut</button>
         </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Export Peminjaman Barang-->

<!-- Hapus Peminjaman -->
<?php 
  foreach ($content->result_array() as $i) :
        $id               = $i['peminjaman_id'];
        $kd_pinjam        = $i['peminjaman_kode'];
        $nm_barang        = $i['barang_nama'];
?>
<!--Modal Hapus Peminjaman Barang-->
<div class="modal fade" id="ModalHapus<?php echo $kd_pinjam;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-trash"></span> Hapus Data Peminjaman</h3>
      </div>
      <form class="form-horizontal" action="<?php echo base_url('peminjaman/delete/'.$kd_pinjam);?>" method="post" enctype="multipart/form-data">
        
        <div class="modal-body"> 
                      
          <div class="form-group">
            <div class="col-sm-11">
              <p>Apakah Anda yakin mau menghapus data peminjaman <b><?php echo $nm_barang;?></b> ?</p>
            </div>
          </div> 

          <div class="form-group">
            <div class="col-sm-11">
              <strong>Penting!</strong>
              <br>
              Anda tidak akan bisa menghapus data barang ini jika sedang menggunakan pada form peminjaman barang atau barang keluar!
            </div>
          </div> 
        
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Close</button>
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-trash"></span> Hapus</button>
         </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach;?>
<script type="text/javascript">
  $(document).ready(function(){
      $(".select1").select2({
      placeholder: "Pilih Barang",
      allowClear: true
    });
  });
</script>