<?php
switch ($jenis) {
  // Home
  case 'Beranda': include "v_beranda.php"; break;
  // Jaminan
  case 'Jaminan': include "v_jaminan.php"; break;
  // Keperluan
  case 'Keperluan': include "v_keperluan.php"; break;
  // Lokasi
  case 'Lokasi': include "v_lokasi.php"; break;
  // User
  case 'User': include "v_user.php"; break;
  // Barang
  case 'Barang': include "v_barang.php"; break;
  case 'Edit Barang': include "v_edit_barang.php"; break;
  // Pemakaian
  case 'Pemakaian Barang': include "v_pemakaian_barang.php"; break;
  case 'Edit Pemakaian Barang': include "v_edit_pemakaian_barang.php"; break;
  // Pemakaian
  case 'Peminjaman Barang': include "v_peminjaman_barang.php"; break;
  case 'Edit Peminjaman Barang': include "v_edit_peminjaman_barang.php"; break;
  // Tentang
  case "Tentang";include("v_tentang.php"); break;
	default:
		# code...
		break;
}