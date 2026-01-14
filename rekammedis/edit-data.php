<?php
session_start();
if(!isset($_SESSION['ssLoginRM'])){ header('location: ../otentikasi/index.php'); exit(); }
require '../config.php';
$title = 'Edit Data Asesmen - SIKS PPKS';
require '../templates/header.php';
require '../templates/sidebar.php';
$id = $_GET['id'];
// Query Data Utama
$sqlrm = "SELECT *, tbl_ppks.alamat AS alamatpasien
          FROM tbl_asesmen
          INNER JOIN tbl_ppks ON tbl_asesmen.nik = tbl_ppks.nik
          WHERE no_asesmen = '$id'";
$queryRM = mysqli_query($koneksi, $sqlrm);
$rm = mysqli_fetch_assoc($queryRM);
if (!$rm) {
    echo "<script>alert('Data Asesmen tidak ditemukan!'); window.location='index.php';</script>";
    exit();
}
// PERBAIKAN 1: Membersihkan tanda kutip (") dari database agar tampil rapi di Tokenfield
$layanan_bersih = str_replace('"', '', $rm['layanan_dibutuhkan']);
// PERBAIKAN 2: Menyiapkan data autocomplete layanan dari database
$nmLayananEdit = [];
$ql = mysqli_query($koneksi, "SELECT jenis_layanan FROM tbl_layanan");
while($dl = mysqli_fetch_array($ql)){
    $nmLayananEdit[] = $dl['jenis_layanan'];
}
?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css">
<style>
    /* Styling agar input terlihat seperti kotak surat/tags */
    .tokenfield { height: auto !important; min-height: 38px; border-radius: 0; }
    .token { background-color: #0d6efd !important; color: white !important; border: none !important; }
    .token .close { color: white !important; opacity: 0.8; }
</style>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100" style="background-color: #f8f9fc;">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data Asesmen</h1>
    <a href="index.php" class="text-decoration-none text-secondary fw-bold">Kembali</a>
  </div>
  <form action="proses-data.php" method="POST">
    <div class="row">
      <div class="col-lg-6 pe-4">
        <div class="form-group mb-3">
          <label class="form-label small fw-bold text-secondary">No Asesmen</label>
          <input type="text" name="no_rm" class="form-control rounded-0" value="<?= $rm['no_asesmen'] ?>" readonly>
        </div>
        <div class="form-group mb-3">
          <label class="form-label small fw-bold text-secondary">Tanggal Asesmen</label>
          <input type="date" name="tgl" class="form-control rounded-0" value="<?= $rm['tgl_asesmen'] ?>">
        </div>
        <div class="form-group mb-3">
          <label class="form-label small fw-bold text-secondary">Data PPKS (NIK)</label>
          <input type="text" class="form-control rounded-0" name="nik" value="<?= $rm['nik'] ?>" readonly>
        </div>
        <div class="form-group mb-3">
          <input type="text" class="form-control border-0 border-bottom bg-transparent fw-bold text-primary" value="<?= $rm['nama_ppks'] ?>" readonly>
        </div>
        <div class="form-group mb-3">
          <label class="form-label small fw-bold text-secondary">Kondisi PPKS / Keluhan</label>
          <textarea name="keluhan" class="form-control rounded-0" rows="3"><?= $rm['kondisi_ppks']; ?></textarea>
        </div>
      </div>
      <div class="col-lg-6 border-start ps-4">
        <div class="form-group mb-3">
          <label class="form-label small fw-bold text-secondary">Petugas Pemeriksa</label>
          <select name="petugas" class="form-select rounded-0">
            <?php
            // Hanya mengambil user dengan jabatan Petugas (3)
            $qu = mysqli_query($koneksi, "SELECT fullname FROM tbl_user WHERE jabatan = 3");
            while($du = mysqli_fetch_assoc($qu)){ ?>
              <option value="<?= $du['fullname'] ?>" <?= $du['fullname'] == $rm['petugas_asesmen'] ? 'selected' : ''; ?>><?= $du['fullname']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group mb-3">
          <label class="form-label small fw-bold text-secondary">Layanan yang Dibutuhkan</label>
          <input type="text" name="layanan" class="form-control rounded-0" id="tokenfield" value="<?= $layanan_bersih ?>" placeholder="Ketik layanan lalu tekan Enter..." />
          <small class="text-muted" style="font-size: 0.75rem;">*Ketik nama layanan, atau pilih dari saran yang muncul.</small>
        </div>
        <button type="submit" name="update" class="btn btn-primary btn-sm px-4 rounded-0 mt-3">
            <i class="bi bi-save me-1"></i> Simpan Perubahan
        </button>
      </div>
    </div>
  </form>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
<script>
    $(document).ready(function(){
        $('#tokenfield').tokenfield({
            autocomplete: {
                source: [<?= '"' . implode('", "', $nmLayananEdit) . '"' ?>],
                delay: 100
            },
            showAutocompleteOnFocus: true
        });
        // Memastikan input tidak submit saat tekan Enter di tokenfield
        $('#tokenfield').on('tokenfield:createdtoken', function (e) {
            // Bisa tambahkan logika lain jika perlu
        });
    });
</script>
<?php require '../templates/footer.php'; ?>