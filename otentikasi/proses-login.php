<?php
ob_start();
session_start();
require_once "../config.php";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    // Query Database Normal
    $queryLogin = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($queryLogin) === 1) {
        $row = mysqli_fetch_assoc($queryLogin);
        // Cek Password Normal
        if ($password === $row['password']) {
            $_SESSION['ssLoginRM'] = true;
            $_SESSION['ssUser'] = $row['username'];
            // Pastikan kolom jabatan sesuai database (biasanya 1=Admin)
            $_SESSION['ssUserJab'] = isset($row['jabatan']) ? $row['jabatan'] : 1;
            // Cek Gambar
            if (isset($row['gambar']) && !empty($row['gambar'])) {
                $_SESSION['ssGambar'] = $row['gambar'];
            } else {
                $_SESSION['ssGambar'] = 'user.png';
            }
            ob_end_clean();
            header("location: ../index.php");
            exit();
        }
    }
    ob_end_clean();
    echo "<script>alert('Username atau Password salah!'); window.location='index.php';</script>";
    exit();
}
?>