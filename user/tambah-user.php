<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])){
  header('location: ../otentikasi/index.php');
  exit();
}

require '../config.php';
$title = 'Tambah User Baru';
require '../templates/header.php';
require '../templates/sidebar.php';

// Proteksi Halaman (Hanya Admin)
if($_SESSION['ssUserJab'] != 1){
  echo "<script>alert('Akses ditolak!'); window.location='../index.php';</script>";
  exit();
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah User Baru</h1>
    <a href="index.php" class="btn btn-outline-secondary btn-sm">
      <i class="bi bi-arrow-left"></i> Kembali ke Data User
    </a>
  </div>

  <form action="proses-user.php" method="POST" enctype="multipart/form-data">
    <div class="card shadow-sm border-0 mb-4">
      <div class="card-header bg-white py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Registrasi User</h6>
      </div>
      <div class="card-body">
        <div class="row">
          
          <div class="col-lg-4 text-center border-end">
            <div class="mb-3">
              <label class="form-label fw-bold">Foto Profil</label>
              <div class="mt-2">
                <img src="../assets/gambar/user.png" alt="Preview Foto" class="img-thumbnail rounded-circle shadow-sm tampil" style="width: 150px; height: 150px; object-fit: cover;">
              </div>
            </div>
            <div class="mb-3 px-4">
              <input type="file" class="form-control form-control-sm" name="gambar" id="gambar" onchange="imgView()">
              <small class="text-muted d-block mt-1">Format: JPG/PNG/GIF (Max 2MB)</small>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Username <span class="text-danger">*</span></label>
                <input type="text" name="username" class="form-control" placeholder="Username untuk login" required autocomplete="off">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="fullname" class="form-control" placeholder="Nama lengkap user" required>
              </div>
            </div>

            <div class="row">
               <div class="col-md-6 mb-3">
                <label class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control" placeholder="******" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                <input type="password" name="password2" class="form-control" placeholder="******" required>
              </div>
            </div>

            <div class="mb-3">
  <label class="form-label">Jabatan / Role <span class="text-danger">*</span></label>
  <select name="jabatan" class="form-select" required>
    <option value="">-- Pilih Jabatan --</option>
    <option value="1">Administrator (Akses Penuh)</option>
    <option value="2">Supervisor (Semua menu kecuali User)</option>
    <option value="3">Petugas (Data PPKS & Asesmen)</option>
  </select>
</div>

            <div class="mb-3">
              <label class="form-label">Alamat Lengkap</label>
              <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat domisili user..."></textarea>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
               <button type="reset" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-counterclockwise"></i> Reset
               </button>
               <button type="submit" name="simpan" class="btn btn-primary btn-sm px-4">
                <i class="bi bi-save"></i> Simpan User
               </button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </form>
</main>

<script>
  function imgView(){
    let gambar = document.getElementById('gambar');
    let tampil = document.querySelector('.tampil');
    
    if(gambar.files && gambar.files[0]){
        let fileReader = new FileReader();
        fileReader.readAsDataURL(gambar.files[0]);
        fileReader.addEventListener('load', (e) => {
          tampil.src = e.target.result;
        })
    }
  }
</script>

<?php require '../templates/footer.php'; ?>