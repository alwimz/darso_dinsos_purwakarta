<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])){ header('location: ../otentikasi/index.php'); exit(); }
require '../config.php';
$title = 'Edit Layanan';
require '../templates/header.php';
require '../templates/sidebar.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM tbl_layanan WHERE id_layanan = '$id'");
$data = mysqli_fetch_assoc($query);
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100" style="background-color: #f8f9fc;">
  
  <div class="d-flex justify-content-between align-items-center pt-4 pb-3 mb-3">
    <h3 class="fw-bold text-dark mb-0">Edit Layanan</h3>
    <a href="index.php" class="text-decoration-none text-secondary fw-bold">
      <i class="bi bi-arrow-left"></i> Kembali
    </a>
  </div>

  <div class="card border-0 shadow-sm rounded-0">
    <div class="card-body p-4">
      <form action="proses-obat.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id_layanan'] ?>">
        
        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Jenis Layanan / Bantuan</label>
            <input type="text" name="jenis" class="form-control rounded-0" value="<?= $data['jenis_layanan'] ?>" required>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-secondary">Deskripsi & Keterangan</label>
            <textarea name="deskripsi" class="form-control rounded-0" rows="4" required><?= $data['deskripsi_layanan'] ?></textarea>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" name="edit" class="btn btn-primary btn-sm px-4 rounded-0 shadow-sm">
                Simpan Perubahan
            </button>
        </div>

      </form>
    </div>
  </div>
</main>
<?php require '../templates/footer.php'; ?>