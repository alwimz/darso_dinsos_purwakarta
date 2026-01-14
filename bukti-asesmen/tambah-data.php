<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])) header('location: ../otentikasi/index.php');
// Proteksi: Hanya Administrator yang bisa akses
if($_SESSION['ssUserJab'] != 1){
  echo "<script>alert('Akses ditolak! Hanya Administrator yang bisa mengakses halaman ini.'); window.location='../index.php';</script>"; exit();
}
require '../config.php';
$title = 'Input Bukti Asesmen';
require '../templates/header.php';
require '../templates/sidebar.php';

// Check if editing existing asesmen
$editMode = false;
$existingData = null;
if(isset($_GET['no'])) {
    $no_asesmen = mysqli_real_escape_string($koneksi, $_GET['no']);
    $q = mysqli_query($koneksi, "SELECT a.*, p.nama_ppks, p.jenis_ppks 
                                 FROM tbl_asesmen a 
                                 INNER JOIN tbl_ppks p ON a.nik = p.nik 
                                 WHERE a.no_asesmen = '$no_asesmen'");
    if(mysqli_num_rows($q) > 0){
        $existingData = mysqli_fetch_assoc($q);
        $editMode = true;
    }
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Input Bukti Asesmen</h1>
  </div>

  <form action="proses-data.php" method="POST">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">Data PPKS (Klien)</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Cari NIK</label>
                        <div class="input-group">
                            <input type="text" id="cari_nik" class="form-control" placeholder="Masukkan NIK" value="<?= $editMode ? $existingData['nik'] : '' ?>">
                            <button class="btn btn-secondary" type="button" id="btnCari">Cari</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIK (Otomatis)</label>
                        <input type="text" name="nik" id="hasil_nik" class="form-control" readonly required value="<?= $editMode ? $existingData['nik'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama PPKS</label>
                        <input type="text" id="hasil_nama" class="form-control" readonly value="<?= $editMode ? $existingData['nama_ppks'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis PPKS</label>
                        <input type="text" id="hasil_jenis" class="form-control" readonly value="<?= $editMode ? $existingData['jenis_ppks'] : '' ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">Detail Bukti Asesmen</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">No. Asesmen</label>
                        <input type="text" id="hasil_no_asesmen" name="no_asesmen" class="form-control" readonly required value="<?= $editMode ? $existingData['no_asesmen'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link Bukti Asesmen</label>
                        <input type="url" name="link_bukti" class="form-control" placeholder="https://drive.google.com/..." value="<?= $editMode ? ($existingData['link_bukti'] ?? '') : '' ?>" required>
                        <small class="text-muted">Masukkan link Google Drive, Dropbox, atau URL lainnya</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="edit_mode" value="<?= $editMode ? '1' : '0' ?>">
    <button type="submit" name="simpan" class="btn btn-primary w-100"><i class="bi bi-save"></i> Simpan Bukti Asesmen</button>
  </form>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Fitur Cari NIK - get asesmen data
    document.getElementById('btnCari').addEventListener('click', function(){
        let nik = document.getElementById('cari_nik').value;
        if(!nik) { alert('Isi NIK dulu!'); return; }
        fetch('get_asesmen.php?nik=' + nik)
        .then(response => response.json())
        .then(data => {
            if(data.status == 'ok'){
                document.getElementById('hasil_nik').value = data.data.nik;
                document.getElementById('hasil_nama').value = data.data.nama_ppks;
                document.getElementById('hasil_jenis').value = data.data.jenis_ppks;
                document.getElementById('hasil_no_asesmen').value = data.data.no_asesmen;
            } else {
                alert(data.message || 'Data tidak ditemukan!');
            }
        });
    });
</script>

<?php require '../templates/footer.php'; ?>
