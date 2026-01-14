<?php
date_default_timezone_set('Asia/Jakarta');
$host = 'localhost';
$user = 'darn5374_rehsos';
$pass = 'Rehsos2026';
$dbname = 'darn5374_db_darso';
$koneksi = mysqli_connect($host, $user, $pass, $dbname);
$main_url = "https://darso.online/";
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
function uploadGbr($url){
  $namafile = $_FILES['gambar']['name'];
  $ukuran = $_FILES['gambar']['size'];
  $tmp = $_FILES['gambar']['tmp_name'];
  $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif'];
  $ekstensiFile = explode('.', $namafile);
  $ekstensiFile = strtolower(end($ekstensiFile));
  if(!in_array($ekstensiFile, $ekstensiValid)){
    echo "<script>alert('Bukan file gambar!'); window.location = '$url';</script>"; die();
  }
  $namafileBaru = time() . '-' . $namafile;
  move_uploaded_file($tmp, '../assets/gambar/' . $namafileBaru);
  return $namafileBaru;
}
// JANGAN PAKAI TAG PENUTUP PHP DI SINI UNTUK MENGHINDARI SPASI KOSONG