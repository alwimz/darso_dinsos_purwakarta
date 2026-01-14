<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])) header('location: ../otentikasi/index.php');
require '../config.php';
$title = 'Tambah Layanan';
require '../templates/header.php';
require '../templates/sidebar.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Layanan Baru</h1>
    <a href="index.php" class="text-decoration-none"><i class="bi bi-arrow-left"></i> Kembali</a>
  </div>

  <form action="proses-obat.php" method="POST">
    <div class="mb-3">
        <label class="form-label">Jenis Layanan</label>
        <input type="text" name="jenis" class="form-control" placeholder="Contoh: Asesmen Psikologis" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Deskripsi Layanan</label>
        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
    </div>
    <button type="submit" name="simpan" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
  </form>
</main>
<?php require '../templates/footer.php'; ?>