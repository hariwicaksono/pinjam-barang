<div class="box">
<div class="box-body">
<!-- Edit User -->
<?php
  $a = $content->user_id;
  $b = $content->user_nama;
  $c = $content->user_foto;
?>
      <form class="form-horizontal" action="<?php echo base_url('user/edit/'.$a); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
        
          <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Nama Lengkap *</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="ws_nama" value="<?php echo $b; ?>" placeholder="Nama Lengkap" required>
            </div>
          </div>

          <?php if(empty($c)):?>
          <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Foto Sebelumnya *</label>
            <div class="col-sm-8">
              <td><img width="100" src="<?php echo base_url().'assets/img/avatar.png';?>"></td>
            </div>
          </div> 
          <?php else:?>
            <div class="form-group">
            <label for="inputUserName" class="col-sm-3">Foto Sebelumnya *</label>
            <div class="col-sm-8">
              <td><img width="100" src="<?php echo base_url('assets/foto/user/'.$c); ?>"></td>
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
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Update</button>
            <button type="button" class="btn btn-danger" onclick="history.go(-1);"><span class="glyphicon glyphicon-remove-sign"></span> Back</button>
          </div>
      </form>
<!-- End Edit User -->
</div>
</div>