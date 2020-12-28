        <li>
          <a href="<?php echo base_url('home');?>"><i class="fa fa-home"></i> <span>Beranda</span></a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('lokasi'); ?>"><i class="fa fa-circle-o"></i> <span>List Lokasi</span></a></li>
            <li><a href="<?php echo base_url('jaminan'); ?>"><i class="fa fa-circle-o"></i> List Jaminan</a></li>
            <li><a href="<?php echo base_url('keperluan'); ?>"><i class="fa fa-circle-o"></i> <span>List Keperluan</span></a></li>
            <li><a href="<?php echo base_url('user'); ?>"><i class="fa fa-circle-o"></i> <span>List User</span></a></li>
          </ul>
        </li>
        <li>
          <a href="<?php echo base_url('barang'); ?>">
            <i class="fa fa-briefcase"></i>
            <span>Data Barang</span>
            
          </a>
          
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-briefcase"></i>
            <span>Peminjaman Barang</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('peminjaman'); ?>"><i class="fa fa-circle-o"></i> <span>List Peminjaman</span></a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-briefcase"></i>
            <span>Barang Habis Pakai</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('pemakaian'); ?>"><i class="fa fa-circle-o"></i> <span>List Pemakaian</span></a></li>
          </ul>
        </li>
      
        <li><a href="<?php echo base_url('tentang'); ?>"><i class="fa fa-info"></i> <span>Tentang</span></a></li>
        <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>