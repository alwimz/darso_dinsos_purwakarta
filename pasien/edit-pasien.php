<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])){ header('location: ../otentikasi/index.php'); exit(); }
require '../config.php';
$title = 'Edit Data PPKS';
require '../templates/header.php';
require '../templates/sidebar.php';

// Ambil NIK dari URL
$id = $_GET['id'];

// PERBAIKAN QUERY: tbl_pasien -> tbl_ppks
$query = mysqli_query($koneksi, "SELECT * FROM tbl_ppks WHERE nik = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if(!$data){
    echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
    exit();
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100" style="background-color: #f8f9fc;">
  
  <div class="d-flex justify-content-between align-items-center pt-4 pb-3 mb-3">
    <h3 class="fw-bold text-dark mb-0">Edit Data PPKS</h3>
    <a href="index.php" class="text-decoration-none text-secondary fw-bold">
      <i class="bi bi-arrow-left"></i> Kembali
    </a>
  </div>

  <div class="card border-0 shadow-sm rounded-0">
    <div class="card-body p-4">
      <form action="proses-pasien.php" method="POST">
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label small fw-bold text-secondary">NIK (Nomor Induk Kependudukan)</label>
                <input type="text" name="nik" class="form-control rounded-0" value="<?= $data['nik'] ?>" readonly style="background-color: #e9ecef;">
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control rounded-0" value="<?= $data['nama_ppks'] ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label small fw-bold text-secondary">Jenis PPKS</label>
                <select name="jenis_ppks" class="form-select rounded-0" required>
                    <option value="Disabilitas Terlantar (Disabilitas Fisik)" <?= $data['jenis_ppks'] == 'Disabilitas Terlantar (Disabilitas Fisik)' ? 'selected' : '' ?>>Disabilitas Terlantar (Disabilitas Fisik)</option>
                    <option value="Disabilitas Terlantar (Disabilitas Intelektual)" <?= $data['jenis_ppks'] == 'Disabilitas Terlantar (Disabilitas Intelektual)' ? 'selected' : '' ?>>Disabilitas Terlantar (Disabilitas Intelektual)</option>
                    <option value="Disabilitas Terlantar (Disabilitas Mental)" <?= $data['jenis_ppks'] == 'Disabilitas Terlantar (Disabilitas Mental)' ? 'selected' : '' ?>>Disabilitas Terlantar (Disabilitas Mental)</option>
                    <option value="Disabilitas Terlantar (Disabilitas Sensorik)" <?= $data['jenis_ppks'] == 'Disabilitas Terlantar (Disabilitas Sensorik)' ? 'selected' : '' ?>>Disabilitas Terlantar (Disabilitas Sensorik)</option>
                    <option value="Disabilitas Terlantar (Disabilitas Ganda)" <?= $data['jenis_ppks'] == 'Disabilitas Terlantar (Disabilitas Ganda)' ? 'selected' : '' ?>>Disabilitas Terlantar (Disabilitas Ganda)</option>
                    <option value="Anak Terlantar" <?= $data['jenis_ppks'] == 'Anak Terlantar' ? 'selected' : '' ?>>Anak Terlantar</option>
                    <option value="Lanjut Usia Terlantar" <?= $data['jenis_ppks'] == 'Lanjut Usia Terlantar' ? 'selected' : '' ?>>Lanjut Usia Terlantar</option>
                    <option value="Gelandangan" <?= $data['jenis_ppks'] == 'Gelandangan' ? 'selected' : '' ?>>Gelandangan</option>
                    <option value="Pengemis" <?= $data['jenis_ppks'] == 'Pengemis' ? 'selected' : '' ?>>Pengemis</option>
                    <option value="Lainnya" <?= $data['jenis_ppks'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-bold text-secondary">Jenis Kelamin</label>
                <div class="d-flex gap-3 mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jk" value="L" <?= $data['jk'] == 'L' ? 'checked' : '' ?>>
                        <label class="form-check-label small">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jk" value="P" <?= $data['jk'] == 'P' ? 'checked' : '' ?>>
                        <label class="form-check-label small">Perempuan</label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-3">
             <label class="form-label small fw-bold text-secondary">Tanggal Lahir</label>
             <input type="date" name="tgl_lahir" class="form-control rounded-0" value="<?= isset($data['tgl_lahir']) ? $data['tgl_lahir'] : '' ?>">
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-secondary">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control rounded-0" rows="3" required><?= $data['alamat'] ?></textarea>
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