<div class="box">
  <div class="box-header">
    <a data-toggle="modal" href="#ModalAdd" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Tambah</a>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  <div class="alert text-info alert dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa fa-info"></i> Penting!</h4>
    <h5>1. Anda pun tidak akan bisa menghapus data jaminan apabila sedang digunakan pada data peminjaman barang.</h5>
  </div>
  <table id="example1" class="table table-bordered table-striped">
    <thead class="thead-default">
      <tr>
        <th>No</th>
        <th>Jenis Jaminan</th>
        <th style="text-align:right;">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1; 
      foreach ($content->result_array() as $i) :
        $a = $i['jaminan_id'];
        $b = $i['jaminan_nama'];
      ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $b; ?></td>
          <td style="text-align:right;">
            <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $a;?>"><span class="fa fa-pencil"></span></a>
            <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $a;?>"><span class="fa fa-trash"></span></a>
          </td>
        </tr>
      <?php endforeach ?>
  </tbody>
</table>
</div>
</div>

<!-- Modal Add Jaminan-->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Jaminan</h3>
      </div>
      <form class="form-horizontal" action="<?php echo base_url('jaminan/add');?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Nama Jaminan *</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="ws_jaminan" placeholder="Masukan Nama Jaminan" required>
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
<!-- End Modal Add Jaminan -->

<!-- Modal Edit Jaminan -->

<?php
foreach ($content->result_array() as $i) :
  $a = $i['jaminan_id'];
  $b = $i['jaminan_nama'];
?>

<div class="modal fade" id="ModalEdit<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-pencil"></span> Edit Jaminan</h3>
      </div>
      <form class="form-horizontal" action="<?php echo base_url('jaminan/edit/'.$a); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Nama Jaminan *</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="ws_jaminan" placeholder="Masukan Jenis Jaminan" value="<?php echo $b; ?>" required>
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
<?php endforeach; ?>
<!-- End Modal Edit Jaminan -->

<!-- Modal Hapus Jaminan -->

<?php 
  foreach ($content->result_array() as $i) :
    $a = $i['jaminan_id'];
    $b = $i['jaminan_nama'];
?>

<div class="modal fade" id="ModalHapus<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-trash"></span> Hapus Jaminan</h3>
      </div>
      <form class="form-horizontal" action="<?php echo base_url('jaminan/delete/'.$a);?>" method="post" enctype="multipart/form-data">
      <div class="modal-body"> 
                      
        <div class="form-group">
          <div class="col-sm-11">
            <p>Apakah Anda yakin mau menghapus data <b><?php echo $b;?></b> ?</p>
          </div>
        </div> 

        <div class="form-group">
          <div class="col-sm-11">
            <strong>Penting!</strong>
            <br>
            Anda tidak akan bisa menghapus data ini jika data tersebut sedang digunakan pada data peminjaman barang!
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
<!-- End Modal Hapus Jaminan -->