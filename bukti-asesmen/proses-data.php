<?php
session_start();
require '../config.php';

if(isset($_POST['simpan'])){
    $no_asesmen = mysqli_real_escape_string($koneksi, $_POST['no_asesmen']);
    $link_bukti = mysqli_real_escape_string($koneksi, $_POST['link_bukti']);
    
    // Validate
    if(empty($no_asesmen) || empty($link_bukti)){
        echo "<script>alert('No. Asesmen dan Link Bukti tidak boleh kosong!'); window.history.back();</script>";
        exit();
    }
    
    // Update link_bukti in tbl_asesmen
    $query = "UPDATE tbl_asesmen SET link_bukti = '$link_bukti' WHERE no_asesmen = '$no_asesmen'";
    
    if(mysqli_query($koneksi, $query)){
        if(mysqli_affected_rows($koneksi) > 0){
            header("location:index.php?msg=disimpan");
        } else {
            echo "<script>alert('No. Asesmen tidak ditemukan atau tidak ada perubahan!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Error Database: ".mysqli_error($koneksi)."'); window.history.back();</script>";
    }
}
?>
