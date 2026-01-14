<?php
require '../config.php';

$nik = mysqli_real_escape_string($koneksi, $_GET['nik']);

// First check if PPKS exists
$q_ppks = mysqli_query($koneksi, "SELECT * FROM tbl_ppks WHERE nik = '$nik'");
if(mysqli_num_rows($q_ppks) == 0){
    echo json_encode(['status' => 'error', 'message' => 'Data PPKS tidak ditemukan!']);
    exit;
}
$ppks = mysqli_fetch_assoc($q_ppks);

// Then check if asesmen exists for this NIK
$q_asesmen = mysqli_query($koneksi, "SELECT no_asesmen, link_bukti FROM tbl_asesmen WHERE nik = '$nik' ORDER BY tgl_asesmen DESC LIMIT 1");
if(mysqli_num_rows($q_asesmen) == 0){
    echo json_encode(['status' => 'error', 'message' => 'Data Asesmen untuk NIK ini belum ada! Silakan input asesmen terlebih dahulu.']);
    exit;
}
$asesmen = mysqli_fetch_assoc($q_asesmen);

echo json_encode([
    'status' => 'ok',
    'data' => [
        'nik' => $ppks['nik'],
        'nama_ppks' => $ppks['nama_ppks'],
        'jenis_ppks' => $ppks['jenis_ppks'],
        'no_asesmen' => $asesmen['no_asesmen'],
        'link_bukti' => $asesmen['link_bukti'] ?? ''
    ]
]);
?>
