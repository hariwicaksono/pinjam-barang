<html>
<body>
<div class="box">
  <div class="box-header">
    <a data-toggle="modal" href="#ModalAdd" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Tambah</a>
    <a data-toggle="modal" href="#ModalImport" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Import</a>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  <div class="alert text-info alert dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa fa-info"></i> Penting!</h4>
    <h5>1. Anda tidak akan bisa menghapus data barang apabila sedang digunakan pada data pemakaian barang.</h5>
    <h5>2. Anda pun tidak akan bisa menghapus data barang apabila sedang digunakan pada data peminjaman barang.</h5>
  </div>
  <table id="example1" class="table table-bordered table-striped">
    <thead class="thead-default">
      <tr>
        <th>No</th>
        <th>Kode</th>        
        <th>Nama Barang</th>
        <th>Lokasi</th>
        <th>Jumlah</th>
        <th>Kondisi</th>
        <th>Foto</th>
        <th style="text-align:right;">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1; 
      foreach ($content->result_array() as $i) :
        $id               = $i['barang_id'];
        $kd_barang        = $i['barang_kode'];
        $nm_barang        = $i['barang_nama'];
        $sp_barang        = $i['barang_spesifikasi'];
        $lk_barang        = $i['barang_lokasi'];
        $kt_barang        = $i['barang_kategori'];
        $jm_barang        = $i['barang_jml'];
        $tgl_masuk_barang = $i['barang_tgl_masuk'];
        $kn_barang        = $i['barang_kondisi'];
        $sd_barang        = $i['barang_sumber'];
        $foto             = $i['barang_foto'];
        $link             = set_linkurl($kd_barang, $nm_barang);
      ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $kd_barang; ?></td>
          <td><?php echo $nm_barang; ?></td>
          <td><?php echo $lk_barang; ?></td>
          <td><?php echo $jm_barang ?></td>
          <td><?php echo $kn_barang; ?></td>
          <?php if(empty($foto)):?>
            <td><img width="60" src="<?php echo base_url().'assets/img/no-image.jpg';?>"></td>
          <?php else:?>
            <td><img width="60" src="<?php echo base_url('assets/foto/barang/'.$foto); ?>"></td>
          <?php endif;?>
          <td style="text-align:right;">
            <a class="btn" data-toggle="modal" data-target="#ModalDetail<?php echo $id;?>" title="Detail Barang"><span class="fa fa-eye"></span></a>
            <a class="btn" href="<?php echo base_url('barang/edit/'.$link);?>" title="Edit Barang"><span class="fa fa-pencil"></span></a>
            <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $id;?>" title="Hapus Barang"><span class="fa fa-trash"></span></a>
          </td>
        </tr>
      <?php endforeach; ?>
  </tbody>
</table>
</div>
</div>
<!-- Modal Add Barang-->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Barang</h3>
      </div>
      <form class="form-horizontal" action="<?php echo base_url('barang/add');?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Nama Barang *</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="ws_nama" placeholder="Masukan Nama Barang" required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Spesifikasi *</label>
            <div class="col-sm-7">
              <textarea name="ws_spesifikasi" class="form-control" placeholder="Spesifikasi Barang" required></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-sm-4 control-label">Lokasi Barang *</label>
            <div class="col-sm-7">
            <select class="form-control select7" name="ws_lokasi" style="width: 100%" required>
              <option value="">-- Pilih Lokasi --</option>
              <?php foreach ($content2->result_array() as $i) { ?>
              <option value="<?php echo $i['lokasi_id']; ?>"><?php echo $i['lokasi_nama']; ?></option>
              <?php } ?>
            </select>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Kategori Barang *</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="ws_kategori" placeholder="Kategori Barang" required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Tanggal Masuk *</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="ws_tgl_masuk" id="datepicker1" placeholder="Tanggal Masuk" required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Jumlah Barang *</label>
            <div class="col-sm-7">
              <input type="number" class="form-control" name="ws_jumlah" placeholder="0" required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Kondisi *</label>
            <div class="col-sm-7">
              <select name="ws_kondisi" class="form-control" style="width: 100%;" required> 
                <option value="">--Pilih Kondisi--</option>
                  <option value="Baru">Baru</option>
                  <option value="Second">Second</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Sumber Dana *</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="ws_sumber" placeholder="Dananya dari siapa?" required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Foto *</label>
            <div class="col-sm-7">
              <input type="file" name="filefoto"/>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Close</button>
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Add Barang -->

