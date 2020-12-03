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
    <h5>1. Anda tidak akan bisa melakukan Pemakaian jika jumlah pemakaian lebih besar dari stok Pemakaian</h5>
    <h5>2. Periksa kembali kondisi Pemakaian apabila pemakaian telah selesai.</h5>
  </div>

  <table id="example1" class="table table-bordered table-striped">
    <thead class="thead-default">
      <tr>
        <td><b>No</b></td>
        <td><b>Tgl Pakai</b></td>
        <td><b>Nama Pemakaian</b></td>
        <td><b>Jumlah</b></td>
        <td><b>Keperluan</b></td>
        <td><b>Deksripsi</b></td>
        <td><b>Aksi</b></td>
      </tr>
    </thead>
    <tbody>
  <?php
  $no = 1;
  foreach($content->result_array() as $i):
    $id          = $i['pemakaian_id'];
    $kd_pakai    = $i['pemakaian_kode'];
    $tgl         = date('d-m-Y', strtotime($i['pemakaian_tgl']));
  ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $tgl; ?></td>
      <td><?php echo $i['barang_nama']; ?></td>
      <td><?php echo $i['pemakaian_jml']; ?></td> 
      <td><?php echo $i['keperluan_nama']; ?></td>
      <td><?php echo $i['pemakaian_deskripsi']; ?></td>
      <td>
        <a class="btn" href="<?php echo base_url('pemakaian/edit/'.$kd_pakai);?>" title="Edit Pemakaian"><span class="fa fa-pencil"></span></a>
        <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $kd_pakai;?>" title="Hapus Pemakaian"><span class="fa fa-trash"></span></a>
      </td>
    </tr>
  <?php
  $no++;
  endforeach;
  ?>
  </tbody>
</table>
</div>
</div>
<!-- Modal Pemakaian Pemakaian -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Pemakaian</h3>
      </div>
      <!-- Body -->
      <div class="modal-body">

          <!-- Form Tambah Pemakaian -->
          <form class="form-horizontal" action="<?php echo base_url('pemakaian/add');?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="" class="col-sm-4 control-label">Pemakaian *</label>
              <div class="col-sm-7">
              <select class="form-control select2" name="ws_kode" style="width: 100%;" required>
                <option value="">Pilih Pemakaian</option>
                <?php foreach ($content2->result_array() as $i) { ?>
                <option value="<?php echo $i['barang_kode']; ?>"><?php echo $i['barang_nama']; ?></option>
                <?php } ?>
              </select>
              </div>
            </div>

          <div class="form-group">
            <label for="" class="col-sm-4 control-label">Jumlah Pakai *</label>
            <div class="col-sm-7">
              <input type="number" class="form-control" name="ws_jumlah" placeholder="Jumlah Pakai" required>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-4 control-label">Tanggal Pakai *</label>
            <div class="col-sm-7">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" name="ws_tgl" id="datepicker1" placeholder="Tanggal Pemakaian" required>
            </div>  
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-4 control-label">Keperluan *</label>
            <div class="col-sm-7">
            <select class="form-control select5" name="ws_keperluan" style="width: 100%" required>
              <option value="">Pilih Keperluan</option>
              <?php foreach ($content4->result_array() as $i) { ?>
              <option value="<?php echo $i['keperluan_id']; ?>"><?php echo $i['keperluan_nama']; ?></option>
              <?php } ?>
            </select>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-4 control-label">Deskripsi *</label>
            <div class="col-sm-7">
              <textarea name="ws_deskripsi" class="form-control" placeholder="Deskripsi pembagian pamakaian Pemakaian"></textarea>
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
    
      </div> <!-- modal body -->
      <div class="modal-footer">
        <!-- footer -->
      </div>
    </div>
  </div>
</div>
<!-- End Pemakaian Pemakaian -->

<!--Modal Export Pemakaian -->
<div class="modal fade" id="ModalExport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-download"></span> Export To Excel</h3>
      </div>
      <form class="form-horizontal" action="<?php echo base_url('pemakaian/export');?>" method="post" enctype="multipart/form-data">
        
        <div class="modal-body"> 
                      
          <div class="form-group">
            <div class="col-sm-11">
            <i class="fa fa-info"></i> <b>Penting!</b>
              <p>Data yang akan diexport adalah data Pemakaian habis pakai.</p>
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

<!-- Hapus Peminjaman -->
<?php 
  foreach ($content->result_array() as $i) :
    $a = $i['pemakaian_id'];
    $b = $i['pemakaian_kode'];
    $c = $i['barang_nama'];
    $d = date('d-m-Y', strtotime($i['pemakaian_tgl']));
?>
<!--Modal Hapus Peminjaman Pemakaian-->
<div class="modal fade" id="ModalHapus<?php echo $b;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-trash"></span> Hapus Data Pemakaian</h3>
      </div>
      <form class="form-horizontal" action="<?php echo base_url('pemakaian/delete/'.$b);?>" method="post" enctype="multipart/form-data">
        
        <div class="modal-body"> 
                      
          <div class="form-group">
            <div class="col-sm-11">
              <p>Apakah Anda yakin mau menghapus data pemakaian <b><?php echo $c;?></b> ?</p>
            </div>
          </div> 

          <div class="form-group">
            <div class="col-sm-11">
              <strong>Penting!</strong>
              <br>
              Anda tidak akan bisa menghapus data Pemakaian ini jika sedang menggunakan pada form peminjaman Pemakaian atau Pemakaian keluar!
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
