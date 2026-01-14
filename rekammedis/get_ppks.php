<?php
require '../config.php';

if(isset($_GET['nik'])){
    $nik = $_GET['nik'];
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_ppks WHERE nik = '$nik'");
    $data = mysqli_fetch_assoc($query);

    if($data){
        echo json_encode(['status' => 'ok', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'not_found']);
    }
}
?>