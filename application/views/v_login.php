<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Selamat datang di aplikasi pinjam barang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/dist/css/adminlte.min.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
html{font-size: 110%}
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box" style="margin-top: -150px">
  <div class="login-logo">
    <p><b>Pinjam</b> Barang</p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
  <div class="card-body">
    <p class="login-box-msg">Login untuk mengakses data.</p>
    <?php if(isset($error)) { echo $error; } ?>
    <?php if(isset($pesan)) { echo $pesan; } ?>
    <form action="<?php echo base_url('login/log');?>" method="post" id="form">
      <div class="input-group has-feedback mb-3">
        <?php 
          $username = array('name' => 'ws_user', 'class' => 'form-control', 'placeholder' => 'Username', 'required');
          echo form_input($username); ?>
           <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
          </div>
          </div>
          <?php echo form_error('ws_user', '<font style="color: red;font-size:.875rem;">','</font>'); ?>
      </div>
      
      <div class="input-group has-feedback mb-3">
        <?php 
          $password = array('name' => 'ws_pass', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password');
          echo form_input($password); ?>
          <div class="input-group-append">
            <div class="input-group-text">
          <span class="fas fa-lock"></span>
          </div>
          </div>
         <?php echo form_error('ws_pass', '<font style="color: red;font-size:.875rem;">','</font>'); ?>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <button type="submit" class="btn bg-primary btn-block">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google"></i> Sign in using
        Google</a>
    </div> -->
    <!-- /.social-auth-links -->

    <!-- <a href="#">Lupa Password</a><br> -->
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/adminlte/plugins/jquery/jquery.min.js');?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/adminlte/dist/js/adminlte.min.js');?>"></script>
</body>
</html>
