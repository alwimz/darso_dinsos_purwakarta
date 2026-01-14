<?php
session_start();
require '../config.php';

// PROSES TAMBAH
if(isset($_POST['simpan'])){
  $jenis = trim(htmlspecialchars($_POST['jenis']));
  $deskripsi = trim(htmlspecialchars($_POST['deskripsi']));

  mysqli_query($koneksi, "INSERT INTO tbl_layanan VALUES('', '$jenis', '$deskripsi')");
  header('location: index.php');
}

// PROSES UPDATE (Ganti 'update' menjadi 'edit' sesuai tombol di form)
if(isset($_POST['edit'])){
  $id = $_POST['id'];
  $jenis = trim(htmlspecialchars($_POST['jenis']));
  $deskripsi = trim(htmlspecialchars($_POST['deskripsi']));

  mysqli_query($koneksi, "UPDATE tbl_layanan SET 
                jenis_layanan = '$jenis', 
                deskripsi_layanan = '$deskripsi' 
              WHERE id_layanan = '$id'");
  header('location: index.php');
}

// PROSES HAPUS
if(@$_GET['aksi'] == 'hapus'){
  $id = $_GET['id'];
  mysqli_query($koneksi, "DELETE FROM tbl_layanan WHERE id_layanan = '$id'");
  header('location: index.php');
}
?>