<?php
session_start();
require '../config.php';
// 1. PROSES TAMBAH USER
if(isset($_POST['simpan'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $fullname = mysqli_real_escape_string($koneksi, $_POST['fullname']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']); // Password Asli
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    // VALIDASI: Cek Username Kembar
    $cek = mysqli_query($koneksi, "SELECT username FROM tbl_user WHERE username = '$username'");
    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Gagal! Username sudah terpakai.'); window.location='tambah-user.php';</script>";
        exit;
    }
    // UPLOAD FOTO (Menggunakan fungsi uploadGbr dari config.php)
    $gambar = 'user.png'; // Default
    if(!empty($_FILES['gambar']['name'])){
        $gambar = uploadGbr('tambah-user.php');
    }
    // SIMPAN KE DB (Tanpa MD5, Tanpa Alamat)
    $query = "INSERT INTO tbl_user (username, password, fullname, jabatan, gambar)
              VALUES ('$username', '$password', '$fullname', '$jabatan', '$gambar')";
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Berhasil! User baru bisa login sekarang.'); window.location='index.php';</script>";
    } else {
        // Tampilkan pesan error asli mysql untuk diagnosa jika gagal
        echo "Gagal Simpan: " . mysqli_error($koneksi);
    }
}
// 2. PROSES UPDATE USER
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $fullname = mysqli_real_escape_string($koneksi, $_POST['fullname']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $gambarLama = $_POST['gambarLama'];
    // Cek ganti gambar
    if(!empty($_FILES['gambar']['name'])){
        $gambar = uploadGbr('index.php');
    } else {
        $gambar = $gambarLama;
    }
    $query = "UPDATE tbl_user SET
                fullname = '$fullname',
                jabatan = '$jabatan',
                gambar = '$gambar'
              WHERE id_user = '$id'"; // Pastikan primary key di tabel adalah id_user
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Data user diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "Gagal Update: " . mysqli_error($koneksi);
    }
}
// 3. HAPUS USER
if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus-user'){
    $id = $_GET['id'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tbl_user WHERE id_user = '$id'");
    if($hapus){
        echo "<script>alert('User dihapus!'); window.location='index.php';</script>";
    }
}
?>