<!-- Modal Add Import-->
<div class="modal fade" id="ModalImport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-plus-sign"></span> Import Barang</h3>
      </div>
      <form class="form-horizontal" action="<?php echo base_url('barang/import');?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="form-group">
            <div class="col-sm-12">
              <p><strong>Penting:</strong></p>
              <p>1. Silahkan download format import data barang <a href="<?php echo base_url('assets/file/barang/format_import_barang.xls');?>">di sini</a>.<br>
              2. Isi data dengan benar sesuai kolom yang sudah ada.<br>
              3. Setelah data diisi, silahkan upload lalu klik menu <b>import</b>.<br>
              4. Proses import selesai.<br>
              5. Jika terjadi error silahkan cek kembali format yang Anda isi.</p>
            </div>
          </div>

          <div class="form-grup">
            <label for="exampleUsername">File *</label>
            <input type="file" name="fileimport"/>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Close</button>
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Import</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Add Import -->

<!-- Modal Detail Barang -->
<?php

foreach ($content->result_array() as $i) :
  $id               = $i['barang_id'];
  $kd_barang        = $i['barang_kode'];
  $nm_barang        = $i['barang_nama'];
  $sp_barang        = $i['barang_spesifikasi'];
  $lk_barang        = $i['barang_lokasi'];
  $kt_barang        = $i['barang_kategori'];
  $jm_barang        = $i['barang_jml'];
  $tgl_masuk_barang = $i['barang_tgl_masuk'];
  $kn_barang        = $i['barang_kondisi'];
  $sd_barang        = $i['barang_sumber'];
  $foto             = $i['barang_foto'];
?>

<div class="modal fade" id="ModalDetail<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h3 class="modal-title" id="myModalLabel"><span class="fa fa-eye"></span> Detail Barang</h3>
      </div>
      <div class="modal-body">        
        <table class="table table-bordered table-striped">
          <tr>
            <td width="200">Kode Barang</td>
            <td align="center">:</td>
            <td><?php echo $kd_barang; ?></td>
          </tr>
          <tr>
            <td width="200">Nama Barang</td>
            <td align="center">:</td>
            <td><?php echo $nm_barang; ?></td>
          </tr>
          <tr>
            <td width="200">Spesifikasi</td>
            <td align="center">:</td>
            <td><?php echo $sp_barang; ?></td>
          </tr>
          <tr>
            <td width="200">Lokasi Barang</td>
            <td align="center">:</td>
            <td><?php echo $lk_barang; ?></td>
          </tr>
          <tr>
            <td width="200">Kategori Barang</td>
            <td align="center">:</td>
            <td><?php echo $kt_barang; ?></td>
          </tr>
          <tr>
            <td width="200">Jumlah Barang</td>
            <td align="center">:</td>
            <td><?php echo $jm_barang; ?></td>
          </tr>
          <tr>
            <td width="200">Tanggal Masuk Barang</td>
            <td align="center">:</td>
            <td><?php echo $tgl_masuk_barang; ?></td>
          </tr>
          <tr>
            <td width="200">Kondisi Barang</td>
            <td align="center">:</td>
            <td><?php echo $kn_barang; ?></td>
          </tr>
          <tr>
            <td width="200">Sumber Barang</td>
            <td align="center">:</td>
            <td><?php echo $sd_barang; ?></td>
          </tr>
          <?php if(empty($foto)):?>
            <tr>
              <td width="200">Foto</td>
              <td align="center" width="10">:</td>
              <td><img width="100" src="<?php echo base_url().'assets/img/no-image.jpg';?>"></td>
            </tr>
          <?php else:?>
            <tr>
              <td width="200">Foto</td>
              <td align="center">:</td>
              <td><img width="100" src="<?php echo base_url('assets/foto/barang/'.$foto); ?>"></td>
            </tr>
          <?php endif;?>
          </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php   endforeach; ?>

<!-- Hapus Barang -->
<?php 
  foreach ($content->result_array() as $i) :
    $id               = $i['barang_id'];
    $kd               = $i['barang_kode'];
    $nm_barang        = $i['barang_nama'];
?>
<!--Modal Hapus Barang-->
<div class="modal fade" id="ModalHapus<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-trash"></span> Hapus Barang</h3>
      </div>
      <form class="form-horizontal" action="<?php echo base_url('barang/delete/'.$kd);?>" method="post" enctype="multipart/form-data">
        <div class="modal-body"> 
                      
          <div class="form-group">
            <div class="col-sm-11">
              <p>Apakah Anda yakin mau menghapus data <b><?php echo $nm_barang;?></b> ?</p>
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
</body>
</html>
