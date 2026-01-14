<?php
session_start();
if(!isset($_SESSION['ssLoginRM'])){ header('location: ../otentikasi/index.php'); exit(); }
require '../config.php';
$id = $_GET['id'];
$query = "SELECT * FROM tbl_asesmen
          INNER JOIN tbl_ppks ON tbl_asesmen.nik = tbl_ppks.nik
          WHERE no_asesmen = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);
if(!$data){ echo "<script>alert('Data tidak ditemukan!'); window.close();</script>"; exit(); }
// --- LOGIKA FORMAT LAYANAN (ANGKA & RAPAT KIRI) ---
$raw_layanan = $data['layanan_dibutuhkan'];
$clean_layanan = str_replace('"', '', $raw_layanan); // Hapus tanda kutip
$array_layanan = explode(',', $clean_layanan); // Pecah jadi array
$list_layanan = "";
if(!empty($clean_layanan)){
    // Format: 1. Nama Layanan (lalu Enter)
    $no = 1;
    foreach($array_layanan as $item){
        $item = trim($item);
        if(!empty($item)){
            $list_layanan .= $no . ". " . $item . "<br>";
            $no++;
        }
    }
} else {
    $list_layanan = "- Tidak ada layanan khusus -";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Asesmen</title>
    <link href="<?= $main_url ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Times New Roman', serif; color: #000; background-color: #fff; font-size: 12pt; }
        /* Kop Surat */
        .kop-container {
            display: flex;
            align-items: center;
            padding-bottom: 5px;
            border-bottom: 3px solid #000;
            margin-bottom: 2px;
        }
        .logo-pemkab { width: 90px; height: auto; margin-right: 20px; }
        .kop-text { text-align: center; flex-grow: 1; }
        .kop-text h4 { margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase; }
        .kop-text h3 { margin: 0; font-size: 16pt; font-weight: bold; text-transform: uppercase; }
        .kop-text p { margin: 0; font-size: 10pt; line-height: 1.3; }
        .garis-tipis { border-top: 1px solid #000; margin-bottom: 25px; }
        /* Judul */
        .judul-laporan { text-align: center; margin-bottom: 30px; }
        .judul-laporan h5 { text-decoration: underline; font-weight: bold; margin: 0; text-transform: uppercase; font-size: 14pt; }
        /* Span Nomor Dokumen dihapus */
        /* Tabel Biodata */
        .table-data { width: 100%; margin-bottom: 20px; }
        .table-data tr td { padding: 3px 0; vertical-align: top; }
        .label-col { width: 180px; font-weight: bold; }
        .sep-col { width: 20px; text-align: center; }
        /* Tabel Hasil Asesmen */
        .table-hasil { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table-hasil th, .table-hasil td { border: 1px solid #000; padding: 8px 12px; vertical-align: top; }
        .table-hasil th { background-color: #f0f0f0; text-align: left; width: 35%; }
        /* Tanda Tangan */
        .ttd-container { margin-top: 50px; display: flex; justify-content: flex-end; }
        .ttd-box { width: 250px; text-align: center; }
    </style>
</head>
<body onload="window.print()">
    <div class="container mt-4">
        <div class="kop-container">
            <img src="<?= $main_url ?>assets/gambar/kop.png" class="logo-pemkab" alt="Logo" onerror="this.style.display='none'">
            <div class="kop-text">
                <h4>PEMERINTAH KABUPATEN PURWAKARTA</h4>
                <h3>DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN<br>DAN PERLINDUNGAN ANAK</h3>
                <p>Jl. Taman Pahlawan Nomor 9 Purwakarta 41119 Telp/Fax 0264-8304578</p>
                <p>Email: dinsosp3a.kab.purwakarta@gmail.com | Website: dinsosp3a.purwakartakab.go.id</p>
            </div>
        </div>
        <div class="garis-tipis"></div>
        <div class="judul-laporan">
            <h5>LAPORAN HASIL ASESMEN REHABILITASI SOSIAL</h5>
        </div>
        <table class="table-data">
            <tr><td class="label-col">Hari / Tanggal Asesmen</td><td class="sep-col">:</td><td><?= date('d F Y', strtotime($data['tgl_asesmen'])) ?></td></tr>
            <tr><td class="label-col">NIK PPKS</td><td class="sep-col">:</td><td><?= $data['nik'] ?></td></tr>
            <tr><td class="label-col">Nama Lengkap</td><td class="sep-col">:</td><td style="font-weight: bold; text-transform: uppercase;"><?= $data['nama_ppks'] ?></td></tr>
            <tr><td class="label-col">Jenis Kelamin</td><td class="sep-col">:</td><td><?= $data['jk'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td></tr>
            <tr><td class="label-col">Kategori PPKS</td><td class="sep-col">:</td><td><?= $data['jenis_ppks'] ?></td></tr>
            <tr><td class="label-col">Alamat Lengkap</td><td class="sep-col">:</td><td><?= $data['alamat'] ?></td></tr>
        </table>
        <h5 style="font-weight: bold; margin-top: 20px;">Rincian Hasil Asesmen</h5>
        <table class="table-hasil">
            <tr>
                <th>Kondisi PPKS</th>
                <td><?= nl2br($data['kondisi_ppks']) ?></td>
            </tr>
            <tr>
                <th>Layanan yang Diberikan</th>
                <td><?= $list_layanan ?></td>
            </tr>
            <tr>
                <th>Petugas Pemeriksa</th>
                <td><?= $data['petugas_asesmen'] ?></td>
            </tr>
            <?php if(!empty($data['link_bukti'])): ?>
            <tr>
                <th>Bukti Asesmen</th>
                <td>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=<?= urlencode($data['link_bukti']) ?>" alt="QR Code Bukti" style="width: 100px; height: 100px;">
                </td>
            </tr>
            <?php endif; ?>
        </table>
        <div class="ttd-container">
            <div class="ttd-box">
                <p>Purwakarta, <?= date('d F Y', strtotime($data['tgl_asesmen'])) ?></p>
                <p></strong>Petugas</strong></p>
                <br><br><br>
                <p style="text-decoration: underline; font-weight: bold;"><?= $data['petugas_asesmen'] ?></p>
            </div>
        </div>
    </div>
</body>
</html>