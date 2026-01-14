<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])){
  header('location: ../otentikasi/index.php');
  exit();
}
require '../config.php';
$title = 'Tambah PPKS - Database Asesmen';
require '../templates/header.php';
require '../templates/sidebar.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah PPKS Baru</h1>
    <a href="index.php" class="text-decoration-none"><i class="bi bi-arrow-left"></i> Kembali</a>
  </div>

  <form action="proses-pasien.php" method="POST">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">NIK (16 Digit)</label>
            <input type="text" name="nik" class="form-control" maxlength="16" required placeholder="Masukkan NIK manual">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Nama Lengkap PPKS</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Jenis PPKS</label>
            <select name="jenis_ppks" class="form-select" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="Disabilitas Terlantar (Disabilitas Fisik)">Disabilitas Terlantar (Disabilitas Fisik)</option>
                <option value="Disabilitas Terlantar (Disabilitas Intelektual)">Disabilitas Terlantar (Disabilitas Intelektual)</option>
                <option value="Disabilitas Terlantar (Disabilitas Mental)">Disabilitas Terlantar (Disabilitas Mental)</option>
                <option value="Disabilitas Terlantar (Disabilitas Sensorik)">Disabilitas Terlantar (Disabilitas Sensorik)</option>
                <option value="Disabilitas Terlantar (Disabilitas Ganda)">Disabilitas Terlantar (Disabilitas Ganda)</option>
                <option value="Anak Terlantar">Anak Terlantar</option>
                <option value="Lanjut Usia Terlantar">Lanjut Usia Terlantar</option>
                <option value="Gelandangan">Gelandangan</option>
                <option value="Pengemis">Pengemis</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="jk" value="L" checked> <label class="form-check-label">Laki-laki</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="jk" value="P"> <label class="form-check-label">Perempuan</label>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required></textarea>
        </div>
    </div>
    <button type="submit" name="simpan" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Data</button>
  </form>
</main>

<?php require '../templates/footer.php'; ?>