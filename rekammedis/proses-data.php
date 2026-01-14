<?php
session_start();
require '../config.php';
// 1. PROSES TAMBAH DATA (SIMPAN)
if(isset($_POST['simpan'])){
    // Menggunakan 'no_asesmen' dan 'kondisi' (Sesuai file tambah-data.php asli Anda)
    // Gunakan ternary operator ( ? : ) untuk berjaga-jaga jika namanya beda
    $no = isset($_POST['no_asesmen']) ? $_POST['no_asesmen'] : $_POST['no_rm'];
    $tgl = $_POST['tgl'];
    $nik = $_POST['nik'];
    $petugas = $_POST['petugas'];
    $kondisi = isset($_POST['kondisi']) ? $_POST['kondisi'] : $_POST['keluhan'];
    $layanan = $_POST['layanan'];
    // Validasi: Cegah data kosong
    if(empty($no) || empty($nik) || empty($kondisi)){
        echo "<script>alert('Gagal! Data Asesmen, NIK, atau Kondisi tidak boleh kosong.'); window.location='tambah-data.php';</script>";
        exit();
    }
    // Format Layanan: Tambah tanda kutip otomatis
    $arr_layanan = explode(',', $layanan);
    $layanan_rapi = [];
    foreach($arr_layanan as $l){
        $l = trim($l);
        $l = str_replace('"', '', $l);
        if(!empty($l)) $layanan_rapi[] = '"'.$l.'"';
    }
    $layanan_db = implode(', ', $layanan_rapi);
    $query = "INSERT INTO tbl_asesmen (no_asesmen, tgl_asesmen, nik, petugas_asesmen, kondisi_ppks, layanan_dibutuhkan)
              VALUES('$no', '$tgl', '$nik', '$petugas', '$kondisi', '$layanan_db')";
    if(mysqli_query($koneksi, $query)){
        header("location:index.php?msg=disimpan");
    } else {
        echo "<script>alert('Error Database: ".mysqli_error($koneksi)."'); window.history.back();</script>";
    }
}
// 2. PROSES UPDATE DATA (EDIT)
if(isset($_POST['update'])){
    // Menggunakan 'no_rm' dan 'keluhan' (Sesuai file edit-data.php yang baru kita buat)
    $no = isset($_POST['no_rm']) ? $_POST['no_rm'] : $_POST['no_asesmen'];
    $tgl = $_POST['tgl'];
    // $nik tidak diupdate karena readonly/disable
    $petugas = $_POST['petugas'];
    $kondisi = isset($_POST['keluhan']) ? $_POST['keluhan'] : $_POST['kondisi'];
    $layanan = $_POST['layanan'];
    // Validasi blank
    if(empty($kondisi)){
        echo "<script>alert('Kondisi PPKS / Keluhan tidak boleh kosong!'); window.history.back();</script>";
        exit();
    }
    // Format Layanan
    $arr_layanan = explode(',', $layanan);
    $layanan_rapi = [];
    foreach($arr_layanan as $l){
        $l = trim($l);
        $l = str_replace('"', '', $l);
        if(!empty($l)) $layanan_rapi[] = '"'.$l.'"';
    }
    $layanan_db = implode(', ', $layanan_rapi);
    // Update Data
    $query = "UPDATE tbl_asesmen SET
                tgl_asesmen = '$tgl',
                petugas_asesmen = '$petugas',
                kondisi_ppks = '$kondisi',
                layanan_dibutuhkan = '$layanan_db'
              WHERE no_asesmen = '$no'";
    if(mysqli_query($koneksi, $query)){
        header("location:index.php?msg=diupdate");
    } else {
        echo "<script>alert('Error Database: ".mysqli_error($koneksi)."'); window.history.back();</script>";
    }
}
// 3. PROSES HAPUS
if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus'){
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM tbl_asesmen WHERE no_asesmen = '$id'");
    header("location:index.php?msg=dihapus");
}
?>