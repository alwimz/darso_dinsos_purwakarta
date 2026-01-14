<?php
session_start();
require '../config.php';

// PROSES TAMBAH (ADD)
if(isset($_POST['simpan'])){
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $tgl = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $jenis = $_POST['jenis_ppks'];

    $query = "INSERT INTO tbl_ppks VALUES('$nik', '$nama', '$tgl', '$jk', '$alamat', '$jenis')";
    mysqli_query($koneksi, $query);
    header("location:index.php");
}

// PROSES UPDATE (EDIT)
if(isset($_POST['edit'])){
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $tgl = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $jenis = $_POST['jenis_ppks'];

    // Update berdasarkan NIK
    $query = "UPDATE tbl_ppks SET 
                nama_ppks = '$nama', 
                tgl_lahir = '$tgl', 
                jk = '$jk', 
                alamat = '$alamat', 
                jenis_ppks = '$jenis' 
              WHERE nik = '$nik'";
    mysqli_query($koneksi, $query);
    header("location:index.php");
}

// PROSES HAPUS
if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus'){
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM tbl_ppks WHERE nik = '$id'");
    header("location:index.php");
}
?>